<?php

/**
 * <meta_config>
 * @path : app/Http/Controllers/Api/ActivityLogController.php | usage: Activity Log Controller using Eloquent Model
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\HasUserAgentParser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityLogRequest;
use App\Http\Resources\ActivityLogResource;
use App\Models\ActivityLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ActivityLogController extends Controller
{
    use HasUserAgentParser;

    /**
     * Step 1.1: Read All Logs with Model Scope
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $logs = ActivityLog::with('user:id,name,email')
            ->filter($request->query())
            ->latest()
            ->paginate($request->query('per_page', 20));

        return ActivityLogResource::collection($logs);
    }

    /**
     * Step 1.2: Read Single Log Detail
     */
    public function show(ActivityLog $activityLog): JsonResponse
    {
        $activityLog->loadMissing('user:id,name,email');

        return response()->json(['status' => 'success', 'data' => new ActivityLogResource($activityLog),]);
    }

    /**
     * Step 1.3: Store Incoming Behavioral Telemetry via Model
     */
    public function store(StoreActivityLogRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $payload = $validated['payload'] ?? [];
        if (! isset($payload['session_id']) && $request->hasSession()) {
            $payload['session_id'] = $request->session()->getId();
        }
        $payload['date_logged'] = now()->toDateString();

        try {
            $log = ActivityLog::create([
                'user_id'    => Auth::id(),
                'module'     => $validated['module'],
                'event_name' => $validated['event_name'],
                'payload'    => $payload,
                'ip_address' => $request->ip(),
                'user_agent' => $this->parseUserAgent($request->userAgent()),
            ]);

            return response()->json([
                'status' => 'success',
                'data' => new ActivityLogResource($log),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('API Event Logging Failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Logging failed'], 500);
        }
    }
}
