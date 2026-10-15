<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->text('short_desc')->nullable();
            $table->longText('detailed_desc')->nullable();
            $table->text('mantra_chanted')->nullable(); // e.g. "125,000 Mahamrityunjaya Japa"
            $table->string('duration')->nullable(); // e.g. "3 Days (5 Hours daily)"
            $table->string('priests_count')->nullable(); // e.g. "5 Vedic Brahmins"
            $table->decimal('dakshina_inr', 10, 2)->default(0);
            $table->decimal('dakshina_usd', 10, 2)->default(0);
            $table->json('benefits')->nullable(); // array of bullet benefit points
            $table->text('samagri_details')->nullable();
            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order_index')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
