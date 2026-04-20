<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $global_settings['app_name'] ?? config('app.name', 'JDIH Admin') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; height: 100vh; margin: 0; overflow: hidden; }
        .sidebar-active { background: rgba(255,255,255,0.05); color: #4ade80 !important; border-left: 4px solid #0F9D58; }
        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        
        /* Native Media Queries for Sidebar Guarantee */
        @media (min-width: 992px) {
            #sidebar-desktop { display: flex !important; width: 280px !important; }
            #mobile-toggle { display: none !important; }
        }
        @media (max-width: 991px) {
            #sidebar-desktop { display: none !important; }
            #mobile-toggle { display: block !important; }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white">
    <!-- Desktop Layout Wrapper -->
    <div class="flex flex-col h-screen w-full overflow-hidden">
        @if(auth()->user()->isImpersonated())
        <div class="bg-orange-600 text-white px-6 py-2 flex items-center justify-between text-[11px] font-black uppercase tracking-[0.2em] shadow-lg z-[100] animate-in slide-in-from-top duration-500">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-alert" class="w-4 h-4"></i>
                    <span>Mode Impersonasi Aktif</span>
                </div>
                <div class="w-px h-3 bg-white/30"></div>
                <span>Bertindak sebagai: {{ auth()->user()->name }}</span>
            </div>
            <form action="{{ route('admin.impersonate.leave') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white text-orange-600 px-4 py-1.5 rounded-full hover:bg-orange-50 transition-all flex items-center gap-2">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    Kembali ke Super Admin
                </button>
            </form>
        </div>
        @endif
        
        <div class="flex flex-1 overflow-hidden">
        
        <!-- Physical Desktop Sidebar -->
        <aside id="sidebar-desktop" style="background-color: #0c1120; flex-shrink: 0;" class="flex-col border-r border-slate-800">
            <!-- Sidebar Header -->
            <div class="h-20 flex items-center px-6 border-b border-slate-800/50">
                <div class="flex items-center gap-3">
                    @if(!empty($global_settings['logo_light']))
                        <img src="{{ asset('storage/'.$global_settings['logo_light']) }}" alt="Logo" class="h-10 w-auto">
                    @elseif(!empty($global_settings['logo_dark']))
                        <img src="{{ asset('storage/'.$global_settings['logo_dark']) }}" alt="Logo" class="h-10 w-auto">
                    @else
                        <div class="w-10 h-10 bg-[#0F9D58] rounded-xl flex items-center justify-center text-white text-xl font-bold">
                            {{ substr($global_settings['app_name'] ?? 'J', 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <h2 class="text-white font-bold text-base leading-none">{{ $global_settings['app_name'] ?? 'JDIH Admin' }}</h2>
                        <p class="text-[9px] text-slate-500 uppercase tracking-tighter mt-1 font-black">{{ $global_settings['app_tagline'] ?? 'Intelligence System' }}</p>
                    </div>
                </div>
            </div>

            <!-- Nav Items -->
            <div class="flex-1 overflow-y-auto custom-scroll py-6 px-4 space-y-1">
                <p class="px-4 text-[10px] uppercase text-slate-500 font-black mb-3 tracking-widest">Main Menu</p>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('dashboard') ? 'sidebar-active' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                </a>

                @if(auth()->user()->isSuperAdmin())
                <p class="px-4 mt-8 text-[10px] uppercase text-slate-500 font-black mb-3 tracking-widest">Pengaturan Konten</p>
                <div class="space-y-0.5">
                    <!-- Berita Dropdown -->
                    <div>
                        <button onclick="toggleSubmenu('submenu-berita')" class="w-full flex items-center justify-between px-4 py-2 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 transition-all {{ request()->routeIs('admin.news.*', 'admin.tags.*', 'admin.news-categories.*') ? 'text-white bg-slate-800/50' : '' }}">
                            <div class="flex items-center gap-3">
                                <i data-lucide="newspaper" class="w-4 h-4"></i> Berita
                            </div>
                            <i data-lucide="chevron-down" id="icon-berita" class="w-3 h-3 transition-transform {{ request()->routeIs('admin.news.*', 'admin.tags.*', 'admin.news-categories.*') ? 'rotate-180' : '' }}"></i>
                        </button>
                        <div id="submenu-berita" class="{{ request()->routeIs('admin.news.*', 'admin.tags.*', 'admin.news-categories.*') ? '' : 'hidden' }} mt-1 ml-4 border-l border-slate-800 pl-2 space-y-0.5">
                            <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-4 py-2 text-xs font-semibold text-slate-500 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.news.*') ? 'text-[#4ade80]' : '' }}">
                                <i data-lucide="list" class="w-3 h-3"></i> Semua Berita
                            </a>
                            <a href="{{ route('admin.news-categories.index') }}" class="flex items-center gap-3 px-4 py-2 text-xs font-semibold text-slate-500 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.news-categories.*') ? 'text-[#4ade80]' : '' }}">
                                <i data-lucide="layers" class="w-3 h-3"></i> Kategori Berita
                            </a>
                            <a href="{{ route('admin.tags.index') }}" class="flex items-center gap-3 px-4 py-2 text-xs font-semibold text-slate-500 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.tags.*') ? 'text-[#4ade80]' : '' }}">
                                <i data-lucide="hash" class="w-3 h-3"></i> Hashtag
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.pages.*') ? 'sidebar-active' : '' }}">
                        <i data-lucide="file-plus" class="w-4 h-4"></i> Halaman
                    </a>
                    <a href="{{ route('admin.menus.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.menus.*') ? 'sidebar-active' : '' }}">
                        <i data-lucide="menu" class="w-4 h-4"></i> Navigasi Menu
                    </a>
                    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.faqs.*') ? 'sidebar-active' : '' }}">
                        <i data-lucide="help-circle" class="w-4 h-4"></i> FAQs
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.settings.*') ? 'sidebar-active' : '' }}">
                        <i data-lucide="settings" class="w-4 h-4"></i> Pengaturan Umum
                    </a>
                </div>
                @endif

                <p class="px-4 mt-8 text-[10px] uppercase text-slate-500 font-black mb-3 tracking-widest">Management</p>
                <a href="{{ route('admin.documents.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.documents.*') ? 'sidebar-active' : '' }}">
                    <i data-lucide="file-text" class="w-4 h-4"></i> Produk Hukum
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.categories.*') ? 'sidebar-active' : '' }}">
                    <i data-lucide="layers" class="w-4 h-4"></i> Klaster & Kategori
                </a>

                <!-- Pelaporan Dropdown -->
                <div class="mt-2">
                    <button onclick="toggleSubmenu('submenu-reports')" class="w-full flex items-center justify-between px-4 py-3 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 transition-all {{ request()->routeIs('admin.reports.*') ? 'text-white bg-slate-800/50' : '' }}">
                        <div class="flex items-center gap-3">
                            <i data-lucide="bar-chart-3" class="w-4 h-4"></i> Pelaporan
                        </div>
                        <i data-lucide="chevron-down" id="icon-reports" class="w-3 h-3 transition-transform {{ request()->routeIs('admin.reports.*') ? 'rotate-180' : '' }}"></i>
                    </button>
                    <div id="submenu-reports" class="{{ request()->routeIs('admin.reports.*') ? '' : 'hidden' }} mt-1 ml-4 border-l border-slate-800 pl-2 space-y-1">
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-2 text-xs font-semibold text-slate-500 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.reports.index') ? 'text-[#4ade80]' : '' }}">
                            <i data-lucide="pie-chart" class="w-3 h-3"></i> Ringkasan
                        </a>
                        <a href="{{ route('admin.reports.documents') }}" class="flex items-center gap-3 px-4 py-2 text-xs font-semibold text-slate-500 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.reports.documents') ? 'text-[#4ade80]' : '' }}">
                            <i data-lucide="file-text" class="w-3 h-3"></i> Produk Hukum
                        </a>
                    </div>
                </div>
                @if(auth()->user()->isSuperAdmin())
                <p class="px-4 mt-8 text-[10px] uppercase text-slate-500 font-black mb-3 tracking-widest">Users</p>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.users.*') ? 'sidebar-active' : '' }}">
                    <i data-lucide="users" class="w-4 h-4"></i> Pengguna
                </a>
                <a href="{{ route('admin.logs.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.logs.*') ? 'sidebar-active' : '' }}">
                    <i data-lucide="activity" class="w-4 h-4"></i> Log Audit
                </a>
                <p class="px-4 mt-8 text-[10px] uppercase text-slate-500 font-black mb-3 tracking-widest">Support</p>
                <a href="{{ route('admin.feedbacks.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.feedbacks.*') ? 'sidebar-active' : '' }}">
                    <i data-lucide="message-square" class="w-4 h-4"></i> Feedback
                </a>
                <a href="{{ route('admin.backups.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-400 rounded-lg hover:bg-slate-800 {{ request()->routeIs('admin.backups.*') ? 'sidebar-active' : '' }}">
                    <i data-lucide="database-backup" class="w-4 h-4"></i> Manajemen Backup
                </a>
                @endif
            </div>

            <!-- Profile Footer -->
            <div class="p-6 border-t border-slate-800/50 bg-[#080c18]">
                <div class="flex items-center gap-3 text-slate-400">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] font-bold uppercase truncate">
                            @if(auth()->user()->isImpersonated())
                                <span class="text-orange-400">Impersonating Admin</span>
                            @elseif(auth()->user()->isSuperAdmin())
                                Super Admin
                            @else
                                Admin JDIH
                            @endif
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <button type="submit" class="hover:text-white transition-colors"><i data-lucide="log-out" class="w-4 h-4"></i></button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Workspace (Solid Container) -->
        <main class="flex-1 flex flex-col min-w-0 bg-[#f8fafc] overflow-hidden">
            <!-- Header Bar (Solid) -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-10 flex-shrink-0 z-10 shadow-sm">
                <div class="flex items-center gap-4">
                    <button id="mobile-toggle" onclick="openMobileMenu()" class="p-2 bg-slate-100 rounded-lg text-slate-600">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-slate-900 leading-none">@yield('title', 'Admin Panel')</h1>
                        <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest mt-1">
                            {{ $global_settings['app_tagline'] ?? 'UIN SIBER SYEKH NURJATI' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    @if(auth()->user()->isImpersonated())
                    <form action="{{ route('admin.impersonate.leave') }}" method="POST" class="hidden lg:block">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-5 py-2.5 bg-orange-600 text-white rounded-xl text-[11px] font-black uppercase tracking-widest hover:bg-orange-700 transition-all shadow-xl shadow-orange-200">
                            <i data-lucide="user-minus" class="w-4 h-4"></i>
                            Stop Impersonation
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Visit Site</a>
                </div>
            </header>

            <!-- Page Content (Pure Scroll Area) -->
            <div class="flex-1 overflow-y-auto p-6 lg:p-10 custom-scroll">
                <div class="max-w-6xl mx-auto">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-100 text-[#0F9D58] text-sm font-bold rounded-xl flex items-center gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5"></i> {{ session('success') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</div>

    <!-- Mobile Sidebar Floating (Only used on small screens) -->
    <div id="mobile-sidebar-overlay" onclick="closeMobileMenu()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden"></div>
    <div id="mobile-sidebar" style="width: 280px; background-color: #0c1120;" class="fixed inset-y-0 left-0 z-50 transform -translate-x-full border-r border-slate-800 transition-transform md:hidden flex flex-col">
        <!-- Re-use header/nav from desktop logic if needed or just simple close -->
        <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/50">
             <div class="text-white font-bold">JDIH ADMIN</div>
             <button onclick="closeMobileMenu()" class="text-slate-500"><i data-lucide="x" class="w-6 h-6"></i></button>
        </div>
        <div class="flex-1 p-6 space-y-4">
             <a href="{{ route('dashboard') }}" class="block text-slate-400 hover:text-white">Dashboard</a>
             <a href="{{ route('admin.documents.index') }}" class="block text-slate-400 hover:text-white">Produk Hukum</a>
             <a href="{{ route('admin.categories.index') }}" class="block text-slate-400 hover:text-white">Kategori</a>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function toggleSubmenu(id) {
            const submenu = document.getElementById(id);
            const icon = document.getElementById('icon-' + id.replace('submenu-', ''));
            submenu.classList.toggle('hidden');
            if (icon) {
                icon.classList.toggle('rotate-180');
            }
        }
        function openMobileMenu() {
            document.getElementById('mobile-sidebar').classList.remove('-translate-x-full');
            document.getElementById('mobile-sidebar-overlay').classList.remove('hidden');
        }
        function closeMobileMenu() {
            document.getElementById('mobile-sidebar').classList.add('-translate-x-full');
            document.getElementById('mobile-sidebar-overlay').classList.add('hidden');
        }
    </script>
    @stack('scripts')
</body>
</html>
