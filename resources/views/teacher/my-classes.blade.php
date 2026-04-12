<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - My Classes</title>
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

        /* SIDEBAR (Consistent with Dashboard) */
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
        }

        .sidebar-logo img { width: 44px; height: auto; }

        .sidebar-logo span {
            font-size: 0.78rem;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: 2px;
        }

        .nav { list-style: none; width: 100%; flex: 1; display: flex; flex-direction: column; gap: 4px; padding: 0 12px; }

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
            transition: all 0.2s;
        }

        .nav li a:hover, .nav li.active a { background: var(--teal-light); color: var(--teal); font-weight: 600; }

        .nav li a .icon { width: 18px; height: 18px; opacity: 0.7; }

        .sidebar-logout { width: calc(100% - 24px); margin: 0 12px; }

        .sidebar-logout a {
            display: flex; align-items: center; gap: 10px; padding: 11px 14px;
            border-radius: 10px; background: var(--navy); color: #fff;
            text-decoration: none; font-size: 0.8rem; font-weight: 600;
        }

        /* MAIN CONTENT */
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

        /* GRID LAYOUT FOR CLASSES */
        .content {
            flex: 1; overflow-y: auto; padding: 0 28px 28px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            align-content: start;
        }

        .class-card {
            height: 160px;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: right bottom;
            background-size: auto 85%;
        }

        .class-card:hover { transform: translateY(-5px); }

        /* Specific Backgrounds */
        .bg-grey { background-color: var(--grey-card); }
        .bg-green { background-color: var(--green-card); }

        /* ── New Class Card ── */
        .new-class-card {
            height: 160px;
            border-radius: 16px;
            border: 2px dashed #b0ccc9;
            background: transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            color: var(--teal);
            font-family: 'Poppins', sans-serif;
        }

        .new-class-card:hover {
            border-color: var(--teal);
            background: var(--teal-light);
        }

        .new-class-card .plus-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--teal-light);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .new-class-card:hover .plus-icon { background: #c2e9e6; }

        .new-class-card span {
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* ── Modal ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open { display: flex; }

        .modal {
            background: #fff;
            border-radius: 20px;
            padding: 32px 36px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.16);
            position: relative;
        }

        .modal-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .modal-subtitle {
            font-size: 0.8rem;
            color: var(--text-mid);
            margin-bottom: 24px;
        }

        .modal-close {
            position: absolute;
            top: 18px;
            right: 20px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            padding: 4px;
            border-radius: 6px;
            transition: color 0.2s, background 0.2s;
        }

        .modal-close:hover { color: var(--text-dark); background: #f0f4f6; }

        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1.5px solid #d8e8ea;
            font-family: 'Poppins', sans-serif;
            font-size: 0.84rem;
            color: var(--text-dark);
            background: #f7fbfc;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus { border-color: var(--teal); background: #fff; }

        .color-row {
            display: flex;
            gap: 10px;
        }

        .color-opt {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 3px solid transparent;
            cursor: pointer;
            transition: border-color 0.15s;
        }

        .color-opt.selected { border-color: var(--navy); }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        .btn-cancel {
            flex: 1;
            padding: 11px;
            border-radius: 10px;
            border: 1.5px solid #d0e4e2;
            background: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--text-mid);
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-cancel:hover { background: #f0f6f8; }

        .btn-create {
            flex: 1;
            padding: 11px;
            border-radius: 10px;
            border: none;
            background: var(--teal);
            font-family: 'Poppins', sans-serif;
            font-size: 0.84rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-create:hover { opacity: 0.88; }

        .computer-bg { background-image: url("{{ asset('images/computer-class-bg.png') }}"); }
        .book-bg { background-image: url("{{ asset('images/book-class-bg.png') }}"); }

        .class-info h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 2px; }
        .class-info p { font-size: 0.75rem; opacity: 0.9; font-weight: 500; }
        .student-count { font-size: 0.7rem; font-weight: 400; opacity: 0.8; }

    </style>
</head>
<body>

<div class="app">
    <x-teacher.sidebar active="my-classes" />

    <div class="main">
        <div class="topbar">
            <h2>My Class</h2>
            <div class="user-chip">
                <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'N', 0, 1)) }}
                </div>
                <span>{{ auth()->user()->name ?? 'Nur Elin' }}</span>
            </div>
        </div>

        <div class="content">
            
            <!-- New Class Card -->
            <button class="new-class-card" onclick="openModal()">
                <div class="plus-icon">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span>Create New Class</span>
            </button>

            <a href="{{ route('teacher.class-students') }}" class="class-card bg-grey computer-bg" style="text-decoration:none;">
                <div class="class-info">
                    <h3>Class A</h3>
                    <p>X PPLG 1</p>
                </div>
                <div class="student-count">6 students</div>
            </a>

            <div class="class-card bg-green book-bg">
                <div class="class-info">
                    <h3>Class B</h3>
                    <p>X PPLG 2</p>
                </div>
                <div class="student-count">8 students</div>
            </div>

            <div class="class-card bg-grey computer-bg">
                <div class="class-info">
                    <h3>Class C</h3>
                    <p>X PPLG 3</p>
                </div>
                <div class="student-count">12 students</div>
            </div>

            <div class="class-card bg-green book-bg">
                <div class="class-info">
                    <h3>Class D</h3>
                    <p>X PPLG 4</p>
                </div>
                <div class="student-count">4 students</div>
            </div>

            <div class="class-card bg-grey computer-bg">
                <div class="class-info">
                    <h3>Class E</h3>
                    <p>X PPLG 5</p>
                </div>
                <div class="student-count">4 students</div>
            </div>

            <div class="class-card bg-green book-bg">
                <div class="class-info">
                    <h3>Class F</h3>
                    <p>X PPLG 6</p>
                </div>
                <div class="student-count">8 students</div>
            </div>

        </div>
    </div>
