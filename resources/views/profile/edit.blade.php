@extends('layouts.template')

@section('title', 'Pengaturan Akun')

@section('content')
    <section class="section_gap mt-5">
        <div class="container">
            {{-- Notifikasi --}}
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    @if (session('status') === 'profile-updated')
                        Informasi profil berhasil diperbarui.
                    @elseif (session('status') === 'password-updated')
                        Password berhasil diperbarui.
                    @else
                        {{ session('status') }}
                    @endif
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card shadow-sm mt-4">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="font-weight-bold">Informasi Akun</h4>
                                <p class="text-muted">Perbarui data-data yang terhubung dengan akun Anda.</p>

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
                                            <label class="custom-file-label" for="profile_picture">Ganti foto...</label>
                                        </div>
                                    </div>
                                    @error('profile_picture')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-12 border-left-lg">
                                <h4 class="font-weight-bold">Detail Akun</h4>
                                <p class="text-muted">Pastikan nama, username, dan email Anda sudah benar.</p>

                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Nama Lengkap</label>
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username" class="font-weight-bold">Username</label>
                                    <input id="username" name="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username', $user->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">Email</label>
                                    <input id="email" name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ml-2">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- KARTU UNTUK UPDATE PASSWORD --}}
            <div class="card shadow-sm mt-4">
                <div class="card-body p-4 p-md-5">
                    @include('profile.partials.update-password-form-custom')
                </div>
            </div>

            {{-- KARTU UNTUK HAPUS AKUN --}}
            <div class="card shadow-sm mt-4">
                <div class="card-body p-4 p-md-5">
                    @include('profile.partials.delete-user-form-custom')
                </div>
            </div>
        </div>
    </section>

    {{-- Sedikit CSS untuk style tambahan --}}
    @push('styles')
        <style>
            @media (min-width: 992px) {
                .border-left-lg {
                    border-left: 1px solid #dee2e6;
                    padding-left: 2rem;
                }
            }
        </style>
    @endpush

    @push('scripts-footer')
        {{-- Sedikit JS untuk menampilkan nama file di input --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Script untuk custom file input
                document.querySelectorAll('.custom-file-input').forEach(function(input) {
                    input.addEventListener('change', function(e) {
                        let fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file...';
                        e.target.nextElementSibling.innerText = fileName;
                    });
                });

                // Script untuk toggle password
                document.querySelectorAll('.toggle-password').forEach(button => {
                    button.addEventListener('click', function() {
                        const targetInput = document.getElementById(this.dataset.target);
                        const icon = this.querySelector('i');
                        if (targetInput.type === 'password') {
                            targetInput.type = 'text';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        } else {
                            targetInput.type = 'password';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    });
                });
            });
        </script>
    @endpush

@endsection
