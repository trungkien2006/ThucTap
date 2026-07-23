<?php
    $pageTitle = 'Chuyên ngành';
    $breadcrumbs = [['label' => 'Chuyên ngành']];
?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4">
    
    <div class="flex items-end justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-[22px] font-semibold tracking-tight">Chuyên ngành</h1>
            <p class="text-xs text-muted-foreground mt-0.5">Quản lý các chuyên ngành tổ chức sự kiện</p>
        </div>
        <button onclick="document.getElementById('newDepartmentModal').classList.remove('hidden')" class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all shadow-sm">
            <i data-lucide="plus" class="h-5 w-5"></i> Chuyên ngành mới
        </button>
    </div>

    <?php
    $palettes = [
        'from-blue-500/20 to-blue-500/5 text-blue-600',
        'from-emerald-500/20 to-emerald-500/5 text-emerald-600',
        'from-amber-500/20 to-amber-500/5 text-amber-600',
        'from-violet-500/20 to-violet-500/5 text-violet-600',
        'from-rose-500/20 to-rose-500/5 text-rose-600',
        'from-cyan-500/20 to-cyan-500/5 text-cyan-600',
    ];
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 p-5 flex flex-col gap-3 bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300-hover">
            <div class="flex items-start justify-between">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br grid place-items-center <?php echo e($palettes[$i % count($palettes)]); ?> shadow-sm">
                    <i data-lucide="building" class="h-5 w-5"></i>
                </div>
                <div class="flex items-center gap-1">
                    <a href="<?php echo e(route('admin.departments.edit', $dept)); ?>" class="h-9 w-9 rounded-lg flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Sửa">
                        <i data-lucide="pencil" class="h-4 w-4"></i>
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dept->events_count == 0): ?>
                    <form action="<?php echo e(route('admin.departments.destroy', $dept)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa chuyên ngành này?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="h-9 w-9 rounded-lg flex items-center justify-center text-red-500 hover:bg-red-50 hover:text-red-600 transition-all" title="Xóa">
                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                        </button>
                    </form>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div>
                <div class="text-sm font-semibold flex items-center gap-1.5">
                    <span class="text-muted-foreground font-mono text-xs">#<?php echo e(($departments->currentPage() - 1) * $departments->perPage() + $i + 1); ?></span>
                    <span><?php echo e($dept->name); ?></span>
                </div>
                <div class="text-[11px] text-muted-foreground mt-0.5">Slug: /<?php echo e(Str::slug($dept->name)); ?></div>
            </div>
            <div class="flex items-center justify-between pt-2 border-t border-border">
                <div>
                    <div class="text-lg font-semibold tabular-nums"><?php echo e($dept->events_count); ?></div>
                    <div class="text-[11px] text-muted-foreground">sự kiện</div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-semibold tabular-nums"><?php echo e(number_format($dept->total_views ?? 0)); ?></div>
                    <div class="text-[11px] text-muted-foreground">lượt xem</div>
                </div>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <div class="col-span-full py-12 text-center bg-card rounded-lg border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
            <i data-lucide="building" class="h-10 w-10 text-muted-foreground/30 mx-auto mb-3"></i>
            <p class="text-sm text-muted-foreground">Chưa có chuyên ngành nào.</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($departments->hasPages()): ?>
        <div class="flex justify-center mt-4">
            <?php echo e($departments->links()); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>


<div id="newDepartmentModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="bg-card border border-border rounded-xl shadow-lg w-full max-w-md p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-bold text-foreground">Thêm chuyên ngành mới</h3>
            <button onclick="document.getElementById('newDepartmentModal').classList.add('hidden')" class="text-muted-foreground hover:text-foreground">
                <i data-lucide="x" class="h-4 w-4"></i>
            </button>
        </div>
        <form action="<?php echo e(route('admin.departments.store')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div class="space-y-2">
                <label for="new_name" class="text-xs font-semibold text-foreground">Tên chuyên ngành</label>
                <input type="text" name="name" id="new_name" required class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-ring" />
            </div>
            <div class="flex justify-end gap-2.5 pt-4 border-t border-border">
                <button type="button" onclick="document.getElementById('newDepartmentModal').classList.add('hidden')" class="h-9 px-4 rounded-md text-xs font-medium border border-input bg-background hover:bg-accent">Hủy</button>
                <button type="submit" class="h-9 px-4 rounded-md text-xs font-medium bg-primary text-primary-foreground hover:bg-primary/90 shadow">Lưu</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kienxinhzai\Downloads\ThucTap-tuan\resources\views/admin/departments/index.blade.php ENDPATH**/ ?>