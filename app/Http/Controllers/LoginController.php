<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    public function show()
    {
       return view('auth.login'); 
    }

    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'login'     => 'required',
            'password'  => 'required'
        ]);

        if (!Auth::attempt($validator)) {
            return redirect()->route('login')
                ->withErrors([
                    'login' => '¡Usuario o contraseña incorrectos!'
                ]);
        }
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
