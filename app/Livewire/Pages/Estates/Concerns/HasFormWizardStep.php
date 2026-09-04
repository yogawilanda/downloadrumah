<?php

namespace App\Livewire\Pages\Estates\Concerns;

trait HasFormWizardStep
{
    public int $currentStep = 1;

    public function nextStep(): void
    {
        $this->currentStep = min(4, $this->currentStep + 1);
    }

    public function previousStep(): void
    {
        $this->currentStep = max(1, $this->currentStep - 1);
    }

    public function setStep(int $step): void
    {
        $this->currentStep = max(1, min(4, $step));
    }
}
