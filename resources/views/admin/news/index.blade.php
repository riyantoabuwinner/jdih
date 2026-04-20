@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900">Daftar Berita</h2>
        <p class="text-slate-500 text-sm font-medium">Kelola artikel, informasi, dan update hukum terbaru.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.news.create') }}" 
           style="background-color: #0F9D58; color: white;"
           class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-900/20">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Tulis Berita
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden min-w-full">
    <div id="bulkActionToolbar" class="hidden px-8 py-4 bg-red-50 border-b border-red-100 flex items-center justify-between">
        <p class="text-xs font-bold text-red-600 uppercase tracking-widest leading-none">
            <span id="selectedCount">0</span> Berita Terpilih
        </p>
        <button type="button" onclick="submitBulkDelete()" class="px-4 py-2 bg-red-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all flex items-center gap-2">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus Masal
        </button>
    </div>
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-8 py-5 w-10">
                    <input type="checkbox" id="selectAll" class="w-5 h-5 rounded border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer">
                </th>
                <th class="px-4 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Judul & Penulis</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Status</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Tanggal</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($news as $article)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-8 py-6">
                        <input type="checkbox" name="ids[]" value="{{ $article->id }}" class="row-checkbox w-5 h-5 rounded border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer">
                    </td>
                    <td class="px-4 py-6">
                        <div class="flex items-center gap-4">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </div>
                            @endif
                            <div>
                                <p class="font-bold text-slate-900">{{ $article->title }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[9px] text-slate-400 uppercase font-black tracking-tighter">Oleh: {{ $article->creator->name ?? 'Admin' }}</span>
                                    @if($article->category)
                                        <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                        <span class="text-[9px] text-[#0F9D58] uppercase font-black tracking-tighter">{{ $article->category->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($article->status == 'published')
                            <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-[10px] font-black uppercase tracking-widest">Published</span>
                        @else
                            <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-[10px] font-black uppercase tracking-widest">Draft</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-xs font-bold text-slate-600">{{ ($article->published_at ? \Carbon\Carbon::parse($article->published_at) : $article->created_at)->format('d M Y') }}</p>
                    </td>
                    <td class="px-8 py-6 text-right">
                         <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.news.edit', $article) }}" class="p-2 text-slate-400 hover:text-[#0F9D58] transition-colors"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button class="p-2 text-slate-400 hover:text-red-500"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </form>
                         </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-8 py-12 text-center text-slate-400 italic">Belum ada berita.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($news instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="px-8 py-4 bg-slate-50 border-t border-slate-100">
            {{ $news->links() }}
        </div>
    @endif
</div>

<!-- Hidden Bulk Delete Form -->
<form id="realBulkDeleteForm" action="{{ route('admin.news.bulk-delete') }}" method="POST" class="hidden">
    @csrf
    <div id="bulkDeleteInputs"></div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const actionToolbar = document.getElementById('bulkActionToolbar');
        const selectedCountLabel = document.getElementById('selectedCount');

        function updateToolbar() {
            const selectedCount = document.querySelectorAll('.row-checkbox:checked').length;
            selectedCountLabel.textContent = selectedCount;
            
            if (selectedCount > 0) {
                actionToolbar.classList.remove('hidden');
                actionToolbar.classList.add('flex');
            } else {
                actionToolbar.classList.add('hidden');
                actionToolbar.classList.remove('flex');
            }
        }

        if(selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => {
                    cb.checked = this.checked;
                });
                updateToolbar();
            });
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                if (!this.checked) {
                    selectAll.checked = false;
                } else {
                    const allChecked = document.querySelectorAll('.row-checkbox:checked').length === checkboxes.length;
                    selectAll.checked = allChecked;
                }
                updateToolbar();
            });
        });

        window.submitBulkDelete = function() {
            const selected = document.querySelectorAll('.row-checkbox:checked');
            if (selected.length === 0) return;

            if (confirm('Hapus ' + selected.length + ' berita yang dipilih?')) {
                const form = document.getElementById('realBulkDeleteForm');
                const inputsContainer = document.getElementById('bulkDeleteInputs');
                inputsContainer.innerHTML = '';
                
                selected.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = cb.value;
                    inputsContainer.appendChild(input);
                });
                
                form.submit();
            }
        };
    });
</script>
@endpush
@endsection
