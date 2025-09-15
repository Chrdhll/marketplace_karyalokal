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
        
        // Hitung total pendapatan dari pesanan yang sudah selesai
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // Hitung jumlah pesanan baru (yang sudah dibayar) bulan ini
        $newOrdersCount = Order::where('status', 'paid')->whereMonth('created_at', now()->month)->count();

        // Hitung total freelancer yang aktif
        $freelancerCount = User::where('role', 'freelancer')->where('profile_status', 'approved')->count();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue))
                ->description('Dari semua pesanan yang selesai')
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