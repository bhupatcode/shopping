<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;



class AuthController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials=$request->only('email','password');

        if(Auth::attempt($credentials)){
            session(['user_email' => Auth::user()->email]);
            return redirect()->intended('/');
        }
        return back()->with('error','Invalid Data');
    }

    public function showregister()
    {
        return view('auth.register');
    }
public function showOtpForm()
{
    return view('auth.verify-otp'); // Make sure this view exists
}
public function showResetForm()
{
    return view('auth.reset-password');
}


    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created! Please login.');

    }
    public function sendOtp(Request $request) {
    $request->validate(['email' => 'required|email|exists:users,email']);

    $otp = rand(100000, 999999);
    $expiresAt = now()->addMinutes(10);

    $user = User::where('email', $request->email)->first();
    $user->reset_otp = $otp;
    $user->otp_expires_at = $expiresAt;
    $user->save();

    // Send OTP email
    Mail::to($user->email)->send(new \App\Mail\SendOtpMail($otp));

    session(['reset_email' => $user->email]);

    return redirect()->route('password.otp')->with('success', 'OTP sent to your email.');
}
public function verifyOtp(Request $request) {
    $request->validate(['otp' => 'required']);

    $user = User::where('email', session('reset_email'))->first();

    if ($user->reset_otp == $request->otp && now()->lessThan($user->otp_expires_at)) {
        session(['otp_verified' => true]);
        return redirect()->route('password.reset');
    }

    return back()->with('error', 'Invalid or expired OTP');
}
public function resetPassword(Request $request) {
    if (!session('otp_verified')) {
        return redirect()->route('password.request')->with('error', 'Unauthorized');
    }

    $request->validate([
        'password' => 'required|confirmed|min:6'
    ]);

    $user = User::where('email', session('reset_email'))->first();
    $user->password = Hash::make($request->password);
    $user->reset_otp = null;
    $user->otp_expires_at = null;
    $user->save();

    session()->forget(['otp_verified', 'reset_email']);

    return redirect()->route('login')->with('success', 'Password reset successfully!');
}
public function showForgotForm()
{
    return view('auth.forgot-password');
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
