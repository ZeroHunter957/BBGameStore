@extends('layouts.user')
@section('title', 'list page')

@section('content')
<style>
	.custom-pagination {
		list-style: none;
		padding: 0;
		margin: 20px 0;
		display: flex;
		align-items: center;
	}

	.page-item {
		display: inline-block;
		margin: 0 5px;
		padding: 10px 15px;
		font-size: 14px;
		font-weight: 500;
		text-align: center;
		color: #007bff;
		background-color: #f8f9fa;
		border: 1px solid #ddd;
		border-radius: 5px;
		transition: background-color 0.3s ease, color 0.3s ease;
		cursor: pointer;
	}

	.page-item:hover {
		background-color: #007bff;
		color: #fff;
	}

	.page-item.active {
		background-color: #007bff;
		color: #fff;
		border-color: #007bff;
	}

	.page-item.disabled {
		color: #6c757d;
		background-color: #e9ecef;
		border-color: #ddd;
		cursor: not-allowed;
	}

	.page-item:first-child {
		border-radius: 5px 0 0 5px;
	}

	.page-item:last-child {
		border-radius: 0 5px 5px 0;
	}

	/* Additional Style for Spacing */
	.page-item+.page-item {
		margin-left: 5px;
	}

	/* Responsive Styles for Mobile */
	@media (max-width: 767px) {
		.page-item {
			font-size: 12px;
			padding: 8px 12px;
		}
	}

	.trending-items .item {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		height: 100%;
		padding: 15px;
		background: rgba(255, 255, 255, 0.2);
		border-radius: 10px;
		box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
		transition: transform 0.3s ease-in-out;
	}

	.trending-items .item:hover {
		transform: scale(1.05);
	}

	.trending-items .thumb img.fixed-image {
		width: 100%;
		height: 200px;
		/* Đặt chiều cao cố định cho ảnh */
		object-fit: cover;
		/* Giữ tỷ lệ ảnh mà không bị méo */
		border-radius: 10px;
	}

	.trending-items .down-content {
		flex-grow: 1;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		text-align: center;
	}

	.trending-items h4 {
		min-height: 50px;
		/* Đảm bảo tiêu đề không làm thay đổi kích thước */
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		/* Giới hạn số dòng hiển thị */
		-webkit-box-orient: vertical;
	}

	.trending-items p {
		font-size: 14px;
		color: #ddd;
	}

	.custom-pagination .page-item {
		background-color: #007bff;
		/* Màu xanh */
		color: white;
		padding: 8px 15px;
		margin: 0 5px;
		border-radius: 5px;
		text-decoration: none;
		transition: background 0.3s ease;
	}

	.custom-pagination .page-item:hover {
		background-color: #0056b3;
		/* Màu xanh đậm hơn khi hover */
	}

	.custom-pagination .page-item.active {
		background-color: #28a745;
		/* Màu xanh lá cho trang hiện tại */
		font-weight: bold;
	}

	.custom-pagination .page-item.disabled {
		background-color: #6c757d;
		/* Màu xám */
		cursor: not-allowed;
	}
</style>
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