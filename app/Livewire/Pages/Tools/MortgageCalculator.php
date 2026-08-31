<?php

namespace App\Livewire\Pages\Tools;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Layout;



#[Layout('components.layouts.app')]
#[Title('Kalkulator KPR')]
class MortgageCalculator extends Component
{
    public function render()
    {
        return view('livewire.pages.tools.mortgage-calculator');
    }
}
