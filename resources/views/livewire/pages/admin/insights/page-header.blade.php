{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/admin/insights/page-header.blade.php
    2. usage_________________: Admin Insights — Page Header & Telemetry Refresh Control
    3. type__________________: Livewire Blade Partial
    4. expected_data_________: []
    5. purpose_______________: Render the analytics page heading, live status indicator, and telemetry refresh action.
    6. ruling________________: Presentation and Livewire refresh action only.
    7. ruling_structure______: Livewire Component → Page Header
    8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div
    class="flex flex-col justify-between gap-3 border-b border-slate-200/80 pb-4
           dark:border-slate-800 sm:flex-row sm:items-center"
>
    {{-- Page Identity --}}
    <div>
        <div class="flex items-center gap-2">
            <h1
                class="text-lg font-black tracking-tight text-slate-900
                       dark:text-slate-100 sm:text-2xl"
            >
                User Insights & Telemetry
            </h1>

            <span
                class="inline-flex items-center gap-1 rounded-full border border-emerald-200/60
                       bg-emerald-50 px-2 py-0.5 text-[10px] font-bold text-emerald-700
                       dark:border-emerald-900/70 dark:bg-emerald-950/40
                       dark:text-emerald-400"
            >
                <span
                    class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-500"
                ></span>
                Live
            </span>
        </div>

        <p
            class="mt-0.5 text-[11px] text-slate-500 dark:text-slate-400 sm:text-xs"
        >
            Pantau trafik, sesi pengguna, dan log aktivitas sistem secara real-time.
        </p>
    </div>

    {{-- Refresh --}}
    <button
        wire:click="$refresh"
        class="inline-flex w-full items-center justify-center gap-2 rounded-md border
               border-slate-200 bg-white px-3.5 py-2 text-xs font-bold text-slate-700
               shadow-sm transition hover:bg-slate-50 active:scale-95
               dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200
               dark:hover:bg-slate-800 sm:w-auto"
    >
        <svg
            class="h-4 w-4 text-slate-500 dark:text-slate-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
            />
        </svg>

        <span>Refresh Telemetry</span>
    </button>
</div>
