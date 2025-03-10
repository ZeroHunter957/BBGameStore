@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 p-8 neon-glass-card">
        <h2 class="text-4xl font-extrabold text-center futuristic-title">
            ✨ Select Coupon Recipients ✨
        </h2>
        <p class="text-center text-xl mt-4">
            <strong>Coupon Code:</strong> 
            <span class="coupon-code">{{ $coupon->code }}</span>
        </p>

        <div class="max-w-2xl mx-auto futuristic-box">
            <form id="sendCouponForm" class="space-y-6">
                @csrf
                <div class="user-list">
                    @foreach ($users as $account)
                        <label class="user-item">
                            <input type="checkbox" name="recipients[]" value="{{ $account->id }}" class="hidden peer">
                            <span class="user-info">{{ $account->fullname }} 
                                (<span class="user-email">{{ $account->email }}</span>)
                            </span>
                            <div class="toggle-switch"></div>
                        </label>
                    @endforeach
                </div>

                <button type="button" id="sendCouponBtn" class="neon-btn">
                    🚀 Send Coupon <span id="loadingIcon" class="hidden">🔄</span>
                    <span class="btn-glow"></span>
                </button>
            </form>
        </div>
    </div>

    <style>
        /* 🌌 BACKGROUND FUTURISTIC */
        body {
            background: linear-gradient(135deg, #0f172a 10%, #1e293b 100%);
            font-family: 'Poppins', sans-serif;
            color: white;
            overflow: hidden;
        }

        /* 🚀 GLASSMORPHISM CARD */
        .neon-glass-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        /* 🎭 TITLE EFFECT */
        .futuristic-title {
            background: linear-gradient(90deg, #ff00ff, #00ffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0px 0px 15px rgba(255, 0, 255, 0.5);
            letter-spacing: 2px;
        }

        /* ✨ COUPON CODE EFFECT */
        .coupon-code {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: bold;
            color: white;
            box-shadow: 0px 0px 10px rgba(255, 65, 108, 0.7);
        }

        /* 🎭 USER LIST */
        .user-list {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }

        /* 🎭 USER ITEM EFFECT */
        .user-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 0px 10px rgba(0, 255, 255, 0.3);
            cursor: pointer;
        }

        .user-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.02);
        }

        /* 🌊 TOGGLE SWITCH */
        .toggle-switch {
            width: 40px;
            height: 20px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            position: relative;
            transition: all 0.3s ease;
        }

        .toggle-switch::before {
            content: "";
            width: 16px;
            height: 16px;
            background: white;
            position: absolute;
            top: 2px;
            left: 3px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .peer:checked + .toggle-switch {
            background: #00ffff;
            box-shadow: 0px 0px 15px rgba(0, 255, 255, 0.7);
        }

        .peer:checked + .toggle-switch::before {
            transform: translateX(20px);
        }

        /* 🎇 NEON BUTTON */
        .neon-btn {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50px;
            padding: 14px;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0px 0px 20px rgba(255, 65, 108, 0.7);
            transition: all 0.3s ease;
        }

        .neon-btn:hover {
            transform: scale(1.05);
        }

        /* 🎇 BUTTON GLOW EFFECT */
        .btn-glow {
            position: absolute;
            top: 0;
            left: 50%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            border-radius: 50%;
            animation: glow 1.5s infinite alternate;
        }

        @keyframes glow {
            0% { box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.5); }
            100% { box-shadow: 0px 0px 50px rgba(255, 255, 255, 1); }
        }

        /* 🚀 FADE IN EFFECT */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

<script>
    document.getElementById('sendCouponBtn').addEventListener('click', function() {
    alert("✅ Coupon sent successfully!");
    window.location.href = "{{ route('coupon.index') }}"; // 🔥 Quay về danh sách mã giảm giá
});

</script>

@endsection
