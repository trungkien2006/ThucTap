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
        // 1. Drop unused tables
        Schema::dropIfExists('event_documents');
        Schema::dropIfExists('event_images');
        Schema::dropIfExists('event_videos');

        // 2. Drop unused columns in event_medias if they exist
        Schema::table('event_medias', function (Blueprint $table) {
            if (Schema::hasColumn('event_medias', 'document_url')) {
                $table->dropColumn('document_url');
            }
            if (Schema::hasColumn('event_medias', 'document_name')) {
                $table->dropColumn('document_name');
            }
            if (Schema::hasColumn('event_medias', 'action_url')) {
                $table->dropColumn('action_url');
            }
        });

        // 3. Rename qr_code_path to registration_link in events table
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('qr_code_path', 'registration_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't restore the tables because they are deprecated.
        
        Schema::table('event_medias', function (Blueprint $table) {
            $table->string('document_url')->nullable()->after('content');
            $table->string('document_name')->nullable()->after('document_url');
            $table->string('action_url')->nullable()->after('document_name');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('registration_link', 'qr_code_path');
        });
    }
};
