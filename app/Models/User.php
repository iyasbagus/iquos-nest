<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\CreatorApplication;
use App\Models\PremiumPayment;
use App\Models\SubscriptionPlan;
use App\Models\Download;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, HasFactory, Notifiable, HasApiTokens, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'username', 'email', 'password', 'profile_picture', 'bio'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_picture')->singleFile(); // hanya simpan 1 gambar, akan replace otomatis

        $this->addMediaCollection('banner_image')->singleFile();
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public function asset()
    {
        return $this->hasMany(Asset::class, 'creator_id');
    }

    public function totalDownloads()
    {
        return Download::whereIn('asset_id', $this->asset()->pluck('id'))->count();
    }

    public function creatorApplication()
    {
        return $this->hasOne(CreatorApplication::class);
    }

    public function premiumPayments()
    {
        return $this->hasMany(PremiumPayment::class, 'user_id');
    }

    public function dailyDownloads()
    {
        return $this->hasMany(DailyDownload::class, 'user_id');
    }

    public function latestActivePremium()
    {
        return $this->hasOne(PremiumPayment::class, 'user_id')->where('status', 'completed')->where('subscription_end', '>=', now())->latest('subscription_end');
    }

    public function isPremium()
    {
        return $this->latestActivePremium()->exists();
    }

    public function getProfilePictureAttribute()
    {
        return $this->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($this->name);
    }

    // Sebagai creator
    public function creatorEarnings()
    {
        return $this->hasMany(CreatorEarning::class, 'creator_id');
    }

    public function totalEarnings()
    {
        return $this->creatorEarnings()->sum('amount');
    }

    // Sebagai pengunduh
    public function downloadedEarnings()
    {
        return $this->hasMany(CreatorEarning::class, 'downloaded_by');
    }
}
