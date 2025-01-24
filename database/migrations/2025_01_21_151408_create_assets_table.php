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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('file_url');
            $table->string('thumbnail_url');
            $table->unsignedBigInteger('creator_id');
            $table->boolean('is_premium_only');
            $table->integer('dowloads');
            $table->decimal('rating', total:1, places:1);
            $table->enum('status', ['active', 'pending', 'rejected']);
            // $table->dateTime('created_at');
            // $table->dateTime('updated_at');
            $table->timestamps();

            //foreign wak
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
