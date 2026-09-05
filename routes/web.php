<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

// Full Pages
use App\Livewire\Pages\Home\HomeFeed;
use App\Livewire\Pages\AgentDashboard;
use App\Livewire\Pages\Tools\MortgageCalculator;

// Component Based / Estates
use App\Livewire\Pages\Estates\EstateForm;
use App\Livewire\Pages\Estates\EstateShow;
use App\Livewire\Pages\Estates\EstateListing;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', HomeFeed::class)->middleware('throttle:5,1')->name('home');

// Tools KPR (Perbaikan Typo & Penamaan Route)
Route::get('/kpr', MortgageCalculator::class)->name('mortgage.calculator');

// Public Media Storage Direct Access
Route::get('/media/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);
    if (!file_exists($file))
        abort(404);
    return Response::file($file);
})->where('path', '.*');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', AgentDashboard::class)->name('dashboard');
    Route::get('/listings', EstateListing::class)->name('listings.index');

    Route::get('/estates/create', EstateForm::class)->name('estates.create');
    Route::get('/estates/{estate:slug}/edit', EstateForm::class)->name('estates.edit');

    Route::view('profile', 'profile')->name('profile');
});

Route::post('/logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Dynamic / Wildcard Routes :
| Must be placed in bottom placement.
|--------------------------------------------------------------------------
*/

Route::get('/estates/{estate:slug}', EstateShow::class)->name('estates.show');

require __DIR__ . '/auth.php';
