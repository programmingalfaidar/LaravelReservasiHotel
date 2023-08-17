<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // relasi ke dalam tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi kedalam tabel pesanan detail
    public function PesananDetail()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
