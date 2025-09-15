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
    <link rel="stylesheet" href="/assets/css/linearicons.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/css/nice-select.css">
    <link rel="stylesheet" href="/assets/css/nouislider.min.css">
    <link rel="stylesheet" href="/assets/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="/assets/css/ion.rangeSlider.skinFlat.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap4.css" rel="stylesheet">
    <!-- Font Awesome CDN (versi 6) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

    @stack('scripts')
</head>

<body>

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ route('index') }}"><img src="/assets/img/logobaru.png"
                            alt="" style="width: 50%;"></a>
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
                            <li class="nav-item {{ request()->routeIs('freelancer.dashboard') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('freelancer.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('freelancer.orders.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('freelancer.orders.index') }}">Pesanan Masuk</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('freelancer.gigs.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('freelancer.gigs.index') }}">Kelola Jasa</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('freelancer.profil.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('freelancer.profil.show') }}">Profil Saya</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            {{-- TOMBOL KEMBALI KE MARKETPLACE (MODE KLIEN) --}}
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="primary-btn"
                                    style="border-radius: 5px; line-height: 38px;">Kembali ke Marketplace</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
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
    <script src="/assets/js/countdown.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="/assets/js/gmaps.min.js"></script>
    <script src="/assets/js/main.js"></script>

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
    @stack('scripts-footer')
</body>

</html>
