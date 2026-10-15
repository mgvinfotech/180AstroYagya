<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('astrologers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title')->nullable(); // e.g. "Vedic Jyotish Acharya & Karmakandi Expert"
            $table->string('qualification')->nullable(); // e.g. "Acharya (Sampurnanand Sanskrit University, Varanasi)"
            $table->integer('experience_years')->default(15);
            $table->string('specialties')->nullable(); // comma-separated or json
            $table->string('languages')->nullable(); // Hindi, Sanskrit, English
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->decimal('rating', 3, 2)->default(4.95);
            $table->integer('reviews_count')->default(108);
            $table->decimal('consultation_fee', 10, 2)->default(2100);
            $table->boolean('is_available_online')->default(true);
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astrologers');
    }
};
