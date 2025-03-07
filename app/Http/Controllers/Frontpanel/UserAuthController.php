<?php

namespace App\Http\Controllers\Frontpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function registerView()
    {
        return view('frontpanel.auth.register');
    }

    public function loginView()
    {
        return view('frontpanel.auth.login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', 
            'is_active' => 1
        ]);

        auth()->login($user);

        return redirect()->route('frontpanel.home')->with('success', 'Registrasi berhasil. Selamat datang!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password, 'is_active' => 1])) {
            return redirect()->route('frontpanel.home')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->withErrors(['login' => 'Login gagal, periksa username/email, password, atau status akun Anda.']);
        }
    }
}
