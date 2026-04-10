<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
