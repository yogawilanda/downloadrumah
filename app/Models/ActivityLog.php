<?php

/**
 * <meta_config>
 * @path : app/Models/ActivityLog.php | usage: Eloquent Model for Activity Telemetry
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'module',
        'event_name',
        'payload',
        'ip_address',
        'user_agent',
    ];

    /**
     * Automatic JSON Casting for Payload Attribute
     */
    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }

    /**
     * Format Date Output for JSON Serialization
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Relationship to User Model
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Local Scope: Apply Common Query Filters
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['module'] ?? null, fn ($q, $m) => $q->where('module', $m))
            ->when($filters['event_name'] ?? null, fn ($q, $e) => $q->where('event_name', $e))
            ->when($filters['user_id'] ?? null, fn ($q, $u) => $q->where('user_id', $u))
            ->when($filters['date'] ?? null, fn ($q, $d) => $q->whereDate('created_at', $d));
    }
}
