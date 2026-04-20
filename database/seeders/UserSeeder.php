<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = \App\Models\Role::where('name', 'super_admin')->first();

        \App\Models\User::updateOrCreate(
            ['username' => 'superadmin'],
            [
                'name' => 'Super Admin JDIH',
                'email' => 'admin@jdih.uinsiber.ac.id',
                'password' => bcrypt('password'),
                'role_id' => $superAdminRole->id,
                'is_active' => true,
            ]
        );
    }
}
