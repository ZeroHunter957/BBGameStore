@extends('layouts.admin')
@section('content')
    <div class="container mt-3">
        <style>
            /* Toàn bộ container */
.container {
    max-width: 100%;
    margin: 0 auto;
    padding: 30px;
    background-color: #f8f9fa;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

/* Hiệu ứng hover cho container */
.container:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

/* Tiêu đề Coupon List */
h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    text-align: left;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-out;
}

/* Hiệu ứng fade-in cho tiêu đề */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Bảng */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: fadeInTable 1s ease-out;
}

/* Hiệu ứng hover cho bảng */
.table:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Hiệu ứng fade-in cho bảng */
@keyframes fadeInTable {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Tiêu đề của bảng */
.table thead {
    background: linear-gradient(90deg, #1f2d3d, #343a40);
    color: white;
    font-weight: bold;
    text-align: center;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 15px;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.2);
}

/* Căn chỉnh các cột trong bảng */
.table td, .table th {
    padding: 15px;
    text-align: center;
    vertical-align: middle;
}

/* Chỉnh sửa màu nền các hàng trong bảng */
.table tbody tr {
    transition: all 0.3s ease-in-out;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
    transform: scale(1.02);
}

/* Đặt màu nền cho các hàng lẻ và chẵn */
.table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table tbody tr:nth-child(even) {
    background-color: #ffffff;
}

/* Nút "Set as Today's Pick" */
.btn-sm {
    padding: 8px 15px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

/* Nút "Edit" */
.btn-warning {
    background: linear-gradient(135deg, #ffb900, #ff8c00);
    color: #212529;
    box-shadow: 0 4px 8px rgba(255, 140, 0, 0.2);
}

.btn-warning:hover {
    background: linear-gradient(135deg, #e0a800, #ff7100);
    box-shadow: 0 6px 12px rgba(255, 140, 0, 0.3);
    transform: translateY(-2px);
}

/* Nút "Delete" */
.btn-danger {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #c82333, #b21e2d);
    box-shadow: 0 6px 12px rgba(220, 53, 69, 0.3);
    transform: translateY(-2px);
}

/* Cột "Code" */
.table td:nth-child(2) {
    font-weight: 600;
    color: #007bff;
}

/* Cột "Discount" */
.table td:nth-child(3) {
    color: #ff5733;
    font-weight: 600;
}

/* Cột "Status" */
.table td:nth-child(6) {
    font-weight: 600;
    color: #28a745;
}

/* Chỉnh sửa chữ Pending */
.form-select {
    padding-left: 15px;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

/* Hiệu ứng hover cho dropdown */
.form-select:hover {
    border-color: #007bff;
    background-color: #e9ecef;
}

/* Hiệu ứng hover cho nút "Delete" */
.table td .btn-danger {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.table td .btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(220, 53, 69, 0.3);
}

/* Nút "Create New Coupon" */
.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    font-weight: 500;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
    transform: translateY(-2px);
}

        </style>
        <h2>Coupon List</h2>
        <a href="{{ route('coupon.create') }}" class="mb-3 btn btn-primary">Create New Coupon</a>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Discount (%)</th>
                    <th>Valid From</th>
                    <th>Valid To</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        {{-- <td>{{ $coupon->id }}</td> --}}
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->discount_percent }}%</td>
                        <td>{{ $coupon->valid_from ?? 'N/A' }}</td>
                        <td>{{ $coupon->valid_to ?? 'N/A' }}</td>
                        {{-- <td>{{ $coupon->is_active ? 'Active' : 'Inactive' }}</td> --}}
                        <td>
                            <span class="{{ $coupon->status == 'Active' ? 'text-success' : 'text-danger' }}">
                                {{ $coupon->status }}
                            </span>
                        </td>
                        
                        <td>
                            <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('coupon.selectRecipients', ['id' => $coupon->id]) }}" class="btn btn-primary">Send</a>

                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
