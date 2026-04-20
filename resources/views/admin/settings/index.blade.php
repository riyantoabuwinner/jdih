@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-black text-slate-900">Konfigurasi JDIH</h2>
    <p class="text-slate-500">Sesuaikan identitas visual dan informasi dasar portal Anda.</p>
</div>

<div class="max-w-4xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Branding Section -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-5 bg-slate-50 border-b border-slate-200">
                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="layout" class="w-4 h-4 text-islami"></i>
                    Identitas Portal
                </h3>
            </div>
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Nama Aplikasi</label>
                        <input type="text" name="app_name" value="{{ $settings['app_name'] ?? 'JDIH UIN Siber' }}" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Tagline Instansi</label>
                        <input type="text" name="app_tagline" value="{{ $settings['app_tagline'] ?? 'Syekh Nurjati Cirebon' }}" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Deskripsi Footer</label>
                    <textarea name="footer_description" rows="3" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">{{ $settings['footer_description'] ?? 'Portal Jaringan Dokumentasi dan Informasi Hukum' }}</textarea>
                </div>
            </div>
        </div>
        
        <!-- Asset Visual Section -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-5 bg-slate-50 border-b border-slate-200">
                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4 text-islami"></i>
                    Aset Visual
                </h3>
            </div>
            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Logo Gelap untuk Header -->
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest">Logo Latar Terang (Header)</label>
                        <div class="relative group">
                            <div class="w-full h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex items-center justify-center overflow-hidden" id="previewContainer_logo_dark">
                                @if(isset($settings['logo_dark']))
                                    <img src="{{ asset('storage/'.$settings['logo_dark']) }}" id="preview_logo_dark" class="max-h-20 w-auto object-contain">
                                @else
                                    <div id="placeholder_logo_dark" class="flex flex-col items-center">
                                        <i data-lucide="image-plus" class="w-8 h-8 text-slate-300"></i>
                                    </div>
                                @endif
                                <input type="file" name="logo_dark" onchange="previewImage(this, 'logo_dark')" class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                            <p class="text-[9px] text-slate-400 mt-2 italic">*Gunakan logo berwarna gelap agar kontras dengan header putih.</p>
                        </div>
                    </div>

                    <!-- Logo Terang untuk Footer -->
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest">Logo Latar Gelap (Footer / Dark Mode)</label>
                        <div class="relative group">
                            <div class="w-full h-32 bg-slate-900 border-2 border-dashed border-slate-700 rounded-2xl flex items-center justify-center overflow-hidden" id="previewContainer_logo_light">
                                @if(isset($settings['logo_light']))
                                    <img src="{{ asset('storage/'.$settings['logo_light']) }}" id="preview_logo_light" class="max-h-20 w-auto object-contain">
                                @else
                                    <div id="placeholder_logo_light" class="flex flex-col items-center">
                                        <i data-lucide="image-plus" class="w-8 h-8 text-slate-600"></i>
                                    </div>
                                @endif
                                <input type="file" name="logo_light" onchange="previewImage(this, 'logo_light')" class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                            <p class="text-[9px] text-slate-400 mt-2 italic">*Gunakan logo berwarna terang (putih/emas) untuk footer & dark mode.</p>
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest">Favicon / Icon Tab</label>
                        <div class="relative group">
                            <div class="w-full h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex items-center justify-center overflow-hidden" id="previewContainer_favicon">
                                @if(isset($settings['favicon']))
                                    <img src="{{ asset('storage/'.$settings['favicon']) }}" id="preview_favicon" class="w-12 h-12 object-contain shadow-sm">
                                @else
                                    <div id="placeholder_favicon" class="flex flex-col items-center">
                                        <i data-lucide="compass" class="w-8 h-8 text-slate-300"></i>
                                    </div>
                                @endif
                                <input type="file" name="favicon" onchange="previewImage(this, 'favicon')" class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                            <p class="text-[9px] text-slate-400 mt-2 italic">*Icon yang muncul pada tab browser.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-5 bg-slate-50 border-b border-slate-200">
                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="mail" class="w-4 h-4 text-islami"></i>
                    Kontak & Alamat
                </h3>
            </div>
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Email Publik</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'jdih@uinsiber.ac.id' }}" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Telepon / WhatsApp</label>
                        <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '+62 123 4567 890' }}" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Alamat Kantor</label>
                    <textarea name="contact_address" rows="2" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">{{ $settings['contact_address'] ?? 'Jl. Perjuangan No. 1, Cirebon, Jawa Barat' }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    style="background-color: #0c1120; color: white;"
                    class="px-10 py-4 rounded-xl font-bold hover:opacity-90 transition-all shadow-xl">
                Simpan Konfigurasi
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input, targetId) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let img = document.getElementById('preview_' + targetId);
                const placeholder = document.getElementById('placeholder_' + targetId);
                const container = document.getElementById('previewContainer_' + targetId);
                
                if (!img) {
                    img = document.createElement('img');
                    img.id = 'preview_' + targetId;
                    img.className = targetId === 'favicon' ? 'w-12 h-12 object-contain shadow-sm' : 'max-h-20 w-auto object-contain';
                    if (placeholder) placeholder.style.display = 'none';
                    container.appendChild(img);
                }
                
                img.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
