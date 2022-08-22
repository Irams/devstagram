<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutControler extends Controller
{
    public function store()
    {
        // dd('cerrando sesión');
        auth()->logout();
        return redirect()->route('login');
    }
}
