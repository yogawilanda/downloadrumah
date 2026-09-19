{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
        1. path__________________: resources/views/livewire/pages/home/guest-matching/step-location.blade.php
        2. usage_________________: DownloadRumah — Guest Matching Location Step
        3. type__________________: Blade Partial
        4. expected_data_________: [location, propertyLabel]
        5. purpose_______________: Collect the minimum location input required
        for the first property matching attempt.
        6. ruling________________: Presentation only. Matching and state logic
        remain in GuestMatching and GuestMatchingService.
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
            Di mana kamu mencari properti?
        </h1>

        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
            Lokasi membantu kami mencocokkan properti yang tersedia.
        </p>
    </div>

    <div>
        <flux:field>
            <flux:label>Lokasi</flux:label>

            <flux:input
                wire:model.live="location"
                placeholder="Contoh: Kabupaten Bantul"
            />
        </flux:field>
    </div>

    <div class="flex flex-col gap-3 sm:flex-row">
        <flux:button
            wire:click="submit"
            variant="primary"
            class="w-full sm:w-auto"
        >
            Lihat properti sekarang
        </flux:button>

        <flux:button
            wire:click="continueToBudget"
            variant="ghost"
            class="w-full sm:w-auto"
        >
            Persempit pencarian →
        </flux:button>
    </div>

</div>
