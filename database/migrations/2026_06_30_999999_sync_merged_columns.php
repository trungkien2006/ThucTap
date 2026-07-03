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
        // 1. Sync categories
        if (!Schema::hasColumn('categories', 'name_vi')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('name_vi')->nullable()->after('name');
            });
        }

        // 2. Sync speakers
        if (!Schema::hasColumn('speakers', 'type')) {
            Schema::table('speakers', function (Blueprint $table) {
                $table->string('type')->default('guest')->after('photo_url');
            });
        }
        if (!Schema::hasColumn('speakers', 'is_hidden')) {
            Schema::table('speakers', function (Blueprint $table) {
                $table->boolean('is_hidden')->default(false)->after('type');
            });
        }

        // 3. Sync events
        if (!Schema::hasColumn('events', 'likes_count')) {
            Schema::table('events', function (Blueprint $table) {
                $table->integer('likes_count')->default(0)->after('views_count');
            });
        }
        if (!Schema::hasColumn('events', 'status')) {
            Schema::table('events', function (Blueprint $table) {
                $table->string('status')->default('draft')->after('is_published');
            });

            // Migrate existing status data based on is_published flag
            \Illuminate\Support\Facades\DB::table('events')->update([
                'status' => \Illuminate\Support\Facades\DB::raw("IF(is_published = 1, 'published', 'draft')")
            ]);
        }

        // 4. Sync events indexes (safely check if index exists is tricky, so we wrap in try-catch)
        try {
            Schema::table('events', function (Blueprint $table) {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $indexesFound = $sm->listTableIndexes('events');

                if (!array_key_exists('events_is_published_index', $indexesFound)) {
                    $table->index('is_published');
                }
                if (!array_key_exists('events_event_date_index', $indexesFound)) {
                    $table->index('event_date');
                }
                if (!array_key_exists('events_views_count_index', $indexesFound)) {
                    $table->index('views_count');
                }
                if (!array_key_exists('events_likes_count_index', $indexesFound)) {
                    $table->index('likes_count');
                }
            });
        } catch (\Exception $e) {
            // Ignore index creation errors if they already exist
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down migration required for a sync script
    }
};
