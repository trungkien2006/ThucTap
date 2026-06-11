<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ── Event Types ────────────────────────────────────
        $eventTypes = [
            'Conference',
            'Workshop',
            'Seminar',
            'Cultural',
            'Sports',
            'Orientation',
            'Other',
        ];

        foreach ($eventTypes as $type) {
            Category::create([
                'name' => $type,
                'slug' => \Illuminate\Support\Str::slug($type),
                'type' => 'event_type',
            ]);
        }

        // ── Departments ────────────────────────────────────
        $departments = [
            'Công nghệ thông tin',
            'Quản trị kinh doanh',
            'Thiết kế đồ hoạ',
            'Ngôn ngữ Anh',
            'Ngôn ngữ Nhật',
            'Ngôn ngữ Hàn',
            'Truyền thông đa phương tiện',
        ];

        foreach ($departments as $dept) {
            Category::create([
                'name' => $dept,
                'slug' => \Illuminate\Support\Str::slug($dept),
                'type' => 'department',
            ]);
        }
    }
}
