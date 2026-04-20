@extends('layouts.admin')

@section('title', 'Manajemen Feedback')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-black text-slate-900">Masukan Pengguna</h2>
    <p class="text-slate-500">Dengar apa yang dikatakan oleh masyarakat tentang layanan JDIH.</p>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Pengirim & Status</th>
                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Topik & Rating</th>
                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Komentar / Saran</th>
                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($feedbacks as $feedback)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <p class="font-black text-slate-900 leading-tight">{{ $feedback->name ?? 'Anonymous' }}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $feedback->email ?? '-' }}</p>
                    <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-600 text-[9px] font-bold rounded uppercase mt-2 ring-1 ring-slate-200">{{ $feedback->profession ?? 'Umum' }}</span>
                </td>
                <td class="px-6 py-4">
                    <p class="text-[11px] font-bold text-slate-700 mb-2 uppercase tracking-wide">{{ $feedback->subject ?? 'Feedback Layanan' }}</p>
                    <div class="flex items-center gap-1">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i data-lucide="star" class="w-3.5 h-3.5 {{ $i <= $feedback->rating ? 'fill-current' : 'text-slate-200' }}"></i>
                            @endfor
                        </div>
                        <span class="text-[10px] font-black text-slate-400 ml-1">({{ $feedback->rating }})</span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="text-xs text-slate-600 leading-relaxed max-w-md bg-slate-50 p-3 rounded-xl border border-slate-100 italic">"{{ $feedback->comment }}"</p>
                    <p class="text-[9px] text-slate-400 mt-2 font-bold uppercase tracking-widest italic">{{ $feedback->created_at->format('d M Y, H:i') }} ({{ $feedback->created_at->diffForHumans() }})</p>
                </td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST" onsubmit="return confirm('Hapus feedback ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-10 text-center">
                    <div class="flex flex-col items-center">
                        <i data-lucide="message-square" class="w-10 h-10 text-slate-200 mb-2"></i>
                        <p class="text-slate-400 italic">Belum ada feedback dari pengguna.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $feedbacks->links() }}
</div>
@endsection
