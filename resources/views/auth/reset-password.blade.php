@extends('layouts.app')
@section('content')
<div class="auth-container">
    <h2>Reset Password</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <label for="password">New Password</label>
        <input type="password" name="password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" required>
        @error('password_confirmation') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">Reset Password</button>
    </form>
</div>
@endsection
