<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

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
			<!-- resources/views/banned-words/index.blade.php -->

			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Banned Words</strong> Management</h1>

					<form action="{{ route('words.store') }}" method="POST" class="mb-3">
						@csrf
						<div class="input-group">
							<input type="text" name="word" class="form-control" placeholder="Enter banned word" required>
							<button type="submit" class="btn btn-primary">Add</button>
						</div>
					</form>


					<div class="card flex-fill">
						<table class="table table-hover my-0">
							<thead>
								<tr>
									<th>ID</th>
									<th>Word</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($bannedWords as $bannedWord)
								<tr>
									<td>{{ $bannedWord->id }}</td>
									<td>{{ $bannedWord->word }}</td>
									<td>
										<form action="{{ route('words.destroy', $bannedWord->id) }}" method="POST" style="display:inline;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this banned word?')">Delete</button>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
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
	<script src="js/app.js"></script>
</body>

</html>