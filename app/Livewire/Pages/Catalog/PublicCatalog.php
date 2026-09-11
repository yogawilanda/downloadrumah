<?php

namespace App\Livewire\Pages\Catalog;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Actions\Seo\ConfigureAgentCatalogSeo;

/**
 * loc: app/Livewire/Pages/Estates/PublicCatalog.php
 * func: Handles isolated public catalog listing for specific agent username
 */
#[Layout('components.layouts.app')]
class PublicCatalog extends Component
{
    use WithPagination;

    public string $username;

    public function mount(string $username): void
    {
        $this->username = $username;
    }
    // app/Livewire/Pages/Catalog/PublicCatalog.php



    public function render(ConfigureAgentCatalogSeo $configureSeo)
    {
        $agent = User::whereUsername($this->username)->firstOrFail();

        // Set SEO khusus etalase agen via laravel/head
        $configureSeo($agent);

        $estates = $agent->estates()
            ->published()
            ->with(['primaryImage', 'city', 'district'])
            ->latest()
            ->paginate(12);

        return view('livewire.pages.catalog.public-catalog', [
            'agent' => $agent,
            'estates' => $estates,
        ]);
    }
}
