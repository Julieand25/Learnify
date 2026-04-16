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

        /* Bar chart */
        .bar-chart {
            display: flex;
            align-items: flex-end;
            gap: 16px;
            height: 180px;
            padding-top: 10px;
            border-bottom: 1.5px solid #eef2f5;
        }

        .bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            flex: 1;
        }

        .bars {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 160px;
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

        .bar-label {
            font-size: 0.72rem;
            color: var(--text-mid);
            text-align: center;
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
                    <div class="bar-chart" id="barChart">
                        <!-- Generated by JS below -->
                    </div>
                </div>

                <!-- Calendar Card -->
                <div class="calendar-card">
                    <div class="cal-header">
                        <div>
                            <div class="cal-title">Calendar</div>
                            <div class="cal-month" id="calMonthLabel">December 2025</div>
                        </div>
                        <div class="cal-nav">
                            <button onclick="changeMonth(-1)">&#8249;</button>
                            <button onclick="changeMonth(1)">&#8250;</button>
                        </div>
                    </div>

                    <div class="cal-grid" id="calGrid">
                        <!-- Generated by JS -->
                    </div>

                    <p class="cal-hint">*You can choose multiple date</p>
                    <button class="btn-reminder">Set Reminder</button>
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
    const tableBody    = document.getElementById('studentTableBody');
    const classLabel   = document.getElementById('classNameLabel');
    const prevBtn      = document.getElementById('prevClassBtn');
    const nextBtn      = document.getElementById('nextClassBtn');
    const chartHeight  = 160;

    function renderBarChart(studentsData) {
        chartEl.innerHTML = '';
        if (studentsData.length === 0) {
            chartEl.style.alignItems = 'center';
            chartEl.style.justifyContent = 'center';
            chartEl.innerHTML = '<span style="font-size:0.8rem;color:#9aaabb;">No students yet</span>';
            return;
        }
        chartEl.style.alignItems = 'flex-end';
        chartEl.style.justifyContent = '';
        studentsData.forEach(s => {
            const group = document.createElement('div');
            group.className = 'bar-group';

            const bars = document.createElement('div');
            bars.className = 'bars';

            const bBlue = document.createElement('div');
            bBlue.className = 'bar blue';
            bBlue.style.height = (s.notes_pct / 100 * chartHeight) + 'px';
            bBlue.title = `Notes: ${s.notes_pct}%`;

            const bPink = document.createElement('div');
            bPink.className = 'bar pink';
            bPink.style.height = (s.quiz_pct / 100 * chartHeight) + 'px';
            bPink.title = `Quiz: ${s.quiz_label}`;

            bars.appendChild(bBlue);
            bars.appendChild(bPink);

            const label = document.createElement('div');
            label.className = 'bar-label';
            label.textContent = s.name.split(' ')[0]; // first name only

            group.appendChild(bars);
            group.appendChild(label);
            chartEl.appendChild(group);
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
    let currentYear = 2025;
    let currentMonth = 11; // December (0-indexed)
    const selectedDates = new Set();
    const today = new Date();

    const dayNames = ['S','M','T','W','T','F','S'];
    const monthNames = ['January','February','March','April','May','June',
                        'July','August','September','October','November','December'];

    function renderCalendar() {
        const grid = document.getElementById('calGrid');
        const label = document.getElementById('calMonthLabel');
        grid.innerHTML = '';
        label.textContent = `${monthNames[currentMonth]} ${currentYear}`;

        // Day name headers
        dayNames.forEach(d => {
            const el = document.createElement('div');
            el.className = 'cal-day-name';
            el.textContent = d;
            grid.appendChild(el);
        });

        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const prevDays = new Date(currentYear, currentMonth, 0).getDate();

        // Previous month fillers
        for (let i = firstDay - 1; i >= 0; i--) {
            const el = document.createElement('div');
            el.className = 'cal-day other-month';
            el.textContent = prevDays - i;
            grid.appendChild(el);
        }

        // Current month days
        for (let d = 1; d <= daysInMonth; d++) {
            const el = document.createElement('div');
            el.className = 'cal-day';
            el.textContent = d;

            const key = `${currentYear}-${currentMonth}-${d}`;
            const isToday = d === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear();

            if (isToday) el.classList.add('today');
            if (selectedDates.has(key)) el.classList.add('selected');

            el.addEventListener('click', () => {
                if (isToday) return;
                if (selectedDates.has(key)) selectedDates.delete(key);
                else selectedDates.add(key);
                renderCalendar();
            });

            grid.appendChild(el);
        }

        // Next month fillers
        const total = firstDay + daysInMonth;
        const remaining = total % 7 === 0 ? 0 : 7 - (total % 7);
        for (let d = 1; d <= remaining; d++) {
            const el = document.createElement('div');
            el.className = 'cal-day other-month';
            el.textContent = d;
            grid.appendChild(el);
        }
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