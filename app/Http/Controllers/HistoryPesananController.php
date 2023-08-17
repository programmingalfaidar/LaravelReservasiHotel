<?php

namespace App\Http\Controllers;

use App\Models\PesananDetail;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\User;

class HistoryPesananController extends Controller
{
    public function index($id)
    {

        $Pesanan = Pesanan::where('user_id', $id)->first();
        if (!empty($Pesanan)) {
        } else {
            $pDetails = PesananDetail::where('status', '1')->where('pesanan_id', $Pesanan->id)->get();
        }
        if (!empty($pDetails)) {
            return view('User.Pesanan.History', [
                'title' => 'History Pemesanan Tiket ' . auth()->user()->name,
                'users' => User::all(),
                // 'pesanans' => Pesanan::all()
            ]);
        } else {
            $pDetails = PesananDetail::where('status', '1')->where('pesanan_id', $Pesanan->id)->get();

            return view('User.Pesanan.History', [
                'title' => 'History Pemesanan Tiket ' . auth()->user()->name,
                'users' => User::all(),
                // 'pesanans' => Pesanan::all(),
                'pDetails' => $pDetails
            ]);
        }
    }
}
