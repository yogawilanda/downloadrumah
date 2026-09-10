<div class="hidden lg:block overflow-x-auto">
    <table class="w-full text-left border-collapse text-xs">
        <thead>
            <tr
                class="border-b border-slate-200 bg-slate-50/80 text-slate-500 font-bold uppercase text-[10px] tracking-wider">
                <th class="py-3 px-3">Waktu</th>
                <th class="py-3 px-3">Pengguna</th>
                <th class="py-3 px-3">Event & Path URL</th>
                <th class="py-3 px-3">IP & Perangkat</th>
                <th class="py-3 px-3 text-right">Tindakan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
            @forelse ($logs as $log)
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="py-3 px-3 whitespace-nowrap text-slate-400 font-mono text-[11px]">
                        {{ $log->created_at->format('d/m H:i:s') }}
                    </td>
                    <td class="py-3 px-3 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 font-bold text-[10px] flex items-center justify-center shrink-0">
                                {{ strtoupper(substr($log->user ? $log->user->name : 'G', 0, 1)) }}
                            </div>
                            <span
                                class="font-bold text-slate-800">{{ $log->user ? $log->user->name : 'Guest User' }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-3">
                        <div class="flex items-center gap-2">
                            <span
                                class="px-2 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider bg-blue-50 text-blue-600 border border-blue-100 shrink-0">
                                {{ $log->event_name }}
                            </span>
                            <span class="text-slate-600 font-mono text-[11px] truncate max-w-sm"
                                title="{{ $log->payload['url'] ?? '-' }}">
                                {{ $log->payload['url'] ?? '-' }}
                            </span>
                        </div>
                    </td>
                    <td class="py-3 px-3 whitespace-nowrap text-slate-500 text-[11px]">
                        <div class="font-mono text-slate-700">{{ $log->ip_address }}</div>
                        <div class="text-[10px] text-slate-400 truncate max-w-xs">{{ $log->user_agent }}</div>
                    </td>
                    <td class="py-3 px-3 text-right whitespace-nowrap">
                        @if (isset($log->payload['session_id']))
                            <button wire:click="inspectJourney('{{ $log->payload['session_id'] }}')"
                                class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-lg text-[10px] font-bold hover:bg-blue-600 hover:text-white transition active:scale-95">
                                Trace Journey
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-slate-400">Belum ada data telemetry
                        terekam.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
