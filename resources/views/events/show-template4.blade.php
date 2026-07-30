@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" rel="stylesheet">
<style>
:root {
    --t4-gold: #C9A84C;
    --t4-gold-dark: #A87C28;
    --t4-gold-light: #FDF6E3;
    --t4-gold-muted: #E8D5A3;
    --t4-bg: #FAF7F0;
    --t4-surface: #FFFFFF;
    --t4-text: #2A2118;
    --t4-muted: #7A6E60;
    --t4-border: #E8D9C0;
    --t4-border-light: #F0E6D2;
}

.t4-body {
    background-color: var(--t4-bg) !important;
    color: var(--t4-text);
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
    line-height: 1.8;
    min-height: 100vh;
    padding-bottom: 90px;
}
.t4-body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: radial-gradient(ellipse at 20% 50%, rgba(201,168,76,0.04) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(201,168,76,0.03) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

/* ─── CONTAINER ─── */
.t4-container {
    max-width: 860px;
    margin: 0 auto;
    background: var(--t4-surface);
    border-left: 1px solid var(--t4-border);
    border-right: 1px solid var(--t4-border);
    min-height: 100vh;
    box-shadow: 0 0 80px rgba(44, 37, 32, 0.08);
    position: relative;
    z-index: 1;
}

/* ─── HERO ─── */
.t4-hero {
    position: relative;
    width: 100%;
    height: 460px;
    overflow: hidden;
}
.t4-hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transform: scale(1.04);
    transition: transform 8s ease;
}
.t4-hero:hover .t4-hero-img { transform: scale(1.07); }
.t4-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(20,14,8,0.1) 0%, rgba(20,14,8,0.3) 40%, rgba(20,14,8,0.78) 100%);
    z-index: 1;
}
.t4-hero-content {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    text-align: center;
    color: #FFFFFF;
    z-index: 2;
    padding: 70px 48px 44px;
}
.t4-hero-tag {
    display: inline-block;
    background: rgba(201,168,76,0.85);
    backdrop-filter: blur(4px);
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    padding: 5px 16px;
    border-radius: 20px;
    margin-bottom: 16px;
    border: 1px solid rgba(255,255,255,0.2);
}
.t4-hero-quote {
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: 17px;
    opacity: 0.9;
    margin-bottom: 14px;
    letter-spacing: 0.03em;
    line-height: 1.6;
}
.t4-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 36px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 12px;
    color: #FDF6E3;
    text-shadow: 0 2px 24px rgba(0,0,0,0.25);
}
.t4-hero-subtitle {
    font-size: 11px;
    letter-spacing: 0.35em;
    text-transform: uppercase;
    font-weight: 600;
    opacity: 0.7;
}

