<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (session('role') !== 'admin') {
            return redirect('/login');
        }

        return view('admin.dashboard');
    }

    public function index()
    {
        if (session('role') !== 'admin') {
            return redirect('/login');
        }

        return view('admin.questions', [
            'questions' => Question::all()
        ]);
    }

    public function addForm()
    {
        if (session('role') !== 'admin') {
            return redirect('/login');
        }

        return view('admin.add');
    }
}
