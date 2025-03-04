@extends('layouts.admin')
@section('title', 'Comment List Page')

@section('content')

<style>
    /* --- Cấu hình tổng thể --- */
body {
    background-color: #f4f7fa;
    font-family: 'Poppins', sans-serif;
}

/* --- Hiệu ứng input --- */
.input-group input,
.form-control {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease-in-out;
}

.input-group input:focus,
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.4);
}

/* --- Hiệu ứng nút bấm --- */
.btn {
    border-radius: 10px;
    transition: all 0.3s ease-in-out;
    font-weight: 600;
    padding: 8px 14px;
}

.btn-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
    border: none;
    color: #fff;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #0056b3, #003f7f);
    transform: scale(1.05);
}

.btn-danger {
    background: linear-gradient(45deg, #ff3e3e, #c30000);
    border: none;
    color: #fff;
}

.btn-danger:hover {
    background: linear-gradient(45deg, #c30000, #8b0000);
    transform: scale(1.05);
}

.btn-info {
    background: linear-gradient(45deg, #17a2b8, #117a8b);
    border: none;
    color: white;
}

.btn-info:hover {
    background: linear-gradient(45deg, #117a8b, #0c5d6f);
    transform: scale(1.05);
}

/* --- Hiệu ứng bảng --- */
.table {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    background: white;
}

.table thead {
    background-color: #343a40;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

.table tbody tr {
    transition: all 0.3s ease-in-out;
}

.table tbody tr:hover {
    background: linear-gradient(45deg, #f1f1f1, #e3e3e3);
    transform: scale(1.02);
}

/* --- Hiệu ứng cảnh báo từ cấm --- */
.text-danger {
    font-weight: bold;
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0% { transform: translateX(0px); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0px); }
}

</style>
    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Comments List</h2>
        </div>

        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong> {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('comments.index') }}" method="GET" class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search comments..." class="form-control d-inline-block w-25">
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Content</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Blog</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>
                                        @if(isset($comment->has_banned_word) && $comment->has_banned_word)
                                            <span class="text-danger">This comment contains banned words!</span><br>
                                        @endif
                                        {{ $comment->content }}
                                    </td>
                                    <td>{{ $comment->account->fullname }}</td>
                                    <td>{{ $comment->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('blogusers.show', $comment->blog_id) }}" class="btn btn-info btn-sm" target="_blank">View Blog</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('comments.deleteByAdmin', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
