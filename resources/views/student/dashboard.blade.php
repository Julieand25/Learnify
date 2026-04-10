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
            
            --sidebar-w: 200px;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--main-bg);
            color: var(--text-dark);
            overflow: hidden;
        }

        .app { display: flex; height: 100vh; width: 100vw; }

        /* ════════════ SIDEBAR ════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            padding: 30px 0;
            flex-shrink: 0;
            box-shadow: 4px 0 15px rgba(0,0,0,0.03);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 25px;
            margin-bottom: 40px;
        }

        .sidebar-logo img { width: 35px; }
        .sidebar-logo span { font-weight: 800; color: var(--navy); letter-spacing: 1px; }

        .nav { list-style: none; flex: 1; padding: 0 15px; }
        .nav li { margin-bottom: 8px; }
        .nav li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.85rem;
            color: var(--text-mid);
            transition: 0.3s;
        }

        .nav li.active a { background: var(--teal-light); color: var(--teal); font-weight: 600; }
        .nav li a:hover:not(.active) { background: #f8f9fa; }
        .nav li a svg { width: 20px; opacity: 0.7; }

        .sidebar-logout { padding: 0 15px; }
        .sidebar-logout a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            background: #6c7a89;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* ════════════ MAIN CONTENT ════════════ */
        .main { flex: 1; display: flex; flex-direction: column; overflow-y: auto; padding: 30px 40px; }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .user-profile { display: flex; align-items: center; gap: 15px; }
        .notif-btn {
            background: #fff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            cursor: pointer;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            padding: 5px 15px 5px 5px;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .user-chip img { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; }

        /* ════════════ COURSE CATEGORIES ════════════ */
        .section-label { font-size: 1rem; font-weight: 700; margin-bottom: 20px; }
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
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

        /* MINI BAR CHART */
        .mini-bars {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            height: 80px;
            margin-bottom: 10px;
        }

        .m-bar { width: 15px; background: #7467ef; border-radius: 4px; }
        .bar-label { font-size: 0.65rem; color: var(--text-light); margin-top: 8px; }

    </style>
</head>
<body>

<div class="app">
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="logo.png" alt="L">
            <span>LEARNIFY</span>
        </div>
        <ul class="nav">
            <li class="active"><a href="#">Dashboard</a></li>
            <li><a href="#">Learning Module</a></li>
            <li><a href="#">Quiz</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
        <div class="sidebar-logout">
            <a href="#">Logout</a>
        </div>
    </aside>

    <main class="main">
        <div class="top-header">
            <h2>Good morning, Eden 👋</h2>
            <div class="user-profile">
                <button class="notif-btn">🔔</button>
                <div class="user-chip">
                    <img src="https://i.pravatar.cc/150?u=eden" alt="User">
                    <span>Eden Hazard</span>
                </div>
            </div>
        </div>

        <h3 class="section-label">Course Category</h3>
        <div class="categories-grid">
            <a href="#" class="cat-card physics">
                <div class="cat-info">📁 Physics</div>
                <span>&rsaquo;</span>
            </a>
            <a href="#" class="cat-card chemistry">
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
            </a>
        </div>

        <div class="dashboard-body">
            <div class="chart-container">
                <div class="chart-header">
                    <div class="chart-title">Physics - Electricity<br><small>Progress Score</small></div>
                    <div class="average-legend"><span class="dot"></span> Average grade</div>
                </div>
                
                <svg viewBox="0 0 800 300" style="width:100%; height:auto; overflow:visible;">
                    <line x1="0" y1="0" x2="800" y2="0" stroke="#f0f2f5" stroke-width="2" />
                    <line x1="0" y1="75" x2="800" y2="75" stroke="#f0f2f5" stroke-width="2" />
                    <line x1="0" y1="150" x2="800" y2="150" stroke="#f0f2f5" stroke-width="2" />
                    <line x1="0" y1="225" x2="800" y2="225" stroke="#f0f2f5" stroke-width="2" />
                    <line x1="0" y1="300" x2="800" y2="300" stroke="#333" stroke-width="1" />

                    <text x="-40" y="10" font-size="14" fill="#9aaabb">100%</text>
                    <text x="-40" y="110" font-size="14" fill="#9aaabb">66%</text>
                    <text x="-40" y="210" font-size="14" fill="#9aaabb">33%</text>
                    <text x="-40" y="300" font-size="14" fill="#9aaabb">0%</text>

                    <path d="M 50 10 C 150 10, 250 180, 400 120 S 600 250, 750 90" 
                          fill="none" stroke="#333" stroke-width="2" />
                    
                    <circle cx="50" cy="10" r="6" fill="#4a69bd" />
                    <circle cx="400" cy="120" r="6" fill="#4a69bd" />
                    <circle cx="550" cy="180" r="6" fill="#4a69bd" />
                    <circle cx="750" cy="90" r="6" fill="#4a69bd" />

                    <text x="50" y="340" font-size="14" fill="#1a2b3c" font-weight="600">3.1</text>
                    <text x="400" y="340" font-size="14" fill="#1a2b3c" font-weight="600">3.2</text>
                    <text x="550" y="340" font-size="14" fill="#1a2b3c" font-weight="600">3.3</text>
                    <text x="750" y="340" font-size="14" fill="#1a2b3c" font-weight="600">3.4</text>
                </svg>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span style="font-weight:700">Statistic</span>
                    <span>⋮</span>
                </div>
                
                <div class="circular-progress">
                    <span class="percent-badge">32%</span>
                    <img src="https://i.pravatar.cc/150?u=eden" alt="Eden">
                </div>

                <p class="stat-hint">Continue your learning to achieve your target</p>

                <div class="mini-bars">
                    <div class="m-bar" style="height: 70%;"></div>
                    <div class="m-bar" style="height: 40%;"></div>
                    <div class="m-bar" style="height: 60%;"></div>
                    <div class="m-bar" style="height: 90%;"></div>
                </div>
                <div style="display:flex; justify-content:space-around">
                    <span class="bar-label">3.1</span>
                    <span class="bar-label">3.2</span>
                    <span class="bar-label">3.3</span>
                    <span class="bar-label">3.4</span>
                </div>
                <p style="font-size:0.75rem; color:var(--teal); font-weight:700; margin-top:15px;">Learning Progress</p>
            </div>
        </div>
    </main>
</div>

</body>
</html>