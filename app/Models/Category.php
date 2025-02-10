<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['name', 'slug', 'description', 'images'];
    public $timestamp = true;

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
