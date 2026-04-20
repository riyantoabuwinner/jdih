<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', ($global_settings['app_name'] ?? 'JDIH') . ' ' . ($global_settings['app_tagline'] ?? 'UIN Siber Syekh Nurjati Cirebon'))</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        <!-- Favicon -->
        @php
            $favicon = !empty($global_settings['favicon']) ? asset('storage/'.$global_settings['favicon']) : asset('favicon.ico');
            $logoLight = !empty($global_settings['logo_light']) ? asset('storage/'.$global_settings['logo_light']) : null;
            $logoDark = !empty($global_settings['logo_dark']) ? asset('storage/'.$global_settings['logo_dark']) : null;
            $appName = !empty($global_settings['app_name']) ? $global_settings['app_name'] : 'JDIH';
        @endphp
        <link rel="icon" type="image/png" href="{{ $favicon }}">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(16px); }
            .dark .glass { background: rgba(2, 6, 23, 0.8) !important; border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important; }
            .bg-islami { background-color: #0F9D58; }
            .bg-gold { background-color: #D4AF37; }
            .text-islami { color: #0F9D58; }
            
            /* CYBER PATTERN STYLE */
            .bg-cyber {
                background-color: #040404;
                background-image: 
                    linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
                background-size: 20px 20px;
                position: relative;
            }
            .bg-cyber::after {
                content: "";
                position: absolute;
                bottom: 0; left: 0; right: 0; height: 1px;
                background: linear-gradient(90deg, transparent, #0F9D58, transparent);
                opacity: 0.6;
                pointer-events: none;
            }
            
            /* TOUGH GOOGLE TRANSLATE HIDING */
            iframe.goog-te-banner-frame, .goog-te-banner-frame, .goog-te-balloon-frame, #goog-gt-tt, .skiptranslate {
                display: none !important;
                visibility: hidden !important;
            }
            body { top: 0px !important; position: static !important; }
            html { top: 0px !important; }
            #google_translate_element { display: none; }
            
            header { z-index: 1000 !important; }
            .top-bar-container { z-index: 1100 !important; }
        </style>
        @stack('styles')
    </head>
    <body class="antialiased font-sans text-slate-900 bg-[#f8fafc] dark:bg-slate-950 transition-colors">
        
        <header class="sticky top-0 w-full shadow-sm">
            
            <!-- CYBER BLACK TOP BAR -->
            <div class="top-bar-container bg-cyber py-3 relative">
                <div class="max-w-7xl mx-auto px-6 relative z-10">
                    <div class="flex justify-between items-center text-white">
                        
                        <!-- Left: Launchers (Top Menu) -->
                        <div class="flex items-center gap-3">
                            @if(isset($global_menus['top']))
                                @foreach($global_menus['top'] as $menu)
                                    <a href="{{ $menu->url }}" target="{{ $menu->target }}" class="flex items-center gap-2 px-4 py-2 bg-islami hover:bg-green-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-[0_4px_0_rgb(11,122,68)] hover:shadow-[0_2px_0_rgb(11,122,68)] active:shadow-none hover:translate-y-[2px] active:translate-y-[4px] border border-white/10 group">
                                        <i data-lucide="globe" class="w-3.5 h-3.5 group-hover:rotate-12 transition-transform"></i>
                                        {{ $menu->label }}
                                    </a>
                                @endforeach
                            @else
                                <a href="https://uinssc.ac.id" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-islami hover:bg-green-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-[0_4px_0_rgb(11,122,68)] hover:shadow-[0_2px_0_rgb(11,122,68)] active:shadow-none hover:translate-y-[2px] active:translate-y-[4px] border border-white/10 group">
                                    <i data-lucide="globe" class="w-3.5 h-3.5 group-hover:rotate-12 transition-transform"></i>
                                    UINSSC
                                </a>
                                <a href="https://ppid.uinssc.ac.id" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-gold hover:bg-yellow-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-[0_4px_0_rgb(161,133,37)] hover:shadow-[0_2px_0_rgb(161,133,37)] active:shadow-none hover:translate-y-[2px] active:translate-y-[4px] border border-white/10 group">
                                    <i data-lucide="globe" class="w-3.5 h-3.5 group-hover:rotate-12 transition-transform"></i>
                                    PPID
                                </a>
                            @endif
                        </div>

                        <!-- Right: Features -->
                        <div class="flex items-center gap-4">
                            
                            <!-- SOLID GREY LANGUAGE DROPDOWN -->
                            <div class="relative group" id="languageSwitcher">
                                <button class="flex items-center gap-3 px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl font-bold text-[11px] uppercase focus:outline-none transition-all border border-white/30 shadow-2xl min-w-[90px] justify-between">
                                    <div class="flex items-center gap-2">
                                        <img id="activeFlag" src="https://flagcdn.com/w20/id.png" class="w-4 h-3 rounded-sm object-cover ring-1 ring-white/40">
                                        <span id="currentLangLabel">ID</span>
                                    </div>
                                    <i data-lucide="chevron-down" class="w-3 h-3 text-white/60"></i>
                                </button>
                                
                                <!-- FIXED: SOLID CYBER BLACK FOR CONTRAST -->
                                <div class="absolute right-0 mt-3 w-40 bg-slate-900 border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.6)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[9999] overflow-hidden p-1.5 backdrop-blur-xl">
                                    <a href="javascript:void(0)" onclick="changeLang('id', 'ID', 'https://flagcdn.com/w20/id.png')" class="flex items-center gap-4 px-4 py-3 hover:bg-slate-700/50 rounded-xl transition-all group/item mb-1 text-white border border-transparent hover:border-white/10">
                                        <img src="https://flagcdn.com/w20/id.png" class="w-5 h-3.5 rounded-sm object-cover shadow-sm ring-1 ring-white/20">
                                        <span class="text-[11px] font-black tracking-[0.2em] text-white">ID</span>
                                    </a>
                                    <a href="javascript:void(0)" onclick="changeLang('en', 'EN', 'https://flagcdn.com/w20/gb.png')" class="flex items-center gap-4 px-4 py-3 hover:bg-slate-700/50 rounded-xl transition-all group/item mb-1 text-white border border-transparent hover:border-white/10">
                                        <img src="https://flagcdn.com/w20/gb.png" class="w-5 h-3.5 rounded-sm object-cover shadow-sm ring-1 ring-white/20">
                                        <span class="text-[11px] font-black tracking-[0.2em] text-white">EN</span>
                                    </a>
                                    <a href="javascript:void(0)" onclick="changeLang('ar', 'AR', 'https://flagcdn.com/w20/sa.png')" class="flex items-center gap-4 px-4 py-3 hover:bg-slate-700/50 rounded-xl transition-all group/item text-white border border-transparent hover:border-white/10">
                                        <img src="https://flagcdn.com/w20/sa.png" class="w-5 h-3.5 rounded-sm object-cover shadow-sm ring-1 ring-white/20">
                                        <span class="text-[11px] font-black tracking-[0.2em] text-white">AR</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Accessibility -->
                            <button id="themeToggle" class="w-10 h-10 flex items-center justify-center text-white bg-white/5 hover:bg-white/20 rounded-xl transition-all focus:outline-none border border-white/20 group" title="Theme">
                                <i data-lucide="sun" class="w-4 h-4 hidden text-yellow-400" id="sunIcon"></i>
                                <i data-lucide="moon" class="w-4 h-4" id="moonIcon"></i>
                            </button>
                             <button id="fullscreenToggle" class="w-10 h-10 flex items-center justify-center text-white bg-white/5 hover:bg-white/20 rounded-xl transition-all focus:outline-none border border-white/20 shadow-lg" title="Fullscreen">
                                 <i data-lucide="maximize" class="w-4 h-4"></i>
                             </button>

                             <div class="h-6 w-[1px] bg-white/10 mx-1"></div>

                             @auth
                                <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 px-4 py-2 bg-islami hover:bg-green-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg border border-white/10">
                                    <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i>
                                    Dashboard
                                </a>
                             @else
                                <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-red-500 shadow-lg">
                                    <i data-lucide="log-in" class="w-3.5 h-3.5"></i>
                                    Masuk
                                </a>
                             @endauth
                         </div>
                    </div>
                </div>
            </div>

            <!-- MENU NAVIGATION -->
            <nav class="glass border-b border-slate-200 dark:border-white/5 relative z-[1050]">
                <div class="max-w-7xl mx-auto px-6 h-24 flex justify-between items-center text-left">
                    <a href="{{ route('home') }}" class="flex items-center gap-5 group">
                        @if($logoDark)
                            <img src="{{ $logoDark }}" alt="Logo" class="h-14 w-auto transition-transform duration-300 group-hover:scale-105 block dark:hidden">
                            @if($logoLight)
                                <img src="{{ $logoLight }}" alt="Logo" class="h-14 w-auto transition-transform duration-300 group-hover:scale-105 hidden dark:block">
                            @else
                                <img src="{{ $logoDark }}" alt="Logo" class="h-14 w-auto transition-transform duration-300 group-hover:scale-105 hidden dark:block">
                            @endif
                        @elseif($logoLight)
                            <img src="{{ $logoLight }}" alt="Logo" class="h-14 w-auto transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="text-islami transition-transform duration-300 group-hover:scale-105">
                                <i data-lucide="shield" class="w-10 h-10"></i>
                            </div>
                        @endif
                        <div class="hidden sm:block text-left">
                            <h1 class="text-lg font-black tracking-tight text-slate-900 dark:text-white leading-none uppercase mb-1.5">
                                {{ $global_settings['app_name'] ?? 'Jaringan Dokumentasi dan Informasi Hukum (JDIH)' }}
                            </h1>
                            <p class="text-[11px] uppercase tracking-[0.3em] text-slate-400 dark:text-slate-500 font-bold">
                                {{ $global_settings['app_tagline'] ?? 'UIN Siber Syekh Nurjati Cirebon' }}
                            </p>
                        </div>
                    </a>

                    <div class="flex items-center">
                        <div class="hidden lg:flex items-center gap-10">
                            @if(isset($global_menus['main']))
                                @foreach($global_menus['main'] as $menu)
                                    @if($menu->children->count() > 0)
                                        <div class="relative group">
                                            <button class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-slate-500 hover:text-islami transition-colors focus:outline-none">
                                                {{ $menu->label }}
                                                <i data-lucide="chevron-down" class="w-3 h-3 text-slate-400 group-hover:text-islami transition-colors"></i>
                                            </button>
                                            <div class="absolute left-0 mt-4 w-max min-w-[240px] bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/10 rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[1200] overflow-hidden p-1.5 backdrop-blur-xl">
                                                @foreach($menu->children as $child)
                                                    <a href="{{ $child->url }}" target="{{ $child->target }}" class="block px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-islami rounded-xl transition-all whitespace-nowrap">
                                                        {{ $child->label }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ $menu->url }}" target="{{ $menu->target }}" class="text-xs font-black uppercase tracking-widest text-slate-500 hover:text-islami transition-colors">{{ $menu->label }}</a>
                                    @endif
                                @endforeach
                            @else
                                <a href="{{ route('home') }}" class="text-xs font-black uppercase tracking-widest text-slate-500 hover:text-islami transition-colors">Beranda</a>
                                <div class="relative group">
                                    <button class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-slate-500 hover:text-islami transition-colors focus:outline-none">
                                        Profil
                                        <i data-lucide="chevron-down" class="w-3 h-3 text-slate-400 group-hover:text-islami transition-colors"></i>
                                    </button>
                                    <div class="absolute left-0 mt-4 w-max min-w-[240px] bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/10 rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[1200] overflow-hidden p-1.5 backdrop-blur-xl">
                                        <a href="#" class="block px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-islami rounded-xl transition-all whitespace-nowrap">Silahkan Setting Menu</a>
                                    </div>
                                </div>
                                <a href="{{ route('public.documents.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-500 hover:text-islami transition-colors">Produk Hukum</a>
                                <a href="{{ route('public.faq') }}" class="text-xs font-black uppercase tracking-widest text-slate-500 hover:text-islami transition-colors">FAQs</a>
                            @endif
                        </div>
                        
                        <!-- Secondary Menu (If any) -->
                        @if(isset($global_menus['secondary']))
                        <div class="hidden lg:flex items-center gap-10 ml-10 border-l border-slate-100 dark:border-white/5 pl-10">
                            @foreach($global_menus['secondary'] as $menu)
                                <a href="{{ $menu->url }}" target="{{ $menu->target }}" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-islami transition-colors">{{ $menu->label }}</a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </nav>
        </header>

        <main class="min-h-screen">
            @yield('content')
        </main>

        <!-- Oval / Arch Top for Footer -->
        <div class="relative w-full bg-black h-24 md:h-36 lg:h-40 transform translate-y-1 border-t border-white/5" style="border-radius: 50% 50% 0 0 / 100% 100% 0 0; box-shadow: 0 -10px 40px rgba(0,0,0,0.1);">
            <div class="absolute inset-0 bg-cyber opacity-20 pointer-events-none" style="border-radius: 50% 50% 0 0 / 100% 100% 0 0;"></div>
        </div>

        <footer class="bg-black text-white pt-8 relative overflow-hidden" style="padding-bottom: 40px !important;">
            <!-- Decorative Backgroud Pattern -->
            <div class="absolute inset-0 bg-cyber opacity-20 pointer-events-none"></div>
            <div class="absolute right-0 top-0 w-[500px] h-[500px] bg-islami/10 blur-[120px] rounded-full pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="max-w-7xl mx-auto px-6 text-left relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-16">
                    
                    <!-- Branding & About (Col-span 4) -->
                    <div class="lg:col-span-4 space-y-6">
                        <div class="flex items-center gap-4">
                            @if($logoLight)
                                <img src="{{ $logoLight }}" alt="Logo" class="h-16 w-auto drop-shadow-[0_0_15px_rgba(15,157,88,0.5)] transform hover:scale-105 transition-transform">
                            @elseif($logoDark)
                                <img src="{{ $logoDark }}" alt="Logo" class="h-16 w-auto drop-shadow-[0_0_15px_rgba(15,157,88,0.5)] transform hover:scale-105 transition-transform">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-islami to-green-900 rounded-xl flex items-center justify-center shadow-lg shadow-green-900/50">
                                    <i data-lucide="scale" class="w-6 h-6 text-white"></i>
                                </div>
                            @endif
                            <div>
                                <h2 class="text-sm font-black tracking-tighter leading-tight uppercase whitespace-nowrap text-white">
                                    {{ $global_settings['app_name'] ?? 'Jaringan Dokumentasi dan Informasi Hukum' }}
                                </h2>
                                <p class="text-[11px] text-white/50 font-bold tracking-[0.1em] mt-1.5 uppercase">
                                    {{ $global_settings['app_tagline'] ?? 'UIN Siber Syekh Nurjati Cirebon' }}
                                </p>
                            </div>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed text-justify pr-0 lg:pr-8">
                            {{ $global_settings['footer_description'] ?? 'Portal resmi Jaringan Dokumentasi dan Informasi Hukum. Menyajikan pusaka dokumen legal, produk hukum, dan regulasi secara tertib, transparan, dan terintegrasi secara siber.' }}
                        </p>
                    </div>

                    <!-- Layanan & Tautan (Col-span 3) -->
                    <div class="lg:col-span-2 lg:col-start-6 space-y-6">
                        <h3 class="text-sm font-black uppercase tracking-widest text-white">Tautan Pusat</h3>
                        <ul class="space-y-4">
                            @if(isset($global_menus['footer']))
                                @foreach($global_menus['footer'] as $menu)
                                    <li><a href="{{ $menu->url }}" target="{{ $menu->target }}" class="text-sm text-slate-400 hover:text-islami flex items-center gap-2 transition-colors group"><i data-lucide="chevron-right" class="w-3 h-3 text-islami group-hover:translate-x-1 transition-transform"></i> {{ $menu->label }}</a></li>
                                @endforeach
                            @else
                                <li><a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-islami flex items-center gap-2 transition-colors group"><i data-lucide="chevron-right" class="w-3 h-3 text-islami group-hover:translate-x-1 transition-transform"></i> Beranda</a></li>
                                <li><a href="{{ route('public.documents.index') }}" class="text-sm text-slate-400 hover:text-islami flex items-center gap-2 transition-colors group"><i data-lucide="chevron-right" class="w-3 h-3 text-islami group-hover:translate-x-1 transition-transform"></i> Katalog Hukum</a></li>
                                <li><a href="{{ route('public.faq') }}" class="text-sm text-slate-400 hover:text-islami flex items-center gap-2 transition-colors group"><i data-lucide="chevron-right" class="w-3 h-3 text-islami group-hover:translate-x-1 transition-transform"></i> FAQs</a></li>
                            @endif
                        </ul>
                    </div>

                    <!-- Jejaring (Col-span 2) -->
                    <div class="lg:col-span-2 space-y-6">
                        <h3 class="text-sm font-black uppercase tracking-widest text-white">Jejaring Siber</h3>
                        <ul class="space-y-4">
                            <li><a href="https://jdihn.go.id" target="_blank" class="text-sm text-slate-400 hover:text-white flex items-center gap-2 transition-colors group"><i data-lucide="external-link" class="w-3 h-3 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"></i> JDIHN Pusat</a></li>
                            <li><a href="https://kemenag.go.id" target="_blank" class="text-sm text-slate-400 hover:text-white flex items-center gap-2 transition-colors group"><i data-lucide="external-link" class="w-3 h-3 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"></i> Kemenag RI</a></li>
                            <li><a href="https://uinssc.ac.id" target="_blank" class="text-sm text-slate-400 hover:text-white flex items-center gap-2 transition-colors group"><i data-lucide="external-link" class="w-3 h-3 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"></i> Kampus Utama</a></li>
                            <li><a href="https://ppid.uinssc.ac.id" target="_blank" class="text-sm text-slate-400 hover:text-white flex items-center gap-2 transition-colors group"><i data-lucide="external-link" class="w-3 h-3 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"></i> PPID UINSSC</a></li>
                        </ul>
                    </div>

                    <!-- Kontak Center (Col-span 4) -->
                    <div class="lg:col-span-3 space-y-6">
                        <h3 class="text-sm font-black uppercase tracking-widest text-white">Layanan Kontak</h3>
                        <ul class="space-y-4 pt-2">
                            <li class="flex items-start gap-4">
                                <div class="mt-1 w-8 h-8 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0 text-islami"><i data-lucide="map-pin" class="w-4 h-4"></i></div>
                                <span class="text-xs sm:text-sm text-slate-400 leading-relaxed font-medium">
                                    {!! nl2br(e($global_settings['contact_address'] ?? "Gedung Pusat Administrasi Biro (Rektorat)\nUIN Siber Syekh Nurjati Cirebon\nJl. Perjuangan By Pass Sunyaragi, Kesambi,\nKota Cirebon, Jawa Barat 45131")) !!}
                                </span>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0 text-blue-400"><i data-lucide="mail" class="w-4 h-4"></i></div>
                                <a href="mailto:{{ $global_settings['contact_email'] ?? 'info@syekhnurjati.ac.id' }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">
                                    {{ $global_settings['contact_email'] ?? 'info@syekhnurjati.ac.id' }}
                                </a>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0 text-amber-400"><i data-lucide="phone" class="w-4 h-4"></i></div>
                                <span class="text-sm font-medium text-slate-400">
                                    {{ $global_settings['contact_phone'] ?? '(0231) 481264' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                
                <div class="pt-8 border-t border-white/10 flex flex-col items-center justify-center gap-4">
                    <!-- Social Media Toggles -->
                    <div class="flex items-center gap-4">
                        <a href="https://facebook.com" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-islami hover:text-white transition-all border border-white/5 hover:scale-110"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                        <a href="https://twitter.com" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-islami hover:text-white transition-all border border-white/5 hover:scale-110"><i data-lucide="twitter" class="w-4 h-4"></i></a>
                        <a href="https://instagram.com/uin_siber" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-islami hover:text-white transition-all border border-white/5 hover:scale-110"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                        <a href="https://youtube.com" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-islami hover:text-white transition-all border border-white/5 hover:scale-110"><i data-lucide="youtube" class="w-4 h-4"></i></a>
                    </div>

                    <!-- Copyright -->
                    <div class="text-xs sm:text-sm font-bold tracking-wide text-center leading-relaxed">
                        @if(isset($global_menus['last']))
                            <div class="flex items-center justify-center gap-6 mb-4">
                                @foreach($global_menus['last'] as $menu)
                                    <a href="{{ $menu->url }}" target="{{ $menu->target }}" class="text-[10px] uppercase tracking-widest text-slate-500 hover:text-islami transition-colors">{{ $menu->label }}</a>
                                @endforeach
                            </div>
                        @endif
                        <div class="text-slate-500">
                             &copy; {{ date('Y') }} PUSTIKOM UIN Siber Syekh Nurjati Cirebon. <br class="block sm:hidden">
                            <span class="text-slate-600">Hak Cipta Dilindungi Undang-Undang.</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        @include('components.accessibility-menu')
        @include('components.ai-assistant')

        <div id="google_translate_element"></div>


        @stack('scripts')
        <script src="https://unpkg.com/lucide@latest"></script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
        <script>
            lucide.createIcons();

            setInterval(() => {
                const googleBar = document.querySelector('.goog-te-banner-frame');
                if (googleBar) { googleBar.style.display = 'none'; }
                document.body.style.top = '0px';
                document.documentElement.style.top = '0px';
            }, 500);

            const themeToggle = document.getElementById('themeToggle');
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');
            
            window.applyTheme = function(isDark) {
                if (isDark) {
                    document.documentElement.classList.add('dark');
                    if (sunIcon) sunIcon.classList.remove('hidden');
                    if (moonIcon) moonIcon.classList.add('hidden');
                } else {
                    document.documentElement.classList.remove('dark');
                    if (sunIcon) sunIcon.classList.add('hidden');
                    if (moonIcon) moonIcon.classList.remove('hidden');
                }
            }

            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                applyTheme(true);
            } else {
                applyTheme(false);
            }

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const isDark = document.documentElement.classList.toggle('dark');
                    localStorage.theme = isDark ? 'dark' : 'light';
                    applyTheme(isDark);
                });
            }

            const fullscreenToggle = document.getElementById('fullscreenToggle');
            if (fullscreenToggle) {
                fullscreenToggle.addEventListener('click', () => {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen();
                        fullscreenToggle.innerHTML = '<i data-lucide="minimize" class="w-4 h-4"></i>';
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                            fullscreenToggle.innerHTML = '<i data-lucide="maximize" class="w-4 h-4"></i>';
                        }
                    }
                    lucide.createIcons();
                });
            }

            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'id',
                    includedLanguages: 'id,en,ar',
                    autoDisplay: false
                }, 'google_translate_element');
            }

            function changeLang(langCode, label, flagSrc) {
                const wait = setInterval(() => {
                    const combo = document.querySelector('.goog-te-combo');
                    if (combo) {
                        combo.value = langCode;
                        combo.dispatchEvent(new Event('change'));
                        document.getElementById('currentLangLabel').innerText = label;
                        document.getElementById('activeFlag').src = flagSrc;
                        
                        // Stop TTS if active when language changes
                        if (window.speechSynthesis.speaking) {
                            window.speechSynthesis.cancel();
                        }
                        
                        clearInterval(wait);
                    }
                }, 100);
                setTimeout(() => clearInterval(wait), 4000);
            }
        </script>

        @stack('scripts')
    </body>
</html>
