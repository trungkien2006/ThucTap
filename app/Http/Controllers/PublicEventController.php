<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class PublicEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('bannerImage', 'category', 'registrations')
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

        $events = $query->paginate(12);
        $categories = Category::eventTypes()->get();

        return view('welcome', compact('events', 'categories'));
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
            'documents',
        ])->where('slug', $slug)->published()->firstOrFail();

        // Tăng lượt xem
        $event->increment('views_count');

        return view('events.show', compact('event'));
    }
}
