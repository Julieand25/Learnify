<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
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

    public function unenrollClass(Request $request, ClassRoom $classRoom): RedirectResponse
    {
        $request->user()->enrolledClasses()->detach($classRoom->id);

        return redirect()->route('student.learning-module')
            ->with('success', 'You have unenrolled from ' . $classRoom->name . '.');
    }
}
