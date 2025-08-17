<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MahasiswaProfile;
use App\Models\Prodi;

class MahasiswaProfileSeeder extends Seeder
{
    public function run(): void
    {
        $prodis = Prodi::all();

        foreach ($prodis as $prodi) {
            // Ambil user yang punya role Mahasiswa
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'Mahasiswa');
            })->where('email', 'like', '%'.strtolower(str_replace(' ', '', $prodi->nama_prodi)).'%')->get();

            $i = 1;
            foreach ($users as $user) {
                MahasiswaProfile::create([
                    'user_id' => $user->id,
                    'nim' => (string)($prodi->id . str_pad($i, 4, '0', STR_PAD_LEFT)), // misal: 10001
                    'prodi_id' => $prodi->id,
                ]);
                $i++;
            }
        }
    }
}
