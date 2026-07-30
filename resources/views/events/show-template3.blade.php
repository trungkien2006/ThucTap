@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,600&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
<style>
/* Removed hide navbar rule to comply with layout rule */

:root {
    --navy: #1E3A8A;
    --blue: #2563EB;
    --blue-lt: rgba(37, 99, 235, 0.1);
    --gold: #D97706;
    --gold-lt: #FEF3C7;
    --bg: linear-gradient(135deg, #F0F4FF 0%, #E6EEFF 100%);
    --surface: rgba(255, 255, 255, 0.7);
    --ink: #0F172A;
    --soft: #334155;
    --muted: #64748B;
    --border: rgba(226, 232, 240, 0.8);
}

.t3-body {
    background: var(--bg) !important;
    background-attachment: fixed !important;
    color: var(--ink);
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 14px;
    line-height: 1.6;
    min-height: 100vh;
}

/* NAV */
.t3-nav {
    background: var(--navy);
    padding: 0 48px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
}
.t3-nav-logo {
    color: #fff;
    font-weight: 800;
    font-size: 15px;
    letter-spacing: .05em;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}
.t3-nav-logo span {
    background: var(--blue);
    border-radius: 7px;
    width: 30px;
    height: 30px;
    display: grid;
    place-items: center;
    font-size: 13px;
    color: #fff;
}
.t3-nav-links {
    display: flex;
    gap: 28px;
}
.t3-nav-links a {
    color: rgba(255,255,255,.65);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: color .2s;
}
.t3-nav-links a:hover {
    color: #fff;
}
.t3-nav-cta {
    background: var(--blue);
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
.t3-nav-cta:hover {
    background: #1e40af;
}

/* HERO */
.t3-hero {
    background: var(--navy);
    padding: 80px 64px 72px;
    min-height: 480px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}
.t3-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 100% at 20% 50%, rgba(15,23,42,0.6) 0%, transparent 70%);
    z-index: 1;
}
.t3-hero-inner {
    position: relative;
    max-width: 640px;
    z-index: 10;
}
.t3-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border-radius: 999px;
    padding: 6px 16px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.85);
    margin-bottom: 20px;
}
.t3-hero-badge span {
    width: 7px;
    height: 7px;
    background: #4ADE80;
    border-radius: 50%;
    display: block;
    box-shadow: 0 0 6px #4ADE80;
    animation: pulse-dot 2s infinite;
}
@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(0.8); }
}
.t3-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(36px, 5vw, 62px);
    font-weight: 700;
    color: #fff;
    line-height: 1.05;
    letter-spacing: -.02em;
    margin-bottom: 16px;
    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
}
.t3-hero h1 em {
    font-style: italic;
    color: #93C5FD;
}
.t3-hero-sub {
    font-size: 15px;
    color: rgba(255,255,255,.6);
    max-width: 620px;
    line-height: 1.7;
    margin-bottom: 32px;
}
.t3-hero-meta {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 36px;
}
.t3-hero-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,.7);
    font-size: 13px;
}
.t3-hero-meta-item svg {
    width: 15px;
    height: 15px;
    color: #93C5FD;
}
.t3-hero-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.t3-btn-primary {
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 12px 24px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: background.15s;
}
.t3-btn-primary:hover {
    background: #1e40af;
}
.t3-btn-outline {
    background: rgba(255,255,255,.12);
    color: #fff;
    border: 1.5px solid rgba(255,255,255,.3);
    border-radius: 12px;
    padding: 13px 28px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all .2s;
    backdrop-filter: blur(10px);
    letter-spacing: 0.02em;
}
.t3-btn-outline:hover {
    background: rgba(255,255,255,.22);
    border-color: rgba(255,255,255,.5);
    transform: translateY(-1px);
}
.t3-hero-stats {
    display: flex;
    gap: 0;
    padding-top: 32px;
    border-top: 1px solid rgba(255,255,255,.1);
    margin-top: 36px;
    flex-wrap: wrap;
}
.t3-hero-stats > div {
    padding-right: 32px;
    margin-right: 32px;
    border-right: 1px solid rgba(255,255,255,.1);
}
.t3-hero-stats > div:last-child {
    border-right: none;
    margin-right: 0;
    padding-right: 0;
}
.t3-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 30px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}
.t3-stat-label {
    font-size: 10.5px;
    color: rgba(255,255,255,.4);
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-top: 4px;
}

