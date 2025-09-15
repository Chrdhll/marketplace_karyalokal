@extends('layouts.freelancer')

@section('title', 'Dashboard Freelancer')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <h1 class="mb-2">Dashboard</h1>
            <p class="lead mb-4">Selamat datang kembali, {{ auth()->user()->name }}!</p>

            <div class="row">
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
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pesanan Masuk Terbaru</h5>
                    <a href="{{ route('freelancer.orders.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Klien</th>
                                    <th>Jasa</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentOrders as $order)
                                    <tr>
                                        <th>#{{ $order->id }}</th>
                                        <td>{{ $order->client->name }}</td>
                                        <td>{{ $order->gig->title }}</td>
                                        <td>
                                            @if ($order->status == 'paid')
                                                <span class="badge badge-primary">Dibayar</span>
                                            @elseif($order->status == 'in_progress')
                                                <span class="badge badge-info">Dikerjakan</span>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('order.show', $order->id) }}"
                                                class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pesanan yang masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
