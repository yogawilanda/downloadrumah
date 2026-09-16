{{-- resources/views/livewire/pages/estates/partials/step-four.blade.php --}}
<div class="space-y-6">

    {{-- Step Header --}}
    <div class="flex items-end justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-4">
        <div>
            <div class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">
                Langkah 04
            </div>
            <h2 class="mt-1 text-lg font-bold tracking-tight text-slate-950 dark:text-white">
                Konfirmasi Listing
            </h2>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                Periksa kembali informasi sebelum listing dipublikasikan.
            </p>
        </div>
        <div
            class="hidden sm:block text-right text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
            ESTATE / REVIEW
        </div>
    </div>

    @php
    $typeLabel = match($form->transaction_type) {
    'sale' => 'Dijual',
    'rent' => 'Disewakan',
    'sale & rent' => 'Dijual & Disewakan',
    default => 'Dijual'
    };

    $transactionStatus = strtoupper($form->transaction_status ?: 'AVAILABLE');
    $publicityStatus = strtoupper($form->publicity_status ?: 'DRAFT');

    $selectedProvince = $provinces->firstWhere('code', $form->province_id)?->name;
    $selectedCity = $cities->firstWhere('code', $form->city_id)?->name;
    $selectedDistrict = $districts->firstWhere('code', $form->district_id)?->name;
    $fullLocation = implode(', ', array_filter([
    $selectedDistrict,
    $selectedCity,
    $selectedProvince
    ]));

    $activeFacilityIds = array_keys(
    array_filter(
    $form->selected_facilities ?? [],
    fn($f) => !empty($f['id'])
    )
    );

    $selectedFacilityModels = $facilities->whereIn('id', $activeFacilityIds);
    @endphp

    {{-- Primary Summary --}}
    <section class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">

        <div class="p-5 space-y-5">

            {{-- Listing Identity --}}
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span
                            class="px-2 py-1 text-[9px] font-bold uppercase tracking-[0.1em] bg-slate-950 dark:bg-white text-white dark:text-slate-950">
                            {{ $typeLabel }}
                        </span>
                        <span
                            class="px-2 py-1 text-[9px] font-bold uppercase tracking-[0.1em] border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300">
                            {{ strtoupper($form->listing_group ?: 'Secondary') }}
                        </span>
                    </div>
                    <h3 class="font-bold text-base text-slate-950 dark:text-white leading-snug">
                        {{ $form->title ?: '-' }}
                    </h3>
                </div>

                <span
                    class="px-2 py-1 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 text-[9px] font-bold uppercase tracking-wider shrink-0">
                    {{ strtoupper($form->property_type) }}
                </span>
            </div>

            {{-- Status Matrix --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 border border-slate-200 dark:border-slate-800">

                <div class="p-3 border-r border-slate-200 dark:border-slate-800">
                    <span
                        class="block text-[9px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        Transaksi
                    </span>
                    <span class="block mt-1 text-[11px] font-bold text-slate-950 dark:text-white">
                        {{ $transactionStatus }}
                    </span>
                </div>

                <div class="p-3 sm:border-r border-slate-200 dark:border-slate-800">
                    <span
                        class="block text-[9px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        Publisitas
                    </span>
                    <span class="block mt-1 text-[11px] font-bold text-slate-950 dark:text-white">
                        {{ $publicityStatus }}
                    </span>
                </div>

                <div class="hidden sm:block p-3">
                    <span
                        class="block text-[9px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        Group
                    </span>
                    <span class="block mt-1 text-[11px] font-bold text-slate-950 dark:text-white">
                        {{ strtoupper($form->listing_group ?: 'SECONDARY') }}
                    </span>
                </div>

            </div>

            {{-- Price --}}
            <div class="border-y border-slate-200 dark:border-slate-800 py-3">
                <span class="text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.12em]">
                    Harga Ringkasan
                </span>
                <p class="text-xl font-extrabold text-slate-950 dark:text-white mt-0.5">
                    Rp {{ number_format((float)($form->price ?? 0), 0, ',', '.') }}
                </p>
            </div>

            {{-- Location --}}
            <div class="flex items-start gap-3 text-xs">
                <span
                    class="flex h-7 w-7 items-center justify-center bg-slate-950 dark:bg-white text-white dark:text-slate-950 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <div>
                    <span class="font-bold text-slate-800 dark:text-slate-200">
                        {{ $fullLocation ?: 'Lokasi belum dipilih' }}
                    </span>
                    @if ($form->address)
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                        {{ $form->address }}
                        {{ $form->block_number ? '('.$form->block_number.')' : '' }}
                    </p>
                    @endif
                </div>
            </div>

            {{-- Description --}}
            @if ($form->description)
            <div class="pt-3 border-t border-slate-200 dark:border-slate-800">
                <span class="text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.12em]">
                    Deskripsi
                </span>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed whitespace-pre-line mt-1">
                    {{ Str::limit($form->description, 200) }}
                </p>
            </div>
            @endif
        </div>
    </section>

    {{-- Specifications --}}
    <section class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
        <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-900 dark:text-white">
                Spesifikasi Utama
            </h3>
        </div>

        <div class="p-5 space-y-4">
            <div
                class="grid grid-cols-3 gap-px bg-slate-200 dark:bg-slate-800 border border-slate-200 dark:border-slate-800">
                <div class="p-3 bg-white dark:bg-slate-900 text-center">
                    <span class="block text-[9px] text-slate-400">KT / KM</span>
                    <span class="font-bold text-xs text-slate-900 dark:text-white">
                        {{ $form->bedroom ?: 0 }} / {{ $form->bathroom ?: 0 }}
                    </span>
                </div>
                <div class="p-3 bg-white dark:bg-slate-900 text-center">
                    <span class="block text-[9px] text-slate-400">LB / LT</span>
                    <span class="font-bold text-xs text-slate-900 dark:text-white">
                        {{ $form->building_size ?: 0 }}m² / {{ $form->land_size ?: 0 }}m²
                    </span>
                </div>
                <div class="p-3 bg-white dark:bg-slate-900 text-center">
                    <span class="block text-[9px] text-slate-400">Legalitas</span>
                    <span class="font-bold text-xs text-slate-900 dark:text-white">
                        {{ strtoupper($form->certificate_type ?: 'SHM') }}
                    </span>
                </div>
            </div>

            @if ($selectedFacilityModels->isNotEmpty())
            <div class="pt-3 border-t border-slate-200 dark:border-slate-800">
                <span class="text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.12em]">
                    Fasilitas
                </span>
                <div
                    class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-px bg-slate-200 dark:bg-slate-800 border border-slate-200 dark:border-slate-800">
                    @foreach ($selectedFacilityModels as $fac)
                    @php $val = $form->selected_facilities[$fac->id]['value'] ?? null; @endphp
                    <div class="bg-white dark:bg-slate-900 px-3 py-2 text-[11px] text-slate-700 dark:text-slate-300">
                        <span class="font-bold text-slate-950 dark:text-white">✓</span>
                        {{ $fac->name }} {{ $val ? "($val)" : '' }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    {{-- Owner --}}
    <section class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
        <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-900 dark:text-white">
                Data Pemilik — Internal
            </h3>
        </div>

        <div class="p-5 flex items-center justify-between gap-4">
            <div>
                <span class="font-bold text-xs text-slate-900 dark:text-white block">
                    {{ $form->owner_name ?: 'Nama Pemilik Belum Diisi' }}
                </span>
                <span class="text-[11px] text-slate-500 dark:text-slate-400">
                    {{ $form->owner_phone ?: 'Telepon Belum Diisi' }}
                </span>
            </div>

            <span class="px-2 py-1 text-[9px] font-bold uppercase tracking-wider border
                {{ $form->show_owner_phone
                    ? 'border-slate-950 text-slate-950 dark:border-white dark:text-white'
                    : 'border-slate-200 text-slate-400 dark:border-slate-700 dark:text-slate-500' }}">
                {{ $form->show_owner_phone ? 'Publik' : 'Privat · Agen Only' }}
            </span>
        </div>
    </section>
</div>
