@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="glass-card shadow-lg border-0 rounded-4 p-5">
        <h2 class="text-center text-light fw-bold mb-3">🎁 Chọn Người Nhận Coupon</h2>
        <h4 class="text-center text-light mb-4">Mã Coupon: <strong class="text-warning">{{ $coupon->code }}</strong></h4>

        <form action="{{ route('coupon.send', $coupon->id) }}" method="POST">
            @csrf
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-md-6">
                        <div class="custom-checkbox">
                            <input type="checkbox" name="emails[]" value="{{ $user->email }}" id="user-{{ $user->id }}">
                            <label for="user-{{ $user->id }}">
                                <span class="checkbox-icon"></span>
                                {{ $user->name }} <small class="text-muted">({{ $user->email }})</small>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn-glow">🚀 Gửi Coupon</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Nền gradient siêu đẹp */
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }

    /* Hiệu ứng Glassmorphism cho card */
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 600px;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: fadeIn 0.8s ease-in-out;
    }

    /* Checkbox tuỳ chỉnh với hiệu ứng 3D */
    .custom-checkbox {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.15);
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 12px;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .custom-checkbox:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: scale(1.03);
    }

    .custom-checkbox input {
        display: none;
    }

    .custom-checkbox label {
        display: flex;
        align-items: center;
        cursor: pointer;
        width: 100%;
        color: white;
        font-size: 16px;
    }

    .checkbox-icon {
        width: 20px;
        height: 20px;
        border: 2px solid white;
        border-radius: 6px;
        display: inline-block;
        transition: 0.3s ease-in-out;
    }

    .custom-checkbox input:checked + label .checkbox-icon {
        background: linear-gradient(135deg, #ff9a9e, #fad0c4);
        border-color: #ff758c;
        box-shadow: 0px 0px 8px rgba(255, 120, 150, 0.8);
    }

    /* Nút gửi coupon với hiệu ứng phát sáng */
    .btn-glow {
        background: linear-gradient(135deg, #ff758c, #ff7eb3);
        color: white;
        border: none;
        padding: 12px 30px;
        font-size: 18px;
        border-radius: 30px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0px 4px 10px rgba(255, 120, 150, 0.5);
        cursor: pointer;
    }

    .btn-glow:hover {
        background: linear-gradient(135deg, #ff7eb3, #ff758c);
        transform: scale(1.05);
        box-shadow: 0px 6px 15px rgba(255, 120, 150, 0.8);
    }

    /* Hiệu ứng fadeIn cho trang */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
