<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($slides) && isset($slides[0])): ?>
    <!-- Decorative Preloads commented out for local dev performance -->
    
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        @media (max-width: 1023px) {
            #master-wipe-container {
                display: flex !important;
                flex-direction: column !important;
                grid-template-columns: none !important;
                height: auto !important;
                overflow: hidden !important;
            }
            #master-wipe-container > div {
                grid-area: auto !important;
                position: relative !important;
                width: 100% !important;
                height: auto !important;
            }
            #featured-events-wrapper {
                grid-area: auto !important;
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                transform: none !important;
                z-index: auto !important;
            }
            
            /* Hero Slider Mobile Overrides */
            .slider-content {
                padding: 0 20px !important;
                align-items: flex-end !important;
                justify-content: flex-start !important;
                padding-bottom: 60px !important;
            }
            .slide-info {
                flex: 1 1 auto !important;
                width: 100% !important;
                max-width: 100% !important;
                margin-bottom: 0 !important;
            }
            .slide-title {
                font-size: clamp(24px, 7vw, 36px) !important;
                line-height: 1.1 !important;
                margin-bottom: 12px !important;
                word-break: keep-all !important;
                overflow-wrap: normal !important;
                white-space: normal !important;
            }
            .slide-desc {
                font-size: 13px !important;
                max-width: 100% !important;
                margin-bottom: 20px !important;
                line-height: 1.5 !important;
            }
            .slide-eyebrow {
                font-size: 11px !important;
                margin-bottom: 8px !important;
            }
            .btn-cta {
                padding: 8px 18px !important;
                font-size: 10px !important;
            }
            .btn-play {
                width: 36px !important;
                height: 36px !important;
            }
            .btn-play svg {
                width: 12px !important;
                height: 12px !important;
            }
            .card-strip {
                display: none !important;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section id="top" class="relative min-h-screen w-full overflow-hidden" style="background:#1C1410;">

    
    <div class="slider-wrapper" id="slider">
        <div class="bg-layers" id="bgLayers">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="bg-layer <?php echo e($i === 0 ? 'active' : 'idle'); ?>" data-index="<?php echo e($i); ?>"
                 <?php if($i === 0): ?> style="background-image:url('<?php echo e($slide['image']); ?>')" <?php endif; ?>></div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        
        <div class="slider-overlay" style="background: rgba(0,0,0,0.2);"></div>
        <div class="slider-content">
            <div class="slide-info is-active" id="slideInfo">
                <div class="slide-eyebrow" id="slideEyebrow"><?php echo e($slides[0]['eyebrow']); ?></div>
                <h1 class="slide-title" id="slideTitle"><?php echo e($slides[0]['title']); ?></h1>
                <p class="slide-desc" id="slideDesc"><?php echo e($slides[0]['description']); ?></p>
                <div class="slide-actions">
                    <button class="btn-play" aria-label="Xem video">
                        <svg viewBox="0 0 16 16"><polygon points="3,1 13,8 3,15"/></svg>
                    </button>
                    <a href="<?php echo e($slides[0]['cta_url']); ?>" class="btn-cta" id="slideCta"><?php echo e($slides[0]['cta_label']); ?></a>
                </div>
            </div>
            <div class="card-strip" id="cardStrip">
                <div class="card-track" id="cardTrack">
                    
                </div>
            </div>
        </div>
        </div>
    </div>
    <script>
    (function(){
        const slides = <?php echo json_encode($slides, 15, 512) ?>, total = slides.length;
        if (!total) return;

        /* ─── State ─── */
        let current  = 0;
        let isAnim   = false;
        const INTERVAL = 2000; // 2 seconds

        /* ─── Constants ─── */
        const MAX_CARDS = 4;
        const CW = 200, GAP = 16, STEP = CW + GAP;

        /* ─── Circular queue of slide indices ───
           queue[0] is always the NEXT slide (leftmost card).
           When a card is consumed, it goes to the end. */
        let queue = [];
        for (let i = 1; i < total; i++) queue.push(i); // [1,2,3,...,7]
        queue.push(0); // slide 0 at the end (it's currently the background)

        /* ─── DOM ─── */
        const bgLayers     = document.querySelectorAll('.bg-layer');
        const cardTrack    = document.getElementById('cardTrack');
        const slideInfo    = document.getElementById('slideInfo');
        const slideEyebrow = document.getElementById('slideEyebrow');
        const slideTitle   = document.getElementById('slideTitle');
        const slideDesc    = document.getElementById('slideDesc');
        const slideCta     = document.getElementById('slideCta');
        const progressBar  = document.getElementById('progressBar');
        const sliderEl     = document.getElementById('slider');

        // Lazy load remaining background images when browser is idle
        const loadRemainingBg = () => {
            bgLayers.forEach((layer, idx) => {
                if (idx !== 0 && slides[idx]) {
                    const img = new Image();
                    img.onload = () => { layer.style.backgroundImage = `url('${slides[idx].image}')`; };
                    img.src = slides[idx].image;
                }
            });
        };
        if ('requestIdleCallback' in window) {
            requestIdleCallback(loadRemainingBg, { timeout: 1500 });
        } else {
            setTimeout(loadRemainingBg, 300);
        }

        /* ─── Shift title animation ─── */
        function shiftTitle(text) {
            slideTitle.innerHTML = '';
            const words = text.split(' ');
            let charIndex = 0;
            words.forEach((word, wIdx) => {
                const wordSpan = document.createElement('span');
                wordSpan.style.display = 'inline-block';
                
                const chars = word.split('');
                chars.forEach((char) => {
                    const span = document.createElement('span');
                    span.className = 'shift-char';
                    span.textContent = char;
                    span.style.transitionDelay = `${charIndex * 25}ms`;
                    wordSpan.appendChild(span);
                    charIndex++;
                });
                slideTitle.appendChild(wordSpan);
                
                if (wIdx < words.length - 1) {
                    const spaceSpan = document.createElement('span');
                    spaceSpan.className = 'shift-char';
                    spaceSpan.textContent = '\u00A0';
                    spaceSpan.style.transitionDelay = `${charIndex * 25}ms`;
                    slideTitle.appendChild(spaceSpan);
                    charIndex++;
                }
            });
            // Trigger the animation on next frame
            requestAnimationFrame(() => requestAnimationFrame(() => {
                slideTitle.querySelectorAll('.shift-char').forEach(s => s.classList.add('is-visible'));
            }));
        }

        // Initial title shift animation
        shiftTitle(slides[0].title);

        /* ─── Card helpers ─── */
        function liveCards() { return Array.from(cardTrack.querySelectorAll('.dest-card')); }

        function makeCard(slideIdx) {
            const sl   = slides[slideIdx];
            const card = document.createElement('div');
            card.className     = 'dest-card';
            card.dataset.index = slideIdx;
            card.innerHTML =
                `<img src="${sl.image}" alt="${sl.title}" loading="lazy" decoding="async">` +
                `<div class="dest-card-overlay"></div>` +
                `<div class="dest-card-info">` +
                    `<div class="dest-card-tag">${sl.tag}</div>` +
                    `<div class="dest-card-name">${sl.title}</div>` +
                `</div>`;
                
            card.addEventListener('click', () => {
                if (isAnim) return;
                const idxInQueue = queue.indexOf(slideIdx);
                if (idxInQueue !== -1) {
                    advance(idxInQueue, card);
                }
            });

            return card;
        }

        function markFirstActive() {
            liveCards().forEach((c, i) => c.classList.toggle('active', i === 0));
        }

        /* ─── Build initial strip (first MAX_CARDS from queue) ─── */
        function initStrip() {
            cardTrack.innerHTML = '';
            cardOffset = 0;
            cardTrack.style.transition = 'none';
            cardTrack.style.transform  = 'translateX(0)';
            const count = Math.min(MAX_CARDS, queue.length);
            for (let i = 0; i < count; i++) {
                cardTrack.appendChild(makeCard(queue[i]));
            }
            markFirstActive();
        }

        /* ─── Advance: expand leftmost card (or clicked card) → bg, recycle to queue end ─── */
        function advance(jumpQueueIndex = 0, targetCardOverride = null) {
            if (isAnim || queue.length === 0) return;
            isAnim = true;
            stopTimer();

            const nextSlideIdx = queue[jumpQueueIndex];
            const prev         = current;
            current            = nextSlideIdx;

            /* --- Expand clone in BACKGROUND (z:0 < overlay z:1 < content z:5) --- */
            const targetCard = targetCardOverride || cardTrack.firstElementChild;
            if (targetCard) {
                const sRect = sliderEl.getBoundingClientRect();
                const cRect = targetCard.getBoundingClientRect();

                const computedShadow = window.getComputedStyle(targetCard).boxShadow;

                const clone = document.createElement('div');
                clone.style.cssText =
                    'position:absolute;' +
                    `top:${cRect.top - sRect.top}px;` +
                    `left:${cRect.left - sRect.left}px;` +
                    `width:${cRect.width}px;height:${cRect.height}px;` +
                    `background-image:url('${slides[nextSlideIdx].image}');` +
                    'background-size:cover;background-position:center;' +
                    `box-shadow:${computedShadow};` +
                    'border-radius:20px;z-index:0;pointer-events:none;' +
                    'transition:top 750ms cubic-bezier(0.4,0,0.2,1),' +
                               'left 750ms cubic-bezier(0.4,0,0.2,1),' +
                               'width 750ms cubic-bezier(0.4,0,0.2,1),' +
                               'height 750ms cubic-bezier(0.4,0,0.2,1),' +
                               'border-radius 750ms cubic-bezier(0.4,0,0.2,1);';
                sliderEl.appendChild(clone);

                bgLayers[prev].classList.remove('active');
                bgLayers[prev].classList.add('leaving');

                requestAnimationFrame(() => requestAnimationFrame(() => {
                    clone.style.top = '0'; clone.style.left = '0';
                    clone.style.width = '100%'; clone.style.height = '100%';
                    clone.style.borderRadius = '0';
                }));

                setTimeout(() => {
                    bgLayers[prev].classList.remove('leaving');
                    bgLayers[prev].classList.add('idle');
                    bgLayers[current].style.transition = 'none';
                    bgLayers[current].classList.remove('idle', 'leaving');
                    bgLayers[current].classList.add('active');
                    setTimeout(() => { bgLayers[current].style.transition = ''; }, 50);
                    clone.remove();
                }, 770);
            }

            /* --- Card Track DOM updates with FLIP Animation --- */
            // 1. Record original positions of DOM nodes
            const oldCards = Array.from(cardTrack.children);
            const firstRects = new Map();
            oldCards.forEach(c => firstRects.set(c, c.getBoundingClientRect()));

            // 2. Remove the clicked card from the track
            const clickedCard = oldCards[jumpQueueIndex];
            if (clickedCard) {
                clickedCard.remove();
                firstRects.delete(clickedCard);
            }

            // 3. Update queue
            queue.splice(jumpQueueIndex, 1);
            queue.push(nextSlideIdx);

            // 4. Append new card to the end
            const newSlideIdx = queue[Math.min(MAX_CARDS, queue.length) - 1];
            const newCard = makeCard(newSlideIdx);
            cardTrack.appendChild(newCard);

            // 5. Update active class FIRST (this triggers flex-basis transition natively)
            markFirstActive();

            // 6. Invert and Play (FLIP) for smooth sliding
            const newCards = Array.from(cardTrack.children);
            newCards.forEach(c => {
                const firstRect = firstRects.get(c);
                if (firstRect) {
                    const lastRect = c.getBoundingClientRect();
                    const dx = firstRect.left - lastRect.left;
                    if (dx !== 0) {
                        // FIX: Only disable transform. Disabling all transitions ('none') kills flex-basis animation
                        c.style.transition = 'transform 0s';
                        c.style.transform = `translateX(${dx}px)`;
                        requestAnimationFrame(() => requestAnimationFrame(() => {
                            // Restore CSS transitions for perfectly composed animations
                            c.style.transition = '';
                            c.style.transform = '';
                        }));
                    }
                } else {
                    // New card sliding and fading in from right
                    const dx = (jumpQueueIndex + 1) * STEP;
                    c.style.transition = 'transform 0s, opacity 0s';
                    c.style.opacity = '0';
                    c.style.transform = `translateX(${dx}px)`;
                    requestAnimationFrame(() => requestAnimationFrame(() => {
                        c.style.transition = 'transform 600ms cubic-bezier(0.4,0,0.2,1), opacity 600ms ease';
                        c.style.opacity = '1';
                        c.style.transform = '';
                        setTimeout(() => { c.style.transition = ''; }, 600);
                    }));
                }
            });

            /* --- Update text --- */
            slideInfo.classList.remove('is-active');
            setTimeout(() => {
                slideEyebrow.textContent = slides[current].eyebrow;
                shiftTitle(slides[current].title);
                slideDesc.textContent    = slides[current].description;
                slideCta.textContent     = slides[current].cta_label;
                slideCta.href            = slides[current].cta_url;
                slideInfo.classList.add('is-active');
            }, 250);

            /* --- Unlock & restart timer --- */
            setTimeout(() => {
                isAnim = false;
                startTimer();
            }, 800);
        }

        /* ─── Timer (Game Loop Pattern) ─── */
        let isHovering = false;
        let timerRAF = null;
        let lastTime = 0;
        let accumulated = 0;

        function updateProgressBar(acc) {
            if (!progressBar) return;
            const percentage = (acc / INTERVAL) * 100;
            progressBar.style.width = `${percentage}%`;
        }

        function loop(time) {
            if (!lastTime) lastTime = time;
            let delta = time - lastTime;
            lastTime = time;

            // Cap delta to 100ms to prevent massive skips if tab was in background
            if (delta > 100) delta = 100;

            // Progress the timer if not animating a slide
            if (!isAnim) {
                // Slower progression (x3 slower) when user is hovering over the slider
                const effectiveDelta = isHovering ? delta / 3 : delta;
                accumulated += effectiveDelta;
                
                const displayAcc = Math.min(accumulated, INTERVAL);
                updateProgressBar(displayAcc);

                if (accumulated >= INTERVAL) {
                    accumulated = 0;
                    updateProgressBar(0); // Clear immediately
                    advance(); // Sets isAnim = true, pausing the timer naturally
                }
            }
            
            timerRAF = requestAnimationFrame(loop);
        }

        function startTimer() {
            stopTimer();
            accumulated = 0;
            lastTime = 0;
            updateProgressBar(0);
            
            // Check if mouse is already inside slider when loaded
            isHovering = sliderEl?.matches(':hover') || false;
            
            timerRAF = requestAnimationFrame(loop);
        }

        function stopTimer() {
            if (timerRAF) cancelAnimationFrame(timerRAF);
            timerRAF = null;
            lastTime = 0;
            // DO NOT reset accumulated here, so segments stay lit visually during the slide transition
        }

        /* ─── Pause on hover ─── */
        sliderEl?.addEventListener('mouseenter', () => isHovering = true);
        sliderEl?.addEventListener('mouseleave', () => isHovering = false);

        /* ─── Init ─── */
        initStrip();
        startTimer();
    })();
    </script>
</section>


    <div id="events-sticky-wrapper" class="relative z-30" style="background: #FFFBEA;">
        <section id="events" class="relative z-20"
            style="background:#FFFBEA;">

            <div id="categories-section" class="relative z-[15] pt-2 pb-8 lg:pt-4 lg:pb-10" style="background:#FFFBEA;">
                <div class="mx-auto w-full max-w-[1400px] px-6 lg:px-10">

                <div class="mb-8 text-center event-category-title" style="opacity: 0;">
                    <h2
                        class="font-barlow-condensed text-4xl font-black uppercase tracking-tight text-[#1C1410] lg:text-5xl">
                        Danh mục sự kiện
                    </h2>
                    <div class="mt-3 flex justify-center">
                        <div class="h-1.5 w-12 rounded-full" style="background:#07A0C3;"></div>
                    </div>
                </div>

                <?php
                    $totalCount = 0;
                    foreach ($categories as $c)
                        $totalCount += $c['event_count'] ?? 0;

                    $catIcons = [
                        'conference' => 'mic',
                        'workshop' => 'wrench',
                        'seminar' => 'presentation',
                        'cultural' => 'palette',
                        'sports' => 'medal',
                        'orientation' => 'compass',
                        'other' => 'more-horizontal'
                    ];

                    $catImages = [
                        'conference' => 'images/categories/conference.jpg',
                        'workshop' => 'images/categories/workshop.jpg',
                        'seminar' => 'images/categories/seminar.jpg',
                        'cultural' => 'images/categories/cultural.jpg',
                        'sports' => 'images/categories/sports.jpg',
                        'orientation' => 'images/categories/orientation.jpg',
                    ];

                    $gridItems = [];
                    foreach ($categories as $cat) {
                        $gridItems[] = [
                            'name' => $cat['name'],
                            'slug' => $cat['slug'],
                            'count' => $cat['event_count'] ?? 0,
                            'icon' => $catIcons[$cat['slug']] ?? 'folder',
                            'image' => $catImages[$cat['slug']] ?? null
                        ];
                    }
                ?>

                <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-6 md:grid md:grid-cols-2 lg:grid-cols-3 lg:gap-6 max-w-[1200px] mx-auto hide-scrollbar px-4 md:px-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $gridItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e($item['slug'] ? route('events.index', ['category' => $item['slug']]) : '#events'); ?>"
                            style="aspect-ratio: 16/9; min-height: 160px; opacity: 0;"
                            class="event-category-card snap-start shrink-0 w-[85%] md:w-auto group relative block rounded-2xl overflow-hidden <?php echo e($item['image'] ? 'bg-gray-900' : 'bg-gray-200'); ?> shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item['image']): ?>
                                <!-- Background Image -->
                                <img src="<?php echo e(asset($item['image'])); ?>" alt="<?php echo e($item['name']); ?>" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-[1.15] opacity-60 group-hover:opacity-80">
                            <?php else: ?>
                                <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-gray-800 to-gray-700 opacity-80 group-hover:opacity-100 transition-opacity"></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Glassmorphism Gradient Overlay -->
                            <div class="absolute inset-0 transition-opacity duration-500 opacity-40 group-hover:opacity-20"
                                 style="background: linear-gradient(to right, rgba(28,20,16,0.9) 0%, rgba(28,20,16,0.4) 100%);"></div>

                            <!-- Icon (Absolutely centered in the collapsed shape) -->
                            <div class="absolute top-0 left-0 flex items-center justify-center z-10 cat-icon-container pointer-events-none">
                                <i data-lucide="<?php echo e($item['icon']); ?>" class="w-8 h-8 lg:w-10 lg:h-10 text-white drop-shadow-md transition-transform duration-500 group-hover:scale-110"></i>
                            </div>

                            <!-- Expanding Text Content -->
                            <div class="absolute top-0 flex flex-col justify-center cat-text-container z-10 opacity-0 group-hover:opacity-100 transition-all duration-500 delay-75 transform -translate-x-4 group-hover:translate-x-0 pointer-events-none">
                                <h3 class="text-white text-xl lg:text-2xl font-black tracking-tight drop-shadow-lg leading-tight mb-1 whitespace-normal pr-2">
                                    <?php echo e($item['name']); ?>

                                </h3>
                                
                                <div class="inline-flex items-center gap-1.5 text-[#FFE381] text-xs lg:text-sm font-bold uppercase tracking-wider drop-shadow-md mt-1">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                    <span><?php echo e($item['count']); ?> sự kiện</span>
                                </div>
                            </div>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                    <!-- Inline View All Button -->
                    <a href="<?php echo e(route('events.index')); ?>"
                        style="opacity: 0;"
                        class="event-category-card group relative block bg-[#07A0C3] hover:bg-[#068ba9] shadow-md hover:shadow-2xl hover:z-50 cat-parallelogram-sm"
                        title="Xem tất cả danh mục">
                        
                        <!-- Icon -->
                        <div class="absolute top-0 left-0 flex items-center justify-center z-10 cat-sm-icon-container pointer-events-none">
                            <i data-lucide="plus" class="w-10 h-10 lg:w-12 lg:h-12 text-white drop-shadow-md transition-transform duration-500 group-hover:rotate-90"></i>
                        </div>

                        <!-- Expanding Text Content -->
                        <div class="absolute top-0 flex flex-col justify-center cat-sm-text-container z-10 opacity-0 group-hover:opacity-100 transition-all duration-500 delay-75 transform -translate-x-4 group-hover:translate-x-0 pointer-events-none">
                            <h3 class="text-white text-2xl lg:text-3xl font-black tracking-tight drop-shadow-lg leading-tight uppercase whitespace-nowrap">
                                Xem thêm
                            </h3>
                        </div>
                    </a>
                </div>

                <!-- Decorative bottom — nằm ngoài vùng GSAP animation -->
                <div class="mt-10 flex items-center justify-center gap-4 pointer-events-none select-none">
                    <div class="h-px flex-1 max-w-[120px]" style="background: linear-gradient(to right, transparent, rgba(7,160,195,0.2));"></div>
                    <span class="text-[10px] font-bold uppercase tracking-[0.3em]" style="color: rgba(122,106,82,0.3);">
                        <?php echo e($totalCount); ?> sự kiện đa dạng
                    </span>
                    <div class="h-px flex-1 max-w-[120px]" style="background: linear-gradient(to left, transparent, rgba(7,160,195,0.2));"></div>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                    gsap.registerPlugin(ScrollTrigger);
                    
                    const tl = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#events",
                            start: "top 80%", 
                            // Chỉ chạy 1 lần khi cuộn xuống, cuộn lên sẽ không bị ẩn đi gây rối mắt
                            toggleActions: "play none none none", 
                        }
                    });
                    
                    // Title fades in and slides up
                    tl.fromTo('.event-category-title', 
                        { opacity: 0, y: 30 }, 
                        { opacity: 1, y: 0, duration: 0.6, ease: "power2.out" }
                    )
                    // Cards slide up smoothly instead of bouncing
                    .fromTo('.event-category-card', 
                        { opacity: 0, y: 50, scale: 0.95 }, 
                        { opacity: 1, y: 0, scale: 1, duration: 0.8, stagger: 0.15, ease: "power3.out" }, 
                        "-=0.4"
                    );
                }
            });
        </script>
    </section>
    </div>

    <!-- Tĩnh anchor để fix lỗi nhảy trang của trình duyệt do GSAP -->
    <div id="master-wipe-anchor" style="scroll-margin-top: 72px;"></div>

    <!-- MASTER WIPE CONTAINER -->
    <div id="master-wipe-container"
        style="display: grid; grid-template-columns: 1fr; width: 100%; overflow-x: hidden; position: relative; z-index: 30;">

        <div style="grid-area: 1 / 1; width: 100%; height: 100%; z-index: 30;">
            <?php echo $__env->make('frontend.upcoming-mobile', ['upcoming' => $upcoming], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <!-- FEATURED EVENTS WRAPPER -->
        <div id="featured-events-wrapper" class="hidden lg:block"
            style="grid-area: 1 / 1; width: 100%; height: 100%; z-index: 40; background: #FFFBEA; transform: translateX(100%);">
            <section id="featured-events" class="relative z-10 h-full w-full pt-10 lg:pt-12 pb-16 overflow-hidden">
                <div class="mx-auto max-w-[1400px] px-6 lg:px-10 h-full flex flex-col justify-start">
                    <div class="mb-6 flex items-end justify-between shrink-0">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="h-7 w-1 rounded-full" style="background:#07A0C3;"></div>
                                <span class="text-xs font-bold uppercase tracking-[0.25em]" style="color:#07A0C3;">Featured
                                    Events</span>
                            </div>
                            <h2
                                class="font-barlow-condensed text-5xl font-black uppercase tracking-tight text-[#1C1410] lg:text-6xl">
                                Sự kiện nổi bật</h2>
                        </div>
                        <a href="#" class="hidden items-center gap-2 text-sm font-semibold lg:inline-flex transition-colors"
                            style="color:#07A0C3;" onmouseover="this.style.color='#04F06A'"
                            onmouseout="this.style.color='#07A0C3'">
                            Xem tất cả <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                        </a>
                    </div>

                    <!-- HORIZONTAL CARDS CONTAINER -->
                    <div id="featured-cards-viewport" class="flex-1 w-full min-h-[520px] overflow-hidden relative">
                        <div id="featured-cards-container"
                            class="flex gap-6 flex-nowrap absolute top-0 left-0 h-full items-center"
                            style="width: max-content; padding-right: 2rem;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_slice($featuredEvents, 0, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="shrink-0 featured-card-item rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300"
                                    style="width: 350px; height: 480px; max-width: 85vw;">
                                    <?php if (isset($component)) { $__componentOriginal07bdbe031a4c57e4cd3488994f94e999 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07bdbe031a4c57e4cd3488994f94e999 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.event-card','data' => ['event' => $ev,'mode' => 'grid']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('event-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['event' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ev),'mode' => 'grid']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07bdbe031a4c57e4cd3488994f94e999)): ?>
