<div class="block lg:hidden divide-y divide-slate-100">
    @forelse ($logs as $log)
        <div class="py-3 space-y-2">
            <div class="flex items-center justify-between text-xs">
                <div class="flex items-center gap-2 min-w-0">
                    <span
                        class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 font-bold text-[10px] flex items-center justify-center shrink-0">
                        {{ strtoupper(substr($log->user ? $log->user->name : 'G', 0, 1)) }}
                    </span>
                    <span
                        class="font-bold text-slate-800 truncate">{{ $log->user ? $log->user->name : 'Guest User' }}</span>
                </div>
                <span
                    class="text-[10px] font-mono text-slate-400 shrink-0 bg-slate-50 px-2 py-0.5 rounded-md border border-slate-100">{{ $log->created_at->format('d/m H:i:s') }}</span>
            </div>

            <div class="bg-slate-50/80 p-2.5 rounded-xl border border-slate-100 space-y-1.5">
                <div class="flex items-center justify-between">
                    <span
                        class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider bg-blue-100 text-blue-700">
                        {{ $log->event_name }}
                    </span>
                    @if (isset($log->payload['session_id']))
                        <button wire:click="inspectJourney('{{ $log->payload['session_id'] }}')"
                            class="px-2.5 py-1 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white rounded-lg text-[10px] font-bold shadow-sm transition">
                            Trace Journey
                        </button>
                    @endif
                </div>
                <p class="text-[11px] font-mono text-slate-700 break-all leading-relaxed">
                    {{ $log->payload['url'] ?? '-' }}
                </p>
            </div>

            <div class="flex items-center justify-between text-[10px] text-slate-400 px-1">
                <span class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-slate-600">{{ $log->ip_address }}</span>
                <span class="truncate max-w-[160px]">{{ $log->user_agent }}</span>
            </div>
        </div>
    @empty
        <div class="text-center py-8 text-xs text-slate-400">Belum ada data telemetry terekam.</div>
    @endforelse
</div>
