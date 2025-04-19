<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('premium_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->decimal('amount', total: 10, places: 2);
            $table->string('payment_method');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->dateTime('transaction_date');
            $table->string('reference_number')->nullable();
            $table->dateTime('subscription_start');
            $table->dateTime('subscription_end');
            $table->integer('downloads_used')->default(0);
            $table->timestamps();

            // ini foreign wak
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('subscription_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premium_payments');
    }
};
