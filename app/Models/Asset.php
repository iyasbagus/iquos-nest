<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    use HasFactory;

    public $fillable = ['title', 'description', 'file_url', 'thumbnail_url', 'creator_id', 'is_premium_only', 'downloads', 'rating', 'status'
];

    protected $casts = [
        'is_premium_only' => 'boolean',
    ];

    public $timestamp = true;

     // Relasi many-to-many ke categories
        public function category()
        {
            return $this->belongsToMany(Category::class, 'asset_categories', 'asset_id', 'category_id');
        }

    // relasi one to may ke creator
    public function creator()
    {
        return $this->BelongsTo(User::class, 'creator_id');
    }

    //mengapus image
    public function deleteImage(){
        if($this->cover && file_exists(public_path('admin/images/asset' . $this->thumbail_url))){
            return unlink(public_path('admin/images/asset' . $this->thumbnail_url));
        }
    }
}
