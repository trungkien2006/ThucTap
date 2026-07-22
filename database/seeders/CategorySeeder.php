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
        ];

        foreach ($eventTypes as $type) {
            Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($type)],
                [
                    'name' => $type,
                    'type' => 'event_type',
                ]
            );
        }

        // ── Chuyên ngành ───────────────────────────────────
        $departments = [
            'Lập trình web',
            'Digital marketing',
            'Marketing & Sales',
            'Logistics',
            'Công nghệ kĩ thuật điều khiển và tự động hóa',
            'Thiết kế đồ họa',
            'Tiếng Trung Quốc',
            'Kế toán doanh nghiệp',
        ];

        foreach ($departments as $dept) {
            Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($dept)],
                [
                    'name' => $dept,
                    'type' => 'department',
                ]
            );
        }
    }
}
