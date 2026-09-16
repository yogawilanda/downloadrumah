{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/admin/insights/desktop-view-table-view.blade.php
    2. usage_________________: Admin Insights — Desktop Telemetry Log Table
    3. type__________________: Livewire Blade View
    4. expected_data_________: [logs]
    5. purpose_______________: Display telemetry logs in a desktop-optimized tabular view.
    6. ruling________________: Presentation only; telemetry inspection is delegated to Livewire actions.
    7. ruling_structure______: Livewire Component → Desktop Telemetry Table
    8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div class="hidden overflow-x-auto lg:block">
    <table class="w-full border-collapse text-left text-xs">
        <thead>
            <tr
                class="border-b border-slate-200 bg-slate-50/80 text-[10px] font-bold uppercase
                       tracking-wider text-slate-500 dark:border-slate-800 dark:bg-slate-900/80
                       dark:text-slate-400"
            >
                <th class="px-3 py-3">Waktu</th>
                <th class="px-3 py-3">Pengguna</th>
                <th class="px-3 py-3">Event & Path URL</th>
                <th class="px-3 py-3">IP & Perangkat</th>
                <th class="px-3 py-3 text-right">Tindakan</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-100 text-slate-700 dark:divide-slate-800 dark:text-slate-300">
            @forelse ($logs as $log)
                <tr class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/50">
                    <td class="whitespace-nowrap px-3 py-3 font-mono text-[11px] text-slate-400 dark:text-slate-500">
                        {{ $log->created_at->format('d/m H:i:s') }}
                    </td>

                    <td class="whitespace-nowrap px-3 py-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full
                                       bg-sky-100 text-[10px] font-bold text-sky-600
                                       dark:bg-sky-950/50 dark:text-sky-400"
                            >
                                {{ strtoupper(substr($log->user ? $log->user->name : 'G', 0, 1)) }}
                            </div>

                            <span class="font-bold text-slate-800 dark:text-slate-200">
                                {{ $log->user ? $log->user->name : 'Guest User' }}
                            </span>
                        </div>
                    </td>

                    <td class="px-3 py-3">
                        <div class="flex items-center gap-2">
                            <span
                                class="shrink-0 rounded-md border border-sky-100 bg-sky-50 px-2 py-0.5
                                       text-[10px] font-black uppercase tracking-wider text-sky-600
                                       dark:border-sky-900/70 dark:bg-sky-950/40 dark:text-sky-400"
                            >
                                {{ $log->event_name }}
                            </span>

                            <span
                                class="max-w-sm truncate font-mono text-[11px] text-slate-600
                                       dark:text-slate-400"
                                title="{{ $log->payload['url'] ?? '-' }}"
                            >
                                {{ $log->payload['url'] ?? '-' }}
                            </span>
                        </div>
                    </td>

                    <td class="whitespace-nowrap px-3 py-3 text-[11px] text-slate-500 dark:text-slate-400">
                        <div class="font-mono text-slate-700 dark:text-slate-300">
                            {{ $log->ip_address }}
                        </div>

                        <div class="max-w-xs truncate text-[10px] text-slate-400 dark:text-slate-500">
                            {{ $log->user_agent }}
                        </div>
                    </td>

                    <td class="whitespace-nowrap px-3 py-3 text-right">
                        @if (isset($log->payload['session_id']))
                            <button
                                wire:click="inspectJourney('{{ $log->payload['session_id'] }}')"
                                class="rounded-lg border border-sky-100 bg-sky-50 px-3 py-1
                                       text-[10px] font-bold text-sky-600 transition
                                       hover:bg-sky-600 hover:text-white active:scale-95
                                       dark:border-sky-900/70 dark:bg-sky-950/40
                                       dark:text-sky-400 dark:hover:bg-sky-600 dark:hover:text-white"
                            >
                                Trace Journey
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td
                        colspan="5"
                        class="py-8 text-center text-slate-400 dark:text-slate-500"
                    >
                        Belum ada data telemetry terekam.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
