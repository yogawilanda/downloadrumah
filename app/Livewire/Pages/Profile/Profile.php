<?php

/**
 * loc: app/Livewire/Pages/Profile/Profile.php
 * func: Full-page component for user profile management
 */
namespace App\Livewire\Pages\Profile;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Profile extends Component
{
    public function render()
    {
        return view('livewire.pages.profile.profile');
    }
}
