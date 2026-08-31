{{--
loc: resources/views/components/layouts/estate/top-nav.blade.php
usage: specific usage top navigation with Material Design 3 style buttons and centered modals
--}}

@props(['estate'])

<!-- Top Bar Navigation (M3 Style) -->
<div
    class="fixed top-0 left-0 right-0 z-40 max-w-md mx-auto px-4 py-3 flex items-center justify-between pointer-events-none">
    <!-- M3 Circular Icon Button (Back) -->
    <a href="{{ route('home') }}" wire:navigate
        class="w-10 h-10 rounded-full bg-white/90 backdrop-blur-md shadow-sm border border-slate-200/60 text-slate-700 flex items-center justify-center transition-all duration-200 hover:bg-white hover:shadow active:scale-95 pointer-events-auto">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7" />
        </svg>
    </a>

    <!-- M3 Tonal Button (Share) -->
    <button @click="shareModal = true" type="button"
        class="pointer-events-auto inline-flex items-center justify-center gap-2 h-10 px-4 rounded-full bg-white/90 hover:bg-slate-100 active:scale-95 text-slate-800 font-semibold text-xs backdrop-blur-md shadow-sm border border-slate-200/60 transition-all duration-200">
        <x-icons.icons-share />
        <span>Bagikan</span>
    </button>
</div>

<!-- Modal 1: Opsi Bagikan (M3 Centered Dialog) -->
<div x-show="shareModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <!-- Layer Backdrop: Hanya Fade In/Out (Tanpa Scale agar blur tidak glitch/kotak) -->
    <div x-show="shareModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="shareModal = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <!-- Layer Card Modal: Memakai Animasi Scale + Opacity -->
    <div x-show="shareModal" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative z-10 bg-white w-full max-w-xs sm:max-w-sm rounded-[28px] p-6 shadow-2xl border border-slate-100 space-y-5">

        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="font-bold text-slate-900 text-sm">Bagikan Properti Ini</h3>
            <button @click="shareModal = false" type="button"
                class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-2.5">
            <!-- Option 1: Copy Link -->
            <button @click="
                    navigator.clipboard.writeText('{{ url()->current() }}');
                    shareModal = false;
                    toastModal = true;
                    setTimeout(() => toastModal = false, 2000);
                " type="button"
                class="w-full text-left p-3.5 bg-slate-50 hover:bg-slate-100/80 active:scale-[0.98] rounded-2xl border border-slate-100 flex items-center space-x-3.5 transition-all">
                <div
                    class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-xs font-semibold text-slate-700">1. Salin Link Properti</span>
            </button>

            <!-- Option 2: Forward ke WA Lain -->
            <button @click="shareModal = false; waModal = true;" type="button"
                class="w-full text-left p-3.5 bg-slate-50 hover:bg-slate-100/80 active:scale-[0.98] rounded-2xl border border-slate-100 flex items-center space-x-3.5 transition-all">
                <div
                    class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <x-icons.icons-chat class="w-4 h-4 fill-current" />
                </div>
                <span class="text-xs font-semibold text-slate-700">2. Kirim ke WhatsApp Lain</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal 2: Input Nomor WA Tujuan (M3 Centered Dialog) -->
<div x-show="waModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <!-- Layer Backdrop -->
    <div x-show="waModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="waModal = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <!-- Layer Card Modal -->
    <div x-show="waModal" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative z-10 bg-white w-full max-w-xs sm:max-w-sm rounded-[28px] p-6 shadow-2xl border border-slate-100 space-y-5">

        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="font-bold text-slate-900 text-sm">Kirim via WhatsApp</h3>
            <button @click="waModal = false" type="button"
                class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nomor WhatsApp Tujuan:</label>
                <input type="text" x-model="shareTargetNumber" placeholder="Contoh: 08123456789"
                    class="w-full text-xs px-4 py-3 bg-slate-50 border border-slate-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:bg-white focus:border-transparent transition-all">
            </div>

            @php
                $shareText = rawurlencode("Lihat properti '{$estate->title}' di DownloadRumah ini: " . url()->current());
            @endphp

            <button @click="
                let num = shareTargetNumber.replace(/[^0-9]/g, '');
                if(num.startsWith('0')) num = '62' + num.slice(1);
                if(!num) { alert('Masukkan nomor WA yang valid'); return; }
                window.open('https://wa.me/' + num + '?text={{ $shareText }}', '_blank');
                waModal = false;
            " type="button"
                class="w-full h-11 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white font-semibold rounded-full text-xs flex items-center justify-center space-x-2 shadow-md shadow-emerald-600/20 transition-all">
                <span>Kirim Sekarang</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal 3: Toast Notifikasi (M3 Snackbar Style - Slide Up Bottom) -->
<div x-show="toastModal" x-cloak
    class="fixed bottom-6 inset-x-0 z-50 flex items-center justify-center p-4 pointer-events-none"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 scale-95">

    <div
        class="bg-slate-900 text-white px-5 py-3.5 rounded-full shadow-2xl flex items-center space-x-3 max-w-xs border border-slate-800 pointer-events-auto">
        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-xs font-medium">Link properti berhasil disalin!</span>
    </div>
</div>
