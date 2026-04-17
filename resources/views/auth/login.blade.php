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
            /* NO overflow here — controlled by JS below */
        }

        /* ═══════════════════════
           PAGE WRAPPER
        ═══════════════════════ */
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

        /* Fat circle blob */
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
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 5px;
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
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

        /* ═══════════════════════
           ROLE TOGGLE
        ═══════════════════════ */
        .role-toggle {
            display: flex;
            background: #f0f2f4;
            border-radius: 999px;
            padding: 5px;
            margin-bottom: 28px;
            gap: 0;
        }

        .role-btn {
            flex: 1;
            padding: 10px 0;
            border: none;
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: #7a8a9a;
            background: transparent;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, font-weight 0.1s;
        }

        .role-btn.active {
            background: #fff;
            color: #2e8b84;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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

            h1 { font-size: 2rem; letter-spacing: 3px; }
        }

        /* ═══════════════════════
           SMALL MOBILE (≤ 480px)
        ═══════════════════════ */
        @media (max-width: 480px) {
            .brand img { width: 120px; }
            .brand-name { font-size: 1.4rem; letter-spacing: 3px; }
            h1 { font-size: 1.7rem; }

            input[type="email"],
            input[type="password"] {
                padding: 11px 13px;
                font-size: 0.82rem;
            }

            .btn-login { padding: 11px; font-size: 0.92rem; }
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

            <h1>LOGIN</h1>

            @if (session('status'))
                <div class="status-msg">{{ session('status') }}</div>
            @endif

            <div class="role-toggle">
                <button type="button" class="role-btn active" id="btn-student">Student</button>
                <button type="button" class="role-btn" id="btn-teacher">Teacher</button>
            </div>

            <p class="welcome">Welcome back!</p>
            <p class="sub">Enter your Credentials to access your account</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                {{-- Submitted with the form so the backend knows which role was selected --}}
                <input type="hidden" name="role" id="role-input" value="{{ old('role', 'student') }}">

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
                    <div class="password-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter Your Password"
                            required
                            autocomplete="current-password"
                            oninput="updateEyeBtn()"
                        >
                        <button type="button" class="eye-btn" id="eyeBtn" onclick="togglePassword()" tabindex="-1">
                            {{-- Eye open --}}
                            <svg id="eyeOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{-- Eye off --}}
                            <svg id="eyeOff" style="display:none;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @foreach ($errors->get('password') as $msg)
                        <p class="error-msg">{{ $msg }}</p>
                    @endforeach
                </div>

                <button type="submit" class="btn-login">login</button>

                <div id="signup-section">
                    <p class="or">or</p>
                    <p class="signup-row">
                        Don't have an account?
                        <a href="{{ route('register') }}">Sign Up</a>
                    </p>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
    // Role toggle
    const btnStudent    = document.getElementById('btn-student');
    const btnTeacher    = document.getElementById('btn-teacher');
    const signupSection = document.getElementById('signup-section');
    const roleInput     = document.getElementById('role-input');

    function setRole(role) {
        roleInput.value = role;
        if (role === 'student') {
            btnStudent.classList.add('active');
            btnTeacher.classList.remove('active');
            signupSection.style.display = '';
        } else {
            btnTeacher.classList.add('active');
            btnStudent.classList.remove('active');
            signupSection.style.display = 'none';
        }
    }

    btnStudent.addEventListener('click', () => setRole('student'));
    btnTeacher.addEventListener('click', () => setRole('teacher'));

    // Restore the selected role after a failed login (old input)
    setRole(roleInput.value);

    // Password eye toggle
    const pwdInput = document.getElementById('password');
    const eyeBtn   = document.getElementById('eyeBtn');
    const eyeOpen  = document.getElementById('eyeOpen');
    const eyeOff   = document.getElementById('eyeOff');

    function updateEyeBtn() {
        eyeBtn.style.display = pwdInput.value.length > 0 ? 'block' : 'none';
    }

    function togglePassword() {
        const isHidden = pwdInput.type === 'password';
        pwdInput.type  = isHidden ? 'text' : 'password';
        eyeOpen.style.display = isHidden ? 'none'  : 'block';
        eyeOff.style.display  = isHidden ? 'block' : 'none';
        pwdInput.focus();
    }

    // Show eye button if password field already has a value (e.g. browser autofill)
    if (pwdInput.value.length > 0) updateEyeBtn();

    // Apply overflow:hidden on desktop (> 1024px), allow scroll on smaller screens
    function handleOverflow() {
        if (window.innerWidth > 1024) {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        } else {
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
        }
    }

    // Run on load
    handleOverflow();

    // Run on every resize
    window.addEventListener('resize', handleOverflow);
</script>

</body>
</html>
