<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;

class LoginController extends Controller
{
    // show login form
    public function showLoginForm() : View
    {
        return view('auth.login');
    }

    // Login process
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Login Successful');
        }

        return back()->withErrors([
            'email' => 'Emil atau password salah'
        ])->onlyInput('email');
    }

    // Logout process
    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout Successful');

    }
}
