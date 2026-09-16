{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/components/layouts/estate/top-nav.blade.php
| @usage      : specific usage top navigation with Material Design 3 style buttons and centered modals
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@props(['estate'])

<!-- Top Bar Navigation (M3 Style) -->
<div
    class="fixed top-0 left-0 right-0 z-40 max-w-md mx-auto px-4 py-3 flex items-center justify-between pointer-events-none"
>
    <a
        href="{{ route('home') }}"
        wire:navigate
        class="pointer-events-auto flex h-10 w-10 items-center justify-center rounded-full
               border border-slate-200/60 bg-white/90 text-slate-700 shadow-sm
               backdrop-blur-md transition-all duration-200
               hover:bg-white hover:shadow active:scale-95
               dark:border-slate-700/60 dark:bg-slate-900/90 dark:text-slate-200
               dark:hover:bg-slate-800"
        title="Kembali ke Beranda"
    >
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2.2"
                d="M15 19l-7-7 7-7"
            />
        </svg>
    </a>

    <button
        @click="shareModal = true"
        type="button"
        class="pointer-events-auto inline-flex h-10 items-center justify-center gap-2
               rounded-full border border-slate-200/60 bg-white/90 px-4
               text-xs font-semibold text-slate-800 shadow-sm backdrop-blur-md
               transition-all duration-200 hover:bg-slate-100 active:scale-95
               dark:border-slate-700/60 dark:bg-slate-900/90 dark:text-slate-100
               dark:hover:bg-slate-800"
    >
        <x-icons.icons-share />
        <span>Bagikan</span>
    </button>
</div>

<!-- Modal 1: Opsi Bagikan -->
<div x-show="shareModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div
        x-show="shareModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="shareModal = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"
    ></div>

    <div
        x-show="shareModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative z-10 w-full max-w-xs space-y-5 rounded-[28px]
               border border-slate-200 bg-white p-6 shadow-2xl
               dark:border-slate-700 dark:bg-slate-900"
    >
        <div class="flex items-center justify-between border-b border-slate-100 pb-3 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                Bagikan Properti Ini
            </h3>

            <button
                @click="shareModal = false"
                type="button"
                class="flex h-8 w-8 items-center justify-center rounded-full
                       text-slate-400 transition-colors hover:bg-slate-100
                       hover:text-slate-600
                       dark:hover:bg-slate-800 dark:hover:text-slate-200"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
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
                class="flex w-full items-center space-x-3.5 rounded-md
                       border border-slate-200 bg-slate-50 p-3.5 text-left
                       transition-all hover:bg-slate-100/80 active:scale-[0.98]
                       dark:border-slate-700 dark:bg-slate-800
                       dark:hover:bg-slate-700"
            >
                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full
                           bg-indigo-100 text-indigo-600
                           dark:bg-indigo-950/60 dark:text-indigo-400"
                >
                    <svg class="h-4 w-4 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                        />
                    </svg>
                </div>

                <span class="text-xs font-semibold text-slate-700 dark:text-slate-200">
                    1. Salin Link Properti
                </span>
            </button>

            <button
                @click="shareModal = false; waModal = true;"
                type="button"
                class="flex w-full items-center space-x-3.5 rounded-md
                       border border-slate-200 bg-slate-50 p-3.5 text-left
                       transition-all hover:bg-slate-100/80 active:scale-[0.98]
                       dark:border-slate-700 dark:bg-slate-800
                       dark:hover:bg-slate-700"
            >
                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full
                           bg-emerald-100 text-emerald-600
                           dark:bg-emerald-950/60 dark:text-emerald-400"
                >
                    <x-icons.icons-chat class="h-4 w-4 fill-current" />
                </div>

                <span class="text-xs font-semibold text-slate-700 dark:text-slate-200">
                    2. Kirim ke WhatsApp Lain
                </span>
            </button>
        </div>
    </div>
</div>

<!-- Modal 2: Input Nomor WA Tujuan -->
<div x-show="waModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div
        x-show="waModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="waModal = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"
    ></div>

    <div
        x-show="waModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative z-10 w-full max-w-xs space-y-5 rounded-[28px]
               border border-slate-200 bg-white p-6 shadow-2xl
               dark:border-slate-700 dark:bg-slate-900"
    >
        <div class="flex items-center justify-between border-b border-slate-100 pb-3 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                Kirim via WhatsApp
            </h3>

            <button
                @click="waModal = false"
                type="button"
                class="flex h-8 w-8 items-center justify-center rounded-full
                       text-slate-400 transition-colors hover:bg-slate-100
                       hover:text-slate-600
                       dark:hover:bg-slate-800 dark:hover:text-slate-200"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-4">
            <div>
                <label class="mb-1.5 block text-xs font-semibold text-slate-600 dark:text-slate-300">
                    Nomor WhatsApp Tujuan:
                </label>

                <input
                    type="text"
                    x-model="shareTargetNumber"
                    placeholder="Contoh: 08123456789"
                    class="w-full rounded-md border border-slate-200 bg-slate-50 px-4 py-3
                           text-xs text-slate-800 transition-all
                           placeholder:text-slate-400 focus:border-transparent
                           focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-600
                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100
                           dark:placeholder:text-slate-500 dark:focus:bg-slate-800"
                />
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
                class="flex h-11 w-full items-center justify-center space-x-2 rounded-full
                       bg-emerald-600 text-xs font-semibold text-white
                       shadow-md shadow-emerald-600/20 transition-all
                       hover:bg-emerald-700 active:scale-[0.98]"
            >
                <span>Kirim Sekarang</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal 3: Toast Notifikasi -->
<div
    x-show="toastModal"
    x-cloak
    class="pointer-events-none fixed inset-x-0 bottom-6 z-50 flex items-center justify-center p-4"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 scale-95"
>
    <div
        class="pointer-events-auto flex max-w-xs items-center space-x-3 rounded-full
               border border-slate-800 bg-slate-900 px-5 py-3.5 text-white shadow-2xl
               dark:border-slate-700 dark:bg-slate-800"
    >
        <svg class="h-5 w-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2.5"
                d="M5 13l4 4L19 7"
            />
        </svg>

        <span class="text-xs font-medium">
            Link properti berhasil disalin!
        </span>
    </div>
</div>
