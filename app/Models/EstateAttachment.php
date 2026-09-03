<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EstateAttachment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->file_path) {
                    return null;
                }

                // 1. Jika berupa URL eksternal lengkap (e.g. Unsplash, S3, Cloudinary)
                if (filter_var($this->file_path, FILTER_VALIDATE_URL)) {
                    return $this->file_path;
                }

                // 2. Deteksi jika file_path berupa string temporer Livewire (belum tersimpan permanen)
                if (str_contains($this->file_path, 'livewire-tmp') || str_contains($this->file_path, '-meta')) {
                    // Cek ketersediaan file di disk tmp, jika ada ambil temporaryUrl, jika tidak return null/fallback
                    if (Storage::disk('public')->exists($this->file_path)) {
                        return Storage::disk('public')->url($this->file_path);
                    }
                    return null;
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

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
