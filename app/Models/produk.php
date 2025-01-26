<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produks';
    protected $fillable = [
        'namaproduk',
        'harga',
        'deskripsi',
        'stok',
        'gambarproduk',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(kategoriproduk::class, 'kategori_id');
    }
}
