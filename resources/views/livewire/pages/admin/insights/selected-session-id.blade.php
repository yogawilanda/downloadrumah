{{-- resources/views/livewire/pages/admin/insights/selected-session-id.blade.php --}}
<div class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6" x-data>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" wire:click="closeJourney">
    </div>
    <div
        class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-slate-100 flex flex-col max-h-[85vh] overflow-hidden z-10">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/80">
            <div>
                <h2 class="text-sm font-bold text-slate-800">User Journey Timeline</h2>
                <p class="text-[10px] font-mono text-slate-500 truncate max-w-[220px] sm:max-w-md">Sesi:
                    {{ $selectedSessionId }}</p>
            </div>
            <button wire:click="closeJourney"
                class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:bg-slate-200/60 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-4 overflow-y-auto flex-1 space-y-4">
            <div class="relative border-l-2 border-blue-200 ml-3 space-y-4">
                @forelse($journeyLogs as $step)
                    <div class="relative pl-5">
                        <span
                            class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-blue-600 ring-4 ring-white"></span>
                        <div class="flex items-center justify-between gap-2">
                            <span
                                class="text-[10px] font-mono text-slate-400">{{ $step->created_at->format('H:i:s') }}</span>
                            <span
                                class="text-[9px] font-bold uppercase px-2 py-0.5 bg-blue-50 text-blue-600 rounded-md border border-blue-100">{{ $step->event_name }}</span>
                        </div>
                        <p
                            class="text-[11px] font-mono text-slate-700 bg-slate-50 p-2.5 rounded-xl mt-1.5 border border-slate-200/80 break-all leading-relaxed">
                            {{ $step->payload['url'] ?? '-' }}
                        </p>
                    </div>
                @empty
                    <div class="text-center py-6 text-xs text-slate-400">Tidak ada riwayat aktivitas pada sesi
                        ini.</div>
                @endforelse
            </div>
        </div>
        <div class="p-3.5 bg-slate-50 border-t border-slate-100 flex justify-end">
            <button wire:click="closeJourney"
                class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-100 transition shadow-sm active:scale-95">Tutup</button>
        </div>
    </div>
</div>
