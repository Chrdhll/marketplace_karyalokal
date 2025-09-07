@extends('layouts.template')

@section('title', $gig->title)

@section('content')

    <div class="product_image_area mt-5">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    {{-- Menampilkan satu gambar utama, karena kita belum punya fitur galeri --}}
                    <div class="single-prd-item">
                        <img class="img-fluid"
                            src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/600x600' }}"
                            alt="{{ $gig->title }}">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $gig->title }}</h3>
                        <h2>Rp {{ number_format($gig->price, 0, ',', '.') }}</h2>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Kategori</span> : {{ $gig->service }}</a></li>
                            <li><a href="#"><span>Estimasi</span> : {{ $gig->estimated_time }}</a></li>
                        </ul>
                        <p>{{ \Illuminate\Support\Str::limit($gig->description, 200) }}</p>
                        <div class="card_area d-flex align-items-center">
                            <a class="primary-btn" href="{{ route('checkout', $gig->id) }}">Pesan Jasa Ini</a>
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
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Spesifikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                        aria-controls="review" aria-selected="false">Ulasan ({{ $gig->review_count }})</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                {{-- TAB DESKRIPSI --}}
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>{!! nl2br(e($gig->description)) !!}</p>
                </div>

                {{-- TAB SPESIFIKASI --}}
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Freelancer</h5>
                                    </td>
                                    <td>
                                        <h5><a
                                                href="{{ route('public.freelancer.show', $gig->user->id) }}">{{ $gig->user->name }}</a>
                                        </h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Kategori</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $gig->service }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Estimasi Pengerjaan</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $gig->estimated_time }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Total Ulasan</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $gig->review_count }} Ulasan</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Rating Rata-rata</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $gig->rating_average ? number_format($gig->rating_average, 1) : 'Belum ada rating' }}
                                            / 5.0</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- TAB ULASAN (REVIEWS) --}}
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
                                <div class="mt-4"> {{ $reviews->links() }} </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                {{-- LOGIKA "PINTAR" UNTUK FORM REVIEW --}}
                                @if ($canReview)
                                    <h4>Tambahkan Ulasan Anda</h4>
                                    <form class="row contact_form"
                                        action="{{ route('reviews.store', $orderToReview->id) }}" method="post">
                                        @csrf
                                        <div class="col-md-12 form-group">
                                            <label>Rating Anda</label>
                                            <select name="rating" class="form-control" required>
                                                <option value="">-- Pilih Bintang --</option>
                                                <option value="5">★★★★★ (Luar Biasa)</option>
                                                <option value="4">★★★★☆ (Bagus)</option>
                                                <option value="3">★★★☆☆ (Cukup)</option>
                                                <option value="2">★★☆☆☆ (Kurang)</option>
                                                <option value="1">★☆☆☆☆ (Buruk)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <textarea class="form-control" name="comment" rows="4" placeholder="Tulis ulasan Anda di sini..." required></textarea>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" value="submit" class="primary-btn">Kirim Ulasan</button>
                                        </div>
                                    </form>
                                @else
                                    <h4>Tambahkan Ulasan</h4>
                                    <p>Anda harus memesan dan menyelesaikan jasa ini untuk dapat memberikan ulasan.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
