<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyDownload extends Model
{
    protected $fillable = [
        'user_id', 'date', 'free_asset_ids', 'premium_asset_ids'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
