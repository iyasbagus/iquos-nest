<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubscriptionFeature;
use App\Models\PremiumPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionPlan extends Model
{
    use HasFactory;

    public $fillable = ['name', 'price', 'duration', 'max_downloads', 'revenue_share_percentage'];
    public $timestamp = true;

    // relasi many to many ke features
    public function features()
    {
        return $this->hasMany(SubscriptionFeature::class, 'subscription_plan_id');
    }

    public function payments()
    {
        return $this->belongsToMany(PremiumPayment::class, 'plan_id');
    }
}
