<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        //1. Validate the data
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        //2. Authentication
        $user = User::where('email', $request->email)->first();

        // dd(password_verify($request->input('password'), $user->password));
        if (!$user || !password_verify($request->input('password'), $user->password)) {
            return back()->withErrors(['email' => 'This provided credentials do not match our records.']);
        }
        // dd($user);
        Auth::login($user, $request->boolean('remember'));

        // || another log in system
        // Note: This is the preferred way to authenticate users in Laravel.
        // Auth::attempt([ 
        //     'email'->$request->email,
        //     'password'->$request->input('password'),  
        //     $request->boolean('remember')
        // ]);

        //3. Redirect to dashboard
        return redirect()->route('dashboard');
    }
}
