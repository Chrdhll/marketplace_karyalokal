@extends('layouts.freelancer')

@section('title', 'Dashboard Freelancer')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <div class="d-lg-flex justify-content-lg-between align-items-lg-center text-center text-lg-left mb-4">
                <div>
                    <h1 class="h2 mb-0">Dashboard</h1>
                    <p class="lead text-muted">Selamat datang kembali, {{ auth()->user()->name }}!</p>
                </div>
                <div>
                    <a href="{{ route('freelancer.gigs.create') }}" class="primary-btn">Tambah Jasa Baru</a>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-shopping-cart"></i> Pesanan Baru</h5>
                            <p class="card-text display-4">{{ $stats['pesanan_baru'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-info shadow">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-spinner"></i> Sedang Dikerjakan</h5>
                            <p class="card-text display-4">{{ $stats['pesanan_dikerjakan'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-check-circle"></i> Pesanan Selesai</h5>
                            <p class="card-text display-4">{{ $stats['pesanan_selesai'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-dark shadow">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-money"></i> Total Pendapatan</h5>
                            <p class="card-text h2">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                {{-- <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Total Pendapatan</h6>
                            <h4 class="card-title font-weight-bold">Rp
                                {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</h4>
                            <a href="#" class="card-link stretched-link">Lihat Laporan</a>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Pendapatan (Bulan Ini)</h6>
                            <h4 class="card-title font-weight-bold">Rp
                                {{ number_format($stats['pendapatan_bulan_ini'], 0, ',', '.') }}</h4>
                            <a href="{{ route('freelancer.reports.index') }}"
                                class="card-link stretched-link text-warning">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Rating Rata-Rata</h6>
                            <h4 class="card-title font-weight-bold">{{ $stats['rating'] }} / 5.0 <span
                                    class="text-warning">★</span></h4>
                            <a href="{{ route('freelancer.reviews.index') }}"
                                class="card-link stretched-link text-warning">Lihat Ulasan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Pesanan Aktif</h6>
                            <h4 class="card-title font-weight-bold">{{ $stats['pesanan_aktif'] }}</h4>
                            <a href="{{ route('freelancer.orders.index') }}"
                                class="card-link stretched-link text-warning">Kelola
                                Pesanan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Jasa Aktif</h6>
                            <h4 class="card-title font-weight-bold">{{ $stats['total_gigs'] }}</h4>
                            <a href="{{ route('freelancer.gigs.index') }}"
                                class="card-link stretched-link text-warning">Kelola Jasa</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-7 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Grafik Pendapatan (7 Hari Terakhir)</h5>
                        </div>
                        <div class="card-body">
                            {{-- Kita akan menggunakan Chart.js untuk grafik ini --}}
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Aktivitas Terbaru</h5>
                            <a href="{{ route('freelancer.orders.index') }}" class="btn btn-sm btn-outline-warning">Lihat
                                Semua</a>
                        </div>
                        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                            @forelse ($recentOrders as $order)
                                <div class="media mb-3">
                                    <img src="{{ $order->client->profile_picture_path ? Storage::url($order->client->profile_picture_path) : 'https://ui-avatars.com/api/?name=' . urlencode($order->client->name) }}"
                                        class="rounded-circle mr-3" alt="{{ $order->client->name }}"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">Pesanan Baru dari <strong>{{ $order->client->name }}</strong>
                                        </h6>
                                        <p class="mb-0 text-muted">{{ $order->gig->title }}</p>
                                        <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                    </div>
                                    <a href="{{ route('order.show', $order->id) }}"
                                        class="btn btn-sm btn-light align-self-center">Detail</a>
                                </div>
                                @if (!$loop->last)
                                    <hr>
                                @endif
                            @empty
                                <p class="text-center text-muted">Belum ada aktivitas terbaru.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts-footer')
    {{-- Tambahkan library Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartData['labels']) !!}, // Ambil data dari controller
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: {!! json_encode($chartData['data']) !!}, // Ambil data dari controller
                            fill: true,
                            borderColor: 'rgb(255, 210, 0)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
