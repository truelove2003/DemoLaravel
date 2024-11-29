<!DOCTYPE html>
<html>
<head>
    <title>My Laravel App</title>
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            @auth
                <a href="/dashboard">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login.form') }}">Login</a>
                <a href="{{ route('register.form') }}">Register</a>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
