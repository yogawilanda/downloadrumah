<?php

/**
 * <meta_config>
 * @path : app/Models/Facility.php | usage: Master Facility Eloquent Model
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'icon',
    ];

    /**
     * Relasi ke Estate (Many-to-Many via Pivot)
     */
    public function estates(): BelongsToMany
    {
        return $this->belongsToMany(Estate::class, 'estate_facility')
            ->withPivot('value')
            ->withTimestamps();
    }
}
