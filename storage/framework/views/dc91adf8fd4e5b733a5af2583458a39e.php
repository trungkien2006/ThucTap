<?php $__env->startSection('title', 'Sự kiện - UniEvent'); ?>

<?php $__env->startSection('content'); ?>
<section class="relative pt-24 pb-16 lg:pt-32 lg:pb-24 min-h-screen" style="background: transparent;">
    

    
    <!-- Top border -->
    <div class="absolute inset-x-0 top-0 h-1.5" style="background:#FFE381;"></div>

    <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">
        
        <!-- Header -->
        <div data-aos="fade-up" class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-3 mb-4">
                <div class="h-1 w-8 rounded-full" style="background:#E8C84A;"></div>
                <span class="text-sm font-bold uppercase tracking-[0.2em]" style="color:#8A7320;">Khám Phá</span>
                <div class="h-1 w-8 rounded-full" style="background:#E8C84A;"></div>
            </div>
            <h1 class="font-['Barlow_Condensed'] text-5xl font-black uppercase tracking-tight text-[#1C1410] lg:text-7xl mb-6" style="text-shadow: -1px -1px 0 #FFFBEA, 1px -1px 0 #FFFBEA, -1px 1px 0 #FFFBEA, 1px 1px 0 #FFFBEA, 0 4px 12px rgba(255,255,255,0.8);">
                Sự kiện tổng hợp
            </h1>
            <p class="text-lg font-bold text-[#1C1410] leading-relaxed max-w-2xl mx-auto" style="text-shadow: -1px -1px 0 #FFFBEA, 1px -1px 0 #FFFBEA, -1px 1px 0 #FFFBEA, 1px 1px 0 #FFFBEA, 0 4px 12px rgba(255,255,255,0.8);">
                Nơi hội tụ tất cả các hoạt động, hội thảo, phong trào của sinh viên. Chọn danh mục dưới đây để tìm kiếm sự kiện phù hợp với bạn.
            </p>
        </div>

        <!-- ── Unified Filter Bar (Archive Style) ── -->
        <div data-aos="fade-up" data-aos-delay="100" 
             class="relative z-40 mt-10 p-4 rounded-3xl flex flex-col lg:flex-row lg:items-center gap-4 border mb-12"
             style="background: #FFFFFF; border-color: #E8E2D5; box-shadow: 0 10px 30px rgba(28, 20, 16, 0.03);">
            
            <form action="<?php echo e(route('events.index')); ?>" method="GET" class="w-full flex flex-col lg:flex-row lg:items-center gap-4" id="events-filter-form">
                <!-- Search Keyword Input -->
                <div class="flex-1 min-w-[200px] relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-4 w-4 text-[#7A6A52]/70"></i>
                    </span>
                    <input type="text" 
                           name="search"
                           value="<?php echo e(request('search')); ?>"
                           placeholder="Tìm kiếm theo tên hoặc nội dung sự kiện..." 
                           class="w-full pl-10 pr-4 py-2.5 text-sm font-semibold rounded-2xl border transition-all placeholder-[#7A6A52]/50 text-[#1C1410] focus:ring-2 focus:ring-[#FFE381]/50 focus:border-[#FFE381] outline-none"
                           style="background: #FFFDF9; border-color: #E8E2D5;">
                </div>

                <!-- Dropdowns & Action Controls -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-wrap items-center gap-3 w-full md:w-auto">
                    <!-- Year Filter Dropdown -->
                    <div class="flex items-center justify-between gap-2 rounded-2xl px-4 h-11 border relative w-full md:w-auto" 
                         style="background: #FFFDF9; border-color: #E8E2D5;">
                        <div class="flex items-center gap-2">
                            <i data-lucide="calendar" class="h-4 w-4 shrink-0 text-[#8A7320]"></i>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Năm</span>
                        </div>
                        <select name="year" onchange="document.getElementById('events-filter-form').submit()"
                                class="bg-transparent bg-none text-sm font-semibold focus:outline-none cursor-pointer pr-5 appearance-none text-[#1C1410] w-full">
                            <option value="">Tất cả</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($availableYears)): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $availableYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($yr); ?>" <?php echo e((isset($selectedYear) && $selectedYear == $yr) ? 'selected' : ''); ?>>
                                        <?php echo e($yr); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                        <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] absolute right-3 pointer-events-none"></i>
                    </div>

                    <!-- Month Filter Dropdown -->
                    <div class="flex items-center justify-between gap-2 rounded-2xl px-4 h-11 border relative w-full md:w-auto" 
                         style="background: #FFFDF9; border-color: #E8E2D5;">
                        <div class="flex items-center gap-2">
                            <i data-lucide="calendar-days" class="h-4 w-4 shrink-0 text-[#07A0C3]"></i>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Tháng</span>
                        </div>
                        <select name="month" onchange="document.getElementById('events-filter-form').submit()"
                                class="bg-transparent bg-none text-sm font-semibold focus:outline-none cursor-pointer pr-5 appearance-none text-[#1C1410] w-full">
                            <option value="">Tất cả</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($m = 1; $m <= 12; $m++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($m); ?>" <?php echo e((isset($selectedMonth) && $selectedMonth == $m) ? 'selected' : ''); ?>>
                                    Tháng <?php echo e($m); ?>

                                </option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                        <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] absolute right-3 pointer-events-none"></i>
                    </div>

                    <!-- Status Filter Dropdown -->
                    <div class="flex items-center justify-between gap-2 rounded-2xl px-4 h-11 border relative w-full md:w-auto" 
                         style="background: #FFFDF9; border-color: #E8E2D5;">
                        <div class="flex items-center gap-2">
                            <i data-lucide="activity" class="h-4 w-4 shrink-0 text-[#FF4D4D]"></i>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Trạng thái</span>
                        </div>
                        <select name="status" onchange="document.getElementById('events-filter-form').submit()"
                                class="bg-transparent bg-none text-sm font-semibold focus:outline-none cursor-pointer pr-5 appearance-none text-[#1C1410] w-full">
                            <option value="">Tất cả</option>
                            <option value="upcoming" <?php echo e((isset($selectedStatus) && $selectedStatus === 'upcoming') ? 'selected' : ''); ?>>Sắp diễn ra</option>
                            <option value="completed" <?php echo e((isset($selectedStatus) && $selectedStatus === 'completed') ? 'selected' : ''); ?>>Đã kết thúc</option>
                        </select>
                        <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] absolute right-3 pointer-events-none"></i>
                    </div>

                    <!-- Category Filter Dropdown -->
                    <div class="flex items-center justify-between gap-2 rounded-2xl px-4 h-11 border relative w-full md:w-auto" 
                         style="background: #FFFDF9; border-color: #E8E2D5;">
                        <div class="flex items-center gap-2">
                            <i data-lucide="tag" class="h-4 w-4 shrink-0 text-[#04B050]"></i>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Loại</span>
                        </div>
                        <select name="category" onchange="document.getElementById('events-filter-form').submit()"
                                class="bg-transparent bg-none text-sm font-semibold focus:outline-none cursor-pointer pr-5 appearance-none text-[#1C1410] w-full">
                            <option value="">Tất cả</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($categories)): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($cat['slug']); ?>" <?php echo e((isset($selectedCategory) && $selectedCategory == $cat['slug']) ? 'selected' : ''); ?>>
                                        <?php echo e($cat['name']); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                        <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] absolute right-3 pointer-events-none"></i>
                    </div>

                    <button type="submit" class="h-11 px-6 rounded-2xl text-sm font-bold transition-all shadow-sm flex items-center justify-center gap-2 hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 w-full md:w-auto"
                            style="background: #FFE381; color: #1C1410; border: 1px solid rgba(232,200,74,0.6);">
                        <i data-lucide="filter" class="w-4 h-4"></i> Lọc
                    </button>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->has('category') || request()->has('search') || request()->has('year') || request()->has('month') || request()->has('status')): ?>
                    <a href="<?php echo e(route('events.index')); ?>" class="h-11 px-4 rounded-2xl text-sm font-bold transition-all flex items-center justify-center gap-2 border hover:bg-slate-50 w-full md:w-auto"
                       style="background: #FFFDF9; color: #7A6A52; border-color: #E8E2D5;">
                        <i data-lucide="x" class="w-4 h-4"></i> Xóa lọc
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </form>
        </div>

        <style>
            #events-filter-form select {
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                background-color: transparent !important;
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                appearance: none !important;
            }
            #events-filter-form select::-ms-expand {
                display: none !important;
            }
        </style>

        <!-- Events Grid -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($events->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-16" id="events-grid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <!-- GSAP animation wrapper -->
            <div class="event-grid-card-wrapper" style="opacity: 0; transform: translateY(40px);">
                <div class="group h-full flex flex-col rounded-3xl bg-white shadow-sm border border-[#E8E2D5] overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <!-- Image -->
                    <div class="relative h-64 overflow-hidden bg-slate-100">
                    <img src="<?php echo e($event->bannerImage ? \App\Helpers\FileHelper::url($event->bannerImage->url, true) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80'); ?>" 
                         alt="<?php echo e($event->title); ?>" 
                         class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <!-- Hover Description Overlay -->
                    <div class="absolute inset-0 p-6 flex flex-col justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none" style="background-color: rgba(0,0,0,0.4);">
                        <p class="text-white text-sm leading-relaxed line-clamp-7 font-medium drop-shadow-md">
                            <?php echo e(Str::limit(strip_tags($event->description), 240)); ?>

                        </p>
                    </div>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->category): ?>
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wider backdrop-blur-md bg-white/90 text-[#1C1410] shadow-sm">
                            <?php echo e($event->category->name); ?>

                        </span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <!-- Date badge -->
                    <div class="absolute bottom-4 right-4 text-center bg-white/95 backdrop-blur-sm rounded-2xl p-2 min-w-[70px] shadow-lg border border-white/50 group-hover:-translate-y-1 transition-transform">
                        <div class="text-[#07A0C3] font-black text-2xl leading-none">
                            <?php echo e(\Carbon\Carbon::parse($event->event_date)->format('d')); ?>

                        </div>
                        <div class="text-[#1C1410] font-bold text-[10px] uppercase tracking-wider mt-1">
                            Tháng <?php echo e(\Carbon\Carbon::parse($event->event_date)->format('m')); ?>

                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex flex-1 flex-col p-6 lg:p-8">
                    <h3 class="mb-3 font-['Barlow_Condensed'] text-2xl font-black uppercase leading-tight tracking-tight text-[#1C1410] group-hover:text-[#07A0C3] transition-colors line-clamp-2">
                        <a href="<?php echo e(route('events.show', $event->slug)); ?>">
                            <span class="absolute inset-0"></span>
                            <?php echo e($event->title); ?>

                        </a>
                    </h3>
                    
                    <!-- Description moved to image hover overlay -->
                    
                    <!-- Footer / Metrics -->
                    <div class="mt-auto flex items-center justify-between border-t border-[#E8E2D5]/50 pt-4">
                        <div class="flex items-center gap-4 text-xs font-semibold text-[#7A6A52]">
                            <div class="flex items-center gap-1.5" title="Lượt xem">
                                <i data-lucide="eye" class="h-4 w-4 text-[#07A0C3]"></i>
                                <span><?php echo e($event->views_count ?? 0); ?></span>
                            </div>
                            <div class="flex items-center gap-1.5" title="Lượt thích">
                                <i data-lucide="heart" class="h-4 w-4 text-rose-500"></i>
                                <span><?php echo e($event->likes_count ?? 0); ?></span>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 text-sm font-bold text-[#1C1410] group-hover:text-[#07A0C3] transition-colors">
                            Chi tiết <i data-lucide="arrow-right" class="h-4 w-4"></i>
                        </span>
                    </div>
                    </div>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                    gsap.registerPlugin(ScrollTrigger);
                    
                    ScrollTrigger.batch(".event-grid-card-wrapper", {
                        interval: 0.1, // time window to batch items that enter at the same time
                        batchMax: 4,   // max items per batch (matches xl grid cols)
                        onEnter: batch => {
                            gsap.to(batch, {
                                opacity: 1, 
                                y: 0, 
                                stagger: 0.15, 
                                duration: 0.8, 
                                ease: "power3.out",
                                overwrite: true
                            });
                        },
                        start: "top 90%",
                        once: true
                    });
                } else {
                    // Fallback if GSAP fails to load
                    document.querySelectorAll('.event-grid-card-wrapper').forEach(el => {
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    });
                }
            });
        </script>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <?php echo e($events->appends(['category' => $selectedCategory, 'search' => request('search'), 'year' => request('year'), 'month' => request('month'), 'status' => request('status')])->links('pagination::tailwind')); ?>

        </div>
        
        <?php else: ?>
        <div class="text-center py-20 bg-white rounded-3xl border border-[#E8E2D5] shadow-sm">
            <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-slate-50 text-slate-400 mb-4">
                <i data-lucide="calendar-x" class="h-10 w-10"></i>
            </div>
            <h3 class="text-2xl font-bold text-[#1C1410] mb-2 font-['Barlow_Condensed'] uppercase tracking-tight">Không tìm thấy sự kiện nào</h3>
            <p class="text-[#7A6A52]">Hãy thử chọn một danh mục khác hoặc quay lại sau.</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/frontend/events.blade.php ENDPATH**/ ?>