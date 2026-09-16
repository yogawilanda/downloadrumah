<?php

namespace App\Livewire\Pages\Home;

use App\Models\City;
use App\Models\Estate;
use App\Services\CityService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\Component;

class DiscoveryIntent extends Component
{
    public string $variant = 'hero';

    #[Url] public string $search = '';
    #[Url] public string $city = ''; // Satu-satunya single source of truth untuk lokasi
    #[Url] public string $transaction_type = '';
    #[Url] public string $max_price = '';

    public function submitSearch(): void
    {
        $params = array_filter([
            'search' => $this->search,
            'city' => Str::slug($this->city),
            'transaction_type' => $this->transaction_type,
            'max_price' => $this->max_price,
        ]);

        $this->redirectRoute('listings.index', $params, navigate: true);
    }

    public function selectCitySuggestion(string $cityName): void
    {
        $this->city = $cityName;
        $this->submitSearch();
    }

    public function render(CityService $cityService): View
    {
        $term = trim($this->search);

        $suggestions = [
            'cities' => mb_strlen($term) >= 2
                ? City::query()->where('name', 'like', "%{$term}%")->orderBy('name')->limit(5)->get()
                : collect(),
            'estates' => mb_strlen($term) >= 2
                ? Estate::query()->published()->available()->with('primaryImage')->where('title', 'like', "%{$term}%")->latest()->limit(5)->get()
                : collect(),
        ];

        return view('livewire.pages.home.discovery-intent', [
            'suggestions' => $suggestions,
            'cities' => $cityService->getDropdownCities(12),
            'popularCities' => $cityService->getPopularCities(5),
        ]);
    }
}
