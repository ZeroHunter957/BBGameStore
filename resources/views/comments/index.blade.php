@extends('layouts.admin')
@section('title', 'Comment List Page')

@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Comments List</h2>
        </div>

        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong> {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('comments.index') }}" method="GET" class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search comments..." class="form-control d-inline-block w-25">
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Content</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Blog</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>
                                        @if(isset($comment->has_banned_word) && $comment->has_banned_word)
                                            <span class="text-danger">This comment contains banned words!</span><br>
                                        @endif
                                        {{ $comment->content }}
                                    </td>
                                    <td>{{ $comment->account->fullname }}</td>
                                    <td>{{ $comment->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('blogusers.show', $comment->blog_id) }}" class="btn btn-info btn-sm" target="_blank">View Blog</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('comments.deleteByAdmin', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
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