/* COUNTDOWN */
.t3-countdown-bar {
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
    padding: 18px 48px;
    display: flex;
    align-items: center;
    gap: 32px;
    justify-content: center;
    flex-wrap: wrap;
    border-top: 1px solid rgba(255,255,255,0.08);
}
.t3-cd-label {
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .12em;
    color: rgba(255,255,255,.7);
}
.t3-cd-units {
    display: flex;
    gap: 12px;
}
.t3-cd-unit {
    text-align: center;
}
.t3-cd-num {
    background: rgba(255,255,255,0.15);
    color: #fff;
    font-size: 24px;
    font-weight: 800;
    border-radius: 10px;
    padding: 8px 16px;
    display: block;
    line-height: 1;
    min-width: 52px;
    letter-spacing: -.01em;
    border: 1px solid rgba(255,255,255,0.1);
}
.t3-cd-unit-label {
    font-size: 10px;
    color: rgba(255,255,255,.55);
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-top: 5px;
    font-weight: 700;
}

/* CONTENT */
.t3-content {
    max-width: 1000px;
    margin: 0 auto;
    padding: 60px 48px;
}
@media (max-width: 991px) {
    .t3-content {
        padding: 40px 24px;
    }
}
.t3-section-eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--blue);
    margin-bottom: 10px;
}
.t3-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    letter-spacing: -.01em;
}
.t3-section-body {
    color: var(--soft);
    line-height: 1.8;
    font-size: 14px;
}
.t3-section-body p + p {
    margin-top: 14px;
}

/* SPEAKERS */
.t3-speakers {
    margin-top: 48px;
}
.t3-speaker-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
    margin-top: 20px;
}
.t3-speaker-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: all .2s;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04);
}
.t3-speaker-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(30, 58, 138, 0.08);
}
.t3-speaker-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    margin: 0 auto 12px;
    display: grid;
    place-items: center;
    font-size: 26px;
    background: var(--blue-lt);
    overflow: hidden;
}
.t3-speaker-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t3-speaker-name {
    font-size: 14px;
    font-weight: 700;
}
.t3-speaker-role {
    font-size: 12px;
    color: var(--muted);
    margin-top: 2px;
}
.t3-speaker-topic {
    font-size: 11.5px;
    color: var(--blue);
    font-weight: 600;
    margin-top: 8px;
    padding: 4px 10px;
    background: var(--blue-lt);
    border-radius: 999px;
    display: inline-block;
}

/* SCHEDULE */
.t3-schedule {
    margin-top: 48px;
}
.t3-sched-item {
    display: flex;
    gap: 16px;
    padding: 18px 0;
    border-bottom: 1px solid var(--border);
}
.t3-sched-item:last-child {
    border-bottom: none;
}
.t3-sched-time {
    width: 80px;
    font-size: 12px;
    font-weight: 700;
    color: var(--blue);
    flex-shrink: 0;
    padding-top: 2px;
}
.t3-sched-body {
    flex: 1;
}
.t3-sched-title {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 3px;
}
.t3-sched-speaker {
    font-size: 12px;
    color: var(--muted);
}
.t3-sched-tag {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
    background: var(--gold-lt);
    color: var(--gold);
    margin-top: 6px;
    letter-spacing: .04em;
}

