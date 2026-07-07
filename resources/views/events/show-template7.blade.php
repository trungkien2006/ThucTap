@extends('layouts.frontend')

{{--
  ================================================================
  MẪU 7 — TẠP CHÍ TỐT NGHIỆP (Graduation Magazine / Editorial)
  ----------------------------------------------------------------
  - Phù hợp cho sự kiện: Lễ Tốt Nghiệp, Lễ Trưởng Thành, Kỷ Yếu
  - Màu sắc: Trắng Kem (Cream), Đen Tuyền (Ink), Vàng Đồng (Gold)
  - Bố cục: Cổ điển, thanh lịch, typography lớn (Serif), giống bài báo
  ================================================================
--}}

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
/* Removed hide navbar rule to comply with layout rule */

:root {
    --mag-bg: #F9F8F3;        /* Cream/Paper */
    --mag-ink: #1C1A17;       /* Deep dark */
    --mag-gold: #C5A059;      /* Elegant Gold */
    --mag-gray: #78736B;
    --mag-border: #E8E5DF;
    
    --font-serif: 'Playfair Display', serif;
    --font-sans: 'DM Sans', sans-serif;
    
    --container-w: 800px;
}

body { background-color: #EFECE5; }

.t7-wrapper {
    max-width: var(--container-w);
    margin: 0 auto;
    background: var(--mag-bg);
    color: var(--mag-ink);
    font-family: var(--font-sans);
    font-size: 15px;
    line-height: 1.8;
    min-height: 100vh;
    box-shadow: 0 0 50px rgba(0,0,0,0.05);
}

/* ── HERO ── */
.t7-hero {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    overflow: hidden;
}
.t7-hero-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t7-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(28,26,23,0) 0%, rgba(28,26,23,0.2) 40%, rgba(28,26,23,0.85) 100%);
}
.t7-hero-content {
    position: relative;
    z-index: 10;
    padding: 60px 40px;
    text-align: center;
    color: #fff;
}
.t7-hero-issue {
    font-family: var(--font-sans);
    font-size: 11px;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--mag-gold);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}
.t7-hero-issue::before, .t7-hero-issue::after {
    content: '';
    width: 40px;
    height: 1px;
    background: var(--mag-gold);
}
.t7-hero h1 {
    font-family: var(--font-serif);
    font-weight: 600;
    font-size: clamp(40px, 8vw, 64px);
    line-height: 1.1;
    margin-bottom: 15px;
    letter-spacing: -0.02em;
}
.t7-hero-sub {
    font-family: var(--font-serif);
    font-style: italic;
    font-size: 20px;
    color: rgba(255,255,255,0.9);
    margin-bottom: 30px;
}
.t7-hero-meta {
    display: inline-flex;
    gap: 30px;
    border-top: 1px solid rgba(255,255,255,0.2);
    border-bottom: 1px solid rgba(255,255,255,0.2);
    padding: 15px 0;
    font-size: 13px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

/* ── COUNTDOWN ── */
.t7-cd-wrap {
    background: var(--mag-ink);
    color: #fff;
    padding: 30px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.t7-cd-text {
    font-family: var(--font-serif);
    font-style: italic;
    font-size: 22px;
    color: var(--mag-gold);
}
.t7-cd-timer {
    display: flex;
    gap: 20px;
}
.t7-cd-item { text-align: center; }
.t7-cd-num {
    display: block;
    font-family: var(--font-serif);
    font-size: 32px;
    line-height: 1;
}
.t7-cd-label {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(255,255,255,0.6);
    margin-top: 5px;
}

/* ── CONTENT CONTAINER ── */
.t7-content {
    padding: 60px 40px;
}

/* ── SECTION HEADER ── */
.t7-section-hd {
    text-align: center;
    margin-bottom: 40px;
}
.t7-section-kicker {
    font-size: 11px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--mag-gray);
    margin-bottom: 10px;
}
.t7-section-title {
    font-family: var(--font-serif);
    font-weight: 600;
    font-size: 36px;
    color: var(--mag-ink);
    position: relative;
    padding-bottom: 15px;
}
.t7-section-title::after {
    content: '';
    position: absolute;
    bottom: 0; left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 2px;
    background: var(--mag-gold);
}

/* ── INTRO ── */
.t7-intro {
    font-size: 16px;
    line-height: 2;
    text-align: center;
    color: var(--mag-gray);
    margin-bottom: 60px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}


/* ── GALLERY (MAGAZINE STYLE) ── */
.t7-gallery { margin-bottom: 80px; }
.t7-gal-item {
    display: flex;
    flex-direction: column;
    margin-bottom: 50px;
}
.t7-gal-img-wrap {
    width: 100%;
    position: relative;
    padding-bottom: 20px;
}
.t7-gal-img-wrap::before {
    content: '';
    position: absolute;
    top: -15px; left: -15px;
    width: 40%; height: 40%;
    border-top: 1px solid var(--mag-ink);
    border-left: 1px solid var(--mag-ink);
    z-index: 1;
}
.t7-gal-img {
    width: 100%;
    aspect-ratio: 4/5;
    object-fit: cover;
    position: relative;
    z-index: 2;
    filter: grayscale(20%) contrast(110%);
}
.t7-gal-content {
    padding: 20px 0 0 20px;
    border-left: 1px solid var(--mag-border);
    margin-left: 20px;
}
.t7-gal-caption {
    font-family: var(--font-serif);
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 10px;
}
.t7-gal-text {
    font-size: 14px;
    color: var(--mag-gray);
}
@media (min-width: 600px) {
    .t7-gal-item:nth-child(even) {
        flex-direction: row-reverse;
        align-items: center;
        gap: 40px;
    }
    .t7-gal-item:nth-child(odd) {
        flex-direction: row;
        align-items: center;
        gap: 40px;
    }
    .t7-gal-img-wrap { width: 55%; padding-bottom: 0; }
    .t7-gal-content { width: 45%; padding: 0; border: none; margin: 0; }
    .t7-gal-img { aspect-ratio: 3/4; }
}

/* ── SPEAKERS / GUESTS ── */
.t7-speakers { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 60px; }
@media (max-width:768px){
    .t7-speakers { grid-template-columns: 1fr; }
}
.t7-speaker-card { text-align: center; }
.t7-speaker-img { 
    width: 100px; height: 100px; border-radius: 50%; object-fit: cover; 
    margin: 0 auto 15px; border: 1px solid var(--mag-border); padding: 4px; 
    filter: grayscale(100%); transition: filter 0.3s ease; 
}
.t7-speaker-card:hover .t7-speaker-img { filter: grayscale(0%); }
.t7-speaker-name { 
    font-family: var(--font-serif); font-size: 18px; font-weight: 600; 
    margin-bottom: 4px; 
}
.t7-speaker-role { 
    font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--mag-gold); 
}

