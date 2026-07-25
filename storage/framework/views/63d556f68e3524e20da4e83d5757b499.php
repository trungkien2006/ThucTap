<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div class="flex items-center gap-3">
        <a href="<?php echo e(route('admin.events.index')); ?>" class="w-10 h-10 rounded-xl border border-border flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all">
            <i data-lucide="arrow-left" class="h-5 w-5"></i>
        </a>
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <h1 class="text-[24px] font-bold text-foreground font-heading leading-tight"><?php echo e($event->title); ?></h1>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->is_published): ?>
                    <span class="inline-flex items-center rounded-full bg-emerald-50 dark:bg-emerald-950/20 px-2 py-0.5 text-xs font-medium text-emerald-700 dark:text-emerald-400 ring-1 ring-inset ring-emerald-600/10">Đã xuất bản</span>
                <?php else: ?>
                    <span class="inline-flex items-center rounded-full bg-amber-50 dark:bg-amber-950/20 px-2 py-0.5 text-xs font-medium text-amber-700 dark:text-amber-400 ring-1 ring-inset ring-amber-600/10">Bản nháp</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <p class="text-xs text-muted-foreground mt-1">Sự kiện tạo bởi <?php echo e($event->creator->name ?? 'Hệ thống'); ?> · <?php echo e($event->created_at ? $event->created_at->format('d/m/Y') : '—'); ?></p>
        </div>
    </div>
    <div class="flex items-center gap-2 flex-wrap">
        <a href="<?php echo e(route('events.show', $event->slug)); ?>" target="_blank" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors border border-border bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <i data-lucide="external-link" class="h-3.5 w-3.5"></i>
            Xem trang
        </a>
        <a href="<?php echo e(route('admin.events.design', $event)); ?>" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <i data-lucide="palette" class="h-3.5 w-3.5"></i>
            Thiết kế
        </a>
        <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors border border-input bg-orange-500 hover:bg-orange-600 text-white h-9 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <i data-lucide="edit" class="h-3.5 w-3.5"></i>
            Chỉnh sửa
        </a>
    </div>
</div>

