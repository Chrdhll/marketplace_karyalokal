<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendapatan</title>
    <style> body { font-family: sans-serif; } table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; } th { background-color: #f2f2f2; } </style>
</head>
<body>
    <h1>Laporan Pendapatan</h1>
    <p>Periode: {{ ucfirst($filter) }}</p>
    <p>Total Pendapatan: Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</p>
    <p>Total Pesanan: {{ $summary['total_orders'] }}</p>
    <hr>
    <table>
        <thead>
            <tr><th>ID Pesanan</th><th>Tanggal Selesai</th><th>Jasa</th><th>Klien</th><th>Pendapatan</th></tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>#{{ $order->uuid }}</td>
                <td>{{ $order->updated_at->format('d M Y') }}</td>
                <td>{{ $order->gig->title }}</td>
                <td>{{ $order->client->name }}</td>
                <td>Rp {{ number_format($order->freelancer_earning, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>