@extends('layouts.admin')

@section('title', 'Accessory List')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Accessory List</h2>
            <a href="{{ route('accessory.create') }}" class="btn btn-primary">Create New Accessory</a>
        </div>

        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong> {{ session('message') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accessories as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                <img src="{{ asset($item->image) }}" class="img-thumbnail" width="80"
                                    alt="Accessory Image">
                            </td>
                            <td>
                                <a href="{{ route('accessory.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                {{-- <form action="{{ route('accessory.delete', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
