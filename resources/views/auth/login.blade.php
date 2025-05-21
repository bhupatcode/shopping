<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - My App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="login-container">
        <form method="POST" action="{{ route('login') }}" class="login-box">
            @csrf
            <h2>Login</h2>

            @if(session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group remember">
                <label><input type="checkbox" name="remember"> Remember Me</label>
            </div>
            <div>
                 Do not have Account?<a href="{{ route('register') }}">Register</a>
            </div>
            <div class="form-group">
    <a href="{{ route('password.request') }}">Forgot Password?</a>
</div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
