<?php

namespace App\Models;

use App\Models\Concerns\HasCatalog;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;


/**
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $brand_name
 * @property string $email
 * @property string|null $phone_number
 * @property bool $is_super_admin
 */
#[Fillable(['name', 'username', 'brand_name', 'email', 'password', 'phone_number', 'is_super_admin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasCatalog, HasApiTokens;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_super_admin' => 'boolean',
        ];
    }

    // Relasi ke Estates (Properti)
    public function estates()
    {
        return $this->hasMany(Estate::class);
    }

    /**
     * Scope query to find user by catalog username.
     */
    public function scopeWhereUsername($query, string $username)
    {
        return $query->where('username', $username);
    }

    /**
     * Check if the user has the super admin role flag.
     */
    public function isSuperAdmin(): bool
    {
        if ((bool) $this->is_super_admin) {
            return true;
        }

        // Fallback: SUPER_ADMIN_IDS env (comma separated user IDs) for bootstrap.
        $ids = array_filter(array_map('intval', explode(',', (string) env('SUPER_ADMIN_IDS', ''))));
        return !empty($ids) && in_array((int) $this->id, $ids, true);
    }

    /**
     * Fallback jika brand_name masih kosong.
     */
    public function getDisplayBrandNameAttribute(): string
    {
        return $this->brand_name ?? $this->name;
    }

    /**
     * Fallback jika username masih kosong.
     */
    public function getDisplayUsernameAttribute(): string
    {
        return $this->username ?? \Illuminate\Support\Str::slug($this->name);
    }

    // TODO: Add another roles without using spatie for mvp phase.
}
