@extends('layouts.admin')

@section('title', 'Manajemen Tags')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900">Tagging System</h2>
        <p class="text-slate-500">Kata kunci untuk mempermudah pencarian AI Semantic.</p>
    </div>
    
    <form action="{{ route('admin.tags.store') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="text" name="name" placeholder="Nama tag baru..." class="px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:ring-0 focus:border-[#0F9D58] min-w-[200px]">
        <button type="submit" class="px-6 py-3 bg-[#0F9D58] text-white rounded-xl font-bold hover:bg-green-700 transition-all">Tambah</button>
    </form>
</div>

<div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
    <div class="flex flex-wrap gap-4">
        @forelse($tags as $tag)
            <div class="group flex items-center gap-2 px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl hover:border-[#0F9D58] transition-all">
                <span class="text-sm font-bold text-slate-700">#{{ $tag->name }}</span>
                <span class="px-2 py-0.5 bg-slate-200 text-slate-600 rounded-md text-[9px] font-black">
                    {{ $tag->documents_count + $tag->pages_count + $tag->news_count }}
                </span>
                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="ml-2">
                    @csrf @method('DELETE')
                    <button class="text-slate-300 hover:text-red-500 transition-colors"><i data-lucide="x" class="w-4 h-4"></i></button>
                </form>
            </div>
        @empty
            <p class="text-slate-400 italic">Belum ada tag yang dibuat.</p>
        @endforelse
    </div>
</div>
@endsection
