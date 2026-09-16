{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
0. author________________: yogawilanda <eaywilanda@gmail.com>
1. path__________________: resources/views/components/widgets/tabs/tab.blade.php
2. usage_________________: Application-wide UI / Design System
3. type__________________: Blade UI Component
4. expected_data_________: [active, action, label, value, class]
5. purpose_______________: Provide a generic selectable tab primitive.
6. ruling________________: Component must remain domain-agnostic and contain presentation only.
7. ruling_structure______: UI Primitive → Consumer
8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

@props([
    'active' => false,
    'action' => null,
    'label',
    'value' => null,
])

<button
    type="button"
    @if ($action)
        wire:click="{{ $action }}"
    @endif
    {{ $attributes->class([
        'relative px-5 py-5 text-left transition-all duration-150 sm:px-7 sm:py-6',
        'bg-white text-slate-950' => $active,
        'bg-slate-200/60 text-slate-500 hover:bg-slate-200' => !$active,
    ]) }}
>
    <span @class([
        'block text-[10px] font-black uppercase tracking-[0.16em]',
        'text-sky-600' => $active,
        'text-slate-400' => !$active,
    ])>
        {{ $label }}
    </span>

    @if ($value !== null)
        <span class="mt-1 block text-base font-black sm:text-lg">
            {{ $value }}
        </span>
    @endif

    @if ($active)
        <span class="absolute inset-x-0 bottom-0 h-1 bg-sky-500"></span>
    @endif
</button>

