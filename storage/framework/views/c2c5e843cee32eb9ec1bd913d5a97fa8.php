<?php
    $pageTitle = 'Events';
    $breadcrumbs = [['label' => 'Events']];
?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4">
    
    <div class="flex items-end justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-[22px] font-semibold tracking-tight">Sự kiện</h1>
            <p class="text-xs text-muted-foreground mt-0.5">Quản lý tất cả sự kiện theo chuyên ngành và học kỳ</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="<?php echo e(route('admin.events.create')); ?>" class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all shadow-sm">
                <i data-lucide="plus" class="h-5 w-5"></i> Sự kiện mới
            </a>
        </div>
    </div>

    
    <?php
        $semestersMap = ['1' => 'Fall', '2' => 'Spring', '3' => 'Summer'];
        $selectedCategories = array_filter(is_array(request('category_id')) ? request('category_id') : [request('category_id')]);
        $selectedDepartments = array_filter(is_array(request('department_id')) ? request('department_id') : [request('department_id')]);
        $selectedStatuses = array_filter(is_array(request('status')) ? request('status') : [request('status')]);
        
        $statusOptions = [
            'upcoming' => 'Sắp diễn ra',
            'running' => 'Đang diễn ra',
            'completed' => 'Đã kết thúc',
            'draft' => 'Bản nháp',
        ];
    ?>
    <!-- Top Control Bar -->
    <div class="flex flex-col gap-4 pb-4 border-b border-border text-sm text-foreground mb-6">
        <form method="GET" action="<?php echo e(route('admin.events.index')); ?>" id="filterForm" class="flex flex-col gap-4 w-full">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <input type="hidden" name="category_id[]" value="<?php echo e($c); ?>" class="filter-input-category_id">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <input type="hidden" name="department_id[]" value="<?php echo e($d); ?>" class="filter-input-department_id">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <input type="hidden" name="status[]" value="<?php echo e($s); ?>" class="filter-input-status">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <!-- Primary Filters Row -->
            <div class="flex flex-wrap items-center gap-6 w-full">
                <!-- Search Control -->
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group relative flex-1 min-w-[240px]">
                    <i data-lucide="search" class="w-4 h-4 shrink-0 pointer-events-none absolute left-0 text-muted-foreground"></i>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Tìm kiếm theo tên, ID, địa điểm…" class="pl-6 w-full font-medium bg-transparent border-none focus:outline-none focus:ring-0 text-sm placeholder:text-muted-foreground">
                </label>

                <!-- Semester Control -->
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                    <i data-lucide="book-open" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                    <select name="semester" onchange="document.getElementById('filterForm').submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                        <option value="">Tất cả Học kỳ</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $semestersMap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($val); ?>" <?php echo e(request('semester') == $val ? 'selected' : ''); ?>>Học kỳ <?php echo e($label); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </label>
                
                <!-- Category Control -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedCategories) == 0): ?>
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                    <i data-lucide="tag" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                    <select onchange="addFilterTag('category_id', this)" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm max-w-[150px] truncate">
                        <option value="">+ Danh mục</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </label>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Department Control -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedDepartments) == 0): ?>
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                    <i data-lucide="building" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                    <select onchange="addFilterTag('department_id', this)" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm max-w-[150px] truncate">
                        <option value="">+ Chuyên ngành</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($dept->id); ?>"><?php echo e($dept->name); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </label>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Status Control -->
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                    <i data-lucide="activity" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                    <select name="status" onchange="document.getElementById('filterForm').submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                        <option value="">+ Trạng thái</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($val); ?>" <?php echo e(request('status') == $val || (is_array(request('status')) && in_array($val, request('status'))) ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </label>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search') || request('semester') || request('year_start') || request('year_end') || count($selectedCategories) > 0 || count($selectedDepartments) > 0 || count($selectedStatuses) > 0): ?>
                    <div class="ml-auto flex items-center gap-6">
                        <a href="<?php echo e(route('admin.events.index')); ?>" class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors flex items-center gap-1.5" title="Xóa tất cả bộ lọc">
                            <i data-lucide="x" class="h-4 w-4"></i> Xóa lọc
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Secondary Filters Row (Year Slider and Active Tags) -->
            <div class="flex flex-wrap items-center justify-between gap-4 mt-2">
                <!-- Year Range Combobox -->
                <div class="flex items-center gap-2 h-9 rounded-lg bg-slate-50/80 border border-border/80 px-3 group focus-within:bg-white focus-within:border-primary/40 focus-within:ring-2 focus-within:ring-primary/10 transition-all">
                    <i data-lucide="calendar-range" class="w-4 h-4 shrink-0 text-muted-foreground group-focus-within:text-primary transition-colors"></i>
                    <span class="text-xs font-medium text-muted-foreground shrink-0 group-focus-within:text-primary transition-colors">Năm:</span>
                    
                    <input list="year_suggestions" type="text" name="year_start" value="<?php echo e(request('year_start')); ?>" placeholder="Từ năm" class="w-[75px] text-xs font-semibold bg-transparent border-none p-0 focus:ring-0 text-center text-foreground placeholder:text-muted-foreground/60 placeholder:font-normal" onchange="document.getElementById('filterForm').submit()">
                    
                    <span class="text-muted-foreground text-xs font-medium">-</span>
                    
                    <input list="year_suggestions" type="text" name="year_end" value="<?php echo e(request('year_end')); ?>" placeholder="Đến năm" class="w-[75px] text-xs font-semibold bg-transparent border-none p-0 focus:ring-0 text-center text-foreground placeholder:text-muted-foreground/60 placeholder:font-normal" onchange="document.getElementById('filterForm').submit()">

                    <datalist id="year_suggestions">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($y = date('Y') + 5; $y >= 2015; $y--): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($y); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </datalist>
                </div>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css">
                <style>
                    /* Customizing noUiSlider to look minimal */
                    .noUi-handle {
                        width: 14px !important;
                        height: 14px !important;
                        right: -7px !important;
                        top: -5px !important;
                        border-radius: 50%;
                        background: #0f172a !important;
                        border: 2px solid #fff !important;
                        box-shadow: 0 1px 3px rgba(0,0,0,0.3) !important;
                        cursor: pointer;
                    }
                    .noUi-handle:before, .noUi-handle:after { display: none !important; }
                    .noUi-connect { background: #0f172a !important; }
                </style>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var yearSlider = document.getElementById('year-slider');
                        var startInput = document.getElementById('year_start_input');
                        var endInput = document.getElementById('year_end_input');
                        var startVal = document.getElementById('yearValStart');
                        var endVal = document.getElementById('yearValEnd');

                        noUiSlider.create(yearSlider, {
                            start: [parseInt(startInput.value), parseInt(endInput.value)],
                            connect: true,
                            step: 1,
                            range: {
                                'min': 2015,
                                'max': <?php echo e(date('Y') + 2); ?>

                            }
                        });

                        yearSlider.noUiSlider.on('update', function(values, handle) {
                            var value = Math.round(values[handle]);
                            if (handle) {
                                endVal.innerHTML = value;
                                endInput.value = value;
                            } else {
                                startVal.innerHTML = value;
                                startInput.value = value;
                            }
                        });

                        yearSlider.noUiSlider.on('change', function() {
                            document.getElementById('filterForm').submit();
                        });
                    });
                </script>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedCategories) > 0 || count($selectedDepartments) > 0): ?>
                    <div class="flex flex-wrap items-center gap-1.5 ml-auto">
                        <span class="text-[11px] font-semibold text-muted-foreground mr-1">Đang chọn:</span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php $catModel = $categories->firstWhere('id', $c); ?>
                            <span class="inline-flex items-center gap-1 bg-primary/10 text-primary rounded-lg px-2.5 py-1 text-xs font-medium">
                                <?php echo e($catModel->name ?? $c); ?>

                                <button type="button" onclick="removeFilterTag('category_id', '<?php echo e($c); ?>')" class="hover:text-red-500 transition-colors ml-0.5">
                                    <i data-lucide="x" class="h-3 w-3"></i>
                                </button>
                            </span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php $deptModel = $departments->firstWhere('id', $d); ?>
                            <span class="inline-flex items-center gap-1 bg-primary/10 text-primary rounded-lg px-2.5 py-1 text-xs font-medium">
                                <?php echo e($deptModel->name ?? $d); ?>

                                <button type="button" onclick="removeFilterTag('department_id', '<?php echo e($d); ?>')" class="hover:text-red-500 transition-colors ml-0.5">
                                    <i data-lucide="x" class="h-3 w-3"></i>
                                </button>
                            </span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </form>
    </div>

    
    <div class="bg-card rounded-lg border border-border overflow-hidden shadow-none">
        <div class="flex items-center justify-between px-4 py-3 border-b border-border bg-white/20">
            <span class="text-xs text-muted-foreground font-medium">Tổng số: <?php echo e($events->total()); ?> sự kiện</span>
        </div>
        <div class="w-full">
            <table class="w-full text-xs relative">
                <thead class="bg-white/40 backdrop-blur-md text-[11px] uppercase tracking-wide text-muted-foreground">
                    <tr>
                        <th class="w-[50px] text-center px-3 py-3 font-medium border-r border-border/40">STT</th>
                        <th class="text-left px-4 py-3 font-medium">Sự kiện</th>
                        <th class="text-left px-3 py-2 font-medium">Chuyên ngành</th>
                        <th class="text-left px-3 py-2 font-medium">Thời gian & Địa điểm</th>
                        <th class="text-left px-3 py-2 font-medium">Trạng thái</th>
                        <th class="text-right px-4 py-2 font-medium w-[160px]">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/50">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $semesterName = $event->semester == 1 ? 'Fall' : ($event->semester == 2 ? 'Spring' : 'Summer');
                        $yearStr = $event->academic_year ?? '2024-2025';
                        $bannerUrl = $event->bannerImage ? \App\Helpers\FileHelper::url($event->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80';
                    ?>
                    <tr class="border-t border-border hover:bg-slate-50 relative hover:z-10 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300">
                        <td class="px-3 py-3 align-top text-center font-medium text-muted-foreground pt-4 border-r border-border/40 bg-slate-50/30">
                            <?php echo e($events->firstItem() + $loop->index); ?>

                        </td>
                        <td class="px-4 py-3 align-top">
                            <div class="flex items-start gap-3 relative group/title">
                                <img src="<?php echo e($bannerUrl); ?>" alt="Banner" class="w-16 h-12 rounded-md object-cover border border-border shadow-sm flex-shrink-0">
                                <div>
                                    <a href="<?php echo e(route('admin.events.show', $event)); ?>" class="font-medium text-[13px] text-foreground hover:text-primary transition-colors line-clamp-1 w-fit"><?php echo e($event->title); ?></a>
                                    <div class="text-[11px] text-muted-foreground mt-1 flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1"><i data-lucide="folder" class="w-3 h-3"></i> <?php echo e($event->category?->name ?? 'Không phân loại'); ?></span>
                                    </div>
                                </div>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->creator): ?>
                                <!-- Tooltip for extra info -->
                                <div class="absolute left-16 top-full mt-1 w-56 p-2.5 bg-card border border-border shadow-lg rounded-lg opacity-0 invisible group-hover/title:opacity-100 group-hover/title:visible transition-all z-20 flex flex-col gap-1.5">
                                    <p class="text-[10px] font-semibold text-muted-foreground uppercase mb-0.5 border-b border-border/50 pb-1">Thông tin bổ sung</p>
                                    <div class="flex items-center gap-2 text-[11px] text-foreground mt-1">
                                        <div class="w-5 h-5 rounded-full bg-primary/10 flex items-center justify-center text-[9px] font-bold text-primary shrink-0"><?php echo e(mb_substr($event->creator->name, 0, 1)); ?></div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-muted-foreground text-[10px] leading-none mb-0.5">Người tạo</p>
                                            <p class="font-medium truncate leading-none"><?php echo e($event->creator->name); ?></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 text-[11px] text-foreground mt-1.5">
                                        <div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-[9px] font-bold text-slate-500 shrink-0"><i data-lucide="clock" class="w-3 h-3"></i></div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-muted-foreground text-[10px] leading-none mb-0.5">Ngày tạo sự kiện</p>
                                            <p class="font-medium truncate leading-none"><?php echo e($event->created_at->format('H:i - d/m/Y')); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-top pt-3">
                            <div class="flex flex-col gap-1.5 items-start">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->departments->count() > 0): ?>
                                    <div class="relative group/dept">
                                        <span class="inline-flex items-center h-5 px-2 rounded-full text-[10px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60 cursor-help">
                                            <?php echo e($event->departments->first()->name); ?> <?php echo e($event->departments->count() > 1 ? '(+' . ($event->departments->count() - 1) . ')' : ''); ?>

                                        </span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->departments->count() > 1): ?>
                                            <!-- Tooltip for remaining departments -->
                                            <div class="absolute left-0 top-full mt-1 w-48 p-2.5 bg-card border border-border shadow-lg rounded-lg opacity-0 invisible group-hover/dept:opacity-100 group-hover/dept:visible transition-all z-20 flex flex-col gap-1.5">
                                                <p class="text-[10px] font-semibold text-muted-foreground uppercase mb-0.5 border-b border-border/50 pb-1">Các chuyên ngành khác</p>
                                                <ul class="flex flex-col gap-1">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->departments->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                    <li class="text-[11px] text-foreground flex items-start gap-1.5"><span class="w-1 h-1 rounded-full bg-amber-500 mt-1.5 shrink-0"></span> <span class="flex-1 leading-snug"><?php echo e($dept->name); ?></span></li>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted-foreground text-[11px]">—</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-top pt-3">
                            <div class="relative group/time">
                                <div class="flex flex-col gap-1 text-[11px] text-muted-foreground cursor-help w-fit">
                                    <div class="flex items-center gap-1.5">
                                        <i data-lucide="calendar-days" class="w-3.5 h-3.5 text-foreground/70"></i>
                                        <span class="font-medium text-foreground/90"><?php echo e($event->event_date->format('d/m/Y')); ?></span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-foreground/70"></i>
                                        <span class="truncate max-w-[150px]"><?php echo e($event->location ?? 'Chưa xác định'); ?></span>
                                    </div>
                                </div>
                                
                                <!-- Tooltip for more time/location info -->
                                <div class="absolute left-0 top-full mt-1 w-64 p-3 bg-card border border-border shadow-lg rounded-lg opacity-0 invisible group-hover/time:opacity-100 group-hover/time:visible transition-all z-20 flex flex-col gap-2.5">
                                    <div>
                                        <p class="text-[10px] font-semibold text-muted-foreground uppercase mb-1">Học kỳ & Năm học</p>
                                        <p class="text-[11px] text-foreground font-medium bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full inline-flex"><?php echo e($semesterName); ?> <?php echo e($yearStr); ?></p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-semibold text-muted-foreground uppercase mb-1">Thời gian</p>
                                        <div class="text-[11px] text-foreground grid grid-cols-[16px_1fr] gap-x-1 gap-y-1.5 items-start">
                                            <i data-lucide="play" class="w-3.5 h-3.5 text-emerald-600 mt-0.5"></i> 
                                            <span><strong>Bắt đầu:</strong> <?php echo e($event->event_date->format('H:i - d/m/Y')); ?></span>
                                            
                                            <i data-lucide="square" class="w-3.5 h-3.5 text-red-500 mt-0.5"></i> 
                                            <span><strong>Kết thúc:</strong> <?php echo e($event->end_date ? $event->end_date->format('H:i - d/m/Y') : 'Chưa xác định'); ?></span>
                                        </div>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->location): ?>
                                    <div>
                                        <p class="text-[10px] font-semibold text-muted-foreground uppercase mb-1">Địa điểm chi tiết</p>
                                        <p class="text-[11px] text-foreground leading-relaxed"><?php echo e($event->location); ?></p>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-3 align-top pt-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$event->is_published): ?>
                                <span class="inline-flex items-center h-5 px-2 rounded text-[10px] font-medium bg-amber-100 text-amber-700 whitespace-nowrap">Bản nháp</span>
                            <?php elseif($event->event_date < now()): ?>
                                <span class="inline-flex items-center h-5 px-2 rounded text-[10px] font-medium bg-slate-100 text-slate-700 whitespace-nowrap">Đã kết thúc</span>
                            <?php elseif($event->event_date <= now() && (!$event->end_date || $event->end_date >= now())): ?>
                                <span class="inline-flex items-center h-5 px-2 rounded text-[10px] font-medium bg-blue-100 text-blue-700 whitespace-nowrap">Đang diễn ra</span>
                            <?php else: ?>
                                <span class="inline-flex items-center h-5 px-2 rounded text-[10px] font-medium bg-emerald-100 text-emerald-700 whitespace-nowrap">Sắp diễn ra</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td class="px-4 py-3 align-top pt-3">
                            <div class="flex items-center justify-end gap-1 opacity-60 group-hover:opacity-100 transition-opacity">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->isEnded() && $event->isMissingRecap()): ?>
                                <button onclick="openDriveModal(<?php echo e($event->id); ?>, '<?php echo e(htmlspecialchars($event->title)); ?>')" class="h-[30px] w-[92px] justify-center rounded text-[11px] font-medium text-white bg-red-500 hover:bg-red-600 border border-transparent transition-colors shadow-sm flex items-center gap-1.5 mr-1" title="Nhắc thêm link GG Drive">
                                    <i data-lucide="link" class="w-3.5 h-3.5 shrink-0"></i> Thêm link
                                </button>
                                <?php elseif($event->recap_drive_link): ?>
                                <button onclick="openDriveModal(<?php echo e($event->id); ?>, '<?php echo e(htmlspecialchars($event->title)); ?>', '<?php echo e(htmlspecialchars($event->recap_drive_link)); ?>')" class="h-[30px] w-[92px] justify-center rounded text-[11px] font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 border border-emerald-200 transition-colors shadow-sm flex items-center gap-1.5 mr-1" title="Sửa link GG Drive">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5 shrink-0"></i> Sửa link
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <a href="<?php echo e(route('admin.events.show', $event)); ?>" class="h-7 w-7 rounded flex items-center justify-center text-muted-foreground hover:bg-background hover:text-foreground hover:shadow-sm transition-all" title="Xem chi tiết">
                                    <i data-lucide="eye" class="h-3.5 w-3.5"></i>
                                </a>
                                <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="h-7 w-7 rounded flex items-center justify-center text-muted-foreground hover:bg-background hover:text-primary hover:shadow-sm transition-all" title="Chỉnh sửa">
                                    <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                                </a>
                                <form action="<?php echo e(route('admin.events.archive', $event)); ?>" method="POST" class="inline" onsubmit="showConfirmModal(event, 'Lưu trữ sự kiện', 'Bạn có chắc chắn muốn lưu trữ sự kiện &quot;<?php echo e($event->title); ?>&quot;? Sự kiện sẽ được chuyển vào kho lưu trữ.', 'warning');">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="h-7 w-7 rounded flex items-center justify-center text-muted-foreground hover:bg-background hover:text-amber-600 hover:shadow-sm transition-all" title="Lưu trữ">
                                        <i data-lucide="archive" class="h-3.5 w-3.5"></i>
                                    </button>
                                </form>
                                <form action="<?php echo e(route('admin.events.destroy', $event)); ?>" method="POST" class="inline" onsubmit="showConfirmModal(event, 'Xóa sự kiện', 'Bạn có chắc chắn muốn xóa sự kiện &quot;<?php echo e($event->title); ?>&quot;? Hành động này không thể hoàn tác.', 'danger');">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="h-7 w-7 rounded flex items-center justify-center text-muted-foreground hover:bg-red-50 hover:text-red-500 transition-all" title="Xóa">
                                        <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="6" class="px-4 py-16 text-center bg-muted/10">
                            <div class="flex flex-col items-center justify-center max-w-[200px] mx-auto text-muted-foreground">
                                <div class="h-12 w-12 rounded-full bg-background flex items-center justify-center shadow-sm border border-border/50 mb-3">
                                    <i data-lucide="calendar-x" class="h-5 w-5 opacity-70"></i>
                                </div>
                                <p class="text-[13px] font-medium mb-1 text-foreground">Không có dữ liệu</p>
                                <p class="text-[11px] opacity-70 text-center mb-4">Chưa có sự kiện nào hoặc không tìm thấy kết quả phù hợp.</p>
                                <a href="<?php echo e(route('admin.events.create')); ?>" class="inline-flex items-center gap-1.5 h-8 px-4 text-[11px] font-medium bg-primary text-primary-foreground hover:bg-primary/90 rounded-md transition-all shadow-sm">
                                    <i data-lucide="plus" class="h-3.5 w-3.5"></i> Thêm mới
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($events->hasPages()): ?>
        <div class="flex items-center justify-between px-4 py-3 border-t border-border text-xs text-muted-foreground">
            <span>Hiển thị <?php echo e($events->firstItem()); ?>–<?php echo e($events->lastItem()); ?> trên <?php echo e($events->total()); ?></span>
            <div class="flex items-center gap-1">
                <?php echo e($events->links()); ?>

            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div id="confirmModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300 animate-in fade-in zoom-in-95">
        <div class="bg-card border border-border rounded-xl shadow-xl w-full max-w-md p-6 space-y-4 scale-95 transition-transform duration-300 transform" id="confirmModalContainer">
            <div class="flex items-start gap-4">
                <div class="h-10 w-10 rounded-full flex items-center justify-center shrink-0" id="confirmIconBg">
                    <i data-lucide="alert-triangle" class="h-5 w-5" id="confirmIcon"></i>
                </div>
                <div class="flex-1 space-y-1">
                    <h3 class="text-sm font-bold text-foreground animate-none" id="confirmTitle">Xác nhận</h3>
                    <p class="text-xs text-muted-foreground leading-relaxed" id="confirmMessage">Bạn có chắc chắn muốn thực hiện hành động này không?</p>
                </div>
            </div>
            <div class="flex justify-end gap-2.5 pt-4 border-t border-border">
                <button type="button" id="confirmCancelBtn" class="h-9 px-4 rounded-lg text-xs font-medium border border-input bg-background hover:bg-accent text-foreground transition-all">Hủy</button>
                <button type="button" id="confirmOkBtn" class="h-9 px-4 rounded-lg text-xs font-medium text-white transition-all shadow-sm">Xác nhận</button>
            </div>
        </div>
    </div>
