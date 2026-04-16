<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - {{ $classRoom->name }}</title>
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
            --purple: #6c63ff;
            --sidebar-w: 160px;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--main-bg);
            color: var(--text-dark);
            overflow: hidden;
        }

        /* ══════════════════════════════
           LAYOUT
        ══════════════════════════════ */
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
            position: relative;
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

        .sidebar-logo img {
            width: 44px;
            height: auto;
        }

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

        .nav li a:hover {
            background: var(--teal-light);
            color: var(--teal);
        }

        .nav li.active a {
            background: var(--teal-light);
            color: var(--teal);
            font-weight: 600;
        }

        .nav li a .icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.7;
        }

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

        /* Top bar */
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
            padding: 0 28px 28px;
        }

        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #c0d0d8; border-radius: 10px; }

        /* ══════════════════════════════
           PAGE HEADER ROW
        ══════════════════════════════ */
        .page-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 10px;
            border: 1.5px solid #d0e4e2;
            background: var(--card-bg);
            color: var(--teal);
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
            white-space: nowrap;
        }

        .back-btn:hover {
            background: var(--teal-light);
            border-color: var(--teal);
        }

        .back-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* ══════════════════════════════
           STUDENT TABLE CARD
        ══════════════════════════════ */
        .table-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 8px 0;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-light);
            text-align: left;
            padding: 12px 24px;
            background: #f7fbfc;
            border-bottom: 1px solid #eef4f5;
            letter-spacing: 0.3px;
        }

        tbody tr {
            border-bottom: 1px solid #f0f6f7;
            transition: background 0.15s;
            cursor: pointer;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f5fbfa; }

        tbody td {
            padding: 18px 24px;
            font-size: 0.84rem;
            color: var(--text-dark);
            vertical-align: middle;
        }

        /* Student name cell */
        .name-cell {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e0eaee;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .avatar svg {
            width: 20px;
            height: 20px;
            color: #a0b4be;
        }

        .student-name {
            font-weight: 500;
            color: var(--text-dark);
        }

        /* Class badge */
        .class-badge {
            font-size: 0.82rem;
            color: var(--text-mid);
            font-weight: 400;
        }

        /* Progress bar cell */
        .progress-cell {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .progress-bar-wrap {
            width: 190px;
            height: 6px;
            background: #e0eaee;
            border-radius: 999px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .progress-bar-fill {
            height: 100%;
            background: var(--purple);
            border-radius: 999px;
            transition: width 0.6s ease;
        }

        .progress-pct {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
            min-width: 36px;
        }
    </style>
</head>
<body>

<div class="app">

    <!-- ══ SIDEBAR ══ -->
    <x-teacher.sidebar active="my-classes" />

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Top bar -->
        <div class="topbar">
            <h2 style="font-size:1.3rem;font-weight:700;color:var(--text-dark);">Class Students</h2>
            <div class="topbar-right">
                <button class="notif-btn">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                <div class="user-chip">
                    @if (auth()->user()?->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                    @else
                        <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                            {{ strtoupper(substr(auth()->user()->name ?? 'N', 0, 1)) }}
                        </div>
                    @endif
                    <span>{{ auth()->user()->name ?? 'Nur Elin' }}</span>
                </div>
            </div>
        </div>

        <!-- Scrollable content -->
        <div class="content">

            <!-- Page header: back button + title -->
            <div class="page-header">
                <a href="{{ route('teacher.my-classes') }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    My Classes
                </a>
                <h1 class="page-title">{{ $classRoom->name }}</h1>
            </div>

            <!-- Table Card -->
            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Progress Quiz and Learning Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                        <tr>
                            <td>
                                <div class="name-cell">
                                    @if ($student->profile_photo_path)
                                        <img src="{{ asset('storage/' . $student->profile_photo_path) }}" alt="{{ $student->name }}" class="avatar" style="object-fit:cover;">
                                    @else
                                        <div class="avatar">
                                            <svg fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="student-name">{{ $student->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="class-badge">{{ $classRoom->name }}</span>
                            </td>
                            <td>
                                <div class="progress-cell">
                                    <div class="progress-bar-wrap">
                                        <div class="progress-bar-fill" style="width: 0%"></div>
                                    </div>
                                    <span class="progress-pct">—</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align:center;padding:24px;color:var(--text-light);">No students enrolled yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

</body>
</html>