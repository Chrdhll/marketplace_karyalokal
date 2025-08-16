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
	<link rel="stylesheet" href="/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/css/themify-icons.css">
	<link rel="stylesheet" href="/assets/css/nice-select.css">
	<link rel="stylesheet" href="/assets/css/nouislider.min.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/main.css">
</head>

<body id="category">

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="{{ route('index') }}"><img src="/assets/img/logobaru.png" alt=""
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
							<li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Beranda</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown" role="button"
									aria-haspopup="true" aria-expanded="false">Cari Freelance</a>
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
					<h1>Cari Freelance</h1>
					<nav class="d-flex align-items-center">
						<a href="{{ route('index') }}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Cari Freelance</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!-- freelance -->
	<div class="container mb-5">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Browse Categories</div>
					<ul class="main-categories">
						<li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable"
								aria-expanded="false" aria-controls="fruitsVegetable"><span
									class="lnr lnr-arrow-right"></span>Fruits and Vegetables<span
									class="number">(53)</span></a>
							<ul class="collapse" id="fruitsVegetable" data-toggle="collapse" aria-expanded="false"
								aria-controls="fruitsVegetable">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>

						<li class="main-nav-list"><a data-toggle="collapse" href="#meatFish" aria-expanded="false"
								aria-controls="meatFish"><span class="lnr lnr-arrow-right"></span>Meat and Fish<span
									class="number">(53)</span></a>
							<ul class="collapse" id="meatFish" data-toggle="collapse" aria-expanded="false"
								aria-controls="meatFish">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#cooking" aria-expanded="false"
								aria-controls="cooking"><span class="lnr lnr-arrow-right"></span>Cooking<span
									class="number">(53)</span></a>
							<ul class="collapse" id="cooking" data-toggle="collapse" aria-expanded="false"
								aria-controls="cooking">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#beverages" aria-expanded="false"
								aria-controls="beverages"><span class="lnr lnr-arrow-right"></span>Beverages<span
									class="number">(24)</span></a>
							<ul class="collapse" id="beverages" data-toggle="collapse" aria-expanded="false"
								aria-controls="beverages">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#homeClean" aria-expanded="false"
								aria-controls="homeClean"><span class="lnr lnr-arrow-right"></span>Home and
								Cleaning<span class="number">(53)</span></a>
							<ul class="collapse" id="homeClean" data-toggle="collapse" aria-expanded="false"
								aria-controls="homeClean">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>
						<li class="main-nav-list"><a href="#">Pest Control<span class="number">(24)</span></a></li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#officeProduct" aria-expanded="false"
								aria-controls="officeProduct"><span class="lnr lnr-arrow-right"></span>Office
								Products<span class="number">(77)</span></a>
							<ul class="collapse" id="officeProduct" data-toggle="collapse" aria-expanded="false"
								aria-controls="officeProduct">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#beauttyProduct" aria-expanded="false"
								aria-controls="beauttyProduct"><span class="lnr lnr-arrow-right"></span>Beauty
								Products<span class="number">(65)</span></a>
							<ul class="collapse" id="beauttyProduct" data-toggle="collapse" aria-expanded="false"
								aria-controls="beauttyProduct">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#healthProduct" aria-expanded="false"
								aria-controls="healthProduct"><span class="lnr lnr-arrow-right"></span>Health
								Products<span class="number">(29)</span></a>
							<ul class="collapse" id="healthProduct" data-toggle="collapse" aria-expanded="false"
								aria-controls="healthProduct">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>
						<li class="main-nav-list"><a href="#">Pet Care<span class="number">(29)</span></a></li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#homeAppliance" aria-expanded="false"
								aria-controls="homeAppliance"><span class="lnr lnr-arrow-right"></span>Home
								Appliances<span class="number">(15)</span></a>
							<ul class="collapse" id="homeAppliance" data-toggle="collapse" aria-expanded="false"
								aria-controls="homeAppliance">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
								</li>
							</ul>
						</li>
						<li class="main-nav-list"><a class="border-bottom-0" data-toggle="collapse" href="#babyCare"
								aria-expanded="false" aria-controls="babyCare"><span
									class="lnr lnr-arrow-right"></span>Baby Care<span class="number">(48)</span></a>
							<ul class="collapse" id="babyCare" data-toggle="collapse" aria-expanded="false"
								aria-controls="babyCare">
								<li class="main-nav-list child"><a href="#">Frozen Fish<span
											class="number">(13)</span></a></li>
								<li class="main-nav-list child"><a href="#">Dried Fish<span
											class="number">(09)</span></a></li>
								<li class="main-nav-list child"><a href="#">Fresh Fish<span
											class="number">(17)</span></a></li>
								<li class="main-nav-list child"><a href="#">Meat Alternatives<span
											class="number">(01)</span></a></li>
								<li class="main-nav-list child"><a href="#" class="border-bottom-0">Meat<span
											class="number">(11)</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select>
							<option value="1">Programing</option>
							<option value="1">Desain dan Video Editor</option>
							<option value="1">Ide Menulis</option>
						</select>
					</div>
					<div class="sorting mr-auto">
						<select>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select>
					</div>
					<div class="pagination">
						<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<a href="#" class="active">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
						<a href="#">6</a>
						<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						<div class="col-lg-4 col-md-6">
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
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>

						<!-- single product -->
						<div class="col-lg-4 col-md-6">
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
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>

						<!-- single product -->
						<div class="col-lg-4 col-md-6">
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
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>

						<!-- single product -->
						<div class="col-lg-4 col-md-6">
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
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>

						<!-- single product -->
						<div class="col-lg-4 col-md-6">
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
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>

						<!-- single product -->
						<div class="col-lg-4 col-md-6">
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
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
						<select>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select>
					</div>
					<div class="pagination">
						<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<a href="#" class="active">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
						<a href="#">6</a>
						<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
	<!-- freelance -->

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
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
											type="text">
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
					<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is
					made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
						target="_blank">Colorlib</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<!-- Modal Quick Product View -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="container relative">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="product-quick-view">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="quick-view-carousel">
								<div class="item" style="background: url(/assets/img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(/assets/img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(/assets/img/organic-food/q1.jpg);">

								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="quick-view-content">
								<div class="top">
									<h3 class="head">Mill Oil 1000W Heater, White</h3>
									<div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span
											class="ml-10">$149.99</span></div>
									<div class="category">Category: <span>Household</span></div>
									<div class="available">Availibility: <span>In Stock</span></div>
								</div>
								<div class="middle">
									<p class="content">Mill Oil is an innovative oil filled radiator with the most
										modern technology. If you are
										looking for something that can make your interior look awesome, and at the same
										time give you the pleasant
										warm feeling during the winter.</p>
									<a href="#" class="view-full">View full Details <span
											class="lnr lnr-arrow-right"></span></a>
								</div>
								<div class="bottom">
									<div class="color-picker d-flex align-items-center">Color:
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
									</div>
									<div class="quantity-container d-flex align-items-center mt-15">
										Quantity:
										<input type="text" class="quantity-amount ml-15" value="1" />
										<div class="arrow-btn d-inline-flex flex-column">
											<button class="increase arrow" type="button" title="Increase Quantity"><span
													class="lnr lnr-chevron-up"></span></button>
											<button class="decrease arrow" type="button" title="Decrease Quantity"><span
													class="lnr lnr-chevron-down"></span></button>
										</div>

									</div>
									<div class="d-flex mt-20">
										<a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
		integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
		crossorigin="anonymous"></script>
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