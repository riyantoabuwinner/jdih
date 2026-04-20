@extends('layouts.public')

@section('title', 'JDIH UIN Siber Syekh Nurjati Cirebon')

@section('content')
<!-- Hero Section -->
<main id="home" class="relative overflow-hidden pt-16 pb-24 lg:pt-32 lg:pb-40 dark:bg-slate-900 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 gap-y-12">
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase bg-green-100 dark:bg-green-900/30 text-[#22c55e] mb-8">
                    JDIH Integrated Portal
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight mb-8 leading-[1.2] text-[#22c55e]">
                    Transparansi Hukum <br class="hidden sm:block"/> 
                    Berbasis <span class="text-[#facc15]">Digital Terpadu</span>
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 mb-12 leading-relaxed max-w-xl">
                    Akses dokumentasi dan informasi hukum terlengkap di lingkungan {{ $global_settings['app_tagline'] ?? 'UIN Siber Syekh Nurjati Cirebon' }} secara cepat, akurat, dan transparan.
                </p>
                
                <!-- Improved Search Experience -->
                <div class="max-w-2xl mt-10">
                    <form action="{{ route('public.documents.index') }}" method="GET" class="relative flex flex-col sm:flex-row items-stretch sm:items-center bg-white dark:bg-slate-800 rounded-[2rem] sm:rounded-full shadow-2xl border border-slate-100 dark:border-slate-700 p-2 gap-2">
                        <div class="hidden sm:flex items-center pl-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        <input type="text" name="search" placeholder="Cari peraturan, SK, atau kebijakan..." class="flex-grow bg-transparent border-none focus:ring-0 px-6 sm:px-4 py-5 dark:text-white text-base font-medium">
                        <button type="submit" style="background-color: #22c55e !important; color: white !important;" class="px-10 py-5 rounded-[1.5rem] sm:rounded-full font-black uppercase tracking-[0.2em] text-[10px] hover:brightness-110 transition-all shadow-lg shadow-emerald-500/20 whitespace-nowrap flex items-center justify-center gap-2">
                            CARI 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="relative mt-12 sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                <div class="relative mx-auto w-full rounded-3xl shadow-2xl overflow-hidden group">
                   <img src="/jdih_hero_banner.png" alt="JDIH Hero" class="w-full h-auto transform group-hover:scale-110 transition-transform duration-[2000ms]">
                   <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                       <div class="text-white text-left">
                           <div class="flex items-center gap-2 mb-2">
                               <span class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></span>
                               <span class="text-xs font-bold uppercase tracking-widest opacity-80">JDIHN Database Live</span>
                           </div>
                           <p class="text-sm font-medium italic">"Membangun Integritas Melalui Keterbukaan Informasi Hukum"</p>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Ultra-Soft, Elegant & Modern Infographics Section -->
<section id="statistik" class="relative py-16 lg:py-20 overflow-hidden" style="background-color: #021f12;">
    <!-- Soft Ambient Lights (Aurora Effect) -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-1/4 rounded-full mix-blend-screen" style="width: 400px; height: 400px; background-color: #0f9d58; opacity: 0.2; filter: blur(130px);"></div>
        <div class="absolute bottom-0 right-1/4 rounded-full mix-blend-screen" style="width: 500px; height: 500px; background-color: #0aff89; opacity: 0.05; filter: blur(140px);"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: url('https://www.transparenttextures.com/patterns/stardust.png');"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 h-full flex flex-col justify-center">
        <!-- Centered Header -->
        <div class="max-w-3xl mx-auto mb-16 text-center">
            <h2 class="text-3xl lg:text-4xl font-light text-white mb-4 tracking-tight leading-tight">
                Infografis <span class="font-bold text-[#eab308]">JDIH</span>
            </h2>
            <p class="text-sm lg:text-base text-slate-300 font-light leading-relaxed">Presentasi data statistik dokumentasi hukum secara transparan dan akuntabel.</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mt-12">
            @php
                $statsConfig = [
                    'total_documents' => ['label' => 'Total Produk Hukum', 'icon' => 'file-text'],
                    'total_categories' => ['label' => 'Kategori Hukum', 'icon' => 'layers'],
                    'total_views' => ['label' => 'Dokumen Dilihat', 'icon' => 'eye'],
                    'total_downloads' => ['label' => 'Total Unduhan', 'icon' => 'arrow-down-to-line'],
                ];
            @endphp
            
            @foreach($stats as $key => $value)
                @php 
                    $config = $statsConfig[$key] ?? ['label' => 'Statistik', 'icon' => 'bar-chart-2'];
                @endphp
                <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-3xl transition-all duration-500 hover:bg-white/20 hover:-translate-y-2 text-center flex flex-col items-center shadow-lg">
                    
                    <!-- Centered Icon on Top -->
                    <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform duration-500 shadow-inner border border-white/20">
                        <i data-lucide="{{ $config['icon'] }}" class="w-7 h-7 text-[#eab308]"></i>
                    </div>
                    
                    <div class="relative w-full">
                        <h3 class="text-3xl lg:text-4xl font-black text-white mb-2 tabular-nums tracking-tight">
                            {{ number_format($value, 0, ',', '.') }}
                        </h3>
                        <p class="text-[10px] sm:text-xs font-bold text-white/70 uppercase tracking-[0.2em] leading-relaxed">
                            {{ $config['label'] }}
                        </p>
                    </div>

                    <!-- Subtle Decorative Glow Area -->
                    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl pointer-events-none"></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Colored & Animated Minimalist Category Grid -->
<section class="py-16 lg:py-24 bg-slate-50/50 dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800/50">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-xl">
                <h2 class="text-3xl lg:text-5xl font-light text-slate-800 dark:text-white mb-4 tracking-tight">Klasifikasi <span class="font-bold text-[#eab308]">Produk Hukum</span></h2>
                <p class="text-sm lg:text-base text-slate-500 dark:text-slate-400 font-light leading-relaxed">Penelusuran dokumentasi dan regulasi berdasarkan struktur kategori siber yang memiliki rona warna terpadu.</p>
            </div>
            <a href="{{ route('public.documents.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-slate-400 hover:text-[#0f9d58] transition-colors pb-1 border-b-2 border-transparent hover:border-[#0f9d58]">
                Jelajahi Pustaka
                <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($categories as $category)
                @php
                    $nameLower = strtolower($category->name);
                    $icon = 'folder-open';
                    $accentColor = '#0f9d58'; // Green by default
                    
                    if (str_contains($nameLower, 'undang') || str_contains($nameLower, 'peraturan menteri')) {
                        $icon = 'scale';
                        $accentColor = '#eab308'; // Gold
                        $desc = 'Koleksi instrumen undang-undang, PP, Perpres, hingga PMA tingkat nasional.';
                    } elseif (str_contains($nameLower, 'institusi') || str_contains($nameLower, 'uin')) {
                        $icon = 'landmark';
                        $accentColor = '#0f9d58'; // Green
                        $desc = 'Regulasi internal mencakup Peraturan Rektor, Keputusan Senat, dan tata kelola kampus.';
                    } elseif (str_contains($nameLower, 'monografi')) {
                        $icon = 'book-open';
                        $accentColor = '#eab308'; // Gold
                        $desc = 'Pusat literatur, pangkalan referensi, dan kajian intelektual ilmu hukum.';
                    } elseif (str_contains($nameLower, 'artikel')) {
                        $icon = 'file-check-2';
                        $accentColor = '#0f9d58'; // Green
                        $desc = 'Jurnal terverifikasi, tulisan ilmiah lepas, dan ringkasan pakar seputar jurisprudensi.';
                    } elseif (str_contains($nameLower, 'putusan')) {
                        $icon = 'gavel';
                        $accentColor = '#eab308'; // Gold
                        $desc = 'Direktori putusan akhir pengadilan maupun nota kesepahaman institusional.';
                    } else {
                        $desc = 'Dokumen regulasi dan instrumen operasional pelengkap sistem akademik.';
                        $accentColor = '#0f9d58'; // Green
                    }
                @endphp
                
                <a href="{{ route('public.documents.index', ['category_id' => $category->id]) }}" 
                   class="group flex flex-col bg-white dark:bg-slate-800/40 rounded-[2rem] p-8 transition-all duration-700 relative overflow-hidden" 
                   style="border: 1px solid {{ $accentColor }}20; border-top: 5px solid {{ $accentColor }}; box-shadow: 0 4px 20px -10px {{ $accentColor }}15;" 
                   onmouseover="this.style.boxShadow='0 20px 40px -15px {{ $accentColor }}40'" 
                   onmouseout="this.style.boxShadow='0 4px 20px -10px {{ $accentColor }}15'">
                    
                    <!-- Permanent Soft Background Wash -->
                    <div class="absolute inset-0 z-0 opacity-[0.08] dark:opacity-[0.03]" style="background: linear-gradient(135deg, transparent 40%, {{ $accentColor }} 100%);"></div>

                    <!-- Soft Blooming Circle Animation on Hover -->
                    <div class="absolute -right-8 -top-8 w-48 h-48 rounded-full opacity-[0.05] scale-100 group-hover:scale-[2] group-hover:opacity-[0.15] transition-all duration-1000 ease-out z-0 pointer-events-none" style="background: radial-gradient(circle, {{ $accentColor }}, transparent 70%);"></div>

                    <!-- Elegant Side Accent Line climbing up -->
                    <div class="absolute left-0 bottom-0 w-[4px] h-0 group-hover:h-full transition-all duration-[800ms] ease-in-out z-20" style="background-color: {{ $accentColor }};"></div>
                    
                    <div class="flex-grow flex flex-col relative z-10 transition-transform duration-700 group-hover:translate-x-2">
                        <div class="mb-6 flex justify-between items-start">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-700 group-hover:-rotate-6 group-hover:scale-110" style="background-color: {{ $accentColor }}1A; color: {{ $accentColor }}; box-shadow: 0 4px 10px {{ $accentColor }}10;">
                                <i data-lucide="{{ $icon }}" class="w-7 h-7" style="stroke-width: 1.5;"></i>
                            </div>
                        </div>

                        <h3 class="text-xl md:text-2xl font-bold text-slate-800 dark:text-slate-100 mb-2 transition-colors duration-500 leading-tight" style="letter-spacing: -0.01em;">
                            {{ $category->name }}
                        </h3>
                        
                        <p class="text-sm text-slate-500/90 dark:text-slate-400 leading-relaxed font-normal transition-colors duration-500">
                            {{ $category->description ?? $desc }}
                        </p>
                    </div>
                    
                    <div class="mt-8 flex items-center justify-between pt-5 border-t border-slate-100 dark:border-slate-800/50 relative z-10 transition-transform duration-700 group-hover:translate-x-2">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-light text-slate-800 dark:text-slate-300 tabular-nums">
                                {{ number_format($category->total_documents_count ?? $category->documents_count ?? 0) }}
                            </span>
                            <span class="text-[10px] uppercase font-bold text-slate-400 transition-colors duration-500" style="letter-spacing: 0.15em;">Berkas</span>
                        </div>
                        
                        <!-- Smooth Arrow Fly-through Animation Layering -->
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white dark:bg-slate-800 border transition-all duration-500 overflow-hidden relative" style="border-color: {{ $accentColor }}30; color: {{ $accentColor }};">
                            
                            <!-- background fill layer slides in from bottom -->
                            <div class="absolute inset-0 h-0 group-hover:h-full translate-y-full group-hover:translate-y-0 transition-all duration-[600ms] ease-out z-0" style="background-color: {{ $accentColor }};"></div>
                            
                            <i data-lucide="arrow-right" class="w-4 h-4 transform -translate-x-8 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 group-hover:text-white transition-all duration-500 ease-out absolute z-10"></i>
                            <i data-lucide="chevron-right" class="w-4 h-4 transform group-hover:translate-x-8 group-hover:opacity-0 transition-all duration-500 ease-out absolute z-10"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest Documents -->
<section class="py-32 bg-white dark:bg-slate-800 transition-colors">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-xl text-left">
                <h2 class="text-3xl lg:text-5xl font-light text-slate-800 dark:text-white mb-4 tracking-tight">Pembaruan <span class="font-bold text-[#eab308]">Terkini</span></h2>
                <p class="text-sm lg:text-base text-slate-500 dark:text-slate-400 font-light leading-relaxed">Dokumentasi hukum skala universitas yang baru saja disahkan.</p>
            </div>
            <a href="{{ route('public.documents.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-slate-400 hover:text-[#0f9d58] transition-colors pb-1 border-b-2 border-transparent hover:border-[#0f9d58]">
                Semua Arsip
                <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid gap-4">
            @forelse($latestDocuments as $doc)
                @php
                    $isGold = $loop->index % 2 !== 0;
                    $brandColor = $isGold ? '#eab308' : '#0f9d58';
                    
                    // Soft Color-to-White Gradients
                    $cardGradient = $isGold 
                        ? 'linear-gradient(to right, rgba(234, 179, 8, 0.08) 0%, #ffffff 100%)' 
                        : 'linear-gradient(to right, rgba(15, 157, 88, 0.08) 0%, #ffffff 100%)';
                @endphp

                <div class="group relative p-6 sm:p-8 lg:p-10 rounded-[2rem] border border-slate-100 dark:border-slate-800 hover:border-{{ $isGold ? 'amber' : 'green' }}-200 shadow-sm hover:shadow-xl transition-all duration-700 overflow-hidden" 
                     style="background: {{ $cardGradient }}; border-left: 8px solid {{ $brandColor }};">
                    
                    <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 text-left w-full">
                        
                        <!-- Left: Icon & Title -->
                        <div class="flex items-center gap-8 w-full lg:w-3/4 flex-grow min-w-0">
                            <!-- Minimalist Boxed Icon -->
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 bg-white shadow-md border border-slate-50 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                                <i data-lucide="file-text" class="w-6 h-6" style="color: {{ $brandColor }};"></i>
                            </div>
                            
                            <!-- Text Content -->
                            <div class="flex-grow min-w-0">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <span class="text-[9px] font-black uppercase tracking-widest px-2.5 py-1 rounded-md border shadow-sm" style="color: {{ $brandColor }}; border-color: {{ $brandColor }}40; background-color: {{ $brandColor }}10;">{{ $doc->category->name }}</span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NO. {{ $doc->number }} / {{ $doc->year }}</span>
                                </div>
                                <h4 class="text-base sm:text-lg lg:text-xl font-medium text-slate-700 dark:text-slate-200 group-hover:text-slate-900 transition-colors duration-500 leading-relaxed line-clamp-1">
                                    {{ strip_tags($doc->title) }}
                                </h4>
                            </div>
                        </div>
                        
                        <!-- Right: Date & Button -->
                        <div class="flex items-center justify-between lg:justify-end gap-10 w-full lg:w-auto mt-4 lg:mt-0 pt-4 lg:pt-0 border-t lg:border-t-0 border-slate-100 flex-shrink-0">
                            <div class="text-left lg:text-right">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-1">Diterbitkan</p>
                                <p class="text-xs font-bold text-slate-500 tabular-nums whitespace-nowrap tracking-wide">{{ ($doc->published_at ?? $doc->created_at)->format('d M Y') }}</p>
                            </div>
                            
                            <a href="{{ route('public.documents.show', $doc->slug) }}" class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white transition-all py-4 px-7 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 active:scale-95" 
                               style="background-color: {{ $brandColor }};">
                                Buka <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-slate-50 dark:bg-slate-900 rounded-3xl border border-dashed border-slate-200 dark:border-slate-800">
                     <i data-lucide="archive-x" class="w-10 h-10 mx-auto text-slate-300 mb-3"></i>
                     <p class="text-slate-400 font-light text-sm">Belum ada dokumen yang diterbitkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Statistics & Metrics Section -->
<section id="statistik" class="py-24 bg-white dark:bg-slate-950 transition-colors">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="text-left">
                <span class="text-[10px] font-black uppercase text-gold tracking-[0.3em] mb-4 block">Transparansi Data</span>
                <h2 class="text-3xl lg:text-5xl font-light text-slate-800 dark:text-white mb-4 tracking-tight">Statistik & <span class="font-bold text-[#eab308]">Matriks Data</span></h2>
            </div>
            <a href="{{ route('admin.reports.index') }}" class="group flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors">
                Lihat Detail
                <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left: Popular Products Bar Chart -->
            <div class="w-full lg:w-7/12 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 p-8 sm:p-10 shadow-2xl shadow-slate-200/50 dark:shadow-none flex flex-col h-[500px]">
                <div class="flex items-center gap-3 mb-8">
                    <i data-lucide="bar-chart-3" class="w-6 h-6 text-gold"></i>
                    <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 uppercase tracking-widest">5 Jenis Produk Hukum Terpopuler</h3>
                </div>
                <div class="flex-grow min-h-0">
                    <canvas id="popularProductsChart"></canvas>
                </div>
            </div>

            <!-- Right: Visitor Stats Donut Chart -->
            <div class="w-full lg:w-5/12 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 p-8 sm:p-10 shadow-2xl shadow-slate-200/50 dark:shadow-none flex flex-col h-[500px]">
                <div class="flex items-center gap-3 mb-8">
                    <i data-lucide="users" class="w-6 h-6 text-gold"></i>
                    <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 uppercase tracking-widest">Statistik Pengunjung</h3>
                </div>
                
                <div class="grid grid-cols-2 gap-8 items-center flex-grow">
                    <div class="relative h-full flex items-center justify-center">
                        <canvas id="visitorPieChart"></canvas>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="p-5 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-white/5 shadow-sm">
                            <p class="text-[9px] font-black uppercase text-slate-400 tracking-widest mb-1">Total Pengunjung</p>
                            <h4 class="text-2xl font-black text-slate-800 dark:text-white tabular-nums">{{ number_format($visitStats['total']) }}</h4>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-3">
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-white/5">
                                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Tahun Ini</span>
                                <span class="text-sm font-black text-slate-800 dark:text-slate-100 tabular-nums">{{ number_format($visitStats['year']) }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-white/5">
                                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Bulan Ini</span>
                                <span class="text-sm font-black text-slate-800 dark:text-slate-100 tabular-nums">{{ number_format($visitStats['month']) }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-white/5">
                                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Hari Ini</span>
                                <span class="text-sm font-black text-slate-800 dark:text-slate-100 tabular-nums">{{ number_format($visitStats['today']) }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/10 rounded-xl border border-green-100 dark:border-green-900/20">
                                <span class="flex items-center gap-2 text-[9px] font-bold text-green-600 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                    Online
                                </span>
                                <span class="text-sm font-black text-green-700 dark:text-green-400 tabular-nums">{{ number_format($visitStats['online']) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News -->
<section id="berita" class="py-24 bg-slate-50 dark:bg-slate-900 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="text-left max-w-xl">
                <h2 class="text-3xl lg:text-5xl font-light text-slate-800 dark:text-white mb-4 tracking-tight">Berita & <span class="font-bold text-[#eab308]">Informasi</span></h2>
                <p class="text-sm lg:text-base text-slate-500 dark:text-slate-400 font-light leading-relaxed">Update terbaru seputar kebijakan dan aktivitas hukum di lingkungan kampus.</p>
            </div>
            <a href="#" class="group inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-slate-400 hover:text-[#0f9d58] transition-colors pb-1 border-b-2 border-transparent hover:border-[#0f9d58]">
                Index Berita
                <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
            @forelse($latestNews as $news)
                <article class="group bg-white dark:bg-slate-800 rounded-[2.5rem] overflow-hidden border border-slate-100 dark:border-white/5 shadow-sm hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 flex flex-col h-full">
                    <!-- Image Region -->
                    <div class="relative h-64 overflow-hidden">
                        @if($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover transition-transform duration-[3000ms] group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-300">
                                <i data-lucide="image" class="w-12 h-12"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-6 left-6">
                            <span class="px-4 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[9px] font-black text-white uppercase tracking-[0.2em] shadow-lg">NEWS UPDATE</span>
                        </div>
                    </div>

                    <!-- Content Region -->
                    <div class="p-8 sm:p-10 flex flex-col flex-grow">
                        <div class="flex items-center gap-4 mb-6 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar" class="w-3.5 h-3.5 text-[#eab308]"></i> 
                                {{ ($news->published_at ? \Carbon\Carbon::parse($news->published_at) : $news->created_at)->format('d M Y') }}
                            </div>
                            <div class="w-1 h-1 rounded-full bg-slate-200"></div>
                            <div class="flex items-center gap-2 font-black text-[#0f9d58]">By Admin</div>
                        </div>

                        <h3 class="text-xl lg:text-2xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-[#0f9d58] transition-colors leading-tight line-clamp-2">
                            {{ $news->title }}
                        </h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-8 line-clamp-3 font-light">
                            {{ Str::limit(strip_tags($news->content), 150) }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('public.pages.show', $news->slug) }}" class="inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-[#0f9d58] transition-all group/btn hover:gap-5">
                                Baca Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover/btn:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-20 text-center bg-white dark:bg-slate-800 rounded-[2.5rem] border border-dashed border-slate-200 dark:border-slate-700">
                    <i data-lucide="newspaper" class="w-12 h-12 mx-auto text-slate-300 mb-4"></i>
                    <p class="text-slate-400 font-medium italic">Belum ada berita yang diterbitkan untuk saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Bar Chart: Popular Categories ---
        const popularCtx = document.getElementById('popularProductsChart').getContext('2d');
        const popularData = @json($popularCategoriesForChart->map(fn($c) => ['name' => $c->name, 'count' => $c->documents_count]));
        
        new Chart(popularCtx, {
            type: 'bar',
            data: {
                labels: popularData.map(d => d.name),
                datasets: [{
                    label: 'Jumlah Dokumen',
                    data: popularData.map(d => d.count),
                    backgroundColor: '#16a34a', // Leaf green
                    borderRadius: 12,
                    borderSkipped: false,
                    barThickness: 45
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 }
                    }
                },
                scales: {
                    x: { 
                        grid: { display: false },
                        ticks: { font: { size: 11, weight: '600' }, color: '#64748b' }
                    },
                    y: { 
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#e2e8f0' },
                        ticks: { font: { size: 11 }, color: '#94a3b8' }
                    }
                }
            }
        });

        // --- Donut Chart: Visitor Distribution ---
        const visitorCtx = document.getElementById('visitorPieChart').getContext('2d');
        new Chart(visitorCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tahun Ini', 'Bulan Ini', 'Hari Ini'],
                datasets: [{
                    data: [
                        {{ $visitStats['year'] }},
                        {{ $visitStats['month'] }},
                        {{ $visitStats['today'] }}
                    ],
                    backgroundColor: ['#eab308', '#0f9d58', '#3b82f6'],
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endpush
