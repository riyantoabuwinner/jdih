@extends('layouts.admin')

@section('title', 'Manajemen Backup')

@push('styles')
    @if(($settings['backup_status'] ?? '') == 'processing')
        <meta http-equiv="refresh" content="10">
    @endif
@endpush

@section('content')

@if(($settings['backup_status'] ?? '') == 'processing')
<div class="mb-8 p-8 bg-white border border-slate-200 rounded-3xl shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-orange-100">
                <i data-lucide="loader-2" class="w-6 h-6 animate-spin"></i>
            </div>
            <div>
                <h4 class="text-base font-black text-slate-900 uppercase tracking-widest leading-none">Backup Sedang Berjalan</h4>
                <p class="text-xs text-slate-500 mt-2 font-medium">Sistem sedang mengarsip seluruh basis data dan dokumen.</p>
            </div>
        </div>
        <div class="text-right">
            <span class="text-2xl font-black text-orange-600 tracking-tighter">{{ $settings['backup_progress'] ?? 0 }}%</span>
            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">Selesai</p>
        </div>
    </div>
    <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden border border-slate-50">
        <div class="h-full bg-gradient-to-r from-orange-500 to-orange-400 transition-all duration-700 ease-out shadow-[0_0_20px_rgba(249,115,22,0.3)]" style="width: {{ $settings['backup_progress'] ?? 0 }}%"></div>
    </div>
    <p class="text-[9px] text-orange-600 font-black uppercase tracking-[0.2em] mt-4 text-center">Jangan menutup halaman ini hingga proses selesai</p>
</div>
@elseif(($settings['backup_status'] ?? '') == 'failed')
<div class="mb-8 p-6 bg-red-50 border border-red-100 rounded-2xl flex items-center justify-between">
    <div class="flex items-center gap-4">
        <div class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-red-200">
            <i data-lucide="alert-circle" class="w-6 h-6"></i>
        </div>
        <div>
            <h4 class="text-sm font-black text-red-900 uppercase tracking-widest">Backup Terakhir Gagal</h4>
            <p class="text-xs text-red-700 mt-0.5">{{ $settings['backup_last_error'] ?? 'Terjadi kesalahan tidak diketahui.' }}</p>
        </div>
    </div>
    <form action="{{ route('admin.backups.run') }}" method="POST">
        @csrf
        <button type="submit" class="px-5 py-2 bg-red-600 text-white rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all">Coba Lagi</button>
    </form>
</div>
@endif

<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">System Backup</h2>
        <p class="text-slate-500 mt-1">Kelola cadangan data aplikasi dan basis data secara berkala.</p>
    </div>
    <div class="flex items-center gap-3">
        @if(($settings['backup_status'] ?? '') != 'processing')
        <form action="{{ route('admin.backups.run') }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 bg-islami text-white rounded-xl font-bold flex items-center gap-2 hover:scale-105 transition-all shadow-lg shadow-green-100">
                <i data-lucide="play" class="w-5 h-5"></i>
                Jalankan Backup Sekarang
            </button>
        </form>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- Backup History -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Arsip Backup</h4>
                <div class="flex items-center gap-2 text-slate-400">
                    <i data-lucide="archive" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Nama File</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Ukuran</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Dibuat Pada</th>
                            <th class="px-8 py-4 text-right text-[10px] font-black uppercase text-slate-400 tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($backups as $backup)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-5">
                                <span class="text-sm font-bold text-slate-900">{{ $backup['name'] }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-xs font-semibold text-slate-500">{{ $backup['size'] }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-xs font-semibold text-slate-500">{{ $backup['created_at']->format('d M Y, H:i') }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.backups.download', $backup['name']) }}" class="p-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-900 hover:text-white transition-all" title="Download">
                                        <i data-lucide="download" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.backups.destroy', $backup['name']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus backup ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center text-slate-400 italic text-sm">
                                <div class="flex flex-col items-center gap-3">
                                    <i data-lucide="folder-x" class="w-12 h-12 opacity-20"></i>
                                    Belum ada data backup yang tersimpan.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Backup Settings -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden p-8">
            <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6 flex items-center gap-2">
                <i data-lucide="settings" class="w-4 h-4 text-islami"></i>
                Pengaturan Backup
            </h4>
            
            <form action="{{ route('admin.backups.updateSettings') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Periode Backup Otomatis</label>
                    <select name="backup_frequency" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-islami focus:border-islami outline-none transition-all text-sm font-bold">
                        <option value="none" {{ ($settings['backup_frequency'] ?? '') == 'none' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="daily" {{ ($settings['backup_frequency'] ?? '') == 'daily' ? 'selected' : '' }}>Harian (Setiap Hari)</option>
                        <option value="weekly" {{ ($settings['backup_frequency'] ?? '') == 'weekly' ? 'selected' : '' }}>Mingguan (Setiap Minggu)</option>
                        <option value="monthly" {{ ($settings['backup_frequency'] ?? '') == 'monthly' ? 'selected' : '' }}>Bulanan (Setiap Bulan)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Retensi Backup (Hari)</label>
                    <input type="number" name="backup_retention" value="{{ $settings['backup_retention'] ?? 30 }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-islami focus:border-islami outline-none transition-all text-sm font-bold" placeholder="Contoh: 30">
                    <p class="text-[9px] text-slate-500 mt-2 italic">Backup yang lebih lama dari jumlah hari ini akan dihapus otomatis untuk menghemat ruang.</p>
                </div>

                <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-black transition-all flex items-center justify-center gap-2 shadow-lg">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Pengaturan
                </button>
            </form>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
            <div class="flex gap-4">
                <i data-lucide="info" class="w-6 h-6 text-blue-600 flex-shrink-0"></i>
                <div>
                    <h5 class="text-xs font-black text-blue-900 uppercase tracking-widest mb-1">Catatan Penting</h5>
                    <p class="text-xs text-blue-700 leading-relaxed">
                        Proses backup mencakup seluruh basis data dan file unggahan (PDF, Gambar). File cadangan disimpan secara aman di folder <code>storage/app/backups</code>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
