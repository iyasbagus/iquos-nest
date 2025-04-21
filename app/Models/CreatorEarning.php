<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreatorEarning extends Model
{
    protected $fillable = ['creator_id', 'asset_id', 'downloaded_by', 'amount', 'premium_payment_id'];

     /**
     * Relasi ke Creator (User)
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Relasi ke Asset yang diunduh
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Relasi ke User yang mengunduh
     */
    public function downloader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'downloaded_by');
    }

    /**
     * Relasi ke pembayaran premium
     */
    public function premiumPayment(): BelongsTo
    {
        return $this->belongsTo(PremiumPayment::class);
    }
}
