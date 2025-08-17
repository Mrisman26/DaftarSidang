<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Buat Role
        Role::create(['name' => 'Mahasiswa']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Dosen']);
        Role::create(['name' => 'Kaprodi']);

    }
}
