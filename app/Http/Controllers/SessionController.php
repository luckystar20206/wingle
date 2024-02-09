<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class SessionController extends Controller
{
    public function store(){
        $attributes = request()->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if(auth()->attempt($attributes)){
            return redirect('/')->with('success', 'Welcome back');
        }

        return back()->withInput()->withErrors(['The entered credentials are not correct']);
    }

    public function create(){
        return view('login');
    }

    public function destroy(){
        auth()->logout();

        return redirect('/')->with('loggedout', 'Goodbye!');
    }
}
