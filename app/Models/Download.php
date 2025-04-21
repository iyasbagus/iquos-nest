<?php

namespace App\Models;

use App\Models\User;
use App\Models\Asset;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['user_id', 'asset_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
