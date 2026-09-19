{{-- ----------- Yoga Wilanda Documentation v1.2.2 -----------------
<meta_config>
    author________________: yogawilanda <eayogawilanda@gmail.com>
    path__________________: resources/views/livewire/pages/home/guest-matching.blade.php
    controller____________: <livewire:pages.home.guest-matching />
    usage_________________: DownloadRumah — Guest Matching Experience
    type__________________: Livewire View
    expected_data_________: [intent, step, propertyType, searchState,
                             location, budget, purpose, showResults]
    purpose_______________: Orchestrate the guest matching presentation
    through the shared shell and step/result partials.
    ruling________________: State and business logic remain in GuestMatching.
    Semantic mapping remains in GuestIntentMap.
    Matching logic remains in GuestMatchingService.
    ruling_structure______: Shell → Results / Step Partial
    status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<x-widgets.intents.shell
    :step="$step"
    :intent-label="$this->intentLabel"
    :show-results="$showResults"
>

    @if ($showResults)

        @include('livewire.pages.home.guest-matching.results')

    @elseif ($step === 1)

        @include('livewire.pages.home.guest-matching.step-intent')

    @elseif ($step === 2)

        @include('livewire.pages.home.guest-matching.step-property')

    @elseif ($step === 3)

        @include('livewire.pages.home.guest-matching.step-location')

    @elseif ($step === 4)

        @include('livewire.pages.home.guest-matching.step-budget')

    @elseif ($step === 5)

        @include('livewire.pages.home.guest-matching.step-purpose')

    @elseif ($step === 6)

        @include('livewire.pages.home.guest-matching.step-summary')

    @endif

</x-widgets.intents.shell>
