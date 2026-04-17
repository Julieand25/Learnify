<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Edit Quiz</title>
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

        /* SIDEBAR */
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

        .section-label {
            padding: 0 28px 14px;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-mid);
        }

        /* GRID LAYOUT */
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
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: right bottom;
            background-size: auto 85%;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        /* Specific Backgrounds */
        .bg-grey   { background-color: var(--grey-card); }
        .bg-green  { background-color: var(--green-card); }
        .bg-teal   { background-color: var(--teal); }
        .bg-navy   { background-color: var(--navy); }
        .bg-purple { background-color: #6c63ff; }

        .computer-bg { background-image: url("{{ asset('images/computer-class-bgtest.png') }}"); }
        .book-bg { background-image: url("{{ asset('images/book-class-bgtest.png') }}"); }

        .class-info h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 2px; }
        .class-info p { font-size: 0.75rem; opacity: 0.9; font-weight: 500; }
        .student-count { font-size: 0.7rem; font-weight: 400; opacity: 0.8; }

        /* Select badge shown on hover */
        .select-badge {
            position: absolute;
            bottom: 18px;
            right: 18px;
            background: rgba(255,255,255,0.22);
            border: 1.5px solid rgba(255,255,255,0.5);
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 0.72rem;
            font-weight: 600;
            color: #fff;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .class-card:hover .select-badge { opacity: 1; }

        .select-badge svg { width: 12px; height: 12px; flex-shrink: 0; }

    </style>
</head>
<body>

<div class="app">
    <x-teacher.sidebar active="quiz" />

    <div class="main">
        <div class="topbar">
            <h2>Edit Quiz</h2>
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

        <div class="section-label">Select a class to edit its quiz</div>

        <div class="content">
            @forelse ($classes as $class)
            <a class="class-card {{ $class->color_class }} {{ $class->bg }}"
               href="{{ route('teacher.edit-quiz.class', $class->id) }}"
               style="text-decoration:none;">

                <div class="card-top">
                    <div class="class-info">
                        <h3>{{ $class->name }}</h3>
                        <p>{{ $class->subject_label }}</p>
                    </div>
                </div>

                <div class="student-count">{{ $class->students_count }} {{ Str::plural('student', $class->students_count) }}</div>

                <div class="select-badge">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Quiz
                </div>
            </a>
            @empty
            <div style="grid-column:1/-1;text-align:center;color:var(--text-light);padding:40px 0;font-size:0.9rem;">
                No classes yet. Create a class first in
                <a href="{{ route('teacher.my-classes') }}" style="color:var(--teal);font-weight:600;text-decoration:none;">My Classes</a>.
            </div>
            @endforelse
        </div>
    </div>
</div>

</body>
</html>
