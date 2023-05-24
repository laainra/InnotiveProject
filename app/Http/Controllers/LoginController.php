<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Session;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }else{
            return view('innotive');
        }
    }

    public function actionlogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully logged in');
        }

        return redirect("/")->with(['loginError' => 'Oppes! Username or password is incorrect']);
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
