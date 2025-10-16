<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Cek apakah status BARU SAJA diubah menjadi 'completed'
        if ($order->wasChanged('status') && $order->status === 'completed') {

            // Ambil data freelancer yang terhubung dengan pesanan ini
            $freelancer = $order->freelancer;
            $freelancerProfile = $freelancer->freelancerProfile;

            // Jika freelancer dan profilnya ada
            if ($freelancer && $freelancerProfile) {

                // Tentukan persentase komisi (10%)
                $commissionRate = 0.10;

                // Hitung komisi dan pendapatan bersih
                $platformFee = $order->total_price * $commissionRate;
                $freelancerEarning = $order->total_price - $platformFee;

                // 1. Update kolom di tabel 'orders' untuk catatan
                $order->platform_fee = $platformFee;
                $order->freelancer_earning = $freelancerEarning;
                $order->saveQuietly(); // Simpan tanpa memicu event lagi

                // 2. Tambahkan pendapatan bersih ke saldo freelancer
                $freelancerProfile->increment('balance', $freelancerEarning);

                // Catat di log untuk debugging (opsional tapi bagus)

                Log::info("Pesanan {$order->order_number} selesai. Saldo freelancer #{$freelancer->id} ditambah sebesar {$freelancerEarning}.");
            }
        }
    }
}
