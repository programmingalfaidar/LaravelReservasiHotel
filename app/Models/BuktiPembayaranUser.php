<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaranUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pesananDetail()
    {
        return $this->belongsTo(PesananDetail::class);
    }
}
