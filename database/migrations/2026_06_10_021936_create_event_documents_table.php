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
        Schema::create('event_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('url');
            $table->bigInteger('file_size')->nullable()->comment('bytes');
            $table->string('file_type')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_documents');
    }
};
