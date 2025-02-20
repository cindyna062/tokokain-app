<?php

use App\Http\Controllers\auth\SesiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', [TestController::class, 'index']);


Route::get('/', [DashboardController::class, 'index']);
Route::get('/search', [DashboardController::class, 'search'])->name('search');
Route::get('/search-suggestions', [DashboardController::class, 'suggestions'])->name('search.suggestions');
Route::middleware(['guest'])->group(function () {

    Route::get('/login', [SesiController::class, 'indexlogin'])->name('login');
    Route::post('/login', [SesiController::class, 'store']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm']);
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [SesiController::class, 'logout']);
});

Route::middleware(['auth', 'roles:admin'])->group(function () {
    //dashboard
    // Route::get('/', [DashboardController::class, 'index']);

    //produk
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/produk/tambahproduk', [ProdukController::class, 'formtambahproduk']);
    Route::post('/produk/tambahproduk', [ProdukController::class, 'storeproduk'])->name('produk.store');
    Route::put('/produk/updateproduk/{id}', [ProdukController::class, 'updateproduk'])->name('produk.update');
    Route::delete('/produk/deleteproduk/{id}', [ProdukController::class, 'destroyproduk'])->name('produk.delete');

    Route::get('/kategoriproduk', [KategoriProdukController::class, 'index']);
    Route::post('/kategoriproduk/tambah', [KategoriProdukController::class, 'store'])->name('kategori.store');
    Route::put('/kategoriproduk/update/{id}', [KategoriProdukController::class, 'update'])->name('kategori.update');

});

Route::middleware(['auth', 'roles:user'])->group(function () {
    //dashboard
    // Route::get('/', [DashboardController::class, 'index']);

    Route::get('/user/produk', [ProdukController::class, 'indexuser']);
    Route::get('/produkterbaru', [ProdukController::class, 'newproduk']);
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    // Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout/detail', [CheckoutController::class, 'detail'])->name('checkout.detail');
    Route::post('/checkout/submit', [CheckoutController::class, 'submit'])->name('checkout.submit');
    Route::get('/order-success', [CheckoutController::class, 'success'])->name('order.success');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});