/* ─── SECTIONS ─── */
.t4-card {
    padding: 56px 72px;
    text-align: center;
    position: relative;
    border-bottom: 1px solid var(--t4-border-light);
}
.t4-card:last-of-type { border-bottom: none; }
.t4-card-alt { background: linear-gradient(135deg, #FDFAF5 0%, #FAF5E8 100%); }

.t4-ornament-divider {
    position: absolute;
    bottom: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--t4-surface);
    padding: 0 20px;
    color: var(--t4-gold-muted);
    font-size: 16px;
    z-index: 2;
    letter-spacing: 0.4em;
}
.t4-card-alt .t4-ornament-divider { background: #FAF5E8; }

/* ─── SECTION TITLE ─── */
.t4-sec-title {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--t4-gold-dark);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 8px;
}
.t4-sec-underline {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 28px;
}
.t4-sec-underline::before, .t4-sec-underline::after {
    content: '';
    width: 48px; height: 1px;
    background: linear-gradient(to right, transparent, var(--t4-gold-muted));
}
.t4-sec-underline::after { background: linear-gradient(to left, transparent, var(--t4-gold-muted)); }
.t4-sec-star { color: var(--t4-gold); font-size: 12px; }

/* ─── DATE HIGHLIGHT ─── */
.t4-date-highlight {
    font-family: 'Cormorant Garamond', serif;
    font-size: 34px;
    color: var(--t4-gold-dark);
    font-weight: 600;
    font-style: italic;
    letter-spacing: 0.06em;
    margin-bottom: 8px;
}
.t4-body-text {
    font-size: 14px;
    color: var(--t4-muted);
    line-height: 2;
    max-width: 560px;
    margin: 0 auto;
}
.t4-body-text strong { color: var(--t4-gold-dark); font-weight: 600; }

/* ─── FULL CALENDAR ─── */
.t4-full-calendar {
    max-width: 360px;
    margin: 0 auto 28px;
    background: var(--t4-surface);
    border-radius: 16px;
    border: 1px solid var(--t4-border);
    overflow: hidden;
    box-shadow: 0 6px 30px rgba(44, 37, 32, 0.07);
}
.t4-cal-header {
    background: linear-gradient(135deg, var(--t4-gold-dark) 0%, var(--t4-gold) 100%);
    color: #FDF6E3;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.18em;
    padding: 14px 0;
    text-align: center;
}
.t4-cal-body { padding: 16px; }
.t4-cal-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 3px;
    text-align: center;
}
.t4-cal-day-name {
    font-size: 10px;
    font-weight: 700;
    color: var(--t4-gold-dark);
    padding-bottom: 8px;
    letter-spacing: 0.05em;
}
.t4-cal-day {
    aspect-ratio: 1/1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    border-radius: 50%;
    color: var(--t4-text);
    font-weight: 400;
}
.t4-cal-day.empty { visibility: hidden; }
.t4-cal-day.event-day {
    background: linear-gradient(135deg, var(--t4-gold-dark), var(--t4-gold));
    color: #FFF;
    font-weight: 800;
    font-size: 13px;
    box-shadow: 0 3px 12px rgba(201,168,76,0.45);
    position: relative;
}
.t4-cal-day.event-day::after {
    content: '★';
    position: absolute;
    top: 0; right: 0;
    font-size: 7px;
    color: #fff;
    background: var(--t4-gold-dark);
    width: 12px; height: 12px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 12px;
}
.t4-cal-day.today {
    border: 2px solid var(--t4-gold);
    font-weight: 700;
    color: var(--t4-gold-dark);
}
.t4-cal-day.today.event-day { background: linear-gradient(135deg, var(--t4-gold-dark), var(--t4-gold)); color: #FFF; }
.t4-cal-legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 10px 0 2px;
    font-size: 11px;
    color: var(--t4-muted);
    font-weight: 500;
}
.t4-cal-legend-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    display: inline-block;
    vertical-align: middle;
    margin-right: 5px;
}

/* ─── INFO BOXES ─── */
.t4-info-wrap {
    margin: 28px auto 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    max-width: 540px;
}
.t4-info-wrap.single { grid-template-columns: 1fr; }
.t4-info-item {
    background: var(--t4-gold-light);
    border: 1px solid var(--t4-gold-muted);
    border-radius: 14px;
    padding: 16px 18px;
    text-align: left;
    display: flex;
    align-items: center;
    gap: 14px;
}
.t4-info-icon {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, var(--t4-gold-dark), var(--t4-gold));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    color: #fff;
    font-size: 20px;
    box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}
.t4-info-label {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--t4-gold-dark);
    font-weight: 700;
    margin-bottom: 3px;
}
.t4-info-val {
}

