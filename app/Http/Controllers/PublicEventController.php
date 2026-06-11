<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class PublicEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::published()->upcoming()->orderBy('event_date', 'asc');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        $events = $query->paginate(12);

        return view('welcome', compact('events'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->published()->firstOrFail();
        
        // Tăng lượt xem
        $event->increment('views_count');

        return view('events.show', compact('event'));
    }
}
