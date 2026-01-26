<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Fasilitas',
            'Kebersihan',
            'Keamanan',
            'Pelayanan Guru',
            'Lainnya',
        ];

        foreach ($data as $item) {
            Kategori::create([
                'ket_kategori' => $item
            ]);
        }
    }
}
