<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('teacher.my-classes', [
            'user' => $request->user(),
        ]);
    }

    public function classStudents(Request $request): View
    {
        return view('teacher.class-students', [
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
