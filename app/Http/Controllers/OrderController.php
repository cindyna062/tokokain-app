<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->with('items.produk')->orderBy('created_at', 'desc')->get();
        $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();
        return view('ecommerce.checkout.orderlist', compact('orders', 'cart'));
    }
}
