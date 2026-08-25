<?php
namespace App\Livewire\Pages\Estates;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estate;
use Illuminate\Support\Facades\Auth;

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
            // Properti yang dibuat oleh agen ini (Draft maupun Published)
            $query->where('user_id', $user->id);
        } elseif ($this->tab === 'co_broke') {
            // Persiapan Co-Broke: Properti milik agen LAIN yang open untuk Co-Broke
            $query->where('user_id', '!=', $user->id)
                  ->where('is_published', true)
                  ->where('allow_cobroke', true); // kolom boolean fleksibel untuk fitur mendatang
        }

        $estates = $query->latest()->paginate(10);

        return view('livewire.pages.estates.estate-listing', [
            'estates' => $estates,
        ]);
    }
}
