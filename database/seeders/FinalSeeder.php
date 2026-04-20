<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinalSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data to avoid conflicts
        DB::table('news_tag')->truncate();
        DB::table('document_tag')->truncate();
        DB::table('feedbacks')->truncate();
        DB::table('faqs')->truncate();
        DB::table('menus')->truncate();
        DB::table('pages')->truncate();
        DB::table('documents')->truncate();
        DB::table('news')->truncate();
        DB::table('tags')->truncate();
        DB::table('categories')->truncate();
        DB::table('news_categories')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();

        // Table: settings
        DB::table('settings')->insert([
            [
  'id' => 1,
  'key' => 'logo',
  'value' => 'logos/logo-uin.png',
  'group' => 'general',
  'created_at' => '2026-04-13 04:34:56',
  'updated_at' => '2026-04-13 04:34:56',
],
            [
  'id' => 2,
  'key' => 'favicon',
  'value' => 'logos/favicon-uin.png',
  'group' => 'general',
  'created_at' => '2026-04-13 04:34:56',
  'updated_at' => '2026-04-13 04:34:56',
],
            [
  'id' => 3,
  'key' => 'app_name',
  'value' => 'Jaringan Dokumentasi dan Informasi Hukum',
  'group' => 'general',
  'created_at' => '2026-04-19 20:45:11',
  'updated_at' => '2026-04-20 02:55:28',
],
            [
  'id' => 4,
  'key' => 'app_tagline',
  'value' => 'UIN SIBER SYEKH NURJATI CIREBON',
  'group' => 'general',
  'created_at' => '2026-04-19 20:45:11',
  'updated_at' => '2026-04-20 02:55:28',
],
            [
  'id' => 5,
  'key' => 'footer_description',
  'value' => 'Portal resmi Jaringan Dokumentasi dan Informasi Hukum UIN Siber Syekh Nurjati Cirebon. Menyajikan pusaka dokumen legal, produk hukum, dan regulasi kampus secara tertib, transparan, dan terintegrasi secara siber.',
  'group' => 'general',
  'created_at' => '2026-04-19 20:45:11',
  'updated_at' => '2026-04-19 20:45:11',
],
            [
  'id' => 6,
  'key' => 'contact_email',
  'value' => 'jdih@uinssc.ac.id',
  'group' => 'general',
  'created_at' => '2026-04-19 20:45:11',
  'updated_at' => '2026-04-20 02:55:28',
],
            [
  'id' => 7,
  'key' => 'contact_phone',
  'value' => '(0231) 481264',
  'group' => 'general',
  'created_at' => '2026-04-19 20:45:11',
  'updated_at' => '2026-04-19 20:45:11',
],
            [
  'id' => 8,
  'key' => 'contact_address',
  'value' => 'Gedung Pusat Administrasi Biro (Rektorat],
UIN Siber Syekh Nurjati Cirebon
Jl. Perjuangan By Pass Sunyaragi, Kesambi,
Kota Cirebon, Jawa Barat 45131',
  'group' => 'general',
  'created_at' => '2026-04-19 20:45:11',
  'updated_at' => '2026-04-19 20:45:31',
],
            [
  'id' => 9,
  'key' => 'logo_light',
  'value' => 'settings/zupIm96Zudva2gWpAL4YZgg2KpGUz86OgJS3H7M0.png',
  'group' => 'general',
  'created_at' => '2026-04-19 20:53:29',
  'updated_at' => '2026-04-19 20:53:29',
],
            [
  'id' => 10,
  'key' => 'logo_dark',
  'value' => 'settings/6VOnNeVh2EETKXIbkSSXXHNmFWP9WwBBuSEfm2ze.png',
  'group' => 'general',
  'created_at' => '2026-04-19 20:53:29',
  'updated_at' => '2026-04-19 20:53:29',
],
            [
  'id' => 11,
  'key' => 'backup_status',
  'value' => 'ready',
  'group' => 'backup',
  'created_at' => '2026-04-20 06:29:00',
  'updated_at' => '2026-04-20 07:05:33',
],
            [
  'id' => 12,
  'key' => 'backup_frequency',
  'value' => 'weekly',
  'group' => 'backup',
  'created_at' => '2026-04-20 06:39:43',
  'updated_at' => '2026-04-20 06:39:43',
],
            [
  'id' => 13,
  'key' => 'backup_retention',
  'value' => '30',
  'group' => 'backup',
  'created_at' => '2026-04-20 06:39:43',
  'updated_at' => '2026-04-20 06:39:43',
],
            [
  'id' => 14,
  'key' => 'backup_progress',
  'value' => '100',
  'group' => 'backup',
  'created_at' => '2026-04-20 06:43:34',
  'updated_at' => '2026-04-20 07:05:33',
],
            [
  'id' => 15,
  'key' => 'backup_last_error',
  'value' => 'SQLSTATE[HY000]: General error: 1 near "SHOW": syntax error (Connection: sqlite, Database: C:\\xampp\\htdocs\\jdih\\database\\database.sqlite, SQL: SHOW TABLES)',
  'group' => 'backup',
  'created_at' => '2026-04-20 06:44:02',
  'updated_at' => '2026-04-20 06:44:02',
],
            [
  'id' => 16,
  'key' => 'last_backup_at',
  'value' => '2026-04-20 07:05:33',
  'group' => 'backup',
  'created_at' => '2026-04-20 06:53:07',
  'updated_at' => '2026-04-20 07:05:33',
],
        ]);

        // Table: roles
        DB::table('roles')->insert([
            [
  'id' => 1,
  'name' => 'super_admin',
  'label' => 'Super Admin',
  'created_at' => '2026-04-11 14:18:54',
  'updated_at' => '2026-04-11 14:18:54',
],
            [
  'id' => 2,
  'name' => 'admin',
  'label' => 'Admin JDIH',
  'created_at' => '2026-04-11 14:18:54',
  'updated_at' => '2026-04-11 14:18:54',
],
            [
  'id' => 3,
  'name' => 'editor',
  'label' => 'Editor',
  'created_at' => '2026-04-11 14:18:54',
  'updated_at' => '2026-04-11 14:18:54',
],
            [
  'id' => 4,
  'name' => 'validator',
  'label' => 'Validator (Legal)',
  'created_at' => '2026-04-11 14:18:54',
  'updated_at' => '2026-04-11 14:18:54',
],
            [
  'id' => 5,
  'name' => 'guest',
  'label' => 'Guest',
  'created_at' => '2026-04-11 14:18:54',
  'updated_at' => '2026-04-11 14:18:54',
],
        ]);

        // Table: users
        DB::table('users')->insert([
            [
  'id' => 1,
  'name' => 'Super Admin JDIH',
  'email' => 'admin@jdih.uinsiber.ac.id',
  'email_verified_at' => NULL,
  'password' => '$2y$12$jK9qhgERX7Q14vwr/M8ifetD9WfjNV9XvBZ5.xgIQ9ohQPXE4I90W',
  'remember_token' => NULL,
  'created_at' => '2026-04-11 14:18:55',
  'updated_at' => '2026-04-13 03:47:38',
  'role_id' => 1,
  'username' => 'superadmin',
  'phone' => NULL,
  'avatar' => NULL,
  'is_active' => 1,
],
            [
  'id' => 2,
  'name' => 'adminfitk',
  'email' => 'fitk@uinssc.ac.id',
  'email_verified_at' => NULL,
  'password' => '$2y$12$vYR6iWWyShZQsdNH47/Jpew7OIC0uhi/WFl6lJIxZTIp3xrPNTP46',
  'remember_token' => NULL,
  'created_at' => '2026-04-11 18:04:51',
  'updated_at' => '2026-04-11 18:04:51',
  'role_id' => 2,
  'username' => NULL,
  'phone' => NULL,
  'avatar' => NULL,
  'is_active' => 1,
],
            [
  'id' => 3,
  'name' => 'Admin Test',
  'email' => 'admin_test@example.com',
  'email_verified_at' => NULL,
  'password' => '$2y$12$s5O.1FgqrzoLv6wWQ/d0FO21IOwvLxMQsrCtxPQXOTfIHKckZkViG',
  'remember_token' => NULL,
  'created_at' => '2026-04-11 19:34:15',
  'updated_at' => '2026-04-11 19:34:15',
  'role_id' => NULL,
  'username' => NULL,
  'phone' => NULL,
  'avatar' => NULL,
  'is_active' => 1,
],
        ]);

        // Table: news_categories
        DB::table('news_categories')->insert([
            [
  'id' => 1,
  'name' => 'Berita dan Informasi',
  'slug' => 'berita-dan-informasi',
  'description' => NULL,
  'created_at' => '2026-04-19 07:00:14',
  'updated_at' => '2026-04-19 07:00:14',
],
            [
  'id' => 2,
  'name' => 'Pengumuman',
  'slug' => 'pengumuman',
  'description' => NULL,
  'created_at' => '2026-04-19 07:00:23',
  'updated_at' => '2026-04-19 07:00:23',
],
        ]);

        // Table: categories
        DB::table('categories')->insert([
            [
  'id' => 1,
  'name' => 'Peraturan Perundang-undangan',
  'slug' => 'peraturan-perundang-undangan',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'cluster',
],
            [
  'id' => 2,
  'name' => 'Undang-Undang Dasar 1945',
  'slug' => 'undang-undang-dasar-1945',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 3,
  'name' => 'Ketetapan MPR',
  'slug' => 'ketetapan-mpr',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 4,
  'name' => 'Undang-Undang / Perppu',
  'slug' => 'undang-undang-perppu',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 5,
  'name' => 'Peraturan Pemerintah',
  'slug' => 'peraturan-pemerintah',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 6,
  'name' => 'Peraturan Presiden',
  'slug' => 'peraturan-presiden',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 4,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 7,
  'name' => 'Peraturan Menteri',
  'slug' => 'peraturan-menteri',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 5,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 8,
  'name' => 'Peraturan Menteri Agama (PMA)',
  'slug' => 'peraturan-menteri-agama-pma',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 6,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 9,
  'name' => 'Keputusan Menteri Agama (KMA)',
  'slug' => 'keputusan-menteri-agama-kma',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 7,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 10,
  'name' => 'Instruksi Menteri Agama',
  'slug' => 'instruksi-menteri-agama',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 8,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 11,
  'name' => 'Surat Edaran Menteri Agama',
  'slug' => 'surat-edaran-menteri-agama',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 9,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 12,
  'name' => 'Peraturan Lembaga Pemerintah Non Kementerian (LPNK)',
  'slug' => 'peraturan-lembaga-pemerintah-non-kementerian-lpnk',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 10,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 13,
  'name' => 'Peraturan Badan / Komisi',
  'slug' => 'peraturan-badan-komisi',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 11,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 14,
  'name' => 'Peraturan Daerah Provinsi',
  'slug' => 'peraturan-daerah-provinsi',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 12,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 15,
  'name' => 'Peraturan Gubernur',
  'slug' => 'peraturan-gubernur',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 13,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 16,
  'name' => 'Peraturan Daerah Kabupaten/Kota',
  'slug' => 'peraturan-daerah-kabupatenkota',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 14,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 17,
  'name' => 'Peraturan Bupati/Walikota',
  'slug' => 'peraturan-bupatiwalikota',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 15,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 18,
  'name' => 'Peraturan Desa',
  'slug' => 'peraturan-desa',
  'parent_id' => 1,
  'description' => NULL,
  'order' => 16,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 19,
  'name' => 'Produk Hukum Institusi (UIN)',
  'slug' => 'produk-hukum-institusi',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'cluster',
],
            [
  'id' => 20,
  'name' => 'Peraturan Rektor',
  'slug' => 'peraturan-rektor',
  'parent_id' => 19,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 21,
  'name' => 'Keputusan Rektor',
  'slug' => 'keputusan-rektor',
  'parent_id' => 19,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 22,
  'name' => 'Instruksi Rektor',
  'slug' => 'instruksi-rektor',
  'parent_id' => 19,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 23,
  'name' => 'Surat Edaran Rektor',
  'slug' => 'surat-edaran-rektor',
  'parent_id' => 19,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 24,
  'name' => 'Peraturan Dekan',
  'slug' => 'peraturan-dekan',
  'parent_id' => 19,
  'description' => NULL,
  'order' => 4,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 25,
  'name' => 'Keputusan Dekan',
  'slug' => 'keputusan-dekan',
  'parent_id' => 19,
  'description' => NULL,
  'order' => 5,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 26,
  'name' => 'Monografi Hukum',
  'slug' => 'monografi-hukum',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'cluster',
],
            [
  'id' => 27,
  'name' => 'Buku Hukum',
  'slug' => 'buku-hukum',
  'parent_id' => 26,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 28,
  'name' => 'Jurnal Hukum',
  'slug' => 'jurnal-hukum',
  'parent_id' => 26,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 29,
  'name' => 'Hasil Penelitian / Pengkajian Hukum',
  'slug' => 'hasil-penelitian-pengkajian-hukum',
  'parent_id' => 26,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 30,
  'name' => 'Kamus Hukum',
  'slug' => 'kamus-hukum',
  'parent_id' => 26,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 31,
  'name' => 'Ensiklopedia Hukum',
  'slug' => 'ensiklopedia-hukum',
  'parent_id' => 26,
  'description' => NULL,
  'order' => 4,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 32,
  'name' => 'Artikel Hukum',
  'slug' => 'artikel-hukum',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 4,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'cluster',
],
            [
  'id' => 33,
  'name' => 'Majalah Hukum',
  'slug' => 'majalah-hukum',
  'parent_id' => 32,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 34,
  'name' => 'Kliping Koran',
  'slug' => 'kliping-koran',
  'parent_id' => 32,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 35,
  'name' => 'Buletin',
  'slug' => 'buletin',
  'parent_id' => 32,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 36,
  'name' => 'Putusan Pengadilan / Yurisprudensi',
  'slug' => 'putusan-pengadilan',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 5,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'cluster',
],
            [
  'id' => 37,
  'name' => 'Putusan Mahkamah Konstitusi',
  'slug' => 'putusan-mahkamah-konstitusi',
  'parent_id' => 36,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 38,
  'name' => 'Putusan Mahkamah Agung',
  'slug' => 'putusan-mahkamah-agung',
  'parent_id' => 36,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 39,
  'name' => 'Putusan Pengadilan Tinggi',
  'slug' => 'putusan-pengadilan-tinggi',
  'parent_id' => 36,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 40,
  'name' => 'Putusan Pengadilan Negeri',
  'slug' => 'putusan-pengadilan-negeri',
  'parent_id' => 36,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 41,
  'name' => 'Dokumen Hukum Lainnya',
  'slug' => 'dokumen-hukum-lainnya',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 6,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'cluster',
],
            [
  'id' => 42,
  'name' => 'Naskah Akademik',
  'slug' => 'naskah-akademik',
  'parent_id' => 41,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 43,
  'name' => 'Rancangan Peraturan',
  'slug' => 'rancangan-peraturan',
  'parent_id' => 41,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 44,
  'name' => 'Risalah Sidang',
  'slug' => 'risalah-sidang',
  'parent_id' => 41,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 45,
  'name' => 'Nota Kesepahaman (MoU)',
  'slug' => 'nota-kesepahaman-mou',
  'parent_id' => 41,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 46,
  'name' => 'Perjanjian Kerja Sama (MoA)',
  'slug' => 'perjanjian-kerja-sama-moa',
  'parent_id' => 41,
  'description' => NULL,
  'order' => 4,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'legal_type',
],
            [
  'id' => 47,
  'name' => 'Hukum Tata Negara',
  'slug' => 'hukum-tata-negara',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 48,
  'name' => 'Hukum Administrasi Negara',
  'slug' => 'hukum-administrasi-negara',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 49,
  'name' => 'Hukum Pidana',
  'slug' => 'hukum-pidana',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 50,
  'name' => 'Hukum Perdata',
  'slug' => 'hukum-perdata',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 51,
  'name' => 'Hukum Islam',
  'slug' => 'hukum-islam',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 4,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 52,
  'name' => 'Pendidikan Islam',
  'slug' => 'pendidikan-islam',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 5,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 53,
  'name' => 'Haji dan Umrah',
  'slug' => 'haji-dan-umrah',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 6,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 54,
  'name' => 'Sertifikasi Halal',
  'slug' => 'sertifikasi-halal',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 7,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 55,
  'name' => 'Urusan Agama Islam',
  'slug' => 'urusan-agama-islam',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 8,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 56,
  'name' => 'Moderasi Beragama',
  'slug' => 'moderasi-beragama',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 9,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 57,
  'name' => 'Pendidikan',
  'slug' => 'pendidikan',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 10,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 58,
  'name' => 'Ekonomi & Keuangan',
  'slug' => 'ekonomi-keuangan',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 11,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 59,
  'name' => 'Kesehatan',
  'slug' => 'kesehatan',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 12,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 60,
  'name' => 'Teknologi Informasi',
  'slug' => 'teknologi-informasi',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 13,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 61,
  'name' => 'Lingkungan Hidup',
  'slug' => 'lingkungan-hidup',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 14,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 62,
  'name' => 'Zakat dan Wakaf',
  'slug' => 'zakat-dan-wakaf',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 15,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'subject',
],
            [
  'id' => 63,
  'name' => 'Nasional',
  'slug' => 'nasional',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'territory',
],
            [
  'id' => 64,
  'name' => 'Provinsi',
  'slug' => 'provinsi',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'territory',
],
            [
  'id' => 65,
  'name' => 'Kabupaten/Kota',
  'slug' => 'kabupatenkota',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'territory',
],
            [
  'id' => 66,
  'name' => 'Internal Universitas',
  'slug' => 'internal-universitas',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'territory',
],
            [
  'id' => 67,
  'name' => 'Internal Fakultas',
  'slug' => 'internal-fakultas',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 4,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'territory',
],
            [
  'id' => 68,
  'name' => 'Internal Prodi/Unit',
  'slug' => 'internal-prodiunit',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 5,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'territory',
],
            [
  'id' => 69,
  'name' => 'Regulatif (Mengatur)',
  'slug' => 'regulatif',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 0,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'function',
],
            [
  'id' => 70,
  'name' => 'Eksekutif (Penetapan)',
  'slug' => 'eksekutif',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 1,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'function',
],
            [
  'id' => 71,
  'name' => 'Instruktif',
  'slug' => 'instruktif',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 2,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'function',
],
            [
  'id' => 72,
  'name' => 'Informatif',
  'slug' => 'informatif',
  'parent_id' => NULL,
  'description' => NULL,
  'order' => 3,
  'created_at' => '2026-04-18 09:27:49',
  'updated_at' => '2026-04-18 09:27:49',
  'information_cluster_id' => NULL,
  'type' => 'function',
],
        ]);

        // Table: tags
        DB::table('tags')->insert([
            [
  'id' => 1,
  'name' => 'uinssc',
  'slug' => 'uinssc',
  'created_at' => '2026-04-19 07:00:51',
  'updated_at' => '2026-04-19 07:00:51',
],
        ]);

        // Table: news
        DB::table('news')->insert([
            [
  'id' => 3,
  'title' => 'Fakultas Syariah UIN Siber Syekh Nurjati Cirebon Tingkatkan Digitalisasi Pengelolaan Informasi Hukum melalui Benchmarking di UIN Bandung',
  'slug' => 'fakultas-syariah-uin-siber-syekh-nurjati-cirebon-tingkatkan-digitalisasi-pengelolaan-informasi-hukum-melalui-benchmarking-di-uin-bandung',
  'content' => '<p style="text-align: justify;">UIN Siber Cirebon (Bandung) &ndash; Fakultas Syariah Universitas Islam Negeri (UIN) Siber Syekh Nurjati Cirebon, yang dikenal dengan nama Cyber Islamic University (CIU), melaksanakan kegiatan Benchmarking Komperatif dan Implementasi Program Digitalisasi Pengelolaan Informasi Hukum dan Jaringan Hukum. Acara yang berlangsung pada 14-15 November 2024 ini bertempat di Kantor Jaringan Dokumentasi dan Informasi Hukum (JDIH) Fakultas Syariah dan Hukum UIN Sunan Gunung Djati Bandung.</p>
<p style="text-align: justify;">Dekan Fakultas Syariah UIN Siber Syekh Nurjati Cirebon, Dr. H. Edy Setyawan, Lc., MA., menjelaskan bahwa kegiatan ini sangat penting dalam rangka mempelajari praktik terbaik dalam pengelolaan JDIH. &ldquo;Kami ingin memahami lebih jauh mengenai pengelolaan JDIH di UIN Bandung yang nantinya dapat diterapkan di UIN Siber, serta membuka kesempatan untuk saling berbagi ilmu terkait pengelolaan JDIH,&rdquo; ungkap Dr. Edy. Ia didampingi timnya yang terdiri dari Ahmad Khoirudin, M.H., Redy Prayuda, S.Ag., M.Pd.I., Tatang Permana, S.E., MM., Uun Sunimah, S.E., dan Firman Agung Saputra, S.E., MM., dalam kunjungan tersebut.</p>
<p style="text-align: justify;">Wakil Dekan II Fakultas Syariah dan Hukum UIN Sunan Gunung Djati Bandung, H. Ateng Ruhendi, M.Pd., menyambut baik kedatangan rombongan dari UIN Siber Cirebon. &ldquo;Kami berterima kasih atas kunjungan ini dan berharap kegiatan ini dapat memperkuat jaringan informasi hukum di antara kedua institusi,&rdquo; ujar Ateng.</p>
<p style="text-align: justify;">Dalam pemaparannya, Ketua JDIH FSH UIN Bandung, Hj. Dewi Mayaningsih, S.H., M.H., mengungkapkan pentingnya keberadaan JDIH di perguruan tinggi. &ldquo;JDIH memiliki peran penting untuk menyediakan informasi hukum yang sistematis. Saat ini, JDIH yang terintegrasi nasional di perguruan tinggi hanya ada di ITB dan UIN Sunan Gunung Djati Bandung. Kami harap, UIN Siber Syekh Nurjati Cirebon juga dapat membentuk unit JDIH yang dapat terintegrasi secara nasional,&rdquo; kata Hj. Dewi.</p>
<p style="text-align: justify;">Selain menyediakan informasi hukum yang mencakup SK, surat edaran, peraturan daerah, hingga perpres, JDIH UIN Bandung juga aktif dalam mengarsipkan dan mempublikasikan jurnal-jurnal hukum. FSH UIN Bandung bahkan memiliki ruang podcast yang secara rutin menayangkan diskusi bersama pakar hukum dan ahli lainnya di platform YouTube.</p>
<p style="text-align: justify;">Acara ini ditutup dengan penandatanganan nota kesepahaman (MoU) antara Pusat Konsultasi dan Bantuan Hukum (PKBH) UIN Siber Syekh Nurjati Cirebon dengan JDIH Fakultas Syariah dan Hukum UIN Bandung. Diharapkan, kerja sama ini akan memperkuat sinergi dalam pengelolaan dan digitalisasi informasi hukum di kedua institusi.</p>',
  'image' => 'news/pgqfMLvO8By0pbsLC9JrlBoST3SgqE8SRFBz9wif.jpg',
  'status' => 'published',
  'created_by' => 1,
  'published_at' => '2024-11-14 00:00:00',
  'created_at' => '2026-04-20 16:13:21',
  'updated_at' => '2026-04-20 16:29:15',
  'news_category_id' => 1,
  'metadata' => '{"seo_title":null,"seo_description":null,"seo_keywords":null}',
],
            [
  'id' => 4,
  'title' => 'Penandatanganan MoU antara PKBH UIN Siber Syekh Nurjati Cirebon dan JDIH UIN Sunan Gunung Djati Bandung',
  'slug' => 'penandatanganan-mou-antara-pkbh-uin-siber-syekh-nurjati-cirebon-dan-jdih-uin-sunan-gunung-djati-bandung',
  'content' => '<p style="text-align: justify;">UIN Siber Cirebon (Bandung) &ndash; Rombongan dari Universitas Islam Negeri Siber Syekh Nurjati Cirebon (UIN SSC) yang dipimpin oleh Dekan Fakultas Syariah, Dr. H. Edy Setyawan, Lc., M.Ag., beranggotakan Ketua Pusat Konsultasi dan Bantuan Hukum (PKBH) UIN SSC H. Ahmad Khoirudin, Lc., M.H., Ketua Jaringan Dokumentasi dan Informasi Hukum (JDIH) UIN SSC Wing Redy Prayuda, S.Ag., M.Pd.I., serta Tim Keuangan Fakultas, melakukan kunjungan ke Universitas Islam Negeri Sunan Gunung Djati Bandung (UIN Bandung) untuk penandatanganan Memorandum of Understanding (MoU) pada hari Kamis, 14 November 2024.</p>
<p style="text-align: justify;">Acara ini berlangsung di kantor JDIH UIN Bandung mulai pukul 09.00 hingga 12.00 WIB. Dari pihak UIN Bandung, turut hadir Dekan Fakultas Syariah dan Hukum (FSH), para Wakil Dekan, Tim JDIH, serta Tim Lembaga Bantuan Hukum dan Konsultasi (LBKH) UIN Bandung. MoU ini menandai dimulainya kerja sama antara PKBH UIN SSC dan JDIH UIN Bandung dalam bidang dokumentasi hukum dan layanan bantuan hukum.</p>
<p style="text-align: justify;">Perjanjian ini bertujuan untuk memperkuat sinergi dalam pengelolaan dan penyebaran informasi hukum serta memberikan dukungan advokasi kepada masyarakat. Dalam sambutannya, Dr. H. Edy Setyawan menyampaikan bahwa kerja sama ini merupakan langkah penting dalam meningkatkan kualitas layanan hukum yang disediakan oleh UIN SSC, sejalan dengan misi universitas dalam mendukung pengembangan hukum Islam di Indonesia.</p>
<p style="text-align: justify;">Ketua PKBH UIN SSC, H. Ahmad Khoirudin, Lc., M.H., menandatangani MoU sebagai pihak pertama, sedangkan Ketua JDIH UIN Bandung, H. Dewi Mayaningsih, S.H., M.H., bertindak atas nama pihak kedua.</p>
<p style="text-align: justify;">Nota Kesepahaman ini mencakup kerja sama dalam dokumentasi dan penyebaran informasi hukum, peningkatan kapasitas layanan melalui pelatihan dan konsultasi, advokasi hukum bagi masyarakat, penelitian kebijakan hukum, serta pemanfaatan sarana yang menunjang kegiatan hukum di kedua pihak.</p>
<p style="text-align: justify;">Diharapkan, kerja sama ini dapat mengoptimalkan tugas dan fungsi kedua pihak dalam pelayanan hukum dan dokumentasi di lingkup universitas, serta memberikan manfaat luas bagi masyarakat.</p>',
  'image' => 'news/OPU4ACtz6DirmR7KdC6w67EswHuekkUiikHDaeXp.jpg',
  'status' => 'published',
  'created_by' => 1,
  'published_at' => '2024-11-14 00:00:00',
  'created_at' => '2026-04-20 16:14:35',
  'updated_at' => '2026-04-20 16:29:46',
  'news_category_id' => 1,
  'metadata' => '{"seo_title":null,"seo_description":null,"seo_keywords":null}',
],
            [
  'id' => 5,
  'title' => 'PKBH UIN Siber Syekh Nurjati Cirebon Perkuat Integrasi JDIH dengan Dukungan BPHN Kementerian Hukum RI',
  'slug' => 'pkbh-uin-siber-syekh-nurjati-cirebon-perkuat-integrasi-jdih-dengan-dukungan-bphn-kementerian-hukum-ri',
  'content' => '<p style="text-align: justify;">UIN Siber Cirebon (Jakarta) &ndash; Pusat Konsultasi dan Bantuan Hukum (PKBH) UIN Siber Syekh Nurjati Cirebon terus berinovasi dalam mendukung transparansi hukum melalui pengembangan Jaringan Dokumentasi dan Informasi Hukum (JDIH). Dalam upaya mewujudkan integrasi sistem JDIH UIN SSC dengan Jaringan Dokumentasi dan Informasi Hukum Nasional (JDIHN) yang dikelola oleh Badan Pembinaan Hukum Nasional (BPHN), Kementerian Hukum RI, PKBH UIN SSC telah melakukan kunjungan kerja ke Pusat JDIHN pada Senin, 25 November 2024.</p>
<p style="text-align: justify;">Hadir dalam kunjungan tersebut Ketua PKBH, H. Ahmad Khoirudin, Lc., M.H., didampingi Wakil Ketua PKBH, Ahmad Dzuizzin, M.H., Sekretaris Jenderal PKBH, Ahmad Ibrizul Izzi, S.H., M.H., Bendahara PKBH, Novi Fitriani, S.H., M.H., serta Advokat PKBH, Mohammad Riski Ramadhan, S.H. Tim ini bertugas memastikan proses integrasi JDIH UIN SSC dengan aplikasi ILDIS berjalan lancar dan sesuai dengan arahan dari JDIHN BPHN Kementerian Hukum RI.</p>
<p style="text-align: justify;">Langkah ini bertujuan untuk mengintegrasikan JDIH UIN SSC dengan aplikasi ILDIS (Indonesian Legal Documentation and Information System), sehingga dapat terhubung secara resmi dengan portal JDIHN. Meski website JDIH UIN SSC belum secara resmi diluncurkan, integrasi ini merupakan pondasi awal untuk memastikan layanan informasi hukum yang terstruktur dan dapat diakses oleh masyarakat luas, termasuk civitas akademika UIN Siber Syekh Nurjati Cirebon. Website resmi JDIH UIN SSC nantinya dapat diakses melalui https://jdih.uinssc.ac.id/.</p>
<p style="text-align: justify;">Ketua PKBH, H. Ahmad Khoirudin, Lc., M.H., menjelaskan bahwa integrasi dengan JDIHN adalah langkah strategis untuk memperkuat peran UIN SSC sebagai bagian dari sistem informasi hukum di tingkat nasional. &ldquo;Dengan bergabung dalam jaringan nasional, JDIH UIN SSC akan menjadi salah satu pusat unggulan dalam penyediaan dokumentasi dan informasi hukum di lingkungan Perguruan Tinggi Keagamaan Islam Negeri (PTKIN). Kami berharap ini dapat menjadi sarana mendukung penegakan hukum berbasis data yang akurat dan terkini,&rdquo; ujarnya.</p>
<p style="text-align: justify;">Wakil Ketua PKBH, Ahmad Dzuizzin, M.H., menambahkan bahwa JDIH UIN SSC akan mengelola berbagai dokumen hukum, baik internal kampus seperti Surat Keputusan Rektor dan Dekan, maupun dokumen hukum nasional seperti peraturan perundang-undangan. &ldquo;Melalui integrasi ini, kami berharap manfaat JDIH tidak hanya dirasakan oleh civitas akademika, tetapi juga oleh masyarakat umum dan praktisi hukum,&rdquo; ungkapnya.</p>
<div>
<p style="text-align: justify;">Kunjungan ke Pusat JDIHN ini dihadiri oleh sejumlah pejabat penting dari JDIHN Pusat yang turut memberikan arahan dan masukan teknis untuk pengembangan JDIH UIN SSC. Program ini didukung penuh oleh Fakultas Syariah UIN Siber Syekh Nurjati Cirebon yang akan membentuk struktur organisasi khusus untuk memastikan pengelolaan JDIH berjalan optimal. Dekan Fakultas Syariah, Dr. H. Edy Setyawan, Lc., M.Ag., menyampaikan bahwa digitalisasi informasi hukum adalah langkah penting dalam mendukung visi kampus sebagai pusat unggulan ilmu hukum berbasis digital.</p>
<p style="text-align: justify;">Kolaborasi ini diharapkan mampu meningkatkan kualitas pengelolaan informasi hukum di PTKIN dan memberikan manfaat luas bagi pembangunan hukum di Indonesia.</p>
</div>',
  'image' => 'news/k5NVFaKq8DX2jifIVuJiNyoKnAQNthLz5WLYW59N.jpg',
  'status' => 'published',
  'created_by' => 1,
  'published_at' => '2024-11-25 00:00:00',
  'created_at' => '2026-04-20 16:15:27',
  'updated_at' => '2026-04-20 16:26:54',
  'news_category_id' => 1,
  'metadata' => '{"seo_title":null,"seo_description":null,"seo_keywords":null}',
],
        ]);

        // Table: documents
        DB::table('documents')->insert([
            [
  'id' => 1,
  'title' => '<p style="text-align:justify">PENERAPAN APLIKASI E-TUGAS AKHIR (ETA) SEBAGAI APLIKASI PENGELOLAAN TUGAS AKHIR MAHASISWA UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON TAHUN 2026</p>',
  'slug' => 'penerapan-aplikasi-e-tugas-akhir-eta-sebagai-aplikasi-pengelolaan-tugas-akhir-mahasiswa-universitas-islam-negeri-siber-syekh-nurjati-cirebon-tahun-2026-4182',
  'number' => '1075',
  'year' => 2026,
  'category_id' => 2,
  'status' => 'published',
  'file_path' => 'documents/KdbT7YpLtiJOf35k4mNHYbYvJunupRksIdVnEZPB.pdf',
  'created_by' => 1,
  'published_at' => '2026-04-13 05:56:59',
  'view_count' => 37,
  'download_count' => 0,
  'metadata' => NULL,
  'created_at' => '2026-04-13 05:34:45',
  'updated_at' => '2026-04-20 03:57:47',
  'deleted_at' => NULL,
  'tanggal_penetapan' => '2026-04-01 00:00:00',
  'tanggal_pengundangan' => '2026-04-01 00:00:00',
  'abstrak' => '<p style="text-align:justify">Keputusan Rektor Universitas Islam Negeri Siber Syekh Nurjati Cirebon tentang Penerapan Aplikasi Etugas Akhir (ETA) sebagai aplikasi pengelolaan tugas akhir mahasiswa Universitas Islam Negeri Siber Syekh Nurjati Cirebon tahun 2026</p>',
  'content_html' => NULL,
  'legal_status' => 'active',
  'access_level' => 'public',
  'territory_level' => 'internal',
  'document_function' => 'regulative',
  'subject_id' => NULL,
  'territory_id' => NULL,
  'function_id' => NULL,
],
            [
  'id' => 2,
  'title' => '<p>Tes</p>',
  'slug' => 'ptesp-8175',
  'number' => '123',
  'year' => 2026,
  'category_id' => 2,
  'status' => 'published',
  'file_path' => 'documents/VuhhQor8RuwDe7fAtvsuvCC75jOeW9VvzpLQLguB.pdf',
  'created_by' => 1,
  'published_at' => '2026-04-13 06:32:32',
  'view_count' => 7,
  'download_count' => 0,
  'metadata' => NULL,
  'created_at' => '2026-04-13 06:32:32',
  'updated_at' => '2026-04-19 20:38:59',
  'deleted_at' => '2026-04-19 20:38:59',
  'tanggal_penetapan' => '2026-04-02 00:00:00',
  'tanggal_pengundangan' => '2026-04-02 00:00:00',
  'abstrak' => '<p>Tes</p>',
  'content_html' => NULL,
  'legal_status' => 'active',
  'access_level' => 'public',
  'territory_level' => 'internal',
  'document_function' => 'regulative',
  'subject_id' => NULL,
  'territory_id' => NULL,
  'function_id' => NULL,
],
            [
  'id' => 3,
  'title' => '<p>Tes</p>',
  'slug' => 'ptesp-1702',
  'number' => NULL,
  'year' => 2026,
  'category_id' => 21,
  'status' => 'published',
  'file_path' => 'documents/5nhHRHy9rA6u3152fn0jBmQiZNpaCUXQTnTNWKgX.pdf',
  'created_by' => 1,
  'published_at' => NULL,
  'view_count' => 0,
  'download_count' => 0,
  'metadata' => NULL,
  'created_at' => '2026-04-18 09:50:11',
  'updated_at' => '2026-04-19 20:38:59',
  'deleted_at' => '2026-04-19 20:38:59',
  'tanggal_penetapan' => '2026-04-18 00:00:00',
  'tanggal_pengundangan' => '2026-04-18 00:00:00',
  'abstrak' => '<p>Tes</p>',
  'content_html' => '<p>Tes</p>',
  'legal_status' => 'active',
  'access_level' => 'public',
  'territory_level' => 'internal',
  'document_function' => 'regulative',
  'subject_id' => 57,
  'territory_id' => 66,
  'function_id' => 69,
],
            [
  'id' => 4,
  'title' => '<p style="text-align: justify;">PENGGUNAAN PLATFORM eTA (TUGAS AKHIR) UINSSC DI LINGKUNGAN PROGRAM STUDI PENDIDIKAN JARAK JAUH UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON</p>',
  'slug' => 'penggunaan-platform-eta-tugas-akhir-uinssc-di-lingkungan-program-studi-pendidikan-jarak-jauh-universitas-islam-negeri-siber-syekh-nurjati-cirebon-9354',
  'number' => '1124',
  'year' => 2026,
  'category_id' => 21,
  'status' => 'published',
  'file_path' => 'documents/EDefhNSiHFCACYI13HwRrpk78uqpnHSBat8uiFOu.pdf',
  'created_by' => 1,
  'published_at' => NULL,
  'view_count' => 23,
  'download_count' => 2,
  'metadata' => NULL,
  'created_at' => '2026-04-20 03:46:20',
  'updated_at' => '2026-04-20 14:37:50',
  'deleted_at' => NULL,
  'tanggal_penetapan' => '2026-04-07 00:00:00',
  'tanggal_pengundangan' => '2026-04-07 00:00:00',
  'abstrak' => '<p style="text-align: justify;">Menetapkan : KEPUTUSAN REKTOR UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON TENTANG PENGGUNAAN PLATFORM ETA (ELECTRONIC TUGAS AKHIR) SEBAGAI SISTEM RESMI DALAM PENGELOLAAN TUGAS AKHIR MAHASISWA DI LINGKUNGAN PROGRAM STUDI PENDIDIKAN JARAK JAUH UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON.</p>',
  'content_html' => 'KEPUTUSAN REKTOR UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON NOMOR 1124 TAHUN 2026 TENTANG PENGGUNAAN PLATFORM eTA (TUGAS AKHIR) UINSSC DI LINGKUNGAN PROGRAM STUDI PENDIDIKAN JARAK JAUH UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON DENGAN RAHMAT TUHAN YANG MAHA ESA REKTOR UIN SIBER SYEKH NURJATI CIREBON Menimbang : a. Bahwa dalam rangka meningkatkan kualitas layanan akademik khususnya pengelolaan tugas akhir mahasiswa secara digital, transparan, dan terintegrasi, diperlukan sistem yang mendukung; b. Bahwa platform eTa (electronic Tugas Akhir) merupakan platform resmi untuk pengelolaan administrasi dan proses akademik tugas akhir di lingkungan UINSSC; c. Bahwa untuk menjamin tertib administrasi, efektivitas, dan akuntabilitas pelaksanaan tugas akhir pada Program Studi Pendidikan Jarak Jauh, perlu ditetapkan kebijakan penggunaan platform eTa; d. Bahwa berdasarkan pertimbangan sebagaimana dimaksud pada huruf a, b, dan c, perlu menetapkan Surat Keputusan Rektor tentang Penggunaan Platform eTa di Lingkungan Program Studi Pendidikan Jarak Jauh UINSSC. Mengingat : 1. Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional; 2. Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi; 3. Peraturan Pemerintah Nomor 04 Tahun 2014, tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi; 4. Keputusan Menteri Agama RI Nomor 871 Tahun 2021 tentang Izin Penyelenggaraan Program Studi Pendidikan Jarak Jauh Pendidikan Agama Islam Program Sarjana pada IAIN Syekh Nurjati Cirebon; 5. Peraturan Menteri Agama Nomor 31 Tahun 2024, tentang Organisasi dan Tata Kerja Universitas Islam Negeri Siber Syekh Nurjati Cirebon; 6. Peraturan Presiden RI Nomor 60 Tahun 2024 tentang Universitas Islam Negeri Siber Syekh Nurjati Cirebon; 7. Keputusan Dirjen Pendis No. 1175 Tahun 2021 tentang Penetapan Institut Agama Islam Negeri Syekh Nurjati Cirebon sebagai Pilot Project Perguruan Tinggi Agama Islam Berbasis Siber (Digital University); M E M U T U S K A N Menetapkan : KEPUTUSAN REKTOR UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON TENTANG PENGGUNAAN PLATFORM ETA (ELECTRONIC TUGAS AKHIR) SEBAGAI SISTEM RESMI DALAM PENGELOLAAN TUGAS AKHIR MAHASISWA DI LINGKUNGAN PROGRAM STUDI PENDIDIKAN JARAK JAUH UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON. KESATU : Menetapkan Penggunaan Platform eTA (electronic Tugas Akhir) Sebagai Sistem Resmi dalam Pengelolaan Tugas Akhir Mahasiswa di Lingkungan Program Studi Pendidikan Jarak Jauh yang dapat diakses pada laman https://ta.uinssc.ac.id/. KEDUA : Platform eTa digunakan untuk seluruh proses tugas akhir, meliputi: 1. Pengajuan judul tugas akhir; 2. Penetapan dosen pembimbing; 3. Proses bimbingan; 4. Monitoring kemajuan tugas akhir; 5. Pengajuan ujian komprehensif; 6. Pengajuan ujian tugas akhir; 7. Penilaian dan administrasi kelulusan. Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan Balai Besar Sertifikasi Elektronik (BBSrE). Token : VouIE9Uq KETIGA : Dosen pembimbing wajib: 1. Melakukan pembimbingan melalui aplikasi eTa; 2. Memberikan persetujuan dan catatan bimbingan dalam sistem; 3. Melakukan evaluasi kemajuan mahasiswa secara berkala. KEEMPAT : Mahasiswa wajib: 1. Menggunakan aplikasi eTa dalam seluruh proses administrasi dan akademik tugas akhir; 2. Mengunggah dokumen yang diperlukan secara lengkap dan tepat waktu; 3. Memantau perkembangan tugas akhir melalui sistem. KELIMA : Pengelola program studi wajib: 1. Mengelola data tugas akhir melalui aplikasi eTa; 2. Melakukan verifikasi administrasi; 3. Melakukan monitoring dan evaluasi pelaksanaan tugas akhir. KEENAM : Pustikom bertanggung jawab atas: 1. Pengembangan dan pemeliharaan eTa; 2. Keamanan data dan sistem; 3. Dukungan teknis kepada pengguna; 4. Pelatihan penggunaan platform. KETUJUH : Keputusan ini berlaku sejak tanggal ditetapkan, dengan ketentuan apabila terdapat kekeliruan akan diadakan perubahan dan perbaikan sebagaimana mestinya. Ditetapkan di : CIREBON Pada Tanggal : 7 April 2026 REKTOR, ^ AAN JAELANI Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan Balai Besar Sertifikasi Elektronik (BBSrE). Token : VouIE9Uq',
  'legal_status' => 'active',
  'access_level' => 'public',
  'territory_level' => 'internal',
  'document_function' => 'regulative',
  'subject_id' => 57,
  'territory_id' => 66,
  'function_id' => 69,
],
        ]);

        // Table: pages
        DB::table('pages')->insert([
            [
  'id' => 1,
  'slug' => 'tentang',
  'title' => 'Tentang JDIH UINSSC',
  'content' => '<div class="space-y-12" style="text-align: justify;"><!-- Formal Intro (Justified) -->
<div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300">
<p style="text-align: justify;"><strong class="text-islami font-bold">Jaringan Dokumentasi dan Informasi Hukum (JDIH) UIN Siber Syekh Nurjati Cirebon</strong> merupakan wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan. Sistem ini dibangun sebagai wujud nyata komitmen universitas dalam menyelenggarakan tata kelola perguruan tinggi yang baik (<em>Good University Governance</em>), transparan, dan akuntabel di era transformasi digital.</p>
<p style="text-align: justify;">Pembentukan JDIH di lingkungan UIN Siber Syekh Nurjati Cirebon ini merupakan amanat dan bentuk kepatuhan institusional terhadap <strong>Peraturan Presiden Nomor 33 Tahun 2012</strong> tentang Jaringan Dokumentasi dan Informasi Hukum Nasional (JDIHN), serta regulasi turunan di bawah Kementerian Agama Republik Indonesia yang mewajibkan ketersediaan pangkalan data hukum yang valid dan terintegrasi.</p>
</div>
<!-- Legal Basis Grid -->
<div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 not-prose" style="text-align: justify;">
<h3 class="text-xl font-bold mb-6 text-slate-900 dark:text-white border-l-4 border-islami pl-4 drop-shadow-sm">Landasan Hukum &amp; Operasional</h3>
<ul class="space-y-5 text-justify text-slate-600 dark:text-slate-400">
<li class="flex items-start gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
<div class="bg-green-100 dark:bg-green-900/50 p-2 rounded-lg text-islami shrink-0">&nbsp;</div>
<span class="mt-1 leading-relaxed"><strong>Undang-Undang Nomor 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik.</span></li>
<li class="flex items-start gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
<div class="bg-green-100 dark:bg-green-900/50 p-2 rounded-lg text-islami shrink-0">&nbsp;</div>
<span class="mt-1 leading-relaxed"><strong>Peraturan Presiden Nomor 33 Tahun 2012</strong> tentang Jaringan Dokumentasi dan Informasi Hukum Nasional.</span></li>
<li class="flex items-start gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
<div class="bg-green-100 dark:bg-green-900/50 p-2 rounded-lg text-islami shrink-0">&nbsp;</div>
<span class="mt-1 leading-relaxed"><strong>Peraturan Menteri Agama (PMA) Nomor 27 Tahun 2013</strong> tentang Jaringan Dokumentasi dan Informasi Hukum Kementerian Agama.</span></li>
<li class="flex items-start gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
<div class="bg-green-100 dark:bg-green-900/50 p-2 rounded-lg text-islami shrink-0">&nbsp;</div>
<span class="mt-1 leading-relaxed"><strong>Statuta dan Peraturan Rektor</strong> UIN Siber Syekh Nurjati Cirebon sebagai pengikat internal sivitas akademika.</span></li>
</ul>
</div>
<!-- Objectives (Justified) -->
<div>
<h2 class="text-2xl font-black text-slate-900 dark:text-white mb-6 border-b pb-3" style="text-align: justify;">Tujuan dan Layanan Utama</h2>
<div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300">
<p style="text-align: justify;">Sebagai garda terdepan pelestarian dokumen regulasi, pusat informasi ini berfungsi untuk memberikan layanan dokumentasi hukum yang terstruktur, akurat, dan terbuka. JDIH menjembatani kebutuhan para pimpinan, pendidik, birokrat, hingga periset regulasi dengan menyajikan instrumen berupa:</p>
<div class="grid sm:grid-cols-2 gap-y-4 gap-x-8 my-8 font-semibold pt-6 border-t border-slate-200 dark:border-slate-700 not-prose" style="text-align: justify;">
<div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700">Peraturan &amp; Keputusan Rektor</div>
<div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700">Keputusan Senat Akademik</div>
<div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700">Standar Operasional Prosedur (SOP)</div>
<div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700">MoU / MoA (Kerjasama Lintas Sektor)</div>
<div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700">Surat Edaran &amp; Instruksi Pimpinan</div>
<div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700">SK dan Peraturan Setingkat Fakultas</div>
</div>
<p style="text-align: justify;">Di tengah akselerasi Universitas Islam Negeri (UIN) Siber Syekh Nurjati Cirebon sebagai institusi pendidikan berbasis siber lintas dunia kelas wahid (<em>World Class Cyber University</em>), infrastruktur JDIH ini terus melangkah dengan pemanfaatan teknologi mesin pencari (<em>search engine</em>) agar senantiasa merangkul terciptanya tata kelola kampus yang taat asas, patuh pada hukum, serta anti plagiarisme pijakan aturan demi Indonesia yang lebih baik.</p>
</div>
</div>
</div>',
  'metadata' => '{"seo_title":null,"seo_description":null,"seo_keywords":null}',
  'created_at' => '2026-04-18 14:57:04',
  'updated_at' => '2026-04-19 19:56:01',
  'image' => NULL,
],
            [
  'id' => 2,
  'slug' => 'visi-misi',
  'title' => 'Visi dan Misi',
  'content' => '<div class="space-y-12">
    <div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-700 pb-3 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-green-100 text-islami flex items-center justify-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></div>
            Visi
        </h2>
        <div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300">
            <blockquote class="border-l-4 border-islami bg-slate-50 dark:bg-slate-800/50 p-6 rounded-r-2xl italic font-medium">
                "Terwujudnya Jaringan Dokumentasi dan Informasi Hukum yang Unggul, Inovatif, Terintegrasi, dan Berbasis Siber dalam Mendukung Universitas Islam Negeri (UIN) Siber Syekh Nurjati Cirebon sebagai World Class Cyber University."
            </blockquote>
        </div>
    </div>
    <div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-700 pb-3 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
            Misi
        </h2>
        <div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300 pl-4">
            <ol class="space-y-4 list-decimal marker:text-islami marker:font-bold">
                <li><strong>Membangun Infrastruktur Digital:</strong> Menyediakan pangkalan data hukum (*database*) yang andal, aman, dan dapat diakses dengan mudah oleh sivitas akademika maupun publik.</li>
                <li><strong>Meningkatkan Kualitas Regulasi:</strong> Mendukung ketersediaan instrumen hukum yang autentik, mutakhir, dan bebas dari duplikasi atau ketidakjelasan aturan.</li>
                <li><strong>Optimalisasi Pelayanan:</strong> Memberikan layanan informasi hukum secara prima yang menjunjung tinggi efisiensi birokrasi, ketepatan, dan kemudahan literasi.</li>
                <li><strong>Sinergi Antar Lembaga:</strong> Meningkatkan koordinasi dengan pusat JDIH Kementerian Agama Republik Indonesia dan Badan Pembinaan Hukum Nasional guna terciptanya keselarasan hukum skala nasional.</li>
            </ol>
        </div>
    </div>
</div>',
  'metadata' => NULL,
  'created_at' => '2026-04-18 14:57:04',
  'updated_at' => '2026-04-18 16:06:15',
  'image' => NULL,
],
            [
  'id' => 3,
  'slug' => 'komitmen-pelayanan',
  'title' => 'Komitmen Pelayanan',
  'content' => '<div class="space-y-8">
    <div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300">
        <p>
            Segenap pengelola Jaringan Dokumentasi dan Informasi Hukum (JDIH) UIN Siber Syekh Nurjati Cirebon memiliki integritas dan komitmen penuh untuk memberikan pelayanan publik di bidang dokumentasi dan informasi hukum dengan standar tertinggi.
        </p>
        <p>
            Maklumat ini merupakan bentuk keseriusan kami dalam membangun <em>Good University Governance</em> yang transparan dan akuntabel. Kami berjanji untuk secara berkesinambungan menjaga mutu birokrasi dan melayani permintaan informasi regulasi perundang-undangan dengan prinsip utama:
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mt-6 not-prose">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm flex flex-col items-start gap-4">
            <div class="text-islami bg-green-50 dark:bg-green-900/30 p-4 rounded-2xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-2">Cepat dan Responsif</h4>
                <p class="text-slate-600 dark:text-slate-400 text-justify text-sm leading-relaxed">Merespons permintaan salinan dokumen produk hukum dan menyajikan koleksi regulasi secara daring (*real-time*) melalui ekosistem portal siber digital.</p>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm flex flex-col items-start gap-4">
            <div class="text-blue-600 bg-blue-50 dark:bg-blue-900/30 p-4 rounded-2xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg></div>
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-2">Akurat dan Valid</h4>
                <p class="text-slate-600 dark:text-slate-400 text-justify text-sm leading-relaxed">Menjamin keaslian dan kemutakhiran setiap produk hukum yang diunggah ke dalam sistem pangkalan data, bebas dari unsur rekayasa maupun kesalahan administrasi.</p>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm flex flex-col items-start gap-4">
            <div class="text-amber-600 bg-amber-50 dark:bg-amber-900/30 p-4 rounded-2xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-2">Tanpa Diskriminasi</h4>
                <p class="text-slate-600 dark:text-slate-400 text-justify text-sm leading-relaxed">Memberikan pelayanan keadilan prima kepada semua pendidik, pimpinan, tenaga kependidikan, serta periset luas tanpa terkecuali.</p>
            </div>
        </div>
    </div>
</div>',
  'metadata' => NULL,
  'created_at' => '2026-04-18 14:57:04',
  'updated_at' => '2026-04-18 16:06:15',
  'image' => NULL,
],
            [
  'id' => 4,
  'slug' => 'pengelola',
  'title' => 'Pengelola JDIH',
  'content' => '<div class="space-y-8">
    <div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300">
        <p>
            Sistem pangkalan data JDIH UIN Siber Syekh Nurjati Cirebon berada di bawah koordinasi mutlak pihak Rektorat. Secara fungsional, pengelolaan operasional dikomandoi langsung oleh Biro Administrasi untuk menjamin keabsahan dan pemeliharaan aplikasi hukum secara sistematis. Berdasarkan hierarki tata pamong pada tubuh universitas, struktur manajerial ditetapkan sebagai berikut:
        </p>
    </div>
    
    <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-700 not-prose">
        <h3 class="text-xl font-bold mb-8 text-slate-900 dark:text-white text-center tracking-tight">Struktur Manajemen Terpadu</h3>
        <div class="flex flex-col gap-5 max-w-2xl mx-auto">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm text-center">
                <div class="text-[10px] uppercase tracking-widest text-slate-400 font-black mb-1">Pengarah Utama & Pembina</div>
                <div class="text-lg font-black text-islami uppercase tracking-tight">Rektor UIN Siber Syekh Nurjati Cirebon</div>
            </div>
            
            <div class="w-px h-6 bg-slate-300 dark:bg-slate-600 mx-auto"></div>
            
            <div class="grid sm:grid-cols-2 gap-5">
                <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm text-center">
                    <div class="text-[10px] uppercase tracking-widest text-slate-400 font-black mb-1">Penanggung Jawab</div>
                    <div class="text-sm leading-relaxed font-bold text-slate-800 dark:text-slate-200">Wakil Rektor Bidang Administrasi Umum, Perencanaan, dan Keuangan</div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm text-center">
                    <div class="text-[10px] uppercase tracking-widest text-slate-400 font-black mb-1">Koordinator Pelaksana</div>
                    <div class="text-sm leading-relaxed font-bold text-slate-800 dark:text-slate-200">Kepala Biro Administrasi Umum, Akademik, dan Kemahasiswaan (AUAK)</div>
                </div>
            </div>
            
            <div class="w-px h-6 bg-slate-300 dark:bg-slate-600 mx-auto"></div>
            
            <div class="bg-gradient-to-r from-islami to-[#128a4f] p-6 rounded-3xl shadow-lg text-center transform hover:scale-[1.02] transition-transform">
                <div class="text-[10px] uppercase tracking-widest text-green-200 font-black mb-1">Implementasi Sistem & Keamanan Siber</div>
                <div class="text-sm leading-relaxed font-bold text-white">Tim Pelaksana JDIH bersama Pusat Teknologi Informasi Pangkalan Data (PTIPD)</div>
            </div>
        </div>
    </div>
</div>',
  'metadata' => NULL,
  'created_at' => '2026-04-18 14:57:04',
  'updated_at' => '2026-04-18 16:06:15',
  'image' => NULL,
],
            [
  'id' => 5,
  'slug' => 'kontak',
  'title' => 'Pusat Layanan dan Kontak',
  'content' => '<div class="space-y-8">
    <div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300">
        <p>
            Apabila Anda memerlukan bantuan administratif lanjutan dalam mengakses produk hukum tertentu, pelaporan terhadap dokumen rekayasa, maupun permohonan penerbitan informasi hukum spesifik di luar jaringan portal ini, Anda dipersilakan untuk menghubungi dewan pengelola JDIH. Tim korespondensi kami senantiasa bersiaga menyambut setiap pertanyaan, masukan, maupun aduan demi ekosistem siber yang lebih progresif.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-6 mt-8 not-prose">
        <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm">
            <h3 class="text-xl font-bold mb-6 text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-4">Gerbang Korespondensi</h3>
            <ul class="space-y-6">
                <li class="flex items-start gap-4 group">
                    <div class="bg-green-50 dark:bg-green-900/30 p-3 rounded-2xl text-islami shrink-0 group-hover:bg-islami group-hover:text-white transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                    <div>
                        <div class="font-bold text-slate-900 dark:text-white mb-1 uppercase tracking-widest text-[10px]">Alamat Domisili Institusi</div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed text-justify">Gedung Pusat Administrasi Biro (Rektorat)<br>UIN Siber Syekh Nurjati Cirebon<br>Jl. Perjuangan By Pass Sunyaragi, Kesambi, Kota Cirebon, Jawa Barat – Kodepos 45131</div>
                    </div>
                </li>
                <li class="flex items-center gap-4 group">
                    <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-2xl text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></div>
                    <div>
                        <div class="font-bold text-slate-900 dark:text-white mb-1 uppercase tracking-widest text-[10px]">Surat Elektronik (Email)</div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm"><a href="mailto:info@syekhnurjati.ac.id" class="hover:text-islami font-medium">info@syekhnurjati.ac.id</a></div>
                    </div>
                </li>
                <li class="flex items-center gap-4 group">
                    <div class="bg-amber-50 dark:bg-amber-900/30 p-3 rounded-2xl text-amber-600 shrink-0 group-hover:bg-amber-600 group-hover:text-white transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg></div>
                    <div>
                        <div class="font-bold text-slate-900 dark:text-white mb-1 uppercase tracking-widest text-[10px]">Narahubung Sentral</div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm font-medium">(0231) 481264</div>
                    </div>
                </li>
            </ul>
        </div>
        
        <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-200 dark:border-slate-700">
            <h3 class="text-xl font-bold mb-6 text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-700 pb-4">Waktu Operasional Luring</h3>
            <div class="space-y-4 text-justify text-sm">
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-6">
                    Meskipun portal siber ini berjalan mulus secara virtual <strong class="text-islami">24 jam di udara</strong>, jadwal operasional tatap muka pada sentra pangkalan data administrasi fisik (Rektorat) mengikuti penetapan dinas resmi kepegawaian institusi.
                </p>
                <div class="flex justify-between items-center bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <span class="font-bold text-slate-700 dark:text-slate-300">Senin - Kamis</span>
                    <span class="text-islami font-black">08:00 - 16:00 WIB</span>
                </div>
                <div class="flex justify-between items-center bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <span class="font-bold text-slate-700 dark:text-slate-300">Jumat</span>
                    <span class="text-blue-600 font-black">08:30 - 16:30 WIB</span>
                </div>
                <div class="flex justify-between items-center bg-red-50 dark:bg-red-900/10 p-5 rounded-2xl border border-red-100 dark:border-red-900/30 text-red-600 shadow-[inset_0_0_10px_rgba(0,0,0,0.02)]">
                    <span class="font-bold uppercase tracking-widest text-xs">Sabtu, Minggu &amp; Libur Nasional</span>
                    <span class="font-black uppercase tracking-widest text-xs">Birokrasi Tutup</span>
                </div>
            </div>
        </div>
    </div>
</div>',
  'metadata' => NULL,
  'created_at' => '2026-04-18 14:57:04',
  'updated_at' => '2026-04-19 07:11:44',
  'image' => NULL,
],
        ]);

        // Table: menus
        DB::table('menus')->insert([
            [
  'id' => 4,
  'label' => 'Profil',
  'url' => '#',
  'type' => 'custom',
  'model_id' => NULL,
  'location' => 'main',
  'parent_id' => NULL,
  'order' => 1,
  'target' => '_self',
  'created_at' => '2026-04-20 02:28:54',
  'updated_at' => '2026-04-20 02:28:54',
],
            [
  'id' => 5,
  'label' => 'Tentang JDIH UINSSC',
  'url' => '/tentang',
  'type' => 'page',
  'model_id' => 1,
  'location' => 'main',
  'parent_id' => 4,
  'order' => 0,
  'target' => '_self',
  'created_at' => '2026-04-20 02:29:03',
  'updated_at' => '2026-04-20 03:04:58',
],
            [
  'id' => 6,
  'label' => 'Visi dan Misi',
  'url' => '/visi-misi',
  'type' => 'page',
  'model_id' => 2,
  'location' => 'main',
  'parent_id' => 4,
  'order' => 1,
  'target' => '_self',
  'created_at' => '2026-04-20 02:29:12',
  'updated_at' => '2026-04-20 03:04:58',
],
            [
  'id' => 7,
  'label' => 'Komitmen Pelayanan',
  'url' => '/komitmen-pelayanan',
  'type' => 'page',
  'model_id' => 3,
  'location' => 'main',
  'parent_id' => 4,
  'order' => 2,
  'target' => '_self',
  'created_at' => '2026-04-20 02:29:20',
  'updated_at' => '2026-04-20 03:04:58',
],
            [
  'id' => 8,
  'label' => 'Pengelola JDIH',
  'url' => '/pengelola',
  'type' => 'page',
  'model_id' => 4,
  'location' => 'main',
  'parent_id' => 4,
  'order' => 3,
  'target' => '_self',
  'created_at' => '2026-04-20 02:29:25',
  'updated_at' => '2026-04-20 03:04:58',
],
            [
  'id' => 9,
  'label' => 'Pusat Layanan dan Kontak',
  'url' => '/kontak',
  'type' => 'page',
  'model_id' => 5,
  'location' => 'main',
  'parent_id' => 4,
  'order' => 4,
  'target' => '_self',
  'created_at' => '2026-04-20 02:29:32',
  'updated_at' => '2026-04-20 03:04:58',
],
            [
  'id' => 10,
  'label' => 'Produk Hukum',
  'url' => '/dokumen',
  'type' => 'module',
  'model_id' => NULL,
  'location' => 'main',
  'parent_id' => NULL,
  'order' => 2,
  'target' => '_self',
  'created_at' => '2026-04-20 02:34:57',
  'updated_at' => '2026-04-20 03:03:13',
],
            [
  'id' => 11,
  'label' => 'Berita',
  'url' => '/berita/kategori/berita-dan-informasi',
  'type' => 'news_category',
  'model_id' => 1,
  'location' => 'main',
  'parent_id' => NULL,
  'order' => 3,
  'target' => '_self',
  'created_at' => '2026-04-20 02:44:40',
  'updated_at' => '2026-04-20 08:07:32',
],
            [
  'id' => 12,
  'label' => 'FAQs',
  'url' => '/faq',
  'type' => 'module',
  'model_id' => NULL,
  'location' => 'main',
  'parent_id' => NULL,
  'order' => 4,
  'target' => '_self',
  'created_at' => '2026-04-20 02:45:22',
  'updated_at' => '2026-04-20 03:03:13',
],
            [
  'id' => 14,
  'label' => 'Beranda',
  'url' => '/',
  'type' => 'module',
  'model_id' => NULL,
  'location' => 'main',
  'parent_id' => NULL,
  'order' => 0,
  'target' => '_self',
  'created_at' => '2026-04-20 02:47:43',
  'updated_at' => '2026-04-20 03:03:13',
],
            [
  'id' => 15,
  'label' => 'Feedback',
  'url' => '/survey',
  'type' => 'module',
  'model_id' => NULL,
  'location' => 'main',
  'parent_id' => NULL,
  'order' => 5,
  'target' => '_self',
  'created_at' => '2026-04-20 08:07:37',
  'updated_at' => '2026-04-20 08:11:05',
],
        ]);

        // Table: faqs
        DB::table('faqs')->insert([
            [
  'id' => 1,
  'question' => 'Apa itu JDIH?',
  'answer' => 'JDIH (Jaringan Dokumentasi dan Informasi Hukum) adalah wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan.',
  'order' => 1,
  'is_published' => 1,
  'created_at' => '2026-04-18 09:19:43',
  'updated_at' => '2026-04-18 09:19:43',
],
            [
  'id' => 2,
  'question' => 'Bagaimana cara mencari dokumen hukum?',
  'answer' => 'Anda dapat menggunakan fitur pencarian di halaman utama dengan memasukkan kata kunci, nomor dokumen, atau tahun.',
  'order' => 2,
  'is_published' => 1,
  'created_at' => '2026-04-18 09:19:43',
  'updated_at' => '2026-04-18 09:19:43',
],
            [
  'id' => 3,
  'question' => 'Apakah dokumen hukum dapat diunduh?',
  'answer' => 'Ya, sebagian besar dokumen hukum yang tersedia di JDIH dapat diunduh dalam format PDF secara gratis.',
  'order' => 3,
  'is_published' => 1,
  'created_at' => '2026-04-18 09:19:43',
  'updated_at' => '2026-04-18 09:19:43',
],
            [
  'id' => 4,
  'question' => 'Bagaimana jika saya tidak menemukan dokumen yang dicari?',
  'answer' => 'Anda dapat menghubungi admin melalui fitur feedback atau menu kontak yang tersedia untuk menanyakan ketersediaan dokumen tersebut.',
  'order' => 4,
  'is_published' => 1,
  'created_at' => '2026-04-18 09:19:43',
  'updated_at' => '2026-04-18 09:19:43',
],
        ]);

        // Table: feedbacks
        DB::table('feedbacks')->insert([
            [
  'id' => 4,
  'name' => 'Riyanto',
  'email' => 'riyanto@uinssc.ac.id',
  'rating' => 5,
  'comment' => 'Mantap sekali',
  'created_at' => '2026-04-20 08:08:52',
  'updated_at' => '2026-04-20 08:08:52',
  'profession' => 'Dosen / Pegawai',
  'subject' => 'Mantap',
],
        ]);

        // Table: document_tag
        DB::table('document_tag')->insert([
            [
  'document_id' => 4,
  'tag_id' => 1,
],
        ]);

        // Table: news_tag
        DB::table('news_tag')->insert([
            [
  'id' => 2,
  'news_id' => 3,
  'tag_id' => 1,
  'created_at' => NULL,
  'updated_at' => NULL,
],
            [
  'id' => 3,
  'news_id' => 4,
  'tag_id' => 1,
  'created_at' => NULL,
  'updated_at' => NULL,
],
            [
  'id' => 4,
  'news_id' => 5,
  'tag_id' => 1,
  'created_at' => NULL,
  'updated_at' => NULL,
],
        ]);
    }
}
