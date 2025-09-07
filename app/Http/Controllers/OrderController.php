<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik klien yang sedang login.
     */
    public function index()
    {
        $orders = Order::where('client_id', Auth::id())
                       ->latest()
                       ->paginate(10);
        
        // Nanti kita akan buat view untuk ini
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
        $order = Order::create([
            'gig_id' => $gig->id,
            'client_id' => Auth::id(),
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
}
