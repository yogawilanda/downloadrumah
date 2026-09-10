{{--
|--------------------------------------------------------------------------
| Contextual Header Control Component (Estate Show)
|--------------------------------------------------------------------------
| @path       : resources/views/components/layouts/estate/header-control.blade.php
| @usage      : Contextual control header across mobile, tablet, and desktop
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@props(['estate'])

{{-- 1. DESKTOP SUB-HEADER BAR (Shown on lg+) --}}
<div class="hidden lg:block w-full max-w-6xl mx-auto px-4 md:px-6 lg:px-8 py-3 mb-2">
    <div class="flex items-center justify-between gap-4">
        {{-- Breadcrumb & Back Link --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" wire:navigate
                class="p-2 bg-white hover:bg-slate-100 text-slate-700 rounded-md border border-slate-200/80 shadow-sm transition active:scale-95"
                title="Kembali ke Beranda">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <nav class="flex items-center gap-2 text-xs font-medium text-slate-500">
                <a href="{{ route('home') }}" wire:navigate class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-slate-400 capitalize">
                    {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
                </span>

                {{-- Ambil Nama Kota / Kabupaten --}}
                @if ($estate->city?->name)
                    <span>/</span>
                    <span class="text-slate-600">
                        {{ $estate->city->name }}
                    </span>
                @endif

                {{-- Ambil Nama Kecamatan (Opsional) --}}
                @if ($estate->district?->name)
                    <span>/</span>
                    <span class="text-slate-600">
                        {{ $estate->district->name }}
                    </span>
                @endif

                <span>/</span>
                <span class="text-slate-800 font-bold truncate max-w-[280px]">
                    {{ $estate->title }}
                </span>
            </nav>
        </div>

        {{-- Desktop Action Utility Buttons --}}
        <div class="flex items-center gap-2">
            <button @click="shareModal = true" type="button"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs border border-slate-200/80 shadow-sm transition active:scale-95">
                <x-icons.icons-share class="w-4 h-4" />
                <span>Bagikan Properti</span>
            </button>
        </div>
    </div>
</div>

{{-- 2. MOBILE & TABLET FLOATING M3 CONTROL (Shown on < lg) --}}
<div class="lg:hidden fixed top-0 left-0 right-0 z-40 px-4 py-3 flex items-center justify-between pointer-events-none">
    <!-- M3 Back Icon Button -->
    <a href="{{ route('home') }}" wire:navigate
        class="w-10 h-10 rounded-full bg-white/90 backdrop-blur-md shadow-sm border border-slate-200/60 text-slate-700 flex items-center justify-center transition-all duration-200 hover:bg-white active:scale-95 pointer-events-auto">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7" />
        </svg>
    </a>

    <!-- M3 Tonal Share Button -->
    <button @click="shareModal = true" type="button"
        class="pointer-events-auto inline-flex items-center justify-center gap-2 h-10 px-4 rounded-full bg-white/90 hover:bg-slate-100 active:scale-95 text-slate-800 font-bold text-xs backdrop-blur-md shadow-sm border border-slate-200/60 transition-all duration-200">
        <x-icons.icons-share class="w-4 h-4" />
        <span>Bagikan</span>
    </button>
</div>

{{-- 3. MODAL 1: Opsi Bagikan (M3 Centered Dialog) --}}
<div x-show="shareModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div x-show="shareModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="shareModal = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

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
            <button
                @click="
                    navigator.clipboard.writeText('{{ url()->current() }}');
                    shareModal = false;
                    toastModal = true;
                    setTimeout(() => toastModal = false, 2000);
                "
                type="button"
                class="w-full text-left p-3.5 bg-slate-50 hover:bg-slate-100/80 active:scale-[0.98] rounded-md border border-slate-100 flex items-center space-x-3.5 transition-all">
                <div
                    class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-700">1. Salin Link Properti</span>
            </button>

            <button @click="shareModal = false; waModal = true;" type="button"
                class="w-full text-left p-3.5 bg-slate-50 hover:bg-slate-100/80 active:scale-[0.98] rounded-md border border-slate-100 flex items-center space-x-3.5 transition-all">
                <div
                    class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <x-icons.icons-chat class="w-4 h-4 fill-current" />
                </div>
                <span class="text-xs font-bold text-slate-700">2. Kirim ke WhatsApp Lain</span>
            </button>
        </div>
    </div>
</div>

{{-- 4. MODAL 2: Input Nomor WA Tujuan (M3 Centered Dialog) --}}
<div x-show="waModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div x-show="waModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="waModal = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

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
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor WhatsApp Tujuan:</label>
                <input type="text" x-model="shareTargetNumber" placeholder="Contoh: 08123456789"
                    class="w-full text-xs px-4 py-3 bg-slate-50 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:bg-white transition-all">
            </div>

            @php
                $shareText = rawurlencode(
                    "Lihat properti '{$estate->title}' di DownloadRumah ini: " . url()->current(),
                );
            @endphp

            <button
                @click="
                let num = shareTargetNumber.replace(/[^0-9]/g, '');
                if(num.startsWith('0')) num = '62' + num.slice(1);
                if(!num) { alert('Masukkan nomor WA yang valid'); return; }
                window.open('https://wa.me/' + num + '?text={{ $shareText }}', '_blank');
                waModal = false;
            "
                type="button"
                class="w-full h-11 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white font-bold rounded-full text-xs flex items-center justify-center space-x-2 shadow-md shadow-emerald-600/20 transition-all">
                <span>Kirim Sekarang</span>
            </button>
        </div>
    </div>
</div>

{{-- 5. MODAL 3: Toast Notifikasi --}}
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
