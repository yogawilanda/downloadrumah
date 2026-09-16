{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/admin/insights/mobile-view-tile-view.blade.php
    2. usage_________________: Admin Insights — Mobile Telemetry Log Tile View
    3. type__________________: Livewire Blade Partial
    4. expected_data_________: [logs]
    5. purpose_______________: Display telemetry logs as compact mobile-friendly tiles.
    6. ruling________________: Presentation only; telemetry inspection is delegated to Livewire actions.
    7. ruling_structure______: Livewire Component → Mobile Telemetry Tile View
    8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div class="block divide-y divide-slate-100 dark:divide-slate-800 lg:hidden">
    @forelse ($logs as $log)
        <div class="space-y-2 py-3">
            {{-- User & Timestamp --}}
            <div class="flex items-center justify-between text-xs">
                <div class="flex min-w-0 items-center gap-2">
                    <span
                        class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full
                               bg-sky-100 text-[10px] font-bold text-sky-600
                               dark:bg-sky-950/50 dark:text-sky-400"
                    >
                        {{ strtoupper(substr($log->user ? $log->user->name : 'G', 0, 1)) }}
                    </span>

                    <span class="truncate font-bold text-slate-800 dark:text-slate-200">
                        {{ $log->user ? $log->user->name : 'Guest User' }}
                    </span>
                </div>

                <span
                    class="shrink-0 rounded-md border border-slate-100 bg-slate-50 px-2
                           py-0.5 font-mono text-[10px] text-slate-400
                           dark:border-slate-800 dark:bg-slate-800 dark:text-slate-500"
                >
                    {{ $log->created_at->format('d/m H:i:s') }}
                </span>
            </div>

            {{-- Event & URL --}}
            <div
                class="space-y-1.5 rounded-md border border-slate-100 bg-slate-50/80
                       p-2.5 dark:border-slate-800 dark:bg-slate-800/60"
            >
                <div class="flex items-center justify-between gap-2">
                    <span
                        class="rounded-md border border-sky-100 bg-sky-50 px-2 py-0.5
                               text-[9px] font-black uppercase tracking-wider text-sky-700
                               dark:border-sky-900/70 dark:bg-sky-950/40
                               dark:text-sky-400"
                    >
                        {{ $log->event_name }}
                    </span>

                    @if (isset($log->payload['session_id']))
                        <button
                            wire:click="inspectJourney('{{ $log->payload['session_id'] }}')"
                            class="rounded-lg bg-sky-600 px-2.5 py-1 text-[10px] font-bold
                                   text-white shadow-sm transition hover:bg-sky-700
                                   active:scale-95 dark:bg-sky-500 dark:hover:bg-sky-600"
                        >
                            Trace Journey
                        </button>
                    @endif
                </div>

                <p
                    class="break-all font-mono text-[11px] leading-relaxed
                           text-slate-700 dark:text-slate-300"
                >
                    {{ $log->payload['url'] ?? '-' }}
                </p>
            </div>

            {{-- Technical Metadata --}}
            <div
                class="flex items-center justify-between px-1 text-[10px]
                       text-slate-400 dark:text-slate-500"
            >
                <span
                    class="rounded bg-slate-100 px-1.5 py-0.5 font-mono text-slate-600
                           dark:bg-slate-800 dark:text-slate-400"
                >
                    {{ $log->ip_address }}
                </span>

                <span class="max-w-[160px] truncate">
                    {{ $log->user_agent }}
                </span>
            </div>
        </div>
    @empty
        <div
            class="py-8 text-center text-xs text-slate-400 dark:text-slate-500"
        >
            Belum ada data telemetry terekam.
        </div>
    @endforelse
</div>
