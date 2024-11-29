<!DOCTYPE html>
<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            @error('username')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="hobbies">Hobbies:</label>
            <input type="text" id="hobbies" name="hobbies" value="{{ old('hobbies') }}">
            @error('hobbies')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Register</button>
        
        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
            <script>
                // JavaScript redirect example
                setTimeout(function() {
                    window.location.href = "{{ url('/user') }}";
                }, 3000); // Redirect after 3 seconds (adjust as needed)
            </script>
        @endif
    </form>
</body>
</html>
