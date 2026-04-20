<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $message = strtolower($request->input('message', ''));
        $reply = $this->generateReply($message);

        return response()->json([
            'reply' => $reply
        ]);
    }

    private function generateReply($message)
    {
        // GREETINGS
        if (Str::contains($message, ['halo', 'hai', 'hello', 'selamat pagi', 'selamat siang'])) {
            return "Halo! Ada yang bisa saya bantu terkait aplikasi JDIH UIN Siber Syekh Nurjati Cirebon hari ini?\n\nAnda bisa menanyakan tentang:\n- **Tujuan JDIH**\n- **Cara Download Dokumen**\n- **Cara Login / TTE**\n- **Fitur Aksesibilitas**";
        }

        // TENTANG JDIH / APLIKASI
        if (Str::contains($message, ['apa itu jdih', 'tentang aplikasi', 'fungsi jdih', 'tujuan jdih', 'aplikasi ini'])) {
            return "Aplikasi **JDIH UIN Siber Syekh Nurjati Cirebon** adalah portal berbasis web terpusat yang dikelola secara digital untuk mendokumentasikan, mencari, dan mengakses Produk Hukum (Peraturan, SK, Keputusan, dll).\n\nAplikasi ini memastikan adanya:\n- Transparansi dan akuntabilitas publik.\n- Sentralisasi produk hukum yang dikeluarkan institusi.\n- Integrasi yang mudah diakses oleh mahasiswa, dosen, maupun masyarakat umum.";
        }

        // CARA MENDAPATKAN / MENDOWNLOAD DOKUMEN
        if (Str::contains($message, ['download', 'unduh', 'cara mencari', 'cari dokumen', 'dapat dokumen', 'produk hukum'])) {
            return "Untuk mencari produk hukum:\n1. Buka halaman utama (Beranda) atau menu **Produk Hukum**.\n2. Ketik kolom pencarian atau gunakan filter berdasarkan Kategori Hukum.\n3. Klik dokumen yang diinginkan untuk membacanya melalui **PDF Viewer In-App**.\n4. Jika Anda perlu mengarsipkannya secara luring, klik ikon panah **Download (Unduh)** yang tersedia di bilah atas layar dokumen.";
        }

        // PROSES BISNIS ADMIN / ALUR UPLOAD
        if (Str::contains($message, ['cara tambah', 'cara upload', 'admin', 'tambah dokumen', 'unggah regulasi'])) {
            return "Proses bisnis penerbitan regulasi (Bagi Administrator/Operator):\n1. Admin login melalui panel `/login`.\n2. Buka menu **Produk Hukum** di dashboard administratif.\n3. Klik **Tambah Data** dan isi metadata (Judul, T.E.U., Tanggal Terbit, Status).\n4. Unggah berkas dokumen utama berformat PDF ber-watermark atau bertanda tangan elektronik.\n5. Status publikasi akan diperbarui secara real-time untuk muncul di sisi publik.";
        }

        // PROSES BISNIS LOGIN / TTE LECTURER
        if (Str::contains($message, ['tanda tangan', 'tte', 'dosen', 'registrasi tte', 'login dosen', 'sso'])) {
            return "Untuk validasi Tanda Tangan Elektronik (TTE):\n\nDosen wajib melakukan **Registrasi TTE** sebelum bisa merilis atau menandatangani dokumen hukum. Aplikasi akan mendeteksi apakah dosen tersebut sudah mendaftar, dan akan membatalkan interaksi otomatis (Cancel Signature request) jika sertifikat TTE belum didaftarkan melalui menu **Profil -> Pengaturan Sertifikat** di dashboard.";
        }
        
        // SURVEY KEPUASAN & FEEDBACK
        if (Str::contains($message, ['survey', 'survei', 'feedback', 'kepuasan', 'masukan'])) {
            return "Aplikasi JDIH kami terus belajar dari Anda! Fitur **Survey Kepuasan/Feedback** (berada di menu header bagian kanan) ditujukan agar Anda dapat memberi Rating Bintang 1-5 terhadap layanan dokumentasi maupun kualitas UI/UX portal ini.\n\nAdmin dapat melihat statistik distribusinya langsung di panel laporan grafik yang interaktif.";
        }

        // AKSESIBILITAS (TTS, DISLEKSIA DLL)
        if (Str::contains($message, ['aksesibilitas', 'text to speech', 'pembaca layar', 'rabun', 'kursor', 'tampilan', 'gelap', 'mode'])) {
            return "Aplikasi JDIH saat ini memiliki komitmen aksesibilitas paling mumpuni (Inklusif) bersandar pada pedoman W3C:\n- **Text-to-Speech (TTS):** Mampu membacakan secara lisan bagian teks manapun yang Anda sorot/blok dengan mengikuti logat bahasa situs otomatis.\n- **Pengaturan Visual:** Warna kontras, Dark Mode, mode Dyslexia font, Kursor Besar, Spasi Ekstra.\n\nKlik tombol di pojok kiri bawah layar untuk membukanya!";
        }

        // AUTHOR/MAKER / OTHER
        if (Str::contains($message, ['siapa yang membuat', 'pembuat', 'developer', 'bikin ini'])) {
            return "Sistem JDIH dan AI Assistant ini diberdayakan secara intensif dan berkelanjutan sebagai ekosistem pintar, diklaim untuk digitalisasi menyeluruh di lingkungan **UIN Siber Syekh Nurjati Cirebon**.";
        }

        // FALLBACK
        return "Maaf, saya belum menemukan jawaban yang pas dari pusat pangkalan data kami tentang pertanyaan Anda.\n\nAnda dapat merincikannya dengan menggunakan kata kunci spesifik seperti:\n- **'cara mencari dokumen'**\n- **'tanda tangan TTE dosen'**\n- **'apa fitur aksesibilitas'**\n- **'survey kepuasan'**\n\nAtau kirim langsung pesan melalui **Menu Feedback** kami!";
    }
}
