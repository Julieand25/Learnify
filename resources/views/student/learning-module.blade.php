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
            --sidebar-w: 160px;
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
           SIDEBAR
        ══════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 0 20px;
            flex-shrink: 0;
            box-shadow: 2px 0 12px rgba(0,0,0,0.06);
            z-index: 10;
        }

        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            margin-bottom: 36px;
            padding: 0 16px;
        }

        .sidebar-logo img { width: 44px; height: auto; }

        .sidebar-logo span {
            font-size: 0.78rem;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: 2px;
        }

        .nav {
            list-style: none;
            width: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 0 12px;
        }

        .nav li a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-mid);
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }

        .nav li a:hover { background: var(--teal-light); color: var(--teal); }
        .nav li.active a { background: var(--teal-light); color: var(--teal); font-weight: 600; }
        .nav li a .icon { width: 18px; height: 18px; flex-shrink: 0; opacity: 0.7; }
        .nav li.active a .icon { opacity: 1; }

        .sidebar-logout {
            width: calc(100% - 24px);
            margin: 0 12px;
        }

        .sidebar-logout a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 10px;
            background: var(--navy);
            color: #fff;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            transition: opacity 0.2s;
            white-space: nowrap;
        }

        .sidebar-logout a:hover { opacity: 0.85; }

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

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 28px;
            background: var(--main-bg);
            flex-shrink: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notif-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: none;
            background: var(--card-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: box-shadow 0.2s;
        }

        .notif-btn:hover { box-shadow: 0 4px 14px rgba(0,0,0,0.12); }

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

        /* Scrollable content */
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 0 36px 36px;
        }

        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #c0d0d8; border-radius: 10px; }

        /* ══════════════════════════════
           PAGE TITLE
        ══════════════════════════════ */
        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        /* ══════════════════════════════
           DESCRIPTION
        ══════════════════════════════ */
        .page-desc {
            font-size: 0.9rem;
            color: var(--text-mid);
            text-align: center;
            max-width: 680px;
            margin: 0 auto 36px;
            line-height: 1.7;
        }

        /* ══════════════════════════════
           SUBJECT GRID
        ══════════════════════════════ */
        .subject-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            max-width: 760px;
        }

        /* Subject card */
        .subject-card {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
        }

        .subject-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        }

        /* Thumbnail area */
        .thumb {
            width: 100%;
            height: 120px;
            position: relative;
            overflow: hidden;
        }

        .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Coming soon overlay */
        .coming-overlay {
            position: absolute;
            inset: 0;
            background: rgba(220, 235, 238, 0.72);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .coming-label {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: 0.5px;
        }

        /* Subject name below thumbnail */
        .subject-name {
            padding: 10px 14px;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--text-mid);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="app">

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/learnify-logo.png') }}" alt="Learnify">
            <span>LEARNIFY</span>
        </div>

        <ul class="nav">
            <li>
                <a href="{{ route('student.dashboard') }}">
                    <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Learning Module
                </a>
            </li>
            <li>
                <a href="#">
                    <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Quiz
                </a>
            </li>
            <li>
                <a href="#">
                    <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Settings
                </a>
            </li>
        </ul>

        <div class="sidebar-logout">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </div>
    </aside>

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Topbar -->
        <div class="topbar">
            <div><!-- spacer --></div>
            <div class="topbar-right">
                <button class="notif-btn">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                <div class="user-chip">
                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'E', 0, 1)) }}
                    </div>
                    <span>{{ auth()->user()->name ?? 'Eden Hazard' }}</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">

            <h1 class="page-title">Learning Module</h1>

            <p class="page-desc">
                The Learning Module is designed as an all-in-one educational space where students can explore
                a variety of SPM subjects in an organized and engaging way.
            </p>

            <!-- Subject grid -->
            <div class="subject-grid">

                {{-- PHYSIC — available --}}
                <a href="{{ route('student.learning.physics') }}" class="subject-card">
                    <div class="thumb">
                        <img src="{{ asset('images/subjects/physics.jpg') }}" alt="Physics"
                             onerror="this.style.background='linear-gradient(135deg,#c8d8e8,#a0b8cc)';this.style.display='block';this.removeAttribute('src')">
                    </div>
                    <div class="subject-name">Physic</div>
                </a>

                {{-- BIOLOGY — coming soon --}}
                <div class="subject-card" style="cursor: default;">
                    <div class="thumb">
                        <img src="{{ asset('images/subjects/biology.jpg') }}" alt="Biology"
                             onerror="this.style.background='linear-gradient(135deg,#d4e8c8,#b0cca0)';this.style.display='block';this.removeAttribute('src')">
                        <div class="coming-overlay">
                            <span class="coming-label">Coming Soon</span>
                        </div>
                    </div>
                    <div class="subject-name">Biology</div>
                </div>

                {{-- CHEMISTRY — coming soon --}}
                <div class="subject-card" style="cursor: default;">
                    <div class="thumb">
                        <img src="{{ asset('images/subjects/chemistry.jpg') }}" alt="Chemistry"
                             onerror="this.style.background='linear-gradient(135deg,#e8d4c8,#ccb0a0)';this.style.display='block';this.removeAttribute('src')">
                        <div class="coming-overlay">
                            <span class="coming-label">Coming Soon</span>
                        </div>
                    </div>
                    <div class="subject-name">Chemistry</div>
                </div>

                {{-- MATHEMATICS — coming soon --}}
                <div class="subject-card" style="cursor: default;">
                    <div class="thumb">
                        <img src="{{ asset('images/subjects/mathematics.jpg') }}" alt="Mathematics"
                             onerror="this.style.background='linear-gradient(135deg,#e8e8c8,#cccca0)';this.style.display='block';this.removeAttribute('src')">
                        <div class="coming-overlay">
                            <span class="coming-label">Coming Soon</span>
                        </div>
                    </div>
                    <div class="subject-name">Mathematics</div>
                </div>

                {{-- HISTORY — coming soon --}}
                <div class="subject-card" style="cursor: default;">
                    <div class="thumb">
                        <img src="{{ asset('images/subjects/history.jpg') }}" alt="History"
                             onerror="this.style.background='linear-gradient(135deg,#e8d8b0,#ccba88)';this.style.display='block';this.removeAttribute('src')">
                        <div class="coming-overlay">
                            <span class="coming-label">Coming Soon</span>
                        </div>
                    </div>
                    <div class="subject-name">History</div>
                </div>

                {{-- ENGLISH — coming soon --}}
                <div class="subject-card" style="cursor: default;">
                    <div class="thumb">
                        <img src="{{ asset('images/subjects/english.jpg') }}" alt="English"
                             onerror="this.style.background='linear-gradient(135deg,#c8d4e8,#a0b4cc)';this.style.display='block';this.removeAttribute('src')">
                        <div class="coming-overlay">
                            <span class="coming-label">Coming Soon</span>
                        </div>
                    </div>
                    <div class="subject-name">English</div>
                </div>

            </div><!-- /subject-grid -->

        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

</body>
</html>