<?php

/**
 * <meta_config>
 * @path : app/Models/Concerns/HasEstateRelations.php | usage: Eloquent Relations Trait for Estate Model
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Models\Concerns;

use App\Models\EstateAttachment;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Province;

trait HasEstateRelations
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'code');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'estate_facility')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(EstateAttachment::class);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(EstateAttachment::class)->ofMany([
            'is_primary' => 'max',
            'id' => 'max',
        ]);
    }
}
