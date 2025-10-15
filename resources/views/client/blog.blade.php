@extends('layouts.template')

@section('title', 'Profil ' . $user->name)

@section('content')
    <section class="section_gap mt-5">
        <div class="container py-8 mt-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm sticky-top" style="top: 20px;">
                        <div class="card-body text-center">
                            <img src="{{ $user->profile_picture_path ? Storage::url($user->profile_picture_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&color=fff' }}"
                                alt="{{ $user->name }}" class="rounded-circle mb-3"
                                style="width: 120px; height: 120px; object-fit: cover;">
                            <h4 class="font-weight-bold">{{ $user->name }}</h4>
                            <p class="text-muted">{{ $user->headline }}</p>
                            <div class="d-flex justify-content-center align-items-center mb-2">
                                <span style="color: #fbc02d; font-size: 18px;">★</span>
                                <span style="font-size: 16px; color: #333; margin-left: 5px; font-weight: bold;">
                                    {{ $user->rating_average ? number_format($user->rating_average, 1) : 'Baru' }}
                                </span>
                                <span class="text-muted ml-2">({{ $user->review_count ?? 0 }} ulasan)</span>
                            </div>
                            <p class="text-muted"><i class="fa fa-map-marker"></i> {{ $user->location }}</p>
                            <a href="#" class="btn btn-primary btn-block">Hubungi Saya</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Tentang Saya</h5>
                            <p>{{ $user->bio ?? 'Freelancer ini belum menambahkan bio.' }}</p>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Keahlian</h5>
                            <p>{{ $user->keahlian ?? 'Freelancer ini belum menambahkan keahlian.' }}</p>
                        </div>
                    </div>

                    <h4 class="font-weight-bold mb-3">Jasa yang Ditawarkan</h4>
                    <div class="row">
                        @forelse ($gigs as $gig)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <a href="{{ route('public.gigs.show', $gig->slug) }}">
                                    <img src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/300x200' }}"
                                        class="card-img-top" alt="{{ $gig->title }}"
                                        style="height: 180px; object-fit: cover;">
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text text-muted">{{ $gig->service }}</p>
                                        <h5 class="card-title" style="min-height: 50px;">
                                            <a href="{{ route('public.gigs.show', $gig->slug) }}">{{ $gig->title }}</a>
                                        </h5>
                                        <p class="card-text font-weight-bold">
                                            Rp {{ number_format($gig->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    Freelancer ini belum memiliki jasa yang ditawarkan.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{-- Link Paginasi untuk Gigs --}}
                    <div class="mt-4">
                        {{ $gigs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
