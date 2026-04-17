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
        input[type="password"],
        .password-wrap input {
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

        /* Suppress browser-native password reveal button */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear { display: none; }
        input[type="password"]::-webkit-credentials-auto-fill-button { visibility: hidden; }

        /* Password wrapper + eye toggle */
        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 42px;
        }

        .eye-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255,255,255,0.55);
            padding: 0;
            line-height: 0;
            display: none;
        }

        .eye-btn:hover { color: #fff; }
        .eye-btn svg { width: 18px; height: 18px; display: block; }

        .match-error {
            margin-top: 5px;
            font-size: 0.75rem;
            color: #ffb3b3;
            display: none;
        }

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
            .password-wrap input {
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
                    <div class="password-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="new-password"
                            oninput="updateEye('pwd'); checkMatch();"
                        >
                        <button type="button" class="eye-btn" id="eyeBtn1" onclick="togglePwd('pwd')" tabindex="-1">
                            <svg id="eyeOpen1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eyeOff1" style="display:none;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @foreach ($errors->get('password') as $msg)
                        <p class="error-msg">{{ $msg }}</p>
                    @endforeach
                </div>

                {{-- Confirm Password --}}
                <div class="field">
                    <div class="label-row">
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                    <div class="password-wrap">
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Re-enter your password"
                            required
                            autocomplete="new-password"
                            oninput="updateEye('confirm'); checkMatch();"
                        >
                        <button type="button" class="eye-btn" id="eyeBtn2" onclick="togglePwd('confirm')" tabindex="-1">
                            <svg id="eyeOpen2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eyeOff2" style="display:none;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    <p class="match-error" id="matchError">Passwords do not match.</p>
                </div>

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
    const pwdInput     = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const matchError   = document.getElementById('matchError');

    // Eye toggle helpers
    function updateEye(field) {
        const btn = document.getElementById(field === 'pwd' ? 'eyeBtn1' : 'eyeBtn2');
        const inp = field === 'pwd' ? pwdInput : confirmInput;
        btn.style.display = inp.value.length > 0 ? 'block' : 'none';
    }

    function togglePwd(field) {
        const inp    = field === 'pwd' ? pwdInput : confirmInput;
        const open   = document.getElementById(field === 'pwd' ? 'eyeOpen1' : 'eyeOpen2');
        const off    = document.getElementById(field === 'pwd' ? 'eyeOff1'  : 'eyeOff2');
        const isHide = inp.type === 'password';
        inp.type           = isHide ? 'text' : 'password';
        open.style.display = isHide ? 'none'  : 'block';
        off.style.display  = isHide ? 'block' : 'none';
        inp.focus();
    }

    // Real-time password match check
    function checkMatch() {
        const p = pwdInput.value;
        const c = confirmInput.value;
        if (c.length === 0) {
            matchError.style.display = 'none';
            confirmInput.style.borderColor = '';
        } else if (p !== c) {
            matchError.style.display = 'block';
            confirmInput.style.borderColor = '#ffb3b3';
        } else {
            matchError.style.display = 'none';
            confirmInput.style.borderColor = 'rgba(255,255,255,0.8)';
        }
    }

    // Block submit if passwords don't match
    document.querySelector('form').addEventListener('submit', function (e) {
        if (pwdInput.value !== confirmInput.value) {
            e.preventDefault();
            matchError.style.display = 'block';
            confirmInput.style.borderColor = '#ffb3b3';
            confirmInput.focus();
        }
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