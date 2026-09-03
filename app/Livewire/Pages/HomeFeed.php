<?php

namespace App\Livewire\Pages;

use App\Models\Estate;
use Livewire\Component;
use Livewire\WithPagination;

class HomeFeed extends Component
{
    use WithPagination;

    // Filter Properties (Reactive Data Binding)
    public $search = '';
    public $transaction_type = '';
    public $city_id = '';
    public $max_price = '';

    // Reset halaman ke 1 saat filter berubah
    public function updatedSearch() { $this->resetPage(); }
    public function updatedTransactionType() { $this->resetPage(); }
    public function updatedCityId() { $this->resetPage(); }
    public function updatedMaxPrice() { $this->resetPage(); }

    public function render()
    {
        $estates = Estate::query()
            // Eager loading relasi gambar dan lokasi Laravolt
            ->with(['primaryImage', 'city', 'province'])
            ->active() // Menggunakan scopeActive() dari Estate Model
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->transaction_type, function ($query) {
                $query->where('transaction_type', $this->transaction_type);
            })
            ->when($this->city_id, function ($query) {
                $query->where('city_id', $this->city_id);
            })
            ->when($this->max_price, function ($query) {
                $query->where('price', '<=', $this->max_price);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.pages.home-feed', [
            'estates' => $estates,
        ]);
    }
}
