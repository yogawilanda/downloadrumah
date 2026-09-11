<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
    <div class="flex items-center gap-2">
        <div class="w-2.5 h-2.5 rounded-full bg-blue-600"></div>
        <h2 class="text-sm font-bold text-slate-800">Stream Aktivitas Live</h2>
    </div>
    <div class="relative w-full sm:w-72">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari IP, Event, Path URL..."
            class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-md text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
</div>
