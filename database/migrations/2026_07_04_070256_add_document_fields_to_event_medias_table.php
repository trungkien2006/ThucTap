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
        Schema::table('event_medias', function (Blueprint $table) {
            $table->string('document_url')->nullable()->after('content');
            $table->string('document_name')->nullable()->after('document_url');
            $table->string('action_url')->nullable()->after('document_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_medias', function (Blueprint $table) {
            $table->dropColumn(['document_url', 'document_name', 'action_url']);
        });
    }
};
