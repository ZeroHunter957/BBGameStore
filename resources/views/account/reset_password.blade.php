@extends('layouts.user')
@section('title', 'Reset Password')

@section('content')

    <div class="main-banner"></div> <!-- Keep the banner if necessary -->
    <div class="section trending">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-info">
                    <strong>Info!</strong> {{ session('message') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Reset Password</h2>
            </div>

            <form action="{{ route('account.update-password') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label for="password">New Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter new password"
                        name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" class="form-control" id="password_confirmation"
                        placeholder="Confirm new password" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-success">Reset Password</button>
            </form>
        </div>
    </div>

@endsection
