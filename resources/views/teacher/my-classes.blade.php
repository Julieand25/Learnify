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

</body>
</html>
