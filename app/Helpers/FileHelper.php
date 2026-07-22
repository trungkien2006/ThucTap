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

        $localDisk = Storage::disk('public');

        if ($optimize) {
            // Check if we already have a cached optimized webp on local disk
            $optimizedPath = 'optimized/' . md5($path . '800' . '80') . '.webp';
            if ($localDisk->exists($optimizedPath)) {
                // Serve the static file directly — no PHP overhead
                return asset('storage/' . $optimizedPath);
            }

            // If original file is available locally, serve the optimize route ONCE to generate the cache
            if ($localDisk->exists($path)) {
                return route('image.optimize', ['path' => $path, 'w' => 800, 'q' => 80]);
            }

            // File doesn't exist locally and disk isn't google — return storage URL anyway (may 404 gracefully)
            if (config('filesystems.default') !== 'google') {
                return asset('storage/' . $path);
            }

            // Last resort: Google Drive proxy to optimize
            return route('image.optimize', ['path' => $path, 'w' => 800, 'q' => 80]);
        }

        // Non-optimized: serve directly from local storage if available
        if ($localDisk->exists($path)) {
            return asset('storage/' . $path);
        }

        // If filesystem is google, proxy through file.proxy route
        if (config('filesystems.default') === 'google') {
            return route('file.proxy', ['path' => $path]);
        }

        // Fallback: build storage URL (may 404 if file doesn't exist)
        return asset('storage/' . $path);
    }
}
