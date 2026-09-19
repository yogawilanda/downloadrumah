{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
        1. path__________________: resources/views/livewire/pages/home/guest-matching/step-property.blade.php
        2. usage_________________: DownloadRumah — Guest Matching Property Step
        3. type__________________: Blade Partial
        4. expected_data_________: [propertyTypes, propertyType, intent]
        5. purpose_______________: Render property type selection for guest matching.
        6. ruling________________: Presentation only. State remains in GuestMatching.
        7. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div class="space-y-6">

    <div class="flex items-center gap-3">
        <flux:button
            wire:click="back"
            variant="ghost"
            size="sm"
        >
            Kembali
        </flux:button>
    </div>

    <div>
        <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
            Oke. Kamu sedang mencari apa?
        </h1>

        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
            Pilih jenis properti yang kamu cari.
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
