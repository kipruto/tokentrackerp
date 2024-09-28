<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {

        return view('auth.login');
    }

    // Handle the login request

    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required | email',
           'password' => 'required|string|min:8',
        ]);

        // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();
        // Redirect to the dashboard or intended route
            return redirect()->intended('dashboard');
        }
        return redirect()->back()
        ->withErrors(['errorMessage' => 'These credentials do not match our records.'])
        ->withInput($request->except('password'));
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');

    }
}
