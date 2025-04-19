<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\MediaLibrary\CustomPathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Asset extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $fillable = ['title', 'description', 'file_url', 'thumbnail_url', 'creator_id', 'is_premium_only', 'downloads', 'rating', 'status'];

    protected $casts = [
        'is_premium_only' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('assets')->useDisk('public'); // Sesuaikan dengan disk storage yang digunakan

        $this->addMediaCollection('images')->useDisk('public');
    }
    
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large')->width(1000)->height(1000)->sharpen(10)->nonQueued(); // Tambahkan ini jika ingin langsung dibuat saat upload

        $this->addMediaConversion('medium')->width(600)->height(600)->sharpen(10)->nonQueued();

        $this->addMediaConversion('small')->width(300)->height(300)->sharpen(10)->nonQueued();
    }

    public $timestamps = true;

    // Relasi many-to-many ke categories
    public function category()
    {
        return $this->belongsToMany(Category::class, 'asset_categories', 'asset_id', 'category_id');
    }

    // Relasi many-to-many ke categories
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'asset_tags', 'asset_id', 'tag_id');
    }

    // relasi one to may ke creator
    public function creator()
    {
        return $this->BelongsTo(User::class, 'creator_id');
    }
}