<?php $attributes = $__attributesOriginal07bdbe031a4c57e4cd3488994f94e999; ?>
<?php unset($__attributesOriginal07bdbe031a4c57e4cd3488994f94e999); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07bdbe031a4c57e4cd3488994f94e999)): ?>
<?php $component = $__componentOriginal07bdbe031a4c57e4cd3488994f94e999; ?>
<?php unset($__componentOriginal07bdbe031a4c57e4cd3488994f94e999); ?>
<?php endif; ?>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- MOBILE FEATURED EVENTS VIEW (Scrollable Container + Pagination) -->
        <div class="block lg:hidden px-4 pb-10 pt-6" style="background:#FFFBEA;"
             x-data="{
                items: <?php echo e(json_encode(collect($featuredEvents)->map(function($ev) {
                    return ['title' => $ev['title'], 'slug' => $ev['slug'], 'date' => $ev['date'], 'category' => $ev['category'] ?? 'Sự kiện', 'img' => $ev['img'] ?? 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80'];
                })->values())); ?>,
                perPage: 10,
                page: 0,
                get totalPages() { return Math.ceil(this.items.length / this.perPage); },
                get paged() { return this.items.slice(this.page * this.perPage, (this.page + 1) * this.perPage); },
                goTo(p) { this.page = p; this.$nextTick(() => { if(this.$refs.featScrollBox) this.$refs.featScrollBox.scrollTop = 0; }); }
             }">
            <!-- Tiêu đề -->
            <div class="mb-4">
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-6 w-1 rounded-full" style="background:#07A0C3;"></div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#07A0C3]">Featured Events</span>
                </div>
                <h2 class="font-barlow-condensed text-3xl font-black uppercase text-[#1C1410]">
                    Sự kiện nổi bật
                </h2>
            </div>

            <!-- Scrollable inner container -->
            <div class="relative rounded-2xl border border-black/5 bg-white/50" style="backdrop-filter: blur(4px);">
                <div x-ref="featScrollBox" class="overflow-y-auto px-2 py-2 flex flex-col gap-2.5" style="max-height: 340px; scrollbar-width: thin;">
                    <template x-for="(item, i) in paged" :key="page + '-' + i">
                        <a :href="'/events/' + item.slug" class="flex gap-3 items-center bg-white p-2.5 rounded-xl shadow-sm border border-black/5 active:scale-[0.98] transition-all shrink-0" style="text-decoration: none;">
                            <div class="w-[100px] h-[72px] shrink-0 rounded-lg overflow-hidden bg-gray-200">
                                <img :src="item.img" :alt="item.title" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#07A0C3]" x-text="item.category"></span>
                                <h3 class="font-bold text-[13px] text-[#1C1410] line-clamp-2 mt-0.5 leading-snug" x-text="item.title"></h3>
                                <div class="flex items-center gap-1.5 text-[11px] text-gray-500 mt-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="2"/><line x1="16" y1="2" x2="16" y2="6" stroke-width="2"/><line x1="8" y1="2" x2="8" y2="6" stroke-width="2"/><line x1="3" y1="10" x2="21" y2="10" stroke-width="2"/></svg>
                                    <span x-text="item.date"></span>
                                </div>
                            </div>
                        </a>
                    </template>
                </div>
                <!-- Bottom fade hint -->
                <div class="absolute bottom-0 left-0 right-0 h-8 rounded-b-2xl pointer-events-none" style="background: linear-gradient(to top, rgba(255,251,234,0.95), transparent);"></div>
            </div>

            <!-- Pagination -->
            <template x-if="totalPages > 1">
                <div class="flex items-center justify-center gap-2 mt-4">
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tiltCards = document.querySelectorAll('.hover-tilt');
            tiltCards.forEach(el => {
                let rect = null;
                el.addEventListener('mousemove', e => {
                    if(!rect) rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const deltaX = (x - centerX) / centerX;
                    const deltaY = (y - centerY) / centerY;
                    // Max tilt is 5 degrees
                    el.style.transform = `rotateX(${-deltaY * 5}deg) rotateY(${deltaX * 5}deg) scale3d(1.02, 1.02, 1.02)`;
                });
                el.addEventListener('mouseleave', () => {
                    rect = null; // Xóa cache khi chuột ra ngoài
                    el.style.transform = 'rotateX(0) rotateY(0) scale3d(1, 1, 1)';
                    el.style.transition = 'transform 0.5s ease-out';
                });
                el.addEventListener('mouseenter', () => {
                    rect = el.getBoundingClientRect(); // Cache lại rect
                    el.style.transition = 'none';
                });
            });

            // Sticky Categories Shadow Effect
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);
                ScrollTrigger.create({
                    trigger: '#categories-bar',
                    start: 'top 73px',
                    toggleClass: { targets: '#categories-bar', className: 'shadow-[0_10px_30px_-10px_rgba(0,0,0,0.1)]' }
                });
            }
        });
    </script>



    
    <div id="archive-delay-spacer"></div>
    <div id="archive-sticky-wrapper" style="background: #2D1F0A; position: relative; z-index: 50;">
    <?php $archiveJson = json_encode($archive); ?>
