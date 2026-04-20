@extends('layouts.admin')

@section('title', 'Manajemen FAQ')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900">Pertanyaan Umum</h2>
        <p class="text-slate-500">Kelola daftar pertanyaan yang sering diajukan oleh pengguna.</p>
    </div>
    
    <a href="{{ route('admin.faqs.create') }}" class="px-6 py-3 bg-[#0F9D58] text-white rounded-xl font-bold hover:bg-green-700 transition-all flex items-center gap-2 w-fit">
        <i data-lucide="plus" class="w-5 h-5"></i> Tambah FAQ
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Urutan</th>
                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Pertanyaan</th>
                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($faqs as $faq)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-600">{{ $faq->order }}</span>
                </td>
                <td class="px-6 py-4">
                    <div class="max-w-md">
                        <p class="font-bold text-slate-900 truncate">{{ $faq->question }}</p>
                        <p class="text-xs text-slate-500 truncate mt-1">{{ $faq->answer }}</p>
                    </div>
                </td>
                <td class="px-6 py-4">
                    @if($faq->is_published)
                        <span class="px-3 py-1 bg-green-50 text-[#0F9D58] text-[10px] font-black uppercase rounded-full">Published</span>
                    @else
                        <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black uppercase rounded-full">Draft</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="p-2 text-slate-400 hover:text-[#0F9D58] transition-colors">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-10 text-center">
                    <div class="flex flex-col items-center">
                        <i data-lucide="help-circle" class="w-10 h-10 text-slate-200 mb-2"></i>
                        <p class="text-slate-400 italic">Belum ada FAQ yang dibuat.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $faqs->links() }}
</div>
@endsection
