<?php

/**
 * <meta_config>
 * @path : routes/api.php | usage: Telemetry & Internal Analytics API Routes
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

use App\Http\Controllers\Api\ActivityLogController;
use Illuminate\Support\Facades\Route;

/**
 * Step 1.1: Web-Session Friendly Telemetry Endpoint
 */
Route::middleware(['web'])->prefix('v1')->group(function () {
    Route::get('/log-activity', [ActivityLogController::class, 'index']);
    Route::get('/log-activity/{id}', [ActivityLogController::class, 'show']);
    Route::post('/log-activity', [ActivityLogController::class, 'store']);
});
