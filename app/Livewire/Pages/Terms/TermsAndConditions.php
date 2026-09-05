<?php

namespace App\Livewire\Pages\Terms;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Syarat & Ketentuan')]
class TermsAndConditions extends Component
{
    public function render()
    {
        return view('livewire.pages.terms.terms-and-conditions');
    }
}
