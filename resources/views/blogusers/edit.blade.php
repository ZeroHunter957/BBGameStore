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

<main class="content">
	<div class="container-fluid p-0">
		<form id="editArticleForm" action="{{ route('blogusers.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" id="title" value="{{ $blog->title }}" required>
			</div>

			<div class="mb-3">
				<label for="content" class="form-label">Content</label>
				<div id="content" class="form-control" required>{!! $blog->content !!}</div>
			</div>

			<div class="mb-3">
				<label for="image" class="form-label">Image</label>
				<input type="file" class="form-control" name="image" id="image" accept="image/*">

				@if($blog->image)
				<img src="{{ asset('storage/' . $blog->image) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-width: 200px;">
				@endif
			</div>

			<button type="submit" class="btn btn-primary">Update Blog</button>
		</form>
	</div>
</main>
<footer>
	<div class="container">
		<div class="col-lg-12">
			<p>Copyright © 2048 LUGX Gaming Company. All rights reserved. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: TemplateMo</a></p>
		</div>
	</div>
</footer>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/counter.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>

<!-- jQuery CDN (optional, if you need it for other purposes) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JavaScript (optional, for Bootstrap components like modals, tooltips) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional: Fetch Polyfill (If needed for older browsers, but most modern browsers support Fetch) -->
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

		document.getElementById('editArticleForm').addEventListener('submit', function(e) {
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

			fetch('{{ route("blogusers.update", $blog->id) }}', {
					method: 'POST',
					body: formData,
					headers: {
						'X-CSRF-TOKEN': csrfToken,
					},
				})
				.then(response => response.text())
				.then(data => {
					try {
						const jsonResponse = JSON.parse(data);
						if (jsonResponse.errors) {

						} else {
							window.location.href = '/blogusers';
						}
					} catch (error) {

						window.location.href = '/blogusers';
					}
				})
				.catch(error => {
					console.error('Error updating blog:', error);
				});

		});
	});
</script>
@endsection