<section id="archive" class="relative overflow-hidden py-12 lg:py-16"
         style="background:linear-gradient(160deg,#2D1F0A 0%,#3D2A0E 50%,#1C2A10 100%); z-index: 50;"
         x-data="{ 
            yearIdx: 0, 
            eventIdx: 0,
            archive: <?php echo e($archiveJson); ?>, 
            dir: 1, 
            get currentYear() { return this.archive[this.yearIdx]; }, 
            get currentEvent() { return this.currentYear.events[this.eventIdx]; },
            go(d) {
                this.dir = d;
                let n = this.eventIdx + d;
                if(n >= 0 && n < this.currentYear.events.length) {
                    this.eventIdx = n;
                }
            },
            setYear(i) {
                this.dir = i > this.yearIdx ? 1 : -1;
                this.yearIdx = i;
                this.eventIdx = 0;
            }
         }">

    <!-- Warm glow blobs -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -left-32 top-1/4 h-[450px] w-[450px] rounded-full blur-[130px] opacity-25" style="background:#FFE381; transform: translateZ(0); will-change: transform;"></div>
        <div class="absolute -right-32 bottom-10 h-[350px] w-[350px] rounded-full blur-[130px] opacity-20" style="background:#07A0C3; transform: translateZ(0); will-change: transform;"></div>
        <div class="absolute left-1/2 bottom-0 h-40 w-[600px] -translate-x-1/2 rounded-full blur-[80px] opacity-15" style="background:#04F06A; transform: translateZ(0); will-change: transform;"></div>
        <!-- Thêm 1 blob trang trí phụ — giảm trống góc trên-phải -->
        <div class="absolute right-1/4 top-10 h-[200px] w-[200px] rounded-full blur-[100px] opacity-10" style="background:#E8C84A; transform: translateZ(0); will-change: transform;"></div>
    </div>
    <!-- Top border Jasmine -->
    <div class="absolute inset-x-0 top-0 h-1.5" style="background:#FFE381;"></div>

    <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">
        <div data-aos="fade-up" class="flex items-end justify-between">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-7 w-1 rounded-full" style="background:#FFE381;"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.25em]" style="color:#FFE381;">Archive</span>
                </div>
                <h2 class="font-barlow-condensed text-5xl font-black uppercase tracking-tight text-white lg:text-7xl">Kho lưu trữ sự kiện</h2>
                <p class="mt-3 max-w-md leading-relaxed" style="color:rgba(255,227,129,0.65);">
                    Từng năm. Từng đêm diễn. Từng ký ức được lưu lại để có thể sống lại bất cứ lúc nào.
                </p>
            </div>
            <div class="hidden gap-3 lg:flex">
                <button @click="go(-1)" :disabled="eventIdx === 0"
                    class="grid h-12 w-12 place-items-center rounded-full border-2 text-white/70 transition-all disabled:opacity-30"
                    style="border-color:rgba(255,227,129,0.3); background:rgba(255,227,129,0.05);"
                    onmouseover="this.style.borderColor='#FFE381';this.style.color='#FFE381'"
                    onmouseout="this.style.borderColor='rgba(255,227,129,0.3)';this.style.color='rgba(255,255,255,0.7)'">
                    <i data-lucide="chevron-left" class="h-5 w-5"></i>
                </button>
                <button @click="go(1)" :disabled="eventIdx === currentYear.events.length - 1"
                    class="grid h-12 w-12 place-items-center rounded-full border-2 text-white/70 transition-all disabled:opacity-30"
                    style="border-color:rgba(255,227,129,0.3); background:rgba(255,227,129,0.05);"
                    onmouseover="this.style.borderColor='#FFE381';this.style.color='#FFE381'"
                    onmouseout="this.style.borderColor='rgba(255,227,129,0.3)';this.style.color='rgba(255,255,255,0.7)'">
                    <i data-lucide="chevron-right" class="h-5 w-5"></i>
                </button>
            </div>
        </div>

        <div class="relative mt-14 grid grid-cols-1 gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16">
            <!-- Chữ số năm — Jasmine gradient & Buttons -->
            <div class="relative flex flex-col items-start z-10">
                <!-- Mobile Clean Header -->
                <div class="flex items-center gap-4 lg:hidden pl-4 pr-4 w-full">
                     <h3 class="font-barlow-condensed text-4xl font-black"
                         style="-webkit-text-fill-color:transparent;-webkit-background-clip:text;background-clip:text;
                                background-image:linear-gradient(160deg,#FFE381 30%,#E8C84A 70%,#07A0C3 100%);"
                         x-text="'NĂM ' + currentYear.year"></h3>
                     <div class="h-px flex-1" style="background:rgba(255,227,129,0.2);"></div>
                </div>

                <!-- Desktop Huge Text -->
                <div class="hidden lg:block font-barlow-condensed font-black leading-[0.85] tracking-tighter text-[18vw] pl-6 pr-4"
                     style="-webkit-text-fill-color:transparent;-webkit-background-clip:text;background-clip:text;
                            background-image:linear-gradient(160deg,#FFE381 30%,#E8C84A 70%,#07A0C3 100%);"
                     x-text="currentYear.year"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-10"
                     x-transition:enter-end="opacity-100 translate-y-0"></div>

                <div class="mt-6 pl-6 hidden lg:block">
                    <a :href="'<?php echo e(route('archive')); ?>?year=' + currentYear.year" class="inline-flex items-center gap-2 rounded-full px-6 py-3 text-sm font-bold transition-all hover:scale-105"
                       style="background:#FFE381; color:#1C1410;">
                        Xem chi tiết năm <span x-text="currentYear.year"></span> <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </a>
                </div>

                <!-- Year tabs -->
                <div class="mt-5 lg:mt-7 flex overflow-x-auto hide-scrollbar items-center gap-2 pl-4 pr-4 lg:pl-6 pb-2 w-full max-w-[100vw]">
                    <template x-for="(a,i) in archive" :key="a.year">
                        <button @click="setYear(i)"
                            class="rounded-full px-4 py-1.5 text-sm font-bold font-mono transition-all shrink-0"
                            :style="i===yearIdx
                                ? 'background:#FFE381;color:#1C1410;box-shadow:0 4px 12px rgba(255,227,129,0.4);'
                                : 'background:rgba(255,227,129,0.08);color:rgba(255,227,129,0.45);'">
                            <span x-text="a.year"></span>
                        </button>
                    </template>
                </div>

                <!-- Timeline mini strip -->
                <div class="mt-10 pl-4 lg:pl-6 pr-4 hidden lg:block">
                    <div class="relative border-l-2 space-y-4" style="border-color: rgba(255,227,129,0.2);">
                        <template x-for="(a, i) in archive" :key="a.year">
                            <div class="relative pl-5 cursor-pointer" @click="setYear(i)">
                                <!-- Timeline dot -->
                                <div class="absolute -left-[5px] top-1.5 h-2 w-2 rounded-full transition-all duration-300"
                                     :style="i === yearIdx 
                                        ? 'background:#FFE381; box-shadow:0 0 8px rgba(255,227,129,0.6); transform:scale(1.5);' 
                                        : 'background:rgba(255,227,129,0.25);'"></div>
                                
                                <div class="text-xs font-bold font-mono transition-colors duration-300"
                                     :style="i === yearIdx ? 'color:#FFE381;' : 'color:rgba(255,227,129,0.35);'"
                                     x-text="a.year + ' · ' + (a.achievements[0] || '')"></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div>
                <div class="rounded-2xl lg:rounded-none overflow-hidden lg:overflow-visible mx-4 lg:mx-0" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 227, 129, 0.05);">
                    <a :href="currentEvent.featured_url" class="group relative block h-[220px] lg:rounded-2xl lg:h-[360px]"
                         style="box-shadow:0 20px 60px rgba(255,227,129,0.15);">
                        <img :src="currentEvent.img" :alt="currentEvent.featured_title" loading="lazy"
                             class="h-full w-full object-cover transition-transform duration-[1500ms] group-hover:scale-105" />
                        <div class="absolute inset-0"
                             style="background:linear-gradient(to top,rgba(45,31,10,0.92) 0%,rgba(45,31,10,0.25) 60%,transparent 100%);"></div>
                        <!-- Jasmine accent bar -->
                        <div class="absolute bottom-0 left-0 right-0 h-1.5" style="background:#FFE381;"></div>
                        <!-- Tiêu đề trên PC -->
                        <div class="absolute bottom-6 left-5 right-5 z-20 hidden lg:block">
                            <div class="block w-fit">
                                <h3 class="font-barlow-condensed text-2xl font-black uppercase tracking-wide text-white lg:text-4xl transition-colors group-hover:text-[#FFE381]"
                                    x-text="currentEvent.featured_title"></h3>
                            </div>
                        </div>
                    </a>

                    <!-- Card Body cho Mobile & PC -->
                    <div class="p-5 lg:p-0 lg:mt-5">
                        <!-- Tiêu đề trên Mobile -->
                        <h3 class="font-barlow-condensed text-2xl font-black uppercase tracking-wide text-white transition-colors lg:hidden"
                            x-text="currentEvent.featured_title"></h3>
                            
                        <p class="mt-3 lg:mt-0 text-sm leading-relaxed lg:text-lg" style="color:rgba(255,227,129,0.7);" x-text="currentEvent.desc"></p>

                        <!-- Thống kê tinh gọn cho Mobile -->
                        <div class="mt-4 flex flex-wrap items-center gap-4 lg:hidden">
                            <!-- Stat: Số sự kiện -->
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar-check" class="h-4 w-4" style="color:#FFE381;"></i>
                                <span class="text-xs font-bold text-white" x-text="currentYear.achievements[0]"></span>
                            </div>
                            <!-- Separator -->
                            <div class="h-3 w-px bg-white/20"></div>
                            <!-- Stat: Năm hoạt động -->
                            <div class="flex items-center gap-2">
                                <i data-lucide="history" class="h-4 w-4" style="color:#07A0C3;"></i>
                                <span class="text-xs font-bold text-white" x-text="currentYear.year"></span>
                            </div>
                        </div>

                        <!-- Thống kê gốc cho PC -->
                        <div class="mt-5 hidden lg:flex flex-wrap gap-4">
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(255,227,129,0.12); border:1px solid rgba(255,227,129,0.25);">
                                    <i data-lucide="calendar-check" class="h-4 w-4" style="color:#FFE381;"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-bold uppercase tracking-widest" style="color:rgba(255,227,129,0.5);">Tổ chức</div>
                                    <div class="text-sm font-bold text-white" x-text="currentYear.achievements[0]"></div>
                                </div>
                            </div>
                            <div class="h-auto w-px self-stretch" style="background:rgba(255,227,129,0.15);"></div>
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(7,160,195,0.12); border:1px solid rgba(7,160,195,0.25);">
                                    <i data-lucide="history" class="h-4 w-4" style="color:#07A0C3;"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-bold uppercase tracking-widest" style="color:rgba(7,160,195,0.5);">Năm hoạt động</div>
                                    <div class="text-sm font-bold text-white" x-text="currentYear.year"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Tags (chỉ PC) -->
                        <div class="mt-5 hidden lg:grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <template x-for="achieve in currentYear.achievements" :key="achieve">
                                <div class="rounded-xl px-4 py-3 text-sm font-medium text-white"
                                     style="background:rgba(255,227,129,0.10); border:1px solid rgba(255,227,129,0.25);"
                                     x-text="achieve"></div>
                            </template>
                        </div>

                        <!-- Action Bar cho Mobile -->
                        <div class="mt-6 flex items-center justify-between lg:hidden border-t border-[#FFE381]/10 pt-4">
                            <a :href="'<?php echo e(route('archive')); ?>?year=' + currentYear.year" class="inline-flex items-center gap-2 rounded-full px-5 py-2 text-xs font-bold transition-all"
                               style="background:#FFE381; color:#1C1410;">
                                Xem thêm <i data-lucide="arrow-right" class="h-3 w-3"></i>
                            </a>
                            
                            <div class="flex gap-2">
                                <button @click="go(-1)" :disabled="eventIdx === 0"
                                    class="grid h-9 w-9 place-items-center rounded-full border border-[#FFE381]/30 disabled:opacity-30">
                                    <i data-lucide="chevron-left" class="h-4 w-4 text-white"></i>
                                </button>
                                <button @click="go(1)" :disabled="eventIdx === currentYear.events.length - 1"
                                    class="grid h-9 w-9 place-items-center rounded-full border border-[#FFE381]/30 disabled:opacity-30">
                                    <i data-lucide="chevron-right" class="h-4 w-4 text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="h-[10vh]"></div>

    <!-- Bottom border jasmine accent -->
    <div class="absolute inset-x-0 bottom-0 h-1" style="background: linear-gradient(to right, transparent, rgba(255,227,129,0.4), transparent);"></div>
</section>


<div id="media-sticky-wrapper" style="background: #FFF3C4; position: relative; z-index: 60;">
<?php $mediaJson = json_encode($media); ?>
<section id="media" class="relative overflow-hidden py-8 lg:py-10" style="background:#FFF3C4; z-index: 60;"
         x-data="mediaPlayer(<?php echo e($mediaJson); ?>)" x-init="initPlayer()">
    <!-- Top Jasmine border -->
    <div class="absolute inset-x-0 top-0 h-1.5" style="background:#FFE381;"></div>
    <!-- Subtle accent blobs -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute right-0 top-0 h-80 w-80 rounded-full blur-[120px] opacity-30" style="background:#07A0C3;"></div>
        <div class="absolute -left-20 bottom-0 h-64 w-64 rounded-full blur-[100px] opacity-20" style="background:#04F06A;"></div>
        <!-- Blob trang trí phụ — lấp khoảng trống giữa -->
        <div class="absolute left-1/3 top-1/2 h-[180px] w-[180px] rounded-full blur-[100px] opacity-15" style="background:#FFE381;"></div>
    </div>

    <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">
        <div data-aos="fade-up" class="flex items-end justify-between pb-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-7 w-1 rounded-full" style="background:#04F06A;"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.25em]" style="color:#04B050;">Media</span>
                </div>
                <h2 class="font-barlow-condensed text-4xl font-black uppercase tracking-tight text-[#1C1410] lg:text-5xl">Album & Recap</h2>
            </div>
            <a href="#" class="group inline-flex items-center gap-1.5 text-sm font-semibold text-[#07A0C3] transition-colors hover:text-[#04F06A]">
                Thư viện đầy đủ <i data-lucide="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <template x-if="items.length > 0">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left Side: Main Player -->
                <div class="lg:col-span-8 bg-black rounded-2xl overflow-hidden relative" style="box-shadow:0 16px 50px rgba(7,160,195,0.15); height: 380px;">
                    <template x-for="(item, index) in items" :key="index">
                        <div x-show="currentIndex === index" 
                             x-transition:enter="transition ease-out duration-700 transform"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-300 transform"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-105"
                             class="absolute inset-0 flex items-center justify-center">
                            <template x-if="item.type === 'video'">
                                <video :src="item.src" class="w-full h-full object-contain" autoplay muted playsinline @ended="next()"></video>
                            </template>
                            <template x-if="item.type === 'image'">
                                <img :src="item.src" :alt="item.title" class="w-full h-full object-contain" />
                            </template>
                        </div>
                    </template>
                    
                    <!-- THÊM MỚI — Counter và label media, chèn trong player box, sau progress bar -->
                    <div class="absolute top-4 left-4 z-20 flex items-center gap-2">
                        <div class="flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold shadow-md"
                             style="background:rgba(0,0,0,0.55); color:white; backdrop-filter:blur(6px);">
                            <span x-text="currentIndex + 1"></span>
                            <span style="color:rgba(255,255,255,0.4);">/</span>
                            <span x-text="items.length"></span>
                        </div>
                        <div class="rounded-full px-3 py-1 text-xs font-bold shadow-md"
                             style="background:rgba(255,227,129,0.85); color:#1C1410;"
                             x-text="currentItem.type === 'video' ? '▶ Video' : '🖼 Ảnh'"></div>
                    </div>

                    <!-- Progress Bar at the bottom of the player -->
                    <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-black/50 z-20">
                        <div class="h-full bg-[#07A0C3] transition-all duration-100" :style="`width: ${progress}%`"></div>
                    </div>
                </div>

                <!-- Right Side: Info and Thumbnails -->
                <div class="lg:col-span-4 flex flex-col gap-4 h-auto lg:h-[380px]">
                    <!-- Top Info Box (2/3) -->
                    <div class="flex-1 rounded-2xl p-6 flex flex-col justify-center relative overflow-hidden group" style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(12px); box-shadow: 0 4px 20px rgba(255,200,60,0.15); border: 1px solid rgba(255, 227, 129, 0.5);">
                        <div class="mb-4 inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.25em] text-[#1C1410]" style="background:#FFE381;" x-text="currentItem.type === 'video' ? 'Video' : 'Hình ảnh'"></div>
                        
                        <h3 class="font-barlow-condensed text-2xl lg:text-3xl font-bold tracking-tight text-[#1C1410] leading-snug line-clamp-3" x-text="currentItem.title"></h3>
                        
                        <div class="mt-4 flex items-center gap-2">
                            <div class="h-10 w-1 rounded-full" style="background:#04F06A;"></div>
                            <a :href="currentItem.event_url" class="text-sm font-semibold text-[#7A6A52] hover:text-[#07A0C3] transition-colors" x-text="currentItem.event_name"></a>
                        </div>

                        <!-- THÊM MỚI — Nút xem tất cả + progress dots, chèn cuối info box bên phải -->
                        <div class="mt-auto pt-3 flex items-center justify-between">
                            <!-- Dots indicator -->
                            <div class="flex gap-1.5 items-center">
                                <template x-for="(item, i) in items.slice(0, Math.min(items.length, 8))" :key="i">
                                    <div class="rounded-full transition-all duration-300"
                                         :style="i === currentIndex 
                                            ? 'width:1.25rem; height:0.35rem; background:#07A0C3;' 
                                            : 'width:0.35rem; height:0.35rem; background:rgba(7,160,195,0.25);'"></div>
                                </template>
                                <span x-show="items.length > 8" class="text-[10px] font-bold ml-1" style="color:rgba(122,106,82,0.5);"
                                      x-text="'+' + (items.length - 8)"></span>
                            </div>
                            <!-- Link xem thêm -->
                            <a href="<?php echo e(route('events.index')); ?>" class="text-xs font-bold uppercase tracking-widest transition-colors"
                               style="color:rgba(7,160,195,0.7);"
                               onmouseover="this.style.color='#04F06A'" onmouseout="this.style.color='rgba(7,160,195,0.7)'">
                                Xem tất cả &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Bottom Thumbnails (1/3) -->
                    <div class="h-[120px] grid grid-cols-3 gap-3">
                        <template x-for="i in 3" :key="i">
                            <div class="rounded-xl overflow-hidden cursor-pointer relative group bg-black" 
                                 @click="goToItem(getThumbIndex(i))"
                                 :class="getThumbIndex(i) === currentIndex ? 'ring-2 ring-[#07A0C3]' : ''">
                                <template x-if="items[getThumbIndex(i)]">
                                    <template x-if="items[getThumbIndex(i)].type === 'video'">
                                        <video :src="items[getThumbIndex(i)].src" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 opacity-60 group-hover:opacity-100"></video>
                                    </template>
                                </template>
                                <template x-if="items[getThumbIndex(i)]">
                                    <template x-if="items[getThumbIndex(i)].type === 'image'">
                                        <img :src="items[getThumbIndex(i)].src" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 opacity-60 group-hover:opacity-100" />
                                    </template>
                                </template>
                                
                                <template x-if="items[getThumbIndex(i)] && items[getThumbIndex(i)].type === 'video'">
                                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                        <div class="grid h-8 w-8 place-items-center rounded-full bg-white/80 text-[#1C1410] shadow-sm">
                                            <i data-lucide="play" class="h-3 w-3 translate-x-0.5"></i>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mediaPlayer', (mediaItems) => ({
                items: mediaItems || [],
                currentIndex: 0,
                progress: 0,
                timer: null,
                duration: 5000,
                intervalStep: 50,
                
                get currentItem() {
                    return this.items[this.currentIndex] || {};
                },
                
                initPlayer() {
                    if (this.items.length === 0) return;
                    this.startMedia();
                },
                
                startMedia() {
                    this.stopTimer();
                    this.progress = 0;
                    
                    if (this.currentItem.type === 'image') {
                        // Image timer logic
                        this.timer = setInterval(() => {
                            this.progress += (this.intervalStep / this.duration) * 100;
                            if (this.progress >= 100) {
                                this.next();
                            }
                        }, this.intervalStep);
                        
                        // Pause videos
                        this.$nextTick(() => {
                            const videos = this.$root.querySelectorAll('video');
                            videos.forEach(v => v.pause());
                        });
                        
                    } else if (this.currentItem.type === 'video') {
                        // For video, progress bar is handled by the video element's timeupdate
                        this.$nextTick(() => {
                            const videos = this.$root.querySelectorAll('video');
                            videos.forEach(v => {
                                if (v.getAttribute('src') === this.currentItem.src) {
                                    v.currentTime = 0;
                                    v.play().catch(e => console.log('Autoplay blocked', e));
                                    v.ontimeupdate = () => {
                                        if (v.duration) {
                                            this.progress = (v.currentTime / v.duration) * 100;
                                        }
                                    };
                                } else {
                                    v.pause();
                                }
                            });
                        });
                    }
                },
                
                stopTimer() {
                    if (this.timer) {
                        clearInterval(this.timer);
                        this.timer = null;
                    }
                },
                
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.items.length;
                    this.startMedia();
                },
                
                goToItem(index) {
                    if (index === this.currentIndex || index >= this.items.length) return;
                    this.currentIndex = index;
                    this.startMedia();
                },
                
                getThumbIndex(offset) {
                    if (this.items.length === 0) return 0;
                    return (this.currentIndex + offset) % this.items.length;
                }
            }));
        });
    </script>
    
    <!-- Bottom gradient line -->
    <div class="absolute inset-x-0 bottom-0 h-1" style="background: linear-gradient(to right, transparent, rgba(4,240,106,0.3), rgba(7,160,195,0.3), transparent);"></div>
</section>
</div>





<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend-mobile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/frontend/home-mobile.blade.php ENDPATH**/ ?>