/* SIDEBAR */
.t3-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.t3-sidebar-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04);
}
.t3-sidebar-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: var(--muted);
}
.t3-sidebar-card-body {
    padding: 20px;
}
.t3-reg-price {
    font-family: 'Playfair Display', serif;
    font-size: 36px;
    font-weight: 700;
    color: var(--ink);
    line-height: 1;
}
.t3-reg-price span {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: var(--muted);
}
.t3-reg-deadline {
    font-size: 12px;
    color: var(--muted);
    margin-top: 6px;
    margin-bottom: 20px;
}
.t3-reg-deadline strong {
    color: var(--ink);
}
.t3-btn-reg {
    width: 100%;
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 13px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    text-align: center;
    display: block;
    text-decoration: none;
    transition: background .15s;
}
.t3-btn-reg:hover {
    background: #1e40af;
}
.t3-info-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.t3-info-item {
    display: flex;
    gap: 10px;
    align-items: flex-start;
}
.t3-info-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: var(--blue-lt);
    display: grid;
    place-items: center;
    flex-shrink: 0;
    font-size: 14px;
}
.t3-info-label {
    font-size: 11px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .06em;
}
.t3-info-value {
    font-size: 13.5px;
    font-weight: 600;
    margin-top: 1px;
}

/* FOOTER */
.t3-footer {
    background: var(--navy);
    color: rgba(255,255,255,.5);
    padding: 32px 48px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    flex-wrap: wrap;
    gap: 16px;
}
.t3-footer strong {
    color: #fff;
}
.t3-gallery-block {
    display: flex;
    flex-direction: column;
    gap: 20px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 24px;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04);
    margin-top: 32px;
}
.t3-gallery-media {
    width: 100%;
    border-radius: 8px;
    object-fit: cover;
    aspect-ratio: 16/10;
    border: 1px solid var(--border);
}
@media (max-width: 768px) {
    .t3-gallery-block {
        gap: 16px;
        padding: 16px;
    }
}
</style>
@endpush

