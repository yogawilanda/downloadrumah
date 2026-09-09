<?php

/**
 * @path: app/Livewire/Pages/Home/TopNav.php
 * @usage : Top Navigation that basically a bit needed some functionality for specifics pages
 * @author : yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Pages\Home;

use App\Models\Estate;
use App\Models\City;
use Livewire\Attributes\Url;
use Livewire\Component;

class TopNav extends Component
{
    #[Url]
    public string $search = '';

    #[Url]
    public string $city_id = '';

    #[Url]
    public string $transaction_type = '';

    #[Url]
    public string $max_price = '';

    public bool $isListingPage = false;

    public function mount(
        string $search = '',
        string $city_id = '',
        string $transaction_type = '',
        string $max_price = '',
        bool $isListingPage = false
    ): void {
        $this->search = $search;
        $this->city_id = $city_id;
        $this->transaction_type = $transaction_type;
        $this->max_price = $max_price;
        $this->isListingPage = $isListingPage;
    }

    public function updatedSearch(): void
    {
        // Hanya memicu re-render internal untuk autocomplete
    }

    public function updatedCityId(): void
    {
        $this->submitSearch();
    }

    public function updatedTransactionType(): void
    {
        $this->submitSearch();
    }

    public function submitSearch(): void
    {
        $params = array_filter([
            'search' => $this->search,
            'city_id' => $this->city_id,
            'transaction_type' => $this->transaction_type,
            'max_price' => $this->max_price,
        ]);

        if ($this->isListingPage) {
            // Berada di PublicListing -> Dispatch Event (In-page Update)
            $this->dispatch('apply-home-filter', $params);
        } else {
            // Berada di HomeFeed / Landing Gate -> SPA Redirect ke PublicListing
            $this->redirectRoute('listings.index', $params, navigate: true);
        }
    }

    public function selectCitySuggestion(string $cityCode): void
    {
        $this->city_id = $cityCode;
        $this->submitSearch();
    }

    public function render()
    {
        $term = trim($this->search);

        $suggestions = [
            'cities' => mb_strlen($term) >= 2
                ? City::query()->where('name', 'like', "%{$term}%")->orderBy('name')->limit(5)->get()
                : collect(),
            'estates' => mb_strlen($term) >= 2
                ? Estate::query()->published()->available()->where('title', 'like', "%{$term}%")->latest()->limit(5)->get()
                : collect(),
        ];

        // Query kota populer (opsional: sesuaikan urutan/scope jika ada flag khusus)
        $popularCities = City::query()->orderBy('name')->limit(5)->get();

        return view('livewire.pages.home.top-nav', [
            'suggestions' => $suggestions,
            'popularCities' => $popularCities,
            'cities' => City::query()->orderBy('name')->limit(8)->get(),
        ]);
    }
}
