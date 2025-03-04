@extends('layouts.admin')
@section('title', 'Comment List Page')

@section('content')

    <style>
        /* --- Cấu hình tổng thể --- */
body {
    background-color: #f4faff;
    font-family: 'Poppins', sans-serif;
}

/* --- Hiệu ứng input tìm kiếm --- */
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
    box-shadow: 0px 0px 12px rgba(0, 123, 255, 0.5);
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
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    background: white;
}

.table thead {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

.table tbody tr {
    transition: all 0.3s ease-in-out;
}

.table tbody tr:hover {
    background: linear-gradient(45deg, #e6f2ff, #d0e7ff);
    transform: scale(1.02);
}

/* --- Hiển thị Star Rating đẹp hơn --- */
.star-rating {
    font-size: 18px;
    color: #f1c40f; /* Màu vàng */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

    </style>
    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Feedback List</h2>
        </div>

        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong> {{ session('message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Content</th>
                                <th>Star</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Game</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedbacks as $feedback)
                                <tr>
                                    <td>{{ $feedback->id }}</td>
                                    <td>
                                        {{ $feedback->content }}
                                    </td>
                                    <td>
                                        {{ $feedback->star }}
                                    </td>
                                    <td>{{ $feedback->account->fullname }}</td>
                                    <td>{{ $feedback->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('menu.gamedetails', $feedback->game->id) }}" class="btn btn-info btn-sm" target="_blank">View Game</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('feedbacks.deleteByAdmin', $feedback->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</button>
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
