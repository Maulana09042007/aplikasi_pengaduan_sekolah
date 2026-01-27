<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Siswa;

class AspirasiSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriIds = Kategori::pluck('id')->toArray();

        // HARUS SAMA PERSIS DENGAN ENUM
        $statusList = ['Menunggu', 'Diproses', 'Selesai'];

        for ($i = 1; $i <= 10; $i++) {

            $nis = '20240' . rand(10, 99);

            $siswa = Siswa::firstOrCreate(
                ['nis' => $nis],
                [
                    'nama'  => 'Siswa ' . $nis,
                    'kelas' => 'XI RPL 1'
                ]
            );

            Aspirasi::create([
                'siswa_id'        => $siswa->id,
                'kategori_id'     => collect($kategoriIds)->random(),
                'lokasi'          => 'Ruang ' . rand(1, 10),
                'status'          => collect($statusList)->random(),
                'feedback_user'   => 'Ini adalah aspirasi dari siswa ' . $nis,
                'feedback_admin'  => null, // admin belum balas
            ]);
        }
    }
}
