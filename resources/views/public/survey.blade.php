@extends('layouts.public')

@section('title', 'Survey Kepuasan Layanan - JDIH UIN Siber Cirebon')

@section('content')
<div class="min-h-screen bg-[#fafafa] py-20">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header Section -->
        <div class="text-center mb-16 animate-fade-in">
            <span class="px-4 py-1.5 bg-islami/10 text-islami text-[10px] font-black uppercase tracking-[0.3em] rounded-full inline-block mb-6">Feedback & Survey</span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">Survey Kepuasan Layanan</h1>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                Bantu kami meningkatkan kualitas layanan informasi hukum di JDIH UIN Siber Syekh Nurjati Cirebon dengan memberikan masukan berharga Anda.
            </p>
        </div>

        @if(session('success'))
        <div class="mb-10 p-6 bg-green-50 border border-green-100 rounded-3xl flex items-center gap-6 animate-bounce-in">
            <div class="w-14 h-14 bg-green-500 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-green-100 flex-shrink-0">
                <i data-lucide="check-circle-2" class="w-8 h-8"></i>
            </div>
            <div>
                <h4 class="text-lg font-black text-green-900">Masukan Berhasil Terkirim!</h4>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <form action="{{ route('public.survey.store') }}" method="POST" class="bg-white rounded-[2.5rem] p-10 md:p-16 shadow-2xl shadow-slate-200/50 border border-slate-100 animate-slide-up">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                <!-- Name -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black uppercase tracking-widest text-slate-400">Nama Lengkap</label>
                    <div class="relative group">
                        <i data-lucide="user" class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-islami transition-colors"></i>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama Anda" 
                        class="w-full pl-14 pr-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-islami outline-none transition-all font-bold text-slate-900 @error('name') border-red-200 bg-red-50 @enderror">
                    </div>
                    @error('name') <p class="text-[10px] text-red-500 font-bold uppercase tracking-wider pl-4">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black uppercase tracking-widest text-slate-400">Alamat Email</label>
                    <div class="relative group">
                        <i data-lucide="mail" class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-islami transition-colors"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" 
                        class="w-full pl-14 pr-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-islami outline-none transition-all font-bold text-slate-900 @error('email') border-red-200 bg-red-50 @enderror">
                    </div>
                    @error('email') <p class="text-[10px] text-red-500 font-bold uppercase tracking-wider pl-4">{{ $message }}</p> @enderror
                </div>

                <!-- Profession -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black uppercase tracking-widest text-slate-400">Pekerjaan / Status</label>
                    <div class="relative group">
                        <i data-lucide="briefcase" class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-islami transition-colors"></i>
                        <select name="profession" class="w-full pl-14 pr-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-islami outline-none transition-all font-bold text-slate-900 appearance-none @error('profession') border-red-200 bg-red-50 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="Mahasiswa" {{ old('profession') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="Dosen / Pegawai" {{ old('profession') == 'Dosen / Pegawai' ? 'selected' : '' }}>Dosen / Pegawai</option>
                            <option value="Alumni" {{ old('profession') == 'Alumni' ? 'selected' : '' }}>Alumni</option>
                            <option value="Masyarakat Umum" {{ old('profession') == 'Masyarakat Umum' ? 'selected' : '' }}>Masyarakat Umum</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 pointer-events-none"></i>
                    </div>
                    @error('profession') <p class="text-[10px] text-red-500 font-bold uppercase tracking-wider pl-4">{{ $message }}</p> @enderror
                </div>

                <!-- Subject -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black uppercase tracking-widest text-slate-400">Subjek Masukan</label>
                    <div class="relative group">
                        <i data-lucide="tag" class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-islami transition-colors"></i>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Contoh: Akses Dokumen, Tampilan, dll" 
                        class="w-full pl-14 pr-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-islami outline-none transition-all font-bold text-slate-900 @error('subject') border-red-200 bg-red-50 @enderror">
                    </div>
                    @error('subject') <p class="text-[10px] text-red-500 font-bold uppercase tracking-wider pl-4">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Quality Rating -->
            <div class="mb-12">
                <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 block mb-6 text-center">Seberapa puas Anda dengan layanan JDIH kami?</label>
                <div class="flex items-center justify-center gap-4 flex-wrap">
                    @for($i = 1; $i <= 5; $i++)
                    <label class="relative group cursor-pointer">
                        <input type="radio" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} class="peer absolute opacity-0">
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-50 border-2 border-slate-50 rounded-3xl flex flex-col items-center justify-center gap-1 transition-all group-hover:scale-110 peer-checked:bg-islami peer-checked:border-islami peer-checked:text-white shadow-sm group-hover:shadow-xl group-hover:shadow-slate-200 peer-checked:shadow-islami/30">
                            <i data-lucide="star" class="w-6 h-6 md:w-8 md:h-8 {{ old('rating') >= $i ? 'fill-current' : 'text-slate-300 group-hover:text-islami' }} peer-checked:text-white"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest {{ old('rating') == $i ? 'text-white' : 'text-slate-400' }}">{{ $i }}</span>
                        </div>
                    </label>
                    @endfor
                </div>
                @error('rating') <p class="text-[10px] text-red-500 font-bold uppercase tracking-wider mt-4 text-center">{{ $message }}</p> @enderror
            </div>

            <!-- Comment -->
            <div class="space-y-3 mb-12">
                <label class="text-[11px] font-black uppercase tracking-widest text-slate-400">Komentar / Saran Anda</label>
                <textarea name="comment" rows="5" placeholder="Tuliskan masukan atau saran Anda di sini..." 
                class="w-full px-8 py-6 bg-slate-50 border-2 border-slate-50 rounded-3xl focus:bg-white focus:border-islami outline-none transition-all font-bold text-slate-900 @error('comment') border-red-200 bg-red-50 @enderror">{{ old('comment') }}</textarea>
                @error('comment') <p class="text-[10px] text-red-500 font-bold uppercase tracking-wider pl-4">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="group relative px-12 py-5 bg-islami text-white font-black uppercase tracking-[0.2em] rounded-2xl shadow-2xl shadow-islami/30 hover:scale-105 active:scale-95 transition-all">
                    <span class="relative z-10 flex items-center gap-3">
                        Kirim Survey Sekarang
                        <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                    </span>
                    <div class="absolute inset-0 bg-white/20 blur-xl rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </button>
            </div>
        </form>

        <!-- Visual Decorative Elements -->
        <div class="mt-20 text-center text-slate-400 text-xs font-medium uppercase tracking-[0.3em]">
            &bull; JDIH UIN Siber Syekh Nurjati Cirebon &bull;
        </div>
    </div>
</div>

<style>
    @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes bounce-in { 0% { transform: scale(0.9); opacity: 0; } 70% { transform: scale(1.1); } 100% { transform: scale(1); opacity: 1; } }
    .animate-fade-in { animation: fade-in 1s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-bounce-in { animation: bounce-in 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    
    input::placeholder, textarea::placeholder {
        font-weight: 600;
        letter-spacing: 0;
        text-transform: none;
        opacity: 0.4;
    }
</style>
@endsection
