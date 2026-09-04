{{--
loc : resources\views\livewire\pages\estates\partials\step-four.blade.php
usage : summary & review page for estate listing submission
--}}

<div class="space-y-4">
    <h2 class="text-base font-bold text-center text-gray-900">Konfirmasi Listing</h2>

    <!-- Card Primary Summary -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <!-- Badge & Judul -->
        <div class="flex items-start justify-between gap-3">
            <div>
                @php
                    $typeLabel = match($form->transaction_type) {
                        'sale' => 'Dijual',
                        'rent' => 'Disewakan',
                        'sale & rent' => 'Dijual & Disewakan',
                        default => 'Dijual'
                    };
                @endphp
                <span class="inline-block px-2.5 py-1 text-[10px] font-bold tracking-wide uppercase bg-blue-50 text-blue-600 rounded-md mb-2">
                    {{ $typeLabel }} • {{ strtoupper($form->listing_group ?: 'Secondary') }}
                </span>
                <h3 class="font-bold text-base text-gray-900 leading-snug">{{ $form->title ?: '-' }}</h3>
            </div>
            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-[10px] font-semibold rounded-md shrink-0">
                {{ strtoupper($form->property_type) }}
            </span>
        </div>

        <!-- Harga -->
        <div class="border-t border-b border-gray-100 py-2.5">
            <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider block">Harga Ringkasan</span>
            <p class="text-blue-600 font-extrabold text-xl mt-0.5">
                Rp {{ number_format((float)($form->price ?? 0), 0, ',', '.') }}
            </p>
        </div>

        <!-- Detail Lokasi -->
        @php
            $selectedProvince = $provinces->firstWhere('code', $form->province_id)?->name;
            $selectedCity = $cities->firstWhere('id', $form->city_id)?->name;
            $fullLocation = implode(', ', array_filter([$form->district, $selectedCity, $selectedProvince]));
        @endphp

        <div class="space-y-1 text-xs text-gray-600">
            <div class="flex items-start gap-2">
                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <div class="flex-1">
                    <span class="font-semibold text-gray-800">{{ $fullLocation ?: 'Lokasi belum dipilih' }}</span>
                    @if ($form->address)
                        <p class="text-[11px] text-gray-500 mt-0.5">{{ $form->address }} {{ $form->block_number ? '('.$form->block_number.')' : '' }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Deskripsi (WA Format Friendly) -->
        @if ($form->description)
            <div class="pt-2 border-t border-gray-100">
                <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider block mb-1">Deskripsi</span>
                <p class="text-xs text-gray-600 leading-relaxed whitespace-pre-line font-sans">
                    {{ Str::limit($form->description, 200) }}
                </p>
            </div>
        @endif
    </div>

    <!-- Card Spesifikasi Bangunan & Fasilitas -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-3">
        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Spesifikasi Utama</h3>

        <div class="grid grid-cols-3 gap-2 text-center text-xs">
            <div class="p-2 bg-gray-50 rounded-xl">
                <span class="block text-[10px] text-gray-400">KT / KM</span>
                <span class="font-bold text-gray-800">{{ $form->bedroom ?: 0 }} / {{ $form->bathroom ?: 0 }}</span>
            </div>
            <div class="p-2 bg-gray-50 rounded-xl">
                <span class="block text-[10px] text-gray-400">LB / LT</span>
                <span class="font-bold text-gray-800">{{ $form->building_size ?: 0 }}m² / {{ $form->land_size ?: 0 }}m²</span>
            </div>
            <div class="p-2 bg-gray-50 rounded-xl">
                <span class="block text-[10px] text-gray-400">Legalitas</span>
                <span class="font-bold text-gray-800">{{ strtoupper($form->attributes_list['legal_docs'] ?? 'SHM') }}</span>
            </div>
        </div>

        <!-- List Fasilitas Terpilih -->
        @php
            $activeFacilityIds = array_keys(array_filter($form->selected_facilities ?? [], fn($f) => !empty($f['id'])));
            $selectedFacilityModels = $facilities->whereIn('id', $activeFacilityIds);
        @endphp

        @if ($selectedFacilityModels->isNotEmpty())
            <div class="pt-2 border-t border-gray-100">
                <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider block mb-2">Fasilitas</span>
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($selectedFacilityModels as $fac)
                        @php $val = $form->selected_facilities[$fac->id]['value'] ?? null; @endphp
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50/70 text-blue-700 text-[11px] font-medium rounded-lg">
                            ✓ {{ $fac->name }} {{ $val ? "($val)" : '' }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Card Kontak Pemilik Internal -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-2">
        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Data Pemilik (Internal)</h3>
        <div class="flex items-center justify-between text-xs pt-1">
            <div>
                <span class="font-semibold text-gray-800 block">{{ $form->owner_name ?: 'Nama Pemilik Belum Diisi' }}</span>
                <span class="text-gray-500 text-[11px]">{{ $form->owner_phone ?: 'Telepon Belum Diisi' }}</span>
            </div>
            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full {{ $form->show_owner_phone ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' }}">
                {{ $form->show_owner_phone ? 'Publik' : 'Privat (Agen Only)' }}
            </span>
        </div>
    </div>
</div>
