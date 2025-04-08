<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\PremiumPayment;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles ,HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'premium_untill',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        ];
    }

    public function asset()
    {
        return $this->hasMany(Asset::class, 'creator_id');
    }

    public function premiumPayments()
    {
        return $this->hasMany(PremiumPayment::class, 'user_id');
    }

    public function activeSubscription()
    {
        return $this->hasOne(PremiumPayment::class)
        ->where('status', 'completed')
        ->where('subcsription_end', '>' , now());
    }

    public function isPremium()
    {
        return $this->premium_until && $this->premium_until > now();
    }
}
