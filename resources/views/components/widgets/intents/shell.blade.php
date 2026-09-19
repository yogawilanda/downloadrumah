{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
        1. path__________________: resources/views/components/widgets/intents/shell.blade.php
        2. usage_________________: DownloadRumah — Guest Matching Shell
        3. type__________________: Blade Component
        4. expected_data_________: [step, intentLabel, showResults, slot]
        5. purpose_______________: Provide the shared visual shell and
        progress/status framing for the guest matching experience.
        6. ruling________________: The shell owns layout and presentation
        framing only. Guest matching state and business logic remain in
        GuestMatching.
        7. ruling_structure______: Shell → Content → Progress / Status
        8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

@props([
    'step' => 1,
    'intentLabel' => null,
    'showResults' => false,
])

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950">
    <div class="mx-auto flex min-h-screen w-full max-w-5xl items-center px-4 py-8 sm:px-6 lg:px-8">

        <div class="w-full overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

            {{-- Content --}}
            <div class="p-6 sm:p-8 md:p-10">
                {{ $slot }}
            </div>

            {{-- Progress / Status --}}
            @unless ($showResults)

            <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800 sm:px-8 md:px-10">
                <div class="flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400">

                    <span>
                        {{ $step }} / 6
                    </span>

                    @if ($intentLabel)
                        <span>
                            {{ $intentLabel }}
                        </span>
                    @endif

                </div>
            </div>

            @endunless

        </div>

    </div>
</div>
