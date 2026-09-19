{{-- ----------- Yoga Wilanda Documentation v1.0.2 -----------------
<meta_config>
    author________________: yogawilanda <eayogawilanda@gmail.com>
        path__________________: resources/views/livewire/pages/home/guest-matching/results.blade.php
        usage_________________: DownloadRumah — Guest Matching Result Summary
        type__________________: Blade Partial
        expected_data_________: [matchingResults, matchingExplanation]
        purpose_______________: Summarize how well the user's intent is
        represented by the current property supply.
        ruling________________: This surface MUST NOT duplicate public
        property listing or browsing.
        ruling_structure______: Understand Intent → Measure Match → Explain Gap
        → Optional Next Action
        status________________: Active
</meta_config>
------------------------------------------------------------------ --}}

@php
$matched = $matchingExplanation['matched'] ?? [];
$unverified = $matchingExplanation['unverified'] ?? [];

$matchedCount = count($matched);
$unverifiedCount = count($unverified);
$totalCriteria = $matchedCount + $unverifiedCount;
@endphp

<div class="space-y-8">

    {{-- RESULT SUMMARY --}}
    <div class="space-y-4">

        <div>
            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                Pencarian selesai
            </p>

            <h1 class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-white">
                @if ($matchedCount > 0 && $unverifiedCount === 0)
                Kebutuhanmu cocok dengan kriteria yang kami cek.
                @elseif ($matchedCount > 0)
                Kami menemukan kecocokan dari kebutuhanmu.
                @else
                Kebutuhanmu sudah kami pahami.
                @endif
            </h1>

            <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                Kami mencocokkan kebutuhanmu dengan informasi properti
                yang tersedia saat ini.
            </p>
        </div>

        {{-- MATCH SCORE --}}
        @if ($totalCriteria > 0)
        <div class="border-y border-zinc-200 py-6 dark:border-zinc-800">
            <p class="text-3xl font-semibold text-zinc-900 dark:text-white">
                {{ $matchedCount }}/{{ $totalCriteria }}
            </p>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                kriteria dapat kami cocokkan
            </p>
        </div>
        @endif

    </div>


    {{-- WHAT WE MATCHED --}}
    @if (!empty($matched))

    <div class="space-y-3">

        <div>
            <p class="text-sm font-medium text-zinc-900 dark:text-white">
                Yang cocok
            </p>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Bagian ini dapat kami pastikan dari data yang tersedia.
            </p>
        </div>

        <div class="space-y-2">

            @foreach ($matched as $criterion)

            <div class="flex items-center gap-3 text-sm text-zinc-700 dark:text-zinc-300">
                <span class="text-zinc-900 dark:text-white">✓</span>
                <span>
                    {{ match ($criterion) {
                    'location' => 'Lokasi',
                    'property_type' => 'Jenis properti',
                    'budget' => 'Budget',
                    default => $criterion,
                    } }}
                </span>
            </div>

            @endforeach

        </div>

    </div>

    @endif


    {{-- WHAT WE CANNOT VERIFY --}}
    @if (!empty($unverified))

    <div class="space-y-3">

        <div>
            <p class="text-sm font-medium text-zinc-900 dark:text-white">
                Yang belum dapat kami pastikan
            </p>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Bukan berarti tidak ada. Informasinya belum cukup
                untuk kami nyatakan sebagai kecocokan.
            </p>
        </div>

        <div class="space-y-3">

            @foreach ($unverified as $criterion => $message)

            <div class="border-l-2 border-zinc-300 pl-4 dark:border-zinc-700">
                <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    {{ match ($criterion) {
                    'property.kos' => 'Jenis properti',
                    default => $criterion,
                    } }}
                </p>

                <p class="mt-1 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
                    {{ $message }}
                </p>
            </div>

            @endforeach

        </div>

    </div>

    @endif


    {{-- NO MATCH / DEMAND CAPTURE --}}
    @if (count($matchingResults) === 0)

    <div class="border-y border-zinc-200 py-6 dark:border-zinc-800">

        <p class="text-sm font-medium text-zinc-900 dark:text-white">
            Belum ada kecocokan yang bisa kami tampilkan.
        </p>

        <p class="mt-2 max-w-xl text-sm leading-6 text-zinc-600 dark:text-zinc-400">
            Kebutuhanmu tetap tercatat sebagai pencarian yang jelas.
            Jika informasi yang tersedia belum mencukupi, kami tidak
            akan mengubah kriteriamu hanya agar terlihat ada hasil.
        </p>

    </div>

    @else

    {{-- MATCH EXISTS --}}
    <div class="border-y border-zinc-200 py-6 dark:border-zinc-800">

        <p class="text-sm font-medium text-zinc-900 dark:text-white">
            Ada properti yang sesuai dengan kriteria yang kami cek.
        </p>

        <p class="mt-2 max-w-xl text-sm leading-6 text-zinc-600 dark:text-zinc-400">
            Untuk melihat detail dan membandingkan properti,
            lanjutkan ke pencarian properti.
        </p>

    </div>

    @endif


    <div class="flex flex-col gap-3 sm:flex-row">
        <flux:button href="{{ route('listings.index') }}" variant="primary">
            Lihat properti yang cocok
        </flux:button>

        <flux:button wire:click="resetMatching" variant="ghost">
            Ubah pencarian
        </flux:button>
    </div>

</div>
