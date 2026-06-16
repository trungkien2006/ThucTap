<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = EventMedia::query()->with('event');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $query->where('caption', 'like', '%' . $request->search . '%');
        }

        $media = $query->orderByDesc('created_at')->paginate(24);

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,webp,gif,svg,bmp,mp4,avi,mov,wmv,mkv,webm,pdf,doc,docx|max:51200',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $uploaded = 0;
        $results = [];
        $duplicates = [];
        $forceUpload = $request->has('force_upload') && $request->force_upload == 1;

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();

                if (!$forceUpload) {
                    $exists = EventMedia::where('caption', $originalName)->exists();
                    if ($exists) {
                        $duplicates[] = $originalName;
                        continue;
                    }
                }

                $ext = strtolower($file->getClientOriginalExtension());
                $type = in_array($ext, ['mp4', 'avi', 'mov', 'wmv', 'mkv', 'webm']) ? 'video' : (in_array($ext, ['pdf', 'doc', 'docx']) ? 'document' : 'image');
                $path = $file->store('media', 'public');

                $media = EventMedia::create([
                    'event_id' => $request->event_id,
                    'type'     => $type,
                    'url'      => $path,
                    'caption'  => $originalName,
                ]);
                $results[] = [
                    'id'  => $media->id,
                    'url' => Storage::url($path),
                    'caption' => $media->caption,
                    'type' => $type,
                ];
                $uploaded++;
            }
        }

        // If AJAX request (from Design Studio), return JSON
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'uploaded' => $uploaded, 'files' => $results, 'duplicates' => $duplicates]);
        }

        if (count($duplicates) > 0) {
            $msg = "Đã tải lên {$uploaded} tệp thành công. Bỏ qua " . count($duplicates) . " tệp đã tồn tại (VD: " . \Illuminate\Support\Str::limit(implode(', ', $duplicates), 50) . ").";
            return redirect()->route('admin.media.index')->with('warning', $msg);
        }

        return redirect()->route('admin.media.index')->with('success', "Đã tải lên {$uploaded} tệp mới.");
    }

    public function destroy(EventMedia $medium)
    {
        if (Storage::disk('public')->exists($medium->url)) {
            Storage::disk('public')->delete($medium->url);
        }
        $medium->delete();
        return redirect()->route('admin.media.index')->with('success', 'Đã xóa media thành công.');
    }
}
