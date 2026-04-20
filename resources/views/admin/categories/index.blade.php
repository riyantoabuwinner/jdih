@extends('layouts.admin')

@section('title', 'Kategori & Taksonomi Hukum')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900">Taksonomi Hukum</h2>
        <p class="text-slate-500">Daftar klasifikasi dokumen hukum (Jenis, Bidang, Wilayah, Fungsi).</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.categories.create') }}" class="px-6 py-3 bg-islami text-white rounded-2xl font-bold flex items-center gap-2 hover:scale-105 transition-all shadow-lg shadow-green-900/20">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Tambah Klasifikasi
        </a>
    </div>
</div>

<div class="space-y-12">
    @php
        $displayOrder = [
            \App\Enums\CategoryType::CLUSTER,
            \App\Enums\CategoryType::LEGAL_TYPE,
            \App\Enums\CategoryType::SUBJECT,
            \App\Enums\CategoryType::TERRITORY,
            \App\Enums\CategoryType::FUNCTION,
        ];
    @endphp

    @foreach($displayOrder as $type)
        @php
            $groupCategories = $categories->where('type', $type);
            // In this section, treat categories as 'roots' if their parent is null 
            // OR if their parent belongs to a different Type group.
            $rootForSection = $groupCategories->filter(function($cat) use ($type) {
                return !$cat->parent || $cat->parent->type !== $type;
            });
        @endphp

        @if($groupCategories->count() > 0)
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center gap-4">
                    <div class="px-4 py-2 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-900/10">
                        {{ $type->label() }}
                    </div>
                </div>
                <a href="{{ route('admin.categories.create', ['type' => $type->value]) }}" class="px-4 py-2 bg-islami text-white rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:scale-105 transition-all shadow-lg shadow-green-900/20">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                    Tambah {{ $type->label() }}
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/20">
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-50">Struktur / Nama</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-50 text-center">Jumlah Dokumen</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-50 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($rootForSection as $category)
                            @include('admin.categories.partials.row', ['category' => $category, 'level' => 0, 'onlyType' => $type])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    @endforeach
</div>
@endsection
