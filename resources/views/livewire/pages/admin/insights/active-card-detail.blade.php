{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/admin/insights/active-card-detail.blade.php
    2. usage_________________: Admin Insights — Active Card Detail Modal
    3. type__________________: Livewire Blade View
    4. expected_data_________: [activeCardDetail, cardDetailsData]
    5. purpose_______________: Display telemetry breakdown details for an active insight card.
    6. ruling________________: Presentation only; interaction is delegated to Livewire actions.
    7. ruling_structure______: Livewire Component → Active Card Detail View
    8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div
    class="fixed inset-0 z-50 flex items-end justify-center p-0 sm:items-center sm:p-4"
    x-data
>
    {{-- Backdrop --}}
    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
        wire:click="closeCardDetail"
    ></div>

    {{-- Modal --}}
    <div
        class="relative z-10 flex max-h-[80vh] w-full flex-col overflow-hidden
               rounded-t-3xl border border-slate-200 bg-white shadow-2xl
               dark:border-slate-700 dark:bg-slate-900
               sm:max-w-md sm:rounded-2xl"
    >
        {{-- Header --}}
        <div
            class="flex items-center justify-between border-b border-slate-100
                   bg-slate-50/80 p-4 dark:border-slate-800 dark:bg-slate-800/60"
        >
            <div>
                <h2 class="text-sm font-bold text-slate-800 dark:text-slate-100">
                    Breakdown Detail Telemetry
                </h2>

                <p
                    class="mt-0.5 text-[10px] font-bold uppercase tracking-wider
                           text-slate-500 dark:text-slate-400"
                >
                    Kategori: {{ $activeCardDetail }}
                </p>
            </div>

            <button
                wire:click="closeCardDetail"
                class="flex h-8 w-8 items-center justify-center rounded-full
                       text-slate-400 transition hover:bg-slate-200/60
                       hover:text-slate-700 dark:hover:bg-slate-700
                       dark:hover:text-slate-200"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.5"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>

        {{-- Data --}}
        <div class="flex-1 overflow-y-auto p-4">
            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($cardDetailsData as $row)
                    <div class="flex items-center justify-between gap-3 py-2.5 text-xs">
                        <span
                            class="max-w-[200px] truncate font-mono text-[11px] text-slate-700
                                   dark:text-slate-300 sm:max-w-xs"
                            title="{{ $row->key_name }}"
                        >
                            {{ $row->key_name }}
                        </span>

                        <span
                            class="shrink-0 whitespace-nowrap rounded-full border
                                   border-sky-100 bg-sky-50 px-2.5 py-1 font-mono
                                   text-[10px] font-bold text-sky-600
                                   dark:border-sky-900/70 dark:bg-sky-950/40
                                   dark:text-sky-400"
                        >
                            {{ number_format($row->total) }} Hits
                        </span>
                    </div>
                @empty
                    <div
                        class="py-6 text-center text-xs text-slate-400
                               dark:text-slate-500"
                    >
                        Data breakdown tidak ditemukan.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Footer --}}
        <div
            class="flex justify-end border-t border-slate-100 bg-slate-50 p-3.5
                   dark:border-slate-800 dark:bg-slate-800/60"
        >
            <button
                wire:click="closeCardDetail"
                class="w-full rounded-md border border-slate-200 bg-white px-4 py-2
                       text-xs font-bold text-slate-700 shadow-sm transition
                       hover:bg-slate-100 active:scale-95
                       dark:border-slate-700 dark:bg-slate-900
                       dark:text-slate-200 dark:hover:bg-slate-800
                       sm:w-auto"
            >
                Tutup
            </button>
        </div>
    </div>
</div>
