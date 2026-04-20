@extends('layouts.admin')

@section('title', 'Edit Halaman: ' . $page->title)

@section('content')
<div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <div>
            <h2 class="text-xl font-bold text-slate-900 leading-none">Manajemen Halaman</h2>
            <p class="text-xs text-slate-500 uppercase font-black tracking-widest mt-2">Edit: {{ $page->title }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('public.pages.show', $page->slug) }}" target="_blank" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all flex items-center gap-2">
                <i data-lucide="eye" class="w-3.5 h-3.5"></i> Lihat
            </a>
            <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali
            </a>
        </div>
    </div>

    <div class="p-8">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" id="pageForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Left Side: Content Editor -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Title -->
                    <div>
                        <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest mb-3">Judul Halaman</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" 
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-lg font-bold focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all"
                            placeholder="Masukkan judul halaman..." required>
                        @error('title') <p class="text-xs text-red-500 mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest mb-3">Slug / Permalink (URL)</label>
                        <div class="flex items-center gap-2">
                            <span class="text-slate-400 font-medium text-sm">{{ url('/') }}/</span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug) }}" 
                                class="flex-1 px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all"
                                placeholder="judul-halaman" required>
                        </div>
                        @error('slug') <p class="text-xs text-red-500 mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Content with Tabs -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest">Isi Konten</label>
                            <div class="flex bg-slate-100 p-1 rounded-xl">
                                <button type="button" onclick="switchTab('view')" id="btn-view" class="px-4 py-1.5 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all bg-white shadow-sm text-islami">View</button>
                                <button type="button" onclick="switchTab('code')" id="btn-code" class="px-4 py-1.5 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all text-slate-500">Code</button>
                            </div>
                        </div>

                        <div id="editor-container">
                            <textarea name="content" id="editor" rows="20" class="hidden">{{ old('content', $page->content) }}</textarea>
                        </div>
                        
                        <div id="code-container" class="hidden">
                            <textarea id="code-editor" class="w-full px-8 py-6 bg-[#0f172a] text-[#4ade80] border border-slate-700 rounded-[2rem] text-sm font-mono focus:ring-4 focus:ring-green-500/10 transition-all shadow-2xl resize-none" style="color: #4ade80 !important; background-color: #0f172a !important; height: 600px !important; min-height: 600px !important;" placeholder="<html>...</html>">{{ old('content', $page->content) }}</textarea>
                        </div>
                        
                        @error('content') <p class="text-xs text-red-500 mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- SEO Section -->
                    <div class="pt-8 border-t border-slate-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500">
                                <i data-lucide="search" class="w-4 h-4"></i>
                            </div>
                            <h3 class="text-sm font-black uppercase tracking-widest text-slate-700">Pengaturan SEO</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-6 bg-slate-50/50 p-8 rounded-[2rem] border border-slate-100">
                            <div>
                                <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest mb-3">SEO Title (Meta Title)</label>
                                <input type="text" name="seo_title" value="{{ old('seo_title', $page->metadata['seo_title'] ?? '') }}" 
                                    class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all"
                                    placeholder="Judul untuk mesin pencari...">
                            </div>

                            <div>
                                <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest mb-3">SEO Description (Meta Description)</label>
                                <textarea name="seo_description" rows="3" 
                                    class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all"
                                    placeholder="Deskripsi singkat untuk mesin pencari...">{{ old('seo_description', $page->metadata['seo_description'] ?? '') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest mb-3">SEO Keywords</label>
                                <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $page->metadata['seo_keywords'] ?? '') }}" 
                                    class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all"
                                    placeholder="Kata kunci dipisahkan koma (misal: hukum, jdih, uin)...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Settings & Media -->
                <div class="space-y-8">
                    <!-- Image Preview Area -->
                    <div class="bg-slate-50 p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                        <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest mb-4">Preview Image</label>
                        
                        <div id="image-preview" class="relative aspect-video bg-slate-100 rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden mb-4 group">
                            @if($page->image)
                                <img id="img-target" src="{{ Storage::url($page->image) }}" class="w-full h-full object-cover">
                                <div id="preview-placeholder" class="hidden text-center p-4">
                                    <i data-lucide="image" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Belum ada gambar</p>
                                </div>
                            @else
                                <div id="preview-placeholder" class="text-center p-4">
                                    <i data-lucide="image" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Belum ada gambar</p>
                                </div>
                                <img id="img-target" class="hidden w-full h-full object-cover">
                            @endif
                            
                            <label for="image" class="absolute inset-0 cursor-pointer flex items-center justify-center bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="px-4 py-2 bg-white text-slate-900 rounded-xl text-[10px] font-black uppercase tracking-widest">Ganti Gambar</span>
                            </label>
                        </div>

                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                        
                        <p class="text-[9px] text-slate-400 font-medium leading-relaxed italic border-t border-slate-200 pt-4 mt-4 text-center">
                            Ukuran maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.
                        </p>
                        @error('image') <p class="text-xs text-red-500 mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Hashtags / Tags Area -->
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-[10px] uppercase font-black text-slate-500 tracking-widest">Hashtags</label>
                            <a href="{{ route('admin.tags.index') }}" target="_blank" class="text-[9px] font-black uppercase text-blue-500 hover:underline">Kelola Hashtag</a>
                        </div>
                        
                        <div class="max-h-60 overflow-y-auto custom-scroll pr-2 space-y-2">
                            @php $selectedTags = $page->tags->pluck('id')->toArray(); @endphp
                            @foreach($tags as $tag)
                                <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition-all border border-transparent has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 group">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="w-4 h-4 rounded text-blue-500 focus:ring-blue-500 border-slate-300" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                                    <span class="text-xs font-bold text-slate-600 group-has-[:checked]:text-blue-700">#{{ $tag->name }}</span>
                                </label>
                            @endforeach
                            @if($tags->isEmpty())
                                <p class="text-[10px] text-slate-400 italic text-center py-4">Belum ada hashtag tersedia.</p>
                            @endif
                        </div>
                        <p class="text-[9px] text-slate-400 font-medium mt-4 leading-relaxed">
                            Hashtag akan membantu dalam pencarian konten.
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="bg-[#080c18] p-8 rounded-[2rem] shadow-xl shadow-slate-900/20 text-white">
                        <h3 class="text-sm font-bold mb-4 flex items-center gap-2">
                            <i data-lucide="save" class="w-4 h-4 text-green-400"></i> Update
                        </h3>
                        <p class="text-xs text-slate-400 mb-8 leading-relaxed">
                            Pembaruan akan langsung berakibat pada tampilan publik.
                        </p>
                        <button type="submit" class="w-full py-4 bg-[#0F9D58] hover:bg-green-700 text-white rounded-2xl text-xs font-black uppercase tracking-widest transition-all flex items-center justify-center gap-3">
                            <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Title to Slug Auto-fill (only if not system page and title changes)
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    titleInput.addEventListener('input', function() {
        const slug = this.value.toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
        slugInput.value = slug;
    });

    // Image Preview
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('img-target');
            const placeholder = document.getElementById('preview-placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // TinyMCE Init
    tinymce.init({
        selector: '#editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat code',
        height: 600,
        border_radius: '1rem',
        skin: 'oxide',
        content_css: 'default',
        setup: function (editor) {
            editor.on('init', function() {
                document.getElementById('code-editor').value = editor.getContent();
            });
            editor.on('change keyup nodechange', function () {
                editor.save();
                document.getElementById('code-editor').value = editor.getContent();
            });
        }
    });

    // Real-time Sync from Code to View while typing in Code Tab
    document.getElementById('code-editor').addEventListener('input', function() {
        tinymce.get('editor').setContent(this.value);
    });

    // Tab Switching Logic
    function switchTab(type) {
        const btnView = document.getElementById('btn-view');
        const btnCode = document.getElementById('btn-code');
        const viewContainer = document.getElementById('editor-container');
        const codeContainer = document.getElementById('code-container');
        const codeEditor = document.getElementById('code-editor');

        if (type === 'view') {
            btnView.classList.add('bg-white', 'shadow-sm', 'text-islami');
            btnView.classList.remove('text-slate-500');
            btnCode.classList.remove('bg-white', 'shadow-sm', 'text-islami');
            btnCode.classList.add('text-slate-500');

            viewContainer.classList.remove('hidden');
            codeContainer.classList.add('hidden');

            // Sync from Code to View
            tinymce.get('editor').setContent(codeEditor.value);
        } else {
            btnCode.classList.add('bg-white', 'shadow-sm', 'text-islami');
            btnCode.classList.remove('text-slate-500');
            btnView.classList.remove('bg-white', 'shadow-sm', 'text-islami');
            btnView.classList.add('text-slate-500');

            viewContainer.classList.add('hidden');
            codeContainer.classList.remove('hidden');

            // Sync from View to Code
            codeEditor.value = tinymce.get('editor').getContent();
        }
    }
</script>
@endpush
@endsection
