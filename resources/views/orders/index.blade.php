@extends('layouts.template')

@section('title', 'Pesanan Saya')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-4">Riwayat Pesanan Saya</h1>

                    {{-- Notifikasi setelah membuat pesanan baru --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
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
                                                <th scope="row">#{{ $order->id }}</th>
                                                <td>
                                                    <a href="{{ route('public.gigs.show', $order->gig->id) }}">
                                                        {{ $order->gig->title }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('public.freelancer.show', $order->freelancer->id) }}">
                                                        {{ $order->freelancer->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
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
                                                    {{-- Cek jika status 'completed' DAN belum pernah direview --}}
                                                    @if ($order->status == 'completed' && !$order->review)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#reviewModal-{{ $order->id }}">
                                                            Beri Ulasan
                                                        </button>
                                                    @else
                                                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat
                                                            Detail</a>
                                                    @endif
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
@endsection

{{-- Taruh di luar @endsection, atau di dalamnya sebelum @endsection --}}
@foreach ($orders as $order)
    @if ($order->status == 'completed' && !$order->review)
        <div class="modal fade" id="reviewModal-{{ $order->id }}" tabindex="-1" role="dialog"
            aria-labelledby="reviewModalLabel-{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel-{{ $order->id }}">Beri Ulasan untuk:
                            {{ $order->gig->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('reviews.store', $order->id) }}" method="POST">
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
