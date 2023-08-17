<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // relasi ke dalam tabel kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
    //relasi ke tabel pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    // public function bukti()
    // {
    //     return $this->belongsTo(BuktiPembayaranUser::class);
    // }
}
