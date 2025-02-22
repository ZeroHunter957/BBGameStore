@extends('layouts.admin')

@section('title', 'Game List')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Game List</h2>
            <a href="{{ route('game.create') }}" class="btn btn-primary">Create New Game</a>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Developer</th>
                        <th>Platform</th>
                        <th>Release Date</th>
                        <th>File</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($games as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td class="text-truncate" style="max-width: 200px;">{!! Str::limit(strip_tags($item->description), 50) !!}</td>
                            <td>{{ $item->developer }}</td>
                            <td>{{ $item->platform }}</td>
                            <td>{{ $item->release_date }}</td>
                            <td>
                                <a href="{{ asset($item->file) }}" class="btn btn-sm btn-success"
                                    target="_blank">Download</a>
                            </td>
                            <td>
                                <img src="{{ asset($item->image) }}" class="img-thumbnail" width="80" alt="Game Image">
                            </td>
                            <td>
                                <a href="{{ route('game.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <a href="{{ route('game.setTodaysPick', $item->id) }}" class="btn btn-primary btn-sm">
                                    Set as Today's Pick
                                </a>
                                @if ($item->todays_pick)
                                    <span class="badge bg-success">Today's Pick</span>
                                @endif
                                {{-- <form action="{{ route('game.delete', $item->id) }}" method="POST" class="d-inline">
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
