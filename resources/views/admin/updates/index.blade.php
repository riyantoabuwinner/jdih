@extends('layouts.admin')

@section('title', 'Update Sistem')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900">Update Sistem</h2>
        <p class="text-slate-500 text-sm font-medium">Kelola pembaruan aplikasi langsung dari repository GitHub.</p>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.updates.check') }}" method="POST">
            @csrf
            <button type="submit" class="group flex items-center gap-2 px-6 py-3 bg-[#0c1120] text-white rounded-xl font-bold hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20">
                <i data-lucide="search" class="w-4 h-4 group-hover:rotate-12 transition-transform"></i>
                Cek Pembaruan
            </button>
        </form>
        <form action="{{ route('admin.updates.run') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memperbarui sistem? Pastikan koneksi internet stabil.')">
            @csrf
            <button type="submit" class="group flex items-center gap-2 px-6 py-3 bg-[#0F9D58] text-white rounded-xl font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-900/20">
                <i data-lucide="refresh-cw" class="w-4 h-4 group-hover:rotate-180 transition-transform duration-700"></i>
                Perbarui Sistem
            </button>
        </form>
    </div>
</div>

<div class="space-y-8">
    <!-- Status Card -->
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                <i data-lucide="monitor" class="w-5 h-5"></i>
            </div>
            <h3 class="text-sm font-black uppercase text-slate-700 tracking-widest">Status Branch & Lingkungan Server</h3>
        </div>
        <div class="p-8">
            <div class="flex flex-wrap items-center gap-8 text-sm">
                <div>
                    <span class="text-slate-400 font-medium">Branch:</span>
                    <span class="ml-2 font-bold text-slate-900">{{ $branch }}</span>
                </div>
                <div class="w-px h-4 bg-slate-200"></div>
                <div>
                    <span class="text-slate-400 font-medium">Hash:</span>
                    <span class="ml-2 font-mono font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded text-xs">{{ $hash }}</span>
                </div>
                <div class="w-px h-4 bg-slate-200"></div>
                <div>
                    <span class="text-slate-400 font-medium">Tanggal:</span>
                    <span class="ml-2 font-bold text-slate-900">{{ $date }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Git Log Card -->
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                <i data-lucide="clock" class="w-5 h-5"></i>
            </div>
            <h3 class="text-sm font-black uppercase text-slate-700 tracking-widest">Riwayat Perubahan (Git Log)</h3>
        </div>
        <div class="p-8">
            <div class="bg-[#0f172a] p-8 rounded-[1.5rem] border border-slate-800 shadow-inner">
                <pre class="text-[#4ade80] font-mono text-[11px] leading-relaxed overflow-x-auto custom-scroll">{{ $logs }}</pre>
            </div>
        </div>
    </div>

    <!-- Execution Output Card -->
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-green-500">
                <i data-lucide="terminal" class="w-5 h-5"></i>
            </div>
            <h3 class="text-sm font-black uppercase text-slate-700 tracking-widest">Output Eksekusi Git Pull (Terakhir)</h3>
        </div>
        <div class="p-8">
            <div class="bg-[#0f172a] p-8 rounded-[1.5rem] border border-slate-800 shadow-inner">
                <pre class="text-slate-300 font-mono text-[11px] leading-relaxed whitespace-pre-wrap">{{ $last_output }}</pre>
            </div>
        </div>
    </div>
</div>
@endsection
