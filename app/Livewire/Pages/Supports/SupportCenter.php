<?php

namespace App\Livewire\Pages\Supports;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Pusat Bantuan & Support')]
class SupportCenter extends Component
{
    public function render()
    {
        return view('livewire.pages.supports.support-center');
    }
}
