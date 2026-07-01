@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer {
    display: none !important;
}

:root {
    --bg-dark: #0B0F19;
    --accent-orange: #F97316;
    --accent-orange-lt: rgba(249, 115, 22, 0.15);
    --card-bg: rgba(255, 255, 255, 0.03);
    --card-border: rgba(255, 255, 255, 0.08);
    --text-primary: #F3F4F6;
    --text-secondary: #9CA3AF;
}

.t4-body {
    background-color: var(--bg-dark);
    color: var(--text-primary);
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    line-height: 1.6;
}

/* NAV */
.t4-nav {
    border-bottom: 1px solid var(--card-border);
    background: rgba(11, 15, 25, 0.8);
    backdrop-filter: blur(12px);
    padding: 0 48px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
}
.t4-nav-logo {
    color: var(--text-primary);
    font-weight: 800;
    font-size: 17px;
    text-decoration: none;
    letter-spacing: -0.02em;
    display: flex;
    align-items: center;
    gap: 8px;
}
.t4-nav-logo span {
    color: var(--accent-orange);
}
.t4-nav-links {
    display: flex;
    gap: 28px;
}
.t4-nav-links a {
    color: var(--text-secondary);
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    transition: color .2s;
}
.t4-nav-links a:hover {
    color: var(--text-primary);
}
.t4-nav-cta {
    background: var(--accent-orange);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 18px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s;
}
.t4-nav-cta:hover {
    background: #ea580c;
}

/* HERO */
.t4-hero {
    padding: 96px 48px 80px;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.t4-hero-blur {
    position: absolute;
    top: -10%;
    left: 50%;
    transform: translateX(-50%);
    width: 600px;
    height: 300px;
    background: radial-gradient(ellipse, rgba(249, 115, 22, 0.15) 0%, transparent 80%);
    pointer-events: none;
}
.t4-hero-inner {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
    z-index: 10;
}
.t4-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--accent-orange-lt);
    border: 1px solid rgba(249, 115, 22, 0.3);
    border-radius: 99px;
    padding: 6px 16px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--accent-orange);
    margin-bottom: 24px;
}
.t4-hero h1 {
    font-size: clamp(36px, 5vw, 64px);
    font-weight: 800;
    color: #fff;
    line-height: 1.1;
    letter-spacing: -0.03em;
    margin-bottom: 20px;
}
.t4-hero-sub {
    font-size: 16px;
    color: var(--text-secondary);
    max-width: 640px;
    margin: 0 auto 40px;
    line-height: 1.8;
}
.t4-hero-meta {
    display: inline-flex;
    gap: 24px;
    flex-wrap: wrap;
    justify-content: center;
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    padding: 12px 28px;
    border-radius: 99px;
    margin-bottom: 40px;
}
.t4-hero-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-primary);
    font-size: 13.5px;
}
.t4-hero-meta-item svg {
    width: 16px;
    height: 16px;
    color: var(--accent-orange);
}

/* COUNTDOWN */
.t4-countdown {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 60px;
}
.t4-cd-box {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 12px;
    width: 80px;
    height: 80px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.t4-cd-num {
    font-size: 24px;
    font-weight: 800;
    color: #fff;
    line-height: 1;
}
.t4-cd-label {
    font-size: 10px;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 4px;
}

/* CONTENT CONTAINER */
.t4-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 48px 80px;
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 48px;
}
@media (max-width: 991px) {
    .t4-container {
        grid-template-columns: 1fr;
        padding: 0 24px 60px;
    }
}

.t4-section-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
    padding-left: 12px;
}
.t4-section-title::before {
    content: '';
    position: absolute;
    left: 0;
    top: 6px;
    bottom: 6px;
    width: 3px;
    background: var(--accent-orange);
    border-radius: 2px;
}

.t4-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 32px;
}

