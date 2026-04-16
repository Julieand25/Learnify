<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Online Notes</title>
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
           MAIN
        ══════════════════════════════ */
        .main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Topbar */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 28px;
            background: var(--main-bg);
            flex-shrink: 0;
        }

        .header-text h2 { font-size: 1.3rem; font-weight: 700; }
        .header-text p  { font-size: 0.78rem; color: var(--text-mid); margin-top: 2px; }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-mid);
            text-decoration: none;
            margin-bottom: 6px;
            transition: color 0.2s;
        }

        .back-btn:hover { color: var(--teal); }
        .back-btn svg { width: 14px; height: 14px; }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--card-bg);
            border-radius: 24px;
            padding: 6px 14px 6px 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* Scrollable content */
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 0;
        }

        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #c0d0d8; border-radius: 10px; }

        /* ══════════════════════════════
           HERO BANNER
        ══════════════════════════════ */
        .hero {
            display: flex;
            align-items: flex-start;
            gap: 40px;
            padding: 18px 36px 12px;
            border-bottom: 1px solid #d4eae8;
        }

        .hero-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
            flex: 0 0 auto;
            max-width: 340px;
        }

        .hero-desc {
            font-size: 0.85rem;
            color: var(--text-mid);
            line-height: 1.7;
            padding-top: 6px;
        }

        /* ══════════════════════════════
           BODY CONTENT
        ══════════════════════════════ */
        .body-content {
            padding: 28px 36px 40px;
        }

        /* Subject heading */
        .subject-heading {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .subject-desc {
            font-size: 0.82rem;
            color: var(--text-mid);
            line-height: 1.6;
            margin-bottom: 24px;
            max-width: 740px;
        }

        /* Image row */
        .img-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .img-row img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
            background: #c8d8e0;
        }

        /* ══════════════════════════════
           CURRICULUM SECTION
        ══════════════════════════════ */
        .curriculum-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 18px;
        }

        /* 4-column chapter dropdowns */
        .chapters-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            align-items: start;
        }

        .chapter-col {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .chapter-number {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 2px;
        }

        /* Dropdown trigger button */
        .chapter-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 10px 12px;
            background: var(--card-bg);
            border: 1.5px solid #ccdee4;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
            text-align: left;
            transition: border-color 0.2s, background 0.2s;
            position: relative;
        }

        .chapter-btn:hover { border-color: var(--teal); }
        .chapter-btn.open  { border-color: var(--teal); background: #f4fbfa; }

        .chapter-btn svg.book-icon {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: var(--teal);
        }

        .chapter-btn .chevron {
            width: 14px;
            height: 14px;
            margin-left: auto;
            color: var(--text-light);
            flex-shrink: 0;
            transition: transform 0.2s;
        }

        .chapter-btn.open .chevron { transform: rotate(180deg); }

        .chapter-btn span { flex: 1; }

        /* Hint text */
        .chapter-hint {
            font-size: 0.7rem;
            color: var(--text-light);
        }

        /* Dropdown panel */
        .chapter-dropdown {
            display: none;
            flex-direction: column;
            background: var(--card-bg);
            border: 1.5px solid #ccdee4;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .chapter-dropdown.show { display: flex; }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            font-size: 0.78rem;
            color: var(--text-mid);
            text-decoration: none;
            border-bottom: 1px solid #f0f6f7;
            transition: background 0.15s, color 0.15s;
            cursor: pointer;
        }

        .dropdown-item:last-child { border-bottom: none; }

        .dropdown-item:hover {
            background: var(--teal-light);
            color: var(--teal);
        }

        .dropdown-item svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            color: var(--text-light);
        }

        .dropdown-item:hover svg { color: var(--teal); }
    </style>
</head>
<body>

