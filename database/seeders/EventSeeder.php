<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Lễ Tôn vinh Ong Vàng Polytechnic học kỳ Fall 2024',
                'slug' => 'le-ton-vinh-ong-vang-fall-2024',
                'description' => "Lễ Tôn vinh Sinh viên Giỏi, xuất sắc học kỳ Fall 2024 nhằm tuyên dương và ghi nhận những nỗ lực học tập của sinh viên. Sự kiện là dấu mốc quan trọng, đánh dấu sự trưởng thành và nỗ lực không ngừng nghỉ của các bạn sinh viên.\n\nTham gia sự kiện, các bạn không chỉ nhận được phần thưởng xứng đáng mà còn có cơ hội giao lưu, học hỏi từ các cựu sinh viên thành đạt và đại diện các doanh nghiệp hàng đầu trong ngành.\n\nSự kiện năm nay hứa hẹn mang đến nhiều bất ngờ với sự dàn dựng công phu, âm nhạc sôi động và những câu chuyện truyền cảm hứng từ chính các bạn sinh viên vượt khó vươn lên.",
                'event_date' => now()->addDays(15)->setTime(18, 0),
                'end_date' => now()->addDays(15)->setTime(21, 30),
                'location' => 'Hội trường lớn, Tòa nhà F',
                'academic_year' => '2024',


                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Talkshow: Hành trang GenZ - Sẵn sàng cho kỷ nguyên AI',
                'slug' => 'talkshow-hanh-trang-genz-ai',
                'description' => "Trí tuệ nhân tạo (AI) đang thay đổi mọi khía cạnh của cuộc sống và công việc. Talkshow 'Hành trang GenZ - Sẵn sàng cho kỷ nguyên AI' mang đến cho sinh viên bức tranh toàn cảnh về tương lai của thị trường lao động dưới sự tác động của AI.\n\nTại buổi chia sẻ, các chuyên gia công nghệ sẽ giải đáp các thắc mắc về kỹ năng cần thiết để làm chủ công nghệ, không bị AI thay thế mà ngược lại, dùng AI như một đòn bẩy để phát triển sự nghiệp.\n\nBạn sẽ được hướng dẫn sử dụng các công cụ AI phổ biến hiện nay như ChatGPT, Midjourney trong quá trình học tập và làm việc nhóm hiệu quả.",
                'event_date' => now()->addDays(5)->setTime(14, 0),
                'end_date' => now()->addDays(5)->setTime(16, 30),
                'location' => 'Phòng Hội thảo số 3',
                'academic_year' => '2024',


                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ngày hội Việc làm JobFair 2024',
                'slug' => 'jobfair-2024',
                'description' => "Ngày hội việc làm lớn nhất năm, quy tụ hơn 50 doanh nghiệp hàng đầu trong các lĩnh vực Công nghệ thông tin, Thiết kế đồ họa, Quản trị kinh doanh và Ngôn ngữ.\n\nĐây là cơ hội 'vàng' để sinh viên trực tiếp nộp CV, phỏng vấn thử, và tìm kiếm cơ hội thực tập, việc làm ngay khi còn ngồi trên ghế nhà trường.\n\nSự kiện bao gồm các gian hàng tư vấn trực tiếp, các phiên hội thảo nhỏ giới thiệu về môi trường làm việc của từng doanh nghiệp và chương trình bốc thăm trúng thưởng hấp dẫn.",
                'event_date' => now()->addDays(30)->setTime(8, 0),
                'end_date' => now()->addDays(30)->setTime(17, 0),
                'location' => 'Sân trường chính',
                'academic_year' => '2024',


                'is_published' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \Illuminate\Support\Facades\DB::table('events')->insert($events);
    }
}
