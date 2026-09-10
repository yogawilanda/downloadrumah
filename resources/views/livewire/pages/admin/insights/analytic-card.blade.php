<div class="grid grid-cols-2 md:grid-cols-4 gap-2.5 sm:gap-4">
    {{-- Total Hits --}}
    <div
        class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:border-blue-200 transition">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-slate-400">Total Hits</span>
            <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
        </div>
        <div>
            <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ number_format($totalHits) }}
            </h3>
            <span class="text-[10px] text-emerald-600 font-bold block mt-0.5">↑ Live Request</span>
        </div>
        <button wire:click="openCardDetail('events')"
            class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-bold text-blue-600 flex items-center justify-between hover:underline">
            <span>Rincian Event</span> <span>&rarr;</span>
        </button>
    </div>

    {{-- Sesi Unik --}}
    <div
        class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:border-blue-200 transition">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-slate-400">Sesi Unik</span>
            <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>
        <div>
            <h3 class="text-xl sm:text-2xl font-black text-indigo-600 tracking-tight">
                {{ number_format($uniqueSessions) }}</h3>
            <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Active Session IDs</span>
        </div>
        <button wire:click="openCardDetail('sessions')"
            class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-bold text-blue-600 flex items-center justify-between hover:underline">
            <span>Daftar Sesi</span> <span>&rarr;</span>
        </button>
    </div>

    {{-- Authenticated Users --}}
    <div
        class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:border-blue-200 transition">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-slate-400">Logged In</span>
            <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
        </div>
        <div>
            <h3 class="text-xl sm:text-2xl font-black text-emerald-600 tracking-tight">
                {{ number_format($authenticatedLogs) }}</h3>
            <span class="text-[10px] text-slate-400 font-medium block mt-0.5 truncate">{{ number_format($guestLogs) }}
                Guest Requests</span>
        </div>
        <button wire:click="openCardDetail('users')"
            class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-bold text-blue-600 flex items-center justify-between hover:underline">
            <span>Top User Log</span> <span>&rarr;</span>
        </button>
    </div>

    {{-- Top Page --}}
    <div
        class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:border-blue-200 transition">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-slate-400">Top Page</span>
            <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
        </div>
        <div>
            <h3 class="text-xs sm:text-sm font-bold text-slate-800 truncate font-mono bg-slate-50 p-1.5 rounded-lg border border-slate-100"
                title="{{ $topPage }}">{{ $topPage }}</h3>
            <span class="text-[10px] text-slate-400 font-medium block mt-1">Halaman Paling Banyak Dilihat</span>
        </div>
        <button wire:click="openCardDetail('pages')"
            class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-bold text-blue-600 flex items-center justify-between hover:underline">
            <span>Populer URL</span> <span>&rarr;</span>
        </button>
    </div>
</div>
