<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function store(Request $request)
    {
        // dd('Log out me now');

        //1. logout the user
        // auth()->logout();
        Auth::logout();

        // 2. Invalidate the session 
        $request->session()->invalidate();

        // 3. Regenerate the CSRF token
        $request->session()->regenerateToken();
        // 4. Redirect to home or login page
        return redirect('/login');
    }
}
