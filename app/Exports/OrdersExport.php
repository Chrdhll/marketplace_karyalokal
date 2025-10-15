<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $orders;
    public function __construct($orders) { $this->orders = $orders; }
    public function collection() { return $this->orders; }
    public function headings(): array { return ["ID Pesanan", "Tanggal", "Jasa", "Klien", "Harga"]; }
    public function map($order): array {
        return [
            '#' . $order->id,
            $order->updated_at->format('d/m/Y'),
            $order->gig->title,
            $order->client->name,
            $order->total_price,
        ];
    }
}