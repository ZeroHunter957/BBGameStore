@extends('layouts.user')
@section('title', 'Login')

@section('content')
    {{-- ADMIN ACCOUNT --}}
    {{-- admin@gmail.com & Admin123 --}}

    <div class="main-banner"></div>
    <div class="section trending">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-info">
                    <strong>Info!</strong> {{ session('message') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Login Form</h2>
            </div>

            <form action="{{ route('account.checkLogin') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <div class="mt-3">
                <a href="{{ route('account.forgot-password') }}" class="btn btn-link">Forgot Password?</a>
            </div>

        </div>
    </div>

@endsection
