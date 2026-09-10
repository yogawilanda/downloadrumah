{{-- resources/views/livewire/pages/admin/insights/details-card.blade.php --}}
{{-- Bottom Sheet / Modal 2: Card Breakdown Details --}}
@if ($activeCardDetail)
    <div class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4" x-data>
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" wire:click="closeCardDetail"></div>
        <div
            class="relative w-full sm:max-w-md bg-white rounded-t-3xl sm:rounded-2xl shadow-2xl border border-slate-100 flex flex-col max-h-[80vh] overflow-hidden z-10">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/80">
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Breakdown Detail Telemetry</h2>
                    <p class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mt-0.5">Kategori:
                        {{ $activeCardDetail }}</p>
                </div>
                <button wire:click="closeCardDetail"
                    class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:bg-slate-200/60 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-y-auto flex-1">
                <div class="divide-y divide-slate-100">
                    @forelse($cardDetailsData as $row)
                        <div class="py-2.5 flex items-center justify-between gap-3 text-xs">
                            <span class="font-mono text-slate-700 truncate max-w-[200px] sm:max-w-xs text-[11px]"
                                title="{{ $row->key_name }}">
                                {{ $row->key_name }}
                            </span>
                            <span
                                class="shrink-0 px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 font-bold font-mono text-[10px] whitespace-nowrap border border-blue-100">
                                {{ number_format($row->total) }} Hits
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-6 text-xs text-slate-400">Data breakdown tidak ditemukan.</div>
                    @endforelse
                </div>
            </div>
            <div class="p-3.5 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button wire:click="closeCardDetail"
                    class="w-full sm:w-auto px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-100 transition shadow-sm active:scale-95">Tutup</button>
            </div>
        </div>
    </div>
@endif
