@extends('layouts.freelancer')

@section('title', 'Profil Saya')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h2">Profil Saya</h1>
                        <div>
                            {{-- Tombol Edit Profil --}}
                            <a href="{{ route('freelancer.profil.edit') }}" class="btn btn-primary">Edit Profil</a>
                            {{-- Tombol Keamanan & Ganti Password --}}
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Keamanan & Ganti Password</a>
                        </div>
                    </div>

                    @if (auth()->user()->profile_status == 'pending' && auth()->user()->bio)
                        <div class="alert alert-warning shadow-sm" role="alert">
                            <h4 class="alert-heading">Menunggu Persetujuan</h4>
                            <p>Profil Anda telah kami terima dan sedang ditinjau oleh tim admin. Anda tidak dapat mengubah
                                profil
                                selama proses peninjauan.</p>
                        </div>
                    @elseif (auth()->user()->profile_status == 'rejected')
                        <div class="alert alert-danger shadow-sm" role="alert">
                            <h4 class="alert-heading">Profil Ditolak</h4>
                            <p>Maaf, profil Anda belum dapat kami setujui. Silakan periksa kembali kelengkapan data Anda di
                                bawah
                                dan kirim ulang dengan menekan tombol "Simpan Profil".</p>
                        </div>
                    @elseif (auth()->user()->profile_status == 'approved' && auth()->user()->bio)
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
                                    <p class="h5 text-muted">{{ $user->headline }}</p>
                                    <p class="mt-3"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        {{ $user->location ?? 'Lokasi belum diatur' }}</p>
                                    <hr>
                                    <h5>Bio</h5>
                                    <p>{{ $user->bio ?? 'Bio belum diisi.' }}</p>
                                    <h5>Headline</h5>
                                    <p>{{ $user->headline ?? 'headline belum diisi.' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5>CV</h5>
                                    @if ($user->cv_file_path)
                                        <a href="{{ Storage::url($user->cv_file_path) }}" target="_blank"
                                            class="btn btn-outline-primary">Lihat CV</a>
                                    @else
                                        <p class="text-muted">CV belum di-upload.</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h5>Portofolio</h5>
                                    @if ($user->portfolio)
                                        <a href="{{ Storage::url($user->portfolio) }}" target="_blank"
                                            class="btn btn-outline-primary">Lihat Portofolio</a>
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
