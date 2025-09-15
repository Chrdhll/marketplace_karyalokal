@extends('layouts.freelancer')

@section('title', 'Edit Profil Freelancer')

@section('content')

    <section class="section_gap mt-5">
        <div class="bg-gray-100 py-10">
            <div class="container">
                {{-- Notifikasi sukses setelah update --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        {{-- Ini isi pesannya --}}
                        {{ session('error') }}

                        {{-- Ini tombol silangnya --}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (!auth()->user()->bio)
                    <div class="alert alert-info shadow-sm mb-4">
                        <h4 class="alert-heading">Selamat Datang di KaryaLokal!</h4>
                        <p>Ini adalah langkah pertamamu untuk memulai perjalanan sebagai freelancer. Lengkapi profilmu
                            selengkap mungkin untuk menarik perhatian klien.</p>
                        <hr>
                        <p class="mb-0">Setelah profilmu dikirim, tim kami akan meninjaunya sebelum ditampilkan di
                            marketplace.</p>
                    </div>
                @endif
                <div class="card shadow-sm mt-4">
                    <div class="card-body p-4 p-md-5">

                        {{-- Jika status pending, seluruh form akan di-disable --}}
                        <fieldset
                            {{ auth()->user()->profile_status == 'pending' && auth()->user()->bio ? 'disabled' : '' }}>
                            <form action="{{ route('freelancer.profil.update') }}" method="POST"
                                @if (auth()->user()->profile_status !== 'approved') onsubmit="return confirm('Pastikan semua data sudah terisi dengan benar. Setelah dikirim, profil Anda akan dikunci hingga proses review oleh admin selesai. Lanjutkan?');" @endif
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
                                            <label for="name" class="font-weight-bold">Nama</label>
                                            <input type="text" name="name" id="name"
                                                placeholder="Contoh: John Doe" value="{{ old('name', $user->name) }}"
                                                class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="username" class="font-weight-bold">Username</label>
                                            <input type="text" name="username" id="username"
                                                placeholder="Contoh: johndoe" value="{{ old('username', $user->username) }}"
                                                class="form-control @error('username') is-invalid @enderror">
                                            @error('username')
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

                                        <div class="form-group">
                                            <label for="email" class="font-weight-bold">Email</label>
                                            <input type="email" name="email" id="email"
                                                placeholder="Contoh: 8rV4o@example.com"
                                                value="{{ old('email', $user->email) }}"
                                                class="form-control @error('location') is-invalid @enderror">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-lg-8 border-left-lg">
                                        <h4 class="font-weight-bold">Detail Profesional</h4>
                                        <p class="text-muted">Jelaskan keahlian dan pengalaman Anda.</p>

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
                                            <label for="bio" class="font-weight-bold">Bio Singkat</label>
                                            <textarea name="bio" id="bio" rows="5" class="form-control @error('bio') is-invalid @enderror"
                                                placeholder="Ceritakan tentang diri Anda sebagai seorang profesional...">{{ old('bio', $user->bio) }}</textarea>
                                            @error('bio')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="company_name" class="font-weight-bold">Nama Perusahaan</label>
                                            <input type="text" name="company_name" id="company_name"
                                                placeholder="Contoh: PT. ABC"
                                                value="{{ old('company_name', $user->company_name) }}"
                                                class="form-control @error('company_name') is-invalid @enderror">
                                            @error('company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @php
                                            $isFirstSubmission = !$user->cv_file_path || !$user->portfolio;
                                        @endphp

                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                {{ $isFirstSubmission ? 'Upload CV (PDF)' : 'Ganti CV (Opsional)' }}
                                                @if ($isFirstSubmission)
                                                    <span class="text-danger">*</span>
                                                @endif
                                                <div class="custom-file">
                                                    <input type="file" name="cv_file_path"
                                                        class="custom-file-input @error('cv_file_path') is-invalid @enderror"
                                                        id="cv_file_path" accept="application/pdf"
                                                        @if ($isFirstSubmission) required @endif>
                                                    <label class="custom-file-label" for="cv">Pilih file...</label>
                                                </div>
                                                @error('cv_file_path')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @if ($user->cv_file_path)
                                                    <small class="form-text text-muted mt-2">CV saat ini: <a
                                                            href="{{ Storage::url($user->cv_file_path) }}"
                                                            target="_blank">Lihat CV</a></small>
                                                @endif
                                            </div>


                                            <div class="col-md-6 form-group">
                                                <label for="portfolio" class="font-weight-bold">
                                                    {{ $isFirstSubmission ? 'Upload Portofolio (PDF)' : 'Ganti Portofolio (Opsional)' }}
                                                    @if ($isFirstSubmission)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="custom-file">
                                                    <input type="file" name="portfolio"
                                                        class="custom-file-input @error('portfolio') is-invalid @enderror"
                                                        id="portfolio" accept="application/pdf"
                                                        @if ($isFirstSubmission) required @endif>
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
                                    <a href="{{ route('freelancer.profil.show') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary ml-2">
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
