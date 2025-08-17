<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruangan::create([
            'kode_ruangan' => 'R101',
            'nama_ruangan' => 'Ruang Sidang A',
            'prodi_id' => null, // bisa dipakai semua prodi
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R102',
            'nama_ruangan' => 'Ruang Teknik',
            'prodi_id' => 1, // khusus prodi_id = 1
        ]);
    }
}
