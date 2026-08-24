<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
                if (filter_var($this->file_path, FILTER_VALIDATE_URL)) {
                    return $this->file_path;
                }
                return asset('storage/' . $this->file_path);
            }
        );
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
