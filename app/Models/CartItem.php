<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'produk_id', 'quantity'];

    public function produk()
    {
        return $this->belongsTo(produk::class);
    }
}
