@extends('layouts.admin')

@section('title', 'Panduan Penggunaan')

@section('content')
<div class="space-y-12">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-[#0c1120] rounded-[2.5rem] p-10 lg:p-16 text-white shadow-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 bg-green-500/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gold-500/10 rounded-full blur-3xl -ml-32 -mb-32"></div>
        
        <div class="relative z-10 max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-[10px] font-black uppercase tracking-widest text-[#4ade80] mb-6 border border-white/10">
                <i data-lucide="book-open" class="w-4 h-4"></i> Documentation Center
            </span>
            <h2 class="text-4xl lg:text-5xl font-light mb-6 leading-tight">Halo, <span class="font-bold text-[#eab308]">{{ auth()->user()->name }}</span>. Selamat datang di Pusat Panduan.</h2>
            <p class="text-slate-400 text-lg leading-relaxed">
                Panduan ini disusun khusus berdasarkan hak akses Anda sebagai 
                <span class="text-white font-bold uppercase tracking-widest text-sm decoration-2 underline decoration-[#0F9D58] underline-offset-8">
                    {{ str_replace('_', ' ', $role) }}
                </span>.
            </p>
        </div>
    </div>

    <!-- Guide Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Navigation Sidebar (Sticky) -->
        <div class="lg:col-span-1">
            <div class="sticky top-10 space-y-4">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                    <h3 class="text-xs font-black uppercase text-slate-400 tracking-widest mb-6">Daftar Isi Panduan</h3>
                    <nav class="space-y-1">
                        @if($role == 'super_admin' || $role == 'admin')
                            <a href="#quick-start" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                                <i data-lucide="zap" class="w-4 h-4 text-amber-500"></i> Quick Start
                            </a>
                            <a href="#doc-management" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                                <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i> Manajemen Dokumen
                            </a>
                            <a href="#category-config" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                                <i data-lucide="layers" class="w-4 h-4 text-purple-500"></i> Klaster & Kategori
                            </a>
                        @endif

                        @if($role == 'super_admin')
                            <a href="#system-settings" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                                <i data-lucide="settings" class="w-4 h-4 text-slate-700"></i> Konfigurasi Sistem
                            </a>
                            <a href="#user-management" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                                <i data-lucide="users" class="w-4 h-4 text-green-600"></i> Kelola Pengguna
                            </a>
                        @endif

                        @if($role == 'editor')
                            <a href="#news-writing" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                                <i data-lucide="edit-3" class="w-4 h-4 text-orange-500"></i> Menulis Berita & Artikel
                            </a>
                        @endif

                        <a href="#jdihn-sync" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                            <i data-lucide="share-2" class="w-4 h-4 text-red-500"></i> Integrasi Nasional
                        </a>
                    </nav>
                </div>

                <div class="bg-[#0F9D58] p-8 rounded-[2rem] text-white shadow-xl shadow-green-900/20">
                    <i data-lucide="help-circle" class="w-8 h-8 mb-4 text-green-200"></i>
                    <h4 class="text-lg font-bold mb-2">Butuh Bantuan Lebih?</h4>
                    <p class="text-sm text-green-50/80 leading-relaxed mb-6">Hubungi tim IT JDIH UIN SSC jika Anda menemukan kendala teknis.</p>
                    <a href="mailto:it@uinssc.ac.id" class="inline-block px-5 py-2.5 bg-white text-[#0F9D58] rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-green-50 transition-all">Kirim Email</a>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-2 space-y-12 pb-20">
            <!-- Section: Quick Start -->
            <section id="quick-start" class="scroll-mt-24">
                <h3 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-amber-500 rounded-full"></span> Quick Start Guide
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm group hover:border-[#0F9D58] transition-all">
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="upload-cloud" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-lg font-bold mb-3">Unggah Produk Hukum</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Cukup masuk ke menu Produk Hukum, klik Tambah, masukkan nomor peraturan, unggah PDF, dan simpan.</p>
                    </div>
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm group hover:border-[#0F9D58] transition-all">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="eye" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-lg font-bold mb-3">Monitoring View</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Pantau grafik statistik di dashboard utama untuk melihat berapa banyak dokumen Anda dibaca hari ini.</p>
                    </div>
                </div>
            </section>

            <!-- Section: Role Specific Guide -->
            @if($role == 'super_admin')
            <section id="system-settings" class="scroll-mt-24">
                <h3 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-slate-700 rounded-full"></span> Pengaturan Sistem (Super Admin)
                </h3>
                <div class="space-y-6">
                    <div class="bg-slate-900 p-8 rounded-[2rem] text-white">
                        <ul class="space-y-6">
                            <li class="flex gap-4">
                                <div class="w-6 h-6 rounded-full bg-green-500 flex-shrink-0 flex items-center justify-center text-[10px] font-black">1</div>
                                <div>
                                    <h5 class="font-bold mb-1">Identitas Portal</h5>
                                    <p class="text-sm text-slate-400">Anda dapat mengubah Nama Aplikasi, Tagline, Logo, dan Favicon di menu **Pengaturan Umum**.</p>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <div class="w-6 h-6 rounded-full bg-green-500 flex-shrink-0 flex items-center justify-center text-[10px] font-black">2</div>
                                <div>
                                    <h5 class="font-bold mb-1">Backup Data Berkala</h5>
                                    <p class="text-sm text-slate-400">Gunakan menu **Manajemen Backup** untuk mengunduh salinan database Anda setiap minggu demi keamanan.</p>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <div class="w-6 h-6 rounded-full bg-green-500 flex-shrink-0 flex items-center justify-center text-[10px] font-black">3</div>
                                <div>
                                    <h5 class="font-bold mb-1">Manajemen Menu Navigasi</h5>
                                    <p class="text-sm text-slate-400">Atur struktur menu atas (Top), utama (Main), hingga footer melalui fitur Drag & Drop di menu **Navigasi Menu**.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            @endif

            @if($role == 'admin' || $role == 'super_admin')
            <section id="doc-management" class="scroll-mt-24">
                <h3 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-blue-500 rounded-full"></span> Alur Manajemen Dokumen
                </h3>
                <div class="bg-white rounded-[2rem] border border-slate-200 overflow-hidden shadow-sm">
                    <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                        <h4 class="text-sm font-black uppercase text-slate-500 tracking-widest">Standard Operating Procedure</h4>
                    </div>
                    <div class="p-8">
                        <div class="space-y-8">
                            <div class="flex items-start gap-6">
                                <div class="w-10 h-10 rounded-xl bg-blue-500 text-white flex items-center justify-center font-bold flex-shrink-0">A</div>
                                <div>
                                    <h5 class="font-bold text-slate-900 mb-2">Pemberian Nomor & Tahun</h5>
                                    <p class="text-sm text-slate-500 leading-relaxed">Sistem pencarian dan integrasi JDI Nasional sangat bergantung pada Nomor dan Tahun. Pastikan format penulisan nomor seragam sesuai standar persuratan UIN SSC.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-6">
                                <div class="w-10 h-10 rounded-xl bg-blue-500 text-white flex items-center justify-center font-bold flex-shrink-0">B</div>
                                <div>
                                    <h5 class="font-bold text-slate-900 mb-2">Pemetaan Kategori</h5>
                                    <p class="text-sm text-slate-500 leading-relaxed">Gunakan Kategori yang tepat agar dokumen muncul di filter pencarian yang relevan bagi pengunjung umum.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-6">
                                <div class="w-10 h-10 rounded-xl bg-blue-500 text-white flex items-center justify-center font-bold flex-shrink-0">C</div>
                                <div>
                                    <h5 class="font-bold text-slate-900 mb-2">Upload PDF Terenkripsi</h5>
                                    <p class="text-sm text-slate-500 leading-relaxed">Sistem otomatis akan mengamankan file PDF Anda, namun direkomendasikan PDF hasil scan telah melalui proses OCR agar teksnya bisa dicari.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <section id="jdihn-sync" class="scroll-mt-24">
                <div class="bg-emerald-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-2xl -mr-16 -mt-16"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold mb-4">Integrasi JDIH Nasional</h3>
                            <p class="text-emerald-100 text-sm leading-relaxed mb-6">Portal Anda telah dilengkapi dengan Endpoint API standar Nasional. Pastikan data dokumen lengkap (Nomor, Tahun, Tanggal) agar proses sinkronisasi ke BPHN berjalan mulus.</p>
                            <div class="bg-white/10 p-4 rounded-xl font-mono text-xs text-emerald-200 border border-white/5">
                                API URL: {{ url('/api/jdihn') }}
                            </div>
                        </div>
                        <div class="w-24 h-24 bg-white/10 rounded-[2rem] flex items-center justify-center flex-shrink-0">
                            <i data-lucide="terminal" class="w-10 h-10 text-[#4ade80]"></i>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@push('styles')
<style>
    html { scroll-behavior: smooth; }
</style>
@endpush
@endsection
