<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    use HasFactory;

    public $fillable = ['title', 'description', 'file_url', 'thumbnail_url', 'creator_id', 'is_premium_only', 'downloads', 'rating', 'status'
];

    public $timestamp = true;

    public function user()
    {
        return $this->BelongsTo(User::class, 'creator_id');
    }
}
