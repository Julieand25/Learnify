<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Student Dashboard</title>
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
            
            /* Category Colors from your Image */
            --cat-blue: #d1e3ff;
            --cat-pink: #fde2e4;
            --cat-orange: #fef0d5;
            --cat-green: #d1f5ea;
            
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--main-bg);
            color: var(--text-dark);
            overflow: hidden;
        }

        .app { display: flex; height: 100vh; width: 100vw; overflow: hidden; }

        /* ════════════ MAIN CONTENT ════════════ */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 28px;
            background: var(--main-bg);
            flex-shrink: 0;
        }

        .topbar h2 { font-size: 1.3rem; font-weight: 700; }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--card-bg);
            border-radius: 24px;
            padding: 6px 14px 6px 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .content { flex: 1; overflow-y: auto; padding: 0 28px 28px; }
        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #c0d0d8; border-radius: 10px; }

        /* ════════════ COURSE CATEGORIES ════════════ */
        .section-label { font-size: 1rem; font-weight: 700; margin-bottom: 20px; }
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .cat-card {
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            transition: transform 0.2s;
        }

        .cat-card:hover { transform: translateY(-3px); }
        .cat-info { display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 0.85rem; }
        .cat-card.physics { background: var(--cat-blue); color: #3b7ddd; }
        .cat-card.chemistry { background: var(--cat-pink); color: #d63384; }
        .cat-card.biology { background: var(--cat-orange); color: #fd7e14; }
        .cat-card.english { background: var(--cat-green); color: #198754; }

        /* ════════════ CONTENT LAYOUT ════════════ */
        .dashboard-body { display: grid; grid-template-columns: 1fr 300px; gap: 30px; }

        /* CHART AREA */
        .chart-container {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            border: 1px solid #eef2f5;
        }

        .chart-header { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .chart-title { font-size: 0.9rem; color: var(--text-mid); font-weight: 500; }
        .average-legend { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: var(--text-mid); }
        .dot { width: 10px; height: 10px; border-radius: 50%; background: #4a69bd; }

        /* ── Line chart inside chart-container ── */
        .chart-area {
            display: flex;
            align-items: flex-start;
            gap: 0;
        }

        .y-axis-labels {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
            padding-right: 10px;
            height: 280px;
            flex-shrink: 0;
        }

        .y-lbl {
            font-size: 0.65rem;
            color: #9aaabb;
            font-weight: 500;
            line-height: 1;
        }

        .chart-plot {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .line-wrap {
            height: 280px;
            position: relative;
            border-left: 1.5px solid #eef2f5;
            border-bottom: 1.5px solid #eef2f5;
            overflow: visible;
        }

        .hgrid {
            position: absolute;
            left: 0; right: 0;
            border-top: 1px dashed #eef2f5;
            pointer-events: none;
        }

        #studentChart {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            overflow: visible;
        }

        .x-row {
            display: flex;
            padding: 8px 0 0;
        }

        .x-item {
            flex: 1;
            text-align: center;
            font-size: 0.62rem;
            color: #5a6a7a;
            line-height: 1.3;
            word-break: break-word;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            padding: 0 3px;
        }

        /* STATISTICS SIDEBAR */
        .stat-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .stat-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }

        /* Circular Progress */
        .circular-progress {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: conic-gradient(#7467ef 32%, #f0f2f5 0);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
        }

        .circular-progress::before {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            background: #fff;
            border-radius: 50%;
        }

        .circular-progress img {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            z-index: 1;
            object-fit: cover;
        }

        .percent-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #7467ef;
            color: #fff;
            font-size: 0.65rem;
            padding: 3px 8px;
            border-radius: 10px;
            z-index: 2;
        }

        .stat-hint { font-size: 0.75rem; color: var(--text-light); margin-bottom: 30px; }

        /* MINI BAR CHART (notes progress) */
        .mini-chart-area {
            display: flex;
            align-items: flex-start;
            gap: 0;
            margin-bottom: 6px;
        }

        .mini-y-axis {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
            padding-right: 5px;
            height: 110px;
            flex-shrink: 0;
        }

        .mini-y-lbl {
            font-size: 0.52rem;
            color: #9aaabb;
            font-weight: 500;
            line-height: 1;
        }

        .mini-plot { flex: 1; display: flex; flex-direction: column; }

        .mini-plot-inner {
            height: 110px;
            position: relative;
            display: flex;
            align-items: stretch;
            gap: 8px;
            padding: 0 6px;
            border-left: 1px solid #e4edf0;
            border-bottom: 1px solid #e4edf0;
            overflow: visible;
        }

        .mini-grid-line {
            position: absolute;
            left: 0; right: 0;
            border-top: 1px dashed #eef2f5;
            pointer-events: none;
        }

        .mini-bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            flex: 1;
            position: relative;
        }

        .mini-bar {
            width: 100%;
            max-width: 26px;
            border-radius: 3px 3px 0 0;
        }

        .mini-bar.dark  { background: #6c63cc; }
        .mini-bar.light { background: #b3aee8; }

        .mini-x-row {
            display: flex;
            padding: 4px 6px 0;
        }

        .mini-x-item {
            flex: 1;
            text-align: center;
            font-size: 0.58rem;
            color: var(--text-mid);
            line-height: 1.2;
        }

    </style>
</head>
<body>

<div class="app">
    <x-student.sidebar active="dashboard" />

    <div class="main">
        <div class="topbar">
            <h2>Good morning, {{ auth()->user()->name ?? 'Student' }} 👋</h2>
            <div class="user-chip">
                @if (auth()->user()?->profile_photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                @else
                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
                    </div>
                @endif
                <span>{{ auth()->user()->name ?? 'Student' }}</span>
            </div>
        </div>

        <div class="content">
        <h3 class="section-label">Course Category</h3>
        <div class="categories-grid">
            <a href="{{ route('student.learning-module') }}" class="cat-card physics">
                <div class="cat-info">📁 Physics</div>
                <span>&rsaquo;</span>
            </a>
            <!--<a href="#" class="cat-card chemistry">
                <div class="cat-info">📁 Chemistry</div>
                <span>&rsaquo;</span>
            </a>
            <a href="#" class="cat-card biology">
                <div class="cat-info">📁 Biology</div>
                <span>&rsaquo;</span>
            </a>
            <a href="#" class="cat-card english">
                <div class="cat-info">📁 English</div>
                <span>&rsaquo;</span>
            </a>-->
        </div>

        <div class="dashboard-body">
            <div class="chart-container">
                <div class="chart-header">
                    <div class="chart-title">Physics - Electricity<br><small>Progress Score</small></div>
                    <div class="average-legend"><span class="dot"></span> Average grade</div>
                </div>

                <div class="chart-area">
                    <!-- Y-axis labels -->
                    <div class="y-axis-labels">
                        <span class="y-lbl">100</span>
                        <span class="y-lbl">80</span>
                        <span class="y-lbl">60</span>
                        <span class="y-lbl">40</span>
                        <span class="y-lbl">20</span>
                        <span class="y-lbl">0</span>
                    </div>

                    <!-- Plot -->
                    <div class="chart-plot">
                        <div class="line-wrap" id="studentChartWrap">
                            <div class="hgrid" style="bottom:20%;"></div>
                            <div class="hgrid" style="bottom:40%;"></div>
                            <div class="hgrid" style="bottom:60%;"></div>
                            <div class="hgrid" style="bottom:80%;"></div>
                            <div class="hgrid" style="bottom:100%;"></div>
                            <svg id="studentChart"></svg>
                        </div>
                        <div class="x-row">
                            <div class="x-item">Current &amp; Potential Difference</div>
                            <div class="x-item">Resistance</div>
                            <div class="x-item">Electromotive Force &amp; Internal Resistance</div>
                            <div class="x-item">Energy &amp; Electrical Power</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                @php $circPct = (int) round($notesPct / 4); @endphp
                <div class="stat-header">
                    <span style="font-weight:700">Statistic</span>
                    <!--<span>⋮</span>-->
                </div>

                <div class="circular-progress" style="background: conic-gradient(#7467ef {{ $circPct }}%, #f0f2f5 0);">
                    <span class="percent-badge">{{ $circPct }}%</span>
                    @if (auth()->user()?->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Avatar">
                    @else
                        <div style="width:110px;height:110px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:2rem;font-weight:700;z-index:1;">
                            {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
                        </div>
                    @endif
                </div>

                <p class="stat-hint">Continue your learning to achieve your target</p>

                <div class="mini-chart-area">
                    <div class="mini-y-axis">
                        <span class="mini-y-lbl">100</span>
                        <span class="mini-y-lbl">80</span>
                        <span class="mini-y-lbl">60</span>
                        <span class="mini-y-lbl">40</span>
                        <span class="mini-y-lbl">20</span>
                        <span class="mini-y-lbl">0</span>
                    </div>
                    <div class="mini-plot">
                        <div class="mini-plot-inner" id="miniBarPlot">
                            <div class="mini-grid-line" style="bottom:20%;"></div>
                            <div class="mini-grid-line" style="bottom:40%;"></div>
                            <div class="mini-grid-line" style="bottom:60%;"></div>
                            <div class="mini-grid-line" style="bottom:80%;"></div>
                            <div class="mini-grid-line" style="bottom:100%;"></div>
                        </div>
                        <div class="mini-x-row">
                            <span class="mini-x-item">3.1</span>
                            <span class="mini-x-item">3.2</span>
                            <span class="mini-x-item">3.3</span>
                            <span class="mini-x-item">3.4</span>
                        </div>
                    </div>
                </div>
                <p style="font-size:0.75rem; color:var(--teal); font-weight:700; margin-top:10px;">Learning Progress</p>
            </div>
        </div>
        </div><!-- /content -->
    </div><!-- /main -->
</div>

<script>
    const quizPct = {{ $quizPct ?? 0 }};
    const wrap    = document.getElementById('studentChartWrap');
    const svg     = document.getElementById('studentChart');
    const ns      = 'http://www.w3.org/2000/svg';
    const H       = 280;
    const n       = 4;
    const color   = '#4a69bd';

    function el(tag, attrs) {
        const e = document.createElementNS(ns, tag);
        Object.entries(attrs || {}).forEach(([k, v]) => e.setAttribute(k, v));
        return e;
    }

    function draw() {
        const W = wrap.clientWidth;
        function toX(i) { return ((2 * i + 1) / (2 * n)) * W; }
        function toY(v)  { return H - (v / 100) * H; }

        svg.innerHTML = '';

        const vals = [0, quizPct, 0, 0];
        const pts  = vals.map((v, i) => ({ x: toX(i), y: toY(v) }));

        // Smooth bezier path
        let d = `M ${pts[0].x} ${pts[0].y}`;
        for (let i = 0; i < pts.length - 1; i++) {
            const cp1x = pts[i].x + (pts[i+1].x - pts[i].x) * 0.4;
            const cp2x = pts[i+1].x - (pts[i+1].x - pts[i].x) * 0.4;
            d += ` C ${cp1x} ${pts[i].y}, ${cp2x} ${pts[i+1].y}, ${pts[i+1].x} ${pts[i+1].y}`;
        }

        svg.appendChild(el('path', { d, fill: 'none', stroke: color, 'stroke-width': '2', 'stroke-linecap': 'round' }));

        // Dots
        pts.forEach(p => {
            svg.appendChild(el('circle', { cx: p.x, cy: p.y, r: 5, fill: '#fff', stroke: color, 'stroke-width': 2 }));
            svg.appendChild(el('circle', { cx: p.x, cy: p.y, r: 3, fill: color }));
        });

        // Score label above Resistance dot
        if (quizPct > 0) {
            const lbl = document.createElementNS(ns, 'text');
            lbl.setAttribute('x', pts[1].x);
            lbl.setAttribute('y', pts[1].y - 10);
            lbl.setAttribute('font-family', 'Poppins, sans-serif');
            lbl.setAttribute('font-size', '10');
            lbl.setAttribute('fill', color);
            lbl.setAttribute('font-weight', '600');
            lbl.textContent = quizPct + '%';
            svg.appendChild(lbl);
        }
    }

    draw();
    window.addEventListener('resize', draw);

    // ── Mini notes-progress bar chart ──
    const notesPct  = {{ $notesPct ?? 0 }};
    const miniPlot  = document.getElementById('miniBarPlot');
    const miniH     = 110;

    [0, notesPct, 0, 0].forEach(function(pct) {
        const group = document.createElement('div');
        group.className = 'mini-bar-group';
        const bar = document.createElement('div');
        const heightPx = Math.max(2, (pct / 100) * miniH);
        bar.className = 'mini-bar ' + (pct === 100 ? 'dark' : 'light');
        bar.style.height = heightPx + 'px';
        group.appendChild(bar);
        miniPlot.appendChild(group);
    });
</script>
</body>
</html>