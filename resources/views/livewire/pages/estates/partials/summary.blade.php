{{-- resources/views/livewire/pages/estates/partials/summary.blade.php --}}
<div class="space-y-6">

    {{-- Listing Header --}}
    <div class="border-b border-slate-200 dark:border-slate-800 pb-5 space-y-4">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <span class="px-2 py-1 bg-slate-950 dark:bg-white text-white dark:text-slate-950 text-[9px] font-bold uppercase tracking-[0.12em]">
                    {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
                </span>
                <span class="text-[9px] font-bold uppercase tracking-[0.12em] text-slate-400 dark:text-slate-500">
                    PROPERTY
                </span>
            </div>

            <a href="{{ $this->kprUrl }}" wire:navigate
                class="inline-flex items-center gap-2 px-3 py-2 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-[10px] font-bold uppercase tracking-wider hover:bg-slate-950 hover:text-white dark:hover:bg-white dark:hover:text-slate-950 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                KPR
            </a>
        </div>

        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-950 dark:text-white tracking-tight leading-none">
                {{ $estate->formatted_price }}
            </h1>

            <h2 class="mt-2 text-base sm:text-lg font-bold text-slate-900 dark:text-white leading-snug">
                {{ $estate->title }}
            </h2>

            <p class="mt-2 text-xs sm:text-sm text-slate-500 dark:text-slate-400 flex items-start gap-2">
                <svg class="w-4 h-4 shrink-0 mt-0.5 text-slate-950 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>{{ $estate->address ?? implode(', ', array_filter([$estate->city?->name, $estate->district])) }}</span>
            </p>
        </div>
    </div>

    {{-- Core Specifications --}}
    <div class="grid grid-cols-4 border border-slate-200 dark:border-slate-800">
        @foreach ([['Kamar', $estate->bedroom, 'KT'], ['Mandi', $estate->bathroom, 'KM'], ['Luas Bgn', $estate->building_size, 'm²'], ['Luas Tnh', $estate->land_size, 'm²']] as $index => [$label, $value, $unit])
            <div class="p-3 text-center bg-white dark:bg-slate-900 {{ $index > 0 ? 'border-l border-slate-200 dark:border-slate-800' : '' }}">
                <span class="block text-[9px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    {{ $label }}
                </span>
                <span class="block mt-1 text-xs sm:text-sm font-bold text-slate-900 dark:text-white">
                    {{ $value ?? '-' }} {{ $unit }}
                </span>
            </div>
        @endforeach
    </div>

    {{-- Description --}}
    <section class="pt-1">
        <div class="flex items-center gap-3 mb-2">
            <span class="w-5 h-5 flex items-center justify-center bg-slate-950 dark:bg-white text-white dark:text-slate-950 text-[9px] font-bold">
                01
            </span>
            <h3 class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-900 dark:text-white">
                Deskripsi Properti
            </h3>
        </div>

        <p class="pl-8 text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed whitespace-pre-line">
            {{ $estate->description }}
        </p>
    </section>

    {{-- Additional Attributes --}}
    @if (!empty($estate->attributes))
        <section class="pt-4 border-t border-slate-200 dark:border-slate-800">
            <div class="flex items-center gap-3 mb-3">
                <span class="w-5 h-5 flex items-center justify-center bg-slate-950 dark:bg-white text-white dark:text-slate-950 text-[9px] font-bold">
                    02
                </span>
                <h3 class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-900 dark:text-white">
                    Informasi Tambahan
                </h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 border border-slate-200 dark:border-slate-800">
                @if ($estate->attr->legal_docs)
                    <div class="p-3 border-b sm:border-r border-slate-200 dark:border-slate-800">
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400">Legalitas</span>
                        <span class="block mt-1 text-xs font-bold text-slate-900 dark:text-white">{{ $estate->attr->legal_docs }}</span>
                    </div>
                @endif

                @if ($estate->attr->electricity)
                    <div class="p-3 border-b border-slate-200 dark:border-slate-800">
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400">Listrik</span>
                        <span class="block mt-1 text-xs font-bold text-slate-900 dark:text-white">{{ $estate->attr->electricity }} VA</span>
                    </div>
                @endif

                @if ($estate->attr->water_type)
                    <div class="p-3 border-b sm:border-b-0 sm:border-r border-slate-200 dark:border-slate-800">
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400">Sumber Air</span>
                        <span class="block mt-1 text-xs font-bold text-slate-900 dark:text-white">{{ $estate->attr->water_type }}</span>
                    </div>
                @endif

                @if ($estate->attr->is_kpr)
                    <div class="p-3 border-b sm:border-b-0 border-slate-200 dark:border-slate-800">
                        <span class="text-[10px] font-bold text-slate-950 dark:text-white">✓ Bisa KPR</span>
                    </div>
                @endif

                @if ($estate->attr->has_imb)
                    <div class="p-3 sm:border-r border-slate-200 dark:border-slate-800">
                        <span class="text-[10px] font-bold text-slate-950 dark:text-white">✓ Ada IMB / PBG</span>
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

    {{-- Mobile & Tablet Action --}}
    <div class="lg:hidden left-0 right-0 z-40 bg-white/95 dark:bg-slate-950/95 backdrop-blur-md border-t border-slate-200 dark:border-slate-800 p-3 sm:px-6">
        <div class="max-w-md md:max-w-2xl mx-auto">
            @if ($isOwner)
                @include('livewire.pages.estates.partials.agent-owner-edit')
            @else
                @include('livewire.pages.estates.partials.agent-contact')
            @endif
        </div>
    </div>
</div>
