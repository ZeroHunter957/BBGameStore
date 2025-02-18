@extends('layouts.user')
@section('title', 'list page')

@section('content')

    {{-- ADMIN ACCOUNT --}}
    {{-- admin@gmail.com & Admin123 --}}

    <div class="main-banner"></div>
    <div class="section trending">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-info">
                    <strong>Info!</strong>{{ session('message') }}
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Login form</h2>
            </div>
            <form action="{{ route('account.checkLogin') }}" method="post">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