<div class="app">

    <x-student.sidebar active="learning-module" />

    <!-- ══ MAIN ══ -->
    <div class="main">

        <div class="topbar">
            <div class="header-text">
                <a href="{{ route('student.learning-module') }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Learning Module
                </a>
                <h2>Physics</h2>
                <p>SPM Physics — Notes &amp; Curriculum</p>
            </div>
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

        <!-- Content -->
        <div class="content">

            <!-- ── HERO BANNER ── -->
            <div class="hero">
                <h1 class="hero-title">Online Notes for SPM Students</h1>
                <p class="hero-desc">
                    Access comprehensive, syllabus-aligned notes tailored for Form 5 students.
                    Master complex concepts through simplified explanations and visual aids.
                </p>
            </div>

            <!-- ── BODY ── -->
            <div class="body-content">

                <h2 class="subject-heading">Physics</h2>
                <p class="subject-desc">
                    A complete guide to Form 5 Physics based on the KSSM curriculum. Covers key themes
                    including Newtonian Mechanics, Electricity, and Electromagnetism.
                </p>

                <!-- 3 images -->
                <div class="img-row">
                    <img src="{{ asset('images/notes-img1.png') }}" alt="Notes Image 1"
                         onerror="this.style.background='linear-gradient(135deg,#c8d8e8,#a8b8c8)';this.removeAttribute('src')">
                    <img src="{{ asset('images/notes-img2.png') }}" alt="Notes Image 2"
                         onerror="this.style.background='linear-gradient(135deg,#d8c8b8,#c0a888)';this.removeAttribute('src')">
                    <img src="{{ asset('images/notes-img3.png') }}" alt="Notes Image 3"
                         onerror="this.style.background='linear-gradient(135deg,#c8d0b8,#a8b098)';this.removeAttribute('src')">
                </div>

                <!-- Curriculum -->
                <h3 class="curriculum-title">Curriculum</h3>

                <div class="chapters-grid">

                    <!-- Chapter 1: Force & Motion II -->
                    <div class="chapter-col">
                        <div class="chapter-number">1. Force &amp; Motion II</div>
                        <button class="chapter-btn" onclick="toggleDropdown('ch1')">
                            <svg class="book-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span>Chapter 1: Force &amp; Motion II</span>
                            <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="chapter-dropdown" id="ch1">
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 1.1: Newton's Laws
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 1.2: Momentum
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 1.3: Gravity
                            </a>
                        </div>
                        <span class="chapter-hint">Select a chapter to learn.</span>
                    </div>

                    <!-- Chapter 2: Pressure -->
                    <div class="chapter-col">
                        <div class="chapter-number">2. Pressure</div>
                        <button class="chapter-btn" onclick="toggleDropdown('ch2')">
                            <svg class="book-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span>Chapter 2: Pressure</span>
                            <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="chapter-dropdown" id="ch2">
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 2.1: Gas Pressure
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 2.2: Atmospheric Pressure
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 2.3: Pascal's Principle
                            </a>
                        </div>
                        <span class="chapter-hint">Select a chapter to learn.</span>
                    </div>

                    <!-- Chapter 3: Electricity — clickable with subtopics -->
                    <div class="chapter-col">
                        <div class="chapter-number">3. Electricity</div>
                        <button class="chapter-btn" id="ch3-btn" onclick="toggleDropdown('ch3')">
                            <svg class="book-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span>Chapter 3: Electricity</span>
                            <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="chapter-dropdown" id="ch3">
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 3.1: Current &amp; Potential Difference
                            </a>
                            <a href="{{ route('student.chapter.resistance') }}" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 3.2: Resistance
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 3.3: EMF &amp; Internal Force
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 3.4: Electrical Energy &amp; Power
                            </a>
                        </div>
                        <span class="chapter-hint">Select a chapter to learn.</span>
                    </div>

                    <!-- Chapter 4: Electromagnetism -->
                    <div class="chapter-col">
                        <div class="chapter-number">4. Electromagnetism</div>
                        <button class="chapter-btn" onclick="toggleDropdown('ch4')">
                            <svg class="book-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span>Chapter 4: Electromagnetism</span>
                            <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="chapter-dropdown" id="ch4">
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 4.1: Magnetic Field
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 4.2: Electromagnetic Induction
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Chapter 4.3: Transformer
                            </a>
                        </div>
                        <span class="chapter-hint">Select a chapter to learn.</span>
                    </div>

                </div><!-- /chapters-grid -->

            </div><!-- /body-content -->
        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const btn = dropdown.previousElementSibling;
        const content = document.querySelector('.content');

        // Close all other open dropdowns
        document.querySelectorAll('.chapter-dropdown.show').forEach(d => {
            if (d.id !== id) {
                d.classList.remove('show');
                d.previousElementSibling.classList.remove('open');
            }
        });

        // Toggle current
        const isOpen = dropdown.classList.contains('show');
        dropdown.classList.toggle('show', !isOpen);
        btn.classList.toggle('open', !isOpen);

        if (!isOpen) {
            // Opening — scroll so the dropdown is visible
            setTimeout(() => {
                dropdown.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 50);
        } else {
            // Closing — scroll back to top
            content.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.chapter-col')) {
            const hadOpen = document.querySelector('.chapter-dropdown.show');
            document.querySelectorAll('.chapter-dropdown.show').forEach(d => {
                d.classList.remove('show');
                d.previousElementSibling.classList.remove('open');
            });
            if (hadOpen) {
                document.querySelector('.content').scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    });
</script>

</body>
</html>