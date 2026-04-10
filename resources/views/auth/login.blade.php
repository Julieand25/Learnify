<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .page {
            display: flex;
            height: 100vh;
            width: 100vw;
            background: #2e8b84;
            position: relative;
        }

        /* ── LEFT: plain mint background ── */
        .left {
            position: relative;
            width: 30%;
            flex-shrink: 0;
            background: #dff4f2;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── BIG FAT CIRCLE: sits on the right edge of .left, bleeds into .right ── */
        .fat-circle {
            position: absolute;
            /* Center it vertically on the page */
            top: 50%;
            /* Push it so its center is roughly at the left/right boundary */
            left: 23%;
            transform: translate(-50%, -50%);
            /* Make it very large — 90vh tall so it's fat and prominent */
            width: 90vh;
            height: 120vh;
            background: #dff4f2;
            border-radius: 50%;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
        }

        .brand img {
            width: 300px;
            height: auto;
        }

        .brand-name {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1c3d6b;
            letter-spacing: 4px;
            text-align: center;
        }

        /* ── RIGHT: teal form panel ── */
        .right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5% 0 8%;
            z-index: 2;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 5px;
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome {
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .sub {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.75);
            margin-bottom: 26px;
        }

        .field {
            margin-bottom: 18px;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        label {
            font-size: 0.88rem;
            font-weight: 600;
            color: #fff;
        }

        .forgot {
            font-size: 0.78rem;
            color: #1c3d6b;
            font-weight: 600;
            text-decoration: none;
        }

        .forgot:hover { text-decoration: underline; }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            background: transparent;
            border: 1.5px solid rgba(255,255,255,0.5);
            border-radius: 6px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            outline: none;
            transition: border-color 0.2s;
        }

        input::placeholder { color: rgba(255,255,255,0.45); }
        input:focus { border-color: #fff; }

        .error-msg {
            margin-top: 5px;
            font-size: 0.75rem;
            color: #ffb3b3;
        }

        .btn-login {
            display: block;
            width: 100%;
            padding: 13px;
            margin-top: 8px;
            background: #fff;
            border: none;
            border-radius: 6px;
            color: #2e8b84;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-login:hover { opacity: 0.9; }

        .or {
            text-align: center;
            color: rgba(255,255,255,0.65);
            font-size: 0.82rem;
            margin: 18px 0 8px;
        }

        .signup-row {
            text-align: center;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.75);
        }

        .signup-row a {
            color: #1c3d6b;
            font-weight: 700;
            text-decoration: none;
            margin-left: 3px;
        }

        .signup-row a:hover { text-decoration: underline; }

        .status-msg {
            padding: 9px 13px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 5px;
            color: #fff;
            font-size: 0.82rem;
            margin-bottom: 14px;
        }
    </style>
</head>
<body>

<div class="page">

    {{-- LEFT: plain mint strip --}}
    <div class="left"></div>

    {{-- BIG FAT CIRCLE with logo inside --}}
    <div class="fat-circle">
        <div class="brand">
            <img src="{{ asset('images/learnify-logo.png') }}" alt="Learnify">
            <p class="brand-name">LEARNIFY</p>
        </div>
    </div>

    {{-- RIGHT: teal form --}}
    <div class="right">
        <div class="form-box">

            <h1>LOGIN</h1>

            @if (session('status'))
                <div class="status-msg">{{ session('status') }}</div>
            @endif

            <p class="welcome">Welcome back!</p>
            <p class="sub">Enter your Credentials to access your account</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="field">
                    <div class="label-row">
                        <label for="email">Email address</label>
                    </div>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @foreach ($errors->get('email') as $msg)
                        <p class="error-msg">{{ $msg }}</p>
                    @endforeach
                </div>

                {{-- Password --}}
                <div class="field">
                    <div class="label-row">
                        <label for="password">Password</label>
                        @if (Route::has('password.request'))
                            <a class="forgot" href="{{ route('password.request') }}">forgot password</a>
                        @endif
                    </div>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter Your Password"
                        required
                        autocomplete="current-password"
                    >
                    @foreach ($errors->get('password') as $msg)
                        <p class="error-msg">{{ $msg }}</p>
                    @endforeach
                </div>

                <button type="submit" class="btn-login">login</button>

                <p class="or">or</p>
                <p class="signup-row">
                    Don't have an account?
                    <a href="{{ route('register') }}">Sign Up</a>
                </p>

            </form>
        </div>
    </div>

</div>

</body>
</html>