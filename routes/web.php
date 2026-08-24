<?php

use App\Livewire\HomeFeed;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/', HomeFeed::class)->name('home');

require __DIR__.'/auth.php';
