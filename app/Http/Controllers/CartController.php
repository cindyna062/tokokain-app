<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::user()->id; // Pastikan hanya mengambil ID, bukan objek u


        // Cek jika pengguna sudah memiliki keranjang
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Tambahkan item ke keranjang
        $cartItem = $cart->items()->updateOrCreate(
            ['produk_id' => $validated['produk_id']],
            ['quantity' => DB::raw("quantity + {$validated['quantity']}")]
        );


        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function viewCart()
    {
        $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();
        return view('cart.index', compact('cart'));
    }
}
