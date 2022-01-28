<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function attemptLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'username' => __('نام کاربری یا رمز عبور نادرست است.'),
        ]);
    }

    public function signup()
    {
        return view('signup');
    }

    public function attemptSignup(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
        ]);

        $credentials['password'] = bcrypt($credentials['password']);

        User::create($credentials);

        Auth::attempt($credentials);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
