<?php

/**
 * <meta_config>
 * @path             : app/Http/Middleware/LogPageView.php
 * @usage            : Global HTTP Middleware for Page View & Visitor Telemetry Tracking
 * @type             : HTTP Middleware (Telemetry Layer)
 *
 * @expected_params  : Illuminate\Http\Request $request, Closure $next
 * @expected_output  : Symfony\Component\HttpFoundation\Response
 *
 * @tech_debt        : [Middleware Performance & Async Audit]
 *   - SYNCHRONOUS DB LOGGING : `ActivityLog::create` berjalan secara sinkron di setiap request GET. Jika trafik tinggi, pertimbangkan queue/job async atau buffer log agar tidak membebani latency response.
 *   - TRAIT DEPENDENCY : Bergantung pada `HasUserAgentParser` dari namespace API Controller (`App\Http\Controllers\Api\Concerns`). Idealnya dipindah ke global Concern jika dipakai lintas layer.
 *
 * @ruling           : Max 100 total lines of code. Exceed? Modularize via Concerns/Jobs.
 * @ruling           : Max params 3-5, exceed Modularize to trait
 * @ruling_scope     : FILTERED LOGGING. Skips non-GET requests, JSON API calls, and asset streams.
 * @ruling_privacy   : USER IDENTIFICATION. Gracefully captures `user_id` (null if guest) and session ID.
 *
 * @created | updated : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Http\Middleware;

use App\Http\Controllers\Api\Concerns\HasUserAgentParser;
use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogPageView
{
    use HasUserAgentParser;

    /**
     * Handle an incoming request for page view analytics.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        /**
         * Step 1.1: Skip non-GET requests and internal API/Asset calls
         */
        if (! $request->isMethod('GET') || $request->expectsJson() || $request->is('api/*')) {
            return $response;
        }

        /**
         * Step 1.2: Record Page View via ActivityLog Model
         */
        ActivityLog::create([
            'user_id'    => Auth::id(),
            'module'     => 'traffic',
            'event_name' => 'page_view',
            'payload'    => [
                'url'         => $request->fullUrl(),
                'session_id'  => $request->hasSession() ? $request->session()->getId() : null,
                'date_logged' => now()->toDateString(),
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $this->parseUserAgent($request->userAgent()),
        ]);

        return $response;
    }
}