/* ─── TIMELINE TREE ─── */
.t4-timeline {
    position: relative;
    margin-top: 32px;
    padding: 20px 0;
}
.t4-timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--t4-border);
    transform: translateX(-50%);
}
.t4-timeline-item {
    position: relative;
    width: 50%;
    padding: 0 40px;
    margin-bottom: 30px;
}
.t4-timeline-item:last-child {
    margin-bottom: 0;
}
.t4-timeline-item:nth-child(odd) {
    left: 0;
    text-align: right;
}
.t4-timeline-item:nth-child(even) {
    left: 50%;
    text-align: left;
}
.t4-timeline-dot {
    position: absolute;
    top: 15px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: var(--t4-gold);
    border: 3px solid var(--t4-surface);
    z-index: 2;
}
.t4-timeline-item:nth-child(odd) .t4-timeline-dot {
    right: -7px;
}
.t4-timeline-item:nth-child(even) .t4-timeline-dot {
    left: -7px;
}
.t4-timeline-content {
    background: #FAF8F2;
    border: 1px solid var(--t4-border);
    padding: 16px 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(44, 37, 32, 0.03);
    position: relative;
    display: inline-block;
    width: 100%;
}
.t4-timeline-time {
    font-size: 11px;
    font-weight: 700;
    color: var(--t4-gold);
    margin-bottom: 6px;
    letter-spacing: 0.05em;
}
.t4-timeline-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--t4-text);
    line-height: 1.4;
}
@media (max-width: 768px) {
    .t4-timeline::before {
        left: 20px;
    }
    .t4-timeline-item {
        width: 100%;
        padding-left: 50px;
        padding-right: 0;
        left: 0 !important;
        text-align: left !important;
    }
    .t4-timeline-item:nth-child(odd) .t4-timeline-dot,
    .t4-timeline-item:nth-child(even) .t4-timeline-dot {
        left: 13px;
        right: auto;
    }
}

/* ─── SPEAKERS ─── */
.t4-speakers {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 24px;
}
.t4-speaker {
    background: #FAF8F2;
    border: 1px solid var(--t4-border);
    border-radius: 12px;
    padding: 16px;
}
.t4-speaker-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 12px;
    border: 2px solid var(--t4-border);
}
.t4-speaker-name {
    font-size: 13px;
    font-weight: 700;
    color: var(--t4-text);
}
.t4-speaker-role {
    font-size: 11px;
    color: var(--t4-muted);
}

/* ─── CALENDAR PAGE ─── */
.t4-full-calendar {
    max-width: 340px;
    margin: 24px auto 0;
    background: #FFFFFF;
    border-radius: 12px;
    border: 1px solid var(--t4-border);
    padding: 16px;
    box-shadow: 0 4px 15px rgba(44, 37, 32, 0.03);
}
.t4-cal-header {
    text-align: center;
    font-weight: 700;
    color: var(--t4-gold);
    margin-bottom: 12px;
    font-size: 14px;
    text-transform: uppercase;
}
.t4-cal-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px;
    text-align: center;
}
.t4-cal-day-name {
    font-size: 11px;
    font-weight: 700;
    color: var(--t4-muted);
    margin-bottom: 8px;
}
.t4-cal-day {
    aspect-ratio: 1/1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    border-radius: 50%;
    color: var(--t4-text);
}
.t4-cal-day.empty {
    visibility: hidden;
}
.t4-cal-day.event-day {
    background: var(--t4-gold);
    color: #FFF;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(217, 119, 6, 0.3);
}
.t4-cal-day.today {
    border: 2px solid var(--t4-gold);
    font-weight: 700;
    color: var(--t4-gold);
}
.t4-cal-day.today.event-day {
    background: var(--t4-gold);
    color: #FFF;
}

/* ─── COUNTDOWN ─── */
.t4-countdown {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 24px;
}
.t4-cd-box {
    background: #FAF8F2;
    border: 1px solid var(--t4-border);
    border-radius: 8px;
    padding: 8px;
    min-width: 64px;
}
.t4-cd-num {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--t4-gold);
    line-height: 1.2;
}
.t4-cd-label {
    font-size: 9px;
    text-transform: uppercase;
    color: var(--t4-muted);
    font-weight: 700;
}

