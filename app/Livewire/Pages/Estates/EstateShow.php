<?php

/**
 * <meta_config>
 * @path : app/Livewire/Pages/Estates/EstateShow.php | usage: Livewire Component for Single Estate Detail View
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : false | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Pages\Estates;

use App\Actions\Seo\ConfigureEstateSeo;
use App\Models\Estate;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class EstateShow extends Component
{
    /**
     * Instance model Estate yang sedang ditayangkan.
     */
    public Estate $estate;

    /**
     * Inisialisasi data properti, eager-load relasi, dan konfigurasi SEO Runtime.
     */
    public function mount(Estate $estate, ConfigureEstateSeo $configureEstateSeo): void
    {
        $this->estate = $estate->load([
            'user',
            'attachments',
            'facilities',
            'city',
            'district',
            'province'
        ]);

        $configureEstateSeo($this->estate);
    }

    /**
     * Generate URL Simulasi KPR dengan parameter harga & mode agent.
     */
    public function getKprUrlProperty(): string
    {
        return route('mortgage.calculator', [
            'mode' => 'agent',
            'price' => $this->estate->price ?? 0,
            'condition' => $this->estate->is_secondary ? 'used' : 'new',
        ]);
    }

    /**
     * Render halaman detail properti.
     */
    public function render(): View
    {
        return view('livewire.pages.estates.estate-show');
    }
}
