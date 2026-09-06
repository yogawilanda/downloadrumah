<?php

namespace App\Livewire\Pages\Home;

use App\Livewire\Pages\Home\Concerns\HasHomeFeedFilters;
use App\Livewire\Pages\Home\Concerns\HasPublicEstateSearch;
use App\Models\Estate;
use Laravolt\Indonesia\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * loc: app/Livewire/Pages/HomeFeed.php
 * func: Handles public home feed listing with query-string filters & pagination
 */
class HomeFeed extends Component
{
    use WithPagination, HasHomeFeedFilters, HasPublicEstateSearch;

    public function render()
    {
        $query = Estate::query()
            ->with(['primaryImage', 'city', 'district', 'province'])
            ->published()->available();

        $estates = $this->applyPublicFilters($query)
            ->reorder('created_at', 'desc')
            ->limit(8)
            ->get();

        $suggestions = $this->searchSuggestions();
        $cities = City::query()->orderBy('name')->limit(8)->get();

        return view('livewire.pages.home-feed', [
            'estates' => $estates,
            'recentEstates' => $estates->take(4),
            'recommendedEstates' => $estates->skip(4)->take(4),
            'suggestions' => $suggestions,
            'cities' => $cities,
        ]);
    }
}