/* SPEAKERS */
.t4-speaker-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.t4-speaker-row {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 16px;
    background: rgba(255,255,255,0.01);
    border: 1px solid var(--card-border);
    border-radius: 12px;
    transition: all 0.2s;
}
.t4-speaker-row:hover {
    background: rgba(255, 115, 22, 0.03);
    border-color: rgba(249, 115, 22, 0.2);
}
.t4-speaker-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--accent-orange-lt);
    display: grid;
    place-items: center;
    font-size: 24px;
    overflow: hidden;
}
.t4-speaker-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t4-speaker-details {
    flex: 1;
}
.t4-speaker-name {
    font-size: 15px;
    font-weight: 700;
}
.t4-speaker-role {
    font-size: 12.5px;
    color: var(--text-secondary);
}
.t4-speaker-topic {
    font-size: 12px;
    color: var(--accent-orange);
    font-weight: 500;
    margin-top: 2px;
}

/* SCHEDULE */
.t4-timeline {
    display: flex;
    flex-direction: column;
    gap: 20px;
    position: relative;
    padding-left: 20px;
}
.t4-timeline::before {
    content: '';
    position: absolute;
    left: 4px;
    top: 8px;
    bottom: 8px;
    width: 1px;
    background: var(--card-border);
}
.t4-timeline-item {
    position: relative;
}
.t4-timeline-dot {
    position: absolute;
    left: -20px;
    top: 8px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: var(--accent-orange);
    border: 2px solid var(--bg-dark);
}
.t4-timeline-time {
    font-size: 12px;
    font-weight: 700;
    color: var(--accent-orange);
    margin-bottom: 2px;
}
.t4-timeline-title {
    font-size: 14.5px;
    font-weight: 700;
}
.t4-timeline-speaker {
    font-size: 12px;
    color: var(--text-secondary);
}

