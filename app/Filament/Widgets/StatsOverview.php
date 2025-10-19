<?php

namespace App\Filament\Widgets;

use App\Models\Gig;
use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Menghitung PENDAPATAN BERSIH PLATFORM (Komisi 10%)
        $totalRevenue = Order::where('status', 'completed')->sum('platform_fee');

        // Menghitung jumlah pesanan baru (yang sudah dibayar dan selesai) bulan ini
        $newOrdersCount = Order::where('status', '!=', 'pending')
            ->where(function ($query) {
                $query->where('status', 'completed')->orWhere('status', 'delivered');
            })
            ->whereMonth('created_at', now()->month)
            ->count();

        // Menghitung total freelancer yang aktif
        $freelancerCount = User::whereHas('freelancerProfile', function ($query) {
            $query->where('profile_status', 'approved');
        })->count();

        return [
            Stat::make('Pendapatan Platform', 'Rp ' . number_format($totalRevenue))
                ->description('Total komisi 10% dari semua pesanan selesai')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Pesanan Baru (Bulan Ini)', $newOrdersCount)
                ->description('Pesanan yang sudah dibayar')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),
            Stat::make('Freelancer Aktif', $freelancerCount)
                ->description('Total freelancer yang sudah disetujui')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}