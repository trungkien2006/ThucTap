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
            return $localDisk->response($path);
        }

        $cloudDisk = Storage::disk(config('filesystems.default'));
        if (!$cloudDisk->exists($path)) {
            abort(404);
        }
        
        // Cache locally for future requests
        $localDisk->put($path, $cloudDisk->get($path));
        
        return $localDisk->response($path);
    }
}
