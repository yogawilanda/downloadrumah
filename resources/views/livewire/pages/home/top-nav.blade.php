{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/home/top-nav.blade.php
| @usage            : DownloadRumah Global Header — Brand Identity & Contextual Property Action
| @type             : Global Header Component
|
| @expected_data    : [auth()->user()]
| @expected_events  : [none]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Header remains visible because brand identity must stay discoverable.
| @ruling_ui        : Structural, quiet, and secondary to the bottom navigation.
| @ruling_navigation: Top navigation does not duplicate primary navigation destinations.
| @ruling_motion    : Snappy transitions only.
| @ruling_performance : No additional requests or unnecessary interactive state.
|
| @status           : Facelift — Structural Header
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">

    <div class="flex h-14 items-center justify-between">

        {{-- Brand --}}
        <a href="{{ route('home') }}" wire:navigate class="group ml-[6%] flex items-center gap-2">
            <span class="flex  h-7 w-7 items-center justify-center bg-white">
                <x-icons.header-logo class="h-4 w-4 text-sky-600" />
            </span>

            <div class="flex items-baseline tracking-tight">
                <span class="text-sm font-bold text-slate-900">
                    Download
                </span>
                <span class="text-sm font-bold text-sky-600">
                    Rumah
                </span>
            </div>
        </a>


        {{-- Contextual Actions --}}
        <div class="flex items-center gap-2">

            {{-- Add Property --}}
            <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" wire:navigate
                class="hidden items-center gap-2 border border-slate-300 bg-white px-3 py-2 text-xs font-bold text-slate-700 transition duration-150 hover:border-sky-400 hover:text-sky-600 md:flex">
                <x-icons.icons-adds class="h-3.5 w-3.5" />
                <span>Tambahkan Properti</span>
            </a>

            {{-- Notification --}}
            <button type="button" title="Notifikasi"
                class="relative flex h-8 w-8 items-center justify-center border border-slate-200 bg-white text-slate-500 transition duration-150 hover:border-slate-400 hover:text-slate-800">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>

                <span class="absolute right-1.5 top-1.5 h-1.5 w-1.5 bg-sky-500" aria-hidden="true"></span>
            </button>

        </div>

    </div>

</div>
