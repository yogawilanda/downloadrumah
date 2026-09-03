<?php

/**
 * <meta_config>
 * @path : app/Http/Controllers/Api/ActivityLogController.php | usage: API Endpoint for Event Telemetry
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActivityLogController extends Controller
{
    /**
     * Record User Behavioral Events
     */
    public function store(Request $request): JsonResponse
    {
        /**
         * Step 1.1: Request Payload Validation
         */
        $validated = $request->validate([
            'module'     => 'required|string|max:50',
            'event_name' => 'required|string|max:100',
            'payload'    => 'nullable|array',
        ]);

        /**
         * Step 1.2: Enrich Payload with Safe Session ID Detection
         */
        $payload = $validated['payload'] ?? [];
        if (! isset($payload['session_id']) && $request->hasSession()) {
            $payload['session_id'] = $request->session()->getId();
        }

        /**
         * Step 1.3: Asynchronous Insert to Activity Log
         */
        try {
            DB::table('activity_logs')->insert([
                'user_id' => Auth::id(),
                'module'     => $validated['module'],
                'event_name' => $validated['event_name'],
                'payload'    => json_encode($payload),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['status' => 'success'], 201);
        } catch (\Throwable $e) {
            Log::error('API Event Logging Failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Logging failed'], 500);
        }
    }
}
