<?php

use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\Admin\SpeakerController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\DocumentController;

use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/archive', [FrontendController::class, 'archive'])->name('archive');
Route::get('/events', [FrontendController::class, 'events'])->name('events.index');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');
Route::get('/events/{slug}', [PublicEventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/like', [PublicEventController::class, 'like'])->name('events.like');

Route::get('/drive-proxy', [\App\Http\Controllers\Admin\FileProxyController::class, 'stream'])->name('file.proxy');
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', function () {
        $currentYear = now()->year;
        $lastYear = now()->subYear()->year;
        
        $totalViews = \App\Models\Event::sum('views_count') ?? 0;
        $totalLikes = \App\Models\Event::sum('likes_count') ?? 0;
        $totalEvents = \App\Models\Event::count();
        $upcomingEventsCount = \App\Models\Event::where('event_date', '>=', now())->count();
        $completedEventsCount = \App\Models\Event::where('event_date', '<', now())->count();
        $totalSpeakers = \App\Models\Speaker::where('is_hidden', false)->count();
        $totalMedia = \App\Models\EventMedia::whereIn('type', ['image', 'video'])->count();

        $upcomingEvents = \App\Models\Event::with('category')
            ->where('is_published', true)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();

        $mostViewed = \App\Models\Event::with('category')
            ->where('is_published', true)
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        $getGrowthDelta = function ($current, $previous) {
            if ($previous == 0) {
                return $current > 0 ? '+100%' : '0%';
            }
            $diff = (($current - $previous) / $previous) * 100;
            return ($diff >= 0 ? '+' : '') . round($diff, 1) . '%';
        };

        $deltas = [
            'events' => $getGrowthDelta(
                \App\Models\Event::whereYear('created_at', $currentYear)->count(),
                \App\Models\Event::whereYear('created_at', $lastYear)->count()
            ),
            'upcoming' => $getGrowthDelta(
                \App\Models\Event::where('event_date', '>=', now())->whereYear('event_date', $currentYear)->count(),
                \App\Models\Event::where('event_date', '>=', now()->subYear())->whereYear('event_date', $lastYear)->count()
            ),
            'completed' => $getGrowthDelta(
                \App\Models\Event::where('event_date', '<', now())->whereYear('event_date', $currentYear)->count(),
                \App\Models\Event::where('event_date', '<', now()->subYear())->whereYear('event_date', $lastYear)->count()
            ),
            'views' => $getGrowthDelta(
                \App\Models\Event::whereYear('created_at', $currentYear)->sum('views_count'),
                \App\Models\Event::whereYear('created_at', $lastYear)->sum('views_count')
            ),
            'media' => $getGrowthDelta(
                \App\Models\EventMedia::whereIn('type', ['image', 'video'])->whereYear('created_at', $currentYear)->count(),
                \App\Models\EventMedia::whereIn('type', ['image', 'video'])->whereYear('created_at', $lastYear)->count()
            ),
        ];

        // Optimized: 1 query, database-agnostic grouping
        $eventsByMonth = \App\Models\Event::whereYear('created_at', $currentYear)
            ->pluck('created_at')
            ->map(fn($date) => \Carbon\Carbon::parse($date)->month)
            ->groupBy(fn($m) => $m)
            ->map(fn($group) => $group->count())
            ->toArray();
        $eventsTrend = [];
        for ($m = 1; $m <= 12; $m++) {
            $eventsTrend[] = $eventsByMonth[$m] ?? 0;
        }

        $popularCategories = \App\Models\Category::eventTypes()
            ->withCount(['events' => function ($q) {
                $q->where('created_at', '>=', now()->subYear());
            }])
            ->orderByDesc('events_count')
            ->take(6)
            ->get();

        $colorsList = ['#546abf', '#66b2ff', '#62a152', '#e29b3e', '#cc66ff', '#94a3b8'];
        $categoriesData = [];
        foreach ($popularCategories as $i => $cat) {
            $categoriesData[] = [
                'category' => $cat->name,
                'count' => $cat->events_count,
                'color' => $colorsList[$i % count($colorsList)]
            ];
        }

        // Optimized: 1 query, database-agnostic grouping
        $allMedia = \App\Models\EventMedia::whereIn('type', ['image', 'video'])
            ->whereYear('created_at', $currentYear)
            ->get(['type', 'created_at']);
        $imagesTrend = [];
        $videosTrend = [];
        for ($m = 1; $m <= 12; $m++) {
            $imagesTrend[] = $allMedia->where('type', 'image')->filter(fn($item) => \Carbon\Carbon::parse($item->created_at)->month === $m)->count();
            $videosTrend[] = $allMedia->where('type', 'video')->filter(fn($item) => \Carbon\Carbon::parse($item->created_at)->month === $m)->count();
        }

        return view('admin.dashboard', compact(
            'totalViews', 'totalLikes', 'totalEvents', 'upcomingEventsCount',
            'completedEventsCount', 'totalSpeakers', 'totalMedia',
            'upcomingEvents', 'mostViewed', 'deltas', 'eventsTrend', 'categoriesData',
            'imagesTrend', 'videosTrend'
        ));
    })->name('dashboard');

    // Events
    Route::post('events/{event}/archive', [App\Http\Controllers\Admin\EventController::class, 'archive'])->name('events.archive');
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
    Route::get('events/{event}/template', [App\Http\Controllers\Admin\EventController::class, 'template'])->name('events.template');
    Route::post('events/{event}/template', [App\Http\Controllers\Admin\EventController::class, 'saveTemplate'])->name('events.save_template');
    Route::get('events/{event}/design', [App\Http\Controllers\Admin\EventController::class, 'design'])->name('events.design');
    Route::post('events/{event}/save-design', [App\Http\Controllers\Admin\EventController::class, 'saveDesign'])->name('events.save_design');
    Route::post('events/upload-document', [App\Http\Controllers\Admin\EventController::class, 'uploadDocument'])->name('events.upload_document');
    Route::get('events/{event}/preview', [App\Http\Controllers\Admin\EventController::class, 'preview'])->name('events.preview');
    Route::get('events/{event}/preview-iframe', [App\Http\Controllers\Admin\EventController::class, 'previewIframe'])->name('events.preview_iframe');
    Route::get('template-preview/{templateId}', [App\Http\Controllers\Admin\EventController::class, 'templatePreview'])->name('events.template_preview');

    // Event Categories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

    // Departments
    Route::resource('departments', App\Http\Controllers\Admin\DepartmentController::class);

    // Event Archive
    Route::get('/archive', [App\Http\Controllers\Admin\EventController::class, 'archiveIndex'])->name('archive.index');

    // Speakers
    Route::resource('speakers', SpeakerController::class);

    // Media
    Route::resource('media', MediaController::class)->only(['index', 'store', 'destroy']);

    // Documents
    Route::resource('documents', DocumentController::class);

    // Profile Settings & Activities
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/activity', [App\Http\Controllers\ProfileController::class, 'activity'])->name('profile.activity');

    // Admin Users Management
    Route::get('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [\App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [\App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';