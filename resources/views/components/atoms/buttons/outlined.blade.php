{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eaywilanda@gmail.com>
    1. path__________________: resources/views/components/buttons/outlined.blade.php
    2. controller____________: Consumer Component
    3. view_dependency_______: DownloadRumah UI System
    4. usage_________________: DownloadRumah — Reusable Outline Button
    5. type__________________: Blade Component
    6. expected_data_________: [value, attributes]
    7. purpose_______________: Render a reusable outline-style button
    8. ruling________________: Button behavior is provided through attributes, visual defaults may be overridden by the consumer.
    9. ruling_structure______: Consumer → Outline Button
    10. status_______________: Active
</meta_config>

API Usage :
Default
<x-buttons.outlined
value="Dekat tempat kerja"
wire:click="selectPurpose('near_work')"
/>

Override
<x-buttons.outlined
    value="Dekat tempat kerja"
    class="w-auto"
    wire:click="selectPurpose('near_work')"
/>
------------------- For Blade With Params ------------------------}}

@props([
    'value',
])

<button
    type="button"
    {{ $attributes->class([
        'w-full border border-slate-300 bg-slate-50 px-4 py-4 text-left text-sm font-bold text-slate-700 transition',
        'hover:border-slate-950 hover:bg-white',
        'dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200',
        'dark:hover:border-sky-500 dark:hover:bg-slate-800 dark:hover:text-slate-100',
    ]) }}
>
    {{ $value }}

    <span class="float-right text-slate-400 dark:text-slate-500">
        →
    </span>
</button>
