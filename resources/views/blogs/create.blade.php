<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/ui-forms.html" />

	<title>Forms | AdminKit Demo</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">AdminKit</span>
				</a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="{{ route(name: 'dashboard') }}">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-header">
						Management
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('blogs.index') }}">
							<i class="align-middle" data-feather="check-square"></i>
							<span class="align-middle">Games</span>
						</a>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('blogs.index') }}">
							<i class="align-middle" data-feather="check-square"></i>
							<span class="align-middle">Blogs</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('blogs.create') }}">
							<i class="align-middle" data-feather="plus-circle"></i>
							<span class="align-middle">Create Blog</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('words.index') }}">
							<i class="align-middle" data-feather="check-square"></i>
							<span class="align-middle">Từ cấm</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('comments.index') }}">
							<i class="align-middle" data-feather="check-square"></i>
							<span class="align-middle">Bình luận</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<main class="content">
				<div class="container-fluid p-0">
					<form id="createArticleForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
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
						<button type="submit" class="btn btn-primary">Create Blog</button>
					</form>
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>

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

				fetch('{{ route("blogs.store") }}', {
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
							window.location.href = '/blogs';
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