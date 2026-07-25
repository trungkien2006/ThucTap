<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * Resolve a file path/URL to a publicly accessible URL.
     * 
     * When $optimize = true, tries to serve a locally cached webp first.
     * Falls back to the image-optimize route only if local file is missing and 
     * Google Drive is the filesystem (i.e. images aren't stored locally).
     */
    public static function url($path, $optimize = false)
    {
        if (empty($path)) {
            return '';
        }

        // Already a full external URL — return as-is
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $isGoogle = config('filesystems.disks.google.clientId');

        if ($optimize) {
            $optimizedPath = 'optimized/' . md5($path . '800' . '80') . '.webp';
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($optimizedPath)) {
                return asset('storage/' . $optimizedPath);
            }
            return route('image.optimize', ['path' => $path, 'w' => 800, 'q' => 80]);
        }

        if ($isGoogle) {
            return route('file.proxy', ['path' => $path]);
        }

        return asset('storage/' . $path);
    }
}
