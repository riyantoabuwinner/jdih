@extends('layouts.admin')

@section('title', 'Manajemen Halaman')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900">Daftar Halaman</h2>
        <p class="text-slate-500">Kelola konten statis dan halaman kustom JDIH.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.pages.create') }}" class="px-6 py-3 bg-[#0F9D58] text-white rounded-2xl font-bold flex items-center gap-2 hover:scale-105 transition-all shadow-lg shadow-green-900/20">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Tambah Halaman
        </a>
    </div>
</div>

<!-- Table Card -->
<div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div id="bulkActionToolbar" class="hidden px-8 py-4 bg-red-50 border-b border-red-100 flex items-center justify-between">
        <p class="text-xs font-bold text-red-600 uppercase tracking-widest leading-none">
            <span id="selectedCount">0</span> Halaman Terpilih
        </p>
        <button type="button" onclick="submitBulkDelete()" class="px-4 py-2 bg-red-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all flex items-center gap-2">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus Masal
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-6 w-10">
                        <input type="checkbox" id="selectAll" class="w-5 h-5 rounded border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer">
                    </th>
                    <th class="px-4 py-6 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Judul Halaman</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Slug / URL</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Tipe</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pages as $page)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-6">
                            <input type="checkbox" name="ids[]" value="{{ $page->id }}" class="row-checkbox w-5 h-5 rounded border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer">
                        </td>
                        <td class="px-4 py-6">
                            <div class="flex items-center gap-4">
                                @if($page->image)
                                    <div class="w-12 h-12 rounded-xl overflow-hidden shadow-sm flex-shrink-0">
                                        <img src="{{ Storage::url($page->image) }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-[#0F9D58] group-hover:text-white transition-all flex-shrink-0">
                                        <i data-lucide="file-text" class="w-6 h-6"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-slate-900 mb-0.5">{{ $page->title }}</p>
                                    <p class="text-xs text-slate-400 font-medium tracking-wide">Terakhir diupdate: {{ $page->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <code class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black">
                                /{{ $page->slug }}
                            </code>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-green-50 text-[#0F9D58] rounded-lg text-[10px] font-black uppercase tracking-widest">
                                Kustom
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('public.pages.show', $page->slug) }}" target="_blank" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="View">
                                    <i data-lucide="external-link" class="w-5 h-5"></i>
                                </a>
                                <a href="{{ route('admin.pages.edit', $page) }}" class="p-2 text-slate-400 hover:text-[#0F9D58] hover:bg-green-50 rounded-lg transition-all" title="Edit">
                                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                                </a>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline" onsubmit="return confirm('Hapus halaman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-400 italic">
                            Belum ada halaman kustom yang tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pages instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="p-8 bg-slate-50/50 border-t border-slate-100">
            {{ $pages->links() }}
        </div>
    @endif
</div>

<!-- Hidden Bulk Delete Form -->
<form id="realBulkDeleteForm" action="{{ route('admin.pages.bulk-delete') }}" method="POST" class="hidden">
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

            if (confirm('Hapus ' + selected.length + ' halaman yang dipilih?')) {
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
