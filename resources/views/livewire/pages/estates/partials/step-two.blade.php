{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/estates/partials/step-two-form.blade.php
| @usage : Partial View Step 2 (Building Specs & Location) for Estate Wizard Form
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
    |--------------------------------------------------------------------------
    --}}

    <div class="space-y-6">

        {{-- Step Header --}}
        <div class="flex items-end justify-between border-b border-slate-200 dark:border-slate-800 pb-4">

            <div>

                <div class="flex items-center gap-2 mb-1">

                    <span class="w-1.5 h-1.5 bg-slate-950 dark:bg-white"></span>

                    <span class="text-[9px] font-bold uppercase tracking-[0.18em]
                             text-slate-400 dark:text-slate-500">
                        Langkah 02
                    </span>

                </div>

                <h2 class="text-xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Detail Properti
                </h2>

                <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                    Lokasi, spesifikasi bangunan, dan fasilitas properti.
                </p>

            </div>

            <div class="hidden sm:block text-right">

                <span class="font-mono text-[10px] text-slate-400 dark:text-slate-600">
                    ESTATE / DETAILS
                </span>

            </div>

        </div>


        {{-- Lokasi --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">

            <div class="flex items-center justify-between
                    px-5 py-4 border-b border-slate-200 dark:border-slate-800">

                <div class="flex items-center gap-3">

                    <div class="w-7 h-7 bg-slate-950 dark:bg-white
                            text-white dark:text-slate-950
                            flex items-center justify-center">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />

                            <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                    </div>

                    <div>

                        <h3 class="text-[11px] font-bold uppercase tracking-[0.14em]
                               text-slate-900 dark:text-slate-100">
                            Lokasi Properti
                        </h3>

                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">
                            Tentukan wilayah dan alamat properti.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 space-y-5">

                {{-- Province / City --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Province --}}
                    <div>

                        <label class="block mb-2 text-[10px] font-bold uppercase tracking-[0.1em]
                                  text-slate-600 dark:text-slate-400">
                            Provinsi
                        </label>

                        <select wire:model.live="form.province_id" class="w-full appearance-none border border-slate-200 dark:border-slate-700
                               bg-white dark:bg-slate-950
                               px-3.5 py-2.5 text-xs text-slate-900 dark:text-slate-100
                               focus:border-slate-950 dark:focus:border-white
                               focus:outline-none focus:ring-0
                               cursor-pointer">
                            <option value="">Pilih Provinsi</option>

                            @foreach ($provinces as $province)
                            <option value="{{ $province->code }}">
                                {{ $province->name }}
                            </option>
                            @endforeach

                        </select>

                        @error('form.province_id')
                        <span class="text-[10px] text-red-500 mt-1.5 block">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>


                    {{-- City --}}
                    <div>

                        <label class="block mb-2 text-[10px] font-bold uppercase tracking-[0.1em]
                                  text-slate-600 dark:text-slate-400">
                            Kota / Kabupaten
                        </label>

                        <div class="relative">

                            <select wire:model.live="form.city_id" @disabled(!$form->province_id)
                                class="w-full appearance-none border border-slate-200 dark:border-slate-700
                                bg-white dark:bg-slate-950
                                px-3.5 py-2.5 text-xs text-slate-900 dark:text-slate-100
                                focus:border-slate-950 dark:focus:border-white
                                focus:outline-none focus:ring-0
                                disabled:bg-slate-100 dark:disabled:bg-slate-800
                                disabled:text-slate-400
                                disabled:cursor-not-allowed cursor-pointer"
                                >
                                <option value="">
                                    {{ $form->province_id ? 'Pilih Kota / Kabupaten' : 'Pilih Provinsi Terlebih Dahulu'
                                    }}
                                </option>

                                @foreach ($cities as $city)
                                <option value="{{ $city->code }}">
                                    {{ $city->name }}
                                </option>
                                @endforeach

                            </select>

                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">

                                <div wire:loading wire:target="form.province_id">

                                    <svg class="animate-spin h-3.5 w-3.5 text-slate-900 dark:text-white"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="3" />

                                        <path class="opacity-80" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z" />

                                    </svg>

                                </div>

                            </div>

                        </div>

                        @error('form.city_id')
                        <span class="text-[10px] text-red-500 mt-1.5 block">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                </div>


                {{-- District / Block --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- District --}}
                    <div>

                        <label class="block mb-2 text-[10px] font-bold uppercase tracking-[0.1em]
                                  text-slate-600 dark:text-slate-400">
                            Kecamatan
                        </label>

                        <div class="relative">

                            <select wire:model.live="form.district_id" @disabled(!$form->city_id)
                                class="w-full appearance-none border border-slate-200 dark:border-slate-700
                                bg-white dark:bg-slate-950
                                px-3.5 py-2.5 text-xs text-slate-900 dark:text-slate-100
                                focus:border-slate-950 dark:focus:border-white
                                focus:outline-none focus:ring-0
                                disabled:bg-slate-100 dark:disabled:bg-slate-800
                                disabled:text-slate-400
                                disabled:cursor-not-allowed cursor-pointer"
                                >
                                <option value="">
                                    {{ $form->city_id ? 'Pilih Kecamatan' : 'Pilih Kota / Kabupaten Terlebih Dahulu' }}
                                </option>

                                @foreach ($districts as $district)
                                <option value="{{ $district->code }}">
                                    {{ $district->name }}
                                </option>
                                @endforeach

                            </select>

                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">

                                <div wire:loading wire:target="form.city_id">

                                    <svg class="animate-spin h-3.5 w-3.5 text-slate-900 dark:text-white"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="3" />

                                        <path class="opacity-80" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z" />

                                    </svg>

                                </div>

                            </div>

                        </div>

                        @error('form.district_id')
                        <span class="text-[10px] text-red-500 mt-1.5 block">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>


                    {{-- Block Number --}}
                    <div>

                        <label class="block mb-2 text-[10px] font-bold uppercase tracking-[0.1em]
                                  text-slate-600 dark:text-slate-400">
                            No / Blok
                        </label>

                        <input type="text" wire:model="form.block_number" placeholder="Contoh: No. 12B / Blok A" class="w-full border border-slate-200 dark:border-slate-700
                               bg-white dark:bg-slate-950
                               px-3.5 py-2.5 text-xs text-slate-900 dark:text-slate-100
                               placeholder:text-slate-400 dark:placeholder:text-slate-600
                               focus:border-slate-950 dark:focus:border-white
                               focus:outline-none focus:ring-0" />

                        @error('form.block_number')
                        <span class="text-[10px] text-red-500 mt-1.5 block">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                </div>


                {{-- Address --}}
                <div>

                    <label class="block mb-2 text-[10px] font-bold uppercase tracking-[0.1em]
                              text-slate-600 dark:text-slate-400">
                        Nama Jalan / Perumahan
                    </label>

                    <input type="text" wire:model="form.address" placeholder="Contoh: Jl. Raya Mulyosari No. 45" class="w-full border border-slate-200 dark:border-slate-700
                           bg-white dark:bg-slate-950
                           px-3.5 py-2.5 text-xs text-slate-900 dark:text-slate-100
                           placeholder:text-slate-400 dark:placeholder:text-slate-600
                           focus:border-slate-950 dark:focus:border-white
                           focus:outline-none focus:ring-0" />

                    @error('form.address')
                    <span class="text-[10px] text-red-500 mt-1.5 block">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

            </div>

        </div>


        {{-- Building Specifications --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">

            <div class="flex items-center gap-3 px-5 py-4 border-b border-slate-200 dark:border-slate-800">

                <div class="w-7 h-7 bg-slate-950 dark:bg-white
                        text-white dark:text-slate-950
                        flex items-center justify-center">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>

                </div>

                <div>

                    <h3 class="text-[11px] font-bold uppercase tracking-[0.14em]
                           text-slate-900 dark:text-slate-100">
                        Spesifikasi Bangunan
                    </h3>

                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">
                        Ukuran dan jumlah ruang utama.
                    </p>

                </div>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">

                    @foreach ([
                    ['bedroom', 'Kamar Tidur', '1'],
                    ['bathroom', 'Kamar Mandi', '1'],
                    ['building_size', 'LB (m²)', '36'],
                    ['land_size', 'LT (m²)', '60'],
                    ['building_width', 'Lebar (m)', '6'],
                    ['building_length', 'Panjang (m)', '10']
                    ] as [$field, $label, $placeholder])

                    <div>

                        <label class="block mb-2 text-[10px] font-bold uppercase tracking-[0.1em]
                                      text-slate-600 dark:text-slate-400">
                            {{ $label }}
                        </label>

                        <input type="number" @if (in_array($field, ['building_width', 'building_length' ])) step="0.1"
                            @endif wire:model="form.{{ $field }}" placeholder="{{ $placeholder }}" class="w-full border border-slate-200 dark:border-slate-700
                                   bg-white dark:bg-slate-950
                                   px-3.5 py-2.5 text-xs text-slate-900 dark:text-slate-100
                                   placeholder:text-slate-400 dark:placeholder:text-slate-600
                                   focus:border-slate-950 dark:focus:border-white
                                   focus:outline-none focus:ring-0" />

                        @error('form.' . $field)
                        <span class="text-[10px] text-red-500 mt-1.5 block">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    @endforeach

                </div>

            </div>

        </div>


        {{-- Facilities --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">

            <div class="flex items-center gap-3 px-5 py-4 border-b border-slate-200 dark:border-slate-800">

                <div class="w-7 h-7 bg-slate-950 dark:bg-white
                        text-white dark:text-slate-950
                        flex items-center justify-center">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>

                </div>

                <div>

                    <h3 class="text-[11px] font-bold uppercase tracking-[0.14em]
                           text-slate-900 dark:text-slate-100">
                        Fasilitas Properti
                    </h3>

                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">
                        Pilih fasilitas yang tersedia.
                    </p>

                </div>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-2 gap-2.5">

                    @foreach ($facilities as $facility)

                    @php
                    $isChecked = !empty($form->selected_facilities[$facility->id]['id']);
                    @endphp

                    <div class="border p-3 transition-colors
                            {{ $isChecked
                                ? 'border-slate-950 dark:border-white bg-slate-50 dark:bg-slate-800'
                                : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950' }}">

                        <label class="flex items-center gap-2 cursor-pointer">

                            <input type="checkbox" wire:model.live="form.selected_facilities.{{ $facility->id }}.id"
                                value="{{ $facility->id }}" class="w-4 h-4 rounded-none
                                       border-slate-300 dark:border-slate-600
                                       text-slate-950 dark:text-white
                                       focus:ring-0" />

                            <span class="text-xs font-semibold truncate
                                         text-slate-800 dark:text-slate-200">
                                {{ $facility->name }}
                            </span>

                        </label>


                        @if ($isChecked)

                        <div class="mt-3 pt-3 border-t
                                        border-slate-200 dark:border-slate-700">

                            <input type="text" wire:model="form.selected_facilities.{{ $facility->id }}.value"
                                placeholder="Detail (ex: 2200 Watt / 2 Unit)" class="w-full border border-slate-200 dark:border-slate-700
                                           bg-white dark:bg-slate-950
                                           px-2.5 py-2 text-xs
                                           text-slate-900 dark:text-slate-100
                                           placeholder:text-slate-400 dark:placeholder:text-slate-600
                                           focus:border-slate-950 dark:focus:border-white
                                           focus:outline-none focus:ring-0" />

                        </div>

                        @endif

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>
