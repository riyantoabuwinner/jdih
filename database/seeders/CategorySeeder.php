<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Peraturan Rektor', 'slug' => 'peraturan-rektor'],
            ['name' => 'Surat Keputusan (SK)', 'slug' => 'surat-keputusan'],
            ['name' => 'Instruksi Rektor', 'slug' => 'instruksi-rektor'],
            ['name' => 'Pedoman/Panduan', 'slug' => 'pedoman-panduan'],
            ['name' => 'Monografi Hukum', 'slug' => 'monografi-hukum'],
            ['name' => 'Artikel Hukum', 'slug' => 'artikel-hukum'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
