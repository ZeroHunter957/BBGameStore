@extends('layouts.user')
@section('title', 'list page')

@section('content')

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
				<a class="is_active" href="javascript:void(0);" data-filter="*" onclick="filterBlogs('all')">Show All</a>
			</li>
			<li>
				<a href="javascript:void(0);" data-filter=".adv" onclick="filterBlogs('my-blogs')">My Blogs</a>
			</li>
		</ul>

		<a href="{{ route('blogusers.create') }}" class="btn btn-success">Create New Blog</a>

		<form action="{{ route('blogusers.index') }}" method="GET" class="mb-4">
			<input type="text" name="search" value="{{ request()->search }}" placeholder="Search Blogs..." class="form-control">
			<button type="submit" class="btn btn-primary mt-2">Search</button>
		</form>

		<div class="row trending-box">
			@foreach($latestBlogs as $blog)
			<div class="col-lg-3 col-md-6 mb-30 trending-items">
				<div class="item">
					<div class="thumb">
						<a href="{{ route('blogusers.show', $blog->id) }}">
							<img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="fixed-image">
						</a>
					</div>
					<div class="down-content mt-3">
						<span class="category text-muted">{{ $blog->category ?? 'General' }}</span>
						<h4 class="mt-2">{{ $blog->title }}</h4>
						<p class="text-muted">Created on {{ $blog->created_at->format('M d, Y') }}</p>

						@if(Auth::check() && $blog->user_id == Auth::id())
						<div class="mt-3">
							<a href="{{ route('blogusers.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
						</div>
						@endif
					</div>
				</div>
			</div>
			@endforeach
		</div>

		<script>
			function filterBlogs(filter) {
				let url = new URL(window.location.href);
				url.searchParams.set('filter', filter); // Set the filter parameter in the URL
				window.location.href = url.toString(); // Redirect to the new URL, which will reload the page
			}
		</script>


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
@endsection