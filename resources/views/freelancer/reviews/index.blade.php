@extends('layouts.freelancer')
@section('title', 'Ulasan Diterima')
@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <h1 class="mb-4">Ulasan Diterima</h1>
            @forelse ($reviews as $review)
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="media">
                            <img src="{{ $review->client->profile_picture_path ? Storage::url($review->client->profile_picture_path) : 'https://ui-avatars.com/api/?name=' . urlencode($review->client->name) }}"
                                class="rounded-circle mr-3" alt="{{ $review->client->name }}"
                                style="width: 60px; height: 60px; object-fit: cover;">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $review->client->name }}</h5>
                                <div class="rating mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star"
                                            style="color: {{ $i <= $review->rating ? '#fbc02d' : '#e0e0e0' }};"></i>
                                    @endfor
                                    <span class="ml-2 text-muted">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <p>{{ $review->comment }}</p>
                                <small class="text-muted">Untuk jasa: <a
                                        href="{{ route('public.gigs.show', $review->gig->id) }}">{{ $review->gig->title }}</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <p class="lead">Anda belum menerima ulasan apapun.</p>
                    </div>
                </div>
            @endforelse
            <div class="mt-4">{{ $reviews->links() }}</div>
        </div>
    </section>
@endsection
