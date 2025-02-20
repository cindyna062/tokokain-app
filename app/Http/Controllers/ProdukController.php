<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\kategoriproduk;
use App\Models\produk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        switch (Auth::user()->role) {
            case 'admin':
                $kategori = DB::table('kategoriproduks')->select('id', 'kategori_produk')->get();

                $produks = produk::all();
                return view('admin.produk.dtproduk', compact('produks', 'kategori'));
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
        return view('ecommerce.produk.index', compact('produks', 'kategoris', 'cart'));
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

            $data['created_at'] = now();

            DB::table('produks')->insert($data);

            DB::commit();

            return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Produk Gagal Ditambahkan' . $e->getMessage());
        }
    }

    public function updateproduk(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Validasi input
            $rules = [
                'namaproduk' => 'required|string|max:255',
                'harga' => 'nullable|numeric',
                'stok' => 'nullable|integer',
                'deskripsi' => 'nullable|string',
                'kategori_id' => 'nullable|integer',
            ];

            // Validasi hanya jika ada gambar yang diunggah
            if ($request->hasFile('gambarproduk')) {
                $rules['gambarproduk.*'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            }

            $request->validate($rules);

            // Ambil produk yang akan diperbarui
            $produk = Produk::findOrFail($id);

            // Update data produk
            $produk->namaproduk = $request->namaproduk;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->deskripsi = $request->deskripsi;
            $produk->kategori_id = $request->kategori_id;

            // **Hapus gambar lama yang dipilih untuk dihapus**
            if ($request->has('delete_images')) {
                $existingImages = json_decode($produk->gambarproduk, true) ?? [];
                $remainingImages = array_diff($existingImages, $request->delete_images);

                // Hapus gambar dari storage
                foreach ($request->delete_images as $image) {
                    Storage::delete('public/' . $image);
                }

                $produk->gambarproduk = json_encode(array_values($remainingImages));
            }

            // **Tambah gambar baru jika ada**
            if ($request->hasFile('gambarproduk')) {
                $uploadedImages = [];
                foreach ($request->file('gambarproduk') as $image) {
                    $uploadedImages[] = $image->store('produk', 'public');
                }

                // Gabungkan gambar baru dengan gambar lama yang masih ada
                $existingImages = json_decode($produk->gambarproduk, true) ?? [];
                $produk->gambarproduk = json_encode(array_merge($existingImages, $uploadedImages));
            }

            // Simpan perubahan
            $produk->save();

            DB::commit();
            return redirect()->back()->with('success', 'Produk Berhasil Diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Produk Gagal Diperbarui: ' . $e->getMessage());
        }
    }

    public function destroyproduk($id)
    {
        $produks = Produk::find($id);
        if (!$produks) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        $produks->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
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
