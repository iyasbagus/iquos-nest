<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\MediaLibrary\CustomPathGenerator;
use Illuminate\Console\Concerns\InteractsWithIO;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $fillable = ['name', 'slug', 'description'];
    public $timestamp = true;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category')->useDisk('public');
    }

    // relasi many to many ke asset
    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'asset_categories', 'asset_id' ,'category_id');
    }

    public function deleteImage(){
        if($this->cover && file_exists(public_path('admin/images/category' . $this->images))){
            return unlink(public_path('admin/images/category' . $this->images));
        }
    }
}
