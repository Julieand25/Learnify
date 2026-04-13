<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\QuizAttempt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        return view('student.dashboard', [
            'user' => $request->user(),
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
        return view('student.chapter-resistance', [
            'user' => $request->user(),
        ]);
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

        return view('student.take-quiz', [
            'user'            => $request->user(),
            'classRoom'       => $classRoom,
            'quiz'            => $quiz,
            'question'        => $question,
            'currentQuestion' => $questionNumber,
            'totalQuestions'  => $total,
            'savedAnswer'     => $savedAnswer,
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

    public function unenrollClass(Request $request, ClassRoom $classRoom): RedirectResponse
    {
        $request->user()->enrolledClasses()->detach($classRoom->id);

        return redirect()->route('student.learning-module')
            ->with('success', 'You have unenrolled from ' . $classRoom->name . '.');
    }
}
