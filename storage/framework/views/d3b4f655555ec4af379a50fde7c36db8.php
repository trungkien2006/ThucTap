<?php
    $pageTitle = 'Quản lý diễn giả';
    $breadcrumbs = [['label' => 'Quản lý diễn giả']];
?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-4">
        
        <div class="flex items-end justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-[22px] font-semibold tracking-tight">Quản lý Diễn giả</h1>
                <p class="text-xs text-muted-foreground mt-0.5">Danh sách diễn giả của các sự kiện</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="<?php echo e(route('admin.speakers.create')); ?>"
                    class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all shadow-sm">
                    <i data-lucide="plus" class="h-5 w-5"></i> Thêm diễn giả
                </a>
            </div>
        </div>

        <!-- Top Control Bar -->
        <div class="flex flex-wrap items-center gap-6 pb-4 border-b border-border text-sm text-foreground mb-6">
            <form action="<?php echo e(route('admin.speakers.index')); ?>" method="GET" class="flex flex-wrap items-center gap-6 w-full lg:w-auto flex-1">
                <!-- Search Control -->
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group relative w-full lg:w-96">
                    <i data-lucide="search" class="w-4 h-4 shrink-0 pointer-events-none absolute left-0 text-muted-foreground"></i>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Tìm kiếm diễn giả…" class="pl-6 w-full font-medium bg-transparent border-none focus:outline-none focus:ring-0 text-sm placeholder:text-muted-foreground">
                </label>
            </form>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search')): ?>
                <div class="ml-auto flex items-center gap-6">
                    <a href="<?php echo e(route('admin.speakers.index')); ?>" class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors flex items-center gap-1.5" title="Xóa tìm kiếm">
                        <i data-lucide="x" class="h-4 w-4"></i> Xóa
                    </a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 p-5 bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300-hover flex flex-col justify-between">
                    <div>
                        
                        <div class="flex items-start gap-3 mb-3">
                            <div class="h-12 w-12 shrink-0 rounded-full bg-gradient-to-br from-primary to-primary/60 text-primary-foreground grid place-items-center text-sm font-semibold overflow-hidden">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($speaker->photo_url): ?>
                                    <img src="<?php echo e($speaker->photo_url); ?>" alt="<?php echo e($speaker->name); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <?php echo e(collect(explode(' ', $speaker->name))->map(fn($w) => substr($w, 0, 1))->slice(0, 2)->implode('')); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-sm font-semibold truncate flex items-center gap-1">
                                    <span class="text-muted-foreground font-mono text-xs shrink-0">#<?php echo e(($speakers->currentPage() - 1) * $speakers->perPage() + $loop->iteration); ?></span>
                                    <span class="truncate"><?php echo e($speaker->name); ?></span>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($speaker->title): ?>
                                    <div class="text-[11px] text-muted-foreground truncate" title="<?php echo e($speaker->title); ?>"><?php echo e($speaker->title); ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <p class="text-[11px] text-muted-foreground leading-relaxed line-clamp-2 mb-3">
                            <?php echo e($speaker->bio ?? 'Chưa có tiểu sử.'); ?>

                        </p>
                    </div>

                    
                    <div class="flex items-center justify-between pt-3 border-t border-border mt-2">
                        <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-secondary text-secondary-foreground">
                            <?php echo e($speaker->events_count); ?> sự kiện
                        </span>
                        
                        <div class="flex items-center gap-1">
                            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="LinkedIn">
                                <i data-lucide="linkedin" class="h-3 w-3"></i>
                            </a>
                            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Twitter">
                                <i data-lucide="twitter" class="h-3 w-3"></i>
                            </a>
                            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Website">
                                <i data-lucide="globe" class="h-3 w-3"></i>
                            </a>
                            <span class="text-muted-foreground/30 mx-1 text-xs">|</span>
                            <a href="<?php echo e(route('admin.speakers.edit', $speaker)); ?>" 
                               class="h-7 w-7 rounded-md flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Sửa">
                                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                            </a>
                            <form action="<?php echo e(route('admin.speakers.destroy', $speaker)); ?>" method="POST" class="inline" 
                                  onsubmit="return confirm('Bạn có chắc chắn muốn ẩn diễn giả này không?');">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" 
                                        class="h-7 w-7 rounded-md flex items-center justify-center text-muted-foreground hover:bg-red-50 hover:text-red-500 transition-all" title="Ẩn">
                                    <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full py-16 text-center bg-card rounded-lg border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
                    <i data-lucide="mic-off" class="h-10 w-10 text-muted-foreground/30 mx-auto mb-3"></i>
                    <p class="text-sm text-muted-foreground mb-4">Chưa có diễn giả nào.</p>
                    <a href="<?php echo e(route('admin.speakers.create')); ?>"
                        class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all">
                        <i data-lucide="plus" class="h-5 w-5"></i> Thêm diễn giả đầu tiên
                    </a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($speakers->hasPages()): ?>
            <div class="flex justify-center mt-4">
                <?php echo e($speakers->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\anima\Downloads\ThucTap-main\resources\views/admin/speakers/index.blade.php ENDPATH**/ ?>