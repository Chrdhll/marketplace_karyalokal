@extends('layouts.template')

@section('title', 'Verifikasi Email Anda')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5 py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">

                    <div class="card shadow-sm text-center">
                        <div class="card-body p-4 p-md-5">

                            {{-- Ikon agar lebih menarik --}}
                            <i class="fa fa-envelope-o fa-4x text-primary mb-4"></i>

                            <h2 class="card-title h3">Verifikasi Alamat Email Anda</h2>

                            <p class="text-muted mt-3">
                                Terima kasih sudah mendaftar! Sebelum melanjutkan, Anda perlu memverifikasi alamat email
                                dengan mengklik link yang baru saja kami kirimkan.
                            </p>
                            <p class="text-muted">
                                Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkannya lagi.
                            </p>

                            {{-- Notifikasi jika email verifikasi baru saja dikirim --}}
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success mt-4">
                                    Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat registrasi.
                                </div>
                            @endif

                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        Kirim Ulang Email Verifikasi
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-muted">
                                        Logout
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