/* SIDEBAR REGISTER */
.t4-side-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 20px;
}
.t4-side-price {
    font-size: 28px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 16px;
}
.t4-side-price span {
    font-size: 13px;
    color: var(--text-secondary);
    font-weight: 400;
}
.t4-btn-register {
    display: block;
    width: 100%;
    background: var(--accent-orange);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 12px;
    text-align: center;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s;
}
.t4-btn-register:hover {
    background: #ea580c;
}
.t4-side-info-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.t4-side-info-item {
    display: flex;
    align-items: center;
    gap: 12px;
}
.t4-side-info-icon {
    font-size: 18px;
    color: var(--accent-orange);
}
.t4-side-info-content {
    display: flex;
    flex-direction: column;
}
.t4-side-info-label {
    font-size: 10px;
    color: var(--text-secondary);
    text-transform: uppercase;
}
.t4-side-info-val {
    font-size: 13.5px;
    font-weight: 600;
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

@section('content')
<div class="t4-body">
    <!-- Navbar -->
    <nav class="t4-nav">
        <a href="{{ route('home') }}" class="t4-nav-logo">
            <span>◇</span> UniEvent Workshop
        </a>
        <div class="t4-nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('home') }}#events">Sự kiện</a>
            <a href="{{ route('archive') }}">Lưu trữ</a>
        </div>
        <a href="#t4-reg" class="t4-nav-cta">Tham gia ngay</a>
    </nav>

    <!-- Hero -->
    <div class="t4-hero">
        <div class="t4-hero-blur"></div>
        <div class="t4-hero-inner">
            <div class="t4-hero-badge">
                <span>⚡</span> {{ $event->category ? $event->category->name : 'Workshop' }}
            </div>
            <h1 style="{!! $titleStyleStr !!}">{!! nl2br(e($event->title)) !!}</h1>
            <p class="t4-hero-sub" style="{!! $descStyleStr !!}">
                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 180) }}
            </p>

            <div class="t4-countdown">
                <div class="t4-cd-box"><span class="t4-cd-num" id="t4-days">00</span><span class="t4-cd-label">Ngày</span></div>
                <div class="t4-cd-box"><span class="t4-cd-num" id="t4-hours">00</span><span class="t4-cd-label">Giờ</span></div>
                <div class="t4-cd-box"><span class="t4-cd-num" id="t4-mins">00</span><span class="t4-cd-label">Phút</span></div>
            </div>

            <div class="t4-hero-meta">
                <div class="t4-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    {{ $event->event_date->translatedFormat('d F Y') }}
                </div>
                <div class="t4-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    {{ $event->event_date->format('H:i') }}
                </div>
                @if($event->location)
                <div class="t4-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $event->location }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="t4-container">
        <div class="t4-main">
            <div class="t4-card">
                <h2 class="t4-section-title">Về buổi Workshop</h2>
                <div style="color: var(--text-secondary); line-height: 1.8;">
                    {!! $event->description !!}
                </div>
            </div>

            <!-- Speakers -->
            @if($event->speakers->count() > 0)
            <div class="t4-card">
                <h2 class="t4-section-title">Diễn giả chính</h2>
                <div class="t4-speaker-list">
                    @foreach($event->speakers as $speaker)
                    <div class="t4-speaker-row">
                        <div class="t4-speaker-avatar">
                            @if($speaker->photo_url)
                                <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" alt="{{ $speaker->name }}">
                            @else
                                👨‍💻
                            @endif
                        </div>
                        <div class="t4-speaker-details">
                            <div class="t4-speaker-name">{{ $speaker->name }}</div>
                            <div class="t4-speaker-role">{{ $speaker->title }}</div>
                            @if($speaker->bio)
                                <div class="t4-speaker-topic">{{ $speaker->bio }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Timeline -->
            @if($event->scheduleItems->count() > 0)
            <div class="t4-card">
                <h2 class="t4-section-title">Lịch trình nội dung</h2>
                <div class="t4-timeline">
                    @foreach($event->scheduleItems as $item)
                    <div class="t4-timeline-item">
                        <div class="t4-timeline-dot"></div>
                        <div class="t4-timeline-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}</div>
                        <div class="t4-timeline-title">{{ $item->title }}</div>
                        @if($item->speaker)
                            <div class="t4-timeline-speaker">Chia sẻ: {{ $item->speaker->name }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="t4-sidebar" id="t4-reg">
            <div class="t4-side-card">
                <div class="t4-side-price">Miễn phí <span>/ Giới hạn chỗ</span></div>
                <a href="mailto:admin@school.edu?subject=Đăng ký Workshop {{ $event->title }}" class="t4-btn-register">Đăng ký tham gia ngay →</a>
            </div>

            <div class="t4-side-card">
                <div class="t4-side-info-list">
                    <div class="t4-side-info-item">
                        <div class="t4-side-info-icon">📅</div>
                        <div class="t4-side-info-content">
                            <span class="t4-side-info-label">Ngày tổ chức</span>
                            <span class="t4-side-info-val">{{ $event->event_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    @if($event->location)
                    <div class="t4-side-info-item">
                        <div class="t4-side-info-icon">📍</div>
                        <div class="t4-side-info-content">
                            <span class="t4-side-info-label">Địa điểm</span>
                            <span class="t4-side-info-val">{{ $event->location }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="t4-side-info-item">
                        <div class="t4-side-info-icon">🔥</div>
                        <div class="t4-side-info-content">
                            <span class="t4-side-info-label">Cấp chứng nhận</span>
                            <span class="t4-side-info-val">Có chứng nhận tham gia</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<script>
    // Countdown calculation
    const eventTime = new Date("{{ $event->event_date->toIso8601String() }}").getTime();
    function runTimer() {
        const diff = eventTime - new Date().getTime();
        if (diff < 0) return;
        
        document.getElementById('t4-days').innerText = String(Math.floor(diff / (1000*60*60*24))).padStart(2, '0');
        document.getElementById('t4-hours').innerText = String(Math.floor((diff % (1000*60*60*24)) / (1000*60*60))).padStart(2, '0');
        document.getElementById('t4-mins').innerText = String(Math.floor((diff % (1000*60*60)) / (1000*60))).padStart(2, '0');
    }
    setInterval(runTimer, 1000);
    runTimer();
</script>
@endsection
