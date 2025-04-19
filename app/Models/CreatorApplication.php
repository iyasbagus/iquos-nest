<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CreatorApplication extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id', 'portfolio_link', 'status', 'rejection_reason'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('preview_images')->useDisk('public'); // Sesuaikan dengan disk storage yang digunakan

        $this->addMediaCollection('asset_files')->useDisk('public');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
