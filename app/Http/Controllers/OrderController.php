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
        // 1. Cek dulu apakah ada pesanan pending untuk gig ini
        $pendingOrder = Order::where('client_id', Auth::id())
                             ->where('gig_id', $gig->id)
                             ->where('status', 'pending')
                             ->first();

        // Jika sudah ada, jangan buat baru, langsung arahkan ke pembayaran
        if ($pendingOrder) {
            return redirect()->route('payment.show', $pendingOrder->id);
        }

        // 2. Jika belum ada, buat pesanan baru
        $order = Auth::user()->ordersAsClient()->create([
            'gig_id' => $gig->id,
            'freelancer_id' => $gig->user_id,
            'total_price' => $gig->price,
            'status' => 'pending',
        ]);

        // 3. Langsung redirect ke halaman pembayaran yang baru
        return redirect()->route('payment.show', $order->id);
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

    public function showPayment(Order $order)
{
    // Keamanan: pastikan user adalah pemilik order
    if ($order->client_id !== Auth::id()) {
        abort(403);
    }
    
    // Jika order sudah dibayar, redirect ke daftar pesanan
    if ($order->status !== 'pending') {
        return redirect()->route('index')->with('info', 'Pesanan ini sudah diproses.');
    }

    // Buat ulang Snap Token untuk pembayaran
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');

    $midtrans_params = [
        'transaction_details' => [
            'order_id' => $order->id . '-' . time(),
            'gross_amount' => $order->total_price,
        ],
        'customer_details' => [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
        ],
    ];
    $snapToken = \Midtrans\Snap::getSnapToken($midtrans_params);

    // Gunakan kembali view payment.blade.php
    return view('orders.payment', compact('snapToken', 'order'));
}

 public function cancel(Order $order)
    {
        // 1. Keamanan: Pastikan yang membatalkan adalah Klien dari pesanan ini.
        if ($order->client_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // 2. Logika: Pastikan hanya pesanan 'pending' yang bisa dibatalkan.
        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan yang sudah diproses tidak dapat dibatalkan.');
        }

        // 3. Ubah status menjadi 'cancelled'
        $order->update(['status' => 'cancelled']);

        // 4. Redirect kembali ke daftar pesanan dengan pesan sukses
        return redirect()->route('order.index')->with('success', 'Pesanan #' . $order->id . ' telah berhasil dibatalkan.');
    }
}
