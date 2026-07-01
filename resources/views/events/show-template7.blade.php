@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer {
    display: none !important;
}

:root {
    --bg-orientation: #FFFFFF;
    --navy-blue: #0F172A;
    --accent-gold: #D97706;
    --text-primary: #1E293B;
    --text-secondary: #64748B;
    --border-orient: #E2E8F0;
}

.t7-body {
    background-color: var(--bg-orientation);
    color: var(--text-primary);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    line-height: 1.6;
}

/* NAV */
.t7-nav {
    background: #FFF;
    border-bottom: 1px solid var(--border-orient);
    padding: 0 48px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
}
.t7-nav-logo {
    color: var(--navy-blue);
    font-family: 'Cinzel', serif;
    font-weight: 700;
    font-size: 18px;
    text-decoration: none;
}
.t7-nav-logo span {
    color: var(--accent-gold);
}
.t7-nav-links {
    display: flex;
    gap: 28px;
}
.t7-nav-links a {
    color: var(--text-secondary);
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s;
}
.t7-nav-links a:hover {
    color: var(--navy-blue);
}
.t7-nav-cta {
    background: var(--navy-blue);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 8px 20px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s;
}
.t7-nav-cta:hover {
    background: #1e293b;
}

/* HERO */
.t7-hero {
    position: relative;
    padding: 100px 48px 80px;
    text-align: center;
    background: #0F172A;
    color: #fff;
    overflow: hidden;
}
.t7-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 800px;
    margin: 0 auto;
}
.t7-hero-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(217, 119, 6, 0.15);
    border: 1px solid var(--accent-gold);
    color: var(--accent-gold);
    padding: 4px 14px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 24px;
}
.t7-hero h1 {
    font-family: 'Cinzel', serif;
    font-size: clamp(36px, 5.5vw, 64px);
    font-weight: 700;
    line-height: 1.15;
    color: #fff;
    margin-bottom: 24px;
}
.t7-hero-sub {
    font-size: 16px;
    color: #94A3B8;
    max-width: 600px;
    margin: 0 auto 36px;
}

/* COUNTDOWN */
.t7-countdown {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 48px;
}
.t7-cd-unit {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    width: 80px;
    padding: 12px 0;
    text-align: center;
}
.t7-cd-num {
    font-size: 24px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}
.t7-cd-label {
    font-size: 9px;
    text-transform: uppercase;
    color: #94A3B8;
    letter-spacing: 0.05em;
    margin-top: 4px;
}

/* HERO META */
.t7-hero-meta {
    display: inline-flex;
    flex-wrap: wrap;
    gap: 24px;
    justify-content: center;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 12px 28px;
    border-radius: 99px;
}
.t7-hero-meta-item {
    font-size: 13.5px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.t7-hero-meta-item svg {
    color: var(--accent-gold);
    width: 16px;
    height: 16px;
}

/* CONTAINER */
.t7-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 48px 80px;
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 48px;
}
@media (max-width: 991px) {
    .t7-container {
        grid-template-columns: 1fr;
        padding: 40px 24px 60px;
    }
}

.t7-section-title {
    font-family: 'Cinzel', serif;
    font-size: 24px;
    color: var(--navy-blue);
    margin-bottom: 20px;
    letter-spacing: 0.05em;
}

.t7-card {
    background: #FFF;
    border: 1px solid var(--border-orient);
    border-radius: 12px;
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
}

/* SCHEDULE */
.t7-schedule-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}
.t7-schedule-row {
    display: flex;
    gap: 24px;
    padding: 20px 0;
    border-bottom: 1px solid var(--border-orient);
}
.t7-schedule-row:last-child {
    border-bottom: none;
}
.t7-schedule-time {
    font-size: 14px;
    font-weight: 700;
    color: var(--accent-gold);
    width: 70px;
    flex-shrink: 0;
}
.t7-schedule-info {
    flex: 1;
}
.t7-schedule-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--navy-blue);
}
.t7-schedule-speaker {
    font-size: 12.5px;
    color: var(--text-secondary);
    margin-top: 4px;
}

/* VIP SPEAKERS */
.t7-vip-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}
.t7-vip-card {
    background: #FFF;
    border: 1px solid var(--border-orient);
    border-radius: 8px;
    padding: 24px 16px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.01);
}
.t7-vip-photo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin: 0 auto 16px;
    overflow: hidden;
    border: 1px solid var(--border-orient);
    background: #F8FAFC;
}
.t7-vip-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t7-vip-name {
    font-size: 14.5px;
    font-weight: 700;
    color: var(--navy-blue);
}
.t7-vip-role {
    font-size: 12px;
    color: var(--text-secondary);
    margin-top: 4px;
}

/* SIDEBAR REGISTER */
.t7-side-card {
    background: #FFF;
    border: 1px solid var(--border-orient);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
}
.t7-side-header {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--text-secondary);
    border-bottom: 1px solid var(--border-orient);
    padding-bottom: 10px;
    margin-bottom: 16px;
}
.t7-btn-reg {
    display: block;
    width: 100%;
    background: var(--navy-blue);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 12px;
    text-align: center;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.15s;
}
.t7-btn-reg:hover {
    background: #1e293b;
}
.t7-side-info-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.t7-side-info-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}
.t7-side-info-icon {
    font-size: 16px;
    color: var(--accent-gold);
}
.t7-side-info-label {
    font-size: 9px;
    text-transform: uppercase;
    color: var(--text-secondary);
}
.t7-side-info-val {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--navy-blue);
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
<div class="t7-body">
    <!-- Navbar -->
    <nav class="t7-nav">
        <a href="{{ route('home') }}" class="t7-nav-logo">
            <span>🎓</span> UniEvent Ceremony
        </a>
        <div class="t7-nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('home') }}#events">Sự kiện</a>
            <a href="{{ route('archive') }}">Lưu trữ</a>
        </div>
        <a href="#t7-reg" class="t7-nav-cta">Đăng ký tham dự</a>
    </nav>

    <!-- Hero -->
    <div class="t7-hero" style="@if($event->bannerImage) background-image: linear-gradient(rgba(15,23,42,0.8), rgba(15,23,42,0.95)), url('{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}'); background-size: cover; background-position: center; @endif">
        <div class="t7-hero-inner">
            <div class="t7-hero-badge">
                🏛 {{ $event->category ? $event->category->name : 'Lễ kỷ niệm & Khai giảng' }}
            </div>
            <h1 style="{!! $titleStyleStr !!}">{!! nl2br(e($event->title)) !!}</h1>
            <p class="t7-hero-sub" style="{!! $descStyleStr !!}">
                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 180) }}
            </p>

            <div class="t7-countdown">
                <div class="t7-cd-unit"><div class="t7-cd-num" id="t7-days">00</div><div class="t7-cd-label">Ngày</div></div>
                <div class="t7-cd-unit"><div class="t7-cd-num" id="t7-hours">00</div><div class="t7-cd-label">Giờ</div></div>
                <div class="t7-cd-unit"><div class="t7-cd-num" id="t7-mins">00</div><div class="t7-cd-label">Phút</div></div>
            </div>

            <div class="t7-hero-meta">
                <div class="t7-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    {{ $event->event_date->translatedFormat('d/m/Y') }}
                </div>
                <div class="t7-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    {{ $event->event_date->format('H:i') }}
                </div>
                @if($event->location)
                <div class="t7-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $event->location }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="t7-container">
        <div class="t7-main">
            <div class="t7-card">
                <h2 class="t7-section-title">Nội dung chương trình lễ</h2>
                <div style="color: var(--text-secondary); line-height: 1.8;">
                    {!! $event->description !!}
                </div>
            </div>

            <!-- Schedule -->
            @if($event->scheduleItems->count() > 0)
            <div class="t7-card">
                <h2 class="t7-section-title">Tiến trình buổi lễ</h2>
                <div class="t7-schedule-list">
                    @foreach($event->scheduleItems as $item)
                    <div class="t7-schedule-row">
                        <div class="t7-schedule-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}</div>
                        <div class="t7-schedule-info">
                            <div class="t7-schedule-title">{{ $item->title }}</div>
                            @if($item->speaker)
                                <div class="t7-schedule-speaker">Chủ trì/Phát biểu: {{ $item->speaker->name }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- VIP Speakers -->
            @if($event->speakers->count() > 0)
            <div class="t7-card">
                <h2 class="t7-section-title">Đại biểu danh dự</h2>
                <div class="t7-vip-grid">
                    @foreach($event->speakers as $speaker)
                    <div class="t7-vip-card">
                        <div class="t7-vip-photo">
                            @if($speaker->photo_url)
                                <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" alt="{{ $speaker->name }}">
                            @else
                                🤵
                            @endif
                        </div>
                        <div class="t7-vip-name">{{ $speaker->name }}</div>
                        <div class="t7-vip-role">{{ $speaker->title }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="t7-sidebar" id="t7-reg">
            <div class="t7-side-card">
                <div class="t7-side-header">Đăng ký tham dự</div>
                <a href="mailto:admin@school.edu?subject=Đăng ký tham dự buổi lễ {{ $event->title }}" class="t7-btn-reg">Đăng ký ngay</a>
            </div>

            <div class="t7-side-card">
                <div class="t7-side-info-list">
                    <div class="t7-side-info-item">
                        <div class="t7-side-info-icon">📅</div>
                        <div>
                            <span class="t7-side-info-label" style="display:block;">Thời gian</span>
                            <span class="t7-side-info-val">{{ $event->event_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    @if($event->location)
                    <div class="t7-side-info-item">
                        <div class="t7-side-info-icon">📍</div>
                        <div>
                            <span class="t7-side-info-label" style="display:block;">Địa điểm</span>
                            <span class="t7-side-info-val">{{ $event->location }}</span>
                        </div>
                    </div>
                    @endif
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
        
        document.getElementById('t7-days').innerText = String(Math.floor(diff / (1000*60*60*24))).padStart(2, '0');
        document.getElementById('t7-hours').innerText = String(Math.floor((diff % (1000*60*60*24)) / (1000*60*60))).padStart(2, '0');
        document.getElementById('t7-mins').innerText = String(Math.floor((diff % (1000*60*60)) / (1000*60))).padStart(2, '0');
    }
    setInterval(runTimer, 1000);
    runTimer();
</script>
@endsection
