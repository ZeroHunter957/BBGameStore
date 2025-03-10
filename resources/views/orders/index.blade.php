@extends('layouts.admin')

@section('title', 'Game List')

@section('content')

<style>
    /* Tổng thể container */
.container {
    background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
    color: #333;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

/* Tiêu đề */
h2 {
    font-size: 28px;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    letter-spacing: 1.5px;
    background: linear-gradient(to right, #007bff, #6610f2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Ô tìm kiếm */
input[type="text"] {
    background: white;
    border: 2px solid #ccc;
    color: #333;
    padding: 12px;
    border-radius: 10px;
    width: 100%;
    transition: 0.3s ease-in-out;
    font-size: 16px;
}

input[type="text"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 12px rgba(0, 123, 255, 0.5);
    outline: none;
}

/* Nút tìm kiếm */
.btn-primary {
    background: linear-gradient(to right, #007bff, #6610f2);
    border: none;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: bold;
    font-size: 16px;
    transition: 0.3s;
    color: white;
}

.btn-primary:hover {
    transform: scale(1.08);
    box-shadow: 0 0 18px rgba(0, 123, 255, 0.5);
}

/* Bảng dữ liệu */
table {
    width: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid #ddd;
}

/* Header bảng */
th {
    background: linear-gradient(to right, #007bff, #6610f2);
    color: white;
    padding: 14px;
    text-transform: uppercase;
    font-size: 16px;
}

/* Nội dung bảng */
td {
    padding: 14px;
    border-bottom: 2px solid #ddd;
    font-size: 15px;
}

/* Hover hiệu ứng cho từng dòng */
tbody tr:hover {
    background: rgba(0, 123, 255, 0.1);
    transform: scale(1.02);
    transition: all 0.3s ease-in-out;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    padding: 10px 14px;
    margin: 0 6px;
    background: #e9ecef;
    border-radius: 8px;
    color: #007bff;
    transition: 0.3s;
    font-weight: bold;
    text-decoration: none;
}

.pagination a:hover {
    background: linear-gradient(to right, #007bff, #6610f2);
    box-shadow: 0 0 15px rgba(0, 123, 255, 0.5);
    color: white;
}

</style>
<div class="container">
    <h2 class="mb-4">Order Management</h2>

    <form method="GET" action="{{ route('orders.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by Game Title or User Name" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Game</th>
                <th>Price</th>
                <th>Purchased Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libraries as $library)
            <tr>
                <td>{{ $library->id }}</td>
                <td>{{ $library->account->fullname }}</td>
                <td>{{ $library->game->title }}</td>
                <td>${{ number_format($library->game->price, 2, '.', ',') }}</td>
                <td>{{ $library->created_at->format('m/d/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $libraries->links() }}
    </div>

</div>
@endsection