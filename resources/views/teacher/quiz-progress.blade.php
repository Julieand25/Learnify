<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Quiz Progress</title>
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
            gap: 5px;
            color: var(--text-mid);
            font-size: 0.78rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-btn:hover { color: var(--teal); }
        .back-btn svg { width: 14px; height: 14px; flex-shrink: 0; }

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
            padding: 28px 32px 50px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            max-width: 720px;
        }

        .chart-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 28px;
        }

        /* ── Chart layout ── */
        .chart-area {
            display: flex;
            align-items: flex-start;
            gap: 0;
        }

        /* Y-axis — same height as chart container */
        .y-axis {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
            padding-right: 14px;
            height: 288px;
            flex-shrink: 0;
        }

        .y-label {
            font-size: 0.72rem;
            color: var(--text-light);
            font-weight: 500;
            line-height: 1;
        }

        .plot {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* Line chart container */
        .line-chart-wrap {
            height: 288px;
            position: relative;
            border-left: 1.5px solid #e4edf0;
            border-bottom: 1.5px solid #e4edf0;
            overflow: visible;
        }

        .grid-line {
            position: absolute;
            left: 0;
            right: 0;
            border-top: 1px dashed #dde8ec;
            pointer-events: none;
        }

        /* SVG fills the container */
        #lineChart {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: visible;
        }

        /* X-labels row — same width as chart, 4 equal columns */
        .x-labels-row {
            display: flex;
            padding: 10px 0 0;
        }

        .x-label-item {
            flex: 1;
            text-align: center;
            font-size: 0.7rem;
            color: var(--text-mid);
            line-height: 1.4;
            word-break: break-word;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            padding: 0 4px;
        }

        /* Legend */
        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 20px;
            font-size: 0.75rem;
            color: var(--text-mid);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

<div class="app">

    <!-- ══ SIDEBAR ══ -->
    <x-teacher.sidebar active="dashboard" />

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Topbar -->
        <div class="topbar">
            <a href="{{ route('teacher.dashboard') }}" class="back-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Back
            </a>
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

            <!-- Page header -->
            <div class="page-header">
                <div class="header-text">
                    <h1 class="page-title">Quiz – Progress</h1>
                    <p class="page-subtitle">Student Name: {{ $studentData->pluck('name')->implode(', ') }}</p>
                </div>
            </div>

            @if ($studentData->isEmpty())
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
                    <div class="chart-title">Physics – Electricity</div>

                    <div class="chart-area">

                        <!-- Y-axis labels -->
                        <div class="y-axis">
                            <span class="y-label">100</span>
                            <span class="y-label">80</span>
                            <span class="y-label">60</span>
                            <span class="y-label">40</span>
                            <span class="y-label">20</span>
                            <span class="y-label">0</span>
                        </div>

                        <!-- Plot -->
                        <div class="plot">
                            <div class="line-chart-wrap" id="lineChartWrap">
                                <div class="grid-line" style="bottom: 20%;"></div>
                                <div class="grid-line" style="bottom: 40%;"></div>
                                <div class="grid-line" style="bottom: 60%;"></div>
                                <div class="grid-line" style="bottom: 80%;"></div>
                                <div class="grid-line" style="bottom: 100%;"></div>
                                <svg id="lineChart"></svg>
                            </div>

                            <!-- X-labels: 4 equal columns align with SVG data points -->
                            <div class="x-labels-row">
                                <div class="x-label-item">Current &amp; Potential Difference</div>
                                <div class="x-label-item">Resistance</div>
                                <div class="x-label-item">Electromotive Force &amp; Internal Resistance</div>
                                <div class="x-label-item">Energy &amp; Electrical Power</div>
                            </div>
                        </div>

                    </div>

                    <!-- Legend -->
                    <!--<div class="legend" id="chartLegend"></div>-->
                </div>
            @endif

        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

<script>
    @if ($studentData->isNotEmpty())
    const students = @json($studentData->values());

    const colors  = ['#6c63cc','#2e8b84','#f06292','#ff9800','#00bcd4','#4caf50','#e91e63','#3f51b5'];
    const wrap    = document.getElementById('lineChartWrap');
    const svg     = document.getElementById('lineChart');
    const legend  = document.getElementById('chartLegend');
    const ns      = 'http://www.w3.org/2000/svg';
    const H       = 288;
    const n       = 4; // number of x-axis topics

    function el(tag, attrs) {
        const e = document.createElementNS(ns, tag);
        Object.entries(attrs || {}).forEach(([k, v]) => e.setAttribute(k, v));
        return e;
    }

    // Data points for each student: [0, quiz_pct, 0, 0]
    // X positions: center of each flex:1 column = (2i+1)/(2n) * W
    // This aligns exactly with the HTML x-label item centers
    function draw() {
        const W = wrap.clientWidth;

        function toX(i) { return ((2 * i + 1) / (2 * n)) * W; }
        function toY(v)  { return H - (v / 100) * H; }

        svg.innerHTML = '';

        students.forEach((s, si) => {
            const color = colors[si % colors.length];
            const vals  = [0, s.quiz_pct, 0, 0];
            const pts   = vals.map((v, i) => ({ x: toX(i), y: toY(v) }));

            // Smooth cubic bezier path
            let d = `M ${pts[0].x} ${pts[0].y}`;
            for (let i = 0; i < pts.length - 1; i++) {
                const cp1x = pts[i].x + (pts[i+1].x - pts[i].x) * 0.4;
                const cp2x = pts[i+1].x - (pts[i+1].x - pts[i].x) * 0.4;
                d += ` C ${cp1x} ${pts[i].y}, ${cp2x} ${pts[i+1].y}, ${pts[i+1].x} ${pts[i+1].y}`;
            }

            svg.appendChild(el('path', {
                d,
                fill: 'none',
                stroke: color,
                'stroke-width': '2',
                'stroke-linecap': 'round',
                'stroke-linejoin': 'round'
            }));

            // Dots
            pts.forEach(p => {
                svg.appendChild(el('circle', { cx: p.x, cy: p.y, r: 6, fill: '#fff', stroke: color, 'stroke-width': 2 }));
                svg.appendChild(el('circle', { cx: p.x, cy: p.y, r: 3.5, fill: color }));
            });

            // Score label above the Resistance dot (index 1)
            if (s.quiz_pct > 0) {
                const scoreLbl = document.createElementNS(ns, 'text');
                scoreLbl.setAttribute('x', pts[1].x);
                scoreLbl.setAttribute('y', pts[1].y - 12);
                scoreLbl.setAttribute('font-family', 'Poppins, sans-serif');
                scoreLbl.setAttribute('font-size', '10');
                scoreLbl.setAttribute('fill', color);
                scoreLbl.setAttribute('font-weight', '600');
                scoreLbl.textContent = s.quiz_pct + '%';
                svg.appendChild(scoreLbl);
            }
        });
    }

    draw();

    // Rebuild legend
    students.forEach((s, si) => {
        const color = colors[si % colors.length];
        const item  = document.createElement('div');
        item.className = 'legend-item';
        item.innerHTML = `<span class="legend-dot" style="background:${color};"></span><span>${s.name}</span>`;
        legend.appendChild(item);
    });

    // Redraw on resize
    window.addEventListener('resize', draw);
    @endif
</script>

</body>
</html>
