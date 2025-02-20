<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $request->session()->put('previous_url', url()->previous());
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $user = User::where('email', $request->email)->first();

            if ($user && $user->password == $request->password) {
                Auth::login($user);
                $request->session()->put('user_id', $user->id);
                $request->session()->put('role', $user->role);

                Log::info('User logged in successfully', ['user_id' => $user->id, 'role' => $user->role]);

                $previousUrl = $request->session()->get('previous_url', url('/'));

                Log::info('Redirecting to previous URL:', ['previous_url' => $previousUrl]);

                return redirect($previousUrl);
            } else {
                Log::warning('Login failed', ['email' => $request->email]);

                return redirect()->back()->with('error', 'Invalid credentials');
            }
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage(), ['exception' => $e]);

            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
