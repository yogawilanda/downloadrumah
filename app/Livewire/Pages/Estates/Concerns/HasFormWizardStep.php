<?php

namespace App\Livewire\Pages\Estates\Concerns;

use Illuminate\Validation\ValidationException;

trait HasFormWizardStep
{
    public int $currentStep = 1;

    public function nextStep(): void
    {
        $this->validateCurrentStep();
        $this->currentStep = min(4, $this->currentStep + 1);
    }

    public function previousStep(): void
    {
        $this->currentStep = max(1, $this->currentStep - 1);
    }

    public function setStep(int $step): void
    {
        $targetStep = max(1, min(4, $step));

        if ($targetStep > $this->currentStep) {
            for ($stepNumber = $this->currentStep; $stepNumber < $targetStep; $stepNumber++) {
                $this->validateCurrentStep($stepNumber);
            }
        }

        $this->currentStep = $targetStep;
    }

    abstract protected function validateStep(int $step): void;

    protected function validateCurrentStep(?int $step = null): void
    {
        try {
            $this->validateStep($step ?? $this->currentStep);
        } catch (ValidationException $exception) {
            $field = array_key_first($exception->errors());
            $this->dispatch('estate-form-error', field: str_replace('form.', '', $field));
            throw $exception;
        }
    }
}
