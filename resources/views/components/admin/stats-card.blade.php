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
    class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:border-indigo-200 transition relative">
    <div>
        {{-- Header Section: Title & Interactive Help Tooltip --}}
        <div class="flex items-center justify-between mb-2 gap-1">
            <div class="flex items-center gap-1.5 min-w-0">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-slate-400 truncate">
                    {{ $title }}
                </span>

                @if ($tooltip)
                    <div x-data="{ open: false }" @click.outside="open = false"
                        class="relative inline-flex items-center shrink-0">
                        <button type="button" @mouseenter="open = true" @mouseleave="open = false"
                            @click.stop="open = !open"
                            class="w-4 h-4 rounded-full bg-slate-100 hover:bg-indigo-100 text-slate-400 hover:text-indigo-600 flex items-center justify-center text-[10px] font-bold cursor-pointer transition focus:outline-none">
                            ?
                        </button>

                        {{-- Floating Tooltip Box (Clean White Theme) --}}
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-1 scale-95" x-cloak
                            class="absolute left-0 bottom-full mb-2 w-48 sm:w-56 p-2.5 bg-white border border-slate-200 text-slate-700 text-[11px] font-medium leading-relaxed rounded-xl shadow-lg z-50">
                            {{ $tooltip }}
                            {{-- Panah (Arrow) --}}
                            <div
                                class="w-2.5 h-2.5 bg-white border-b border-r border-slate-200 rotate-45 absolute -bottom-1.5 left-2">
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Fallback Indicator --}}
                @if ($isFallback)
                    <span class="relative flex h-2 w-2 shrink-0" title="Nilai default (Backend belum mengirim data)">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                    </span>
                @endif
            </div>

            <div
                class="w-7 h-7 rounded-lg {{ $iconBg }} {{ $iconColor }} flex items-center justify-center shrink-0">
                {{ $slot }}
            </div>
        </div>

        {{-- Value Section --}}
        <div class="mt-1">
            <div class="flex items-baseline gap-1.5 flex-wrap">
                <h3
                    class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 tracking-tight truncate max-w-full">
                    {{ $displayValue }}
                </h3>
                @if ($badge)
                    <span
                        class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full shrink-0">
                        {{ $badge }}
                    </span>
                @endif
            </div>
            @if ($subtitle)
                <span class="text-[10px] text-slate-400 font-medium block mt-0.5 truncate">{{ $subtitle }}</span>
            @endif
        </div>
    </div>

    @if ($actionTarget && $actionLabel)
        <button wire:click="openCardDetail('{{ $actionTarget }}')"
            class="mt-3 pt-2 border-t border-slate-100 text-left text-[11px] font-bold text-indigo-600 flex items-center justify-between hover:underline">
            <span>{{ $actionLabel }}</span> <span>&rarr;</span>
        </button>
    @endif
</div>
