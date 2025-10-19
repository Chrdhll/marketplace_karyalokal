@extends('layouts.freelancer')

@section('title', 'Profil Saya')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-lg-flex justify-content-lg-between align-items-lg-center text-center text-lg-left mb-4">
                        <h1 class="h2">Profil Saya</h1>
                        <div>
                            {{-- Tombol Edit Profil --}}
                            <a href="{{ route('freelancer.profil.edit') }}" class="btn btn-warning">Edit Profil</a>
                            {{-- Tombol Keamanan & Ganti Password --}}
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Keamanan & Ganti Password</a>
                        </div>
                    </div>

                    @if (auth()->user()->freelancerProfile?->profile_status == 'pending')
                        <div class="alert alert-warning shadow-sm" role="alert">
                            <h4 class="alert-heading">Menunggu Persetujuan</h4>
                            <p>Profil Anda telah kami terima dan sedang ditinjau oleh tim admin. Anda tidak dapat mengubah
                                profil
                                selama proses peninjauan.</p>
                        </div>
                    @elseif (auth()->user()->freelancerProfile?->profile_status == 'rejected')
                        <div class="alert alert-danger shadow-sm" role="alert">
                            <h4 class="alert-heading">Profil Ditolak</h4>
                            <p>Maaf, profil Anda belum dapat kami setujui. Silakan periksa kembali kelengkapan data Anda di
                                bawah
                                dan kirim ulang dengan menekan tombol "Simpan Profil".</p>
                        </div>
                    @elseif (auth()->user()->freelancerProfile?->profile_status == 'approved' && auth()->user()->bio)
                        <div class="alert alert-success shadow-sm" role="alert">
                            <h4 class="alert-heading">Profil Disetujui!</h4>
                            <p class="mb-0">Selamat! Profil Anda telah disetujui. Anda sekarang dapat <a
                                    href="{{ route('freelancer.gigs.index') }}" class="alert-link">menambahkan jasa
                                    (Gigs)</a>
                                Anda.
                            </p>
                        </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <img src="{{ $user->profile_picture_path ? Storage::url($user->profile_picture_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                        alt="{{ $user->name }}" class="rounded-circle mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                                <div class="col-md-9">
                                    <h3>{{ $user->name }}</h3>
                                    <p class="h5 text-muted">{{ $user->freelancerProfile?->headline }}</p>
                                    <p class="mt-3"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        {{ $user->freelancerProfile?->location ?? 'Lokasi belum diatur' }}</p>
                                    <hr>
                                    <h5>Bio</h5>
                                    <p>{{ $user->freelancerProfile?->bio ?? 'Bio belum diisi.' }}</p>
                                    <h5>Headline</h5>
                                    <p>{{ $user->freelancerProfile?->headline ?? 'headline belum diisi.' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mt-3">CV</h5>
                                    @if ($user->freelancerProfile?->cv_file_path)
                                        <a href="{{ Storage::url($user->freelancerProfile?->cv_file_path) }}"
                                            target="_blank" class="btn btn-outline-warning">Lihat CV</a>
                                    @else
                                        <p class="text-muted">CV belum di-upload.</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mt-3">Portofolio</h5>
                                    @if ($user->freelancerProfile?->portfolio)
                                        <a href="{{ Storage::url($user->freelancerProfile?->portfolio) }}" target="_blank"
                                            class="btn btn-outline-warning">Lihat Portofolio</a>
                                    @else
                                        <p class="text-muted">Portofolio belum di-upload.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
