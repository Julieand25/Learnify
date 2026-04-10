<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Register</title>
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
        }

        .page {
            display: flex;
            height: 100vh;
            width: 100%;
            background: #2e8b84;
        }

        /* ═══════════════════════
           LEFT PANEL
        ═══════════════════════ */
        .left-panel {
            width: 620px;
            flex-shrink: 0;
            background: #dff4f2;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 40px;
            position: relative;
            border-radius: 0 50% 50% 0 / 0 50% 50% 0;
            overflow: visible;
        }

        .circle-blob {
            width: 650px;
            height: 920px;
            background: #dff4f2;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: -60px;
        }

        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }

        .brand img {
            width: 240px;
            height: auto;
        }

        .brand-name {
            font-size: 2.2rem;
            font-weight: 800;
            color: #1c3d6b;
            letter-spacing: 4px;
            text-align: center;
        }

        /* ═══════════════════════
           RIGHT PANEL
        ═══════════════════════ */
        .right-panel {
            flex: 1;
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 40px;
        }

        /* ═══════════════════════
           FORM
        ═══════════════════════ */
        .form-box {
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 5px;
            text-align: left;
            margin-bottom: 6px;
        }

        .sub {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.85);
            font-weight: 500;
            margin-bottom: 22px;
        }

        .field {
            margin-bottom: 14px;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 7px;
        }

        label {
            font-size: 0.88rem;
            font-weight: 600;
            color: #fff;
        }

        input[type="text"],
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

        /* Terms & policy checkbox */
        .terms-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 6px 0 14px;
        }

        .terms-row input[type="checkbox"] {
            width: 14px;
            height: 14px;
            accent-color: #1c3d6b;
            flex-shrink: 0;
            cursor: pointer;
        }

        .terms-row label {
            font-size: 0.78rem;
            font-weight: 400;
            color: rgba(255,255,255,0.75);
            cursor: pointer;
        }

        .terms-row label a {
            color: #1c3d6b;
            font-weight: 600;
            text-decoration: none;
        }

        .terms-row label a:hover { text-decoration: underline; }

        .btn-signup {
            display: block;
            width: 100%;
            padding: 13px;
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

        .btn-signup:hover { opacity: 0.9; }

        .or {
            text-align: center;
            color: rgba(255,255,255,0.65);
            font-size: 0.82rem;
            margin: 16px 0 8px;
        }

        .signin-row {
            text-align: center;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.75);
        }

        .signin-row a {
            color: #1c3d6b;
            font-weight: 700;
            text-decoration: none;
            margin-left: 3px;
        }

        .signin-row a:hover { text-decoration: underline; }

        .status-msg {
            padding: 9px 13px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 5px;
            color: #fff;
            font-size: 0.82rem;
            margin-bottom: 14px;
        }

        /* ═══════════════════════
           TABLET (≤ 1024px)
        ═══════════════════════ */
        @media (max-width: 1024px) {
            .left-panel {
                width: 340px;
                padding-left: 30px;
            }

            .circle-blob {
                width: 420px;
                height: 520px;
                margin-left: -120px;
            }

            .brand img { width: 190px; }
            .brand-name { font-size: 1.8rem; }

            h1 { font-size: 2.5rem; }

            .right-panel { padding: 40px 30px; }
        }

        /* ═══════════════════════
           MOBILE (≤ 767px)
        ═══════════════════════ */
        @media (max-width: 767px) {
            .page {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }

            .left-panel {
                width: 100%;
                border-radius: 0 0 40% 40% / 0 0 50px 50px;
                justify-content: center;
                padding: 40px 20px 60px;
                overflow: hidden;
            }

            .circle-blob {
                width: auto;
                height: auto;
                background: transparent;
                border-radius: 0;
                margin-left: 0;
            }

            .brand img { width: 150px; }
            .brand-name { font-size: 1.7rem; }

            .right-panel {
                padding: 40px 24px 50px;
                justify-content: flex-start;
            }

            .form-box { max-width: 100%; }

            h1 { font-size: 2rem; letter-spacing: 3px; }
        }

        /* ═══════════════════════
           SMALL MOBILE (≤ 480px)
        ═══════════════════════ */
        @media (max-width: 480px) {
            .brand img { width: 120px; }
            .brand-name { font-size: 1.4rem; letter-spacing: 3px; }
            h1 { font-size: 1.7rem; }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                padding: 11px 13px;
                font-size: 0.82rem;
            }

            .btn-signup { padding: 11px; font-size: 0.92rem; }
        }
    </style>
</head>
<body>

<div class="page">

    {{-- ── LEFT PANEL ── --}}
    <div class="left-panel">
        <div class="circle-blob">
            <div class="brand">
                <img src="{{ asset('images/learnify-logo.png') }}" alt="Learnify Logo">
                <p class="brand-name">LEARNIFY</p>
            </div>
        </div>
    </div>

    {{-- ── RIGHT PANEL ── --}}
    <div class="right-panel">
        <div class="form-box">

            <h1>SIGN UP</h1>
            <p class="sub">Get started now</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="field">
                    <div class="label-row">
                        <label for="name">Name</label>
                    </div>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        placeholder="Enter your name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                    >
                    @foreach ($errors->get('name') as $msg)
                        <p class="error-msg">{{ $msg }}</p>
                    @endforeach
                </div>

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
                    </div>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter Your Password"
                        required
                        autocomplete="new-password"
                    >
                    @foreach ($errors->get('password') as $msg)
                        <p class="error-msg">{{ $msg }}</p>
                    @endforeach
                </div>

                {{-- Confirm Password (hidden but required by Laravel) --}}
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    required
                    autocomplete="new-password"
                    style="display:none;"
                    id="password_confirmation"
                >

                {{-- Terms & Policy --}}
                <div class="terms-row">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="#">terms &amp; policy</a>
                    </label>
                </div>

                <button type="submit" class="btn-signup">Sign up</button>

                <p class="or">or</p>
                <p class="signin-row">
                    Have an account?
                    <a href="{{ route('login') }}">Sign In</a>
                </p>

            </form>

        </div>
    </div>

</div>

<script>
    // Sync password_confirmation with password field on input
    // since we hide the confirm field but Laravel needs it
    document.getElementById('password').addEventListener('input', function () {
        document.getElementById('password_confirmation').value = this.value;
    });

    // overflow:hidden on desktop, scrollable on smaller screens
    function handleOverflow() {
        if (window.innerWidth > 1024) {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        } else {
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
        }
    }

    handleOverflow();
    window.addEventListener('resize', handleOverflow);
</script>

</body>
</html>