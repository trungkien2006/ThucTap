<?php
    $pageTitle = 'Thư viện Media';
    $breadcrumbs = [['label' => 'Thư viện Media']];
?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-4">
        <!-- Page Header -->
        <div class="flex items-end justify-between flex-wrap gap-3 mb-2">
            <div>
                <h1 class="text-[22px] font-semibold tracking-tight">Thư viện Media (Albums)</h1>
                <p class="text-xs text-muted-foreground mt-0.5">Quản lý các album sự kiện</p>
            </div>
        </div>

        <!-- Top Control Bar -->
        <div class="flex flex-wrap items-center gap-6 pb-4 border-b border-border text-sm text-foreground">
            <form action="<?php echo e(route('admin.media.index')); ?>" method="GET" class="flex flex-wrap items-center gap-6 w-full lg:w-auto flex-1">
                <!-- Sort Control -->
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                    <i data-lucide="align-left" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                    <select name="sort" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                        <option value="date_desc" <?php echo e(request('sort', 'date_desc') === 'date_desc' ? 'selected' : ''); ?>>Sắp xếp: Mới nhất</option>
                        <option value="date_asc" <?php echo e(request('sort') === 'date_asc' ? 'selected' : ''); ?>>Sắp xếp: Cũ nhất</option>
                        <option value="title" <?php echo e(request('sort') === 'title' ? 'selected' : ''); ?>>Sắp xếp: Tên (A-Z)</option>
                        <option value="title_desc" <?php echo e(request('sort') === 'title_desc' ? 'selected' : ''); ?>>Sắp xếp: Tên (Z-A)</option>
                        <option value="likes" <?php echo e(request('sort') === 'likes' ? 'selected' : ''); ?>>Sắp xếp: Nhiều lượt thích nhất</option>
                    </select>
                </label>

                <!-- View Control -->
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                    <i data-lucide="layout-grid" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                    <select name="view" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                        <option value="grid_4" <?php echo e(request('view') === 'grid_4' ? 'selected' : ''); ?>>Hiển thị: 4 cột</option>
                        <option value="grid_5" <?php echo e(request('view', 'grid_5') === 'grid_5' ? 'selected' : ''); ?>>Hiển thị: 5 cột</option>
                        <option value="grid_6" <?php echo e(request('view') === 'grid_6' ? 'selected' : ''); ?>>Hiển thị: 6 cột</option>
                    </select>
                </label>

                <!-- Link Filter Control -->
                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                    <i data-lucide="link" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                    <select name="has_link" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                        <option value="">Lọc: Tất cả</option>
                        <option value="yes" <?php echo e(request('has_link') === 'yes' ? 'selected' : ''); ?>>Đã gắn link</option>
                        <option value="no" <?php echo e(request('has_link') === 'no' ? 'selected' : ''); ?>>Chưa gắn link</option>
                    </select>
                </label>
            </form>
            
            <div class="ml-auto flex items-center gap-6">
                <div>
                    <span class="text-muted-foreground">Tổng sự kiện:</span>
                    <span class="font-bold ml-1"><?php echo e($totalAlbums ?? 0); ?></span>
                </div>
                <div>
                    <span class="text-muted-foreground">Số sự kiện có album trong tháng:</span>
                    <span class="font-bold ml-1"><?php echo e($albumsThisMonth ?? 0); ?></span>
                </div>
            </div>
        </div>

        <?php
            $view = request('view', 'grid_5');
            $gridClass = 'grid-cols-2 md:grid-cols-3';
            if ($view === 'grid_4') $gridClass .= ' lg:grid-cols-4 xl:grid-cols-4';
            elseif ($view === 'grid_6') $gridClass .= ' lg:grid-cols-5 xl:grid-cols-6';
            else $gridClass .= ' lg:grid-cols-4 xl:grid-cols-5';
        ?>

        <!-- Albums Grid -->
        <div class="grid <?php echo e($gridClass); ?> gap-6 pt-2">
            <!-- Album Cards -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    // Lấy ảnh cover (banner) hoặc ảnh đầu tiên trong album
                    $cover = $album->bannerImage ? \App\Helpers\FileHelper::url($album->bannerImage->url) : null;
                    if (!$cover) {
                        $firstMedia = $album->media()->where('type', 'image')->first();
                        if ($firstMedia) {
                            $cover = \App\Helpers\FileHelper::url($firstMedia->url);
                        }
                    }
                ?>

                <div class="relative group bg-card rounded-xl overflow-hidden shadow-sm border border-border hover:shadow-md transition-all">
                    <!-- Album Link Overlay -->
                    <a href="<?php echo e(route('admin.media.index', ['event_id' => $album->id])); ?>" class="absolute inset-0 z-10"></a>
                    
                    <!-- Cover Image -->
                    <div class="aspect-square relative bg-muted flex items-center justify-center overflow-hidden">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($album->recap_drive_link)): ?>
                            <!-- Album Link Tag -->
                            <div class="absolute top-3 left-3 z-30 bg-red-500 text-white p-1.5 rounded-md shadow-md backdrop-blur-sm bg-opacity-90 flex items-center justify-center" title="Đã gắn link Album">
                                <i data-lucide="folder-heart" class="w-4 h-4"></i>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cover): ?>
                            <img src="<?php echo e($cover); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="">
                        <?php else: ?>
                            <i data-lucide="image" class="w-10 h-10 text-muted-foreground/30"></i>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        
                        <!-- Info Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-3 text-white">
                            <h3 class="font-semibold text-sm truncate mb-1" title="<?php echo e($album->title); ?>"><?php echo e($album->title); ?></h3>
                            <div class="text-[10px] text-white/80 font-medium mb-1.5">
                                Ngày tạo: <?php echo e($album->created_at ? $album->created_at->format('d-m-Y') : '—'); ?>

                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3 text-[10px] text-white/90">
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="heart" class="w-3 h-3"></i>
                                        <span><?php echo e($album->likes_count ?? 0); ?></span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="message-circle" class="w-3 h-3"></i>
                                        <span>0</span>
                                    </div>
                                </div>
                                <div class="relative z-20">
                                    <button type="button" class="text-white hover:text-white/80 hover:bg-white/20 p-1 rounded transition-colors">
                                        <i data-lucide="more-horizontal" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($albums->hasPages()): ?>
            <div class="flex justify-center mt-6">
                <?php echo e($albums->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\anima\Downloads\ThucTap-main\resources\views/admin/media/index.blade.php ENDPATH**/ ?>