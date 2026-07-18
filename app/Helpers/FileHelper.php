<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function url($path, $optimize = false)
    {
        if (empty($path)) {
            return '';
        }
        
        if ($optimize) {
            // Using ?w=800 by default for event cards, can be expanded if needed
            return route('image.optimize', ['path' => $path, 'w' => 800, 'q' => 80]);
        }
        
        // If it's already a full URL (e.g. http://...)
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }

        try {
            if (Storage::disk('public')->exists($path)) {
                return asset('storage/' . $path);
            }
        } catch (\Exception $e) {}

        if (config('filesystems.default') === 'google') {
            return route('file.proxy', ['path' => $path]);
        }

        $cacheKey = 'gdrive_url_' . md5($path);
        if (\Illuminate\Support\Facades\Cache::has($cacheKey)) {
            return \Illuminate\Support\Facades\Cache::get($cacheKey);
        }

        try {
            $url = Storage::url($path);
            if (!empty($url)) {
                \Illuminate\Support\Facades\Cache::put($cacheKey, $url, now()->addHour());
            }
            return $url ?: '';
        } catch (\Exception $e) {
            return '';
        }
    }
}
