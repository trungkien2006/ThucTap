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
        Schema::table('events', function (Blueprint $table) {
            $table->index('is_published');
            $table->index('event_date');
            $table->index('views_count');
            $table->index('likes_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex(['is_published']);
            $table->dropIndex(['event_date']);
            $table->dropIndex(['views_count']);
            $table->dropIndex(['likes_count']);
        });
    }
};
