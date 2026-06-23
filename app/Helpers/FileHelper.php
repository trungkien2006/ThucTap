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

        $url = \Illuminate\Support\Facades\Cache::rememberForever('gdrive_url_' . md5($path), function() use ($path) {
            try {
                return Storage::url($path);
            } catch (\Exception $e) {
                // If it fails (e.g. file not found on Drive), return empty or fallback
                return '';
            }
        });

        if (empty($url)) {
            return '';
        }

        return $url;
    }
}
