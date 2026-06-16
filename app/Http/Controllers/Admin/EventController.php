<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventDocument;
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
        // All media in the library (global, for reuse picker)
        $mediaLibrary = EventMedia::whereIn('type', ['image', 'video'])
            ->orderByDesc('created_at')
            ->get();
        $allSpeakers = \App\Models\Speaker::all();
        return view('admin.events.design', compact('event', 'mediaLibrary', 'allSpeakers'));
    }

    public function saveDesign(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'end_date' => 'nullable|date_format:H:i',
            'location' => 'nullable|string',
            'academic_year' => 'nullable|string',
            'department_id' => 'nullable|exists:categories,id',
            'max_attendees' => 'nullable|integer',
            'speaker_id' => 'nullable|exists:speakers,id',
            'schedule_text' => 'nullable|string',
            'media_slots' => 'nullable|array', // array of URLs
        ]);

        if ($request->has('event_date')) {
            $date = \Carbon\Carbon::parse($request->event_date);
            if ($request->has('start_time')) {
                $time = explode(':', $request->start_time);
                $date->setTime($time[0], $time[1]);
            }
            $event->event_date = $date;
        }

        if ($request->has('end_date') && $request->has('event_date')) {
            $date = clone $event->event_date;
            $time = explode(':', $request->end_date);
            $date->setTime($time[0], $time[1]);
            $event->end_date = $date;
        }

        if ($request->has('title') && !empty($request->title)) $event->title = $request->title;
        if ($request->has('description')) $event->description = $request->description;
        if ($request->has('location')) $event->location = $request->location;
        if ($request->has('academic_year')) $event->academic_year = $request->academic_year;
        if ($request->has('department_id')) $event->department_id = $request->department_id;
        if ($request->has('max_attendees')) $event->max_attendees = $request->max_attendees;

        $event->save();

        if ($request->has('speaker_id') && $request->speaker_id) {
            $event->speakers()->sync([$request->speaker_id]);
        } else {
            $event->speakers()->detach();
        }

        if ($request->has('schedule_text')) {
            $event->scheduleItems()->delete();
            $lines = explode("\n", $request->schedule_text);
            $order = 0;
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                $parts = explode('-', $line, 2);
                if (count($parts) == 2) {
                    $event->scheduleItems()->create([
                        'start_time' => trim($parts[0]),
                        'title' => trim($parts[1]),
                        'sort_order' => $order++,
                    ]);
                }
            }
        }

        // Process media slots
        if ($request->has('media_slots')) {
            // First delete existing gallery images relations (not actual files)
            $event->galleryImages()->delete();
            
            foreach ($request->media_slots as $slot) {
                $url = is_array($slot) ? ($slot['url'] ?? '') : $slot;
                $caption = is_array($slot) ? ($slot['caption'] ?? '') : '';
                $content = is_array($slot) ? ($slot['content'] ?? '') : '';

                if (empty($url) && empty($content)) continue;
                
                $path = null;
                $type = 'text'; // Default to text if only content is provided
                
                if (!empty($url)) {
                    // Extract local path from URL (remove /storage/ prefix)
                    $path = str_replace(Storage::url(''), '', parse_url($url, PHP_URL_PATH));
                    
                    // Determine type based on extension
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $type = in_array($ext, ['mp4', 'avi', 'mov', 'wmv', 'mkv', 'webm']) ? 'video' : 'image';
                }
                
                $event->media()->create([
                    'type' => $type,
                    'url' => $path,
                    'caption' => $caption,
                    'content' => $content,
                    'is_banner' => false,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }
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
