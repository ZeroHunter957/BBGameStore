@extends('layouts.user')
@section('title', 'list page')

@section('content')
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="content py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h2 class="text-center mb-4">Create New Blog Post</h2>
				<form id="createArticleForm" action="{{ route('blogusers.store') }}" method="POST" enctype="multipart/form-data">
					@csrf

					<!-- Title Field -->
					<div class="mb-3">
						<label for="title" class="form-label">Blog Title</label>
						<input type="text" class="form-control" name="title" id="title" placeholder="Enter the title" required>
					</div>

					<!-- Content Field (CKEditor) -->
					<div class="mb-3">
						<label for="content" class="form-label">Content</label>
						<div id="content" class="form-control" style="min-height: 200px;" required></div>
					</div>

					<!-- Image Upload Field -->
					<div class="mb-3">
						<label for="image" class="form-label">Blog Image</label>
						<input type="file" class="form-control" name="image" id="image" accept="image/*">
					</div>

					<!-- Submit Button -->
					<button type="submit" class="btn btn-primary btn-lg w-100">Create Blog</button>
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
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/whatwg-fetch/3.6.2/fetch.min.js"></script>
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

			fetch('{{ route("blogusers.store") }}', {
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
						window.location.href = '/blogusers';
					}
				})
				.catch(error => {
					console.error('Error creating blog:', error);
					window.location.href = '/blogusers';

				});
		});
	});
</script>
@endsection