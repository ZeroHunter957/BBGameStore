<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Show login form
     */
    public function login()
    {
        return view("account.login");
    }

    /**
     * Handle login attempt
     */
    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $account = Account::where("email", $request->email)->first();

        if ($account && Hash::check($request->password, $account->password)) {
            // Store user data in session manually
            $request->session()->put('accountLogin', $account->id); // Store only the user ID
            return $account->role === "ADMIN" ? redirect('/dashboard') : redirect('/');
        }

        return back()->with('message', 'Invalid email or password.');
    }

    /**
     * Show registration form
     */
    public function register()
    {
        return view("account.register");
    }

    /**
     * Handle new user registration
     */
    public function registerPost(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts',
            'password' => 'required|min:6|confirmed',
        ]);

        $otpCode = Str::upper(Str::random(6));

        Account::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otpCode,
            'expireotp' => Carbon::now()->addMinutes(5),
            'status' => true,
            'isverify' => false,
            'role' => "USER",
        ]);

        Session::put('s_email', $request->email);

        return redirect()->route('account.OTPregister')->with('success', 'Account created successfully. Check your email for the OTP.');
    }

    /**
     * Show OTP verification form
     */
    public function viewOTPRegister()
    {
        return view("account.otp_register");
    }

    /**
     * Handle OTP verification
     */
    public function verifyOTPRegister(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $account = Account::where('otp', $request->otp)->first();

        if (!$account) {
            return redirect()->route("account.OTPregister")->with("message", "Invalid OTP");
        }

        if ($account->expireotp < Carbon::now()) {
            return redirect()->route("account.OTPregister")->with("message", "OTP expired");
        }

        $account->update(["isverify" => true]);

        return redirect('/login')->with('success', 'OTP verified. You can now log in.');
    }

    /**
     * Resend OTP if expired
     */
    public function resendOTP(Request $request)
    {
        $email = Session::get('s_email');
        if (!$email) {
            return redirect()->route("account.register")->with("message", "Session expired. Please register again.");
        }

        $account = Account::where("email", $email)->first();
        if (!$account) {
            return redirect()->route("account.register")->with("message", "Account not found.");
        }

        $newOtp = Str::upper(Str::random(6));

        $account->update([
            'otp' => $newOtp,
            'expireotp' => Carbon::now()->addMinutes(5),
        ]);

        return redirect()->route("account.OTPregister")->with("success", "A new OTP has been sent to your email.");
    }

    /**
     * Logout and destroy session
     */
    public function logout(Request $request)
    {
        session()->forget('accountLogin');
        return redirect('/login')->with('message', 'You have been logged out.');
    }
}