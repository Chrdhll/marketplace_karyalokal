@extends('layouts.template')

@section('title', 'Confirmation')

@section('content')
    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ route('index') }}"><img src="/assets/img/logobaru.png"
                            alt="" style="width: 50%;"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Beranda</a></li>
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
                            <li class="nav-item"><a href="#" class="cart"><span class="ti-user"></span></a></li>
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
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

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Confirmation</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('index') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Confirmation</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Order Details Area =================-->
    <section class="order_details section_gap">
        <div class="container">
            <h3 class="title_confirmation">Thank you. Your order has been received.</h3>
            <div class="row order_d_inner">
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Order Info</h4>
                        <ul class="list">
                            <li><a href="#"><span>Order number</span> : 60235</a></li>
                            <li><a href="#"><span>Date</span> : Los Angeles</a></li>
                            <li><a href="#"><span>Total</span> : USD 2210</a></li>
                            <li><a href="#"><span>Payment method</span> : Check payments</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Billing Address</h4>
                        <ul class="list">
                            <li><a href="#"><span>Street</span> : 56/8</a></li>
                            <li><a href="#"><span>City</span> : Los Angeles</a></li>
                            <li><a href="#"><span>Country</span> : United States</a></li>
                            <li><a href="#"><span>Postcode </span> : 36952</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Shipping Address</h4>
                        <ul class="list">
                            <li><a href="#"><span>Street</span> : 56/8</a></li>
                            <li><a href="#"><span>City</span> : Los Angeles</a></li>
                            <li><a href="#"><span>Country</span> : United States</a></li>
                            <li><a href="#"><span>Postcode </span> : 36952</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="order_details_table">
                <h2>Order Details</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>Pixelstore fresh Blackberry</p>
                                </td>
                                <td>
                                    <h5>x 02</h5>
                                </td>
                                <td>
                                    <p>$720.00</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Pixelstore fresh Blackberry</p>
                                </td>
                                <td>
                                    <h5>x 02</h5>
                                </td>
                                <td>
                                    <p>$720.00</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Pixelstore fresh Blackberry</p>
                                </td>
                                <td>
                                    <h5>x 02</h5>
                                </td>
                                <td>
                                    <p>$720.00</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Subtotal</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>$2160.00</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Shipping</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>Flat rate: $50.00</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>$2210.00</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Order Details Area =================-->

@endsection
