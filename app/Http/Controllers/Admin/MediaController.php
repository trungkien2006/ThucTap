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
            'files.*' => 'required|file|mimes:jpg,jpeg,png,webp,gif,mp4,pdf,doc,docx|max:10240',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $uploaded = 0;
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $ext = $file->getClientOriginalExtension();
                $type = in_array($ext, ['mp4']) ? 'video' : (in_array($ext, ['pdf', 'doc', 'docx']) ? 'document' : 'image');
                $path = $file->store('media', 'public');

                EventMedia::create([
                    'event_id' => $request->event_id,
                    'type' => $type,
                    'url' => $path,
                    'caption' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                ]);
                $uploaded++;
            }
        }

        return redirect()->route('admin.media.index')->with('success', "Đã tải lên {$uploaded} tệp.");
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
