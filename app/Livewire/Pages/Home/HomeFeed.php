<?php

namespace App\Livewire\Pages\Home;

use App\Actions\Seo\ConfigureHomeFeedSeo;
use App\Livewire\Pages\Home\Concerns\HasHomeFeedFilters;
use App\Livewire\Pages\Home\Concerns\HasPublicEstateSearch;
use App\Models\Estate;
use Laravolt\Indonesia\Models\City;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * loc: app/Livewire/Pages/HomeFeed.php
 * func: Handles public home feed listing with query-string filters & pagination
 */
class HomeFeed extends Component
{
    use WithPagination, HasHomeFeedFilters, HasPublicEstateSearch;

    public ?array $analysisResult = null;

    #[On('housing-analysis-completed')]
    public function handleAnalysisCompleted(array $result): void
    {
        $this->analysisResult = $result;
        // Opsional: BISA langsung assign $this->max_price = $result['target_budget'];
    }

    public function render(ConfigureHomeFeedSeo $configureSeo)
    {
        // Inject SEO dinamis sesuai state filter saat ini
        $configureSeo(
            search: $this->search ?? null,
            city: $this->city ?? null,
            maxPrice: $this->max_price ?? null
        );

        $query = Estate::query()
            ->with(['primaryImage', 'city', 'district', 'province'])
            ->published()->available();

        // Jika ada hasil analisis, terapkan scope/filter tambahan di query
        if ($this->analysisResult) {
            $query->where('price', '<=', $this->analysisResult['target_budget']);
        }

        $estates = $this->applyPublicFilters($query)
            ->reorder('created_at', 'desc')
            ->limit(8)
            ->get();

        $suggestions = $this->searchSuggestions();
        $cities = City::query()->orderBy('name')->limit(8)->get();

        return view('livewire.pages.home.home-feed', [
            'estates' => $estates,
            'recentEstates' => $estates->take(4),
            'recommendedEstates' => $estates->skip(4)->take(4),
            'suggestions' => $suggestions,
            'cities' => $cities,
        ]);
    }
}
