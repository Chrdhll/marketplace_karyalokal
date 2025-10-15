@extends('layouts.template')
@section('title', 'Aktifkan Kembali Akun')
@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm text-center">
                        <div class="card-body p-5">
                            <h3>Selamat Datang Kembali!</h3>
                            <p class="text-muted">Akun Anda dengan email <strong>{{ session('email') }}</strong> saat ini
                                tidak aktif dan dijadwalkan untuk dihapus.</p>
                            <p>Apakah Anda ingin mengaktifkan kembali akun Anda?</p>
                            <form action="{{ route('reactivate.process') }}" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{ session('email') }}">
                                <button type="submit" class="btn btn-primary btn-lg">Ya, Aktifkan Kembali Akun
                                    Saya</button>
                            </form>
                            <a href="{{ route('logout') }}" class="btn btn-link mt-3"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Tidak,
                                keluar saja</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
