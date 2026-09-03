<?php

namespace App\Livewire\Pages\Estates;

use App\Models\Estate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EstateListing extends Component
{
    use WithPagination;

    // Active Tab: 'my_listings' | 'co_broke' | 'drafts'
    public string $tab = 'my_listings';

    public function setTab(string $tabName)
    {
        $this->tab = $tabName;
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();

        $query = Estate::query();

        if ($this->tab === 'my_listings') {
            // Properti yang dibuat oleh agen ini
            $query->where('user_id', $user->id);
        } elseif ($this->tab === 'co_broke') {
            // Co-Broke: Properti agen lain, status active, & open co-broke via JSON attributes
            $query->where('user_id', '!=', $user->id)
                ->active()
                ->where('attributes->agent_cooperation', true);
        } elseif ($this->tab === 'drafts') {
            // Draft milik agen ini
            $query->where('user_id', $user->id)
                ->where('status', 'draft');
        }

        $estates = $query
            ->with(['primaryImage', 'city'])
            ->latest()
            ->paginate(10);

        return view('livewire.pages.estates.estate-listing', [
            'estates' => $estates,
        ]);
    }
}
