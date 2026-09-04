<?php

/**
 * <meta_config>
 * @path : app/Models/Concerns/HasEstateAttributes.php | usage: Accessors & Scopes Trait for Estate
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasEstateAttributes
{
    /**
     * Accessor Format Rupiah Lengkap: Rp 1.200.000.000
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->price ?? 0, 0, ',', '.')
        );
    }

    /**
     * Accessor Format Ringkas: 1,2 M / 850 Jt
     */
    protected function shortPrice(): Attribute
    {
        return Attribute::make(
            get: function () {
                $price = $this->price ?? 0;
                if ($price >= 1000000000) {
                    $formatted = number_format($price / 1000000000, 1, ',', '.');
                    return rtrim(rtrim($formatted, '0'), ',') . ' M';
                } elseif ($price >= 1000000) {
                    $formatted = number_format($price / 1000000, 1, ',', '.');
                    return rtrim(rtrim($formatted, '0'), ',') . ' Jt';
                }
                return 'Rp ' . number_format($price, 0, ',', '.');
            }
        );
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeForSale($query)
    {
        return $query->where('transaction_type', 'sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('transaction_type', 'rent');
    }

    public function scopeForRentAndSell($query)
    {
        return $query->where('transaction_type', 'sale & rent');
    }

    public function scopeForListingTab($query, string $tab, int $userId)
    {
        return match ($tab) {
            'my_listings' => $query->where('user_id', $userId),
            'co_broke'    => $query->where('user_id', '!=', $userId)->active(),
            'drafts'      => $query->where('user_id', $userId)->where('status', 'draft'),
            default       => $query->where('user_id', $userId),
        };
    }
}
