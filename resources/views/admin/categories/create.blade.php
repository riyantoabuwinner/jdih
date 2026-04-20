@extends('layouts.admin')

@section('title', 'Tambah Kategori/Klaster')

@section('content')
@php
    $typeVal = request('type');
    $typeLabel = $typeVal ? \App\Enums\CategoryType::from($typeVal)->label() : 'Klasifikasi';
    
    $placeholders = [
        'cluster' => 'Misal: Klaster Informasi Dasar',
        'legal_type' => 'Misal: Peraturan Rektor',
        'subject' => 'Misal: Pendidikan & Kebudayaan',
        'territory' => 'Misal: Tingkat Universitas',
        'function' => 'Misal: Fungsi Regulatif',
    ];
    $placeholder = $placeholders[$typeVal] ?? 'Misal: Nama Kategori';
@endphp

<div class="mb-10">
    <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-colors mb-4">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span>Kembali ke Daftar</span>
    </a>
    <h2 class="text-3xl font-black text-slate-900">Tambah {{ $typeLabel }}</h2>
    <p class="text-slate-500">Buat {{ strtolower($typeLabel) }} baru untuk mengorganisir produk hukum.</p>
</div>

<div class="max-w-2xl bg-white p-10 rounded-3xl border border-slate-200 shadow-sm">
    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $hideType = in_array(request('type'), ['subject', 'territory', 'function']);
            @endphp

            @if(!$hideType)
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Tipe {{ $typeLabel }}</label>
                @if(request('type'))
                    <div class="px-5 py-4 bg-slate-100 border border-slate-200 rounded-2xl text-sm font-black text-slate-900 uppercase tracking-widest">
                        {{ $typeLabel }}
                    </div>
                    <input type="hidden" name="type" id="type_select" value="{{ request('type') }}">
                @else
                    <select name="type" id="type_select" required class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl text-sm font-bold focus:ring-0 focus:border-[#0F9D58] @error('type') border-red-500 @enderror">
                        @foreach(\App\Enums\CategoryType::cases() as $type)
                            <option value="{{ $type->value }}" {{ request('type') == $type->value ? 'selected' : '' }}>{{ $type->label() }}</option>
                        @endforeach
                    </select>
                @endif
                @error('type')
                    <p class="text-red-500 text-[10px] mt-2 font-bold uppercase">{{ $message }}</p>
                @enderror
            </div>
            @else
                <input type="hidden" name="type" id="type_select" value="{{ request('type') }}">
            @endif

            <div id="parent_wrapper">
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Induk {{ $typeLabel }}</label>
                <select name="parent_id" id="parent_id" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl text-sm font-bold focus:ring-0 focus:border-[#0F9D58]">
                    <option value="">-- Non Induk (Mulai Hierarki Baru) --</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" data-type="{{ $parent->type->value }}">{{ $parent->name }} ({{ $parent->type->label() }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Nama {{ $typeLabel }}</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="{{ $placeholder }}" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl text-lg font-bold focus:ring-0 focus:border-[#0F9D58] @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p>
            @enderror
        </div>

        <input type="hidden" name="order" value="0">

        <div class="pt-6">
            <button type="submit" 
                    style="background-color: #0c1120; color: white;"
                    class="w-full py-4 rounded-2xl font-bold flex items-center justify-center gap-3 hover:opacity-90 transition-all shadow-xl shadow-slate-900/10">
                <i data-lucide="check-circle" class="w-6 h-6 text-[#0F9D58]"></i>
                Simpan {{ $typeLabel }}
            </button>
        </div>
    </form>
</div>

<script>
    const typeSelect = document.getElementById('type_select');
    const parentWrapper = document.getElementById('parent_wrapper');
    const parentSelect = document.getElementById('parent_id');

    function toggleFormLogic() {
        const type = typeSelect.value;
        
        // Handle Parent Selection visibility and filtering
        if (['subject', 'territory', 'function'].includes(type)) {
            parentWrapper.style.display = 'none';
        } else {
            parentWrapper.style.display = 'block';
            
            // Filter Parent Options
            Array.from(parentSelect.options).forEach(opt => {
                if (opt.value === "") return;
                const parentType = opt.getAttribute('data-type');
                
                if (type === 'legal_type') {
                    // Legal Type must have Cluster as parent
                    opt.style.display = parentType === 'cluster' ? 'block' : 'none';
                } else {
                    // Clusters can have other clusters as parents or be independent
                    opt.style.display = parentType === type ? 'block' : 'none';
                }
            });
            parentSelect.value = "";
        }
    }

    if (typeSelect.tagName === 'SELECT') {
        typeSelect.addEventListener('change', toggleFormLogic);
    }

    // Initial state
    toggleFormLogic();
</script>
@endsection
