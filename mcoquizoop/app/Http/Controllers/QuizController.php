<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Score;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
{
    if (!session()->has('username')) {
        return redirect('/login');
    }

    $questions = Question::all();
    return view('quiz', compact('questions'));
}
    public function submit(Request $request)
{
    $answers = $request->input('answers', []);

    $questions = Question::all();   
    $score = 0;

    foreach ($questions as $question) {
        if (
            isset($answers[$question->id]) &&
            $answers[$question->id] === $question->answer
        ) {
            $score++;
        }
    }

    $total = $questions->count();   

    Score::create([
        'student' => session('username', 'guest'),
        'score'   => $score
    ]);

    session([
        'last_score' => $score,
        'total'      => $total,
        'percent'    => round(($score / $total) * 100, 2),
        'status'     => ($score / $total) >= 0.75 ? 'PASSED' : 'FAILED'
    ]);

    return redirect('/result');
}
}
