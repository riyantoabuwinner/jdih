@extends('layouts.public')

@section('title', 'FAQ - JDIH UIN Siber Syekh Nurjati Cirebon')

@section('content')
<!-- JDIH Hero Banner Header (Matching Static Pages Nuance) -->
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
                <span class="text-green-400">Bantuan & FAQ</span>
            </nav>

            <!-- Title (FAQ Style) -->
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">Frequently <span class="text-white/60">Asked Questions</span></h1>

            <!-- Subtitle Accent -->
            <p class="mt-8 text-lg md:text-2xl text-white/80 font-medium max-w-2xl leading-relaxed">
                Jawaban cepat untuk pertanyaan yang paling sering Anda ajukan seputar JDIH.
            </p>
        </div>
    </div>
</div>

<section class="py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">
            @forelse($faqs as $faq)
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-islami transition-all group">
                    <h3 class="text-xl font-bold mb-4 group-hover:text-islami transition-colors flex items-start gap-4">
                        <span class="w-8 h-8 rounded-lg bg-green-100 text-islami flex items-center justify-center flex-shrink-0 text-sm">Q</span>
                        {{ $faq->question }}
                    </h3>
                    <div class="flex items-start gap-4">
                        <span class="w-8 h-8 rounded-lg bg-slate-200 text-slate-500 flex items-center justify-center flex-shrink-0 text-sm">A</span>
                        <p class="text-slate-600 leading-relaxed">{{ $faq->answer }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                    <p class="text-slate-400 font-medium italic">Belum ada FAQ yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20 text-center bg-slate-900 rounded-3xl p-12 text-white">
            <h3 class="text-2xl font-bold mb-4">Masih Butuh Bantuan?</h3>
            <p class="text-slate-400 mb-8">Jangan ragu untuk menghubungi tim kami atau berikan masukan melalui halaman feedback.</p>
            <a href="{{ route('public.feedback') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-islami text-white rounded-xl font-bold hover:bg-green-700 transition-all">
                Berikan Masukan
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </a>
        </div>
    </div>
</section>
@endsection
