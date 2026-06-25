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
            $table->string('status')->default('draft')->after('is_published');
        });

        // Migrate existing status data based on is_published flag
        \Illuminate\Support\Facades\DB::table('events')->update([
            'status' => \Illuminate\Support\Facades\DB::raw("IF(is_published = 1, 'published', 'draft')")
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
