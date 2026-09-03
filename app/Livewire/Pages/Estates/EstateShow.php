<?php

namespace App\Livewire\Pages\Estates;

use App\Models\Estate;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class EstateShow extends Component
{
    public Estate $estate;

    public function mount(Estate $estate): void
    {
        // Eager load relasi user, attachments, dan lokasi Laravolt
        $this->estate = $estate->load(['user', 'attachments', 'city', 'province']);
    }

    public function render()
    {
        return view('livewire.pages.estates.estate-show');
    }
}