/* ── SCHEDULE (TIMELINE) ── */
.t7-timeline {
    position: relative;
    max-width: 600px;
    margin: 0 auto 80px;
}
.t7-timeline::before {
    content: '';
    position: absolute;
    top: 0; bottom: 0; left: 50%;
    transform: translateX(-50%);
    width: 1px;
    background: var(--mag-border);
}
.t7-tl-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    position: relative;
}
.t7-tl-time {
    width: 45%;
    text-align: right;
    font-family: var(--font-serif);
    font-size: 24px;
    font-weight: 600;
    color: var(--mag-gold);
}
.t7-tl-dot {
    width: 11px; height: 11px;
    border-radius: 50%;
    background: var(--mag-ink);
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    border: 3px solid var(--mag-bg);
}
.t7-tl-content {
    width: 45%;
    text-align: left;
}
.t7-tl-title {
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 5px;
}
.t7-tl-desc {
    font-size: 13px;
    color: var(--mag-gray);
    line-height: 1.5;
}
/* Alternate */
.t7-tl-item:nth-child(even) { flex-direction: row-reverse; }
.t7-tl-item:nth-child(even) .t7-tl-time { text-align: left; }
.t7-tl-item:nth-child(even) .t7-tl-content { text-align: right; }

@media (max-width: 600px) {
    .t7-timeline::before { left: 20px; }
    .t7-tl-item, .t7-tl-item:nth-child(even) { flex-direction: column; align-items: flex-start; padding-left: 50px; }
    .t7-tl-time { width: 100%; text-align: left !important; font-size: 20px; margin-bottom: 5px; }
    .t7-tl-dot { left: 20px; }
    .t7-tl-content { width: 100%; text-align: left !important; }
}

/* ── EVENT TIMING ── */
.t7-event-time {
    font-family: var(--font-serif);
    font-size: 18px;
    text-align: center;
    margin-bottom: 60px;
    color: var(--mag-gold);
    font-style: italic;
}

/* ── PREV / NEXT NAV ── */
.t7-nav {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
    border-top: 1px solid var(--mag-border);
    padding-top: 30px;
}
.t7-nav-item {
    text-decoration: none;
    color: var(--mag-ink);
    transition: opacity 0.2s;
}
.t7-nav-item:hover { opacity: 0.7; }
.t7-nav-label {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: var(--mag-gray);
    margin-bottom: 4px;
}
.t7-nav-title {
    font-family: var(--font-serif);
    font-weight: 600;
    font-size: 18px;
}

