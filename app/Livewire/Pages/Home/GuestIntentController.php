<?php

namespace App\Livewire\Pages\Home;

use App\DataObjects\GuestIntentMap;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use function Termwind\render;

/* ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path                : app/Livewire/Pages/Home/GuestIntentController.php
| @usage               : DownloadRumah — Guest Intent Controller
| @type                : Livewire Component
| @expected_data       : [intent, step, propertyType, searchState, location, budget, purpose]
| @purpose             : Manage step navigation, form states, label resolution, and query payload assembly.
| @ruling               : Business logic and navigation state reside here; raw data mapping stays in GuestIntentMap.
| @ruling_structure     : Action methods modify step/state -> Computed properties resolve dynamic labels & matching payload.
| @status               : Active / Refactored
| @author               : yogawilanda <eaywilanda@gmail.com>
</meta_config>
-------------------------------------------------------------------------------------------------------- */

class GuestIntentController extends Component
{
    public string $intent = 'search';
    public int $step = 1;
    public ?string $propertyType = null;
    public ?string $searchState = null;
    public string $location = '';
    public string $budget = '';
    public ?string $purpose = null;

    public function setIntent(string $intent): void
    {
        $this->intent = $intent;
        $this->reset(['propertyType', 'searchState', 'location', 'budget', 'purpose']);
        $this->step = 1;
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
        if ($this->step === 3 && $this->intent === 'search' && $this->searchState !== 'known') {
            $this->step = 1;
            return;
        }

        if ($this->step === 3 && $this->intent === 'offer') {
            $this->step = 1;
            return;
        }

        if ($this->step > 1) {
            $this->step--;
        }
    }



    public function resetMatching(): void
    {
        $this->reset(['propertyType', 'searchState', 'location', 'budget', 'purpose']);
        $this->step = 1;
    }

    public function submit(): void
    {
        $payload = $this->payload;

        dd(json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Execute matching query or redirect to search result page
        // $this->redirectRoute('properties.index', $payload);
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
            ? ($this->intentMap['property_types'][$this->propertyType]['label'] ?? 'Belum ditentukan')
            : 'Belum ditentukan';
    }

    #[Computed]
    public function purposeLabel(): string
    {
        if (!$this->purpose) {
            return '-';
        }

        return $this->intentMap['purposes'][$this->intent][$this->purpose]['label'] ?? '-';
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
        return [
            'intent' => $this->intent,
            'search_state' => $this->searchState,
            'property_pointer' => $this->propertyType
                ? ($this->intentMap['property_types'][$this->propertyType]['pointer'] ?? null)
                : null,
            'location' => trim($this->location),
            'budget' => (int) preg_replace('/[^0-9]/', '', $this->budget),
            'purpose_pointer' => $this->purpose
                ? ($this->intentMap['purposes'][$this->intent][$this->purpose]['pointer'] ?? null)
                : null,
        ];
    }

    public function render(): View
    {
        return view('livewire.pages.home.sections.hero');
    }
}
