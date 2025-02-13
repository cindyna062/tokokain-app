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
                ],
                [
                    'kategori_produk' => 'Satin',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain satin dengan tekstur halus dan kilauan mewah.',
                ],
                [
                    'kategori_produk' => 'Linen',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain linen premium yang ringan dan nyaman untuk pakaian kasual.',
                ],
                [
                    'kategori_produk' => 'Wolfis',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain wolfis yang halus, tidak menerawang, dan mudah dirawat.',
                ],
                [
                    'kategori_produk' => 'Balotelli',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain balotelli yang memiliki tekstur khas dan tidak mudah kusut.',
                ],
                [
                    'kategori_produk' => 'Sifon',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain sifon yang ringan, flowy, dan tersedia dalam berbagai motif.',
                ],
                [
                    'kategori_produk' => 'Denim',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain denim yang kuat dan tahan lama, cocok untuk pakaian kasual.',
                ],
                [
                    'kategori_produk' => 'Spandek',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain spandek yang elastis dan cocok untuk pakaian olahraga.',
                ],
                [
                    'kategori_produk' => 'Organza',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain organza yang transparan dengan tampilan mewah untuk gaun pesta.',
                ],
                [
                    'kategori_produk' => 'Velvet',
                    'gambar_kategori' => '["defaultkategori.jpg"]',
                    'deskripsi' => 'Kategori kain velvet dengan tekstur lembut dan tampilan elegan.',
                ],

            ];
        DB::table('kategoriproduks')->insert($data);
    }
}
