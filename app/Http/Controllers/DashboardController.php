<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            // Jika pengguna sudah login, cek peran (role) mereka
            switch (Auth::user()->role) {
                case 'admin':
                    return view('admin.index');
                    break;
                case 'user':
                    // Ambil produk terbaru berdasarkan timestamp
                    $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();
                    $produkbaru = Produk::orderBy('created_at', 'desc')->take(4)->get();
                    $produk = Produk::all();
                    return view('ecommerce.index', compact('produk', 'produkbaru', 'cart'));
                    break;
                default:
                    return redirect('/')->with('error', 'Role tidak dikenali.');
            }
        } else {
            $produkbaru = produk::orderBy('created_at', 'desc')->take(4)->get();
            // Jika pengguna belum login (guest), tampilkan halaman umum
            return view('ecommerce.index', compact('produkbaru'));
        }
    }
}
