<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasCatalog
{
    public function scopeWhereUsername($query, string $username)
    {
        return $query->where('username', $username);
    }

    /**
     * Fallback jika brand_name null atau string kosong ("").
     */
    public function getDisplayBrandNameAttribute(): string
    {
        return !empty(trim($this->brand_name ?? '')) ? $this->brand_name : $this->name;
    }

    /**
     * Fallback jika username null atau string kosong ("").
     */
    public function getDisplayUsernameAttribute(): string
    {
        return !empty(trim($this->username ?? '')) ? $this->username : Str::slug($this->name);
    }
} 
