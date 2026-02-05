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
        $statusList = ['Menunggu', 'Proses', 'Selesai'];

        for ($i = 1; $i <= 10; $i++) {

            // 1️⃣ NIS dummy
            $nis = '20240' . rand(10, 99);

            // 2️⃣ pastikan siswa ada
            $siswa = Siswa::firstOrCreate(
                ['nis' => $nis],
                [
                    'nama'  => 'Siswa ' . $nis,
                    'kelas' => 'XI RPL 1'
                ]
            );

            // 3️⃣ simpan aspirasi pakai siswa_id
            Aspirasi::create([
                'siswa_id'   => $siswa->id,
                'kategori_id'=> collect($kategoriIds)->random(),
                'lokasi'     => 'Ruang ' . rand(1, 10),
                'status'     => collect($statusList)->random(),
                'feedback'   => 'tolong benarkan',
            ]);
        }
    }
}
