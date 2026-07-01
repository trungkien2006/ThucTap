@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@500;700&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer {
    display: none !important;
}

:root {
    --bg-sports: #111317;
    --primary-orange: #FF4E00;
    --text-sports: #FFFFFF;
    --text-muted-sports: #8E929A;
    --border-sports: rgba(255, 78, 0, 0.2);
}

.t6-body {
    background-color: var(--bg-sports);
    color: var(--text-sports);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    line-height: 1.6;
}

/* NAV */
.t6-nav {
    background: #000;
    border-bottom: 2px solid var(--primary-orange);
    padding: 0 48px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
}
.t6-nav-logo {
    color: #fff;
    font-family: 'Teko', sans-serif;
    font-size: 30px;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    text-decoration: none;
    line-height: 1;
}
.t6-nav-logo span {
    color: var(--primary-orange);
}
.t6-nav-links {
    display: flex;
    gap: 24px;
}
.t6-nav-links a {
    color: var(--text-muted-sports);
    font-size: 13.5px;
    font-weight: 700;
    text-transform: uppercase;
    text-decoration: none;
    transition: color 0.2s;
}
.t6-nav-links a:hover {
    color: #fff;
}
.t6-nav-cta {
    background: var(--primary-orange);
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 8px 20px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s;
}
.t6-nav-cta:hover {
    background: #e04500;
}

/* HERO */
.t6-hero {
    position: relative;
    padding: 100px 48px 80px;
    text-align: center;
    overflow: hidden;
}
.t6-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 900px;
    margin: 0 auto;
}
.t6-hero-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 78, 0, 0.15);
    border: 1px solid var(--primary-orange);
    color: var(--primary-orange);
    padding: 4px 14px;
    border-radius: 4px;
    font-family: 'Teko', sans-serif;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 20px;
}
.t6-hero h1 {
    font-family: 'Teko', sans-serif;
    font-size: clamp(48px, 8vw, 84px);
    font-weight: 700;
    line-height: 0.95;
    text-transform: uppercase;
    color: #fff;
    margin-bottom: 20px;
    letter-spacing: 0.02em;
}
.t6-hero-sub {
    font-size: 16px;
    color: var(--text-muted-sports);
    max-width: 600px;
    margin: 0 auto 36px;
}

/* COUNTDOWN */
.t6-countdown {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 48px;
}
.t6-cd-unit {
    background: #1C1E24;
    border-left: 3px solid var(--primary-orange);
    width: 80px;
    padding: 12px 0;
    text-align: center;
}
.t6-cd-num {
    font-family: 'Teko', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}
.t6-cd-label {
    font-size: 9px;
    text-transform: uppercase;
    color: var(--text-muted-sports);
    font-weight: 700;
}

/* HERO META */
.t6-hero-meta {
    display: inline-flex;
    flex-wrap: wrap;
    gap: 24px;
    justify-content: center;
    border-top: 1px solid #23262F;
    border-bottom: 1px solid #23262F;
    padding: 16px 0;
    width: 100%;
    max-width: 600px;
}
.t6-hero-meta-item {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 8px;
}
.t6-hero-meta-item svg {
    color: var(--primary-orange);
    width: 16px;
    height: 16px;
}

/* CONTAINER */
.t6-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 48px 80px;
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 48px;
}
@media (max-width: 991px) {
    .t6-container {
        grid-template-columns: 1fr;
        padding: 0 24px 60px;
    }
}

.t6-section-title {
    font-family: 'Teko', sans-serif;
    font-size: 32px;
    text-transform: uppercase;
    color: #fff;
    margin-bottom: 20px;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    gap: 10px;
}
.t6-section-title::before {
    content: '';
    display: block;
    width: 6px;
    height: 24px;
    background: var(--primary-orange);
}

.t6-card {
    background: #1C1E24;
    border: 1px solid #23262F;
    padding: 32px;
    margin-bottom: 32px;
}

/* SCHEDULE */
.t6-schedule-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.t6-schedule-row {
    display: flex;
    align-items: center;
    background: #111317;
    border: 1px solid #23262F;
    padding: 16px 20px;
}
.t6-schedule-time {
    font-family: 'Teko', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--primary-orange);
    width: 70px;
    flex-shrink: 0;
}
.t6-schedule-info {
    flex: 1;
}
.t6-schedule-title {
    font-size: 15px;
    font-weight: 700;
}
.t6-schedule-speaker {
    font-size: 12px;
    color: var(--text-muted-sports);
    margin-top: 2px;
}

/* ATHLETES / REEFEREES */
.t6-athletes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}
.t6-athlete-card {
    background: #111317;
    border: 1px solid #23262F;
    padding: 20px;
    text-align: center;
    transition: border-color 0.2s;
}
.t6-athlete-card:hover {
    border-color: var(--primary-orange);
}
.t6-athlete-photo {
    width: 70px;
    height: 70px;
    border-radius: 4px;
    margin: 0 auto 12px;
    overflow: hidden;
    background: #23262F;
}
.t6-athlete-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t6-athlete-name {
    font-size: 14.5px;
    font-weight: 700;
}
.t6-athlete-role {
    font-size: 11.5px;
    color: var(--text-muted-sports);
    margin-top: 2px;
}

