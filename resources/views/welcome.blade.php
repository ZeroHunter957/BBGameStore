<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

	<title>Lugx Gaming Shop HTML5 Template</title>

	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/css/templatemo-lugx-gaming.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

	<style>
		.item {
			position: relative;
		}

		.thumb img {
			width: 100%;
			height: auto;
			border-radius: 10px;
		}

		.price {
			background-color: #f39c12;
			color: white;
			padding: 5px;
			position: absolute;
			top: 10px;
			left: 10px;
			font-size: 16px;
		}

		.category {
			font-size: 14px;
			font-weight: 600;
		}

		h4 {
			font-size: 18px;
			font-weight: 600;
		}

		.down-content p {
			font-size: 14px;
			color: #666;
		}
	</style>

</head>

<body>

	<div id="js-preloader" class="js-preloader">
		<div class="preloader-inner">
			<span class="dot"></span>
			<div class="dots">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<header class="header-area header-sticky">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="main-nav">
						<!-- ***** Logo Start ***** -->
						<a href="index.html" class="logo">
							<img src="assets/images/logo.png" alt="" style="width: 158px;">
						</a>
						<!-- ***** Logo End ***** -->
						<!-- ***** Menu Start ***** -->
						<ul class="nav">
							<li><a href="{{ route('home') }}">Home</a></li>
							<li><a href="#">Games</a></li>
							<li><a href="{{ route('shop.index') }}" class="active">Blogs</a></li>
							<li><a href="contact.html">Contact</a></li>

							@if (Auth::check())
							<li><a href="{{ route('logout') }}">Log Out</a></li>
							@else
							<li><a href="{{ route('login') }}">Sign In</a></li>
							@endif
						</ul>
						<a class='menu-trigger'>
							<span>Menu</span>
						</a>
						<!-- ***** Menu End ***** -->
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- ***** Header Area End ***** -->

	<div class="main-banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 align-self-center">
					<div class="caption header-text">
						<h6>Welcome to lugx</h6>
						<h2>BEST GAMING SITE EVER!</h2>
						<p>LUGX Gaming is free Bootstrap 5 HTML CSS website template for your gaming websites. You can download and use this layout for commercial purposes. Please tell your friends about TemplateMo.</p>
						<div class="search-input">
							<form id="search" action="#">
								<input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
								<button role="button">Search Now</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-4 offset-lg-2">
					<div class="right-image">
						<img src="assets/images/banner-image.jpg" alt="">
						<span class="price">$22</span>
						<span class="offer">-40%</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="features">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<a href="#">
						<div class="item">
							<div class="image">
								<img src="assets/images/featured-01.png" alt="" style="max-width: 44px;">
							</div>
							<h4>Free Storage</h4>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-6">
					<a href="#">
						<div class="item">
							<div class="image">
								<img src="assets/images/featured-02.png" alt="" style="max-width: 44px;">
							</div>
							<h4>User More</h4>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-6">
					<a href="#">
						<div class="item">
							<div class="image">
								<img src="assets/images/featured-03.png" alt="" style="max-width: 44px;">
							</div>
							<h4>Reply Ready</h4>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-6">
					<a href="#">
						<div class="item">
							<div class="image">
								<img src="assets/images/featured-04.png" alt="" style="max-width: 44px;">
							</div>
							<h4>Easy Layout</h4>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="section trending">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-heading">
						<h6>Trending</h6>
						<h2>Trending Blogs</h2>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="main-button">
						<a href="{{ route('blogs.index') }}">View All</a>
					</div>
				</div>

				@foreach ($latestBlogs as $blog)
				<div class="col-lg-3 col-md-6 mb-4">
					<div class="item">
						<div class="thumb">
							<a href="{{ route('blogs.detail', $blog->id) }}">
								<img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded"> <!-- Added img-fluid for responsive images -->
							</a>
							@if($blog->image)
							<span class="badge bg-success text-white position-absolute top-0 start-0 m-2">New</span> <!-- Use badge for better positioning -->
							@endif
						</div>
						<div class="down-content mt-3"> <!-- Added margin-top to space out the text -->
							<span class="category text-muted">{{ $blog->category ?? 'General' }}</span> <!-- Add category if available or default 'General' -->
							<h4 class="mt-2">{{ $blog->title }}</h4>
							<p class="text-muted">Created on {{ $blog->created_at->format('M d, Y') }}</p> <!-- Display date with format -->
						</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>


	<div class="section most-played">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-heading">
						<h6>TOP GAMES</h6>
						<h2>Most Played</h2>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="main-button">
						<a href="shop.html">View All</a>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="item">
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/top-game-01.jpg" alt=""></a>
						</div>
						<div class="down-content">
							<span class="category">Adventure</span>
							<h4>Assasin Creed</h4>
							<a href="product-details.html">Explore</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="item">
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/top-game-02.jpg" alt=""></a>
						</div>
						<div class="down-content">
							<span class="category">Adventure</span>
							<h4>Assasin Creed</h4>
							<a href="product-details.html">Explore</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="item">
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/top-game-03.jpg" alt=""></a>
						</div>
						<div class="down-content">
							<span class="category">Adventure</span>
							<h4>Assasin Creed</h4>
							<a href="product-details.html">Explore</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="item">
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/top-game-04.jpg" alt=""></a>
						</div>
						<div class="down-content">
							<span class="category">Adventure</span>
							<h4>Assasin Creed</h4>
							<a href="product-details.html">Explore</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="item">
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/top-game-05.jpg" alt=""></a>
						</div>
						<div class="down-content">
							<span class="category">Adventure</span>
							<h4>Assasin Creed</h4>
							<a href="product-details.html">Explore</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="item">
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/top-game-06.jpg" alt=""></a>
						</div>
						<div class="down-content">
							<span class="category">Adventure</span>
							<h4>Assasin Creed</h4>
							<a href="product-details.html">Explore</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section categories">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-heading">
						<h6>Categories</h6>
						<h2>Top Categories</h2>
					</div>
				</div>
				<div class="col-lg col-sm-6 col-xs-12">
					<div class="item">
						<h4>Action</h4>
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/categories-01.jpg" alt=""></a>
						</div>
					</div>
				</div>
				<div class="col-lg col-sm-6 col-xs-12">
					<div class="item">
						<h4>Action</h4>
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/categories-05.jpg" alt=""></a>
						</div>
					</div>
				</div>
				<div class="col-lg col-sm-6 col-xs-12">
					<div class="item">
						<h4>Action</h4>
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/categories-03.jpg" alt=""></a>
						</div>
					</div>
				</div>
				<div class="col-lg col-sm-6 col-xs-12">
					<div class="item">
						<h4>Action</h4>
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/categories-04.jpg" alt=""></a>
						</div>
					</div>
				</div>
				<div class="col-lg col-sm-6 col-xs-12">
					<div class="item">
						<h4>Action</h4>
						<div class="thumb">
							<a href="product-details.html"><img src="assets/images/categories-05.jpg" alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section cta">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="shop">
						<div class="row">
							<div class="col-lg-12">
								<div class="section-heading">
									<h6>Our Shop</h6>
									<h2>Go Pre-Order Buy & Get Best <em>Prices</em> For You!</h2>
								</div>
								<p>Lorem ipsum dolor consectetur adipiscing, sed do eiusmod tempor incididunt.</p>
								<div class="main-button">
									<a href="shop.html">Shop Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-2 align-self-end">
					<div class="subscribe">
						<div class="row">
							<div class="col-lg-12">
								<div class="section-heading">
									<h6>NEWSLETTER</h6>
									<h2>Get Up To $100 Off Just Buy <em>Subscribe</em> Newsletter!</h2>
								</div>
								<div class="search-input">
									<form id="subscribe" action="#">
										<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email...">
										<button type="submit">Subscribe Now</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer>
		<div class="container">
			<div class="col-lg-12">
				<p>Copyright © 2048 LUGX Gaming Company. All rights reserved. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: TemplateMo</a></p>
			</div>
		</div>
	</footer>

	<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

	<script src="{{ asset('js/isotope.min.js') }}"></script>
	<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
	<script src="{{ asset('assets/js/counter.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>