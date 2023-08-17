<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('User.Registrasi', [
            'title' => 'Registrasi'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email:dns', 'unique:users'],
            'nohp' => 'required|max:255|unique:users',
            'password' => 'required|min:5|max:255',
            // 'status' => 'nullable'
        ]);

        // $validasi['password'] = bcrypt($validasi['password']);
        $validasi['password'] = Hash::make($validasi['password']);

        User::create($validasi);

        // $request->session()->flash('success', 'Registration Succesfull! Please Login');

        return redirect('/login')->with('success', 'Registration Succesfull! Please Login');
    }
}
