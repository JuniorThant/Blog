<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = $this->validateRegistrationRequest($request);

        $user = User::create($data);
        Auth::login($user);

        return redirect('/blogposts');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/blogposts');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $data = $this->validateLoginRequest($request);

        if (Auth::attempt($data)) {
            return redirect('/blogposts')->with('success', 'Welcome Back');
        } else {
            return redirect()->back()->withErrors([
                'password' => 'Incorrect Email or Password'
            ]);
        }
    }

    private function validateRegistrationRequest(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'email' => ['required', 'email'],
            'username' => ['required', 'max:255', 'min:6', Rule::unique('users', 'username')],
            'password' => ['required', 'max:15', 'min:8']
        ]);
    }

    private function validateLoginRequest(Request $request)
    {
        return $request->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => ['required', 'min:8', 'max:15']
        ], [
            'email.required' => 'We need your email address.'
        ]);
    }
}

