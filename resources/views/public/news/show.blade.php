@extends('layouts.public')

@section('title', $news->title . ' - JDIH UIN Siber Syekh Nurjati Cirebon')

@section('content')
<!-- JDIH Hero Banner Header (Matching Landing Page Nuance) -->
<div class="relative w-full min-h-[400px] md:min-h-[550px] flex items-center overflow-hidden bg-slate-900 border-b border-white/10" style="background-color: #030712;">
    
    <!-- Background Image from Landing Page -->
    <div class="absolute inset-0">
        <img src="/jdih_hero_banner.png" alt="JDIH Banner" class="w-full h-full object-cover object-right md:object-center" style="opacity: 0.4; filter: brightness(0.6);">
        
        <!-- Deep Black-Slate Gradient Overlay via Inline CSS (Guaranteed to render) -->
        <div class="absolute inset-0" style="background: linear-gradient(to right, #030712 0%, #030712 50%, rgba(3,7,18,0.8) 60%, transparent 80%);"></div>
        <div class="absolute inset-0" style="background: linear-gradient(to top, #030712 0%, transparent 40%); opacity: 0.95;"></div>
    </div>

    <!-- Hero Content Area -->
    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10 w-full py-20 mt-16 md:mt-0">
        <div class="max-w-2xl lg:max-w-3xl text-left">
            
            <!-- Elegant Breadcrumb -->
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-white/50 mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-green-400 transition-colors">Beranda</a>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <span class="text-white/50">Warta</span>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <span class="text-green-400">Detail Berita</span>
            </nav>

            <!-- Title (FAQ Style) -->
            <h1 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight leading-tight">{{ $news->title }}</h1>

            <!-- Subtitle Accent: Author & Date -->
            <div class="flex flex-wrap items-center gap-4 mt-10">
                <div class="flex items-center gap-3 px-4 py-2 bg-white/5 border border-white/10 backdrop-blur-sm rounded-xl">
                    <div class="w-2 h-2 rounded-full bg-green-400 shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-white/80">Oleh {{ $news->creator->name ?? 'Admin' }}</span>
                </div>
                <div class="flex items-center gap-3 px-4 py-2 bg-white/5 border border-white/10 backdrop-blur-sm rounded-xl">
                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-white/60"></i>
                    <span class="text-[10px] font-black uppercase tracking-widest text-white/70">{{ $news->created_at->format('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Body -->
<div class="bg-white">
    <div class="max-w-6xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <!-- Content (Left) -->
            <div class="lg:col-span-8">
                <!-- Featured Image: Neatly Contained -->
                @if($news->image)
                    <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl shadow-green-900/5 ring-1 ring-slate-100">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-auto object-cover max-h-[450px]">
                    </div>
                @endif

                <article class="prose prose-slate prose-lg max-w-none 
                    prose-p:text-slate-600 prose-p:leading-relaxed 
                    prose-headings:font-black prose-headings:text-slate-900 
                    prose-strong:text-islami">
                    {!! $news->content !!}
                </article>
                
                <style>
                    /* Force text justify in case tailwind JIT hasn't compiled the prose-p utilities */
                    .prose p, .prose li {
                        text-align: justify !important;
                    }
                </style>

                <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bagikan:</span>
                        <div class="flex gap-2">
                             <a href="#" class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-islami hover:text-white transition-all"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                             <a href="#" class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-islami hover:text-white transition-all"><i data-lucide="twitter" class="w-4 h-4"></i></a>
                             <a href="#" class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-islami hover:text-white transition-all"><i data-lucide="link" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right) -->
            <div class="lg:col-span-4">
                <div class="sticky top-28 space-y-10">
                    
                    <!-- Sidebar Feed -->
                    <div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-900 mb-8 flex items-center gap-3">
                            <span class="w-1.5 h-1.5 bg-islami rounded-full"></span>
                            Update Terbaru
                        </h3>
                        <div class="space-y-6">
                            @foreach($relatedNews as $item)
                                <a href="{{ route('public.pages.show', $item->slug) }}" class="group block border-b border-slate-50 pb-6 last:border-0 hover:translate-x-1 transition-all">
                                    <div class="flex gap-4 items-start">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-slate-100 border border-slate-50">
                                            @if($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300"><i data-lucide="image" class="w-5 h-5"></i></div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-bold text-slate-700 line-clamp-2 leading-snug group-hover:text-islami transition-colors">{{ $item->title }}</h4>
                                            <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-wider">{{ $item->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Compact Quick Link Card -->
                    <div class="bg-slate-900 p-8 rounded-[2rem] text-white shadow-xl">
                        <h4 class="text-lg font-black mb-2 italic">Legal Solution</h4>
                        <p class="text-xs text-slate-400 mb-6 leading-relaxed">Cari tahu regulasi terbaru dengan cepat dan mudah melalui portal resmi kami.</p>
                        <a href="{{ route('public.documents.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-islami hover:text-white transition-colors">
                            Telusuri Katalog <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="py-12"></div>

@push('scripts')
<script>
    if (typeof lucide !== 'undefined') lucide.createIcons();
</script>
@endpush
@endsection
