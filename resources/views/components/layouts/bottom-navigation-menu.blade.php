{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/bottom-navigation-menu.blade.php
| @usage            : DownloadRumah Bottom Navigation — Secondary Menu & Application Information Sheet
| @type             : Global Alpine Navigation Sheet
|
| @expected_data    : [auth()->user()]
| @expected_events  : [openMenu, closeMenu]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Preserve existing navigation destinations and account logic.
| @ruling_ui        : Structural panel. Hard geometry. Thin borders. Restrained accents.
| @ruling_modal     : Centered sheet with dimmed backdrop and bounded scroll area.
| @ruling_motion    : Snappy entrance only. No continuous animation.
| @ruling_responsive: Mobile-first. Panel remains readable at all viewport sizes.
| @ruling_performance : CSS-only visual treatment; no additional requests.
|
| @status           : Facelift — Structural Navigation
| @author           : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div
    x-show="openMenu"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6"
    style="display: none;"
>

    {{-- =============================================================
         BACKDROP
         ============================================================= --}}
    <div
        x-show="openMenu"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        @click="openMenu = false"
        class="fixed inset-0 bg-slate-950/35"
        aria-hidden="true"
    ></div>


    {{-- =============================================================
         MENU PANEL
         ============================================================= --}}
    <div
        x-show="openMenu"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="relative z-10 max-h-[88vh] w-full max-w-2xl overflow-y-auto border border-slate-300 bg-white"
    >

        {{-- Structural top rail --}}
        <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-slate-100"></div>


        {{-- =========================================================
             HEADER
             ========================================================= --}}
        <div class="flex items-center justify-between border-b border-slate-300 px-5 py-4 sm:px-7">

            <div class="flex items-center gap-3">

                <span class="h-2 w-2 bg-sky-500"></span>

                <div>
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                        DownloadRumah
                    </p>

                    <h3 class="mt-0.5 text-sm font-bold text-slate-900 sm:text-base">
                        Menu & Informasi
                    </h3>
                </div>

            </div>

            <button
                type="button"
                @click="openMenu = false"
                class="flex h-8 w-8 items-center justify-center border border-slate-200 text-slate-400 transition duration-150 hover:border-slate-400 hover:text-slate-700 focus:outline-none"
                aria-label="Tutup menu"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>


        {{-- =========================================================
             ACCOUNT CONTEXT
             ========================================================= --}}
        @guest

            <div class="border-b border-slate-300 bg-slate-50 px-5 py-5 sm:px-7">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-sky-600">
                            Akun
                        </p>

                        <h4 class="mt-1 text-sm font-bold text-slate-900">
                            Masuk untuk mengelola properti.
                        </h4>

                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            Akses fitur pengelolaan properti dan akunmu dari satu tempat.
                        </p>
                    </div>

                    <a
                        href="{{ route('login') }}"
                        wire:navigate
                        @click="openMenu = false"
                        class="inline-flex shrink-0 items-center justify-center border border-slate-900 bg-slate-950 px-4 py-2.5 text-xs font-bold text-white transition duration-150 hover:border-sky-600 hover:bg-sky-600"
                    >
                        Masuk
                        <span class="ml-2">→</span>
                    </a>

                </div>

            </div>

        @else

            <div class="border-b border-slate-300 bg-slate-50 px-5 py-5 sm:px-7">

                <div class="flex items-center justify-between gap-4">

                    <div class="flex min-w-0 items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center border border-slate-300 bg-white text-sm font-bold text-slate-800">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">
                            <p class="truncate text-sm font-bold text-slate-900">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="truncate text-xs text-slate-500">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                        @csrf

                        <button
                            type="submit"
                            class="border border-slate-300 bg-white px-3 py-2 text-xs font-bold text-slate-500 transition duration-150 hover:border-rose-300 hover:text-rose-600"
                        >
                            Keluar
                        </button>
                    </form>

                </div>

            </div>

        @endguest


        {{-- =========================================================
             ACCOUNT NAVIGATION
             ========================================================= --}}
        @auth

            <div class="border-b border-slate-300 px-5 py-6 sm:px-7">

                <div class="mb-4 flex items-center gap-2">
                    <span class="h-px w-5 bg-sky-500"></span>

                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                        Navigasi Utama
                    </p>
                </div>

                <div class="grid gap-0 border-l border-t border-slate-300 sm:grid-cols-2">

                    {{-- Dashboard --}}
                    <a
                        href="{{ route('dashboard') }}"
                        wire:navigate
                        @click="openMenu = false"
                        class="group flex items-center justify-between border-b border-r border-slate-300 bg-white p-4 transition duration-150 hover:bg-slate-50"
                    >

                        <div>
                            <p class="text-xs font-bold text-slate-900 group-hover:text-sky-700">
                                Dashboard
                            </p>

                            <p class="mt-1 text-[11px] leading-5 text-slate-500">
                                Ringkasan properti & statistik
                            </p>
                        </div>

                        <span class="text-sm font-bold text-slate-300 transition group-hover:text-sky-500">
                            →
                        </span>

                    </a>


                    {{-- Profile --}}
                    <a
                        href="{{ route('profile') }}"
                        wire:navigate
                        @click="openMenu = false"
                        class="group flex items-center justify-between border-b border-r border-slate-300 bg-white p-4 transition duration-150 hover:bg-slate-50"
                    >

                        <div>
                            <p class="text-xs font-bold text-slate-900 group-hover:text-sky-700">
                                Pengaturan Akun
                            </p>

                            <p class="mt-1 text-[11px] leading-5 text-slate-500">
                                Ubah informasi pribadi
                            </p>
                        </div>

                        <span class="text-sm font-bold text-slate-300 transition group-hover:text-sky-500">
                            →
                        </span>

                    </a>


                    {{-- Digital Catalog --}}
                    @if (auth()->user()->username)

                        <a
                            href="{{ route('catalog.show', auth()->user()->username) }}"
                            target="_blank"
                            @click="openMenu = false"
                            class="group flex items-center justify-between border-b border-r border-slate-300 bg-slate-50 p-4 transition duration-150 hover:bg-white sm:col-span-2"
                        >

                            <div>
                                <div class="flex items-center gap-2">

                                    <p class="text-xs font-bold text-slate-900 group-hover:text-sky-700">
                                        Katalog Digital Saya
                                    </p>

                                    <span class="border border-sky-200 bg-sky-50 px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-sky-700">
                                        Publik
                                    </span>

                                </div>

                                <p class="mt-1 text-[11px] leading-5 text-slate-500">
                                    Etalase pribadi yang dapat dibagikan kepada calon pembeli.
                                </p>
                            </div>

                            <span class="text-sm font-bold text-slate-300 transition group-hover:text-sky-500">
                                ↗
                            </span>

                        </a>

                    @else

                        <a
                            href="{{ route('profile') }}"
                            wire:navigate
                            @click="openMenu = false"
                            class="group flex items-center justify-between border-b border-r border-slate-300 bg-slate-50 p-4 transition duration-150 hover:bg-white sm:col-span-2"
                        >

                            <div>
                                <p class="text-xs font-bold text-slate-900 group-hover:text-amber-600">
                                    Aktifkan Katalog Digital
                                </p>

                                <p class="mt-1 text-[11px] leading-5 text-slate-500">
                                    Atur username di profil untuk membuat etalase pribadi.
                                </p>
                            </div>

                            <span class="text-xs font-bold text-amber-600">
                                Atur →
                            </span>

                        </a>

                    @endif


                    {{-- Super Admin --}}
                    @if (auth()->user()->isSuperAdmin())

                        <a
                            href="{{ route('admin.insights.index') }}"
                            wire:navigate
                            @click="openMenu = false"
                            class="group flex items-center justify-between border-b border-r border-slate-300 bg-white p-4 transition duration-150 hover:bg-slate-50 sm:col-span-2"
                        >

                            <div class="flex items-center gap-2">

                                <p class="text-xs font-bold text-slate-900 group-hover:text-violet-700">
                                    Admin Dashboard
                                </p>

                                <span class="border border-violet-200 bg-violet-50 px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-violet-700">
                                    Admin
                                </span>

                            </div>

                            <span class="text-sm font-bold text-slate-300 transition group-hover:text-violet-500">
                                →
                            </span>

                        </a>

                    @endif

                </div>

            </div>

        @endauth


        {{-- =========================================================
             PWA INSTALL
             ========================================================= --}}
        <div
            x-show="$store.pwa && $store.pwa.canInstall"
            class="border-b border-slate-300 px-5 py-5 sm:px-7"
        >

            <button
                @click="$store.pwa.installApp(); openMenu = false"
                type="button"
                class="group flex w-full items-center justify-between border border-slate-300 bg-white p-4 text-left transition duration-150 hover:border-sky-300 hover:bg-slate-50"
            >

                <div>
                    <p class="text-xs font-bold text-slate-900 group-hover:text-sky-700">
                        Simpan Aplikasi di HP
                    </p>

                    <p class="mt-1 text-[11px] leading-5 text-slate-500">
                        Akses lebih cepat tanpa membuka browser.
                    </p>
                </div>

                <span class="text-[9px] font-bold uppercase tracking-[0.12em] text-sky-600">
                    Gratis
                </span>

            </button>

        </div>


        {{-- =========================================================
             APPLICATION INFORMATION
             ========================================================= --}}
        <div class="px-5 py-5 sm:px-7">

            <div class="mb-3 flex items-center gap-2">

                <span class="h-px w-5 bg-slate-300"></span>

                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                    Informasi Aplikasi
                </p>

            </div>

            <div class="grid border-l border-t border-slate-300 sm:grid-cols-2">

                <a
                    href="{{ route('privacy') }}"
                    wire:navigate
                    @click="openMenu = false"
                    class="flex items-center justify-between border-b border-r border-slate-300 px-4 py-3 text-xs font-semibold text-slate-600 transition duration-150 hover:bg-slate-50 hover:text-sky-700"
                >
                    <span>Kebijakan Privasi</span>
                    <span class="text-slate-300">→</span>
                </a>

                <a
                    href="{{ route('support') }}"
                    wire:navigate
                    @click="openMenu = false"
                    class="flex items-center justify-between border-b border-r border-slate-300 px-4 py-3 text-xs font-semibold text-slate-600 transition duration-150 hover:bg-slate-50 hover:text-sky-700"
                >
                    <span>Bantuan / Konsultasi</span>
                    <span class="text-slate-300">→</span>
                </a>

                <a
                    href="{{ route('terms') }}"
                    wire:navigate
                    @click="openMenu = false"
                    class="flex items-center justify-between border-b border-r border-slate-300 px-4 py-3 text-xs font-semibold text-slate-600 transition duration-150 hover:bg-slate-50 hover:text-sky-700"
                >
                    <span>Syarat & Ketentuan</span>
                    <span class="text-slate-300">→</span>
                </a>

                <a
                    href="{{ route('release-notes') }}"
                    wire:navigate
                    @click="openMenu = false"
                    class="flex items-center justify-between border-b border-r border-slate-300 px-4 py-3 text-xs font-semibold text-slate-600 transition duration-150 hover:bg-slate-50 hover:text-sky-700"
                >
                    <span>Release Notes</span>
                    <span class="text-[10px] font-bold text-slate-400">
                        v0.9.0-alpha
                    </span>
                </a>

            </div>

        </div>

    </div>

</div>
