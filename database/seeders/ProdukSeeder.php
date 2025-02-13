<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
            [
                [
                    'namaproduk' => 'Kain Katun Jepang',
                    'harga' => 75000,
                    'deskripsi' => 'Kain katun Jepang berkualitas tinggi, lembut dan nyaman digunakan.',
                    'stok' => 50,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 1,
                ],
                [
                    'namaproduk' => 'Kain Satin Silk',
                    'harga' => 120000,
                    'deskripsi' => 'Kain satin silk dengan kilauan mewah, cocok untuk gaun elegan.',
                    'stok' => 30,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 2,
                ],
                [
                    'namaproduk' => 'Kain Linen Premium',
                    'harga' => 95000,
                    'deskripsi' => 'Kain linen berkualitas premium, ringan dan cocok untuk pakaian kasual.',
                    'stok' => 40,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 3,
                ],
                [
                    'namaproduk' => 'Kain Wolfis',
                    'harga' => 65000,
                    'deskripsi' => 'Kain wolfis dengan tekstur halus dan tidak menerawang.',
                    'stok' => 60,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 4,
                ],
                [
                    'namaproduk' => 'Kain Balotelli',
                    'harga' => 70000,
                    'deskripsi' => 'Kain balotelli dengan serat kuat dan tidak mudah kusut.',
                    'stok' => 45,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 5,
                ],
                [
                    'namaproduk' => 'Kain Sifon Motif',
                    'harga' => 80000,
                    'deskripsi' => 'Kain sifon dengan motif menarik, ringan dan flowy.',
                    'stok' => 35,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 6,
                ],
                [
                    'namaproduk' => 'Kain Denim Tebal',
                    'harga' => 110000,
                    'deskripsi' => 'Kain denim tebal berkualitas tinggi, cocok untuk jaket dan celana.',
                    'stok' => 25,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 7,
                ],
                [
                    'namaproduk' => 'Kain Spandek Super',
                    'harga' => 90000,
                    'deskripsi' => 'Kain spandek elastis dengan ketebalan yang pas, cocok untuk pakaian olahraga.',
                    'stok' => 55,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 8,
                ],
                [
                    'namaproduk' => 'Kain Organza',
                    'harga' => 150000,
                    'deskripsi' => 'Kain organza transparan dengan kilauan mewah, cocok untuk gaun pesta.',
                    'stok' => 20,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 9,
                ],
                [
                    'namaproduk' => 'Kain Velvet Premium',
                    'harga' => 130000,
                    'deskripsi' => 'Kain velvet premium dengan tekstur lembut dan tampilan mewah.',
                    'stok' => 30,
                    'gambarproduk' => '["default.jpg"]',
                    'kategori_id' => 10,
                ],
            ];
        DB::table('produks')->insert($data);
    }
}
