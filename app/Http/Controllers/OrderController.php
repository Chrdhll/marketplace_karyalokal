<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik klien yang sedang login.
     */
    public function index()
    {
        $orders = Auth::user()->ordersAsClient()->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Menyimpan pesanan baru ke database.
     */
    public function checkout(Gig $gig)
    {
        // Tampilkan halaman konfirmasi pesanan
        return view('orders.checkout', compact('gig'));
    }

    public function processCheckout(Request $request, Gig $gig)
    {
        // 1. Buat pesanan di database dengan status 'pending'
        $order = Auth::user()->ordersAsClient()->create([
            'gig_id' => $gig->id,
            'freelancer_id' => $gig->user_id,
            'total_price' => $gig->price,
            'status' => 'pending',
        ]);

        // 2. Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        // 3. Siapkan data untuk Midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $order->id . '-' . time(), // Order ID unik
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        // 4. Dapatkan Snap Token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($midtrans_params);

        // 5. Kirim Snap Token ke view
        return view('orders.payment', compact('snapToken', 'order'));
    }

    public function downloadDelivery(Order $order)
    {
        // Keamanan: Pastikan yang download adalah klien dari pesanan ini
        if ($order->client_id !== Auth::id()) {
            abort(403);
        }
        // Keamanan: Pastikan file-nya ada
        if (!$order->delivered_file_path || !Storage::exists($order->delivered_file_path)) {
            abort(404);
        }
        // Lakukan download
        return Storage::download($order->delivered_file_path);
    }

    public function show(Order $order)
    {
        // Keamanan: Pastikan yang melihat adalah Klien atau Freelancer dari pesanan ini.
        if (Auth::id() !== $order->client_id && Auth::id() !== $order->freelancer_id) {
            abort(403, 'AKSES DITOLAK');
        }

        $order->load(['gig', 'client', 'freelancer', 'messages.user', 'review']);

        return view('orders.show', compact('order'));
    }

    public function postMessage(Request $request, Order $order)
    {
        // 1. Keamanan: Pastikan yang mengirim pesan adalah Klien atau Freelancer dari pesanan ini.
        if (Auth::id() !== $order->client_id && Auth::id() !== $order->freelancer_id) {
            abort(403, 'AKSES DITOLAK');
        }

        // 2. Validasi: Pastikan pesan tidak kosong.
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // 3. Simpan pesan ke database menggunakan relasi
        $order->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->input('message'),
        ]);

        // 4. Redirect kembali ke halaman detail pesanan
        return back()->with('success', 'Pesan berhasil terkirim!');
    }
}
