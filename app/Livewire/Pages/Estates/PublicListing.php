<?php
/**
 * loc: app/Livewire/Pages/Estates/PublicListing.php
 * func: Handles public home feed listing with query-string filters & pagination
 */

namespace App\Livewire\Pages\Estates;

use App\Livewire\Pages\Home\Concerns\HasHomeFeedFilters;
use App\Livewire\Pages\Home\Concerns\HasPublicEstateSearch;
use App\Models\Estate;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PublicListing extends Component
{
    use WithPagination, HasHomeFeedFilters, HasPublicEstateSearch;

    #[On('apply-home-filter')]
    public function handleFilterUpdate(array $params): void
    {
        $this->search = $params['search'] ?? '';
        $this->city_id = $params['city_id'] ?? '';
        $this->transaction_type = $params['transaction_type'] ?? '';
        $this->max_price = $params['max_price'] ?? '';

        $this->resetPage();
    }

    public function render(): View
    {
        $estates = Estate::query()
            ->with(['primaryImage', 'city', 'district', 'province'])
            ->published()
            ->available()
            ->tap(fn ($query) => $this->applyPublicFilters($query))
            ->latest()
            ->paginate(10);

        return view('livewire.pages.estates.public-listing', compact('estates'));
    }
}
