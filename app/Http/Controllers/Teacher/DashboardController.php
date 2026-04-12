<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function settings(Request $request): View
    {
        return view('teacher.settings', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->update(['name' => $request->name]);

        return redirect()->route('teacher.settings')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update(['password' => Hash::make($request->password)]);

        return redirect()->route('teacher.settings')->with('success', 'Password updated successfully.');
    }
}
