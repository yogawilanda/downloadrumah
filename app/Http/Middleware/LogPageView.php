<?php

/**
 * <meta_config>
 * @path : app/Http/Middleware/LogPageView.php | usage: Global Web Traffic Telemetry Middleware
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
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
