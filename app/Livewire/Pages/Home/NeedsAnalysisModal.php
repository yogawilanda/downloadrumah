<?php

namespace App\Livewire\Pages\Home;


use App\Livewire\Pages\Home\Concerns\HasAnalysisState;
use Livewire\Component;

class NeedsAnalysisModal extends Component
{
    use HasAnalysisState;

    public bool $isOpen = false;

    protected $listeners = ['open-analysis-modal' => 'openModal'];

    public function openModal(): void
    {
        $this->reset(['currentStep']);
        $this->isOpen = true;
    }

    public function submitAnalysis(): void
    {
        $this->validate($this->rules()[3]);

        $result = $this->calculateRecommendation();

        // Emit hasil analisis ke parent (HomeFeed)
        $this->dispatch('housing-analysis-completed', result: $result);
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.pages.home.needs-analysis-modal');
    }
}
