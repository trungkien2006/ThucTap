<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($description, $url = null)
    {
        $path = storage_path('app/profile_activities.json');
        
        $activities = [];
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $activities = json_decode($content, true) ?: [];
        }
        
        $activities[] = [
            'user_id' => Auth::id() ?? 1,
            'user_name' => Auth::user()?->name ?? 'Admin',
            'activity' => $description,
            'created_at' => now()->toDateTimeString(),
            'url' => $url,
        ];
        
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        file_put_contents($path, json_encode($activities, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
