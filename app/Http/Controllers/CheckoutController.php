<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function detail()
    {
        $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();

        // if (!$cart || $cart->items->isEmpty()) {
        //     return redirect()->route('order.success')->withErrors(['message' => 'Keranjang Anda kosong!']);
        // }

        return view('ecommerce.checkout.detail', compact('cart'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();

        // if (!$cart || $cart->items->isEmpty()) {
        //     return redirect()->route('order.success')->withErrors(['message' => 'Keranjang Anda kosong!']);
        // }

        // Buat order baru
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'alamat' => $validated['alamat'],
            'total' => $cart->items->sum(fn($item) => $item->produk->harga * $item->quantity),
        ]);

        // Salin item dari keranjang ke order_items
        foreach ($cart->items as $item) {
            // Periksa stok produk
            if ($item->produk->stok < $item->quantity) {
                return back()->withErrors(['message' => "Stok untuk {$item->produk->nama} tidak mencukupi."]);
            }

            // Kurangi stok produk
            $item->produk->stok -= $item->quantity;
            $item->produk->save();

            // Tambahkan item ke order
            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $item->produk_id,
                'quantity' => $item->quantity,
                'harga' => $item->produk->harga,
            ]);
        }

        // Hapus keranjang setelah selesai checkout
        $cart->items()->delete();
        $cart->delete();

        return redirect()->route('order.success')->with('success', 'Pesanan berhasil dibuat!');
    }
    public function success()
    {
        $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();
        return view('ecommerce.checkout.order-success', compact('cart'));
    }
}