<!-- Event Banner (if available) -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->bannerImage): ?>
    <div class="w-full h-[220px] md:h-[300px] rounded-xl overflow-hidden shadow-sm mb-6 border border-border">
        <img src="<?php echo e(\App\Helpers\FileHelper::url($event->bannerImage->url)); ?>" class="w-full h-full object-cover" alt="Event Banner">
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <div class="bg-card rounded-xl border-none p-4 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 flex items-center gap-4">
        <div class="h-10 w-10 rounded-xl bg-blue-50 dark:bg-blue-950/20 text-blue-500 flex items-center justify-center shrink-0">
            <i data-lucide="eye" class="h-5 w-5"></i>
        </div>
        <div>
            <p class="text-[11px] font-medium text-muted-foreground uppercase tracking-wider">Lượt xem</p>
            <p class="text-xl font-bold text-foreground mt-0.5 tabular-nums"><?php echo e(number_format($event->views_count ?? 0)); ?></p>
        </div>
    </div>
    <div class="bg-card rounded-xl border-none p-4 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 flex items-center gap-4">
        <div class="h-10 w-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-500 flex items-center justify-center shrink-0">
            <i data-lucide="heart" class="h-5 w-5"></i>
        </div>
        <div>
            <p class="text-[11px] font-medium text-muted-foreground uppercase tracking-wider">Lượt thích</p>
            <p class="text-xl font-bold text-foreground mt-0.5 tabular-nums"><?php echo e(number_format($event->likes_count ?? 0)); ?></p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Details & Description & Speakers & Schedule -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Event General Information -->
        <div class="bg-card rounded-xl border-none p-6 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-5 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Thông tin chung
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-xs">
                <div class="space-y-1">
                    <span class="text-muted-foreground">Năm học & Học kỳ</span>
                    <p class="font-semibold text-foreground text-sm">
                        <?php echo e($event->academic_year ?? '—'); ?> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->semester): ?> (<?php echo e($event->semester); ?>) <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Thời gian bắt đầu</span>
                    <p class="font-semibold text-foreground text-sm">
                        <?php echo e($event->event_date ? $event->event_date->format('d/m/Y — H:i') : '—'); ?>

                    </p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Thời gian kết thúc</span>
                    <p class="font-semibold text-foreground text-sm">
                        <?php echo e($event->end_date ? $event->end_date->format('d/m/Y — H:i') : '—'); ?>

                    </p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Địa điểm</span>
                    <p class="font-semibold text-foreground text-sm"><?php echo e($event->location); ?></p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Danh mục</span>
                    <p class="font-semibold text-foreground text-sm capitalize"><?php echo e($event->category?->name ?? '—'); ?></p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Chuyên ngành</span>
                    <p class="text-[13px] font-semibold text-primary mt-1"><?php echo e($event->departments->pluck('name')->implode(', ') ?: '—'); ?></p>
                </div>
            </div>
        </div>

        <!-- Event Description -->
        <div class="bg-card rounded-xl border-none p-6 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-4 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Mô tả sự kiện
            </h3>
            <div class="prose dark:prose-invert max-w-none text-xs text-muted-foreground leading-relaxed">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->description): ?>
                    <?php echo $event->description; ?>

                <?php else: ?>
                    <p class="italic text-muted-foreground/60">Không có mô tả chi tiết cho sự kiện này.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Event Speakers -->
        <div class="bg-card rounded-xl border-none p-6 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-5 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Diễn giả tham gia (<?php echo e($event->speakers->count()); ?>)
            </h3>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->speakers->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="flex gap-3 p-3 rounded-lg border border-border bg-muted/20">
                            <div class="h-12 w-12 rounded-full overflow-hidden shrink-0 bg-muted border border-border">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($speaker->photo_url): ?>
                                    <?php
                                        $photoUrl = (strpos($speaker->photo_url, 'http') === 0 || strpos($speaker->photo_url, '/') === 0) ? $speaker->photo_url : \App\Helpers\FileHelper::url($speaker->photo_url);
                                    ?>
                                    <img src="<?php echo e($photoUrl); ?>" class="w-full h-full object-cover" alt="">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-primary/10 text-primary font-bold text-sm">
                                        <?php echo e(substr($speaker->name, 0, 1)); ?>

                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs font-bold text-foreground truncate"><?php echo e($speaker->name); ?></h4>
                                <p class="text-[10px] text-muted-foreground truncate"><?php echo e($speaker->title ?? 'Diễn giả'); ?></p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($speaker->pivot && $speaker->pivot->role): ?>
                                    <span class="inline-flex items-center rounded-md bg-primary/10 px-1.5 py-0.5 text-[9px] font-medium text-primary mt-1">
                                        <?php echo e($speaker->pivot->role); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-6 border border-dashed border-border rounded-lg bg-muted/10">
                    <i data-lucide="users" class="h-8 w-8 text-muted-foreground/30 mx-auto mb-2"></i>
                    <p class="text-xs text-muted-foreground">Chưa liên kết diễn giả nào cho sự kiện.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Event Schedule -->
        <div class="bg-card rounded-xl border-none p-6 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-5 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Lịch trình chi tiết
            </h3>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->scheduleItems->count() > 0): ?>
                <div class="relative pl-6 border-l border-border space-y-6 ml-2.5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->scheduleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="relative">
                            <!-- Bullet -->
                            <span class="absolute -left-[31px] top-1 h-3.5 w-3.5 rounded-full border-2 border-background bg-primary shadow-sm"></span>
                            
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1 mb-1">
                                <h4 class="text-xs font-bold text-foreground"><?php echo e($item->title); ?></h4>
                                <span class="text-[10px] text-primary font-semibold font-mono bg-primary/10 px-2 py-0.5 rounded-md shrink-0">
                                    <?php echo e($item->start_time ? $item->start_time->format('H:i') : ''); ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->end_time): ?> - <?php echo e($item->end_time->format('H:i')); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->description): ?>
                                <p class="text-[11px] text-muted-foreground mt-0.5 leading-relaxed"><?php echo e($item->description); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->speaker): ?>
                                <div class="flex items-center gap-1.5 mt-2">
                                    <i data-lucide="mic" class="h-3 w-3 text-muted-foreground"></i>
                                    <span class="text-[10px] text-muted-foreground font-medium">Diễn giả: <?php echo e($item->speaker->name); ?></span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-6 border border-dashed border-border rounded-lg bg-muted/10">
                    <i data-lucide="calendar" class="h-8 w-8 text-muted-foreground/30 mx-auto mb-2"></i>
                    <p class="text-xs text-muted-foreground">Chưa có lịch trình chi tiết.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Right Column: QR Code & Documents & Media Gallery -->
    <div class="space-y-6">
        <!-- QR Code -->
        <div class="bg-card rounded-xl border-none p-6 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 text-center flex flex-col justify-center items-center">
            <h3 class="text-sm font-bold text-foreground mb-1">Mã QR sự kiện</h3>
            <p class="text-[10px] text-muted-foreground mb-5">Quét để truy cập nhanh</p>
            <div class="p-4 bg-white dark:bg-white/90 border border-border rounded-xl shadow-sm mb-4 inline-block">
                <?php echo SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(route('events.show', $event->slug)); ?>

            </div>
            <button onclick="navigator.clipboard.writeText('<?php echo e(route('events.show', $event->slug)); ?>'); alert('Đã sao chép link!');" class="inline-flex items-center justify-center rounded-lg text-xs font-semibold border border-border bg-background hover:bg-accent text-foreground h-9 px-4 gap-1.5 w-full transition-all">
                <i data-lucide="copy" class="h-3.5 w-3.5"></i> 
                Sao chép liên kết
            </button>
        </div>



        <!-- Gallery / Media -->
        <div class="bg-card rounded-xl border-none p-6 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-4 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Thư viện ảnh/video (<?php echo e($event->galleryImages->count() + $event->videos->count()); ?>)
            </h3>
            <?php
                $allMedia = $event->media()->whereIn('type', ['image', 'video'])->get();
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allMedia->count() > 0): ?>
                <div class="grid grid-cols-3 gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $allMedia->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e(\App\Helpers\FileHelper::url($m->url)); ?>" target="_blank" class="aspect-square rounded-lg overflow-hidden border border-border hover:opacity-85 transition-opacity relative group bg-muted/40 grid place-items-center">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($m->type === 'image'): ?>
                                <img src="<?php echo e(\App\Helpers\FileHelper::url($m->url)); ?>" class="w-full h-full object-cover" alt="">
                            <?php else: ?>
                                <i data-lucide="video" class="h-5 w-5 text-primary/70"></i>
                                <span class="absolute bottom-1 right-1 bg-black/70 text-white text-[8px] px-1 rounded">video</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allMedia->count() > 6): ?>
                    <a href="<?php echo e(route('admin.media.index', ['search' => $event->title])); ?>" class="block text-center text-xs text-primary font-medium hover:underline mt-3">
                        Xem tất cả tệp media
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
                <p class="text-xs text-muted-foreground italic text-center py-4">Chưa có tệp hình ảnh/video.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/admin/events/show.blade.php ENDPATH**/ ?>