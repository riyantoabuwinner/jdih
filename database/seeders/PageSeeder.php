<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'tentang',
                'title' => 'Tentang JDIH UINSSC',
                'content' => <<<HTML
<div class="space-y-12">
    <!-- Formal Intro (Justified) -->
    <div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300">
        <p>
            <strong class="text-islami font-bold">Jaringan Dokumentasi dan Informasi Hukum (JDIH) UIN Siber Syekh Nurjati Cirebon</strong> merupakan wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan. Sistem ini dibangun sebagai wujud nyata komitmen universitas dalam menyelenggarakan tata kelola perguruan tinggi yang baik (<em>Good University Governance</em>), transparan, dan akuntabel di era transformasi digital.
        </p>
        <p>
            Pembentukan JDIH di lingkungan UIN Siber Syekh Nurjati Cirebon ini merupakan amanat dan bentuk kepatuhan institusional terhadap <strong>Peraturan Presiden Nomor 33 Tahun 2012</strong> tentang Jaringan Dokumentasi dan Informasi Hukum Nasional (JDIHN), serta regulasi turunan di bawah Kementerian Agama Republik Indonesia yang mewajibkan ketersediaan pangkalan data hukum yang valid dan terintegrasi.
        </p>
    </div>

    <!-- Legal Basis Grid -->
    <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 not-prose">
        <h3 class="text-xl font-bold mb-6 text-slate-900 dark:text-white border-l-4 border-islami pl-4 drop-shadow-sm">Landasan Hukum & Operasional</h3>
        <ul class="space-y-5 text-justify text-slate-600 dark:text-slate-400">
            <li class="flex items-start gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="bg-green-100 dark:bg-green-900/50 p-2 rounded-lg text-islami shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg></div>
                <span class="mt-1 leading-relaxed"><strong>Undang-Undang Nomor 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik.</span>
            </li>
            <li class="flex items-start gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="bg-green-100 dark:bg-green-900/50 p-2 rounded-lg text-islami shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg></div>
                <span class="mt-1 leading-relaxed"><strong>Peraturan Presiden Nomor 33 Tahun 2012</strong> tentang Jaringan Dokumentasi dan Informasi Hukum Nasional.</span>
            </li>
            <li class="flex items-start gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="bg-green-100 dark:bg-green-900/50 p-2 rounded-lg text-islami shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg></div>
                <span class="mt-1 leading-relaxed"><strong>Peraturan Menteri Agama (PMA) Nomor 27 Tahun 2013</strong> tentang Jaringan Dokumentasi dan Informasi Hukum Kementerian Agama.</span>
            </li>
            <li class="flex items-start gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="bg-green-100 dark:bg-green-900/50 p-2 rounded-lg text-islami shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg></div>
                <span class="mt-1 leading-relaxed"><strong>Statuta dan Peraturan Rektor</strong> UIN Siber Syekh Nurjati Cirebon sebagai pengikat internal sivitas akademika.</span>
            </li>
        </ul>
    </div>

    <!-- Objectives (Justified) -->
    <div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-6 border-b pb-3">Tujuan dan Layanan Utama</h2>
        <div class="prose prose-slate dark:prose-invert max-w-none text-justify text-lg leading-relaxed text-slate-700 dark:text-slate-300">
            <p>
                Sebagai garda terdepan pelestarian dokumen regulasi, pusat informasi ini berfungsi untuk memberikan layanan dokumentasi hukum yang terstruktur, akurat, dan terbuka. JDIH menjembatani kebutuhan para pimpinan, pendidik, birokrat, hingga periset regulasi dengan menyajikan instrumen berupa:
            </p>
            
            <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8 my-8 font-semibold pt-6 border-t border-slate-200 dark:border-slate-700 not-prose">
                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700"><span class="w-2 h-2 rounded-full bg-islami"></span> Peraturan &amp; Keputusan Rektor</div>
                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700"><span class="w-2 h-2 rounded-full bg-islami"></span> Keputusan Senat Akademik</div>
                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700"><span class="w-2 h-2 rounded-full bg-islami"></span> Standar Operasional Prosedur (SOP)</div>
                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700"><span class="w-2 h-2 rounded-full bg-islami"></span> MoU / MoA (Kerjasama Lintas Sektor)</div>
                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700"><span class="w-2 h-2 rounded-full bg-islami"></span> Surat Edaran &amp; Instruksi Pimpinan</div>
                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-slate-700 dark:text-slate-300 border border-slate-100 dark:border-slate-700"><span class="w-2 h-2 rounded-full bg-islami"></span> SK dan Peraturan Setingkat Fakultas</div>
            </div>
            
            <p>
                Di tengah akselerasi Universitas Islam Negeri (UIN) Siber Syekh Nurjati Cirebon sebagai institusi pendidikan berbasis siber lintas dunia kelas wahid (<em>World Class Cyber University</em>), infrastruktur JDIH ini terus melangkah dengan pemanfaatan teknologi mesin pencari (<em>search engine</em>) agar senantiasa merangkul terciptanya tata kelola kampus yang taat asas, patuh pada hukum, serta anti plagiarisme pijakan aturan demi Indonesia yang lebih baik.
            </p>
        </div>
    </div>
</div>
HTML
            ],
            [
                'slug' => 'visi-misi',
                'title' => 'Visi dan Misi',
                'content' => <<<HTML
<div class="space-y-12">
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
</div>
HTML
            ],
            [
                'slug' => 'komitmen-pelayanan',
                'title' => 'Komitmen Pelayanan',
                'content' => <<<HTML
<div class="space-y-8">
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
</div>
HTML
            ],
            [
                'slug' => 'pengelola',
                'title' => 'Pengelola JDIH',
                'content' => <<<HTML
<div class="space-y-8">
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
</div>
HTML
            ],
            [
                'slug' => 'kontak',
                'title' => 'Pusat Layanan dan Kontak',
                'content' => <<<HTML
<div class="space-y-8">
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
</div>
HTML
            ],
        ];

        foreach ($pages as $page) {
            \App\Models\Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
