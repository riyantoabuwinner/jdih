<div id="aiAssistantWrapper" class="fixed z-[2000] bottom-10 right-10">
    <!-- Chat Window (Hidden by Default) -->
    <div id="aiChatWindow" class="absolute bottom-20 right-0 w-[400px] max-w-[calc(100vw-40px)] bg-slate-50 dark:bg-slate-900 rounded-[2rem] shadow-[0_20px_50px_-12px_rgba(212,175,55,0.4)] border border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden transition-all duration-300 origin-bottom-right scale-0 opacity-0 pointer-events-none">
        
        <!-- Header -->
        <div class="px-6 py-3 bg-gold flex items-center justify-between relative overflow-hidden">
            <!-- decorative background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent pointer-events-none"></div>
            
            <div class="flex items-center gap-4 relative z-10">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg shadow-yellow-900/20">
                    <i data-lucide="bot" class="w-7 h-7 text-yellow-600"></i>
                </div>
                <div>
                    <h3 class="font-black text-white text-lg leading-tight shadow-black drop-shadow-sm">JDIH Assistant</h3>
                    <p class="text-yellow-100 text-[11px] font-bold uppercase tracking-widest flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse inline-block"></span>
                        Online
                    </p>
                </div>
            </div>
            
            <button onclick="toggleAiChat()" class="text-white hover:bg-white/20 p-2 rounded-xl transition-colors relative z-10 focus:outline-none">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Chat History -->
        <div id="aiChatContent" class="h-[350px] overflow-y-auto p-6 space-y-5 bg-white dark:bg-slate-950 scroll-smooth">
            <!-- Initial Greeting -->
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-gold/10 text-yellow-600 dark:bg-gold/20 flex-shrink-0 flex items-center justify-center mt-1">
                    <i data-lucide="bot" class="w-5 h-5"></i>
                </div>
                <div class="bg-slate-100 dark:bg-slate-800/80 px-4 py-3 rounded-2xl rounded-tl-none max-w-[85%] text-sm text-slate-700 dark:text-slate-300 shadow-sm border border-slate-200 dark:border-slate-700/50">
                    <p class="font-bold text-slate-800 dark:text-slate-100 mb-1">Halo! 👋</p>
                    <p>Saya adalah **JDIH Assistant** UIN Siber Syekh Nurjati Cirebon. Anda bisa bertanya apa saja mengenai fitur, regulasi, atau proses bisnis aplikasi ini.</p>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800">
            <form id="aiChatForm" class="flex gap-2 relative">
                <input type="text" id="aiChatInput" autocomplete="off" placeholder="Ketik pertanyaan Anda di sini..." class="w-full bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-sm rounded-2xl px-5 py-3.5 focus:outline-none focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all dark:text-slate-200" required>
                <button type="submit" id="aiChatSubmitBtn" class="bg-gold hover:bg-yellow-600 text-white rounded-2xl px-4 flex items-center justify-center transition-colors focus:outline-none shadow-md shadow-yellow-500/20">
                    <i data-lucide="send" class="w-5 h-5"></i>
                </button>
            </form>
            <div class="text-center mt-2">
                <span class="text-[9px] text-slate-400 dark:text-slate-500 uppercase tracking-widest font-semibold flex flex-col hidden" id="aiTypingIndicator">
                    <span class="flex items-center justify-center gap-1">
                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    </span>
                    <span class="mt-1">Assistant is typing...</span>
                </span>
                <span class="text-[9px] text-slate-400 dark:text-slate-500 uppercase font-semibold" id="aiWatermark">
                    Powered by JDIH AI
                </span>
            </div>
        </div>
    </div>

    <!-- Floating Bubble -->
    <button onclick="toggleAiChat()" id="aiBubbleBtn" class="group flex items-center justify-center w-16 h-16 bg-gold hover:bg-yellow-500 text-white rounded-[2rem] hover:rounded-2xl shadow-[0_10px_30px_-5px_rgba(212,175,55,0.6)] hover:scale-110 active:scale-95 transition-all duration-300 focus:outline-none ring-4 ring-white/50 dark:ring-slate-900 absolute right-0 bottom-0">
        <i data-lucide="bot" class="w-8 h-8 group-hover:rotate-12 transition-transform"></i>
        <!-- Ping indicator -->
        <span class="absolute top-0 right-0 w-4 h-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500 border-2 border-white dark:border-slate-900 text-[8px] items-center justify-center font-bold font-sans">1</span>
        </span>
    </button>
</div>

<style>
/* Custom Scrollbar for Chat Content */
#aiChatContent::-webkit-scrollbar { width: 6px; }
#aiChatContent::-webkit-scrollbar-track { background: transparent; }
#aiChatContent::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
.dark #aiChatContent::-webkit-scrollbar-thumb { background-color: #334155; }

