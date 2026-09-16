{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
0. author________________: yogawilanda <eaywilanda@gmail.com>
1. path__________________: resources/views/components/atoms/decorations/square-dots.blade.php
2. usage_________________: Application-wide UI / Design System
3. type__________________: Blade UI Component
4. expected_data_________: [class]
5. purpose_______________: Provide a reusable square decorative dot.
6. ruling________________: Presentation only; no domain-specific logic.
7. ruling_structure______: Atom → Consumer
8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

@props([
    'class' => 'h-1.5 w-1.5 bg-sky-500',
])

<span {{ $attributes->class($class) }}></span>
