@props(['event', 'mode' => 'grid', 'isActive' => false, 'idx' => 0])

@php
    // Fallback logic for missing properties
    $name = $event['name'] ?? $event['title'] ?? 'SỰ KIỆN ĐANG CẬP NHẬT';
    $slug = $event['slug'] ?? '#';
    $category = $event['category'] ?? 'SỰ KIỆN';
    $images = $event['images'] ?? (isset($event['img']) ? [$event['img']] : []);
    $bgImg = !empty($images) && isset($images[0]) ? $images[0] : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80';
    
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
@endphp

<!-- Card Outer Wrapper (Handles layout and hover z-index) -->
<div class="{{ $outerWrapperClass }}" style="{{ $wrapperStyle }}">
    
    <!-- Link & Inner Styling -->
    <a href="{{ route('events.show', $slug) }}" class="{{ $wrapperClass }}">
        
        <!-- 1. Background Image -->
        <img src="{{ $bgImg }}" alt="{{ $name }}" class="absolute inset-0 w-full h-full object-cover">
        
        <!-- 2. Gradient Overlay -->
        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.3) 50%, transparent 100%);"></div>
        
        <!-- 3. Arrow Icon -->
        <div class="absolute top-[16px] right-[16px] w-[32px] h-[32px] rounded-full flex items-center justify-center text-black shadow-sm transition-transform group-hover:rotate-45" style="background: rgba(255,255,255,0.9);">
            <svg class="w-[14px] h-[14px]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
        </div>
        
        <!-- 4. Category Label -->
        <div class="absolute bottom-[64px] left-[20px] bg-[#F59E0B] text-black text-[11px] font-bold uppercase rounded-[4px] px-[10px] py-[4px] shadow-sm tracking-wider">
            {{ $category }}
        </div>
        
        <!-- 5. Event Name -->
        <h3 class="absolute bottom-[20px] left-[20px] right-[20px] font-sans font-bold text-white text-[18px] md:text-[20px] uppercase leading-tight drop-shadow-md" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $name }}
        </h3>
        
    </a>
</div>
