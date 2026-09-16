{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/estates/partials/step-one.blade.php
| @usage : Partial View for Estate Registration Form (Step 1: General Info)
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@php
    $primaryPhotoType = $primaryPhotoType ?? 'existing';
    $primaryPhotoIndex = $primaryPhotoIndex ?? 0;
@endphp

<div class="space-y-6">

    {{-- Step Header --}}
    <div class="flex items-end justify-between border-b border-slate-200 dark:border-slate-800 pb-4">

        <div>
            <div class="flex items-center gap-2 mb-1">

                <span class="w-1.5 h-1.5 bg-slate-950 dark:bg-white"></span>

                <span class="text-[9px] font-bold uppercase tracking-[0.18em]
                             text-slate-400 dark:text-slate-500">
                    Langkah 01
                </span>

            </div>

            <h2 class="text-xl font-bold tracking-tight text-slate-950 dark:text-white">
                Info Umum
            </h2>

            <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                Informasi utama dan media properti.
            </p>
        </div>

        <div class="hidden sm:block text-right">

            <span class="font-mono text-[10px] text-slate-400 dark:text-slate-600">
                ESTATE / GENERAL
            </span>

        </div>

    </div>


    {{-- Listing Photo Guidance --}}
    <div class="border-l-2 border-slate-950 dark:border-white
                bg-slate-50 dark:bg-slate-900
                px-4 py-3">

        <div class="flex items-start gap-3">

            <div class="mt-0.5 text-slate-950 dark:text-white text-xs font-bold">
                i
            </div>

            <div>

                <p class="text-[10px] font-bold uppercase tracking-[0.1em]
                          text-slate-800 dark:text-slate-200">
                    Tips Listing Menarik
                </p>

                <p class="mt-1 text-[11px] leading-relaxed
                          text-slate-500 dark:text-slate-400">
                    Gunakan foto landscape (horizontal) agar properti tampil
                    lebih penuh dan konsisten pada halaman listing.
                </p>

            </div>

        </div>

    </div>


    {{-- Photo Section --}}
    @include('livewire.pages.estates.partials.photo-picker')


    {{-- Basic Information --}}
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">

        <div class="flex items-center justify-between
                    px-5 py-4
                    border-b border-slate-200 dark:border-slate-800">

            <div class="flex items-center gap-3">

                <div class="w-7 h-7
                            bg-slate-950 dark:bg-white
                            text-white dark:text-slate-950
                            flex items-center justify-center">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="square"
                            stroke-linejoin="miter"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>

                </div>

                <div>

                    <h3 class="text-[11px] font-bold uppercase tracking-[0.14em]
                               text-slate-900 dark:text-slate-100">
                        Informasi Dasar
                    </h3>

                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">
                        Detail utama yang akan ditampilkan pada listing.
                    </p>

                </div>

            </div>

            <span class="hidden sm:block font-mono text-[9px]
                         text-slate-300 dark:text-slate-700">
                REQUIRED
            </span>

        </div>


        <div class="p-5 space-y-6">

            {{-- Judul Listing --}}
            @include('livewire.pages.estates.partials.estate_forms.title-form')

            {{-- Deskripsi Listing --}}
            @include('livewire.pages.estates.partials.estate_forms.description')

            {{-- Tipe Transaksi --}}
            @include('livewire.pages.estates.partials.estate_forms.transaction-type')

            {{-- Harga --}}
            @include('livewire.pages.estates.partials.estate_forms.price')

            {{-- Jenis Listing & Tipe Properti --}}
            @include('livewire.pages.estates.partials.estate_forms.listing-and-property-type')

            {{-- Komisi & Legalitas --}}
            @include('livewire.pages.estates.partials.estate_forms.commission')

        </div>

    </div>

</div>