/* ── BOTTOM ACTIONS ── */
.t7-bottom {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    padding: 40px 0;
    border-top: 1px solid var(--mag-border);
}
.t7-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 30px;
    font-family: var(--font-sans);
    font-weight: 600;
    font-size: 13px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    cursor: pointer;
    border: 1px solid var(--mag-ink);
    transition: all 0.3s;
    background: transparent;
    color: var(--mag-ink);
    text-decoration: none;
}
.t7-btn-like.liked {
    background: var(--mag-ink);
    color: #fff;
}
.t7-btn-like:hover { background: var(--mag-ink); color: #fff; }
.t7-btn-views { border-color: transparent; pointer-events: none; color: var(--mag-gray); }
.t7-btn-share {
    background: var(--mag-ink);
    color: #fff;
}
.t7-btn-share:hover { background: var(--mag-gray); border-color: var(--mag-gray); }

.t7-footer {
    text-align: center;
    padding: 30px;
    font-size: 12px;
    color: var(--mag-gray);
    letter-spacing: 0.05em;
    background: #EFECE5;
}

</style>
@endpush

@php
    $titleStyles = [];
    if (!empty($event->title_font_family)) {
        $titleStyles[] = "font-family: '{$event->title_font_family}', serif;";
    }
    if (!empty($event->title_font_size)) {
        $titleStyles[] = "font-size: {$event->title_font_size}px;";
    }
    if (!empty($event->title_color)) {
        $titleStyles[] = "color: {$event->title_color} !important;";
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

@section('content')
<div class="t7-wrapper">
    
    {{-- HERO --}}
    <div class="t7-hero">
        @if($event->bannerImage)
            <img src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}" class="t7-hero-bg" alt="{{ $event->title }}">
        @else
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600" class="t7-hero-bg" alt="Graduation">
        @endif
        <div class="t7-hero-overlay"></div>
        <div class="t7-hero-content">
            <div class="t7-hero-issue">{{ $event->category ? $event->category->name : 'LỄ TỐT NGHIỆP' }}</div>
            <h1 style="{!! $titleStyleStr !!}">{!! nl2br(e($event->title)) !!}</h1>
            <div class="t7-hero-sub">Ấn Bản Đặc Biệt</div>
            <div class="t7-hero-meta">
                <span>{{ $event->event_date->format('d.m.Y') }}</span>
                <span>•</span>
                <span>{{ $event->location ?? 'Địa điểm đang cập nhật' }}</span>
            </div>
        </div>
    </div>

    {{-- COUNTDOWN --}}
    @if($event->event_date > now())
    <div class="t7-cd-wrap" id="t7-countdown" data-date="{{ $event->event_date->format('Y-m-d\TH:i:s') }}">
        <div class="t7-cd-text">Chờ đón khoảnh khắc...</div>
        <div class="t7-cd-timer">
            <div class="t7-cd-item"><span class="t7-cd-num" id="t7-days">00</span><div class="t7-cd-label">Ngày</div></div>
            <div class="t7-cd-item"><span class="t7-cd-num" id="t7-hours">00</span><div class="t7-cd-label">Giờ</div></div>
            <div class="t7-cd-item"><span class="t7-cd-num" id="t7-mins">00</span><div class="t7-cd-label">Phút</div></div>
        </div>
    </div>
    @endif

    <div class="t7-content">
        
        {{-- DESCRIPTION --}}
        <div class="t7-section-hd">
            <div class="t7-section-kicker">Chương 1</div>
            <h2 class="t7-section-title">Câu Chuyện Của Chúng Tôi</h2>
        </div>
        <div class="t7-intro" style="{!! $descStyleStr !!}">
            {!! $event->description !!}
        </div>

        {{-- TIME DISPLAY --}}
        <div class="t7-event-time">
            Bắt đầu: {{ $event->event_date->format('H:i A') }} 
            @if($event->end_date)
                — Kết thúc: {{ $event->end_date->format('H:i A') }}
            @endif
        </div>

        {{-- GALLERY --}}
        @if($event->galleryImages->count() > 0)
        <div class="t7-section-hd">
            <div class="t7-section-kicker">Chương 2</div>
            <h2 class="t7-section-title">Khung Hình Kỷ Niệm</h2>
        </div>
        <div class="t7-gallery">
            @foreach($event->galleryImages as $block)
            <div class="t7-gal-item">
                <div class="t7-gal-img-wrap">
                    @if($block->url)
                        @if($block->type === 'video')
                            <video src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="t7-gal-img" autoplay loop muted playsinline controls></video>
                        @else
                            <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="t7-gal-img" alt="">
                        @endif
                    @endif
                </div>
                <div class="t7-gal-content">
                    @if($block->caption) <h3 class="t7-gal-caption">{{ $block->caption }}</h3> @endif
                    @if(!empty($block->content)) <div class="t7-gal-text">{!! $block->content !!}</div> @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- SPEAKERS / GUESTS --}}
        @if($event->speakers->count() > 0)
        <div class="t7-section-hd">
            <div class="t7-section-kicker">Chương 3</div>
            <h2 class="t7-section-title">Gương Mặt Tiêu Biểu</h2>
        </div>
        <div class="t7-speakers">
            @foreach($event->speakers as $speaker)
            <div class="t7-speaker-card">
                @if($speaker->photo_url)
                    <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" class="t7-speaker-img" alt="{{ $speaker->name }}">
                @else
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80" class="t7-speaker-img" alt="{{ $speaker->name }}">
                @endif
                <div class="t7-speaker-name">{{ $speaker->name }}</div>
                <div class="t7-speaker-role">{{ $speaker->title }}</div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- SCHEDULE --}}
        @if($event->scheduleItems->count() > 0)
        <div class="t7-section-hd">
            <div class="t7-section-kicker">Chương 4</div>
            <h2 class="t7-section-title">Lịch Trình Sự Kiện</h2>
        </div>
        <div class="t7-timeline">
            @foreach($event->scheduleItems as $item)
            <div class="t7-tl-item">
                <div class="t7-tl-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}{{ $item->end_time ? ' - ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') : '' }}</div>
                <div class="t7-tl-dot"></div>
                <div class="t7-tl-content">
                    <div class="t7-tl-title">{{ $item->title }}</div>
                    @if($item->speaker) <div class="t7-tl-desc">Cùng {{ $item->speaker->name }}</div> @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        {{-- PREV / NEXT NAV --}}
        @if(isset($previousEvent) || isset($nextEvent))
        <div class="t7-nav">
            <div style="text-align: left;">
                @if(isset($previousEvent) && $previousEvent)
                <a href="{{ route('events.show', $previousEvent->slug) }}" class="t7-nav-item">
                    <div class="t7-nav-label">Sự kiện trước</div>
                    <div class="t7-nav-title">{{ $previousEvent->title }}</div>
                </a>
                @endif
            </div>
            <div style="text-align: right;">
                @if(isset($nextEvent) && $nextEvent)
                <a href="{{ route('events.show', $nextEvent->slug) }}" class="t7-nav-item">
                    <div class="t7-nav-label">Sự kiện tiếp</div>
                    <div class="t7-nav-title">{{ $nextEvent->title }}</div>
                </a>
                @endif
            </div>
        </div>
        @endif

        {{-- ACTIONS --}}
        <div class="t7-bottom" x-data="{ copied: false }">
            <button id="like-btn" data-event-id="{{ $event->id }}" class="t7-btn t7-btn-like {{ session()->has('liked_events.' . $event->id) ? 'liked' : '' }}">
                YÊU THÍCH <span id="likes-count">({{ $event->likes_count }})</span>
            </button>
            <div class="t7-btn t7-btn-views">
                LƯỢT XEM ({{ $event->views_count }})
            </div>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="t7-btn t7-btn-share">
                CHIA SẺ
            </a>
            <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)" class="t7-btn" style="position: relative;">
                SAO CHÉP LINK
                <span x-show="copied" x-transition style="display:none;position:absolute;bottom:100%;left:50%;transform:translateX(-50%);margin-bottom:10px;background:#1C1A17;color:white;font-size:10px;padding:4px 8px;border-radius:4px;white-space:nowrap;letter-spacing:0;">Đã sao chép!</span>
            </button>
        </div>
    </div>
    
    <footer class="t7-footer">
        © {{ date('Y') }} UniEvent — Lưu giữ những khoảnh khắc đáng nhớ.
    </footer>
</div>

@include('components.event-fab-menu', ['event' => $event])

<script>
    const cdEl = document.getElementById('t7-countdown');
    if (cdEl) {
        const targetDate = new Date(cdEl.getAttribute('data-date')).getTime();
        function updateCountdown() {
            const now = new Date().getTime();
            const diff = targetDate - now;
            if (diff < 0) {
                document.getElementById('t7-days').innerText = "00";
                document.getElementById('t7-hours').innerText = "00";
                document.getElementById('t7-mins').innerText = "00";
                return;
            }
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById('t7-days').innerText = String(days).padStart(2, '0');
            document.getElementById('t7-hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('t7-mins').innerText = String(mins).padStart(2, '0');
        }
        setInterval(updateCountdown, 1000);
        updateCountdown();
    }

    const likeBtn = document.getElementById('like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            const eventId = this.dataset.eventId;
            const countSpan = document.getElementById('likes-count');
            fetch(`/events/${eventId}/like`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    countSpan.innerText = '(' + data.likes_count + ')';
                    if (data.liked) {
                        likeBtn.classList.add('liked');
                    } else {
                        likeBtn.classList.remove('liked');
                    }
                }
            })
            .catch(err => console.error(err));
        });
    }
</script>
@endsection
