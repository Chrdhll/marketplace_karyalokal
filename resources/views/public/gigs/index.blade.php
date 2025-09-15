@extends('layouts.template')

@section('title', $activeCategory ? 'Jasa Kategori: ' . $activeCategory->name : 'Jelajahi Semua Jasa')

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>{{ $activeCategory ? $activeCategory->name : 'Semua Jasa' }}</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('index') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('public.gigs.index') }}">Jasa</a>
                        @if ($activeCategory)
                            <span class="lnr lnr-arrow-right"></span><a href="#">{{ $activeCategory->name }}</a>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                {{-- ============================================= --}}
                {{--              SIDEBAR KATEGORI DINAMIS           --}}
                {{-- ============================================= --}}
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        {{-- Link untuk menampilkan semua kategori --}}
                        <li class="main-nav-list">
                            <a href="{{ route('public.gigs.index') }}" class="{{ !$activeCategory ? 'active' : '' }}">
                                Semua Kategori
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            @if ($category->gigs_count > 0)
                                {{-- Hanya tampilkan kategori yang ada isinya --}}
                                <li class="main-nav-list">
                                    <a href="{{ route('public.gigs.index', ['category' => $category->slug]) }}"
                                        class="{{ request('category') == $category->slug ? 'active' : '' }}">
                                        {{ $category->name }}<span class="number">({{ $category->gigs_count }})</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <form id="filterForm" action="{{ route('public.gigs.index') }}" method="GET" class="d-flex">
                        {{-- Simpan filter kategori yang sedang aktif --}}
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div class="sorting">
                            <select name="sort" onchange="document.getElementById('filterForm').submit();" class="filter-nice-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga
                                    Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga
                                    Tertinggi</option>
                            </select>
                        </div>
                    </form>
                    <div class="ml-auto">
                        {{-- Tampilkan pagination di sini --}}
                        {{ $gigs->appends(request()->query())->links() }}
                    </div>
                </div>
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @forelse ($gigs as $gig)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-product">
                                    <a href="{{ route('public.gigs.show', $gig->id) }}">
                                        <img class="img-fluid"
                                            src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/300x200' }}"
                                            alt="{{ $gig->title }}" style="height: 180px; object-fit: cover;">
                                    </a>
                                    <div class="product-details">
                                        <h6>{{ $gig->title }}</h6>
                                        <div class="price d-flex justify-content-between align-items-center">
                                            <h6 class="l-through mb-0 text-primary font-weight-bold">Rp
                                                {{ number_format($gig->price, 0, ',', '.') }}</h6>
                                            <div class="d-flex align-items-center">
                                                <span style="color: #fbc02d; font-size: 16px;">★</span>
                                                <span
                                                    style="font-size: 14px; color: #555; margin-left: 4px;">{{ $gig->rating_average ? number_format($gig->rating_average, 1) : 'Baru' }}</span>
                                            </div>
                                        </div>
                                        <div class="prd-bottom">

                                            {{-- IKON 1: LINK BIASA --}}
                                            <a href="{{ route('public.freelancer.show', $gig->user->username) }}"
                                                class="social-info">
                                                <span class="ti-user"></span>
                                                <p class="hover-text">
                                                    {{ \Illuminate\Support\Str::limit($gig->user->name, 10) }}</p>
                                            </a>

                                            {{-- ============================================= --}}
                                            {{--         IKON 2: WISHLIST (TEKNIK BARU)          --}}
                                            {{-- ============================================= --}}

                                            <form id="wishlist-form-{{ $gig->id }}"
                                                action="{{ route('wishlist.toggle', $gig->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>

                                            <a href="#" class="social-info"
                                                onclick="event.preventDefault(); document.getElementById('wishlist-form-{{ $gig->id }}').submit();">
                                                @if (auth()->check() && auth()->user()->wishlistedGigs->contains($gig))
                                                    {{-- Tampilan jika sudah di-wishlist --}}
                                                    <span class="fa fa-heart" style="color: red;"></span>
                                                    <p class="hover-text">Hapus</p>
                                                @else
                                                    {{-- Tampilan jika belum di-wishlist --}}
                                                    <span class="lnr lnr-heart"></span>
                                                    <p class="hover-text">Wishlist</p>
                                                @endif
                                            </a>

                                            {{-- ============================================= --}}

                                            {{-- IKON 3: LINK BIASA --}}
                                            <a href="{{ route('public.gigs.show', $gig->id) }}" class="social-info">
                                                <span class="lnr lnr-move"></span>
                                                <p class="hover-text">Lihat Jasa</p>
                                            </a>

                                        </div>
                                        {{-- <div class="prd-bottom">
                                            <a href="{{ route('public.freelancer.show', $gig->user->id) }}"
                                                class="social-info">
                                                <span class="ti-user"></span>
                                                <p class="hover-text">
                                                    {{ \Illuminate\Support\Str::limit($gig->user->name, 10) }}</p>
                                            </a>
                                            <form action="{{ route('wishlist.toggle', $gig->id) }}" method="POST"
                                                class="d-inline wishlist-toggle-form">
                                                @csrf
                                                <button type="submit" class="social-info"
                                                    style="border: none; background: none; cursor: pointer;">
                                                    @if (auth()->check() && auth()->user()->wishlistedGigs->contains($gig))
                                                        <span class="fa fa-heart" style="color: red;"></span>
                                                        <p class="hover-text">Hapus</p>
                                                    @else
                                                        <span class="lnr lnr-heart"></span>
                                                        <p class="hover-text">Wishlist</p>
                                                    @endif
                                                </button>
                                            </form>
                                            <a href="{{ route('public.gigs.show', $gig->id) }}" class="social-info">
                                                <span class="lnr lnr-move"></span>
                                                <p class="hover-text">Lihat Jasa</p>
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning">Tidak ada jasa yang ditemukan.</div>
                            </div>
                        @endforelse
                    </div>
                </section>
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <form id="filterForm" action="{{ route('public.gigs.index') }}" method="GET" class="d-flex">
                        {{-- Simpan filter kategori yang sedang aktif --}}
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div class="sorting">
                            <select name="sort" onchange="document.getElementById('filterForm').submit();" class="filter-nice-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga
                                    Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga
                                    Tertinggi</option>
                            </select>
                        </div>
                    </form>
                    <div class="ml-auto">
                        {{-- Tampilkan pagination di sini --}}
                        {{ $gigs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
