<?php
    $pageTitle = 'Event Archive';
    $breadcrumbs = [['label' => 'Event Archive']];
?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    
    <div class="flex items-end justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-[26px] font-bold text-slate-800 tracking-tight">Lưu trữ sự kiện</h1>
            <p class="text-[13px] text-slate-500 mt-1">Kho lưu trữ hình ảnh, video và thông tin của các sự kiện đã diễn ra</p>
        </div>
    </div>

    
    <!-- Top Control Bar -->
    <div class="flex flex-wrap items-center gap-6 pb-4 border-b border-border text-sm text-foreground mb-6">
        <form action="<?php echo e(route('admin.archive.index')); ?>" method="GET" class="flex flex-wrap items-center gap-6 w-full lg:w-auto flex-1">
            <!-- Search Control -->
            <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group relative w-full lg:w-64">
                <i data-lucide="search" class="w-4 h-4 shrink-0 pointer-events-none absolute left-0 text-muted-foreground"></i>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Tìm kiếm sự kiện…" class="pl-6 w-full font-medium bg-transparent border-none focus:outline-none focus:ring-0 text-sm placeholder:text-muted-foreground">
            </label>

            <!-- Year Control -->
            <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                <i data-lucide="calendar" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                <select name="academic_year" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                    <option value="">Tất cả Năm học</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $academicYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($year); ?>" <?php echo e(request('academic_year') == $year ? 'selected' : ''); ?>>Năm học <?php echo e($year); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </label>

            <!-- Semester Control -->
            <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                <i data-lucide="book-open" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                <select name="semester" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                    <option value="">Tất cả Học kỳ</option>
                    <option value="1" <?php echo e(request('semester') == '1' ? 'selected' : ''); ?>>Học kỳ Thu</option>
                    <option value="2" <?php echo e(request('semester') == '2' ? 'selected' : ''); ?>>Học kỳ Xuân</option>
                    <option value="3" <?php echo e(request('semester') == '3' ? 'selected' : ''); ?>>Học kỳ Hè</option>
                </select>
            </label>

            <!-- Category Control -->
            <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                <i data-lucide="tag" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                <select name="category_id" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm max-w-[150px] truncate">
                    <option value="">Tất cả Danh mục</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category_id') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </label>
        </form>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search') || request('academic_year') || request('semester') || request('category_id')): ?>
        <div class="ml-auto flex items-center gap-6">
            <a href="<?php echo e(route('admin.archive.index')); ?>" class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors flex items-center gap-1.5" title="Xóa tất cả bộ lọc">
                <i data-lucide="x" class="h-4 w-4"></i> Xóa lọc
            </a>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php
    $grouped = $events->groupBy(function($e) {
        return $e->event_date->format('Y');
    });
    ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($events->isEmpty()): ?>
    <div class="py-20 text-center bg-white rounded-2xl border border-slate-200/60 shadow-sm flex flex-col items-center justify-center">
        <div class="h-16 w-16 rounded-full bg-slate-50 flex items-center justify-center mb-4">
            <i data-lucide="archive-x" class="h-8 w-8 text-slate-400"></i>
        </div>
        <h3 class="text-[15px] font-semibold text-slate-700 mb-1">Không tìm thấy sự kiện</h3>
        <p class="text-[13px] text-slate-500">Chưa có sự kiện nào trong kho lưu trữ hoặc không khớp với bộ lọc.</p>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search') || request('academic_year') || request('semester') || request('category_id')): ?>
            <a href="<?php echo e(route('admin.archive.index')); ?>" class="mt-4 inline-flex items-center gap-1.5 text-primary text-[13px] font-semibold hover:underline">
                <i data-lucide="refresh-cw" class="h-4 w-4"></i> Đặt lại bộ lọc
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php else: ?>
    <div class="space-y-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year => $yearEvents): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <section class="space-y-4 animate-in fade-in slide-in-from-bottom-4 duration-500">
            <div class="flex items-center gap-3">
                <div class="h-8 w-1.5 rounded-full bg-primary"></div>
                <h2 class="text-xl font-bold text-slate-800"><?php echo e($year); ?></h2>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600"><?php echo e($yearEvents->count()); ?> sự kiện</span>
                <div class="flex-1 h-px bg-slate-200/60"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $yearEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="group bg-white rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                    <div class="aspect-[16/9] bg-slate-100 relative overflow-hidden">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($e->bannerImage): ?>
                            <img src="<?php echo e(\App\Helpers\FileHelper::url($e->bannerImage->url)); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 group-hover:scale-105 transition-transform duration-500">
                                <i data-lucide="image" class="h-10 w-10 text-slate-300"></i>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <a href="<?php echo e(route('events.show', $e->slug)); ?>" target="_blank" class="inline-flex items-center gap-1.5 text-white text-[12px] font-semibold hover:text-primary-200">
                                Xem chi tiết <i data-lucide="external-link" class="h-3 w-3"></i>
                            </a>
                        </div>
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-white/90 text-slate-700 shadow-sm backdrop-blur-sm">
                                Đã lưu trữ
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4 flex flex-col flex-1">
                        <a href="<?php echo e(route('events.show', $e->slug)); ?>" target="_blank" class="font-bold text-[15px] leading-snug line-clamp-2 text-slate-800 group-hover:text-primary transition-colors mb-3" title="<?php echo e($e->title); ?>"><?php echo e($e->title); ?></a>
                        
                        <div class="mt-auto pt-2">
                            <div class="flex items-center gap-2 text-[12px] text-slate-500 mb-4 font-medium flex-wrap">
                                <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-100 px-2 py-1 rounded-md">
                                    <i data-lucide="calendar" class="h-3.5 w-3.5 text-primary"></i>
                                    <?php echo e($e->event_date->format('d/m/Y')); ?>

                                </div>
                                <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-100 px-2 py-1 rounded-md">
                                    <i data-lucide="eye" class="h-3.5 w-3.5 text-blue-500"></i>
                                    <?php echo e(number_format($e->views_count ?? 0)); ?>

                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                                <div class="text-[11px] text-slate-400 font-medium truncate max-w-[120px]" title="<?php echo e($e->category->name ?? 'Sự kiện'); ?>">
                                    <?php echo e($e->category->name ?? 'Sự kiện'); ?>

                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <a href="<?php echo e(route('admin.media.index', ['event_id' => $e->id])); ?>" class="h-8 px-3 rounded-lg flex items-center justify-center bg-primary/10 hover:bg-primary/20 text-primary transition-all text-[12px] font-semibold" title="Xem thư viện media">
                                        <i data-lucide="images" class="h-4 w-4 mr-1.5"></i> Media
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </section>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kienxinhzai\Downloads\ThucTap-tuan\resources\views/admin/archive/index.blade.php ENDPATH**/ ?>