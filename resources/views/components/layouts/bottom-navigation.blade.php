{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/bottom-navigation.blade.php
| @usage            : DownloadRumah Global Bottom Navigation & Primary Mobile Navigation
| @type             : Global Navigation Component
|
| @expected_data    : [auth()->user(), current route state]
| @expected_events  : [livewire:navigated]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Navigation remains fixed and globally available.
| @ruling_ui        : Structural geometry. Hard edges. Restrained shadow. Sky accent.
| @ruling_motion    : Snappy transitions only. No continuous animation.
| @ruling_responsive: Navigation remains usable across mobile, tablet, and desktop.
| @ruling_performance : No additional requests or decorative JS.
|
| @status           : Facelift — Structural Navigation
| @author           : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div x-data="{
    openMenu: false,

    activeTab: '{{ request()->routeIs('home')
        ? 'home'
        : (request()->routeIs('mortgage.*')
            ? 'kpr'
            : (request()->routeIs('listings.*')
                ? 'listings'
                : 'menu')) }}',

    setTab(tab) {
        this.activeTab = tab;
    },

    confirmNavigation(event) {
        if (
            window.estateFormDirty &&
            event.target.closest('a') &&
            !confirm('Isian belum disimpan. Keluar dari form?')
        ) {
            event.preventDefault();
        }
    }
}" x-on:livewire:navigated.window="window.estateFormDirty = false"
    @click.capture="confirmNavigation($event)">

    {{-- =============================================================
         NAVIGATION FRAME
         ============================================================= --}}
    <div class="fixed inset-x-0 bottom-0 z-40 border-t border-slate-300 bg-white">

        {{-- Structural rail --}}
        <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-slate-100"></div>

        <div class="mx-auto flex h-16 max-w-6xl items-center px-3 sm:px-6 lg:px-8">

            {{-- =====================================================
                 01. HOME
                 ===================================================== --}}
            <a href="{{ route('home') }}" wire:navigate @click="setTab('home')"
                :class="activeTab === 'home'
                    ?
                    'text-sky-600' :
                    'text-slate-400 hover:text-slate-700'"
                class="group relative flex h-full flex-1 flex-col items-center justify-center gap-1 transition-colors duration-150">

                <span :class="activeTab === 'home' ? 'bg-sky-500' : 'bg-transparent'"
                    class="absolute inset-x-5 top-0 h-0.5 transition-colors duration-150"></span>

                <x-icons.icons-home class="h-5 w-5 shrink-0" />

                <span class="text-[10px] font-semibold tracking-tight sm:text-[11px]">
                    Beranda
                </span>

            </a>


            {{-- =====================================================
                 02. KPR
                 ===================================================== --}}
            <a href="{{ route('mortgage.calculator') }}" wire:navigate @click="setTab('kpr')"
                :class="activeTab === 'kpr'
                    ?
                    'text-sky-600' :
                    'text-slate-400 hover:text-slate-700'"
                class="group relative flex h-full flex-1 flex-col items-center justify-center gap-1 transition-colors duration-150">

                <span :class="activeTab === 'kpr' ? 'bg-sky-500' : 'bg-transparent'"
                    class="absolute inset-x-5 top-0 h-0.5 transition-colors duration-150"></span>

                <x-icons.icons-calculator class="h-5 w-5 shrink-0" />

                <span class="text-[10px] font-semibold tracking-tight sm:text-[11px]">
                    KPR
                </span>

            </a>


            {{-- =====================================================
                 03. PRIMARY ACTION
                 ===================================================== --}}
            <div class="flex h-full flex-1 items-center justify-center px-2">

                <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" wire:navigate
                    title="Tambahkan properti"
                    class="group relative flex h-11 w-11 items-center justify-center border border-slate-900 bg-slate-950 text-white transition duration-150 hover:bg-sky-600 hover:border-sky-600 active:translate-y-px sm:h-12 sm:w-12">

                    <span class="absolute -right-1 -top-1 h-2 w-2 border border-white bg-sky-500"
                        aria-hidden="true"></span>

                    <x-icons.icons-adds class="h-5 w-5 sm:h-6 sm:w-6" />

                </a>

            </div>


            {{-- =====================================================
                 04. LISTINGS
                 ===================================================== --}}
            <a href="{{ route('listings.index') }}" wire:navigate @click="setTab('listings')"
                :class="activeTab === 'listings'
                    ?
                    'text-sky-600' :
                    'text-slate-400 hover:text-slate-700'"
                class="group relative flex h-full flex-1 flex-col items-center justify-center gap-1 transition-colors duration-150">

                <span :class="activeTab === 'listings' ? 'bg-sky-500' : 'bg-transparent'"
                    class="absolute inset-x-5 top-0 h-0.5 transition-colors duration-150"></span>

                <x-icons.icons-listings class="h-5 w-5 shrink-0" />

                <span class="text-[10px] font-semibold tracking-tight sm:text-[11px]">
                    Cari
                </span>

            </a>


            {{-- =====================================================
                 05. MENU
                 ===================================================== --}}
            <button type="button" @click="openMenu = true; setTab('menu')"
                :class="activeTab === 'menu'
                    ?
                    'text-sky-600' :
                    'text-slate-400 hover:text-slate-700'"
                class="group relative flex h-full flex-1 flex-col items-center justify-center gap-1 transition-colors duration-150 focus:outline-none">

                <span :class="activeTab === 'menu' ? 'bg-sky-500' : 'bg-transparent'"
                    class="absolute inset-x-5 top-0 h-0.5 transition-colors duration-150"></span>

                <x-icons.icons-menus class="h-5 w-5 shrink-0" />

                <span class="text-[10px] font-semibold tracking-tight sm:text-[11px]">
                    Menu
                </span>

            </button>

        </div>

    </div>


    {{-- =============================================================
         MENU SHEET
         ============================================================= --}}
    <x-layouts.bottom-navigation-menu />

</div>
