<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Learning Module</title>
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
            --grey-card: #8e9499;
            --green-card: #00c853;
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

        /* MAIN */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }

        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 28px; background: var(--main-bg);
        }

        .topbar h2 { font-size: 1.3rem; font-weight: 700; }

        .user-chip {
            display: flex; align-items: center; gap: 10px; background: var(--card-bg);
            border-radius: 24px; padding: 6px 14px 6px 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .user-chip span {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* CONTENT */
        .content { flex: 1; overflow-y: auto; padding: 0 28px 28px; }
        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #c0d0d8; border-radius: 10px; }

        /* PAGE HEADER */
        .page-header { margin-bottom: 20px; }
        .page-header h3 { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
        .page-header p  { font-size: 0.8rem; color: var(--text-mid); line-height: 1.6; }

        /* JOIN SECTION */
        .join-section {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px 24px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
            margin-bottom: 24px;
        }

        .join-section-title { font-size: 0.85rem; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
        .join-section-sub   { font-size: 0.75rem; color: var(--text-mid); margin-bottom: 14px; }

        .join-row { display: flex; gap: 10px; align-items: center; }

        .join-input {
            flex: 1;
            padding: 10px 16px;
            border-radius: 10px;
            border: 1.5px solid #d8e8ea;
            font-family: 'Poppins', sans-serif;
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--navy);
            background: #f7fbfc;
            letter-spacing: 1.5px;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
            text-transform: uppercase;
        }

        .join-input::placeholder { font-weight: 400; letter-spacing: 0.5px; color: var(--text-light); text-transform: none; }
        .join-input:focus { border-color: var(--teal); background: #fff; }

        .btn-search {
            padding: 10px 22px;
            border-radius: 10px;
            border: none;
            background: var(--teal);
            font-family: 'Poppins', sans-serif;
            font-size: 0.84rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            white-space: nowrap;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }

        .btn-search:hover { opacity: 0.88; }

        /* Join message (error / info) */
        .join-msg {
            margin-top: 10px;
            font-size: 0.78rem;
            font-weight: 600;
            display: none;
            align-items: center;
            gap: 6px;
        }

        .join-msg.error   { color: #c0392b; display: flex; }
        .join-msg.info    { color: var(--text-mid); display: flex; }
        .join-msg svg     { width: 14px; height: 14px; flex-shrink: 0; }

        /* Found-class result card */
        .found-result {
            display: none;
            margin-top: 14px;
            background: #f7fbfc;
            border: 1.5px solid #d8e8ea;
            border-radius: 12px;
            padding: 14px 18px;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .found-result.show { display: flex; }

        .found-color-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .found-info { flex: 1; min-width: 0; }
        .found-info strong { display: block; font-size: 0.88rem; color: var(--text-dark); font-weight: 700; }
        .found-info span   { font-size: 0.75rem; color: var(--text-mid); }

        .btn-enroll {
            padding: 9px 20px;
            border-radius: 10px;
            border: none;
            background: var(--navy);
            font-family: 'Poppins', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            white-space: nowrap;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }

        .btn-enroll:hover { opacity: 0.85; }

        /* ENROLLED CLASS GRID — identical to my-classes */
        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            align-content: start;
        }

        .class-card {
            height: 160px;
            border-radius: 16px;
            position: relative;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            cursor: pointer;
            text-decoration: none;
            background-repeat: no-repeat;
            background-position: right bottom;
            background-size: auto 85%;
        }

        .class-card:hover { transform: translateY(-5px); }

        .bg-grey   { background-color: var(--grey-card); }
        .bg-green  { background-color: var(--green-card); }
        .bg-teal   { background-color: var(--teal); }
        .bg-navy   { background-color: var(--navy); }
        .bg-purple { background-color: #6c63ff; }

        .computer-bg { background-image: url("{{ asset('images/computer-class-bgtest.png') }}"); }
        .book-bg     { background-image: url("{{ asset('images/book-class-bgtest.png') }}"); }

        .card-top { display: flex; align-items: flex-start; justify-content: space-between; }
        .class-info h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 2px; }
        .class-info p  { font-size: 0.75rem; opacity: 0.9; font-weight: 500; }
        .class-code    { font-size: 0.7rem; font-weight: 400; opacity: 0.8; }

        /* 3-dot menu — identical to my-classes */
        .card-menu-wrap { position: relative; flex-shrink: 0; }

        .card-menu-btn {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,0.25);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .card-menu-btn:hover { background: rgba(255,255,255,0.4); }

        .card-dropdown {
            display: none;
            position: absolute;
            top: 34px;
            right: 0;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            min-width: 130px;
            z-index: 50;
            overflow: hidden;
        }

        .card-dropdown.open { display: block; }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
            transition: background 0.15s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: 'Poppins', sans-serif;
        }

        .dropdown-item:hover { background: #f5fbfa; color: var(--teal); }
        .dropdown-item.danger:hover { background: #fdecea; color: #c0392b; }
        .dropdown-item svg { width: 14px; height: 14px; flex-shrink: 0; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            .class-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .topbar { padding: 14px 20px; }
            .content { padding: 0 20px 20px; }
            .join-section { padding: 16px 18px; }
        }

        @media (max-width: 640px) {
            html, body { overflow: auto; }

            .app { flex-direction: column; height: auto; min-height: 100vh; overflow: visible; }

            .sidebar {
                order: 2;
                width: 100% !important;
                flex-direction: row !important;
                height: 56px !important;
                padding: 0 !important;
                border-top: 1px solid #eef2f5;
                box-shadow: 0 -2px 8px rgba(0,0,0,0.06) !important;
            }

            .sidebar-logo { display: none !important; }

            .nav {
                flex-direction: row !important;
                gap: 0 !important;
                padding: 0 !important;
                flex: 1 !important;
                justify-content: space-around;
            }

            .nav li { flex: 1; display: flex; }

            .nav li a {
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                padding: 6px 4px !important;
                gap: 2px !important;
                font-size: 0.56rem !important;
                border-radius: 0 !important;
                width: 100%;
            }

            .nav li a .icon { width: 20px !important; height: 20px !important; opacity: 1 !important; }

            .sidebar-logout {
                width: auto !important;
                margin: 0 !important;
                flex-shrink: 0;
            }

            .sidebar-logout a {
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                padding: 6px 10px !important;
                gap: 2px !important;
                font-size: 0.56rem !important;
                border-radius: 0 !important;
                background: transparent !important;
                color: var(--text-mid) !important;
            }

            .sidebar-logout a .icon { width: 20px !important; height: 20px !important; }

            .main { order: 1; overflow-y: auto; flex: 1; }

            .user-chip span { display: none; }
            .user-chip { padding: 5px !important; border-radius: 50% !important; }

            .class-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 400px) {
            .topbar h2 { font-size: 0.95rem; }
            .join-row { flex-direction: column; align-items: stretch; }
            .btn-search { width: 100%; }
        }

    </style>
</head>
<body>

<div class="app">

    <x-student.sidebar active="learning-module" />

    <div class="main">

        <div class="topbar">
            <h2>Learning Module</h2>
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

        {{-- Flash banners --}}
        @if (session('success'))
        <div style="margin:0 28px 0;padding:12px 18px;background:#e6f9f0;border-radius:10px;color:#1a8a5a;font-size:0.84rem;font-weight:600;display:flex;align-items:center;gap:8px;">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div style="margin:0 28px 0;padding:12px 18px;background:#fdecea;border-radius:10px;color:#c0392b;font-size:0.84rem;font-weight:600;display:flex;align-items:center;gap:8px;">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            {{ session('error') }}
        </div>
        @endif

        <div class="content">

            <div class="page-header">
                <h3>My Classes{{ isset($subject) && $subject ? ' — ' . ucfirst($subject) : '' }}</h3>
                @if (isset($subject) && $subject)
                <p>
                    Showing <strong>{{ ucfirst($subject) }}</strong> classes only.
                    <a href="{{ route('student.learning-module') }}" style="color:var(--teal);font-weight:600;text-decoration:none;">View all</a>
                </p>
                @else
                <p>Your enrolled classes appear below. Use the search to join a new class.</p>
                @endif
            </div>

            <!-- Join a Class -->
            <div class="join-section">
                <div class="join-section-title">Join a Class</div>
                <div class="join-section-sub">Enter the class code given by your teacher.</div>
                <div class="join-row">
                    <input type="text" class="join-input" id="classCodeInput"
                           placeholder="e.g. CLS-ABC123" maxlength="20"
                           oninput="this.value = this.value.toUpperCase()">
                    <button type="button" class="btn-search" onclick="searchClass()">Search</button>
                </div>

                <div class="join-msg" id="joinMsg">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    <span id="joinMsgText"></span>
                </div>

                <!-- Found class result -->
                <div class="found-result" id="foundResult">
                    <div class="found-color-dot" id="foundDot"></div>
                    <div class="found-info">
                        <strong id="foundName"></strong>
                        <span id="foundTeacher"></span>
                    </div>
                    <form method="POST" action="{{ route('student.class.enroll') }}" id="enrollForm">
                        @csrf
                        <input type="hidden" name="code" id="enrollCode">
                        <button type="submit" class="btn-enroll">Enroll</button>
                    </form>
                </div>
            </div>

            <!-- Enrolled classes grid -->
            <div class="class-grid">
                @forelse ($enrolledClasses as $class)
                @php
                    $subjectUrl = match($class->subject) {
                        'physics' => route('student.physics-notes', ['class_id' => $class->id]),
                        default   => null,
                    };
                @endphp
                <div class="class-card {{ $class->color_class }} {{ $class->bg }}"
                     onclick="cardClick(event, {{ $subjectUrl ? "'$subjectUrl'" : 'null' }})"
                     style="{{ $subjectUrl ? '' : 'cursor:default;' }}">
                    <div class="card-top">
                        <div class="class-info">
                            <h3>{{ $class->name }}</h3>
                            <p>{{ $class->teacher->name ?? 'Unknown Teacher' }}</p>
                        </div>
                        <div class="card-menu-wrap">
                            <button class="card-menu-btn"
                                    onclick="toggleDropdown(event, {{ $class->id }})"
                                    title="Options">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5"  r="1.5"/>
                                    <circle cx="12" cy="12" r="1.5"/>
                                    <circle cx="12" cy="19" r="1.5"/>
                                </svg>
                            </button>
                            <div class="card-dropdown" id="dropdown-{{ $class->id }}">
                                <button class="dropdown-item danger"
                                        onclick="unenrollClass(event, {{ $class->id }}, '{{ addslashes($class->name) }}')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Unenroll
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="class-code">{{ $class->code }}</div>

                    <form id="unenroll-form-{{ $class->id }}" method="POST"
                          action="{{ route('student.class.unenroll', $class->id) }}"
                          style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                @empty
                <div style="grid-column:1/-1;text-align:center;color:var(--text-light);padding:48px 0;font-size:0.88rem;">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 12px;display:block;opacity:0.4;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    You haven't joined any class yet.<br>
                    <span style="font-size:0.78rem;">Enter a class code above to get started.</span>
                </div>
                @endforelse
            </div>


        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

<script>
    const colorMap = {
        grey:   '#8e9499',
        green:  '#00c853',
        teal:   '#2e8b84',
        navy:   '#1c3d6b',
        purple: '#6c63ff',
    };

    function searchClass() {
        const code = document.getElementById('classCodeInput').value.trim();

        clearResult();

        if (!code) { showError('Please enter a class code.'); return; }
        if (!/^CLS-[A-Z0-9]{4,}$/i.test(code)) {
            showError('Invalid format. Class codes look like CLS-ABC123.');
            return;
        }

        fetch('{{ route("student.class.search") }}?code=' + encodeURIComponent(code), {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (!data.found) {
                showError('No class found with that code. Please check and try again.');
                return;
            }
            if (data.enrolled) {
                showInfo('You\'re already enrolled in <strong>' + escHtml(data.name) + '</strong>.');
                return;
            }
            showFoundClass(data);
        })
        .catch(() => showError('Something went wrong. Please try again.'));
    }

    function showFoundClass(data) {
        document.getElementById('foundName').textContent    = data.name;
        document.getElementById('foundTeacher').textContent = 'Teacher: ' + data.teacher;
        document.getElementById('foundDot').style.background = colorMap[data.color] || '#8e9499';
        document.getElementById('enrollCode').value         = data.code;
        document.getElementById('foundResult').classList.add('show');
    }

    function showError(msg) {
        const el = document.getElementById('joinMsg');
        el.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>';
        el.className = 'join-msg error';
        document.getElementById('joinMsgText').textContent = msg;
    }

    function showInfo(html) {
        const el = document.getElementById('joinMsg');
        el.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';
        el.className = 'join-msg info';
        document.getElementById('joinMsgText').innerHTML = html;
    }

    function clearResult() {
        document.getElementById('joinMsg').className = 'join-msg';
        document.getElementById('foundResult').classList.remove('show');
    }

    function escHtml(str) {
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    document.getElementById('classCodeInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') searchClass();
    });

    // Clear result when user edits the input
    document.getElementById('classCodeInput').addEventListener('input', clearResult);

    // ── Card navigation ──
    function cardClick(e, url) {
        if (!url) return;
        window.location.href = url;
    }

    // ── 3-dot dropdown ──
    function toggleDropdown(e, id) {
        e.stopPropagation();
        const target = document.getElementById('dropdown-' + id);
        const isOpen = target.classList.contains('open');
        closeAllDropdowns();
        if (!isOpen) target.classList.add('open');
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.card-dropdown.open').forEach(d => d.classList.remove('open'));
    }

    function unenrollClass(e, id, name) {
        e.stopPropagation();
        closeAllDropdowns();
        if (confirm('Unenroll from "' + name + '"?\nYou can rejoin later with the class code.')) {
            document.getElementById('unenroll-form-' + id).submit();
        }
    }

    document.addEventListener('click', closeAllDropdowns);
</script>

</body>
</html>
