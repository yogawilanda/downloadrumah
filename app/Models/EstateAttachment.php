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

                // Jika sudah berupa URL lengkap (e.g. S3 / Cloudinary)
                if (filter_var($this->file_path, FILTER_VALIDATE_URL)) {
                    return $this->file_path;
                }

                // Bersihkan prefix 'public/' atau slash di awal
                $cleanPath = ltrim(str_replace('public/', '', $this->file_path), '/');

                // Local disks are served through the application route so this works
                // without requiring a public/storage symlink on the deployment.
                if (config('filesystems.disks.public.driver') === 'local') {
                    return url('media/'.$cleanPath);
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
