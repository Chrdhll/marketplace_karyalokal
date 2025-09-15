{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="role" :value="__('Daftar sebagai')" />
            <div class="flex items-center mt-2">
                <input id="role_client" type="radio" name="role" value="client"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" checked>
                <label for="role_client" class="ml-2 block text-sm text-gray-900">
                    Klien (Pencari Jasa)
                </label>
            </div>
            <div class="flex items-center mt-2">
                <input id="role_freelancer" type="radio" name="role" value="freelancer"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                <label for="role_freelancer" class="ml-2 block text-sm text-gray-900">
                    Freelancer (Penyedia Jasa)
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.template')

@section('title', 'Register')

@section('content')

    <section class="login_box_area section_gap mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="/assets/img/login.jpg" alt="">
                        <div class="hover">
                            <h4>Sudah punya akun?</h4>
                            <p>Masuk dan lanjutkan proyek hebatmu bersama kami.</p>
                            <a class="primary-btn" href="{{ route('login') }}">Login Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner" id="register-form">
                        <h3>Buat Akun Baru</h3>

                        <form class="row login_form" action="{{ route('register') }}" method="POST"
                            id="contactFormRegister">
                            @csrf

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" placeholder="Username (contoh: karyalokal, tanpa spasi)"
                                    value="{{ old('username') }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Password" required>
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Konfirmasi Password" required>
                            </div>

                            {{-- <div class="col-md-12 form-group">
                                <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                                    <option value="">-- Pilih Role --</option>

                                    <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>
                                        Klien (Pencari Jasa)
                                    </option>
                                    <option value="freelancer" {{ old('role') == 'freelancer' ? 'selected' : '' }}>
                                        Freelancer (Penyedia Jasa)
                                    </option>
                                </select>

                                @error('role')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
