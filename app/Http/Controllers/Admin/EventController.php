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
        return view('admin.events.create', compact('categories', 'departments'));
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
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Remove banner_image from validated data — it goes to event_images
        unset($validated['banner_image']);

        $event = new Event($validated);
        $event->registration_open = $request->has('registration_open');
        $event->is_published = false;
        $event->created_by = auth()->id();
        $event->save();

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('events/banners', 'public');
            $event->media()->create([
                'type' => 'image',
                'url' => $path,
                'is_banner' => true,
            ]);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $event->load('bannerImage');
        $categories = Category::eventTypes()->get();
        $departments = Category::departments()->get();
        return view('admin.events.edit', compact('event', 'categories', 'departments'));
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
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published,archived',
        ]);

        $status = $validated['status'];
        unset($validated['status'], $validated['banner_image']);

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

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
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
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
