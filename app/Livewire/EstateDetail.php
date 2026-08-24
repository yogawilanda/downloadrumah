<?php

namespace App\Livewire;

use App\Models\Estate;
use Livewire\Component;

class EstateDetail extends Component
{
    public Estate $estate;

    public function mount($slug)
    {
        $this->estate = Estate::with(['user', 'attachments'])->where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.estate-detail');
    }
}
