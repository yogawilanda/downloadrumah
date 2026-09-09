<div>
    <a href="{{ $this->kprUrl }}" wire:navigate
        class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 text-blue-600 font-semibold text-xs rounded-md hover:bg-blue-100 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
            </path>
        </svg>
        Simulasi Cicilan KPR Unit Ini
    </a>

    <div class="flex items-center justify-between mb-1">
        <h1 class="text-2xl font-black text-blue-600 tracking-tight">{{ $estate->formatted_price }}</h1>
        <span
            class="inline-flex items-center justify-center px-3 py-1 text-[11px] font-bold tracking-wider uppercase rounded-full text-white shadow-sm {{ $estate->transaction_type === 'sale' ? 'bg-emerald-600' : 'bg-amber-600' }}">{{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}</span>
    </div>
    <h2 class="text-base font-bold text-slate-900 leading-snug">{{ $estate->title }}</h2>

    {{-- Perbaikan pemanggilan nama kota dari relasi Laravolt --}}
    <p class="text-xs text-slate-500 mt-1.5 flex items-center gap-1.5">
        <span>{{ $estate->address ?? implode(', ', array_filter([$estate->city?->name, $estate->district])) }}</span>
    </p>
</div>

<div class="grid grid-cols-4 gap-2 py-3 px-2 bg-slate-50 rounded-md text-center border border-slate-100">
    @foreach ([['Kamar', $estate->bedroom, 'KT'], ['Mandi', $estate->bathroom, 'KM'], ['Luas Bgn', $estate->building_size, 'm²'], ['Luas Tnh', $estate->land_size, 'm²']] as $index => [$label, $value, $unit])
        <div class="space-y-0.5 {{ $index > 0 ? 'border-l border-slate-200/60' : '' }}">
            <span class="block text-[11px] font-medium text-slate-400">{{ $label }}</span>
            <span class="font-bold text-xs text-slate-800">{{ $value ?? '-' }} {{ $unit }}</span>
        </div>
    @endforeach
</div>

<div class="space-y-1.5">
    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Deskripsi Properti</h3>
    <p class="text-xs text-slate-600 leading-relaxed whitespace-pre-line font-normal">{{ $estate->description }}</p>
</div>

{{-- Perbaikan loop attributes menggunakan Accessor attr --}}
@if (!empty($estate->attributes))
    <div class="space-y-2">
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Informasi Tambahan</h3>
        <div class="flex flex-wrap gap-2">
            @if ($estate->attr->legal_docs)
                <span
                    class="px-3 py-1.5 bg-blue-50/70 text-blue-700 border border-blue-100/80 text-xs font-semibold rounded-full flex items-center gap-1">
                    <span>Legalitas:</span><span>{{ $estate->attr->legal_docs }}</span>
                </span>
            @endif

            @if ($estate->attr->electricity)
                <span
                    class="px-3 py-1.5 bg-blue-50/70 text-blue-700 border border-blue-100/80 text-xs font-semibold rounded-full flex items-center gap-1">
                    <span>Listrik:</span><span>{{ $estate->attr->electricity }} VA</span>
                </span>
            @endif

            @if ($estate->attr->water_type)
                <span
                    class="px-3 py-1.5 bg-blue-50/70 text-blue-700 border border-blue-100/80 text-xs font-semibold rounded-full flex items-center gap-1">
                    <span>Sumber Air:</span><span>{{ $estate->attr->water_type }}</span>
                </span>
            @endif

            @if ($estate->attr->is_kpr)
                <span
                    class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold rounded-full">
                    Bisa KPR
                </span>
            @endif

            @if ($estate->attr->has_imb)
                <span
                    class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold rounded-full">
                    Ada IMB / PBG
                </span>
            @endif

            @if ($estate->attr->promo_cooperation)
                <span
                    class="px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-100 text-xs font-semibold rounded-full">
                    Promo: {{ $estate->attr->promo_cooperation }}
                </span>
            @endif
        </div>
    </div>
@endif
