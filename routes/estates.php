<?php

/**
 * <meta_config>
 * @path             : routes/estates.php
 * @usage            : Domain-Specific Routing for Estate Listings & Management
 * @type             : Domain Route Delegator
 *
 * @expected_groups  : [Public & Agent Authenticated Estate Operations]
 *   - Public Listing : Browse all properties (`/listings`)
 *   - Public Detail  : Estate detail view (`/estates/{estate:slug}`)
 *   - Agent Actions  : Estate Form Create & Edit (`middleware: auth`)
 *
 * @ruling_v1_1_6_routing : [STRICT ROUTING GOVERNANCE]
 *   1. ZERO INLINE CLOSURES : All routes delegate to Livewire Components.
 *   2. WILDCARD BOTTOM PLACEMENT : Dynamic slug parameters MUST stay at the bottom of dynamic definitions.
 *
 * @created | updated : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

use App\Livewire\Pages\Estates\EstateForm;
use App\Livewire\Pages\Estates\EstateListing;
use App\Livewire\Pages\Estates\EstateShow;
use App\Livewire\Pages\Estates\PublicListing;
use Illuminate\Support\Facades\Route;

// Public Estate Listing
Route::get('/listings', PublicListing::class)->name('listings.index');

// Authenticated Estate Management
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/estates', EstateListing::class)->name('dashboard.estates');
    Route::get('/estates/create', EstateForm::class)->name('estates.create');
    Route::get('/estates/{estate:slug}/edit', EstateForm::class)->name('estates.edit');
});

// Wildcard Detail Route (Bottom Placement)
Route::get('/estates/{estate:slug}', EstateShow::class)->name('estates.show');
