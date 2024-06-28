<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css\styles.css') }}">
</head>
<body>
    <div class="login-page">
        <div class="form">
            <h1>Stock App</h1>
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <input type="email" placeholder="Email" id="email" name="email" required>
                </div>
                <div>
                    <input type="password" placeholder="Password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
