<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class DataKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // if (!auth()->guest()) {
        //     abort(403);
        // }
        return view('Admin.DataKamar.index', [
            'title' => 'Data Kamar',
            'users'  => User::all(),
            'kamars' => Kamar::all(),
            'datas' => Kamar::where('kamar', 'like', '%' . request('cari_kamar') . '%')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.DataKamar.create', [
            'title' => 'create',
            'kamars' => Kamar::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'image' => 'image|file|max:4024',
            'kamar' => 'required|max:255',
            'harga' => 'required',
        ]);



        if ($request->file('image')) {
            $validasi['image'] = $request->file('image')->store('data-gambar');
        }

        // $validasi['user_id'] = auth()->user()->id;
        // $validasi['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Kamar::create($validasi);

        return redirect('/kamars')->with('success', 'Tambah Data Kamar Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {


        return view('Admin.DataKamar.edit', [
            'tittle' => 'edit',
            'kamars' => $kamar,
            'users' => User::All()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $rules = [
            'image' => 'image|file|max:024',
            'kamar' => 'required|max:255',
            'harga' => 'required',
        ];

        $validasi = $request->validate($rules);
        if ($request->file('image')) {
            if ($request->oldimage) {
                Storage::delete($request->oldimage);
            }
            $validasi['image'] = $request->file('image')->store('data-gambar');
        }
        Kamar::where('id', $kamar->id)
            ->update($validasi);


        return redirect('/kamars')->with('success', 'Post Data Edit Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        if ($kamar->image) {
            Storage::delete($kamar->image);
        }
        // Kamar::where('kamar', $kamar->kamar)
        //     ->destroy($kamar);
        Kamar::destroy($kamar->id);

        return redirect('/kamars')->with('success', 'Data Kamar Berhasil Dihapus');
    }
}
