{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/agent-owner-edit.blade.php
| @usage      : Owner listing status and edit action overlay
| @version    : 1.2.0
| @ruling     : sharp architectural UI / responsive / dark mode
|--------------------------------------------------------------------------
--}}

<div class="pointer-events-none z-40">
    <div class="pointer-events-auto mx-auto w-full max-w-md px-4">
        <div
            class="flex items-center justify-between gap-4 border border-slate-200
                   bg-white p-3
                   dark:border-slate-800 dark:bg-slate-900"
        >
            {{-- Status & Label Info --}}
            <div class="min-w-0">
                @php
                    $statusLabel = strtoupper($estate->publicity_status);

                    $statusStyle = match ($estate->publicity_status) {
                        'published' => 'border-slate-950 bg-slate-950 text-white dark:border-white dark:bg-white dark:text-slate-950',
                        'archived' => 'border-red-600 text-red-600 dark:border-red-400 dark:text-red-400',
                        default => 'border-slate-300 text-slate-600 dark:border-slate-700 dark:text-slate-300',
                    };
                @endphp

                <div class="flex items-center gap-2">
                    <span
                        class="border px-2 py-1 text-[10px] font-bold uppercase
                               tracking-[0.14em] {{ $statusStyle }}"
                    >
                        {{ $statusLabel }}
                    </span>

                    <span
                        class="text-[10px] font-semibold uppercase tracking-[0.12em]
                               text-slate-400 dark:text-slate-500"
                    >
                        Owner
                    </span>
                </div>

                <p class="mt-1 truncate text-xs font-medium text-slate-500 dark:text-slate-400">
                    Listing milik Anda
                </p>
            </div>

            {{-- Action Button Edit --}}
            <a
                href="{{ route('estates.edit', $estate->slug) }}"
                wire:navigate
                class="flex shrink-0 items-center gap-2 border border-slate-950
                       bg-slate-950 px-4 py-2.5 text-xs font-bold text-white
                       transition hover:bg-white hover:text-slate-950
                       dark:border-white dark:bg-white dark:text-slate-950
                       dark:hover:bg-slate-900 dark:hover:text-white"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="square"
                        stroke-linejoin="miter"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                    />
                </svg>
                <span>Edit Listing</span>
            </a>
        </div>
    </div>
</div>
