<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $featuredEvents = [
            [
                'title' => 'Design Forward — Workshop UI/UX 2026',
                'date' => '12.07.2026',
                'location' => 'Hội trường A, ĐH Bách Khoa',
                'category' => 'Workshop',
                'img' => asset('images/frontend/event-workshop.jpg'),
            ],
            [
                'title' => 'Voices of Tomorrow — Talkshow khởi nghiệp',
                'date' => '24.07.2026',
                'location' => 'Nhà hát Lớn, TP. HCM',
                'category' => 'Talkshow',
                'img' => asset('images/frontend/event-talkshow.jpg'),
            ],
            [
                'title' => 'CodeArena 2026 — Cuộc thi lập trình',
                'date' => '08.08.2026',
                'location' => 'Trung tâm Đổi mới Sáng tạo',
                'category' => 'Cuộc thi',
                'img' => asset('images/frontend/event-competition.jpg'),
            ],
            [
                'title' => 'Lễ Khai Giảng Niên Khóa 2026–2027',
                'date' => '05.09.2026',
                'location' => 'Sân Trung Tâm',
                'category' => 'Lễ khai giảng',
                'img' => asset('images/frontend/event-ceremony.jpg'),
            ],
            [
                'title' => 'AI & The Future — Seminar quốc tế',
                'date' => '22.09.2026',
                'location' => 'Auditorium B2',
                'category' => 'Seminar',
                'img' => asset('images/frontend/event-seminar.jpg'),
            ],
        ];

        $upcoming = [
            ['name' => 'Open Day 2026', 'date' => '30 Jun', 'status' => 'Đang mở', 'open' => true],
            ['name' => 'Workshop UI/UX', 'date' => '12 Jul', 'status' => 'Còn 24 chỗ', 'open' => true],
            ['name' => 'Talkshow Khởi nghiệp', 'date' => '24 Jul', 'status' => 'Sắp mở', 'open' => false],
            ['name' => 'CodeArena Vòng loại', 'date' => '08 Aug', 'status' => 'Đang mở', 'open' => true],
            ['name' => 'Lễ Khai Giảng', 'date' => '05 Sep', 'status' => 'Theo lời mời', 'open' => false],
        ];

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

        $slides = [
            [
                'id'          => 1,
                'eyebrow'     => 'Hội trường A — Cơ sở chính',
                'title'       => 'Lễ Khai Giảng Năm Học 2026',
                'description' => 'Sự kiện khai mạc năm học mới, chào đón toàn thể sinh viên khoá K2026 cùng quý thầy cô và đại biểu khách mời.',
                'image'       => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1600&q=80',
                'tag'         => 'Lễ khai giảng',
                'cta_label'   => 'Xem chi tiết',
                'cta_url'     => '#',
            ],
            [
                'id'          => 2,
                'eyebrow'     => 'Khoa Công nghệ Thông tin',
                'title'       => 'Workshop AI & Machine Learning',
                'description' => 'Buổi thực hành chuyên sâu về trí tuệ nhân tạo với các chuyên gia, dành cho sinh viên năm 3 & 4.',
                'image'       => 'https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=1600&q=80',
                'tag'         => 'Workshop',
                'cta_label'   => 'Đăng ký ngay',
                'cta_url'     => '#',
            ],
            [
                'id'          => 3,
                'eyebrow'     => 'Sân khấu ngoài trời — Khu B',
                'title'       => 'Talkshow Khởi Nghiệp Sinh Viên',
                'description' => 'Gặp gỡ và lắng nghe hành trình của các founder startup từ 22 tuổi đã gọi vốn thành công.',
                'image'       => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
                'tag'         => 'Talkshow',
                'cta_label'   => 'Xem lịch trình',
                'cta_url'     => '#',
            ],
            [
                'id'          => 4,
                'eyebrow'     => 'Phòng hội thảo B2.01',
                'title'       => 'Seminar Nghiên Cứu Khoa Học',
                'description' => 'Hội thảo nghiên cứu khoa học sinh viên cấp trường — nơi các đề tài xuất sắc được trình bày.',
                'image'       => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=1600&q=80',
                'tag'         => 'Seminar',
                'cta_label'   => 'Nộp bài tham dự',
                'cta_url'     => '#',
            ],
            [
                'id'          => 5,
                'eyebrow'     => 'Toàn trường — Tất cả cơ sở',
                'title'       => 'Cuộc Thi Lập Trình 24H',
                'description' => 'Hackathon xuyên đêm với chủ đề "EdTech for Tomorrow" — giải thưởng tổng lên đến 50 triệu đồng.',
                'image'       => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=1600&q=80',
                'tag'         => 'Cuộc thi',
                'cta_label'   => 'Đăng ký đội',
                'cta_url'     => '#',
            ],
        ];

        return view('frontend.home', compact('categories', 'featuredEvents', 'upcoming', 'archive', 'media', 'stats', 'slides'));
    }
}
