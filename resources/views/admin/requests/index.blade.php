@extends('layouts.admin')

@section('title', 'Permintaan Informasi')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-black text-slate-900">Pusat Bantuan & Request</h2>
    <p class="text-slate-500">Daftar permintaan informasi hukum dari masyarakat.</p>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Pengirim</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Subjek</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Tanggal</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($requests as $req)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-8 py-6">
                        <p class="font-bold text-slate-900">{{ $req->name }}</p>
                        <p class="text-xs text-slate-400">{{ $req->email }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm font-medium text-slate-700 truncate max-w-xs">{{ $req->subject ?? 'Permintaan Informasi Hukum' }}</p>
                    </td>
                    <td class="px-8 py-6 text-xs text-slate-400 font-bold">
                        {{ $req->created_at->format('d M Y') }}
                    </td>
                    <td class="px-8 py-6 text-right">
                         <button class="px-4 py-2 bg-slate-900 text-white text-[10px] font-black uppercase rounded-lg hover:bg-slate-800 transition-all">Balas</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-8 py-12 text-center text-slate-400 italic">Belum ada permintaan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
