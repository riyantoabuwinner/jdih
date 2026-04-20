@extends('layouts.admin')

@section('title', 'Navigation Oracle - Menu Builder')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
<style>
    :root {
        --lux-green: #0F9D58;
        --lux-gold: #D4AF37;
        --lux-dark: #0f172a;
        --lux-slate: #f8fafc;
    }

    /* NESTABLE CUSTOMIZATION - ULTRA CLEAN */
    .dd { max-width: 100%; }
    .dd-list { list-style: none; padding: 0; }
    .dd-list .dd-list { padding-left: 48px; margin-top: 10px; }
    .dd-item { display: block; position: relative; list-style: none; margin-bottom: 15px; }
    
    .dd-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        background: white;
        border-radius: 18px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        color: #1e293b;
        position: relative;
        overflow: hidden;
    }
    
    /* Glassmorphism Shine */
    .dd-content::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
    }
    .dd-item:hover > .dd-content::before { left: 100%; }

    /* Parent Style - Elegant Green */
    .dd-item > .dd-content {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    .dd-item > .dd-content .title-text { color: white !important; font-weight: 800; }
    .dd-item > .dd-content .sub-text { color: rgba(255,255,255,0.7) !important; }
    .dd-item > .dd-content .lux-badge { background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.1); }
    .dd-item > .dd-content .dd-handle { background: rgba(255,255,255,0.15); color: white; }

    /* Child Style - Elegant Gold */
    .dd-item .dd-list .dd-item > .dd-content {
        background: linear-gradient(135deg, #fbbf24, #d97706);
        color: white;
    }
    .dd-item .dd-list .dd-item > .dd-content .title-text { color: white !important; font-weight: 800; }
    .dd-item .dd-list .dd-item > .dd-content .sub-text { color: rgba(255,255,255,0.7) !important; }
    .dd-item .dd-list .dd-item > .dd-content .lux-badge { background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.1); }
    .dd-item .dd-list .dd-item > .dd-content .dd-handle { background: rgba(255,255,255,0.15); color: white; }

    /* Action Buttons */
    .lux-action-group {
        display: flex;
        gap: 8px;
    }
    .lux-action-btn {
        width: 36px;
        height: 36px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    .btn-edit { background: rgba(255,255,255,0.2); color: white; }
    .btn-edit:hover { background: white; color: #1e293b; transform: scale(1.1); }
    .btn-delete { background: rgba(255,255,255,0.2); color: white; }
    .btn-delete:hover { background: #ef4444; color: white; transform: scale(1.1); }

    /* HANDLE DESIGN */
    .dd-handle {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: move;
        transition: all 0.3s;
        margin-right: 18px;
    }

    /* COLLAPSE/EXPAND BUTTONS */
    .dd-item > button {
        float: left;
        width: 24px;
        height: 24px;
        margin: 22px 10px 0 10px;
        background: #f1f5f9;
        border: none;
        border-radius: 8px;
        text-indent: 100%;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        z-index: 10;
        transition: all 0.3s;
    }
    .dd-item > button:before {
        content: '+';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        text-indent: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        color: #475569;
    }
    .dd-item > button[data-action="collapse"]:before { content: '-'; }
    .dd-item > button:hover { background: #e2e8f0; transform: scale(1.1); }

    .dd-placeholder {
        margin: 5px 0;
        min-height: 60px;
        background: #f0fdf4;
        border: 2px dashed #0F9D58;
        border-radius: 20px;
    }

    /* SOURCE PANEL - SIDEBAR */
    .lux-card {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.02);
        overflow: hidden;
    }
    
    .lux-acc-head {
        width: 100%;
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        border-bottom: 1px solid #f8fafc;
        transition: all 0.3s;
        cursor: pointer;
    }
    .lux-acc-head:hover { background: #fbfcfd; }
    .lux-acc-head.active { background: white; }
    .lux-acc-head .title { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: #475569; }
    .lux-acc-head.active .title { color: var(--lux-green); }
    .lux-acc-head .icon-wrapper {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        transition: all 0.3s;
    }
    .lux-acc-head.active .icon-wrapper { background: #f0fdf4; color: var(--lux-green); }

    .lux-acc-body { padding: 24px 28px; background: white; border-bottom: 1px solid #f8fafc; }

    /* INPUTS & BUTTONS */
    .lux-input {
        width: 100%;
        padding: 12px 16px;
        background: #f8fafc;
        border: 1px solid #eef2f6;
        border-radius: 14px;
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.3s;
        outline: none;
    }
    .lux-input:focus { background: white; border-color: var(--lux-green); box-shadow: 0 0 0 4px rgba(15, 157, 88, 0.08); }

    .lux-btn-add {
        width: 100%;
        padding: 14px;
        background: var(--lux-dark);
        color: white;
        border-radius: 14px;
        font-weight: 800;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.4s;
    }
    .lux-btn-add:hover { background: #1e293b; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }

    /* BADGES */
    .lux-badge {
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* HEADER BANNER - NEW DESIGN */
    .oracle-header {
        background: white;
        padding: 40px;
        border-radius: 32px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05);
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .lux-select-box {
        background: #f8fafc;
        border: 1px solid #eef2f6;
        padding: 12px 24px;
        border-radius: 16px;
        font-weight: 800;
        font-size: 13px;
        color: #1e293b;
        outline: none;
        transition: all 0.3s;
        cursor: pointer;
        min-width: 200px;
    }
    .lux-select-box:focus { border-color: var(--lux-green); }

    .lux-btn-save {
        padding: 14px 28px;
        background: var(--lux-green);
        color: white;
        border-radius: 16px;
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border: none;
        box-shadow: 0 10px 20px -5px rgba(15, 157, 88, 0.4);
        transition: all 0.4s;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .lux-btn-save:hover { transform: translateY(-3px); box-shadow: 0 15px 30px -5px rgba(15, 157, 88, 0.5); filter: brightness(1.05); }

    /* MODAL */
    .lux-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: all 0.3s ease-in-out;
    }
    .lux-modal-overlay.active { opacity: 1; visibility: visible; pointer-events: auto; }
    .lux-modal {
        background: white;
        border-radius: 32px;
        width: 100%;
        max-width: 500px;
        overflow: hidden;
        transform: translateY(20px);
        transition: all 0.4s;
    }
    .lux-modal-overlay.active .lux-modal { transform: translateY(0); }
    .lux-modal-header { padding: 30px; background: #f8fafc; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; }
    .lux-modal-body { padding: 30px; }
    .lux-modal-footer { padding: 20px 30px; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 12px; }

    .hidden { display: none !important; }
</style>
@endpush

@section('content')

<!-- Header Oracle -->
<div class="oracle-header flex flex-col md:flex-row gap-8">
    <div class="flex items-center gap-6">
        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-[22px] flex items-center justify-center shadow-2xl shadow-green-500/20">
            <i data-lucide="compass" class="w-8 h-8 text-white"></i>
        </div>
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Navigation Oracle</h1>
            <p class="text-sm font-bold text-slate-400 mt-1 uppercase tracking-widest leading-none">Menu Builder & Hierarchy Manager</p>
        </div>
    </div>
    
    <div class="flex items-center gap-4">
        <div class="relative">
            <select onchange="window.location.href='?location=' + this.value" class="lux-select-box">
                @foreach($locations as $key => $name)
                    <option value="{{ $key }}" {{ $location == $key ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <button onclick="saveMenu()" class="lux-btn-save">
            <i data-lucide="shield-check" class="w-5 h-5"></i>
            Commit Structure
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
    
    <!-- LEFT PANEL -->
    <div class="lg:col-span-4 space-y-6">
        <div class="lux-card">
            
            <!-- Custom Links -->
            <div class="lux-acc-item">
                <div class="lux-acc-head active" onclick="toggleLux('acc-custom', this)">
                    <div class="flex items-center gap-4">
                        <div class="icon-wrapper"><i data-lucide="link" class="w-4 h-4"></i></div>
                        <span class="title">Tautan Kustom</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3 h-3 text-slate-300"></i>
                </div>
                <div id="acc-custom" class="lux-acc-body">
                    <form action="{{ route('admin.menus.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="location" value="{{ $location }}">
                        <input type="hidden" name="type" value="custom">
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">Label Menu</label>
                            <input type="text" name="label" required placeholder="Ex: Beranda" class="lux-input">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">URL Target</label>
                            <input type="text" name="url" placeholder="https://..." class="lux-input">
                        </div>
                        <button type="submit" class="lux-btn-add">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Push to Stack
                        </button>
                    </form>
                </div>
            </div>

            <!-- Pages -->
            <div class="lux-acc-item">
                <div class="lux-acc-head" onclick="toggleLux('acc-pages', this)">
                    <div class="flex items-center gap-4">
                        <div class="icon-wrapper"><i data-lucide="file" class="w-4 h-4"></i></div>
                        <span class="title">Halaman</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3 h-3 text-slate-300"></i>
                </div>
                <div id="acc-pages" class="lux-acc-body hidden">
                    <div class="max-h-60 overflow-y-auto space-y-2 pr-1 custom-scroll">
                        @foreach($pages as $page)
                            <form action="{{ route('admin.menus.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="location" value="{{ $location }}">
                                <input type="hidden" name="type" value="page">
                                <input type="hidden" name="model_id" value="{{ $page->id }}">
                                <input type="hidden" name="label" value="{{ $page->title }}">
                                <input type="hidden" name="url" value="{{ $page->slug ? url('/' . $page->slug, [], false) : '#' }}">
                                <button type="submit" class="w-full text-left p-3.5 bg-[#fbfcfd] hover:bg-green-50 rounded-xl border border-transparent hover:border-green-100 transition-all flex items-center justify-between group">
                                    <span class="text-[13px] font-bold text-slate-600 group-hover:text-green-700">{{ $page->title }}</span>
                                    <div class="w-7 h-7 bg-white rounded-lg shadow-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i data-lucide="plus" class="w-3 h-3 text-green-500"></i>
                                    </div>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- News Categories -->
            <div class="lux-acc-item">
                <div class="lux-acc-head" onclick="toggleLux('acc-cats', this)">
                    <div class="flex items-center gap-4">
                        <div class="icon-wrapper"><i data-lucide="layout-grid" class="w-4 h-4"></i></div>
                        <span class="title">Kategori Berita</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3 h-3 text-slate-300"></i>
                </div>
                <div id="acc-cats" class="lux-acc-body hidden">
                    <div class="max-h-60 overflow-y-auto space-y-2 pr-1 custom-scroll">
                        @foreach($categories as $cat)
                            <form action="{{ route('admin.menus.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="location" value="{{ $location }}">
                                <input type="hidden" name="type" value="news_category">
                                <input type="hidden" name="model_id" value="{{ $cat->id }}">
                                <input type="hidden" name="label" value="{{ $cat->name }}">
                                <input type="hidden" name="url" value="{{ $cat->slug ? route('public.news.category', $cat->slug, false) : '#' }}">
                                <button type="submit" class="w-full text-left p-3.5 bg-[#fbfcfd] hover:bg-green-50 rounded-xl border border-transparent hover:border-green-100 transition-all flex items-center justify-between group">
                                    <span class="text-[13px] font-bold text-slate-600 group-hover:text-green-700">{{ $cat->name }}</span>
                                    <div class="w-7 h-7 bg-white rounded-lg shadow-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i data-lucide="plus" class="w-3 h-3 text-green-500"></i>
                                    </div>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Modules -->
            <div class="lux-acc-item">
                <div class="lux-acc-head" onclick="toggleLux('acc-modules', this)">
                    <div class="flex items-center gap-4">
                        <div class="icon-wrapper"><i data-lucide="layers" class="w-4 h-4"></i></div>
                        <span class="title">Modul Sistem</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3 h-3 text-slate-300"></i>
                </div>
                <div id="acc-modules" class="lux-acc-body hidden">
                    @php
                        $modules = [
                            ['label' => 'Beranda', 'url' => '/', 'icon' => 'home'],
                            ['label' => 'Produk Hukum', 'url' => route('public.documents.index', [], false), 'icon' => 'scale'],
                            ['label' => 'Survey Kepuasan', 'url' => route('public.survey', [], false), 'icon' => 'clipboard-check'],
                            ['label' => 'FAQs', 'url' => route('public.faq', [], false), 'icon' => 'help-circle'],
                        ];
                    @endphp
                    <div class="space-y-2">
                        @foreach($modules as $mod)
                            <form action="{{ route('admin.menus.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="location" value="{{ $location }}">
                                <input type="hidden" name="type" value="module">
                                <input type="hidden" name="label" value="{{ $mod['label'] }}">
                                <input type="hidden" name="url" value="{{ $mod['url'] }}">
                                <button type="submit" class="w-full text-left p-3.5 bg-[#fbfcfd] hover:bg-green-50 rounded-xl border border-transparent hover:border-green-100 transition-all flex items-center justify-between group">
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="{{ $mod['icon'] }}" class="w-3.5 h-3.5 text-slate-400"></i>
                                        <span class="text-[13px] font-bold text-slate-600 group-hover:text-green-700">{{ $mod['label'] }}</span>
                                    </div>
                                    <i data-lucide="plus" class="w-3.5 h-3.5 text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="lg:col-span-8">
        <div class="lux-card p-12 min-h-[700px] bg-white relative">
            <div class="absolute top-0 right-0 p-8 transform rotate-12 opacity-[0.03] pointer-events-none">
                <i data-lucide="shield" class="w-64 h-64 text-slate-900"></i>
            </div>
            
            <div class="flex items-center justify-between mb-12 relative z-10">
                <div>
                    <h2 class="text-2xl font-black text-slate-800">Visual Structure</h2>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1">Hierarchical Tree Management</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_10px_#22c55e]"></span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Safe State</span>
                </div>
            </div>

            <div class="dd" id="nestable">
                <ol class="dd-list">
                    @forelse($menus as $menu)
                        <li class="dd-item" data-id="{{ $menu->id }}">
                            <div class="dd-content">
                                <div class="flex items-center">
                                    <div class="dd-handle">
                                        <i data-lucide="grip-vertical" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm title-text">{{ $menu->label }}</div>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="lux-badge">{{ str_replace('_', ' ', $menu->type) }}</span>
                                            <span class="text-[9px] sub-text truncate max-w-[150px]">{{ $menu->url }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="lux-action-group">
                                    <button type="button" onclick='editMenu("{{ $menu->id }}", {!! json_encode($menu->label) !!}, {!! json_encode($menu->url) !!})' class="lux-action-btn btn-edit">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <button type="button" onclick="deleteMenu('{{ $menu->id }}')" class="lux-action-btn btn-delete">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                            </div>
                            <form id="delete-form-{{ $menu->id }}" action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="hidden">
                                @csrf @method('DELETE')
                            </form>
                            
                            @if($menu->children->count() > 0)
                                <ol class="dd-list">
                                    @foreach($menu->children as $child)
                                        <li class="dd-item" data-id="{{ $child->id }}">
                                            <div class="dd-content">
                                                <div class="flex items-center">
                                                    <div class="dd-handle">
                                                        <i data-lucide="grip-vertical" class="w-3.5 h-3.5"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm title-text">{{ $child->label }}</div>
                                                        <div class="flex items-center gap-2 mt-0.5">
                                                            <span class="lux-badge">{{ str_replace('_', ' ', $child->type) }}</span>
                                                            <span class="text-[9px] sub-text truncate max-w-[150px]">{{ $child->url }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="lux-action-group">
                                                    <button type="button" onclick='editMenu("{{ $child->id }}", {!! json_encode($child->label) !!}, {!! json_encode($child->url) !!})' class="lux-action-btn btn-edit">
                                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                                    </button>
                                                    <button type="button" onclick="deleteMenu('{{ $child->id }}')" class="lux-action-btn btn-delete">
                                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <form id="delete-form-{{ $child->id }}" action="{{ route('admin.menus.destroy', $child) }}" method="POST" class="hidden">
                                                @csrf @method('DELETE')
                                            </form>
                                        </li>
                                    @endforeach
                                </ol>
                            @endif
                        </li>
                    @empty
                        <div class="py-20 text-center border-2 border-dashed border-slate-100 rounded-[32px]">
                            <i data-lucide="inbox" class="w-12 h-12 text-slate-200 mx-auto mb-4"></i>
                            <p class="text-sm font-bold text-slate-300 uppercase tracking-widest">Stack is Empty</p>
                        </div>
                    @endforelse
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal - Moved Outside for Better Event Handling -->
<div id="editModal" class="lux-modal-overlay" style="z-index: 9999;">
    <div class="lux-modal">
        <div class="lux-modal-header">
            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Edit Menu Item</h3>
            <button onclick="closeEditModal()" class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                <i data-lucide="x" class="w-4 h-4 text-slate-400"></i>
            </button>
        </div>
        <div class="lux-modal-body">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">Menu Label</label>
                        <input type="text" name="label" id="editLabel" required class="lux-input">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">Target URL</label>
                        <input type="text" name="url" id="editUrl" placeholder="https://..." class="lux-input">
                    </div>
                </div>
            </form>
        </div>
        <div class="lux-modal-footer">
            <button type="button" onclick="closeEditModal()" class="px-6 py-3 text-[11px] font-black uppercase text-slate-400 hover:text-slate-600 transition-colors">Cancel</button>
            <button type="submit" form="editForm" class="lux-btn-save !shadow-none !py-3">Update Item</button>
        </div>
    </div>
</div>

<form id="sortForm" action="{{ route('admin.menus.update-order') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="hierarchy" id="hierarchyInput">
</form>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
<script>
    $(document).ready(function() {
        if($('#nestable').length) {
            $('#nestable').nestable({ maxDepth: 2 });
        }
        if(typeof lucide !== 'undefined') lucide.createIcons();
    });

    function toggleLux(id, head) {
        const body = document.getElementById(id);
        if(!body) return;
        
        const isHidden = body.classList.contains('hidden');
        
        // Close others in same container
        document.querySelectorAll('.lux-acc-body').forEach(b => b.classList.add('hidden'));
        document.querySelectorAll('.lux-acc-head').forEach(h => h.classList.remove('active'));
        
        // Toggle this one
        if(isHidden) {
            body.classList.remove('hidden');
            head.classList.add('active');
        }
    }

    function saveMenu() {
        const hierarchy = $('#nestable').nestable('serialize');
        document.getElementById('hierarchyInput').value = JSON.stringify(hierarchy);
        const form = document.getElementById('sortForm');
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST', 
            body: formData, 
            headers: { 
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => res.json()).then(data => {
            if (data.status === 'success') {
                alert('Hierarchy committed successfully!');
                window.location.reload();
            }
        }).catch(err => {
            console.error('Save failed:', err);
            alert('Failed to save structure.');
        });
    }

    function deleteMenu(id) {
        if (confirm('Permanently remove this node from stack?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    function editMenu(id, label, url) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const labelInput = document.getElementById('editLabel');
        const urlInput = document.getElementById('editUrl');

        form.action = `{{ url('admin/menus') }}/${id}`;
        labelInput.value = label;
        urlInput.value = url;

        modal.classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }
</script>
@endpush
