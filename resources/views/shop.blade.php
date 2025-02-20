<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

	<title>Lugx Gaming - Shop Page</title>

	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/css/templatemo-lugx-gaming.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
	<style>
		.pagination {
			justify-content: center;
			margin-top: 20px;
			margin-bottom: 20px;
		}

		.pagination .page-item {
			margin: 0 5px;
		}

		.pagination .page-link {
			border: 1px solid #ddd;
			padding: 10px 20px;
			font-size: 16px;
			color: #007bff;
			background-color: #fff;
			transition: background-color 0.3s, color 0.3s;
		}

		.pagination .page-link:hover {
			background-color: #007bff;
			color: #fff;
		}

		.pagination .page-item.active .page-link {
			background-color: #007bff;
			border-color: #007bff;
			color: white;
		}

		/* Disabled state */
		.pagination .page-item.disabled .page-link {
			color: #ccc;
			border-color: #ddd;
			pointer-events: none;
		}

		/* Add a little border radius for rounded corners */
		.pagination .page-link {
			border-radius: 5px;
		}

		.custom-pagination {
			display: flex;
			justify-content: center;
			gap: 10px;
			margin-top: 20px;
			margin-bottom: 20px;
		}

		/* Style the individual page items */
		.custom-pagination .page-item {
			display: inline-block;
			padding: 10px 15px;
			border: 1px solid #ddd;
			border-radius: 5px;
			color: #007bff;
			font-size: 16px;
			text-decoration: none;
			cursor: pointer;
			transition: background-color 0.3s, color 0.3s;
		}

		/* Hover effect for page items */
		.custom-pagination .page-item:hover {
			background-color: #007bff;
			color: white;
		}

		/* Active page styling */
		.custom-pagination .page-item.active {
			background-color: #007bff;
			color: white;
			border-color: #007bff;
		}

		/* Disabled page styling */
		.custom-pagination .page-item.disabled {
			color: #ccc;
			border-color: #ddd;
			pointer-events: none;
		}

		/* Pagination buttons (Previous/Next) */
		.custom-pagination .page-item {
			padding: 10px 20px;
			font-weight: bold;
		}

		/* Remove border-radius on first and last elements for a more linear look */
		.custom-pagination .page-item:first-child {
			border-radius: 5px 0 0 5px;
		}

		.custom-pagination .page-item:last-child {
			border-radius: 0 5px 5px 0;
		}
	</style>

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

	<!-- ***** Preloader Start ***** -->
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
	<!-- ***** Preloader End ***** -->

	<!-- ***** Header Area Start ***** -->
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

	<div class="page-heading header-text">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h3>Our Shop</h3>
					<span class="breadcrumb"><a href="#">Home</a> > Our Shop</span>
				</div>
			</div>
		</div>
	</div>

	<div class="section trending">
		<div class="container">
			<ul class="trending-filter">
				<li>
					<a class="is_active" href="#!" data-filter="*">Show All</a>
				</li>
				<li>
					<a href="#!" data-filter=".adv">Adventure</a>
				</li>
				<li>
					<a href="#!" data-filter=".str">Strategy</a>
				</li>
				<li>
					<a href="#!" data-filter=".rac">Racing</a>
				</li>
			</ul>
			<a href="{{ route('shop.create') }}" class="btn btn-success">Create New Blog</a>

			<form action="{{ route('shop.index') }}" method="GET" class="mb-4">
				<input type="text" name="search" value="{{ request()->search }}" placeholder="Search Blogs..." class="form-control">
				<button type="submit" class="btn btn-primary mt-2">Search</button>
			</form>

			<div class="row trending-box">
				@foreach($latestBlogs as $blog)
				<div class="col-lg-3 col-md-6 mb-30 trending-items">
					<div class="item">
						<div class="thumb">
							<a href="{{ route('blogs.detail', $blog->id) }}">
								<img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="fixed-image">
							</a>
						</div>
						<div class="down-content mt-3">
							<span class="category text-muted">{{ $blog->category ?? 'General' }}</span>
							<h4 class="mt-2">{{ $blog->title }}</h4>
							<p class="text-muted">Created on {{ $blog->created_at->format('M d, Y') }}</p>

							@if(Auth::check() && $blog->user_id == Auth::id())
							<div class="mt-3">
								<a href="{{ route('shop.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
							</div>
							@endif
						</div>
					</div>
				</div>
				@endforeach
			</div>

			<style>
				.thumb {
					width: 100%;
					height: 200px;
					/* Chiều cao cố định */
					overflow: hidden;
					/* Cắt ảnh thừa nếu có */
					display: flex;
					align-items: center;
					justify-content: center;
					background-color: #f8f9fa;
					/* Màu nền nếu ảnh không tải được */
				}

				.thumb img.fixed-image {
					width: 100%;
					height: 100%;
					object-fit: cover;
					/* Đảm bảo ảnh không méo, giữ tỷ lệ */
				}
			</style>


			<div class="custom-pagination d-flex justify-content-center">
				@if ($latestBlogs->onFirstPage())
				<span class="page-item disabled">Previous</span>
				@else
				<a href="{{ $latestBlogs->previousPageUrl() }}" class="page-item">Previous</a>
				@endif

				@foreach ($latestBlogs->getUrlRange(1, $latestBlogs->lastPage()) as $page => $url)
				<a href="{{ $url }}" class="page-item {{ $page == $latestBlogs->currentPage() ? 'active' : '' }}">
					{{ $page }}
				</a>
				@endforeach

				@if ($latestBlogs->hasMorePages())
				<a href="{{ $latestBlogs->nextPageUrl() }}" class="page-item">Next</a>
				@else
				<span class="page-item disabled">Next</span>
				@endif
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