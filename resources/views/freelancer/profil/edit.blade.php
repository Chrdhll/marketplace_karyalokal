@extends('layouts.template')

@section('title', 'Edit Profil Freelancer')

@section('content')

    <section class="section_gap mt-5">
        <div class="bg-gray-100 py-10">
            <div class="container">
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
                                href="{{ route('freelancer.gigs.index') }}" class="alert-link">menambahkan jasa (Gigs)</a>
                            Anda.
                        </p>
                    </div>
                @endif

                {{-- Notifikasi sukses setelah update --}}
                @if (session('success'))
                    <div class="alert alert-success shadow-sm mt-4">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm mt-4">
                    <div class="card-body p-4 p-md-5">

                        {{-- Jika status pending, seluruh form akan di-disable --}}
                        <fieldset
                            {{ auth()->user()->profile_status == 'pending' && auth()->user()->bio ? 'disabled' : '' }}>
                            <form action="{{ route('freelancer.profil.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-lg-4">
                                        <h4 class="font-weight-bold">Info Dasar</h4>
                                        <p class="text-muted">Informasi personal dan kontak Anda.</p>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Foto Profil</label>
                                            <div class="d-flex align-items-center">
                                                <img class="rounded-circle"
                                                    src="{{ auth()->user()->profile_picture_path ? Storage::url(auth()->user()->profile_picture_path) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                                    alt="Foto Profil"
                                                    style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                                                <div class="custom-file">
                                                    <input type="file" name="profile_picture"
                                                        class="custom-file-input @error('profile_picture') is-invalid @enderror"
                                                        id="profile_picture" accept="image/*">
                                                    <label class="custom-file-label" for="profile_picture">Ganti
                                                        foto...</label>
                                                </div>
                                            </div>
                                            @error('profile_picture')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="headline" class="font-weight-bold">Headline</label>
                                            <input type="text" name="headline" id="headline"
                                                placeholder="Contoh: Web Developer & UI/UX Designer"
                                                value="{{ old('headline', $user->headline) }}"
                                                class="form-control @error('headline') is-invalid @enderror">
                                            @error('headline')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="location" class="font-weight-bold">Lokasi</label>
                                            <input type="text" name="location" id="location"
                                                placeholder="Contoh: Jakarta, Indonesia"
                                                value="{{ old('location', $user->location) }}"
                                                class="form-control @error('location') is-invalid @enderror">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-lg-8 border-left-lg">
                                        <h4 class="font-weight-bold">Detail Profesional</h4>
                                        <p class="text-muted">Jelaskan keahlian dan pengalaman Anda.</p>

                                        <div class="form-group">
                                            <label for="bio" class="font-weight-bold">Bio Singkat</label>
                                            <textarea name="bio" id="bio" rows="5" class="form-control @error('bio') is-invalid @enderror"
                                                placeholder="Ceritakan tentang diri Anda sebagai seorang profesional...">{{ old('bio', $user->bio) }}</textarea>
                                            @error('bio')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="keahlian" class="font-weight-bold">Keahlian</label>
                                            <input type="text" name="keahlian" id="keahlian"
                                                placeholder="Contoh: PHP, Laravel, MySQL (pisahkan dengan koma)"
                                                value="{{ old('keahlian', $user->keahlian) }}"
                                                class="form-control @error('keahlian') is-invalid @enderror">
                                            @error('keahlian')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="cv" class="font-weight-bold">Upload CV (PDF)</label>
                                                <div class="custom-file">
                                                    <input type="file" name="cv"
                                                        class="custom-file-input @error('cv') is-invalid @enderror"
                                                        id="cv" accept="application/pdf">
                                                    <label class="custom-file-label" for="cv">Pilih file...</label>
                                                </div>
                                                @error('cv')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @if ($user->cv_file_path)
                                                    <small class="form-text text-muted mt-2">CV saat ini: <a
                                                            href="{{ Storage::url($user->cv_file_path) }}"
                                                            target="_blank">Lihat CV</a></small>
                                                @endif
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="portfolio" class="font-weight-bold">Upload Portofolio
                                                    (PDF)</label>
                                                <div class="custom-file">
                                                    <input type="file" name="portfolio"
                                                        class="custom-file-input @error('portfolio') is-invalid @enderror"
                                                        id="portfolio" accept="application/pdf">
                                                    <label class="custom-file-label" for="portfolio">Pilih file...</label>
                                                </div>
                                                @error('portfolio')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @if ($user->portfolio)
                                                    <small class="form-text text-muted mt-2">Portofolio saat ini: <a
                                                            href="{{ Storage::url($user->portfolio) }}"
                                                            target="_blank">Lihat
                                                            Portofolio</a></small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Simpan Profil
                                    </button>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
    </section>

    {{-- Sedikit CSS untuk style tambahan --}}
    <style>
        @media (min-width: 992px) {
            .border-left-lg {
                border-left: 1px solid #dee2e6;
                padding-left: 2rem;
            }
        }
    </style>

    {{-- Sedikit JS untuk menampilkan nama file di input --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.custom-file-input').forEach(function(input) {
                input.addEventListener('change', function(e) {
                    let fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file...';
                    let nextSibling = e.target.nextElementSibling;
                    if (nextSibling) {
                        nextSibling.innerText = fileName;
                    }
                });
            });
        });
    </script>

    </section>
@endsection
