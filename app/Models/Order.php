<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'alamat','jenis_pengiriman','kurir','jenis_pembayaran', 'total'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
