<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    // Ganti heading "Harga" menjadi "Pendapatan"
    public function headings(): array
    {
        return ["ID Pesanan", "Tanggal Selesai", "Jasa", "Klien", "Pendapatan (Rp)"];
    }

    // Sesuaikan data yang diekspor
    public function map($order): array
    {
        return [
            $order->order_number, // <-- Gunakan order_number yang lebih rapi
            $order->updated_at->format('d/m/Y'),
            $order->gig->title,
            $order->client->name,
            $order->freelancer_earning, // <-- Tampilkan pendapatan bersih freelancer
        ];
    }
}
