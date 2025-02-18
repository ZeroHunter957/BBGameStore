@extends('layouts.admin')
@section('title', 'list page')

@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Accessory Categories List</h2>
            <a href="{{ route('accessorycategory.create') }}" class="btn btn-primary">Create a new Accessory Category</a>
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
                        <th>Id</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accessorycategories as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
