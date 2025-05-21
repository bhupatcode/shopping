@extends('layouts.app')
@section('content')
<div class="auth-container">
    <h2>Forgot Password</h2>

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

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <label for="email">Enter your registered email</label>
        <input type="email" name="email" required value="{{ old('email') }}">
        @error('email') <p class="error">{{ $message }}</p> @enderror
        <button type="submit">Send OTP</button>
    </form>
</div>
@endsection
