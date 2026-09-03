<?php

/**
 * <meta_config>
 * @path : app/Http/Middleware/LogPageView.php | usage: Automatic Level 1 Traffic Logging Middleware
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogPageView
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        /**
         * Step 1.1: Bypass Static Assets & System Routes
         */
        if ($request->is('storage/*', 'build/*', 'favicon.ico', 'api/*')) {
            return $response;
        }

        /**
         * Step 1.2: Record Page View Telemetry
         */
        try {
            DB::table('activity_logs')->insert([
                'user_id'    => Auth::id(),
                'module'     => 'traffic',
                'event_name' => 'page_view',
                'payload'    => json_encode([
                    'url'        => $request->fullUrl(),
                    'session_id' => $request->session()->getId(),
                ]),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {
            /**
             * Step 1.3: Fail-safe Exception Handling
             */
            Log::error('Pageview Logging Failed: ' . $e->getMessage());
        }

        return $response;
    }
}
