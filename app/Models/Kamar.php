<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // public function scopeFilter($query, array $filters)
    // {
    //     // if (isset($filters['search']) ? $filters['search'] : false) {
    //     //     $query->where('kamar', 'like', '%' . $filters['search'] . '%')
    //     //         ->orWhere('harga', 'like', '%' . $filters['search'] . '%');
    //     // }

    //     $query->when($filters['search'] ?? false, function ($query, $search) {
    //         $query->where('kamar', 'like', '%' . $search . '%')
    //             ->orWhere('harga', 'like', '%' . $search . '%');
    //     });
    // }

    public function getRouteKeyName()
    {
        return 'kamar';
    }
    //relasi ke dalam tabel pesanan detail
    public function pesananDetail()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
