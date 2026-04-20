@extends('layouts.admin')

@section('title', 'Tambah Produk Hukum - JDIH Modern')

@section('content')
<div class="mb-10 flex items-center justify-between">
    <div>
        <a href="{{ route('admin.documents.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-colors mb-4">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar</span>
        </a>
        <h2 class="text-3xl font-black text-slate-900">Publikasi Produk Hukum</h2>
        <p class="text-slate-500 text-sm">Lengkapi 10 Dimensi Klasterisasi & Konten Produk Hukum.</p>
    </div>
    <div class="flex items-center gap-4">
        <button type="button" onclick="document.getElementById('main-form').submit()" style="background-color: #0c1120;" class="px-8 py-4 text-white rounded-2xl font-black uppercase tracking-widest text-xs flex items-center gap-3 hover:opacity-95 shadow-xl transition-all">
            <i data-lucide="check-circle" class="w-5 h-5 text-islami"></i>
            Simpan Dokumen
        </button>
    </div>
</div>

<!-- Tab Navigation -->
<div class="flex items-center gap-2 mb-8 bg-white p-2 rounded-2xl border border-slate-200 w-fit">
    <button onclick="switchTab('info')" id="tab-btn-info" class="tab-btn active px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">1. Info Utama</button>
    <button onclick="switchTab('klasifikasi')" id="tab-btn-klasifikasi" class="tab-btn px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">2. Klasifikasi</button>
    <button onclick="switchTab('konten')" id="tab-btn-konten" class="tab-btn px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">3. Isi Peraturan</button>
    <button onclick="switchTab('pengaturan')" id="tab-btn-pengaturan" class="tab-btn px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">4. Berkas & Akses</button>
</div>

