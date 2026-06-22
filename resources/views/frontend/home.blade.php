@extends('layouts.frontend')

@section('content')

{{-- ════════════════════════════════════════
     HERO SLIDER
     Overlay ấm — jasmine tint thay vì lạnh xanh
════════════════════════════════════════════ --}}
<section id="top" class="relative h-[100svh] w-full overflow-hidden" style="background:#1C1410;">
<<<<<<< HEAD

=======
    {{-- Continuous Timer bar at the very top --}}
    <div class="absolute top-0 left-0 w-full h-1 z-[60]" style="background: rgba(255, 255, 255, 0.2);">
        <div id="progressBar" class="h-full bg-[#FFE381] w-0 transition-none"></div>
    </div>
>>>>>>> origin/kien
    
    <div class="slider-wrapper" id="slider">
        <div class="bg-layers" id="bgLayers">
            @foreach($slides as $i => $slide)
            <div class="bg-layer {{ $i === 0 ? 'active' : 'idle' }}" data-index="{{ $i }}"
                 style="background-image:url('{{ $slide['image'] }}')"></div>
            @endforeach
        </div>
        {{-- Overlay --}}
        <div class="slider-overlay"
             style="background:linear-gradient(110deg,rgba(255,200,60,0.50) 0%,rgba(28,20,16,0.55) 50%,rgba(7,160,195,0.15) 100%);"></div>
        <div class="slider-content">
            <div class="slide-info is-active" id="slideInfo">
                <div class="slide-eyebrow" id="slideEyebrow">{{ $slides[0]['eyebrow'] }}</div>
                <h1 class="slide-title" id="slideTitle">{{ $slides[0]['title'] }}</h1>
                <p class="slide-desc" id="slideDesc">{{ $slides[0]['description'] }}</p>
                <div class="slide-actions">
                    <button class="btn-play" aria-label="Xem video">
                        <svg viewBox="0 0 16 16"><polygon points="3,1 13,8 3,15"/></svg>
                    </button>
                    <a href="{{ $slides[0]['cta_url'] }}" class="btn-cta" id="slideCta">{{ $slides[0]['cta_label'] }}</a>
                </div>
            </div>
            <div class="card-strip" id="cardStrip">
                <div class="card-track" id="cardTrack">
                    {{-- Rendered by JS --}}
                </div>
            </div>
        </div>
        </div>
    </div>
    <script>
    (function(){
        const slides = @json($slides), total = slides.length;
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

        /* ─── Card helpers ─── */
        function liveCards() { return Array.from(cardTrack.querySelectorAll('.dest-card')); }

        function makeCard(slideIdx) {
            const sl   = slides[slideIdx];
            const card = document.createElement('div');
            card.className     = 'dest-card';
            card.dataset.index = slideIdx;
            card.innerHTML =
                `<img src="${sl.image}" alt="${sl.title}" loading="lazy">` +
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

<<<<<<< HEAD
                const computedShadow = window.getComputedStyle(targetCard).boxShadow;

=======
>>>>>>> origin/kien
                const clone = document.createElement('div');
                clone.style.cssText =
                    'position:absolute;' +
                    `top:${cRect.top - sRect.top}px;` +
                    `left:${cRect.left - sRect.left}px;` +
                    `width:${cRect.width}px;height:${cRect.height}px;` +
                    `background-image:url('${slides[nextSlideIdx].image}');` +
                    'background-size:cover;background-position:center;' +
<<<<<<< HEAD
                    `box-shadow:${computedShadow};` +
=======
>>>>>>> origin/kien
                    'border-radius:20px;z-index:0;pointer-events:none;' +
                    'transition:top 750ms cubic-bezier(0.4,0,0.2,1),' +
                               'left 750ms cubic-bezier(0.4,0,0.2,1),' +
                               'width 750ms cubic-bezier(0.4,0,0.2,1),' +
                               'height 750ms cubic-bezier(0.4,0,0.2,1),' +
<<<<<<< HEAD
                               'box-shadow 750ms cubic-bezier(0.4,0,0.2,1),' +
=======
>>>>>>> origin/kien
                               'border-radius 750ms cubic-bezier(0.4,0,0.2,1);';
                sliderEl.appendChild(clone);

                bgLayers[prev].classList.remove('active');
                bgLayers[prev].classList.add('leaving');

                requestAnimationFrame(() => requestAnimationFrame(() => {
                    clone.style.top = '0'; clone.style.left = '0';
                    clone.style.width = '100%'; clone.style.height = '100%';
                    clone.style.borderRadius = '0';
<<<<<<< HEAD
                    clone.style.boxShadow = '0 0 0 0 rgba(255,227,129,0), 0 28px 72px rgba(0,0,0,0)';
=======
>>>>>>> origin/kien
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
            // 1. Record original positions
            const cards = Array.from(cardTrack.children);
            const firstRects = new Map();
            cards.forEach(c => firstRects.set(c.dataset.index, c.getBoundingClientRect()));

            // 2. Extract the clicked card from queue, keep others intact, push to end
            queue.splice(jumpQueueIndex, 1);
            queue.push(nextSlideIdx);

            // 3. Rebuild track completely
            cardTrack.innerHTML = '';
            const count = Math.min(MAX_CARDS, queue.length);
            for (let i = 0; i < count; i++) {
                cardTrack.appendChild(makeCard(queue[i]));
            }

            // 4. Invert and Play (FLIP) for smooth sliding
            const newCards = Array.from(cardTrack.children);
            newCards.forEach(c => {
                if (parseInt(c.dataset.index) === nextSlideIdx) {
                    return; // Bỏ qua animation bay từ trái qua phải cho thẻ vừa click
                }

                const firstRect = firstRects.get(c.dataset.index);
                if (firstRect) {
                    const lastRect = c.getBoundingClientRect();
                    const dx = firstRect.left - lastRect.left;
                    if (dx !== 0) {
                        c.style.transition = 'none';
                        c.style.transform = `translateX(${dx}px)`;
                        requestAnimationFrame(() => requestAnimationFrame(() => {
                            c.style.transition = 'transform 550ms cubic-bezier(0.4,0,0.2,1)';
                            c.style.transform = 'translateX(0px)';
                        }));
                    }
                } else {
                    // New card sliding in from right
                    const dx = (jumpQueueIndex + 1) * STEP;
                    c.style.transition = 'none';
                    c.style.transform = `translateX(${dx}px)`;
                    requestAnimationFrame(() => requestAnimationFrame(() => {
                        c.style.transition = 'transform 550ms cubic-bezier(0.4,0,0.2,1)';
                        c.style.transform = 'translateX(0px)';
                    }));
                }
            });

            markFirstActive();

            /* --- Update text --- */
            slideInfo.classList.remove('is-active');
            setTimeout(() => {
                slideEyebrow.textContent = slides[current].eyebrow;
                slideTitle.textContent   = slides[current].title;
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

{{-- ════════════════════════════════════════
     STATS — Nền Jasmine đậm, accent xanh
     Cầu nối từ slider tối → body ấm
════════════════════════════════════════════ --}}
<section class="relative overflow-hidden" style="background:#FFE381;">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute right-0 top-0 h-64 w-64 rounded-full opacity-20 blur-3xl" style="background:#07A0C3;"></div>
        <div class="absolute left-0 bottom-0 h-48 w-48 rounded-full opacity-15 blur-2xl" style="background:#04F06A;"></div>
    </div>
    <div class="relative mx-auto grid max-w-[1400px] grid-cols-2 lg:grid-cols-4">
        @foreach($stats as $i => $s)
        <div data-aos="fade-up" data-aos-delay="{{ $i * 100 }}"
             class="flex flex-col items-center justify-center py-16 {{ $i < 3 ? 'border-r border-black/10' : '' }}">
            <div class="font-['Barlow'] text-6xl font-black text-[#1C1410] lg:text-7xl">
                <span x-data="{ count:0,target:{{ $s['value'] }},decimals:{{ $s['decimals'] }},started:false }"
                      x-intersect.once="started=true;let step=target/60;let t=setInterval(()=>{count+=step;if(count>=target){count=target;clearInterval(t);}},30)"
                      x-text="decimals?count.toFixed(decimals):Math.round(count).toLocaleString()">0</span>{{ $s['suffix'] }}
            </div>
            <div class="mt-2 h-1 w-10 rounded-full" style="background:#07A0C3;"></div>
            <div class="mt-2 text-xs font-bold uppercase tracking-[0.25em] text-[#1C1410]/60">{{ $s['label'] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- ════════════════════════════════════════
     FEATURED EVENTS + UPCOMING — Nền kem Jasmine nhạt
════════════════════════════════════════════ --}}
<section id="events" class="relative py-24 lg:py-32" style="background:#FFFBEA;">
    <!-- Horizontal accent line top -->
    <div class="absolute inset-x-0 top-0 h-0.5" style="background:#FFE381;"></div>

    <div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-8 px-6 lg:grid-cols-[1fr_460px] lg:gap-10 lg:px-10 xl:grid-cols-[1fr_500px]">

        {{-- ── Featured Events ── --}}
        <div>
            <div data-aos="fade-up" class="mb-10 flex items-end justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-7 w-1 rounded-full" style="background:#07A0C3;"></div>
                        <span class="text-xs font-bold uppercase tracking-[0.25em]" style="color:#07A0C3;">Featured Events</span>
                    </div>
                    <h2 class="font-['Barlow'] text-5xl font-black uppercase tracking-tight text-[#1C1410] lg:text-6xl">Sự kiện nổi bật</h2>
                </div>
                <a href="#" class="hidden items-center gap-2 text-sm font-semibold lg:inline-flex transition-colors"
                   style="color:#07A0C3;" onmouseover="this.style.color='#04F06A'" onmouseout="this.style.color='#07A0C3'">
                    Xem tất cả <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach($featuredEvents as $i => $ev)
                <article data-aos="fade-up" data-aos-delay="{{ $i * 60 }}"
                         x-data="{ animClass: '' }"
                         @mouseenter="animClass = 'hover-anim-' + (Math.floor(Math.random() * 3) + 1)"
                         @mouseleave="animClass = ''"
                         :class="animClass"
                         class="group relative flex flex-col overflow-hidden rounded-2xl transition-all duration-500 hover:-translate-y-1"
                         style="background:#FFF8D0; box-shadow:0 2px 16px rgba(255,227,129,0.4);"
                         onmouseover="this.style.boxShadow='0 12px 40px rgba(7,160,195,0.18)'"
                         onmouseout="this.style.boxShadow='0 2px 16px rgba(255,227,129,0.4)'">
                    
                    <!-- Color Sweep Layer -->
                    <div class="sweep-bg"></div>

                    <div class="relative z-10 h-48 w-full shrink-0 overflow-hidden">
                        <a href="{{ route('events.show', $ev['slug'] ?? '#') }}" class="block h-full w-full">
                            <img src="{{ $ev['img'] }}" alt="{{ $ev['title'] }}" loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        </a>
                        <!-- Bottom accent bar -->
                        <div class="absolute bottom-0 left-0 right-0 h-1" style="background:#FFE381;"></div>
                        <!-- Category badge -->
                        <div class="absolute left-3 top-3">
                            <span class="rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-[#1C1410] shadow-md"
                                  style="background:#FFE381;">{{ $ev['category'] }}</span>
                        </div>
                    </div>
                    <div class="relative z-10 flex flex-1 flex-col justify-between p-5">
                        <div>
<<<<<<< HEAD
                            <h3 class="font-['Barlow_Condensed'] text-2xl font-black uppercase leading-tight tracking-wide text-[#1C1410] transition-colors group-hover:text-[#07A0C3]">
                                <a href="{{ route('events.show', $ev['slug'] ?? '#') }}">
                                    {{ $ev['title'] }}
                                </a>
                            </h3>
                            <div class="mt-3 flex flex-col gap-1.5 text-sm text-[#7A6A52]">
                                <p class="line-clamp-3">{{ $ev['summary'] ?? '' }}</p>
                            </div>
                        </div>
=======
                            <h3 class="font-['Barlow'] text-2xl font-black uppercase leading-tight tracking-wide text-[#1C1410] transition-colors group-hover:text-[#07A0C3]">
                                {{ $ev['title'] }}
                            </h3>
                            <div class="mt-3 flex flex-col gap-1.5 text-sm text-[#7A6A52]">
                                <span class="inline-flex items-center gap-2">
                                    <i data-lucide="calendar" class="h-4 w-4" style="color:#07A0C3;"></i> {{ $ev['date'] }}
                                </span>
                                <span class="inline-flex items-center gap-2">
                                    <i data-lucide="map-pin" class="h-4 w-4" style="color:#04F06A;"></i> <span class="truncate">{{ $ev['location'] }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="mt-5 flex items-center gap-4">
                            <a href="#"
                               class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-bold text-white shadow transition-all hover:shadow-md hover:-translate-y-0.5"
                               style="background:#07A0C3;">
                                Xem chi tiết <i data-lucide="arrow-up-right" class="h-3 w-3"></i>
                            </a>
                        </div>
>>>>>>> origin/kien
                    </div>
                </article>
                @endforeach
            </div>
        </div>

        {{-- ── Upcoming Events ── --}}
        <aside class="lg:sticky lg:top-28 lg:self-start">
            <div data-aos="fade-left" class="overflow-hidden rounded-2xl shadow-xl"
                 style="border:2px solid #FFE381;">
                {{-- Header Jasmine --}}
                <div class="relative overflow-hidden px-6 py-6" style="background:#FFE381;">
                    <div class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full opacity-30" style="background:#07A0C3;"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <div class="text-xs font-bold uppercase tracking-[0.25em] text-[#7A6A52]">Upcoming</div>
                            <h3 class="font-['Barlow'] mt-0.5 text-3xl font-black uppercase tracking-wide text-[#1C1410]">Sắp diễn ra</h3>
                        </div>
                        <div class="flex items-center gap-2 rounded-full bg-white/60 px-3 py-1.5 text-xs font-bold text-[#1C1410] backdrop-blur">
                            <span class="h-2 w-2 animate-pulse rounded-full" style="background:#07A0C3;"></span>Live
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="px-3 pt-12 pb-5" style="background:#FFFBEA;">
                    <div class="relative py-2">
                        <!-- Center Line -->
                        <div class="absolute bottom-0 top-0 w-px" style="left:50%;transform:translateX(-50%);background:rgba(0,0,0,0.12);"></div>

                        <div class="-space-y-12 sm:-space-y-20">
                            @foreach($upcoming as $i => $u)
                            {{-- Row: full width flex, each half is exactly 50% --}}
                            <div class="relative flex w-full items-start" style="min-height:88px;" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">

                                <!-- Dot on center line -->
                                <div class="absolute z-10 h-3.5 w-3.5 rounded-full"
                                     style="left:50%;top:26px;transform:translate(-50%,-50%);border:3px solid #FFFBEA;{{ $u['open'] ? 'background:#07A0C3;' : 'background:#d1c9a8;' }}"></div>

                                @if($i % 2 == 0)
                                {{-- === LEFT side: text top, imgs bottom --}}
                                <div style="width:50%;padding-right:16px;" class="flex flex-col items-end justify-start text-right">
                                    <div class="mb-3">
                                        <a href="{{ route('events.show', $u['slug'] ?? '#') }}" class="mt-0.5 text-sm font-black uppercase text-[#1C1410] leading-snug hover:text-[#07A0C3] transition-colors inline-block">{{ $u['name'] }}</a>
                                        <p class="mt-2 text-xs text-[#7A6A52] line-clamp-2">{{ $u['summary'] ?? '' }}</p>
                                    </div>
                                    @if(isset($u['images']) && count($u['images']) > 0)
                                    <div class="relative shrink-0" style="width:170px;height:120px;">
                                        @if(count($u['images']) > 1)
                                        <div style="position:absolute;left:0;top:0;width:140px;height:100px;z-index:1;">
                                            <img src="{{ $u['images'][0] }}" style="position:absolute;left:0;top:8px;width:100%;height:100%;border-radius:12px;object-fit:cover;filter:blur(12px) saturate(1.5);opacity:0.6;transform:scale(0.92);">
                                            <img src="{{ $u['images'][0] }}" style="position:absolute;left:0;top:0;width:100%;height:100%;border-radius:12px;object-fit:cover;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                                        </div>
                                        <div style="position:absolute;right:0;bottom:0;width:100px;height:70px;z-index:2;transition:transform .2s;"
                                             onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                                            <img src="{{ $u['images'][1] }}" style="position:absolute;left:0;top:6px;width:100%;height:100%;border-radius:8px;object-fit:cover;filter:blur(10px) saturate(1.5);opacity:0.6;transform:scale(0.92);">
                                            <img src="{{ $u['images'][1] }}" style="position:absolute;left:0;top:0;width:100%;height:100%;border-radius:8px;object-fit:cover;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                                        </div>
                                        @else
                                        <div style="position:absolute;right:0;top:0;width:170px;height:119px;z-index:1;">
                                            <img src="{{ $u['images'][0] }}" style="position:absolute;left:0;top:10px;width:100%;height:100%;border-radius:12px;object-fit:cover;filter:blur(14px) saturate(1.5);opacity:0.6;transform:scale(0.92);">
                                            <img src="{{ $u['images'][0] }}" style="position:absolute;left:0;top:0;width:100%;height:100%;border-radius:12px;object-fit:cover;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div style="width:50%;"></div>

                                @else
                                {{-- === RIGHT side: center | text top, imgs bottom --}}
                                <div style="width:50%;"></div>
                                <div style="width:50%;padding-left:16px;" class="flex flex-col items-start justify-start text-left">
                                    <div class="mb-3">
                                        <a href="{{ route('events.show', $u['slug'] ?? '#') }}" class="mt-0.5 text-sm font-black uppercase text-[#1C1410] leading-snug hover:text-[#07A0C3] transition-colors inline-block">{{ $u['name'] }}</a>
                                        <p class="mt-2 text-xs text-[#7A6A52] line-clamp-2">{{ $u['summary'] ?? '' }}</p>
                                    </div>
                                    @if(isset($u['images']) && count($u['images']) > 0)
                                    <div class="relative shrink-0" style="width:170px;height:120px;">
                                        @if(count($u['images']) > 1)
                                        <div style="position:absolute;right:0;top:0;width:140px;height:100px;z-index:1;">
                                            <img src="{{ $u['images'][0] }}" style="position:absolute;left:0;top:8px;width:100%;height:100%;border-radius:12px;object-fit:cover;filter:blur(12px) saturate(1.5);opacity:0.6;transform:scale(0.92);">
                                            <img src="{{ $u['images'][0] }}" style="position:absolute;left:0;top:0;width:100%;height:100%;border-radius:12px;object-fit:cover;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                                        </div>
                                        <div style="position:absolute;left:0;bottom:0;width:100px;height:70px;z-index:2;transition:transform .2s;"
                                             onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                                            <img src="{{ $u['images'][1] }}" style="position:absolute;left:0;top:6px;width:100%;height:100%;border-radius:8px;object-fit:cover;filter:blur(10px) saturate(1.5);opacity:0.6;transform:scale(0.92);">
                                            <img src="{{ $u['images'][1] }}" style="position:absolute;left:0;top:0;width:100%;height:100%;border-radius:8px;object-fit:cover;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                                        </div>
                                        @else
                                        <div style="position:absolute;left:0;top:0;width:170px;height:119px;z-index:1;">
                                            <img src="{{ $u['images'][0] }}" style="position:absolute;left:0;top:10px;width:100%;height:100%;border-radius:12px;object-fit:cover;filter:blur(14px) saturate(1.5);opacity:0.6;transform:scale(0.92);">
                                            <img src="{{ $u['images'][0] }}" style="position:absolute;left:0;top:0;width:100%;height:100%;border-radius:12px;object-fit:cover;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <a href="#"
                       class="mt-14 mb-2 inline-flex w-full items-center justify-center gap-2 rounded-full py-3 text-sm font-bold transition-all hover:opacity-90"
                       style="background:#FFE381; color:#1C1410; border:2px solid #E8C84A;">
                        Xem lịch đầy đủ <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </aside>
    </div>
</section>

{{-- ════════════════════════════════════════
     ARCHIVE — Nền ấm tối hơn (không lạnh navy)
     Jasmine accent chủ đạo, xanh chỉ là detail
════════════════════════════════════════════ --}}
@php $archiveJson = json_encode($archive); @endphp
<section id="archive" class="relative overflow-hidden py-24 lg:py-32"
         style="background:linear-gradient(160deg,#2D1F0A 0%,#3D2A0E 50%,#1C2A10 100%);"
         x-data="{ idx:0, archive:{{ $archiveJson }}, dir:1, get current(){return this.archive[this.idx];}, go(d){this.dir=d;let n=this.idx+d;if(n>=0&&n<this.archive.length)this.idx=n;} }">

    <!-- Warm glow blobs -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -left-32 top-1/4 h-[450px] w-[450px] rounded-full blur-[130px] opacity-25" style="background:#FFE381;"></div>
        <div class="absolute -right-32 bottom-10 h-[350px] w-[350px] rounded-full blur-[130px] opacity-20" style="background:#07A0C3;"></div>
        <div class="absolute left-1/2 bottom-0 h-40 w-[600px] -translate-x-1/2 rounded-full blur-[80px] opacity-15" style="background:#04F06A;"></div>
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
                <h2 class="font-['Barlow'] text-5xl font-black uppercase tracking-tight text-white lg:text-7xl">Kho lưu trữ sự kiện</h2>
                <p class="mt-3 max-w-md leading-relaxed" style="color:rgba(255,227,129,0.65);">
                    Từng năm. Từng đêm diễn. Từng ký ức được lưu lại để có thể sống lại bất cứ lúc nào.
                </p>
            </div>
            <div class="hidden gap-3 lg:flex">
                <button @click="go(-1)" :disabled="idx===0"
                    class="grid h-12 w-12 place-items-center rounded-full border-2 text-white/70 transition-all disabled:opacity-30"
                    style="border-color:rgba(255,227,129,0.3); background:rgba(255,227,129,0.05);"
                    onmouseover="this.style.borderColor='#FFE381';this.style.color='#FFE381'"
                    onmouseout="this.style.borderColor='rgba(255,227,129,0.3)';this.style.color='rgba(255,255,255,0.7)'">
                    <i data-lucide="chevron-left" class="h-5 w-5"></i>
                </button>
                <button @click="go(1)" :disabled="idx===archive.length-1"
                    class="grid h-12 w-12 place-items-center rounded-full border-2 text-white/70 transition-all disabled:opacity-30"
                    style="border-color:rgba(255,227,129,0.3); background:rgba(255,227,129,0.05);"
                    onmouseover="this.style.borderColor='#FFE381';this.style.color='#FFE381'"
                    onmouseout="this.style.borderColor='rgba(255,227,129,0.3)';this.style.color='rgba(255,255,255,0.7)'">
                    <i data-lucide="chevron-right" class="h-5 w-5"></i>
                </button>
            </div>
        </div>

        <div class="relative mt-14 grid grid-cols-1 gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16">
            <!-- Chữ số năm — Jasmine gradient -->
            <div class="relative flex items-start z-10">
<<<<<<< HEAD
                <div class="font-['Barlow_Condensed'] text-[28vw] font-black leading-[0.85] tracking-tighter lg:text-[18vw] pl-4 lg:pl-6 pr-4"
=======
                <div class="font-['Barlow'] text-[28vw] font-black leading-[0.85] tracking-tighter lg:text-[18vw] pl-4 lg:pl-6 pr-4"
>>>>>>> origin/kien
                     style="-webkit-text-fill-color:transparent;-webkit-background-clip:text;background-clip:text;
                            background-image:linear-gradient(160deg,#FFE381 30%,#E8C84A 70%,#07A0C3 100%);"
                     x-text="current.year"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-10"
                     x-transition:enter-end="opacity-100 translate-y-0"></div>
            </div>

            <div>
                <div class="group relative h-[320px] overflow-hidden rounded-2xl lg:h-[420px]"
                     style="box-shadow:0 20px 60px rgba(255,227,129,0.15);">
                    <img :src="current.img" :alt="current.title" loading="lazy"
                         class="h-full w-full object-cover transition-transform duration-[1500ms] group-hover:scale-105" />
                    <div class="absolute inset-0"
                         style="background:linear-gradient(to top,rgba(45,31,10,0.92) 0%,rgba(45,31,10,0.25) 60%,transparent 100%);"></div>
                    <!-- Jasmine accent bar -->
                    <div class="absolute bottom-0 left-0 right-0 h-1.5" style="background:#FFE381;"></div>
                    <div class="absolute bottom-6 left-5 right-5">
                        <div class="mb-2 inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[9px] font-bold uppercase tracking-[0.25em] text-[#1C1410]"
                             style="background:#FFE381;">✦ Featured event</div>
<<<<<<< HEAD
                        <h3 class="font-['Barlow_Condensed'] text-3xl font-black uppercase tracking-wide text-white lg:text-4xl"
=======
                        <h3 class="font-['Barlow'] text-3xl font-black uppercase tracking-wide text-white lg:text-4xl"
>>>>>>> origin/kien
                            x-text="current.title"></h3>
                    </div>
                </div>

                <p class="mt-5 text-base leading-relaxed lg:text-lg" style="color:rgba(255,227,129,0.7);" x-text="current.desc"></p>

                <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <template x-for="achieve in current.achievements" :key="achieve">
                        <div class="rounded-xl px-4 py-3 text-sm font-medium text-white"
                             style="background:rgba(255,227,129,0.10); border:1px solid rgba(255,227,129,0.25);"
                             x-text="achieve"></div>
                    </template>
                </div>

                <!-- Year tabs -->
                <div class="mt-7 flex flex-wrap items-center gap-2">
                    <template x-for="(a,i) in archive" :key="a.year">
                        <button @click="dir=i>idx?1:-1;idx=i"
                            class="rounded-full px-4 py-1.5 text-sm font-bold font-mono transition-all"
                            :style="i===idx
                                ? 'background:#FFE381;color:#1C1410;box-shadow:0 4px 12px rgba(255,227,129,0.4);'
                                : 'background:rgba(255,227,129,0.08);color:rgba(255,227,129,0.45);'">
                            <span x-text="a.year"></span>
                        </button>
                    </template>
                </div>

                <div class="mt-6 flex gap-3 lg:hidden">
                    <button @click="go(-1)" :disabled="idx===0"
                        class="grid h-11 w-11 place-items-center rounded-full border border-[#FFE381]/30 disabled:opacity-30">
                        <i data-lucide="chevron-left" class="h-5 w-5 text-white"></i>
                    </button>
                    <button @click="go(1)" :disabled="idx===archive.length-1"
                        class="grid h-11 w-11 place-items-center rounded-full border border-[#FFE381]/30 disabled:opacity-30">
                        <i data-lucide="chevron-right" class="h-5 w-5 text-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     MEDIA — Nền Jasmine ấm, thoáng sáng
════════════════════════════════════════════ --}}
<<<<<<< HEAD
@php $mediaJson = json_encode($media); @endphp
<section class="relative overflow-hidden py-24 lg:py-32" style="background:#FFF3C4;"
         x-data="mediaPlayer({{ $mediaJson }})" x-init="initPlayer()">
=======
<section class="relative overflow-hidden py-24 lg:py-32" style="background:#FFF3C4;">
>>>>>>> origin/kien
    <!-- Top Jasmine border -->
    <div class="absolute inset-x-0 top-0 h-1.5" style="background:#FFE381;"></div>
    <!-- Subtle accent blobs -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute right-0 top-0 h-80 w-80 rounded-full blur-[120px] opacity-30" style="background:#07A0C3;"></div>
        <div class="absolute -left-20 bottom-0 h-64 w-64 rounded-full blur-[100px] opacity-20" style="background:#04F06A;"></div>
    </div>

    <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">
        <div data-aos="fade-up" class="flex items-end justify-between pb-10">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-7 w-1 rounded-full" style="background:#04F06A;"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.25em]" style="color:#04B050;">Media</span>
                </div>
<<<<<<< HEAD
                <h2 class="font-['Barlow_Condensed'] text-4xl font-black uppercase tracking-tight text-[#1C1410] lg:text-5xl">Album & Recap</h2>
=======
                <h2 class="font-['Barlow'] text-4xl font-black uppercase tracking-tight text-[#1C1410] lg:text-5xl">Album & Recap</h2>
>>>>>>> origin/kien
            </div>
            <a href="#" class="group inline-flex items-center gap-1.5 text-sm font-semibold text-[#07A0C3] transition-colors hover:text-[#04F06A]">
                Thư viện đầy đủ <i data-lucide="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

<<<<<<< HEAD
        <template x-if="items.length > 0">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left Side: Main Player -->
                <div class="lg:col-span-8 bg-black rounded-2xl overflow-hidden relative" style="box-shadow:0 16px 50px rgba(7,160,195,0.15); height: 500px;">
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
                    
                    <!-- Progress Bar at the bottom of the player -->
                    <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-black/50 z-20">
                        <div class="h-full bg-[#07A0C3] transition-all duration-100" :style="`width: ${progress}%`"></div>
                    </div>
                </div>

                <!-- Right Side: Info and Thumbnails -->
                <div class="lg:col-span-4 flex flex-col gap-4 h-[500px]">
                    <!-- Top Info Box (2/3) -->
                    <div class="flex-1 rounded-2xl p-6 flex flex-col justify-center relative overflow-hidden group" style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(12px); box-shadow: 0 4px 20px rgba(255,200,60,0.15); border: 1px solid rgba(255, 227, 129, 0.5);">
                        <div class="mb-4 inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.25em] text-[#1C1410]" style="background:#FFE381;" x-text="currentItem.type === 'video' ? 'Video' : 'Hình ảnh'"></div>
                        
                        <h3 class="font-['Barlow_Condensed'] text-3xl font-black uppercase tracking-wide text-[#1C1410] leading-snug line-clamp-4" x-text="currentItem.title"></h3>
                        
                        <div class="mt-4 flex items-center gap-2">
                            <div class="h-10 w-1 rounded-full" style="background:#04F06A;"></div>
                            <a :href="currentItem.event_url" class="text-sm font-semibold text-[#7A6A52] hover:text-[#07A0C3] transition-colors" x-text="currentItem.event_name"></a>
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
=======
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
            @foreach($media as $i => $m)
            <div data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <a href="#"
                   class="group relative block aspect-[3/4] overflow-hidden rounded-2xl transition-all duration-500 hover:-translate-y-2"
                   style="box-shadow:0 4px 20px rgba(255,200,60,0.3);"
                   onmouseover="this.style.boxShadow='0 16px 50px rgba(7,160,195,0.25)'"
                   onmouseout="this.style.boxShadow='0 4px 20px rgba(255,200,60,0.3)'">
                    <img src="{{ $m['src'] }}" alt="{{ $m['label'] }}" loading="lazy"
                         class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-[#2D1F0A]/80 via-[#2D1F0A]/10 to-transparent"></div>

                    @if($m['type'] === 'video')
                    <div class="absolute inset-0 grid place-items-center">
                        <div class="grid h-14 w-14 place-items-center rounded-full text-[#1C1410] shadow-lg transition-transform group-hover:scale-110"
                             style="background:#FFE381;">
                            <i data-lucide="play" class="h-5 w-5 translate-x-0.5 fill-current"></i>
                        </div>
                    </div>
                    @endif

                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <!-- Sliding bottom bar -->
                        <div class="mb-2 h-0.5 w-0 rounded-full transition-all duration-500 group-hover:w-full"
                             style="background:#FFE381;"></div>
                        <div class="text-[9px] font-bold uppercase tracking-[0.25em]" style="color:#FFE381;">{{ $m['type'] }}</div>
                        <div class="font-['Barlow'] mt-1 text-lg font-bold uppercase tracking-wide text-white group-hover:text-[#FFE381] transition-colors">{{ $m['label'] }}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
>>>>>>> origin/kien
</section>

@endsection
