@extends('layouts.admin')

@section('title', 'Kategori Berita')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900">Kategori Berita</h2>
        <p class="text-slate-500 text-sm font-medium">Kelola kategori untuk pengelompokan artikel berita.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.news-categories.create') }}" 
           style="background-color: #0F9D58; color: white;"
           class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-900/20">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Tambah Kategori
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden min-w-full">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Nama Kategori</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Deskripsi</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest text-center">Jumlah Berita</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($categories as $category)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-8 py-6">
                        <div>
                            <p class="font-bold text-slate-900">{{ $category->name }}</p>
                            <p class="text-[10px] text-slate-400 font-mono tracking-tighter">{{ $category->slug }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $category->description ?? '-' }}</p>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-widest">
                            {{ $category->news_count }} Berita
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                         <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.news-categories.edit', $category) }}" class="p-2 text-slate-400 hover:text-[#0F9D58] transition-colors"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                            <form action="{{ route('admin.news-categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button class="p-2 text-slate-400 hover:text-red-500"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </form>
                         </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-8 py-12 text-center text-slate-400 italic">Belum ada kategori berita.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
