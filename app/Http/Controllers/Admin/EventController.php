<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('bannerImage', 'category')
            ->orderBy('event_date', 'desc')
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('registrations', 'bannerImage', 'category', 'scheduleItems.speaker', 'speakers');
        return view('admin.events.show', compact('event'));
    }

    public function create()
    {
        $categories = Category::eventTypes()->get();
        $departments = Category::departments()->get();
        $speakers = \App\Models\Speaker::all();
        return view('admin.events.create', compact('categories', 'departments', 'speakers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:events,slug',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'department_id' => 'nullable|exists:categories,id',
            'max_attendees' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',
        ]);

        // Remove banner_image and speaker_ids from validated data
        unset($validated['banner_image'], $validated['speaker_ids']);

        $event = new Event($validated);
        $event->registration_open = $request->has('registration_open');
        $event->is_published = false;
        $event->created_by = auth()->id();
        $event->save();

        if ($request->has('speaker_ids')) {
            $event->speakers()->sync($request->input('speaker_ids'));
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('events/banners', 'public');
            $event->media()->create([
                'type' => 'image',
                'url' => $path,
                'is_banner' => true,
            ]);
        }

        // Redirect to design step (Step 2)
        return redirect()->route('admin.events.design', $event)->with('success', 'Sự kiện đã được tạo. Hãy thiết kế giao diện!');
    }

    /**
     * Step 2: Design Studio
     */
    public function design(Event $event)
    {
        $event->load('bannerImage', 'media', 'category', 'scheduleItems', 'speakers');
        return view('admin.events.design', compact('event'));
    }

    /**
     * Step 3: Preview before publish
     */
    public function preview(Event $event)
    {
        $event->load('bannerImage', 'media', 'category', 'scheduleItems', 'speakers');
        return view('admin.events.preview', compact('event'));
    }

    public function edit(Event $event)
    {
        $event->load('bannerImage', 'speakers');
        $categories = Category::eventTypes()->get();
        $departments = Category::departments()->get();
        $speakers = \App\Models\Speaker::all();
        return view('admin.events.edit', compact('event', 'categories', 'departments', 'speakers'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:events,slug,' . $event->id,
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'department_id' => 'nullable|exists:categories,id',
            'max_attendees' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',
            'status' => 'required|in:draft,published,archived',
        ]);

        $status = $validated['status'];
        unset($validated['status'], $validated['banner_image'], $validated['speaker_ids']);

        $event->fill($validated);

        $event->is_published = ($status === 'published');
        $event->registration_open = $request->has('registration_open');

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old banner if exists
            $oldBanner = $event->bannerImage;
            if ($oldBanner && Storage::disk('public')->exists($oldBanner->url)) {
                Storage::disk('public')->delete($oldBanner->url);
                $oldBanner->delete();
            }

            $path = $request->file('banner_image')->store('events/banners', 'public');
            $event->media()->create([
                'type' => 'image',
                'url' => $path,
                'is_banner' => true,
            ]);
        }

        $event->save();

        $event->speakers()->sync($request->input('speaker_ids', []));

        return redirect()->route('admin.events.index')->with('success', 'Cập nhật sự kiện thành công.');
    }

    public function destroy(Event $event)
    {
        // Delete all associated image files from storage
        foreach ($event->media()->where('type', 'image')->get() as $image) {
            if (Storage::disk('public')->exists($image->url)) {
                Storage::disk('public')->delete($image->url);
            }
        }

        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Đã xóa sự kiện thành công.');
    }
}
