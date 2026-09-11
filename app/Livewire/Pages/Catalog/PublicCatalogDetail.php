<?php

namespace App\Livewire\Pages\Catalog;

use App\Actions\Seo\ConfigureAgentCatalogEstateSeo;
use App\Models\Estate;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class PublicCatalogDetail extends Component
{
    public User $agent;
    public Estate $estate;

    public function mount(string $username, Estate $estate): void
    {
        $this->agent = User::whereUsername($username)->firstOrFail();

        $isOwner = auth()->check() && auth()->id() === $estate->user_id;

        if ($estate->user_id !== $this->agent->id || (!$isOwner && !$estate->is_published)) {
            abort(404);
        }

        $this->estate = $estate;
    }

    #[Computed]
    public function kprUrl(): string
    {
        return route('mortgage.calculator', [
            'price' => $this->estate->price,
        ]);
    }

    public function render(ConfigureAgentCatalogEstateSeo $configureSeo)
    {
        $this->estate->load(['primaryImage', 'city', 'district', 'province', 'attachments']);

        $configureSeo($this->agent, $this->estate);

        return view('livewire.pages.catalog.public-catalog-detail', [
            'agent' => $this->agent,
            'estate' => $this->estate,
        ]);
    }
}
