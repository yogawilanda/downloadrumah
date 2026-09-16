{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
0. author________________: yogawilanda <eayogawilanda@gmail.com>
1. path__________________: resources/views/components/atoms/labels/section-label.blade.php
2. usage_________________: Application-wide UI / Design System
3. type__________________: Blade UI Component
4. expected_data_________: [value, class]
5. purpose_______________: Provide a reusable section label with decorative dot.
6. ruling________________: Presentation only; no domain-specific logic.
7. ruling_structure______: Atom → Consumer
8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

@props(['value'])

<div {{ $attributes->class('mb-4 flex items-center gap-2') }}>
    <x-atoms.decorations.square-dots />

    <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">
        {{ $value }}
    </span>
</div>
