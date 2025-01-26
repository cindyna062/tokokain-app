<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        // Cek jika pengguna sudah login
    // if (Auth::check()) {
    //     // Cek peran pengguna
    //     if (Auth::user()->role == 'admin') {
    //         // Arahkan pengguna admin ke halaman dashboard admin (misalnya)
    //         return redirect('/admin-dashboard');
    //     } elseif (Auth::user()->role == 'user') {
    //         // Arahkan pengguna biasa ke halaman dashboard pengguna (misalnya)
    //         return redirect('/user-dashboard');
    //     }
    // }
    $produkbaru = produk::orderBy('created_at', 'desc')->take(4)->get();
        return view('ecommerce.index', compact('produkbaru'));
    }
    public function indexlogin()
    {

        return view('auth.login');
    }
    public function store(Request $request)
    {
        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $remember = $request->has('remember'); // Periksa apakah checkbox 'remember' dicentang

        if (Auth::attempt($infologin, $remember)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->intended('/');
            } else {
                return redirect()->back()->with('error', 'Email atau Password Tidak Terdaftar');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah');
        }
    }
    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('');
    }
}
