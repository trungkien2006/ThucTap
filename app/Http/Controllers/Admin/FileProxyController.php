<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileProxyController extends Controller
{
    public function stream(Request $request)
    {
        $path = $request->query('path');
        if (!$path) {
            abort(404);
        }
        
        $localDisk = Storage::disk('public');
        if ($localDisk->exists($path)) {
            return $this->cachedResponse($localDisk, $path);
        }

        $isGoogle = config('filesystems.disks.google.clientId');
        if ($isGoogle) {
            try {
                $cacheKey = 'gdrive_url_' . md5($path);
                $directUrl = \Illuminate\Support\Facades\Cache::rememberForever($cacheKey, function() use ($path) {
                    return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
                });
                $fileContents = file_get_contents($directUrl);
                $localDisk->put($path, $fileContents);
            } catch (\Exception $e) {
                abort(404);
            }
        } else {
            $cloudDisk = Storage::disk(config('filesystems.default'));
            if (!$cloudDisk->exists($path)) {
                abort(404);
            }
            $localDisk->put($path, $cloudDisk->get($path));
        }
        
        return $this->cachedResponse($localDisk, $path);
    }

    private function cachedResponse($disk, $path)
    {
        $response = $disk->response($path);
        $response->headers->set('Cache-Control', 'public, max-age=2592000, immutable');
        $response->headers->set('Vary', 'Accept-Encoding');
        return $response;
    }

    public function optimize(Request $request)
    {
        $path = $request->query('path');
        $width = $request->query('w', 800);
        $quality = $request->query('q', 75);
        
        if (!$path) abort(404);

        $localDisk = Storage::disk('public');
        $optimizedPath = 'optimized/' . md5($path . $width . $quality) . '.webp';

        if ($localDisk->exists($optimizedPath)) {
            // Redirect to the static file URL so the browser caches it directly
            return redirect()->away(asset('storage/' . $optimizedPath), 301);
        }


        // Fetch original file
        $fileContents = null;
        if ($localDisk->exists($path)) {
            $fileContents = $localDisk->get($path);
        } else {
            $isGoogle = config('filesystems.disks.google.clientId');
            if ($isGoogle) {
                try {
                    $cacheKey = 'gdrive_url_' . md5($path);
                    $directUrl = \Illuminate\Support\Facades\Cache::rememberForever($cacheKey, function() use ($path) {
                        return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
                    });
                    $fileContents = file_get_contents($directUrl);
                } catch (\Exception $e) {
                    abort(404);
                }
            } elseif (strpos($path, 'http') === 0) {
                try {
                    $fileContents = file_get_contents($path);
                } catch (\Exception $e) {
                    abort(404);
                }
            }
        }

        if (!$fileContents) abort(404);

        // Attempt to compress using GD
        try {
            $image = @imagecreatefromstring($fileContents);
            if ($image !== false) {
                $origWidth = imagesx($image);
                $origHeight = imagesy($image);
                
                // Only resize if original is larger
                if ($origWidth > $width) {
                    $newHeight = (int)($origHeight * ($width / $origWidth));
                    $resized = imagecreatetruecolor($width, $newHeight);
                    // Preserve transparency for PNGs/WebP
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                    $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
                    imagefilledrectangle($resized, 0, 0, $width, $newHeight, $transparent);
                    
                    imagecopyresampled($resized, $image, 0, 0, 0, 0, $width, $newHeight, $origWidth, $origHeight);
                    imagedestroy($image);
                    $image = $resized;
                }

                ob_start();
                if (function_exists('imagewebp')) {
                    imagewebp($image, null, $quality);
                } else {
                    imagejpeg($image, null, $quality);
                }
                $optimizedContents = ob_get_clean();
                imagedestroy($image);

                $localDisk->put($optimizedPath, $optimizedContents);
                // Redirect to static file — browser will cache the webp URL permanently
                return redirect()->away(asset('storage/' . $optimizedPath), 301);
            }
        } catch (\Exception $e) {
            // Fallback to original if GD fails
        }

        // If GD fails or it's not an image, just return original
        if (strpos($path, 'http') === 0) {
            return redirect($path);
        }
        
        if ($localDisk->exists($path)) return $this->cachedResponse($localDisk, $path);
        
        $isGoogle = config('filesystems.disks.google.clientId');
        if ($isGoogle) {
            try {
                $cacheKey = 'gdrive_url_' . md5($path);
                $directUrl = \Illuminate\Support\Facades\Cache::rememberForever($cacheKey, function() use ($path) {
                    return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
                });
                $fileContents = file_get_contents($directUrl);
                $localDisk->put($path, $fileContents);
                return $this->cachedResponse($localDisk, $path);
            } catch (\Exception $e) {
                // fall through to 404
            }
        } else {
            $cloudDisk = Storage::disk(config('filesystems.default'));
            if ($cloudDisk->exists($path)) {
                $localDisk->put($path, $cloudDisk->get($path));
                return $this->cachedResponse($localDisk, $path);
            }
        }
        
        abort(404);
    }
}
