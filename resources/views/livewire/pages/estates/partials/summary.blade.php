{{-- resources/views/livewire/pages/estates/partials/summary.blade.php --}}

<div class="space-y-6">

    {{-- Listing Header --}}
    <div class="space-y-4 border-b border-slate-200 pb-5 dark:border-slate-800">
        <div class="flex items-center justify-between gap-3">
            <div class="flex min-w-0 items-center gap-2">
                <span
                    class="shrink-0 bg-slate-950 px-2 py-1 text-[9px]
                           font-bold uppercase tracking-[0.12em] text-white
                           dark:bg-white dark:text-slate-950"
                >
                    {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
                </span>

                <span
                    class="text-[9px] font-bold uppercase tracking-[0.12em]
                           text-slate-400 dark:text-slate-500"
                >
                    PROPERTY
                </span>
            </div>

            <a
                href="{{ $this->kprUrl }}"
                wire:navigate
                class="inline-flex shrink-0 items-center gap-2 border border-slate-200
                       px-3 py-2 text-[10px] font-bold uppercase tracking-wider
                       text-slate-700 transition-colors hover:bg-slate-950
                       hover:text-white dark:border-slate-700 dark:text-slate-300
                       dark:hover:bg-white dark:hover:text-slate-950"
            >
                <svg
                    class="h-3.5 w-3.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="square"
                        stroke-linejoin="miter"
                        stroke-width="2"
                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                    />
                </svg>

                KPR
            </a>
        </div>

        <div>
            <h1
                class="text-2xl font-black leading-none tracking-tight
                       text-slate-950 dark:text-white sm:text-3xl"
            >
                {{ $estate->formatted_price }}
            </h1>

            <h2
                class="mt-2 text-base font-bold leading-snug
                       text-slate-900 dark:text-white sm:text-lg"
            >
                {{ $estate->title }}
            </h2>

            <p
                class="mt-2 flex items-start gap-2 text-xs text-slate-500
                       dark:text-slate-400 sm:text-sm"
            >
                <svg
                    class="mt-0.5 h-4 w-4 shrink-0 text-slate-950 dark:text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="square"
                        stroke-linejoin="miter"
                        stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                    />
                    <path
                        stroke-linecap="square"
                        stroke-linejoin="miter"
                        stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                </svg>

                <span>
                    {{ $estate->address ?? implode(', ', array_filter([
                        $estate->city?->name,
                        $estate->district,
                    ])) }}
                </span>
            </p>
        </div>
    </div>

    {{-- Core Specifications --}}
    <div class="grid grid-cols-4 border border-slate-200 dark:border-slate-800">
        @foreach ([
            ['Kamar', $estate->bedroom, 'KT'],
            ['Mandi', $estate->bathroom, 'KM'],
            ['Luas Bgn', $estate->building_size, 'm²'],
            ['Luas Tnh', $estate->land_size, 'm²'],
        ] as $index => [$label, $value, $unit])
            <div
                class="bg-white p-3 text-center dark:bg-slate-900
                       {{ $index > 0 ? 'border-l border-slate-200 dark:border-slate-800' : '' }}"
            >
                <span
                    class="block text-[9px] font-bold uppercase tracking-wider
                           text-slate-400 dark:text-slate-500"
                >
                    {{ $label }}
                </span>

                <span
                    class="mt-1 block text-xs font-bold text-slate-900
                           dark:text-white sm:text-sm"
                >
                    {{ $value ?? '-' }} {{ $unit }}
                </span>
            </div>
        @endforeach
    </div>

    {{-- Description --}}
    <section class="pt-1">
        <div class="mb-2 flex items-center gap-3">
            <span
                class="flex h-5 w-5 items-center justify-center bg-slate-950
                       text-[9px] font-bold text-white dark:bg-white
                       dark:text-slate-950"
            >
                01
            </span>

            <h3
                class="text-[10px] font-bold uppercase tracking-[0.14em]
                       text-slate-900 dark:text-white"
            >
                Deskripsi Properti
            </h3>
        </div>

        <p
            class="pl-8 text-xs leading-relaxed text-slate-600
                   dark:text-slate-400 sm:text-sm"
        >
            {{ $estate->description }}
        </p>
    </section>

    {{-- Additional Attributes --}}
    @if (!empty($estate->attributes))
        <section class="border-t border-slate-200 pt-4 dark:border-slate-800">
            <div class="mb-3 flex items-center gap-3">
                <span
                    class="flex h-5 w-5 items-center justify-center bg-slate-950
                           text-[9px] font-bold text-white dark:bg-white
                           dark:text-slate-950"
                >
                    02
                </span>

                <h3
                    class="text-[10px] font-bold uppercase tracking-[0.14em]
                           text-slate-900 dark:text-white"
                >
                    Informasi Tambahan
                </h3>
            </div>

            <div class="grid grid-cols-1 border border-slate-200 dark:border-slate-800 sm:grid-cols-2">

                @if ($estate->attr->legal_docs)
                    <div class="border-b border-slate-200 p-3 dark:border-slate-800 sm:border-r">
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400">
                            Legalitas
                        </span>

                        <span class="mt-1 block text-xs font-bold text-slate-900 dark:text-white">
                            {{ $estate->attr->legal_docs }}
                        </span>
                    </div>
                @endif

                @if ($estate->attr->electricity)
                    <div class="border-b border-slate-200 p-3 dark:border-slate-800">
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400">
                            Listrik
                        </span>

                        <span class="mt-1 block text-xs font-bold text-slate-900 dark:text-white">
                            {{ $estate->attr->electricity }} VA
                        </span>
                    </div>
                @endif

                @if ($estate->attr->water_type)
                    <div class="border-b border-slate-200 p-3 dark:border-slate-800 sm:border-r sm:border-b-0">
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400">
                            Sumber Air
                        </span>

                        <span class="mt-1 block text-xs font-bold text-slate-900 dark:text-white">
                            {{ $estate->attr->water_type }}
                        </span>
                    </div>
                @endif

                @if ($estate->attr->is_kpr)
                    <div class="border-b border-slate-200 p-3 dark:border-slate-800 sm:border-b-0">
                        <span class="text-[10px] font-bold text-slate-950 dark:text-white">
                            ✓ Bisa KPR
                        </span>
                    </div>
                @endif

                @if ($estate->attr->has_imb)
                    <div class="p-3 sm:border-r border-slate-200 dark:border-slate-800">
                        <span class="text-[10px] font-bold text-slate-950 dark:text-white">
                            ✓ Ada IMB / PBG
                        </span>
                    </div>
                @endif

                @if ($estate->attr->promo_cooperation)
                    <div class="p-3">
                        <span class="text-[10px] font-bold text-slate-950 dark:text-white">
                            Promo: {{ $estate->attr->promo_cooperation }}
                        </span>
                    </div>
                @endif

            </div>
        </section>
    @endif

</div>
