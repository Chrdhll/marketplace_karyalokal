@extends('layouts.template')

@section('content')
    <!-- header section -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6 mt-5">
                            <div class="banner-content mt-5" style="color: white;">
                                <h1 class="mt-4" style="color: white;">Welcome To<br>KaryaLokal</h1>
                                <p>Butuh logo baru, website profesional, atau konten berkualitas? Jelajahi ribuan jasa dari
                                    freelancer berbakat di seluruh Indonesia. Temukan partner yang tepat dan mulai proyek
                                    Anda hari ini.</p>
                                <form action="{{ route('public.gigs.index') }}" method="GET" class="mt-4">
                                    <div class="input-group" style="width: 100%;">
                                        <input type="text" name="q" class="form-control" placeholder="Cari jasa..."
                                            style="border-radius: 0; min-height: 50px; font-size: 16px;">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit"
                                                style="background-color: #ffba00; color: white; border-radius: 0; min-height: 50px; padding: 0 30px; font-size: 16px;">
                                                Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- header section -->

    <!-- Start Made On -->
    <section class="category-area mt-5">
        <div class="container">
            <h2 class="mb-4">Made On KaryaLokal</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="/assets/img/category/c1.jpg" alt="">
                                <a href="/assets/img/category/c1.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Programing</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="/assets/img/category/c2.jpg" alt="">
                                <a href="/assets/img/category/c2.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">CopyWriting</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="/assets/img/category/c3.jpg" alt="">
                                <a href="/assets/img/category/c3.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Video Editing</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="/assets/img/category/c4.jpg" alt="">
                                <a href="/assets/img/category/c4.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Grapich Design</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-deal">
                        <div class="overlay"></div>
                        <img class="img-fluid w-100" src="/assets/img/category/c5.jpg" alt="">
                        <a href="/assets/img/category/c5.jpg" class="img-pop-up" target="_blank">
                            <div class="deal-details">
                                <h6 class="deal-title">UI/UX Design</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Made On -->

    <section class="lattest-product-area pb-40 category-list">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 mb-0">
                    <div class="section-title">
                        <h1>Produk Unggulan</h1>
                        <p>Temukan produk dan jasa terbaik di KaryaLokal.</p>
                    </div>
                </div>
                <div class="row px-2 px-sm-3 px-md-4 px-lg-0">
                    @forelse ($gigs as $gig)
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="single-product">
                                <a href="{{ route('public.gigs.show', $gig->slug) }}">
                                    <img class="img-fluid"
                                        src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/300x200' }}"
                                        alt="{{ $gig->title }}" style="height: 180px; object-fit: cover;">
                                </a>
                                <div class="product-details">
                                    <h6 class="mb-1">{{ $gig->title }}</h6>
                                    <div class="price d-flex justify-content-between align-items-center">
                                        <h6 class="l-through mb-0 text-primary font-weight-bold">Rp
                                            {{ number_format($gig->price, 0, ',', '.') }}</h6>
                                        <div class="d-flex align-items-center">
                                            <span style="color: #fbc02d; font-size: 16px;">★</span>
                                            <span
                                                style="font-size: 14px; color: #555; margin-left: 4px;">{{ $gig->rating_average ? number_format($gig->rating_average, 1) : 'Baru' }}</span>
                                        </div>
                                    </div>
                                    <div class="prd-bottom mt-2">

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

                                        <form id="wishlist-form-{{ $gig->slug }}"
                                            action="{{ route('wishlist.toggle', $gig->slug) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>

                                        <a href="#" class="social-info"
                                            onclick="event.preventDefault(); document.getElementById('wishlist-form-{{ $gig->slug }}').submit();">
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
                                        <a href="{{ route('public.gigs.show', $gig->slug) }}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">Lihat Jasa</p>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning">Tidak ada jasa yang ditemukan.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </section>

    {{-- Cek dulu apakah ada data freelancer --}}
    @if (isset($freelancers) && count($freelancers) > 0)
        {{-- Tentukan jumlah minimal item agar carousel aktif. 
    Biasanya, jika satu baris muat 4 item, maka carousel baru berguna jika item lebih dari 4. 
    Kamu bisa sesuaikan angka ini. --}}
        @php
            $minItemsForCarousel = 4;
        @endphp

        <section
            class="{{ count($freelancers) > $minItemsForCarousel ? 'owl-carousel active-product-area' : '' }} section_gap">

            <div class="{{ count($freelancers) > $minItemsForCarousel ? 'single-product-slider' : '' }}">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <div class="section-title">
                                <h1>Temukan Freelancer Terbaik</h1>
                                <p>Jelajahi dan temukan talenta lokal terbaik yang siap membantu mewujudkan proyek Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row px-2 px-sm-3 px-md-4 px-lg-0">
                        {{-- Perulangan datanya tetap sama --}}
                        @foreach ($freelancers as $freelancer)
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="single-product">
                                    <a href="{{ route('public.freelancer.show', $freelancer->username) }}">
                                        <img class="img-fluid"
                                            src="{{ $freelancer->profile_picture_path
                                                ? Storage::url($freelancer->profile_picture_path)
                                                : 'https://ui-avatars.com/api/?name=' . urlencode($freelancer->name) . '&background=random' }}"
                                            alt="{{ $freelancer->name }}"
                                            style="height: 260px; width: 100%; object-fit: cover; border-radius: 6px;">
                                    </a>
                                    <div class="product-details">
                                        <h6 class="mb-1">{{ $freelancer->name }}</h6>
                                        <div class="price d-flex justify-content-between align-items-center">
                                            <h6 class="l-through mb-0">
                                                {{ $freelancer->freelancerProfile?->headline ?? 'Freelancer' }}
                                            </h6>
                                            <div class="d-flex align-items-center">
                                                <span style="color: #fbc02d; font-size: 16px;">★</span>
                                                <span style="font-size: 14px; color: #555; margin-left: 4px;">
                                                    {{ $freelancer->rating_average ? number_format($freelancer->rating_average, 1) : 'Baru' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="prd-bottom mt-2">
                                            <a href="{{ route('public.freelancer.show', $freelancer->username) }}"
                                                class="social-info">
                                                <span class="ti-plus"></span>
                                                <p class="hover-text">Lihat Profil</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </section>
    @endif

    <!-- Start ulasan -->
    <section class="exclusive-deal-area" id="about">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 no-padding exclusive-left">
                    <div class="row clock_sec clockdiv" id="clockdiv">
                        <div class="col-lg-12">
                            <div style="text-align: left;">
                                <h1 class="mb-3" style="text-align: left;">KaryaLokal</h1>
                                <p style="text-align: justify;">
                                    KaryaLokal adalah platform freelance yang menghubungkan para pekerja lepas berbakat di
                                    seluruh Indonesia dengan individu maupun bisnis yang membutuhkan jasa mereka. Dengan
                                    misi mendukung potensi dan kreativitas anak bangsa, KaryaLokal menjadi tempat bagi
                                    freelancer lokal untuk memamerkan karya, mendapatkan proyek, dan berkembang bersama
                                    klien dalam negeri.
                                    Kami hadir untuk mempermudah proses pencarian dan penawaran jasa secara aman,
                                    transparan, dan efisien. Baik Anda seorang freelancer yang ingin memperluas peluang
                                    kerja, atau klien yang mencari talenta lokal berkualitas, KaryaLokal adalah jembatan
                                    untuk mewujudkan kerja sama yang saling menguntungkan.
                                </p>
                                <a href="" class="primary-btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 no-padding exclusive-right">
                    <div id="reviewCarousel" class="carousel slide" data-ride="carousel"> {{-- Bootstrap 4 pakai data-ride --}}
                        <div class="carousel-inner">

                            {{-- MULAI PERULANGAN DI SINI --}}
                            @forelse ($reviews as $review)
                                {{-- Tambahkan class 'active' hanya untuk item pertama --}}
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="d-flex flex-column align-items-center text-center p-4">
                                        {{-- Foto Profil Klien --}}
                                        <img src="{{ $review->client->profile_picture_path ? Storage::url($review->client->profile_picture_path) : 'https://ui-avatars.com/api/?name=' . urlencode($review->client->name) }}"
                                            alt="Foto User"
                                            style="width:80px;height:80px;border-radius:50%;object-fit:cover;margin-bottom:15px;">

                                        <div class="product-details px-md-5">
                                            <div class="price">
                                                {{-- Rating yang diberikan --}}
                                                <h6><i class="fa fa-star text-warning"></i>
                                                    {{ number_format($review->rating, 1) }} / 5.0</h6>
                                                {{-- Kategori dari Gig yang diulas --}}
                                                <h6 class="text-muted">Kategori:
                                                    {{ $review->gig->category->name ?? 'N/A' }}</h6>
                                            </div>
                                            {{-- Komentar ulasan --}}
                                            <h4>“{{ \Illuminate\Support\Str::limit($review->comment, 100) }}”</h4>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                {{-- Tampilan jika tidak ada ulasan sama sekali --}}
                                <div class="carousel-item active">
                                    <div class="d-flex flex-column align-items-center text-center p-4">
                                        <h4 style="color: #333">Belum Ada Ulasan</h4>
                                        <p style="color: #333">Jadilah yang pertama memberikan ulasan di KaryaLokal!</p>
                                    </div>
                                </div>
                            @endforelse
                            {{-- AKHIR PERULANGAN --}}

                        </div>

                        <button class="carousel-control-prev" type="button" data-target="#reviewCarousel"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#reviewCarousel"
                            data-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- End ulasan -->


@endsection
