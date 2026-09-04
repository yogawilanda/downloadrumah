<?php

/**
 * <meta_config>
 * @path : app/Models/Estate.php | usage: Main Eloquent Model for Estate Listings
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Models;

use App\Models\Concerns\HasEstateAttributes;
use App\Models\Concerns\HasEstateRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estate extends Model
{
    use HasFactory, SoftDeletes, HasEstateAttributes, HasEstateRelations;

    protected $guarded = ['id'];

    protected $casts = [
        'is_kpr' => 'boolean',
        'show_map' => 'boolean',
        'show_owner_phone' => 'boolean',
        'price' => 'integer',
        'commission_percentage' => 'decimal:2',
        'building_width' => 'decimal:2',
        'building_length' => 'decimal:2',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