</div>

<!-- ══ CREATE CLASS MODAL ══ -->
<div class="modal-overlay" id="modalOverlay" onclick="closeOnBackdrop(event)">
    <div class="modal">
        <button class="modal-close" onclick="closeModal()">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="modal-title">Create New Class</div>
        <div class="modal-subtitle">Fill in the details for your new class</div>

        <form method="POST" action="#">
            @csrf

            <div class="form-group">
                <label>Class Name</label>
                <input type="text" name="name" placeholder="e.g. Class G" required>
            </div>

            <div class="form-group">
                <label>Class Code</label>
                <input type="text" name="code" placeholder="e.g. X PPLG 7">
            </div>

            <div class="form-group">
                <label>Card Colour</label>
                <div class="color-row">
                    <div class="color-opt selected" style="background:#8e9499;" data-color="grey" onclick="selectColor(this)"></div>
                    <div class="color-opt" style="background:#00c853;" data-color="green" onclick="selectColor(this)"></div>
                    <div class="color-opt" style="background:#2e8b84;" data-color="teal" onclick="selectColor(this)"></div>
                    <div class="color-opt" style="background:#1c3d6b;" data-color="navy" onclick="selectColor(this)"></div>
                    <div class="color-opt" style="background:#6c63ff;" data-color="purple" onclick="selectColor(this)"></div>
                </div>
                <input type="hidden" name="color" id="colorInput" value="grey">
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-create">Create Class</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal()  { document.getElementById('modalOverlay').classList.add('open'); }
    function closeModal() { document.getElementById('modalOverlay').classList.remove('open'); }

    function closeOnBackdrop(e) {
        if (e.target === document.getElementById('modalOverlay')) closeModal();
    }

    function selectColor(el) {
        document.querySelectorAll('.color-opt').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('colorInput').value = el.dataset.color;
    }
</script>

</body>
</html>