/* ─── STICKY BOTTOM BAR ─── */
.t4-bottom-bar {
    position: fixed;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    max-width: 1000px;
    background: #FFFFFF;
    border-top: 1px solid var(--t4-border);
    padding: 12px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    z-index: 100;
    box-shadow: 0 -4px 20px rgba(44, 37, 32, 0.06);
}
.t4-interaction-group {
    display: flex;
    align-items: center;
    gap: 12px;
}
.t4-action-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 20px;
    border: 1px solid var(--t4-border);
    background: #FAF8F2;
    font-weight: 600;
    font-size: 13px;
    color: var(--t4-text);
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}
.t4-action-btn:hover {
    background: #FEF3C7;
    border-color: var(--t4-gold);
}
.t4-heart-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 20px;
    border: 1px solid var(--t4-border);
    background: #FAF8F2;
    font-weight: 600;
    font-size: 13px;
    color: var(--t4-text);
    cursor: pointer;
    transition: all 0.2s;
}
.t4-heart-btn.liked {
    color: #EF4444;
    border-color: #FCA5A5;
    background: #FEF2F2;
}
.t4-heart-btn:hover {
    background: #FEF2F2;
}
@media (max-width: 600px) {
    .t4-bottom-bar {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style>
@endpush

@php
    $titleStyles = [];
    if (!empty($event->title_font_family)) $titleStyles[] = "font-family: '{$event->title_font_family}', sans-serif;";
    if (!empty($event->title_font_size))   $titleStyles[] = "font-size: {$event->title_font_size}px;";
    if (!empty($event->title_color))       $titleStyles[] = "color: {$event->title_color} !important; background: none;";
    $titleStyleStr = implode(' ', $titleStyles);

    $descStyles = [];
    if (!empty($event->desc_font_family)) $descStyles[] = "font-family: '{$event->desc_font_family}', sans-serif;";
    if (!empty($event->desc_font_size))   $descStyles[] = "font-size: {$event->desc_font_size}px;";
    if (!empty($event->desc_color))       $descStyles[] = "color: {$event->desc_color} !important;";
    $descStyleStr = implode(' ', $descStyles);
@endphp

@section('content')
<div class="t4-body">
    <div class="t4-container">
        
        {{-- SECTION 1: HERO / TOP --}}
        <div class="t4-hero">
            @if($event->bannerImage)
                <img src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}" class="t4-hero-img" alt="{{ $event->title }}">
            @else
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" class="t4-hero-img" alt="Default banner">
            @endif
            <div class="t4-hero-overlay"></div>
            <div class="t4-hero-content">
                @php
                    $heroQuote = "Vượt núi băng ngàn, tìm đến bình minh. Khởi đầu nơi đây, mở ra muôn ngả chân trời.";
                    if (!empty($event->description)) {
                        $heroQuote = Str::limit(strip_tags($event->description), 100);
                    }
                @endphp
                <div class="t4-hero-tag">{{ $event->category ? $event->category->name : 'SỰ KIỆN' }}</div>
                <div class="t4-hero-quote">&ldquo;{{ $heroQuote }}&rdquo;</div>
                <h1 class="t4-hero-title" style="{{ $titleStyleStr }}">{!! nl2br(e($event->title)) !!}</h1>
                <div class="t4-hero-subtitle">✦ &nbsp; {{ $event->event_date->translatedFormat('l, d/m/Y') }} &nbsp; ✦</div>
            </div>
        </div>

        {{-- SECTION 4: EVENT DETAILS & COUNTDOWN --}}
        <div class="t4-card t4-card-alt">
            <div class="t4-sec-title">Thời gian & Địa điểm</div>
            <div class="t4-sec-ornament-line"><div class="t4-sec-ornament-dot"></div></div>
            
            @php
                $evDate = $event->event_date;
                $startOfMonth = $evDate->copy()->startOfMonth();
                $startDayOfWeek = $startOfMonth->dayOfWeekIso; 
                $daysInMonth = $startOfMonth->daysInMonth;
                $today = now();
                $isSameMonthAsToday = ($today->format('Y-m') === $evDate->format('Y-m'));
            @endphp
            <div class="t4-full-calendar">
                <div class="t4-cal-header">Tháng {{ $evDate->format('m') }} • {{ $evDate->format('Y') }}</div>
                <div class="t4-cal-body">
                <div class="t4-cal-grid">
                    <div class="t4-cal-day-name">T2</div>
                    <div class="t4-cal-day-name">T3</div>
                    <div class="t4-cal-day-name">T4</div>
                    <div class="t4-cal-day-name">T5</div>
                    <div class="t4-cal-day-name">T6</div>
                    <div class="t4-cal-day-name">T7</div>
                    <div class="t4-cal-day-name">CN</div>
                    
                    @for($i = 1; $i < $startDayOfWeek; $i++)
                        <div class="t4-cal-day empty"></div>
                    @endfor
                    
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $classes = 't4-cal-day';
                            if ($day == $evDate->day) {
                                $classes .= ' event-day';
                            }
                            if ($isSameMonthAsToday && $day == $today->day) {
                                $classes .= ' today';
                            }
                        @endphp
                        <div class="{{ $classes }}" title="{{ ($day == $evDate->day) ? 'Ngày diễn ra sự kiện' : (($isSameMonthAsToday && $day == $today->day) ? 'Hôm nay' : '') }}">{{ $day }}</div>
                    @endfor
                </div>
                @if($isSameMonthAsToday)
                <div class="t4-cal-legend">
                    <span><span class="t4-cal-legend-dot" style="background: var(--t4-gold);"></span>Sự kiện</span>
                    <span><span class="t4-cal-legend-dot" style="background: transparent; border: 2px solid var(--t4-gold); display:inline-block; width:10px; height:10px; border-radius:50%; margin-right:5px; vertical-align:middle;"></span>Hôm nay</span>
                </div>
                @else
                <div class="t4-cal-legend">
                    <span><span class="t4-cal-legend-dot" style="background: var(--t4-gold);"></span>Ngày diễn ra sự kiện</span>
                </div>
                @endif
                </div>
            </div>

            <div class="t4-info-wrap{{ $event->location ? '' : ' single' }}">
                <div class="t4-info-item">
                    <div class="t4-info-icon"><span class="material-symbols-outlined" style="font-size:20px;">schedule</span></div>
                    <div>
                        <div class="t4-info-label">Thời gian</div>
                        <div class="t4-info-val">
                            {{ $event->event_date->translatedFormat('H:i, l d/m/Y') }} 
                            @if($event->end_date)
                                &mdash; {{ $event->end_date->translatedFormat('H:i, d/m/Y') }}
                            @endif
                        </div>
                    </div>
                </div>
                @if($event->location)
                <div class="t4-info-item">
                    <div class="t4-info-icon"><span class="material-symbols-outlined" style="font-size:20px;">location_on</span></div>
                    <div>
                        <div class="t4-info-label">Địa điểm</div>
                        <div class="t4-info-val">{{ $event->location }}</div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Countdown Timer --}}
            @if($event->event_date > now())
            <div class="t4-countdown" id="t4-countdown" data-date="{{ $event->event_date->format('Y-m-d\TH:i:s') }}">
                <div class="t4-cd-box"><div class="t4-cd-num" id="t4-days">00</div><div class="t4-cd-label">Ngày</div></div>
                <div class="t4-cd-box"><div class="t4-cd-num" id="t4-hours">00</div><div class="t4-cd-label">Giờ</div></div>
                <div class="t4-cd-box"><div class="t4-cd-num" id="t4-mins">00</div><div class="t4-cd-label">Phút</div></div>
                <div class="t4-cd-box"><div class="t4-cd-num" id="t4-secs">00</div><div class="t4-cd-label">Giây</div></div>
            </div>
            @endif
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

        {{-- EVENT DESCRIPTION --}}
        @if(!empty($event->description))
        <div class="t4-card">
            <div class="t4-sec-title" style="{{ $titleStyleStr }}">Giới thiệu sự kiện</div>
            <div class="t4-sec-ornament-line"><div class="t4-sec-ornament-dot"></div></div>
            <div class="t4-body-text" style="{{ $descStyleStr }}">
                {!! $event->description !!}

                @if(!empty($event->qr_code_path))
                <div style="margin-top: 24px; text-align: center;">
                    <a href="{{ $event->qr_code_path }}" target="_blank" 
                       style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 32px; background: linear-gradient(to right, #f97316, #ea580c); color: white; font-weight: bold; border-radius: 8px; box-shadow: 0 4px 14px rgba(234, 88, 12, 0.3); text-decoration: none; text-transform: uppercase; font-family: 'DM Sans', sans-serif; transition: all 0.3s;"
                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(234, 88, 12, 0.4)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 14px rgba(234, 88, 12, 0.3)';">
                        <span class="material-symbols-outlined" style="font-size: 20px;">how_to_reg</span>
                        Đăng ký tham gia ngay
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- DYNAMIC CONTENT BLOCKS --}}
        @foreach($event->galleryImages as $index => $block)
        <div class="t4-card {{ $index % 2 == 0 ? 't4-card-alt' : '' }}">
            @if(!empty($block->caption))
            <div class="t4-sec-title" style="{{ $titleStyleStr }}">{{ $block->caption }}</div>
            <div class="t4-sec-ornament-line"><div class="t4-sec-ornament-dot"></div></div>
            @endif

            <div class="t4-body-text" style="{{ $descStyleStr }}">
                @if(!empty($block->content))
                    {!! $block->content !!}
                @endif
                
                @if(!empty($block->url))
                    <div style="margin-top: 25px; text-align: center;">
                        @if($block->type === 'video')
                            <video src="{{ \App\Helpers\FileHelper::url($block->url) }}" style="max-width: 100%; border-radius: 4px; border: 1px solid rgba(0,0,0,0.1);" autoplay loop muted playsinline controls></video>
                        @else
                            <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" alt="" style="max-width: 100%; border-radius: 4px; border: 1px solid rgba(0,0,0,0.1);">
                        @endif
                    </div>
                @endif

                @if(!empty($block->action_url))
                    <div style="margin-top: 25px; text-align: center;">
                        <a href="{{ $block->action_url }}" target="_blank" style="display: inline-block; padding: 10px 24px; background: var(--t4-gold); color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; font-size: 13px;">Chi tiết</a>
                    </div>
                @endif
            </div>
        </div>
        @endforeach

        {{-- SECTION 5: TIMELINE --}}
        @if($event->scheduleItems->count() > 0)
        <div class="t4-card t4-card-alt">
            <div class="t4-sec-title">Timeline chương trình</div>
            <div class="t4-sec-ornament-line"><div class="t4-sec-ornament-dot"></div></div>
            <div class="t4-timeline">
                @foreach($event->scheduleItems as $item)
                <div class="t4-timeline-item">
                    <div class="t4-timeline-dot"></div>
                    <div class="t4-timeline-content">
                        <div class="t4-timeline-time">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}{{ $item->end_time ? ' — ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') : '' }}</div>
                        <div class="t4-timeline-title">{{ $item->title }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- SECTION 7: DIỄN GIẢ --}}
        @if($event->speakers->count() > 0)
        <div class="t4-card">
            <div class="t4-sec-title">Diễn giả tham gia</div>
            <div class="t4-sec-ornament-line"><div class="t4-sec-ornament-dot"></div></div>
            <div class="t4-speakers">
                @foreach($event->speakers as $speaker)
                <div class="t4-speaker">
                    <img src="{{ $speaker->photo_url ? \App\Helpers\FileHelper::url($speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}" class="t4-speaker-img" alt="">
                    <div class="t4-speaker-name">{{ $speaker->name }}</div>
                    <div class="t4-speaker-role">{{ $speaker->title }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

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

        {{-- SECTION 8: PREV/NEXT EVENTS --}}
        @if(isset($previousEvent) || isset($nextEvent))
        <div class="t4-card" style="padding: 0; text-align: left;">
            <div class="t4-nav-events">
                <div style="flex: 1;">
                    @if(isset($previousEvent) && $previousEvent)
                    <a href="{{ route('events.show', $previousEvent->slug) }}" class="t4-nav-event-item" style="display: block;">
                        <div class="t4-nav-label">← Sự kiện trước</div>
                        <div class="t4-nav-title">{{ $previousEvent->title }}</div>
                    </a>
                    @else
                    <div style="flex: 1;"></div>
                    @endif
                </div>
                <div style="flex: 1;">
                    @if(isset($nextEvent) && $nextEvent)
                    <a href="{{ route('events.show', $nextEvent->slug) }}" class="t4-nav-event-item next" style="display: block;">
                        <div class="t4-nav-label">Sự kiện tiếp →</div>
                        <div class="t4-nav-title">{{ $nextEvent->title }}</div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

{{-- FIXED BOTTOM INTERACTION BAR --}}
<div class="t4-bottom-bar" x-data="{ copied: false }">
    <div class="t4-interaction-group">
        <a href="{{ route('home') }}" class="t4-action-btn" title="Về trang chủ">
            <span class="material-symbols-outlined">home</span>
        </a>
        <div class="t4-action-btn" title="Lượt xem">
            <span class="material-symbols-outlined">visibility</span>
            <span>{{ $event->views_count }}</span>
        </div>
    </div>
    
    <div class="t4-interaction-group">
        <button id="t4-like-btn" class="t4-heart-btn {{ session()->has('liked_events.' . $event->id) ? 'liked' : '' }}" title="Thích sự kiện" data-event-id="{{ $event->id }}">
            <span class="material-symbols-outlined {{ session()->has('liked_events.' . $event->id) ? 'font-fill' : '' }}">favorite</span>
            <span id="likes-count">{{ $event->likes_count }}</span>
        </button>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="t4-action-btn" style="background: #1877F2; color: #fff; border: none;">
            Chia sẻ
        </a>
        <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)" class="t4-action-btn relative">
            <span class="material-symbols-outlined" style="font-size: 18px;">link</span>
            <span x-show="copied" x-transition style="display:none;position:absolute;bottom:100%;left:50%;transform:translateX(-50%);margin-bottom:10px;background:#2C2520;color:white;font-size:11px;padding:4px 8px;border-radius:4px;white-space:nowrap;">Đã sao chép!</span>
        </button>
    </div>
