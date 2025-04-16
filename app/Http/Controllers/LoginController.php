<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    // show login form
    public function showLoginForm() : View
    {
        return view('auth.login');
    }

    // show register form
    public function showRegisterForm() : View
    {
        return view('auth.register');
    }

    // Registration process
    public function register(Request $request)
    {
        // validate the process
        $request->validate([
            'username' => 'required|string|max:100|unique:users',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer'
        ]);

        // create the users
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('auth.login')->with('success', 'Registration on successful');
    }

    // Login process
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->orWhere('email', $request->email)->first();

        // check if user exists
        if ($user == null) {
            return redirect()->back()->with('error', 'User not found');
        }

        // check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password is incorrect');
        }

        $request->session()->regenerate();
        $request->session()->put('isLogged', true);
        $request->session()->put('user', $user);
        $request->session()->put('userId', $user->id);
        $request->session()->put('userName', $user->name);
        $request->session()->put('userRole', $user->role_id);

        return redirect()->route('dashboard')->with('success', 'Login Successful');
    }

    // Logout process
    public function logout (Request $request)
    {
        session()->forget('isLogged');
        session()->forget('user');
        session()->forget('userId');
        session()->forget('userName');
        session()->forget('userRole');
        session()->flush();

        // Auth::logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->route('auth.login');

    }
}
