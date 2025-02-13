<?php

namespace App\Http\Controllers;

use App\Models\kategoriproduk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KategoriProdukController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $kategori = kategoriproduk::all();
        return view('admin.produk.dtkategoriproduk', compact('kategori'));
    }

    // Tambah kategori baru
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'kategori_produk' => 'required|string|max:255',
                'gambar_kategori' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'deskripsi' => 'nullable|string',
            ]);

            // Menangani upload gambar jika ada
            if ($request->hasFile('gambar_kategori')) {
                // Ambil file gambar yang diupload
                $gambarPath = $request->file('gambar_kategori')->store('gambar_kategori', 'public');
                // Ambil nama file setelah upload
                $gambarUrl = json_encode($gambarPath);
            } else {
                $gambarUrl = null;  // Jika tidak ada gambar yang diupload
            }

            // Buat kategori produk
            $kategori = kategoriproduk::create([
                'kategori_produk' => $request->kategori_produk,
                'gambar_kategori' => $gambarUrl,  // Simpan URL gambar ke database
                'deskripsi' => $request->deskripsi,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Kategori Berhasil Ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Produk Gagal Ditambahkan' . $e->getMessage());
        }

    }

    // Update kategori berdasarkan ID
    public function update(Request $request, $id)
    {
        $kategori = kategoriproduk::find($id);
        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $request->validate([
            'kategori_produk' => 'sometimes|string|max:255',
            'gambar_kategori' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->all());

        return response()->json(['message' => 'Kategori berhasil diperbarui', 'data' => $kategori]);
    }

    // Hapus kategori berdasarkan ID
    public function destroy($id)
    {
        $kategori = kategoriproduk::find($id);
        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $kategori->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
