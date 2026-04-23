<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Reset Password</title>
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
            padding: 60px 40px;
        }

        /* ═══════════════════════
           FORM
        ═══════════════════════ */
        .form-box {
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 2.6rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 4px;
            text-align: left;
            margin-bottom: 12px;
        }

        .desc {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.6;
            margin-bottom: 28px;
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

        .btn-send {
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

        .btn-send:hover { opacity: 0.9; }

        .back-row {
            text-align: center;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.75);
            margin-top: 20px;
        }

        .back-row a {
            color: #1c3d6b;
            font-weight: 700;
            text-decoration: none;
            margin-left: 3px;
        }

        .back-row a:hover { text-decoration: underline; }

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

            h1 { font-size: 2.2rem; }

            .right-panel { padding: 50px 30px; }
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

            h1 { font-size: 1.8rem; letter-spacing: 3px; }
        }

        /* ═══════════════════════
           SMALL MOBILE (≤ 480px)
        ═══════════════════════ */
        @media (max-width: 480px) {
            .brand img { width: 120px; }
            .brand-name { font-size: 1.4rem; letter-spacing: 3px; }
            h1 { font-size: 1.5rem; }

            input[type="email"],
            input[type="password"] {
                padding: 11px 13px;
                font-size: 0.82rem;
            }

            .btn-send { padding: 11px; font-size: 0.92rem; }
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

            <h1>RESET<br>PASSWORD</h1>

            <p class="desc">
                Enter your new password below to reset your account password.
            </p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                {{-- Token --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

                {{-- New Password --}}
                <div class="field">
                    <div class="label-row">
                        <label for="password">New password</label>
                    </div>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter new password"
                        required
                        autocomplete="new-password"
                    >
                    @foreach ($errors->get('password') as $msg)
                        <p class="error-msg">{{ $msg }}</p>
                    @endforeach
                </div>

                {{-- Confirm Password --}}
                <div class="field">
                    <div class="label-row">
                        <label for="password_confirmation">Confirm new password</label>
                    </div>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm new password"
                        required
                        autocomplete="new-password"
                    >
                    @foreach ($errors->get('password_confirmation') as $msg)
                        <p class="error-msg">{{ $msg }}</p>
                    @endforeach
                </div>

                <button type="submit" class="btn-send">Reset Password</button>

            </form>

            <p class="back-row">
                Remember your password?
                <a href="{{ route('login') }}">Sign In</a>
            </p>

        </div>
    </div>

</div>

<script>
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
