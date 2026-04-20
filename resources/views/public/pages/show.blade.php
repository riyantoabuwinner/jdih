@extends('layouts.public')

@section('title', ($page->metadata['seo_title'] ?? $page->title) . ' - JDIH UIN Siber Syekh Nurjati Cirebon')

@push('styles')
@if(!empty($page->metadata['seo_description']))
    <meta name="description" content="{{ $page->metadata['seo_description'] }}">
@endif
@if(!empty($page->metadata['seo_keywords']))
    <meta name="keywords" content="{{ $page->metadata['seo_keywords'] }}">
@endif
@endpush

@section('content')
<!-- JDIH Hero Banner Header (Matching Landing Page Nuance) -->
<div class="relative w-full min-h-[400px] md:min-h-[550px] flex items-center overflow-hidden bg-slate-900 border-b border-white/10" style="background-color: #030712;">
    
    <!-- Background Image -->
    <div class="absolute inset-0">
        @if($page->image)
            <img src="{{ Storage::url($page->image) }}" alt="{{ $page->title }}" class="w-full h-full object-cover object-center" style="opacity: 0.5; filter: brightness(0.7);">
        @else
            <img src="/jdih_hero_banner.png" alt="JDIH Banner" class="w-full h-full object-cover object-right md:object-center" style="opacity: 0.4; filter: brightness(0.6);">
        @endif
        
        <!-- Deep Black-Slate Gradient Overlay via Inline CSS (Guaranteed to render) -->
        <div class="absolute inset-0" style="background: linear-gradient(to right, #030712 0%, #030712 50%, rgba(3,7,18,0.8) 60%, transparent 80%);"></div>
        <div class="absolute inset-0" style="background: linear-gradient(to top, #030712 0%, transparent 40%); opacity: 0.95;"></div>
    </div>

    <!-- Hero Content Area -->
    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10 w-full py-20 mt-16 md:mt-0">
        <div class="max-w-2xl lg:max-w-3xl text-left">
            
            @php
                $corePages = ['tentang', 'visi-misi', 'komitmen-pelayanan', 'pengelola', 'kontak'];
                $isCore = in_array($page->slug, $corePages);
            @endphp
            <!-- Elegant Breadcrumb -->
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-white/50 mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-green-400 transition-colors">Beranda</a>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <span class="text-white/50">{{ $isCore ? 'Profil' : 'Halaman' }}</span>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <span class="text-green-400">{{ $page->title }}</span>
            </nav>

            <!-- Title (FAQ Style) -->
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">{{ $page->title }}</h1>

            <!-- Subtitle Accent -->
            <p class="mt-10 text-lg md:text-2xl text-white/80 font-medium max-w-2xl leading-relaxed">
                Jaringan Dokumentasi dan Informasi Hukum <br class="hidden md:block">
                UIN Siber Syekh Nurjati Cirebon
            </p>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<section class="py-16 md:py-24 bg-slate-50 dark:bg-[#030712] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 md:-mt-32 relative z-20">
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] p-8 md:p-16 shadow-[0_40px_100px_rgba(0,0,0,0.1)] dark:shadow-[0_40px_100px_rgba(0,0,0,0.5)] border border-slate-100 dark:border-white/5">
            
            <div class="prose prose-slate dark:prose-invert prose-lg max-w-none text-justify
                prose-headings:font-bold prose-headings:text-slate-900 dark:prose-headings:text-white
                prose-p:text-slate-600 dark:prose-p:text-slate-300 prose-p:leading-relaxed prose-p:text-justify
                prose-strong:text-islami dark:prose-strong:text-green-400 prose-a:text-islami prose-a:no-underline hover:prose-a:underline
                prose-ul:list-disc prose-li:marker:text-islami prose-li:text-justify">
                
                {!! $page->content !!}

                @if($page->tags->count() > 0)
                    <div class="mt-16 pt-8 border-t border-slate-100 dark:border-white/5">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2">
                            <i data-lucide="tag" class="w-3.5 h-3.5"></i> Hashtags
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($page->tags as $tag)
                                <a href="{{ route('public.documents.index', ['search' => '#' . $tag->name]) }}" class="px-4 py-2 bg-slate-50 dark:bg-white/5 text-slate-500 dark:text-slate-400 rounded-xl text-xs font-bold hover:bg-islami hover:text-white transition-all">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(empty($page->content) || $page->content == '<p>Halaman ini sedang dalam pengembangan.</p>')
                    <div class="flex flex-col items-center justify-center py-20 text-center opacity-40">
                        <i data-lucide="file-text" class="w-20 h-20 mb-6 text-slate-300 dark:text-slate-600"></i>
                        <h3 class="text-2xl font-bold tracking-tight text-slate-600 dark:text-slate-200">Konten Belum Tersedia</h3>
                        <p class="text-slate-500 mt-2">Halaman profil ini sedang dalam proses penyusunan.</p>
                    </div>
                @endif
            </div>
            

        </div>
    </div>
    
    <style>
        /* Force text justify in case tailwind JIT hasn't compiled the prose-p utilities */
        .prose p, .prose li {
            text-align: justify !important;
        }
    </style>
</section>
@endsection
