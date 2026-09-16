{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
    0. author________________: yogawilanda <eaywilanda@gmail.com>
        1. path__________________: resources/views/components/atoms/labels/eyebrow.blade.php
        2. usage_________________: Application-wide UI / Design System
        3. type__________________: Blade UI Component
        4. expected_data_________: [value]
        5. purpose_______________: Provide a reusable small uppercase label.
        6. ruling________________: Presentation only; no domain-specific logic.
        7. ruling_structure______: Atom → Consumer
        8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

@props([
'value',
])

<span {{ $attributes->class('text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400') }}>
    {{ $value }}
</span>
