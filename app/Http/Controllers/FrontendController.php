<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function contact()
    {
        return $this->renderView('frontend.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Note: Make sure MAIL_USERNAME is configured in .env
            Mail::raw("Bạn nhận được một tin nhắn mới từ trang Liên hệ:\n\n" .
                      "Họ tên: {$validated['name']}\n" .
                      "Email: {$validated['email']}\n" .
                      "Chủ đề: {$validated['subject']}\n" .
                      "Nội dung:\n{$validated['message']}", function ($message) use ($validated) {
                // To the site admin (or recipient address configured in .env)
                $message->to(env('MAIL_RECEIVE_ADDRESS', 'kient9596@gmail.com'))
                        ->subject('Tin nhắn mới từ: ' . $validated['name']);
                
                // Reply-To the user who submitted the form
                $message->replyTo($validated['email'], $validated['name']);
            });

            return redirect()->back()->with('success', 'Cảm ơn bạn! Tin nhắn của bạn đã được gửi thành công. Chúng tôi sẽ phản hồi sớm nhất có thể.');
        } catch (\Exception $e) {
            \Log::error('Error sending contact email: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi gửi tin nhắn. Vui lòng đảm bảo cấu hình Email (.env) đã chính xác.');
        }
    }

    public function home()
    {
        $data = \Illuminate\Support\Facades\Cache::remember('frontend_home_data', 300, function () {
            $dbCategories = \App\Models\Category::where('type', 'event_type')
                ->whereNotIn('name', ['Other', 'Khác'])
                ->get();

            $categories = $dbCategories->map(function ($c) {
                return [
                    'name' => $c->name,
                    'slug' => $c->slug,
                    'desc' => $c->name,
                    'image' => 'images/categories/' . $c->slug . '.jpg',
                    'event_count' => \App\Models\Event::published()->where('category_id', $c->id)->count()
                ];
            })->toArray();


            $dbFeatured = Event::with(['bannerImage', 'category'])
                ->published()
                ->where('created_at', '>=', now()->subMonths(3))
                ->orderByRaw('(likes_count * 3) + views_count DESC')
                ->take(4)
                ->get();
            $featuredEvents = $dbFeatured->map(function ($event) {
                return [
                    'slug'     => $event->slug,
                    'title'    => $event->title,
                    'date'     => $event->event_date->format('d.m.Y'),
                    'location' => $event->location ?? 'Đang cập nhật',
                    'summary'  => Str::limit(strip_tags($event->description), 100),
                    'category' => $event->category ? $event->category->name : 'Sự kiện',
                    'img'      => $event->bannerImage ? \App\Helpers\FileHelper::url($event->bannerImage->url, true) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
                    'views_count' => $event->views_count,
                    'likes_count' => $event->likes_count,
                ];
            })->toArray();

            $dbUpcoming = Event::with(['bannerImage', 'galleryImages', 'category'])
                ->published()
                ->upcoming()
                ->orderBy('event_date', 'asc')
                ->take(5)
                ->get();
            $upcoming = $dbUpcoming->map(function ($event) {
                $images = [];
                if ($event->bannerImage) {
                    $images[] = \App\Helpers\FileHelper::url($event->bannerImage->url, true);
                }
                foreach ($event->galleryImages->where('type', 'image')->take(2) as $gal) {
                    $images[] = \App\Helpers\FileHelper::url($gal->url, true);
                }
                if (empty($images)) {
                    $images[] = 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80';
                }
                return [
                    'slug'    => $event->slug,
                    'name'    => $event->title,
                    'date'    => $event->event_date->format('d M'),
                    'summary' => Str::limit(strip_tags($event->description), 80),
                    'status'  => 'Sắp mở',
                    'open'    => true,
                    'images'  => array_values($images),
                    'category'=> $event->category->name ?? 'Sự kiện',
                    'location'=> $event->location,
                ];
            })->toArray();

            $archivedEvents = Event::with('bannerImage')
                ->where(function($q) {
                    $q->where('status', 'archived') // Include manually archived events (which are unpublished)
                      ->orWhere(function($q2) {
                          $q2->where('is_published', true) // Only published events for natural archiving
                             ->whereNotNull('recap_drive_link')
                             ->where(function($q3) {
                                 $q3->where('event_date', '<', now())
                                    ->orWhere('end_date', '<', now());
                             });
                      });
                })
                ->orderBy('event_date', 'desc')
                ->get();
            
            $archiveGroups = $archivedEvents->groupBy(function($event) {
                return \Carbon\Carbon::parse($event->event_date)->year;
            });

            $archive = [];
            foreach ($archiveGroups as $year => $events) {
                // Sort by likes and views priority
                $topEvents = $events->sortByDesc(function($e) {
                    return ($e->likes_count * 3) + $e->views_count;
                })->take(5)->values();

                $eventsArray = $topEvents->map(function($ev) {
                    return [
                        'featured_title' => $ev->title,
                        'featured_url' => route('events.show', $ev->slug),
                        'img' => $ev->bannerImage ? \App\Helpers\FileHelper::url($ev->bannerImage->url, true) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
                        'desc' => 'Kho lưu trữ chứa sự kiện đã diễn ra trong năm. Từ hội thảo, hội nghị đến các hoạt động ngoại khóa.',
                    ];
                })->toArray();

                $archive[] = [
                    'year' => $year,
                    'title' => 'Tổng kết năm ' . $year,
                    'events' => $eventsArray,
                    'achievements' => [$events->count() . ' sự kiện đã tổ chức'],
                ];
            }
            // Sort archive by year descending
            usort($archive, function($a, $b) {
                return $b['year'] <=> $a['year'];
            });

            $dbMedia = \App\Models\EventMedia::with('event')
                ->whereHas('event', function($q) {
                    $q->published();
                })
                ->whereIn('type', ['image', 'video'])
                ->where('is_banner', false)
                ->orderByRaw('(CASE WHEN caption IS NOT NULL AND caption != "" THEN 1 ELSE 0 END) DESC')
                ->latest()
                ->take(10)
                ->get();

            $media = $dbMedia->map(function ($m) {
                $labelType = $m->type == 'video' ? 'Video' : 'Album';
                $ext = strtoupper(pathinfo($m->url, PATHINFO_EXTENSION));
                if (!$ext) $ext = $labelType;

                return [
                    'id' => $m->id,
                    'src' => \App\Helpers\FileHelper::url($m->url, true),
                    'type' => $m->type,
                    'format' => $ext,
                    'label' => $labelType . ' · ' . ($m->event ? $m->event->title : 'Sự kiện'),
                    'title' => $m->caption ?: ($m->event ? $m->event->title : 'Sự kiện'),
                    'event_name' => $m->event ? $m->event->title : '',
                    'event_url' => $m->event ? route('events.show', $m->event->slug) : '#',
                ];
            })->toArray();

            $totalEvents = Event::published()->count();
            $totalViews = Event::published()->sum('views_count');
            $totalLikes = Event::published()->sum('likes_count');
            
            $oldestEvent = Event::published()->min('event_date');
            $yearsArchived = 0;
            if ($oldestEvent) {
                $yearsArchived = date('Y') - \Carbon\Carbon::parse($oldestEvent)->year + 1;
            }

            $formatStat = function($value) {
                if ($value >= 1000000) return ['value' => round($value / 1000000, 1), 'suffix' => 'M', 'decimals' => 1];
                if ($value >= 1000) return ['value' => round($value / 1000, 1), 'suffix' => 'K', 'decimals' => 1];
                return ['value' => $value, 'suffix' => '', 'decimals' => 0];
            };

            $eStat = $formatStat($totalEvents);
            $vStat = $formatStat($totalViews);
            $lStat = $formatStat($totalLikes);

            $stats = [
                ['value' => $eStat['value'], 'label' => 'Tổng sự kiện', 'suffix' => $eStat['suffix'] ?: '+', 'decimals' => $eStat['decimals']],
                ['value' => $lStat['value'], 'label' => 'Lượt yêu thích', 'suffix' => $lStat['suffix'], 'decimals' => $lStat['decimals']],
                ['value' => $vStat['value'], 'label' => 'Lượt xem', 'suffix' => $vStat['suffix'], 'decimals' => $vStat['decimals']],
                ['value' => max(1, $yearsArchived), 'label' => 'Năm hoạt động', 'suffix' => '', 'decimals' => 0],
            ];

            $dbSlides = Event::with(['bannerImage', 'category'])
                ->published()
                ->where('event_date', '<=', now())
                ->latest()
                ->take(6)
                ->get();
            $slides = $dbSlides->map(function ($event, $index) {
                return [
                    'id'          => $event->id,
                    'eyebrow'     => $event->location ?? 'Toàn trường',
                    'title'       => $event->title,
                    'description' => Str::limit(strip_tags($event->description), 120),
                    'image'       => $event->bannerImage ? \App\Helpers\FileHelper::url($event->bannerImage->url, true) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
                    'tag'         => $event->category ? $event->category->name : 'Sự kiện',
                    'cta_label'   => 'Xem chi tiết',
                    'cta_url'     => route('events.show', $event->slug),
                ];
            })->toArray();
            // Fallback for slider if no events exist
            if (empty($slides)) {
                $slides = [
                    [
                        'id'          => 1,
                        'eyebrow'     => 'Chưa có sự kiện',
                        'title'       => 'Hệ thống đang được cập nhật',
                        'description' => 'Vui lòng quay lại sau.',
                        'image'       => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
                        'tag'         => 'Hệ thống',
                        'cta_label'   => 'Trang chủ',
                        'cta_url'     => '#',
                    ]
                ];
            }

            return compact('categories', 'featuredEvents', 'upcoming', 'archive', 'media', 'stats', 'slides');
        });

        extract($data);

        return $this->renderView('frontend.home', compact('categories', 'featuredEvents', 'upcoming', 'archive', 'media', 'stats', 'slides'));
    }

    public function events(Request $request)
    {
        $selectedCategory = $request->input('category');
        $searchQuery = $request->input('search');
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');
        $selectedStatus = $request->input('status');

        $query = Event::with(['bannerImage', 'category'])
            ->published()
            ->orderBy('event_date', 'desc');

        if ($selectedCategory) {
            $query->whereHas('category', function($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        if ($searchQuery) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%')
                  ->orWhere('description', 'like', '%' . $searchQuery . '%')
                  ->orWhere('location', 'like', '%' . $searchQuery . '%');
            });
        }

        if ($selectedYear) {
            $query->whereYear('event_date', $selectedYear);
        }

        if ($selectedMonth) {
            $query->whereMonth('event_date', $selectedMonth);
        }

        // Base query: Exclude completed events (only show upcoming and ongoing)
        $query->where(function($q) {
            $q->where('end_date', '>=', now())
              ->orWhere(function($subQ) {
                  $subQ->whereNull('end_date')
                       ->where('event_date', '>=', now()->startOfDay());
              });
        });

        if ($selectedStatus) {
            if ($selectedStatus === 'upcoming') {
                $query->where('event_date', '>', now());
            } elseif ($selectedStatus === 'ongoing') {
                $query->where('event_date', '<=', now());
            }
        }

        $perPage = $this->isMobile() ? 7 : 10;
        $events = $query->paginate($perPage);

        // Get unique years for filter
        $driver = \Illuminate\Support\Facades\DB::connection()->getDriverName();
        $yearExpression = $driver === 'sqlite' ? "strftime('%Y', event_date)" : "YEAR(event_date)";

        $availableYears = Event::published()
            ->selectRaw("$yearExpression as year")
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        // Get categories for navigation menu / filter
        $dbCategories = \App\Models\Category::where('type', 'event_type')
            ->whereNotIn('name', ['Other', 'Khác'])
            ->get();
        $categories = $dbCategories->map(function ($c) {
            return [
                'name' => $c->name,
                'slug' => $c->slug,
                'desc' => $c->name
            ];
        })->toArray();

        return $this->renderView('frontend.events', compact(
            'events', 'categories', 'selectedCategory', 'searchQuery',
            'availableYears', 'selectedYear', 'selectedMonth', 'selectedStatus'
        ));
    }

    public function archive(Request $request)
    {
        $selectedYear = $request->input('year');

        $query = Event::with(['bannerImage', 'category'])
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
            ->where('recap_drive_link', '!=', '')
            ->orderBy('event_date', 'desc');

        $events = $query->get();

        $archive = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'event_year' => \Carbon\Carbon::parse($event->event_date)->year,
                'year' => \Carbon\Carbon::parse($event->event_date)->year,
                'month' => \Carbon\Carbon::parse($event->event_date)->format('n'),
                'category' => $event->category ? $event->category->name : 'Sự kiện khác',
                'title' => $event->title,
                'date_str' => \Carbon\Carbon::parse($event->event_date)->format('d/m/Y'),
                'desc' => Str::limit(strip_tags($event->description), 100),
                'url' => route('events.show', $event->slug),
                'img' => $event->bannerImage ? \App\Helpers\FileHelper::url($event->bannerImage->url, true) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
            ];
        })->toArray();

        // Get categories for navigation menu
        $dbCategories = \App\Models\Category::where('type', 'event_type')
            ->whereNotIn('name', ['Other', 'Khác'])
            ->get();
        $categories = $dbCategories->map(function ($c) {
            return [
                'name' => $c->name,
                'slug' => $c->slug,
                'desc' => $c->name
            ];
        })->toArray();

        $totalArchivedEvents = $events->count();
        $eventIds = $events->pluck('id')->toArray();
        $totalImages = \App\Models\EventMedia::whereIn('event_id', $eventIds)->where('type', 'image')->count();
        $totalVideos = \App\Models\EventMedia::whereIn('event_id', $eventIds)->where('type', 'video')->count();

        // 3 nearest upcoming events for the CTA polaroid cards
        $upcomingEvents = \App\Models\Event::with('bannerImage')
            ->published()
            ->where('event_date', '>', now())
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get()
            ->map(function($event) {
                return [
                    'title' => $event->title,
                    'date_str' => \Carbon\Carbon::parse($event->event_date)->format('d/m/Y'),
                    'url' => route('events.show', $event->slug),
                    'img' => $event->bannerImage ? \App\Helpers\FileHelper::url($event->bannerImage->url, true) : null,
                ];
            })->toArray();

        return $this->renderView('frontend.archive', compact('archive', 'categories', 'selectedYear', 'totalArchivedEvents', 'totalImages', 'totalVideos', 'upcomingEvents'));
    }
}
