@extends('layouts.public')

@section('title', 'Kirim Feedback - JDIH UIN Siber Syekh Nurjati Cirebon')

@section('content')
<!-- Header Section: Compact Green Gradient -->
<div class="relative bg-islami overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-islami via-[#128a4f] to-[#0a5c34] opacity-95"></div>
        <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: url('https://www.transparenttextures.com/patterns/islamic-art.png'); background-size: 300px;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-16 text-center lg:text-left">
        <nav class="flex justify-center lg:justify-start items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-white/50 mb-8" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span class="w-1 h-1 bg-white/20 rounded-full"></span>
            <span class="text-white/40">Feedback & Hubungi Kami</span>
        </nav>
        <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight italic">Hubungi <span class="text-white/60 not-italic">Kami</span></h1>
        <p class="text-green-100/70 text-lg max-w-2xl font-medium">Suara Anda penting bagi kami untuk terus meningkatkan layanan JDIH UIN Siber.</p>
    </div>
</div>

<section class="py-24 bg-white">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-8 p-6 bg-green-50 border border-green-100 rounded-3xl flex items-center gap-4 text-islami">
                <div class="w-12 h-12 bg-islami text-white rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                </div>
                <div>
                    <p class="font-bold text-lg">Berhasil Terkirim!</p>
                    <p class="text-sm opacity-80">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white p-10 rounded-3xl border border-slate-200 shadow-2xl shadow-slate-100">
            <form action="{{ route('public.feedback.store') }}" method="POST">
                @csrf
                <div class="space-y-8">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-400 tracking-widest mb-3">Nama Lengkap (Opsional)</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-islami/20 focus:border-islami outline-none transition-all placeholder:text-slate-300" placeholder="Contoh: Budi Santoso">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-400 tracking-widest mb-3">Email Anda (Opsional)</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-islami/20 focus:border-islami outline-none transition-all placeholder:text-slate-300" placeholder="Contoh: budi@example.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-widest mb-4">Bagaimana Penilaian Anda?</label>
                        <div class="flex items-center gap-4 justify-between bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" {{ $i == 5 ? 'checked' : '' }}>
                                    <div class="flex flex-col items-center gap-2">
                                        <svg width="32" height="32" class="h-8 w-8 text-slate-200 peer-checked:text-yellow-400 peer-checked:fill-current group-hover:text-yellow-400 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        <span class="text-[10px] font-bold text-slate-400 peer-checked:text-slate-900">{{ $i }}</span>
                                    </div>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-widest mb-3">Komentar atau Saran</label>
                        <textarea name="comment" rows="6" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-islami/20 focus:border-islami outline-none transition-all placeholder:text-slate-300" placeholder="Tuliskan pengalaman Anda menggunakan portal JDIH..."></textarea>
                    </div>

                    <button type="submit" class="w-full py-5 bg-islami text-white rounded-2xl font-black uppercase tracking-widest text-sm shadow-xl shadow-green-100 hover:bg-green-700 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Kirim Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
