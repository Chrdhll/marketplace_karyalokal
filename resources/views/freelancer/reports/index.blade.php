@extends('layouts.freelancer')
@section('title', 'Laporan Pendapatan')
@section('content')
    <section class="section_gap  mt-5">
        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h1 class="h2 mb-0">Laporan Pendapatan</h1>

                {{-- Tombol Aksi: Filter & Ekspor --}}
                <div>
                    <div class="btn-group mb-2" role="group">
                        <a href="{{ route('freelancer.reports.index', ['filter' => 'week']) }}"
                            class="btn {{ $filter == 'week' ? 'btn-warning' : 'btn-outline-warning' }}">Minggu Ini</a>
                        <a href="{{ route('freelancer.reports.index', ['filter' => 'month']) }}"
                            class="btn {{ $filter == 'month' ? 'btn-warning' : 'btn-outline-warning' }}">Bulan Ini</a>
                        <a href="{{ route('freelancer.reports.index', ['filter' => 'year']) }}"
                            class="btn {{ $filter == 'year' ? 'btn-warning' : 'btn-outline-warning' }}">Tahun Ini</a>
                        <a href="{{ route('freelancer.reports.index', ['filter' => 'all']) }}"
                            class="btn {{ $filter == 'all' ? 'btn-warning' : 'btn-outline-warning' }}">Semua</a>
                    </div>
                    <div class="btn-group mb-2">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"> <i
                                class="fa fa-download"></i> Ekspor
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item"
                                href="{{ route('freelancer.reports.export.pdf', ['filter' => $filter]) }}"
                                target="_blank">Unduh sebagai PDF</a>
                            <a class="dropdown-item"
                                href="{{ route('freelancer.reports.export.excel', ['filter' => $filter]) }}">Unduh sebagai
                                Excel</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('freelancer.reports.print', ['filter' => $filter]) }}"
                                target="_blank">Cetak</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kartu Ringkasan Statistik --}}
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Total Pendapatan (Periode Terpilih)</h6>
                            <h4 class="card-title font-weight-bold">Rp
                                {{ number_format($summary['total_revenue'], 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Jumlah Pesanan (Periode Terpilih)</h6>
                            <h4 class="card-title font-weight-bold">{{ $summary['total_orders'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Rincian --}}
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
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
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
    </section>


@endsection

@push('styles-footer')
    <style>
        /* Target yang lebih spesifik untuk tombol filter periode.
                  Kita ubah dari .btn-primary menjadi .btn-warning agar warnanya kuning.
                */
        .btn-group>.btn.btn-warning {
            background-color: #ffba00;
            border-color: #ffba00;
            color: #212529;
            /* Teks hitam agar kontras */
        }

        /* Target untuk tombol dropdown Ekspor */
        .btn-group>.btn.dropdown-toggle:focus,
        .btn-group>.btn.dropdown-toggle:active,
        .btn-group>.btn.dropdown-toggle.show {
            background-color: #ffba00 !important;
            border-color: #ffba00 !important;
            color: #212529 !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 186, 0, 0.5) !important;
        }
    </style>
@endpush