/* AI Message Markdown Styles */
.ai-message-body strong { font-weight: 800; color: inherit; }
.ai-message-body p { margin-bottom: 0.5rem; }
.ai-message-body p:last-child { margin-bottom: 0; }
.ai-message-body ul { list-style-type: disc; padding-left: 1.25rem; margin-bottom: 0.5rem; }
</style>

<script>
    function toggleAiChat() {
        const windowEl = document.getElementById('aiChatWindow');
        const isClosed = windowEl.classList.contains('scale-0');
        
        if (isClosed) {
            windowEl.classList.remove('scale-0', 'opacity-0', 'pointer-events-none');
            // Hide notification ping
            const ping = document.querySelector('#aiBubbleBtn > span');
            if(ping) ping.style.display = 'none';
            // Scroll to bottom
            const chatContent = document.getElementById('aiChatContent');
            chatContent.scrollTop = chatContent.scrollHeight;
            document.getElementById('aiChatInput').focus();
        } else {
            windowEl.classList.add('scale-0', 'opacity-0', 'pointer-events-none');
        }
    }

    const aiForm = document.getElementById('aiChatForm');
    const aiInput = document.getElementById('aiChatInput');
    const aiContent = document.getElementById('aiChatContent');
    const submitBtn = document.getElementById('aiChatSubmitBtn');
    const indicator = document.getElementById('aiTypingIndicator');
    const watermark = document.getElementById('aiWatermark');

    aiForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const message = aiInput.value.trim();
        if (!message) return;

        // Add user message to UI
        appendMessage('user', message);
        aiInput.value = '';
        
        // Show typing indicator
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50');
        watermark.classList.add('hidden');
        indicator.classList.remove('hidden');

        try {
            // Send request to backend
            const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';
            
            const response = await fetch('/api/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ message: message })
            });

            if (!response.ok) throw new Error('API Error');

            const data = await response.json();
            
            // Artificial delay to feel like the AI is 'typing'
            setTimeout(() => {
                appendMessage('ai', data.reply);
                finishTyping();
            }, 600);

        } catch (error) {
            console.error(error);
            setTimeout(() => {
                appendMessage('ai', "Maaf, sistem AI sedang mengalami kendala jaringan. Silakan coba beberapa saat lagi.");
                finishTyping();
            }, 600);
        }
    });

    function finishTyping() {
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-50');
        indicator.classList.add('hidden');
        watermark.classList.remove('hidden');
        aiInput.focus();
    }

    function formatAiText(text) {
        // Basic markdown formatting (bold, newlines, lists)
        let formatted = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        formatted = formatted.replace(/\n\n/g, '</p><p>');
        formatted = formatted.replace(/\n- (.*?)(?=\n|$)/g, '<li>$1</li>');
        if (formatted.includes('<li>')) {
            formatted = formatted.replace(/(<li>.*?<\/li>)/s, '<ul>$1</ul>');
            formatted = formatted.replace(/<\/li><li>/g, '</li><li>'); // Fix multiple items
        }
        return `<div class="ai-message-body"><p>${formatted}</p></div>`;
    }

    function appendMessage(sender, text) {
        const wrapper = document.createElement('div');
        wrapper.className = sender === 'user' ? 'flex gap-4 flex-row-reverse mb-5' : 'flex gap-4 mb-5 items-end';

        const bubble = document.createElement('div');
        if (sender === 'user') {
            bubble.className = "bg-slate-900 border-b-slate-800 dark:bg-slate-100/10 px-4 py-3 rounded-2xl rounded-tr-none max-w-[85%] text-sm text-white shadow-md";
            bubble.textContent = text;
        } else {
            bubble.className = "bg-slate-100 dark:bg-slate-800/80 px-4 py-3 rounded-2xl rounded-bl-none max-w-[85%] text-sm text-slate-700 dark:text-slate-300 shadow-sm border border-slate-200 dark:border-slate-700/50";
            bubble.innerHTML = formatAiText(text);
        }

        const iconBox = document.createElement('div');
        if (sender === 'ai') {
            iconBox.className = "w-8 h-8 rounded-full bg-gold/10 text-yellow-600 flex-shrink-0 flex items-center justify-center pb-1";
            iconBox.innerHTML = '<i data-lucide="bot" class="w-4 h-4"></i>';
            wrapper.appendChild(iconBox);
            wrapper.appendChild(bubble);
        } else {
            wrapper.appendChild(bubble);
        }

        aiContent.appendChild(wrapper);
        if (typeof lucide !== 'undefined') lucide.createIcons();
        
        // Auto scroll
        aiContent.scrollTop = aiContent.scrollHeight;
    }
</script>
