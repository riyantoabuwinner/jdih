@extends('layouts.admin')

@section('title', 'Tambah FAQ')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-2 text-slate-500 hover:text-slate-900 transition-colors mb-4 text-sm font-bold">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar
    </a>
    <h2 class="text-3xl font-black text-slate-900">Tambah FAQ Baru</h2>
</div>

<div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm max-w-2xl">
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Pertanyaan</label>
                <textarea name="question" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0F9D58]/20 focus:border-[#0F9D58] outline-none transition-all" required>{{ old('question') }}</textarea>
                @error('question') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Jawaban</label>
                <textarea name="answer" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0F9D58]/20 focus:border-[#0F9D58] outline-none transition-all" required>{{ old('answer') }}</textarea>
                @error('answer') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Urutan Tampil</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0F9D58]/20 focus:border-[#0F9D58] outline-none transition-all" required>
                    @error('order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Status Publikasi</label>
                    <select name="is_published" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0F9D58]/20 focus:border-[#0F9D58] outline-none transition-all">
                        <option value="1" {{ old('is_published') == '1' ? 'selected' : '' }}>Published</option>
                        <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-[#0F9D58] text-white rounded-xl font-bold hover:bg-green-700 transition-all">Simpan FAQ</button>
            </div>
        </div>
    </form>
</div>
@endsection
