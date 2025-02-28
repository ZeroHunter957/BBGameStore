@extends('layouts.admin')
@section('title', 'Banned Words Management')

@section('content')
    <main class="content">
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
