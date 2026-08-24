<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'attributes' => 'array',
    ];

    // 1. Accessor Format Rupiah Lengkap: Rp 1.200.000.000
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->price, 0, ',', '.')
        );
    }

    // 2. Accessor Format Ringkas: 1,2 M / 850 Jt
    protected function shortPrice(): Attribute
    {
        return Attribute::make(
            get: function () {
                $price = $this->price;
                if ($price >= 1000000000) {
                    return number_format($price / 1000000000, 1, ',', '.') . ' M';
                } elseif ($price >= 1000000) {
                    return number_format($price / 1000000, 0, ',', '.') . ' Jt';
                }
                return 'Rp ' . number_format($price, 0, ',', '.');
            }
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(EstateAttachment::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(EstateAttachment::class)->where('is_primary', true);
    }
}
