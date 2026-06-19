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
        $categories = [
            ['name' => 'Workshop', 'desc' => 'Thực hành & sáng tạo'],
            ['name' => 'Seminar', 'desc' => 'Học thuật chuyên sâu'],
            ['name' => 'Talkshow', 'desc' => 'Đối thoại cảm hứng'],
            ['name' => 'Cuộc thi', 'desc' => 'Tranh tài & vinh danh'],
            ['name' => 'Tuyển sinh', 'desc' => 'Open day & tư vấn'],
            ['name' => 'Lễ khai giảng', 'desc' => 'Khoảnh khắc trọng đại'],
            ['name' => 'Hoạt động sinh viên', 'desc' => 'Cộng đồng & văn hóa'],
        ];

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
                'slug'   => $event->slug,
                'name'   => $event->title,
                'date'   => $event->event_date->format('d M'),
                'status' => 'Sắp mở',
                'open'   => true,
                'images' => array_values($images),
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

        $media = [
            ['src' => asset('images/frontend/media-1.jpg'), 'type' => 'album', 'label' => 'Album · UniFest 2025'],
            ['src' => asset('images/frontend/media-2.jpg'), 'type' => 'video', 'label' => 'Recap · Đêm Gala'],
            ['src' => asset('images/frontend/media-3.jpg'), 'type' => 'album', 'label' => 'Album · Triển lãm SV'],
            ['src' => asset('images/frontend/media-4.jpg'), 'type' => 'video', 'label' => 'Recap · Sports Day'],
        ];

        $stats = [
            ['value' => 248, 'label' => 'Tổng sự kiện', 'suffix' => '+', 'decimals' => 0],
            ['value' => 86, 'label' => 'Lượt tham gia', 'suffix' => 'K', 'decimals' => 0],
            ['value' => 1.2, 'label' => 'Lượt xem', 'suffix' => 'M', 'decimals' => 1],
            ['value' => 12, 'label' => 'Năm lưu trữ', 'suffix' => '', 'decimals' => 0],
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
}
