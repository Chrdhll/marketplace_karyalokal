@extends('layouts.template')

@section('title', 'Login')

@section('content')

    <!--================ Login/Register Box Area =================-->
    <section class="login_box_area section_gap mt-5">
        <div class="container">
            <div class="row">
                <!-- Image Panel -->
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="/assets/img/login.jpg" alt="">
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>Register and explore local talent and services.</p>
                            <a class="primary-btn" href="{{ route('register') }}">Buat Akun</a>
                            {{-- <a class="primary-btn" href="javascript:void(0);" onclick="toggleForm()">Create an Account</a> --}}
                        </div>
                    </div>
                </div>

                <!-- Form Panel -->
                <div class="col-lg-6">
                    <!-- Login Form -->
                    <div class="login_form_inner" id="login-form">
                        <h3>Masuk ke Akun Anda</h3>

                        {{-- Menampilkan pesan status (misalnya: setelah berhasil reset password) --}}
                        @if (session('status'))
                            <div class="alert alert-success mb-3">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        @endif

                        {{-- Menampilkan error umum (misal: email & password tidak cocok) --}}
                        @error('login')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <form class="row login_form" action="{{ route('login') }}" method="POST" id="contactFormLogin">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="login" placeholder="Email atau Username"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email atau Username'"
                                    value="{{ old('login') }}" required>
                                {{-- Error spesifik untuk email tidak perlu lagi karena sudah ditangani di atas --}}
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
                                @error('password')
                                    {{-- Kita hanya tampilkan error validasi password (misal: password harus 8 karakter) --}}
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="remember_me" name="remember">
                                    <label for="remember_me">Biarkan saya tetap masuk</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Log In</button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Lupa Password?</a>
                                @endif
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="text-center mt-3">
                                    <a href="{{ route('google.redirect') }}"
                                        class="btn btn-light d-flex align-items-center justify-content-center"
                                        style="border: 1px solid #ddd; padding: 10px; width: 100%;">
                                        <img src="https://developers.google.com/identity/images/g-logo.png"
                                            alt="Google Logo" style="height: 20px; margin-right: 10px;">
                                        <span>Login dengan Google</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('styles')
    <style>
        @media (max-width: 991.98px) {
            .login_box_area .login_box_img {
                margin-right: 0;
            }
        }
    </style>
@endpush
