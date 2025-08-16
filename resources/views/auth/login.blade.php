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

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/assets/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>KaryaLokal</title>

    <!--
  CSS
  ============================================= -->
    <link rel="stylesheet" href="/assets/css/linearicons.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/nice-select.css">
    <link rel="stylesheet" href="/assets/css/nouislider.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="/assets/img/logobaru.png" alt=""
                            style="width: 50%;"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="index.html">Beranda</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">Cari Freelance</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="category.html">Programing</a></li>
                                    <li class="nav-item"><a class="nav-link" href="category.html">Content
                                            Writing</a></li>
                                    <li class="nav-item"><a class="nav-link" href="category.html">Editing</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#about">About Me</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">KaryaLokal Pro</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="">Silver</a></li>
                                    <li class="nav-item"><a class="nav-link" href="">Gold</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="">Diamond</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="login.html"
                                    style="background-color: #ffba00; color: white; padding: 6px 20px; ">Login</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a href="#" class="cart"><span class="ti-user"></span></a>
                            </li>
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier"
                                        id="search"></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

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
                            <a class="primary-btn" href="javascript:void(0);" onclick="toggleForm()">Create an
                                Account</a>
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


                        <form class="row login_form" action="{{ route('login') }}" method="POST"
                            id="contactFormLogin">
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
                    <div class="login_form_inner d-none" id="register-form">
                        <h3>Create Your Account</h3>
                        <form class="row login_form" action="#" method="post" id="contactFormRegister"
                            novalidate="novalidate">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="fullname" placeholder="Full Name"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email"
                                    placeholder="Email Address" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Email Address'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="confirm_password"
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore dolore
                            magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">

                            <form target="_blank" novalidate="true"
                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="form-inline">

                                <div class="d-flex flex-row">

                                    <input class="form-control" name="EMAIL" placeholder="Enter Email"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                        required="" type="email">


                                    <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right"
                                            aria-hidden="true"></i></button>
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1"
                                            value="" type="text">
                                    </div>

                                    <!-- <div class="col-lg-4 col-md-4">
            <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
           </div>  -->
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#" style="color: white;"><span class="ti-facebook"></span></i></a>
                            <a href="#" style="color: white;"><span class="ti-instagram"></span></i></a>
                            <a href="#" style="color: white;"><span class="ti-github"></span></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is
                    made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                        target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->


    <!-- Toggle Script -->
    <script>
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            loginForm.classList.toggle('d-none');
            registerForm.classList.toggle('d-none');
        }
    </script>
    <script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="/assets/js/vendor/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="/assets/js/jquery.nice-select.min.js"></script>
    <script src="/assets/js/jquery.sticky.js"></script>
    <script src="/assets/js/nouislider.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="/assets/js/gmaps.min.js"></script>
    <script src="/assets/js/main.js"></script>
</body>

</html>
