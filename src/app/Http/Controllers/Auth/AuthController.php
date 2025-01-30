<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function show()
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('auth.login');
    }
}
