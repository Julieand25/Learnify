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

                    <div class="q-input" style="pointer-events:none;">{{ $question->question }}</div>

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
                                        <span class="option-input">{{ $opt->body }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <p class="answer-label">Model Answer</p>
                            <textarea class="answer-textarea" name="answer_text"
                                placeholder="Enter your answer here..."
                                rows="5">{{ $savedAnswer->answer_text ?? '' }}</textarea>
                        @endif

                        <div class="nav-row">
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
    function selectOption(radio) {
        document.querySelectorAll('.option-row').forEach(el => el.classList.remove('selected'));
        radio.closest('.option-row').classList.add('selected');
    }
</script>

</body>
</html>
