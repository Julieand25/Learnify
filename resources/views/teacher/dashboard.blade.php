<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Dashboard</title>
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
            --bar-blue: #5b5fc7;
            --bar-pink: #f06292;
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
           MAIN CONTENT
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

        .greeting h2 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
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

        .user-chip img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            background: #ccc;
        }

        .user-chip span {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Scrollable content area */
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 0 28px 28px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #c0d0d8; border-radius: 10px; }

        /* ══════════════════════════════
           TOP ROW: Chart + Calendar
        ══════════════════════════════ */
        .top-row {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 20px;
            align-items: start;
        }

        /* Chart Card */
        .chart-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 14px;
        }

        .chart-subject {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-mid);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .chart-legend {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            color: var(--text-mid);
        }

        .legend-dot {
            width: 24px;
            height: 3px;
            border-radius: 2px;
        }

        .legend-dot.blue { background: var(--bar-blue); }
        .legend-dot.pink { background: var(--bar-pink); }

        /* Chart layout: y-axis + bars + x-axis */
        .chart-outer {
            display: flex;
            gap: 6px;
            align-items: flex-start;
        }

        .y-axis-col {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 160px;
            flex-shrink: 0;
            width: 28px;
        }

        .y-axis-col span {
            font-size: 0.63rem;
            color: var(--text-light);
            text-align: right;
            line-height: 1;
        }

        .chart-col {
            flex: 1;
            min-width: 0;
        }

        /* Bar chart */
        .bar-chart {
            display: flex;
            align-items: flex-end;
            gap: 16px;
            height: 160px;
            position: relative;
            border-bottom: 1.5px solid #eef2f5;
            border-left: 1.5px solid #eef2f5;
        }

        /* Horizontal grid lines (absolute inside bar-chart) */
        .chart-hgrid {
            position: absolute;
            left: 0;
            right: 0;
            height: 1px;
            background: #eef2f5;
            pointer-events: none;
            z-index: 0;
        }

        .bar-group {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 4px;
            flex: 1;
            height: 100%;
            position: relative;
            z-index: 1;
        }

        .bar {
            width: 18px;
            border-radius: 4px 4px 0 0;
            transition: opacity 0.2s;
            cursor: pointer;
        }

        .bar:hover { opacity: 0.75; }
        .bar.blue { background: var(--bar-blue); }
        .bar.pink { background: var(--bar-pink); }

        /* X-axis student name labels */
        .x-axis-row {
            display: flex;
            gap: 16px;
            margin-top: 6px;
        }

        .x-label {
            flex: 1;
            font-size: 0.72rem;
            color: var(--text-mid);
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Calendar Card */
        .calendar-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .cal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .cal-title {
            font-size: 0.72rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .cal-month {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .cal-nav {
            display: flex;
            gap: 6px;
        }

        .cal-nav button {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 1px solid #e0eaee;
            background: var(--card-bg);
            cursor: pointer;
            font-size: 0.75rem;
            color: var(--text-mid);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .cal-nav button:hover { background: var(--teal-light); color: var(--teal); }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            text-align: center;
        }

        .cal-day-name {
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--text-light);
            padding: 4px 0;
        }

        .cal-day {
            font-size: 0.75rem;
            color: var(--text-mid);
            padding: 6px 4px;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cal-day:hover { background: var(--teal-light); color: var(--teal); }
        .cal-day.other-month { color: #c8d8e0; }
        .cal-day.today { background: var(--teal); color: #fff; font-weight: 700; }
        .cal-day.selected { background: var(--teal-light); color: var(--teal); font-weight: 600; }

        .cal-hint {
            font-size: 0.68rem;
            color: var(--text-light);
            margin-top: 12px;
            margin-bottom: 12px;
        }

        .btn-reminder {
            display: block;
            width: 100%;
            padding: 10px;
            background: var(--teal);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-reminder:hover { opacity: 0.88; }

        /* ── Calendar reminder panels ── */
        .cal-day { position: relative; }

        .cal-dot {
            position: absolute;
            bottom: 3px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--teal);
            pointer-events: none;
        }

        .cal-day.today .cal-dot { background: rgba(255,255,255,0.85); }
        .cal-day.has-reminder { font-weight: 600; }

        .cal-back-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .cal-back-btn {
            background: none;
            border: none;
            color: var(--teal);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .cal-back-btn:hover { text-decoration: underline; }

        .cal-panel-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .cal-date-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 12px;
        }

        .cal-date-pill {
            background: var(--teal-light);
            color: var(--teal);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 999px;
        }

        .cal-field { margin-bottom: 10px; }

        .cal-field label {
            display: block;
            font-size: 0.76rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 4px;
        }

        .cal-field input,
        .cal-field textarea {
            width: 100%;
            padding: 8px 11px;
            border: 1.5px solid #e0eaee;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.79rem;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s;
            background: #f7fbfc;
            resize: none;
            box-sizing: border-box;
        }

        .cal-field input:focus,
        .cal-field textarea:focus { border-color: var(--teal); background: #fff; }
        .cal-field textarea { height: 72px; }

        .cal-form-btns {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .cal-btn-save {
            flex: 1;
            padding: 9px;
            background: var(--teal);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.79rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .cal-btn-save:hover { opacity: 0.88; }

        .cal-btn-cancel {
            flex: 1;
            padding: 9px;
            background: #f0f6f8;
            color: var(--text-mid);
            border: 1.5px solid #d0e4e8;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.79rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .cal-btn-cancel:hover { background: #e4eff3; }

        .cal-btn-delete {
            flex: 1;
            padding: 9px;
            background: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.79rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .cal-btn-delete:hover { background: #fecaca; }

        .cal-detail-section {
            background: #f7fbfc;
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 8px;
        }

        .cal-detail-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 3px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cal-detail-value {
            font-size: 0.81rem;
            color: var(--text-dark);
            line-height: 1.5;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .cal-pencil-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--teal);
            padding: 0;
            display: flex;
            align-items: center;
        }

        .cal-pencil-btn:hover { color: var(--navy); }

        .cal-detail-input,
        .cal-detail-textarea {
            width: 100%;
            padding: 6px 10px;
            border: 1.5px solid var(--teal);
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.79rem;
            color: var(--text-dark);
            outline: none;
            background: #fff;
            resize: none;
            box-sizing: border-box;
            margin-top: 4px;
        }

        .cal-detail-textarea { height: 66px; }

        /* ══════════════════════════════
           STUDENT TABLE
        ══════════════════════════════ */
        .table-section {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .table-header h3 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .class-nav {
            background: none;
            border: none;
            color: var(--text-mid);
            font-size: 1rem;
            cursor: pointer;
            padding: 2px 6px;
            border-radius: 6px;
            transition: background 0.15s;
        }

        .class-nav:hover { background: var(--teal-light); color: var(--teal); }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-mid);
            text-align: left;
            padding: 10px 16px;
            border-bottom: 1.5px solid #eef2f5;
        }

        tbody tr {
            border-bottom: 1px solid #f2f6f8;
            transition: background 0.15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f7fbfc; }

        tbody td {
            padding: 14px 16px;
            font-size: 0.82rem;
            color: var(--text-dark);
            vertical-align: middle;
        }

        .student-img {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
            background: #dde8ee;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .student-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Placeholder avatar */
        .avatar-placeholder {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, #c8dde8, #a8c8d8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
            font-weight: 700;
            flex-shrink: 0;
        }

        .progress-links {
            display: flex;
            gap: 14px;
        }

        .progress-link {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.78rem;
            color: var(--text-mid);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .progress-link:hover { color: var(--teal); }

        .progress-link svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            .top-row { grid-template-columns: 1fr; }
            .calendar-card { max-width: 400px; }
        }

        @media (max-width: 768px) {
            .topbar { padding: 14px 20px; }
            .content { padding: 0 20px 20px; }
            .chart-card, .table-section { padding: 16px 16px; }
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
                white-space: normal !important;
                text-align: center;
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
                white-space: normal !important;
                text-align: center;
            }

            .sidebar-logout a .icon { width: 20px !important; height: 20px !important; }

            .main { order: 1; overflow-y: auto; flex: 1; }

            .user-chip span { display: none; }
            .user-chip { padding: 5px !important; border-radius: 50% !important; }

            .calendar-card { max-width: 100%; }

            /* Table: hide Image and Subject columns, allow horizontal scroll */
            .table-section { overflow-x: auto; }
            thead th:nth-child(1),
            thead th:nth-child(3),
            tbody td:nth-child(1),
            tbody td:nth-child(3) { display: none; }
        }

        @media (max-width: 400px) {
            .greeting h2 { font-size: 1rem; }
        }

    </style>
</head>
<body>

<div class="app">

    <!-- ══ SIDEBAR ══ -->
    <x-teacher.sidebar active="dashboard" />

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Top bar -->
        <div class="topbar">
            <div class="greeting">
                <h2>Good morning, {{ auth()->user()->name ?? 'Elin' }} 👋</h2>
            </div>
            <div class="topbar-right">
                <!--<button class="notif-btn">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>-->
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

            <!-- Top row: Chart + Calendar -->
            <div class="top-row">

                <!-- Bar Chart Card -->
                <div class="chart-card">
                    <div class="section-title">Student Progress Tracker</div>
                    <div class="chart-subject">PHYSIC</div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-dot blue"></div>
                            Notes Progress
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot pink"></div>
                            Quiz Progress
                        </div>
                    </div>
                    <div class="chart-outer">
                        <div class="y-axis-col">
                            <span>100</span>
                            <span>80</span>
                            <span>60</span>
                            <span>40</span>
                            <span>20</span>
                            <span>0</span>
                        </div>
                        <div class="chart-col">
                            <div class="bar-chart" id="barChart"></div>
                            <div class="x-axis-row" id="xAxisRow"></div>
                        </div>
                    </div>
                </div>

                <!-- Calendar Card -->
                <div class="calendar-card">

                    {{-- Panel 1: Calendar --}}
                    <div id="cal-panel">
                        <div class="cal-header">
                            <div>
                                <div class="cal-title">Calendar</div>
                                <div class="cal-month" id="calMonthLabel"></div>
                            </div>
                            <div class="cal-nav">
                                <button onclick="changeMonth(-1)">&#8249;</button>
                                <button onclick="changeMonth(1)">&#8250;</button>
                            </div>
                        </div>
                        <div class="cal-grid" id="calGrid"></div>
                        <p class="cal-hint">*Click a date to select; click a marked date to view its reminder</p>
                        <button class="btn-reminder" id="btnSetReminder" onclick="showFormPanel()" style="display:none;">Set Reminder</button>
                    </div>

                    {{-- Panel 2: Set reminder form --}}
                    <div id="reminder-form-panel" style="display:none;">
                        <div class="cal-back-header">
                            <!--<button class="cal-back-btn" onclick="showCalendarPanel()">&#8592; Back</button>-->
                            <span class="cal-panel-title">Set Reminder</span>
                        </div>
                        <div id="formDatePills" class="cal-date-pills"></div>
                        <div class="cal-field">
                            <label for="calEventName">Event Name</label>
                            <input type="text" id="calEventName" placeholder="Enter event name">
                        </div>
                        <div class="cal-field">
                            <label for="calEventDetails">Details</label>
                            <textarea id="calEventDetails" placeholder="Enter event details (optional)"></textarea>
                        </div>
                        <div class="cal-form-btns">
                            <button class="cal-btn-cancel" onclick="showCalendarPanel()">Cancel</button>
                            <button class="cal-btn-save" onclick="saveReminder()">Save</button>
                        </div>
                    </div>

                    {{-- Panel 3: Event detail --}}
                    <div id="reminder-detail-panel" style="display:none;">
                        <div class="cal-back-header">
                            <!--<button class="cal-back-btn" onclick="showCalendarPanel()">&#8592;Back</button>-->
                            <span class="cal-panel-title" id="detailDateLabel"></span>
                        </div>
                        <div class="cal-detail-section" id="detailNameSection"></div>
                        <div class="cal-detail-section" id="detailDetailsSection"></div>
                        <div class="cal-form-btns" id="detailBtns"></div>
                    </div>

                </div>

            </div>

            <!-- Student Table -->
            <div class="table-section">
                <div class="table-header">
                    <button class="class-nav" id="prevClassBtn" onclick="changeClass(-1)">&#8249;</button>
                    <h3 id="classNameLabel">—</h3>
                    <button class="class-nav" id="nextClassBtn" onclick="changeClass(1)">&#8250;</button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Student Name</th>
                            <th>Subject</th>
                            <th>Detailed Progress</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                    </tbody>
                </table>
            </div>

        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

<script>
    // ── REAL CLASS DATA ──
    const classesData = @json($classesData->values());
    let currentClassIdx = 0;

    const chartEl      = document.getElementById('barChart');
    const xAxisEl      = document.getElementById('xAxisRow');
    const tableBody    = document.getElementById('studentTableBody');
    const classLabel   = document.getElementById('classNameLabel');
    const prevBtn      = document.getElementById('prevClassBtn');
    const nextBtn      = document.getElementById('nextClassBtn');
    const chartHeight  = 160; // must match .bar-chart height in CSS

    function renderBarChart(studentsData) {
        chartEl.innerHTML = '';
        xAxisEl.innerHTML = '';

        if (studentsData.length === 0) {
            chartEl.innerHTML = '<span style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:0.8rem;color:#9aaabb;">No students yet</span>';
            return;
        }

        // Horizontal grid lines at 20 / 40 / 60 / 80 / 100 %
        [20, 40, 60, 80, 100].forEach(pct => {
            const line = document.createElement('div');
            line.className = 'chart-hgrid';
            line.style.bottom = (pct / 100 * chartHeight) + 'px';
            chartEl.appendChild(line);
        });

        studentsData.forEach(s => {
            // Bar group (bars only — label is in x-axis row below)
            const group = document.createElement('div');
            group.className = 'bar-group';

            const bBlue = document.createElement('div');
            bBlue.className = 'bar blue';
            bBlue.style.height = (s.notes_pct / 100 * chartHeight) + 'px';
            bBlue.title = `Notes: ${s.notes_pct}%`;

            const bPink = document.createElement('div');
            bPink.className = 'bar pink';
            bPink.style.height = (s.quiz_pct / 100 * chartHeight) + 'px';
            bPink.title = `Quiz: ${s.quiz_label}`;

            group.appendChild(bBlue);
            group.appendChild(bPink);
            chartEl.appendChild(group);

            // X-axis label below the chart
            const lbl = document.createElement('div');
            lbl.className = 'x-label';
            lbl.textContent = s.name.split(' ')[0];
            xAxisEl.appendChild(lbl);
        });
    }

    function renderTable(cls) {
        tableBody.innerHTML = '';
        if (cls.studentsData.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:24px;color:#9aaabb;">No students enrolled yet.</td></tr>';
            return;
        }
        cls.studentsData.forEach(s => {
            const avatarHtml = s.photo_url
                ? `<img src="${s.photo_url}" alt="${s.name}" style="width:44px;height:44px;border-radius:10px;object-fit:cover;">`
                : `<div class="avatar-placeholder">${s.initial}</div>`;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${avatarHtml}</td>
                <td>${s.name}</td>
                <td>${cls.subject}</td>
                <td>
                    <div class="progress-links">
                        <a href="${s.notes_url}" class="progress-link">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;flex-shrink:0;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Notes
                        </a>
                        <a href="${s.quiz_url}" class="progress-link">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;flex-shrink:0;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Quiz
                        </a>
                    </div>
                </td>`;
            tableBody.appendChild(row);
        });
    }

    function renderClass(idx) {
        if (classesData.length === 0) {
            classLabel.textContent = 'No Classes';
            prevBtn.disabled = true;
            nextBtn.disabled = true;
            tableBody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:24px;color:#9aaabb;">No classes created yet.</td></tr>';
            chartEl.innerHTML = '<span style="font-size:0.8rem;color:#9aaabb;">No data</span>';
            return;
        }
        const cls = classesData[idx];
        classLabel.textContent = cls.name + ' Students';
        prevBtn.disabled = idx === 0;
        nextBtn.disabled = idx === classesData.length - 1;
        renderTable(cls);
        renderBarChart(cls.studentsData);
    }

    function changeClass(dir) {
        currentClassIdx = Math.max(0, Math.min(classesData.length - 1, currentClassIdx + dir));
        renderClass(currentClassIdx);
    }

    renderClass(0);

    // ── CALENDAR ──
    const _now = new Date();
    let currentYear  = _now.getFullYear();
    let currentMonth = _now.getMonth(); // 0-indexed
    const selectedDates = new Set();
    const today = new Date();

    // remindersMap: { 'YYYY-MM-DD': { id, event_name, event_details } }
    const remindersMap = @json($remindersForJs);

    let calState    = 'calendar'; // 'calendar' | 'form' | 'detail'
    let detailDate  = null;
    let editingName = false;
    let editingDets = false;

    const dayNames   = ['S','M','T','W','T','F','S'];
    const monthNames = ['January','February','March','April','May','June',
                        'July','August','September','October','November','December'];

    function toIso(y, m, d) {
        return `${y}-${String(m + 1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
    }

    function fmtIso(iso) {
        const [y, m, d] = iso.split('-');
        return `${monthNames[parseInt(m) - 1]} ${parseInt(d)}, ${y}`;
    }

    function esc(str) {
        if (!str) return '';
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // ── Panel switching ──
    function showCalendarPanel() {
        editingName = false;
        editingDets = false;
        document.getElementById('cal-panel').style.display              = '';
        document.getElementById('reminder-form-panel').style.display    = 'none';
        document.getElementById('reminder-detail-panel').style.display  = 'none';
        renderCalendar();
    }

    function showFormPanel() {
        if (selectedDates.size === 0) return;
        document.getElementById('cal-panel').style.display              = 'none';
        document.getElementById('reminder-form-panel').style.display    = '';
        document.getElementById('reminder-detail-panel').style.display  = 'none';

        // Populate date pills
        const pillsEl = document.getElementById('formDatePills');
        pillsEl.innerHTML = '';
        [...selectedDates].sort().forEach(iso => {
            const pill = document.createElement('span');
            pill.className   = 'cal-date-pill';
            pill.textContent = fmtIso(iso);
            pillsEl.appendChild(pill);
        });

        document.getElementById('calEventName').value    = '';
        document.getElementById('calEventDetails').value = '';
        setTimeout(() => document.getElementById('calEventName').focus(), 50);
    }

    function showDetailPanel(iso) {
        detailDate  = iso;
        editingName = false;
        editingDets = false;
        document.getElementById('cal-panel').style.display              = 'none';
        document.getElementById('reminder-form-panel').style.display    = 'none';
        document.getElementById('reminder-detail-panel').style.display  = '';
        document.getElementById('detailDateLabel').textContent = fmtIso(iso);
        renderDetailContent();
    }

    // ── Detail panel rendering ──
    const pencilSvg = `<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>`;

    function renderDetailSection(sectionId, label, value, field, isEditing, inputType) {
        const section = document.getElementById(sectionId);
        if (isEditing) {
            const inputId = field === 'name' ? 'editName' : 'editDets';
            section.innerHTML = `
                <div class="cal-detail-label">${label}</div>
                ${inputType === 'input'
                    ? `<input type="text" class="cal-detail-input" id="${inputId}" value="${esc(value === '—' ? '' : (value || ''))}">`
                    : `<textarea class="cal-detail-textarea" id="${inputId}">${esc(value === '—' ? '' : (value || ''))}</textarea>`
                }`;
            setTimeout(() => { const el = document.getElementById(inputId); if (el) el.focus(); }, 30);
        } else {
            section.innerHTML = `
                <div class="cal-detail-label">
                    ${label}
                    <button class="cal-pencil-btn" onclick="startEdit('${field}')" title="Edit">${pencilSvg}</button>
                </div>
                <div class="cal-detail-value">${(value === null || value === '') ? '—' : esc(value)}</div>`;
        }
    }

    function renderDetailContent() {
        const r = remindersMap[detailDate];
        renderDetailSection('detailNameSection',    'Event Name', r.event_name,    'name', editingName, 'input');
        renderDetailSection('detailDetailsSection', 'Details',    r.event_details, 'dets', editingDets, 'textarea');

        const btns = document.getElementById('detailBtns');
        if (editingName || editingDets) {
            btns.innerHTML = `
                <button class="cal-btn-cancel" onclick="cancelEdit()">Cancel</button>
                <button class="cal-btn-save"   onclick="updateReminder()">Save</button>`;
        } else {
            btns.innerHTML = `
                <button class="cal-btn-cancel"  onclick="showCalendarPanel()">Back</button>
                <button class="cal-btn-delete"  onclick="deleteReminder()">Delete</button>`;
        }
    }

    function startEdit(field) {
        if (field === 'name') editingName = true;
        else                  editingDets = true;
        renderDetailContent();
    }

    function cancelEdit() {
        editingName = false;
        editingDets = false;
        renderDetailContent();
    }

    // ── AJAX: save new reminder ──
    async function saveReminder() {
        const name    = document.getElementById('calEventName').value.trim();
        const details = document.getElementById('calEventDetails').value.trim();
        if (!name) { document.getElementById('calEventName').focus(); return; }

        try {
            const res  = await fetch('{{ route("teacher.reminders.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ dates: [...selectedDates].sort(), event_name: name, event_details: details || null }),
            });
            const data = await res.json();
            Object.entries(data).forEach(([date, r]) => { remindersMap[date] = r; });
            selectedDates.clear();
            showCalendarPanel();
        } catch (e) { console.error(e); }
    }

    // ── AJAX: update existing reminder ──
    async function updateReminder() {
        const r       = remindersMap[detailDate];
        const name    = editingName ? (document.getElementById('editName')?.value ?? '').trim() : r.event_name;
        const details = editingDets ? (document.getElementById('editDets')?.value ?? '').trim() : r.event_details;
        if (!name) { if (editingName) document.getElementById('editName')?.focus(); return; }

        try {
            const res     = await fetch(`/teacher/reminders/${r.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ event_name: name, event_details: details || null }),
            });
            const updated = await res.json();
            remindersMap[detailDate] = updated;
            editingName = false;
            editingDets = false;
            renderDetailContent();
        } catch (e) { console.error(e); }
    }

    // ── AJAX: delete reminder ──
    async function deleteReminder() {
        const r = remindersMap[detailDate];
        try {
            await fetch(`/teacher/reminders/${r.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            });
            delete remindersMap[detailDate];
            detailDate = null;
            showCalendarPanel();
        } catch (e) { console.error(e); }
    }

    // ── Render calendar ──
    function updateReminderBtn() {
        document.getElementById('btnSetReminder').style.display = selectedDates.size > 0 ? 'block' : 'none';
    }

    function renderCalendar() {
        const grid  = document.getElementById('calGrid');
        const label = document.getElementById('calMonthLabel');
        grid.innerHTML = '';
        label.textContent = `${monthNames[currentMonth]} ${currentYear}`;

        dayNames.forEach(d => {
            const el = document.createElement('div');
            el.className = 'cal-day-name';
            el.textContent = d;
            grid.appendChild(el);
        });

        const firstDay    = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const prevDays    = new Date(currentYear, currentMonth, 0).getDate();

        for (let i = firstDay - 1; i >= 0; i--) {
            const el = document.createElement('div');
            el.className = 'cal-day other-month';
            el.textContent = prevDays - i;
            grid.appendChild(el);
        }

        for (let d = 1; d <= daysInMonth; d++) {
            const el      = document.createElement('div');
            el.className  = 'cal-day';
            el.textContent = d;

            const iso     = toIso(currentYear, currentMonth, d);
            const isToday = d === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear();

            if (isToday)               el.classList.add('today');
            if (selectedDates.has(iso)) el.classList.add('selected');

            if (remindersMap[iso]) {
                el.classList.add('has-reminder');
                const dot = document.createElement('span');
                dot.className = 'cal-dot';
                el.appendChild(dot);
            }

            el.addEventListener('click', () => {
                if (remindersMap[iso]) {
                    showDetailPanel(iso);
                } else {
                    if (isToday) return;
                    if (selectedDates.has(iso)) selectedDates.delete(iso);
                    else selectedDates.add(iso);
                    renderCalendar();
                    updateReminderBtn();
                }
            });

            grid.appendChild(el);
        }

        const total     = firstDay + daysInMonth;
        const remaining = total % 7 === 0 ? 0 : 7 - (total % 7);
        for (let d = 1; d <= remaining; d++) {
            const el = document.createElement('div');
            el.className = 'cal-day other-month';
            el.textContent = d;
            grid.appendChild(el);
        }

        updateReminderBtn();
    }

    function changeMonth(dir) {
        currentMonth += dir;
        if (currentMonth > 11) { currentMonth = 0; currentYear++; }
        if (currentMonth < 0)  { currentMonth = 11; currentYear--; }
        renderCalendar();
    }

    renderCalendar();
</script>

</body>
</html>