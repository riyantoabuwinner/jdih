{{-- Accessibility Panel - Fixed Above Chatbot --}}
<div id="accessibilityPanel" class="fixed right-10 bottom-28 z-[2000]">
    {{-- Main Toggle Button --}}
    <button id="accessibilityToggle" class="acc-toggle-btn w-14 h-14 rounded-2xl flex items-center justify-center shadow-2xl transition-all outline-none border-2 border-white/30 hover:scale-110 active:scale-95" aria-label="Pengaturan Aksesibilitas">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="16" cy="4" r="1"/><path d="m18 19 1-7-6 1"/><path d="m5 8 3-3 5.5 3-2.36 3.5"/><path d="M4.24 14.5a5 5 0 0 0 6.88 6"/><path d="M13.76 17.5a5 5 0 0 0-6.88-6"/></svg>
    </button>

    {{-- Accessibility Slide-out Panel --}}
    <div id="accessibilityMenu" class="acc-panel absolute bottom-0 right-20 w-[340px] bg-white dark:bg-slate-900 rounded-3xl shadow-[0_25px_60px_rgba(0,0,0,0.25)] border border-slate-200/60 dark:border-slate-700/60 transform scale-95 opacity-0 translate-y-4 invisible transition-all duration-400 overflow-hidden" style="max-height: 85vh;">
        {{-- ====== HEADER ====== --}}
        <div class="acc-header flex justify-between items-center px-5 py-4">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-white"><circle cx="16" cy="4" r="1"/><path d="m18 19 1-7-6 1"/><path d="m5 8 3-3 5.5 3-2.36 3.5"/><path d="M4.24 14.5a5 5 0 0 0 6.88 6"/><path d="M13.76 17.5a5 5 0 0 0-6.88-6"/></svg>
                <span class="text-white font-bold text-[15px] tracking-wide">Aksesibilitas</span>
            </div>
            <button id="closeAccessibility" class="text-white/70 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition-colors" aria-label="Tutup panel">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        {{-- ====== SCROLLABLE CONTENT ====== --}}
        <div class="acc-content p-5 space-y-6 overflow-y-auto" style="max-height: calc(85vh - 60px);">

            {{-- === SECTION 1: Ukuran Teks === --}}
            <div class="acc-section bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-lg">🔤</span>
                    <span class="font-bold text-slate-700 dark:text-slate-200 text-[13px]">Ukuran Teks</span>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <button onclick="accSetTextSize('normal')" class="acc-text-btn py-3 rounded-xl font-bold text-[13px] transition-all duration-200 border-2" data-size="normal">A</button>
                    <button onclick="accSetTextSize('large')" class="acc-text-btn py-3 rounded-xl font-bold text-[14px] transition-all duration-200 border-2" data-size="large">A+</button>
                    <button onclick="accSetTextSize('xlarge')" class="acc-text-btn py-3 rounded-xl font-bold text-[15px] transition-all duration-200 border-2" data-size="xlarge">A++</button>
                    <button onclick="accSetTextSize('xxlarge')" class="acc-text-btn py-3 rounded-xl font-bold text-[16px] transition-all duration-200 border-2" data-size="xxlarge">A+++</button>
                </div>
            </div>

            {{-- === SECTION 2: Tampilan === --}}
            <div class="acc-section bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-lg">🎨</span>
                    <span class="font-bold text-slate-700 dark:text-slate-200 text-[13px]">Tampilan</span>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <button onclick="accSetAppearance('normal')" class="acc-appearance-btn flex items-center gap-2.5 p-3.5 rounded-2xl border-2 transition-all duration-200 text-left" data-mode="normal">
                        <span class="text-base">☀️</span>
                        <span class="font-bold text-xs leading-tight">Normal</span>
                    </button>
                    <button onclick="accSetAppearance('high-contrast')" class="acc-appearance-btn flex items-center gap-2.5 p-3.5 rounded-2xl border-2 transition-all duration-200 text-left" data-mode="high-contrast">
                        <span class="text-base">◑</span>
                        <span class="font-bold text-xs leading-tight">Kontras<br>Tinggi</span>
                    </button>
                    <button onclick="accSetAppearance('dark-mode')" class="acc-appearance-btn flex items-center gap-2.5 p-3.5 rounded-2xl border-2 transition-all duration-200 text-left" data-mode="dark-mode">
                        <span class="text-base">🌙</span>
                        <span class="font-bold text-xs leading-tight">Mode<br>Gelap</span>
                    </button>
                    <button onclick="accSetAppearance('grayscale')" class="acc-appearance-btn flex items-center gap-2.5 p-3.5 rounded-2xl border-2 transition-all duration-200 text-left" data-mode="grayscale">
                        <span class="text-base">🔘</span>
                        <span class="font-bold text-xs leading-tight">Grayscale</span>
                    </button>
                </div>
            </div>

            {{-- === SECTION 3: Pengaturan Lain === --}}
            <div class="acc-section bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-5">
                    <span class="text-lg">✨</span>
                    <span class="font-bold text-slate-700 dark:text-slate-200 text-[13px]">Pengaturan Lain</span>
                </div>
                <div class="space-y-5">
                    {{-- Sorot Link --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-base">🔗</span>
                            <span class="text-[12px] font-semibold text-slate-600 dark:text-slate-300">Sorot Link</span>
                        </div>
                        <label class="acc-switch relative inline-block w-12 h-7 cursor-pointer">
                            <input type="checkbox" id="toggleHighlightLinks" class="sr-only" onchange="accToggleFeature('highlight-links', this.checked)">
                            <span class="acc-slider"></span>
                        </label>
                    </div>
                    {{-- Font Disleksia --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-base">🔤</span>
                            <span class="text-[12px] font-semibold text-slate-600 dark:text-slate-300">Font Disleksia</span>
                        </div>
                        <label class="acc-switch relative inline-block w-12 h-7 cursor-pointer">
                            <input type="checkbox" id="toggleDyslexiaFont" class="sr-only" onchange="accToggleFeature('dyslexia-font', this.checked)">
                            <span class="acc-slider"></span>
                        </label>
                    </div>
                    {{-- Jeda Animasi --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-base">⏸</span>
                            <span class="text-[12px] font-semibold text-slate-600 dark:text-slate-300">Jeda Animasi</span>
                        </div>
                        <label class="acc-switch relative inline-block w-12 h-7 cursor-pointer">
                            <input type="checkbox" id="togglePauseAnimations" class="sr-only" onchange="accToggleFeature('pause-animations', this.checked)">
                            <span class="acc-slider"></span>
                        </label>
                    </div>
                    {{-- Kursor Besar --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-base">🖱️</span>
                            <span class="text-[12px] font-semibold text-slate-600 dark:text-slate-300">Kursor Besar</span>
                        </div>
                        <label class="acc-switch relative inline-block w-12 h-7 cursor-pointer">
                            <input type="checkbox" id="toggleLargeCursor" class="sr-only" onchange="accToggleFeature('large-cursor', this.checked)">
                            <span class="acc-slider"></span>
                        </label>
                    </div>
                    {{-- Jarak Baris --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-base">↕️</span>
                            <span class="text-[12px] font-semibold text-slate-600 dark:text-slate-300">Jarak Baris</span>
                        </div>
                        <label class="acc-switch relative inline-block w-12 h-7 cursor-pointer">
                            <input type="checkbox" id="toggleLineSpacing" class="sr-only" onchange="accToggleFeature('line-spacing', this.checked)">
                            <span class="acc-slider"></span>
                        </label>
                    </div>
                    {{-- Jarak Huruf --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-base">↔️</span>
                            <span class="text-[12px] font-semibold text-slate-600 dark:text-slate-300">Jarak Huruf</span>
                        </div>
                        <label class="acc-switch relative inline-block w-12 h-7 cursor-pointer">
                            <input type="checkbox" id="toggleLetterSpacing" class="sr-only" onchange="accToggleFeature('letter-spacing', this.checked)">
                            <span class="acc-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- === SECTION 4: Pembaca Layar (TTS) === --}}
            <div class="acc-section bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">🔊</span>
                        <span class="font-bold text-slate-700 dark:text-slate-200 text-[13px]">Pembaca Layar (TTS)</span>
                    </div>
                    <div id="ttsStatus" class="w-2.5 h-2.5 rounded-full bg-slate-300 transition-colors shadow-inner"></div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <button id="startTTSBtn" onclick="accStartTTS()" class="flex items-center justify-center gap-2 py-3.5 rounded-xl bg-blue-600 text-white text-[11px] font-bold uppercase tracking-widest transition-all hover:bg-blue-700 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        MULAI
                    </button>
                    <button id="stopTTSBtn" onclick="accStopTTS()" class="flex items-center justify-center gap-2 py-3.5 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-[11px] font-bold uppercase tracking-widest transition-all hover:bg-slate-300 dark:hover:bg-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/></svg>
                        STOP
                    </button>
                </div>
                <div class="mt-4 flex items-start gap-3">
                    <span class="text-blue-500 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    </span>
                    <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium leading-relaxed">
                        Tekan MULAI, lalu sorot (blok) teks di layar untuk dibacakan. Logat suara mengikuti bahasa situs.
                    </p>
                </div>
            </div>

            {{-- Reset Button --}}
            <button onclick="accResetAll()" class="w-full py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-900/20 text-slate-500 hover:text-red-500 text-[11px] font-bold uppercase tracking-widest transition-all flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                Reset Semua Pengaturan
            </button>
        </div>
    </div>
</div>

<style>
    /* ===== TOGGLE BUTTON ===== */
    .acc-toggle-btn {
        background: linear-gradient(135deg, #065f46 0%, #064e3b 100%);
        color: white;
        box-shadow: 0 8px 30px rgba(6, 78, 59, 0.45);
    }

    /* ===== HEADER ===== */
    .acc-header {
        background: linear-gradient(135deg, #065f46 0%, #064e3b 100%);
    }

    /* ===== SCROLLBAR ===== */
    .acc-content::-webkit-scrollbar { width: 4px; }
    .acc-content::-webkit-scrollbar-track { background: transparent; }
    .acc-content::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }

    /* ===== TEXT SIZE BUTTONS ===== */
    .acc-text-btn {
        background: white;
        border-color: #e2e8f0;
        color: #475569;
        cursor: pointer;
    }
    .dark .acc-text-btn {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.1);
        color: #94a3b8;
    }
    .acc-text-btn:hover {
        border-color: #facc15;
        background: #fffbeb;
    }
    .acc-text-btn.active {
        background-color: #facc15 !important;
        border-color: #facc15 !important;
        color: #1e293b !important;
        font-weight: 900;
        box-shadow: 0 4px 12px rgba(250, 204, 21, 0.35);
    }

    /* ===== APPEARANCE BUTTONS ===== */
    .acc-appearance-btn {
        background: white;
        border-color: #e2e8f0;
        color: #475569;
        cursor: pointer;
    }
    .dark .acc-appearance-btn {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.1);
        color: #94a3b8;
    }
    .acc-appearance-btn:hover {
        border-color: #facc15;
        background: #fffbeb;
    }
    .acc-appearance-btn.active {
        background-color: #facc15 !important;
        border-color: #facc15 !important;
        color: #1e293b !important;
        font-weight: 900;
        box-shadow: 0 4px 12px rgba(250, 204, 21, 0.35);
    }

    /* ===== CUSTOM TOGGLE SWITCH ===== */
    .acc-slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background-color: #cbd5e1;
        border-radius: 9999px;
        transition: .3s;
    }
    .dark .acc-slider {
        background-color: #334155;
    }
    .acc-slider::before {
        content: "";
        position: absolute;
        height: 21px;
        width: 21px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        border-radius: 50%;
        transition: .3s;
        box-shadow: 0 1px 3px rgba(0,0,0,0.15);
    }
    input:checked + .acc-slider {
        background-color: #2563eb;
    }
    input:checked + .acc-slider::before {
        transform: translateX(20px);
    }

    /* ===== ACCESSIBILITY GLOBAL STYLES ===== */
    html.acc-text-large { font-size: 112%; }
    html.acc-text-xlarge { font-size: 124%; }
    html.acc-text-xxlarge { font-size: 136%; }

    html.acc-high-contrast {
        filter: contrast(1.6);
    }
    html.acc-high-contrast body {
        background: #fff !important;
    }

    html.acc-grayscale {
        filter: grayscale(100%);
    }

    html.acc-highlight-links a {
        outline: 3px solid #2563eb !important;
        outline-offset: 2px !important;
        background-color: rgba(59, 130, 246, 0.08) !important;
        text-decoration: underline !important;
    }

    html.acc-dyslexia-font,
    html.acc-dyslexia-font * {
        font-family: 'OpenDyslexic', 'Comic Sans MS', sans-serif !important;
    }

    @font-face {
        font-family: 'OpenDyslexic';
        src: url('https://cdn.jsdelivr.net/gh/antijingoist/opendyslexic@master/compiled/OpenDyslexic-Regular.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }

    html.acc-large-cursor, html.acc-large-cursor * {
        cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white" stroke="black" stroke-width="2"><path d="M4 4l5.9 16.5c.3.8 1.4.9 1.9.1l2.4-4.5 4.5-2.4c.8-.5.7-1.6-.1-1.9L4 4z"/></svg>'), auto !important;
    }

    html.acc-line-spacing * {
        line-height: 2 !important;
    }

    html.acc-letter-spacing * {
        letter-spacing: 0.15em !important;
    }

    html.acc-pause-animations *,
    html.acc-pause-animations *::before,
    html.acc-pause-animations *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
        scroll-behavior: auto !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('accessibilityToggle');
    const menu = document.getElementById('accessibilityMenu');
    const closeBtn = document.getElementById('closeAccessibility');

    // Open/close panel
    if (toggle) {
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            const isHidden = menu.classList.contains('invisible');
            if (isHidden) {
                menu.classList.remove('invisible', 'opacity-0', 'translate-y-4', 'scale-95');
                menu.classList.add('opacity-100', 'translate-y-0', 'scale-100');
            } else {
                menu.classList.add('invisible', 'opacity-0', 'translate-y-4', 'scale-95');
                menu.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            }
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            menu.classList.add('invisible', 'opacity-0', 'translate-y-4', 'scale-95');
            menu.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
        });
    }

    // Close on outside click
    document.addEventListener('click', (e) => {
        if (!menu.contains(e.target) && !toggle.contains(e.target)) {
            menu.classList.add('invisible', 'opacity-0', 'translate-y-4', 'scale-95');
            menu.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
        }
    });

    // Initialize from localStorage
    accInitAll();
});

function accInitAll() {
    const savedSize = localStorage.getItem('acc-text-size') || 'normal';
    accSetTextSize(savedSize, true);

    const savedAppearance = localStorage.getItem('acc-appearance') || 'normal';
    accSetAppearance(savedAppearance, true);

    ['highlight-links', 'dyslexia-font', 'pause-animations', 'large-cursor', 'line-spacing', 'letter-spacing'].forEach(f => {
        const isOn = localStorage.getItem('acc-' + f) === 'true';
        const toggle = document.getElementById('toggle' + accCapitalize(f));
        if (toggle) toggle.checked = isOn;
        if (isOn) document.documentElement.classList.add('acc-' + f);
    });
}

function accSetTextSize(size, isInit) {
    document.documentElement.classList.remove('acc-text-large', 'acc-text-xlarge', 'acc-text-xxlarge');
    if (size !== 'normal') {
        document.documentElement.classList.add('acc-text-' + size);
    }
    localStorage.setItem('acc-text-size', size);
    document.querySelectorAll('.acc-text-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.size === size);
    });
}

function accSetAppearance(mode, isInit) {
    // Remove all appearance classes
    document.documentElement.classList.remove('acc-high-contrast', 'acc-grayscale');

    if (mode === 'dark-mode') {
        if (typeof applyTheme === 'function') applyTheme(true);
        localStorage.theme = 'dark';
    } else if (mode === 'normal') {
        if (typeof applyTheme === 'function') applyTheme(false);
        localStorage.theme = 'light';
    } else if (mode === 'high-contrast') {
        document.documentElement.classList.add('acc-high-contrast');
    } else if (mode === 'grayscale') {
        document.documentElement.classList.add('acc-grayscale');
    }

    localStorage.setItem('acc-appearance', mode);
    document.querySelectorAll('.acc-appearance-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.mode === mode);
    });
}

function accToggleFeature(feature, enabled) {
    if (enabled) {
        document.documentElement.classList.add('acc-' + feature);
    } else {
        document.documentElement.classList.remove('acc-' + feature);
    }
    localStorage.setItem('acc-' + feature, enabled);
}

function accResetAll() {
    // Reset text size
    accSetTextSize('normal');

    // Reset appearance
    document.documentElement.classList.remove('acc-high-contrast', 'acc-grayscale');
    if (typeof applyTheme === 'function') applyTheme(false);
    localStorage.theme = 'light';
    localStorage.setItem('acc-appearance', 'normal');
    document.querySelectorAll('.acc-appearance-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.mode === 'normal');
    });

    // Reset toggles
    ['highlight-links', 'dyslexia-font', 'pause-animations', 'large-cursor', 'line-spacing', 'letter-spacing'].forEach(f => {
        document.documentElement.classList.remove('acc-' + f);
        localStorage.removeItem('acc-' + f);
        const toggle = document.getElementById('toggle' + accCapitalize(f));
        if (toggle) toggle.checked = false;
    });

    localStorage.removeItem('acc-text-size');
    accStopTTS();
}

function accCapitalize(str) {
    return str.split('-').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join('');
}

// === TTS Logic ===
window.accTTSAutoMode = false;

function accStartTTS() {
    window.accTTSAutoMode = true;
    
    const startBtn = document.getElementById('startTTSBtn');
    if (startBtn) {
        startBtn.classList.replace('bg-blue-600', 'bg-green-600');
        startBtn.classList.replace('hover:bg-blue-700', 'hover:bg-green-600'); // Note: to simplify
        startBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" x2="12" y1="19" y2="22"/></svg> AKTIF';
    }
    
    // Read current selection if any
    const selectedText = window.getSelection().toString().trim();
    if (selectedText) {
        accPlayText(selectedText);
    }
}

function accStopTTS() {
    window.accTTSAutoMode = false;
    window.speechSynthesis.cancel();
    
    const startBtn = document.getElementById('startTTSBtn');
    if (startBtn) {
        startBtn.classList.replace('bg-green-600', 'bg-blue-600');
        startBtn.classList.replace('hover:bg-green-600', 'hover:bg-blue-700');
        startBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg> MULAI';
    }
    const statusDot = document.getElementById('ttsStatus');
    if (statusDot && statusDot.classList.contains('bg-blue-500')) {
        statusDot.classList.replace('bg-blue-500', 'bg-slate-300');
    }
}

function accPlayText(text) {
    if (!text.trim()) return;
    window.speechSynthesis.cancel();

    const utterance = new SpeechSynthesisUtterance(text);
    
    // Determine language from switcher
    const langLabelEl = document.getElementById('currentLangLabel');
    let targetLang = 'id-ID';
    if (langLabelEl) {
        const currentLang = langLabelEl.innerText.toLowerCase();
        if (currentLang === 'id') targetLang = 'id-ID';
        else if (currentLang === 'en') targetLang = 'en-US';
        else if (currentLang === 'ar') targetLang = 'ar-SA';
    }
    
    utterance.lang = targetLang;

    // Explicitly try to pick an explicit local voice for the desired accent
    const availableVoices = window.speechSynthesis.getVoices();
    if (availableVoices && availableVoices.length > 0) {
        let selectedVoice = availableVoices.find(voice => voice.lang.replace('_', '-').toLowerCase().includes(targetLang.toLowerCase()));
        
        // Fallback for general matches (e.g., just 'en' instead of 'en-US')
        if (!selectedVoice) {
            const shortLang = targetLang.split('-')[0];
            selectedVoice = availableVoices.find(voice => voice.lang.toLowerCase().startsWith(shortLang));
        }

        if (selectedVoice) {
            utterance.voice = selectedVoice;
        }
    }

    const statusDot = document.getElementById('ttsStatus');
    utterance.onstart = () => {
        if (statusDot) statusDot.classList.replace('bg-slate-300', 'bg-blue-500');
    };
    utterance.onend = () => {
        if (statusDot) statusDot.classList.replace('bg-blue-500', 'bg-slate-300');
    };

    window.speechSynthesis.speak(utterance);
}

// Global listener for automatic reading on highlight
document.addEventListener('mouseup', () => {
    if (window.accTTSAutoMode) {
        setTimeout(() => {
            const selectedText = window.getSelection().toString().trim();
            if (selectedText) {
                accPlayText(selectedText);
            }
        }, 100); // slight delay to allow selection to register
    }
});
</script>
