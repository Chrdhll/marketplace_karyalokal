@extends('layouts.freelancer')

@section('title', 'Pesanan Masuk')

@section('content')

    <section class="section_gap mt-5">
        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Pesanan Masuk</h1>
                {{-- Tambahkan filter di sini nanti jika perlu --}}
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @endif

            {{-- ============================================= --}}
            {{--          DAFTAR PESANAN GAYA BARU (KARTU)         --}}
            {{-- ============================================= --}}
            @forelse ($orders as $order)
                <div class="card shadow-sm mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <span class="font-weight-bold">Pesanan {{ $order->order_number }}</span>
                            <small class="text-muted ml-2">{{ $order->created_at->format('d M Y') }}</small>
                        </div>
                        <div>
                            @if ($order->status == 'pending')
                                <span class="badge badge-secondary">Menunggu Pembayaran</span>
                            @elseif($order->status == 'paid')
                                <span class="badge badge-primary">Dibayar</span>
                            @elseif($order->status == 'in_progress')
                                <span class="badge badge-info">Dikerjakan</span>
                            @elseif($order->status == 'completed')
                                <span class="badge badge-success">Selesai</span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge badge-danger">Dibatalkan</span>
                            @else
                                <span class="badge badge-dark">{{ ucfirst($order->status) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="card-title">{{ $order->gig->title }}</h5>
                                <p class="card-text mb-1">Klien: <strong>{{ $order->client->name }}</strong></p>
                                <p class="card-text">Harga: <strong class="text-success">Rp
                                        {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
                            </div>
                            <div class="col-md-4 text-md-right">
                                {{-- KOLOM AKSI YANG LEBIH RAPI --}}
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-outline-warning mb-2 w-100">
                                    <i class="fa fa-comments"></i> Lihat Detail
                                </a>
                                @if ($order->status == 'paid')
                                    <form action="{{ route('freelancer.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="in_progress">
                                        <button type="submit" class="btn btn-info w-100">Mulai Kerjakan</button>
                                    </form>
                                @elseif($order->status == 'in_progress')
                                    <button type="button" class="btn btn-success w-100" data-toggle="modal"
                                        data-target="#deliveryModal-{{ $order->uuid }}">
                                        Kirim Hasil Kerja
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <p class="lead">Anda belum memiliki pesanan yang masuk.</p>
                    </div>
                </div>
            @endforelse

            {{-- Paginasi --}}
            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </section>

    @foreach ($orders as $order)
        @if ($order->status == 'in_progress')
            <div class="modal fade" id="deliveryModal-{{ $order->uuid }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Kirim Hasil Pekerjaan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('freelancer.orders.deliver', $order->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <p>Upload file hasil pekerjaan untuk pesanan <strong>{{ $order->order_number }} -
                                        {{ $order->gig->title }}</strong>.</p>
                                <div class="form-group">
                                    <label for="delivered_file">File Hasil Kerja (ZIP, PDF, JPG, dll. Max 20MB)</label>
                                    <div class="custom-file">
                                        <input type="file" name="delivered_file" class="custom-file-input"
                                            id="delivered_file" required>
                                        <label class="custom-file-label" for="delivered_file">Pilih file...</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="delivery_notes">Catatan Pengiriman (Opsional)</label>
                                    <textarea name="delivery_notes" class="form-control" rows="3"
                                        placeholder="Contoh: Halo, ini hasil desain logonya dalam format PNG dan AI. Terima kasih!"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim & Selesaikan Pesanan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
