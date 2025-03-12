@extends('layouts.user')

@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Profile</h3>
                    <span class="breadcrumb"><a href="/">Home</a> > Profile</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow p-4">
                    <h2 class="text-center mb-3">Download Game {{ $gameName }}</h2>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <!-- Form nhập mã tải -->
                    <form action="{{ route('verifyDownloadCode', $gameId) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="download_code" class="form-label">Game Download Code:</label>
                            <input type="text" class="form-control" name="download_code" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Confirm & Download Game</button>
                    </form>

                    <!-- Nút gửi mã tải -->
                    <hr>
                    <form action="{{ route('sendDownloadCode', $gameId) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100"> Send download code to email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (session('download_url'))
        <script>
            setTimeout(function() {
                window.location.href = "{{ session('download_url') }}";
            }, 2000);// 2second
        </script>
    @endif
@endsection
