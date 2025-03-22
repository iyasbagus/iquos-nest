<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SubscriptionFeature extends Model
{
    use HasFactory;

    public $fillable = ['subscription_plan_id', 'feature'];
    public $timestamp = true;

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }
}
