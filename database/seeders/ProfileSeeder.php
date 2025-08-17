<?php

namespace Database\Seeders;

use App\Models\Prodi;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $index => $user) {
            Profile::create([
                'user_id' => $user->id,
                'no_hp' => '08' . str_pad((string)(rand(100000000, 999999999)), 9, '0', STR_PAD_LEFT), // contoh: 08123456789
                'alamat' => 'Alamat ' . $user->name,
            ]);
        }
    }
}
