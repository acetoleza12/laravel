<?php

namespace App\Http\Controllers;

use App\Models\Score;

class TeacherController extends Controller
{
    public function dashboard()
    {
        if (session('role') !== 'teacher') {
            return redirect('/login');
        }

        $scores = Score::all();

        return view('teacher.dashboard', compact('scores'));
    }
}
