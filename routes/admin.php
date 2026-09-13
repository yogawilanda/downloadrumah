<?php

use App\Http\Controllers\Admin\ExportActivityLogController;
use App\Livewire\Pages\Admin\Insights\Index as InsightsIndex;
use App\Livewire\Pages\Admin\Settings\Index as SettingsIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Isolated Super Admin Routes
| Auto-prefixed with '/admin', named 'admin.*', & protected by 'super_admin'
|--------------------------------------------------------------------------
*/

Route::get('/settings', SettingsIndex::class)->name('settings.index');
Route::get('/insights', InsightsIndex::class)->name('insights.index');
Route::get('/insights/export-csv', ExportActivityLogController::class)->name('insights.export-csv');
