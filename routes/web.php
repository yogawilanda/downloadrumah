<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response; // <-- TAMBAHKAN INI
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

Route::get('/media/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);
    if (!file_exists($file)) abort(404);
    return Response::file($file);
})->where('path', '.*');

// Auth Routes (Create & Edit)
Route::middleware(['auth'])->group(function () {
    Route::get('/estates/create', EstateForm::class)->name('estates.create');
    Route::get('/dashboard', AgentDashboard::class)->name('dashboard');
    Route::get('/estates/{estate:slug}/edit', EstateForm::class)->name('estates.edit');
});

Route::post('/logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Halaman Detail Properti (Public / Dynamic Wildcard)
Route::get('/estates/{estate:slug}', EstateShow::class)->name('estates.show');

require __DIR__ . '/auth.php';
