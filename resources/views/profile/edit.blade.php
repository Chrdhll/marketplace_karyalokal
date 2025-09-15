@extends('layouts.template')

@section('title', 'Pengaturan Akun')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <h1 class="mb-4">Pengaturan Akun & Keamanan</h1>
            <div class="row">
                <div class="col-lg-12">
                    {{-- KARTU UNTUK UPDATE PASSWORD --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Ubah Password</h5>
                        </div>
                        <div class="card-body">
                            {{-- Ini adalah form dari partial Breeze, disajikan ulang dengan style kita --}}
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="current_password">Password Saat Ini</label>
                                    <div class="input-group" style="width: 36rem">
                                        <input id="current_password" name="current_password" type="password"
                                            class="form-control" autocomplete="current-password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                                data-target="current_password">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('current_password', 'updatePassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group" style="width: 36rem">
                                    <label for="password">Password Baru</label>
                                    <div class="input-group">
                                        <input id="password" name="password" type="password" class="form-control"
                                            autocomplete="new-password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                                data-target="password">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password', 'updatePassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group" style="width: 36rem">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <div class="input-group">
                                        <input id="password_confirmation" name="password_confirmation" type="password"
                                            class="form-control" autocomplete="new-password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                                data-target="password_confirmation">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password_confirmation', 'updatePassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary">Simpan Password</button>
                                    @if (session('status') === 'password-updated')
                                        <p class="ml-3 text-success mb-0">Password berhasil di update.</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- KARTU UNTUK HAPUS AKUN --}}
                    <div class="card shadow-sm border-danger">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Hapus Akun</h5>
                        </div>
                        <div class="card-body">
                            <p>Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen (atau
                                di-soft delete). Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang
                                ingin Anda simpan.</p>

                            {{-- Tombol ini akan memunculkan modal konfirmasi --}}
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-user-deletion">
                                Hapus Akun Saya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="confirm-user-deletion" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title">Apakah Anda yakin?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Setelah akun Anda dihapus, semua datanya tidak dapat dikembalikan. Silakan masukkan password Anda
                            untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>
                        <div class="form-group">
                            <label for="password-delete">Password</label>
                            <div class="input-group">
                                <input id="password-delete" name="password" type="password" class="form-control"
                                    placeholder="Password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="password-delete">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password', 'userDeletion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts-footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cari semua tombol dengan class .toggle-password
            const togglePasswordButtons = document.querySelectorAll('.toggle-password');

            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil ID input target dari atribut data-target
                    const targetInputId = this.dataset.target;
                    const passwordInput = document.getElementById(targetInputId);
                    const icon = this.querySelector('i');

                    // Ganti tipe input dari password ke text atau sebaliknya
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash'); // Ganti ikon menjadi mata dicoret
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye'); // Ganti ikon kembali menjadi mata
                    }
                });
            });
        });
    </script>
@endpush
