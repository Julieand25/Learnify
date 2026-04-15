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
            --line-color: #1a3a6b;
            --dot-color: #2f6de0;
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

        .back-btn svg { width: 16px; height: 16px; flex-shrink: 0; }

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
            padding: 24px 28px 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            max-width: 720px;
        }

        .chart-subject {
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text-mid);
            margin-bottom: 20px;
        }

        /* SVG chart container */
        .svg-wrap {
            width: 100%;
            position: relative;
        }

        .svg-wrap svg {
            width: 100%;
            height: auto;
            overflow: visible;
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
            <h2 style="font-size:1.3rem;font-weight:700;color:var(--text-dark);">Quiz Progress</h2>
            <div class="topbar-right">
                <button class="notif-btn">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                <div class="user-chip">
                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'N', 0, 1)) }}
                    </div>
                    <span>{{ auth()->user()->name ?? 'Nur Elin' }}</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">

            <!-- Page header -->
            <div class="page-header">
                <a href="{{ route('teacher.dashboard') }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Dashboard
                </a>
                <div class="header-text">
                    <h1 class="page-title">Quiz – Progress</h1>
                    <p class="page-subtitle">Student Name : {{ $student->name ?? 'Eden' }}</p>
                </div>
            </div>

            <!-- Chart card -->
            <div class="chart-card">
                <div class="chart-subject">Physics – Electricity</div>

                <div class="svg-wrap">
                    <svg id="lineChart" viewBox="0 0 620 300" xmlns="http://www.w3.org/2000/svg">
                        <!-- Will be rendered by JS -->
                    </svg>
                </div>
            </div>

        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

<script>
    // ── Data points ──
    // x: subtopic label, y: score 0–100
    const data = [
        { label: '3.1', value: 100 },
        { label: '3.2', value: 78  },
        { label: '3.3', value: 68  },
        { label: '3.4', value: 88  },
    ];

    // ── Chart dimensions (matches viewBox) ──
    const W        = 620;
    const H        = 300;
    const padLeft  = 70;   // room for y-axis labels
    const padRight = 60;   // room for "Subtopic" label
    const padTop   = 40;   // room for legend
    const padBot   = 50;   // room for x-axis labels

    const chartW = W - padLeft - padRight;
    const chartH = H - padTop - padBot;

    // Y ticks: 0%, 33%, 66%, 100%
    const yTicks = [0, 33, 66, 100];

    // Convert value → SVG y coordinate
    function toY(val) {
        return padTop + chartH - (val / 100) * chartH;
    }

    // X positions: evenly spaced
    function toX(i) {
        return padLeft + (i / (data.length - 1)) * chartW;
    }

    const svg = document.getElementById('lineChart');
    const ns  = 'http://www.w3.org/2000/svg';

    function el(tag, attrs = {}) {
        const e = document.createElementNS(ns, tag);
        Object.entries(attrs).forEach(([k, v]) => e.setAttribute(k, v));
        return e;
    }

    function txt(content, attrs = {}) {
        const e = el('text', attrs);
        e.textContent = content;
        return e;
    }

    // ── Grid lines & Y labels ──
    yTicks.forEach(tick => {
        const y = toY(tick);

        // Grid line
        svg.appendChild(el('line', {
            x1: padLeft, y1: y,
            x2: padLeft + chartW, y2: y,
            stroke: '#dde8ec',
            'stroke-width': 1,
            'stroke-dasharray': tick === 0 ? '0' : '4 3'
        }));

        // Y label
        svg.appendChild(txt(tick + '%', {
            x: padLeft - 10,
            y: y + 4,
            'text-anchor': 'end',
            'font-family': 'Poppins, sans-serif',
            'font-size': '11',
            fill: '#9aaabb'
        }));
    });

    // Y axis label "Progress Score"
    const yAxisLabel = txt('Progress Score', {
        x: 12,
        y: padTop + chartH / 2,
        'text-anchor': 'middle',
        'font-family': 'Poppins, sans-serif',
        'font-size': '10',
        fill: '#9aaabb',
        transform: `rotate(-90, 12, ${padTop + chartH / 2})`
    });
    svg.appendChild(yAxisLabel);

    // ── X axis labels ──
    data.forEach((d, i) => {
        svg.appendChild(txt(d.label, {
            x: toX(i),
            y: H - padBot + 22,
            'text-anchor': 'middle',
            'font-family': 'Poppins, sans-serif',
            'font-size': '12',
            fill: '#5a6a7a'
        }));
    });

    // "Subtopic" label at the right end of x-axis
    svg.appendChild(txt('Subtopic', {
        x: W - 4,
        y: H - padBot + 22,
        'text-anchor': 'end',
        'font-family': 'Poppins, sans-serif',
        'font-size': '11',
        fill: '#9aaabb'
    }));

    // ── Smooth curve using cubic bezier ──
    // Build path using smooth cubic bezier
    const points = data.map((d, i) => ({ x: toX(i), y: toY(d.value) }));

    function smoothPath(pts) {
        if (pts.length < 2) return '';
        let d = `M ${pts[0].x} ${pts[0].y}`;
        for (let i = 0; i < pts.length - 1; i++) {
            const cp1x = pts[i].x + (pts[i+1].x - pts[i].x) * 0.4;
            const cp1y = pts[i].y;
            const cp2x = pts[i+1].x - (pts[i+1].x - pts[i].x) * 0.4;
            const cp2y = pts[i+1].y;
            d += ` C ${cp1x} ${cp1y}, ${cp2x} ${cp2y}, ${pts[i+1].x} ${pts[i+1].y}`;
        }
        return d;
    }

    // Draw line
    svg.appendChild(el('path', {
        d: smoothPath(points),
        fill: 'none',
        stroke: '#1a3a6b',
        'stroke-width': '2',
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round'
    }));

    // ── Dots ──
    points.forEach((p, i) => {
        // Outer white ring
        svg.appendChild(el('circle', {
            cx: p.x, cy: p.y, r: 6,
            fill: '#ffffff',
            stroke: '#2f6de0',
            'stroke-width': 2
        }));
        // Inner fill
        svg.appendChild(el('circle', {
            cx: p.x, cy: p.y, r: 3.5,
            fill: '#2f6de0'
        }));
    });

    // ── Legend: "Grade" label with dot ──
    // Position it near top-right, just like the screenshot
    const legendX = padLeft + chartW * 0.75;
    const legendY = padTop - 12;

    svg.appendChild(el('circle', {
        cx: legendX, cy: legendY, r: 5,
        fill: '#2f6de0'
    }));

    svg.appendChild(txt('Grade', {
        x: legendX + 10,
        y: legendY + 4,
        'font-family': 'Poppins, sans-serif',
        'font-size': '11',
        fill: '#5a6a7a'
    }));
</script>

</body>
</html>