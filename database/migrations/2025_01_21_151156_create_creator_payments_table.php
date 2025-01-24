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
        Schema::create('creator_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id');
            $table->integer('total_dowloads');
            $table->decimal('amount', total: 15, places: 2);
            $table->enum('payment_method', ['Dana', 'Gopay']);
            $table->enum('payment_status', ['Pending', 'Paid']);
            $table->dateTime('period_start');
            $table->dateTime('period_end');
            $table->dateTime('payment_date');
            $table->timestamps();

            //ini foreign key wak
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creator_payments');
    }
};
