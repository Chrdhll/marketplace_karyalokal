@extends('layouts.template')

@section('title', 'Lupa Password')

@section('content')

    <section class="login_box_area section_gap mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="/assets/img/login.jpg" alt="">
                        <div class="hover">
                            <h4>Ingat password Anda?</h4>
                            <p>Kembali ke halaman login untuk masuk ke akun Anda.</p>
                            <a class="primary-btn" href="{{ route('login') }}">Login Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Lupa Password?</h3>
                        <p class="text-muted mb-4">Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.</p>

                        {{-- Menampilkan pesan status setelah link dikirim --}}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="row login_form" action="{{ route('password.email') }}" method="POST">
                            @csrf
                            
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" placeholder="Alamat Email" 
                                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat Email'"
                                       value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                           
                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Kirim Link Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection