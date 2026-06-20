<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ActivityLogger;

class SpeakerController extends Controller
{
    public function index(Request $request)
    {
        $query = Speaker::withCount('events');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $speakers = $query->orderBy('name')->paginate(12);

        return view('admin.speakers.index', compact('speakers'));
    }

    public function create()
    {
        return view('admin.speakers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'type' => 'required|in:speaker,guest',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        unset($validated['photo']);
        $speaker = new Speaker($validated);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('speakers', 'public');
            $speaker->photo_url = Storage::url($path);
        }

        $speaker->save();

        ActivityLogger::log("đã tạo diễn giả mới: {$speaker->name}", route('admin.speakers.index'));

        return redirect()->route('admin.speakers.index')->with('success', 'Thêm diễn giả thành công.');
    }

    public function edit(Speaker $speaker)
    {
        return view('admin.speakers.edit', compact('speaker'));
    }

    public function update(Request $request, Speaker $speaker)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'type' => 'required|in:speaker,guest',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        unset($validated['photo']);
        $speaker->fill($validated);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('speakers', 'public');
            $speaker->photo_url = Storage::url($path);
        }

        $speaker->save();

        ActivityLogger::log("đã cập nhật diễn giả: {$speaker->name}", route('admin.speakers.index'));

        return redirect()->route('admin.speakers.index')->with('success', 'Cập nhật diễn giả thành công.');
    }

    public function destroy(Speaker $speaker)
    {
        $speakerName = $speaker->name;
        $speaker->delete();

        ActivityLogger::log("đã xóa diễn giả: {$speakerName}", route('admin.speakers.index'));

        return redirect()->route('admin.speakers.index')->with('success', 'Xóa diễn giả thành công.');
    }
}
