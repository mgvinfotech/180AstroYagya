<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->default('#');
            $table->foreignId('parent_id')->nullable()->constrained('navigation_menus')->onDelete('cascade');
            $table->string('location')->default('header'); // header, footer_quick, footer_yagyas, footer_jyotish
            $table->string('target')->default('_self'); // _self, _blank
            $table->string('badge')->nullable(); // e.g. 'Holy', 'Popular'
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_menus');
    }
};
