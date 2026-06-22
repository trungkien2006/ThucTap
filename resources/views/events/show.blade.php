@extends('layouts.public')

@section('content')

@push('styles')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .timeline-dot::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 100%;
        width: 2px;
        height: calc(100% + 1.5rem);
        background: #e1e3e4;
        transform: translateX(-50%);
    }
    .timeline-item:last-child .timeline-dot::after {
        display: none;
    }
</style>
@endpush

@php
    $titleStyles = [];
    if (!empty($event->title_font_family)) {
        $titleStyles[] = "font-family: '{$event->title_font_family}', sans-serif;";
    }
    if (!empty($event->title_font_size)) {
        $titleStyles[] = "font-size: {$event->title_font_size}px;";
    }
    if (!empty($event->title_color)) {
        $titleStyles[] = "color: {$event->title_color} !important;";
    }
    if (!empty($event->title_outline_width) && $event->title_outline_width != '0') {
        $outlineColor = $event->title_outline_color ?? '#000000';
        $titleStyles[] = "-webkit-text-stroke: {$event->title_outline_width}px {$outlineColor};";
        $titleStyles[] = "text-shadow: 0px 2px 4px rgba(0,0,0,0.5);";
    }
    $titleStyleStr = implode(' ', $titleStyles);

    $descStyles = [];
    if (!empty($event->desc_font_family)) {
        $descStyles[] = "font-family: '{$event->desc_font_family}', sans-serif;";
    }
    if (!empty($event->desc_font_size)) {
        $descStyles[] = "font-size: {$event->desc_font_size}px;";
    }
    if (!empty($event->desc_color)) {
        $descStyles[] = "color: {$event->desc_color} !important;";
    }
    $descStyleStr = implode(' ', $descStyles);
@endphp

<!-- Hero Section -->
<section class="relative h-[600px] min-h-[500px] flex items-center justify-center overflow-hidden rounded-[24px] mb-12 mt-4">
    <div class="absolute inset-0 z-0">
        @if($event->bannerImage)
            <img class="w-full h-full object-cover brightness-[0.4]" src="{{ Storage::url($event->bannerImage->url) }}" alt="{{ $event->title }}"/>
        @else
            <div class="w-full h-full bg-deep-navy brightness-[0.8]"></div>
        @endif
    </div>
    <div class="relative z-10 w-full max-w-container-max px-margin-desktop text-center text-pure-white mt-16">
        @if($event->category)
            <span class="inline-block px-4 py-1.5 rounded-full bg-fpt-orange text-pure-white font-label-lg mb-6 tracking-wider uppercase">{{ $event->category->name }}</span>
        @endif
        <h1 class="font-display-lg text-display-lg mb-6 leading-tight max-w-4xl mx-auto" style="{{ $titleStyleStr }}">{{ $event->title }}</h1>
        
        <!-- Countdown Timer -->
        @if($event->event_date > now())
        <div class="flex justify-center gap-4 md:gap-8 mb-12" id="countdown" data-date="{{ $event->event_date->format('Y-m-d\TH:i:s') }}">
            <div class="glass-card rounded-xl p-4 min-w-[100px]">
                <div class="text-4xl md:text-5xl font-bold text-fpt-orange" id="days">00</div>
                <div class="text-sm font-label-lg text-pure-white/90 uppercase">Days</div>
            </div>
            <div class="glass-card rounded-xl p-4 min-w-[100px]">
                <div class="text-4xl md:text-5xl font-bold text-fpt-orange" id="hours">00</div>
                <div class="text-sm font-label-lg text-pure-white/90 uppercase">Hours</div>
            </div>
            <div class="glass-card rounded-xl p-4 min-w-[100px]">
                <div class="text-4xl md:text-5xl font-bold text-fpt-orange" id="minutes">00</div>
                <div class="text-sm font-label-lg text-pure-white/90 uppercase">Mins</div>
            </div>
            <div class="glass-card rounded-xl p-4 min-w-[100px]">
                <div class="text-4xl md:text-5xl font-bold text-fpt-orange" id="seconds">00</div>
                <div class="text-sm font-label-lg text-pure-white/90 uppercase">Secs</div>
            </div>
        </div>
        @endif

        <div class="flex flex-col md:flex-row justify-center gap-4 mt-8">
            <button id="like-btn" data-event-id="{{ $event->id }}" class="bg-surface-container/20 hover:bg-surface-container/40 backdrop-blur-md border border-white/20 text-pure-white px-8 py-3 rounded-full font-headline-md transition-all active:scale-95 shadow-lg flex items-center gap-2 {{ session()->has('liked_events.' . $event->id) ? 'text-red-400 border-red-400/50' : '' }}">
                <span class="material-symbols-outlined {{ session()->has('liked_events.' . $event->id) ? 'text-red-400' : '' }} font-fill">favorite</span>
                <span id="likes-count">{{ $event->likes_count }}</span> Lượt thích
            </button>
            <div class="bg-surface-container/20 backdrop-blur-md border border-white/20 text-pure-white px-8 py-3 rounded-full font-headline-md shadow-lg flex items-center gap-2">
                <span class="material-symbols-outlined">visibility</span>
                <span>{{ $event->views_count }}</span> Lượt xem
            </div>
        </div>
    </div>
