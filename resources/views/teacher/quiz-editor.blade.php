<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Quiz Creator</title>
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

        .notif-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(0,0,0,0.06);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--text-mid);
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
            background: #f87171;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #ef4444;
            border-radius: 999px;
            width: 0%;
            transition: width 0.3s ease;
        }

        .progress-label {
            font-size: 0.72rem; color: var(--text-light); white-space: nowrap;
        }

        /* Red/Green toggle buttons */
        .quiz-actions {
            display: flex; gap: 8px;
        }

        .btn-discard {
            padding: 7px 18px; border-radius: 999px;
            background: #ef4444; color: #fff;
            border: none; font-family: 'Poppins', sans-serif;
            font-size: 0.78rem; font-weight: 600; cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-discard:hover { opacity: 0.85; }

        .btn-save {
            padding: 7px 18px; border-radius: 999px;
            background: #22c55e; color: #fff;
            border: none; font-family: 'Poppins', sans-serif;
            font-size: 0.78rem; font-weight: 600; cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-save:hover { opacity: 0.85; }

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

        /* Type toggle (Objective / Subjective) */
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
            cursor: pointer;
            border: none;
            background: transparent;
            color: var(--text-light);
            transition: background 0.2s, color 0.2s;
        }

        .type-btn.active {
            background: var(--teal);
            color: #fff;
        }

        /* Delete question btn */
        .btn-del-q {
            width: 28px; height: 28px;
            border-radius: 50%;
            border: none;
            background: #fee2e2;
            color: #ef4444;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem;
            transition: background 0.2s;
        }

        .btn-del-q:hover { background: #fca5a5; }

        /* Question text input */
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

        .q-input::placeholder { color: var(--text-light); font-weight: 400; }

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
        }

        .option-label {
            width: 26px; height: 26px;
            border-radius: 50%;
            background: #f0f6f8;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.72rem; font-weight: 700;
            color: var(--text-mid);
            flex-shrink: 0;
        }

        .option-input {
            flex: 1;
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            color: var(--text-dark);
            border: 1px solid #d8eaec;
            border-radius: 8px;
            padding: 8px 12px;
            outline: none;
            transition: border-color 0.2s;
            background: #fafcfd;
        }

        .option-input:focus { border-color: var(--teal); background: #fff; }
        .option-input::placeholder { color: var(--text-light); }

        .btn-del-opt {
            width: 24px; height: 24px;
            border-radius: 50%;
            border: none;
            background: transparent;
            color: var(--text-light);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            transition: color 0.2s;
            flex-shrink: 0;
        }

        .btn-del-opt:hover { color: #ef4444; }

        /* Correct answer selector */
        .correct-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .correct-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-mid);
        }

        .correct-select {
            font-family: 'Poppins', sans-serif;
            font-size: 0.72rem;
            color: var(--text-dark);
            border: 1px solid #d8eaec;
            border-radius: 6px;
            padding: 4px 10px;
            outline: none;
            cursor: pointer;
            background: #fafcfd;
        }

        /* Add option button */
        .btn-add-opt {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--teal-dark);
            background: var(--teal-light);
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-add-opt:hover { background: #c8ede9; }

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

        /* ── Hint toggle row ── */
        .hint-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }

        .hint-toggle-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.7rem;
            font-weight: 600;
            color: #a07800;
            background: #fef9c3;
            border: 1px solid #f0d060;
            border-radius: 8px;
            padding: 5px 11px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .hint-toggle-btn:hover { background: #fef08a; }

        .hint-input-wrap {
            display: none;
            margin-top: 8px;
        }

        .hint-input-wrap.show { display: block; }

        .hint-input {
            width: 100%;
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            color: #5a4a00;
            background: #fef9c3;
            border: 1px solid #f0d060;
            border-radius: 8px;
            padding: 8px 12px;
            outline: none;
            resize: none;
            min-height: 56px;
            line-height: 1.6;
            transition: border-color 0.2s;
        }

        .hint-input:focus { border-color: #d4a000; }
        .hint-input::placeholder { color: #c0a030; }

        /* Edit icon on question (pencil) */
        .edit-icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #7c5cbf;
            padding: 2px;
            display: flex;
            align-items: center;
        }

        /* Add Question button */
        .btn-add-question {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px;
            background: var(--card-bg);
            border: 2px dashed #b0d4d2;
            border-radius: 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--teal-dark);
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .btn-add-question:hover {
            border-color: var(--teal);
            background: var(--teal-light);
        }

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
            min-height: 120px;
            flex-shrink: 0;
        }

        .sticky-note.yellow-dark { background: #fde047; }

        .sticky-pin {
            position: absolute;
            top: -8px; right: 14px;
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
        }

        .sticky-empty {
            font-size: 0.68rem;
            color: #c0a030;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="app">

    <!-- ══ HEADER ══ -->
    <div class="chapter-header">
        <a href="{{ route('teacher.edit-quiz') }}" class="back-btn">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Classes
        </a>
        <div class="header-top">
            <div>
                <h1 class="chapter-title">{{ $classRoom->name }}</h1>
                <p class="chapter-subtitle">{{ $classRoom->subject_label }} — Quiz Editor</p>
            </div>
            <div class="header-right">
                <button class="notif-btn">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                <div class="user-chip">
                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#2e8b84,#1c3d6b);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;overflow:hidden;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'N', 0, 1)) }}
                    </div>
                    <span>{{ auth()->user()->name ?? 'Nur Elin' }}</span>
                </div>
            </div>
        </div>

        <!--<div class="progress-row">
            <div class="progress-track">
                <div class="progress-fill" id="progressFill"></div>
            </div>
            <span class="progress-label" id="progressLabel">0/5</span>
            <div class="quiz-actions">
                <button class="btn-discard" onclick="discardAll()">Discard</button>
                <button class="btn-save"    onclick="saveQuiz()">Save</button>
            </div>
        </div>-->
    </div>

    <!-- ══ MAIN LAYOUT ══ -->
    <div class="main-layout">

        <!-- ── LEFT: Questions ── -->
        <div class="question-area" id="questionArea">
            <!-- Questions injected by JS -->
        </div>

        <!-- ── RIGHT: Hint sticky notes ── -->
        <div class="hint-panel" id="hintPanel">
            <div class="sticky-note" id="globalHintNote">
                <div class="sticky-pin">📌</div>
                <div class="sticky-title">FORMULA HINT</div>
                <div class="sticky-content sticky-empty" id="globalHintText">Add a hint to a question to see it here.</div>
            </div>
        </div>

    </div><!-- /main-layout -->

</div><!-- /app -->

<script>
    // ══════════════════════════════════════════
    // STATE
    // ══════════════════════════════════════════
    let questions   = [];   // array of question objects
    let questionId  = 0;    // auto-increment ID
    const MAX_Q     = 5;

    // ══════════════════════════════════════════
    // RENDER
    // ══════════════════════════════════════════
    function render() {
        const area = document.getElementById('questionArea');
        area.innerHTML = '';

        questions.forEach((q, idx) => {
            const card = document.createElement('div');
            card.className = 'q-card' + (q.focused ? ' active' : '');
            card.id = 'qcard-' + q.id;
            card.innerHTML = buildCardHTML(q, idx);
            area.appendChild(card);
        });

        // Add Question button
        if (questions.length < MAX_Q) {
            const addBtn = document.createElement('button');
            addBtn.className = 'btn-add-question';
            addBtn.innerHTML = `
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add Question ${questions.length + 1}
            `;
            addBtn.onclick = addQuestion;
            area.appendChild(addBtn);
        }

        updateProgress();
        updateHintNotes();
    }

    function buildCardHTML(q, idx) {
        const optLetters = ['A','B','C','D','E','F'];
        let html = `
            <div class="q-card-top">
                <span class="q-number">Question ${idx + 1}</span>
                <div style="display:flex;align-items:center;gap:8px;">
                    <div class="type-toggle">
                        <button class="type-btn ${q.type==='objective'?'active':''}"
                                onclick="setType(${q.id},'objective')">Objective</button>
                        <button class="type-btn ${q.type==='subjective'?'active':''}"
                                onclick="setType(${q.id},'subjective')">Subjective</button>
                    </div>
                    <button class="btn-del-q" onclick="deleteQuestion(${q.id})" title="Delete question">×</button>
                </div>
            </div>

            <textarea class="q-input" rows="2"
                placeholder="Type your question here..."
                oninput="updateField(${q.id},'question',this.value)"
            >${escHtml(q.question)}</textarea>

            <div class="q-divider"></div>
        `;

        if (q.type === 'objective') {
            // Options list
            html += `<div class="options-list" id="opts-${q.id}">`;
            q.options.forEach((opt, oi) => {
                html += `
                    <div class="option-row" id="optrow-${q.id}-${oi}">
                        <div class="option-label">${optLetters[oi]}</div>
                        <input class="option-input" type="text"
                            placeholder="Option ${optLetters[oi]}"
                            value="${escHtml(opt)}"
                            oninput="updateOption(${q.id},${oi},this.value)">
                        <button class="btn-del-opt" onclick="deleteOption(${q.id},${oi})" title="Remove option">×</button>
                    </div>
                `;
            });
            html += `</div>`;

            // Add option button (max 6)
            if (q.options.length < 6) {
                html += `
                    <button class="btn-add-opt" onclick="addOption(${q.id})">
                        + Add Option
                    </button>
                `;
            }

            // Correct answer selector
            html += `
                <div class="correct-row" style="margin-top:10px;">
                    <span class="correct-label">Correct answer:</span>
                    <select class="correct-select" onchange="updateField(${q.id},'correct',this.value)">
                        <option value="">-- Select --</option>
            `;
            q.options.forEach((_, oi) => {
                const selected = q.correct === optLetters[oi] ? 'selected' : '';
                html += `<option value="${optLetters[oi]}" ${selected}>${optLetters[oi]}</option>`;
            });
            html += `</select></div>`;

        } else {
            // Subjective answer
            html += `
                <p class="answer-label">Model Answer</p>
                <textarea class="answer-textarea"
                    placeholder="Enter the expected answer here..."
                    oninput="updateField(${q.id},'answer',this.value)"
                >${escHtml(q.answer)}</textarea>
            `;
        }

        // Hint section
        html += `
            <div class="hint-row">
                <button class="hint-toggle-btn" onclick="toggleHint(${q.id})">
                    📝 ${q.showHint ? 'Hide Hint' : 'Add Hint'}
                </button>
                ${q.hint ? `<span style="font-size:0.68rem;color:#a07800;font-style:italic;">Hint saved</span>` : ''}
            </div>
            <div class="hint-input-wrap ${q.showHint ? 'show' : ''}" id="hintWrap-${q.id}">
                <textarea class="hint-input"
                    placeholder="Enter a formula hint, e.g. V = IR, R = ρL/A..."
                    oninput="updateField(${q.id},'hint',this.value)"
                >${escHtml(q.hint)}</textarea>
            </div>
        `;

        return html;
    }

    // ══════════════════════════════════════════
    // ACTIONS
    // ══════════════════════════════════════════
    function addQuestion() {
        if (questions.length >= MAX_Q) return;
        questionId++;
        questions.push({
            id:       questionId,
            type:     'objective',
            question: '',
            options:  ['', '', '', ''],
            correct:  '',
            answer:   '',
            hint:     '',
            showHint: false,
            focused:  true,
        });
        // unfocus others
        questions.forEach(q => { if (q.id !== questionId) q.focused = false; });
        render();
        // Scroll to bottom
        setTimeout(() => {
            const area = document.getElementById('questionArea');
            area.scrollTop = area.scrollHeight;
        }, 50);
    }

    function deleteQuestion(id) {
        questions = questions.filter(q => q.id !== id);
        render();
    }

    function setType(id, type) {
        const q = questions.find(q => q.id === id);
        if (q) { q.type = type; render(); }
    }

    function updateField(id, field, value) {
        const q = questions.find(q => q.id === id);
        if (q) {
            q[field] = value;
            if (field === 'hint') updateHintNotes();
        }
    }

    function addOption(id) {
        const q = questions.find(q => q.id === id);
        if (q && q.options.length < 6) {
            q.options.push('');
            render();
        }
    }

    function deleteOption(id, idx) {
        const q = questions.find(q => q.id === id);
        if (q && q.options.length > 2) {
            q.options.splice(idx, 1);
            render();
        }
    }

    function updateOption(id, idx, value) {
        const q = questions.find(q => q.id === id);
        if (q) q.options[idx] = value;
    }

    function toggleHint(id) {
        const q = questions.find(q => q.id === id);
        if (q) { q.showHint = !q.showHint; render(); }
    }

    // ══════════════════════════════════════════
    // HINT NOTES (right panel)
    // ══════════════════════════════════════════
    function updateHintNotes() {
        const panel = document.getElementById('hintPanel');
        panel.innerHTML = '';

        const hintsWithContent = questions.filter(q => q.hint && q.hint.trim());

        if (hintsWithContent.length === 0) {
            // Show empty placeholder note
            panel.innerHTML = `
                <div class="sticky-note">
                    <div class="sticky-pin">📌</div>
                    <div class="sticky-title">FORMULA HINT</div>
                    <div class="sticky-content sticky-empty">Add a hint to a question to see it here.</div>
                </div>
            `;
            return;
        }

        // One sticky note per question that has a hint
        hintsWithContent.forEach((q, i) => {
            const qIdx = questions.indexOf(q) + 1;
            const isYellow = i % 2 === 0;
            const note = document.createElement('div');
            note.className = 'sticky-note' + (isYellow ? ' yellow-dark' : '');
            note.innerHTML = `
                <div class="sticky-pin">📌</div>
                <div class="sticky-title" style="color:${isYellow?'#7a5c00':'#a08000'}">Q${qIdx} HINT</div>
                <div class="sticky-content">${escHtml(q.hint)}</div>
            `;
            panel.appendChild(note);
        });
    }

    // ══════════════════════════════════════════
    // PROGRESS BAR
    // ══════════════════════════════════════════
    function updateProgress() {
        const filled = questions.filter(q =>
            q.question.trim() &&
            (q.type === 'objective'
                ? q.options.some(o => o.trim()) && q.correct
                : q.answer.trim())
        ).length;

        const pct = (filled / MAX_Q) * 100;
        document.getElementById('progressFill').style.width = pct + '%';
        document.getElementById('progressLabel').textContent = `${filled}/${MAX_Q}`;
    }

    // ══════════════════════════════════════════
    // SAVE / DISCARD
    // ══════════════════════════════════════════
    function saveQuiz() {
        // Validate
        const incomplete = questions.filter(q => !q.question.trim());
        if (incomplete.length > 0) {
            alert('Please fill in all question texts before saving.');
            return;
        }
        if (questions.length === 0) {
            alert('Please add at least one question.');
            return;
        }
        // In a real app, submit to Laravel via fetch/form
        const payload = questions.map((q, i) => ({
            number:   i + 1,
            type:     q.type,
            question: q.question,
            options:  q.type === 'objective' ? q.options : null,
            correct:  q.type === 'objective' ? q.correct  : null,
            answer:   q.type === 'subjective' ? q.answer  : null,
            hint:     q.hint || null,
        }));
        console.log('Quiz payload:', JSON.stringify(payload, null, 2));
        alert(`Quiz saved! ${questions.length} question(s) ready.`);
    }

    function discardAll() {
        if (questions.length === 0 || confirm('Discard all questions?')) {
            questions = [];
            questionId = 0;
            render();
        }
    }

    // ══════════════════════════════════════════
    // UTILS
    // ══════════════════════════════════════════
    function escHtml(str) {
        if (!str) return '';
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // ══════════════════════════════════════════
    // INIT — start with 1 question pre-loaded
    // ══════════════════════════════════════════
    addQuestion();
</script>

</body>
</html>