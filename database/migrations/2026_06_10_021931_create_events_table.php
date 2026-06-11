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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('banner_image')->nullable();
            $table->datetime('event_date');
            $table->string('location');
            $table->enum('event_type', ['conference', 'workshop', 'seminar', 'cultural', 'sports', 'orientation', 'other']);
            $table->string('academic_year')->nullable(); // e.g. 2025-2026
            $table->tinyInteger('semester')->nullable(); // 1 or 2
            $table->json('schedule')->nullable();
            $table->json('guest_speakers')->nullable();
            $table->json('photo_gallery')->nullable();
            $table->string('video_link')->nullable();
            $table->json('documents')->nullable();
            $table->string('qr_code_path')->nullable();
            $table->boolean('registration_open')->default(true);
            $table->integer('max_attendees')->nullable();
            $table->integer('views_count')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
