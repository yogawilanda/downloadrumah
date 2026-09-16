@props([
    'value' => 'Kembali',
])

<button
    type="button"
    {{ $attributes->class('mb-6 text-xs font-bold text-slate-400 hover:text-slate-950') }}
>
    ← {{ $value }}
</button>
