<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    // show the registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // handle the registration form submit
    public function register(Request $request)
    {
        // validate all fields
        $request->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|string|max:20',
            'password'      => 'required|min:6|confirmed',
            'date_of_birth' => 'required|date',
        ]);

        // save the new user to database
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'date_of_birth' => $request->date_of_birth,
        ]);

        // redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful! You can now login.');
    }

    // show the login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // handle the login form submit
    public function login(Request $request)
    {
        // validate the inputs
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // find user by email
        $user = User::where('email', $request->email)->first();

        // check if user exists and password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Wrong email or password.'])->withInput();
        }

        // store user id in a cookie (valid for 60 minutes)
        $cookie = Cookie::make('user_id', $user->id, 60);

        // go to dashboard with the cookie
        return redirect()->route('dashboard')->withCookie($cookie);
    }

    // show the dashboard
    public function dashboard()
    {
        // get user id from cookie
        $userId = Cookie::get('user_id');

        // if no cookie, redirect to login
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // find the user from database
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('dashboard', compact('user'));
    }

    // handle logout
    public function logout()
    {
        // destroy the cookie by forgetting it
        $cookie = Cookie::forget('user_id');

        return redirect()->route('login')->withCookie($cookie)->with('success', 'You have been logged out.');
    }
}
