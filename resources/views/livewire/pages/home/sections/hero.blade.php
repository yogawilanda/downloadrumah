
{{-- resources/views/livewire/pages/home/sections/hero.blade.php --}}
{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @version             : v1.1.6
| @path                : resources/views/livewire/pages/home/sections/hero.blade.php
| @usage               : DownloadRumah — Guest Intent Experience / Hero
| @type                : Livewire View
| @expected_data       : [intent, step, propertyType, searchState, location, budget, purpose]
| @purpose             : Render the guest intent discovery flow and expose matching inputs through the Hero UI.
| @ruling              : State and business logic reside in GuestIntentController; semantic mapping resides in GuestIntentMap.
| @ruling_structure    : Guest Intent Controller → Hero View → Guest Intent Map
| @status               : Active / Refactored
| @author               : yogawilanda <eaywilanda@gmail.com>
</meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div class="mx-auto max-w-2xl space-y-8 p-6">

    <div class="flex border border-slate-300">
        <button type="button" wire:click="setIntent('search')"
            class="flex-1 px-4 py-3 text-sm font-semibold {{ $intent === 'search' ? 'bg-slate-950 text-white' : 'bg-white text-slate-600 hover:bg-slate-50' }}">
            {{ $this->intentMap['intents']['search']['label'] }}
        </button>

        <button type="button" wire:click="setIntent('offer')"
            class="flex-1 border-l border-slate-300 px-4 py-3 text-sm font-semibold {{ $intent === 'offer' ? 'bg-slate-950 text-white' : 'bg-white text-slate-600 hover:bg-slate-50' }}">
            {{ $this->intentMap['intents']['offer']['label'] }}
        </button>
    </div>

    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        {{-- STEP 1 --}}
        @if ($step === 1)
            <div class="space-y-6">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Mulai
                    </span>

                    <h2 class="mt-2 text-xl font-bold text-slate-950">
                        {{ $intent === 'search' ? 'Apa yang sedang kamu butuhkan?' : 'Apa yang ingin kamu tawarkan?' }}
                    </h2>
                </div>

                @if ($intent === 'search')
                    <div class="space-y-2">
                        @foreach ($this->searchStates as $value => $state)
                            <button type="button" wire:click="selectSearchState('{{ $value }}')"
                                class="flex w-full items-center justify-between rounded-md border border-slate-200 bg-slate-50 px-4 py-3.5 text-left text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-white">
                                <span>{{ $state['label'] }}</span>
                                <span class="text-slate-400">→</span>
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($this->propertyTypes as $value => $property)
                            <button type="button" wire:click="selectPropertyType('{{ $value }}')"
                                class="rounded-md border border-slate-200 bg-slate-50 px-4 py-4 text-left text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-white">
                                {{ $property['label'] }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

        {{-- STEP 2 --}}
        @elseif ($step === 2)
            <div class="space-y-6">
                <button type="button" wire:click="back"
                    class="text-xs font-semibold text-slate-400 hover:text-slate-950">
                    ← Kembali
                </button>

                <div>
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Berikutnya
                    </span>

                    <h2 class="mt-2 text-xl font-bold text-slate-950">
                        Oke. Kamu sedang mencari apa?
                    </h2>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    @foreach ($this->propertyTypes as $value => $property)
                        <button type="button" wire:click="selectPropertyType('{{ $value }}')"
                            class="rounded-md border border-slate-200 bg-slate-50 px-4 py-4 text-left text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-white">
                            {{ $property['label'] }}
                        </button>
                    @endforeach
                </div>
            </div>

        {{-- STEP 3 --}}
        @elseif ($step === 3)
            <div class="space-y-6">
                <button type="button" wire:click="back"
                    class="text-xs font-semibold text-slate-400 hover:text-slate-950">
                    ← Kembali
                </button>

                <div>
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Lokasi
                    </span>

                    <h2 class="mt-2 text-xl font-bold text-slate-950">
                        {{ $intent === 'search' ? 'Di mana kamu mencarinya?' : 'Di mana properti ini berada?' }}
                    </h2>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">
                        Lokasi
                    </label>

                    <input type="text" wire:model="location" wire:keydown.enter="continueToBudget"
                        placeholder="Contoh: Surabaya, Sidoarjo, Malang..."
                        class="w-full rounded-md border border-slate-300 bg-slate-50 px-4 py-3.5 text-sm text-slate-950 outline-none placeholder:text-slate-400 focus:border-slate-950 focus:bg-white">
                </div>

                <div class="flex justify-end">
                    <button type="button" wire:click="continueToBudget"
                        class="rounded-md bg-slate-950 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                        Lanjut →
                    </button>
                </div>
            </div>

        {{-- STEP 4 --}}
        @elseif ($step === 4)
            <div class="space-y-6">
                <button type="button" wire:click="back"
                    class="text-xs font-semibold text-slate-400 hover:text-slate-950">
                    ← Kembali
                </button>

                <div>
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Budget
                    </span>

                    <h2 class="mt-2 text-xl font-bold text-slate-950">
                        {{ $intent === 'search' ? 'Berapa kisaran budgetmu?' : 'Berapa harga yang kamu tawarkan?' }}
                    </h2>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">
                        {{ $intent === 'search' ? 'Budget' : 'Harga' }}
                    </label>

                    <div class="flex">
                        <span class="flex items-center rounded-l-md border border-r-0 border-slate-300 bg-slate-100 px-4 text-sm font-semibold text-slate-500">
                            Rp
                        </span>

                        <input type="text" wire:model="budget" wire:keydown.enter="continueToPurpose"
                            placeholder="500.000.000"
                            class="min-w-0 flex-1 rounded-r-md border border-slate-300 bg-slate-50 px-4 py-3.5 text-sm text-slate-950 outline-none placeholder:text-slate-400 focus:border-slate-950 focus:bg-white">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" wire:click="continueToPurpose"
                        class="rounded-md bg-slate-950 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                        Lanjut →
                    </button>
                </div>
            </div>

        {{-- STEP 5 --}}
        @elseif ($step === 5)
            <div class="space-y-6">
                <button type="button" wire:click="back"
                    class="text-xs font-semibold text-slate-400 hover:text-slate-950">
                    ← Kembali
                </button>

                <div>
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Prioritas
                    </span>

                    <h2 class="mt-2 text-xl font-bold text-slate-950">
                        {{ $intent === 'search' ? 'Apa yang paling penting buatmu?' : 'Menurutmu properti ini cocok untuk siapa?' }}
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Pilih yang paling menggambarkan kebutuhanmu.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    @foreach ($this->purposes as $value => $purpose)
                        <button type="button" wire:click="selectPurpose('{{ $value }}')"
                            class="flex items-center justify-between rounded-md border border-slate-200 bg-slate-50 px-4 py-3.5 text-left text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-white">
                            <span>{{ $purpose['label'] }}</span>
                            <span class="text-slate-400">→</span>
                        </button>
                    @endforeach
                </div>
            </div>

        {{-- STEP 6 --}}
        @elseif ($step === 6)
            <div class="space-y-6">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wide text-sky-600">
                        Selesai
                    </span>

                    <h2 class="mt-2 text-xl font-bold text-slate-950">
                        Sudah cukup jelas.
                    </h2>
                </div>

                <dl class="divide-y divide-slate-200 border-y border-slate-200">
                    <div class="flex justify-between gap-6 py-3">
                        <dt class="text-sm text-slate-500">Tujuan</dt>
                        <dd class="text-right text-sm font-semibold text-slate-950">
                            {{ $this->intentLabel }}
                        </dd>
                    </div>

                    <div class="flex justify-between gap-6 py-3">
                        <dt class="text-sm text-slate-500">Properti</dt>
                        <dd class="text-right text-sm font-semibold text-slate-950">
                            {{ $this->propertyLabel }}
                        </dd>
                    </div>

                    <div class="flex justify-between gap-6 py-3">
                        <dt class="text-sm text-slate-500">Lokasi</dt>
                        <dd class="text-right text-sm font-semibold text-slate-950">
                            {{ $location }}
                        </dd>
                    </div>

                    <div class="flex justify-between gap-6 py-3">
                        <dt class="text-sm text-slate-500">
                            {{ $intent === 'search' ? 'Budget' : 'Harga' }}
                        </dt>
                        <dd class="text-right text-sm font-semibold text-slate-950">
                            Rp {{ $budget }}
                        </dd>
                    </div>

                    <div class="flex justify-between gap-6 py-3">
                        <dt class="text-sm text-slate-500">Prioritas</dt>
                        <dd class="text-right text-sm font-semibold text-slate-950">
                            {{ $this->purposeLabel }}
                        </dd>
                    </div>
                </dl>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">
                    <button type="button" wire:click="resetMatching"
                        class="rounded-md border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                        Ubah kebutuhan
                    </button>

                    <button type="button" wire:click="submit"
                        class="rounded-md bg-slate-950 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                        Lihat yang cocok →
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

