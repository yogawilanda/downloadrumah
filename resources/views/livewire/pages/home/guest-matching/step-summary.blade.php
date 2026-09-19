{{-- ----------- Yoga Wilanda Documentation v1.0.1 -----------------
<meta_config>
    author________________: yogawilanda <eayogawilanda@gmail.com>
    path__________________: resources/views/livewire/pages/home/guest-matching/step-summary.blade.php
    usage_________________: DownloadRumah — Guest Matching Summary Step
    type__________________: Blade Partial
    expected_data_________: [payload, intentLabel, propertyLabel, purposeLabel]
    purpose_______________: Render the canonical assembled intent payload
                            before matching.
    ruling________________: Presentation only. State remains in GuestMatching.
    ruling_data____________: Summary MUST reflect the same payload submitted
                             to GuestMatchingService.
    status________________: Active
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
            Cek lagi pencarianmu
        </h1>

        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
            Pastikan detailnya sudah sesuai sebelum kami mencocokkan properti.
        </p>
    </div>

    <div class="space-y-3 text-sm">

        <div>
            <span class="text-zinc-500">Tujuan</span>
            <p class="font-medium text-zinc-900 dark:text-white">
                {{ $this->intentLabel }}
            </p>
        </div>

        <div>
            <span class="text-zinc-500">Jenis properti</span>
            <p class="font-medium text-zinc-900 dark:text-white">
                {{ $this->propertyLabel }}
            </p>
        </div>

        <div>
            <span class="text-zinc-500">Lokasi</span>
            <p class="font-medium text-zinc-900 dark:text-white">
                {{ $this->payload['location'] ?: '-' }}
            </p>
        </div>

        <div>
            <span class="text-zinc-500">Budget</span>
            <p class="font-medium text-zinc-900 dark:text-white">
                {{ $this->payload['budget'] !== null
                    ? number_format($this->payload['budget'], 0, ',', '.')
                    : '-' }}
            </p>
        </div>

        <div>
            <span class="text-zinc-500">Kebutuhan</span>
            <p class="font-medium text-zinc-900 dark:text-white">
                {{ $this->purposeLabel }}
            </p>
        </div>

    </div>

    <div class="flex flex-col gap-3 sm:flex-row">
        <flux:button
            wire:click="back"
            variant="outline"
            class="w-full sm:w-auto"
        >
            Ubah
        </flux:button>

        <flux:button
            wire:click="submit"
            variant="primary"
            class="w-full sm:w-auto"
        >
            Cari properti
        </flux:button>
    </div>

</div>
