@extends('layouts.freelancer')

@section('title', $gig->title)

@section('content')
    <section class="login_box_area section_gap mt-5">
        <div class="container py-8">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <img src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/700x400' }}"
                            class="card-img-top" alt="{{ $gig->title }}">
                        <div class="card-body">
                            <h1 class="card-title font-weight-bold">{{ $gig->title }}</h1>
                            <p class="text-muted">Kategori: {{ $gig->service }}</p>
                            <hr>
                            <h5 class="font-weight-bold mt-4">Deskripsi Jasa</h5>
                            <p>{{ $gig->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-weight-bold">Harga</h4>
                            <h3>Rp {{ number_format($gig->price, 0, ',', '.') }}</h3>
                            <hr>
                            <h5 class="font-weight-bold mt-4">Estimasi Pengerjaan</h5>
                            <p>{{ $gig->estimated_time }}</p>
                            <hr>
                            <a href="#" class="btn btn-success btn-block mt-3">Pesan Jasa Ini</a>
                            <a href="{{ route('freelancer.gigs.index') }}" class="btn btn-secondary btn-block mt-2">Kembali
                                ke Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
