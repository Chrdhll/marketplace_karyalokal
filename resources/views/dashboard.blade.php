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
    <!-- Font Awesome CDN (versi 6) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

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
                            <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">Cari Freelance</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('category') }}">Programing</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('category') }}">Content
                                            Writing</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('category') }}">Editing</a>
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
                            {{-- <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"
                                    style="background-color: #ffba00; color: white; padding: 6px 20px; ">Login</a></li> --}}
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </li>
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

    <!-- header section -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">
                    <div class="active-banner-slider owl-carousel">
                        <!-- single-slide -->
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6 mt-5">
                                <div class="banner-content mt-5" style="color: white;">
                                    <h1 class="mt-4" style="color: white;">Welcome To<br>KaryaLokal</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                    <form action="search.php" method="GET" class="mt-4">
                                        <div class="input-group" style="width: 100%;">
                                            <input type="text" name="q" class="form-control"
                                                placeholder="Cari produk atau jasa..."
                                                style="border-radius: 0; min-height: 50px; font-size: 16px;">
                                            <div class="input-group-append">
                                                <button class="btn" type="submit"
                                                    style="background-color: #ffba00; color: white; border-radius: 0; min-height: 50px; padding: 0 30px; font-size: 16px;">
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                </div>
                            </div>
                        </div>
                        <!-- single-slide -->
                        <div class="row single-slide">
                            <div class="col-lg-5">
                                <div class="banner-content">
                                    <h1>Nike New <br>Collection!</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                        <span class="add-text text-uppercase">Add to Bag</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="/assets/img/banner/banner-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- header section -->

    <!-- Start Serevices -->
    <section class="brand-area section_gap">
        <div class="container">
            <div class="row">
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="/assets/img/brand/services-1.png" alt="">
                </a>
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="/assets/img/brand/services-2.png" alt="">
                </a>
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="/assets/img/brand/services-3.png" alt="">
                </a>
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="/assets/img/brand/services-4.png" alt="">
                </a>
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="/assets/img/brand/services-5.png" alt="">
                </a>
            </div>
        </div>
    </section>
    <!-- End Serevices -->

    <!-- Start Made On -->
    <section class="category-area">
        <div class="container">
            <h2 class="mb-4">Made On KaryaLokal</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="/assets/img/category/c1.jpg" alt="">
                                <a href="/assets/img/category/c1.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="/assets/img/category/c2.jpg" alt="">
                                <a href="/assets/img/category/c2.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="/assets/img/category/c3.jpg" alt="">
                                <a href="/assets/img/category/c3.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Product for Couple</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="/assets/img/category/c4.jpg" alt="">
                                <a href="/assets/img/category/c4.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-deal">
                        <div class="overlay"></div>
                        <img class="img-fluid w-100" src="/assets/img/category/c5.jpg" alt="">
                        <a href="/assets/img/category/c5.jpg" class="img-pop-up" target="_blank">
                            <div class="deal-details">
                                <h6 class="deal-title">Sneaker for Sports</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Made On -->

    <!-- start My Freelance -->
    <section class="owl-carousel active-product-area section_gap">
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Temukan Freelancer</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et
                                dolore
                                magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="{{ route('blog') }}" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Temukan Freelancer</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et
                                dolore
                                magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/user1.jpg" alt="">
                            <div class="product-details">
                                <h6>Muhammad Nawaf Akbar</h6>
                                <div class="price d-flex justify-content-between align-items-center">
                                    <h6 class="l-through mb-0">Web Developer</h6>
                                    <div class="d-flex align-items-center">
                                        <span style="color: #fbc02d; font-size: 16px;">★</span>
                                        <span style="font-size: 14px; color: #555; margin-left: 4px;">4.8</span>
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="blog.html" class="social-info">
                                        <span class="ti-plus"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section>
    <!-- end My Freelance -->

    <!-- Start ulasan -->
    <section class="exclusive-deal-area" id="about">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 no-padding exclusive-left">
                    <div class="row clock_sec clockdiv" id="clockdiv">
                        <div class="col-lg-12">
                            <div style="text-align: left;">
                                <h1 class="mb-3" style="text-align: left;">KaryaLokal</h1>
                                <p style="text-align: justify;">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </p>
                                <a href="" class="primary-btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 no-padding exclusive-right">
                    <div class="active-exclusive-product-slider">
                        <!-- single review carousel -->
                        <div class="single-exclusive-slider d-flex flex-column align-items-center text-center">
                            <img src="/assets/img/user1.jpg" alt="Foto User"
                                style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 15px;">
                            <div class="product-details">
                                <div class="price">
                                    <h6><i class="fa fa-star text-warning"></i> 4.8 / 5.0</h6>
                                    <h6 class="text-muted">Kategori: Jasa Desain</h6>
                                </div>
                                <h4>“Pelayanan cepat dan hasil desain sangat memuaskan!”</h4>
                                <div class="add-bag d-flex align-items-center justify-content-center mt-3">
                                    <a class="add-btn" href="#"><span class="lnr lnr-eye"></span></a>
                                    <span class="add-text text-uppercase">Lihat Ulasan</span>
                                </div>
                            </div>
                        </div>

                        <!-- single review carousel -->
                        <div class="single-exclusive-slider d-flex flex-column align-items-center text-center">
                            <img src="/assets/img/user1.jpg" alt="Foto User"
                                style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 15px;">
                            <div class="product-details">
                                <div class="price">
                                    <h6><i class="fa fa-star text-warning"></i> 4.5 / 5.0</h6>
                                    <h6 class="text-muted">Kategori: Produk Handmade</h6>
                                </div>
                                <h4>“Produk berkualitas, dikemas rapi, dan pengiriman cepat.”</h4>
                                <div class="add-bag d-flex align-items-center justify-content-center mt-3">
                                    <a class="add-btn" href="#"><span class="lnr lnr-eye"></span></a>
                                    <span class="add-text text-uppercase">Lihat Ulasan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- End ulasan -->

    <!-- Start related-product Area -->
    <!-- <section class="related-product-area section_gap_bottom">
  <div class="container">
   <div class="row justify-content-center">
    <div class="col-lg-6 text-center">
     <div class="section-title">
      <h1>Deals of the Week</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
       labore et dolore
       magna aliqua.</p>
     </div>
    </div>
   </div>
   <div class="row">
    <div class="col-lg-9">
     <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r1.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r2.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r3.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r5.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r6.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r7.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r9.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r10.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="single-related-product d-flex">
        <a href="#"><img src="/assets/img/r11.jpg" alt=""></a>
        <div class="desc">
         <a href="#" class="title">Black lace Heels</a>
         <div class="price">
          <h6>$189.00</h6>
          <h6 class="l-through">$210.00</h6>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
    <div class="col-lg-3">
     <div class="ctg-right">
      <a href="#" target="_blank">
       <img class="img-fluid d-block mx-auto" src="/assets/img/category/c5.jpg" alt="">
      </a>
     </div>
    </div>
   </div>
  </div>
 </section> -->
    <!-- End related-product Area -->

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
</body>

</html>
