<?php

/**
 * <meta_config>
 * @path             : routes/web.php
 * @usage            : Public & Agent Web Routing Entrypoint & Public Domain Orchestrator
 * @type             : Routing Orchestrator
 *
 * @expected_groups  : [Route Domains & Middlewares]
 *   - Public Routes    : Home Feed, Link-in-Bio Catalog, KPR Tools, & Static Legal pages
 *   - Auth Subsystem   : Authentication & Session Routes (`auth.php`)
 *   - Estate Subsystem : Managed in `routes/estates.php`
 *
 * @ruling_v1_1_6_routing : [STRICT ROUTING GOVERNANCE]
 *   1. ROUTE DELEGATION & ISOLATION : Keep file lean (< 100 LOC). Delegated to domain files.
 *   2. ZERO INLINE CLOSURES         : NO inline closures for business logic.
 *
 * @tech_debt        : [ROUTING LEAKAGE & STRUCTURAL AUDIT]
 *   - INLINE CLOSURES IN ROUTER     : Media direct access (`/media/{path}`) performs file checking inline. Move to `MediaStreamController`.
 *   - Bounded Dashboard Route : Based on agnosticism/ddd approach that using user/entity centric, it breaks the contracts of /dashboard, because dashboard in broadview are user for all type of authenticated entity. Solution is /<authenticated_entity_type>/dashboard since this is internal route which not required to implement SEO. But try argue me.
 *
 * @created | updated : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

use App\Http\Controllers\SitemapController;
use App\Livewire\Pages\AgentDashboard;
use App\Livewire\Pages\Catalog\PublicCatalog;
use App\Livewire\Pages\Catalog\PublicCatalogDetail;
use App\Livewire\Pages\Home\HomeFeed;
use App\Livewire\Pages\Profile\Profile;
use App\Livewire\Pages\Supports\ReleaseNotes;
use App\Livewire\Pages\Supports\SupportCenter;
use App\Livewire\Pages\Terms\TermsAndConditions;
use App\Livewire\Pages\Tools\MortgageCalculator;
use App\Livewire\PrivacyPolicy;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', HomeFeed::class)->middleware('dynamic_throttle:throttle.home_feed,1')->name('home');
Route::get('/agen-properti/{username}', PublicCatalog::class)->name('catalog.show');
Route::get('/agen-properti/{username}/p/{estate:slug}', PublicCatalogDetail::class)->name('catalog.detail');
Route::get('/kpr', MortgageCalculator::class)->name('mortgage.calculator');

// Public Media Storage Direct Access
Route::get('/media/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);
    if (! file_exists($file)) {
        abort(404);
    }
    return Response::file($file);
})->where('path', '.*');

// Static Pages
Route::get('/privacy', PrivacyPolicy::class)->name('privacy');
Route::get('/terms', TermsAndConditions::class)->name('terms');
Route::get('/support', SupportCenter::class)->name('support');
Route::get('/release-notes', ReleaseNotes::class)->name('release-notes');

// generative sitemap to register dynamic xml on public
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

/*
|--------------------------------------------------------------------------
| Authenticated Core Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', AgentDashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
});

/*
|--------------------------------------------------------------------------
| Domain Delegates
|--------------------------------------------------------------------------
*/

// Domain Estates (IDE-friendly Ctrl+Clickable)
Route::middleware('web')->group(base_path('routes/estates.php'));

// Subsystem Auth
require __DIR__ . '/auth.php';
