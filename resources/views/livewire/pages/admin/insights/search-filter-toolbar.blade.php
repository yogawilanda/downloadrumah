{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/admin/insights/search-filter-toolbar.blade.php
    2. usage_________________: Admin Insights — Activity Stream Search Toolbar
    3. type__________________: Livewire Blade Partial
    4. expected_data_________: [search]
    5. purpose_______________: Display the live activity stream heading and telemetry search control.
    6. ruling________________: Search state is delegated to Livewire; this view only presents the control.
    7. ruling_structure______: Livewire Component → Search & Filter Toolbar
    8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div
    class="flex flex-col justify-between gap-3 border-b border-slate-100 pb-3
           dark:border-slate-800 sm:flex-row sm:items-center"
>
    {{-- Stream Identity --}}
    <div class="flex items-center gap-2">
        <div class="h-2.5 w-2.5 rounded-full bg-sky-600 dark:bg-sky-500"></div>

        <h2 class="text-sm font-bold text-slate-800 dark:text-slate-100">
            Stream Aktivitas Live
        </h2>
    </div>

    {{-- Search --}}
    <div class="relative w-full sm:w-72">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari IP, Event, Path URL..."
            class="w-full rounded-md border border-slate-200 bg-slate-50 py-2 pl-9 pr-3
                   text-xs text-slate-800 transition placeholder:text-slate-400
                   focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500
                   dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200
                   dark:placeholder:text-slate-500 dark:focus:bg-slate-900
                   dark:focus:ring-sky-500"
        >

        <svg
            class="absolute left-3 top-2.5 h-4 w-4 text-slate-400 dark:text-slate-500"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
            />
        </svg>
    </div>
</div>
