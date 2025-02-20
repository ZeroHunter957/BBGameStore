<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<title>Lugx Gaming - Product Detail</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/templatemo-lugx-gaming.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
	<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>

	<!-- jQuery CDN (optional, if you need it for other purposes) -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Bootstrap 5 JavaScript (optional, for Bootstrap components like modals, tooltips) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Optional: Fetch Polyfill (If needed for older browsers, but most modern browsers support Fetch) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/whatwg-fetch/3.6.2/fetch.min.js"></script>


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
						<a href="index.html" class="logo">
							<img src="assets/images/logo.png" alt="" style="width: 158px;">
						</a>
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
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- ***** Header Area End ***** -->
	<br>
	<br>
	<br>

	<main class="content py-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<h2 class="text-center mb-4">Create New Blog Post</h2>
					<form id="createArticleForm" action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="mb-3">
							<label for="title" class="form-label">Title</label>
							<input type="text" class="form-control" name="title" id="title" required>
						</div>

						<div class="mb-3">
							<label for="content" class="form-label">Content</label>
							<div id="content" class="form-control" required></div>
						</div>

						<div class="mb-3">
							<label for="image" class="form-label">Image</label>
							<input type="file" class="form-control" name="image" id="image" accept="image/*">
						</div>

						<button type="submit" class="btn btn-primary w-100">Create Blog</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<!-- Footer -->
	<footer class="bg-dark text-white py-4">
		<div class="container text-center">
			<p>Copyright © 2048 LUGX Gaming Company. All rights reserved. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank" class="text-white">Design: TemplateMo</a></p>
		</div>
	</footer>

	<!-- Bootstrap and Custom Scripts -->
	<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
	<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
	<script src="{{ asset('assets/js/counter.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			let editor;

			ClassicEditor
				.create(document.querySelector('#content'))
				.then(editorInstance => {
					editor = editorInstance;
				})
				.catch(error => {
					console.error('Error initializing CKEditor:', error);
				});

			const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

			document.getElementById('createArticleForm').addEventListener('submit', function(e) {
				e.preventDefault();

				const articleData = {
					title: document.getElementById('title').value,
					content: editor ? editor.getData() : '',
					image: document.getElementById('image').files[0],
				};

				const formData = new FormData();
				formData.append('title', articleData.title);
				formData.append('content', articleData.content);
				formData.append('image', articleData.image);

				fetch('{{ route("shop.store") }}', {
						method: 'POST',
						body: formData,
						headers: {
							'X-CSRF-TOKEN': csrfToken,
						},
					})
					.then(response => response.json())
					.then(data => {
						if (data.errors) {
							console.error('Validation errors:', data.errors);
						} else {
							console.log('Blog created successfully:', data);
							window.location.href = '/shop';
						}
					})
					.catch(error => {
						console.error('Error creating blog:', error);
					});

			});
		});
	</script>
</body>

</html>