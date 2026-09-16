@props(['estate', 'tab'])

<article
    class="space-y-3 rounded-md border border-slate-100 bg-white p-3 shadow-sm
           dark:border-slate-800 dark:bg-slate-900 dark:shadow-none"
>
    <div class="flex items-center gap-3">
        <div
            class="relative h-20 w-20 shrink-0 overflow-hidden rounded-md bg-slate-100
                   dark:bg-slate-800"
        >
            @if ($estate->primaryImage?->url)
                <img
                    src="{{ $estate->primaryImage->url }}"
                    class="h-full w-full object-cover"
                    alt="{{ $estate->title }}"
                >
            @else
                <div
                    class="flex h-full items-center justify-center text-[10px]
                           text-slate-400 dark:text-slate-500"
                >
                    No Image
                </div>
            @endif
        </div>

        <div class="min-w-0 flex-1">
            <div class="flex items-center gap-1.5">
                <h3 class="truncate text-xs font-bold text-slate-900 dark:text-slate-100">
                    {{ $estate->title }}
                </h3>

                @if ($tab === 'my_listings')
                    <span
                        class="rounded bg-slate-100 px-1.5 py-0.5 text-[9px] font-semibold
                               text-slate-600 dark:bg-slate-800 dark:text-slate-400"
                    >
                        {{ ucfirst($estate->publicity_status ?? 'draft') }}
                    </span>
                @endif
            </div>

            <p class="mt-0.5 text-xs font-black text-sky-600 dark:text-sky-400">
                {{ $estate->short_price }}
            </p>

            <p class="mt-0.5 truncate text-[10px] text-slate-400 dark:text-slate-500">
                {{ $estate->short_location_label }}
            </p>

            @if ($tab === 'co_broke' && $estate->commission_percentage)
                <span class="mt-1 inline-block text-[10px] font-semibold text-emerald-600 dark:text-emerald-400">
                    Komisi Agen: {{ $estate->commission_percentage }}%
                </span>
            @endif
        </div>
    </div>

    <div class="border-t border-slate-100 pt-2 dark:border-slate-800">
        @if ($tab === 'my_listings')
            <div class="grid grid-cols-2 gap-2">
                <a
                    href="{{ route('estates.edit', $estate->slug) }}"
                    class="rounded-md bg-sky-50 py-2 text-center text-xs font-bold
                           text-sky-600 transition hover:bg-sky-100
                           dark:bg-sky-950/40 dark:text-sky-400 dark:hover:bg-sky-950/60"
                >
                    Edit
                </a>

                <button
                    wire:click="deleteEstate({{ $estate->id }})"
                    class="rounded-md bg-red-50 py-2 text-xs font-bold text-red-600
                           transition hover:bg-red-100
                           dark:bg-red-950/40 dark:text-red-400 dark:hover:bg-red-950/60"
                >
                    Hapus
                </button>
            </div>
        @else
            <a
                href="{{ route('estates.show', $estate->slug) }}"
                class="block w-full rounded-md bg-emerald-50 py-2 text-center text-xs
                       font-bold text-emerald-600 transition hover:bg-emerald-100
                       dark:bg-emerald-950/40 dark:text-emerald-400
                       dark:hover:bg-emerald-950/60"
            >
                Hubungi Agen (Co-Broke)
            </a>
        @endif
    </div>
</article>
