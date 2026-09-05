{{--
Forms :
- Province & City (Laravolt dropdown cascade)
- District, Address, Block Number
- Building Specifications
- Dynamic Facilities Checkbox + Pivot Value Input
--}}
{{-- 1.ubah menjadi format dibawah --}}
{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/auth/partials/login-form.blade.php
| @usage : Partial View for User Login Form with Google-style Transitions
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="space-y-4">
    <h2 class="text-base font-bold text-center text-gray-900">Detail Properti</h2>

    <!-- Lokasi Section -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
            <div class="flex items-center gap-2">
                <span class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Lokasi Properti</h3>
            </div>
        </div>

        <!-- Wilayah (Provinsi & Kota/Kab) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <!-- 1. Select Provinsi -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Provinsi</label>
                <div class="relative">
                    <select wire:model.live="form.province_id"
                        class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50/50 pl-3.5 pr-9 py-2.5 text-xs text-gray-800 truncate focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all cursor-pointer">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->code }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('form.province_id')
                    <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- 2. Select Kota / Kab -->
            {{-- 2. Select Kota / Kab --}}
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kota / Kabupaten</label>
                <div class="relative">
                    <!-- TAMBAHKAN .live DI SINI -->
                    <select wire:model.live="form.city_id" @disabled(!$form->province_id)
                        class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50/50 pl-3.5 pr-9 py-2.5 text-xs text-gray-800 truncate focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed cursor-pointer">
                        <option value="">
                            {{ $form->province_id ? 'Pilih Kota / Kabupaten' : 'Pilih Provinsi Terlebih Dahulu' }}
                        </option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <div wire:loading wire:target="form.province_id">
                            <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                @error('form.city_id')
                    <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Detail Alamat -->
        <!-- Detail Alamat -->
        <div class="space-y-3 pt-1">
            <!-- Baris 1: Area & No/Blok -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <!-- Select Area / Kecamatan (Laravolt Cascade) -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kecamatan</label>
                    <div class="relative">
                        <!-- Select Kecamatan -->
                        <select wire:model.live="form.district_id" @disabled(!$form->city_id)
                            class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50/50 pl-3.5 pr-9 py-2.5 text-xs text-gray-800 truncate focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed cursor-pointer">
                            <option value="">
                                {{ $form->city_id ? 'Pilih Kecamatan' : 'Pilih Kota / Kabupaten Terlebih Dahulu' }}
                            </option>
                            @foreach ($districts as $district)
                                <!-- Ganti $district->id menjadi $district->code -->
                                <option value="{{ $district->code }}">{{ $district->name }}</option>
                            @endforeach
                        </select>

                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                            <div wire:loading wire:target="form.city_id">
                                <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @error('form.district_id')
                        <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">No / Blok</label>
                    <input type="text" wire:model="form.block_number" placeholder="Contoh: No. 12B / Blok A"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-2.5 text-xs text-gray-800 placeholder-gray-400 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
                    @error('form.block_number')
                        <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Baris 2: Nama Jalan (Full Width) -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Jalan / Perumahan</label>
                <input type="text" wire:model="form.address" placeholder="Contoh: Jl. Raya Mulyosari No. 45"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-2.5 text-xs text-gray-800 placeholder-gray-400 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
                @error('form.address')
                    <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- Spesifikasi Bangunan -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </span>
            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Spesifikasi Bangunan</h3>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            @foreach ([['bedroom', 'Kamar Tidur', '1'], ['bathroom', 'Kamar Mandi', '1'], ['building_size', 'LB (m²)', '36'], ['land_size', 'LT (m²)', '60'], ['building_width', 'Lebar (m)', '6'], ['building_length', 'Panjang (m)', '10']] as [$field, $label, $placeholder])
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">{{ $label }}</label>
                    <input type="number" @if (in_array($field, ['building_width', 'building_length'])) step="0.1" @endif
                        wire:model="form.{{ $field }}" placeholder="{{ $placeholder }}"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-2 text-xs text-gray-800 placeholder-gray-400 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
                    @error('form.' . $field)
                        <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
        </div>
    </div>

    <!-- Fasilitas Properti Section -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </span>
            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Fasilitas Properti</h3>
        </div>

        <div class="grid grid-cols-2 gap-2.5">
            @foreach ($facilities as $facility)
                @php
                    $isChecked = !empty($form->selected_facilities[$facility->id]['id']);
                @endphp

                <div
                    class="p-2.5 rounded-xl border border-gray-100 bg-gray-50/50 transition-all {{ $isChecked ? 'bg-blue-50/30 border-blue-200' : '' }}">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" wire:model.live="form.selected_facilities.{{ $facility->id }}.id"
                            value="{{ $facility->id }}"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4">
                        <span class="text-xs font-semibold text-gray-800 truncate">{{ $facility->name }}</span>
                    </label>

                    {{-- Input detail hanya muncul jika checkbox dicentang --}}
                    @if ($isChecked)
                        <div class="mt-2 pt-2 border-t border-blue-100/60">
                            <input type="text" wire:model="form.selected_facilities.{{ $facility->id }}.value"
                                placeholder="Detail (ex: 2200 Watt / 2 Unit)"
                                class="w-full text-xs rounded-lg border border-gray-200 px-2 py-1 bg-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
