<?php

namespace App\Livewire\Pages;

use App\Models\Estate;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class AgentDashboard extends Component
{
    use WithPagination;
    public function deleteEstate(int $id): void
    {
        $estate = Estate::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($estate) {
            $estate->delete();
            session()->flash('success', 'Properti berhasil dihapus!');
        }
    }

    public function render()
    {
        $userId = Auth::id();

        $userEstates = Estate::where('user_id', $userId)
            ->with(['primaryImage', 'attachments', 'city', 'district'])
            ->latest()
            ->paginate(5);

        return view('livewire.pages.agent-dashboard', [
            'estates' => $userEstates,
            'listingCount' => Estate::where('user_id', $userId)->count(),
        ]);
    }
}
