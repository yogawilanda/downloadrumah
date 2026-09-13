<?php

/**
 * <meta_config>
 * @path             : app/Models/EstateAttachment.php
 * @usage            : Eloquent Model for Estate Photo & Document Media Attachments
 * @type             : Eloquent Model (Data Layer & Accessor Fallbacks)
 * @table            : estate_attachments
 *
 * @expected_attributes : [MAX 5-7 Core Casts & Accessors]
 *   - is_primary (bool)       : Flag for primary thumbnail status
 *   - sort_order (int)        : Custom display sequence order
 *   - url (string)            : Graceful fallback accessor for photo URL / fallback image
 *
 * @expected_relations  : [MAX 3-5 Relationships]
 *   - estate() (BelongsTo)                : Parent Estate model listing
 *
 * @scopes_and_methods  : [MAX 3-5 Scopes & Helpers]
 *   - None (Rely on parent HasEstateMedia relation ordering)
 *
 * @tech_debt        : [Fallback & Storage Safety Audit]
 *   - FALLBACK IMPLEMENTED (Done, need validation) : Added default `/images/placeholder-estate.webp` if `file_path` is empty/missing.
 *   - LIVEWIRE TMP DRIVER(In Progress)  : Temporary Livewire uploads check storage existence directly.
 *   - TRAIT REFACTOR PENDING : Extract complex `url()` accessor (external URL, livewire-tmp, clean path, custom media route) into dedicated trait (e.g. `HasEstateMediaAccessors`) to keep model slim without losing edge-case context.
 *
 * @ruling           : Max 100 total lines of codes. Exceed? Modularize via Concerns/Traits.
 * @overflow_action  : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * @ruling_scope     : ISOLATION & CLEAN QUERYING. File resolution logic strictly encapsulated inside Accessor.
 * @ruling_type      : STRICT TYPE SAFETY. Return type BelongsTo explicitly added to `estate()` relationship.
 * @ruling_model     : SINGLE SOURCE OF FALLBACK. Never return null from `url` attribute; always provide fallback asset URL.
 * @ruling_ui        : NO UI LEAKAGE. Storage disk driver checks are abstracted from UI view layer.
 *
 * @created | updated : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class EstateAttachment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Accessor URL Media dengan Graceful Fallback Placeholder Image
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                $fallbackImage = asset('images/placeholder-estate.webp');

                if (! $this->file_path) {
                    return $fallbackImage;
                }

                // 1. Jika berupa URL eksternal lengkap (e.g. Unsplash, S3, Cloudinary)
                if (filter_var($this->file_path, FILTER_VALIDATE_URL)) {
                    return $this->file_path;
                }

                // 2. Deteksi jika file_path berupa string temporer Livewire (belum tersimpan permanen)
                if (str_contains($this->file_path, 'livewire-tmp') || str_contains($this->file_path, '-meta')) {
                    if (Storage::disk('public')->exists($this->file_path)) {
                        return Storage::disk('public')->url($this->file_path);
                    }
                    return $fallbackImage;
                }

                // 3. Bersihkan prefix 'public/' atau slash di awal untuk file lokal permanen
                $cleanPath = ltrim(str_replace('public/', '', $this->file_path), '/');

                // 4. Jika menggunakan custom route media (tanpa symlink storage)
                if (config('filesystems.disks.public.driver') === 'local') {
                    return url('media/' . $cleanPath);
                }

                return Storage::disk('public')->url($cleanPath);
            }
        );
    }

    /**
     * Relasi ke Parent Model Estate
     */
    public function estate(): BelongsTo
    {
        return $this->belongsTo(Estate::class);
    }
}
