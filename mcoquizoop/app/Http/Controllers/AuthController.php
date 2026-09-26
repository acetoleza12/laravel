<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
   
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $r)
{
    User::create([
        'first_name' => trim($r->first_name),
        'last_name'  => trim($r->last_name),
        'username'   => trim($r->username),
        'password'   => trim($r->password),
        'role'       => 'student',
    ]);

    return redirect('/login');
}


    
    public function loginForm()
    {
        return view('auth.login');
    }

   public function login(Request $r)
{
    $user = User::where('username', $r->username)
        ->where('password', $r->password)
        ->first();

    if (!$user) {
        return back()->with('error', 'Invalid login');
    }

    
    session([
    'username' => $user->username,
    'role' => $user->role
]);

    
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    if ($user->role === 'teacher') {
        return redirect('/teacher/dashboard');
    }

    return redirect('/quiz'); 
}


    
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
