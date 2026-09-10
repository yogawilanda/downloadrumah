<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200/80">
    <div>
        <div class="flex items-center gap-2">
            <h1 class="text-lg sm:text-2xl font-black text-slate-900 tracking-tight">User Insights & Telemetry</h1>
            <span
                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200/60">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live
            </span>
        </div>
        <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">Pantau trafik, sesi pengguna, dan log aktivitas
            sistem secara real-time.</p>
    </div>
    <button wire:click="$refresh"
        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50 active:scale-95 transition shadow-sm">
        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        <span>Refresh Telemetry</span>
    </button>
</div>
