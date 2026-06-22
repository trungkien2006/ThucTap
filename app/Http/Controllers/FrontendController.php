<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function home()
    {
        $dbCategories = \App\Models\Category::where('type', 'event_type')
            ->where('name', '!=', 'Other')
            ->get();

        $vietnameseNames = [
            'Conference' => 'Hội nghị',
            'Workshop' => 'Hội thảo thực hành',
            'Seminar' => 'Hội thảo chuyên đề',
            'Cultural' => 'Văn hóa nghệ thuật',
            'Sports' => 'Thể thao',
            'Orientation' => 'Định hướng'
        ];

        $categories = $dbCategories->map(function ($c) use ($vietnameseNames) {
            return [
                'name' => $c->name,
                'slug' => $c->slug,
                'desc' => $vietnameseNames[$c->name] ?? 'Sự kiện'
            ];
        })->toArray();


        $dbFeatured = Event::with(['bannerImage', 'category'])
            ->published()
            ->orderByRaw('views_count + likes_count DESC')
            ->take(6)
            ->get();
        $featuredEvents = $dbFeatured->map(function ($event) {
            return [
                'slug'     => $event->slug,
                'title'    => $event->title,
                'date'     => $event->event_date->format('d.m.Y'),
                'location' => $event->location ?? 'Đang cập nhật',
                'summary'  => Str::limit(strip_tags($event->description), 100),
                'category' => $event->category ? $event->category->name : 'Sự kiện',
                'img'      => $event->bannerImage ? Storage::url($event->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
            ];
        })->toArray();

        $dbUpcoming = Event::with(['bannerImage', 'galleryImages'])
            ->published()
            ->upcoming()
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();
        $upcoming = $dbUpcoming->map(function ($event) {
            $images = [];
            if ($event->bannerImage) {
                $images[] = Storage::url($event->bannerImage->url);
            }
            foreach ($event->galleryImages->where('type', 'image')->take(2) as $gal) {
                $images[] = Storage::url($gal->url);
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
            ];
        })->toArray();

        $archive = [
            [
                'year' => 2023,
                'title' => 'Innovation Expo',
                'img' => asset('images/frontend/archive-2023.jpg'),
                'desc' => 'Triển lãm đổi mới sáng tạo đầu tiên do sinh viên tổ chức, hội tụ hơn 40 dự án từ 12 khoa, biến hành lang trường thành một thành phố tương lai thu nhỏ.',
                'achievements' => ['42 dự án trưng bày', '6.500 lượt tham quan', 'Giải Bạc Sinh viên NCKH'],
            ],
            [
                'year' => 2024,
                'title' => 'University Debate Finals',
                'img' => asset('images/frontend/archive-2024.jpg'),
                'desc' => 'Vòng chung kết tranh biện liên trường — đêm của ngôn từ, lý lẽ và bản lĩnh. Khán phòng kín chỗ, hàng vạn lượt xem trực tuyến.',
                'achievements' => ['32 đội tham dự', '12.000 lượt xem livestream', 'Phủ sóng 18 trường ĐH'],
            ],
            [
                'year' => 2025,
                'title' => 'UniFest — Mùa lễ hội âm nhạc',
                'img' => asset('images/frontend/archive-2025.jpg'),
                'desc' => 'Một đêm hè không ngủ. Sân khấu ngoài trời, đèn quét bầu trời, 15 nghìn người cùng hát một bài. Trở thành ký ức điện ảnh của niên khóa.',
                'achievements' => ['15.000 người tham dự', '9 nghệ sĩ biểu diễn', 'Top trending mạng xã hội'],
            ],
            [
                'year' => 2026,
                'title' => 'AI Summit — Tương lai đã ở đây',
                'img' => asset('images/frontend/archive-2026.jpg'),
                'desc' => 'Diễn đàn AI sinh viên lớn nhất từ trước đến nay, với panel chuyên gia toàn cầu, trình diễn mô hình trực tiếp và cuộc thi hackathon 48 giờ.',
                'achievements' => ['28 diễn giả quốc tế', '120 đội hackathon', 'Giải thưởng 500 triệu VND'],
            ],
        ];

        $dbMedia = \App\Models\EventMedia::with('event')
            ->whereHas('event', function($q) {
                $q->published();
            })
            ->whereIn('type', ['image', 'video'])
            ->where('is_banner', false)
            ->orderByRaw('(CASE WHEN caption IS NOT NULL AND caption != "" THEN 1 ELSE 0 END) + (CASE WHEN content IS NOT NULL AND content != "" THEN 1 ELSE 0 END) DESC')
            ->latest()
            ->take(10)
            ->get();

        $media = $dbMedia->map(function ($m) {
            $labelType = $m->type == 'video' ? 'Video' : 'Album';
            return [
                'id' => $m->id,
                'src' => Storage::url($m->url),
                'type' => $m->type,
                'label' => $labelType . ' · ' . ($m->event ? $m->event->title : 'Sự kiện'),
                'title' => $m->caption ?: ($m->content ?: 'Khoảnh khắc sự kiện'),
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
            ->latest()
            ->take(6)
            ->get();
        $slides = $dbSlides->map(function ($event, $index) {
            return [
                'id'          => $event->id,
                'eyebrow'     => $event->location ?? 'Toàn trường',
                'title'       => $event->title,
                'description' => Str::limit(strip_tags($event->description), 120),
                'image'       => $event->bannerImage ? Storage::url($event->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
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

        return view('frontend.home', compact('categories', 'featuredEvents', 'upcoming', 'archive', 'media', 'stats', 'slides'));
    }

    public function category($slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();

        // Get categories for navigation menu
        $dbCategories = \App\Models\Category::where('type', 'event_type')
            ->where('name', '!=', 'Other')
            ->get();
        $vietnameseNames = [
            'Conference' => 'Hội nghị',
            'Workshop' => 'Hội thảo thực hành',
            'Seminar' => 'Hội thảo chuyên đề',
            'Cultural' => 'Văn hóa nghệ thuật',
            'Sports' => 'Thể thao',
            'Orientation' => 'Định hướng'
        ];
        $categories = $dbCategories->map(function ($c) use ($vietnameseNames) {
            return [
                'name' => $c->name,
                'slug' => $c->slug,
                'desc' => $vietnameseNames[$c->name] ?? 'Sự kiện'
            ];
        })->toArray();

        // Newest event for the top section
        $newestEvent = Event::with(['bannerImage'])
            ->where('category_id', $category->id)
            ->published()
            ->orderBy('created_at', 'desc')
            ->first();

        // Other new events (excluding the newest one)
        $query = Event::with(['bannerImage'])
            ->where('category_id', $category->id)
            ->published()
            ->orderBy('created_at', 'desc');

        if ($newestEvent) {
            $query->where('id', '!=', $newestEvent->id);
        }
        $otherEvents = $query->paginate(10);

        // Featured events for this category
        $featuredEvents = Event::with(['bannerImage'])
            ->where('category_id', $category->id)
            ->published()
            ->orderByRaw('views_count + likes_count DESC')
            ->take(5)
            ->get();

        // Media for this category
        $dbMedia = \App\Models\EventMedia::with('event')
            ->whereHas('event', function($q) use ($category) {
                $q->published()->where('category_id', $category->id);
            })
            ->whereIn('type', ['image', 'video'])
            ->where('is_banner', false)
            ->latest()
            ->take(8)
            ->get();

        $media = $dbMedia->map(function ($m) {
            return [
                'id' => $m->id,
                'src' => Storage::url($m->url),
                'type' => $m->type,
                'title' => $m->caption ?: ($m->content ?: 'Khoảnh khắc sự kiện'),
                'event_name' => $m->event ? $m->event->title : '',
                'event_url' => $m->event ? route('events.show', $m->event->slug) : '#',
            ];
        })->toArray();

        return view('frontend.category', compact('category', 'categories', 'newestEvent', 'otherEvents', 'featuredEvents', 'media'));
    }
}
