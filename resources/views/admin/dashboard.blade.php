@extends('layouts.app')
@php
    $pageTitle = 'Dashboard';
    $categories = $categoriesData ?? [];

    $now = now();
    $month = $now->month;
    $year = $now->year;
    if ($month >= 1 && $month <= 4) {
        $semesterName = 'Spring';
        $schoolYear = ($year - 1) . '–' . $year;
    } elseif ($month >= 5 && $month <= 8) {
        $semesterName = 'Summer';
        $schoolYear = ($year - 1) . '–' . $year;
    } else {
        $semesterName = 'Fall';
        $schoolYear = $year . '–' . ($year + 1);
    }
@endphp

@section('content')
    <div class="space-y-4">
        {{-- Page Header --}}
        <div class="flex items-end justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl md:text-[22px] font-semibold tracking-tight">Tổng quan</h1>
                <p class="text-xs text-muted-foreground mt-0.5">Học kỳ {{ $semesterName }} {{ $schoolYear }} · Cập nhật 2 phút trước</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.events.create') }}"
                    class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all shadow-sm">
                    <i data-lucide="plus" class="h-5 w-5"></i> Sự kiện mới
                </a>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3">
            @php
                $statCards = [
                    ['label' => 'Tổng số sự kiện', 'value' => $totalEvents, 'delta' => $deltas['events'] ?? '0%', 'icon' => 'calendar'],
                    ['label' => 'Sự kiện sắp diễn ra', 'value' => $upcomingEventsCount, 'delta' => $deltas['upcoming'] ?? '0%', 'icon' => 'calendar-clock'],
                    ['label' => 'Sự kiện hoàn thành', 'value' => $completedEventsCount, 'delta' => $deltas['completed'] ?? '0%', 'icon' => 'calendar-check'],
                    ['label' => 'Lượt xem sự kiện', 'value' => number_format($totalViews), 'delta' => $deltas['views'] ?? '0%', 'icon' => 'eye'],
                    ['label' => 'Tổng media', 'value' => number_format($totalMedia), 'delta' => $deltas['media'] ?? '0%', 'icon' => 'film'],
                ];
            @endphp
            @foreach($statCards as $s)
                <div
                    class="bg-card rounded-lg border border-border p-3 flex flex-col justify-between shadow-none stat-card-interactive h-full">
                    <div class="space-y-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-[11px] uppercase tracking-wide text-muted-foreground font-medium truncate block"
                                title="{{ $s['label'] }}">{{ $s['label'] }}</span>
                            <i data-lucide="{{ $s['icon'] }}" class="h-3.5 w-3.5 text-muted-foreground shrink-0"></i>
                        </div>
                        <div class="text-xl font-semibold tracking-tight">{{ $s['value'] }}</div>
                    </div>
                    <div class="flex items-center gap-1 text-[11px] text-success mt-2 pt-1 border-t border-border/40">
                        <i data-lucide="arrow-up-right" class="h-3 w-3 text-emerald-600 shrink-0"></i>
                        <span class="text-emerald-600 font-medium whitespace-nowrap">{{ $s['delta'] }}</span>
                        <span class="text-muted-foreground truncate">năm trước</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Charts Row 1 --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            {{-- Area Chart: Events Trend --}}
            <div
                class="bg-card rounded-lg border border-border p-4 lg:col-span-3 shadow-none flex flex-col gap-3 chart-card-interactive">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-semibold">Xu hướng sự kiện</h2>
                        <p class="text-[11px] text-muted-foreground">Xu hướng hàng tháng trong năm học (1 năm)</p>
                    </div>
                </div>
                <div class="h-56 relative">
                    <canvas id="eventsChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Charts Row 2 (Integrated Statistics & Analytics) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            {{-- Popular Categories (Doughnut Chart) --}}
            <div class="bg-card rounded-lg border border-border p-4 shadow-none flex flex-col chart-card-interactive">
                <div>
                    <h2 class="text-sm font-semibold">Danh mục phổ biến</h2>
                    <p class="text-[11px] text-muted-foreground">Tỷ lệ trên tổng số sự kiện trong vòng 1 năm</p>
                </div>
                <div class="h-40 flex items-center justify-center gap-4 mt-3">
                    <div class="w-1/2 h-full relative">
                        <canvas id="popularCategoriesChart"></canvas>
                    </div>
                    <div class="flex-1 space-y-1.5 overflow-y-auto max-h-full">
                        @forelse($categories as $c)
                            <div class="flex items-center gap-2 text-xs category-legend-item">
                                <span class="h-2 w-2 rounded-sm shrink-0" style="background: {{ $c['color'] }}"></span>
                                <span class="flex-1 truncate">{{ $c['category'] }}</span>
                                <span class="tabular-nums text-muted-foreground font-medium">{{ $c['count'] }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-muted-foreground py-4">Chưa có dữ liệu</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Media Growth (Line Chart) --}}
            <div
                class="bg-card rounded-lg border border-border p-4 lg:col-span-2 shadow-none flex flex-col gap-3 chart-card-interactive">
                <div>
                    <h2 class="text-sm font-semibold">Tăng trưởng truyền thông</h2>
                    <p class="text-[11px] text-muted-foreground">Hình ảnh và video được tải lên hàng tháng</p>
                </div>
                <div class="h-56 relative">
                    <canvas id="mediaGrowthChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Bottom Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            {{-- Most Viewed Events --}}
            <div class="bg-card rounded-lg border border-border p-4 shadow-none flex flex-col gap-3 chart-card-interactive">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold">Sự kiện xem nhiều nhất</h2>
                    <span
                        class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-secondary text-secondary-foreground">30
                        ngày qua</span>
                </div>
                <div class="space-y-2.5">
                    @forelse($mostViewed as $i => $event)
                        <div class="flex items-center gap-3 most-viewed-item">
                            <span
                                class="text-[11px] font-mono w-4 text-muted-foreground">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-medium truncate">{{ $event->title }}</div>
                                <div class="h-1 mt-1 bg-muted rounded-full overflow-hidden">
                                    <div class="h-1 bg-primary rounded-full"
                                        style="width: {{ $mostViewed->first()->views_count > 0 ? round(($event->views_count / $mostViewed->first()->views_count) * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <span
                                class="text-xs font-mono text-muted-foreground tabular-nums">{{ number_format($event->views_count ?? 0) }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-muted-foreground text-center py-4">Chưa có dữ liệu</p>
                    @endforelse
                </div>
            </div>

            {{-- Recent Activity --}}
            <div
                class="bg-card rounded-lg border border-border p-4 shadow-none lg:col-span-2 flex flex-col gap-3 chart-card-interactive">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold">Hoạt động gần đây</h2>
                    <a href="{{ route('admin.profile.activity') }}"
                        class="h-7 px-2 text-xs text-muted-foreground hover:text-foreground hover:bg-accent rounded transition-all flex items-center">Xem
                        tất cả</a>
                </div>
                <div class="relative">
                    <div class="absolute left-[15px] top-1 bottom-1 w-px bg-border"></div>
                    <div class="space-y-3">
                        @php
                            $actPath = storage_path('app/profile_activities.json');
                            $recentActivities = [];
                            if (file_exists($actPath)) {
                                $content = file_get_contents($actPath);
                                $allActivities = json_decode($content, true) ?: [];
                                usort($allActivities, function ($a, $b) {
                                    return strcmp($b['created_at'], $a['created_at']);
                                });
                                $recentActivities = array_slice($allActivities, 0, 5);
                            }
                        @endphp
                        @forelse($recentActivities as $act)
                            @php
                                $userName = $act['user_name'] ?? 'Admin';
                                $words = explode(' ', $userName);
                                $initials = collect($words)->map(fn($w) => substr($w, 0, 1))->slice(0, 2)->implode('');
                                $timeStr = isset($act['created_at']) ? \Carbon\Carbon::parse($act['created_at'])->diffForHumans() : '—';
                            @endphp
                            <a href="{{ $act['url'] ?? '#' }}"
                                class="flex gap-3 items-start activity-item hover:bg-accent/40 p-2 -mx-2 rounded-lg transition-colors">
                                <div
                                    class="h-8 w-8 shrink-0 rounded-full bg-accent text-accent-foreground grid place-items-center text-[10px] font-semibold relative z-10 border-2 border-background uppercase">
                                    {{ $initials }}
                                </div>
                                <div class="flex-1 min-w-0 pt-1">
                                    <p class="text-xs leading-snug">
                                        <span class="font-medium">{{ $userName }}</span>
                                        <span class="text-muted-foreground"> {{ $act['activity'] }}</span>
                                    </p>
                                    <span class="text-[11px] text-muted-foreground">{{ $timeStr }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-muted-foreground pl-8 py-2 font-medium">Chưa có hoạt động nào.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Upcoming Events Table (Removed Registrations) --}}
        <div class="bg-card rounded-lg border border-border overflow-hidden shadow-none">
            <div class="flex items-center justify-between p-4 border-b border-border">
                <div>
                    <h2 class="text-sm font-semibold">Sự kiện sắp diễn ra</h2>
                    <p class="text-[11px] text-muted-foreground">Các sự kiện tiếp theo được lên lịch trong tháng này</p>
                </div>
                <a href="{{ route('admin.events.index') }}"
                    class="inline-flex items-center gap-1 h-9 px-3.5 text-xs border border-border rounded-lg hover:bg-accent text-muted-foreground hover:text-foreground transition-all">
                    Quản lý
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-muted/40 text-[11px] uppercase tracking-wide text-muted-foreground">
                        <tr>
                            <th class="text-left px-4 py-2 font-medium">Sự kiện</th>
                            <th class="text-left px-3 py-2 font-medium">Danh mục</th>
                            <th class="text-left px-3 py-2 font-medium">Ngày diễn ra</th>
                            <th class="text-left px-3 py-2 font-medium">Địa điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcomingEvents as $e)
                            <tr class="border-t border-border hover:bg-muted/30">
                                <td class="px-4 py-2.5">
                                    <div class="font-medium text-xs">{{ $e->title }}</div>
                                </td>
                                <td class="px-3 py-2.5 text-xs">
                                    <span
                                        class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium border border-border bg-background">{{ $e->category?->name ?? 'Seminar' }}</span>
                                </td>
                                <td class="px-3 py-2.5 text-xs tabular-nums">{{ $e->event_date->format('Y-m-d') }}</td>
                                <td class="px-3 py-2.5 text-xs">{{ $e->location ?? 'Chưa xác định' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-muted-foreground text-xs">Không có sự kiện sắp
                                    tới nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const months = ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'];
            const events = {!! json_encode($eventsTrend) !!};

            // Common premium styling helper for tooltips
            const tooltipConfig = {
                enabled: true,
                backgroundColor: 'rgba(255, 255, 255, 0.98)',
                titleColor: '#0f172a',
                titleFont: { family: 'Inter', size: 12, weight: '600' },
                bodyColor: '#475569',
                bodyFont: { family: 'Inter', size: 11 },
                borderColor: '#e2e8f0',
                borderWidth: 1,
                padding: 10,
                cornerRadius: 8,
                usePointStyle: true,
                boxWidth: 6,
                boxHeight: 6,
                boxPadding: 4,
            };

            // Custom plugin to draw a vertical dotted cursor line on hover
            const hoverLinePlugin = {
                id: 'hoverLine',
                afterDatasetsDraw: (chart) => {
                    if (chart.tooltip?._active?.length) {
                        const activePoint = chart.tooltip._active[0];
                        const ctx = chart.ctx;
                        const x = activePoint.element.x;
                        const topY = chart.scales.y.top;
                        const bottomY = chart.scales.y.bottom;
                        ctx.save();
                        ctx.beginPath();
                        ctx.moveTo(x, topY);
                        ctx.lineTo(x, bottomY);
                        ctx.lineWidth = 1;
                        ctx.strokeStyle = 'rgba(226, 232, 240, 0.8)'; // slate-200 / border color
                        ctx.setLineDash([3, 3]);
                        ctx.stroke();
                        ctx.restore();
                    }
                }
            };

            // Function to change pointer cursor on hover
            const onHoverChangeCursor = (event, chartElement) => {
                event.native.target.style.cursor = chartElement.length ? 'pointer' : 'default';
            };

            // 1. Events Trend (Area Chart with fading gradient)
            const ctx1 = document.getElementById('eventsChart');
            if (ctx1) {
                const ctx = ctx1.getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 220);
                gradient.addColorStop(0, 'rgba(84, 106, 191, 0.22)');
                gradient.addColorStop(1, 'rgba(84, 106, 191, 0)');

                new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [
                            {
                                label: 'Sự kiện',
                                data: events,
                                borderColor: '#546abf',
                                backgroundColor: gradient,
                                fill: true,
                                tension: 0.4,
                                borderWidth: 2,
                                pointRadius: 0,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: '#546abf',
                                pointHoverBorderColor: '#ffffff',
                                pointHoverBorderWidth: 2,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false }
                        },
                        scales: {
                            x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 10 } } },
                            y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { family: 'Inter', size: 10 }, stepSize: 1, callback: function (value) { if (Number.isInteger(value)) return value; } } }
                        }
                    },
                    plugins: [hoverLinePlugin]
                });
            }

            // 2. Popular Categories (Doughnut Chart)
            const ctx3 = document.getElementById('popularCategoriesChart');
            if (ctx3) {
                new Chart(ctx3, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(collect($categories)->pluck('category')) !!},
                        datasets: [{
                            data: {!! json_encode(collect($categories)->pluck('count')) !!},
                            backgroundColor: {!! json_encode(collect($categories)->pluck('color')) !!},
                            borderWidth: 2,
                            borderColor: '#ffffff',
                            hoverOffset: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%',
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false }
                        }
                    }
                });
            }

            // 3. Media Growth (Line Chart)
            const ctx4 = document.getElementById('mediaGrowthChart');
            if (ctx4) {
                new Chart(ctx4, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [
                            {
                                label: 'Hình ảnh',
                                data: {!! json_encode($imagesTrend) !!},
                                borderColor: '#546abf',
                                backgroundColor: 'transparent',
                                borderWidth: 2,
                                tension: 0.4,
                                pointRadius: 3,
                                pointHoverRadius: 5,
                                pointBackgroundColor: '#546abf',
                                pointHoverBackgroundColor: '#546abf',
                                pointHoverBorderColor: '#ffffff',
                                pointHoverBorderWidth: 2,
                            },
                            {
                                label: 'Video',
                                data: {!! json_encode($videosTrend) !!},
                                borderColor: '#62a152',
                                backgroundColor: 'transparent',
                                borderWidth: 2,
                                tension: 0.4,
                                pointRadius: 3,
                                pointHoverRadius: 5,
                                pointBackgroundColor: '#62a152',
                                pointHoverBackgroundColor: '#62a152',
                                pointHoverBorderColor: '#ffffff',
                                pointHoverBorderWidth: 2,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'top', align: 'end', labels: { boxWidth: 12, font: { family: 'Inter', size: 10 } } },
                            tooltip: { enabled: false }
                        },
                        scales: {
                            x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 10 } } },
                            y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { family: 'Inter', size: 10 }, stepSize: 1, callback: function (value) { if (Number.isInteger(value)) return value; } } }
                        }
                    },
                    plugins: [hoverLinePlugin]
                });
            }
        });
    </script>
@endpush