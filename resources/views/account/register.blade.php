@extends('layouts.user')
@section('title', 'list page')

@section('content')
    <div class="main-banner"></div>
    <div class="section trending">
        <div class="container">
            <h2>Register form</h2>
            <form method="post" action="{{ route('account.registerPost') }}">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" value="{{ old('email') }}" id="email"
                        placeholder="Enter email" name="email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3 mt-3">
                    <label for="fullname">Fullname:</label>
                    <input type="text" class="form-control" id="fullname" value="{{ old('fullname') }}"
                        placeholder="Enter fullname" name="fullname">
                    @error('fullname')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" name="profile_image" class="form-control" accept="image/*">
                    @error('profile_image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
