<?php

namespace App\Livewire\Pages\Home\Concerns;

trait HasAnalysisState
{
    public int $currentStep = 1;

    // Form Properties
    public string $housingGoal = 'kos'; // kos, sewa_rumah, beli_rumah
    public int $budgetTarget = 5000000;
    public int $monthlySaving = 1000000;

    protected function rules(): array
    {
        return [
            1 => ['housingGoal' => 'required|in:kos,sewa_rumah,beli_rumah'],
            2 => ['budgetTarget' => 'required|numeric|min:500000'],
            3 => ['monthlySaving' => 'required|numeric|min:100000'],
        ];
    }

    public function nextStep(): void
    {
        $this->validate($this->rules()[$this->currentStep] ?? []);
        $this->currentStep++;
    }

    public function previousStep(): void
    {
        $this->currentStep = max(1, $this->currentStep - 1);
    }

    public function calculateRecommendation(): array
    {
        $monthsToSave = ceil($this->budgetTarget / max(1, $this->monthlySaving));

        return [
            'goal' => $this->housingGoal,
            'target_budget' => $this->budgetTarget,
            'monthly_allocation' => $this->monthlySaving,
            'estimated_months' => $monthsToSave,
        ];
    }
}
