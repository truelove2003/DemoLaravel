<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
<br>
    @if ($errors->any())
        <div>
            <strong>Lỗi đăng nhập:</strong> {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
        </div>

        <div>
            <button type="submit">Đăng nhập</button>
        </div>
    </form>
</body>
</html>
