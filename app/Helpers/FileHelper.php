<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function url($path)
    {
        if (empty($path)) {
            return '';
        }
        
        // If it's already a full URL (e.g. http://...)
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }

        if (config('filesystems.default') === 'google') {
            if (Storage::disk('public')->exists($path)) {
                return asset('storage/' . $path);
            }
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
