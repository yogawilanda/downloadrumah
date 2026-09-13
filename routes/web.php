<?php

/**
 * <meta_config>
 * @path             : routes/web.php
 * @usage            : Public & Agent Web Routing Entrypoint & Public Domain Orchestrator
 * @type             : Routing Orchestrator
 *
 * @expected_groups  : [Route Domains & Middlewares]
 *   - Public Routes    : Home Feed, Link-in-Bio Catalog, KPR Tools, & Static Legal pages (Unauthenticated)
 *   - Auth Subsystem   : Authentication & Session Routes (`auth.php`)
 *   - Agent Dashboard  : Authenticated Agent Workspace & Estate Listing CRUD (`middleware: auth`)
 *   - Wildcard Routes  : Estate Public Detail View (`/estates/{estate:slug}`)
 *
 * @ruling_v1_1_6_routing : [STRICT ROUTING GOVERNANCE]
 *   1. ROUTE DELEGATION & ISOLATION   : Keep file lean (< 100 LOC). Sensitive routes MUST be isolated in dedicated files (`routes/admin.php`).
 *   2. ZERO INLINE CLOSURES           : NO inline closures for business/file logic. Refactor `/media/{path}` & `/logout` to dedicated Controllers.
 *   3. WILDCARD PARAMETER ORDERING    : Dynamic slug parameters (`/estates/{slug}`) MUST sit at the bottom to prevent route matching collisions.
 *   4. TYPE-SAFE DOT NAMING           : All routes MUST use explicit dot-notation naming (`catalog.show`, `estates.create`).
 *
 * @tech_debt        : [ROUTING LEAKAGE & STRUCTURAL AUDIT]
 *   - INLINE CLOSURES IN ROUTER       : Media direct access (`/media/{path}`) performs file checking inline. Move to `MediaStreamController`.
 *
 * @created | updated : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

use App\Livewire\Pages\AgentDashboard;
use App\Livewire\Pages\Catalog\PublicCatalog;
use App\Livewire\Pages\Catalog\PublicCatalogDetail;
use App\Livewire\Pages\Estates\EstateForm;
use App\Livewire\Pages\Estates\EstateListing;
use App\Livewire\Pages\Estates\EstateShow;
use App\Livewire\Pages\Estates\PublicListing;
use App\Livewire\Pages\Home\HomeFeed;
use App\Livewire\Pages\Profile\Profile;
use App\Livewire\Pages\Supports\ReleaseNotes;
use App\Livewire\Pages\Supports\SupportCenter;
use App\Livewire\Pages\Terms\TermsAndConditions;
use App\Livewire\Pages\Tools\MortgageCalculator;
use App\Livewire\PrivacyPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', HomeFeed::class)
    ->middleware('dynamic_throttle:throttle.home_feed,1')
    ->name('home');

// Public Catalog Terisolasi (Link-in-bio Agen)
Route::get('/agen-properti/{username}', PublicCatalog::class)
    ->name('catalog.show');

// Public Catalog Terisolasi
Route::get('/agen-properti/{username}/p/{estate:slug}', PublicCatalogDetail::class)
    ->name('catalog.detail');

// Tools KPR
Route::get('/kpr', MortgageCalculator::class)->name('mortgage.calculator');

// Listing untuk semua user
Route::get('/listings', PublicListing::class)->name('listings.index');

// Public Media Storage Direct Access
Route::get('/media/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);
    if (! file_exists($file)) {
        abort(404);
    }
    return Response::file($file);
})->where('path', '.*');

Route::get('/privacy', PrivacyPolicy::class)->name('privacy');
Route::get('/terms', TermsAndConditions::class)->name('terms');

Route::get('/support', SupportCenter::class)->name('support');
Route::get('/release-notes', ReleaseNotes::class)->name('release-notes');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', AgentDashboard::class)->name('dashboard');
    Route::get('/dashboard/estates', EstateListing::class)->name('dashboard.estates');

    Route::get('/estates/create', EstateForm::class)->name('estates.create');
    Route::get('/estates/{estate:slug}/edit', EstateForm::class)->name('estates.edit');

    Route::get('/profile', Profile::class)->name('profile');
});



/*
|--------------------------------------------------------------------------
| Dynamic / Wildcard Routes
| Must be placed in bottom placement.
|--------------------------------------------------------------------------
*/

Route::get('/estates/{estate:slug}', EstateShow::class)->name('estates.show');

require __DIR__ . '/auth.php';
