<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginControler extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // dd('Autenticando...');
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // dd($request->remember);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
