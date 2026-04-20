@extends('layouts.admin')

@section('title', 'Tambah Kategori Berita')

@section('content')
<div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden max-w-2xl mx-auto">
    <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <div>
            <h2 class="text-xl font-bold text-slate-900 leading-none">Tambah Kategori</h2>
            <p class="text-xs text-slate-500 uppercase font-black tracking-widest mt-2">Buat kategori berita baru</p>
        </div>
        <a href="{{ route('admin.news-categories.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali
        </a>
    </div>

    <div class="p-8">
        <form action="{{ route('admin.news-categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest mb-3">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all"
                    placeholder="Masukkan nama kategori (misal: Kegiatan Kampus)..." required>
                @error('name') <p class="text-xs text-red-500 mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest mb-3">Deskripsi (Opsional)</label>
                <textarea name="description" rows="4" 
                    class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all"
                    placeholder="Jelaskan penggunaan kategori ini...">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-red-500 mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-[#0F9D58] hover:bg-green-700 text-white rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-green-900/20 flex items-center justify-center gap-3">
                    <i data-lucide="send" class="w-4 h-4"></i> Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