</section>

<!-- Bento Grid Details Section -->
<section class="max-w-container-max mx-auto py-12">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
        
        <!-- About / Description -->
        <div class="md:col-span-12 bg-pure-white p-8 md:p-12 rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow mb-8">
            <h2 class="font-headline-lg text-headline-lg text-deep-navy mb-6">Giới thiệu sự kiện</h2>
            <div class="text-on-surface-variant font-body-md leading-relaxed prose max-w-none mb-6" style="{{ $descStyleStr }}">
                {!! nl2br(e($event->description)) !!}
            </div>

            {{-- Hiển thị nội dung chi tiết (các khối thiết kế từ studio) --}}
            @if($event->galleryImages->count() > 0)
                <div class="mt-8 pt-8 border-t border-surface-container space-y-8">
                    @foreach($event->galleryImages->take(4) as $block)
                        <div class="space-y-4">
                            @if($block->content)
                                <div class="text-on-surface-variant font-body-md leading-relaxed text-justify break-words">
                                    {!! nl2br(e($block->content)) !!}
                                </div>
                            @endif

                            @if($block->url)
                                <figure class="my-6">
                                    <div class="rounded-xl overflow-hidden bg-slate-100 shadow-sm max-w-2xl">
                                        @if($block->type === 'video')
                                            <video src="{{ Storage::url($block->url) }}" class="w-full h-auto object-cover max-h-[500px]" autoplay loop muted playsinline controls></video>
                                        @else
                                            <img src="{{ Storage::url($block->url) }}" class="w-full h-auto object-contain max-h-[500px]" alt=""/>
                                        @endif
                                    </div>
                                    @if($block->caption)
                                    <figcaption class="mt-3 text-sm text-text-muted italic">
                                        {{ $block->caption }}
                                    </figcaption>
                                    @endif
                                </figure>
                            @endif

                            <div class="flex flex-wrap gap-3 mt-4">
                                {{-- Tài liệu đính kèm nếu có --}}
                                @if($block->document_url)
                                    <a href="{{ Storage::url($block->document_url) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold rounded-xl text-sm border border-emerald-200 transition-all">
                                        <span class="material-symbols-outlined text-lg">download</span>
                                        Tải tài liệu: {{ $block->document_name ?? basename($block->document_url) }}
                                    </a>
                                @endif

                                {{-- URL liên kết ngoài nếu có --}}
                                @if($block->action_url)
                                    <a href="{{ $block->action_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-xl text-sm border border-blue-200 transition-all">
                                        <span class="material-symbols-outlined text-lg">open_in_new</span>
                                        Xem liên kết ngoài
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Date & Time Card -->
        <div class="md:col-span-4 bg-pure-white p-8 rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined" data-icon="calendar_month">calendar_month</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md text-deep-navy">Thời gian</h3>
                    <p class="text-text-muted font-body-sm">Đánh dấu vào lịch của bạn</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-surface-container">
                    <span class="text-on-surface-variant font-label-lg">Ngày diễn ra</span>
                    <span class="text-deep-navy font-bold">{{ $event->event_date->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-surface-container">
                    <span class="text-on-surface-variant font-label-lg">Giờ</span>
                    <span class="text-deep-navy font-bold">{{ $event->event_date->format('h:i A') }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-on-surface-variant font-label-lg">Trạng thái</span>
                    @if($event->event_date > now())
                        <span class="text-green-600 font-bold">Sắp diễn ra</span>
                    @else
                        <span class="text-gray-500 font-bold">Đã kết thúc</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Location & Map Card -->
        <div class="md:col-span-8 bg-pure-white rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col md:flex-row">
            <div class="p-8 md:w-1/2">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined" data-icon="location_on">location_on</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-headline-md text-deep-navy">Địa điểm</h3>
                        <p class="text-text-muted font-body-sm">Nơi sự kiện diễn ra</p>
                    </div>
                </div>
                <p class="text-on-surface-variant mb-6 font-body-md leading-relaxed font-bold text-xl">
                    {{ $event->location }}
                </p>
            </div>
            <div class="md:w-1/2 h-64 md:h-auto min-h-[300px] bg-surface-container-high relative">
                <div class="absolute inset-0 bg-gray-200">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAg2DFIzrPiE9eXGxlhrk8ScwLBwckgjmEZnhrE-ODdCkSyH1b-2ESSrPzi4nApCTbVdD0VvPajUX0fIoyIL6MGdFnydbyV2813F6U8sxnqLkHBzUOroOH7_I3FYJuzL4xhnEGzUasqtv9y1-haiTqsozTeCE__gZ_oedn5F9AEUZ7-39XQUI0PgWgM0X8RvkBK0DIZ4eTYKcWbVAquMrJjM8I1xeekmAgsoQY_EjyDZak8zIbyEjduy7RytBzqM_KFarHBFn8Va78" alt="Map"/>
                </div>
            </div>
        </div>

        <!-- Agenda Timeline -->
        @if($event->scheduleItems->count() > 0)
        <div class="md:col-span-12 bg-pure-white p-8 md:p-12 rounded-2xl border border-outline-variant shadow-sm mt-8">
            <div class="text-center mb-16">
                <h2 class="font-headline-lg text-headline-lg text-deep-navy mb-4">Lịch trình sự kiện</h2>
                <p class="text-text-muted max-w-2xl mx-auto">Chi tiết lịch trình diễn ra trong sự kiện.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($event->scheduleItems as $index => $item)
                <div class="relative timeline-item">
                    <div class="timeline-dot w-8 h-8 rounded-full bg-fpt-orange text-white flex items-center justify-center font-bold mb-6 relative z-10">{{ $index + 1 }}</div>
                    <div class="font-label-lg text-fpt-orange mb-2 uppercase tracking-wide">{{ $item->start_time->format('H:i') }}</div>
                    <h4 class="font-headline-md text-headline-md text-deep-navy mb-3">{{ $item->title }}</h4>
                    @if($item->speaker)
                        <p class="text-text-muted font-body-sm">{{ $item->speaker->name }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>


@push('scripts')
<script>
    const dateStr = document.getElementById('countdown-wrapper')?.getAttribute('data-date');
    const eventDate = new Date(dateStr).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = eventDate - now;

        if (distance < 0) {
            document.getElementById('countdown-wrapper').style.display = 'none';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('days').innerText = days.toString().padStart(2, '0');
        document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
        document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
    }

    if (document.getElementById('countdown-wrapper')) {
        setInterval(updateCountdown, 1000);
        updateCountdown();
    }

    // Like logic
    document.getElementById('like-btn').addEventListener('click', function() {
        const eventId = this.dataset.eventId;
        const btn = this;
        const countSpan = document.getElementById('likes-count');

        fetch(`/events/${eventId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                countSpan.innerText = data.likes_count;
                btn.classList.add('text-red-400', 'border-red-400/50');
                btn.querySelector('.material-symbols-outlined').classList.add('text-red-400');
                btn.style.animation = 'pulse 0.5s ease-in-out';
                setTimeout(() => btn.style.animation = '', 500);
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endpush
@endsection
