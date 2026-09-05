<?php

namespace App\Livewire\Pages\Home\Concerns;

use Livewire\Attributes\Url;

/**
 * loc: app/Livewire/Pages/Concerns/HasHomeFeedFilters.php
 * func: Isolates state properties, URL bindings, and updating hooks for HomeFeed
 */
trait HasHomeFeedFilters
{
    #[Url(except: '')]
    public string $search = '';

    #[Url(except: '')]
    public string $transaction_type = '';

    #[Url(except: '')]
    public string $city_id = '';

    #[Url(except: '')]
    public string $city = '';

    #[Url(except: '')]
    public string $max_price = '';

    #[Url(except: '')]
    public string $location = '';

    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedTransactionType(): void { $this->resetPage(); }
    public function updatedCityId(): void { $this->resetPage(); }
    public function updatedMaxPrice(): void { $this->resetPage(); }
    public function updatedLocation(): void { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->reset(['search', 'transaction_type', 'city_id', 'city', 'max_price', 'location']);
        $this->resetPage();
    }
}
