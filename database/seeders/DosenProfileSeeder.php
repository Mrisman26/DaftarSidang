<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DosenProfile;
use App\Models\Prodi;

class DosenProfileSeeder extends Seeder
{
    public function run(): void
    {
        $prodis = Prodi::all();

        foreach ($prodis as $prodi) {
            $slug = strtolower(str_replace(' ', '', $prodi->nama_prodi));

            // 1. Kaprodi
            $kaprodi = User::where('email', 'kaprodi' . $slug . '@gmail.com')->first();
            if ($kaprodi) {
                DosenProfile::create([
                    'user_id' => $kaprodi->id,
                    'nidn' => rand(1000000000, 9999999999),
                    'prodi_id' => $prodi->id,
                    'is_pembimbing' => true,
                    'is_penguji' => true,
                ]);
            }

            // 2. Dosen
            for ($i = 1; $i <= 3; $i++) {
                $email = 'd' . $slug . $i . '@gmail.com'; // disamakan dengan seeder user
                $user = User::where('email', $email)->first();

                if ($user) {
                    DosenProfile::create([
                        'user_id' => $user->id,
                        'nidn' => rand(1000000000, 9999999999),
                        'prodi_id' => $prodi->id,
                        'is_pembimbing' => (bool)rand(0, 1),
                        'is_penguji' => (bool)rand(0, 1),
                    ]);
                }
            }
        }
    }
}
