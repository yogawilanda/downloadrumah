<?php

/**
 * <meta_config>
 * @path : app/Services/SettingsService.php | usage: Centralized read/write for runtime settings
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * @author : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    private const CACHE_KEY = 'app.settings';
    private const CACHE_TTL = 3600;

    /**
     * Read a setting value with type casting. Falls back to $default.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $settings = $this->all();

        if (!array_key_exists($key, $settings)) {
            return $default;
        }

        return $settings[$key];
    }

    /**
     * Read raw text value without casting.
     */
    public function raw(string $key, mixed $default = null): ?string
    {
        $row = Setting::where('key', $key)->first();
        return $row?->value ?? (is_scalar($default) ? (string) $default : null);
    }

    /**
     * Persist a setting value and refresh the cache.
     */
    public function set(string $key, mixed $value, ?int $userId = null): Setting
    {
        $row = Setting::firstOrNew(['key' => $key]);

        if (!$row->exists) {
            $row->type = $this->inferType($value);
        }

        $row->setTypedValueAttribute($value);
        $row->updated_by = $userId;
        $row->save();

        $this->flush();

        return $row;
    }

    /**
     * Get all settings as a typed key => value array.
     */
    public function all(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            try {
                return Setting::query()
                    ->get(['key', 'value', 'type'])
                    ->mapWithKeys(fn ($s) => [
                        $s->key => match ($s->type) {
                            'integer' => (int) $s->value,
                            'boolean' => (bool) $s->value,
                            'json' => $s->value ? json_decode($s->value, true) : null,
                            default => (string) $s->value,
                        },
                    ])
                    ->all();
            } catch (\Throwable $e) {
                // Settings table not yet migrated (e.g. during package:discover).
                return [];
            }
        });
    }

    /**
     * Clear the in-memory settings cache.
     */
    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Guess a sensible type from the supplied value.
     */
    private function inferType(mixed $value): string
    {
        return match (true) {
            is_bool($value) => 'boolean',
            is_int($value) => 'integer',
            is_array($value) => 'json',
            default => 'string',
        };
    }
}
