@extends('layouts.freelancer')

@section('title', 'Kelola Jasa (Gigs)')

@section('content')
    <section class="section_gap mt-5">
        <div class="container py-8">
            <div class="d-lg-flex justify-content-lg-between align-items-lg-center text-center text-lg-left mb-4">

                <h1 class="text-2xl font-bold">Jasa Anda</h1>
                <a href="{{ route('freelancer.gigs.create') }}" class="primary-btn">Tambah Jasa Baru</a>

            </div>

            {{-- Notifikasi Sukses/Error --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- 2. Alert Error (jika ditendang oleh middleware) --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                @forelse ($gigs as $gig)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ $gig->cover_image_path ? Storage::url($gig->cover_image_path) : 'https://via.placeholder.com/300x200' }}"
                                class="card-img-top" alt="{{ $gig->title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $gig->title }}</h5>
                                <p class="card-text text-muted">{{ $gig->service }}</p>
                                <p class="card-text font-weight-bold">Rp {{ number_format($gig->price, 0, ',', '.') }}</p>
                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="{{ route('freelancer.gigs.edit', $gig->slug) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>

                                    <form action="{{ route('freelancer.gigs.destroy', $gig->slug) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus jasa ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Anda belum memiliki jasa yang ditawarkan. Silakan <a
                                href="{{ route('freelancer.gigs.create') }}">tambahkan jasa baru</a>.
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Link Paginasi --}}
            <div class="mt-4">
                {{ $gigs->links() }}
            </div>
        </div>
    </section>
@endsection
