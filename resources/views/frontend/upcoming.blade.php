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
        max-width: 100%;
        max-height: 60vh;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        position: relative;
        /* Mobile adjustment */
        margin-top: 12vh;
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
    
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.1);
        mix-blend-mode: multiply;
    }

    /* Custom CSS để đảm bảo hiệu ứng blur hoạt động 100% không phụ thuộc Tailwind JIT */
    .group:hover .custom-blur-img-upcoming {
        filter: blur(12px) brightness(0.35) !important;
    }
</style>

<section id="upcoming-vertical" class="relative w-full z-[30] rounded-t-[3rem] shadow-[0_-20px_40px_-15px_rgba(0,0,0,0.05)] pt-12 lg:pt-16" style="background:#FFFBEA; font-family: 'Inter', sans-serif;">
    <div class="upcoming-pinned-container hidden lg:block">
        
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
                @foreach(array_slice($upcoming, 0, 5) as $idx => $u)
                    @php 
                        $img = !empty($u['images']) ? $u['images'][0] : (!empty($u['img']) ? $u['img'] : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80');
                        $zIndex = $idx + 1;
                    @endphp
                    <div class="upcoming-panel text-[#1C1410]" style="z-index: {{ $zIndex }};" data-index="{{ $idx }}">
                        <!-- Center Image Frame -->
                        <div class="slide-image-frame pointer-events-auto">
                            <div tabindex="0" class="slide-image-inner bg-gray-200 relative group overflow-hidden cursor-pointer focus:outline-none"
                                 x-data="{ active: 0, images: {{ json_encode(!empty($u['images']) ? $u['images'] : (!empty($u['img']) ? [$u['img']] : ['https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80'])) }} }">
                                 
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
                                <div class="absolute inset-0 px-8 pt-8 md:px-12 md:pt-12 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-30 pointer-events-none">
                                    <!-- Yellow Category / Tag -->
                                    <h3 class="font-black uppercase text-[16px] md:text-[20px] tracking-widest mb-4 drop-shadow-lg" style="color: #FFC107;">
                                        {{ $u['category'] ?? 'Sự kiện' }}
                                    </h3>
                                    
                                    <!-- White Description Text -->
                                    <div class="text-white text-[16px] md:text-[18px] leading-relaxed drop-shadow-lg font-medium max-w-3xl">
                                        <strong class="block mb-3 text-[28px] md:text-[40px] font-black leading-tight line-clamp-3">{{ $u['name'] ?? $u['title'] ?? '' }}</strong>
                                    </div>
                                    <div class="text-white text-[16px] md:text-[18px] leading-relaxed drop-shadow-lg font-medium max-w-3xl">
                                        <span class="block line-clamp-4 text-white/95">{{ $u['summary'] ?? '' }}</span>
                                    </div>
                                    
                                    <!-- Small details at bottom left -->
                                    <div class="absolute bottom-[50px] left-8 right-8 md:left-12 md:right-12 flex flex-col gap-3 pointer-events-auto">
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

        <!-- THÊM MỚI — Navigation dots -->
        @if($hasEvents && count($upcoming) > 1)
        <div id="upcoming-dots" class="absolute bottom-6 md:bottom-8 left-0 right-0 z-40 flex justify-center gap-2 md:gap-3 pointer-events-none">
            @foreach($upcoming as $idx => $u)
                <div class="upcoming-dot h-2 rounded-full transition-all duration-500"
                     data-dot="{{ $idx }}"
                     style="width: {{ $idx === 0 ? '2rem' : '0.5rem' }}; background: {{ $idx === 0 ? '#FFE381' : 'rgba(122,106,82,0.3)' }};"></div>
            @endforeach
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dots = document.querySelectorAll('.upcoming-dot');
            const panels = document.querySelectorAll('.upcoming-panel');
            if (!dots.length || !panels.length) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const idx = entry.target.dataset.index;
                        dots.forEach((d, i) => {
                            d.style.width = String(i) === String(idx) ? '2rem' : '0.5rem';
                            d.style.background = String(i) === String(idx) ? '#FFE381' : 'rgba(122,106,82,0.3)';
                        });
                    }
                });
            }, { threshold: 0.6 });

            panels.forEach(p => observer.observe(p));
        });
        </script>
        @endif
    </div>

    <!-- MOBILE VIEW (Horizontal Category Style Slider + Alpine Pagination) -->
    <div class="block lg:hidden px-4 pb-8 pt-6"
         x-data="{
            items: {{ json_encode(collect($upcoming)->map(function($u) {
                $img = !empty($u['images']) ? $u['images'][0] : (!empty($u['img']) ? $u['img'] : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80');
                return ['name' => $u['name'], 'slug' => $u['slug'], 'date' => $u['date'], 'category' => $u['category'] ?? 'Sự kiện', 'img' => $img];
            })->values()) }},
            perPage: 3,
            page: 0,
            get totalPages() { return Math.ceil(this.items.length / this.perPage); },
            get paged() { return this.items.slice(this.page * this.perPage, (this.page + 1) * this.perPage); },
            goTo(p) { this.page = p; this.$nextTick(() => { if(this.$refs.featScrollBox) this.$refs.featScrollBox.scrollLeft = 0; }); }
         }">
        <!-- Tiêu đề -->
        <div class="text-center mb-5">
            <div class="flex items-center justify-center gap-2 mb-1">
                <div class="h-1 w-6 rounded-full" style="background:#FFE381;"></div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Đừng bỏ lỡ</span>
                <div class="h-1 w-6 rounded-full" style="background:#FFE381;"></div>
            </div>
            <h2 class="font-barlow-condensed text-3xl font-black uppercase text-[#1C1410]">
                Các sự kiện <span style="color:#07A0C3;">sắp diễn ra</span>
            </h2>
        </div>

        <template x-if="items.length === 0">
            <p class="text-center text-gray-500 py-4">Hiện chưa có sự kiện nào sắp diễn ra.</p>
        </template>

        <!-- Horizontal scrollable category-style container -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 hide-scrollbar" x-ref="featScrollBox">
            <template x-for="(item, i) in paged" :key="page + '-' + i">
                <a :href="'/events/' + item.slug"
                   class="snap-start shrink-0 w-[85%] group relative block rounded-2xl overflow-hidden bg-gray-900 shadow-sm transition-all duration-300"
                   style="aspect-ratio: 16/9; min-height: 160px; text-decoration: none;">
                    
                    <!-- Background Image -->
                    <img :src="item.img" :alt="item.name" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                    <!-- Category Tag (Top Left Badge) -->
                    <div class="absolute top-4 left-4 z-10">
                        <div class="bg-white/95 px-3 py-1.5 rounded-xl border border-black shadow">
                            <span class="text-[#1C1410] text-xs font-bold" x-text="item.category"></span>
                        </div>
                    </div>

                    <!-- Overlay Gradient -->
                    <div class="absolute inset-x-0 bottom-0 h-2/3 pointer-events-none"
                         style="background: linear-gradient(to top, rgba(28,20,16,0.9) 0%, transparent 100%);"></div>

                    <!-- Event Name Title (Bottom Left) -->
                    <div class="absolute bottom-4 left-4 right-24 z-10 text-white">
                        <h3 class="font-bold text-sm tracking-tight line-clamp-1 leading-tight" x-text="item.name"></h3>
                    </div>

                    <!-- Date Badge (Bottom Right) -->
                    <div class="absolute bottom-4 right-4 z-10">
                        <div class="flex items-center gap-1.5 rounded-full px-2.5 py-1.5 text-[10px] font-bold shadow-sm"
                             style="background: rgba(7,160,195,0.95); color: #fff; backdrop-filter: blur(4px);">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <span x-text="item.date"></span>
                        </div>
                    </div>
                </a>
            </template>
        </div>

        <!-- Pagination -->
        <template x-if="totalPages > 1">
            <div class="flex items-center justify-center gap-2 mt-2">
                <button @click="goTo(page - 1)" :disabled="page === 0"
                        class="w-8 h-8 rounded-full flex items-center justify-center text-sm border transition-all"
                        :class="page === 0 ? 'border-gray-200 text-gray-300 cursor-not-allowed' : 'border-gray-300 text-gray-600 active:bg-gray-100'">
                    ‹
                </button>
                <template x-for="p in totalPages" :key="p">
                    <button @click="goTo(p - 1)"
                            class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all"
                            :class="page === p - 1 ? 'bg-[#07A0C3] text-white shadow' : 'text-gray-500 active:bg-gray-100'">
                        <span x-text="p"></span>
                    </button>
                </template>
                <button @click="goTo(page + 1)" :disabled="page >= totalPages - 1"
                        class="w-8 h-8 rounded-full flex items-center justify-center text-sm border transition-all"
                        :class="page >= totalPages - 1 ? 'border-gray-200 text-gray-300 cursor-not-allowed' : 'border-gray-300 text-gray-600 active:bg-gray-100'">
                    ›
                </button>
            </div>
        </template>
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
                
                if (wrapper) {
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
                            scrub: 1.5, // Smoother scrubbing for a premium feel
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
                            ease: "power1.inOut",
                            duration: 2
                        }, label);
                        
                        // Phase 1: The next panel moves DIAGONALLY from bottom-right to an intermediate aligned position
                        tl.to(panel, {
                            xPercent: midX,
                            yPercent: 0,
                            ease: "power1.inOut",
                            duration: 1
                        }, label);
                        
                        // Phase 2: Once aligned vertically, the next panel slides horizontally into the center
                        tl.to(panel, {
                            xPercent: 0,
                            ease: "power1.out",
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
             
             // Reset layout for mobile to flow normally instead of overlapping
             const masterWipe = document.getElementById('master-wipe-container');
             if (masterWipe) {
                 masterWipe.style.display = 'block';
             }
             const featuredWrapper = document.getElementById('featured-events-wrapper');
             if (featuredWrapper) {
                 featuredWrapper.style.transform = 'none';
             }
        }
    });
</script>

