@php
    $agentName = $estate->user->name ?? 'Agen';
    $waMessage = rawurlencode("Halo {$agentName}, saya tertarik dengan properti '{$estate->title}' di DownloadRumah: " . url()->current());
    $waNumber = preg_replace('/[^0-9]/', '', $estate->user->phone_number ?? '6281259990179');
@endphp
<div class="p-4 border border-slate-200/60 rounded-3xl bg-slate-50/70 space-y-4">
    <div class="flex items-center space-x-3">
        <div class="w-11 h-11 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow-sm shrink-0">{{ substr($agentName, 0, 1) }}</div>
        <div class="flex-1 min-w-0"><p class="text-xs font-bold text-slate-900 truncate">{{ $agentName }}</p><p class="text-[11px] text-slate-500">{{ $estate->user->user_title ?? 'Pemilik Listing / Agen' }}</p></div>
    </div>
    <div class="grid grid-cols-2 gap-2.5">
        <a href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}" target="_blank" class="h-11 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white font-semibold rounded-full flex items-center justify-center space-x-2 shadow-sm shadow-emerald-600/20 transition-all text-xs"><x-icons.icons-chat class="w-4 h-4 fill-current" /><span>Hubungi WA</span></a>
        <button type="button" disabled class="h-11 bg-slate-100 text-slate-400 border border-slate-200 font-semibold rounded-full flex items-center justify-center space-x-1.5 text-xs cursor-not-allowed"><span>+ Co-Broker (Segera)</span></button>
    </div>
</div>
