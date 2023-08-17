<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if($request->has('search')){

        // }

        // if (!auth()->guest()) {
        //     abort(403);
        // }
        return view('DataPengguna.index', [
            'title' => 'DataPengguna',
            'users' => User::latest()->filter(request(['search']))->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('DataPengguna.edit', [
            'tittle' => 'edit',
            'users' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validasi = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email:dns', 'unique:users'],
            'nohp' => 'required|max:255|unique:users',
            'password' => 'required|min:5|max:255',
            'status' => 'required'
            // 'status' => 'nullable'
        ]);

        // $validasi['password'] = bcrypt($validasi['password']);
        $validasi['password'] = Hash::make($validasi['password']);
        User::where('id', $user->id)
            ->update($validasi);



        // $request->session()->flash('success', 'Registration Succesfull! Please Login');

        return redirect('/users')->with('success', 'Registration Succesfull! Please Login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/users ')->with('success', 'Data Kamar Berhasil Dihapus');
    }
}
