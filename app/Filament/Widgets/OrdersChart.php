<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class OrdersChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Pesanan 7 Hari Terakhir';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('count', 'date');

        return [
            'datasets' => [
                [
                    'label' => 'Pesanan Dibuat',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgb(54, 162, 235)',
                ],
            ],
            'labels' => $data->keys()->map(fn ($date) => Carbon::parse($date)->format('d M'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}