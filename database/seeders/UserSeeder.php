<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Admin
            User::create([
                'name' => 'Risman',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ])->assignRole('Admin');

            // Daftar Prodi
            $prodis = [
                'Teknik Sipil',
                'Teknik Mesin',
                'Teknik Komputer',
                'Administrasi Bisnis',
                'Bisnis Digital',
            ];

            // Mahasiswa per prodi
            foreach ($prodis as $prodi) {
                $slug = Str::slug($prodi, ''); // contoh: tekniksipil
                for ($i = 1; $i <= 3; $i++) {
                    $username = 'M' . $slug . $i;
                    User::create([
                        'name' => ucfirst($username),
                        'email' => $username . '@gmail.com',
                        'password' => Hash::make('12345678'),
                    ])->assignRole('Mahasiswa');
                }
            }

            // Kaprodi per prodi
            foreach ($prodis as $prodi) {
                $slug = Str::slug($prodi, ''); // contoh: tekniksipil
                User::create([
                    'name' => 'Kaprodi ' . $prodi,
                    'email' => 'kaprodi' . $slug . '@gmail.com',
                    'password' => Hash::make('12345678'),
                ])->assignRole('Kaprodi');
            }

            // Dosen per Prodi
            foreach ($prodis as $prodi) {
                $slug = Str::slug($prodi, ''); // contoh: tekniksipil

                for ($i = 1; $i <= 3; $i++) {
                    $username = 'D' . $slug . $i;
                    User::create([
                        'name' => ucfirst($username),
                        'email' => $username . '@gmail.com',
                        'password' => Hash::make('12345678'),
                    ])->assignRole('Dosen');
                }
            }

        });
    }
}
