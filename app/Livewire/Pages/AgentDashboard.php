<?php

namespace App\Livewire\Pages;

use App\Models\Estate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class AgentDashboard extends Component
{
    use WithPagination;

    public function deleteEstate(int $id): void
    {
        $estate = Estate::where('id', $id)->where('user_id', Auth::id())->first();
        if ($estate) {
            $estate->delete();
            session()->flash('success', 'Properti berhasil dihapus!');
        }
    }

    public function render()
    {
        $userEstates = Estate::where('user_id', Auth::id())
            ->with(['primaryImage', 'attachments'])
            ->latest()
            ->paginate(5);

        return view('livewire.pages.agent-dashboard', [
            'estates' => $userEstates,
            'activeCount' => Estate::where('user_id', Auth::id())->count(),
        ]);
    }
}
