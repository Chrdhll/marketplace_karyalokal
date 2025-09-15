@extends('layouts.freelancer')

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
                                    <thead class="text-center">
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
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- Jika status DIBAYAR, tampilkan tombol "Mulai Kerjakan" --}}
                                                        @if ($order->status == 'paid')
                                                            <form
                                                                action="{{ route('freelancer.orders.updateStatus', $order->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="in_progress">
                                                                <button type="submit" class="btn btn-sm btn-info">Mulai
                                                                    Kerjakan</button>
                                                            </form>

                                                            {{-- Jika status DIKERJAKAN, tampilkan tombol "Selesaikan" --}}
                                                        @elseif($order->status == 'in_progress')
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                data-toggle="modal"
                                                                data-target="#deliveryModal-{{ $order->id }}">
                                                                Kirim Hasil Kerja
                                                            </button>

                                                            {{-- Jika status PENDING (menunggu pembayaran) atau sudah final --}}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                        <a href="{{ route('order.show', $order->id) }}"
                                                            class="btn btn-sm btn-outline-primary ml-2">Lihat Detail</a>
                                                    </div>
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

    @foreach ($orders as $order)
        @if ($order->status == 'in_progress')
            <div class="modal fade" id="deliveryModal-{{ $order->id }}" tabindex="-1" role="dialog">
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
                                <p>Upload file hasil pekerjaan untuk pesanan <strong>#{{ $order->id }} -
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
