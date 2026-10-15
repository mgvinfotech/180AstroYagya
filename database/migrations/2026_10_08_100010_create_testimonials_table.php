<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_title')->nullable(); // e.g. "Devotee & Business Owner"
            $table->string('location')->nullable(); // e.g. "San Francisco, USA", "Mumbai, India"
            $table->string('service_taken')->nullable(); // e.g. "Maha Mrityunjaya & Rahu Shanti Yagya"
            $table->tinyInteger('rating')->default(5);
            $table->text('review_text');
            $table->string('avatar')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_verified')->default(true);
            $table->boolean('is_featured')->default(true);
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
