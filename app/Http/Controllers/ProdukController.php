<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\kategoriproduk;
use App\Models\produk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        switch (Auth::user()->role) {
            case 'admin':
                $produks = produk::all();
                return view('admin.produk.dtproduk', compact('produks'));
        }
    }
    public function indexuser(Request $request)
    {
        $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();
        $kategoris = kategoriproduk::all(); // Ambil semua kategori
        $kategoriId = $request->get('kategori', null); // Ambil kategori yang dipilih jika ada

        // Jika ada kategori yang dipilih, filter produk berdasarkan kategori tersebut
        if ($kategoriId) {
            $produks = Produk::where('kategori_id', $kategoriId)->get();
        } else {
            $produks = Produk::all(); // Menampilkan semua produk jika tidak ada filter
        }
        return view('ecommerce.produk.index', compact('produks','kategoris' , 'cart'));
    }

    public function indexkategori()
    {
        return view('admin.produk.dtkategoriproduk');
    }
    public function formtambahproduk()
    {
        $kategori = DB::table('kategoriproduks')->select('id', 'kategori_produk')->get();

        return view('admin.produk.tambahproduk', compact('kategori'));
    }

    public function storeproduk(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the incoming request
            $data = $request->validate([
                'namaproduk' => 'string',
                'harga' => 'nullable|numeric',
                'stok' => 'nullable|integer',
                'deskripsi' => 'string',
                'kategori_id' => 'nullable|string',  // This can be a string if a new category is created
            ]);

            // Handle image uploads
            if ($request->hasFile('gambarproduk')) {
                $imagePaths = [];
                foreach ($request->file('gambarproduk') as $image) {
                    $imagePaths[] = $image->store('produk', 'public');
                }
                $data['gambarproduk'] = json_encode($imagePaths); // Store the image paths as JSON
            }

            // If the category_id is a new category, we create it
            if (is_string($data['kategori_id'])) {
                // Check if category already exists
                $kategori = DB::table('kategoriproduks')->where('kategori_produk', $data['kategori_id'])->first();
                if (!$kategori) {
                    // Insert new kategori if it doesn't exist
                    $kategori = DB::table('kategoriproduks')->insertGetId([
                        'kategori_produk' => $data['kategori_id']
                    ]);
                }
                $data['kategori_id'] = $kategori;
            }

            // // Handle product image and other product data
            // if ($request->hasFile('gambarproduk')) {
            //     $data['gambarproduk'] = $request->file('gambarproduk')->store('produk', 'public');
            // }

            // Insert the product data including the category_id
            DB::table('produks')->insert($data);

            DB::commit();

            return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Produk Gagal Ditambahkan' . $e->getMessage());
        }
    }
    public function newproduk()
    {
        // Cari produk berdasarkan ID
        // Mengambil produk terbaru (urutkan berdasarkan created_at)
        $produkTerbaru = Produk::orderBy('created_at', 'desc')->limit(5)->get();
        $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();
        // Tampilkan halaman detail produk
        return view('ecommerce.produk.produkterbaru', compact('produkTerbaru', 'cart'));
    }

    public function show($id)
    {
        // Cari produk berdasarkan ID
        $produk = produk::findOrFail($id);
        $cart = Cart::with('items.produk')->where('user_id', Auth::user()->id)->first();
        // Tampilkan halaman detail produk
        return view('ecommerce.produk.show', compact('produk', 'cart'));
    }
}
