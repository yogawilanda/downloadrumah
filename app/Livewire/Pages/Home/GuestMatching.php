<?php

/* -------------- Yoga Wilanda Documentation V.1.2.2 -----------------
| <meta_config>
| Author_______________: yogawilanda <eayogawilanda@gmail.com>
| Path_________________: app/Livewire/Pages/Home/GuestMatching.php
| Render_______________: return view('livewire.pages.home.guest-matching');
| Usage________________: DownloadRumah — Guest Matching Flow
| type_________________: Livewire Component
| expected_data________: [intent, step, propertyType, searchState,
|                         location, budget, purpose, showResults]
| expected_output______: [matchingResults, matchingExplanation]
| purpose______________: Manage guided guest matching state, step navigation,
|                        label resolution, payload assembly, and delegation
|                        to GuestMatchingService.
| ruling_______________: Matching logic MUST remain inside the matching service.
|                        Livewire only manages presentation state and delegates
|                        the assembled payload to GuestMatchingService.
| ruling_structure_____: Action methods modify matching state -> Computed
|                        properties resolve labels & matching payload ->
|                        submit delegates payload to matching service.
| status_______________: Active
</meta_config>
------------------------------------------------------------------ */

namespace App\Livewire\Pages\Home;

use App\DataObjects\GuestIntentMap;
use App\Services\Matching\GuestMatchingService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GuestMatching extends Component
{
    public string $intent = 'search';

    public int $step = 1;

    public ?string $propertyType = null;

    public ?string $searchState = null;

    public string $location = '';

    public string $budget = '';

    public ?string $purpose = null;

    public bool $showResults = false;

    public array $matchingResults = [];

    public array $matchingExplanation = [];


    public function mount(string $intent = 'search'): void
    {
        $this->intent = $intent;
    }


    public function selectSearchState(string $state): void
    {
        $this->searchState = $state;

        $this->step = 2;
    }


    public function selectPropertyType(string $type): void
    {
        $this->propertyType = $type;

        $this->step = 3;
    }


    public function continueToBudget(): void
    {
        $this->step = 4;
    }


    public function continueToPurpose(): void
    {
        $this->step = 5;
    }


    public function selectPurpose(string $purpose): void
    {
        $this->purpose = $purpose;

        $this->step = 6;
    }


    public function back(): void
    {
        if (
            $this->step === 3 &&
            $this->intent === 'search' &&
            $this->searchState !== 'known'
        ) {
            $this->step = 1;

            return;
        }

        if (
            $this->step === 3 &&
            $this->intent === 'offer'
        ) {
            $this->step = 1;

            return;
        }

        if ($this->step > 1) {
            $this->step--;
        }
    }


    public function resetMatching(): void
    {
        $this->reset([
            'propertyType',
            'searchState',
            'location',
            'budget',
            'purpose',
            'showResults',
            'matchingResults',
            'matchingExplanation',
        ]);

        $this->step = 1;
    }


    /**
     * Delegate matching to the application service.
     *
     * Livewire does not perform matching or query construction.
     */
    // public function submit(GuestMatchingService $matchingService): void
    // {
    //     $result = $matchingService->match($this->payload);

    //     $this->matchingResults = $result['results'] ?? [];

    //     $this->matchingExplanation = $result['explanation'] ?? [];

    //     $this->showResults = true;
    // }

    public function submit(GuestMatchingService $matchingService): void
    {
        $result = $matchingService->match($this->payload);

        $this->matchingResults = $result['results'] ?? [];
        $this->matchingExplanation = $result['explanation'] ?? [];
        $this->showResults = true;

        session()->put('property_matching', $this->payload);
    }


    #[Computed]
    public function intentMap(): array
    {
        return GuestIntentMap::map();
    }


    #[Computed]
    public function intentLabel(): string
    {
        return $this->intentMap['intents'][$this->intent]['label'] ?? '-';
    }


    #[Computed]
    public function propertyLabel(): string
    {
        return $this->propertyType
            ? (
                $this->intentMap['property_types'][$this->propertyType]['label']
                ?? 'Belum ditentukan'
            )
            : 'Belum ditentukan';
    }


    #[Computed]
    public function purposeLabel(): string
    {
        if (!$this->purpose) {
            return '-';
        }

        return $this->intentMap['purposes'][$this->intent][$this->purpose]['label']
            ?? '-';
    }


    #[Computed]
    public function searchStates(): array
    {
        return $this->intentMap['search_states'];
    }


    #[Computed]
    public function propertyTypes(): array
    {
        return $this->intentMap['property_types'];
    }


    #[Computed]
    public function purposes(): array
    {
        return $this->intentMap['purposes'][$this->intent] ?? [];
    }


    #[Computed]
    public function payload(): array
    {
        $budget = preg_replace('/[^0-9]/', '', $this->budget);

        return [
            'intent' => $this->intent,

            'search_state' => $this->searchState,

            'property_pointer' => $this->propertyType
                ? (
                    $this->intentMap['property_types'][$this->propertyType]['pointer']
                    ?? null
                )
                : null,

            'location' => trim($this->location),

            'budget' => $budget !== ''
                ? (int) $budget
                : null,

            'purpose_pointer' => $this->purpose
                ? (
                    $this->intentMap['purposes'][$this->intent][$this->purpose]['pointer']
                    ?? null
                )
                : null,
        ];
    }


    public function render(): View
    {
        return view('livewire.pages.home.guest-matching');
    }
}

