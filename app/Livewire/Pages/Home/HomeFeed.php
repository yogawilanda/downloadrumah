<?php

namespace App\Livewire\Pages\Home;

use App\Livewire\Pages\Home\Concerns\HasHomeFeedFilters;
use App\Models\Estate;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * loc: app/Livewire/Pages/HomeFeed.php
 * func: Handles public home feed listing with query-string filters & pagination
 */
class HomeFeed extends Component
{
    use WithPagination, HasHomeFeedFilters;

    public function render()
    {
        $estates = Estate::query()
            // 1. Bersihkan eager loading ke 'district'
            ->with(['primaryImage', 'city', 'district', 'province'])
            ->active()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->transaction_type, fn($q) => $q->where('transaction_type', $this->transaction_type))
            ->when($this->city_id, fn($q) => $q->where('city_id', $this->city_id))
            ->when($this->district_id, fn($q) => $q->where('district_id', $this->district_id))
            ->when($this->max_price, fn($q) => $q->where('price', '<=', (float) $this->max_price))
            ->when($this->location, function ($query) {
                // 2. Cari berdasarkan nama Kota ATAU nama Kecamatan
                $query->where(function ($q) {
                    $q->whereHas('city', fn($c) => $c->where('name', 'like', '%' . $this->location . '%'))
                        ->orWhereHas('district', fn($d) => $d->where('name', 'like', '%' . $this->location . '%'));
                });
            })
            ->reorder('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pages.home-feed', [
            'estates' => $estates,
        ]);
    }
}
