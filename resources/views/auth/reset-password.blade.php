@extends('layouts.template')

@section('title', 'Reset Password')

@section('content')
    <section class="login_box_area section_gap mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="/assets/img/login.jpg" alt="">
                        <div class="hover">
                            <h4>Sudah punya akun?</h4>
                            <p>Masuk ke akun Anda untuk melanjutkan aktivitas.</p>
                            <a class="primary-btn" href="{{ route('login') }}">Login Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Buat Password Baru</h3>
                        <p class="text-muted mb-4">Silakan masukkan password baru Anda. Pastikan password kuat dan mudah diingat.</p>

                        <form class="row login_form" action="{{ route('password.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" placeholder="Alamat Email" 
                                       value="{{ old('email', $request->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" id="password" placeholder="Password Baru" required>
                                    <div class="input-group-append">
                                       
                                    </div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                 <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password Baru" required>
                                    <div class="input-group-append">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection