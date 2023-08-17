<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AuthLoginController extends Controller
{

    public function index()
    {
        return view('User.index', [
            'title' => 'Home',


        ]);
    }
    public function Logic(Request $request)
    {
        $Validasi = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($Validasi)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }


        return back()->with('LoginFailed', 'LoginGagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
