@extends('layouts.admin')
@section('title', 'Blog List Page')

@section('content')
<style>
    .custom-pagination {
        list-style: none;
        padding: 0;
        margin: 20px 0;
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
</style>
<div class="container-fluid mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Blogs List</h2>
        <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create a new Blog</a>
    </div>

    @if (session('message'))
    <div class="alert alert-info">
        <strong>Info!</strong> {{ session('message') }}
    </div>
    @endif

    <form action="{{ route('blogs.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search blogs..." class="form-control d-inline-block w-25">
        <button type="submit" class="btn btn-primary ml-2">Search</button>
    </form>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill w-100">
                <div class="table-responsive">
                    <table class="table table-hover my-0 w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th class="d-none d-xl-table-cell">Created At</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="width: 100px; height: auto;">
                                </td>
                                <td>
                                    {{ $blog->status == 2 ? $blog->title_cache : $blog->title }}
                                </td>
                                <td class="d-none d-xl-table-cell">{{ $blog->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('blogs.updateStatus', $blog->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-control form-control-sm" onchange="this.form.submit()"
                                            @if($blog->status == 1 || $blog->status == 2) disabled @endif>
                                            <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Accepted</option>
                                            <option value="2" {{ $blog->status == 2 ? 'selected' : '' }}>Reject</option>
                                        </select>

                                        <div class="form-group mt-2">
                                            <label for="note">Admin Note</label>
                                            <textarea name="note" class="form-control" placeholder="Enter note" rows="3"></textarea>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const statusSelect = document.getElementById('status');
                        const noteModal = new bootstrap.Modal(document.getElementById('noteModal'));
                        const noteForm = document.getElementById('noteForm');
                        const noteTextarea = document.getElementById('note');
                        const submitButton = document.getElementById('submitNoteButton');

                        statusSelect.addEventListener('change', function() {
                            const selectedStatus = statusSelect.value;

                            if (selectedStatus == '1' || selectedStatus == '2') {
                                noteModal.show();

                                document.getElementById('statusInput').value = selectedStatus;
                            }
                        });

                        submitButton.addEventListener('click', function() {
                            if (noteTextarea.value.trim() === "") {
                                alert("Please enter a note before submitting.");
                                return;
                            }

                            noteForm.submit();
                        });
                    });
                </script>

                <!-- Pagination -->
                <!-- Pagination -->
                <div class="custom-pagination d-flex justify-content-center">
                    @if ($blogs->onFirstPage())
                    <span class="page-item disabled">Previous</span>
                    @else
                    <a href="{{ $blogs->previousPageUrl() }}" class="page-item">Previous</a>
                    @endif

                    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="page-item {{ $page == $blogs->currentPage() ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                    @endforeach

                    @if ($blogs->hasMorePages())
                    <a href="{{ $blogs->nextPageUrl() }}" class="page-item">Next</a>
                    @else
                    <span class="page-item disabled">Next</span>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection