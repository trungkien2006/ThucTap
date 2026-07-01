@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer {
    display: none !important;
}

:root {
    --bg-gala: #0D0814;
    --primary-rose: #EC4899;
    --accent-gold: #F59E0B;
    --text-primary: #FFF1F2;
    --text-secondary: #FDA4AF;
    --border-gala: rgba(236, 72, 153, 0.15);
}

.t5-body {
    background-color: var(--bg-gala);
    color: var(--text-primary);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    line-height: 1.6;
}

/* NAV */
.t5-nav {
    background: rgba(13, 8, 20, 0.95);
    border-bottom: 1px solid var(--border-gala);
    padding: 0 48px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
}
.t5-nav-logo {
    color: #fff;
    font-family: 'Cinzel', serif;
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 0.1em;
    text-decoration: none;
}
.t5-nav-logo span {
    color: var(--primary-rose);
}
.t5-nav-links {
    display: flex;
    gap: 28px;
}
.t5-nav-links a {
    color: rgba(255,255,255,0.7);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s;
}
.t5-nav-links a:hover {
    color: #fff;
}
.t5-nav-cta {
    background: linear-gradient(to right, var(--primary-rose), #D946EF);
    color: #fff;
    border: none;
    border-radius: 99px;
    padding: 8px 24px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: transform 0.2s, opacity 0.2s;
}
.t5-nav-cta:hover {
    transform: scale(1.03);
    opacity: 0.95;
}

/* HERO */
.t5-hero {
    position: relative;
    padding: 120px 48px 90px;
    text-align: center;
    background-size: cover;
    background-position: center;
    overflow: hidden;
}
.t5-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(13,8,20,0.4) 0%, rgba(13,8,20,0.95) 100%);
}
.t5-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 800px;
    margin: 0 auto;
}
.t5-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(236, 72, 153, 0.15);
    border: 1px solid rgba(236, 72, 153, 0.4);
    border-radius: 99px;
    padding: 6px 18px;
    font-family: 'Cinzel', serif;
    font-size: 11px;
    font-weight: 700;
    color: var(--text-secondary);
    margin-bottom: 24px;
    letter-spacing: 0.1em;
}
.t5-hero h1 {
    font-family: 'Cinzel', serif;
    font-size: clamp(38px, 5.5vw, 68px);
    font-weight: 800;
    line-height: 1.1;
    color: #fff;
    text-shadow: 0 0 40px rgba(236, 72, 153, 0.3);
    margin-bottom: 24px;
}
.t5-hero-sub {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 18px;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto 40px;
}
.t5-hero-meta {
    display: inline-flex;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border-gala);
    padding: 14px 32px;
    border-radius: 99px;
    gap: 32px;
    flex-wrap: wrap;
    justify-content: center;
}
.t5-hero-meta-item {
    font-size: 13.5px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.t5-hero-meta-item svg {
    color: var(--primary-rose);
    width: 16px;
    height: 16px;
}

/* COUNTDOWN */
.t5-countdown {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-bottom: 60px;
}
.t5-cd-unit {
    background: linear-gradient(135deg, rgba(236, 72, 153, 0.05) 0%, rgba(217, 70, 239, 0.05) 100%);
    border: 1px solid var(--border-gala);
    border-radius: 14px;
    width: 90px;
    padding: 16px 0;
    text-align: center;
}
.t5-cd-num {
    font-family: 'Cinzel', serif;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
}
.t5-cd-label {
    font-size: 10px;
    text-transform: uppercase;
    color: var(--text-secondary);
    letter-spacing: 0.1em;
}

/* CONTENT CONTAINER */
.t5-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 48px 80px;
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 48px;
}
@media (max-width: 991px) {
    .t5-container {
        grid-template-columns: 1fr;
        padding: 0 24px 60px;
    }
}

.t5-section-title {
    font-family: 'Cinzel', serif;
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 24px;
    letter-spacing: 0.05em;
    border-bottom: 1px solid var(--border-gala);
    padding-bottom: 8px;
    display: inline-block;
}

