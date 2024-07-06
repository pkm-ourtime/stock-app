<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css\styles.css') }}">
</head>

<body>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
        </div>
    @endif

    <div class="auth-page">
        <div class="form">
            <h1>Stock App</h1>
            <form class="auth-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <input type="text" placeholder="Name" id="name" name="name" required>
                </div>
                <div>
                    <input type="email" placeholder="Email" id="email" name="email" required>
                </div>
                <div>
                    <input type="password" placeholder="Password" id="password" name="password" required>
                </div>
                <div>
                    <input type="password" placeholder="Password-Confirmation" id="password_confirmation"
                        name="password_confirmation" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>

</html>
