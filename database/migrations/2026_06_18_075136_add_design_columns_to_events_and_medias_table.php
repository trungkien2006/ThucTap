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
            $table->string('title_font_size')->nullable();
            $table->string('title_color')->nullable();
            $table->string('title_outline_color')->nullable();
            $table->string('title_outline_width')->nullable();
            $table->string('desc_font_size')->nullable();
            $table->string('desc_color')->nullable();
        });

        Schema::table('event_medias', function (Blueprint $table) {
            $table->string('document_url')->nullable();
            $table->string('document_name')->nullable();
            $table->string('action_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'title_font_size',
                'title_color',
                'title_outline_color',
                'title_outline_width',
                'desc_font_size',
                'desc_color'
            ]);
        });

        Schema::table('event_medias', function (Blueprint $table) {
            $table->dropColumn([
                'document_url',
                'document_name',
                'action_url'
            ]);
        });
    }
};
