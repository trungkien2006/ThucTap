<?php
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
?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-4">
        
        <div class="flex items-end justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl md:text-[22px] font-semibold tracking-tight">Tổng quan</h1>
                <p class="text-xs text-muted-foreground mt-0.5">Học kỳ <?php echo e($semesterName); ?> <?php echo e($schoolYear); ?> · Cập nhật 2 phút trước</p>
            </div>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <?php
                $nextEventDate = $upcomingEvents->first() ? $upcomingEvents->first()->event_date->format('d/m/Y') : 'Không có';
                
                $statCards = [
                    [
                        'label' => 'Tổng số sự kiện', 
                        'value' => $totalEvents, 
                        'delta' => $deltas['events'] ?? '0%', 
                        'icon' => 'calendar', 
                        'extra' => '<span class="text-muted-foreground ml-auto whitespace-nowrap">('.$completedEventsCount.' đã kết thúc)</span>',
                        'url' => route('admin.events.index')
                    ],
                    [
                        'label' => 'Sự kiện sắp diễn ra', 
                        'value' => $upcomingEventsCount, 
                        'custom_bottom_text' => '📅 Sự kiện tiếp theo: ' . $nextEventDate, 
                        'icon' => 'calendar-clock',
                        'url' => route('admin.events.index', ['status' => ['upcoming']])
                    ],
                    [
                        'label' => 'Sự kiện chưa xuất bản', 
                        'value' => $draftEventsCount, 
                        'custom_bottom_text' => '⏳ Đang chờ hoàn thiện', 
                        'icon' => 'file-text',
                        'url' => route('admin.events.index', ['status' => ['draft']])
                    ],
                ];
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $isNegative = isset($s['delta']) ? str_starts_with($s['delta'], '-') : false;
                    $isZero = isset($s['delta']) ? $s['delta'] === '0%' : false;
                    $textColor = $isNegative ? 'text-rose-600' : ($isZero ? 'text-muted-foreground' : 'text-emerald-600');
                    $iconName = $isNegative ? 'arrow-down-right' : ($isZero ? 'minus' : 'arrow-up-right');
                ?>
                <div onclick="window.location='<?php echo e($s['url']); ?>'"
                    class="bg-card rounded-2xl border-none p-4 flex flex-col justify-between shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 h-full cursor-pointer transition-all duration-300 group">
                    <div class="space-y-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-[11px] uppercase tracking-wide text-muted-foreground font-medium truncate block"
                                title="<?php echo e($s['label']); ?>"><?php echo e($s['label']); ?></span>
                            <i data-lucide="<?php echo e($s['icon']); ?>" class="h-3.5 w-3.5 text-muted-foreground shrink-0"></i>
                        </div>
                        <div class="text-xl font-semibold tracking-tight group-hover:text-primary transition-colors"><?php echo e($s['value']); ?></div>
                    </div>
                    <div class="flex items-center gap-1 text-[11px] mt-2 pt-1 border-t border-border/40">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($s['custom_bottom_text'])): ?>
                            <span class="text-slate-600 font-medium whitespace-nowrap"><?php echo e($s['custom_bottom_text']); ?></span>
                        <?php else: ?>
                            <i data-lucide="<?php echo e($iconName); ?>" class="h-3 w-3 <?php echo e($textColor); ?> shrink-0"></i>
                            <span class="<?php echo e($textColor); ?> font-medium whitespace-nowrap"><?php echo e($s['delta']); ?></span>
                            <span class="text-muted-foreground truncate">so với tháng trước</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($s['extra'])): ?>
                            <?php echo $s['extra']; ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            
            <div
                class="bg-card rounded-2xl border-none p-5 lg:col-span-2 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 flex flex-col gap-3 transition-all duration-300">
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

            
            <div class="bg-card rounded-2xl border-none p-5 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 flex flex-col lg:col-span-1 transition-all duration-300">
                <div>
                    <h2 class="text-sm font-semibold">Danh mục phổ biến</h2>
                    <p class="text-[11px] text-muted-foreground">Tỷ lệ trên tổng số sự kiện trong vòng 1 năm</p>
                </div>
                <div class="h-40 flex items-center justify-center gap-4 mt-3">
                    <div class="w-1/2 h-full relative">
                        <canvas id="popularCategoriesChart"></canvas>
                    </div>
                    <div class="flex-1 space-y-1.5 overflow-y-auto max-h-full">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="flex items-center gap-2 text-xs category-legend-item">
                                <span class="h-2 w-2 rounded-sm shrink-0" style="background: <?php echo e($c['color']); ?>"></span>
                                <span class="flex-1 truncate"><?php echo e($c['category']); ?></span>
                                <span class="tabular-nums text-muted-foreground font-medium"><?php echo e($c['count']); ?></span>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <p class="text-xs text-muted-foreground py-4">Chưa có dữ liệu</p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            
            <div class="bg-card rounded-2xl border-none p-5 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 flex flex-col gap-3 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold">Sự kiện xem nhiều nhất</h2>
                    <span
                        class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-secondary text-secondary-foreground">30
                        ngày qua</span>
                </div>
                <div class="space-y-2.5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $mostViewed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="flex items-center gap-3 most-viewed-item">
                            <span
                                class="text-[11px] font-mono w-4 text-muted-foreground"><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-medium truncate"><?php echo e($event->title); ?></div>
                                <div class="h-1 mt-1 bg-muted rounded-full overflow-hidden">
                                    <div class="h-1 bg-primary rounded-full"
                                        style="width: <?php echo e($mostViewed->first()->views_count > 0 ? round(($event->views_count / $mostViewed->first()->views_count) * 100) : 0); ?>%">
                                    </div>
                                </div>
                            </div>
                            <span
                                class="text-xs font-mono text-muted-foreground tabular-nums"><?php echo e(number_format($event->views_count ?? 0)); ?></span>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <p class="text-xs text-muted-foreground text-center py-4">Chưa có dữ liệu</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div
                class="bg-card rounded-2xl border-none p-5 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 lg:col-span-2 flex flex-col gap-3 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold">Hoạt động gần đây</h2>
                    <a href="<?php echo e(route('admin.profile.activity')); ?>"
                        class="h-7 px-2 text-xs text-muted-foreground hover:text-foreground hover:bg-accent rounded transition-all flex items-center">Xem
                        tất cả</a>
                </div>
                <div class="relative">
                    <div class="absolute left-[15px] top-1 bottom-1 w-px bg-border"></div>
                    <div class="space-y-3">
                        <?php
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
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $userName = $act['user_name'] ?? 'Admin';
                                $words = explode(' ', $userName);
                                $initials = collect($words)->map(fn($w) => substr($w, 0, 1))->slice(0, 2)->implode('');
                                $timeStr = isset($act['created_at']) ? \Carbon\Carbon::parse($act['created_at'])->diffForHumans() : '—';
                            ?>
                            <a href="<?php echo e($act['url'] ?? '#'); ?>"
                                class="flex gap-3 items-start activity-item hover:bg-accent/40 p-2 -mx-2 rounded-lg transition-colors">
                                <div
                                    class="h-8 w-8 shrink-0 rounded-full bg-accent text-accent-foreground grid place-items-center text-[10px] font-semibold relative z-10 border-2 border-background uppercase">
                                    <?php echo e($initials); ?>

                                </div>
                                <div class="flex-1 min-w-0 pt-1">
                                    <p class="text-xs leading-snug">
                                        <span class="font-medium"><?php echo e($userName); ?></span>
                                        <span class="text-muted-foreground"> <?php echo e($act['activity']); ?></span>
                                    </p>
                                    <span class="text-[11px] text-muted-foreground"><?php echo e($timeStr); ?></span>
                                </div>
                            </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <p class="text-xs text-muted-foreground pl-8 py-2 font-medium">Chưa có hoạt động nào.</p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function () {
            const months = ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'];
            const events = <?php echo json_encode($eventsTrend); ?>;

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
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                pointHitRadius: 30, // Magnetic effect radius
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#546abf',
                                pointBorderWidth: 2,
                                pointHoverBackgroundColor: '#546abf',
                                pointHoverBorderColor: '#ffffff',
                                pointHoverBorderWidth: 2,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            axis: 'x',
                            intersect: false,
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: { 
                                enabled: true,
                                intersect: false,
                                mode: 'index',
                                titleFont: { family: 'Inter' },
                                bodyFont: { family: 'Inter' },
                                padding: 10,
                                cornerRadius: 4,
                                displayColors: false
                            }
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
                        labels: <?php echo json_encode(collect($categories)->pluck('category')); ?>,
                        datasets: [{
                            data: <?php echo json_encode(collect($categories)->pluck('count')); ?>,
                            backgroundColor: <?php echo json_encode(collect($categories)->pluck('color')); ?>,
                            borderWidth: 0,
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '45%',
                        layout: {
                            padding: 15
                        },
                        interaction: {
                            mode: 'nearest',
                            intersect: false,
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: { 
                                enabled: true,
                                intersect: false,
                                titleFont: { family: 'Inter' },
                                bodyFont: { family: 'Inter' },
                                padding: 10,
                                cornerRadius: 4
                            }
                        }
                    }
                });
            }
        })();
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\anima\Downloads\ThucTap-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>