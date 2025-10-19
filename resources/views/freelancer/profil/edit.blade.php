@extends('layouts.freelancer')

@section('title', 'Edit Profil Profesional')
@section('content')
    <section class="section_gap mt-5">
        <div class="container">
            {{-- Pesan Sambutan untuk User Baru --}}
            @if (!auth()->user()->freelancerProfile)
                <div class="alert alert-info shadow-sm mb-4">
                    <h4 class="alert-heading">Selamat Datang di KaryaLokal!</h4>
                    <p>Ini adalah langkah pertamamu untuk memulai perjalanan sebagai freelancer. Lengkapi profil
                        profesionalmu selengkap mungkin untuk menarik perhatian klien.</p>
                    <hr>
                    <p class="mb-0">Setelah profilmu dikirim, tim kami akan meninjaunya sebelum ditampilkan di
                        marketplace.</p>
                </div>

            @endif

            <div class="card shadow-sm mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Edit Profil Profesional</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    <fieldset {{ auth()->user()->freelancerProfile?->profile_status == 'pending' ? 'disabled' : '' }}>
                        <form action="{{ route('freelancer.profil.update') }}" method="POST" enctype="multipart/form-data"
                            @if (auth()->user()->freelancerProfile?->profile_status !== 'approved') onsubmit="return confirm('Pastikan semua data sudah terisi dengan benar. Setelah dikirim, profil Anda akan dikunci hingga proses review oleh admin selesai. Lanjutkan?');" @endif>
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="headline" class="font-weight-bold">Headline</label>
                                <input type="text" name="headline" id="headline"
                                    class="form-control @error('headline') is-invalid @enderror"
                                    placeholder="Contoh: Web Developer & UI/UX Designer"
                                    value="{{ old('headline', $user->freelancerProfile?->headline) }}">
                                @error('headline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bio" class="font-weight-bold">Bio Singkat</label>
                                <textarea name="bio" id="bio" rows="5" class="form-control @error('bio') is-invalid @enderror"
                                    placeholder="Ceritakan tentang diri Anda sebagai seorang profesional...">{{ old('bio', $user->freelancerProfile?->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keahlian" class="font-weight-bold">Keahlian</label>
                                <input type="text" name="keahlian" id="keahlian"
                                    class="form-control @error('keahlian') is-invalid @enderror"
                                    placeholder="Contoh: PHP, Laravel, MySQL (pisahkan dengan koma)"
                                    value="{{ old('keahlian', $user->freelancerProfile?->keahlian) }}">
                                @error('keahlian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location" class="font-weight-bold">Lokasi</label>
                                <input type="text" name="location" id="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    placeholder="Contoh: Jakarta, Indonesia"
                                    value="{{ old('location', $user->freelancerProfile?->location) }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @php
                                $isFirstSubmission = !$user->freelancerProfile;
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
                                    @if ($user->freelancerProfile?->cv_file_path)
                                        <small class="form-text text-muted mt-2">CV saat ini: <a
                                                href="{{ Storage::url($user->freelancerProfile?->cv_file_path) }}"
                                                target="_blank">Lihat
                                                CV</a></small>
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
                                    @if ($user->freelancerProfile?->portfolio)
                                        <small class="form-text text-muted mt-2">Portofolio saat ini: <a
                                                href="{{ Storage::url($user->freelancerProfile?->portfolio) }}"
                                                target="_blank">Lihat
                                                Portofolio</a></small>
                                    @endif

                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('freelancer.profil.show') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary ml-2">Simpan Profil</button>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    @media (min-width: 992px) {
        .border-left-lg {
            border-left: 1px solid #dee2e6;
            padding-left: 2rem;
        }
    }
</style>

@push('scripts-footer')
    {{-- Script untuk menampilkan nama file di input --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.custom-file-input').forEach(function(input) {
                input.addEventListener('change', function(e) {
                    let fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file...';
                    e.target.nextElementSibling.innerText = fileName;
                });
            });
        });
    </script>
@endpush
