<?php

/**
 * <meta_config>
 * @path : app/Helpers/settings.php | usage: Global helper functions for runtime settings
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * @author : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

use App\Services\SettingsService;

if (!function_exists('setting')) {
    /**
     * Resolve a runtime setting value with optional default.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return app(SettingsService::class)->get($key, $default);
    }
}

if (!function_exists('setting_set')) {
    /**
     * Persist a runtime setting value.
     */
    function setting_set(string $key, mixed $value, ?int $userId = null): void
    {
        app(SettingsService::class)->set($key, $value, $userId);
    }
}
