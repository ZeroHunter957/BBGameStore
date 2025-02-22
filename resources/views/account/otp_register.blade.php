@extends('layouts.user')
@section('content')
    <div class="main-banner"></div>
    <div class="section trending">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-info">
                    <strong>Info!</strong>{{ session('message') }}
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>OTP Verification</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('account.verifyOTPRegister') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="otp">Enter the OTP sent to your email</label>
                                <input type="text" id="otp" name="otp" class="form-control"
                                    value="{{ old('otp') }}">
                                @error('otp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
                            <p>Didn't receive an OTP? <a href="{{ route('account.resendOTP') }}">Resend OTP</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
