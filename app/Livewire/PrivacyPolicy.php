<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Kebijakan Privasi')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.pages.privacy.privacy-policy');
    }
}
