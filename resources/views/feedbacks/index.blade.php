@extends('layouts.admin')
@section('title', 'Comment List Page')

@section('content')
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
                                    <td>{{ $feedback->user->name }}</td>
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
