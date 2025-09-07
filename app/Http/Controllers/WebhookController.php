<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // 1. Set konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        // 2. Buat instance notifikasi Midtrans
        $notif = new \Midtrans\Notification();

        // 3. Ambil order_id dan status transaksi dari notifikasi
        $transactionStatus = $notif->transaction_status;
        $orderId = explode('-', $notif->order_id)[0]; // Ambil ID order asli
        $fraudStatus = $notif->fraud_status;

        // 4. Cari order di database
        $order = Order::find($orderId);

        // 5. Lakukan verifikasi signature key untuk keamanan
        $signature_key = hash('sha512', $notif->order_id . $notif->status_code . $notif->gross_amount . config('midtrans.server_key'));
        if ($notif->signature_key != $signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // 6. Handle status transaksi
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            // Jika pembayaran berhasil, update status order
            if ($fraudStatus == 'accept') {
                $order->update([
                    'status' => 'paid', // atau 'in_progress'
                    'midtrans_transaction_id' => $notif->transaction_id,
                ]);
            }
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            // Jika pembayaran gagal atau dibatalkan
            $order->update(['status' => 'cancelled']);
        }

        // Kirim response OK ke Midtrans
        return response()->json(['message' => 'Notification handled'], 200);
    }
}