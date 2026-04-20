# JDIH UIN Siber Syekh Nurjati Cirebon

![JDIH Banner](public/jdih_hero_banner.png)

Portal Jaringan Dokumentasi dan Informasi Hukum (JDIH) resmi UIN Siber Syekh Nurjati Cirebon. Aplikasi ini dirancang untuk menyediakan akses transparan dan cepat terhadap produk hukum, regulasi, dan informasi hukum kampus yang terintegrasi secara nasional.

## ✨ Fitur Utama

- **Modern Dashboard & Statistics**: Visualisasi data riil menggunakan Chart.js untuk memantau popularitas dokumen dan statistik pengunjung harian, bulanan, dan tahunan.
- **AI Assistant Chatbot**: Asisten pintar berbasis AI yang siap menjawab pertanyaan seputar produk hukum dan proses bisnis di lingkungan UIN SSC.
- **Accessibility Module**: Fitur ramah disabilitas termasuk Text-to-Speech (TTS), pengaturan kontras, dan pembesaran teks.
- **National Integration (JDIHN)**: Menyediakan API endpoint standar BPHN untuk sinkronisasi data otomatis dengan JDIH Nasional.
- **Advanced Document Management**: Manajemen dokumen hukum dengan fitur pencarian cepat (Meilisearch), klasifikasi kategori, dan riwayat revisi.
- **Full SEO Optimized**: Metadata otomatis untuk setiap berita dan dokumen guna meningkatkan keterlihatan di mesin pencari.

## 🚀 Teknologi yang Digunakan

- **Backend**: Laravel 12.x
- **Frontend**: Tailwind CSS, Vanilla JS, Lucide Icons
- **Database**: SQLite / MySQL
- **Charts**: Chart.js 4.x
- **Search Engine**: Laravel Scout & Meilisearch
- **Assets**: Vite

## 🛠️ Panduan Instalasi Lokal

1. **Clone Repository**
   ```bash
   git clone https://github.com/riyantoabuwinner/jdih.git
   cd jdih
   ```

2. **Instal Dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Lingkungan**
   Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi & Seeding**
   Aplikasi ini dilengkapi dengan seeder data produksi yang lengkap.
   ```bash
   php artisan migrate
   php artisan db:seed --class=FinalSeeder
   ```

5. **Jalankan Aplikasi**
   ```bash
   npm run build
   php artisan serve
   ```

## 📖 Panduan Admin

Akses halaman admin melalui `/login` menggunakan akun yang telah terdaftar di `UserSeeder` atau `FinalSeeder`.

- **Unggah Dokumen**: Masuk ke menu "Manajemen Dokumen" > "Tambah Baru". Pastikan mengisi nomor peraturan dan kategori dengan benar.
- **Update Berita**: Gunakan editor WYSIWYG di menu "Berita" untuk publikasi informasi kampus.
- **Menu Builder**: Atur navigasi portal secara dinamis melalui menu "Pengaturan Menu".

## 🔗 Integrasi Nasional (JDIHN)

Untuk menghubungkan portal ini ke JDIHN Nasional, berikan URL berikut kepada tim BPHN:
`https://domain-anda.ac.id/api/jdihn`

---

© 2026 UIN Siber Syekh Nurjati Cirebon. Dikembangkan untuk Transparansi Hukum Berbasis Siber.
