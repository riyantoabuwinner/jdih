@extends('layouts.admin')

@section('title', 'Audit Log Sistem')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-black text-slate-900">Jejak Audit</h2>
    <p class="text-slate-500">Pantau setiap perubahan yang terjadi pada basis data sistem.</p>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Waktu</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">User</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Aksi</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Detail Modul</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">IP Address</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 italic-rows text-slate-600">
            @forelse($logs as $log)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-8 py-4 whitespace-nowrap">
                        <span class="text-xs font-bold text-slate-400">{{ $log->created_at->format('d/m/Y H:i') }}</span>
                    </td>
                    <td class="px-8 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black">
                                {{ substr($log->user->name ?? 'S', 0, 1) }}
                            </div>
                            <span class="text-xs font-bold text-slate-900">{{ $log->user->name ?? 'System' }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-4">
                        <span class="text-xs font-bold px-2 py-1 rounded bg-slate-100 uppercase tracking-tighter">{{ $log->action }}</span>
                    </td>
                    <td class="px-8 py-4">
                        <span class="text-xs font-medium">{{ $log->model_type ? class_basename($log->model_type) : 'Generic' }} (ID: {{ $log->model_id ?? '-' }})</span>
                    </td>
                    <td class="px-8 py-4 text-right">
                        <span class="text-[10px] font-mono font-bold text-slate-400">{{ $log->ip_address }}</span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-8 py-12 text-center text-slate-400 italic">Log masih kosong.</td></tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="p-8 bg-slate-50 border-t border-slate-200">
        {{ $logs->links() }}
    </div>
</div>
@endsection
