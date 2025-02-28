@extends('layouts.user')
@section('title', 'Forgot Password')

@section('content')

    <div class="main-banner"></div> <!-- Keep the banner if necessary -->
    <div class="section trending">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-info">
                    <strong>Info!</strong> {{ session('message') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Forgot Password</h2>
            </div>

            <form action="{{ route('account.send-reset-link') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </form>
        </div>
    </div>

@endsection
