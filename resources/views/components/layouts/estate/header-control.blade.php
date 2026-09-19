{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
    | @path : resources/views/components/layouts/estate/header-control.blade.php
    | @usage : Contextual control header across mobile, tablet, and desktop
    | @type : Estate Header Control Component
    | @expected_data : [$estate]
    | @design_tokens : Font: Outfit | Theme: White / Slate / Sky Accent
    |
    | @ruling_ui : Hard borders, restrained geometry, minimal rounding, sky accent.
    | @ruling_motion : Short 150–200ms transitions only.
    |
    | @status : Active
    | @author : yogawilanda <eayogawilanda@gmail.com>
        | </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@props(['estate'])


{{-- Alpine State --}}
<div
    x-data="{
        shareModal: false,
        waModal: false,
        toastModal: false,
        shareTargetNumber: ''
    }"
>


    {{-- 1. DESKTOP SUB-HEADER BAR --}}

    <div class="mx-auto mb-2 hidden w-full max-w-6xl px-4 py-3 md:px-6 lg:block lg:px-8">

        <div class="flex items-center justify-between gap-4">

            {{-- Breadcrumb & Back Link --}}

            <div class="flex items-center gap-3">

                <button
                    type="button"
                    onclick="window.history.back()"
                    class="border border-slate-200/80 bg-white p-2 text-slate-700
                           shadow-sm transition hover:bg-slate-50 active:scale-95
                           dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200
                           dark:hover:bg-slate-800"
                    title="Kembali"
                    aria-label="Kembali"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2.2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </button>


                <nav class="flex items-center gap-2 text-xs font-medium
                           text-slate-500 dark:text-slate-400">

                    <a
                        href="{{ route('home') }}"
                        wire:navigate
                        class="transition hover:text-sky-600 dark:hover:text-sky-400"
                    >
                        Beranda
                    </a>

                    <span class="text-slate-300 dark:text-slate-700">/</span>

                    <span class="text-slate-400 dark:text-slate-500">
                        {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
                    </span>


                    @if ($estate->city?->name)

                        <span class="text-slate-300 dark:text-slate-700">/</span>

                        <span class="text-slate-600 dark:text-slate-300">
                            {{ $estate->city->name }}
                        </span>

                    @endif


                    @if ($estate->district?->name)

                        <span class="text-slate-300 dark:text-slate-700">/</span>

                        <span class="text-slate-600 dark:text-slate-300">
                            {{ $estate->district->name }}
                        </span>

                    @endif


                    <span class="text-slate-300 dark:text-slate-700">/</span>

                    <span class="max-w-[280px] truncate font-bold text-slate-800
                               dark:text-slate-100">
                        {{ $estate->title }}
                    </span>

                </nav>

            </div>


            {{-- Desktop Action Utility --}}

            <div class="flex items-center gap-2">

                <button
                    type="button"
                    @click="shareModal = true"
                    class="inline-flex items-center gap-2 border border-slate-200/80
                           bg-white px-4 py-2 text-xs font-bold text-slate-700
                           shadow-sm transition hover:bg-slate-50 active:scale-95
                           dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200
                           dark:hover:bg-slate-800"
                >
                    <x-icons.icons-share class="h-4 w-4" />

                    <span>
                        Bagikan Properti
                    </span>
                </button>

            </div>

        </div>

    </div>


    {{-- 2. MOBILE & TABLET FLOATING CONTROL --}}

    <div
        class="pointer-events-none fixed left-0 right-0 top-0 z-40
               flex items-center justify-between px-4 py-3 lg:hidden"
    >

        {{-- Back --}}

        <button
            type="button"
            onclick="window.history.back()"
            class="pointer-events-auto border border-slate-200/80 bg-white p-2
                   text-slate-700 shadow-sm transition hover:bg-slate-50
                   active:scale-95
                   dark:border-slate-700 dark:bg-slate-900
                   dark:text-slate-200 dark:hover:bg-slate-800"
            title="Kembali"
            aria-label="Kembali"
        >
            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2.2"
                    d="M15 19l-7-7 7-7"
                />
            </svg>
        </button>


        {{-- Share --}}

        <button
            type="button"
            @click="shareModal = true"
            class="pointer-events-auto inline-flex h-10 items-center justify-center
                   gap-2 border border-slate-200/60 bg-white/90 px-4
                   text-xs font-bold text-slate-800 shadow-sm backdrop-blur-md
                   transition hover:bg-slate-100 active:scale-95
                   dark:border-slate-700/70 dark:bg-slate-900/90
                   dark:text-slate-100 dark:hover:bg-slate-800"
        >
            <x-icons.icons-share class="h-4 w-4" />

            <span>
                Bagikan
            </span>
        </button>

    </div>


    {{-- 3. SHARE OPTIONS MODAL --}}

    <div
        x-show="shareModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
    >

        {{-- Backdrop --}}

        <div
            x-show="shareModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="shareModal = false"
            class="fixed inset-0 bg-slate-950/50 backdrop-blur-sm
                   dark:bg-black/60"
        ></div>


        {{-- Modal --}}

        <div
            x-show="shareModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative z-10 w-full max-w-xs space-y-5 border
                   border-slate-200 bg-white p-6 shadow-2xl
                   dark:border-slate-700 dark:bg-slate-900
                   sm:max-w-sm"
        >

            <div
                class="flex items-center justify-between border-b
                       border-slate-200 pb-3 dark:border-slate-800"
            >
                <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                    Bagikan Properti Ini
                </h3>

                <button
                    type="button"
                    @click="shareModal = false"
                    class="flex h-8 w-8 items-center justify-center
                           text-slate-400 transition hover:bg-slate-100
                           hover:text-slate-700
                           dark:hover:bg-slate-800
                           dark:hover:text-slate-200"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>


            <div class="space-y-2.5">

                {{-- Copy Link --}}

                <button
                    type="button"
                    @click="
                        navigator.clipboard.writeText('{{ url()->current() }}');
                        shareModal = false;
                        toastModal = true;
                        setTimeout(() => toastModal = false, 2000);
                    "
                    class="flex w-full items-center gap-3.5 border
                           border-slate-200 bg-slate-50 p-3.5 text-left
                           transition-all hover:bg-slate-100
                           active:scale-[0.98]
                           dark:border-slate-700 dark:bg-slate-800
                           dark:hover:bg-slate-700"
                >
                    <div
                        class="flex h-9 w-9 shrink-0 items-center justify-center
                               bg-sky-100 text-sky-600
                               dark:bg-sky-950/50 dark:text-sky-400"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                            />
                        </svg>
                    </div>

                    <span class="text-xs font-bold text-slate-700
                                 dark:text-slate-200">
                        1. Salin Link Properti
                    </span>

                </button>


                {{-- WhatsApp --}}

                <button
                    type="button"
                    @click="shareModal = false; waModal = true;"
                    class="flex w-full items-center gap-3.5 border
                           border-slate-200 bg-slate-50 p-3.5 text-left
                           transition-all hover:bg-slate-100
                           active:scale-[0.98]
                           dark:border-slate-700 dark:bg-slate-800
                           dark:hover:bg-slate-700"
                >
                    <div
                        class="flex h-9 w-9 shrink-0 items-center justify-center
                               bg-emerald-100 text-emerald-600
                               dark:bg-emerald-950/50 dark:text-emerald-400"
                    >
                        <x-icons.icons-chat class="h-4 w-4 fill-current" />
                    </div>

                    <span class="text-xs font-bold text-slate-700
                                 dark:text-slate-200">
                        2. Kirim ke WhatsApp Lain
                    </span>

                </button>

            </div>

        </div>

    </div>


    {{-- 4. WHATSAPP NUMBER MODAL --}}

    <div
        x-show="waModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
    >

        {{-- Backdrop --}}

        <div
            x-show="waModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="waModal = false"
            class="fixed inset-0 bg-slate-950/50 backdrop-blur-sm
                   dark:bg-black/60"
        ></div>


        {{-- Modal --}}

        <div
            x-show="waModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative z-10 w-full max-w-xs space-y-5 border
                   border-slate-200 bg-white p-6 shadow-2xl
                   dark:border-slate-700 dark:bg-slate-900
                   sm:max-w-sm"
        >

            <div
                class="flex items-center justify-between border-b
                       border-slate-200 pb-3 dark:border-slate-800"
            >
                <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                    Kirim via WhatsApp
                </h3>

                <button
                    type="button"
                    @click="waModal = false"
                    class="flex h-8 w-8 items-center justify-center
                           text-slate-400 transition hover:bg-slate-100
                           hover:text-slate-700
                           dark:hover:bg-slate-800
                           dark:hover:text-slate-200"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>


            <div class="space-y-4">

                <div>

                    <label
                        class="mb-1.5 block text-xs font-bold text-slate-700
                               dark:text-slate-300"
                    >
                        Nomor WhatsApp Tujuan:
                    </label>

                    <input
                        type="text"
                        x-model="shareTargetNumber"
                        placeholder="Contoh: 08123456789"
                        class="w-full border border-slate-200 bg-slate-50
                               px-4 py-3 text-xs text-slate-800 outline-none
                               transition-all placeholder:text-slate-400
                               focus:border-emerald-500 focus:bg-white
                               focus:ring-2 focus:ring-emerald-500/20
                               dark:border-slate-700 dark:bg-slate-800
                               dark:text-slate-100
                               dark:placeholder:text-slate-500
                               dark:focus:border-emerald-500
                               dark:focus:bg-slate-800"
                    />

                </div>


                @php
                    $shareText = rawurlencode(
                        "Lihat properti '{$estate->title}' di DownloadRumah ini: " . url()->current(),
                    );
                @endphp


                <button
                    type="button"
                    @click="
                        let num = shareTargetNumber.replace(/[^0-9]/g, '');

                        if (num.startsWith('0')) {
                            num = '62' + num.slice(1);
                        }

                        if (!num) {
                            alert('Masukkan nomor WA yang valid');
                            return;
                        }

                        window.open(
                            'https://wa.me/' + num + '?text={{ $shareText }}',
                            '_blank'
                        );

                        waModal = false;
                    "
                    class="flex h-11 w-full items-center justify-center gap-2
                           border border-emerald-600 bg-emerald-600 text-xs
                           font-bold text-white shadow-md
                           shadow-emerald-600/20 transition-all
                           hover:bg-emerald-700 active:scale-[0.98]
                           dark:border-emerald-500 dark:bg-emerald-600
                           dark:hover:bg-emerald-500"
                >
                    <span>
                        Kirim Sekarang
                    </span>
                </button>

            </div>

        </div>

    </div>


    {{-- 5. COPY LINK TOAST --}}

    <div
        x-show="toastModal"
        x-cloak
        class="pointer-events-none fixed inset-x-0 bottom-6 z-50
               flex items-center justify-center p-4"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
    >

        <div
            class="pointer-events-auto flex max-w-xs items-center gap-3
                   border border-slate-700 bg-slate-900 px-5 py-3.5
                   text-white shadow-2xl dark:border-slate-700
                   dark:bg-black"
        >
            <svg
                class="h-5 w-5 shrink-0 text-emerald-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
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

</div>