@php
    // Dynamically retrieve fonts and design custom styling overrides
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
<div class="t3-body">
    <!-- Navbar -->
    <nav class="t3-nav">
        <a href="{{ route('home') }}" class="t3-nav-logo">
            <span>U</span> UniEvent
        </a>
        <div class="t3-nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('home') }}#events">Sự kiện</a>
            <a href="{{ route('archive') }}">Lưu trữ</a>
        </div>
    </nav>

    <div class="t3-hero" style="@if($event->bannerImage) background-image: linear-gradient(to right, rgba(5,15,50,0.85) 0%, rgba(20,50,130,0.55) 45%, rgba(10,30,80,0.1) 100%), url('{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}'); background-size: cover; background-position: center center; @endif">
        <div class="t3-hero-inner">
            <div class="t3-hero-badge">
                <span></span> {{ $event->category ? $event->category->name : 'Sự kiện học đường' }}
            </div>
            <h1 style="{!! $titleStyleStr !!}">{!! nl2br(e($event->title)) !!}</h1>
            <div class="t3-hero-stats">
                <div>
                    <div class="t3-stat-num">{{ $event->speakers->count() }}</div>
                    <div class="t3-stat-label">Diễn giả</div>
                </div>
                <div>
                    <div class="t3-stat-num">{{ $event->views_count }}</div>
                    <div class="t3-stat-label">Lượt xem</div>
                </div>
                <div>
                    <div class="t3-stat-num">{{ $event->scheduleItems->count() }}</div>
                    <div class="t3-stat-label">Hoạt động</div>
                </div>
                <div>
                    <div class="t3-stat-num">{{ $event->likes_count }}</div>
                    <div class="t3-stat-label">Yêu thích</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Countdown -->
    @if($event->event_date > now())
    <div class="t3-countdown-bar" id="countdown-wrapper" data-date="{{ $event->event_date->format('Y-m-d\TH:i:s') }}">
        <div class="t3-cd-label">⏳ Còn lại</div>
        <div class="t3-cd-units">
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-days">00</span><div class="t3-cd-unit-label">Ngày</div></div>
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-hours">00</span><div class="t3-cd-unit-label">Giờ</div></div>
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-mins">00</span><div class="t3-cd-unit-label">Phút</div></div>
        </div>
    </div>
    @endif

    <!-- Main Content Grid -->
    <div class="t3-content">
        <div class="t3-main-col">
            <!-- Premium Event Key Info Bar -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px 32px; margin-bottom: 48px; box-shadow: 0 10px 30px -10px rgba(30, 58, 138, 0.06);">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 24px;">
                    
                    <!-- Item 1: Thời gian -->
                    <div style="display: flex; align-items: center; gap: 16px; flex: 1; min-width: 240px;">
                        <div style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #ffffff; display: flex; justify-content: center; align-items: center; flex-shrink: 0; box-shadow: 0 6px 14px -3px rgba(59, 130, 246, 0.35);">
                            <i data-lucide="calendar" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div style="min-width: 0;">
                            <span style="font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #2563eb; background: #eff6ff; padding: 2px 8px; border-radius: 5px; display: inline-block; margin-bottom: 4px;">Thời gian</span>
                            <div style="font-size: 14.5px; font-weight: 700; color: #0f172a; line-height: 1.3;">
                                {{ $event->event_date->translatedFormat('l, d/m/Y') }}
                            </div>
                            <div style="font-size: 12.5px; font-weight: 600; color: #475569; margin-top: 2px; display: flex; align-items: center; gap: 4px;">
                                <i data-lucide="clock" style="width: 13px; height: 13px; color: #2563eb;"></i>
                                {{ $event->event_date->format('H:i') }} @if($event->end_date) — {{ $event->end_date->format('H:i') }} @endif
                            </div>
                        </div>
                    </div>

                    <div style="width: 1px; height: 40px; background: #e2e8f0;" class="hidden lg:block"></div>

                    <!-- Item 2: Địa điểm -->
                    @if($event->location)
                    <div style="display: flex; align-items: center; gap: 16px; flex: 1; min-width: 200px;">
                        <div style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%); color: #ffffff; display: flex; justify-content: center; align-items: center; flex-shrink: 0; box-shadow: 0 6px 14px -3px rgba(244, 63, 94, 0.35);">
                            <i data-lucide="map-pin" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div style="min-width: 0;">
                            <span style="font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #e11d48; background: #fff1f2; padding: 2px 8px; border-radius: 5px; display: inline-block; margin-bottom: 4px;">Địa điểm</span>
                            <div style="font-size: 14.5px; font-weight: 700; color: #0f172a; line-height: 1.3;">
                                {{ $event->location }}
                            </div>
                            <div style="font-size: 12.5px; font-weight: 500; color: #64748b; margin-top: 2px;">
                                Trực tiếp tại trường
                            </div>
                        </div>
                    </div>

                    <div style="width: 1px; height: 40px; background: #e2e8f0;" class="hidden lg:block"></div>
                    @endif

                    <!-- Item 3: Danh mục -->
                    <div style="display: flex; align-items: center; gap: 16px; flex: 1; min-width: 200px;">
                        <div style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #10b981 0%, #047857 100%); color: #ffffff; display: flex; justify-content: center; align-items: center; flex-shrink: 0; box-shadow: 0 6px 14px -3px rgba(16, 185, 129, 0.35);">
                            <i data-lucide="layers" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div style="min-width: 0;">
                            <span style="font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #059669; background: #ecfdf5; padding: 2px 8px; border-radius: 5px; display: inline-block; margin-bottom: 4px;">Danh mục</span>
                            <div style="font-size: 14.5px; font-weight: 700; color: #0f172a; line-height: 1.3;">
                                {{ $event->category ? $event->category->name : 'Sự kiện học đường' }}
                            </div>
                            <div style="font-size: 12.5px; font-weight: 500; color: #64748b; margin-top: 2px;">
                                Thể loại chính
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @php
                $hasRecap = isset($recapImages) && $recapImages->count() > 0 && $event->isEnded();
            @endphp

            @if($hasRecap)
            <div x-data="{ activeTab: 'info' }" class="w-full">
                <div style="display:flex; justify-content:center; gap:30px; margin: 10px auto 30px; border-bottom:1px solid rgba(0,0,0,0.1); padding-bottom:0px; flex-wrap:wrap; max-width: 800px;">
                    <button @click="activeTab = 'info'" 
                            :style="activeTab === 'info' ? 'border-bottom: 2px solid #f97316; color: #f97316; font-weight: 600;' : 'color: #64748b; font-weight: 500;'"
                            style="padding: 10px 5px; font-size:1.1rem; transition:all 0.3s; background:none; border:none; cursor:pointer; font-family:'DM Sans', sans-serif;">
                        Giới thiệu sự kiện
                    </button>
                    <button @click="activeTab = 'images'" 
                            :style="activeTab === 'images' ? 'border-bottom: 2px solid #f97316; color: #f97316; font-weight: 600;' : 'color: #64748b; font-weight: 500;'"
                            style="padding: 10px 5px; font-size:1.1rem; transition:all 0.3s; background:none; border:none; cursor:pointer; font-family:'DM Sans', sans-serif;">
                        Hình ảnh sự kiện
                    </button>
                </div>

                <div x-show="activeTab === 'info'" class="tab-content-info">
            @endif

            <div class="t3-section-eyebrow">Giới thiệu</div>
            <h2 class="t3-section-title">Về sự kiện này</h2>
            <div class="t3-section-body">
                {!! $event->description !!}

                @if(!empty($event->registration_link))
                <div style="margin-top: 24px; text-align: center;">
                    <a href="{{ $event->registration_link }}" target="_blank" 
                       style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 32px; background: linear-gradient(to right, #f97316, #ea580c); color: white; font-weight: bold; border-radius: 8px; box-shadow: 0 4px 14px rgba(234, 88, 12, 0.3); text-decoration: none; text-transform: uppercase; font-family: 'DM Sans', sans-serif; transition: all 0.3s;"
                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(234, 88, 12, 0.4)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 14px rgba(234, 88, 12, 0.3)';">
                        <span class="material-symbols-outlined" style="font-size: 20px;">how_to_reg</span>
                        Đăng ký tham gia ngay
                    </a>
                </div>
                @endif
            </div>

            <!-- Hoạt động nổi bật (Gallery Blocks) -->
            @if($event->galleryImages->count() > 0)
            <div style="margin-top: 48px;">
                <div class="t3-section-eyebrow">Hoạt động</div>
                <h2 class="t3-section-title">Nội dung chi tiết</h2>
                <div>
                    @foreach($event->galleryImages as $index => $block)
                    <div class="t3-gallery-block">
                        <div class="t3-gallery-media-col">
                            @if($block->url)
                                @if($block->type === 'video')
                                    <video src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="t3-gallery-media" autoplay loop muted playsinline controls></video>
                                @else
                                    <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="t3-gallery-media" alt="">
                                @endif
                                @if($block->caption)<p style="margin-top:10px;font-size:0.95rem;color:#64748b;font-style:italic;text-align:center;">{{ $block->caption }}</p>@endif
                            @endif
                        </div>
                        <div>

                            @if(!empty($block->content))
                                <div style="color: var(--soft); font-size: 14.5px; line-height: 1.8;">{!! $block->content !!}</div>
                            @endif
                            <div class="flex flex-wrap gap-2 mt-4">

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Speakers Section -->
            @if($event->speakers->count() > 0)
            <div class="t3-speakers">
                <div class="t3-section-eyebrow">Diễn giả</div>
                <h2 class="t3-section-title">Chuyên gia tham dự</h2>
                <div class="t3-speaker-grid">
                    @foreach($event->speakers as $speaker)
                    <div class="t3-speaker-card">
                        <div class="t3-speaker-avatar">
                            @if($speaker->photo_url)
                                <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" alt="{{ $speaker->name }}">
                            @else
                                👨‍🏫
                            @endif
                        </div>
                        <div class="t3-speaker-name">{{ $speaker->name }}</div>
                        <div class="t3-speaker-role">{{ $speaker->title }}</div>
                        <div class="t3-speaker-topic">{{ $speaker->bio ?? 'Diễn giả' }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Schedule Section -->
            @if($event->scheduleItems->count() > 0)
            <div class="t3-schedule" id="t3-schedule">
                <div class="t3-section-eyebrow">Lịch trình</div>
                <h2 class="t3-section-title">Chương trình sự kiện</h2>
                <div>
                    @foreach($event->scheduleItems as $item)
                    <div class="t3-sched-item">
                        <div class="t3-sched-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}{{ $item->end_time ? ' - ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') : '' }}</div>
                        <div class="t3-sched-body">
                            <div class="t3-sched-title">{{ $item->title }}</div>
                            @if($item->speaker)
                                <div class="t3-sched-speaker">Diễn giả: {{ $item->speaker->name }}</div>
                            @endif
                            @if($item->description)
                                <div class="t3-sched-tag">{{ $item->description }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Like & Share counter block -->
            <div class="p-6 rounded-2xl flex flex-wrap justify-center gap-4 mt-8 items-center" style="background:#F1F5F9; border:1px solid #E2E8F0;" x-data="{ copied: false }">
                <button id="like-btn" data-event-id="{{ $event->id }}" class="bg-white hover:bg-slate-50 border px-6 py-3 rounded-full font-bold transition-all shadow-sm flex items-center gap-2 {{ session()->has('liked_events.' . $event->id) ? 'text-red-500 border-red-200' : 'text-slate-700 border-slate-200' }}">
                    <span class="material-symbols-outlined {{ session()->has('liked_events.' . $event->id) ? 'text-red-500 font-fill' : '' }}">favorite</span>
                    <span id="likes-count">{{ $event->likes_count }}</span> Lượt thích
                </button>
                <div class="bg-white border text-slate-700 px-6 py-3 rounded-full font-bold shadow-sm flex items-center gap-2 border-slate-200">
                    <span class="material-symbols-outlined text-[#07A0C3]">visibility</span>
                    <span>{{ $event->views_count }}</span> Lượt xem
                </div>
                
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" 
                   class="flex items-center gap-2 bg-[#1877F2] text-white px-6 py-3 rounded-full font-bold shadow-[0_4px_12px_rgba(24,119,242,0.3)] hover:scale-105 transition-transform" style="text-decoration:none;">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" style="width:20px;height:20px;"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Chia sẻ
                </a>
                <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)" 
                        class="relative flex items-center gap-2 bg-white text-slate-700 border border-slate-200 px-6 py-3 rounded-full font-bold shadow-sm hover:bg-slate-50 transition-all cursor-pointer">
                    <span class="material-symbols-outlined" style="font-size:18px;">link</span> Copy Link
                    <span x-show="copied" x-transition style="display:none;position:absolute;top:-40px;left:50%;transform:translateX(-50%);background:#1E3A8A;color:white;font-size:12px;padding:4px 8px;border-radius:4px;white-space:nowrap;">Đã sao chép!</span>
                </button>
            </div>

            @if($hasRecap)
                </div>

                {{-- Tab 2: Hình ảnh sự kiện --}}
                <div x-show="activeTab === 'images'" class="tab-content-images" style="display: none; width: 100%; margin-top: 2rem;">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 px-4 max-w-[1140px] mx-auto mb-8">
                        @foreach($recapImages as $img)
                        <div class="aspect-square relative rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all group cursor-pointer bg-slate-100">
                            <img src="{{ \App\Helpers\FileHelper::url($img->url) }}" 
                                 alt="{{ $img->caption ?? 'Hình ảnh sự kiện' }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

                    <!-- Sự kiện liên quan -->
        @if(isset($relatedEvents) && $relatedEvents->count() > 0)
        <div class="mt-12 pt-8 border-t border-slate-200">
            <h2 class="text-xl md:text-2xl font-bold text-slate-800 text-center mb-8 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[#f97316]">auto_awesome</span>
                Sự kiện liên quan
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($relatedEvents as $relEvent)
                <a href="{{ route('events.show', $relEvent->slug) }}" class="group block rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="w-full aspect-video bg-slate-100 overflow-hidden relative">
                        @if($relEvent->bannerImage)
                            <img src="{{ \App\Helpers\FileHelper::url($relEvent->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-slate-200 flex items-center justify-center">
                                <span class="material-symbols-outlined text-slate-400 text-4xl">image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-5 text-left">
                        <h4 class="font-bold text-slate-800 group-hover:text-[#f97316] transition-colors line-clamp-2 text-[15px] leading-snug">{{ $relEvent->title }}</h4>
                        <div class="mt-3 text-[13px] text-slate-500 flex items-center gap-1.5 font-medium">
                            <span class="material-symbols-outlined text-[16px] text-slate-400">calendar_today</span>
                            {{ $relEvent->event_date->format('d/m/Y') }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Điều hướng Sự kiện Trước / Sau (chỉ dành cho kho lưu trữ) -->
            @if(isset($previousEvent) || isset($nextEvent))
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-slate-200">
                <div>
                    @if(isset($previousEvent) && $previousEvent)
                    <a href="{{ route('events.show', $previousEvent->slug) }}" class="group block max-w-[280px] mr-auto" style="text-decoration:none;">
                        <div class="flex items-center text-slate-500 group-hover:text-blue-600 transition-colors mb-3">
                            <span class="material-symbols-outlined text-2xl -ml-1">arrow_left_alt</span>
                            <div class="h-[2px] bg-current flex-1"></div>
                        </div>
                        <h4 class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors line-clamp-2 text-left" style="font-family:'Playfair Display', serif;font-size:18px;">{{ $previousEvent->title }}</h4>
                    </a>
                    @endif
                </div>
                <div class="text-right">
                    @if(isset($nextEvent) && $nextEvent)
                    <a href="{{ route('events.show', $nextEvent->slug) }}" class="group block max-w-[280px] ml-auto" style="text-decoration:none;">
                        <div class="flex items-center text-slate-500 group-hover:text-blue-600 transition-colors mb-3">
                            <div class="h-[2px] bg-current flex-1"></div>
                            <span class="material-symbols-outlined text-2xl -mr-1">arrow_right_alt</span>
                        </div>
                        <h4 class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors line-clamp-2 text-right" style="font-family:'Playfair Display', serif;font-size:18px;">{{ $nextEvent->title }}</h4>
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="t3-footer">
        <div>© {{ date('Y') }} <strong>UniEvent</strong> — Hệ thống quản lý sự kiện trường học</div>
        <div>Được xây dựng với phong cách chuyên nghiệp</div>
    </footer>
</div>

@include('components.event-fab-menu', ['event' => $event])

@endsection

@push('scripts')
<script>
    // Javascript Countdown timer
    const cdWrapper = document.getElementById('countdown-wrapper');
    if (cdWrapper) {
        const targetDate = new Date(cdWrapper.getAttribute('data-date')).getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const diff = targetDate - now;
            
            if (diff < 0) {
                cdWrapper.style.display = 'none';
                return;
            }
            
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            
            document.getElementById('t3-days').innerText = String(days).padStart(2, '0');
            document.getElementById('t3-hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('t3-mins').innerText = String(mins).padStart(2, '0');
        }
        
        setInterval(updateCountdown, 1000);
        updateCountdown();
    }

    // Like logic
    const likeBtn = document.getElementById('like-btn');
    if(likeBtn) {
        likeBtn.addEventListener('click', function() {
            const eventId = this.dataset.eventId;
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
                    
                    if (data.liked) {
                        likeBtn.classList.remove('text-slate-700', 'border-slate-200');
                        likeBtn.classList.add('text-red-500', 'border-red-200');
                        likeBtn.querySelector('.material-symbols-outlined').classList.add('font-fill', 'text-red-500');
                    } else {
                        likeBtn.classList.remove('text-red-500', 'border-red-200');
                        likeBtn.classList.add('text-slate-700', 'border-slate-200');
                        likeBtn.querySelector('.material-symbols-outlined').classList.remove('font-fill', 'text-red-500');
                    }
                    
                    likeBtn.style.animation = 'pulse 0.5s ease-in-out';
                    setTimeout(() => likeBtn.style.animation = '', 500);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
</script>
@endpush

