<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminDataPesananUser extends Controller
{
    public function index()
    {

        return view('Admin.DataTransaksi.index', [
            'title' => 'Data Pemesanan User',
            'users' => User::all(),

        ]);
    }
}
