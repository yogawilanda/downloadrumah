<?php

/**
 * <meta_config>
 * @path : app/Livewire/Pages/Estates/EstateListing.php | usage: Livewire Component for Estate Listings Tabbed View
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : false | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Pages\Estates;

use App\Models\Estate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EstateListing extends Component
{
    use WithPagination;

    /**
     * Tab aktif: 'my_listings' | 'co_broke' | 'drafts'
     */
    public string $tab = 'my_listings';

    /**
     * Mengubah tab aktif dan me-reset paginasi.
     */
    public function setTab(string $tabName): void
    {
        $this->tab = $tabName;
        $this->resetPage();
    }

    /**
     * Soft delete properti milik pengguna yang sedang login.
     */
    public function deleteEstate(int $id): void
    {
        $estate = Estate::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($estate) {
            $estate->delete();
            session()->flash('success', 'Properti berhasil dihapus.');
        }
    }

    /**
     * Render komponen listing properti.
     */
    public function render(): View
    {
        $userId = Auth::id();

        $estates = Estate::query()
            ->forListingTab($this->tab, $userId)
            ->with(['primaryImage', 'city'])
            ->latest()
            ->paginate(10);

        return view('livewire.pages.estates.estate-listing', [
            'estates' => $estates,
        ]);
    }
}
