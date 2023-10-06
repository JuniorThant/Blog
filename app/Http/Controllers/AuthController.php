<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        $data=request()->validate([
            'name'=>'required|max:255|min:3',
            'email'=>'required|email',
            'username'=>['required','max:255','min:6',Rule::unique('users','username')],
            'password'=>'required|max:15|min:8'
        ]);

        $user=User::create($data);
        auth()->login($user);
        return redirect('/blogposts')->with('success','Welcome Dear '.$user->name);
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/blogposts')->with('success','Good Bye');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function postlogin()
    {
        $data=request()->validate([
            'email'=>['required','email',Rule::exists('users','email')],
            'password'=>['required','min:8','max:15']
        ],[
            'email.required'=>'We need your email address.'
        ]);
        if(auth()->attempt($data))
        {
            return redirect('/blogposts')->with('success','Welcome Back');
        }else
        {
            return redirect()->back()->withErrors([
                'password'=>'Incorrect Email or Password'
            ]);
        }
    }
}
