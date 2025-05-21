@extends('layouts.app')
@section('content')
<div class="auth-container">
    <h2>Verify OTP</h2>

    @if(session('error')) <p class="error">{{ session('error') }}</p> @endif
    @if(session('success')) <p class="success">{{ session('success') }}</p> @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.otp.verify') }}" method="POST">
        @csrf
        <label for="otp">Enter OTP sent to your email</label>
        <input type="text" name="otp" required>
        @error('otp') <p class="error">{{ $message }}</p> @enderror
        <button type="submit">Verify</button>
    </form>

    <form action="{{ route('password.email') }}" method="POST" style="margin-top: 1rem;">
        @csrf
        <input type="hidden" name="email" value="{{ session('reset_email') }}">
        <button type="submit" class="btn-resend">Resend OTP</button>
    </form>
</div>
@endsection
