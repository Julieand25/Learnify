<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Notes Progress</title>
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
            --bar-dark: #6c63cc;
            --bar-light: #b3aee8;
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

        /* Topbar */
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
           PAGE HEADER
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
            flex-shrink: 0;
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

        .header-text { display: flex; flex-direction: column; gap: 2px; }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .page-subtitle {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-mid);
        }

        /* ══════════════════════════════
           CHART CARD
        ══════════════════════════════ */
        .chart-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 28px 32px 32px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            max-width: 720px;
        }

        .chart-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 28px;
        }

        /* ── Bar chart ── */
        .chart-area {
            display: flex;
            align-items: flex-end;
            gap: 0;
            position: relative;
        }

        /* Y-axis labels */
        .y-axis {
            display: flex;
            flex-direction: column-reverse;
            justify-content: space-between;
            align-items: flex-end;
            padding-right: 14px;
            padding-bottom: 52px; /* align with x-axis label height */
            height: 340px;
            flex-shrink: 0;
        }

        .y-label {
            font-size: 0.72rem;
            color: var(--text-light);
            font-weight: 500;
        }

        /* Chart plot area */
        .plot {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        /* Horizontal grid lines + bars together */
        .plot-inner {
            height: 288px;
            position: relative;
            display: flex;
            align-items: flex-end;
            gap: 32px;
            padding: 0 20px;
            border-left: 1.5px solid #e4edf0;
            border-bottom: 1.5px solid #e4edf0;
        }

        /* Grid lines */
        .plot-inner::before,
        .plot-inner::after,
        .grid-33,
        .grid-66 {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            border-top: 1px dashed #e4edf0;
        }

        .grid-line {
            position: absolute;
            left: 0;
            right: 0;
            border-top: 1px dashed #dde8ec;
        }

        /* Bar group */
        .bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .bar {
            width: 56px;
            border-radius: 6px 6px 0 0;
            transition: opacity 0.2s;
            cursor: pointer;
            position: relative;
        }

        .bar:hover { opacity: 0.8; }
        .bar.dark  { background: var(--bar-dark); }
        .bar.light { background: var(--bar-light); }

        /* X-axis labels */
        .x-labels {
            display: flex;
            gap: 32px;
            padding: 10px 20px 0;
        }

        .x-label {
            flex: 1;
            text-align: center;
            font-size: 0.72rem;
            color: var(--text-mid);
            line-height: 1.4;
        }
    </style>
</head>
<body>

<div class="app">

    <!-- ══ SIDEBAR ══ -->
    <x-teacher.sidebar active="my-classes" />

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Topbar -->
        <div class="topbar">
            <h2 style="font-size:1.3rem;font-weight:700;color:var(--text-dark);">Notes Progress</h2>
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

        <!-- Content -->
        <div class="content">

            <!-- Page header -->
            <div class="page-header">
                <a href="{{ route('teacher.my-classes.students', $classRoom->id) }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back
                </a>
                <div class="header-text">
                    <h1 class="page-title">Notes – Progress</h1>
                    <p class="page-subtitle">Student Name: {{ $studentProgress->pluck('name')->implode(', ') }}</p>
                </div>
            </div>

            @if ($studentProgress->isEmpty())
                <div style="background:#fff;border-radius:16px;padding:48px 32px;text-align:center;color:var(--text-mid);box-shadow:0 2px 12px rgba(0,0,0,0.06);max-width:520px;">
                    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 16px;display:block;color:#c0d0d8;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197"/>
                    </svg>
                    <p style="font-size:0.9rem;font-weight:600;">No students enrolled yet.</p>
                    <p style="font-size:0.8rem;margin-top:6px;">Share the class code so students can join.</p>
                </div>
            @else
                <!-- Chart card -->
                <div class="chart-card">
                    <div class="chart-title">Physics - Electricity</div>

                    <div class="chart-area">

                        <!-- Y-axis -->
                        <div class="y-axis">
                            <span class="y-label">0</span>
                            <span class="y-label">20</span>
                            <span class="y-label">40</span>
                            <span class="y-label">60</span>
                            <span class="y-label">80</span>
                            <span class="y-label">100</span>
                        </div>

                        <!-- Plot -->
                        <div class="plot">
                            <div class="plot-inner" id="barPlot">
                                <div class="grid-line" style="bottom: 20%;"></div>
                                <div class="grid-line" style="bottom: 40%;"></div>
                                <div class="grid-line" style="bottom: 60%;"></div>
                                <div class="grid-line" style="bottom: 80%;"></div>
                                <div class="grid-line" style="bottom: 100%;"></div>
                            </div>
                            <div class="x-labels" id="xLabels"></div>
                        </div>

                    </div>
                </div>

                <!-- Legend -->
                <div style="display:flex;gap:20px;margin-top:16px;font-size:0.75rem;color:var(--text-mid);">
                    <span style="display:flex;align-items:center;gap:6px;">
                        <span style="width:12px;height:12px;border-radius:3px;background:var(--bar-dark);display:inline-block;"></span>
                        Completed (3/3)
                    </span>
                    <span style="display:flex;align-items:center;gap:6px;">
                        <span style="width:12px;height:12px;border-radius:3px;background:var(--bar-light);display:inline-block;"></span>
                        In progress
                    </span>
                </div>
            @endif

        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

<script>
    @if ($studentProgress->isNotEmpty())
    const students = @json($studentProgress->values());

    const plotHeight = 288;
    const plot       = document.getElementById('barPlot');
    const xLabel     = document.getElementById('xLabels');

    students.forEach((s, i) => {
        const isDark   = s.sections_reached === 3;
        const heightPx = Math.max(4, (s.percent / 100) * plotHeight);

        // Bar group
        const group = document.createElement('div');
        group.className  = 'bar-group';
        group.style.cssText = 'display:flex;flex-direction:column;align-items:center;flex:1;';

        const bar = document.createElement('div');
        bar.className = 'bar ' + (isDark ? 'dark' : 'light');
        bar.style.height = heightPx + 'px';
        bar.style.width  = '56px';
        bar.title        = s.name + ': ' + s.sections_reached + '/3 sections (' + s.percent + '%)';

        // Percent label above bar
        const pctLbl = document.createElement('div');
        pctLbl.style.cssText = 'font-size:0.68rem;font-weight:600;color:var(--text-mid);margin-bottom:4px;';
        pctLbl.textContent   = s.percent + '%';

        group.appendChild(pctLbl);
        group.appendChild(bar);
        plot.appendChild(group);

        // X-axis label (student name)
        const lbl = document.createElement('div');
        lbl.className = 'x-label';
        lbl.style.cssText = 'flex:1;text-align:center;font-size:0.7rem;color:#5a6a7a;line-height:1.4;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:80px;';
        lbl.textContent   = s.name;
        lbl.title         = s.name;
        xLabel.appendChild(lbl);
    });
    @endif
</script>

</body>
</html>