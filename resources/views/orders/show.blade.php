@extends(auth()->id() == $order->freelancer_id ? 'layouts.freelancer' : 'layouts.template')

@section('title', 'Detail Pesanan ' . $order->order_number)

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <h1 class="mb-4">Detail Pesanan <span class="text-primary">{{ $order->order_number }}</span></h1>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5>Jasa yang Dipesan</h5>
                        </div>
                        <div class="card-body">
                            <div class="media">
                                <img src="{{ $order->gig->cover_image_path ? Storage::url($order->gig->cover_image_path) : 'https://via.placeholder.com/150x100' }}"
                                    class="mr-3" alt="{{ $order->gig->title }}"
                                    style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
                                <div class="media-body">
                                    <h5 class="mt-0"><a
                                            href="{{ route('public.gigs.show', $order->gig->id) }}">{{ $order->gig->title }}</a>
                                    </h5>
                                    <p class="mb-1">Oleh: <a
                                            href="{{ route('public.freelancer.show', $order->freelancer->username) }}">{{ $order->freelancer->name }}</a>
                                    </p>
                                    <p class="font-weight-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($order->status == 'completed' && $order->delivered_file_path)
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h5>Hasil Pekerjaan</h5>
                            </div>
                            <div class="card-body">
                                <h6>Catatan dari Freelancer:</h6>
                                <p>{{ $order->delivery_notes ?? 'Tidak ada catatan.' }}</p>
                                <a href="{{ route('order.download', $order->uuid) }}" class="btn btn-success"><i
                                        class="fa fa-download"></i> Download Hasil</a>
                            </div>
                        </div>
                    @endif

                    @if ($order->review)
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h5>Ulasan Anda</h5>
                            </div>
                            <div class="card-body">
                                <div class="rating mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star"
                                            style="color: {{ $i <= $order->review->rating ? '#fbc02d' : '#e0e0e0' }};"></i>
                                    @endfor
                                </div>
                                <p>{{ $order->review->comment }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="d-none d-lg-block">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h5>Ruang Diskusi</h5>
                            </div>
                            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                {{-- Histori Chat --}}
                                @forelse ($order->messages as $message)
                                    {{-- Cek apakah pengirim adalah user yang sedang login --}}
                                    @if ($message->user_id == auth()->id())
                                        {{-- Pesan Milik Sendiri (rata kanan) --}}
                                        <div class="d-flex justify-content-end mb-3">
                                            <div class="p-3"
                                                style="background-color: #e1f5fe; border-radius: 15px 15px 0 15px; max-width: 80%;">
                                                <strong>Anda:</strong>
                                                <p class="mb-0">{{ $message->message }}</p>
                                                <small
                                                    class="text-muted">{{ $message->created_at->format('d M, H:i') }}</small>
                                            </div>
                                        </div>
                                    @else
                                        {{-- Pesan Milik Orang Lain (rata kiri) --}}
                                        <div class="d-flex justify-content-start mb-3">
                                            <div class="p-3"
                                                style="background-color: #f1f1f1; border-radius: 15px 15px 15px 0; max-width: 80%;">
                                                <strong>{{ $message->user->name }}:</strong>
                                                <p class="mb-0">{{ $message->message }}</p>
                                                <small
                                                    class="text-muted">{{ $message->created_at->format('d M, H:i') }}</small>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <p class="text-center text-muted">Belum ada pesan dalam diskusi ini.</p>
                                @endforelse
                            </div>

                            {{-- Form Kirim Pesan --}}
                            <div class="card-footer">
                                <form action="{{ route('order.messages.store', $order->uuid) }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <textarea name="message" class="form-control" placeholder="Ketik pesan Anda..." rows="2" style="height: 40px;"  required></textarea>
                                        <div class="input-group-append"> 
                                            <button class="btn btn-primary" type="submit">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5>Ringkasan</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>ID Pesanan:</strong> {{ $order->order_number }}</p>
                            <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                            </p>
                            <hr>
                            <p><strong>Klien:</strong> {{ $order->client->name }}</p>
                            <p><strong>Freelancer:</strong> {{ $order->freelancer->name }}</p>
                        </div>
                    </div>
                    
                    <div class="d-block d-lg-none">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h5>Ruang Diskusi</h5>
                            </div>
                            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                {{-- Histori Chat --}}
                                @forelse ($order->messages as $message)
                                    {{-- Cek apakah pengirim adalah user yang sedang login --}}
                                    @if ($message->user_id == auth()->id())
                                        {{-- Pesan Milik Sendiri (rata kanan) --}}
                                        <div class="d-flex justify-content-end mb-3">
                                            <div class="p-3"
                                                style="background-color: #e1f5fe; border-radius: 15px 15px 0 15px; max-width: 80%;">
                                                <strong>Anda:</strong>
                                                <p class="mb-0">{{ $message->message }}</p>
                                                <small
                                                    class="text-muted">{{ $message->created_at->format('d M, H:i') }}</small>
                                            </div>
                                        </div>
                                    @else
                                        {{-- Pesan Milik Orang Lain (rata kiri) --}}
                                        <div class="d-flex justify-content-start mb-3">
                                            <div class="p-3"
                                                style="background-color: #f1f1f1; border-radius: 15px 15px 15px 0; max-width: 80%;">
                                                <strong>{{ $message->user->name }}:</strong>
                                                <p class="mb-0">{{ $message->message }}</p>
                                                <small
                                                    class="text-muted">{{ $message->created_at->format('d M, H:i') }}</small>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <p class="text-center text-muted">Belum ada pesan dalam diskusi ini.</p>
                                @endforelse
                            </div>

                            {{-- Form Kirim Pesan --}}
                            <div class="card-footer">
                                <form action="{{ route('order.messages.store', $order->uuid) }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <textarea name="message" class="form-control" placeholder="Ketik pesan Anda..." rows="2" style="height: 40px;"  required></textarea>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </section>
@endsection
