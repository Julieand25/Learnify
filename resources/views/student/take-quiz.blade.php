<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Quiz</title>
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
            --red: #ef4444;
            --green: #22c55e;
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
            flex-direction: column;
            overflow: hidden;
        }

        /* ══════════════════════════════
           CHAPTER HEADER
        ══════════════════════════════ */
        .chapter-header {
            background: var(--main-bg);
            padding: 20px 28px 0;
            flex-shrink: 0;
        }

        .header-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-mid);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-bottom: 10px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-btn:hover { color: var(--teal-dark); }
        .back-btn svg { flex-shrink: 0; }

        .chapter-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .chapter-subtitle {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-chip {
            display: flex; align-items: center; gap: 8px;
        }

        .user-chip span {
            font-size: 0.82rem; font-weight: 600; color: var(--text-dark);
        }

        /* Progress row */
        .progress-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }

        .progress-track {
            flex: 1; height: 6px;
            background: #e6e6e6;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #22c55e;
            border-radius: 999px;
            width: 0%;
            transition: width 0.3s ease;
        }

        .progress-label {
            font-size: 0.72rem; color: var(--text-light); white-space: nowrap;
        }

        /* ══════════════════════════════
           MAIN LAYOUT
        ══════════════════════════════ */
        .main-layout {
            flex: 1;
            display: flex;
            gap: 0;
            overflow: hidden;
            padding: 16px 28px 24px;
            gap: 20px;
        }

        /* ══════════════════════════════
           LEFT: QUESTION AREA
        ══════════════════════════════ */
        .question-area {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
            overflow-y: auto;
        }

        .question-area::-webkit-scrollbar { width: 4px; }
        .question-area::-webkit-scrollbar-thumb { background: #b0ccd0; border-radius: 10px; }

        /* Question card */
        .q-card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 20px 22px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border: 1.5px solid transparent;
            transition: border-color 0.2s;
        }

        .q-card.active { border-color: var(--teal); }

        /* Card top row */
        .q-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .q-number {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Type toggle style (read-only display for student) */
        .type-toggle {
            display: flex;
            border: 1.5px solid #d0e4e2;
            border-radius: 8px;
            overflow: hidden;
        }

        .type-btn {
            padding: 6px 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            border: none;
            background: transparent;
            color: var(--text-light);
        }

        .type-btn.active {
            background: var(--teal);
            color: #fff;
        }

        /* Question text */
        .q-input {
            width: 100%;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
            border: none;
            outline: none;
            background: transparent;
            resize: none;
            line-height: 1.5;
            min-height: 40px;
        }

        .q-divider {
            height: 1px;
            background: #eef4f5;
            margin: 12px 0;
        }

        /* ── OBJECTIVE: Answer options ── */
        .options-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 10px;
        }

        .option-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border: 1px solid #d8eaec;
            border-radius: 8px;
            background: #fafcfd;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            user-select: none;
        }

        .option-row:hover {
            border-color: var(--teal);
            background: var(--teal-light);
        }

        .option-row.selected {
            border-color: var(--teal-dark);
            background: var(--teal-light);
        }

        .option-row input[type="radio"] { display: none; }

        .option-label {
            width: 26px; height: 26px;
            border-radius: 50%;
            background: #f0f6f8;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.72rem; font-weight: 700;
            color: var(--text-mid);
            flex-shrink: 0;
            transition: background 0.2s, color 0.2s;
        }

        .option-row.selected .option-label {
            background: var(--teal-dark);
            color: #fff;
        }

        .option-input {
            flex: 1;
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            color: var(--text-dark);
            background: transparent;
            border: none;
            outline: none;
            cursor: pointer;
        }

        /* ── SUBJECTIVE: Answer textarea ── */
        .answer-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
        }

        .answer-textarea {
            width: 100%;
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            color: var(--text-dark);
            border: 1px solid #d8eaec;
            border-radius: 8px;
            padding: 10px 12px;
            outline: none;
            resize: none;
            min-height: 80px;
            background: #fafcfd;
            transition: border-color 0.2s;
            line-height: 1.6;
        }

        .answer-textarea:focus { border-color: var(--teal); background: #fff; }
        .answer-textarea::placeholder { color: var(--text-light); }

        /* Navigation */
        .nav-row {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-next {
            padding: 7px 18px; border-radius: 999px;
            background: var(--teal-dark); color: #fff;
            border: none; font-family: 'Poppins', sans-serif;
            font-size: 0.78rem; font-weight: 600; cursor: pointer;
            transition: opacity 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }

        .btn-next:hover { opacity: 0.85; }

        .btn-submit {
            padding: 7px 18px; border-radius: 999px;
            background: #22c55e; color: #fff;
            border: none; font-family: 'Poppins', sans-serif;
            font-size: 0.78rem; font-weight: 600; cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-submit:hover { opacity: 0.85; }

        /* ══════════════════════════════
           STATE: No quiz / empty
        ══════════════════════════════ */
        .empty-state {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: var(--text-light);
            text-align: center;
        }

        .empty-state svg { opacity: 0.35; margin-bottom: 4px; }
        .empty-state h4 { font-size: 0.95rem; font-weight: 700; color: var(--text-mid); }
        .empty-state p  { font-size: 0.78rem; line-height: 1.6; max-width: 320px; }

        /* ══════════════════════════════
           STATE: Results
        ══════════════════════════════ */
        .result-card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 32px 28px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border: 1.5px solid transparent;
            text-align: center;
        }

        .result-score-ring {
            width: 110px; height: 110px;
            border-radius: 50%;
            border: 6px solid var(--teal-dark);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            margin: 0 auto 20px;
        }

        .result-score-ring .score-num {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--teal-dark);
            line-height: 1;
        }

        .result-score-ring .score-sub {
            font-size: 0.65rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .result-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .result-sub {
            font-size: 0.8rem;
            color: var(--text-mid);
            margin-bottom: 24px;
        }

        /* Answer review list */
        .review-list {
            text-align: left;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .review-item {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1.5px solid #eef4f5;
            background: #fafcfd;
        }

        .review-item.correct { border-color: #bbf7d0; background: #f0fdf4; }
        .review-item.wrong   { border-color: #fecaca; background: #fff5f5; }
        .review-item.manual  { border-color: #fde68a; background: #fefce8; }

        .review-q {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .review-answer {
            font-size: 0.72rem;
            color: var(--text-mid);
        }

        .review-badge {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 999px;
            margin-bottom: 4px;
        }

        .badge-correct { background: #dcfce7; color: #16a34a; }
        .badge-wrong   { background: #fee2e2; color: #dc2626; }
        .badge-manual  { background: #fef9c3; color: #a07800; }

        /* ══════════════════════════════
           RIGHT: STICKY NOTE / HINT
        ══════════════════════════════ */
        .hint-panel {
            width: 160px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .sticky-note {
            background: #fef9c3;
            border-radius: 10px;
            padding: 14px 14px 18px;
            box-shadow: 3px 4px 12px rgba(0,0,0,0.1);
            position: relative;
            height: 140px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .sticky-note.yellow-dark { background: #fde047; }

        .sticky-pin {
            position: absolute;
            top: 4px; right: 14px;
            font-size: 1.1rem;
        }

        .sticky-title {
            font-size: 0.68rem;
            font-weight: 700;
            color: #a08000;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        .sticky-content {
            font-size: 0.7rem;
            color: #5a4a00;
            line-height: 1.6;
            white-space: pre-wrap;
            overflow-y: auto;
            max-height: 78px;
            scrollbar-width: thin;
            scrollbar-color: #d4b84a transparent;
        }

        .sticky-content::-webkit-scrollbar { width: 3px; }
        .sticky-content::-webkit-scrollbar-thumb { background: #d4b84a; border-radius: 10px; }

        .sticky-empty {
            font-size: 0.68rem;
            color: #c0a030;
            font-style: italic;
        }

        /* Hover-reveal layer — hidden by default, shown on hover */
        .sticky-reveal {
            opacity: 0;
            position: absolute;
            inset: 0;
            padding: 14px 14px 18px;
            transition: opacity 0.25s;
            pointer-events: none;
            background: inherit;
            border-radius: 10px;
            overflow: hidden;
        }

        .sticky-placeholder { transition: opacity 0.25s; }

        .sticky-note:hover .sticky-placeholder { opacity: 0; }
        .sticky-note:hover .sticky-reveal      { opacity: 1; pointer-events: auto; }

        /* ══════════════════════════════
           CIRCUIT BUILDER
        ══════════════════════════════ */
        .circuit-svg-wrap {
            margin: 4px 0 6px;
            background: #f8fbfd;
            border: 1px solid #e0ecef;
            border-radius: 10px;
            padding: 8px;
        }

        .component-tray {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin: 12px 0 4px;
        }

        .component-tile {
            background: #f0f6f8;
            border: 2px solid #d8eaec;
            border-radius: 10px;
            padding: 10px 16px;
            cursor: grab;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            color: var(--text-mid);
            text-align: center;
            transition: border-color 0.2s, opacity 0.2s, transform 0.15s;
            user-select: none;
            min-width: 70px;
            outline: none;
        }

        .component-tile:hover  { border-color: var(--teal); transform: translateY(-2px); }
        .component-tile:active { cursor: grabbing; }
        .component-tile:focus-visible { box-shadow: 0 0 0 2px var(--teal); }
        .component-tile.used   { opacity: 0.22; pointer-events: none; }

        .circuit-complete-msg {
            text-align: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--teal-dark);
            background: var(--teal-light);
            border-radius: 8px;
            padding: 7px 12px;
            margin: 10px 0 4px;
        }

        .followup-section {
            animation: fadeInUp 0.3s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="app">

    <!-- ══ HEADER ══ -->
    <div class="chapter-header">
        <a href="{{ route('student.quiz') }}" class="back-btn">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Classes
        </a>
        <div class="header-top">
            <div>
                <h1 class="chapter-title">{{ $classRoom->name }}</h1>
                <!-- <p class="chapter-subtitle">{{ $classRoom->subject_label ?? 'Quiz' }}</p> -->
            </div>
            <div class="header-right">
                <div class="user-chip">
                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;">
                        {{ strtoupper(substr($user->name ?? 'S', 0, 1)) }}
                    </div>
                    <span>{{ $user->name ?? 'Student' }}</span>
                </div>
            </div>
        </div>

        <div class="progress-row">
            @php
                $pct = $totalQuestions > 0 ? round(($currentQuestion / $totalQuestions) * 100) : 0;
            @endphp
            <div class="progress-track">
                <div class="progress-fill" style="width: {{ $pct }}%"></div>
            </div>
            <span class="progress-label">{{ $currentQuestion }}/{{ $totalQuestions }}</span>
        </div>
    </div>

    <!-- ══ MAIN LAYOUT ══ -->
    <div class="main-layout">

        <!-- ── LEFT: Question / State ── -->
        <div class="question-area">

            @if ($attempt)
                {{-- ─── COMPLETED: Show results ─── --}}
                <div class="result-card">
                    <div class="result-score-ring">
                        <span class="score-num">{{ $attempt->score }}</span>
                        <span class="score-sub">/ {{ $attempt->total }}</span>
                    </div>
                    <div class="result-title">Quiz Completed!</div>
                    <div class="result-sub">
                        You scored <strong>{{ $attempt->score }}</strong> out of <strong>{{ $attempt->total }}</strong> objective
                        question{{ $attempt->total !== 1 ? 's' : '' }}.
                        @if ($attempt->total > 0)
                            That's {{ round(($attempt->score / $attempt->total) * 100) }}%.
                        @endif
                    </div>

                    <form method="POST" action="{{ route('student.quiz.retake', $classRoom->id) }}"
                          onsubmit="return confirm('Retake this quiz? Your previous attempt will be cleared.')">
                        @csrf
                        <button type="submit" class="btn-next" style="margin: 0 auto;">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Retake Quiz
                        </button>
                    </form>

                    @if ($attempt->answers->count() > 0 && $quiz && $quiz->questions->isNotEmpty())
                        <div class="review-list">
                            @foreach ($quiz->questions as $idx => $q)
                                @php
                                    $ans = $attempt->answers->firstWhere('quiz_question_id', $q->id);
                                @endphp
                                @if ($q->type === 'objective')
                                    @php
                                        $correct = $ans && $ans->is_correct;
                                        $cls = $ans ? ($correct ? 'correct' : 'wrong') : '';
                                    @endphp
                                    <div class="review-item {{ $cls }}">
                                        <div class="review-q">Q{{ $idx + 1 }}. {{ $q->question }}</div>
                                        @if ($ans)
                                            <span class="review-badge {{ $correct ? 'badge-correct' : 'badge-wrong' }}">
                                                {{ $correct ? 'Correct' : 'Incorrect' }}
                                            </span>
                                            <div class="review-answer">
                                                Your answer: <strong>{{ $ans->selected_option ?? '—' }}</strong>
                                            </div>
                                        @else
                                            <div class="review-answer" style="color:var(--text-light);">Not answered</div>
                                        @endif
                                    </div>
                                @elseif ($q->type === 'circuit')
                                    <div class="review-item manual">
                                        <div class="review-q">Q{{ $idx + 1 }}. Circuit Builder</div>
                                        <span class="review-badge badge-manual">Circuit</span>
                                        <div class="review-answer" style="margin-bottom:4px;font-style:italic;font-size:0.7rem;">{{ $q->question }}</div>
                                        <div class="review-answer">Your answer: {{ $ans->answer_text ?? '—' }}</div>
                                    </div>
                                @else
                                    <div class="review-item manual">
                                        <div class="review-q">Q{{ $idx + 1 }}. {{ $q->question }}</div>
                                        <span class="review-badge badge-manual">Subjective</span>
                                        <div class="review-answer">Your answer: {{ $ans->answer_text ?? '—' }}</div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

            @elseif (! $quiz || $quiz->questions->isEmpty())
                {{-- ─── NO QUIZ YET ─── --}}
                <div class="empty-state">
                    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <h4>No Quiz Available</h4>
                    <p>Your teacher hasn't published a quiz for this class yet. Check back later.</p>
                </div>

            @else
                {{-- ─── ACTIVE QUESTION ─── --}}
                <div class="q-card active">
                    <div class="q-card-top">
                        <span class="q-number">Question {{ $currentQuestion }}</span>
                        <!-- <div class="type-toggle">
                            <button class="type-btn {{ $question->type === 'objective'  ? 'active' : '' }}">Objective</button>
                            <button class="type-btn {{ $question->type === 'subjective' ? 'active' : '' }}">Subjective</button>
                        </div> -->
                    </div>

                    <div class="q-input" style="pointer-events:none;">
                        @if ($question->type === 'circuit')
                            Drag and drop the correct symbols into the empty slots to complete the series circuit diagram.
                        @else
                            {{ $question->question }}
                        @endif
                    </div>

                    <div class="q-divider"></div>

                    <form method="POST" action="{{ route('student.quiz.answer', $classRoom->id) }}" id="answerForm">
                        @csrf
                        <input type="hidden" name="question_number" value="{{ $currentQuestion }}">
                        <input type="hidden" name="question_id"     value="{{ $question->id }}">

                        @if ($question->type === 'objective')
                            <div class="options-list">
                                @foreach ($question->options as $opt)
                                    @php $selected = $savedAnswer && $savedAnswer->selected_option === $opt->letter; @endphp
                                    <label class="option-row {{ $selected ? 'selected' : '' }}">
                                        <input type="radio" name="answer" value="{{ $opt->letter }}"
                                               {{ $selected ? 'checked' : '' }}
                                               onchange="selectOption(this)">
                                        <div class="option-label">{{ $opt->letter }}</div>
                                        <span class="option-input">{{ $opt->text }}</span>
                                    </label>
                                @endforeach
                            </div>

                        @elseif ($question->type === 'circuit')
                            {{-- ── Circuit Builder (uses the real circuit SVG) ── --}}

                            <div class="circuit-svg-wrap">
                                <svg viewBox="0 0 480 260" xmlns="http://www.w3.org/2000/svg"
                                     style="display:block;width:100%;max-width:480px;margin:0 auto;">
                                    <style>
                                        .cw  { stroke:#1a1a1a; stroke-width:4; stroke-linecap:round; fill:none; }
                                        .cbt { fill:none; stroke:#1a1a1a; stroke-width:4; stroke-linecap:round; stroke-linejoin:round; }
                                        .ctm { fill:none; stroke:#1a1a1a; stroke-width:3; stroke-linecap:round; }
                                        .cblt { fill:#1a1a1a; }
                                        .cres { fill:none; stroke:#1a1a1a; stroke-width:4; }
                                        .crtxt  { font-size:13px; fill:#1a1a1a; font-family:sans-serif; dominant-baseline:central; text-anchor:middle; }
                                        .ctag   { fill:#f5e6d3; stroke:#c8a882; stroke-width:1.5; }
                                        .ctagtxt { font-size:13px; fill:#7a5c3a; font-family:sans-serif; dominant-baseline:central; text-anchor:middle; }
                                        .cslot  { fill:#eef6fb; stroke:#6baed6; stroke-width:2; stroke-dasharray:6,3; cursor:pointer; transition:fill 0.15s,stroke 0.15s; }
                                        .cslot.drag-over { fill:#dff4f2; stroke:#2aa19a; }
                                        .cslottxt { font-size:11px; fill:#5a9ec8; font-family:sans-serif; text-anchor:middle; dominant-baseline:central; pointer-events:none; }
                                        .cslottxt2 { font-size:9px; fill:#94a3b8; font-family:sans-serif; text-anchor:middle; dominant-baseline:central; pointer-events:none; }
                                    </style>

                                    {{-- ─ Wires (always visible) ─ --}}
                                    <line class="cw" x1="70"  y1="30"  x2="410" y2="30"/>
                                    <line class="cw" x1="70"  y1="230" x2="168" y2="230"/>
                                    <line class="cw" x1="292" y1="230" x2="410" y2="230"/>
                                    <line class="cw" x1="70"  y1="30"  x2="70"  y2="113"/>
                                    <line class="cw" x1="70"  y1="147" x2="70"  y2="230"/>
                                    <line class="cw" x1="410" y1="30"  x2="410" y2="90"/>
                                    <line class="cw" x1="410" y1="170" x2="410" y2="230"/>

                                    {{-- ─ Battery slot ─ --}}
                                    <g id="battery-slot-group">
                                        <rect id="battery-slot-rect" class="cslot" x="15" y="100" width="115" height="60" rx="6"
                                              ondragover="event.preventDefault();svgSlotOver(this)"
                                              ondragleave="svgSlotLeave(this)"
                                              ondrop="svgDrop(event,'battery')"/>
                                        <text class="cslottxt"  x="72" y="122">BATTERY</text>
                                        <text class="cslottxt2" x="72" y="138">drop here</text>
                                    </g>

                                    {{-- ─ Battery (hidden initially, revealed on drop) ─ --}}
                                    <g id="battery-group" style="opacity:0;pointer-events:none;">
                                        <circle class="ctm" cx="50" cy="90" r="11"/>
                                        <line class="ctm" x1="50" y1="84" x2="50" y2="96"/>
                                        <line class="ctm" x1="44" y1="90" x2="56" y2="90"/>
                                        <path class="cbt" d="M60,113 L48,113 Q40,113 40,121 L40,139 Q40,147 48,147 L60,147"/>
                                        <path class="cbt" d="M80,113 L92,113 Q100,113 100,121 L100,139 Q100,147 92,147 L80,147"/>
                                        <polygon class="cblt" points="72,118 62,130 69,130 65,142 81,129 73,129 79,118"/>
                                        <circle class="ctm" cx="50" cy="170" r="11"/>
                                        <line class="ctm" x1="44" y1="170" x2="56" y2="170"/>
                                        <!-- <rect class="ctag" x="110" y="135" width="44" height="20" rx="10"/>
                                        <text class="ctagtxt" x="132" y="145">12V</text> -->
                                    </g>

                                    {{-- ─ Bulb slot ─ --}}
                                    <g id="bulb-slot-group">
                                        <rect id="bulb-slot-rect" class="cslot" x="382" y="100" width="74" height="60" rx="6"
                                              ondragover="event.preventDefault();svgSlotOver(this)"
                                              ondragleave="svgSlotLeave(this)"
                                              ondrop="svgDrop(event,'bulb')"/>
                                        <text class="cslottxt"  x="419" y="122">BULB</text>
                                        <text class="cslottxt2" x="419" y="138">drop here</text>
                                    </g>

                                    {{-- ─ Bulb (hidden initially, revealed on drop) ─ --}}
                                    <g id="bulb-group" style="opacity:0;pointer-events:none;">
                                        <circle fill="none" stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" cx="410" cy="130" r="16"/>
                                        <line stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="410" y1="98"  x2="410" y2="108"/>
                                        <line stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="410" y1="152" x2="410" y2="162"/>
                                        <line stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="379" y1="130" x2="388" y2="130"/>
                                        <line stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="432" y1="130" x2="441" y2="130"/>
                                        <line stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="387" y1="109" x2="393" y2="115"/>
                                        <line stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="427" y1="144" x2="433" y2="150"/>
                                        <line stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="387" y1="151" x2="393" y2="145"/>
                                        <line stroke="#1a1a1a" stroke-width="4" stroke-linecap="round" x1="427" y1="115" x2="433" y2="109"/>
                                        <!-- rect class="ctag" x="428" y="157" width="50" height="20" rx="10"/>
                                        <text class="ctagtxt" x="453" y="167">0.25A</text> -->
                                    </g>

                                    {{-- ─ Resistor slot ─ --}}
                                    <g id="resistor-slot-group">
                                        <rect id="resistor-slot-rect" class="cslot" x="160" y="212" width="140" height="36" rx="4"
                                              ondragover="event.preventDefault();svgSlotOver(this)"
                                              ondragleave="svgSlotLeave(this)"
                                              ondrop="svgDrop(event,'resistor')"/>
                                        <text class="cslottxt" x="230" y="230">RESISTOR — drop here</text>
                                    </g>

                                    {{-- ─ Resistor (hidden initially, revealed on drop) ─ --}}
                                    <g id="resistor-group" style="opacity:0;pointer-events:none;">
                                        <rect class="cres" x="168" y="218" width="124" height="24" rx="3"/>
                                        <!-- <text class="crtxt" x="230" y="230">0.4&#937;</text> -->
                                    </g>
                                </svg>
                            </div>

                            {{-- Component tray --}}
                            <div class="component-tray">
                                <button type="button" class="component-tile" id="comp-battery"
                                        draggable="true" ondragstart="dragStart(event,'battery')">
                                    <svg width="28" height="28" viewBox="0 0 48 48" fill="none">
                                        <rect x="8" y="14" width="28" height="20" rx="3" stroke="#4a5a6a" stroke-width="3" fill="#f0f6f8"/>
                                        <rect x="36" y="20" width="5" height="8" rx="1.5" fill="#4a5a6a"/>
                                        <line x1="16" y1="24" x2="28" y2="24" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="22" y1="18" x2="22" y2="30" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="26" y1="22" x2="26" y2="26" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                    Battery
                                </button>
                                <button type="button" class="component-tile" id="comp-bulb"
                                        draggable="true" ondragstart="dragStart(event,'bulb')">
                                    <svg width="28" height="28" viewBox="0 0 48 48" fill="none">
                                        <circle cx="24" cy="22" r="10" stroke="#4a5a6a" stroke-width="3" fill="#fefce8"/>
                                        <line x1="24" y1="6"  x2="24" y2="10" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="24" y1="34" x2="24" y2="38" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="8"  y1="22" x2="12" y2="22" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="36" y1="22" x2="40" y2="22" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="12" y1="10" x2="15" y2="13" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="33" y1="31" x2="36" y2="34" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                    Bulb
                                </button>
                                <button type="button" class="component-tile" id="comp-resistor"
                                        draggable="true" ondragstart="dragStart(event,'resistor')">
                                    <svg width="28" height="28" viewBox="0 0 48 48" fill="none">
                                        <rect x="8" y="18" width="32" height="12" rx="2" stroke="#4a5a6a" stroke-width="3" fill="#f0f6f8"/>
                                        <line x1="0" y1="24" x2="8"  y2="24" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="40" y1="24" x2="48" y2="24" stroke="#4a5a6a" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                    Resistor
                                </button>
                            </div>

                            {{-- Follow-up revealed after circuit complete (or pre-shown if already answered) --}}
                            <div class="followup-section" id="followupSection"
                                 style="{{ $savedAnswer ? '' : 'display:none;' }}">
                                <!--<div class="circuit-complete-msg">
                                    ✓ Circuit complete! Now answer the follow-up question.
                                </div>-->
                                <div class="q-divider"></div>
                                <p class="answer-label" style="margin-bottom:6px;">{{ $question->question }}</p>
                                <textarea class="answer-textarea" name="answer_text" rows="4"
                                    placeholder="Enter your answer here...">{{ $savedAnswer->answer_text ?? '' }}</textarea>
                            </div>

                        @else
                            <p class="answer-label">Your Answer</p>
                            <textarea class="answer-textarea" name="answer_text"
                                placeholder="Enter your answer here..."
                                rows="5">{{ $savedAnswer->answer_text ?? '' }}</textarea>
                        @endif

                        <div class="nav-row" id="navRow"
                             style="{{ $question->type === 'circuit' && !$savedAnswer ? 'display:none;' : '' }}">
                            @if ($currentQuestion < $totalQuestions)
                                <button type="submit" class="btn-next">
                                    Next
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            @else
                                <button type="submit" class="btn-submit">Submit Quiz</button>
                            @endif
                        </div>
                    </form>
                </div>
            @endif

        </div><!-- /question-area -->

        <!-- ── RIGHT: Hint sticky notes (hidden when quiz is completed) ── -->
        @if (! $attempt)
        <div class="hint-panel">
            @if ($quiz && $question)
                @if ($question->hint)
                    <div class="sticky-note">
                        <div class="sticky-pin">📌</div>
                        <div class="sticky-title">FORMULA HINT</div>
                        <div class="sticky-content sticky-placeholder">Hover to reveal hint...</div>
                        <div class="sticky-reveal">
                            <div class="sticky-pin">📌</div>
                            <div class="sticky-title">FORMULA HINT</div>
                            <div class="sticky-content">{{ $question->hint }}</div>
                        </div>
                    </div>
                @else
                    <div class="sticky-note">
                        <div class="sticky-pin">📌</div>
                        <div class="sticky-title">FORMULA HINT</div>
                        <div class="sticky-empty">No hint for this question.</div>
                    </div>
                @endif
            @else
                <div class="sticky-note">
                    <div class="sticky-pin">📌</div>
                    <div class="sticky-title">FORMULA HINT</div>
                    <div class="sticky-empty">Hints appear here during the quiz.</div>
                </div>
            @endif
        </div>
        @endif

    </div><!-- /main-layout -->

</div><!-- /app -->

<script>
    // ── Objective: highlight selected option ──
    function selectOption(radio) {
        document.querySelectorAll('.option-row').forEach(el => el.classList.remove('selected'));
        radio.closest('.option-row').classList.add('selected');
    }

    // ── Circuit Builder: SVG drag-and-drop ──
    const circuitState = { battery: false, bulb: false, resistor: false };

    function dragStart(event, type) {
        event.dataTransfer.setData('component', type);
        event.dataTransfer.effectAllowed = 'move';
    }

    function svgSlotOver(rect) {
        rect.classList.add('drag-over');
    }

    function svgSlotLeave(rect) {
        rect.classList.remove('drag-over');
    }

    function svgDrop(event, zone) {
        event.preventDefault();
        const type = event.dataTransfer.getData('component');
        const slotRect = document.getElementById(zone + '-slot-rect');
        if (slotRect) slotRect.classList.remove('drag-over');

        if (type !== zone) {
            // Wrong component — flash the slot red briefly
            if (slotRect) {
                slotRect.style.stroke = '#ef4444';
                slotRect.style.fill   = '#fee2e2';
                setTimeout(() => {
                    slotRect.style.stroke = '';
                    slotRect.style.fill   = '';
                }, 500);
            }
            return;
        }

        if (circuitState[zone]) return;   // already placed

        // Hide the slot placeholder
        const slotGroup = document.getElementById(zone + '-slot-group');
        if (slotGroup) slotGroup.style.display = 'none';

        // Fade in the real component
        const compGroup = document.getElementById(zone + '-group');
        if (compGroup) {
            compGroup.style.transition = 'opacity 0.35s ease';
            compGroup.style.pointerEvents = 'auto';
            requestAnimationFrame(() => { compGroup.style.opacity = '1'; });
        }

        // Grey-out the tray tile
        const tile = document.getElementById('comp-' + type);
        if (tile) tile.classList.add('used');

        circuitState[zone] = true;
        checkCircuitComplete();
    }

    function checkCircuitComplete() {
        if (!circuitState.battery || !circuitState.bulb || !circuitState.resistor) return;

        const followup = document.getElementById('followupSection');
        if (followup) followup.style.display = 'block';

        const navRow = document.getElementById('navRow');
        if (navRow) navRow.style.display = 'flex';
    }
</script>

</body>
</html>
