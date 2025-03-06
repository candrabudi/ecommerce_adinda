<?php

namespace App\Http\Controllers\Backpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        return view('backpanel.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email-username' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->input('email-username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginType => $request->input('email-username'), 'password' => $request->input('password')])) {
            // Login successful
            return redirect()->intended('backpanel/dashboard')->with('success', 'Login successful');
        }

        return redirect()->back()->withErrors([
            'loginError' => 'Invalid credentials. Please try again.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
