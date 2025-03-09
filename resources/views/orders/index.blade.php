@extends('layouts.admin')

@section('title', 'Game List')

@section('content')
<div class="container">
    <h2 class="mb-4">Order Management</h2>

    <form method="GET" action="{{ route('orders.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by Game Title or User Name" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Game</th>
                <th>Price</th>
                <th>Purchased Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libraries as $library)
            <tr>
                <td>{{ $library->id }}</td>
                <td>{{ $library->account->fullname }}</td>
                <td>{{ $library->game->title }}</td>
                <td>${{ number_format($library->game->price, 2, '.', ',') }}</td>
                <td>{{ $library->created_at->format('m/d/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $libraries->links() }}
    </div>

</div>
@endsection