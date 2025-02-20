<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
            [

                [
                    'kategori_produk' => 'Katun',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain katun dengan berbagai jenis dan motif yang nyaman digunakan.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Satin',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain satin dengan tekstur halus dan kilauan mewah.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Linen',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain linen premium yang ringan dan nyaman untuk pakaian kasual.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Wolfis',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain wolfis yang halus, tidak menerawang, dan mudah dirawat.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Balotelli',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain balotelli yang memiliki tekstur khas dan tidak mudah kusut.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Sifon',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain sifon yang ringan, flowy, dan tersedia dalam berbagai motif.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Denim',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain denim yang kuat dan tahan lama, cocok untuk pakaian kasual.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Spandek',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain spandek yang elastis dan cocok untuk pakaian olahraga.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Organza',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain organza yang transparan dengan tampilan mewah untuk gaun pesta.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],
                [
                    'kategori_produk' => 'Velvet',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain velvet dengan tekstur lembut dan tampilan elegan.',
                    'created_at' => now(), // Pastikan ini ada
                    'updated_at' => now()
                ],

            ];
        DB::table('kategoriproduks')->insert($data);
    }
}
