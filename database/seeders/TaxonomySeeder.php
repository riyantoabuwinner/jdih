<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Enums\CategoryType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset taxonomy
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        DB::table('category_relations')->truncate();
        Schema::enableForeignKeyConstraints();

        $this->seedClusters();
        $this->seedDimensions();
        $this->seedMapping();
    }

    private function seedClusters()
    {
        // 1. Peraturan Perundang-undangan (Standard JDIHN)
        $perpres = Category::create([
            'name' => 'Peraturan Perundang-undangan',
            'slug' => 'peraturan-perundang-undangan',
            'type' => CategoryType::CLUSTER,
            'order' => 1
        ]);

        $nationalLEgal = [
            'Undang-Undang Dasar 1945',
            'Ketetapan MPR',
            'Undang-Undang / Perppu',
            'Peraturan Pemerintah',
            'Peraturan Presiden',
            'Peraturan Menteri',
            'Peraturan Menteri Agama (PMA)',
            'Keputusan Menteri Agama (KMA)',
            'Instruksi Menteri Agama',
            'Surat Edaran Menteri Agama',
            'Peraturan Lembaga Pemerintah Non Kementerian (LPNK)',
            'Peraturan Badan / Komisi',
            'Peraturan Daerah Provinsi',
            'Peraturan Gubernur',
            'Peraturan Daerah Kabupaten/Kota',
            'Peraturan Bupati/Walikota',
            'Peraturan Desa',
        ];

        foreach ($nationalLEgal as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'type' => CategoryType::LEGAL_TYPE,
                'parent_id' => $perpres->id,
                'order' => $i
            ]);
        }

        // 2. Produk Hukum Institusi (UIN)
        $uinProd = Category::create([
            'name' => 'Produk Hukum Institusi (UIN)',
            'slug' => 'produk-hukum-institusi',
            'type' => CategoryType::CLUSTER,
            'order' => 2
        ]);

        $uinLegal = [
            'Peraturan Rektor',
            'Keputusan Rektor',
            'Instruksi Rektor',
            'Surat Edaran Rektor',
            'Peraturan Dekan',
            'Keputusan Dekan',
        ];

        foreach ($uinLegal as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'type' => CategoryType::LEGAL_TYPE,
                'parent_id' => $uinProd->id,
                'order' => $i
            ]);
        }

        // 3. Monografi Hukum
        $mono = Category::create([
            'name' => 'Monografi Hukum',
            'slug' => 'monografi-hukum',
            'type' => CategoryType::CLUSTER,
            'order' => 3
        ]);

        $monoLegal = [
            'Buku Hukum',
            'Jurnal Hukum',
            'Hasil Penelitian / Pengkajian Hukum',
            'Kamus Hukum',
            'Ensiklopedia Hukum',
        ];

        foreach ($monoLegal as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'type' => CategoryType::LEGAL_TYPE, // Standard JDIHN treats these as types
                'parent_id' => $mono->id,
                'order' => $i
            ]);
        }

        // 4. Artikel Hukum
        $article = Category::create([
            'name' => 'Artikel Hukum',
            'slug' => 'artikel-hukum',
            'type' => CategoryType::CLUSTER,
            'order' => 4
        ]);

        $articleTypes = ['Majalah Hukum', 'Kliping Koran', 'Buletin'];

        foreach ($articleTypes as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'type' => CategoryType::LEGAL_TYPE,
                'parent_id' => $article->id,
                'order' => $i
            ]);
        }

        // 5. Putusan Pengadilan
        $court = Category::create([
            'name' => 'Putusan Pengadilan / Yurisprudensi',
            'slug' => 'putusan-pengadilan',
            'type' => CategoryType::CLUSTER,
            'order' => 5
        ]);

        $courtTypes = [
            'Putusan Mahkamah Konstitusi',
            'Putusan Mahkamah Agung',
            'Putusan Pengadilan Tinggi',
            'Putusan Pengadilan Negeri',
        ];

        foreach ($courtTypes as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'type' => CategoryType::LEGAL_TYPE,
                'parent_id' => $court->id,
                'order' => $i
            ]);
        }

        // 6. Dokumen Hukum Lainnya
        $others = Category::create([
            'name' => 'Dokumen Hukum Lainnya',
            'slug' => 'dokumen-hukum-lainnya',
            'type' => CategoryType::CLUSTER,
            'order' => 6
        ]);

        $otherTypes = [
            'Naskah Akademik',
            'Rancangan Peraturan',
            'Risalah Sidang',
            'Nota Kesepahaman (MoU)',
            'Perjanjian Kerja Sama (MoA)',
        ];

        foreach ($otherTypes as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'type' => CategoryType::LEGAL_TYPE,
                'parent_id' => $others->id,
                'order' => $i
            ]);
        }
    }

    private function seedDimensions()
    {
        // Subjects (Bidang Hukum)
        $subjects = [
            'Hukum Tata Negara',
            'Hukum Administrasi Negara',
            'Hukum Pidana',
            'Hukum Perdata',
            'Hukum Islam',
            'Pendidikan Islam',
            'Haji dan Umrah',
            'Sertifikasi Halal',
            'Urusan Agama Islam',
            'Moderasi Beragama',
            'Pendidikan',
            'Ekonomi & Keuangan',
            'Kesehatan',
            'Teknologi Informasi',
            'Lingkungan Hidup',
            'Zakat dan Wakaf',
        ];

        foreach ($subjects as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'type' => CategoryType::SUBJECT,
                'order' => $i
            ]);
        }

        // Territories (Wilayah)
        $territories = [
            'Nasional',
            'Provinsi',
            'Kabupaten/Kota',
            'Internal Universitas',
            'Internal Fakultas',
            'Internal Prodi/Unit',
        ];

        foreach ($territories as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name), // Should match enum values if they are slugs
                'type' => CategoryType::TERRITORY,
                'order' => $i
            ]);
        }

        // Functions (Fungsi)
        $functions = [
            ['name' => 'Regulatif (Mengatur)', 'slug' => 'regulatif'],
            ['name' => 'Eksekutif (Penetapan)', 'slug' => 'eksekutif'],
            ['name' => 'Instruktif', 'slug' => 'instruktif'],
            ['name' => 'Informatif', 'slug' => 'informatif'],
        ];

        foreach ($functions as $i => $fn) {
            Category::create([
                'name' => $fn['name'],
                'slug' => $fn['slug'],
                'type' => CategoryType::FUNCTION,
                'order' => $i
            ]);
        }
    }

    private function seedMapping()
    {
        // Map everything initially to allow all legal types access to all dimensions
        // This can be refined manually in the Admin UI later
        $legalTypes = Category::where('type', CategoryType::LEGAL_TYPE)->get();
        $dimensions = Category::whereIn('type', [
            CategoryType::SUBJECT,
            CategoryType::TERRITORY,
            CategoryType::FUNCTION
        ])->get();

        foreach ($legalTypes as $type) {
            $type->categories()->attach($dimensions->pluck('id'));
        }
    }
}
