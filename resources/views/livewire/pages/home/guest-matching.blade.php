{{-- ----------- Yoga Wilanda Documentation v1.2.1 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
        1. path__________________: resources/views/livewire/pages/home/guest-matching.blade.php
        2. controller____________:
        <livewire:pages.home.guest-matching />
        3. usage_________________: DownloadRumah — Guest Matching Experience
        4. type__________________: Livewire View
        5. expected_data_________: [intent, step, propertyType, searchState,
        location, budget, purpose, showResults]
        6. purpose_______________: Render the progressive guest matching flow
        and matching results.
        7. ruling________________: State and business logic reside in GuestMatching;
        semantic mapping resides in GuestIntentMap;
        matching logic resides in GuestMatchingService.
        8. ruling_structure______: Discovery Gateway → Minimum Intent → Optional Refinement
        → Matching Results
        9. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div class="min-h-[70vh] bg-slate-100 px-5 py-14 dark:bg-slate-950 sm:px-8 md:px-12 md:py-20 lg:px-14">

    <div class="mx-auto max-w-5xl">

        {{-- MATCHING SURFACE --}}

        <div class="border border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900">

            {{-- ====================================================
            MATCHING RESULTS
            ===================================================== --}}

            @if ($showResults)

            <div class="p-6 sm:p-8 md:p-10">

                <div class="max-w-2xl">

                    <flux:text variant="subtle" class="text-[10px] font-bold uppercase tracking-[0.15em]">
                        Hasil pencarian
                    </flux:text>

                    @if (count($matchingResults) > 0)

                    <flux:heading size="xl" class="mt-2">
                        {{ count($matchingResults) }} properti ditemukan.
                    </flux:heading>

                    <flux:text variant="subtle" class="mt-3 block">
                        Kami menemukan properti berdasarkan kebutuhan yang kamu berikan.
                    </flux:text>

                    @else

                    <flux:heading size="xl" class="mt-2">
                        Belum menemukan yang cocok.
                    </flux:heading>

                    <flux:text variant="subtle" class="mt-3 block">
                        Belum ada properti yang memenuhi kriteria pencarianmu saat ini.
                    </flux:text>

                    @endif

                </div>


                {{-- RESULTS --}}

                @if (count($matchingResults) > 0)

                <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">

                    @foreach ($matchingResults as $result)

                    @php
                    $estate = $result['estate'];
                    @endphp

                    <div
                        class="overflow-hidden border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950">

                        {{-- IMAGE --}}

                        @if ($estate->primaryImage)

                        <img src="{{ Storage::url($estate->primaryImage->file_path) }}" alt="{{ $estate->title }}"
                            class="aspect-[16/10] w-full object-cover">

                        @else

                        <div
                            class="flex aspect-[16/10] items-center justify-center bg-slate-100 text-xs text-slate-400 dark:bg-slate-900">
                            Tidak ada foto
                        </div>

                        @endif


                        {{-- CONTENT --}}

                        <div class="p-5">

                            <flux:heading size="sm">
                                {{ $estate->title }}
                            </flux:heading>

                            <div class="mt-2 text-lg font-black text-slate-950 dark:text-slate-100">
                                Rp {{ number_format($estate->price, 0, ',', '.') }}
                            </div>

                            <div class="mt-2 text-xs font-medium text-slate-400">
                                {{ $estate->property_type }}
                            </div>


                            {{-- EVIDENCE --}}

                            @if (!empty($result['evidence']['unverified']))

                            <div class="mt-4 border-t border-slate-100 pt-4 dark:border-slate-800">

                                <div class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                    Catatan
                                </div>

                                @foreach ($result['evidence']['unverified'] as $message)

                                <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                    {{ $message }}
                                </p>

                                @endforeach

                            </div>

                            @endif

                        </div>

                    </div>

                    @endforeach

                </div>

                @else

                {{-- EMPTY STATE --}}

                <div class="mt-8 border border-dashed border-slate-300 p-8 dark:border-slate-700">

                    <flux:text variant="subtle">
                        Coba ubah lokasi, jenis properti, atau budget untuk melihat kemungkinan
                        kecocokan lainnya.
                    </flux:text>

                </div>

                @endif


                {{-- ACTIONS --}}

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <flux:button variant="ghost" size="sm" wire:click="resetMatching"
                        class="text-slate-400 hover:text-slate-950 dark:hover:text-slate-100">
                        Mulai lagi
                    </flux:button>

                </div>

            </div>


            {{-- ====================================================
            STEP 1 — INITIAL INTENT
            ===================================================== --}}

            @elseif ($step === 1)

            <div class="p-6 sm:p-8 md:p-10">

                <div class="max-w-2xl">

                    <flux:text variant="subtle" class="text-[10px] font-bold uppercase tracking-[0.15em]">
                        DownloadRumah
                    </flux:text>

                    <flux:heading size="lg" class="mt-2">
                        {{ $intent === 'search'
                        ? 'Apa yang sedang kamu butuhkan?'
                        : 'Apa yang ingin kamu tawarkan?' }}
                    </flux:heading>

                </div>


                @if ($intent === 'search')

                <div class="mt-8 grid grid-cols-1 gap-2 sm:grid-cols-2">

                    @foreach ($this->searchStates as $value => $state)

                    <flux:button wire:click="selectSearchState('{{ $value }}')" variant="outline" align="start"
                        class="w-full justify-between">
                        {{ $state['label'] }}

                        <x-slot:icon-trailing>
                            →
                        </x-slot:icon-trailing>
                    </flux:button>

                    @endforeach

                </div>

                @else

                <div class="mt-8 grid grid-cols-2 gap-2 sm:grid-cols-4">

                    @foreach ($this->propertyTypes as $value => $property)

                    <flux:button wire:click="selectPropertyType('{{ $value }}')" variant="outline" align="start"
                        class="h-auto min-h-24 w-full flex-col items-start justify-between py-5">
                        <span class="text-sm font-black text-slate-950 dark:text-slate-100">
                            {{ $property['label'] }}
                        </span>

                        <span class="text-xs font-medium text-slate-400 dark:text-slate-500">
                            Pilih →
                        </span>
                    </flux:button>

                    @endforeach

                </div>

                @endif

            </div>


            {{-- ====================================================
            STEP 2 — PROPERTY TYPE
            ===================================================== --}}

            @elseif ($step === 2)

            <div class="p-6 sm:p-8 md:p-10">

                <flux:button variant="ghost" size="sm" wire:click="back"
                    class="mb-6 -ms-2 text-slate-400 hover:text-slate-950 dark:hover:text-slate-100">
                    ← Kembali
                </flux:button>


                <div class="max-w-2xl">

                    <flux:text variant="subtle" class="text-[10px] font-bold uppercase tracking-[0.15em]">
                        DownloadRumah
                    </flux:text>

                    <flux:heading size="lg" class="mt-2">
                        Oke. Kamu sedang mencari apa?
                    </flux:heading>

                </div>


                <div class="mt-8 grid grid-cols-2 gap-2 sm:grid-cols-4">

                    @foreach ($this->propertyTypes as $value => $property)

                    <flux:button wire:click="selectPropertyType('{{ $value }}')" variant="outline" align="start"
                        class="h-auto min-h-24 w-full flex-col items-start justify-between py-5">
                        <span class="text-sm font-black text-slate-950 dark:text-slate-100">
                            {{ $property['label'] }}
                        </span>

                        <span class="text-xs font-medium text-slate-400 dark:text-slate-500">
                            Pilih →
                        </span>
                    </flux:button>

                    @endforeach

                </div>

            </div>


            {{-- ====================================================
            STEP 3 — LOCATION
            ===================================================== --}}

            @elseif ($step === 3)

            <div class="p-6 sm:p-8 md:p-10">

                <flux:button variant="ghost" size="sm" wire:click="back"
                    class="mb-6 -ms-2 text-slate-400 hover:text-slate-950 dark:hover:text-slate-100">
                    ← Kembali
                </flux:button>


                <div class="max-w-2xl">

                    <flux:text variant="subtle" class="text-[10px] font-bold uppercase tracking-[0.15em]">
                        DownloadRumah
                    </flux:text>

                    <flux:heading size="lg" class="mt-2">
                        {{ $intent === 'search'
                        ? 'Di mana kamu mencarinya?'
                        : 'Di mana properti ini berada?' }}
                    </flux:heading>

                </div>


                <div class="mt-8 max-w-xl">

                    <flux:field>

                        <flux:label>
                            Lokasi
                        </flux:label>

                        <flux:input wire:model="location" wire:keydown.enter="continueToBudget"
                            placeholder="Contoh: Surabaya, Sidoarjo, Malang..." />

                    </flux:field>

                </div>


                {{-- PROGRESSIVE CHOICE --}}

                <div class="mt-8 border-t border-slate-200 pt-6 dark:border-slate-800">

                    <div class="max-w-xl">

                        <flux:text variant="subtle" class="text-xs">
                            Kamu sudah memberikan informasi yang cukup untuk mulai mencari.
                        </flux:text>

                    </div>


                    <div class="mt-5 flex flex-col gap-2 sm:flex-row sm:justify-end">

                        <flux:button variant="ghost" wire:click="submit">
                            Lihat properti sekarang
                        </flux:button>

                        <flux:button variant="primary" wire:click="continueToBudget">
                            Persempit pencarian

                            <x-slot:icon-trailing>
                                →
                            </x-slot:icon-trailing>
                        </flux:button>

                    </div>

                </div>

            </div>


            {{-- ====================================================
            STEP 4 — BUDGET / PRICE
            ===================================================== --}}

            @elseif ($step === 4)

            <div class="p-6 sm:p-8 md:p-10">

                <flux:button variant="ghost" size="sm" wire:click="back"
                    class="mb-6 -ms-2 text-slate-400 hover:text-slate-950 dark:hover:text-slate-100">
                    ← Kembali
                </flux:button>


                <div class="max-w-2xl">

                    <flux:text variant="subtle" class="text-[10px] font-bold uppercase tracking-[0.15em]">
                        DownloadRumah
                    </flux:text>

                    <flux:heading size="lg" class="mt-2">
                        {{ $intent === 'search'
                        ? 'Berapa kisaran budgetmu?'
                        : 'Berapa harga yang kamu tawarkan?' }}
                    </flux:heading>

                </div>


                <div class="mt-8 max-w-xl">

                    <flux:field>

                        <flux:label>
                            {{ $intent === 'search' ? 'Budget' : 'Harga' }}
                        </flux:label>

                        <flux:input wire:model="budget" wire:keydown.enter="continueToPurpose" placeholder="500.000.000"
                            type="text">
                            <x-slot:prefix>
                                Rp
                            </x-slot:prefix>
                        </flux:input>

                    </flux:field>

                </div>


                <div class="mt-6 flex justify-end">

                    <flux:button variant="primary" wire:click="continueToPurpose">
                        Lanjut

                        <x-slot:icon-trailing>
                            →
                        </x-slot:icon-trailing>
                    </flux:button>

                </div>

            </div>


            {{-- ====================================================
            STEP 5 — PURPOSE
            ===================================================== --}}

            @elseif ($step === 5)

            <div class="p-6 sm:p-8 md:p-10">

                <flux:button variant="ghost" size="sm" wire:click="back"
                    class="mb-6 -ms-2 text-slate-400 hover:text-slate-950 dark:hover:text-slate-100">
                    ← Kembali
                </flux:button>


                <div class="max-w-2xl">

                    <flux:text variant="subtle" class="text-[10px] font-bold uppercase tracking-[0.15em]">
                        DownloadRumah
                    </flux:text>

                    <flux:heading size="lg" class="mt-2">
                        {{ $intent === 'search'
                        ? 'Apa yang paling penting buatmu?'
                        : 'Menurutmu properti ini cocok untuk siapa?' }}
                    </flux:heading>

                    <flux:text variant="subtle" class="mt-2 block">
                        Pilih yang paling menggambarkan kebutuhanmu.
                    </flux:text>

                </div>


                <div class="mt-8 grid grid-cols-1 gap-2 sm:grid-cols-2">

                    @foreach ($this->purposes as $value => $purpose)

                    <flux:button wire:click="selectPurpose('{{ $value }}')" variant="outline" align="start"
                        class="w-full justify-between">
                        {{ $purpose['label'] }}

                        <x-slot:icon-trailing>
                            →
                        </x-slot:icon-trailing>
                    </flux:button>

                    @endforeach

                </div>

            </div>


            {{-- ====================================================
            STEP 6 — SUMMARY
            ===================================================== --}}

            @elseif ($step === 6)

            <div class="p-6 sm:p-8 md:p-10">

                <div class="max-w-2xl">

                    <flux:text variant="subtle"
                        class="text-[10px] font-bold uppercase tracking-[0.15em] text-sky-600 dark:text-sky-400">
                        Kebutuhanmu
                    </flux:text>

                    <flux:heading size="xl" class="mt-2">
                        Sudah cukup jelas.
                    </flux:heading>

                    <flux:text variant="subtle" class="mt-3 block">
                        Ini yang akan kami gunakan untuk menemukan kecocokan.
                    </flux:text>

                </div>


                <div
                    class="mt-8 divide-y divide-slate-200 border-y border-slate-200 dark:divide-slate-800 dark:border-slate-800">

                    <div class="flex items-center justify-between gap-6 py-4">

                        <span class="text-xs font-bold text-slate-400">
                            Tujuan
                        </span>

                        <span class="text-right text-sm font-bold text-slate-950 dark:text-slate-100">
                            {{ $this->intentLabel }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-6 py-4">

                        <span class="text-xs font-bold text-slate-400">
                            Properti
                        </span>

                        <span class="text-right text-sm font-bold text-slate-950 dark:text-slate-100">
                            {{ $this->propertyLabel }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-6 py-4">

                        <span class="text-xs font-bold text-slate-400">
                            Lokasi
                        </span>

                        <span class="text-right text-sm font-bold text-slate-950 dark:text-slate-100">
                            {{ $location }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-6 py-4">

                        <span class="text-xs font-bold text-slate-400">
                            {{ $intent === 'search' ? 'Budget' : 'Harga' }}
                        </span>

                        <span class="text-right text-sm font-bold text-slate-950 dark:text-slate-100">
                            Rp {{ $budget }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-6 py-4">

                        <span class="text-xs font-bold text-slate-400">
                            Prioritas
                        </span>

                        <span class="text-right text-sm font-bold text-slate-950 dark:text-slate-100">
                            {{ $this->purposeLabel }}
                        </span>

                    </div>

                </div>


                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <flux:button variant="ghost" size="sm" wire:click="resetMatching"
                        class="text-slate-400 hover:text-slate-950 dark:hover:text-slate-100">
                        Ubah kebutuhan
                    </flux:button>


                    <flux:button variant="primary" wire:click="submit">
                        Lihat yang cocok

                        <x-slot:icon-trailing>
                            →
                        </x-slot:icon-trailing>
                    </flux:button>

                </div>

            </div>

            @endif

        </div>


        {{-- ========================================================
        STATUS
        ========================================================= --}}

        @unless ($showResults)

        <div class="mt-4 flex items-center justify-between">

            <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                {{ $step }} / 6
            </span>

            <span class="text-[10px] font-medium text-slate-400">
                {{ $this->intentLabel }}
            </span>

        </div>

        @endunless


    </div>

</div>
