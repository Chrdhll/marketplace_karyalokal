{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-end mt-4">
        </div>

        <div class="flex items-center justify-center mt-4">
            <a href="{{ route('google.redirect') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Login dengan Google
            </a>
        </div>
    </form>
</x-guest-layout>
 --}}

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

                        {{-- Menampilkan error umum (misal: email & password tidak cocok) --}}
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <form class="row login_form" action="{{ route('login') }}" method="POST" id="contactFormLogin">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'"
                                    value="{{ old('email') }}" required>
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

                    <!-- Register Form -->
                    {{-- <div class="login_form_inner d-none" id="register-form">
                        <h3>Create Your Account</h3>
                        <form class="row login_form" action="{{ route('register') }}" method="post"
                            id="contactFormRegister" novalidate="novalidate">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Confirm Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <select class="form-control" name="role">
                                    <option value="">-- Select Role --</option>
                                    <option value="user">User</option>
                                    <option value="freelancer">Freelancer</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Register</button>
                                <a href="javascript:void(0);" onclick="toggleForm()">Back to Login</a>
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>


@endsection
