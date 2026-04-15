<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --teal: #2e8b84;
            --teal-light: #dff4f2;
            --navy: #1c3d6b;
            --sidebar-bg: #ffffff;
            --main-bg: #e8f7f6;
            --card-bg: #ffffff;
            --text-dark: #1a2b3c;
            --text-mid: #5a6a7a;
            --text-light: #9aaabb;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--main-bg);
            color: var(--text-dark);
            overflow: hidden;
        }

        .app {
            display: flex;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }

        /* ══════════════════════════════
           MAIN
        ══════════════════════════════ */
        .main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Topbar */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 28px;
            background: var(--main-bg);
            flex-shrink: 0;
        }

        .topbar h2 { font-size: 1.3rem; font-weight: 700; color: var(--text-dark); }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--card-bg);
            border-radius: 24px;
            padding: 6px 14px 6px 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .user-chip span {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Content */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding: 24px 28px;
            overflow-y: auto;
        }

        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #c0d0d8; border-radius: 10px; }

        .content-inner {
            width: 100%;
            max-width: 860px;
        }

        /* ══════════════════════════════
           SETTINGS SECTIONS
        ══════════════════════════════ */
        .settings-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 28px 32px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            max-width: 860px;
        }

        .section {
            padding: 28px 0;
            border-bottom: 1px solid #eef4f5;
        }

        .section:first-child { padding-top: 0; }
        .section:last-child { border-bottom: none; padding-bottom: 0; }

        .section-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .section-label {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .section-desc {
            font-size: 0.78rem;
            color: var(--text-mid);
            line-height: 1.5;
        }

        .btn-save {
            padding: 10px 26px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn-save:hover { opacity: 0.85; }

        .section-row {
            display: flex;
            align-items: flex-start;
            gap: 40px;
        }

        .row-label {
            min-width: 200px;
            flex-shrink: 0;
        }

        .row-label-title {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .row-label-desc {
            font-size: 0.75rem;
            color: var(--text-mid);
            line-height: 1.5;
        }

        .row-input { flex: 1; }

        /* ── Username input ── */
        .input-with-icon {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1.5px solid #d8e8ec;
            border-radius: 999px;
            padding: 11px 18px;
            background: #fff;
            transition: border-color 0.2s;
        }

        .input-with-icon:focus-within { border-color: var(--teal); }

        .input-with-icon svg {
            width: 16px;
            height: 16px;
            color: var(--text-light);
            flex-shrink: 0;
        }

        .input-with-icon input {
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            color: var(--text-dark);
            width: 100%;
            background: transparent;
        }

        /* ── Profile picture ── */
        .picture-row {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .current-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            object-fit: cover;
            background: #c8d8e8;
            flex-shrink: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .current-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .current-avatar svg {
            width: 36px;
            height: 36px;
            color: #a0b4be;
        }

        .upload-box {
            flex: 1;
            border: 1.5px dashed #b8d4da;
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            background: #f8fcfd;
        }

        .upload-box:hover {
            border-color: var(--teal);
            background: var(--teal-light);
        }

        .upload-box svg {
            width: 28px;
            height: 28px;
            color: #7ab0c8;
        }

        .upload-text {
            font-size: 0.78rem;
            color: var(--text-mid);
            text-align: center;
            line-height: 1.5;
        }

        .upload-text a {
            color: var(--teal);
            font-weight: 600;
            text-decoration: none;
        }

        .upload-text a:hover { text-decoration: underline; }

        .upload-hint {
            font-size: 0.7rem;
            color: var(--text-light);
            text-align: center;
        }

        .upload-input { display: none; }

        /* ── Password inputs ── */
        .password-fields {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .input-labeled {
            display: flex;
            align-items: center;
            border: 1.5px solid #d8e8ec;
            border-radius: 999px;
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .input-labeled:focus-within { border-color: var(--teal); }

        .input-prefix {
            width: 174px;
            padding: 11px 18px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-mid);
            background: #f4f9fb;
            border-right: 1.5px solid #d8e8ec;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .input-labeled input {
            border: none;
            outline: none;
            padding: 11px 18px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            color: var(--text-dark);
            width: 100%;
            background: transparent;
        }
    </style>
</head>
<body>

<div class="app">

    <!-- ══ SIDEBAR ══ -->
    <x-student.sidebar active="settings" />

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Topbar -->
        <div class="topbar">
            <h2>Settings</h2>
            <div class="user-chip">
                @if (auth()->user()?->profile_photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                @else
                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <span>{{ auth()->user()->name }}</span>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
        <div class="content-inner">

            <div class="settings-card">

                {{-- ── PROFILE DETAILS ── --}}
                <div class="section">
                    <div class="section-top">
                        <div>
                            <div class="section-label">Profile Details</div>
                            <div class="section-desc">You can change your profile details here seamlessly.</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;">
                            @if (session('profile_success'))
                                <span style="font-size:0.78rem;font-weight:600;color:#1a8a5a;display:flex;align-items:center;gap:5px;">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    {{ session('profile_success') }}
                                </span>
                            @endif
                            <button class="btn-save" form="profile-form" type="submit">Save</button>
                        </div>
                    </div>

                    <form id="profile-form" method="POST" action="{{ route('student.settings.update-profile') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Username --}}
                        <div class="section-row" style="margin-bottom: 32px;">
                            <div class="row-label">
                                <div class="row-label-title">Username</div>
                                <div class="row-label-desc">This is the main username that will be visible for everyone</div>
                            </div>
                            <div class="row-input">
                                <div class="input-with-icon">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ old('name', auth()->user()->name) }}"
                                        placeholder="Enter your username"
                                        required
                                    >
                                </div>
                                @error('name')
                                    <p style="color:#e05555;font-size:0.74rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Profile Picture --}}
                        <div class="section-row">
                            <div class="row-label">
                                <div class="row-label-title">Profile Picture</div>
                                <div class="row-label-desc">This is where people will see your actual face</div>
                            </div>
                            <div class="row-input">
                                <div class="picture-row">
                                    <div class="current-avatar" id="avatarPreview">
                                        @if (auth()->user()?->profile_photo_path)
                                            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Avatar" id="avatarImg">
                                        @else
                                            <svg fill="currentColor" viewBox="0 0 24 24" id="avatarPlaceholderIcon">
                                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                            </svg>
                                        @endif
                                    </div>

                                    <label class="upload-box" for="profile_photo">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="upload-text">
                                            <a href="#">Click here</a> to upload your file or drag.
                                        </p>
                                        <p class="upload-hint">Supported Format: SVG, JPG, PNG (10mb each)</p>
                                        <input
                                            type="file"
                                            name="profile_photo"
                                            id="profile_photo"
                                            class="upload-input"
                                            accept="image/svg+xml, image/jpeg, image/png"
                                        >
                                    </label>
                                </div>
                                @error('profile_photo')
                                    <p style="color:#e05555;font-size:0.74rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>

                {{-- ── CHANGE PASSWORD ── --}}
                <div class="section">
                    <div class="section-top">
                        <div>
                            <div class="section-label">Change my password</div>
                            <div class="section-desc">Update your password to keep your account secure.</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;">
                            @if (session('password_success'))
                                <span style="font-size:0.78rem;font-weight:600;color:#1a8a5a;display:flex;align-items:center;gap:5px;">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    {{ session('password_success') }}
                                </span>
                            @endif
                            <button class="btn-save" form="password-form" type="submit">Save</button>
                        </div>
                    </div>

                    <form id="password-form" method="POST" action="{{ route('student.settings.update-password') }}">
                        @csrf
                        @method('PUT')

                        <div class="section-row">
                            <div class="row-label">
                                {{-- intentionally blank to align with inputs --}}
                            </div>
                            <div class="row-input">
                                <div class="password-fields">

                                    <div class="input-labeled">
                                        <span class="input-prefix">Current Password</span>
                                        <input
                                            type="password"
                                            name="current_password"
                                            placeholder="Enter current password"
                                            autocomplete="current-password"
                                        >
                                    </div>
                                    @error('current_password')
                                        <p style="color:#e05555;font-size:0.74rem;margin-top:-6px;">{{ $message }}</p>
                                    @enderror

                                    <div class="input-labeled">
                                        <span class="input-prefix">New Password</span>
                                        <input
                                            type="password"
                                            name="password"
                                            placeholder="Enter new password"
                                            autocomplete="new-password"
                                        >
                                    </div>
                                    @error('password')
                                        <p style="color:#e05555;font-size:0.74rem;margin-top:-6px;">{{ $message }}</p>
                                    @enderror

                                    <div class="input-labeled">
                                        <span class="input-prefix">Confirm Password</span>
                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            placeholder="Confirm new password"
                                            autocomplete="new-password"
                                        >
                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div><!-- /settings-card -->

        </div><!-- /content-inner -->
        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

<script>
    document.getElementById('profile_photo').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (ev) {
            const preview = document.getElementById('avatarPreview');
            preview.innerHTML = `<img src="${ev.target.result}" alt="Preview" style="width:100%;height:100%;object-fit:cover;">`;
        };
        reader.readAsDataURL(file);
    });
</script>

</body>
</html>
