<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login BUMN</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="slideshow-bg"></div>

    <div class="login-box">

        <div class="login-logo">
            <img src="{{ asset('images/logo-bumn.png') }}" alt="Logo BUMN">
        </div>

        <div class="login-title">
            Arsip Inaktif BP BUMN
        </div>

        @if(session('error'))
            <p style="color:red; text-align:center;">
                {{ session('error') }}
            </p>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>                
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button class="btn-login" type="submit">
                Login
            </button>
        </form>

        <div class="footer">
            Created by Badan Usaha Milik Negara
        </div>

    </div>

</body>
</html>
