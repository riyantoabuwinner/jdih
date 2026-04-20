<?php

namespace Database\Seeders;

use App\Models\InformationCluster;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InformationClusterSeeder extends Seeder
{
    public function run(): void
    {
        $clusters = [
            [
                'name' => 'Peraturan Perundang-undangan',
                'description' => 'Produk hukum berupa peraturan tertulis.',
                'icon' => 'file-text',
                'order' => 1,
                'categories' => ['Peraturan Rektor', 'Surat Keputusan (SK)', 'Instruksi Rektor']
            ],
            [
                'name' => 'Monografi Hukum',
                'description' => 'Karya tulis hukum, buku, atau referensi hukum.',
                'icon' => 'book',
                'order' => 2,
                'categories' => ['Monografi Hukum']
            ],
            [
                'name' => 'Artikel Hukum / Informasi Hukum',
                'description' => 'Berita, artikel, dan informasi hukum lainnya.',
                'icon' => 'newspaper',
                'order' => 3,
                'categories' => ['Artikel Hukum', 'Pedoman/Panduan']
            ],
            [
                'name' => 'Putusan Pengadilan',
                'description' => 'Dokumentasi putusan pengadilan yang relevan.',
                'icon' => 'gavel',
                'order' => 4,
                'categories' => []
            ],
        ];

        foreach ($clusters as $c) {
            $cluster = InformationCluster::create([
                'name' => $c['name'],
                'slug' => Str::slug($c['name']),
                'description' => $c['description'],
                'icon' => $c['icon'],
                'order' => $c['order'],
            ]);

            foreach ($c['categories'] as $catName) {
                Category::where('name', $catName)->update(['information_cluster_id' => $cluster->id]);
            }
        }
    }
}
