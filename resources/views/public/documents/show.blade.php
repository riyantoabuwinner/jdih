@extends('layouts.public')

@section('title', strip_tags($document->title) . ' - JDIH UIN Siber')

@section('content')
<div class="bg-slate-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-3">
                <li><a href="{{ route('home') }}" class="hover:text-islami transition-colors">Beranda</a></li>
                <li class="flex items-center gap-3">
                    <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    <a href="{{ route('public.documents.index') }}" class="hover:text-islami transition-colors">Produk Hukum</a>
                </li>
                <li class="flex items-center gap-3">
                    <i data-lucide="chevron-right" class="w-3 h-3 text-islami"></i>
                    <span class="text-islami truncate max-w-[200px] sm:max-w-md">{{ strip_tags($document->title) }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid lg:grid-cols-12 gap-10">
            <!-- Main Content Area -->
            <div class="lg:col-span-8 space-y-10">
                <!-- Document Header Card -->
                <div class="bg-white p-10 sm:p-14 rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-10 hidden sm:block">
                         <div class="px-6 py-2 bg-islami/10 text-islami rounded-2xl text-[10px] font-black uppercase tracking-widest border border-islami/20">
                             {{ $document->legal_status?->label() ?? 'Berlaku' }}
                         </div>
                    </div>

                    <div class="relative z-10">
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <span class="px-5 py-2 bg-islami text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-green-900/20">{{ $document->category->name }}</span>
                            <div class="flex items-center gap-2 text-slate-400">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <span class="text-[10px] font-bold uppercase tracking-widest">Diterbitkan {{ $document->created_at->format('M Y') }}</span>
                            </div>
                        </div>

                        <h1 class="text-xl sm:text-2xl font-black text-slate-900 leading-snug mb-8">
                            {{ strip_tags($document->title) }}
                        </h1>

                        <!-- Action Tabs -->
                        <div class="flex items-center gap-3 p-1.5 bg-slate-50 rounded-[1.5rem] border border-slate-100 w-full sm:w-fit mb-10">
                            <button onclick="showSection('details')" id="btn-details" class="tab-btn active flex-1 sm:flex-none px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">Rincian</button>
                            <button onclick="showSection('reading')" id="btn-reading" class="tab-btn flex-1 sm:flex-none px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">Baca Online</button>
                            <button onclick="showSection('document')" id="btn-document" class="tab-btn flex-1 sm:flex-none px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">Berkas PDF</button>
                        </div>

                        <!-- Section: Details -->
                        <div id="section-details" class="tab-content transition-all duration-500">
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mb-12 py-8 border-y border-slate-50">
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Nomor</p>
                                    <p class="text-sm font-black text-slate-900">{{ $document->number ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Tahun</p>
                                    <p class="text-sm font-black text-slate-900">{{ $document->year }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Penetapan</p>
                                    <p class="text-sm font-black text-slate-900">{{ $document->tanggal_penetapan?->format('d/m/y') ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Aksesibilitas</p>
                                    <p class="text-sm font-black text-islami uppercase">{{ $document->access_level?->label() ?? 'Publik' }}</p>
                                </div>
                            </div>

                            <div class="prose prose-slate max-w-none">
                                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-900 mb-6 flex items-center gap-3">
                                    <span class="w-10 h-0.5 bg-islami rounded-full"></span>
                                    Abstrak & Ringkasan
                                </h3>
                                <div class="text-slate-600 leading-loose font-medium bg-slate-50/50 p-10 rounded-[2rem] border border-slate-100 italic">
                                    {!! $document->abstrak ? strip_tags($document->abstrak, '<b><i><u><p><br>') : 'Rincian abstrak saat ini tidak tersedia atau dalam proses digitalisasi.' !!}
                                </div>
                            </div>
                        </div>

                        <!-- Section: Reading (Embedded PDF) -->
                        <div id="section-reading" class="tab-content hidden transition-all duration-500">
                            <div class="bg-slate-100 rounded-[2rem] border border-slate-200 overflow-hidden shadow-inner" style="height: 850px;">
                                @if($document->file_path)
                                    <iframe src="{{ route('public.documents.view-pdf', $document->slug) }}#toolbar=0" class="w-full h-full border-none" allow="autoplay"></iframe>
                                @else
                                    <div class="flex flex-col items-center justify-center h-full text-center p-12">
                                        <div class="w-20 h-20 bg-slate-200 rounded-full flex items-center justify-center mb-6">
                                            <i data-lucide="file-x" class="w-10 h-10 text-slate-400"></i>
                                        </div>
                                        <h4 class="text-sm font-black uppercase text-slate-400">Berkas PDF Belum Tersedia</h4>
                                        <p class="text-xs text-slate-400 mt-2">Admin belum mengunggah salinan digital untuk dokumen ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Section: Document PDF -->
                        <div id="section-document" class="tab-content hidden transition-all duration-500">
                            <div class="bg-slate-900 rounded-[2.5rem] p-16 flex flex-col items-center justify-center text-center shadow-2xl relative overflow-hidden group">
                                <div class="absolute inset-0 bg-islami/5 opacity-0 group-hover:opacity-100 transition-all pointer-events-none"></div>
                                @if($document->file_path)
                                    <div class="p-8 bg-white/5 rounded-[2rem] border border-white/10 mb-8 backdrop-blur-sm">
                                        <i data-lucide="file-text" class="w-20 h-20 text-islami"></i>
                                    </div>
                                    <h4 class="text-white font-black uppercase tracking-widest mb-2">Versi PDF Siap</h4>
                                    <p class="text-slate-500 text-xs mb-10 max-w-xs">Dokumen legal resmi dalam format PDF berstempel Digital.</p>
                                    <div class="flex flex-wrap justify-center gap-4">
                                        <a href="{{ route('public.documents.view-pdf', $document->slug) }}" target="_blank" class="px-10 py-5 bg-islami text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-green-900 cover hover:scale-105 hover:bg-green-700 transition-all">
                                            Lihat di Browser
                                        </a>
                                        <a href="{{ route('public.documents.download', $document->slug) }}" class="px-10 py-5 bg-white/10 text-white rounded-2xl font-black text-xs uppercase tracking-widest backdrop-blur-md hover:bg-white/20 transition-all">
                                            Unduh (PDF)
                                        </a>
                                    </div>
                                @else
                                     <p class="text-slate-500 font-bold italic">Maaf, berkas PDF belum diunggah oleh admin.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Legal Dimension Tracker -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-10">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 flex items-center gap-6 shadow-sm">
                         <div class="w-14 h-14 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center">
                             <i data-lucide="map-pin" class="w-6 h-6"></i>
                         </div>
                         <div>
                             <p class="text-[9px] font-black uppercase text-slate-400 tracking-widest leading-none mb-2">Lingkup Wilayah</p>
                             <p class="text-xs font-black text-slate-900">{{ $document->territory_level?->label() ?? 'Internal Institusi' }}</p>
                         </div>
                    </div>
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 flex items-center gap-6 shadow-sm">
                         <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center">
                             <i data-lucide="activity" class="w-6 h-6"></i>
                         </div>
                         <div>
                             <p class="text-[9px] font-black uppercase text-slate-400 tracking-widest leading-none mb-2">Fungsi Dokumen</p>
                             <p class="text-xs font-black text-slate-900">{{ $document->document_function?->label() ?? 'Peraturan Internal' }}</p>
                         </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4 space-y-8">
                <!-- Metadata Stats -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-8">Metadata Utama</h3>
                    <ul class="space-y-6">
                        <li class="flex justify-between items-center pb-5 border-b border-slate-50">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Subjek / Bidang</span>
                            <span class="text-[10px] font-black text-islami uppercase py-1 px-3 bg-islami/5 rounded-lg">{{ $document->subject?->name ?? 'Umum' }}</span>
                        </li>
                        <li class="flex justify-between items-center pb-5 border-b border-slate-50">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Akses</span>
                            <span class="text-[10px] font-black text-slate-900 uppercase">{{ $document->access_level?->label() ?? 'Publik' }}</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Tampilan</span>
                            <span class="text-[10px] font-black text-slate-900">{{ number_format($document->view_count) }} Kali</span>
                        </li>
                    </ul>

                    <div class="mt-10 pt-10 border-t border-slate-50">
                         <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6 uppercase">Tags / Kata Kunci</h4>
                         <div class="flex flex-wrap gap-2">
                             @forelse($document->tags as $tag)
                                 <span class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-islami hover:text-white transition-all cursor-pointer border border-slate-100">{{ $tag->name }}</span>
                             @empty
                                 <span class="text-[9px] italic text-slate-300">Belum ada tag.</span>
                             @endforelse
                         </div>
                    </div>
                </div>

                <!-- Document Relations (Cross-References) -->
                <div class="bg-[#0c1120] p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
                     <div class="absolute -top-10 -right-10 w-40 h-40 bg-islami/10 rounded-full blur-3xl"></div>
                     <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-8 relative z-10">Relasi & Dokumen Terkait</h3>
                     <div class="space-y-4 relative z-10">
                         @forelse($document->relations as $rel)
                             <a href="{{ route('public.documents.show', $rel->relatedDocument->slug) }}" class="block p-5 bg-white/5 rounded-2xl border border-white/5 hover:border-islami transition-all group backdrop-blur-sm">
                                 <span class="inline-block px-2 py-0.5 bg-islami text-[8px] font-black uppercase text-white rounded mb-2">{{ $rel->relation_type->label() }}</span>
                                 <p class="text-[11px] font-bold text-slate-300 line-clamp-2 leading-relaxed group-hover:text-islami transition-colors">{{ strip_tags($rel->relatedDocument->title) }}</p>
                             </a>
                         @empty
                             <div class="py-8 text-center bg-white/5 rounded-3xl border border-dashed border-white/10">
                                 <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Tidak ada relasi</p>
                             </div>
                         @endforelse
                     </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<style>
    .tab-btn.active {
        background-color: #0F9D58;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(15, 157, 88, 0.3);
    }
    .tab-btn:not(.active) {
        color: #94a3b8;
    }
    .tab-btn:not(.active):hover {
        color: #0f172a;
        background-color: #f1f5f9;
    }
    .prose-headings\:font-black h1, h2, h3, h4 { font-weight: 900 !important; }
</style>

<script>
    function showSection(sectionId) {
        // Content
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById('section-' + sectionId).classList.remove('hidden');
        
        // Buttons
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('btn-' + sectionId).classList.add('active');
    }
</script>
@endsection
