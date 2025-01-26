<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategoriproduk extends Model
{
    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'kategoriproduks';

    // Relasi dengan model produk
    public function produk()
    {
        return $this->hasMany(produk::class, 'kategori_id');
    }
}
