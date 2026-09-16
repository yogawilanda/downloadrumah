{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eaywilanda@gmail.com>
        1. path__________________: resources/views/livewire/pages/home/sections/hero.blade.php
        2. controller____________:
        <livewire:pages.home.guest-intent-controller />
        3. view_dependency_______:
        <livewire:pages.home.home-feed />
        4. usage_________________: DownloadRumah — Guest Intent Experience
        5. type__________________: Livewire View
        6. expected_data_________: [intent, step, propertyType, searchState, location, budget, purpose]
        7. purpose_______________: Render the guest intent discovery flow and expose matching inputs through the Hero
        UI.
        8. ruling________________: State and business logic reside in GuestIntentController; semantic mapping resides in
        GuestIntentMap.
        9. ruling_structure______: Guest Intent Controller → Hero View → Guest Intent Map
        10. status_______________: Active
</meta_config>
------------------- For Blade With Params ----------------------
--}}

<x-layouts.structural-section framed class="border-b border-slate-300 bg-slate-200/20">

    <div class="bg-slate-100 px-5 py-14 sm:px-8 md:px-12 md:py-20 lg:px-14">

        {{-- ============================================================
        HERO
        ============================================================= --}}

        @include('livewire.pages.home.sections.hero-title')


        {{-- ============================================================
        MATCHING SURFACE
        ============================================================= --}}

        <div class="mx-auto mt-12 max-w-5xl">

            {{-- Label --}}

            <x-atoms.labels.section-label value=" Mulai dari sini" />



            {{-- ========================================================
            TABS Case Close
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

            <div class="border-x border-b border-slate-300 bg-white">

                {{-- ====================================================
                STEP 1 — INITIAL INTENT
                ===================================================== --}}

                @if ($step === 1)

                <div class="p-6 sm:p-8 md:p-10">

                    <div class="max-w-2xl">
                        <x-atoms.labels.eyebrow value="DownloadRumah" />

                        <h2 class="mt-2 text-xl font-black tracking-[-0.025em] text-slate-950 sm:text-2xl">
                            {{ $intent === 'search' ? 'Apa yang sedang kamu butuhkan?' : 'Apa yang ingin kamu tawarkan?'
                            }}
                        </h2>
                    </div>
                    @if ($intent === 'search')
                    <div class="mt-8 grid grid-cols-1 gap-2 sm:grid-cols-2">
                        @foreach ($this->searchStates as $value => $state)
                        <x-atoms.buttons.outlined :value="$state['label']"
                            wire:click="selectSearchState('{{ $value }}')" />
                        @endforeach
                    </div>
                    @else
                    <div class="mt-8 grid grid-cols-2 gap-2 sm:grid-cols-4">
                        @foreach ($this->propertyTypes as $value => $property)
                        <button type="button" wire:click="selectPropertyType('{{ $value }}')"
                            class="border border-slate-300 bg-slate-50 px-4 py-5 text-left transition-all hover:border-slate-950 hover:bg-white">
                            <span class="block text-sm font-black text-slate-950">
                                {{ $property['label'] }}
                            </span>
                            <span class="mt-1 block text-xs text-slate-400">
                                Pilih →
                            </span>
                        </button>
                        @endforeach
                    </div>
                    @endif

                </div>


                {{-- ====================================================
                STEP 2 — PROPERTY TYPE
                ===================================================== --}}
                @elseif ($step === 2)
                <div class="p-6 sm:p-8 md:p-10">

                    <x-atoms.buttons.back wire:click="back" />

                    <div class="max-w-2xl">

                        <x-atoms.labels.eyebrow value="DownloadRumah" />

                        <h2 class="mt-2 text-xl font-black tracking-[-0.025em] text-slate-950 sm:text-2xl">
                            Oke. Kamu sedang mencari apa?
                        </h2>

                    </div>


                    <div class="mt-8 grid grid-cols-2 gap-2 sm:grid-cols-4">

                        @foreach ($this->propertyTypes as $value => $property)
                        <button type="button" wire:click="selectPropertyType('{{ $value }}')"
                            class="border border-slate-300 bg-slate-50 px-4 py-5 text-left transition-all hover:border-slate-950 hover:bg-white">
                            <span class="block text-sm font-black text-slate-950">
                                {{ $property['label'] }}
                            </span>

                            <span class="mt-1 block text-xs text-slate-400">
                                Pilih →
                            </span>
                        </button>
                        @endforeach

                    </div>

                </div>


                {{-- ====================================================
                STEP 3 — LOCATION
                ===================================================== --}}
                @elseif ($step === 3)
                <div class="p-6 sm:p-8 md:p-10">

                    <x-atoms.buttons.back wire:click="back" />

                    <div class="max-w-2xl">

                        <x-atoms.labels.eyebrow value="DownloadRumah" />

                        <h2 class="mt-2 text-xl font-black tracking-[-0.025em] text-slate-950 sm:text-2xl">
                            {{ $intent === 'search' ? 'Di mana kamu mencarinya?' : 'Di mana properti ini berada?' }}
                        </h2>

                    </div>


                    <div class="mt-8 max-w-xl">

                        <label class="mb-2 block text-xs font-bold text-slate-600">
                            Lokasi
                        </label>

                        <input type="text" wire:model="location" wire:keydown.enter="continueToBudget"
                            placeholder="Contoh: Surabaya, Sidoarjo, Malang..."
                            class="w-full border border-slate-300 bg-slate-50 px-4 py-4 text-sm font-medium text-slate-950 outline-none transition focus:border-slate-950 focus:bg-white">

                    </div>


                    <div class="mt-6 flex justify-end">
                        <x-atoms.buttons.outlined value="Lanjut →" wire:click="continueToBudget"
                            class="w-auto bg-slate-950 px-5 py-3.5 text-xs font-bold text-white hover:bg-slate-800" />
                    </div>

                </div>


                {{-- ====================================================
                STEP 4 — BUDGET / PRICE
                ===================================================== --}}
                @elseif ($step === 4)
                <div class="p-6 sm:p-8 md:p-10">

                    <x-atoms.buttons.back wire:click="back" />

                    <div class="max-w-2xl">

                        <x-atoms.labels.eyebrow value="DownloadRumah" />

                        <h2 class="mt-2 text-xl font-black tracking-[-0.025em] text-slate-950 sm:text-2xl">
                            {{ $intent === 'search' ? 'Berapa kisaran budgetmu?' : 'Berapa harga yang kamu tawarkan?' }}
                        </h2>

                    </div>


                    <div class="mt-8 max-w-xl">

                        <label class="mb-2 block text-xs font-bold text-slate-600">
                            {{ $intent === 'search' ? 'Budget' : 'Harga' }}
                        </label>

                        <div class="relative">

                            <span class="absolute inset-y-0 left-4 flex items-center text-sm font-bold text-slate-400">
                                Rp
                            </span>

                            <input type="text" wire:model="budget" wire:keydown.enter="continueToPurpose"
                                placeholder="500.000.000"
                                class="w-full border border-slate-300 bg-slate-50 py-4 pl-12 pr-4 text-sm font-medium text-slate-950 outline-none transition focus:border-slate-950 focus:bg-white">

                        </div>

                    </div>


                    <div class="mt-6 flex justify-end">
                        <x-atoms.buttons.outlined value="Lanjut →" wire:click="continueToPurpose"
                            class="w-auto bg-slate-950 px-5 py-3.5 text-xs font-bold text-white hover:bg-slate-800" />
                    </div>

                </div>


                {{-- ====================================================
                STEP 5 — PURPOSE
                ===================================================== --}}
                @elseif ($step === 5)
                <div class="p-6 sm:p-8 md:p-10">

                    <x-atoms.buttons.back wire:click="back" />

                    <div class="max-w-2xl">

                        <x-atoms.labels.eyebrow value="DownloadRumah" />

                        <h2 class="mt-2 text-xl font-black tracking-[-0.025em] text-slate-950 sm:text-2xl">
                            {{ $intent === 'search' ? 'Apa yang paling penting buatmu?' : 'Menurutmu properti ini cocok
                            untuk siapa?' }}
                        </h2>

                        <p class="mt-2 text-sm font-medium leading-6 text-slate-500">
                            Pilih yang paling menggambarkan kebutuhanmu.
                        </p>

                    </div>


                    <div class="mt-8 grid grid-cols-1 gap-2 sm:grid-cols-2">

                        @foreach ($this->purposes as $value => $purpose)
                        <x-atoms.buttons.outlined :value="$purpose['label']"
                            wire:click="selectPurpose('{{ $value }}')" />
                        @endforeach

                    </div>

                </div>
                @elseif ($step === 6)
                <div class="p-6 sm:p-8 md:p-10">

                    <div class="max-w-2xl">

                        <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-sky-600">
                            Kebutuhanmu
                        </span>

                        <h2 class="mt-2 text-2xl font-black tracking-[-0.03em] text-slate-950 sm:text-3xl">
                            Sudah cukup jelas.
                        </h2>

                        <p class="mt-3 text-sm font-medium leading-6 text-slate-500">
                            Ini yang akan kami gunakan untuk menemukan kecocokan.
                        </p>

                    </div>


                    <div class="mt-8 divide-y divide-slate-200 border-y border-slate-200">

                        <div class="flex items-center justify-between gap-6 py-4">

                            <span class="text-xs font-bold text-slate-400">
                                Tujuan
                            </span>

                            <span class="text-right text-sm font-bold text-slate-950">
                                {{ $this->intentLabel }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-6 py-4">

                            <span class="text-xs font-bold text-slate-400">
                                Properti
                            </span>

                            <span class="text-right text-sm font-bold text-slate-950">
                                {{ $this->propertyLabel }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-6 py-4">

                            <span class="text-xs font-bold text-slate-400">
                                Lokasi
                            </span>

                            <span class="text-right text-sm font-bold text-slate-950">
                                {{ $location }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-6 py-4">

                            <span class="text-xs font-bold text-slate-400">
                                {{ $intent === 'search' ? 'Budget' : 'Harga' }}
                            </span>

                            <span class="text-right text-sm font-bold text-slate-950">
                                Rp {{ $budget }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-6 py-4">

                            <span class="text-xs font-bold text-slate-400">
                                Prioritas
                            </span>

                            <span class="text-right text-sm font-bold text-slate-950">
                                {{ $this->purposeLabel }}
                            </span>

                        </div>

                    </div>


                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <button type="button" wire:click="resetMatching"
                            class="text-xs font-bold text-slate-400 hover:text-slate-950">
                            Ubah kebutuhan
                        </button>


                        <button type="button" wire:click="submit"
                            class="bg-slate-950 px-6 py-4 text-xs font-black text-white transition hover:bg-slate-800">
                            Lihat yang cocok →
                        </button>

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
