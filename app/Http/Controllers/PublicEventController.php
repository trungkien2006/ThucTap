<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class PublicEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('bannerImage', 'category')
            ->published()
            ->upcoming()
            ->orderBy('event_date', 'asc');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        $perPage = $this->isMobile() ? 7 : 12;
        $events = $query->paginate($perPage);
        $categories = Category::eventTypes()->get();

        return $this->renderView('welcome', compact('events', 'categories'));
    }

    public function show($slug)
    {
        $event = Event::with([
            'bannerImage',
            'category',
            'scheduleItems.speaker',
            'speakers',
            'galleryImages',
            'videos',
        ])->where('slug', $slug)
          ->where(function($query) {
              $query->published()->orWhere('status', 'archived');
          })
          ->firstOrFail();

        // Tăng lượt xem với chống spam bằng Session
        if (!session()->has('viewed_events.' . $event->id)) {
            $event->increment('views_count');
            session()->put('viewed_events.' . $event->id, true);
        }

        $newestEventsData = \Illuminate\Support\Facades\Cache::remember('newest_events', 300, function() {
            return Event::with(['bannerImage', 'category'])
                ->where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get()
                ->map(fn($e) => [
                    'id'       => $e->id,
                    'slug'     => $e->slug,
                    'title'    => $e->title,
                    'category' => $e->category?->name,
                    'img'      => $e->bannerImage ? \App\Helpers\FileHelper::url($e->bannerImage->url) : null,
                ])
                ->toArray();
        });
        $newestEvents = collect(is_array($newestEventsData) ? $newestEventsData : [])
            ->filter(fn($e) => is_array($e) && isset($e['id']) && $e['id'] !== $event->id)
            ->take(3);

        $prominentEventsData = \Illuminate\Support\Facades\Cache::remember('prominent_events', 300, function() {
            return Event::with(['bannerImage', 'category'])
                ->where('is_published', true)
                ->orderBy('views_count', 'desc')
                ->orderBy('likes_count', 'desc')
                ->take(4)
                ->get()
                ->map(fn($e) => [
                    'id'       => $e->id,
                    'slug'     => $e->slug,
                    'title'    => $e->title,
                    'category' => $e->category?->name,
                    'img'      => $e->bannerImage ? \App\Helpers\FileHelper::url($e->bannerImage->url) : null,
                ])
                ->toArray();
        });
        $prominentEvents = collect(is_array($prominentEventsData) ? $prominentEventsData : [])
            ->filter(fn($e) => is_array($e) && isset($e['id']) && $e['id'] !== $event->id)
            ->take(3);

        $previousEvent = null;
        $nextEvent = null;
        $relatedEvents = null;

        if ($event->status === 'archived') {
            $previousEvent = Event::where('is_published', true)
                ->where('event_date', '<', $event->event_date)
                ->orderBy('event_date', 'desc')
                ->first();

            $nextEvent = Event::where('is_published', true)
                ->where('event_date', '>', $event->event_date)
                ->orderBy('event_date', 'asc')
                ->first();
        } else {
            $relatedEvents = Event::with('bannerImage')
                ->where('is_published', true)
                ->where('status', '!=', 'archived')
                ->where('category_id', $event->category_id)
                ->where('id', '!=', $event->id)
                ->orderBy('event_date', 'desc')
                ->take(3)
                ->get();
        }

        // Lấy tất cả ảnh của sự kiện (gồm ảnh Drive, ảnh tạo sự kiện và ảnh banner)
        $recapImages = $event->media()->where('type', 'image')->get();

        // Template routing
        $viewName = 'events.show';
        if ($event->page_template && view()->exists("events.show-template{$event->page_template}")) {
            $viewName = "events.show-template{$event->page_template}";
        }

        return $this->renderView($viewName, compact('event', 'newestEvents', 'prominentEvents', 'previousEvent', 'nextEvent', 'relatedEvents', 'recapImages'));
    }

    public function like($event_id)
    {
        $event = Event::findOrFail($event_id);

        if (!session()->has('liked_events.' . $event->id)) {
            $event->increment('likes_count');
            session()->put('liked_events.' . $event->id, true);
            return response()->json(['success' => true, 'likes_count' => $event->likes_count]);
        }

        return response()->json(['success' => false, 'message' => 'Bạn đã thích sự kiện này rồi', 'likes_count' => $event->likes_count]);
    }
}
