<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['event', 'mode' => 'grid', 'isActive' => false, 'idx' => 0]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['event', 'mode' => 'grid', 'isActive' => false, 'idx' => 0]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $isModel = is_object($event);
    $name = $isModel ? ($event->title ?? 'SỰ KIỆN ĐANG CẬP NHẬT') : ($event['name'] ?? $event['title'] ?? 'SỰ KIỆN ĐANG CẬP NHẬT');
    $slug = $isModel ? ($event->slug ?? '#') : ($event['slug'] ?? '#');
    $category = $isModel ? ($event->category->name ?? 'SỰ KIỆN') : ($event['category'] ?? 'SỰ KIỆN');
    $images = $isModel ? ($event->bannerImage ? [\App\Helpers\FileHelper::url($event->bannerImage->url, true)] : []) : ($event['images'] ?? (isset($event['img']) ? [$event['img']] : []));
    $bgImg = !empty($images) && isset($images[0]) ? $images[0] : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80';
    
    $date = $isModel ? (isset($event->event_date) ? $event->event_date->format('d.m.Y') : 'Đang cập nhật') : ($event['date'] ?? 'Đang cập nhật');
    $location = $isModel ? ($event->location ?? 'Sẽ thông báo sau') : ($event['location'] ?? 'Sẽ thông báo sau');
    $summaryRaw = $isModel ? ($event->description ?? '') : ($event['summary'] ?? $event['description'] ?? '');
    $summary = $summaryRaw ? \Illuminate\Support\Str::limit(strip_tags($summaryRaw), 100) : 'Đang cập nhật thông tin chi tiết về sự kiện này...';

    // Base inline styles
    $wrapperStyle = '';
    
    // Classes
    $wrapperClass = 'relative block group rounded-2xl overflow-hidden transition-all duration-300';
    
    if ($mode === 'slider') {
        // Slider mode wrapper
        $outerWrapperClass = 'event-card shrink-0 relative transition-all duration-300 ease-in-out snap-start hover:z-50';
        
        // Overlap negative margin
        if ($idx > 0) {
            $outerWrapperClass .= ' -ml-[32px]';
        }
        
        // Z-index trick
        $zIndex = 30 - $idx;
        $wrapperStyle .= "z-index: {$zIndex}; ";
        
        // Size & Active state
        if ($isActive) {
            // Active (First) Card
            $outerWrapperClass .= ' w-[340px] h-[420px] scale-105';
            $wrapperClass .= ' w-full h-full border-[3px] border-[#F59E0B] shadow-2xl';
        } else {
            // Inactive Cards
            $outerWrapperClass .= ' w-[220px] h-[300px] md:w-[280px] md:h-[380px] hover:scale-105';
            $wrapperClass .= ' w-full h-full shadow-lg';
        }
    } else {
        // Grid Mode (For Featured Events)
        $outerWrapperClass = 'w-full h-full';
        $wrapperClass .= ' w-full h-full border border-black/10 hover:-translate-y-2 hover:shadow-2xl';
    }
?>

<style>
    /* Custom CSS để đảm bảo hiệu ứng blur hoạt động 100% không phụ thuộc Tailwind JIT */
    .group:hover .custom-blur-img {
        /* Vừa làm mờ, vừa làm tối hẳn bức ảnh */
        filter: blur(10px) brightness(0.35) !important;
    }
</style>

<!-- Card Outer Wrapper (Handles layout and hover z-index) -->
<div class="<?php echo e($outerWrapperClass); ?>" style="<?php echo e($wrapperStyle); ?>">
    
    <!-- Link & Inner Styling -->
    <a href="<?php echo e(route('events.show', $slug)); ?>" class="<?php echo e($wrapperClass); ?>">
        
        <!-- 1. Background Image -->
        <img src="<?php echo e($bgImg); ?>" alt="<?php echo e($name); ?>" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition-all duration-700 custom-blur-img group-hover:scale-110">
        
        <!-- 2. Dark Hover Overlay -->
        <div class="absolute inset-0 bg-[#1C1410]/60 opacity-0 group-hover:opacity-100 transition-all duration-300 z-10"></div>

        <!-- 4. Hover State (Match Steam Card Style) -->
        <div class="absolute inset-0 px-6 pt-6 md:px-8 md:pt-8 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20 pointer-events-none">
            <!-- Yellow Category / Tag -->
            <h3 class="font-black uppercase text-[15px] md:text-[17px] tracking-widest mb-3 drop-shadow-lg" style="color: #FFC107;">
                <?php echo e($category); ?>

            </h3>
            
            <!-- White Description Text -->
            <div class="text-white text-[15px] md:text-[17px] leading-relaxed drop-shadow-lg font-medium">
                <strong class="block mb-2 text-[19px] md:text-[22px] font-black line-clamp-3"><?php echo e($name); ?></strong>
            </div>
            <div class="text-white text-[15px] md:text-[17px] leading-relaxed drop-shadow-lg font-medium">
                <span class="block line-clamp-4 text-white/95"><?php echo e($summary); ?></span>
            </div>
            
            <!-- Small details at bottom left (optional but helpful for events) -->
            <div class="absolute bottom-[50px] left-6 right-6 md:left-8 md:right-8 flex flex-col gap-2 pointer-events-auto">
                <div class="flex items-center gap-2 text-white/90 text-[14px] font-medium">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span><?php echo e($date); ?></span>
                </div>
                <div class="flex items-start gap-2 text-white/90 text-[14px] font-medium">
                    <i data-lucide="map-pin" class="w-4 h-4 shrink-0 mt-0.5"></i>
                    <span class="line-clamp-1"><?php echo e($location); ?></span>
                </div>
            </div>
        </div>
        
    </a>
</div>
<?php /**PATH C:\Users\kienxinhzai\Downloads\ThucTap-tuan\resources\views/components/event-card.blade.php ENDPATH**/ ?>