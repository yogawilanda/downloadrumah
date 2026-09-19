{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
    author________________: yogawilanda <eayogawilanda@gmail.com>
    path__________________: resources/views/livewire/pages/home/guest-matching/step-purpose.blade.php
    usage_________________: DownloadRumah — Guest Matching Purpose Step
    type__________________: Blade Partial
    expected_data_________: [purposes, purpose]
    purpose_______________: Render optional purpose refinement.
    ruling________________: Presentation only. State remains in GuestMatching.
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
            Properti ini untuk apa?
        </h1>

        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
            Tujuan penggunaan bisa membantu memperjelas pencarian.
        </p>
    </div>

    <div class="space-y-3">
        @foreach ($this->purposes as $key => $purposeOption)

            <flux:button
                wire:click="selectPurpose('{{ $key }}')"
                variant="outline"
                class="w-full justify-start"
            >
                {{ $purposeOption['label'] }}
            </flux:button>

        @endforeach
    </div>

</div>
