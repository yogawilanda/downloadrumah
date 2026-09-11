{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/summary.blade.php
| @usage      : Responsive Body Summary Content for Estate Show
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="space-y-6">
    {{-- Top Action & Price Header --}}
    <div class="space-y-3">
        <div class="flex items-center justify-between gap-3">
            <a href="{{ $this->kprUrl }}" wire:navigate
                class="inline-flex items-center gap-2 px-3.5 py-2 bg-blue-50 text-blue-600 font-bold text-xs rounded-md hover:bg-blue-100 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                    </path>
                </svg>
                <span>Simulasi Cicilan KPR</span>
            </a>

            <span
                class="inline-flex items-center px-3 py-1 text-[11px] font-bold tracking-wider uppercase rounded-full text-white shadow-sm {{ $estate->transaction_type === 'sale' ? 'bg-emerald-600' : 'bg-amber-600' }}">
                {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
            </span>
        </div>

        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-blue-600 tracking-tight mb-1">{{ $estate->formatted_price }}
            </h1>
            <h2 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">{{ $estate->title }}</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1.5 flex items-center gap-1.5">
                <span>{{ $estate->address ?? implode(', ', array_filter([$estate->city?->name, $estate->district])) }}</span>
            </p>
        </div>
    </div>

    {{-- Specs Grid (4 Columns) --}}
    <div class="grid grid-cols-4 gap-2 sm:gap-4 py-3.5 px-3 bg-slate-50 rounded-md text-center border border-slate-100">
        @foreach ([['Kamar', $estate->bedroom, 'KT'], ['Mandi', $estate->bathroom, 'KM'], ['Luas Bgn', $estate->building_size, 'm²'], ['Luas Tnh', $estate->land_size, 'm²']] as $index => [$label, $value, $unit])
            <div class="space-y-0.5 {{ $index > 0 ? 'border-l border-slate-200/60' : '' }}">
                <span
                    class="block text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ $label }}</span>
                <span class="font-bold text-xs sm:text-sm text-slate-800">{{ $value ?? '-' }} {{ $unit }}</span>
            </div>
        @endforeach
    </div>

    {{-- Description --}}
    <div class="space-y-2 pt-2 border-t border-slate-100">
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Deskripsi Properti</h3>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line font-normal">
            {{ $estate->description }}</p>
    </div>

    {{-- Additional Attributes --}}
    @if (!empty($estate->attributes))
        <div class="space-y-2.5 pt-2 border-t border-slate-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Informasi Tambahan</h3>
            <div class="flex flex-wrap gap-2">
                @if ($estate->attr->legal_docs)
                    <span
                        class="px-3 py-1.5 bg-blue-50/70 text-blue-700 border border-blue-100/80 text-xs font-semibold rounded-md flex items-center gap-1">
                        <span class="text-blue-500">Legalitas:</span><span>{{ $estate->attr->legal_docs }}</span>
                    </span>
                @endif

                @if ($estate->attr->electricity)
                    <span
                        class="px-3 py-1.5 bg-blue-50/70 text-blue-700 border border-blue-100/80 text-xs font-semibold rounded-md flex items-center gap-1">
                        <span class="text-blue-500">Listrik:</span><span>{{ $estate->attr->electricity }} VA</span>
                    </span>
                @endif

                @if ($estate->attr->water_type)
                    <span
                        class="px-3 py-1.5 bg-blue-50/70 text-blue-700 border border-blue-100/80 text-xs font-semibold rounded-md flex items-center gap-1">
                        <span class="text-blue-500">Sumber Air:</span><span>{{ $estate->attr->water_type }}</span>
                    </span>
                @endif

                @if ($estate->attr->is_kpr)
                    <span
                        class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold rounded-md">
                        ✓ Bisa KPR
                    </span>
                @endif

                @if ($estate->attr->has_imb)
                    <span
                        class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold rounded-md">
                        ✓ Ada IMB / PBG
                    </span>
                @endif

                @if ($estate->attr->promo_cooperation)
                    <span
                        class="px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-100 text-xs font-semibold rounded-md">
                        🔥 Promo: {{ $estate->attr->promo_cooperation }}
                    </span>
                @endif
            </div>
        </div>
    @endif

    {{-- Mobile & Tablet Bottom Action Bar --}}
    <div
        class="lg:hidden left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/80 p-3 sm:px-6">
        <div class="max-w-md md:max-w-2xl mx-auto">
            @if ($isOwner)
                @include('livewire.pages.estates.partials.agent-owner-edit')
            @else
                @include('livewire.pages.estates.partials.agent-contact')
            @endif
        </div>
    </div>
</div>
