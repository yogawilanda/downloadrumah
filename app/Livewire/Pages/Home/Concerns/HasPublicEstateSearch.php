<?php

namespace App\Livewire\Pages\Home\Concerns;

use App\Models\Estate;
use Laravolt\Indonesia\Models\City;

trait HasPublicEstateSearch
{
    public function selectCity(string $name, string $code): void
    {
        $this->city = $name;
        $this->city_id = $code;
        $this->district_id = '';
        $this->resetPage();
    }

    protected function applyPublicFilters($query)
    {
        $this->city_id = $this->city
            ? (string) (City::where('name', $this->city)->value('code') ?? '')
            : '';

        return $query
            ->when($this->search, fn ($query) => $query->where(function ($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
                    ->orWhereHas('city', fn ($city) => $city->where('name', 'like', "%{$this->search}%"))
                    ->orWhereHas('district', fn ($district) => $district->where('name', 'like', "%{$this->search}%"));
            }))
            ->when($this->transaction_type, fn ($query) => $query->where('transaction_type', $this->transaction_type))
            ->when($this->city_id, fn ($query) => $query->where('city_id', $this->city_id))
            ->when($this->district_id, fn ($query) => $query->where('district_id', $this->district_id))
            ->when($this->max_price, fn ($query) => $query->where('price', '<=', (float) $this->max_price));
    }

    protected function searchSuggestions(): array
    {
        if (mb_strlen(trim($this->search)) < 2) {
            return ['cities' => collect(), 'estates' => collect()];
        }

        $term = trim($this->search);
        return [
            'cities' => City::query()->where('name', 'like', "%{$term}%")->orderBy('name')->limit(5)->get(),
            'estates' => Estate::query()->active()->with('primaryImage')->where(function ($query) use ($term) {
                $query->where('title', 'like', "%{$term}%")
                    ->orWhereHas('city', fn ($city) => $city->where('name', 'like', "%{$term}%"))
                    ->orWhereHas('district', fn ($district) => $district->where('name', 'like', "%{$term}%"));
            })->latest()->limit(5)->get(),
        ];
    }
}
