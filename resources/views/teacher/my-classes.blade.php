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

        .topbar-right { display: flex; align-items: center; gap: 16px; }

        .notif-btn {
            width: 38px; height: 38px; border-radius: 50%; border: none;
            background: var(--card-bg); display: flex; align-items: center;
            justify-content: center; cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: box-shadow 0.2s;
        }
        .notif-btn:hover { box-shadow: 0 4px 14px rgba(0,0,0,0.12); }

        .user-chip {
            display: flex; align-items: center; gap: 10px; background: var(--card-bg);
            border-radius: 24px; padding: 6px 14px 6px 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
        .bg-grey   { background-color: var(--grey-card); }
        .bg-green  { background-color: var(--green-card); }
        .bg-teal   { background-color: var(--teal); }
        .bg-navy   { background-color: var(--navy); }
        .bg-purple { background-color: #6c63ff; }

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

        .code-preview-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .code-preview {
            flex: 1;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1.5px solid #d8e8ea;
            background: #f0f6f8;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: 2px;
        }

        .btn-copy {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1.5px solid #d0e4e2;
            background: #fff;
            color: var(--teal);
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
            flex-shrink: 0;
        }

        .btn-copy:hover { background: var(--teal-light); border-color: var(--teal); }
        .btn-copy.copied { background: #e6f9f0; border-color: #1a8a5a; color: #1a8a5a; }

        /* ── Copy toast ── */
        .copy-toast {
            position: fixed;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: #1a2b3c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            opacity: 0;
            transition: opacity 0.2s, transform 0.2s;
            z-index: 999;
            pointer-events: none;
        }

        .copy-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .copy-toast svg { width: 15px; height: 15px; color: #4ade80; flex-shrink: 0; }

        .btn-regen {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1.5px solid #d0e4e2;
            background: #fff;
            color: var(--teal);
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.2s, border-color 0.2s;
            flex-shrink: 0;
        }

        .btn-regen:hover { background: var(--teal-light); border-color: var(--teal); }

        .code-hint {
            font-size: 0.72rem;
            color: var(--text-light);
            margin-top: 6px;
        }

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

        .computer-bg { background-image: url("{{ asset('images/computer-class-bgtest.png') }}"); }
        .book-bg { background-image: url("{{ asset('images/book-class-bgtest.png') }}"); }

        .class-info h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 2px; }
        .class-info p { font-size: 0.75rem; opacity: 0.9; font-weight: 500; }
        .student-count { font-size: 0.7rem; font-weight: 400; opacity: 0.8; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            .content { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .topbar { padding: 14px 20px; }
            .content { padding: 0 20px 20px; }
            .modal { padding: 24px 20px; }
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

            .content { grid-template-columns: 1fr; }

            .modal {
                max-width: calc(100vw - 32px);
                margin: 16px;
                padding: 20px 16px;
                border-radius: 14px;
            }
        }

        @media (max-width: 400px) {
            .topbar h2 { font-size: 0.95rem; }
        }

    </style>
</head>
<body>

<div class="app">
    <x-teacher.sidebar active="my-classes" />

    <div class="main">
        <div class="topbar">
            <h2>My Classes</h2>
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

        @if (session('success'))
        <div style="margin:0 28px 0;padding:12px 18px;background:#e6f9f0;border-radius:10px;color:#1a8a5a;font-size:0.84rem;font-weight:600;display:flex;align-items:center;gap:8px;">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif

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

            @forelse ($classes as $class)
            <div class="class-card {{ $class->color_class }} {{ $class->bg }}"
                 onclick="cardClick(event, {{ $class->id }}, '{{ route('teacher.my-classes.students', $class->id) }}')"
                 data-id="{{ $class->id }}">

                <div class="card-top">
                    <div class="class-info">
                        <h3>{{ $class->name }}</h3>
                        <p>{{ $class->subject_label }}</p>
                    </div>
                    <div class="card-menu-wrap">
                        <button class="card-menu-btn"
                                onclick="toggleDropdown(event, {{ $class->id }})"
                                title="Options">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="5"  r="1.5"/>
                                <circle cx="12" cy="12" r="1.5"/>
                                <circle cx="12" cy="19" r="1.5"/>
                            </svg>
                        </button>
                        <div class="card-dropdown" id="dropdown-{{ $class->id }}">
                            <button class="dropdown-item"
                                    onclick="openEditModal(event, {{ $class->id }}, '{{ addslashes($class->name) }}', '{{ $class->code }}', '{{ $class->color }}', '{{ $class->subject }}')">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                            <button class="dropdown-item danger"
                                    onclick="deleteClass(event, {{ $class->id }}, '{{ addslashes($class->name) }}')">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <div class="student-count">{{ $class->students_count }} {{ Str::plural('student', $class->students_count) }}</div>

                {{-- Hidden delete form --}}
                <form id="delete-form-{{ $class->id }}" method="POST"
                      action="{{ route('teacher.my-classes.destroy', $class->id) }}"
                      style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;color:var(--text-light);padding:40px 0;font-size:0.9rem;">
                No classes yet. Click <strong>Create New Class</strong> to get started.
            </div>
            @endforelse

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

        <form method="POST" action="{{ route('teacher.my-classes.store') }}">
            @csrf

            <div class="form-group">
                <label>Class Name</label>
                <input type="text" name="name" placeholder="e.g. Class G" required
                       value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>Subject</label>
                <select name="subject" id="subjectInput">
                    <option value="physics">Physics</option>
                    <option value="biology">Biology</option>
                    <option value="chemistry">Chemistry</option>
                    <option value="mathematics">Mathematics</option>
                    <option value="history">History</option>
                    <option value="english">English</option>
                </select>
            </div>

            <div class="form-group">
                <label>Class Code</label>
                <div class="code-preview-wrap">
                    <span class="code-preview" id="codePreview">—</span>
                    <button type="button" class="btn-regen" onclick="regenerateCode()" title="Generate new code">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Regenerate
                    </button>
                </div>
                <p class="code-hint">Auto-generated. Unique code assigned by the system.</p>
                <input type="hidden" name="code" id="codeInput">
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

        <form method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Class Name</label>
                <input type="text" id="editClassName" name="name" required>
            </div>

            <div class="form-group">
                <label>Subject</label>
                <select name="subject" id="editSubjectInput">
                    <option value="physics">Physics</option>
                    <option value="biology">Biology</option>
                    <option value="chemistry">Chemistry</option>
                    <option value="mathematics">Mathematics</option>
                    <option value="history">History</option>
                    <option value="english">English</option>
                </select>
            </div>

            <div class="form-group">
                <label>Class Code</label>
                <div class="code-preview-wrap">
                    <span class="code-preview" id="editCodePreview">—</span>
                    <button type="button" class="btn-copy" id="copyBtn" onclick="copyCode()" title="Copy code">
                        <svg id="copyIcon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <span id="copyLabel">Copy</span>
                    </button>
                </div>
                <p class="code-hint">Class code cannot be changed after creation.</p>
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

<!-- ══ COPY TOAST ══ -->
<div class="copy-toast" id="copyToast">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
    </svg>
    Code copied to clipboard!
</div>

<script>
    // ── Code generator ──
    function generateCode() {
        const chars   = 'ABCDEFGHJKLMNPQRSTUVWXYZ'; // no I/O to avoid confusion
        const digits  = '23456789';                  // no 0/1 to avoid confusion
        let code = 'CLS-';
        for (let i = 0; i < 3; i++) code += chars[Math.floor(Math.random() * chars.length)];
        for (let i = 0; i < 3; i++) code += digits[Math.floor(Math.random() * digits.length)];
        return code;
    }

    function regenerateCode() {
        const code = generateCode();
        document.getElementById('codePreview').textContent = code;
        document.getElementById('codeInput').value = code;
    }

    // ── Create modal ──
    function openModal() {
        regenerateCode();
        document.getElementById('modalOverlay').classList.add('open');
    }
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
    function openEditModal(e, id, name, code, color, subject) {
        e.stopPropagation();
        closeAllDropdowns();
        document.getElementById('editClassName').value = name;
        document.getElementById('editCodePreview').textContent = code;
        // Set form action to the correct class
        document.getElementById('editForm').action = '/teacher/my-classes/' + id;
        // Pre-select the current colour
        document.querySelectorAll('#editModalOverlay .color-opt').forEach(o => {
            o.classList.toggle('selected', o.dataset.color === color);
        });
        document.getElementById('editColorInput').value = color;
        // Pre-select the current subject
        document.getElementById('editSubjectInput').value = subject;
        document.getElementById('editModalOverlay').classList.add('open');
    }

    function closeEditModal() {
        document.getElementById('editModalOverlay').classList.remove('open');
        // reset copy button
        const btn = document.getElementById('copyBtn');
        if (btn) { btn.classList.remove('copied'); document.getElementById('copyLabel').textContent = 'Copy'; }
    }

    function closeOnBackdropEdit(e) {
        if (e.target === document.getElementById('editModalOverlay')) closeEditModal();
    }

    let toastTimer = null;

    function copyCode() {
        const code = document.getElementById('editCodePreview').textContent.trim();
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(showCopied).catch(() => fallbackCopy(code));
        } else {
            fallbackCopy(code);
        }
    }

    function fallbackCopy(text) {
        const ta = document.createElement('textarea');
        ta.value = text;
        ta.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0;';
        document.body.appendChild(ta);
        ta.focus();
        ta.select();
        try { document.execCommand('copy'); showCopied(); }
        catch(e) { alert('Copy failed. Code: ' + text); }
        document.body.removeChild(ta);
    }

    function showCopied() {
        const btn   = document.getElementById('copyBtn');
        const label = document.getElementById('copyLabel');
        const icon  = document.getElementById('copyIcon');
        btn.classList.add('copied');
        label.textContent = 'Copied!';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';

        const toast = document.getElementById('copyToast');
        toast.classList.add('show');
        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            toast.classList.remove('show');
            btn.classList.remove('copied');
            label.textContent = 'Copy';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>';
        }, 2000);
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
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', closeAllDropdowns);
</script>

</body>
</html>
