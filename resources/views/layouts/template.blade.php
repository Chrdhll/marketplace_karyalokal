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
    <title>KaryaLokal @yield('title')</title>
    <!--
  CSS
  ============================================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.skinFlat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Font Awesome CDN (versi 6) -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <style>
        .exclusive-right .product-details h4 {
        font-size: 20px;
        text-transform: uppercase;
        }

        .exclusive-right .add-bag .add-btn {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 50%;
        }

        .exclusive-right .carousel-control-prev-icon,
        .exclusive-right .carousel-control-next-icon {
        background-size: 60%, 60%;
        }

        a {
        text-decoration: none;
        }

       
       @media (max-width: 991.98px) {

            /* Perintah untuk container agar menjadi flexbox */
            /* .header_area .main_menu .navbar .container {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
                padding: 0%; 
            } */

            .nav-lurus, .navbar-brand {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
                padding: 10px 5px ; /* Reset padding aneh */
            }

            /* Perintah untuk logo DAN tombol hamburger agar tidak rakus tempat */

            .header_area,
            .header_area .navbar-toggler {
                width: auto !important; /* Jangan ambil lebar penuh */
                flex: none !important; /* Hentikan sifat 'flex-grow' */
                margin: 0 !important; /* Hapus semua margin yang aneh */
                padding: 0 !important; /* Hapus padding yang aneh */
            }

        .sidebar-wrapper {
            position: fixed;
            top: 0;
            right: -280px; /* Sembunyi di kiri */
            width: 280px;
            height: 100%;
            background: #fff;
            z-index: 9999 !important; 
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        .sidebar-wrapper.active {
            right: 0; /* Munculkan */
        }
        .sidebar-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .close-sidebar-btn { background: none; border: none; font-size: 1.5rem; }
        .sidebar-nav { list-style: none; padding: 15px 0; margin: 0; }
        .sidebar-nav li a {
            display: block; padding: 10px 20px; color: #333;
            text-decoration: none; transition: background 0.2s ease;
        }
        .sidebar-nav .button-login li a {
            background-color: #ffba00; color: white; padding: 6px 20px;
            max-width: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            /* text-decoration: none; transition: background 0.2s ease; */
        }
        .sidebar-nav li a:hover { background: #f8f9fa; }
        .sidebar-nav .sidebar-heading {
            padding: 10px 20px; font-size: 0.8rem; text-transform: uppercase;
            color: #999;
        }
        .sidebar-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            opacity: 0; visibility: hidden; transition: all 0.3s ease;
            z-index: 9998 !important;
           
        }
        .sidebar-overlay.active {
            opacity: 1; visibility: visible;
        }
        .li-login{
            padding: 10px 20px;
        }
    }

    @media (min-width: 992px) {
            /* Sembunyikan semua elemen sidebar */
            .sidebar-wrapper,
            .sidebar-overlay {
                display: none !important;
            }
        }
    </style>

    @stack('styles')
    @stack('scripts')
</head>

<body>

     <div class="sidebar-wrapper" id="sidebar-wrapper">
        <div class="sidebar-header">
            <h5>Menu Navigasi</h5>
            <button type="button" class="close-sidebar-btn" id="close-sidebar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('index') }}">Beranda</a></li>
            <li>
    {{-- Tombol untuk membuka/menutup accordion --}}
                <a href="#categoryCollapse" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="categoryCollapse" class="collapse-trigger">
                    Kategori
                    <span class="lnr lnr-chevron-down float-right"></span>
                </a>
                {{-- Daftar kategori yang bisa disembunyikan --}}
                <ul class="collapse collapse-menu" id="categoryCollapse">
                    <li><a href="{{ route('public.gigs.index') }}">&raquo; Semua Kategori</a></li>
                    @foreach ($sharedCategories as $category)
                        <li>
                            <a href="{{ route('public.gigs.index', ['category' => $category->slug]) }}">&raquo; {{ $category->name }}</a>
                        </li> @endforeach
                </ul>
            </li>
             <li><a href="{{ route('index') }}#about">
    About Me</a></li>
    <hr>

    @auth
        {{-- MENU KLIEN --}}
        <li class="sidebar-heading">
            Akun Saya</li>
        <li><a href="{{ route('order.index') }}">Pesanan Saya</a></li>
        <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>

        {{-- PINTU MASUK KE MODE FREELANCER --}}
        @if (auth()->user()->isApprovedFreelancer())
            <hr>
            <li class="sidebar-heading">Area Freelancer</li>
            <li><a href="{{ route('freelancer.dashboard') }}">Dashboard Penjual</a></li>
        @else
            <li><a href="{{ route('freelancer.profil.edit') }}">Mulai Menjual Jasa</a></li>
        @endif

        <hr>
        <li class="sidebar-heading">Pengaturan</li>
        <li><a href="{{ route('profile.edit') }}">Pengaturan Akun</a></li>
        <li>
            <a href="{{ route('logout') }}"
                onclick="if (confirm('Apakah Anda yakin ingin keluar?')) { event.preventDefault(); document.getElementById('logout-form-sidebar').submit(); }">
                <i class="fa fa-sign-out"></i> Logout
            </a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    @else
        {{-- MENU UNTUK PENGUNJUNG --}}
        <div class="button-login">
            <li class="li-login">
                <a class="nav-link" href="{{ route('login') }}">
                    Login
                </a>
            </li>
        </div>
    @endauth
    </ul>
    </div>
    {{-- Overlay untuk background gelap --}}
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    {{-- <div style="position: fixed; top: 100px; right: 20px; z-index: 9999; width: auto;">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div> --}}

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <div class="nav-lurus">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand logo_h" href="{{ route('index') }}"><img src="/assets/img/logobaru.png"
                                alt="" style="width: 50%;"></a>
                        <button class="navbar-toggler" type="button" id="sidebar-toggler"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Beranda</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">Kategori</a>

                                <ul class="dropdown-menu">
                                    {{-- MULAI PERULANGAN DI SINI --}}
                                    @foreach ($sharedCategories as $category)
                                        <li class="nav-item">
                                            {{-- Link akan otomatis mengarah ke halaman Gigs yang sudah difilter --}}
                                            <a class="nav-link"
                                                href="{{ route('public.gigs.index', ['category' => $category->slug]) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index') }}#about"">About Me</a>
                            </li>
                            {{-- <li class="nav-item submenu dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false">KaryaLokal Pro</a>
        <ul class="dropdown-menu">
            <li class="nav-item"><a class="nav-link" href="">Silver</a></li>
            <li class="nav-item"><a class="nav-link" href="">Gold</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="">Diamond</a>
            </li>
        </ul>
    </li> --}}



                            {{-- Cek dulu apakah user sudah login --}}
                            @auth
                                {{-- Jika sudah login, tampilkan item ini --}}
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="ti-user"></span>
                                        {{-- Tampilkan nama user yang login --}}
                                        Hi, {{ \Illuminate\Support\Str::limit(auth()->user()->username, 10, '...') }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        {{-- MENU KLIEN (Tampil untuk semua yang login) --}}
                                        <li class="nav-item"><a class="nav-link"
                                                href="{{ route('order.index') }}">Pesanan Saya</a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                href="{{ route('wishlist.index') }}">Wishlist</a></li>

                                        {{-- PINTU MASUK KE MODE FREELANCER --}}
                                        @if (auth()->user()->isApprovedFreelancer())
                                            {{-- Jika sudah jadi freelancer, tampilkan link ke dasbornya --}}
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('freelancer.dashboard') }}">Dashboard
                                                    penjual</a></li>
                                        @else
                                            {{-- Jika masih klien, tampilkan ajakan menjadi freelancer --}}
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('freelancer.profil.edit') }}">Mulai menjual
                                                    jasa</a></li>
                                        @endif
                                        {{-- LOGIKA PEMILIHAN LINK PROFIL --}}
                                        {{-- @if (auth()->user()->role == 'freelancer') --}}
                                        {{-- Jika role adalah freelancer, arahkan ke profil freelancer --}}
                                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('freelancer.profil.show') }}">Profil Saya</a>
                    </li> --}}
                                        {{-- @elseif (auth()->user()->role == 'client') --}}
                                        {{-- Jika role adalah client, arahkan ke profil breeze --}}
                                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Pengaturan Akun</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('order.index') }}">Pesanan Saya</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('wishlist.index') }}">Wishlist Saya</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('freelancer.profil.edit') }}">Mulai menjual
                            jasa</a></li> --}}
                                        {{-- @elseif (auth()->user()->role == 'admin')
                    <li class="nav-item"><a class="nav-link" href="/admin">Dashboard Admin</a></li>
                @endif --}}

                                        {{-- @if (auth()->user()->role == 'freelancer' && auth()->user()->profile_status == 'approved')
                    <li class="nav-item"><a class="nav-link" href="{{ route('freelancer.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('freelancer.gigs.index') }}">Kelola Jasa
                            (Gigs)
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('freelancer.orders.index') }}">Pesanan
                            Masuk</a>
                    </li>
                @endif --}}
                                        {{-- TOMBOL LOGOUT --}}

                                        {{-- MENU UMUM & LOGOUT --}}
                                        <li class="nav-item"><a class="nav-link"
                                                href="{{ route('profile.edit') }}">Pengaturan Akun</a></li>
                                        <li class="nav-item">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="nav-link" href="{{ route('logout') }}"
                                                    onclick="if (confirm('Apakah Anda yakin ingin keluar?')) { event.preventDefault(); document.getElementById('logout-form-sidebar').submit(); }">
                                                    Logout
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                {{-- Jika user BELUM login (sebagai guest), tampilkan tombol Login --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"
                                        style="background-color: #ffba00; color: white; padding: 6px 20px;">
                                        Login
                                    </a>
                                </li>
                            @endauth

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            {{-- <li class="nav-item"><a href="#" class="cart"><span class="ti-user"></span></a>
        </li> --}}
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
                {{-- KODE BARU (Sudah Fungsional) --}}
                <form class="d-flex justify-content-between" action="{{ route('public.gigs.index') }}"
                    method="GET">
                    <input type="text" class="form-control" name="q" id="search_input"
                        placeholder="Ketik lalu tekan enter untuk mencari...">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    @yield('content')

    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p class="text-white">
                            KaryaLokal adalah jembatan bagi talenta lokal dan klien untuk bertemu, berkolaborasi, dan
                            tumbuh bersama demi mendukung kreativitas anak bangsa.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p class="text-white">Stay update with our latest</p>
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
                        <p class="text-white">Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="https://instagram.com/pmw.karyalokal" style="color: white;"><span
                                    class="ti-instagram"></span></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0 text-white">
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{ asset('assets/js/gmaps.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cari semua form wishlist
            const wishlistForms = document.querySelectorAll('.wishlist-toggle-form');

            wishlistForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    // 1. Hentikan reload halaman
                    event.preventDefault();

                    // 2. Kirim data ke server di belakang layar (AJAX)
                    fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': this.querySelector('input[name="_token"]')
                                    .value,
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                // 3. Jika berhasil, ubah ikonnya
                                const button = this.querySelector('button');
                                const icon = button.querySelector('span');
                                const text = button.querySelector('p');

                                if (icon.classList.contains('lnr-heart')) {
                                    // Ubah jadi "sudah di-wishlist"
                                    icon.classList.remove('lnr', 'lnr-heart');
                                    icon.classList.add('fa', 'fa-heart');
                                    icon.style.color = 'red';
                                    text.textContent = 'Hapus';
                                } else {
                                    // Ubah jadi "belum di-wishlist"
                                    icon.classList.remove('fa', 'fa-heart');
                                    icon.classList.add('lnr', 'lnr-heart');
                                    icon.style.color = ''; // Kembali ke warna default
                                    text.textContent = 'Wishlist';
                                }
                            } else {
                                // Jika gagal (misal: belum login), redirect ke halaman login
                                window.location.href = "{{ route('login') }}";
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi Tom Select HANYA untuk dropdown dengan class .tom-select-custom
            var tomSelects = document.querySelectorAll('.tom-select-custom');
            for (var i = 0; i < tomSelects.length; i++) {
                new TomSelect(tomSelects[i]);
            }

            // Inisialisasi Nice Select HANYA untuk dropdown dengan class .filter-nice-select
            // Perhatikan kita menggunakan jQuery ($) di sini karena ini adalah plugin jQuery
            if (typeof $ !== 'undefined' && $('.filter-nice-select').length) {
                $('.filter-nice-select').niceSelect();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar-wrapper');
            const overlay = document.getElementById('sidebar-overlay');
            const openBtn = document.getElementById('sidebar-toggler');
            const closeBtn = document.getElementById('close-sidebar');

            function openSidebar() {
                sidebar.classList.add('active');
                overlay.classList.add('active');
            }

            function closeSidebar() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }

            if (openBtn) openBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);
        });
    </script>

    @stack('scripts-footer')
    </body>

</html>
