<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\User;
use app\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PremiumPayment extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'plan_id', 'amount', 'payment_method','status', 'transaction_date', 'reference_number','subscription_start', 'subscription_end'];
    public $timestamp = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }
}
