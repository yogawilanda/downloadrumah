{{-- -------------------- Context & Meta Configuration ---------------------
| Created | Updated : 12/09/26, 20.28 | 12/09/26, 20.55
|--------------------------------------------------------------------------
| @path      : resources/views/components/admin/stats-card.blade.php
| @usage     : Responsive Cards component with Alpine.js interactive tooltip
| @techstack : Laravel 13, Livewire 4, Alpine.js
| @ruling    : max 100 lines  . Ask first before changing code.
| @author    : yogawilanda <eayogawilanda@gmail.com>
|----------------------------------------------------------------------- --}}

@props([
    'title' => 'Metrik Tambahan',
    'value' => null,
    'subtitle' => null,
    'badge' => null,
    'tooltip' => null,
    'iconBg' => 'bg-indigo-50',
    'iconColor' => 'text-indigo-600',
    'actionTarget' => null,
    'actionLabel' => null,
])

@php
    $isFallback = is_null($value) || $value === '';
    $displayValue = $isFallback ? '0' : $value;
@endphp

<div
    class="relative flex flex-col justify-between rounded-2xl border border-slate-200/80
           bg-white p-3.5 shadow-sm transition hover:border-sky-200
           dark:border-slate-700/80 dark:bg-slate-900 dark:hover:border-sky-800"
>
    <div>
        {{-- Header Section: Title & Interactive Help Tooltip --}}
        <div class="mb-2 flex items-center justify-between gap-1">
            <div class="flex min-w-0 items-center gap-1.5">

                <span
                    class="truncate text-[10px] font-bold uppercase tracking-wider
                           text-slate-400 dark:text-slate-500 sm:text-xs"
                >
                    {{ $title }}
                </span>

                @if ($tooltip)
                    <div
                        x-data="{ open: false }"
                        @click.outside="open = false"
                        class="relative inline-flex shrink-0 items-center"
                    >
                        <button
                            type="button"
                            @mouseenter="open = true"
                            @mouseleave="open = false"
                            @click.stop="open = !open"
                            class="flex h-4 w-4 cursor-pointer items-center justify-center
                                   rounded-full bg-slate-100 text-[10px] font-bold
                                   text-slate-400 transition focus:outline-none
                                   hover:bg-sky-100 hover:text-sky-600
                                   dark:bg-slate-800 dark:text-slate-500
                                   dark:hover:bg-sky-950/60 dark:hover:text-sky-400"
                        >
                            ?
                        </button>

                        {{-- Floating Tooltip --}}
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                            x-cloak
                            class="absolute bottom-full left-0 z-50 mb-2 w-48 rounded-xl
                                   border border-slate-200 bg-white p-2.5 text-[11px]
                                   font-medium leading-relaxed text-slate-700 shadow-lg
                                   dark:border-slate-700 dark:bg-slate-800
                                   dark:text-slate-300 sm:w-56"
                        >
                            {{ $tooltip }}

                            {{-- Arrow --}}
                            <div
                                class="absolute -bottom-1.5 left-2 h-2.5 w-2.5 rotate-45
                                       border-b border-r border-slate-200 bg-white
                                       dark:border-slate-700 dark:bg-slate-800"
                            ></div>
                        </div>
                    </div>
                @endif

                {{-- Fallback Indicator --}}
                @if ($isFallback)
                    <span
                        class="relative flex h-2 w-2 shrink-0"
                        title="Nilai default (Backend belum mengirim data)"
                    >
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full
                                   bg-rose-400 opacity-75"
                        ></span>

                        <span
                            class="relative inline-flex h-2 w-2 rounded-full bg-rose-500"
                        ></span>
                    </span>
                @endif

            </div>

            <div
                class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg
                       {{ $iconBg }} {{ $iconColor }}"
            >
                {{ $slot }}
            </div>
        </div>

        {{-- Value Section --}}
        <div class="mt-1">
            <div class="flex flex-wrap items-baseline gap-1.5">

                <h3
                    class="max-w-full truncate text-xl font-black tracking-tight
                           text-slate-900 dark:text-slate-100 sm:text-2xl lg:text-3xl"
                >
                    {{ $displayValue }}
                </h3>

                @if ($badge)
                    <span
                        class="shrink-0 rounded-full bg-emerald-50 px-2 py-0.5
                               text-[10px] font-bold text-emerald-600
                               dark:bg-emerald-950/50 dark:text-emerald-400"
                    >
                        {{ $badge }}
                    </span>
                @endif

            </div>

            @if ($subtitle)
                <span
                    class="mt-0.5 block truncate text-[10px] font-medium
                           text-slate-400 dark:text-slate-500"
                >
                    {{ $subtitle }}
                </span>
            @endif
        </div>
    </div>

    @if ($actionTarget && $actionLabel)
        <button
            wire:click="openCardDetail('{{ $actionTarget }}')"
            class="mt-3 flex items-center justify-between border-t border-slate-100
                   pt-2 text-left text-[11px] font-bold text-sky-600 hover:underline
                   dark:border-slate-800 dark:text-sky-400"
        >
            <span>{{ $actionLabel }}</span>
            <span>&rarr;</span>
        </button>
    @endif
</div>
