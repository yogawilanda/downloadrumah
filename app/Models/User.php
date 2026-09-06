<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'phone_number', 'is_super_admin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use  HasFactory, Notifiable;

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
}
