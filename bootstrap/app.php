<?php

/**
 * <meta_config>
 * @path : bootstrap/app.php | usage: Application Configuration & Middleware Registration
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

use App\Http\Middleware\DynamicThrottle;
use App\Http\Middleware\EnsureSuperAdmin;
use App\Http\Middleware\LogPageView;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /**
         * Step 1.1: Trust Proxies Configuration
         */
        $middleware->trustProxies(at: '*');

        /**
         * Step 1.2: Register Level 1 Global Web Telemetry
         */
        $middleware->web(append: [
            LogPageView::class,
        ]);

        /**
         * Step 1.3: Register Super Admin Middleware Alias
         */
        $middleware->alias([
            'super_admin' => EnsureSuperAdmin::class,
            'dynamic_throttle' => DynamicThrottle::class,
        ]);

        /**
         * Step 1.4: CSRF Exemption for Fast Store API
         */
        $middleware->preventRequestForgery(except: [
            'api/v1/estates/fast-store',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /**
         * Step 1.3: Render JSON Exception Strategy
         */
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );


    })->create();
