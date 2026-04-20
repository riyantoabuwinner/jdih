@extends('layouts.public')

@section('title', 'Kategori: ' . $category->name . ' - JDIH UIN Siber Syekh Nurjati Cirebon')

@section('content')
<!-- Hero Section -->
<div class="relative w-full min-h-[400px] flex items-center overflow-hidden bg-slate-900 border-b border-white/10" style="background-color: #030712;">
    <div class="absolute inset-0">
        <img src="/jdih_hero_banner.png" alt="JDIH Banner" class="w-full h-full object-cover object-center" style="opacity: 0.3; filter: brightness(0.5);">
        <div class="absolute inset-0" style="background: radial-gradient(circle at center, transparent 0%, #030712 100%);"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10 w-full py-20">
        <div class="text-center">
            <nav class="flex items-center justify-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-white/40 mb-8">
                <a href="{{ route('home') }}" class="hover:text-green-400 transition-colors">Beranda</a>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <span class="text-white/40">Warta</span>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <span class="text-green-400">Kategori</span>
            </nav>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">{{ $category->name }}</h1>
            <p class="text-white/60 text-sm max-w-xl mx-auto font-medium leading-relaxed">{{ $category->description ?? 'Kumpulan warta dan informasi terbaru seputar ' . $category->name }}</p>
        </div>
    </div>
</div>

<!-- News Grid -->
<div class="bg-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($news as $item)
                    <a href="{{ route('public.pages.show', $item->slug) }}" class="group flex flex-col bg-slate-50/50 rounded-[2.5rem] p-4 border border-slate-100 hover:bg-white hover:shadow-2xl hover:shadow-green-900/10 transition-all duration-500">
                        <div class="relative w-full aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 bg-slate-200">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <i data-lucide="image" class="w-10 h-10"></i>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-2 bg-white/90 backdrop-blur-md rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-900 shadow-sm border border-white/50">
                                    {{ $category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <h2 class="text-xl font-black text-slate-900 leading-tight mb-4 group-hover:text-green-600 transition-colors line-clamp-2">{{ $item->title }}</h2>
                            <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-green-500 group-hover:text-white transition-all">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-20 flex justify-center">
                {{ $news->links() }}
            </div>
        @else
            <div class="py-20 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="newspaper" class="w-8 h-8 text-slate-300"></i>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-2">Belum ada berita</h3>
                <p class="text-slate-500 text-sm">Tidak ada berita yang ditemukan untuk kategori ini.</p>
                <a href="{{ route('home') }}" class="mt-8 inline-flex items-center gap-3 text-xs font-black uppercase tracking-widest text-green-600 hover:text-green-700 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    if (typeof lucide !== 'undefined') lucide.createIcons();
</script>
@endpush
@endsection
