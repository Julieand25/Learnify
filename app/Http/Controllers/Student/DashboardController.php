<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ChapterProgress;
use App\Models\ClassRoom;
use App\Models\QuizAttempt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        // Get the student's most recent submitted quiz attempt across all enrolled classes
        $attempt = QuizAttempt::where('student_id', $user->id)
            ->whereNotNull('submitted_at')
            ->latest('submitted_at')
            ->first();

        $quizPct = 0;
        if ($attempt) {
            $quizPct = $attempt->total > 0
                ? (int) round($attempt->score / $attempt->total * 100)
                : 100;
        }

        return view('student.dashboard', [
            'user'    => $user,
            'quizPct' => $quizPct,
        ]);
    }

    public function physicsNotes(Request $request): View
    {
        return view('student.physics-notes', [
            'user' => $request->user(),
        ]);
    }

    public function chapterResistance(Request $request): View
    {
        $progress = ChapterProgress::where('student_id', $request->user()->id)
            ->where('chapter_slug', 'resistance')
            ->value('sections_reached') ?? 0;

        return view('student.chapter-resistance', [
            'user'     => $request->user(),
            'progress' => (int) $progress,
        ]);
    }

    public function saveChapterProgress(Request $request): JsonResponse
    {
        $request->validate(['sections_reached' => ['required', 'integer', 'min:1', 'max:3']]);

        $record = ChapterProgress::firstOrNew([
            'student_id'   => $request->user()->id,
            'chapter_slug' => 'resistance',
        ]);

        if ($request->sections_reached > ($record->sections_reached ?? 0)) {
            $record->sections_reached = $request->sections_reached;
            $record->save();
        }

        return response()->json(['ok' => true, 'sections_reached' => $record->sections_reached]);
    }

    public function classQuiz(Request $request): View
    {
        $enrolledClasses = $request->user()
            ->enrolledClasses()
            ->with('teacher')
            ->orderBy('enrollments.created_at', 'asc')
            ->get();

        return view('student.class-quiz', [
            'user'            => $request->user(),
            'enrolledClasses' => $enrolledClasses,
        ]);
    }

    public function learningModule(Request $request): View
    {
        $enrolledClasses = $request->user()
            ->enrolledClasses()
            ->with('teacher')
            ->orderBy('enrollments.created_at', 'asc')
            ->get();

        return view('student.learning-module', [
            'user'            => $request->user(),
            'enrolledClasses' => $enrolledClasses,
        ]);
    }

    public function searchClass(Request $request): JsonResponse
    {
        $code  = strtoupper(trim($request->query('code', '')));
        $class = ClassRoom::where('code', $code)->with('teacher')->first();

        if (! $class) {
            return response()->json(['found' => false]);
        }

        $enrolled = $request->user()
            ->enrolledClasses()
            ->where('class_room_id', $class->id)
            ->exists();

        return response()->json([
            'found'    => true,
            'name'     => $class->name,
            'code'     => $class->code,
            'teacher'  => $class->teacher->name ?? 'Unknown',
            'color'    => $class->color,
            'enrolled' => $enrolled,
        ]);
    }

    public function enrollClass(Request $request): RedirectResponse
    {
        $request->validate(['code' => ['required', 'string']]);

        $code  = strtoupper(trim($request->code));
        $class = ClassRoom::where('code', $code)->first();

        if (! $class) {
            return redirect()->route('student.learning-module')
                ->with('error', 'Class not found. Please check the code and try again.');
        }

        $alreadyEnrolled = $request->user()
            ->enrolledClasses()
            ->where('class_room_id', $class->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->route('student.learning-module')
                ->with('error', 'You are already enrolled in ' . $class->name . '.');
        }

        $request->user()->enrolledClasses()->attach($class->id);

        return redirect()->route('student.learning-module')
            ->with('success', 'You have successfully enrolled in ' . $class->name . '!');
    }

    public function takeQuiz(Request $request, ClassRoom $classRoom): View
    {
        $enrolled = $request->user()->enrolledClasses()
            ->where('class_room_id', $classRoom->id)->exists();
        abort_if(! $enrolled, 403);

        $quiz = $classRoom->quiz()->with('questions.options')->first();

        // Already completed — show results
        $completedAttempt = null;
        if ($quiz) {
            $completedAttempt = QuizAttempt::where('student_id', $request->user()->id)
                ->where('quiz_id', $quiz->id)
                ->whereNotNull('submitted_at')
                ->with('answers')
                ->latest()
                ->first();
        }

        if ($completedAttempt || ! $quiz || $quiz->questions->isEmpty()) {
            return view('student.take-quiz', [
                'user'            => $request->user(),
                'classRoom'       => $classRoom,
                'quiz'            => $quiz,
                'question'        => null,
                'currentQuestion' => 0,
                'totalQuestions'  => $quiz ? $quiz->questions->count() : 0,
                'savedAnswer'     => null,
                'attempt'         => $completedAttempt,
            ]);
        }

        $questionNumber = max(1, (int) $request->query('q', 1));
        $questions      = $quiz->questions;
        $total          = $questions->count();
        $questionNumber = min($questionNumber, $total);
        $question       = $questions[$questionNumber - 1];

        // Look up any in-progress saved answer for this question
        $pendingAttempt = QuizAttempt::where('student_id', $request->user()->id)
            ->where('quiz_id', $quiz->id)
            ->whereNull('submitted_at')
            ->first();

        $savedAnswer = $pendingAttempt
            ? $pendingAttempt->answers()->where('quiz_question_id', $question->id)->first()
            : null;

        // Count only answers that actually have a value (non-empty)
        // so skipped questions (null records) don't inflate the count
        $answeredCount = $pendingAttempt
            ? $pendingAttempt->answers()
                ->where(function ($q) {
                    $q->whereNotNull('selected_option')
                      ->orWhere(function ($q2) {
                          $q2->whereNotNull('answer_text')
                             ->where('answer_text', '!=', '');
                      });
                })
                ->count()
            : 0;

        return view('student.take-quiz', [
            'user'            => $request->user(),
            'classRoom'       => $classRoom,
            'quiz'            => $quiz,
            'question'        => $question,
            'currentQuestion' => $questionNumber,
            'totalQuestions'  => $total,
            'savedAnswer'     => $savedAnswer,
            'answeredCount'   => $answeredCount,
            'attempt'         => null,
        ]);
    }

    public function answerQuestion(Request $request, ClassRoom $classRoom): RedirectResponse
    {
        $enrolled = $request->user()->enrolledClasses()
            ->where('class_room_id', $classRoom->id)->exists();
        abort_if(! $enrolled, 403);

        $quiz = $classRoom->quiz()->with('questions.options')->firstOrFail();

        $questionNumber = (int) $request->input('question_number');
        $questionId     = (int) $request->input('question_id');
        $total          = $quiz->questions->count();

        // Get or create pending attempt
        $attempt = QuizAttempt::where('student_id', $request->user()->id)
            ->where('quiz_id', $quiz->id)
            ->whereNull('submitted_at')
            ->first();

        if (! $attempt) {
            $attempt = QuizAttempt::create([
                'student_id' => $request->user()->id,
                'quiz_id'    => $quiz->id,
            ]);
        }

        // Save/update answer for this question
        $question = $quiz->questions->firstWhere('id', $questionId);
        if ($question) {
            $selectedOption = null;
            $answerText     = null;
            $isCorrect      = null;

            if ($question->type === 'objective') {
                $selectedOption = $request->input('answer');
                $correctOpt     = $question->options->firstWhere('is_correct', true);
                $isCorrect      = $correctOpt && $selectedOption === $correctOpt->letter;
            } else {
                $answerText = $request->input('answer_text');
            }

            $attempt->answers()->updateOrCreate(
                ['quiz_question_id' => $questionId],
                [
                    'selected_option' => $selectedOption,
                    'answer_text'     => $answerText,
                    'is_correct'      => $isCorrect,
                ]
            );
        }

        // Last question → finalize
        if ($questionNumber >= $total) {
            $score     = $attempt->answers()->where('is_correct', true)->count();
            $totalObj  = $quiz->questions->where('type', 'objective')->count();

            $attempt->update([
                'submitted_at' => now(),
                'score'        => $score,
                'total'        => $totalObj,
            ]);

            return redirect()->route('student.quiz.take', $classRoom->id)
                ->with('quiz_result', ['score' => $score, 'total' => $totalObj]);
        }

        return redirect()->route('student.quiz.take', [
            'classRoom' => $classRoom->id,
            'q'         => $questionNumber + 1,
        ]);
    }

    public function retakeQuiz(Request $request, ClassRoom $classRoom): RedirectResponse
    {
        $enrolled = $request->user()->enrolledClasses()
            ->where('class_room_id', $classRoom->id)->exists();
        abort_if(! $enrolled, 403);

        $quiz = $classRoom->quiz()->first();
        if ($quiz) {
            QuizAttempt::where('student_id', $request->user()->id)
                ->where('quiz_id', $quiz->id)
                ->delete();
        }

        return redirect()->route('student.quiz.take', $classRoom->id);
    }

    public function unenrollClass(Request $request, ClassRoom $classRoom): RedirectResponse
    {
        $request->user()->enrolledClasses()->detach($classRoom->id);

        return redirect()->route('student.learning-module')
            ->with('success', 'You have unenrolled from ' . $classRoom->name . '.');
    }

    public function settings(Request $request): View
    {
        return view('student.settings', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg', 'max:10240'],
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('profile_photo')) {
            $old = $request->user()->profile_photo_path;
            if ($old) {
                Storage::disk('public')->delete($old);
            }

            $data['profile_photo_path'] = $request->file('profile_photo')
                ->store('profile-photos', 'public');
        }

        $request->user()->update($data);

        return redirect()->route('student.settings')->with('profile_success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update(['password' => Hash::make($request->password)]);

        return redirect()->route('student.settings')->with('password_success', 'Password updated successfully.');
    }
}
