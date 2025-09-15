@extends('layouts.template')
@section('title', 'Wishlist Saya')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <h1 class="mb-4">Wishlist Saya</h1>
            <div class="row">
                @forelse ($wishlistedGigs as $gig)
                    <div class="col-lg-4 col-md-6 mb-4">
                        {{-- Ini adalah kode kartu Gig yang sama seperti di halaman jelajah --}}
                        <div class="single-product">
                            <a href="{{ route('public.gigs.show', $gig->id) }}">
                                <img class="img-fluid"
                                    src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/300x200' }}"
                                    alt="{{ $gig->title }}" style="height: 180px; object-fit: cover;">
                            </a>
                            <div class="product-details">
                                <h6><a
                                        href="{{ route('public.gigs.show', $gig->id) }}">{{ \Illuminate\Support\Str::limit($gig->title, 45) }}</a>
                                </h6>
                                <div class="price">
                                    <h6 class="l-through">Rp {{ number_format($gig->price, 0, ',', '.') }}</h6>
                                </div>
                                <div class="prd-bottom">
                                    {{-- Form untuk hapus dari wishlist di halaman ini --}}
                                    <form id="wishlist-form-{{ $gig->id }}"
                                        action="{{ route('wishlist.toggle', $gig->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" class="social-info"
                                        onclick="event.preventDefault(); document.getElementById('wishlist-form-{{ $gig->id }}').submit();">
                                        <span class="fa fa-heart" style="color: red;"></span>
                                        <p class="hover-text">Hapus</p>
                                    </a>
                                    <a href="{{ route('public.gigs.show', $gig->id) }}" class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">Lihat Jasa</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Wishlist Anda masih kosong.</div>
                    </div>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $wishlistedGigs->links() }}
            </div>
        </div>
    </section>
@endsection
