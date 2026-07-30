<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ActivityLogger;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('event_id')) {
            $event = \App\Models\Event::findOrFail($request->event_id);
            $query = EventMedia::query()->where('event_id', $event->id)->whereIn('type', ['image', 'video']);

            $sort = $request->input('sort', 'date_desc');
            if ($sort === 'date_asc') {
                $query->orderBy('created_at', 'asc');
            } else {
                $query->orderBy('created_at', 'desc');
            }

            $perPage = $request->input('per_page', 15);
            $media = $query->paginate($perPage)->withQueryString();
            return view('admin.media.show', compact('media', 'event'));
        }

        $query = \App\Models\Event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('has_link')) {
            if ($request->has_link === 'yes') {
                $query->whereNotNull('recap_drive_link')->where('recap_drive_link', '!=', '');
            } elseif ($request->has_link === 'no') {
                $query->where(function($q) {
                    $q->whereNull('recap_drive_link')->orWhere('recap_drive_link', '');
                });
            }
        }

        $sort = $request->input('sort', 'date_desc');
        if ($sort === 'date_asc') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'title') {
            $query->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $query->orderBy('title', 'desc');
        } elseif ($sort === 'likes') {
            $query->orderBy('likes_count', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $view = $request->input('view', 'grid_5');
        if ($view === 'grid_4') {
            $perPage = 12;
        } elseif ($view === 'grid_6') {
            $perPage = 18;
        } else {
            $perPage = 15;
        }

        $albums = $query->paginate($perPage)->withQueryString();
        $totalAlbums = \App\Models\Event::count();
        $albumsThisMonth = \App\Models\Event::whereMonth('created_at', now()->month)
                                            ->whereYear('created_at', now()->year)
                                            ->count();

        return view('admin.media.index', compact('albums', 'totalAlbums', 'albumsThisMonth'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,webp,gif,svg,bmp,mp4,avi,mov,wmv,mkv,webm|max:51200',
            'event_id' => 'required|exists:events,id',
        ]);

        $uploaded = 0;
        $results = [];
        $duplicates = [];
        $forceUpload = $request->has('force_upload') && $request->force_upload == 1;

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();

                if (!$forceUpload) {
                    $exists = EventMedia::where('caption', $originalName)
                                        ->where('event_id', $request->event_id)
                                        ->exists();
                    if ($exists) {
                        $duplicates[] = $originalName;
                        continue;
                    }
                }

                $ext = strtolower($file->getClientOriginalExtension());
                $type = in_array($ext, ['mp4', 'avi', 'mov', 'wmv', 'mkv', 'webm']) ? 'video' : 'image';
                
                $event = \App\Models\Event::with('category')->find($request->event_id);
                $categorySlug = $event && $event->category ? $event->category->slug : 'uncategorized';
                $eventSlug = $event ? $event->slug : 'general';
                $folderPath = "{$categorySlug}/{$eventSlug}/media";

                $path = $file->store($folderPath, 'public');

                $media = EventMedia::create([
                    'event_id' => $request->event_id,
                    'type'     => $type,
                    'url'      => $path,
                    'caption'  => $originalName,
                ]);
                $results[] = [
                    'id'  => $media->id,
                    'url' => \App\Helpers\FileHelper::url($media->url),
                    'path' => $media->url,
                    'caption' => $media->caption,
                    'type' => $type,
                ];
                $uploaded++;
            }
        }

        if ($uploaded > 0) {
            ActivityLogger::log("đã tải lên {$uploaded} tệp media mới", route('admin.media.index'));
        }

        // If AJAX request (from Design Studio), return JSON
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'uploaded' => $uploaded, 'files' => $results, 'duplicates' => $duplicates]);
        }

        if (count($duplicates) > 0) {
            $msg = "Đã tải lên {$uploaded} tệp thành công. Bỏ qua " . count($duplicates) . " tệp đã tồn tại (VD: " . \Illuminate\Support\Str::limit(implode(', ', $duplicates), 50) . ").";
            return redirect()->route('admin.media.index', ['event_id' => $request->event_id])->with('warning', $msg);
        }

        return redirect()->route('admin.media.index', ['event_id' => $request->event_id])->with('success', "Đã tải lên {$uploaded} tệp mới.");
    }

    public function destroy(EventMedia $medium)
    {
        $isUrl = str_starts_with($medium->url, 'http://') || str_starts_with($medium->url, 'https://');
        if (!$isUrl && Storage::exists($medium->url)) {
            Storage::delete($medium->url);
        }
        $caption = $medium->caption;
        $medium->delete();

        ActivityLogger::log("đã xóa tệp media: {$caption}", route('admin.media.index'));

        return redirect()->back()->with('success', 'Đã xóa media thành công.');
    }
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:event_medias,id'
        ]);

        $media = EventMedia::whereIn('id', $request->ids)->get();
        $count = 0;
        foreach ($media as $medium) {
            $isUrl = str_starts_with($medium->url, 'http://') || str_starts_with($medium->url, 'https://');
            if (!$isUrl && Storage::exists($medium->url)) {
                Storage::delete($medium->url);
            }
            $medium->delete();
            $count++;
        }

        ActivityLogger::log("đã xóa hàng loạt {$count} tệp media", route('admin.media.index'));

        return response()->json(['success' => true, 'message' => "Đã xóa {$count} tệp media thành công."]);
    }
}
