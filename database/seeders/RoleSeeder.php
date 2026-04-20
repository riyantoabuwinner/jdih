<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'super_admin', 'label' => 'Super Admin'],
            ['name' => 'admin', 'label' => 'Admin JDIH'],
            ['name' => 'editor', 'label' => 'Editor'],
            ['name' => 'validator', 'label' => 'Validator (Legal)'],
            ['name' => 'pejabat', 'label' => 'Pejabat / Internal UIN'],
            ['name' => 'guest', 'label' => 'Guest'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
