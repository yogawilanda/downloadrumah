{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/agent-contact.blade.php
| @usage      : Display listing owner/agent contact actions
| @version    : 1.1.6
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@php
    $agentName = $estate->user->name ?? 'Agen';
    $waMessage = rawurlencode(
        "Halo {$agentName}, saya tertarik dengan properti '{$estate->title}' di DownloadRumah: " .
        url()->current(),
    );
    $waNumber = preg_replace('/[^0-9]/', '', $estate->user->phone_number ?? '6285158986696');
@endphp

<div class="space-y-4 rounded-md bg-slate-50/70 p-4 dark:bg-slate-900/70">
    <div class="flex items-center space-x-3">
        <div
            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full
                   bg-sky-600 text-sm font-bold text-white shadow-sm"
        >
            {{ substr($agentName, 0, 1) }}
        </div>

        <div class="min-w-0 flex-1">
            <p class="truncate text-xs font-bold text-slate-900 dark:text-slate-100">
                {{ $agentName }}
            </p>
            <p class="text-[11px] text-slate-500 dark:text-slate-400">
                {{ $estate->user->user_title ?? 'Pemilik Listing / Agen' }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2.5">
        <a
            href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}"
            target="_blank"
            class="flex h-11 items-center justify-center space-x-2 rounded-full
                   bg-emerald-600 text-xs font-semibold text-white
                   shadow-sm shadow-emerald-600/20 transition-all
                   hover:bg-emerald-700 active:scale-[0.98]"
        >
            <x-icons.icons-chat class="h-4 w-4 fill-current" />
            <span>Hubungi WA</span>
        </a>

        <button
            type="button"
            disabled
            class="flex h-11 cursor-not-allowed items-center justify-center space-x-1.5
                   rounded-full border border-slate-200 bg-slate-100 text-xs
                   font-semibold text-slate-400
                   dark:border-slate-700 dark:bg-slate-800 dark:text-slate-500"
        >
            <span>+ Co-Broker (Segera)</span>
        </button>
    </div>
</div>
