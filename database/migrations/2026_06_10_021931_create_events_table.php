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
            $table->longText('description')->nullable();
            $table->datetime('event_date');
            $table->datetime('end_date')->nullable();
            $table->string('location');
            $table->string('academic_year')->nullable(); // e.g. 2025-2026
            $table->tinyInteger('semester')->nullable(); // 1 or 2
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->boolean('registration_open')->default(true);
            $table->integer('max_attendees')->nullable();
            $table->integer('views_count')->default(0);
            $table->boolean('is_published')->default(false);
            $table->string('page_template')->nullable();
            $table->string('qr_code_path')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
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
