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
        $query = Event::query()->with('bannerImage', 'category', 'departments', 'creator')
            ->where('status', '!=', 'archived');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('id', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('year_start') && $request->filled('year_end')) {
            $query->whereYear('event_date', '>=', $request->year_start)
                  ->whereYear('event_date', '<=', $request->year_end);
        } elseif ($request->filled('year_start')) {
            $query->whereYear('event_date', '>=', $request->year_start);
        } elseif ($request->filled('year_end')) {
            $query->whereYear('event_date', '<=', $request->year_end);
        }

        if ($request->filled('semester')) {
            $semester = $request->semester;
            $months = [];
            switch ($semester) {
                case '1': $months = [9, 10, 11, 12]; break; // Fall
                case '2': $months = [1, 2, 3, 4]; break; // Spring
                case '3': $months = [5, 6, 7, 8]; break; // Summer
            }
            if (!empty($months)) {
                $query->where(function($q) use ($months) {
                    foreach ($months as $month) {
                        $q->orWhereMonth('event_date', $month);
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

        if ($request->filled('status')) {
            $statuses = array_filter(is_array($request->status) ? $request->status : [$request->status]);
            if (!empty($statuses)) {
                $query->where(function ($q) use ($statuses) {
                    if (in_array('draft', $statuses)) {
                        $q->orWhere('is_published', false);
                    }
                    if (in_array('upcoming', $statuses)) {
                        $q->orWhere(function ($sub) {
                            $sub->where('is_published', true)
                                ->where('event_date', '>', now());
                        });
                    }
                    if (in_array('running', $statuses)) {
                        $q->orWhere(function ($sub) {
                            $sub->where('is_published', true)
                                ->where('event_date', '<=', now())
                                ->where(function($sub2) {
                                    $sub2->whereNull('end_date')->whereRaw('DATE(event_date) >= ?', [now()->toDateString()])
                                         ->orWhere('end_date', '>=', now());
                                });
                        });
                    }
                    if (in_array('completed', $statuses)) {
                        $q->orWhere(function ($sub) {
                            $sub->where('is_published', true)
                                ->where(function($sub2) {
                                    $sub2->where('end_date', '<', now())
                                         ->orWhere(function($sub3) {
                                             $sub3->whereNull('end_date')->whereRaw('DATE(event_date) < ?', [now()->toDateString()]);
                                         });
                                });
                        });
                    }
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
            'end_date' => 'nullable|date|after_or_equal:event_date',
            'location' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'department_ids' => 'nullable|array',
            'department_ids.*' => 'exists:categories,id',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',

        ]);

        // Remove banner_image, speaker_ids from validated data
        unset($validated['banner_image'], $validated['speaker_ids'], $validated['department_ids']);

        $event = new Event($validated);
        $event->is_published = false;
        $event->status = 'draft';
        $event->created_by = auth()->id();
        $event->save();

        if ($request->has('speaker_ids')) {
            $syncData = [];
            foreach ($request->input('speaker_ids', []) as $id) {
                $syncData[$id] = ['role' => 'speaker'];
            }
            
            $event->speakers()->sync($syncData);
        }

        if ($request->has('department_ids')) {
            $event->departments()->sync($request->input('department_ids'));
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $categorySlug = $event->category ? $event->category->slug : 'uncategorized';
            $folderPath = "{$categorySlug}/{$event->slug}/banners";
            $path = $request->file('banner_image')->store($folderPath, 'public');
            $event->media()->create([
                'type' => 'image',
                'url' => $path,
                'is_banner' => true,
            ]);
        }

        ActivityLogger::log("đã tạo sự kiện mới: {$event->title}", route('admin.events.index'));

        if ($request->input('redirect_to') === 'index') {
            return redirect()->route('admin.events.index')->with('success', 'Sự kiện đã được lưu dưới dạng Bản nháp.');
        }

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
        $event = new \App\Models\Event([
            'id' => 9999,
            'title' => 'Sự kiện mẫu (Preview)',
            'slug' => 'su-kien-mau-preview',
            'description' => 'Đây là nội dung sự kiện mẫu được hệ thống sinh ra tự động để phục vụ cho việc xem trước bố cục.',
            'event_date' => now()->addDays(7),
            'location' => 'Hội trường A',
            'academic_year' => 'Fall 2026',
            'page_template' => $templateId,
        ]);
        
        $category = new \App\Models\Category(['name' => 'Sự kiện Tiêu chuẩn']);
        $event->setRelation('category', $category);
        
        $banner = new \App\Models\EventMedia([
            'url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1600&q=80',
            'type' => 'image',
            'is_banner' => true
        ]);
        $event->setRelation('bannerImage', $banner);
        
        $subBanner = new \App\Models\EventMedia([
            'url' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&w=1600&q=80',
            'type' => 'image',
            'is_recap' => true
        ]);
        $event->setRelation('subBannerImage', $subBanner);
        
        $gallery = collect([
            new \App\Models\EventMedia(['url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80', 'type' => 'image', 'content' => 'Nội dung sự kiện mẫu đoạn 1. Khai mạc chương trình và giới thiệu đại biểu.']),
            new \App\Models\EventMedia(['url' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=800&q=80', 'type' => 'image', 'content' => 'Nội dung sự kiện mẫu đoạn 2. Thảo luận các chủ đề chính.']),
            new \App\Models\EventMedia(['url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80', 'type' => 'image', 'content' => 'Nội dung sự kiện mẫu đoạn 3. Giao lưu khán giả.']),
            new \App\Models\EventMedia(['url' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80', 'type' => 'image', 'content' => 'Nội dung sự kiện mẫu đoạn 4. Bế mạc chương trình.']),
        ]);
        $event->setRelation('galleryImages', $gallery);
        
        $speaker = new \App\Models\Speaker([
            'name' => 'Nguyễn Văn A',
            'bio' => 'Chuyên gia mẫu',
            'photo_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
        ]);
        $event->setRelation('speakers', collect([$speaker]));
        
        $schedule = collect([
            new \App\Models\EventSchedule(['start_time' => now()->setTime(8,0), 'end_time' => now()->setTime(9,0), 'title' => 'Đón khách & Check-in']),
            new \App\Models\EventSchedule(['start_time' => now()->setTime(9,0), 'end_time' => now()->setTime(11,0), 'title' => 'Khai mạc & Báo cáo chuyên đề']),
        ]);
        $event->setRelation('scheduleItems', $schedule);
        
        $viewName = 'events.show';
        if ($templateId > 1 && view()->exists("events.show-template{$templateId}")) {
            $viewName = "events.show-template{$templateId}";
        }
        
        return view($viewName, compact('event'));
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

            'schedule_data' => 'nullable|string',
            

            
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
        if ($request->has('registration_link')) $event->qr_code_path = $request->registration_link;
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
        $event->speakers()->sync($syncData);

        if ($request->has('schedule_data')) {
            $scheduleItems = json_decode($request->schedule_data, true);
            if (is_array($scheduleItems)) {
                $event->scheduleItems()->delete();
                $baseDate = $event->event_date ? $event->event_date->format('Y-m-d') : now()->format('Y-m-d');
                
                foreach ($scheduleItems as $item) {
                    if (empty($item['title'])) continue;
                    
                    $startTime = null;
                    if (!empty($item['start_time'])) {
                        try {
                            $startTime = \Carbon\Carbon::parse($baseDate . ' ' . $item['start_time']);
                        } catch (\Exception $e) {}
                    }
                    if (!$startTime) {
                        $startTime = \Carbon\Carbon::parse($baseDate . ' 00:00:00');
                    }
                    
                    $endTime = null;
                    if (!empty($item['end_time'])) {
                        try {
                            $endTime = \Carbon\Carbon::parse($baseDate . ' ' . $item['end_time']);
                        } catch (\Exception $e) {}
                    }

                    $event->scheduleItems()->create([
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'title' => trim($item['title']),
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
        ]);

        $newestEventsData = \Illuminate\Support\Facades\Cache::remember('admin_preview_newest_events', 300, function() {
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
        $eventSpeakerIds = $event->speakers()->pluck('speakers.id')->toArray();
        $speakers = \App\Models\Speaker::where(function ($q) use ($eventSpeakerIds) {
                $q->where('is_hidden', false)
                  ->orWhereIn('id', $eventSpeakerIds);
            })
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
            'end_date' => 'nullable|date|after_or_equal:event_date',
            'location' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'department_ids' => 'nullable|array',
            'department_ids.*' => 'exists:categories,id',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'recap_images' => 'nullable|array',
            'recap_images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,avi,mov,wmv,mkv,webm|max:51200',
            'delete_recap_media' => 'nullable|array',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',

            'status' => 'required|in:draft,published',
        ]);

        $status = $validated['status'];
        unset($validated['status'], $validated['banner_image'], $validated['speaker_ids'], $validated['department_ids'], $validated['recap_images'], $validated['delete_recap_media']);

        $event->fill($validated);

        $event->is_published = ($status === 'published');
        $event->status = $status;

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
            
            $path = $request->file('banner_image')->store($folderPath, 'public');
            
            $event->media()->create([
                'type' => 'image',
                'url' => $path,
                'is_banner' => true,
            ]);
        }
        
        // Handle delete recap media
        if ($request->has('delete_recap_media')) {
            $mediaToDelete = $event->media()->whereIn('id', $request->delete_recap_media)->where('is_recap', true)->get();
            foreach ($mediaToDelete as $media) {
                if (Storage::exists($media->url)) {
                    Storage::delete($media->url);
                }
                $media->delete();
            }
        }
        
        // Handle new recap media upload
        if ($request->hasFile('recap_images')) {
            $categorySlug = $event->category ? $event->category->slug : 'uncategorized';
            $folderPath = "{$categorySlug}/{$event->slug}/media";
            
            foreach ($request->file('recap_images') as $file) {
                $path = $file->store($folderPath, 'public');
                
                $ext = strtolower($file->getClientOriginalExtension());
                $type = in_array($ext, ['mp4', 'avi', 'mov', 'wmv', 'mkv', 'webm']) ? 'video' : 'image';
                
                $event->media()->create([
                    'type' => $type,
                    'url' => $path,
                    'is_banner' => false,
                    'is_recap' => true,
                ]);
            }
        }

        $event->save();

        if ($request->has('speaker_ids') || $request->has('has_speakers_field')) {
            $syncData = [];
            foreach ($request->input('speaker_ids', []) as $id) {
                $syncData[$id] = ['role' => 'speaker'];
            }
            $event->speakers()->sync($syncData);
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

        if (request()->headers->get('referer') && strpos(request()->headers->get('referer'), route('admin.archive.index')) !== false) {
            return redirect()->route('admin.archive.index')->with('success', 'Đã xóa sự kiện thành công.');
        }

        return redirect()->route('admin.events.index')->with('success', 'Đã xóa sự kiện thành công.');
    }

    public function archive(Event $event)
    {
        $event->update([
            'is_published' => false,
            'status' => 'archived'
        ]);

        ActivityLogger::log("đã lưu trữ sự kiện: {$event->title}", route('admin.archive.index'));

        return redirect()->route('admin.events.index')->with('success', 'Đã di chuyển sự kiện vào kho lưu trữ.');
    }

    public function archiveIndex(Request $request)
    {
        $query = Event::query()->with('bannerImage', 'category', 'departments', 'creator')
            ->where(function($q) {
                $q->where('status', 'archived')
                  ->orWhere(function($q2) {
                      $q2->where('is_published', true)
                         ->where(function($q3) {
                             $q3->where('event_date', '<', now())
                                ->orWhere('end_date', '<', now());
                         });
                  });
            })
            ->whereNotNull('recap_drive_link')
            ->where('recap_drive_link', '!=', '');

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

    public function saveRecapLink(Request $request, Event $event)
    {
        $request->validate([
            'recap_drive_link' => 'required|url'
        ]);

        $link = $request->input('recap_drive_link');
        
        // Extract folder ID from Google Drive link
        $folderId = null;
        if (preg_match('/folders\/([a-zA-Z0-9_-]+)/', $link, $matches)) {
            $folderId = $matches[1];
        } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $link, $matches)) {
            $folderId = $matches[1];
        }

        if (!$folderId) {
            return back()->with('error', 'Link Google Drive không hợp lệ. Vui lòng sử dụng link thư mục (có chứa folders/ID).');
        }

        // We assume class Google\Client is available due to masbug/flysystem-google-drive-ext
        try {
            $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
            $client = new \Google\Client();
            $client->setHttpClient($guzzleClient);
            $client->setClientId(config('filesystems.disks.google.clientId'));
            $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
            
            // fetchAccessTokenWithRefreshToken might throw an exception if http_errors is true in Guzzle,
            // or return an error array if caught internally. We handle both.
            try {
                $token = $client->fetchAccessTokenWithRefreshToken(config('filesystems.disks.google.refreshToken'));
                if (isset($token['error'])) {
                    throw new \Exception('Lỗi Token: ' . ($token['error_description'] ?? $token['error']));
                }
            } catch (\Exception $tokenEx) {
                throw new \Exception('REFRESH_TOKEN trong file .env đã hết hạn hoặc bị thu hồi. Vui lòng tạo lại token mới! (Chi tiết: ' . $tokenEx->getMessage() . ')');
            }
            
            $service = new \Google\Service\Drive($client);
            
            // Query for files inside the folder, only images and videos
            $results = $service->files->listFiles([
                'q' => "'$folderId' in parents and (mimeType contains 'image/' or mimeType contains 'video/')",
                'fields' => 'files(id, name, mimeType)',
                'pageSize' => 100 // Get up to 100 files at once
            ]);

            $files = $results->getFiles();

            if (count($files) === 0) {
                return back()->with('error', 'Không tìm thấy hình ảnh/video nào trong thư mục. Đảm bảo thư mục đã được chia sẻ công khai "Anyone with the link".');
            }

            // Gỡ các ảnh cũ khỏi Google Drive trước khi thêm ảnh mới
            $oldRecapMedia = $event->media()->where('is_recap', true)->get();
            foreach ($oldRecapMedia as $media) {
                // Nếu ảnh được lưu trực tiếp trên Google Drive của hệ thống (không phải link ngoài)
                if (!str_starts_with($media->url, 'http') && \Illuminate\Support\Facades\Storage::exists($media->url)) {
                    \Illuminate\Support\Facades\Storage::delete($media->url);
                }
                $media->delete();
            }

            foreach ($files as $file) {
                $type = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';
                
                if ($type === 'image') {
                    // Use thumbnail endpoint for images to bypass third-party cookie blocking
                    $viewUrl = "https://drive.google.com/thumbnail?id=" . $file->getId() . "&sz=w1920";
                } else {
                    // Use preview endpoint for videos (requires iframe to render)
                    $viewUrl = "https://drive.google.com/file/d/" . $file->getId() . "/preview";
                }
                
                $event->media()->create([
                    'type' => $type,
                    'url' => $viewUrl,
                    'is_banner' => false,
                    'is_recap' => true,
                    'caption' => $file->getName()
                ]);
            }

            // Update the event with the link so it moves to Archive
            $event->recap_drive_link = $link;
            $event->save();

            return back()->with('success', 'Đã lấy ' . count($files) . ' file từ Google Drive và thêm vào Album Sự kiện!');

        } catch (\Exception $e) {
            \Log::error('Google Drive Fetch Error: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi truy cập Google Drive. Hãy chắc chắn link đúng và thư mục được cấp quyền "Anyone with the link can view". (Chi tiết: ' . $e->getMessage() . ')');
        }
    }
}
