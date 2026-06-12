<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // 'image' or 'video'
            $table->string('url');
            $table->string('title')->nullable();
            $table->boolean('is_banner')->default(false);
            $table->boolean('is_recap')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamp('created_at')->nullable();
        });

        // Migrate existing data from event_images
        if (Schema::hasTable('event_images')) {
            $images = DB::table('event_images')->get();
            foreach ($images as $image) {
                DB::table('event_medias')->insert([
                    'event_id' => $image->event_id,
                    'type' => 'image',
                    'url' => $image->image_path,
                    'title' => $image->caption,
                    'is_banner' => $image->is_banner,
                    'is_recap' => false,
                    'sort_order' => $image->sort_order,
                    'created_at' => $image->created_at,
                ]);
            }
            Schema::dropIfExists('event_images');
        }

        // Migrate existing data from event_videos
        if (Schema::hasTable('event_videos')) {
            $videos = DB::table('event_videos')->get();
            foreach ($videos as $video) {
                DB::table('event_medias')->insert([
                    'event_id' => $video->event_id,
                    'type' => 'video',
                    'url' => $video->video_url,
                    'title' => $video->title,
                    'is_banner' => false,
                    'is_recap' => $video->is_recap,
                    'sort_order' => $video->sort_order,
                    'created_at' => $video->created_at,
                ]);
            }
            Schema::dropIfExists('event_videos');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('event_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->boolean('is_banner')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('event_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('video_url');
            $table->boolean('is_recap')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamp('created_at')->nullable();
        });

        if (Schema::hasTable('event_medias')) {
            $medias = DB::table('event_medias')->get();
            foreach ($medias as $media) {
                if ($media->type === 'image') {
                    DB::table('event_images')->insert([
                        'event_id' => $media->event_id,
                        'image_path' => $media->url,
                        'caption' => $media->title,
                        'is_banner' => $media->is_banner,
                        'sort_order' => $media->sort_order,
                        'created_at' => $media->created_at,
                    ]);
                } else if ($media->type === 'video') {
                    DB::table('event_videos')->insert([
                        'event_id' => $media->event_id,
                        'title' => $media->title,
                        'video_url' => $media->url,
                        'is_recap' => $media->is_recap,
                        'sort_order' => $media->sort_order,
                        'created_at' => $media->created_at,
                    ]);
                }
            }
            Schema::dropIfExists('event_medias');
        }
    }
};
