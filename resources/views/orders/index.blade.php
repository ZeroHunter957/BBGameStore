<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')

<style>
    /* General styles */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #007bff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 30px;
    }

    /* Search & Filter Form */
    form {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }

    form .form-control, form .form-select {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    form .form-control:focus, form .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
    }

    .btn-primary {
        border-radius: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        color: white;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #004494);
        transform: scale(1.05);
    }

    /* Orders Table */
    .table-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 10px;
    }

    .table th, .table td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .table thead th {
        background: #007bff;
        color: white;
        text-transform: uppercase;
    }

    .table tbody tr {
        transition: 0.3s ease;
    }

    .table tbody tr:hover {
        background: #f1f1f1;
        transform: scale(1.01);
    }

    /* Order status */
    .badge {
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
    }

    .status-pending {
        background: #ffc107;
        color: black;
    }

    .status-processed {
        background: #28a745;
        color: white;
    }

    .status-canceled {
        background: #dc3545;
        color: white;
    }

    /* Action Buttons */
    .btn-sm {
        border-radius: 5px;
        transition: 0.3s;
        padding: 6px 12px;
    }

    .btn-sm:hover {
        transform: scale(1.05);
    }

    /* Fade-in animation */
    .fade-in {
        opacity: 0;
        transform: translateY(10px);
        animation: fadeInUp 0.5s ease-in-out forwards;
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@section('content')
<div class="container">
    <h2 class="mb-4">Order Management</h2>
    
    <!-- Search & Filter -->
    <form method="GET" action="{{ route('orders.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by ID or Customer Name" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Filter by Status --</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Processed</option>
                    <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    
    <!-- Orders Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Products</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        @foreach ($order->items as $item)
                            {{ $item->product->name }} (x{{ $item->quantity }})<br>
                        @endforeach
                    </td>
                    <td>{{ number_format($order->total, 2, '.', ',') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->format('m/d/Y') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>
@endsection
