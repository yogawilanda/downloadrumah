<?php

/**
 * <meta_config>
 * @path : app/Http/Middleware/DynamicThrottle.php
 * @usage : Per-request throttle that resolves its limit from a runtime setting key
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * @author : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class DynamicThrottle
{
    public function __construct(private readonly RateLimiter $limiter) {}

    /**
     * Usage in route:
     *   ->middleware('dynamic_throttle:throttle.home_feed,1')
     *
     * The first parameter is the settings key holding the per-minute limit.
     * The optional second parameter is the decay window in minutes (default 1).
     */
    public function handle(Request $request, Closure $next, string $settingKey = 'throttle.default', string $decayMinutes = '1'): Response
    {
        // Read fresh from DB each request (cache is handled inside setting()).
        $maxAttempts = max(1, (int) setting($settingKey, 60));
        $decay = max(1, (int) $decayMinutes);

        $key = $this->resolveKey($request, $settingKey);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            $retryAfter = $this->limiter->availableIn($key);
            return response()->json([
                'message' => 'Terlalu banyak permintaan. Coba lagi dalam ' . $retryAfter . ' detik.',
            ], 429)->header('Retry-After', (string) $retryAfter);
        }

        $this->limiter->hit($key, $decay * 60);

        $response = $next($request);

        $remaining = max(0, $maxAttempts - $this->limiter->attempts($key));
        return $response->withHeaders([
            'X-RateLimit-Limit'     => (string) $maxAttempts,
            'X-RateLimit-Remaining' => (string) $remaining,
        ]);
    }

    /**
     * Build the rate-limit key. Falls back to IP for unauthenticated routes.
     */
    private function resolveKey(Request $request, string $settingKey): string
    {
        $identity = $request->user()?->id
            ?? $request->ip()
            ?? 'anonymous';

        return 'dyn_throttle|' . $settingKey . '|' . $identity;
    }
}