<form id="main-form" action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <!-- Tab 1: Info Utama -->
    <div id="tab-info" class="tab-content space-y-8">
        <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-8">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Judul Lengkap Produk Hukum</label>
                <textarea name="title" rows="3" required placeholder="Contoh: Peraturan Rektor tentang Tata Tertib Mahasiswa..." class="w-full px-6 py-5 bg-slate-50 border-slate-200 rounded-3xl font-bold text-lg focus:ring-0 focus:border-islami transition-all">{{ old('title') }}</textarea>
                @error('title') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Nomor Peraturan</label>
                    <input type="text" name="number" required placeholder="01" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl font-bold focus:ring-0 focus:border-islami">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Tahun Terbit</label>
                    <input type="number" name="year" required value="{{ date('Y') }}" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl font-bold focus:ring-0 focus:border-islami">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Tgl. Penetapan</label>
                    <input type="date" name="tanggal_penetapan" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl font-bold focus:ring-0 focus:border-islami">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Tgl. Pengundangan</label>
                    <input type="date" name="tanggal_pengundangan" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl font-bold focus:ring-0 focus:border-islami">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Abstrak / Ringkasan</label>
                <textarea name="abstrak" rows="4" class="w-full px-6 py-5 bg-slate-50 border-slate-200 rounded-3xl focus:ring-0 focus:border-islami">{{ old('abstrak') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Tab 2: Klasifikasi -->
    <div id="tab-klasifikasi" class="tab-content hidden space-y-8">
        <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-10">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4 flex items-center gap-2">
                    <i data-lucide="package" class="w-4 h-4 text-islami"></i> Klaster Informasi
                </label>
                <select id="cluster_id" class="w-full px-6 py-5 bg-slate-50 border-slate-200 rounded-3xl font-bold focus:ring-0 focus:border-islami appearance-none">
                    <option value="">-- Pilih Klaster --</option>
                    @foreach($clusters as $cluster)
                        <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4 flex items-center gap-2">
                    <i data-lucide="layers" class="w-4 h-4 text-islami"></i> Jenis Produk Hukum
                </label>
                <select name="category_id" id="category_id" required class="w-full px-6 py-5 bg-slate-50 border-slate-200 rounded-3xl font-bold focus:ring-0 focus:border-islami appearance-none">
                    <option value="">-- Pilih Klaster Dahulu --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" data-parent="{{ $cat->parent_id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bidang Hukum -->
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Bidang Hukum</label>
                <select name="subject_id" id="subject_id" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl text-sm font-bold focus:ring-0 focus:border-[#0F9D58] @error('subject_id') border-red-500 @enderror">
                    <option value="">-- Semua Bidang --</option>
                    @foreach($subjects as $sub)
                        <option value="{{ $sub->id }}" {{ old('subject_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Territory Level -->
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Tingkat Wilayah</label>
                <select name="territory_id" id="territory_id" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl text-sm font-bold focus:ring-0 focus:border-[#0F9D58] @error('territory_id') border-red-500 @enderror">
                    <option value="">-- Semua Wilayah --</option>
                    @foreach($territories as $ter)
                        <option value="{{ $ter->id }}" {{ old('territory_id') == $ter->id ? 'selected' : '' }}>{{ $ter->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="territory_level" value="internal">
            </div>

            <!-- Document Function -->
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Fungsi Dokumen</label>
                <select name="function_id" id="function_id" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl text-sm font-bold focus:ring-0 focus:border-[#0F9D58] @error('function_id') border-red-500 @enderror">
                    <option value="">-- Semua Fungsi --</option>
                    @foreach($functions as $fn)
                        <option value="{{ $fn->id }}" {{ old('function_id') == $fn->id ? 'selected' : '' }}>{{ $fn->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="document_function" value="regulative">
            </div>
        </div>
    </div>

    <!-- Tab 3: Konten HTML -->
    <div id="tab-konten" class="tab-content hidden space-y-8">
        <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-widest">Teks Lengkap Peraturan (HTML)</h3>
                    <p class="text-xs text-slate-400">Salin isi lengkap peraturan ke sini untuk tampilan baca online.</p>
                </div>
            </div>
            <textarea name="content_html" rows="20" class="w-full px-6 py-5 bg-slate-50 border-slate-200 rounded-3xl focus:ring-0 focus:border-islami">{{ old('content_html') }}</textarea>
        </div>
    </div>

    <!-- Tab 4: Pengaturan & Berkas -->
    <div id="tab-pengaturan" class="tab-content hidden grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <!-- Relations -->
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-sm font-black uppercase text-slate-900 tracking-widest">Relasi & Hubungan Hukum</h3>
                    <button type="button" onclick="addRelationRow()" class="px-4 py-2 bg-islami text-white rounded-xl text-[10px] font-bold uppercase tracking-widest hover:scale-105 transition-all shadow-lg shadow-green-900/20">
                        Tambah Relasi
                    </button>
                </div>
                <div id="relations-container" class="space-y-4"></div>
            </div>

            <!-- Tags -->
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm">
                <h3 class="text-sm font-black uppercase text-slate-900 tracking-widest mb-6">Tags / Kata Kunci</h3>
                <select name="tags[]" multiple class="w-full jdin-select2-tags">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="space-y-8">
            <!-- Status & Access -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-8">
                <div>
                     <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Status Hukum</label>
                     <select name="legal_status" required class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl font-bold text-sm">
                         @foreach(\App\Enums\LegalStatus::cases() as $ls)
                             <option value="{{ $ls->value }}">{{ $ls->label() }}</option>
                         @endforeach
                     </select>
                </div>

                <div>
                     <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Aksesibilitas</label>
                     <select name="access_level" required class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl font-bold text-sm">
                         @foreach(\App\Enums\AccessLevel::cases() as $al)
                             <option value="{{ $al->value }}">{{ $al->label() }}</option>
                         @endforeach
                     </select>
                </div>

                <div>
                     <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Status Publikasi Admin</label>
                     <select name="status" required class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl font-bold text-sm">
                         @foreach(\App\Enums\DocumentStatus::cases() as $ds)
                             <option value="{{ $ds->value }}">{{ $ds->label() }}</option>
                         @endforeach
                     </select>
                </div>
            </div>

            <!-- File Upload -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm">
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-6 uppercase tracking-widest">Berkas PDF Asli</label>
                <div class="relative group">
                    <div id="file-drop-area" class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-10 flex flex-col items-center justify-center text-slate-400 group-hover:border-islami transition-all">
                        <i data-lucide="upload-cloud" class="w-12 h-12 mb-2 text-slate-300"></i>
                        <p id="file-name-display" class="text-[9px] font-bold uppercase text-center">Tarik file atau klik di sini</p>
                    </div>
                    <input type="file" name="file" id="file-input" required accept=".pdf" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
                <x-input-error :messages="$errors->get('file')" class="mt-2 text-red-500 text-xs" />
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<style>
    .tab-btn.active { background-color: #0c1120; color: white; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
    .tab-btn:not(.active) { color: #94a3b8; }
    .tab-btn:not(.active):hover { color: #0f172a; }
    
    .select2-container .select2-selection--single, .select2-container--default .select2-selection--multiple {
        height: 56px !important; border-radius: 1.5rem !important; border-color: #e2e8f0 !important; background-color: #f8fafc !important; display: flex; align-items: center; padding: 0 10px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 50px !important; }
    .cke_chrome { border-radius: 2rem !important; border-color: #e2e8f0 !important; overflow: hidden; border-width: 1px !important; box-shadow: none !important; }
    .cke_top { background: #ffffff !important; border-bottom: 1px solid #f1f5f9 !important; padding: 8px 20px !important; }
    .cke_bottom { background: #f8fafc !important; border-top: 1px solid #f1f5f9 !important; }
</style>

<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.remove('hidden');
        document.getElementById('tab-btn-' + tabId).classList.add('active');
    }

    // Initialize CKEditors
    const ckConfig = {
        versionCheck: false,
        height: 300,
        allowedContent: true, // Allow all HTML tags and styles
        pasteFromWordRemoveFontStyles: false,
        pasteFromWordRemoveStyles: false,
        autoParagraph: false,
        toolbar: [
            { name: 'clipboard', items: [ 'Mode', '-', 'Undo', 'Redo', 'PasteFromWord' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            { name: 'insert', items: [ 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak' ] },
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks', 'Source' ] }
        ]
    };

    CKEDITOR.replace('title', { ...ckConfig, height: 80 });
    CKEDITOR.replace('abstrak', ckConfig);
    CKEDITOR.replace('content_html', { ...ckConfig, height: 600 });

    $('.jdin-select2-tags').select2({ placeholder: "Pilih atau ketik tag...", tags: true, width: '100%' });

    // File Input Logic
    document.getElementById('file-input').addEventListener('change', function(e) {
        const fileArea = document.getElementById('file-drop-area');
        const fileIcon = fileArea.querySelector('[data-lucide]');
        const fileDisplay = document.getElementById('file-name-display');
        
        if (e.target.files.length > 0) {
            let fileName = e.target.files[0].name;
            fileDisplay.textContent = fileName;
            fileArea.classList.replace('bg-slate-50', 'bg-green-50');
            fileArea.classList.replace('border-slate-200', 'border-green-200');
            fileArea.classList.add('text-green-600');
            
            // Change icon to check-circle
            fileArea.innerHTML = `
                <i data-lucide="check-circle" class="w-12 h-12 mb-2 text-green-500"></i>
                <p id="file-name-display" class="text-[9px] font-black uppercase text-center text-green-700">${fileName}</p>
                <button type="button" onclick="resetFileInput()" class="mt-4 text-[9px] font-black uppercase text-red-400 hover:text-red-500 underline tracking-widest">Ganti / Hapus</button>
            `;
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }
    });

    function resetFileInput() {
        const input = document.getElementById('file-input');
        input.value = '';
        const fileArea = document.getElementById('file-drop-area');
        fileArea.classList.replace('bg-green-50', 'bg-slate-50');
        fileArea.classList.replace('border-green-200', 'border-slate-200');
        fileArea.classList.remove('text-green-600');
        fileArea.innerHTML = `
            <i data-lucide="upload-cloud" class="w-12 h-12 mb-2 text-slate-300"></i>
            <p id="file-name-display" class="text-[9px] font-bold uppercase text-center">Tarik file atau klik di sini</p>
        `;
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    // Hierarchical Taxonomy Logic
    const clusterSelect = document.getElementById('cluster_id');
    const categorySelect = document.getElementById('category_id');

    if (clusterSelect && categorySelect) {
        clusterSelect.addEventListener('change', function() {
            const clusterId = this.value;
            Array.from(categorySelect.options).forEach(option => {
                if (option.value === "") return;
                if (option.getAttribute('data-parent') === clusterId) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
            categorySelect.value = "";
        });
    }

    // Relation Dynamics
    let relationIndex = 0;
    const allDocumentsData = {!! json_encode($allDocuments->map(function($doc) { 
        return [
            'id' => $doc->id, 
            'title' => strip_tags($doc->title), 
            'year' => $doc->year 
        ]; 
    })) !!};

    function addRelationRow() {
        const container = document.getElementById('relations-container');
        const rowId = 'relation-row-' + relationIndex;
        const rowBlock = document.createElement('div');
        rowBlock.id = rowId;
        rowBlock.className = "p-6 bg-slate-50/50 rounded-2xl border border-slate-200 space-y-4 group hover:bg-white transition-all";
        
        let options = '<option value="">Pilih Produk Hukum</option>';
        allDocumentsData.forEach(doc => {
            options += `<option value="${doc.id}">${doc.title} (${doc.year})</option>`;
        });

        rowBlock.innerHTML = `
            <div class="space-y-4">
                <select name="relations[${relationIndex}][related_document_id]" class="w-full jdin-select2" required>
                    ${options}
                </select>
                <div class="flex items-center gap-4">
                    <select name="relations[${relationIndex}][relation_type]" class="flex-1 px-4 py-2 border-slate-200 rounded-xl text-xs font-bold" required>
                         @foreach(\App\Enums\RelationType::cases() as $rt)
                            <option value="{{ $rt->value }}">{{ $rt->label() }}</option>
                         @endforeach
                    </select>
                    <button type="button" onclick="document.getElementById('${rowId}').remove()" class="p-2 text-red-400 hover:text-red-500 transition-all">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        `;
        container.appendChild(rowBlock);
        
        $(`#${rowId} .jdin-select2`).select2({ 
            placeholder: "Cari Produk Hukum...", 
            width: '100%'
        });
        
        if (typeof lucide !== 'undefined') lucide.createIcons();
        relationIndex++;
    }

    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.remove('hidden');
        document.getElementById('tab-btn-' + tabId).classList.add('active');
    }
</script>
@endpush

