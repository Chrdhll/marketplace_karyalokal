<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Pendapatan</title>
    {{-- Kita pakai CSS Bootstrap dari CDN agar tabelnya tetap rapi --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media print {

            /* Sembunyikan tombol saat dicetak */
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print()"> {{-- Otomatis panggil dialog print saat halaman dimuat --}}
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Laporan Pendapatan</h1>
            <button class="btn btn-primary no-print" onclick="window.print()">Cetak Ulang</button>
        </div>
        <p><strong>Freelancer:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Periode:</strong> {{ ucfirst($filter) }}</p>

        <div class="row my-4">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Total Pendapatan</h6>
                        <h4 class="card-title font-weight-bold">Rp
                            {{ number_format($summary['total_revenue'], 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Jumlah Pesanan</h6>
                        <h4 class="card-title font-weight-bold">{{ $summary['total_orders'] }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal Selesai</th>
                                <th>Jasa</th>
                                <th>Klien</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($completedOrders as $order)
                                <tr>
                                    <td>#{{ $order->uuid }}</td>
                                    <td>{{ $order->updated_at->format('d M Y') }}</td>
                                    <td>{{ $order->gig->title }}</td>
                                    <td>{{ $order->client->name }}</td>
                                    <td>Rp {{ number_format($order->freelancer_earning, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada pendapatan yang tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($completedOrders->hasPages())
                <div class="card-footer">{{ $completedOrders->links() }}</div>
            @endif
        </div>
    </div>
</body>

</html>
