{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/agent-owner-edit.blade.php
| @usage      : Owner listing status and edit action
| @version    : 1.4.0
| @ruling     : sharp architectural UI / responsive / dark mode
|--------------------------------------------------------------------------
--}}

@php
    $statusLabel = strtoupper($estate->publicity_status);

    $statusStyle = match ($estate->publicity_status) {
        'published' =>
            'border-slate-950 bg-slate-950 text-white dark:border-white dark:bg-white dark:text-slate-950',

        'archived' =>
            'border-red-600 text-red-600 dark:border-red-400 dark:text-red-400',

        default =>
            'border-slate-300 text-slate-600 dark:border-slate-700 dark:text-slate-300',
    };
@endphp

<div class="w-full">

    <div
        class="border border-slate-200 bg-white p-4
               dark:border-slate-800 dark:bg-slate-900 sm:p-5"
    >

        {{-- Owner Identity --}}
        <div class="flex items-center gap-3">

            <flux:avatar
                name="{{ auth()->user()->name }}"
                size="sm"
                class="shrink-0"
            />

            <div class="min-w-0">
                <p
                    class="truncate text-sm font-bold text-slate-950
                           dark:text-slate-100"
                >
                    {{ auth()->user()->name }}
                </p>

                <p
                    class="mt-0.5 text-[10px] font-semibold uppercase
                           tracking-[0.14em] text-slate-400
                           dark:text-slate-500"
                >
                    Owner
                </p>
            </div>

        </div>


        {{-- Listing Status --}}
        <div
            class="mt-5 border-t border-slate-200 pt-4
                   dark:border-slate-800"
        >
            <div class="flex items-center justify-between gap-3">

                <div class="min-w-0">
                    <span
                        class="block text-[9px] font-bold uppercase
                               tracking-[0.14em] text-slate-400
                               dark:text-slate-500"
                    >
                        Status Listing
                    </span>

                    <span
                        class="mt-1 block truncate text-[10px] font-medium
                               text-slate-500 dark:text-slate-400"
                    >
                        Listing milik Anda
                    </span>
                </div>

                <span
                    class="shrink-0 border px-2 py-1 text-[9px]
                           font-bold uppercase tracking-[0.12em]
                           {{ $statusStyle }}"
                >
                    {{ $statusLabel }}
                </span>

            </div>
        </div>


        {{-- Edit Action --}}
        <a
            href="{{ route('estates.edit', $estate->slug) }}"
            wire:navigate
            class="mt-4 flex w-full items-center justify-center gap-2
                   border border-slate-950 bg-slate-950 px-4 py-3
                   text-xs font-bold text-white transition
                   hover:bg-white hover:text-slate-950
                   active:scale-[0.99]
                   dark:border-white dark:bg-white dark:text-slate-950
                   dark:hover:bg-slate-900 dark:hover:text-white"
        >
            <svg
                class="h-3.5 w-3.5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="square"
                    stroke-linejoin="miter"
                    stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                />
            </svg>

            Edit Listing
        </a>

    </div>

</div>
