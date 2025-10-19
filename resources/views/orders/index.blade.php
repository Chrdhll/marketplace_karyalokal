@extends('layouts.template')

@section('title', 'Pesanan Saya')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-4">Riwayat Pesanan Saya</h1>

                    @if ($hasPendingOrders)
                        <div class="alert alert-info shadow-sm mb-4">
                            <h4 class="alert-heading">Instruksi Pembayaran</h4>
                            <p class="mb-3">
                                Silakan lakukan pembayaran sejumlah total tagihan Anda ke salah satu metode di bawah ini.
                                Setelah itu, unggah bukti pembayaran pada pesanan yang sesuai.
                            </p>

                            <hr>

                            <div class="row">
                                {{-- KOLOM UNTUK TRANSFER BANK --}}
                                <div class="col-md-6">
                                    <h5 class="font-weight-bold mt-2">1. Transfer Bank</h5>
                                    <p class="mb-0"><strong>Bank BRI:</strong> 1956270008</p>
                                    {{-- <p class="mb-0"><strong>Bank Mandiri:</strong> 0987654321</p> --}}
                                    <p class="mt-1 mb-0"><strong>Atas Nama:</strong> Muhammad Nawaf Akbar</p>
                                </div>

                                {{-- KOLOM UNTUK QRIS --}}
                                <div class="col-md-6">
                                    <h5 class="font-weight-bold mt-2">2. QRIS</h5>
                                    <p class="text-muted">
                                        Anda juga bisa membayar melalui QRIS.
                                    </p>
                                    <img src="/assets/img/qris-karyalokal.png" alt="QRIS KaryaLokal" style="width: 250px; height: auto;">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th scope="col">ID Pesanan</th>
                                            <th scope="col">Jasa yang Dipesan</th>
                                            <th scope="col">Freelancer</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <th scope="row">{{ $order->order_number }}</th>
                                                <td>
                                                    <a href="{{ route('public.gigs.show', $order->gig->slug) }}">
                                                        {{ $order->gig->title }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('public.freelancer.show', $order->freelancer->username) }}">
                                                        {{ $order->freelancer->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td>Rp {{ number_format($order->gig->price, 0, ',', '.') }}</td>
                                                <td>
                                                    {{-- Memberi warna status agar mudah dikenali --}}
                                                    @if ($order->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($order->status == 'in_progress')
                                                        <span class="badge badge-info">In Progress</span>
                                                    @elseif($order->status == 'completed')
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif($order->status == 'cancelled')
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @else
                                                        <span
                                                            class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex m-1">
                                                        @if ($order->status == 'pending')
                                                            @if ($order->proof_of_payment)
                                                                <span
                                                                    class="btn btn-sm btn-info text-white mr-1 px-3">Menunggu
                                                                    Verifikasi</span>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-sm btn-warning text-white mr-1 px-3"
                                                                    data-toggle="modal"
                                                                    data-target="#uploadModal-{{ $order->uuid }}">
                                                                    Upload Bukti
                                                                </button>
                                                            @endif
                                                            {{-- TOMBOL BATAL BARU --}}
                                                            <form action="{{ route('order.cancel', $order->uuid) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger px-3 mr-1">Batalkan</button>
                                                            </form>

                                                            <a href="{{ route('order.show', $order->uuid) }}"
                                                                class="btn btn-sm btn-outline-primary px-3 mr-1">Lihat
                                                                Detail</a>
                                                        @elseif ($order->status == 'completed')
                                                            {{-- Tombol Download akan selalu muncul jika file ada & pesanan selesai --}}
                                                            @if ($order->delivered_file_path)
                                                                <a href="{{ route('order.download', $order->uuid) }}"
                                                                    class="btn btn-sm btn-success d-block mr-1 px-3">
                                                                    <i class="fa fa-download"></i> Download Hasil
                                                                </a>
                                                            @endif

                                                            {{-- Tombol Ulasan hanya muncul jika pesanan selesai DAN belum ada review --}}
                                                            {{-- Tombol Ulasan (diubah menjadi <a>) --}}
                                                            @if (!$order->review)
                                                                <a href="#"
                                                                    class="btn btn-sm btn-primary d-block text-white px-3 mr-1"
                                                                    data-toggle="modal"
                                                                    data-target="#reviewModal-{{ $order->uuid }}">
                                                                    <i class="fa fa-star"></i> Beri Ulasan
                                                                </a>
                                                            @endif

                                                            <a href="{{ route('order.show', $order->uuid) }}"
                                                                class="btn btn-sm btn-outline-primary px-3 mr-1">Lihat
                                                                Detail</a>
                                                        @else
                                                            {{-- Untuk status lain (pending, in_progress, dll), tampilkan tombol Detail --}}
                                                            <a href="{{ route('order.show', $order->uuid) }}"
                                                                class="btn btn-sm btn-outline-primary px-3 mr-1">Lihat
                                                                Detail</a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Anda belum pernah membuat pesanan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if ($orders->hasPages())
                            <div class="card-footer">
                                {{ $orders->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($orders as $order)
        @if ($order->status == 'completed' && !$order->review)
            <div class="modal fade" id="reviewModal-{{ $order->uuid }}" tabindex="-1" role="dialog"
                aria-labelledby="reviewModalLabel-{{ $order->uuid }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reviewModalLabel-{{ $order->uuid }}">Beri Ulasan untuk:
                                {{ $order->gig->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('reviews.store', $order->uuid) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Rating Anda</label>
                                    <select name="rating" class="form-control" required>
                                        <option value="">-- Pilih Bintang --</option>
                                        <option value="5">★★★★★ (Luar Biasa)</option>
                                        <option value="4">★★★★☆ (Bagus)</option>
                                        <option value="3">★★★☆☆ (Cukup)</option>
                                        <option value="2">★★☆☆☆ (Kurang)</option>
                                        <option value="1">★☆☆☆☆ (Buruk)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Ulasan Anda</label>
                                    <textarea name="comment" class="form-control" rows="4" placeholder="Ceritakan pengalaman Anda..." required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @foreach ($orders as $order)
        @if ($order->status == 'pending' && !$order->proof_of_payment)
            <div class="modal fade" id="uploadModal-{{ $order->uuid }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('order.upload-proof', $order->uuid) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <p>Pesanan: {{ $order->order_number }}</p>
                                <p>Total: <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
                                <div class="form-group">
                                    <label for="proof_of_payment">Upload Screenshot Bukti (Max 2MB)</label>
                                    <div class="custom-file">
                                        <input type="file" name="proof_of_payment" class="custom-file-input"
                                            id="proof-{{ $order->uuid }}" required accept="image/*">
                                        <label class="custom-file-label" for="proof-{{ $order->uuid }}">Pilih
                                            file...</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim Bukti</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection
