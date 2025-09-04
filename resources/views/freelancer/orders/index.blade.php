@extends('layouts.template')

@section('title', 'Pesanan Masuk')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-4">Pesanan Masuk</h1>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID Pesanan</th>
                                            <th scope="col">Jasa yang Dipesan</th>
                                            <th scope="col">Nama Klien</th>
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
                                                    <a href="{{ route('public.gigs.show', $order->gig->id) }}"
                                                        target="_blank">
                                                        {{ $order->gig->title }}
                                                    </a>
                                                </td>
                                                <td>{{ $order->client->name }}</td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td>Rp
                                                    {{ number_format($order->price ?? $order->total_price, 0, ',', '.') }}
                                                </td>
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
                                                    {{-- Jika status masih PENDING --}}
                                                    @if ($order->status == 'pending')
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-sm btn-primary dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Kelola
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                {{-- Tombol Terima Pesanan --}}
                                                                <form
                                                                    action="{{ route('freelancer.orders.updateStatus', $order->id) }}"
                                                                    method="POST" class="dropdown-item p-0">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status"
                                                                        value="in_progress">
                                                                    <button type="submit"
                                                                        class="btn btn-link text-success w-100 text-left">Terima</button>
                                                                </form>
                                                                {{-- Tombol Tolak Pesanan --}}
                                                                <form
                                                                    action="{{ route('freelancer.orders.updateStatus', $order->id) }}"
                                                                    method="POST" class="dropdown-item p-0">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status" value="cancelled">
                                                                    <button type="submit"
                                                                        class="btn btn-link text-danger w-100 text-left">Tolak</button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        {{-- Jika status sedang IN PROGRESS --}}
                                                    @elseif($order->status == 'in_progress')
                                                        <form
                                                            action="{{ route('freelancer.orders.updateStatus', $order->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="btn btn-sm btn-success">Selesaikan
                                                                Pesanan</button>
                                                        </form>

                                                        {{-- Jika status sudah COMPLETED atau CANCELLED --}}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Anda belum memiliki pesanan yang
                                                    masuk.
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
