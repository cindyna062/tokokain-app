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
                    return view('homepage', compact('produk', 'produkbaru', 'cart'));
                    break;
                default:
                    return redirect('/')->with('error', 'Role tidak dikenali.');
            }
        } else {
            $produkbaru = produk::orderBy('created_at', 'desc')->take(4)->get();


            // Jika pengguna belum login (guest), tampilkan halaman umum
            return view('homepage', compact('produkbaru'));
        }
    }
    public function search(Request $request)
    {
        $query = $request->input('search'); // Ambil input pencarian
        $results = produk::where('namaproduk', 'LIKE', "%{$query}%")
            ->orWhere('deskripsi', 'LIKE', "%{$query}%")
            ->orWhereHas('kategori', function ($q) use ($query) {
                $q->where('kategori_produk', 'LIKE', "%{$query}%"); // Sesuaikan 'nama' dengan field kategori Anda
            })
            ->get();

        return view('search.results', compact('results', 'query'));
    }
    public function suggestions(Request $request)
    {
        $query = $request->input('search');
        $suggestions = produk::where('namaproduk', 'LIKE', "%{$query}%")
            ->orWhere('deskripsi', 'LIKE', "%{$query}%")
            ->take(5) // Batasi jumlah hasil
            ->get(['id', 'namaproduk']); // Ambil kolom yang diperlukan saja

        return response()->json($suggestions);
    }
}
