<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    @php
        $favicon = !empty($global_settings['favicon']) ? asset('storage/'.$global_settings['favicon']) : asset('favicon.ico');
        $logoUrl = !empty($global_settings['logo']) ? asset('storage/'.$global_settings['logo']) : null;
        $appName = !empty($global_settings['app_name']) ? $global_settings['app_name'] : 'Jaringan Dokumentasi dan Informasi Hukum';
    @endphp
    <link rel="icon" type="image/png" href="{{ $favicon }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-islami { background-color: #0F9D58; }
        .text-islami { color: #0F9D58; }
        .border-islami { border-color: #0F9D58; }
        .focus-ring-islami:focus { --tw-ring-color: rgba(15, 157, 88, 0.5); border-color: #0F9D58; }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 bg-white selection:bg-[#0F9D58] selection:text-white">
    <style>
        /* Fallback anti-purge untuk menyembunyikan gambar di layar HP */
        @media (max-width: 767px) {
            .mobile-hide { display: none !important; }
        }
    </style>
    <div class="grid grid-cols-1 md:grid-cols-2 min-h-screen w-full bg-white">
        
        <!-- Left Side: Clean Modern Form -->
        <div class="w-full h-full flex flex-col justify-center items-center px-6 sm:px-12 py-12 relative bg-white overflow-y-auto" style="border-right: 1px solid #e2e8f0;">
            
            <div class="w-full max-w-md relative z-10">
                
                <!-- Identitas Institusi / App Title -->
                <div class="text-center mb-10">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="Logo Instansi" class="h-16 w-auto object-contain mx-auto mb-6">
                    @else
                        <div class="h-16 w-16 bg-gradient-to-br from-[#0F9D58] to-emerald-400 rounded-2xl flex items-center justify-center shadow-lg shadow-green-200/50 mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight leading-tight">
                        Selamat Datang
                    </h1>
                    <p class="text-sm font-semibold text-slate-500 mt-2 uppercase tracking-wide">
                        Masuk ke Panel Admin
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-6">
                        <!-- Email Address -->
                        <div>
                            <div class="relative rounded-xl shadow-sm group">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none transition-colors group-focus-within:text-[#0F9D58]" style="padding-left: 1rem;">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#0F9D58] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required class="block w-full bg-slate-50 border border-slate-200 rounded-xl placeholder-slate-400 text-slate-900 focus:bg-white focus:outline-none focus:border-[#0F9D58] focus:ring-1 focus:ring-[#0F9D58] transition-all duration-300 sm:text-sm font-medium shadow-sm" placeholder="Email Address / Username" value="{{ old('email') }}" style="padding-top: 0.875rem; padding-bottom: 0.875rem; padding-left: 3rem; padding-right: 1rem;">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="relative rounded-xl shadow-sm group">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none transition-colors group-focus-within:text-[#0F9D58]" style="padding-left: 1rem;">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#0F9D58] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full bg-slate-50 border border-slate-200 rounded-xl placeholder-slate-400 text-slate-900 focus:bg-white focus:outline-none focus:border-[#0F9D58] focus:ring-1 focus:ring-[#0F9D58] transition-all duration-300 sm:text-sm font-medium shadow-sm" placeholder="Password" style="padding-top: 0.875rem; padding-bottom: 0.875rem; padding-left: 3rem; padding-right: 3.5rem;">
                                @if (Route::has('password.request'))
                                    <div class="absolute inset-y-0 right-0 flex items-center" style="padding-right: 1rem;">
                                        <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-slate-400 hover:text-[#0F9D58] uppercase tracking-wide transition-colors">Lupa?</a>
                                    </div>
                                @endif
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                        </div>

                        <!-- Captcha -->
                        <div>
                            <label for="captcha" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide px-1" style="margin-bottom: 0.5rem;">Verifikasi Keamanan (Captcha)</label>
                            
                            <div style="margin-bottom: 0.75rem;">
                                <div class="w-full bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-center cursor-pointer shadow-sm hover:border-[#0F9D58]/50 transition-colors" onclick="document.getElementById('captcha-img').src='{{ captcha_src('flat') }}'+Math.random()" title="Klik untuk gambar baru" style="padding: 0.5rem;">
                                    <img id="captcha-img" src="{{ captcha_src('flat') }}" alt="captcha" class="h-12 w-auto object-contain">
                                </div>
                            </div>

                            <div class="w-full relative rounded-xl shadow-sm">
                                <input id="captcha" name="captcha" type="text" required class="block w-full bg-slate-50 border border-slate-200 rounded-xl placeholder-slate-400 text-slate-900 focus:bg-white focus:outline-none focus:border-[#0F9D58] focus:ring-1 focus:ring-[#0F9D58] transition-all duration-300 sm:text-sm font-bold text-center tracking-widest" placeholder="Ketik Captcha" style="padding-top: 0.875rem; padding-bottom: 0.875rem; padding-left: 1rem; padding-right: 1rem;">
                            </div>
                            <x-input-error :messages="$errors->get('captcha')" class="mt-2 text-sm text-red-500" />
                        </div>
                    </div>

                    <div class="flex items-center px-1" style="margin-top: 1rem;">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 bg-slate-50 text-[#0F9D58] focus:ring-[#0F9D58] border-slate-300 rounded cursor-pointer transition-colors">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-600 font-medium cursor-pointer hover:text-slate-900 transition-colors">
                            Ingat sesi saya
                        </label>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="w-full flex justify-center items-center border border-transparent rounded-xl shadow-md text-sm font-bold text-white transition-all duration-300 uppercase tracking-widest bg-islami hover:opacity-90" style="padding-top: 1rem; padding-bottom: 1rem; padding-left: 1rem; padding-right: 1rem; background-color: #0F9D58; color: white;">
                            Secure Login
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="text-center w-full text-[10px] font-bold text-slate-400 uppercase tracking-widest" style="margin-top: 2.5rem;">
                    &copy; {{ date('Y') }} PUSTIKOM UIN Siber Syekh Nurjati Cirebon
                </div>
            </div>
        </div>

        <!-- Right Side: Hero Image Area -->
        <div class="mobile-hide relative w-full h-full overflow-hidden bg-slate-900">
            <!-- Background Image -->
            <img src="/jdih_hero_banner.png" alt="JDIH Hero Banner" class="absolute inset-0 w-full h-full object-cover">
            
            <!-- Simple Dark Overlay to reduce glare without covering the existing text completely -->
            <div class="absolute inset-0 bg-slate-900/10 mix-blend-multiply"></div>
        </div>

    </div>
</body>
</html>
