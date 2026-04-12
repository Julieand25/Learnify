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

        /* ── 3-dot menu ── */
        .card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .card-menu-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .card-menu-btn {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,0.25);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .card-menu-btn:hover { background: rgba(255,255,255,0.4); }

        .card-dropdown {
            display: none;
            position: absolute;
            top: 34px;
            right: 0;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            min-width: 130px;
            z-index: 50;
            overflow: hidden;
        }

        .card-dropdown.open { display: block; }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
            transition: background 0.15s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: 'Poppins', sans-serif;
        }

        .dropdown-item:hover { background: #f5fbfa; color: var(--teal); }

        .dropdown-item.danger:hover { background: #fdecea; color: #c0392b; }

        .dropdown-item svg { width: 14px; height: 14px; flex-shrink: 0; }

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

        .btn-save {
            flex: 1;
            padding: 11px;
            border-radius: 10px;
            border: none;
            background: var(--navy);
            font-family: 'Poppins', sans-serif;
            font-size: 0.84rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-save:hover { opacity: 0.88; }

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

            @php
            $classes = [
                ['id'=>1, 'name'=>'Class A', 'code'=>'X PPLG 1', 'students'=>6,  'color'=>'bg-grey',  'bg'=>'computer-bg', 'url' => route('teacher.class-students')],
                ['id'=>2, 'name'=>'Class B', 'code'=>'X PPLG 2', 'students'=>8,  'color'=>'bg-green', 'bg'=>'book-bg',     'url' => null],
                ['id'=>3, 'name'=>'Class C', 'code'=>'X PPLG 3', 'students'=>12, 'color'=>'bg-grey',  'bg'=>'computer-bg', 'url' => null],
                ['id'=>4, 'name'=>'Class D', 'code'=>'X PPLG 4', 'students'=>4,  'color'=>'bg-green', 'bg'=>'book-bg',     'url' => null],
                ['id'=>5, 'name'=>'Class E', 'code'=>'X PPLG 5', 'students'=>4,  'color'=>'bg-grey',  'bg'=>'computer-bg', 'url' => null],
                ['id'=>6, 'name'=>'Class F', 'code'=>'X PPLG 6', 'students'=>8,  'color'=>'bg-green', 'bg'=>'book-bg',     'url' => null],
            ];
            @endphp

            @foreach ($classes as $class)
            <div class="class-card {{ $class['color'] }} {{ $class['bg'] }}"
                 onclick="cardClick(event, {{ $class['id'] }}, '{{ $class['url'] ?? '' }}')"
                 data-id="{{ $class['id'] }}">

                <div class="card-top">
                    <div class="class-info">
                        <h3>{{ $class['name'] }}</h3>
                        <p>{{ $class['code'] }}</p>
                    </div>
                    <div class="card-menu-wrap">
                        <button class="card-menu-btn"
                                onclick="toggleDropdown(event, {{ $class['id'] }})"
                                title="Options">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="5"  r="1.5"/>
                                <circle cx="12" cy="12" r="1.5"/>
                                <circle cx="12" cy="19" r="1.5"/>
                            </svg>
                        </button>
                        <div class="card-dropdown" id="dropdown-{{ $class['id'] }}">
                            <button class="dropdown-item"
                                    onclick="openEditModal(event, {{ $class['id'] }}, '{{ $class['name'] }}', '{{ $class['code'] }}')">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                            <button class="dropdown-item danger"
                                    onclick="deleteClass(event, {{ $class['id'] }}, '{{ $class['name'] }}')">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <div class="student-count">{{ $class['students'] }} students</div>
            </div>
            @endforeach

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

<!-- ══ EDIT CLASS MODAL ══ -->
<div class="modal-overlay" id="editModalOverlay" onclick="closeOnBackdropEdit(event)">
    <div class="modal">
        <button class="modal-close" onclick="closeEditModal()">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="modal-title">Edit Class</div>
        <div class="modal-subtitle">Update the details for this class</div>

        <form method="POST" action="#">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Class Name</label>
                <input type="text" id="editClassName" name="name" required>
            </div>

            <div class="form-group">
                <label>Class Code</label>
                <input type="text" id="editClassCode" name="code">
            </div>

            <div class="form-group">
                <label>Card Colour</label>
                <div class="color-row">
                    <div class="color-opt selected" style="background:#8e9499;" data-color="grey"   onclick="selectEditColor(this)"></div>
                    <div class="color-opt"          style="background:#00c853;" data-color="green"  onclick="selectEditColor(this)"></div>
                    <div class="color-opt"          style="background:#2e8b84;" data-color="teal"   onclick="selectEditColor(this)"></div>
                    <div class="color-opt"          style="background:#1c3d6b;" data-color="navy"   onclick="selectEditColor(this)"></div>
                    <div class="color-opt"          style="background:#6c63ff;" data-color="purple" onclick="selectEditColor(this)"></div>
                </div>
                <input type="hidden" name="color" id="editColorInput" value="grey">
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    // ── Create modal ──
    function openModal()  { document.getElementById('modalOverlay').classList.add('open'); }
    function closeModal() { document.getElementById('modalOverlay').classList.remove('open'); }

    function closeOnBackdrop(e) {
        if (e.target === document.getElementById('modalOverlay')) closeModal();
    }

    function selectColor(el) {
        document.querySelectorAll('#modalOverlay .color-opt').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('colorInput').value = el.dataset.color;
    }

    // ── Edit modal ──
    function openEditModal(e, id, name, code) {
        e.stopPropagation();
        closeAllDropdowns();
        document.getElementById('editClassName').value = name;
        document.getElementById('editClassCode').value = code;
        document.getElementById('editModalOverlay').classList.add('open');
    }

    function closeEditModal() { document.getElementById('editModalOverlay').classList.remove('open'); }

    function closeOnBackdropEdit(e) {
        if (e.target === document.getElementById('editModalOverlay')) closeEditModal();
    }

    function selectEditColor(el) {
        document.querySelectorAll('#editModalOverlay .color-opt').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('editColorInput').value = el.dataset.color;
    }

    // ── 3-dot dropdown ──
    function toggleDropdown(e, id) {
        e.stopPropagation();
        const target = document.getElementById('dropdown-' + id);
        const isOpen = target.classList.contains('open');
        closeAllDropdowns();
        if (!isOpen) target.classList.add('open');
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.card-dropdown.open').forEach(d => d.classList.remove('open'));
    }

    // ── Card click (navigate only if no dropdown open) ──
    function cardClick(e, id, url) {
        if (!url) return;
        window.location.href = url;
    }

    function deleteClass(e, id, name) {
        e.stopPropagation();
        closeAllDropdowns();
        if (confirm('Delete "' + name + '"? This cannot be undone.')) {
            // TODO: submit delete form when backend is ready
        }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', closeAllDropdowns);
</script>

</body>
</html>
