<?php

namespace App\Http\Controllers;

use App\Models\Score;

class ScoreController extends Controller
{
   
    public function index()
    {
        $scores = Score::orderBy('created_at', 'desc')->get();
        return view('scores.all', compact('scores'));
    }

    public function mine()
    {
        $scores = Score::where('student', session('username'))
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('scores.mine', compact('scores'));
    }
}
