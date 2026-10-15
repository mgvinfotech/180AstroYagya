<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('inquiry_type')->default('general'); // yagya_booking, jyotish_consultation, kundli_analysis, general
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->foreignId('astrologer_id')->nullable()->constrained('astrologers')->onDelete('set null');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('time_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('gotra')->nullable();
            $table->string('rashi_nakshatra')->nullable();
            $table->string('preferred_language')->default('Hindi');
            $table->date('preferred_date')->nullable();
            $table->text('problem_description')->nullable();
            $table->string('status')->default('pending'); // pending, contacted, scheduled, completed, cancelled
            $table->text('admin_notes')->nullable();
            $table->boolean('email_sent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
