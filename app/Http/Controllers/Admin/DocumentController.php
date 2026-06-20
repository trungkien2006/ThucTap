<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ActivityLogger;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = EventDocument::query()->with('event');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $documents = $query->orderByDesc('created_at')->paginate(20);

        return view('admin.documents.index', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip|max:10240',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $uploaded = 0;
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('documents', 'public');

                $doc = EventDocument::create([
                    'event_id' => $request->event_id,
                    'title' => $file->getClientOriginalName(),
                    'url' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_size' => $file->getSize(),
                ]);
                
                ActivityLogger::log("đã tải lên tài liệu mới: {$doc->title}", route('admin.documents.index'));
                $uploaded++;
            }
        }

        return redirect()->route('admin.documents.index')->with('success', "Đã tải lên {$uploaded} tài liệu.");
    }

    public function edit(EventDocument $document)
    {
        $events = \App\Models\Event::orderByDesc('created_at')->get();
        return view('admin.documents.edit', compact('document', 'events'));
    }

    public function update(Request $request, EventDocument $document)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $document->update([
            'title' => $request->title,
            'event_id' => $request->event_id,
        ]);

        ActivityLogger::log("đã cập nhật tài liệu: {$document->title}", route('admin.documents.index'));

        return redirect()->route('admin.documents.index')->with('success', 'Đã cập nhật tài liệu thành công.');
    }

    public function destroy(EventDocument $document)
    {
        if (Storage::disk('public')->exists($document->url)) {
            Storage::disk('public')->delete($document->url);
        }
        $title = $document->title;
        $document->delete();

        ActivityLogger::log("đã xóa tài liệu: {$title}", route('admin.documents.index'));

        return redirect()->route('admin.documents.index')->with('success', 'Đã xóa tài liệu thành công.');
    }
}
