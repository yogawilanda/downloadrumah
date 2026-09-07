{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/admin/insights/index.blade.php
| @usage : Mobile-First Insights Dashboard with Adaptive Desktop Stretch
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="w-full min-h-screen bg-slate-50/50 p-3 sm:p-6 space-y-4 sm:space-y-6">
    <div class="w-full space-y-4 sm:space-y-6">

        {{-- Page Header (Mobile Compact / Desktop Flex) --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-200">
            <div>
                <h1 class="text-lg sm:text-2xl font-bold text-slate-900 tracking-tight">User Insights & Telemetry</h1>
                <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">Pantau trafik dan log aktivitas sistem secara
                    real-time.</p>
            </div>
            <button wire:click="$refresh"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Refresh</span>
            </button>
        </div>

        {{-- Analytics Cards: Kunci Maksimal 2 Kolom Agar Pas di Mobile Container --}}
        <div class="grid grid-cols-2 gap-2.5 sm:gap-3">
            {{-- Card 1: Total Hits --}}
            <div class="bg-white p-3 rounded-xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div class="space-y-0.5">
                    <p class="text-[10px] sm:text-xs font-medium text-slate-500">Total Hits</p>
                    <h3 class="text-lg sm:text-xl font-extrabold text-slate-900">{{ number_format($totalHits) }}</h3>
                    <span class="text-[9px] text-emerald-600 font-medium block">↑ Real-time</span>
                </div>
                <button wire:click="openCardDetail('events')"
                    class="mt-2 pt-1.5 border-t border-slate-100 text-left text-[10px] font-semibold text-blue-600 flex items-center justify-between">
                    <span>Details</span> <span>&rarr;</span>
                </button>
            </div>

            {{-- Card 2: Sesi Unik --}}
            <div class="bg-white p-3 rounded-xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div class="space-y-0.5">
                    <p class="text-[10px] sm:text-xs font-medium text-slate-500">Sesi Unik</p>
                    <h3 class="text-lg sm:text-xl font-extrabold text-blue-600">{{ number_format($uniqueSessions) }}
                    </h3>
                    <span class="text-[9px] text-slate-400 block">Session ID</span>
                </div>
                <button wire:click="openCardDetail('sessions')"
                    class="mt-2 pt-1.5 border-t border-slate-100 text-left text-[10px] font-semibold text-blue-600 flex items-center justify-between">
                    <span>Details</span> <span>&rarr;</span>
                </button>
            </div>

            {{-- Card 3: Authenticated --}}
            <div class="bg-white p-3 rounded-xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div class="space-y-0.5">
                    <p class="text-[10px] sm:text-xs font-medium text-slate-500 truncate">Authenticated</p>
                    <h3 class="text-lg sm:text-xl font-extrabold text-indigo-600">
                        {{ number_format($authenticatedLogs) }}</h3>
                    <span class="text-[9px] text-indigo-500 font-medium block truncate">{{ $guestLogs }} Guest</span>
                </div>
                <button wire:click="openCardDetail('users')"
                    class="mt-2 pt-1.5 border-t border-slate-100 text-left text-[10px] font-semibold text-blue-600 flex items-center justify-between">
                    <span>Details</span> <span>&rarr;</span>
                </button>
            </div>

            {{-- Card 4: Top Page --}}
            <div class="bg-white p-3 rounded-xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div class="space-y-0.5">
                    <p class="text-[10px] sm:text-xs font-medium text-slate-500">Top Page</p>
                    <h3 class="text-xs sm:text-sm font-bold text-slate-800 truncate">{{ $topPage }}</h3>
                    <span class="text-[9px] text-slate-400 block">Populer</span>
                </div>
                <button wire:click="openCardDetail('pages')"
                    class="mt-2 pt-1.5 border-t border-slate-100 text-left text-[10px] font-semibold text-blue-600 flex items-center justify-between">
                    <span>Details</span> <span>&rarr;</span>
                </button>
            </div>
        </div>

        {{-- Stream Activity Container --}}
        <div class="bg-white rounded-xl border border-slate-200/80 shadow-sm overflow-hidden p-3 sm:p-5 space-y-3">
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 pb-2.5 border-b border-slate-100">
                <h2 class="text-xs sm:text-sm font-bold text-slate-800">Stream Aktivitas</h2>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari IP / Event / Path..."
                    class="w-full sm:w-64 px-3 py-1 bg-slate-50 border border-slate-300 rounded-lg text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Mobile List Tile (Hanya Muncul di HP / Layar Sempit) --}}
            <div class="block lg:hidden divide-y divide-slate-100">
                @forelse ($logs as $log)
                    <div class="py-2.5 space-y-1.5">
                        <div class="flex items-center justify-between text-xs">
                            <span
                                class="font-bold text-slate-800 truncate max-w-[150px]">{{ $log->user ? $log->user->name : 'Guest' }}</span>
                            <span
                                class="text-[10px] font-mono text-slate-400 shrink-0">{{ $log->created_at->format('d/m H:i:s') }}</span>
                        </div>
                        <div class="bg-slate-50 p-2 rounded-lg border border-slate-100 space-y-1">
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-[11px] font-bold text-blue-600 uppercase">{{ $log->event_name }}</span>
                                @if (isset($log->payload['session_id']))
                                    <button wire:click="inspectJourney('{{ $log->payload['session_id'] }}')"
                                        class="px-2 py-0.5 bg-blue-600 text-white rounded text-[9px] font-semibold">
                                        Journey
                                    </button>
                                @endif
                            </div>
                            <p class="text-[10px] font-mono text-slate-600 break-all leading-tight">
                                {{ $log->payload['url'] ?? '-' }}</p>
                        </div>
                        <div class="flex items-center justify-between text-[9px] text-slate-400">
                            <span class="font-mono">{{ $log->ip_address }}</span>
                            <span class="truncate max-w-[140px]">{{ $log->user_agent }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-xs text-slate-400">Belum ada telemetry.</div>
                @endforelse
            </div>

            {{-- Desktop Table View (Muncul di Layar Lebar) --}}
            <div class="hidden lg:block overflow-x-auto">
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
                                <td class="py-2.5 px-3 whitespace-nowrap text-slate-400 font-mono text-[11px]">
                                    {{ $log->created_at->format('d/m H:i:s') }}</td>
                                <td class="py-2.5 px-3 whitespace-nowrap">
                                    <span
                                        class="font-semibold text-slate-800">{{ $log->user ? $log->user->name : 'Guest' }}</span>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span class="font-semibold text-blue-600 mr-1">{{ $log->event_name }}</span>
                                    <span
                                        class="text-slate-500 font-mono text-[11px] truncate max-w-xs inline-block align-bottom">{{ $log->payload['url'] ?? '-' }}</span>
                                </td>
                                <td class="py-2.5 px-3 whitespace-nowrap text-slate-500 text-[11px]">
                                    <div class="font-mono">{{ $log->ip_address }}</div>
                                    <div class="text-[10px] text-slate-400 truncate max-w-xs">{{ $log->user_agent }}
                                    </div>
                                </td>
                                <td class="py-2.5 px-3 text-right whitespace-nowrap">
                                    @if (isset($log->payload['session_id']))
                                        <button wire:click="inspectJourney('{{ $log->payload['session_id'] }}')"
                                            class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded text-[10px] font-bold hover:bg-blue-100 transition">
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

            <div class="pt-2">{{ $logs->links() }}</div>
        </div>

    </div>

    {{-- Center Modal 1: User Journey Timeline --}}
    @if ($selectedSessionId)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6" x-data>
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" wire:click="closeJourney">
            </div>
            <div
                class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-slate-200 flex flex-col max-h-[85vh] overflow-hidden z-10">
                <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/80">
                    <div>
                        <h2 class="text-xs sm:text-sm font-bold text-slate-800">User Journey Timeline</h2>
                        <p class="text-[10px] font-mono text-slate-500 truncate max-w-[220px] sm:max-w-md">Sesi:
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
                <div class="p-4 overflow-y-auto flex-1 space-y-4">
                    <div class="relative border-l-2 border-blue-200 ml-2.5 space-y-4">
                        @forelse($journeyLogs as $step)
                            <div class="relative pl-5">
                                <span
                                    class="absolute -left-[9px] top-0.5 w-4 h-4 rounded-full bg-blue-600 ring-4 ring-white"></span>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-[10px] font-mono text-slate-400">{{ $step->created_at->format('H:i:s') }}</span>
                                    <span
                                        class="text-[9px] font-bold uppercase px-1.5 py-0.5 bg-blue-50 text-blue-600 rounded">{{ $step->event_name }}</span>
                                </div>
                                <p
                                    class="text-[11px] font-mono text-slate-700 bg-slate-50 p-2 rounded mt-1 border border-slate-200/80 break-all">
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

    {{-- Bottom Sheet / Modal 2: Card Breakdown Details --}}
    @if ($activeCardDetail)
        <div class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4" x-data>
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                wire:click="closeCardDetail"></div>
            <div
                class="relative w-full sm:max-w-md bg-white rounded-t-2xl sm:rounded-2xl shadow-2xl border border-slate-200 flex flex-col max-h-[80vh] overflow-hidden z-10">
                <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/80">
                    <div>
                        <h2 class="text-xs sm:text-sm font-bold text-slate-800">Detail Breakdown Telemetry</h2>
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
                <div class="p-4 overflow-y-auto flex-1">
                    <div class="divide-y divide-slate-100">
                        @forelse($cardDetailsData as $row)
                            <div class="py-2.5 flex items-center justify-between gap-2 text-xs">
                                <span class="font-mono text-slate-700 truncate max-w-[180px] sm:max-w-xs text-[11px]">
                                    {{ $row->key_name }}
                                </span>
                                <span
                                    class="shrink-0 px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 font-bold font-mono text-[10px] whitespace-nowrap">
                                    {{ number_format($row->total) }} Hits
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-slate-400">Data breakdown tidak ditemukan.</div>
                        @endforelse
                    </div>
                </div>
                <div class="p-3 bg-slate-50 border-t border-slate-100 flex justify-end">
                    <button wire:click="closeCardDetail"
                        class="w-full sm:w-auto px-4 py-1.5 bg-white border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-100 transition shadow-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
