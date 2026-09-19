{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/agent-contact.blade.php
| @usage      : Display listing owner/agent contact actions
| @version    : 1.2.0
| @ruling     : sharp architectural UI / responsive / dark mode
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@php
    $agentName = $estate->user->name ?? 'Agen';
    $waMessage = rawurlencode(
        "Halo {$agentName}, saya tertarik dengan properti '{$estate->title}' di DownloadRumah: " .
        url()->current(),
    );
    $waNumber = preg_replace('/[^0-9]/', '', $estate->user->phone_number ?? '');
@endphp

<div class="w-full border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900 sm:p-5">

    {{-- Agent Identity --}}
    <div class="flex items-center gap-3">

        <flux:avatar
            name="{{ $agentName }}"
            size="sm"
            class="shrink-0"
        />

        <div class="min-w-0">
            <p
                class="truncate text-sm font-bold text-slate-950
                       dark:text-slate-100"
            >
                {{ $agentName }}
            </p>

            <p
                class="mt-0.5 truncate text-[10px] font-semibold uppercase
                       tracking-[0.14em] text-slate-400 dark:text-slate-500"
            >
                {{ $estate->user->user_title ?? 'Pemilik Listing / Agen' }}
            </p>
        </div>

    </div>


    {{-- Contact Actions --}}
    <div class="mt-5 border-t border-slate-200 pt-4 dark:border-slate-800">

        <a
            href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}"
            target="_blank"
            rel="noopener noreferrer"
            class="flex w-full items-center justify-center gap-2
                   border border-slate-950 bg-slate-950 px-4 py-3
                   text-xs font-bold text-white transition
                   hover:bg-white hover:text-slate-950
                   active:scale-[0.99]
                   dark:border-white dark:bg-white dark:text-slate-950
                   dark:hover:bg-slate-900 dark:hover:text-white"
        >
            <x-icons.icons-chat class="h-4 w-4 fill-current" />
            <span>Hubungi via WhatsApp</span>
        </a>


        <button
            type="button"
            disabled
            class="mt-2 flex w-full cursor-not-allowed items-center
                   justify-center border border-slate-200 bg-slate-50
                   px-4 py-2.5 text-[10px] font-bold uppercase
                   tracking-[0.1em] text-slate-400
                   dark:border-slate-800 dark:bg-slate-950
                   dark:text-slate-600"
        >
            + Co-Broker · Segera
        </button>

    </div>

</div>
