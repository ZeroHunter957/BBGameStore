@extends('layouts.admin')

@section('title', 'Create Game Category')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Game Category Create Form</h2>
        </div>

        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong> {{ session('message') }}
            </div>
        @endif

        <div class="table-responsive">
            <form action="{{ route('gamecategory.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 mt-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter game category name"
                        name="name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
