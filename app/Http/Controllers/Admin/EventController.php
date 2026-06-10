<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('registrations');
        return view('admin.events.show', compact('event'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:conference,workshop,seminar,cultural,sports,orientation,other',
            'academic_year' => 'nullable|string|max:20',
            'semester' => 'nullable|integer|in:1,2',
            'max_attendees' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $event = new Event($validated);

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('events/banners', 'public');
            $event->banner_image = $path;
        }

        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:conference,workshop,seminar,cultural,sports,orientation,other',
            'academic_year' => 'nullable|string|max:20',
            'semester' => 'nullable|integer|in:1,2',
            'max_attendees' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_published' => 'nullable',
            'registration_open' => 'nullable',
        ]);

        $event->fill($validated);

        $event->is_published = $request->has('is_published');
        $event->registration_open = $request->has('registration_open');

        if ($request->hasFile('banner_image')) {
            if ($event->banner_image) {
                Storage::disk('public')->delete($event->banner_image);
            }
            $path = $request->file('banner_image')->store('events/banners', 'public');
            $event->banner_image = $path;
        }

        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->banner_image) {
            Storage::disk('public')->delete($event->banner_image);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
