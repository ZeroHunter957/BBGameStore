<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Feedback;
use Cache;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Mail;

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
            $request->session()->put('accountLogin', $account->id);
            $request->session()->put('role', $account->role); 
            return $account->role === "ADMIN" ? redirect('/admin/dashboard') : redirect('/');
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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $otpCode = Str::upper(Str::random(6));
        $profileImage = 'default.jpg'; // Default image if no upload

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_images'), $imageName);
            $profileImage = $imageName; // Assign uploaded image
        }

        // Create user account with profile image assigned
        $account = Account::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otpCode,
            'expireotp' => Carbon::now()->addMinutes(5),
            'status' => true,
            'isverify' => false,
            'role' => "USER",
            'profile_image' => $profileImage, // Ensure it's saved properly
        ]);

        // Debugging Log
        \Log::info('New user registered', ['profile_image' => $account->profile_image]);

        // Send OTP email
        Mail::raw("Hello {$account->fullname},\n\nYour OTP is: {$otpCode}\n\nIt expires in 5 minutes.", function ($message) use ($account) {
            $message->to($account->email)->subject('Your Registration OTP');
        });

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

        // Log debugging info
        \Log::info('Before OTP Verification:', ['profile_image' => $account->profile_image]);

        // Ensure profile image is not reset
        $account->update([
            "isverify" => true,
        ]);

        \Log::info('After OTP Verification:', ['profile_image' => $account->profile_image]);

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

        // Send the new OTP via email
        Mail::raw("Hello {$account->fullname},\n\nYour new OTP is: {$newOtp}\n\nIt expires in 5 minutes.", function ($message) use ($account) {
            $message->to($account->email)
                ->subject('Your New OTP');
        });

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

    // index
    public function index()
    {
        $accounts = Account::all();
        return view("account.index", compact("accounts"));
    }

    // Profile
    public function profile()
    {
        $userId = session('accountLogin');

        if (!$userId) {
            return redirect('/login')->with('message', 'Please log in to access your profile');
        }

        $user = Account::find($userId);

        if (!$user) {
            return redirect('/login')->with('message', 'User not found');
        }

        return view('account.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Account::find(session('accountLogin'));

        if (!$user) {
            return response()->json(['success' => false]);
        }

        $user->fullname = $request->fullname;

        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('profile_images'), $imageName);
            $user->profile_image = $imageName;
        }

        $user->save();

        return response()->json(['success' => true, 'profile_image' => $user->profile_image]);
    }
    public function getFeedbacks(Request $request)
    {
        $userId = session('accountLogin');
        
        $feedbacks = Feedback::where('account_id', $userId)
            ->with('game') 
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Return the feedbacks in a suitable format (e.g., JSON)
        return response()->json(['feedbacks' => $feedbacks]);
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Account::find(session('accountLogin'));

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Password updated successfully.']);
    }

    // forgot password
    /**
     * Show the password reset request form
     */
    public function showForgotPasswordForm()
    {
        return view('account.forgot_password');
    }

    /**
     * Handle password reset request and send email with a token
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $account = Account::where('email', $request->email)->first();

        if (!$account) {
            return back()->with('message', 'No account found with that email.');
        }

        // Generate a temporary token
        $token = Str::random(60);
        Cache::put("password_reset_{$token}", $account->email, now()->addMinutes(30));

        // Send email
        $resetLink = url("/reset-password/$token");
        Mail::raw("Click this link to reset your password: $resetLink", function ($message) use ($account) {
            $message->to($account->email)->subject('Password Reset Request');
        });

        return back()->with('success', 'Password reset link has been sent to your email.');
    }

    /**
     * Show password reset form
     */
    public function showResetForm($token)
    {
        if (!Cache::has("password_reset_{$token}")) {
            return redirect('/forgot-password')->with('message', 'Invalid or expired reset token.');
        }

        return view('account.reset_password', compact('token'));
    }

    /**
     * Handle password reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $email = Cache::get("password_reset_{$request->token}");

        if (!$email) {
            return redirect('/forgot-password')->with('message', 'Invalid or expired reset token.');
        }

        $account = Account::where('email', $email)->first();

        if (!$account) {
            return redirect('/forgot-password')->with('message', 'Account not found.');
        }

        // Update password
        $account->update([
            'password' => Hash::make($request->password),
        ]);

        // Clear the reset token
        Cache::forget("password_reset_{$request->token}");

        return redirect('/login')->with('success', 'Password reset successful. You can now log in.');
    }
}