<?php

namespace App\Livewire\Pages\Estates;

use App\Livewire\Pages\Home\Concerns\HasHomeFeedFilters;
use App\Livewire\Pages\Home\Concerns\HasPublicEstateSearch;
use App\Models\Estate;
use Illuminate\Contracts\View\View;
use Laravolt\Indonesia\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class PublicListing extends Component
{
    use WithPagination, HasHomeFeedFilters, HasPublicEstateSearch;

    public function render(): View
    {
        $estates = Estate::query()
            ->with(['primaryImage', 'city', 'district', 'province'])
            ->published()
            ->available()
            ->tap(fn ($query) => $this->applyPublicFilters($query))
            ->latest()
            ->paginate(10);

        $suggestions = $this->searchSuggestions();
        $cities = City::query()->orderBy('name')->limit(8)->get();

        return view('livewire.pages.estates.public-listing', compact('estates', 'suggestions', 'cities'));
    }
}
