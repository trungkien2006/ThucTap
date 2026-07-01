@php
    $hasEvents = !empty($upcoming) && count($upcoming) > 0;
@endphp

<style>
    /* Desktop Vertical Slide-up Layout */
    @media (min-width: 1024px) {
        .upcoming-pinned-container {
            width: 100%;
            height: calc(100vh - 72px);
            overflow: hidden;
            position: relative;
        }
        .upcoming-vertical-stack {
            position: relative;
            width: 100%;
            height: calc(100vh - 72px);
        }
        .upcoming-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: calc(100vh - 72px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5vw;
            padding-top: 7rem; /* Push image down so it doesn't overlap the title */
            will-change: transform;
        }
    }
    
    /* Mobile Vertical Stack Fallback */
    @media (max-width: 1023px) {
        .upcoming-pinned-container {
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        .upcoming-vertical-stack {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        .upcoming-panel {
            width: 100%;
            min-height: 100vh;
            padding: 4rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
    }

    /* Image Frame */
    .slide-image-frame {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 0;
    }
    
    .slide-image-inner {
        width: 100%;
        height: 100%;
        max-width: 90vw;
        max-height: 60vh;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        position: relative;
        /* Mobile adjustment */
        margin-top: 15vh;
    }
    
    @media (min-width: 1024px) {
        .slide-image-inner {
            max-width: 65vw;
            max-height: 55vh;
            border-radius: 32px;
            margin-top: 0;
        }
    }
    
    .slide-image-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .slide-image-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.1);
        mix-blend-mode: multiply;
    }
</style>

<section id="upcoming-vertical" class="relative w-full z-[30] rounded-t-[3rem] shadow-[0_-20px_40px_-15px_rgba(0,0,0,0.05)] pt-12 lg:pt-16" style="background:#FFFBEA; font-family: 'Inter', sans-serif;">
    <div class="upcoming-pinned-container">
        
        <!-- Tiêu đề cố định -->
        <div class="absolute top-6 md:top-8 left-0 w-full z-30 pointer-events-none text-center px-6" data-aos="fade-down">
            <div class="flex items-center justify-center gap-3 mb-2">
                <div class="h-1.5 w-8 rounded-full" style="background:#FFE381;"></div>
                <span class="text-md md:text-sm font-bold uppercase tracking-[0.25em]" style="color:#7A6A52;">Đừng bỏ lỡ</span>
                <div class="h-1.5 w-8 rounded-full" style="background:#FFE381;"></div>
            </div>
            <h2 class="font-barlow-condensed text-4xl md:text-5xl lg:text-5xl font-black uppercase tracking-tight text-[#1C1410] drop-shadow-md">
                Các sự kiện <span style="color:#07A0C3;">nổi bật</span>
            </h2>
        </div>

        <div class="upcoming-vertical-stack">
            
            @if($hasEvents)
                @foreach($upcoming as $idx => $u)
                    @php 
                        $img = !empty($u['images']) ? $u['images'][0] : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80';
                        $zIndex = $idx + 1;
                    @endphp
                    <div class="upcoming-panel text-[#1C1410]" style="z-index: {{ $zIndex }};" data-index="{{ $idx }}">
                        <!-- Center Image Frame -->
                        <div class="slide-image-frame pointer-events-auto">
                            <div class="slide-image-inner bg-gray-200 relative group overflow-hidden"
                                 x-data="{ active: 0, images: {{ json_encode(!empty($u['images']) ? $u['images'] : ['https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80']) }} }">
                                 
<style>
    /* Custom CSS để đảm bảo hiệu ứng blur hoạt động 100% không phụ thuộc Tailwind JIT */
    .group:hover .custom-blur-img-upcoming {
        filter: blur(12px) brightness(0.35) !important;
    }
</style>

                                <template x-for="(imgSrc, i) in images" :key="i">
                                    <img :src="imgSrc" :alt="`{{ $u['name'] ?? $u['title'] ?? '' }} - Hình ${i+1}`" 
                                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 custom-blur-img-upcoming group-hover:scale-110"
                                         :class="active === i ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                                </template>



                                <!-- Dots -->
                                <template x-if="images.length > 1">
                                    <div class="absolute bottom-6 right-6 z-30 flex gap-2 pointer-events-auto">
                                        <template x-for="(imgSrc, i) in images" :key="i">
                                            <button @click.prevent.stop="active = i" 
                                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                                    :class="active === i ? 'bg-[#FFC107] w-8' : 'bg-white/50 w-2 hover:bg-white/80'"></button>
                                        </template>
                                    </div>
                                </template>
                                
                                <!-- Dark Hover Overlay -->
                                <div class="absolute inset-0 bg-[#1C1410]/60 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none z-20"></div>
                                
                                <!-- Event Info Content (Hover State Match Steam Card Style) -->
                                <div class="absolute inset-0 flex flex-col justify-start p-8 md:p-12 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-30 pointer-events-none">
                                    <!-- Yellow Category / Tag -->
                                    <h3 class="font-black uppercase text-[16px] md:text-[20px] tracking-widest mb-4 drop-shadow-lg" style="color: #FFC107;">
                                        {{ $u['category'] ?? 'Sự kiện' }}
                                    </h3>
                                    
                                    <!-- White Description Text -->
                                    <div class="text-white text-[16px] md:text-[18px] leading-relaxed drop-shadow-lg font-medium max-w-3xl">
                                        <strong class="block mb-3 text-[28px] md:text-[40px] font-black leading-tight">{{ $u['name'] ?? $u['title'] ?? '' }}</strong>
                                        <span class="line-clamp-4 text-white/95">{{ $u['summary'] ?? '' }}</span>
                                    </div>
                                    
                                    <!-- Small details at bottom left -->
                                    <div class="mt-auto pt-6 flex flex-col gap-3">
                                        <div class="flex items-center gap-3 text-white/90 text-[16px] font-medium">
                                            <i data-lucide="calendar" class="w-5 h-5"></i>
                                            <span>{{ $u['date'] }}</span>
                                        </div>
                                        <div class="flex items-start gap-3 text-white/90 text-[16px] font-medium">
                                            <i data-lucide="map-pin" class="w-5 h-5 shrink-0 mt-0.5"></i>
                                            <span class="line-clamp-2 max-w-lg">{{ $u['location'] ?? 'Sẽ thông báo sau' }}</span>
                                        </div>
                                        
                                        <!-- Action Button -->
                                        <div class="mt-4 pointer-events-auto">
                                            <a href="{{ route('events.show', $u['slug']) }}" class="inline-flex items-center gap-3 text-white text-[14px] font-bold tracking-[0.15em] group/btn w-fit uppercase hover:text-[#FFC107] transition-colors" style="text-decoration: none;">
                                                <span>XEM CHI TIẾT</span>
                                                <div class="w-10 h-10 rounded-full border border-white/50 flex items-center justify-center group-hover/btn:border-[#FFC107] transition-colors">
                                                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="upcoming-panel text-[#1C1410]" style="z-index: 1;" data-index="0">
                    <p class="font-medium text-2xl">Hiện chưa có sự kiện nào sắp diễn ra.</p>
                </div>
            @endif

        </div>
    </div>
</section>

<!-- GSAP Animation Logic -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Only run on desktop (lg breakpoint in Tailwind)
        if (window.innerWidth >= 1024) {
            
            // Wait for GSAP and ScrollTrigger to be available
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);
                
                const wrapper = document.querySelector('.upcoming-pinned-container');
                const panels = gsap.utils.toArray('.upcoming-panel');
                
                if (panels.length > 1 && wrapper) {
                    // Set initial positions: all panels start off-screen to the bottom-right
                    const isMobile = window.innerWidth < 1024;
                    const startX = isMobile ? 95 : 70;
                    const midX = isMobile ? 45 : 27.5;
                    const endX = isMobile ? -100 : -85;
                    // Set initial positions
                    gsap.set(panels, {
                        xPercent: startX,
                        yPercent: 100 // Start from bottom
                    });
                    
                    // First panel starts on-screen
                    gsap.set(panels[0], {
                        xPercent: 0,
                        yPercent: 0
                    });

                    // Wait for DOM to ensure featured events is ready
                    const cardsContainer = document.querySelector('#featured-cards-container');
                    const cardsViewport = document.querySelector('#featured-cards-viewport');
                    
                    const getCardsScrollDistance = () => {
                        if (!cardsContainer || !cardsViewport) return 0;
                        const cards = cardsContainer.querySelectorAll('.featured-card-item');
                        if (cards.length === 0) return 0;
                        const cardWidth = cards[0].offsetWidth;
                        const gap = 24; // gap-6 is 24px
                        const paddingRight = 32; // padding-right: 2rem
                        const totalWidth = (cardWidth * cards.length) + (gap * (cards.length - 1)) + paddingRight;
                        return Math.max(0, totalWidth - cardsViewport.clientWidth);
                    };

                    // Set initial position for featured events wrapper
                    gsap.set("#featured-events-wrapper", { xPercent: 100, x: 0 });

                    // Pin the events (Danh mục) section to create a Z-Index Layering / Overlapping effect
                    if (document.getElementById('events')) {
                        ScrollTrigger.create({
                            trigger: "#events",
                            start: () => {
                                const el = document.getElementById('events');
                                return el.offsetHeight > (window.innerHeight - 72) ? "bottom bottom" : "top 72px";
                            },
                            endTrigger: "#master-wipe-container",
                            end: "top 72px",
                            pin: true,
                            pinSpacing: false, // Allows master-wipe-container to overlap it
                            invalidateOnRefresh: true
                        });
                    }

                    // Create a timeline for the scrub animation
                    const tl = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#master-wipe-container",
                            pin: true,
                            pinSpacing: false, // Allows #archive to slide over it
                            scrub: 1, // Smooth scrubbing
                            start: "top 72px", // Pins right below the site's sticky header
                            // Add extra scroll distance for the section wipe (1.5x) AND the cards scrolling PLUS window height for layered effect
                            end: () => {
                                const D = window.innerHeight * ((panels.length - 1) * 1.5 + 1.5) + getCardsScrollDistance();
                                const spacer = document.getElementById('archive-delay-spacer');
                                if (spacer) spacer.style.height = D + 'px';
                                return "+=" + (D + window.innerHeight - 72);
                            },
                            invalidateOnRefresh: true,
                        }
                    });

                    // Animate each panel
                    panels.forEach((panel, index) => {
                        if (index === 0) return; // Skip first panel
                        
                        const label = 'transition_' + index;

                        // The previous panel moves continuously to the left over BOTH phases
                        // Apply an offset so discarded panels stack visibly on the left
                        const offsetEndX = endX - (index - 1) * 3;
                        
                        tl.to(panels[index - 1], {
                            xPercent: offsetEndX,
                            ease: "none",
                            duration: 2
                        }, label);
                        
                        // Phase 1: The next panel moves DIAGONALLY from bottom-right to an intermediate aligned position
                        tl.to(panel, {
                            xPercent: midX,
                            yPercent: 0,
                            ease: "none",
                            duration: 1
                        }, label);
                        
                        // Phase 2: Once aligned vertically, the next panel slides horizontally into the center
                        tl.to(panel, {
                            xPercent: 0,
                            ease: "none",
                            duration: 1
                        }, label + "+=1");
                    });

                    // Final Phase A: Slide in the featured events section wrapper (Background and Header)
                    tl.to("#featured-events-wrapper", {
                        xPercent: 0,
                        ease: "none",
                        duration: 1.0
                    });

                    // Prepare cards: position them off-screen to the right and invisible
                    gsap.set(".featured-card-item", { x: window.innerWidth, opacity: 0 });

                    // Final Phase A2: Cards fly in sequentially ONE BY ONE
                    tl.to(".featured-card-item", {
                        x: 0,
                        opacity: 1,
                        ease: "power2.out",
                        stagger: 0.2, // Delay between each card's animation
                        duration: 1.0
                    });

                    // Final Phase B: Scroll the cards container horizontally
                    const cardsScrollDist = getCardsScrollDistance();
                    if (cardsScrollDist > 0) {
                        // Duration is proportional to scroll distance
                        const cardsDuration = cardsScrollDist / window.innerHeight;
                        tl.to("#featured-cards-container", {
                            x: -cardsScrollDist,
                            ease: "none",
                            duration: cardsDuration
                        });
                    }

                    // Refresh ScrollTrigger on window resize
                    window.addEventListener('resize', () => {
                        ScrollTrigger.refresh();
                    });

                    // Final Phase C: Empty space to allow #archive to slide over the pinned section smoothly without scrolling the cards further
                    const currentDuration = tl.duration();
                    if (currentDuration > 0) {
                        const D = window.innerHeight * ((panels.length - 1) * 1.5 + 1.5) + getCardsScrollDistance();
                        tl.to({}, { duration: currentDuration * ((window.innerHeight - 72) / D) });
                    }
                }
            } else {
                console.warn('GSAP or ScrollTrigger not loaded.');
            }
        } else {
             // Reset panels for mobile
             const panels = document.querySelectorAll('.upcoming-panel');
             panels.forEach(panel => {
                 panel.style.transform = 'none';
             });
        }
    });
</script>

