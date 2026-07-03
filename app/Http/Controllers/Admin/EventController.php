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
use App\Helpers\ActivityLogger;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query()->with('bannerImage', 'category', 'departments', 'creator');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('id', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('year_semester')) {
            $yearSemesters = array_filter(is_array($request->year_semester) ? $request->year_semester : [$request->year_semester]);
            if (!empty($yearSemesters)) {
                $query->where(function ($q) use ($yearSemesters) {
                    foreach ($yearSemesters as $ys) {
                        $parts = explode('_', $ys, 2);
                        if (count($parts) === 2) {
                            $q->orWhere(function ($sub) use ($parts) {
                                $sub->where('semester', $parts[0])
                                    ->where('academic_year', $parts[1]);
                            });
                        }
                    }
                });
            }
        }

        if ($request->filled('category_id')) {
            $categories = array_filter(is_array($request->category_id) ? $request->category_id : [$request->category_id]);
            if (!empty($categories)) {
                $query->whereIn('category_id', $categories);
            }
        }

        if ($request->filled('department_id')) {
            $depts = array_filter(is_array($request->department_id) ? $request->department_id : [$request->department_id]);
            if (!empty($depts)) {
                $query->whereHas('departments', function($q) use ($depts) {
                    $q->whereIn('categories.id', $depts);
                });
            }
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(10);

        $categories = Category::eventTypes()->get();
        $departments = Category::departments()->get();

        return view('admin.events.index', compact('events', 'categories', 'departments'));
    }

    public function show(Event $event)
    {
        $event->load('bannerImage', 'category', 'scheduleItems.speaker', 'speakers');
        return view('admin.events.show', compact('event'));
    }

    public function create()
    {
        $categories = Category::eventTypes()->get();
        $departments = Category::departments()->get();
        $speakers = \App\Models\Speaker::where('is_hidden', false)->get();
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
            'department_ids' => 'nullable|array',
            'department_ids.*' => 'exists:categories,id',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',
        ]);

        // Remove banner_image and speaker_ids from validated data
        unset($validated['banner_image'], $validated['speaker_ids'], $validated['department_ids']);

        $event = new Event($validated);
        $event->is_published = false;
        $event->created_by = auth()->id();
        $event->save();

        if ($request->has('speaker_ids')) {
            $event->speakers()->sync($request->input('speaker_ids'));
        }

        if ($request->has('department_ids')) {
            $event->departments()->sync($request->input('department_ids'));
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $categorySlug = $event->category ? $event->category->slug : 'uncategorized';
            $folderPath = "{$categorySlug}/{$event->slug}/banners";
            try {
                $path = $request->file('banner_image')->store($folderPath, 'google');
            } catch (\Exception $e) {
                $path = $request->file('banner_image')->store($folderPath, 'public');
            }
            $event->media()->create([
                'type' => 'image',
                'url' => $path,
                'is_banner' => true,
            ]);
        }

        ActivityLogger::log("đã tạo sự kiện mới: {$event->title}", route('admin.events.index'));

        // Redirect to template selection step (Step 2)
        return redirect()->route('admin.events.template', $event)->with('success', 'Sự kiện đã được tạo. Hãy chọn mẫu thiết kế!');
    }

    /**
     * Step 2: Design Studio
     */
    public function template(Event $event)
    {
        $categories = Category::eventTypes()->get();
        return view('admin.events.template-picker', compact('event', 'categories'));
    }

    public function saveTemplate(Request $request, Event $event)
    {
        $request->validate([
            'page_template' => 'required|integer|in:1,2,3,4,5,6,7'
        ]);
        
        $event->page_template = $request->page_template;
        $event->save();
        
        return redirect()->route('admin.events.design', $event)
            ->with('success', 'Đã chọn mẫu thiết kế thành công.');
    }

    public function templatePreview($templateId)
    {
        return view('admin.events.template-preview', compact('templateId'));
    }

    public function design(Event $event)
    {
        $event->load('bannerImage', 'media', 'category', 'scheduleItems', 'speakers');
        // All media in the library (global, for reuse picker)
        $mediaLibrary = EventMedia::whereIn('type', ['image', 'video'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function($m) {
                $m->full_url = \App\Helpers\FileHelper::url($m->url);
                return $m;
            });
        $eventSpeakerIds = $event->speakers->pluck('id')->toArray();
        $allSpeakers = \App\Models\Speaker::where('is_hidden', false)
            ->orWhereIn('id', $eventSpeakerIds)
            ->get();
        $featuredEvents = \App\Models\Event::where('is_published', true)
            ->where('id', '!=', $event->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        return view('admin.events.design', compact('event', 'mediaLibrary', 'allSpeakers', 'featuredEvents'));
    }

    public function saveDesign(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'end_date' => 'nullable|date_format:H:i',
            'location' => 'nullable|string',
            'academic_year' => 'nullable|string',
            'department_id' => 'nullable|exists:categories,id',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',
            'guest_ids' => 'nullable|array',
            'guest_ids.*' => 'exists:speakers,id',
            'schedule_text' => 'nullable|string',
            

            
            'sub_banner_path' => 'nullable|string',
            
            'media_slots' => 'nullable|array',
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


        if ($request->has('event_template')) $event->page_template = $request->event_template;

        $event->save();

        $syncData = [];
        if ($request->has('speaker_ids') && is_array($request->speaker_ids)) {
            foreach ($request->speaker_ids as $id) {
                $syncData[$id] = ['role' => 'speaker'];
            }
        }
        if ($request->has('guest_ids') && is_array($request->guest_ids)) {
            foreach ($request->guest_ids as $id) {
                $syncData[$id] = ['role' => 'guest'];
            }
        }
        $event->speakers()->sync($syncData);

        if ($request->has('schedule_text')) {
            $event->scheduleItems()->delete();
            $lines = explode("\n", $request->schedule_text);
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                $parts = explode('-', $line, 2);
                if (count($parts) == 2) {
                    $event->scheduleItems()->create([
                        'start_time' => trim($parts[0]),
                        'title' => trim($parts[1]),
                    ]);
                }
            }
        }

        // Process sub banner
        if ($request->has('sub_banner_path')) {
            $event->media()->where('is_recap', true)->delete();
            if (!empty($request->sub_banner_path)) {
                
                $path = $request->sub_banner_path;
                
                // Trích xuất path nếu URL được truyền vào
                if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
                    $parsed = parse_url($path);
                    if (isset($parsed['query'])) {
                        parse_str($parsed['query'], $queryParams);
                        $path = $queryParams['path'] ?? $path;
                    }
                    if ($path == $request->sub_banner_path) {
                        if (strpos($path, config('app.url')) !== false || strpos($path, 'file/proxy') !== false || strpos($path, Storage::url('')) !== false) {
                            $path = str_replace(Storage::url(''), '', $parsed['path'] ?? '');
                        }
                    }
                }
                
                $event->media()->create([
                    'type' => 'image',
                    'url' => $path,
                    'is_banner' => false,
                    'is_recap' => true,
                ]);
            }
        }

        // Process media slots
        if ($request->has('media_slots')) {
            $event->galleryImages()->delete();
            
            foreach ($request->media_slots as $slot) {
                $url = is_array($slot) ? ($slot['url'] ?? '') : $slot;
                $raw_path = is_array($slot) ? ($slot['path'] ?? null) : null;
                $caption = is_array($slot) ? ($slot['caption'] ?? '') : '';
                $content = is_array($slot) ? ($slot['content'] ?? '') : '';
                $document_url = is_array($slot) ? ($slot['document_url'] ?? '') : null;
                $document_name = is_array($slot) ? ($slot['document_name'] ?? '') : null;
                $action_url = is_array($slot) ? ($slot['action_url'] ?? '') : null;

                if (empty($url) && empty($content) && empty($document_url) && empty($action_url)) continue;
                
                $path = $raw_path;
                $type = 'text';
                
                if (!empty($url)) {
                    if (!$path) {
                        if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                            $parsed = parse_url($url);
                            if (isset($parsed['query'])) {
                                parse_str($parsed['query'], $queryParams);
                                $path = $queryParams['path'] ?? null;
                            }
                            if (!$path) {
                                // If it's not our local storage or proxy, keep the full URL
                                if (strpos($url, config('app.url')) === false && strpos($url, 'file/proxy') === false && strpos($url, Storage::url('')) === false) {
                                    $path = $url;
                                } else {
                                    $path = str_replace(Storage::url(''), '', $parsed['path'] ?? '');
                                }
                            }
                        } else {
                            $path = $url;
                        }
                    }
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $type = in_array($ext, ['mp4', 'avi', 'mov', 'wmv', 'mkv', 'webm']) ? 'video' : 'image';
                }

                $doc_path = $document_url;
                if (!empty($doc_path)) {
                    if (strpos($doc_path, 'http://') === 0 || strpos($doc_path, 'https://') === 0) {
                        $parsedDoc = parse_url($doc_path);
                        if (isset($parsedDoc['query'])) {
                            parse_str($parsedDoc['query'], $queryParams);
                            $doc_path = $queryParams['path'] ?? null;
                        }
                        if (!$doc_path) {
                            if (strpos($document_url, config('app.url')) === false && strpos($document_url, 'file/proxy') === false && strpos($document_url, Storage::url('')) === false) {
                                $doc_path = $document_url;
                            } else {
                                $doc_path = str_replace(Storage::url(''), '', $parsedDoc['path'] ?? '');
                            }
                        }
                    } else {
                        $doc_path = $document_url;
                    }
                }
                
                $event->media()->create([
                    'type' => $type,
                    'url' => $path ?? '',
                    'caption' => $caption,
                    'content' => $content,
                    'document_url' => $doc_path,
                    'document_name' => $document_name,
                    'action_url' => $action_url,
                    'is_banner' => false,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480', // Max 20MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $folderPath = 'documents';
            if ($request->has('event_id')) {
                $evt = \App\Models\Event::with('category')->find($request->event_id);
                if ($evt) {
                    $catSlug = $evt->category ? $evt->category->slug : 'uncategorized';
                    $folderPath = "{$catSlug}/{$evt->slug}/documents";
                }
            }
            $path = $file->store($folderPath, 'google');
            return response()->json([
                'success' => true,
                'name' => $file->getClientOriginalName(),
                'url' => \App\Helpers\FileHelper::url($path),
                'path' => $path
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Lỗi upload file'], 400);
    }
    public function preview(Event $event)
    {
        $event->load('bannerImage', 'media', 'category', 'scheduleItems', 'speakers');
        $featuredEvents = \App\Models\Event::where('is_published', true)
            ->where('id', '!=', $event->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        return view('admin.events.preview', compact('event', 'featuredEvents'));
    }

    public function previewIframe(Event $event)
    {
        $event->load([
            'bannerImage',
            'category',
            'scheduleItems.speaker',
            'speakers',
            'galleryImages',
            'videos',
            'documents',
        ]);

        $newestEventsData = \Illuminate\Support\Facades\Cache::remember('newest_events', 300, function() {
            return \App\Models\Event::with(['bannerImage', 'category'])
                ->where('is_published', true)
                ->orderBy('event_date', 'desc')
                ->take(5)
                ->get();
        });

        $previousEvent = null;
        $nextEvent = null;

        // Template routing
        $viewName = 'events.show';
        if ($event->page_template && view()->exists("events.show-template{$event->page_template}")) {
            $viewName = "events.show-template{$event->page_template}";
        }

        return view($viewName, compact('event', 'newestEventsData', 'previousEvent', 'nextEvent'));
    }

    public function edit(Event $event)
    {
        $event->load('bannerImage', 'speakers', 'departments');
        $categories = Category::eventTypes()->get();
        $departments = Category::departments()->get();
        $eventSpeakerIds = $event->speakers->pluck('id')->toArray();
        $speakers = \App\Models\Speaker::where('is_hidden', false)
            ->orWhereIn('id', $eventSpeakerIds)
            ->get();
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
            'department_ids' => 'nullable|array',
            'department_ids.*' => 'exists:categories,id',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',
            'status' => 'required|in:draft,published,archived',
        ]);

        $status = $validated['status'];
        unset($validated['status'], $validated['banner_image'], $validated['speaker_ids'], $validated['department_ids']);

        $event->fill($validated);

        $event->is_published = ($status === 'published');

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old banner if exists
            $oldBanner = $event->bannerImage;
            if ($oldBanner && Storage::exists($oldBanner->url)) {
                Storage::delete($oldBanner->url);
                $oldBanner->delete();
            }

            $categorySlug = $event->category ? $event->category->slug : 'uncategorized';
            $folderPath = "{$categorySlug}/{$event->slug}/banners";
            $path = $request->file('banner_image')->store($folderPath, 'google');
            $event->media()->create([
                'type' => 'image',
                'url' => $path,
                'is_banner' => true,
            ]);
        }

        $event->save();

        if ($request->has('speaker_ids') || $request->has('has_speakers_field')) {
            $event->speakers()->sync($request->input('speaker_ids', []));
        }
        if ($request->has('has_departments_field')) {
            $event->departments()->sync($request->input('department_ids', []));
        }

        ActivityLogger::log("đã cập nhật sự kiện: {$event->title}", route('admin.events.index'));

        if ($request->input('redirect_to') === 'design') {
            return redirect()->route('admin.events.template', $event)->with('success', 'Lưu thay đổi thành công. Hãy chọn mẫu thiết kế!');
        }

        return redirect()->route('admin.events.index')->with('success', 'Cập nhật sự kiện thành công.');
    }

    public function destroy(Event $event)
    {
        // Delete all associated image files from storage
        foreach ($event->media()->where('type', 'image')->get() as $image) {
            if (Storage::exists($image->url)) {
                Storage::delete($image->url);
            }
        }

        $eventTitle = $event->title;
        $event->delete();

        ActivityLogger::log("đã xóa sự kiện: {$eventTitle}", route('admin.events.index'));

        return redirect()->route('admin.events.index')->with('success', 'Đã xóa sự kiện thành công.');
    }

    public function archive(Event $event)
    {
        $event->update(['is_published' => false]);

        ActivityLogger::log("đã lưu trữ sự kiện: {$event->title}", route('admin.archive.index'));

        return redirect()->route('admin.events.index')->with('success', 'Đã di chuyển sự kiện vào kho lưu trữ.');
    }

    public function archiveIndex(Request $request)
    {
        $query = Event::query()->with('bannerImage', 'category', 'departments', 'creator')
            ->where('is_published', false);

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('id', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $events = $query->orderBy('event_date', 'desc')->get();

        $academicYears = Event::select('academic_year')->whereNotNull('academic_year')->distinct()->pluck('academic_year');
        $categories = Category::eventTypes()->get();

        return view('admin.archive.index', compact('events', 'academicYears', 'categories'));
    }
}