/* SIDEBAR REGISTER */
.t6-side-card {
    background: #1C1E24;
    border: 1px solid #23262F;
    padding: 24px;
    margin-bottom: 24px;
    text-align: center;
}
.t6-side-price {
    font-family: 'Teko', sans-serif;
    font-size: 36px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 16px;
}
.t6-btn-reg {
    display: block;
    width: 100%;
    background: var(--primary-orange);
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 12px;
    text-align: center;
    font-weight: 700;
    text-transform: uppercase;
    text-decoration: none;
    transition: background 0.15s;
}
.t6-btn-reg:hover {
    background: #e04500;
}
.t6-side-info-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
    text-align: left;
    margin-top: 20px;
}
.t6-side-info-item {
    display: flex;
    align-items: center;
    gap: 12px;
}
.t6-side-info-icon {
    font-size: 16px;
    color: var(--primary-orange);
}
.t6-side-info-label {
    font-size: 9px;
    text-transform: uppercase;
    color: var(--text-muted-sports);
}
.t6-side-info-val {
    font-size: 13.5px;
    font-weight: 700;
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
<div class="t6-body">
    <!-- Navbar -->
    <nav class="t6-nav">
        <a href="{{ route('home') }}" class="t6-nav-logo">
            <span>🏟</span> UniEvent Arena
        </a>
        <div class="t6-nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('home') }}#events">Sự kiện</a>
            <a href="{{ route('archive') }}">Lưu trữ</a>
        </div>
        <a href="#t6-reg" class="t6-nav-cta">Đăng ký thi đấu</a>
    </nav>

    <!-- Hero -->
    <div class="t6-hero" style="@if($event->bannerImage) background-image: linear-gradient(rgba(17,19,23,0.7), rgba(17,19,23,0.95)), url('{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}'); background-size: cover; background-position: center; @endif">
        <div class="t6-hero-inner">
            <div class="t6-hero-badge">
                🏃 {{ $event->category ? $event->category->name : 'Thể thao & Sức khỏe' }}
            </div>
            <h1 style="{!! $titleStyleStr !!}">{!! nl2br(e($event->title)) !!}</h1>
            <p class="t6-hero-sub" style="{!! $descStyleStr !!}">
                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 180) }}
            </p>

            <div class="t6-countdown">
                <div class="t6-cd-unit"><div class="t6-cd-num" id="t6-days">00</div><div class="t6-cd-label">Ngày</div></div>
                <div class="t6-cd-unit"><div class="t6-cd-num" id="t6-hours">00</div><div class="t6-cd-label">Giờ</div></div>
                <div class="t6-cd-unit"><div class="t6-cd-num" id="t6-mins">00</div><div class="t6-cd-label">Phút</div></div>
            </div>

            <div class="t6-hero-meta">
                <div class="t6-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    {{ $event->event_date->translatedFormat('d/m/Y') }}
                </div>
                <div class="t6-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    {{ $event->event_date->format('H:i') }}
                </div>
                @if($event->location)
                <div class="t6-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $event->location }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="t6-container">
        <div class="t6-main">
            <div class="t6-card">
                <h2 class="t6-section-title">Giới thiệu giải đấu</h2>
                <div style="color: var(--text-muted-sports); line-height: 1.8;">
                    {!! $event->description !!}
                </div>
            </div>

            <!-- Schedule -->
            @if($event->scheduleItems->count() > 0)
            <div class="t6-card">
                <h2 class="t6-section-title">Lịch trình thi đấu</h2>
                <div class="t6-schedule-list">
                    @foreach($event->scheduleItems as $item)
                    <div class="t6-schedule-row">
                        <div class="t6-schedule-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}</div>
                        <div class="t6-schedule-info">
                            <div class="t6-schedule-title">{{ $item->title }}</div>
                            @if($item->speaker)
                                <div class="t6-schedule-speaker">Trọng tài / Hướng dẫn: {{ $item->speaker->name }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Speakers / Referees -->
            @if($event->speakers->count() > 0)
            <div class="t6-card">
                <h2 class="t6-section-title">Ban tổ chức & Trọng tài</h2>
                <div class="t6-athletes-grid">
                    @foreach($event->speakers as $speaker)
                    <div class="t6-athlete-card">
                        <div class="t6-athlete-photo">
                            @if($speaker->photo_url)
                                <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" alt="{{ $speaker->name }}">
                            @else
                                📣
                            @endif
                        </div>
                        <div class="t6-athlete-name">{{ $speaker->name }}</div>
                        <div class="t6-athlete-role">{{ $speaker->title }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="t6-sidebar" id="t6-reg">
            <div class="t6-side-card">
                <div class="t6-side-price">Đăng ký tự do</div>
                <a href="mailto:admin@school.edu?subject=Đăng ký giải đấu {{ $event->title }}" class="t6-btn-reg">Đăng ký ngay</a>
                
                <div class="t6-side-info-list">
                    <div class="t6-side-info-item">
                        <div class="t6-side-info-icon">📅</div>
                        <div>
                            <span class="t6-side-info-label">Ngày đấu</span>
                            <span class="t6-side-info-val" style="display:block;">{{ $event->event_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    @if($event->location)
                    <div class="t6-side-info-item">
                        <div class="t6-side-info-icon">📍</div>
                        <div>
                            <span class="t6-side-info-label">Địa điểm</span>
                            <span class="t6-side-info-val" style="display:block;">{{ $event->location }}</span>
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
        
        document.getElementById('t6-days').innerText = String(Math.floor(diff / (1000*60*60*24))).padStart(2, '0');
        document.getElementById('t6-hours').innerText = String(Math.floor((diff % (1000*60*60*24)) / (1000*60*60))).padStart(2, '0');
        document.getElementById('t6-mins').innerText = String(Math.floor((diff % (1000*60*60)) / (1000*60))).padStart(2, '0');
    }
    setInterval(runTimer, 1000);
    runTimer();
</script>
@endsection
