@extends('layouts.frontend')

@section('content')

<!-- Hero Section -->
<section id="top" class="relative h-[100svh] w-full overflow-hidden bg-ink" x-data="{ y: 0, opacity: 1 }" @scroll.window="y = window.scrollY * 0.3; opacity = 1 - (window.scrollY / 800)">
    <div class="absolute inset-0" :style="`transform: translateY(${y}px) scale(${1.05 + (window.scrollY * 0.0002)}); opacity: ${opacity};`">
        <img src="{{ asset('images/frontend/hero.jpg') }}" alt="UniEvent cinematic hero" class="h-full w-full object-cover" width="1920" height="1280" />
        <div class="absolute inset-0 bg-gradient-to-b from-ink/40 via-ink/20 to-ink"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-ink/70 via-transparent to-transparent"></div>
    </div>

    <div class="relative z-10 mx-auto flex h-full max-w-[1400px] flex-col justify-end px-6 pb-24 lg:px-10 lg:pb-32" :style="`opacity: ${opacity};`">
        <div data-aos="fade-up" data-aos-delay="200" class="flex items-center gap-3 text-xs uppercase tracking-[0.3em] text-azure-glow">
            <span class="h-px w-12 bg-azure-glow"></span>
            Nền tảng sự kiện học đường
        </div>

        <h1 class="text-display mt-6 max-w-5xl text-[12vw] leading-[0.9] text-white sm:text-[10vw] lg:text-[8.5vw]">
            <span class="block" data-aos="fade-up" data-aos-delay="400">Mỗi sự kiện</span>
            <span class="block italic text-azure-glow" data-aos="fade-up" data-aos-delay="600">là một ký ức.</span>
        </h1>

        <p data-aos="fade-up" data-aos-delay="800" class="mt-8 max-w-xl text-base text-white/70 lg:text-lg">
            UniEvent ghi lại, kể lại và lưu giữ những khoảnh khắc quan trọng nhất
            của đời sống học đường — qua một trải nghiệm điện ảnh không giới hạn.
        </p>

        <div data-aos="fade-up" data-aos-delay="1000" class="mt-10 flex flex-wrap items-center gap-4">
            <a href="#events" class="group inline-flex items-center gap-3 rounded-full bg-white px-7 py-4 text-sm font-semibold text-ink transition-all hover:bg-azure-glow">
                Khám phá sự kiện
                <i data-lucide="arrow-up-right" class="h-4 w-4 transition-transform group-hover:rotate-45"></i>
            </a>
            <a href="#archive" class="group inline-flex items-center gap-3 rounded-full border border-white/30 px-7 py-4 text-sm font-semibold text-white backdrop-blur-md transition-all hover:bg-white/10">
                Kho lưu trữ sự kiện
                <i data-lucide="chevron-right" class="h-4 w-4 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 z-10 -translate-x-1/2 text-[10px] uppercase tracking-[0.4em] text-white/50 animate-bounce">
        Cuộn xuống &darr;
    </div>
</section>

