<?php

namespace App\Livewire\Pages\Supports;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Catatan Rilis')]
class ReleaseNotes extends Component
{
    public function render()
    {
        return view('livewire.pages.supports.release-notes');
    }
}
