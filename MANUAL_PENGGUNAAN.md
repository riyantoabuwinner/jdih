# Manual Penggunaan Aplikasi JDIH UIN Siber Syekh Nurjati

Dokumen ini berisi panduan operasional bagi Administrator dan Operator portal JDIH UIN SSC.

## 1. Login Ke Dashboard
Akses halaman admin melalui alamat: `URL_PORTAL/login`
Gunakan kredensial yang telah diberikan oleh tim IT (Super Admin).

## 2. Manajemen Produk Hukum (Dokumen)
Menu ini digunakan untuk mengelola Surat Keputusan (SK), Peraturan Rektor, dan regulasi lainnya.

### Cara Menambah Dokumen:
1. Klik menu **"Manajemen Dokumen"** di sidebar.
2. Klik tombol **"Tambah Dokumen"**.
3. **Judul**: Isi dengan nama lengkap peraturan.
4. **Nomor & Tahun**: Wajib diisi untuk keperluan pencarian dan integrasi JDIHN.
5. **File PDF**: Unggah dokumen asli dalam format PDF (direkomendasikan < 5MB).
6. **Kategori**: Pilih kategori yang sesuai (misal: Keputusan Rektor).
7. **Status**: Pilih **Published** agar muncul di halaman depan.

## 3. Manajemen Berita & Informasi
Gunakan menu ini untuk mempublikasikan artikel kegiatan hukum atau pengumuman kampus.

1. Klik menu **"Berita"**.
2. **Editor**: Anda bisa mengetik langsung seperti di Microsoft Word atau menggunakan mode **Code** untuk menyematkan elemen HTML.
3. **Gambar Sampul**: Gunakan gambar berkualitas tinggi (rasio 16:9).
4. **Tanggal Terbit**: Anda bisa mengatur tanggal publikasi secara manual (backdate atau mendatang).

## 4. Fitur AI Assistant (Chatbot)
Fitur asisten ini otomatis dilatih berdasarkan dokumen yang Anda unggah.
- Pastikan dokumen yang diunggah memiliki teks yang terbaca (bukan scan gambar tanpa OCR) agar AI dapat memahami isinya.
- Admin tidak perlu mengatur manual, AI akan memproses database dokumen secara otomatis.

## 5. Fitur Aksesibilitas
Portal ini mendukung user dengan kebutuhan khusus.
- **Icon Hijau (Kanan Bawah)**: Klik untuk membuka menu aksesibilitas.
- Fitur mencakup: Screen Reader (TTS), Kontras Tinggi, dan Garis Bawah pada link.

## 6. Sinkronisasi JDIH Nasional
Aplikasi ini sudah "JDIHN Ready". 
- Data dokumen akan otomatis terkompresi ke dalam format JSON standar nasional.
- Endpoint Integrasi: `/api/jdihn`.
- Pastikan status dokumen adalah **Published** agar bisa terdeteksi oleh sistem JDIHN Pusat (BPHN).

## 7. Pemeliharaan Data (Seeder)
Jika Anda melakukan perubahan besar dan ingin menyimpannya sebagai template awal database:
1. Jalankan script export (melalui terminal atau bantuan pengembang).
2. Gunakan `FinalSeeder.php` untuk memulihkan data jika server dipindahkan.

---
**Tim Support JDIH UIN Siber Syekh Nurjati Cirebon**
Email: jdih@uinssc.ac.id
