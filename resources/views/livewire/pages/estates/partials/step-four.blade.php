<div class="space-y-4">
    <h2 class="text-base font-bold text-center text-gray-900">Konfirmasi Listing</h2>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-3">
        <!-- Judul & Harga -->
        <div>
            <span class="inline-block px-2.5 py-1 text-[10px] font-semibold tracking-wide uppercase bg-indigo-50 text-indigo-600 rounded-md mb-2">
                {{ $form->transaction_type === 'sale' ? 'Dijual' : 'Disewakan' }}
            </span>
            <h3 class="font-bold text-base text-gray-900 leading-snug">{{ $form->title ?: '-' }}</h3>
            <p class="text-amber-600 font-extrabold text-lg mt-1">
                Rp {{ number_format((float)($form->price ?? 0), 0, ',', '.') }}
            </p>
        </div>

        <!-- Detail Lokasi -->
        @php
            $selectedProvince = $provinces->firstWhere('code', $form->province_id)?->name;
            $selectedCity = $cities->firstWhere('id', $form->city_id)?->name;
        @endphp

        <div class="flex items-center gap-1.5 text-xs text-gray-500 pt-2 border-t border-gray-100">
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>
                {{ implode(', ', array_filter([$form->district, $selectedCity, $selectedProvince])) ?: 'Lokasi belum diisi' }}
            </span>
        </div>

        <!-- Deskripsi Singkat -->
        @if($form->description)
            <p class="text-xs text-gray-600 pt-2 border-t border-gray-100 leading-relaxed">
                {{ Str::limit($form->description, 120) }}
            </p>
        @endif
    </div>
</div>