<!-- Stats Section -->
<section class="relative border-y border-outline-variant/60 bg-paper py-20 lg:py-28">
    <div class="mx-auto grid max-w-[1400px] grid-cols-2 gap-10 px-6 lg:grid-cols-4 lg:px-10">
        @foreach($stats as $i => $s)
        <div data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
            <div class="flex flex-col">
                <div class="text-display text-6xl font-medium text-ink lg:text-7xl">
                    <span x-data="{ count: 0, target: {{ $s['value'] }}, decimals: {{ $s['decimals'] }}, started: false }" 
                          x-intersect.once="started = true; let step = target / 60; let i = setInterval(() => { count += step; if(count >= target) { count = target; clearInterval(i); } }, 30)" 
                          x-text="decimals ? count.toFixed(decimals) : Math.round(count).toLocaleString()">0</span>{{ $s['suffix'] }}
                </div>
                <div class="mt-3 h-px w-12 bg-azure"></div>
                <div class="mt-3 text-sm uppercase tracking-widest text-ink-soft">{{ $s['label'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Main Content (Events) -->
<section id="events" class="relative bg-paper py-24 lg:py-32">
    <div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-6 lg:grid-cols-[1fr_360px] lg:gap-16 lg:px-10">
        
        <!-- Left: Featured Events -->
        <div>
            <div data-aos="fade-up" class="flex items-end justify-between border-b border-outline-variant/60 pb-6">
                <div>
                    <div class="text-xs uppercase tracking-[0.3em] text-azure">— Featured</div>
                    <h2 class="text-display mt-4 text-5xl text-ink lg:text-6xl">Sự kiện nổi bật</h2>
                </div>
                <a href="#" class="hidden text-sm text-ink-soft hover:text-ink lg:inline-flex items-center gap-2">
                    Xem tất cả <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>

            <div class="mt-10 space-y-6">
                @foreach($featuredEvents as $i => $ev)
                <article data-aos="fade-up" data-aos-delay="{{ $i * 50 }}" class="group grid grid-cols-1 gap-5 overflow-hidden rounded-2xl border border-outline-variant/60 bg-surface-container-low p-3 transition-all hover-lift sm:grid-cols-[280px_1fr]">
                    <div class="relative h-48 overflow-hidden rounded-xl sm:h-full">
                        <img src="{{ $ev['img'] }}" alt="{{ $ev['title'] }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-[1200ms] ease-out group-hover:scale-110" />
                        <div class="absolute left-3 top-3 rounded-full bg-paper/90 px-3 py-1 text-[10px] uppercase tracking-widest text-ink backdrop-blur">
                            {{ $ev['category'] }}
                        </div>
                    </div>
                    <div class="flex flex-col justify-between p-3 sm:p-4">
                        <div>
                            <h3 class="text-display text-2xl text-ink transition-colors group-hover:text-azure-deep lg:text-3xl">
                                {{ $ev['title'] }}
                            </h3>
                            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-2 text-sm text-ink-soft">
                                <span class="inline-flex items-center gap-2">
                                    <i data-lucide="calendar" class="h-4 w-4 text-azure"></i> {{ $ev['date'] }}
                                </span>
                                <span class="inline-flex items-center gap-2">
                                    <i data-lucide="map-pin" class="h-4 w-4 text-azure"></i> {{ $ev['location'] }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <a href="#" class="group/cta inline-flex items-center gap-2 text-sm font-semibold text-ink">
                                Xem chi tiết
                                <span class="inline-block h-px w-8 bg-ink transition-all group-hover/cta:w-14 group-hover/cta:bg-azure"></span>
                            </a>
                            <i data-lucide="arrow-up-right" class="h-5 w-5 text-ink-soft transition-all group-hover:rotate-45 group-hover:text-azure"></i>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>

        <!-- Right: Upcoming Events -->
        <aside class="lg:sticky lg:top-28 lg:self-start">
            <div data-aos="fade-up" class="rounded-2xl border border-outline-variant/60 bg-surface-container-low p-6">
                <div class="flex items-center justify-between border-b border-outline-variant/60 pb-4">
                    <div>
                        <div class="text-xs uppercase tracking-[0.3em] text-azure">Upcoming</div>
                        <h3 class="text-display mt-2 text-2xl text-ink">Sắp diễn ra</h3>
                    </div>
                    <div class="h-2 w-2 animate-pulse rounded-full bg-azure"></div>
                </div>

                <ol class="relative mt-6 space-y-5 border-l border-outline-variant/60 pl-5">
                    @foreach($upcoming as $i => $u)
                    <li data-aos="fade-right" data-aos-delay="{{ $i * 100 }}" class="relative">
                        <span class="absolute -left-[26px] top-1.5 h-2.5 w-2.5 rounded-full border-2 border-paper bg-azure"></span>
                        <div class="text-[11px] uppercase tracking-widest text-ink-soft">{{ $u['date'] }}</div>
                        <div class="mt-1 text-sm font-medium text-ink">{{ $u['name'] }}</div>
                        <div class="mt-1 inline-flex items-center gap-1.5 text-xs {{ $u['open'] ? 'text-azure-deep' : 'text-ink-soft' }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $u['open'] ? 'bg-azure' : 'bg-ink-soft/50' }}"></span>
                            {{ $u['status'] }}
                        </div>
                    </li>
                    @endforeach
                </ol>

                <a href="#" class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-full bg-ink py-3 text-sm font-medium text-paper transition-colors hover:bg-azure-deep">
                    Xem lịch đầy đủ <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>
        </aside>

    </div>
</section>

<!-- Archive Section -->
@php
    $archiveJson = json_encode($archive);
@endphp
<section id="archive" class="relative overflow-hidden bg-ink py-24 text-white lg:py-32 cinematic-grain" x-data="{ idx: 0, archive: {{ $archiveJson }}, dir: 1, get current() { return this.archive[this.idx]; }, go(delta) { this.dir = delta; let n = this.idx + delta; if(n >= 0 && n < this.archive.length) this.idx = n; } }">
    <div class="absolute inset-0 -z-0 opacity-30">
        <div class="absolute -left-40 top-20 h-[500px] w-[500px] rounded-full bg-azure blur-[180px]"></div>
        <div class="absolute -right-40 bottom-0 h-[400px] w-[400px] rounded-full bg-azure-deep blur-[180px]"></div>
    </div>

    <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">
        <div data-aos="fade-up" class="flex items-end justify-between">
            <div>
                <div class="text-xs uppercase tracking-[0.3em] text-azure-glow">— Archive</div>
                <h2 class="text-display mt-4 text-5xl lg:text-7xl">Kho lưu trữ sự kiện</h2>
                <p class="mt-4 max-w-md text-white/60">
                    Từng năm. Từng đêm diễn. Từng ký ức được lưu lại để có thể sống lại bất cứ lúc nào.
                </p>
            </div>
            <div class="hidden gap-3 lg:flex">
                <button @click="go(-1)" :disabled="idx === 0" class="grid h-14 w-14 place-items-center rounded-full border border-white/20 transition-all hover:bg-white/10 disabled:opacity-30" aria-label="Năm trước">
                    <i data-lucide="chevron-left" class="h-5 w-5"></i>
                </button>
                <button @click="go(1)" :disabled="idx === archive.length - 1" class="grid h-14 w-14 place-items-center rounded-full border border-white/20 transition-all hover:bg-white/10 disabled:opacity-30" aria-label="Năm sau">
                    <i data-lucide="chevron-right" class="h-5 w-5"></i>
                </button>
            </div>
        </div>

        <div class="relative mt-14 grid grid-cols-1 gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16">
            <!-- Year -->
            <div class="relative flex items-start">
                <div class="text-display text-[28vw] font-light leading-[0.85] tracking-tighter text-white lg:text-[18vw]"
                     x-text="current.year"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                ></div>
            </div>

            <!-- Content -->
            <div>
                <div class="group relative h-[320px] overflow-hidden rounded-2xl lg:h-[440px]">
                    <img :src="current.img" :alt="current.title" loading="lazy" class="h-full w-full object-cover transition-transform duration-[1500ms] group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-ink to-transparent"></div>
                    <div class="absolute bottom-5 left-5 right-5">
                        <div class="text-[10px] uppercase tracking-[0.3em] text-azure-glow">Featured event</div>
                        <h3 class="text-display mt-2 text-3xl lg:text-4xl" x-text="current.title"></h3>
                    </div>
                </div>

                <p class="mt-6 text-base leading-relaxed text-white/70 lg:text-lg" x-text="current.desc"></p>

                <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <template x-for="achieve in current.achievements" :key="achieve">
                        <div class="rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm text-white/80 backdrop-blur" x-text="achieve"></div>
                    </template>
                </div>

                <!-- Year pagination dots -->
                <div class="mt-8 flex items-center gap-4">
                    <template x-for="(a, i) in archive" :key="a.year">
                        <button @click="dir = i > idx ? 1 : -1; idx = i" class="text-sm transition-all relative" :class="i === idx ? 'text-white' : 'text-white/30 hover:text-white/60'">
                            <span class="font-mono" x-text="a.year"></span>
                            <span x-show="i === idx" class="mt-1 block h-px bg-azure-glow absolute bottom--1 left-0 right-0"></span>
                        </button>
                    </template>
                </div>

                <!-- Mobile nav -->
                <div class="mt-6 flex gap-3 lg:hidden">
                    <button @click="go(-1)" :disabled="idx === 0" class="grid h-12 w-12 place-items-center rounded-full border border-white/20 disabled:opacity-30">
                        <i data-lucide="chevron-left" class="h-5 w-5"></i>
                    </button>
                    <button @click="go(1)" :disabled="idx === archive.length - 1" class="grid h-12 w-12 place-items-center rounded-full border border-white/20 disabled:opacity-30">
                        <i data-lucide="chevron-right" class="h-5 w-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Media Section -->
<section class="bg-paper py-24 lg:py-32">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div data-aos="fade-up" class="flex items-end justify-between border-b border-outline-variant/60 pb-6">
            <div>
                <div class="text-xs uppercase tracking-[0.3em] text-azure">— Media</div>
                <h2 class="text-display mt-4 text-4xl text-ink lg:text-5xl">Album & Recap</h2>
            </div>
            <a href="#" class="text-sm text-ink-soft hover:text-ink">Thư viện đầy đủ &rarr;</a>
        </div>

        <div class="mt-10 grid grid-cols-2 gap-4 lg:grid-cols-4">
            @foreach($media as $i => $m)
            <div data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <a href="#" class="group relative block aspect-square overflow-hidden rounded-2xl">
                    <img src="{{ $m['src'] }}" alt="{{ $m['label'] }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-[1200ms] ease-out group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-ink/80 to-transparent"></div>
                    @if($m['type'] === 'video')
                    <div class="absolute inset-0 grid place-items-center">
                        <div class="grid h-14 w-14 place-items-center rounded-full bg-white/90 text-ink transition-transform group-hover:scale-110">
                            <i data-lucide="play" class="h-5 w-5 translate-x-0.5 fill-current"></i>
                        </div>
                    </div>
                    @endif
                    <div class="absolute bottom-3 left-3 right-3">
                        <div class="text-[10px] uppercase tracking-widest text-azure-glow">{{ $m['type'] }}</div>
                        <div class="mt-1 text-sm font-medium text-white">{{ $m['label'] }}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
