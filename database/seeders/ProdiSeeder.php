<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodis = [
            ['nama_prodi' => 'Teknik Sipil', 'jenjang' => 'D3'],
            ['nama_prodi' => 'Teknik Mesin', 'jenjang' => 'D3'],
            ['nama_prodi' => 'Teknik Komputer', 'jenjang' => 'D3'],
            ['nama_prodi' => 'Administrasi Bisnis', 'jenjang' => 'D3'],
            ['nama_prodi' => 'Bisnis Digital', 'jenjang' => 'D4'],
        ];

        foreach ($prodis as $prodi) {
            Prodi::create($prodi);
        }
    }
}
