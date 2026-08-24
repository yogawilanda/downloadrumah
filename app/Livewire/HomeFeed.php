<?php

namespace App\Livewire;

use App\Models\Estate;
use Livewire\Component;
use Livewire\WithPagination;

class HomeFeed extends Component
{
    use WithPagination;

    // Filter Properties (Reactive Data Binding)
    public $search = '';
    public $transaction_type = '';
    public $city = '';
    public $max_price = '';

    // Reset halaman ke 1 saat filter berubah
    public function updatedSearch() { $this->resetPage(); }
    public function updatedTransactionType() { $this->resetPage(); }
    public function updatedCity() { $this->resetPage(); }

    public function render()
    {
        $estates = Estate::query()
            ->with(['primaryImage'])
            ->where('status', 'active')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->transaction_type, function ($query) {
                $query->where('transaction_type', $this->transaction_type);
            })
            ->when($this->city, function ($query) {
                $query->where('city', $this->city);
            })
            ->when($this->max_price, function ($query) {
                $query->where('price', '<=', $this->max_price);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.home-feed', [
            'estates' => $estates,
        ]);
    }
}