</div>

@include('components.event-fab-menu', ['event' => $event])

<script>
    // Countdown Timer logic
    const countdownEl = document.getElementById('t4-countdown');
    if (countdownEl) {
        const targetDateStr = countdownEl.getAttribute('data-date');
        const targetDate = new Date(targetDateStr).getTime();
        
        function updateTimer() {
            const now = new Date().getTime();
            const diff = targetDate - now;
            
            if (diff < 0) {
                document.getElementById('t4-days').innerText = "00";
                document.getElementById('t4-hours').innerText = "00";
                document.getElementById('t4-mins').innerText = "00";
                document.getElementById('t4-secs').innerText = "00";
                return;
            }
            
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((diff % (1000 * 60)) / 1000);
            
            document.getElementById('t4-days').innerText = String(days).padStart(2, '0');
            document.getElementById('t4-hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('t4-mins').innerText = String(mins).padStart(2, '0');
            document.getElementById('t4-secs').innerText = String(secs).padStart(2, '0');
        }
        setInterval(updateTimer, 1000);
        updateTimer();
    }

    // Lượt thích
    const likeBtn = document.getElementById('t4-like-btn');
    if (likeBtn) {
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
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    countSpan.innerText = data.likes_count;
                    if (data.liked) {
                        likeBtn.classList.add('liked');
                        likeBtn.querySelector('.material-symbols-outlined').classList.add('font-fill');
                    } else {
                        likeBtn.classList.remove('liked');
                        likeBtn.querySelector('.material-symbols-outlined').classList.remove('font-fill');
                    }
                } else {
                    alert(data.message);
                }
            });
        });
    }
</script>
@endsection
