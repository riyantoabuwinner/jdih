@extends('layouts.admin')

@section('title', 'Admin Intelligence Dashboard')

@section('content')
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden mb-12 rounded-[2rem] bg-gradient-to-r from-slate-900 to-slate-800 p-10 text-white shadow-2xl">
        <div class="relative z-10 max-w-2xl">
            <h2 class="text-3xl font-black mb-4">Statistik & <span class="text-islami">Analitik</span> Hukum</h2>
            <p class="text-slate-400 text-lg leading-relaxed mb-8">Selamat datang di pusat kendali JDIH UIN Siber. Pantau kinerja publikasi dokumen hukum dan interaksi pengguna secara real-time.</p>
            <div class="flex gap-4">
                <a href="{{ route('admin.documents.create') }}" class="px-6 py-3 bg-islami text-white rounded-2xl font-bold flex items-center gap-2 hover:scale-105 transition-all shadow-lg shadow-green-900/40">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    Upload Dokumen Baru
                </a>
                <button class="px-6 py-3 bg-white/10 backdrop-blur text-white rounded-2xl font-bold flex items-center gap-2 hover:bg-white/20 transition-all">
                    <i data-lucide="download" class="w-5 h-5"></i>
                    Export Laporan
                </button>
            </div>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/2 opacity-10 pointer-events-none">
            <i data-lucide="bar-chart-3" class="w-full h-full transform translate-x-20 -translate-y-10"></i>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        @php
            $statsCards = [
                ['label' => 'Total Dokumen', 'value' => \App\Models\Document::count(), 'icon' => 'file-text', 'color' => 'blue', 'trend' => '+12%'],
                ['label' => 'Total Dilihat', 'value' => number_format(\App\Models\Document::sum('view_count')), 'icon' => 'eye', 'color' => 'islami', 'trend' => '+25%'],
                ['label' => 'Total Download', 'value' => number_format(\App\Models\Document::sum('download_count')), 'icon' => 'download-cloud', 'color' => 'purple', 'trend' => '+8%'],
                ['label' => 'Permintaan Akses', 'value' => \App\Models\Request::count(), 'icon' => 'help-circle', 'color' => 'orange', 'trend' => 'New'],
            ];
        @endphp

        @foreach($statsCards as $stat)
            <div class="group p-8 rounded-[2rem] bg-white border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-{{ $stat['color'] }}-50 flex items-center justify-center text-{{ $stat['color'] }} group-hover:bg-islami group-hover:text-white transition-all">
                        <i data-lucide="{{ $stat['icon'] }}" class="w-7 h-7"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase px-2 py-1 rounded-lg {{ $stat['trend'] == 'New' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                        {{ $stat['trend'] }}
                    </span>
                </div>
                <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-2">{{ $stat['label'] }}</p>
                <p class="text-4xl font-black text-slate-900">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-12">
        <!-- Activity Log -->
        <div class="lg:col-span-2 p-10 rounded-[2rem] bg-white border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h3 class="text-xl font-bold">Aktivitas Terkini</h3>
                    <p class="text-sm text-slate-500">Log perubahan sistem terbaru</p>
                </div>
                <a href="#" class="text-xs font-bold text-islami hover:underline uppercase tracking-widest">Lihat Semua</a>
            </div>

            <div class="space-y-8">
                @forelse(\App\Models\Log::latest()->take(5)->get() as $log)
                    <div class="flex items-start gap-6 relative">
                        <div class="w-1 h-full absolute left-6 top-8 bg-slate-100 -z-10"></div>
                        <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400">
                             <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-sm font-bold text-slate-900">{{ $log->user->name ?? 'System' }}</p>
                                <span class="text-[10px] font-medium text-slate-400 italic">{{ $log->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-slate-600">Melakukan <span class="font-bold text-slate-800">{{ $log->action }}</span> pada {{ $log->module ?? 'Sistem' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-slate-400 italic text-sm">Tidak ada aktivitas tercatat.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- System Health / Quick Info -->
        <div class="space-y-12">
            <div class="p-10 rounded-[2rem] bg-islami text-white shadow-xl shadow-green-900/20">
                <h3 class="text-xl font-bold mb-6">Kesehatan Sistem</h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium opacity-80">Database Sync</span>
                        <span class="text-sm font-bold">Online</span>
                    </div>
                    <div class="w-full bg-white/20 h-2 rounded-full overflow-hidden">
                        <div class="bg-white h-full w-[94%]" style="width: 94%"></div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium opacity-80">Storage Usage</span>
                        <span class="text-sm font-bold">1.2 GB / 5 GB</span>
                    </div>
                    <div class="w-full bg-white/20 h-2 rounded-full overflow-hidden">
                        <div class="bg-white h-full w-[24%]" style="width: 24%"></div>
                    </div>
                </div>
            </div>

            <div class="p-10 rounded-[2rem] bg-white border border-slate-100 shadow-sm hover:shadow-lg transition-all">
                <h3 class="text-xl font-bold mb-8">Akses Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.documents.index') }}" class="p-4 rounded-2xl bg-slate-50 hover:bg-slate-900 hover:text-white transition-all flex flex-col items-center text-center gap-3">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">Dokumen</span>
                    </a>
                    <a href="#" class="p-4 rounded-2xl bg-slate-50 hover:bg-slate-900 hover:text-white transition-all flex flex-col items-center text-center gap-3">
                        <i data-lucide="users" class="w-6 h-6"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">Pengguna</span>
                    </a>
                    <a href="#" class="p-4 rounded-2xl bg-slate-50 hover:bg-slate-900 hover:text-white transition-all flex flex-col items-center text-center gap-3">
                        <i data-lucide="settings" class="w-6 h-6"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">Setting</span>
                    </a>
                    <a href="#" class="p-4 rounded-2xl bg-slate-50 hover:bg-slate-900 hover:text-white transition-all flex flex-col items-center text-center gap-3">
                        <i data-lucide="help-circle" class="w-6 h-6"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">Bantuan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
