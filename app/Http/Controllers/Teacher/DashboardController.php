<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        return view('teacher.dashboard', [
            'user' => $request->user(),
        ]);
    }

    public function myClasses(Request $request): View
    {
        $classes = ClassRoom::where('teacher_id', $request->user()->id)
            ->withCount('students')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('teacher.my-classes', [
            'user'    => $request->user(),
            'classes' => $classes,
        ]);
    }

    public function storeClass(Request $request): RedirectResponse
    {
        $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'color'   => ['required', 'string', 'in:grey,green,teal,navy,purple'],
            'subject' => ['required', 'string', 'in:physics,biology,chemistry,mathematics,history,english'],
        ]);

        // Generate a unique code server-side (client code is just a preview)
        do {
            $code = 'CLS-' . strtoupper(Str::random(3)) . rand(100, 999);
        } while (ClassRoom::where('code', $code)->exists());

        ClassRoom::create([
            'teacher_id' => $request->user()->id,
            'name'       => $request->name,
            'code'       => $code,
            'color'      => $request->color,
            'subject'    => $request->subject,
        ]);

        return redirect()->route('teacher.my-classes')->with('success', 'Class created successfully.');
    }

    public function updateClass(Request $request, ClassRoom $classRoom): RedirectResponse
    {
        abort_if($classRoom->teacher_id !== $request->user()->id, 403);

        $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'color'   => ['required', 'string', 'in:grey,green,teal,navy,purple'],
            'subject' => ['required', 'string', 'in:physics,biology,chemistry,mathematics,history,english'],
        ]);

        $classRoom->update([
            'name'    => $request->name,
            'color'   => $request->color,
            'subject' => $request->subject,
        ]);

        return redirect()->route('teacher.my-classes')->with('success', 'Class updated successfully.');
    }

    public function destroyClass(Request $request, ClassRoom $classRoom): RedirectResponse
    {
        abort_if($classRoom->teacher_id !== $request->user()->id, 403);

        $classRoom->delete();

        return redirect()->route('teacher.my-classes')->with('success', 'Class deleted.');
    }

    public function classStudents(Request $request): View
    {
        return view('teacher.class-students', [
            'user' => $request->user(),
        ]);
    }

    public function notesProgress(Request $request): View
    {
        return view('teacher.notes-progress', [
            'user' => $request->user(),
        ]);
    }

    public function quizProgress(Request $request): View
    {
        return view('teacher.quiz-progress', [
            'user' => $request->user(),
        ]);
    }

    public function editQuizClass(Request $request, ClassRoom $classRoom): View
    {
        abort_if($classRoom->teacher_id !== $request->user()->id, 403);

        $quiz = $classRoom->quiz()->with('questions.options')->first();

        $existingQuestions = [];
        if ($quiz) {
            foreach ($quiz->questions as $idx => $q) {
                $options = $q->type === 'objective'
                    ? $q->options->map(fn ($o) => $o->text)->values()->toArray()
                    : ['', '', '', ''];

                $correct = '';
                if ($q->type === 'objective') {
                    $correctOpt = $q->options->firstWhere('is_correct', true);
                    $correct    = $correctOpt ? $correctOpt->letter : '';
                }

                $existingQuestions[] = [
                    'id'       => $idx + 1,
                    'type'     => $q->type,
                    'question' => $q->question,
                    'options'  => $options,
                    'correct'  => $correct,
                    'answer'   => $q->answer ?? '',
                    'hint'     => $q->hint ?? '',
                    'showHint' => ! empty($q->hint),
                    'focused'  => false,
                ];
            }
        }

        return view('teacher.quiz-editor', [
            'user'              => $request->user(),
            'classRoom'         => $classRoom,
            'existingQuestions' => $existingQuestions,
        ]);
    }

    public function saveQuiz(Request $request, ClassRoom $classRoom): JsonResponse
    {
        abort_if($classRoom->teacher_id !== $request->user()->id, 403);

        $data = $request->validate([
            'questions'              => ['required', 'array', 'min:1', 'max:10'],
            'questions.*.type'       => ['required', 'in:objective,subjective,circuit'],
            'questions.*.question'   => ['required', 'string', 'max:1000'],
            'questions.*.options'    => ['nullable', 'array'],
            'questions.*.options.*'  => ['nullable', 'string', 'max:500'],
            'questions.*.correct'    => ['nullable', 'string', 'max:1'],
            'questions.*.answer'     => ['nullable', 'string', 'max:2000'],
            'questions.*.hint'       => ['nullable', 'string', 'max:1000'],
        ]);

        $quiz = $classRoom->quiz()->firstOrCreate(['class_room_id' => $classRoom->id]);

        // Replace all questions (cascade deletes options)
        $quiz->questions()->delete();

        $optLetters = ['A', 'B', 'C', 'D', 'E', 'F'];

        foreach ($data['questions'] as $i => $qData) {
            $question = $quiz->questions()->create([
                'type'       => $qData['type'],
                'question'   => $qData['question'],
                'answer'     => in_array($qData['type'], ['subjective', 'circuit']) ? ($qData['answer'] ?? null) : null,
                'hint'       => ! empty($qData['hint']) ? $qData['hint'] : null,
                'sort_order' => $i,
            ]);

            if ($qData['type'] === 'objective' && ! empty($qData['options'])) {
                foreach ($qData['options'] as $oi => $optText) {
                    if (! empty(trim((string) $optText))) {
                        $question->options()->create([
                            'letter'     => $optLetters[$oi],
                            'text'       => $optText,
                            'is_correct' => ($qData['correct'] ?? '') === $optLetters[$oi],
                        ]);
                    }
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Quiz saved successfully.']);
    }

    public function editQuiz(Request $request): View
    {
        $classes = ClassRoom::where('teacher_id', $request->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('teacher.edit-quiz', [
            'user'    => $request->user(),
            'classes' => $classes,
        ]);
    }

    public function settings(Request $request): View
    {
        return view('teacher.settings', [
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
            // Delete old photo if exists
            $old = $request->user()->profile_photo_path;
            if ($old) {
                Storage::disk('public')->delete($old);
            }

            $data['profile_photo_path'] = $request->file('profile_photo')
                ->store('profile-photos', 'public');
        }

        $request->user()->update($data);

        return redirect()->route('teacher.settings')->with('profile_success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update(['password' => Hash::make($request->password)]);

        return redirect()->route('teacher.settings')->with('password_success', 'Password updated successfully.');
    }
}
