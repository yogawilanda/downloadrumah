<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\HomeFeed;
use App\Livewire\EstateDetail;

// Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/', HomeFeed::class)->name('home');

Route::get('/estate/{slug}', EstateDetail::class)->name('estate.show');


require __DIR__.'/auth.php';
