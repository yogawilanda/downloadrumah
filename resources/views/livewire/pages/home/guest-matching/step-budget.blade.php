{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
    <meta_config>
        author________________: yogawilanda <eayogawilanda@gmail.com>
            path__________________: resources/views/livewire/pages/home/guest-matching/step-budget.blade.php
            usage_________________: DownloadRumah — Guest Matching Budget Step
            type__________________: Blade Partial
            expected_data_________: [budget]
            purpose_______________: Render optional budget refinement.
            ruling________________: Presentation only. State remains in GuestMatching.
            status________________: Active
    </meta_config>
    ------------------------------------------------------------------ --}}

    <div class="space-y-6">

        <div class="flex items-center gap-3">
            <flux:button wire:click="back" variant="ghost" size="sm">
                Kembali
            </flux:button>
        </div>

        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                Berapa budget yang kamu siapkan?
            </h1>

            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                Boleh dilewati kalau belum menentukan budget.
            </p>
        </div>

        <flux:field>
            <flux:label>Budget maksimal</flux:label>

            <flux:input wire:model.live="budget" type="text" inputmode="numeric" placeholder="Contoh: 500000000" />
        </flux:field>

        <flux:button wire:click="continueToPurpose" variant="primary">
            Lanjut
        </flux:button>

    </div>
