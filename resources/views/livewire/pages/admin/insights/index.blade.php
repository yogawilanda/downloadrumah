{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/admin/insights/index.blade.php
| @usage : Single Unified Dashboard for User Analytics, Telemetry Stream & Journey Trace
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="min-h-screen bg-slate-50/50 py-8 px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-200">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">User Insights & Telemetry</h1>
                <p class="text-xs text-slate-500 mt-1">Pantau performa trafik, perilaku pengunjung, dan log aktivitas
                    sistem secara real-time.</p>
            </div>
            <button wire:click="$refresh"
                class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Refresh Data</span>
            </button>
        </div>

        {{-- Analytics Cards (Grid 2-Kolom Mobile / 4-Kolom Desktop) --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div
                class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div class="space-y-1">
                    <p class="text-[11px] sm:text-xs font-medium text-slate-500">Total Hits</p>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900">{{ number_format($totalHits) }}</h3>
                    <span class="text-[10px] text-emerald-600 font-medium block">↑ Real-time</span>
                </div>
                <button wire:click="openCardDetail('events')"
                    class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-semibold text-blue-600 hover:text-blue-700 flex items-center justify-between">
                    <span>Buka Details</span> <span>&rarr;</span>
                </button>
            </div>

            <div
                class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div class="space-y-1">
                    <p class="text-[11px] sm:text-xs font-medium text-slate-500">Sesi Unik</p>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-blue-600">{{ number_format($uniqueSessions) }}
                    </h3>
                    <span class="text-[10px] text-slate-400 block">Unique Session</span>
                </div>
                <button wire:click="openCardDetail('sessions')"
                    class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-semibold text-blue-600 hover:text-blue-700 flex items-center justify-between">
                    <span>Buka Details</span> <span>&rarr;</span>
                </button>
            </div>

            <div
                class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div class="space-y-1">
                    <p class="text-[11px] sm:text-xs font-medium text-slate-500">Authenticated</p>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-indigo-600">
                        {{ number_format($authenticatedLogs) }}</h3>
                    <span class="text-[10px] text-indigo-500 font-medium block">{{ $guestLogs }} Guest</span>
                </div>
                <button wire:click="openCardDetail('users')"
                    class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-semibold text-blue-600 hover:text-blue-700 flex items-center justify-between">
                    <span>Buka Details</span> <span>&rarr;</span>
                </button>
            </div>

            <div
                class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div class="space-y-1">
                    <p class="text-[11px] sm:text-xs font-medium text-slate-500">Top Page</p>
                    <h3 class="text-sm sm:text-base font-bold text-slate-800 truncate">{{ $topPage }}</h3>
                    <span class="text-[10px] text-slate-400 block">Paling populer</span>
                </div>
                <button wire:click="openCardDetail('pages')"
                    class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-semibold text-blue-600 hover:text-blue-700 flex items-center justify-between">
                    <span>Buka Details</span> <span>&rarr;</span>
                </button>
            </div>
        </div>

        {{-- Section 2: Live Activity Logs Stream --}}
        <div class="bg-white rounded-xl border border-slate-200/80 shadow-sm overflow-hidden space-y-3 p-4 sm:p-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                <h2 class="text-sm font-bold text-slate-800">Stream Aktivitas Terbaru</h2>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari IP / Event / Path..."
                    class="w-full sm:w-64 px-3 py-1.5 bg-slate-50 border border-slate-300 rounded-lg text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- 1. Desktop View: Traditional Table --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50/50 text-slate-500 uppercase text-[10px]">
                            <th class="py-2.5 px-3">Waktu</th>
                            <th class="py-2.5 px-3">User</th>
                            <th class="py-2.5 px-3">Event / Path</th>
                            <th class="py-2.5 px-3">IP & Device</th>
                            <th class="py-2.5 px-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($logs as $log)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-2.5 px-3 whitespace-nowrap text-slate-400 text-[11px]">
                                    {{ $log->created_at->format('d/m H:i:s') }}</td>
                                <td class="py-2.5 px-3 whitespace-nowrap">
                                    @if ($log->user)
                                        <span class="font-semibold text-slate-800">{{ $log->user->name }}</span>
                                    @else
                                        <span
                                            class="px-1.5 py-0.5 rounded text-[10px] bg-slate-100 text-slate-500 border border-slate-200">Guest</span>
                                    @endif
                                </td>
                                <td class="py-2.5 px-3">
                                    <span class="font-semibold text-blue-600 mr-1">{{ $log->event_name }}</span>
                                    <span
                                        class="text-slate-500 font-mono text-[11px] truncate max-w-xs inline-block align-bottom">{{ $log->payload['url'] ?? '-' }}</span>
                                </td>
                                <td class="py-2.5 px-3 whitespace-nowrap text-slate-500 text-[11px]">
                                    <div>{{ $log->ip_address }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $log->user_agent }}</div>
                                </td>
                                <td class="py-2.5 px-3 text-right whitespace-nowrap">
                                    @if (isset($log->payload['session_id']))
                                        <button wire:click="inspectJourney('{{ $log->payload['session_id'] }}')"
                                            class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-[10px] font-bold hover:bg-blue-100 transition">
                                            Trace
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-slate-400">Belum ada telemetry.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 2. Mobile View: Flutter-like List Tile --}}
            <div class="block md:hidden divide-y divide-slate-100">
                @forelse ($logs as $log)
                    <div class="py-3 space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-800">{{ $log->user ? $log->user->name : 'Guest' }}</span>
                            <span
                                class="text-[10px] font-mono text-slate-400">{{ $log->created_at->format('d/m H:i:s') }}</span>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100 space-y-1">
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xs font-bold text-blue-600 uppercase tracking-wide">{{ $log->event_name }}</span>
                                @if (isset($log->payload['session_id']))
                                    <button wire:click="inspectJourney('{{ $log->payload['session_id'] }}')"
                                        class="px-2 py-0.5 bg-blue-600 text-white rounded text-[10px] font-semibold">
                                        Journey
                                    </button>
                                @endif
                            </div>
                            <p class="text-[11px] font-mono text-slate-600 break-all">{{ $log->payload['url'] ?? '-' }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between text-[10px] text-slate-400 pt-0.5">
                            <span class="font-mono">{{ $log->ip_address }}</span>
                            <span class="truncate max-w-[180px]">{{ $log->user_agent }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-xs text-slate-400">Belum ada telemetry.</div>
                @endforelse
            </div>

            <div class="pt-2">{{ $logs->links() }}</div>
        </div>

    </div>

    {{-- Center Modal 1: User Journey Timeline --}}
    @if ($selectedSessionId)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" x-data>
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" wire:click="closeJourney">
            </div>
            <div
                class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl border border-slate-200 flex flex-col max-h-[85vh] overflow-hidden z-10">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/80">
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">User Journey Timeline</h2>
                        <p class="text-[11px] font-mono text-slate-500 truncate max-w-[280px] sm:max-w-md">Sesi:
                            {{ $selectedSessionId }}</p>
                    </div>
                    <button wire:click="closeJourney"
                        class="p-1 rounded-lg text-slate-400 hover:text-slate-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-5 overflow-y-auto flex-1 space-y-4">
                    <div class="relative border-l-2 border-blue-200 ml-3 space-y-5">
                        @forelse($journeyLogs as $step)
                            <div class="relative pl-6">
                                <span
                                    class="absolute -left-[9px] top-0.5 w-4 h-4 rounded-full bg-blue-600 ring-4 ring-white"></span>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-[11px] font-mono text-slate-400">{{ $step->created_at->format('H:i:s') }}</span>
                                    <span
                                        class="text-[10px] font-bold uppercase px-1.5 py-0.5 bg-blue-50 text-blue-600 rounded">{{ $step->event_name }}</span>
                                </div>
                                <p
                                    class="text-xs font-mono text-slate-700 bg-slate-50 p-2.5 rounded-lg mt-1.5 border border-slate-200/80 break-all">
                                    {{ $step->payload['url'] ?? '-' }}
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-4 text-xs text-slate-400">Tidak ada riwayat aktivitas.</div>
                        @endforelse
                    </div>
                </div>
                <div class="p-3 bg-slate-50 border-t border-slate-100 flex justify-end">
                    <button wire:click="closeJourney"
                        class="px-4 py-1.5 bg-white border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-100 transition shadow-sm">Tutup</button>
                </div>
            </div>
        </div>
    @endif

    {{-- Center Modal 2: Card Breakdown Details --}}
    {{-- Center Modal / Mobile Bottom Sheet 2: Card Breakdown Details --}}
    @if ($activeCardDetail)
        <div class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4" x-data>
            {{-- Backdrop --}}
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                wire:click="closeCardDetail"></div>

            {{-- Modal Container (Bottom Sheet di HP, Floating Modal di Desktop) --}}
            <div
                class="relative w-full sm:max-w-lg bg-white rounded-t-2xl sm:rounded-2xl shadow-2xl border border-slate-200 flex flex-col max-h-[80vh] overflow-hidden z-10 animate-in slide-in-from-bottom duration-200">

                {{-- Header --}}
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/80">
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Detail Breakdown Telemetry</h2>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold mt-0.5">Kategori:
                            {{ $activeCardDetail }}</p>
                    </div>
                    <button wire:click="closeCardDetail"
                        class="p-1 rounded-lg text-slate-400 hover:text-slate-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Content List --}}
                <div class="p-4 sm:p-5 overflow-y-auto flex-1">
                    <div class="divide-y divide-slate-100">
                        @forelse($cardDetailsData as $row)
                            <div class="py-3 flex items-center justify-between gap-3 text-xs">
                                <span
                                    class="font-mono text-slate-700 truncate max-w-[200px] sm:max-w-xs text-[11px] sm:text-xs">
                                    {{ $row->key_name }}
                                </span>
                                <span
                                    class="shrink-0 px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 font-bold font-mono text-[10px] sm:text-[11px] whitespace-nowrap">
                                    {{ number_format($row->total) }} Hits
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-slate-400">Data breakdown tidak ditemukan.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Footer --}}
                <div class="p-3 bg-slate-50 border-t border-slate-100 flex justify-end">
                    <button wire:click="closeCardDetail"
                        class="w-full sm:w-auto px-4 py-2 bg-white border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-100 transition shadow-sm">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>
