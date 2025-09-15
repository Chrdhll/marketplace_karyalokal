@extends('layouts.template')

@section('title', 'Profil ' . $user->name)

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Profil Freelancer</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('index') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Profil {{ $user->name }}</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="blog_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        <h2 class="mb-4">Jasa yang Ditawarkan</h2>
                        
                        {{-- ====================================================== --}}
                        {{--         MULAI PERULANGAN UNTUK DAFTAR GIGS             --}}
                        {{-- ====================================================== --}}
                        @forelse ($gigs as $gig)
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">{{ $gig->service }}</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">{{ $gig->user->name }}<i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#">{{ $gig->created_at->format('d M, Y') }}<i class="lnr lnr-calendar-full"></i></a></li>
                                        <li><a href="#">{{ $gig->review_count }} Ulasan<i class="lnr lnr-bubble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <a href="{{ route('public.gigs.show', $gig->id) }}">
                                        <img src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/600x350' }}" alt="{{ $gig->title }}">
                                    </a>
                                    <div class="blog_details">
                                        <a href="{{ route('public.gigs.show', $gig->id) }}">
                                            <h2>{{ $gig->title }}</h2>
                                        </a>
                                        <p>{{ \Illuminate\Support\Str::limit($gig->description, 200) }}</p>
                                        <a href="{{ route('public.gigs.show', $gig->id) }}" class="white_bg_btn">Lihat Detail Jasa</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @empty
                        <div class="alert alert-info">
                            <h3>Belum Ada Jasa</h3>
                            <p>Freelancer ini belum menambahkan jasa yang ditawarkan.</p>
                        </div>
                        @endforelse
                        {{-- AKHIR PERULANGAN --}}

                        {{-- Tampilkan Paginasi --}}
                        <nav class="blog-pagination justify-content-center d-flex">
                            {{ $gigs->links() }}
                        </nav>
                    </div>
                </div>

                {{-- ====================================================== --}}
                {{--         BAGIAN SIDEBAR YANG SUDAH DINAMIS              --}}
                {{-- ====================================================== --}}
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {{-- WIDGET PROFIL AUTHOR/FREELANCER --}}
                        <aside class="single_sidebar_widget author_widget">
                            <img class="author_img rounded-circle" 
                                 src="{{ $user->profile_picture_path ? Storage::url($user->profile_picture_path) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                                 alt="{{ $user->name }}" style="width: 120px; height: 120px; object-fit: cover;">
                            <h4>{{ $user->name }}</h4>
                            <p class="text-primary">@ {{ $user->username }}</p>
                            <p>{{ $user->headline }}</p>
                            <p>{{ Str::limit($user->bio, 150) }}</p>
                            <div class="br"></div>
                        </aside>

                        {{-- WIDGET JASA POPULER MILIK FREELANCER INI --}}
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Jasa Terpopuler</h3>
                            @forelse ($popularGigs as $popGig)
                            <div class="media post_item">
                                <img src="{{ $popGig->cover_image_path ? Storage::url($popGig->cover_image_path) : 'https://via.placeholder.com/100x70' }}" alt="post" style="width: 80px; height: 60px; object-fit: cover;">
                                <div class="media-body">
                                    <a href="{{ route('public.gigs.show', $popGig->id) }}">
                                        <h3>{{ \Illuminate\Support\Str::limit($popGig->title, 25) }}</h3>
                                    </a>
                                    <p>Rp {{ number_format($popGig->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @empty
                            <p>Belum ada jasa populer.</p>
                            @endforelse
                            <div class="br"></div>
                        </aside>

                        {{-- WIDGET KATEGORI YANG DITAWARKAN FREELANCER INI --}}
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Kategori Jasa</h4>
                            <ul class="list cat-list">
                                @forelse ($categories as $category)
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>{{ $category->service }}</p>
                                        <p>{{ $category->total }}</p>
                                    </a>
                                </li>
                                @empty
                                <li>
                                    <p>Belum ada kategori.</p>
                                </li>
                                @endforelse
                            </ul>
                            <div class="br"></div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection