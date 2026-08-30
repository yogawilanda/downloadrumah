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
            get: fn () => (object) [
                'is_kpr'            => $this->attributes['attributes']['is_kpr'] ?? false,
                'has_imb'           => $this->attributes['attributes']['has_imb'] ?? false,
                'has_blueprint'     => $this->attributes['attributes']['has_blueprint'] ?? false,
                'legal_docs'        => $this->attributes['attributes']['legal_docs'] ?? null,
                'promo_cooperation' => $this->attributes['attributes']['promo_cooperation'] ?? null,
                'agent_cooperation' => $this->attributes['attributes']['agent_cooperation'] ?? false,
                'electricity'       => $this->attributes['attributes']['electricity'] ?? null,
                'water_type'        => $this->attributes['attributes']['water_type'] ?? null,
                'nearest_places'    => $this->attributes['attributes']['nearest_places'] ?? [],
                'video_url'         => $this->attributes['attributes']['video_url'] ?? null,
            ]
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
