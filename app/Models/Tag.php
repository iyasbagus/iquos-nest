<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public $fillable = ['name','slug'];
    public $timestamp = true;

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'asset_tags', 'asset_id' ,'tag_id');
    }
}
