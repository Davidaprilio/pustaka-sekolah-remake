<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'slug' => 'su-admin',
                'name' => 'Super Admin',
                'description' => 'Admin Sistem',
            ],
            [
                'slug' => 'admin',
                'name' => 'Admin',
                'description' => 'Petugas perpustakaan',
            ],
            [
                'slug' => 'guru',
                'name' => 'Guru',
                'description' => 'user Guru',
            ],
            [
                'slug' => 'siswa',
                'name' => 'Siswa',
                'description' => 'user Siswa',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
