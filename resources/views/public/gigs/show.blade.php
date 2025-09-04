@extends('layouts.template')

@section('title', $gig->title)

@section('content')
    <div class="product_image_area mt-5">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    {{-- <div class="s_Product_carousel"> --}}
                    <div class="single-prd-item">
                        <img class="img-fluid"
                            src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/600x600' }}"
                            alt="{{ $gig->title }}">
                    </div>
                    {{-- Kamu bisa tambahkan carousel untuk gambar-gambar lain jika ada --}}
                    {{-- </div> --}}
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $gig->title }}</h3>
                        <h2>Rp {{ number_format($gig->price, 0, ',', '.') }}</h2>
                        <ul class="list">
                            <li><a href="#"><span>Kategori</span> : {{ $gig->service }}</a></li>
                            <li><a href="#"><span>Estimasi</span> : {{ $gig->estimated_time }}</a></li>
                        </ul>
                        <p>{{ \Illuminate\Support\Str::limit($gig->description, 200) }}</p>
                        <div class="card_area d-flex align-items-center">
                            {{-- Cek apakah ada user yang login --}}
                            @auth
                                {{-- Tampilkan tombol hanya jika user adalah 'client' DAN bukan pemilik jasa ini --}}
                                @if (auth()->user()->role == 'client' && auth()->id() !== $gig->user_id)
                                    <form action="{{ route('order.store', $gig->id) }}" method="POST">
                                        @csrf
                                        {{-- Kamu bisa tambahkan textarea di sini jika ingin klien memberi catatan --}}
                                        {{-- <textarea name="notes" class="form-control mb-3" placeholder="Tulis catatan untuk freelancer..."></textarea> --}}
                                        <button type="submit" class="btn btn-primary btn-block btn-lg">Pesan Jasa Ini</button>
                                    </form>
                                @endif
                            @else
                                {{-- Jika user belum login, tampilkan tombol untuk login --}}
                                <a href="{{ route('login') }}" class="btn btn-primary btn-block btn-lg">Login untuk Memesan</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Deskripsi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                        aria-controls="review" aria-selected="false">Ulasan ({{ $gig->reviews->count() }})</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>{!! nl2br(e($gig->description)) !!}</p>
                </div>

                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="review_list">
                                @forelse ($reviews as $review)
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ $review->client->profile_picture_path ? Storage::url($review->client->profile_picture_path) : 'https://ui-avatars.com/api/?name=' . urlencode($review->client->name) }}"
                                                    alt="{{ $review->client->name }}"
                                                    style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $review->client->name }}</h4>
                                                <div class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star"
                                                            style="color: {{ $i <= $review->rating ? '#fbc02d' : '#e0e0e0' }};"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                @empty
                                    <p>Belum ada ulasan untuk jasa ini.</p>
                                @endforelse
                            </div>
                            <div class="mt-4">
                                {{ $reviews->links() }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Tambahkan Ulasan</h4>
                                <p>Anda harus memesan dan menyelesaikan jasa ini untuk dapat memberikan ulasan.</p>
                                {{-- Nanti di sini kita bisa tambahkan form ulasan jika user berhak --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
