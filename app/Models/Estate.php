<?php
// loc      : app/Models/Estate.php
// usage    : Main Eloquent Model for Estate Listings with Formatted Price Accessors & JSON Attribute Helpers
// status   : Production Ready (Synced with database migration schema 2026_08_24_042555)
// final verdict : Optimized model with clean accessors, scope filters, and custom JSON casting logic

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Province;

class Estate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Type casting for native and dynamic JSON attributes.
     */
    protected $casts = [
        'price'                 => 'decimal:2',
        'commission_percentage' => 'decimal:2',
        'building_width'        => 'decimal:2',
        'building_length'       => 'decimal:2',
        'show_map'              => 'boolean',
        'attributes'            => 'array',
    ];

    /**
     * Use 'slug' column for Implicit Route Model Binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS & MUTATORS
    |--------------------------------------------------------------------------
    */

    // 1. Accessor Format Rupiah Lengkap: Rp 1.200.000.000
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->price ?? 0, 0, ',', '.')
        );
    }

    // 2. Accessor Format Ringkas: 1,2 M / 850 Jt
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

    // 3. Helper Accessor untuk membaca spesifikasi opsional dari kolom JSON attributes dengan aman
    protected function attr(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Decode JSON dari raw attributes jika berupa string, atau gunakan array yang sudah ter-cast
                $json = is_string($this->attributes['attributes'] ?? null)
                    ? json_decode($this->attributes['attributes'], true)
                    : ($this->attributes['attributes'] ?? []);

                return (object) [
                    'is_kpr'            => $json['is_kpr'] ?? false,
                    'has_imb'           => $json['has_imb'] ?? false,
                    'has_blueprint'     => $json['has_blueprint'] ?? false,
                    'legal_docs'        => $json['legal_docs'] ?? null,
                    'promo_cooperation' => $json['promo_cooperation'] ?? null,
                    'agent_cooperation' => $json['agent_cooperation'] ?? false,
                    'electricity'       => $json['electricity'] ?? null,
                    'water_type'        => $json['water_type'] ?? null,
                    'nearest_places'    => $json['nearest_places'] ?? [],
                    'video_url'         => $json['video_url'] ?? null,
                ];
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPES (Quick Filter Engine)
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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

    public function attachments(): HasMany
    {
        return $this->hasMany(EstateAttachment::class);
    }

    public function primaryImage(): HasOne
    {
        // Utamakan yang is_primary = true, kalau tidak ada otomatis ambil gambar terbaru (ID paling besar)
        return $this->hasOne(EstateAttachment::class)->ofMany([
            'is_primary' => 'max',
            'id'         => 'max',
        ]);
    }
}
