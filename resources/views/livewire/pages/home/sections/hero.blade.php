{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogwilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/home/sections/hero.blade.php
    2. controller____________: <livewire:pages.home.guest-intent-controller />
    3. view_dependency_______: <livewire:pages.home.home-feed />
    4. usage_________________: DownloadRumah — Guest Intent Experience
    5. type__________________: Livewire View
    6. expected_data_________: [intent, step, propertyType, searchState, location, budget, purpose]
    7. purpose_______________: Render the guest intent discovery flow and expose matching inputs through the Hero UI.
    8. ruling________________: State and business logic reside in GuestIntentController; semantic mapping resides in GuestIntentMap.
    9. ruling_structure______: Guest Intent Controller → Hero View → Guest Intent Map
    10. status_______________: Active
</meta_config>
------------------- For Blade With Params ----------------------
--}}

<x-layouts.structural-section
    framed
    class="border-b border-slate-300 bg-slate-200/20 dark:border-slate-800 dark:bg-slate-900/20"
>

    <div class="bg-slate-100 px-5 py-14 dark:bg-slate-950 sm:px-8 md:px-12 md:py-20 lg:px-14">

        {{-- ============================================================
        HERO
        ============================================================= --}}

        @include('livewire.pages.home.sections.hero-title')


        {{-- ============================================================
        MATCHING SURFACE
        ============================================================= --}}

        <div class="mx-auto mt-12 max-w-5xl">

            <x-atoms.labels.section-label value="Mulai dari sini" />


            {{-- ========================================================
            TABS
            ========================================================= --}}

            <x-widgets.tabs.tabs :items="[
                [
                    'label' => 'Saya mencari',
                    'value' => 'Properti',
                    'action' => 'setIntent',
                    'parameter' => 'search',
                    'active' => $intent === 'search',
                ],
                [
                    'label' => 'Saya punya',
                    'value' => 'Properti',
                    'action' => 'setIntent',
                    'parameter' => 'offer',
                    'active' => $intent === 'offer',
                ],
            ]" />


            <div class="border-x border-b border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900">

                {{-- ====================================================
                STEP 1 — INITIAL INTENT
                ===================================================== --}}

                @if ($step === 1)

                    <div class="p-6 sm:p-8 md:p-10">

                        <div class="max-w-2xl">

                            <flux:text
                                variant="subtle"
                                class="text-[10px] font-bold uppercase tracking-[0.15em]"
                            >
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

                                    <flux:button
                                        wire:click="selectSearchState('{{ $value }}')"
                                        variant="outline"
                                        align="start"
                                        class="w-full justify-between"
                                    >
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

                                    <flux:button
                                        wire:click="selectPropertyType('{{ $value }}')"
                                        variant="outline"
                                        align="start"
                                        class="h-auto min-h-24 w-full flex-col items-start justify-between py-5"
                                    >
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

                        <flux:button
                            variant="ghost"
                            size="sm"
                            wire:click="back"
                            class="mb-6 -ms-2 text-slate-400 hover:text-slate-950 dark:hover:text-slate-100"
                        >
                            ← Kembali
                        </flux:button>


                        <div class="max-w-2xl">

                            <flux:text
                                variant="subtle"
                                class="text-[10px] font-bold uppercase tracking-[0.15em]"
                            >
                                DownloadRumah
                            </flux:text>

                            <flux:heading size="lg" class="mt-2">
                                Oke. Kamu sedang mencari apa?
                            </flux:heading>

                        </div>


                        <div class="mt-8 grid grid-cols-2 gap-2 sm:grid-cols-4">

                            @foreach ($this->propertyTypes as $value => $property)

                                <flux:button
                                    wire:click="selectPropertyType('{{ $value }}')"
                                    variant="outline"
                                    align="start"
                                    class="h-auto min-h-24 w-full flex-col items-start justify-between py-5"
                                >
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

                        <flux:button
                            variant="ghost"
                            size="sm"
                            wire:click="back"
                            class="mb-6 -ms-2 text-slate-400 hover:text-slate-950 dark:hover:text-slate-100"
                        >
                            ← Kembali
                        </flux:button>


                        <div class="max-w-2xl">

                            <flux:text
                                variant="subtle"
                                class="text-[10px] font-bold uppercase tracking-[0.15em]"
                            >
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

                                <flux:input
                                    wire:model="location"
                                    wire:keydown.enter="continueToBudget"
                                    placeholder="Contoh: Surabaya, Sidoarjo, Malang..."
                                />

                            </flux:field>

                        </div>


                        <div class="mt-6 flex justify-end">

                            <flux:button
                                variant="primary"
                                wire:click="continueToBudget"
                            >
                                Lanjut →

                                <x-slot:icon-trailing>
                                    →
                                </x-slot:icon-trailing>
                            </flux:button>

                        </div>

                    </div>


                {{-- ====================================================
                STEP 4 — BUDGET / PRICE
                ===================================================== --}}

                @elseif ($step === 4)

                    <div class="p-6 sm:p-8 md:p-10">

                        <flux:button
                            variant="ghost"
                            size="sm"
                            wire:click="back"
                            class="mb-6 -ms-2 text-slate-400 hover:text-slate-950 dark:hover:text-slate-100"
                        >
                            ← Kembali
                        </flux:button>


                        <div class="max-w-2xl">

                            <flux:text
                                variant="subtle"
                                class="text-[10px] font-bold uppercase tracking-[0.15em]"
                            >
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

                                <flux:input
                                    wire:model="budget"
                                    wire:keydown.enter="continueToPurpose"
                                    placeholder="500.000.000"
                                    type="text"
                                >
                                    <x-slot:prefix>
                                        Rp
                                    </x-slot:prefix>
                                </flux:input>

                            </flux:field>

                        </div>


                        <div class="mt-6 flex justify-end">

                            <flux:button
                                variant="primary"
                                wire:click="continueToPurpose"
                            >
                                Lanjut →

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

                        <flux:button
                            variant="ghost"
                            size="sm"
                            wire:click="back"
                            class="mb-6 -ms-2 text-slate-400 hover:text-slate-950 dark:hover:text-slate-100"
                        >
                            ← Kembali
                        </flux:button>


                        <div class="max-w-2xl">

                            <flux:text
                                variant="subtle"
                                class="text-[10px] font-bold uppercase tracking-[0.15em]"
                            >
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

                                <flux:button
                                    wire:click="selectPurpose('{{ $value }}')"
                                    variant="outline"
                                    align="start"
                                    class="w-full justify-between"
                                >
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

                            <flux:text
                                variant="subtle"
                                class="text-[10px] font-bold uppercase tracking-[0.15em] text-sky-600 dark:text-sky-400"
                            >
                                Kebutuhanmu
                            </flux:text>

                            <flux:heading size="xl" class="mt-2">
                                Sudah cukup jelas.
                            </flux:heading>

                            <flux:text variant="subtle" class="mt-3 block">
                                Ini yang akan kami gunakan untuk menemukan kecocokan.
                            </flux:text>

                        </div>


                        <div class="mt-8 divide-y divide-slate-200 border-y border-slate-200 dark:divide-slate-800 dark:border-slate-800">

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

                            <flux:button
                                variant="ghost"
                                size="sm"
                                wire:click="resetMatching"
                                class="text-slate-400 hover:text-slate-950 dark:hover:text-slate-100"
                            >
                                Ubah kebutuhan
                            </flux:button>


                            <flux:button
                                variant="primary"
                                wire:click="submit"
                            >
                                Lihat yang cocok →

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

            <div class="mt-4 flex items-center justify-between">

                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                    {{ $step }} / 6
                </span>

                <span class="text-[10px] font-medium text-slate-400">
                    {{ $this->intentLabel }}
                </span>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
