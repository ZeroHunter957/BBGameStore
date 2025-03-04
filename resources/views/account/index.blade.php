@extends('layouts.admin')

@section('title', 'Account List')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        thead {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            color: white;
        }
        th, td {
            padding: 15px;
            text-align: center;
            transition: background 0.3s ease;
        }
        tr:hover {
            background: rgba(78, 84, 200, 0.1);
            transform: scale(1.01);
        }
        .status-active {
            color: white;
            background: #28a745;
            padding: 5px 10px;
            border-radius: 8px;
        }
        .status-inactive {
            color: white;
            background: #dc3545;
            padding: 5px 10px;
            border-radius: 8px;
        }
    </style>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Account List</h2>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="status-active">Active</span>
                                    @else
                                        <span class="status-inactive">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
