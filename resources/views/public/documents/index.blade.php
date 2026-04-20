@extends('layouts.public')

@section('title', 'Daftar Produk Hukum - JDIH UIN Siber')

@section('content')
<!-- Header Section -->
<div class="relative bg-slate-900 overflow-hidden border-b border-white/5">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-islami to-[#0a5c34] opacity-90"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-24 text-center">
        <nav class="flex justify-center items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-white/50 mb-10" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span class="w-1 h-1 bg-white/20 rounded-full"></span>
            <span class="text-white/40">Katalog Produk Hukum</span>
        </nav>
        <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">Peraturan <span class="text-white/60">& Dokumentasi</span></h1>
        <p class="text-green-100/70 text-lg max-w-2xl mx-auto font-medium">Telusuri seluruh peraturan, keputusan rektor, dan dokumen hukum lainnya secara transparan.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid lg:grid-cols-12 gap-8">
        <!-- Sidebar Filter -->
        <aside class="lg:col-span-3 space-y-8">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-6">Filter Pencarian</h3>
                
                <form action="{{ route('public.documents.index') }}" method="GET" class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Kata Kunci</label>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="w-full bg-slate-50 border-transparent rounded-xl focus:bg-white focus:border-islami focus:ring-0 text-sm py-3" placeholder="Cari judul atau nomor...">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Jenis Peraturan</label>
                        <select name="category_id" class="w-full bg-slate-50 border-transparent rounded-xl focus:bg-white focus:border-islami focus:ring-0 text-sm py-3">
                            <option value="">Semua Jenis</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ (isset($filters['category_id']) && $filters['category_id'] == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Bidang Hukum</label>
                        <select name="subject_id" class="w-full bg-slate-50 border-transparent rounded-xl focus:bg-white focus:border-islami focus:ring-0 text-sm py-3">
                            <option value="">Semua Bidang</option>
                            @foreach(\App\Models\Category::where('type', \App\Enums\CategoryType::SUBJECT)->get() as $sub)
                                <option value="{{ $sub->id }}" {{ (isset($filters['subject_id']) && $filters['subject_id'] == $sub->id) ? 'selected' : '' }}>{{ $sub->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Tingkat Wilayah</label>
                        <select name="territory_level" class="w-full bg-slate-50 border-transparent rounded-xl focus:bg-white focus:border-islami focus:ring-0 text-sm py-3">
                            <option value="">Semua Wilayah</option>
                            @foreach(\App\Enums\TerritoryLevel::cases() as $tl)
                                <option value="{{ $tl->value }}" {{ (isset($filters['territory_level']) && $filters['territory_level'] == $tl->value) ? 'selected' : '' }}>{{ $tl->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Tahun</label>
                        <select name="year" class="w-full bg-slate-50 border-transparent rounded-xl focus:bg-white focus:border-islami focus:ring-0 text-sm py-3">
                            <option value="">Semua Tahun</option>
                            @for($y = date('Y'); $y >= 2010; $y--)
                                <option value="{{ $y }}" {{ (isset($filters['year']) && $filters['year'] == $y) ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-islami text-white py-4 rounded-xl font-bold shadow-lg shadow-green-100 hover:bg-green-700 transition-all">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('public.documents.index') }}" class="block text-center text-xs font-bold text-slate-400 uppercase hover:text-red-500 transition-colors">Reset Filter</a>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="lg:col-span-9">
            <div class="flex items-center justify-between mb-8">
                <p class="text-sm text-slate-500 font-medium italic">Menampilkan {{ $documents->total() }} dokumen ditemukan</p>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-slate-400 uppercase">Urutkan:</span>
                    <select class="bg-transparent border-none text-sm font-bold text-slate-900 focus:ring-0 pr-8">
                        <option>Terbaru</option>
                        <option>Terpopuler</option>
                    </select>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($documents as $doc)
                    <div class="p-6 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-islami transition-all duration-500 group">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex flex-col items-center justify-center text-slate-300 group-hover:bg-islami-light group-hover:text-islami transition-all">
                                <span class="text-[10px] font-black uppercase leading-none">PDF</span>
                                <svg width="32" height="32" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-3 py-1 bg-green-100 text-[10px] font-black uppercase text-islami rounded-lg">{{ $doc->category->name }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase">NOMOR {{ $doc->number }} / {{ $doc->year }}</span>
                                </div>
                                <h3 class="text-xl font-bold mb-3 group-hover:text-islami transition-colors">
                                    <a href="{{ route('public.documents.show', $doc->slug) }}">{{ strip_tags($doc->title) }}</a>
                                </h3>
                                <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <svg width="16" height="16" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        {{ ($doc->published_at ?? $doc->created_at)->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg width="16" height="16" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        {{ number_format($doc->view_count) }} Kali Dilihat
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end">
                                <a href="{{ route('public.documents.show', $doc->slug) }}" class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 hover:bg-islami hover:text-white transition-all">
                                    <svg width="24" height="24" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 font-medium">Tidak ada dokumen yang ditemukan.</p>
                    </div>
                @endforelse

                <div class="mt-12">
                    {{ $documents->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
