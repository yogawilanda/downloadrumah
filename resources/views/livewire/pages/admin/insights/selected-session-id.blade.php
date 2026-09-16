{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/admin/insights/selected-session-id.blade.php
    2. usage_________________: Admin Insights — User Journey Timeline Modal
    3. type__________________: Livewire Blade Partial
    4. expected_data_________: [selectedSessionId, journeyLogs]
    5. purpose_______________: Display the chronological telemetry events associated with a selected user session.
    6. ruling________________: Presentation only; session selection and modal actions are delegated to Livewire.
    7. ruling_structure______: Livewire Component → User Journey Timeline
    8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div
    class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6"
    x-data
>
    {{-- Backdrop --}}
    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
        wire:click="closeJourney"
    ></div>

    {{-- Modal --}}
    <div
        class="relative z-10 flex max-h-[85vh] w-full max-w-lg flex-col overflow-hidden
               rounded-2xl border border-slate-200 bg-white shadow-2xl
               dark:border-slate-700 dark:bg-slate-900"
    >
        {{-- Header --}}
        <div
            class="flex items-center justify-between border-b border-slate-100
                   bg-slate-50/80 p-4 dark:border-slate-800 dark:bg-slate-800/60"
        >
            <div>
                <h2 class="text-sm font-bold text-slate-800 dark:text-slate-100">
                    User Journey Timeline
                </h2>

                <p
                    class="max-w-[220px] truncate font-mono text-[10px] text-slate-500
                           dark:text-slate-400 sm:max-w-md"
                >
                    Sesi: {{ $selectedSessionId }}
                </p>
            </div>

            <button
                wire:click="closeJourney"
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

        {{-- Journey Timeline --}}
        <div class="flex-1 space-y-4 overflow-y-auto p-4">
            <div class="relative ml-3 space-y-4 border-l-2 border-sky-200 dark:border-sky-900/70">
                @forelse($journeyLogs as $step)
                    <div class="relative pl-5">
                        {{-- Timeline Marker --}}
                        <span
                            class="absolute -left-[9px] top-1 h-4 w-4 rounded-full
                                   bg-sky-600 ring-4 ring-white
                                   dark:bg-sky-500 dark:ring-slate-900"
                        ></span>

                        <div class="flex items-center justify-between gap-2">
                            <span
                                class="font-mono text-[10px] text-slate-400
                                       dark:text-slate-500"
                            >
                                {{ $step->created_at->format('H:i:s') }}
                            </span>

                            <span
                                class="rounded-md border border-sky-100 bg-sky-50 px-2
                                       py-0.5 text-[9px] font-bold uppercase
                                       text-sky-600 dark:border-sky-900/70
                                       dark:bg-sky-950/40 dark:text-sky-400"
                            >
                                {{ $step->event_name }}
                            </span>
                        </div>

                        <p
                            class="mt-1.5 break-all rounded-md border border-slate-200/80
                                   bg-slate-50 p-2.5 font-mono text-[11px] leading-relaxed
                                   text-slate-700 dark:border-slate-700
                                   dark:bg-slate-800/60 dark:text-slate-300"
                        >
                            {{ $step->payload['url'] ?? '-' }}
                        </p>
                    </div>
                @empty
                    <div
                        class="py-6 text-center text-xs text-slate-400
                               dark:text-slate-500"
                    >
                        Tidak ada riwayat aktivitas pada sesi ini.
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
                wire:click="closeJourney"
                class="rounded-md border border-slate-200 bg-white px-4 py-2
                       text-xs font-bold text-slate-700 shadow-sm transition
                       hover:bg-slate-100 active:scale-95
                       dark:border-slate-700 dark:bg-slate-900
                       dark:text-slate-200 dark:hover:bg-slate-800"
            >
                Tutup
            </button>
        </div>
    </div>
</div>