</div>


<div id="driveModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300 animate-in fade-in zoom-in-95">
    <div class="bg-card border border-border rounded-xl shadow-xl w-full max-w-md p-6 space-y-4 scale-95 transition-transform duration-300 transform" id="driveModalContainer">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center bg-blue-100 text-blue-600">
                <i data-lucide="link" class="h-5 w-5"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-foreground" id="driveModalTitle">Thêm link Album Google Drive</h3>
                <p class="text-sm text-muted-foreground mt-1 mb-4" id="driveModalMessage">Nhập link thư mục Google Drive chứa ảnh recap của sự kiện.</p>
                <form id="driveModalForm" method="POST" action="">
                    <?php echo csrf_field(); ?>
                    <input type="url" name="recap_drive_link" required placeholder="https://drive.google.com/drive/folders/..." class="w-full h-10 px-3 rounded-lg border border-input bg-background focus:outline-none focus:border-ring text-sm mb-4">
                    <div class="flex items-center gap-2 justify-end">
                        <button type="button" onclick="closeDriveModal()" class="h-10 px-4 py-2 rounded-lg text-sm font-medium border border-input bg-background hover:bg-accent hover:text-accent-foreground transition-colors">
                            Hủy
                        </button>
                        <button type="submit" class="h-10 px-4 py-2 rounded-lg text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 shadow-sm transition-all">
                            Lưu Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function addFilterTag(name, select) {
        if (!select.value) return;
        const form = document.getElementById('filterForm');
        let hiddenInput = form.querySelector(`input[name="${name}[]"][value="${select.value}"]`);
        if (!hiddenInput) {
            hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `${name}[]`;
            hiddenInput.value = select.value;
            form.appendChild(hiddenInput);
        }
        form.submit();
    }

    function removeFilterTag(name, val) {
        const form = document.getElementById('filterForm');
        const hiddenInput = form.querySelector(`input[name="${name}[]"][value="${val}"]`);
        if (hiddenInput) {
            hiddenInput.remove();
            form.submit();
        }
    }

    function showConfirmModal(e, title, message, type = 'warning') {
        e.preventDefault();
        const form = e.target.closest('form');
        const modal = document.getElementById('confirmModal');
        const container = document.getElementById('confirmModalContainer');
        const titleEl = document.getElementById('modalTitle');
        const messageEl = document.getElementById('modalMessage');
        const iconContainer = document.getElementById('modalIconContainer');
        const confirmBtn = document.getElementById('modalConfirmBtn');
        const cancelBtn = document.getElementById('modalCancelBtn');

        titleEl.textContent = title;
        messageEl.textContent = message;

        // Reset classes
        iconContainer.className = 'flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center';
        confirmBtn.className = 'px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2';
        
        if (type === 'danger') {
            iconContainer.classList.add('bg-red-100', 'text-red-600');
            iconContainer.innerHTML = '<i data-lucide="alert-triangle" class="h-5 w-5"></i>';
            confirmBtn.classList.add('bg-red-500', 'text-white', 'hover:bg-red-600', 'focus:ring-red-500');
            confirmBtn.textContent = 'Xóa sự kiện';
        } else {
            iconContainer.classList.add('bg-amber-100', 'text-amber-600');
            iconContainer.innerHTML = '<i data-lucide="alert-circle" class="h-5 w-5"></i>';
            confirmBtn.classList.add('bg-primary', 'text-primary-foreground', 'hover:bg-primary/90', 'focus:ring-primary');
            confirmBtn.textContent = 'Xác nhận';
        }

        lucide.createIcons();

        confirmBtn.onclick = function() {
            form.submit();
        };

        modal.classList.remove('hidden');
        // trigger reflow
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        container.classList.remove('scale-95');
    }

    function closeModal() {
        const modal = document.getElementById('confirmModal');
        const container = document.getElementById('confirmModalContainer');
        modal.classList.add('opacity-0');
        container.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
    
    function openDriveModal(eventId, eventTitle, currentLink = '') {
        const modal = document.getElementById('driveModal');
        const container = document.getElementById('driveModalContainer');
        const form = document.getElementById('driveModalForm');
        document.getElementById('driveModalMessage').textContent = 'Nhập link thư mục Google Drive chứa ảnh recap cho sự kiện "' + eventTitle + '".';
        form.action = `/admin/events/${eventId}/recap-link`;
        
        const input = form.querySelector('input[name="recap_drive_link"]');
        if (input) {
            input.value = currentLink;
        }
        
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        container.classList.remove('scale-95');
    }

    function closeDriveModal() {
        const modal = document.getElementById('driveModal');
        const container = document.getElementById('driveModalContainer');
        modal.classList.add('opacity-0');
        container.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function addFilterTag(name, selectElement) {
        const val = selectElement.value;
        if (!val) return;

        const form = document.getElementById('filterForm');

        // Add new hidden input
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `${name}[]`;
        input.value = val;
        input.className = `filter-input-${name}`;
        form.appendChild(input);

        // Submit form
        form.submit();
    }

    function removeFilterTag(name, value) {
        const inputs = document.querySelectorAll(`.filter-input-${name}`);
        inputs.forEach(input => {
            if (input.value == value) {
                input.remove();
            }
        });

        // Submit form
        document.getElementById('filterForm').submit();
    }

    let pendingForm = null;

    function showConfirmModal(event, title, message, type = 'warning') {
        event.preventDefault();
        pendingForm = event.target;
        
        const modal = document.getElementById('confirmModal');
        const container = document.getElementById('confirmModalContainer');
        const titleEl = document.getElementById('confirmTitle');
        const messageEl = document.getElementById('confirmMessage');
        const iconBg = document.getElementById('confirmIconBg');
        const icon = document.getElementById('confirmIcon');
        const okBtn = document.getElementById('confirmOkBtn');
        
        titleEl.textContent = title;
        messageEl.textContent = message;
        
        if (type === 'danger') {
            iconBg.className = 'h-10 w-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0';
            icon.setAttribute('data-lucide', 'trash-2');
            okBtn.className = 'h-9 px-4 rounded-lg text-xs font-medium text-white transition-all shadow-sm';
            okBtn.style.backgroundColor = '#ef4444'; // Tailwind red-500
            okBtn.onmouseover = () => okBtn.style.backgroundColor = '#dc2626'; // Tailwind red-600
            okBtn.onmouseout = () => okBtn.style.backgroundColor = '#ef4444';
        } else {
            iconBg.className = 'h-10 w-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0';
            icon.setAttribute('data-lucide', 'archive');
            okBtn.className = 'h-9 px-4 rounded-lg text-xs font-medium text-white transition-all shadow-sm';
            okBtn.style.backgroundColor = '#f59e0b'; // Tailwind amber-500
            okBtn.onmouseover = () => okBtn.style.backgroundColor = '#d97706'; // Tailwind amber-600
            okBtn.onmouseout = () => okBtn.style.backgroundColor = '#f59e0b';
        }
        
        if (window.lucide) {
            window.lucide.createIcons();
        }
        
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        container.classList.remove('scale-95');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('confirmModal');
        const container = document.getElementById('confirmModalContainer');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        
        function hideModal() {
            modal.classList.add('opacity-0');
            container.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                pendingForm = null;
            }, 300);
        }
        
        cancelBtn.addEventListener('click', hideModal);
        
        okBtn.addEventListener('click', function() {
            if (pendingForm) {
                pendingForm.submit();
            }
            hideModal();
        });
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideModal();
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\anima\Downloads\ThucTap-main\resources\views/admin/events/index.blade.php ENDPATH**/ ?>