.t5-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid var(--border-gala);
    border-radius: 20px;
    padding: 36px;
    margin-bottom: 32px;
}

/* SPEAKERS / ARTISTS */
.t5-artists-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}
.t5-artist-card {
    text-align: center;
    background: rgba(255,255,255,0.01);
    border: 1px solid var(--border-gala);
    border-radius: 16px;
    padding: 24px 16px;
    transition: transform 0.20s;
}
.t5-artist-card:hover {
    transform: translateY(-4px);
    background: rgba(236, 72, 153, 0.03);
}
.t5-artist-photo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin: 0 auto 16px;
    overflow: hidden;
    border: 2px solid var(--primary-rose);
}
.t5-artist-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t5-artist-name {
    font-family: 'Cinzel', serif;
    font-size: 15px;
    font-weight: 700;
}
.t5-artist-role {
    font-size: 12px;
    color: var(--text-secondary);
    margin-top: 4px;
}

/* TIMELINE / PERFORMANCES */
.t5-performance-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.t5-performance-item {
    display: flex;
    gap: 24px;
    padding: 16px 0;
    border-bottom: 1px dashed rgba(236, 72, 153, 0.15);
}
.t5-performance-item:last-child {
    border-bottom: none;
}
.t5-performance-time {
    font-family: 'Cinzel', serif;
    font-size: 14px;
    font-weight: 700;
    color: var(--primary-rose);
    width: 70px;
    flex-shrink: 0;
}
.t5-performance-title {
    font-size: 14.5px;
    font-weight: 600;
}
.t5-performance-artist {
    font-size: 12.5px;
    color: var(--text-secondary);
    margin-top: 2px;
}

