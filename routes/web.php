<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomeFeed;
use App\Livewire\Pages\AgentDashboard;
use App\Livewire\Pages\Estates\EstateForm;
use App\Livewire\Pages\Estates\EstateShow;

Route::get('/', HomeFeed::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Auth Routes (Create & Edit)
Route::middleware(['auth'])->group(function () {
    // Route static /create HARUS sebelum route dynamic /{estate:slug}
    Route::get('/estates/create', EstateForm::class)->name('estates.create');

    Route::get('/dashboard', AgentDashboard::class)->name('dashboard');
    Route::get('/estates/{estate:slug}/edit', EstateForm::class)->name('estates.edit');
});




// Halaman Detail Properti (Public / Dynamic Wildcard)
Route::get('/estates/{estate:slug}', EstateShow::class)->name('estates.show');

require __DIR__ . '/auth.php';
