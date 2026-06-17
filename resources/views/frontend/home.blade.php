@extends('layouts.frontend')

@section('content')

{{-- ════════════════════════════════════════
     HERO SLIDER
     Overlay ấm — jasmine tint thay vì lạnh xanh
════════════════════════════════════════════ --}}
<section id="top" class="relative h-[100svh] w-full overflow-hidden" style="background:#1C1410;">
    <div class="slider-wrapper" id="slider">
        <div class="bg-layers" id="bgLayers">
            @foreach($slides as $i => $slide)
            <div class="bg-layer {{ $i === 0 ? 'active' : 'idle' }}" data-index="{{ $i }}"
                 style="background-image:url('{{ $slide['image'] }}')"></div>
            @endforeach
        </div>
        {{-- Overlay ấm: jasmine trái, tối phải --}}
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
                    @foreach($slides as $i => $slide)
                    <div class="dest-card {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"
                         onclick="goToSlide({{ $i }})" role="button" tabindex="0"
                         aria-label="Xem sự kiện: {{ $slide['title'] }}">
                        <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" loading="lazy">
                        <div class="dest-card-overlay"></div>
                        <div class="dest-card-info">
                            <div class="dest-card-tag">{{ $slide['tag'] }}</div>
                            <div class="dest-card-name">{{ $slide['title'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="slider-bottom-bar">
            <div class="nav-arrows">
                <button class="nav-btn" id="btnPrev" aria-label="Trước">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button class="nav-btn" id="btnNext" aria-label="Tiếp theo">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
            <div class="progress-track"><div class="progress-fill" id="progressFill" style="width:20%"></div></div>
            <div class="slide-counter" id="slideCounter">01</div>
        </div>
    </div>
    <script>
    (function(){
        const slides=@json($slides),total=slides.length;
        if(!total)return;
        let current=0,isAnim=false,autoTimer;
        const bgLayers=document.querySelectorAll('.bg-layer'),cards=document.querySelectorAll('.dest-card');
        const cardTrack=document.getElementById('cardTrack'),slideInfo=document.getElementById('slideInfo');
        const slideEyebrow=document.getElementById('slideEyebrow'),slideTitle=document.getElementById('slideTitle');
        const slideDesc=document.getElementById('slideDesc'),slideCta=document.getElementById('slideCta');
        const progressFill=document.getElementById('progressFill'),slideCounter=document.getElementById('slideCounter');
        function goToSlide(idx){
            if(isAnim||idx===current)return;
            isAnim=true;clearTimeout(autoTimer);
            const prev=current;current=idx;
            bgLayers[prev].classList.remove('active');bgLayers[prev].classList.add('leaving');
            bgLayers[current].classList.remove('idle','leaving');bgLayers[current].classList.add('active');
            setTimeout(()=>{bgLayers[prev].classList.remove('leaving');bgLayers[prev].classList.add('idle');},950);
            slideInfo.classList.remove('is-active');
            setTimeout(()=>{
                slideEyebrow.textContent=slides[current].eyebrow;
                slideTitle.textContent=slides[current].title;
                slideDesc.textContent=slides[current].description;
                slideCta.textContent=slides[current].cta_label;
                slideCta.href=slides[current].cta_url;
                slideInfo.classList.add('is-active');
            },300);
            cards.forEach((c,i)=>c.classList.toggle('active',i===current));
            const cw=165,gw=16,sw=600,vc=Math.floor((sw-48)/(cw+gw));
            let off=current>=vc-1?(current-vc+2)*(cw+gw):0;
            cardTrack.style.transform=`translateX(-${off}px)`;
            progressFill.style.width=((current+1)/total*100)+'%';
            slideCounter.textContent=String(current+1).padStart(2,'0');
            setTimeout(()=>{isAnim=false;},700);scheduleAuto();
        }
        function next(){goToSlide((current+1)%total);}
        function prev(){goToSlide((current-1+total)%total);}
        function scheduleAuto(){clearTimeout(autoTimer);autoTimer=setTimeout(next,5000);}
        document.getElementById('btnNext')?.addEventListener('click',next);
        document.getElementById('btnPrev')?.addEventListener('click',prev);
        document.addEventListener('keydown',e=>{
            if(e.key==='ArrowRight'||e.key==='ArrowDown')next();
            if(e.key==='ArrowLeft'||e.key==='ArrowUp')prev();
        });
        cards.forEach(c=>c.addEventListener('keydown',e=>{
            if(e.key==='Enter'||e.key===' '){e.preventDefault();goToSlide(parseInt(c.dataset.index));}
        }));
        const sl=document.getElementById('slider');
        sl?.addEventListener('mouseenter',()=>clearTimeout(autoTimer));
        sl?.addEventListener('mouseleave',scheduleAuto);
        scheduleAuto();
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
            <div class="font-['Barlow_Condensed'] text-6xl font-black text-[#1C1410] lg:text-7xl">
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

    <div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-6 lg:grid-cols-[1fr_360px] lg:gap-14 lg:px-10">

        {{-- ── Featured Events ── --}}
        <div>
            <div data-aos="fade-up" class="mb-10 flex items-end justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-7 w-1 rounded-full" style="background:#07A0C3;"></div>
                        <span class="text-xs font-bold uppercase tracking-[0.25em]" style="color:#07A0C3;">Featured Events</span>
                    </div>
                    <h2 class="font-['Barlow_Condensed'] text-5xl font-black uppercase tracking-tight text-[#1C1410] lg:text-6xl">Sự kiện nổi bật</h2>
                </div>
                <a href="#" class="hidden items-center gap-2 text-sm font-semibold lg:inline-flex transition-colors"
                   style="color:#07A0C3;" onmouseover="this.style.color='#04F06A'" onmouseout="this.style.color='#07A0C3'">
                    Xem tất cả <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>

            <div class="space-y-5">
                @foreach($featuredEvents as $i => $ev)
                <article data-aos="fade-up" data-aos-delay="{{ $i * 60 }}"
                         x-data="{ animClass: '' }"
                         @mouseenter="animClass = 'hover-anim-' + (Math.floor(Math.random() * 3) + 1)"
                         @mouseleave="animClass = ''"
                         :class="animClass"
                         class="group relative grid grid-cols-1 overflow-hidden rounded-2xl transition-all duration-500
                                hover:-translate-y-1 sm:grid-cols-[260px_1fr]"
                         style="background:#FFF8D0; box-shadow:0 2px 16px rgba(255,227,129,0.4);"
                         onmouseover="this.style.boxShadow='0 12px 40px rgba(7,160,195,0.18)'"
                         onmouseout="this.style.boxShadow='0 2px 16px rgba(255,227,129,0.4)'">
                    
                    <!-- Color Sweep Layer -->
                    <div class="sweep-bg"></div>

                    <div class="relative z-10 h-52 overflow-hidden sm:h-full">
                        <img src="{{ $ev['img'] }}" alt="{{ $ev['title'] }}" loading="lazy"
                             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        <!-- Bottom accent bar -->
                        <div class="absolute bottom-0 left-0 right-0 h-1" style="background:#FFE381;"></div>
                        <!-- Category badge -->
                        <div class="absolute left-3 top-3">
                            <span class="rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-[#1C1410] shadow-md"
                                  style="background:#FFE381;">{{ $ev['category'] }}</span>
                        </div>
                    </div>
                    <div class="relative z-10 flex flex-col justify-between p-6">
                        <div>
                            <h3 class="font-['Barlow_Condensed'] text-3xl font-black uppercase leading-tight tracking-wide text-[#1C1410] transition-colors group-hover:text-[#07A0C3] lg:text-4xl">
                                {{ $ev['title'] }}
                            </h3>
                            <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2 text-sm text-[#7A6A52]">
                                <span class="inline-flex items-center gap-2">
                                    <i data-lucide="calendar" class="h-4 w-4" style="color:#07A0C3;"></i> {{ $ev['date'] }}
                                </span>
                                <span class="inline-flex items-center gap-2">
                                    <i data-lucide="map-pin" class="h-4 w-4" style="color:#04F06A;"></i> {{ $ev['location'] }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-5 flex items-center gap-4">
                            <a href="#"
                               class="inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-bold text-white shadow transition-all hover:shadow-lg hover:scale-105"
                               style="background:#07A0C3;">
                                Xem chi tiết <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                            </a>
                            <span class="h-6 w-px bg-black/10"></span>
                            <span class="text-xs font-semibold uppercase tracking-wider text-[#7A6A52]">{{ $ev['category'] }}</span>
                        </div>
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
                            <h3 class="font-['Barlow_Condensed'] mt-0.5 text-3xl font-black uppercase tracking-wide text-[#1C1410]">Sắp diễn ra</h3>
                        </div>
                        <div class="flex items-center gap-2 rounded-full bg-white/60 px-3 py-1.5 text-xs font-bold text-[#1C1410] backdrop-blur">
                            <span class="h-2 w-2 animate-pulse rounded-full" style="background:#07A0C3;"></span>Live
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="p-6" style="background:#FFFBEA;">
                    <ol class="relative space-y-4 border-l-2 border-[#FFE381] pl-5">
                        @foreach($upcoming as $i => $u)
                        <li data-aos="fade-right" data-aos-delay="{{ $i * 80 }}" class="relative group/item cursor-pointer">
                            <span class="absolute -left-[25px] top-1.5 h-3 w-3 rounded-full border-2 border-[#FFFBEA] shadow transition-transform group-hover/item:scale-125"
                                  style="{{ $u['open'] ? 'background:#07A0C3;' : 'background:#d1c9a8;' }}"></span>
                            <div class="text-[11px] font-bold uppercase tracking-widest text-[#7A6A52]">{{ $u['date'] }}</div>
                            <div class="mt-0.5 text-sm font-semibold text-[#1C1410] group-hover/item:text-[#07A0C3] transition-colors">{{ $u['name'] }}</div>
                            <div class="mt-1 inline-flex items-center gap-1.5 text-xs font-medium {{ $u['open'] ? '' : 'text-[#7A6A52]' }}"
                                 style="{{ $u['open'] ? 'color:#07A0C3;' : '' }}">
                                <span class="h-1.5 w-1.5 rounded-full"
                                      style="{{ $u['open'] ? 'background:#04F06A;' : 'background:#d1c9a8;' }}"></span>
                                {{ $u['status'] }}
                            </div>
                        </li>
                        @endforeach
                    </ol>

                    <a href="#"
                       class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-full py-3 text-sm font-bold transition-all hover:opacity-90"
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
                <h2 class="font-['Barlow_Condensed'] text-5xl font-black uppercase tracking-tight text-white lg:text-7xl">Kho lưu trữ sự kiện</h2>
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
            <div class="relative flex items-start">
                <div class="font-['Barlow_Condensed'] text-[28vw] font-black leading-[0.85] tracking-tighter lg:text-[18vw]"
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
                        <h3 class="font-['Barlow_Condensed'] text-3xl font-black uppercase tracking-wide text-white lg:text-4xl"
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
<section class="relative overflow-hidden py-24 lg:py-32" style="background:#FFF3C4;">
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
                <h2 class="font-['Barlow_Condensed'] text-4xl font-black uppercase tracking-tight text-[#1C1410] lg:text-5xl">Album & Recap</h2>
            </div>
            <a href="#" class="group inline-flex items-center gap-1.5 text-sm font-semibold text-[#07A0C3] transition-colors hover:text-[#04F06A]">
                Thư viện đầy đủ <i data-lucide="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

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
                        <div class="font-['Barlow_Condensed'] mt-1 text-lg font-bold uppercase tracking-wide text-white group-hover:text-[#FFE381] transition-colors">{{ $m['label'] }}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
