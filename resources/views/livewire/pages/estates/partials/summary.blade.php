<div>
    <div class="flex items-center justify-between mb-1">
        <h1 class="text-2xl font-black text-blue-600 tracking-tight">{{ $estate->formatted_price }}</h1>
        <span class="inline-flex items-center justify-center px-3 py-1 text-[11px] font-bold tracking-wider uppercase rounded-full text-white shadow-sm {{ $estate->transaction_type === 'sale' ? 'bg-emerald-600' : 'bg-amber-600' }}">{{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}</span>
    </div>
    <h2 class="text-base font-bold text-slate-900 leading-snug">{{ $estate->title }}</h2>
    <p class="text-xs text-slate-500 mt-1.5 flex items-center gap-1.5"><span>{{ $estate->address ?? ($estate->city . ', ' . $estate->district) }}</span></p>
</div>

<div class="grid grid-cols-4 gap-2 py-3 px-2 bg-slate-50 rounded-2xl text-center border border-slate-100">
    @foreach ([['Kamar', $estate->bedroom, 'KT'], ['Mandi', $estate->bathroom, 'KM'], ['Luas Bgn', $estate->building_size, 'm²'], ['Luas Tnh', $estate->land_size, 'm²']] as $index => [$label, $value, $unit])
        <div class="space-y-0.5 {{ $index > 0 ? 'border-l border-slate-200/60' : '' }}"><span class="block text-[11px] font-medium text-slate-400">{{ $label }}</span><span class="font-bold text-xs text-slate-800">{{ $value ?? '-' }} {{ $unit }}</span></div>
    @endforeach
</div>

<div class="space-y-1.5"><h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Deskripsi Properti</h3><p class="text-xs text-slate-600 leading-relaxed whitespace-pre-line font-normal">{{ $estate->description }}</p></div>

@if(!empty($estate->attributes))
    <div class="space-y-2"><h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Informasi Tambahan</h3><div class="flex flex-wrap gap-2">
        @foreach($estate->attributes as $key => $value)
            @if($value)<span class="px-3 py-1.5 bg-blue-50/70 text-blue-700 border border-blue-100/80 text-xs font-semibold rounded-full flex items-center gap-1"><span class="capitalize">{{ str_replace('_', ' ', $key) }}:</span><span>{{ $value }}</span></span>@endif
        @endforeach
    </div></div>
@endif
