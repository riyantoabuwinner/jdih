<tr class="hover:bg-slate-50/50 transition-colors group">
    <td class="px-8 py-5">
        <div class="flex items-center gap-3">
            @for($i = 0; $i < $level; $i++)
                <div class="w-6 h-px bg-slate-100 ml-2"></div>
            @endfor
            @if($level > 0)
                <i data-lucide="corner-down-right" class="w-3 h-3 text-slate-300"></i>
            @endif
            <div class="flex flex-col">
                <span class="text-sm font-bold text-slate-900 group-hover:text-islami transition-colors">{{ $category->name }}</span>
                <span class="text-[10px] text-slate-400 font-medium tracking-tight">{{ $category->slug }}</span>
            </div>
        </div>
    </td>
    <td class="px-8 py-5 text-center">
        <span class="px-4 py-1.5 bg-slate-900 shadow-lg shadow-slate-900/10 text-white rounded-xl text-[10px] font-black">
            {{ number_format($category->total_documents_count) }}
        </span>
    </td>
    <td class="px-8 py-5">
        <div class="flex items-center justify-end gap-2">
            <a href="{{ route('admin.categories.edit', $category) }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-islami/10 hover:text-islami transition-all border border-slate-100">
                <i data-lucide="edit-2" class="w-4 h-4"></i>
            </a>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus klasifikasi ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all border border-slate-100">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </td>
</tr>

@foreach($category->children as $child)
    @if(!isset($onlyType) || $child->type === $onlyType)
        @include('admin.categories.partials.row', ['category' => $child, 'level' => $level + 1, 'onlyType' => $onlyType ?? null])
    @endif
@endforeach