/* SIDEBAR REGISTER */
.t5-side-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid var(--border-gala);
    border-radius: 20px;
    padding: 28px;
    margin-bottom: 24px;
    text-align: center;
}
.t5-side-price {
    font-family: 'Cinzel', serif;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 20px;
}
.t5-btn-ticket {
    display: block;
    width: 100%;
    background: linear-gradient(to right, var(--primary-rose), #D946EF);
    color: #fff;
    border: none;
    border-radius: 99px;
    padding: 14px;
    text-align: center;
    font-weight: 700;
    text-decoration: none;
    transition: opacity 0.2s;
}
.t5-btn-ticket:hover {
    opacity: 0.9;
}
.t5-side-info-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    text-align: left;
    margin-top: 20px;
}
.t5-side-info-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}
.t5-side-info-icon {
    color: var(--primary-rose);
}
.t5-side-info-label {
    font-size: 10px;
    color: var(--text-secondary);
    text-transform: uppercase;
}
.t5-side-info-val {
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
<div class="t5-body">
    <!-- Navbar -->
    <nav class="t5-nav">
        <a href="{{ route('home') }}" class="t5-nav-logo">
            <span>♛</span> UniEvent Gala
        </a>
        <div class="t5-nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('home') }}#events">Sự kiện</a>
            <a href="{{ route('archive') }}">Lưu trữ</a>
        </div>
        <a href="#t5-reg" class="t5-nav-cta">Đặt vé ngay</a>
    </nav>

    <!-- Hero -->
    <div class="t5-hero" style="@if($event->bannerImage) background-image: linear-gradient(rgba(13,8,20,0.6), rgba(13,8,20,0.95)), url('{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}'); @endif">
        <div class="t5-hero-overlay"></div>
        <div class="t5-hero-inner">
            <div class="t5-hero-badge">
                <span>✦</span> {{ $event->category ? $event->category->name : 'Nghệ thuật & Âm nhạc' }}
            </div>
            <h1 style="{!! $titleStyleStr !!}">{!! nl2br(e($event->title)) !!}</h1>
            <p class="t5-hero-sub" style="{!! $descStyleStr !!}">
                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 160) }}
            </p>

            <div class="t5-countdown">
                <div class="t5-cd-unit"><div class="t5-cd-num" id="t5-days">00</div><div class="t5-cd-label">Ngày</div></div>
                <div class="t5-cd-unit"><div class="t5-cd-num" id="t5-hours">00</div><div class="t5-cd-label">Giờ</div></div>
                <div class="t5-cd-unit"><div class="t5-cd-num" id="t5-mins">00</div><div class="t5-cd-label">Phút</div></div>
            </div>

            <div class="t5-hero-meta">
                <div class="t5-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    {{ $event->event_date->translatedFormat('d/m/Y') }}
                </div>
                <div class="t5-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    {{ $event->event_date->format('H:i') }}
                </div>
                @if($event->location)
                <div class="t5-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $event->location }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="t5-container">
        <div class="t5-main">
            <div class="t5-card">
                <h2 class="t5-section-title">Giới thiệu đêm hội</h2>
                <div style="color: var(--text-secondary); line-height: 1.8;">
                    {!! $event->description !!}
                </div>
            </div>

            <!-- Artists -->
            @if($event->speakers->count() > 0)
            <div class="t5-card">
                <h2 class="t5-section-title">Khách mời & Nghệ sĩ</h2>
                <div class="t5-artists-grid">
                    @foreach($event->speakers as $speaker)
                    <div class="t5-artist-card">
                        <div class="t5-artist-photo">
                            @if($speaker->photo_url)
                                <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" alt="{{ $speaker->name }}">
                            @else
                                🎤
                            @endif
                        </div>
                        <div class="t5-artist-name">{{ $speaker->name }}</div>
                        <div class="t5-artist-role">{{ $speaker->title }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Performances -->
            @if($event->scheduleItems->count() > 0)
            <div class="t5-card">
                <h2 class="t5-section-title">Chương trình biểu diễn</h2>
                <div class="t5-performance-list">
                    @foreach($event->scheduleItems as $item)
                    <div class="t5-performance-item">
                        <div class="t5-performance-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}</div>
                        <div>
                            <div class="t5-performance-title">{{ $item->title }}</div>
                            @if($item->speaker)
                                <div class="t5-performance-artist">Khách mời: {{ $item->speaker->name }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="t5-sidebar" id="t5-reg">
            <div class="t5-side-card">
                <div class="t5-side-price">Vé mời miễn phí</div>
                <a href="mailto:admin@school.edu?subject=Đăng ký vé Gala {{ $event->title }}" class="t5-btn-ticket">Nhận vé mời →</a>
                
                <div class="t5-side-info-list">
                    <div class="t5-side-info-item">
                        <div class="t5-side-info-icon">📅</div>
                        <div>
                            <span class="t5-side-info-label">Thời gian</span>
                            <span class="t5-side-info-val" style="display:block;">{{ $event->event_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    @if($event->location)
                    <div class="t5-side-info-item">
                        <div class="t5-side-info-icon">📍</div>
                        <div>
                            <span class="t5-side-info-label">Địa điểm</span>
                            <span class="t5-side-info-val" style="display:block;">{{ $event->location }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="t5-side-info-item">
                        <div class="t5-side-info-icon">✨</div>
                        <div>
                            <span class="t5-side-info-label">Đóng trang đăng ký</span>
                            <span class="t5-side-info-val" style="display:block;">{{ $event->event_date->subDays(1)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<script>
    const eventTime = new Date("{{ $event->event_date->toIso8601String() }}").getTime();
    function runTimer() {
        const diff = eventTime - new Date().getTime();
        if (diff < 0) return;
        
        document.getElementById('t5-days').innerText = String(Math.floor(diff / (1000*60*60*24))).padStart(2, '0');
        document.getElementById('t5-hours').innerText = String(Math.floor((diff % (1000*60*60*24)) / (1000*60*60))).padStart(2, '0');
        document.getElementById('t5-mins').innerText = String(Math.floor((diff % (1000*60*60)) / (1000*60))).padStart(2, '0');
    }
    setInterval(runTimer, 1000);
    runTimer();
</script>
@endsection
