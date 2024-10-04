<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]
        );

        $credentials = $request->only('email', 'password');
        $credentials['email'] = str_replace('@', '\@', $credentials['email']);

        if (!Auth::attempt($credentials, true)) { // true is for remember me
            throw ValidationException::withMessages([
                'email' => __('Authentication failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/fishing');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
