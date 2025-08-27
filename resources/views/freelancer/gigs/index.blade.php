@extends('layouts.template')

@section('title', 'Kelola Jasa (Gigs)')

@section('content')
    <section class="section_gap mt-5">
        <div class="container py-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-2xl font-bold">Jasa (Gigs) Anda</h1>
                <a href="{{ route('freelancer.gigs.create') }}" class="btn btn-primary">Tambah Jasa Baru</a>
            </div>

            {{-- Notifikasi Sukses/Error --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
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
                                    <a href="{{ route('freelancer.gigs.edit', $gig->id) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>

                                    <form action="{{ route('freelancer.gigs.destroy', $gig->id) }}" method="POST"
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
