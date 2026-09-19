{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
        1. path__________________: resources/views/livewire/pages/home/guest-matching/step-intent.blade.php
        2. usage_________________: DownloadRumah — Guest Matching Intent Step
        3. type__________________: Blade Partial
        4. expected_data_________: [intent, searchStates, propertyTypes]
        5. purpose_______________: Render the initial guest matching intent
        selection based on the selected gateway intent.
        6. ruling________________: Presentation only. State and transitions
        remain in GuestMatching.
        7. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

@if ($intent === 'search')
    {{-- phase 1. User identification journey. answer : on GuestIntentMap.php  --}}
    <div class="space-y-6">

        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                Gambarkan kondisimu saat ini.
            </h1>

            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                Pilih yang paling sesuai dengan kondisi pencarianmu.
            </p>
        </div>

        <div class="space-y-3">
            @foreach ($this->searchStates as $key => $state)

                <flux:button
                    wire:click="selectSearchState('{{ $key }}')"
                    variant="outline"
                    class="w-full justify-start"
                >
                    {{ $state['label'] }}
                </flux:button>

            @endforeach
        </div>

    </div>

@elseif ($intent === 'offer')

    <div class="space-y-6">

        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                Properti apa yang kamu punya?
            </h1>

            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                Pilih jenis properti yang ingin kamu tawarkan.
            </p>
        </div>

        <div class="space-y-3">
            @foreach ($this->propertyTypes as $key => $property)

                <flux:button
                    wire:click="selectPropertyType('{{ $key }}')"
                    variant="outline"
                    class="w-full justify-start"
                >
                    {{ $property['label'] }}
                </flux:button>

            @endforeach
        </div>

    </div>

@endif
