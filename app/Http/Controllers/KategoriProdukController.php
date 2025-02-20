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

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'kategori_produk' => 'required|string|max:255',
                'gambar_kategori' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'deskripsi' => 'nullable|string',
            ]);

            // Temukan kategori berdasarkan ID
            $kategori = kategoriproduk::findOrFail($id);

            // Menangani upload gambar jika ada
            if ($request->hasFile('gambar_kategori')) {
                // Hapus gambar lama jika ada
                if ($kategori->gambar_kategori) {
                    Storage::disk('public')->delete(json_decode($kategori->gambar_kategori));
                }
                // Simpan gambar baru
                $gambarPath = $request->file('gambar_kategori')->store('gambar_kategori', 'public');
                $kategori->gambar_kategori = json_encode($gambarPath);
            }

            // Update data kategori
            $kategori->update([
                'kategori_produk' => $request->kategori_produk,
                'deskripsi' => $request->deskripsi,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Kategori Berhasil Diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Kategori Gagal Diperbarui: ' . $e->getMessage());
        }
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
