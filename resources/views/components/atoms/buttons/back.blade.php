@props([
    'value' => 'Kembali',
])

<button
    type="button"
    {{ $attributes->class(
        'mb-6 text-xs font-bold text-slate-400 transition hover:text-slate-950 dark:text-slate-500 dark:hover:text-slate-100'
    ) }}
>
    ← {{ $value }}
</button>
