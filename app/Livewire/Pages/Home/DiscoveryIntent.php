<?php
/**
 * @path: app/Livewire/Pages/Home/DiscoveryIntent.php
 * @usage : Search controller component that used for home-feed and listings.index
 * @author : yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Pages\Home;

use App\Models\City;
use App\Models\Estate;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class DiscoveryIntent extends Component
{
    #[Url]
    public string $search = '';

    #[Url]
    public string $city_id = '';

    #[Url]
    public string $transaction_type = '';

    #[Url]
    public string $max_price = '';

    public function submitSearch(): void
    {
        $params = array_filter([
            'search' => $this->search,
            'city_id' => $this->city_id,
            'transaction_type' => $this->transaction_type,
            'max_price' => $this->max_price,
        ]);

        $this->redirectRoute('listings.index', $params, navigate: true);
    }

    public function render(): View
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

        // Mengambil 5 kota populer sebagai opsi awal
        $popularCities = City::query()->orderBy('name')->limit(5)->get();

        return view('livewire.pages.home.discovery-intent', [
            'suggestions' => $suggestions,
            'cities' => City::query()->orderBy('name')->limit(12)->get(),
            'popularCities' => $popularCities,
        ]);
    }
}
