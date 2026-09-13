<?php

/**
 * <meta_config>
 * @path             : app/Models/ActivityLog.php
 * @usage            : Eloquent Model for Activity Telemetry (Consumed by Controller, API, & Alpine.js)
 * @type             : Eloquent Model (Data Layer & Accessor Fallbacks)
 * @table            : activity_logs
 *
 * @expected_attributes : [MAX 5-7 Core Casts & Accessors]
 *   - payload (array)                     : Auto-cast JSON telemetry payload
 *
 * @expected_relations  : [MAX 3-5 Relationships]
 *   - user() (BelongsTo)                  : Linked User account model (Nullable for guests)
 *
 * @scopes_and_methods  : [MAX 3-5 Query Scopes & Formatters]
 *   - serializeDate(DateTimeInterface)    : Standard JSON timestamp serializer
 *   - scopeFilter(Builder, array)         : Filter logs by module, event_name, user_id, date
 *
 * @tech_debt        : [Logic Leakage & Filter Audit]
 *   - UI ID MASK DECODING: `scopeFilter` performs `base_convert()` unmasking logic inside query scope.
 *   - REFACTOR TARGET    : Move ID unmasking to Form Request / Action Class before passing to `scopeFilter`.
 *
 * @ruling           : Max 100 total lines. Exceed? Modularize via Concerns/Traits.
 * @overflow_action  : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * @ruling_scope     : ISOLATION & CLEAN QUERYING. Scope handles pure DB queries only. Decode masked IDs before scope entry.
 * @ruling_type      : STRICT TYPE SAFETY. Explicit DateTimeInterface type-hinting & return types on relations.
 * @ruling_model     : LEAN ATTRIBUTES. Auto-cast payload array cleanly.
 * @ruling_ui        : NO UI LEAKAGE. Unmasking obfuscated string parameters belongs in Controller/Request layer.
 *
 * @created/updated  : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    /**
     * Allow mass assignment for telemetry insert.
     */
    protected $guarded = ['id'];

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
            ->when($filters['user_id'] ?? null, function ($q, $u) {
                // Konversi angka ter-mask kembali ke Integer jika dikirim dalam bentuk masked string
                $realUserId = is_numeric($u) ? $u : ((int) base_convert($u, 36, 10) - 100000);
                return $q->where('user_id', $realUserId);
            })
            ->when($filters['date'] ?? null, fn ($q, $d) => $q->whereDate('created_at', $d));
    }
}
