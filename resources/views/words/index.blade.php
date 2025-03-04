@extends('layouts.admin')
@section('title', 'Banned Words Management')

@section('content')
    <main class="content">

        <style>
            /* Làm đẹp toàn bộ giao diện */
body {
    background-color: #f8f9fa;
    font-family: 'Poppins', sans-serif;
}

/* Bảng */
.table {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    background: white;
}

.table thead {
    background-color: #343a40;
    color: white;
    font-weight: bold;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Ô input */
.input-group input,
.form-control {
    border-radius: 8px;
    padding: 10px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease-in-out;
}

.input-group input:focus,
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Nút bấm */
.btn {
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
    font-weight: 600;
}

.btn-primary {
    background-color: #007bff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #a71d2a;
    transform: scale(1.05);
}

        </style>
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Banned Words</strong> Management</h1>

            <form action="{{ route('words.store') }}" method="POST" class="mb-3">
                @csrf
                <div class="input-group">
                    <input type="text" name="word" class="form-control" placeholder="Enter banned word" required>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>

            <form action="{{ route('words.index') }}" method="GET" class="mb-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search banned words..." class="form-control d-inline-block w-25">
                <button type="submit" class="btn btn-primary ml-2">Search</button>
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
@endsection
