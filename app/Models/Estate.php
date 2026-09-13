<?php

/**
 * <meta_config>
 * @path             : app/Models/Estate.php
 * @usage            : Core Eloquent Model for Estate Listings (Domain Entity & Trait Orchestrator)
 * @type             : Eloquent Model (Data Layer & Accessor Fallbacks)
 * @table            : estates (God Table Schema - 40+ columns)
 *
 * @expected_attributes : [MAX 5-7 Core Casts & Accessors]
 *   - price (int)                         : Base listing transaction price
 *   - formatted_price (string)            : Accessor full Rupiah format ("Rp 1.200.000.000")
 *   - short_price (string)                : Accessor compact Rupiah format ("1,2 M")
 *   - location_label (string)             : Accessor full geographical location label
 *   - short_location_label (string)       : Accessor district & city location label
 *
 * @expected_relations  : [MAX 3-5 Core Relations -> Target Split via Domain Traits]
 *   - user() (BelongsTo)                  : Listing owner account
 *   - primaryImage() (HasOne)             : Primary thumbnail attachment photo
 *
 * @scopes_and_methods  : [MAX 3-5 Active Query Scopes]
 *   - scopeActive(Builder)                : Combined published & available listing filter
 *
 * @tech_debt        : [VERBOSE ARCHITECTURAL AUDIT & TRAIT CODE SMELLS]
 *   - DB GOD TABLE OVERHEAD : Migration `estates` has 40+ columns causing severe I/O latency during INSERT operations[cite: 12].
 *   - TRAIT OVERCROWDING    : `HasEstateRelations` hosts 7 relations (Geo Laravolt, Media, Core) violating MAX 3-5 limits.
 *   - SCOPE LOGIC LEAKAGE   : `HasEstateAttributes` hosts 8 scopes including `scopeForListingTab` which leaks UI state (`match ($tab)`).
 *   - PHANTOM REL DETECTED  : `HasEstateAttributes` uses `$this->districtRelation?->name` which is UNDEFINED in `HasEstateRelations`.
 *   - MISSING FALLBACK      : `primaryImage()` returns raw Model/null without default placeholder image URL fallback.
 *   - REFACTOR REQUIREMENT  : Parent MUST enforce splitting `HasEstateRelations` into `HasEstateLocation` & `HasEstateMedia`.
 *
 * @ruling           : Max 100 total lines. Exceed? Modularize via Concerns/Traits.
 * @ruling_scope     : ISOLATION & CLEAN QUERYING. No raw .where() chains in Controllers/Methods. Complex multi-join queries MUST move to Query Classes.
 * @ruling_type      : STRICT TYPE SAFETY. Explicit return types required for all relations, accessors, and scopes. Use PHPDoc annotations for IDE autocompletion across Traits.
 * @ruling_model     : LEAN ATTRIBUTES & ENCAPSULATION. Max 5-7 core casts. All null checks & image placeholders MUST use modern Attribute::make().
 * @ruling_ui        : NO UI LEAKAGE. Model must NEVER know about request tab parameters, form inputs, or UI states.
 *
 * @created | updated : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Models;

use App\Models\Concerns\HasEstateAttributes;
use App\Models\Concerns\HasEstateRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Estate
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property int $price
 * @property string $formatted_price
 * @property string $short_price
 * @property string $location_label
 * @property string $short_location_label
 *
 * @mixin HasEstateAttributes
 * @mixin HasEstateRelations
 */
class Estate extends Model
{
    use HasFactory, SoftDeletes, HasEstateAttributes, HasEstateRelations;

    /**
     * Mass assignment protection guard.
     */
    protected $guarded = ['id'];

    /**
     * Core type casting rules (Slim Casts Rule: Max 5-7 primary items).
     */
    protected $casts = [
        'is_kpr' => 'boolean',
        'show_map' => 'boolean',
        'show_owner_phone' => 'boolean',
        'price' => 'integer',
        'commission_percentage' => 'decimal:2',
        'building_width' => 'decimal:2',
        'building_length' => 'decimal:2',
    ];

    /**
     * Explicit Return Type for Route Key Name
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
