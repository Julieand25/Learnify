<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Chapter 3.2 Resistance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --teal: #3dbdb5;
            --teal-dark: #2aa19a;
            --teal-light: #dff4f2;
            --navy: #1c3d6b;
            --main-bg: #e2f5f3;
            --card-bg: #ffffff;
            --text-dark: #1a2b3c;
            --text-mid: #4a5a6a;
            --text-light: #8aaabb;
            --highlight: #b2eef0;
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
            flex-direction: column;
        }

        .chapter-header {
            background: var(--teal);
            padding: 20px 28px 18px;
            flex-shrink: 0;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,0.15);
            transition: background 0.2s;
        }

        .back-btn:hover { background: rgba(255,255,255,0.25); color: #fff; }
        .back-btn svg { width: 15px; height: 15px; }

        .chapter-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: #fff;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .notif-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-chip span {
            font-size: 0.82rem;
            font-weight: 600;
            color: #fff;
        }

        .chapter-sub-row {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .chapter-subtitle {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
        }

        .progress-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-track {
            flex: 1;
            height: 8px;
            background: rgba(255,255,255,0.35);
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 33%;
            background: #7c5cbf;
            border-radius: 999px;
        }

        .progress-label {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.85);
            white-space: nowrap;
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 28px 28px 60px;
        }

        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #b0ccd0; border-radius: 10px; }

        .section-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 36px 0 28px;
        }

        .section-divider-line {
            flex: 1;
            height: 1.5px;
            background: linear-gradient(to right, #c0dede, transparent);
        }

        .section-divider-line.right {
            background: linear-gradient(to left, #c0dede, transparent);
        }

        .intro-text {
            font-size: 0.84rem;
            color: var(--text-mid);
            line-height: 1.75;
            max-width: 820px;
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .notes-layout {
            display: grid;
            grid-template-columns: 1fr 1.4fr 180px;
            gap: 16px;
            margin-bottom: 16px;
        }

        .notes-bottom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .note-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 18px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .note-card-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .note-card-title .label { color: var(--teal-dark); }

        .speak-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            color: var(--text-light);
            transition: color 0.2s;
        }

        .speak-btn:hover { color: var(--teal-dark); }

        .note-list {
            list-style: disc;
            padding-left: 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .note-list li {
            font-size: 0.78rem;
            color: var(--text-mid);
            line-height: 1.55;
        }

        .hover-word {
            background: var(--highlight);
            border-radius: 3px;
            padding: 1px 3px;
            cursor: default;
            display: inline;
            font-weight: 500;
            color: var(--text-dark);
        }

        .word-tooltip {
            display: none;
            position: fixed;
            z-index: 9999;
            background: #2d3a4a;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 28px rgba(0,0,0,0.3);
            pointer-events: none;
            width: 200px;
        }

        .word-tooltip img { width: 100%; display: block; }

        .word-tooltip .tooltip-label {
            padding: 8px 12px;
            font-size: 0.72rem;
            font-weight: 600;
            color: #fff;
            text-align: center;
        }

        .circuit-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.76rem;
        }

        .circuit-table th {
            background: #f4f9fb;
            padding: 9px 12px;
            font-weight: 600;
            color: var(--text-dark);
            text-align: center;
            border: 1px solid #e0ecef;
        }

        .circuit-table td {
            padding: 10px 12px;
            border: 1px solid #e0ecef;
            text-align: center;
            color: var(--text-mid);
            line-height: 1.5;
            vertical-align: middle;
        }

        .circuit-table td:first-child {
            font-weight: 600;
            color: var(--text-dark);
            text-align: left;
            background: #fafcfd;
        }

        .notepad-card {
            background: #fef9c3;
            border-radius: 10px;
            padding: 14px;
            box-shadow: 3px 3px 10px rgba(0,0,0,0.1);
            position: relative;
            min-height: 140px;
        }

        .notepad-pin {
            position: absolute;
            top: -8px;
            right: 16px;
            font-size: 1.2rem;
        }

        .notepad-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #a08000;
            margin-bottom: 8px;
        }

        .notepad-input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 0.75rem;
            color: #5a4a00;
            resize: none;
            min-height: 80px;
            line-height: 1.6;
        }

        .sim-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .circuit-wrapper {
            background: #e0f5f1;
            border-radius: 16px;
            padding: 20px 24px 20px;
            margin-bottom: 20px;
        }

        .omega-val {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a6b5a;
            text-align: center;
            margin-bottom: 6px;
            font-family: 'Poppins', sans-serif;
        }

        .slider-container {
            position: relative;
            width: 220px;
            height: 28px;
            display: flex;
            align-items: center;
            margin: 0 auto 6px;
        }

        .slider-track-bg {
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 100%;
            height: 10px;
            border-radius: 5px;
            background: #b2e8de;
            pointer-events: none;
        }

        .slider-track-fill {
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            height: 10px;
            border-radius: 5px;
            background: #5db8a0;
            pointer-events: none;
            transition: width 0.15s;
        }

        input[type=range].short-slider {
            -webkit-appearance: none;
            appearance: none;
            width: 220px;
            height: 10px;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
            background: transparent;
            position: relative;
            z-index: 2;
            margin: 0;
        }

        input[type=range].short-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #1a6b5a;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.25);
        }

        input[type=range].short-slider::-moz-range-thumb {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #1a6b5a;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.25);
        }

        input[type=range].short-slider::-webkit-slider-runnable-track { background: transparent; }
        input[type=range].short-slider::-moz-range-track { background: transparent; }

        .slide-label {
            font-size: 0.72rem;
            color: #5a8a88;
            text-align: center;
            margin-bottom: 8px;
        }

        .bottom-nav {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
        }

        .nav-btn {
            background: #1a2b3c;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 18px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .nav-btn:hover { background: var(--teal-dark); }

        .svg-tooltip {
            display: none;
            position: fixed;
            z-index: 9999;
            pointer-events: none;
        }

        .svg-tooltip-inner {
            background: #2d6b5a;
            color: #fff;
            border-radius: 10px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            min-width: 110px;
        }

        .svg-tooltip-label {
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #fff;
            text-align: center;
            padding: 7px 18px;
            background: #2d6b5a;
        }

        .svg-tooltip-tag {
            background: #e0f5f1;
            color: #1a6b5a;
            font-family: 'Poppins', sans-serif;
            font-size: 0.7rem;
            font-weight: 600;
            text-align: center;
            padding: 3px 10px 5px;
            letter-spacing: 0.5px;
        }

        .electron-panel-wrap {
            display: none;
            margin-top: 8px;
            align-items: center;
            flex-direction: column;
            gap: 4px;
        }

        .electron-panel-wrap.visible { display: flex; }

        .electron-hint {
            font-size: 0.68rem;
            color: #4a7a72;
            font-weight: 600;
            text-align: center;
            margin-top: 4px;
            font-family: 'Poppins', sans-serif;
        }

        /* ── FLASH CARD SECTION ── */
        .fc-section-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .fc-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .fc-scene {
            perspective: 900px;
            height: 160px;
            cursor: pointer;
        }

        .fc-card {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.55s cubic-bezier(.4,0,.2,1);
        }

        .fc-card.flipped { transform: rotateY(180deg); }

        .fc-face {
            position: absolute;
            inset: 0;
            border-radius: 16px;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            text-align: center;
        }

        .fc-front { background: #2a8a82; }
        .fc-back  { background: var(--teal); transform: rotateY(180deg); }

        .fc-front-text {
            font-family: 'Poppins', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            color: #fff;
            line-height: 1.55;
        }

        .fc-back-text {
            font-family: 'Poppins', sans-serif;
            font-size: 0.76rem;
            font-weight: 400;
            color: #fff;
            line-height: 1.65;
        }

        .fc-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2px;
        }

        .fc-nav {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--teal-dark);
            padding: 6px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: background 0.18s;
            font-family: 'Poppins', sans-serif;
        }

        .fc-nav:hover { background: rgba(61,189,181,0.15); }
        .fc-nav svg { width: 22px; height: 22px; }

        .fc-test-btn {
            background: var(--teal-light);
            border: 1.5px solid var(--teal);
            border-radius: 20px;
            color: var(--text-dark);
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 8px 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: background 0.18s;
        }

        .fc-test-btn:hover { background: #c8eeeb; }

        .fc-hint {
            font-family: 'Poppins', sans-serif;
            font-size: 0.7rem;
            font-weight: 500;
            color: #5a8a88;
            text-align: center;
            margin-top: 14px;
            letter-spacing: 0.2px;
        }
    </style>
</head>
<body>

<!-- Image hover tooltip -->
<div class="word-tooltip" id="wordTooltip">
    <img id="tooltipImg" src="" alt="">
    <div class="tooltip-label" id="tooltipLabel"></div>
</div>

<!-- SVG component tooltip (battery / bulb) -->
<div class="svg-tooltip" id="svgTooltip">
    <div class="svg-tooltip-inner">
        <div class="svg-tooltip-label" id="svgTooltipLabel">BATTERY</div>
        <div class="svg-tooltip-tag" id="svgTooltipTag">Component</div>
    </div>
</div>

<div class="app">

    <!-- ══ CHAPTER HEADER ══ -->
    <div class="chapter-header">
        <div class="header-top">
            <div style="display:flex;align-items:center;gap:16px;">
                <a href="{{ route('student.physics-notes') }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back
                </a>
                <h1 class="chapter-title">Chapter 3: Electricity</h1>
            </div>
            <div class="header-right">
                <button class="notif-btn">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                <div class="user-chip">
                    <div style="width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'E', 0, 1)) }}
                    </div>
                    <span>{{ auth()->user()->name ?? 'Eden Hazard' }}</span>
                </div>
            </div>
        </div>
        <div class="chapter-sub-row">
            <span class="chapter-subtitle">3.2 Resistance</span>
            <div class="progress-wrap">
                <div class="progress-track">
                    <div class="progress-fill"></div>
                </div>
                <span class="progress-label">1/3</span>
            </div>
        </div>
    </div>

    <!-- ══ SCROLLABLE CONTENT ══ -->
    <div class="content">

        <p class="intro-text">
            This section focuses on Ohm's Law, which states that V is directly proportional to I for Ohmic conductors.
            It explores the factors that affect resistance (length, area, and resistivity) and explains how to calculate
            Effective Resistance in both Series and Parallel circuits. It also touches on advanced materials like Superconductors.
        </p>

        <h2 class="section-title">Main Notes</h2>

        <div class="notes-layout">

            <!-- 1. Ohm's Law -->
            <div class="note-card">
                <div class="note-card-title">
                    <span class="num">1.</span>
                    <span class="label">Ohm's Law</span>
                    <button class="speak-btn" onclick="speakText('ohms-law')" title="Listen">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072M12 6v12m0 0l-3-3m3 3l3-3M6.343 9.657a8 8 0 000 11.314"/>
                        </svg>
                    </button>
                </div>
                <ul class="note-list" id="ohms-law">
                    <li>Statement: Current (I) is directly proportional to potential difference (V), provided temperature and other physical conditions are constant.</li>
                    <li><span class="hover-word" data-img="{{ asset('images/formula-img.png') }}" data-label="V = IR Formula">Formula</span></li>
                    <li>Ohmic Conductors: Obey Ohm's Law; the <span class="hover-word" data-img="{{ asset('images/vi-graph.png') }}" data-label="V-I Graph (Ohmic)">V-I graph</span> is a straight line through the origin.</li>
                    <li>Non-Ohmic Conductors: Do not obey Ohm's Law (e.g., a filament bulb); <span class="hover-word" data-img="{{ asset('images/graph-curved.png') }}" data-label="Curved V-I Graph">the graph is curved</span> as resistance increases with temperature.</li>
                </ul>
            </div>

            <!-- 2. Series vs Parallel -->
            <div class="note-card">
                <div class="note-card-title">
                    <span class="num">2.</span>
                    <span class="label">Series vs Parallel Circuit</span>
                    <button class="speak-btn" onclick="speakText('series-parallel')" title="Listen">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072M12 6v12m0 0l-3-3m3 3l3-3M6.343 9.657a8 8 0 000 11.314"/>
                        </svg>
                    </button>
                </div>
                <table class="circuit-table" id="series-parallel">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th><span class="hover-word" data-img="{{ asset('images/series-circuit.png') }}" data-label="Series Circuit Diagram">Series Circuit</span></th>
                            <th><span class="hover-word" data-img="{{ asset('images/parallel-circuit.png') }}" data-label="Parallel Circuit Diagram">Parallel Circuit</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Current, I</td>
                            <td>Same at all points:<br>I = I1 = I2 = I3</td>
                            <td>Sum of currents in branches:<br>I = I1 + I2 + I3</td>
                        </tr>
                        <tr>
                            <td>Potential Different, V</td>
                            <td>Sum of voltages:<br>V = V1 + V2 + V3</td>
                            <td>Same across each resistor:<br>V = V1 = V2 = V3</td>
                        </tr>
                        <tr>
                            <td>Effective Resistance, R</td>
                            <td>R = R1 + R2 + R3</td>
                            <td>1/R = 1/R1 + 1/R2 + 1/R3</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Notepad -->
            <div class="notepad-card">
                <div class="notepad-pin">📌</div>
                <div class="notepad-label">Notepad</div>
                <textarea class="notepad-input" placeholder="Write your notes here..."></textarea>
            </div>

        </div>

        <div class="notes-bottom">

            <!-- 3. Factors -->
            <div class="note-card">
                <div class="note-card-title">
                    <span class="num">3.</span>
                    <span class="label">Factors Affecting Resistance</span>
                    <button class="speak-btn" onclick="speakText('factors')" title="Listen">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072M12 6v12m0 0l-3-3m3 3l3-3M6.343 9.657a8 8 0 000 11.314"/>
                        </svg>
                    </button>
                </div>
                <ul class="note-list" id="factors">
                    <li>Resistance is determined by the formula: <span class="hover-word" data-img="{{ asset('images/rpla-img.png') }}" data-label="R = ρL/A Formula">R = ρL/A</span></li>
                    <li>Length (l): Resistance is directly proportional to length ( R ∝ L )</li>
                    <li>Cross-sectional Area (A): Resistance is inversely proportional to area ( R ∝ 1/A)</li>
                    <li>Resistivity (ρ): A measure of a material's ability to oppose current ( Unit: Ωm)</li>
                </ul>
            </div>

            <!-- 4. Materials -->
            <div class="note-card">
                <div class="note-card-title">
                    <span class="num">4.</span>
                    <span class="label">Materials &amp; Superconductors</span>
                    <button class="speak-btn" onclick="speakText('materials')" title="Listen">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072M12 6v12m0 0l-3-3m3 3l3-3M6.343 9.657a8 8 0 000 11.314"/>
                        </svg>
                    </button>
                </div>
                <ul class="note-list" id="materials">
                    <li>Conductors: Low resistivity (e.g., Copper).</li>
                    <li>Insulators: Very high resistivity (e.g., Plastic).</li>
                    <li>Superconductors: Materials with zero resistivity when cooled to a critical temperature ( Tc ). Energy is transmitted without any loss.</li>
                </ul>
            </div>

        </div>

        <div class="section-divider">
            <div class="section-divider-line"></div>
            <span style="font-size:0.78rem;font-weight:700;color:var(--teal-dark);white-space:nowrap;letter-spacing:1px;">              </span>
            <div class="section-divider-line right"></div>
        </div>

        <h2 class="sim-title">Interactive Simulation</h2>

        <!-- ── Circuit 1 (interactive slider) ── -->
        <div class="circuit-wrapper">
            <svg id="circuit1" viewBox="0 0 460 260" xmlns="http://www.w3.org/2000/svg"
                 style="display:block;width:100%;max-width:460px;margin:0 auto 8px;">
                <style>
                    .w  { stroke:#1a1a1a; stroke-width:4; stroke-linecap:round; fill:none; }
                    .bt { fill:none; stroke:#1a1a1a; stroke-width:4.5; stroke-linecap:round; stroke-linejoin:round; }
                    .tm { fill:none; stroke:#1a1a1a; stroke-width:3; stroke-linecap:round; }
                    .blt { fill:#1a1a1a; }
                    .res { fill:none; stroke:#1a1a1a; stroke-width:4; }
                    .rtxt  { font-size:13px; fill:#1a1a1a; font-family:sans-serif; dominant-baseline:central; text-anchor:middle; }
                    .tag   { fill:#f5e6d3; stroke:#c8a882; stroke-width:1.5; }
                    .tagtxt { font-size:13px; fill:#7a5c3a; font-family:sans-serif; dominant-baseline:central; text-anchor:middle; }
                </style>

                <!-- Wires -->
                <line class="w" x1="70"  y1="30"  x2="410" y2="30"/>
                <line class="w" x1="70"  y1="230" x2="168" y2="230"/>
                <line class="w" x1="292" y1="230" x2="410" y2="230"/>
                <line class="w" x1="70"  y1="30"  x2="70"  y2="113"/>
                <line class="w" x1="70"  y1="147" x2="70"  y2="230"/>
                <line class="w" x1="410" y1="30"  x2="410" y2="114"/>
                <line class="w" x1="410" y1="146" x2="410" y2="230"/>

                <!-- Plus terminal -->
                <circle class="tm" cx="38" cy="80" r="12"/>
                <line class="tm" x1="38" y1="73" x2="38" y2="87"/>
                <line class="tm" x1="31" y1="80" x2="45" y2="80"/>

                <rect id="battery-hover" x="15" y="105" width="115" height="50" rx="6"
                      fill="transparent" stroke="none" style="cursor:pointer;"
                      data-tip="BATTERY" data-sub="Power Source"/>

                <!-- Battery brackets -->
                <path class="bt" d="M57,113 L28,113 Q20,113 20,121 L20,139 Q20,147 28,147 L57,147"/>
                <path class="bt" d="M83,113 L112,113 Q120,113 120,121 L120,139 Q120,147 112,147 L83,147"/>
                <!-- Lightning bolt -->
                <polygon class="blt" points="72,118 62,130 69,130 65,142 81,129 73,129 79,118"/>

                <!-- Minus terminal -->
                <circle class="tm" cx="38" cy="180" r="12"/>
                <line class="tm" x1="31" y1="180" x2="45" y2="180"/>

                <!-- 12V label -->
                <rect class="tag" x="124" y="120" width="44" height="20" rx="10"/>
                <text class="tagtxt" x="146" y="130">12V</text>

                <rect id="bulb-hover" x="388" y="106" width="60" height="48" rx="6"
                      fill="transparent" stroke="none" style="cursor:pointer;"
                      data-tip="BULB" data-sub="Light Component"/>

                <!-- Sun / bulb -->
                <circle id="sun-circle" fill="none" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" cx="410" cy="130" r="16"/>
                <line id="sun-r1" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="410" y1="102" x2="410" y2="114"/>
                <line id="sun-r2" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="410" y1="146" x2="410" y2="158"/>
                <line id="sun-r3" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="382" y1="130" x2="390" y2="130"/>
                <line id="sun-r4" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="430" y1="130" x2="438" y2="130"/>
                <line id="sun-r5" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="387" y1="109" x2="393" y2="115"/>
                <line id="sun-r6" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="421" y1="145" x2="427" y2="151"/>
                <line id="sun-r7" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="387" y1="151" x2="393" y2="145"/>
                <line id="sun-r8" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="421" y1="115" x2="427" y2="109"/>

                <!-- Ampere label -->
                <rect class="tag" x="380" y="154" width="56" height="20" rx="10"/>
                <text id="cur-label1" class="tagtxt" x="408" y="164">0.25A</text>

                <!-- Resistor -->
                <rect class="res" x="168" y="218" width="124" height="24" rx="3"/>
                <text id="res-label1" class="rtxt" x="230" y="230">48.0&#937;</text>
            </svg>

            <div class="omega-val" id="omega-display">48.0 &#937;</div>

            <div class="slider-container">
                <div class="slider-track-bg"></div>
                <div class="slider-track-fill" id="slider-track-fill" style="width:100%;"></div>
                <input type="range" class="short-slider" id="res-slider" min="0" max="4" value="4" step="1">
            </div>
            <div class="slide-label">Slide to adjust the resistor</div>
        </div>

        <!-- ── Circuit 2 (flow indicator) ── -->
        <div class="circuit-wrapper" id="circuit2-wrapper">
            <svg id="circuit2-svg" viewBox="0 0 460 260" xmlns="http://www.w3.org/2000/svg"
                 style="display:block;width:100%;max-width:460px;margin:0 auto 8px;">
                <style>
                    .w3  { stroke:#1a1a1a; stroke-width:4; stroke-linecap:round; fill:none; }
                    .bt3 { fill:none; stroke:#1a1a1a; stroke-width:4.5; stroke-linecap:round; stroke-linejoin:round; }
                    .tm3 { fill:none; stroke:#1a1a1a; stroke-width:3; stroke-linecap:round; }
                    .blt3 { fill:#1a1a1a; }
                    .sun3 { fill:none; stroke:#1a1a1a; stroke-width:4; stroke-linecap:round; }
                    .res3 { fill:none; stroke:#1a1a1a; stroke-width:4; }
                    .rtxt3 { font-size:16px; fill:#1a1a1a; font-family:sans-serif; dominant-baseline:central; text-anchor:middle; }
                </style>

                <line class="w3" x1="70"  y1="30"  x2="410" y2="30"/>
                <line class="w3" x1="70"  y1="230" x2="168" y2="230"/>
                <line class="w3" x1="292" y1="230" x2="410" y2="230"/>
                <line class="w3" x1="70"  y1="30"  x2="70"  y2="113"/>
                <line class="w3" x1="70"  y1="147" x2="70"  y2="230"/>
                <line class="w3" x1="410" y1="30"  x2="410" y2="114"/>
                <line class="w3" x1="410" y1="146" x2="410" y2="230"/>

                <circle class="tm3" cx="38" cy="80"  r="12"/>
                <line   class="tm3" x1="38" y1="73"  x2="38" y2="87"/>
                <line   class="tm3" x1="31" y1="80"  x2="45" y2="80"/>

                <path class="bt3" d="M57,113 L28,113 Q20,113 20,121 L20,139 Q20,147 28,147 L57,147"/>
                <path class="bt3" d="M83,113 L112,113 Q120,113 120,121 L120,139 Q120,147 112,147 L83,147"/>
                <polygon class="blt3" points="72,118 62,130 69,130 65,142 81,129 73,129 79,118"/>

                <circle class="tm3" cx="38" cy="180" r="12"/>
                <line   class="tm3" x1="31" y1="180" x2="45" y2="180"/>

                <circle class="sun3" cx="410" cy="130" r="16"/>
                <line class="sun3" x1="410" y1="102" x2="410" y2="114"/>
                <line class="sun3" x1="410" y1="146" x2="410" y2="158"/>
                <line class="sun3" x1="382" y1="130" x2="390" y2="130"/>
                <line class="sun3" x1="430" y1="130" x2="438" y2="130"/>
                <line class="sun3" x1="387" y1="109" x2="393" y2="115"/>
                <line class="sun3" x1="421" y1="145" x2="427" y2="151"/>
                <line class="sun3" x1="387" y1="151" x2="393" y2="145"/>
                <line class="sun3" x1="421" y1="115" x2="427" y2="109"/>

                <rect class="res3" x="168" y="218" width="124" height="24" rx="3"/>
                <text class="rtxt3" x="230" y="230">&#937;</text>

                <line id="highlight-wire" x1="292" y1="230" x2="410" y2="230"
                      stroke="#22c55e" stroke-width="6" stroke-linecap="round"
                      style="cursor:pointer;" />

                <line id="flow-bar" x1="292" y1="230" x2="292" y2="230"
                      stroke="#22c55e" stroke-width="5" stroke-linecap="round"/>

                <g transform="translate(432,245)">
                    <circle fill="none" stroke="#1a1a1a" stroke-width="2" cx="0" cy="0" r="7"/>
                    <line stroke="#1a1a1a" stroke-width="2" x1="5"  y1="5"  x2="9"  y2="9"/>
                    <line stroke="#1a1a1a" stroke-width="2" x1="-3" y1="0"  x2="3"  y2="0"/>
                    <line stroke="#1a1a1a" stroke-width="2" x1="0"  y1="-3" x2="0"  y2="3"/>
                </g>
            </svg>

            <div class="electron-panel-wrap" id="electronPanel">
                <canvas id="electronCanvas" width="340" height="48"
                        style="display:block;border-radius:999px;background:#d0ddd8;cursor:pointer;max-width:340px;width:100%;"></canvas>
                <div class="electron-hint" id="electronHint">Hover to move electrons →</div>
            </div>
        </div>

        <!-- ══ SECTION DIVIDER BEFORE FLASH CARDS ══ -->
        <div class="section-divider">
            <div class="section-divider-line"></div>
            <span style="font-size:0.78rem;font-weight:700;color:var(--teal-dark);white-space:nowrap;letter-spacing:1px;">              </span>
            <div class="section-divider-line right"></div>
        </div>

        <!-- ══ REVISION FLASH CARDS ══ -->
        <h2 class="fc-section-title">Revision Flash Card</h2>

        <div class="fc-grid" id="fcGrid"></div>

        <div class="fc-bar">
            <button class="fc-nav" id="fcPrevBtn" title="Previous">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/><line x1="4" y1="6" x2="4" y2="18"/>
                </svg>
            </button>
            <button class="fc-test-btn" id="fcTestBtn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="9" y="2" width="6" height="4" rx="1"/>
                    <path d="M4 6h16v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                </svg>
                Test Yourself
            </button>
            <button class="fc-nav" id="fcNextBtn" title="Next">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/><line x1="20" y1="6" x2="20" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="fc-hint">Click any card to reveal the answer</div>

    </div><!-- /content -->
</div><!-- /app -->

<script>
    /* ── HOVER WORD IMAGE TOOLTIP ── */
    const wordTooltip = document.getElementById('wordTooltip');
    const tooltipImg  = document.getElementById('tooltipImg');
    const tooltipLbl  = document.getElementById('tooltipLabel');

    document.querySelectorAll('.hover-word').forEach(word => {
        word.addEventListener('mouseenter', function(e) {
            tooltipImg.src = this.dataset.img;
            tooltipLbl.textContent = this.dataset.label || '';
            wordTooltip.style.display = 'block';
            placeWordTooltip(e);
        });
        word.addEventListener('mousemove', placeWordTooltip);
        word.addEventListener('mouseleave', () => wordTooltip.style.display = 'none');
    });

    function placeWordTooltip(e) {
        const tw = 200, th = 180, pad = 14;
        let x = e.clientX + pad;
        let y = e.clientY - th / 2;
        if (x + tw > window.innerWidth - 10) x = e.clientX - tw - pad;
        if (y < 10) y = 10;
        if (y + th > window.innerHeight - 10) y = window.innerHeight - th - 10;
        wordTooltip.style.left = x + 'px';
        wordTooltip.style.top  = y + 'px';
    }

    /* ── TEXT-TO-SPEECH ── */
    function speakText(id) {
        if (!window.speechSynthesis) return;
        window.speechSynthesis.cancel();
        const el = document.getElementById(id);
        if (!el) return;
        const u = new SpeechSynthesisUtterance(el.innerText || el.textContent);
        u.lang = 'en-US'; u.rate = 0.92;
        window.speechSynthesis.speak(u);
    }

    /* ── CIRCUIT 1 SLIDER ── */
    const STEPS = [
        { r: '0.4',  a: '30.0', brightness: 1.00 },
        { r: '1.0',  a: '12.0', brightness: 0.80 },
        { r: '4.0',  a: '3.0',  brightness: 0.50 },
        { r: '12.0', a: '1.0',  brightness: 0.20 },
        { r: '48.0', a: '0.25', brightness: 0.05 },
    ];

    const resSlider    = document.getElementById('res-slider');
    const trackFill    = document.getElementById('slider-track-fill');
    const omegaDisplay = document.getElementById('omega-display');
    const curLabel1    = document.getElementById('cur-label1');
    const resLabel1    = document.getElementById('res-label1');
    const flowBar      = document.getElementById('flow-bar');

    const sunEls = [
        'sun-circle','sun-r1','sun-r2','sun-r3',
        'sun-r4','sun-r5','sun-r6','sun-r7','sun-r8'
    ];

    function updateUI() {
        const idx  = parseInt(resSlider.value);
        const step = STEPS[idx];
        const b    = step.brightness;

        trackFill.style.width = ((idx / 4) * 100) + '%';
        omegaDisplay.textContent = step.r + ' \u03A9';
        curLabel1.textContent    = step.a + 'A';
        resLabel1.textContent    = step.r + '\u03A9';

        const flowX = 292 + Math.round(118 * ((4 - idx) / 4));
        flowBar.setAttribute('x2', flowX);

        const sunCircle = document.getElementById('sun-circle');
        if (b <= 0.05) {
            sunCircle.setAttribute('fill', 'none');
            sunCircle.setAttribute('stroke', '#1a1a1a');
            sunEls.filter(id => id !== 'sun-circle').forEach(id => {
                document.getElementById(id).setAttribute('stroke', '#1a1a1a');
            });
        } else {
            sunCircle.setAttribute('fill', `rgba(255,${Math.round(200 + b * 55)},${Math.round(Math.max(10, 150 - b * 140))},${b})`);
            sunCircle.setAttribute('stroke', '#f59e0b');
            sunEls.filter(id => id !== 'sun-circle').forEach(id => {
                document.getElementById(id).setAttribute('stroke', '#f59e0b');
            });
        }
    }

    resSlider.addEventListener('input', updateUI);
    updateUI();

    /* ── SVG COMPONENT TOOLTIPS (Battery & Bulb) ── */
    const svgTooltip      = document.getElementById('svgTooltip');
    const svgTooltipLabel = document.getElementById('svgTooltipLabel');
    const svgTooltipTag   = document.getElementById('svgTooltipTag');

    function showSvgTooltip(e, label, sub) {
        svgTooltipLabel.textContent = label;
        svgTooltipTag.textContent   = sub;
        svgTooltip.style.display    = 'block';
        placeSvgTooltip(e);
    }

    function placeSvgTooltip(e) {
        const tw = 130, th = 56, pad = 12;
        let x = e.clientX + pad;
        let y = e.clientY - th / 2;
        if (x + tw > window.innerWidth - 10) x = e.clientX - tw - pad;
        if (y < 10) y = 10;
        if (y + th > window.innerHeight - 10) y = window.innerHeight - th - 10;
        svgTooltip.style.left = x + 'px';
        svgTooltip.style.top  = y + 'px';
    }

    ['battery-hover', 'bulb-hover'].forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('mouseenter', function(e) {
            showSvgTooltip(e, this.dataset.tip, this.dataset.sub);
        });
        el.addEventListener('mousemove', placeSvgTooltip);
        el.addEventListener('mouseleave', () => {
            svgTooltip.style.display = 'none';
        });
    });

    /* ── HIGHLIGHTED WIRE CLICK → ELECTRON PANEL ── */
    const highlightWire  = document.getElementById('highlight-wire');
    const electronPanel  = document.getElementById('electronPanel');
    const electronCanvas = document.getElementById('electronCanvas');
    const electronHint   = document.getElementById('electronHint');
    const ctx            = electronCanvas.getContext('2d');

    let electronPanelOpen = false;

    highlightWire.addEventListener('click', (e) => {
        e.stopPropagation();
        electronPanelOpen = !electronPanelOpen;
        electronPanel.classList.toggle('visible', electronPanelOpen);
        if (electronPanelOpen) drawElectrons(false);
        else { cancelAnimationFrame(animFrame); animFrame = null; }
    });

    const NUM_ELECTRONS = 12;
    let electronsHovered = false;
    const tubeH  = 48;
    const radius = 8;
    const margin = 20;

    const electrons = Array.from({ length: NUM_ELECTRONS }, (_, i) => ({
        baseFrac: (i + 0.5) / NUM_ELECTRONS,
        offsetFrac: 0,
        y: tubeH / 2 + (Math.random() - 0.5) * (tubeH - 2 * radius - 6),
    }));

    let animFrame = null;
    let animPhase = 0;

    function drawElectrons(hovered) {
        const dpr  = window.devicePixelRatio || 1;
        const cw   = electronCanvas.offsetWidth  || 340;
        const ch   = 48;
        electronCanvas.width  = cw * dpr;
        electronCanvas.height = ch * dpr;
        ctx.scale(dpr, dpr);

        ctx.clearRect(0, 0, cw, ch);
        ctx.fillStyle = '#d0ddd8';
        roundRect(ctx, 0, 0, cw, ch, ch / 2);
        ctx.fill();

        const usable = cw - margin * 2;

        electrons.forEach((e, i) => {
            let xFrac = e.baseFrac;
            if (hovered) {
                xFrac = e.baseFrac + 0.4 * ((animPhase + i * 0.08) % 1.0);
                if (xFrac > 1) xFrac = xFrac - 1;
            }
            const x = margin + xFrac * usable;
            const y = ch / 2;

            ctx.beginPath();
            ctx.arc(x, y, radius, 0, Math.PI * 2);
            ctx.fillStyle = '#4dd8e0';
            ctx.fill();
            ctx.strokeStyle = '#1a9aaa';
            ctx.lineWidth = 1.5;
            ctx.stroke();

            ctx.strokeStyle = '#fff';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(x - 4, y);
            ctx.lineTo(x + 4, y);
            ctx.stroke();
        });
    }

    function roundRect(ctx, x, y, w, h, r) {
        ctx.beginPath();
        ctx.moveTo(x + r, y);
        ctx.lineTo(x + w - r, y);
        ctx.quadraticCurveTo(x + w, y, x + w, y + r);
        ctx.lineTo(x + w, y + h - r);
        ctx.quadraticCurveTo(x + w, y + h, x + w - r, y + h);
        ctx.lineTo(x + r, y + h);
        ctx.quadraticCurveTo(x, y + h, x, y + h - r);
        ctx.lineTo(x, y + r);
        ctx.quadraticCurveTo(x, y, x + r, y);
        ctx.closePath();
    }

    function animateElectrons() {
        animPhase += 0.008;
        drawElectrons(true);
        animFrame = requestAnimationFrame(animateElectrons);
    }

    electronCanvas.addEventListener('mouseenter', () => {
        if (!electronPanelOpen) return;
        electronsHovered = true;
        electronHint.textContent = 'Electrons moving →';
        cancelAnimationFrame(animFrame);
        animPhase = 0;
        animateElectrons();
    });

    electronCanvas.addEventListener('mouseleave', () => {
        if (!electronPanelOpen) return;
        electronsHovered = false;
        electronHint.textContent = 'Hover to move electrons →';
        cancelAnimationFrame(animFrame);
        animFrame = null;
        drawElectrons(false);
    });

    document.addEventListener('click', (e) => {
        if (!electronPanelOpen) return;
        if (e.target === highlightWire) return;
        electronPanelOpen = false;
        electronPanel.classList.remove('visible');
        cancelAnimationFrame(animFrame);
        animFrame = null;
        electronsHovered = false;
    });

    /* ── REVISION FLASH CARDS ── */
    const FC_PAGES = [
        [
            { q: "State Ohm's Law and its formula", a: "Potential difference (V) is directly proportional to current (I) if temperature is constant.\nFormula: V = IR." },
            { q: "Describe the difference in V-I graph shapes", a: "Ohmic: Straight line passing through the origin\nNon-Ohmic: Curved graph (e.g., filament bulb)" },
            { q: "Rules for I, V, and R in a series circuit", a: "I = I1 = I2 = I3\nV = V1 + V2 + V3\nR = R1 + R2 + R3" },
            { q: "Rules for I, V, and R in a parallel circuit", a: "I = I1 + I2 + I3\nV = V1 = V2 = V3\n1/R = 1/R1 + 1/R2 + 1/R3" },
            { q: "What physical factors change a wire's resistance?", a: "• Depends on material resistivity (ρ)\n• R ∝ L\n• R ∝ 1/A" },
            { q: "What is the formula for wire resistance?", a: "R = ρL/A\nρ - Resistivity\nL - Length\nA - Cross-sectional area" },
            { q: "Define resistivity and state its S.I. unit", a: "A measure of a conductor's ability to oppose electric current.\nUnit: Ohm-meter, Ωm" },
            { q: "Define a superconductor", a: "A material that conducts electricity without any resistance (zero resistivity)" },
        ]
    ];

    let fcCurrentPage = 0;
    const fcGrid = document.getElementById('fcGrid');

    function fcRenderPage() {
        fcGrid.innerHTML = '';
        FC_PAGES[fcCurrentPage].forEach((item, i) => {
            const scene = document.createElement('div');
            scene.className = 'fc-scene';
            scene.innerHTML = `
                <div class="fc-card" id="fc-card-${i}">
                    <div class="fc-face fc-front"><div class="fc-front-text">${item.q}</div></div>
                    <div class="fc-face fc-back"><div class="fc-back-text">${item.a.replace(/\n/g, '<br>')}</div></div>
                </div>`;
            scene.addEventListener('click', () => {
                document.getElementById('fc-card-' + i).classList.toggle('flipped');
            });
            fcGrid.appendChild(scene);
        });
    }

    document.getElementById('fcPrevBtn').addEventListener('click', () => {
        fcCurrentPage = Math.max(0, fcCurrentPage - 1);
        fcRenderPage();
    });

    document.getElementById('fcNextBtn').addEventListener('click', () => {
        fcCurrentPage = Math.min(FC_PAGES.length - 1, fcCurrentPage + 1);
        fcRenderPage();
    });

    document.getElementById('fcTestBtn').addEventListener('click', () => {
        alert('Test Yourself feature coming soon!');
    });

    fcRenderPage();
</script>

</body>
</html>