@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Satisfy&family=Fredoka+One&family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
<style>
/* Hide standard navbar and footer to fully showcase the custom mobile-like layout */
#navbar, .studio-footer {
    display: none !important;
}

:root {
    --t5-bg: #D4EBF8; /* Pastel Baby Blue */
    --t5-card-bg: #FFFFFF;
    --t5-text-dark: #1E3E62; /* Navy blue */
    --t5-text-muted: #5B7B9C;
    --t5-accent-pink: #FF6B8B; /* Sweet Pink */
    --t5-accent-yellow: #FFD166;
    --t5-border-color: #BBD6EC;
}

.t5-body {
    background-color: var(--t5-bg) !important;
    color: var(--t5-text-dark);
    font-family: 'Quicksand', sans-serif;
    font-size: 14px;
    line-height: 1.6;
    min-height: 100vh;
    padding-bottom: 80px;
}

/* ─── CONTAINER ─── */
.t5-container {
    max-width: 1000px;
    margin: 0 auto;
    background: #FFFFFF;
    min-height: 100vh;
    box-shadow: 0 0 50px rgba(30, 62, 98, 0.08);
    position: relative;
    overflow-x: hidden;
}

/* Decorative background bubbles */
.t5-bubble {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    pointer-events: none;
    z-index: 1;
}

/* ─── ROTATING MUSIC RECORD ─── */
.t5-music-record {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 44px;
    height: 44px;
    background: #222;
    border-radius: 50%;
    border: 3px solid #FFF;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    animation: spin-record 4s linear infinite;
}
.t5-music-record::after {
    content: '🎵';
    font-size: 16px;
}
@keyframes spin-record {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* ─── POLAROID PHOTO STYLING ─── */
.t5-polaroid {
    background: #FFFFFF;
    padding: 12px 12px 28px 12px;
    border-radius: 4px;
    box-shadow: 0 10px 25px rgba(30, 62, 98, 0.12);
    border: 1px solid rgba(0,0,0,0.03);
    display: inline-block;
    transition: transform 0.3s ease;
}
.t5-polaroid-img-wrap {
    width: 100%;
    aspect-ratio: 1/1;
    overflow: hidden;
    background: #F0F4F8;
    position: relative;
}
.t5-polaroid-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t5-polaroid-caption {
    font-family: 'Caveat', cursive;
    font-size: 20px;
    color: var(--t5-text-dark);
    margin-top: 8px;
    text-align: center;
}

/* Torn effect border alternative styling for polaroid cards */
.t5-polaroid.torn {
    border-radius: 8px;
    border: 8px solid #FFFFFF;
    box-shadow: 0 12px 30px rgba(30, 62, 98, 0.15);
}

/* ─── HERO SECTION ─── */
.t5-hero-section {
    background: linear-gradient(to bottom, #D2EDFC 0%, #FFFFFF 100%);
    padding: 40px 24px 20px;
    text-align: center;
    position: relative;
}
.t5-hero-subtitle {
    font-family: 'Satisfy', cursive;
    font-size: 14px;
    color: var(--t5-text-muted);
    line-height: 1.4;
    margin-bottom: 12px;
}
.t5-hero-title {
    font-family: 'Satisfy', cursive;
    font-size: 64px;
    color: #4A90E2;
    margin: 0;
    line-height: 1;
    text-shadow: 0 4px 10px rgba(74, 144, 226, 0.15);
}
.t5-hero-collage {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 24px 0;
    position: relative;
    z-index: 5;
}
.t5-hero-collage .t5-polaroid {
    width: 70%;
    transform: rotate(-3deg);
}
.t5-celebrant-badge {
    font-family: 'Caveat', cursive;
    font-size: 32px;
    color: var(--t5-accent-pink);
    margin-top: 10px;
    display: inline-block;
    transform: rotate(2deg);
}
.t5-hero-welcome {
    font-size: 11px;
    letter-spacing: 0.25em;
    font-weight: 700;
    color: var(--t5-text-muted);
    margin-top: 12px;
    text-transform: uppercase;
}

/* ─── CARD SECTIONS ─── */
.t5-card {
    padding: 32px 24px;
    text-align: center;
    position: relative;
    z-index: 5;
}
.t5-sec-title {
    font-family: 'Fredoka One', cursive;
    font-size: 24px;
    color: #4A90E2;
    margin-bottom: 16px;
    display: inline-block;
    position: relative;
}

.t5-sec-title.bubble {
    background: #E8F4FC;
    padding: 6px 20px;
    border-radius: 20px;
}

.t5-body-text {
    font-size: 14px;
    color: var(--t5-text-dark);
    line-height: 1.8;
    white-space: pre-line;
}

/* ─── COLLAGE GRID SECTION ─── */
.t5-collage-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    padding: 12px 0;
    margin-top: 16px;
}
.t5-collage-item {
    position: relative;
}
.t5-collage-item:nth-child(1) {
    transform: rotate(-4deg);
}
.t5-collage-item:nth-child(2) {
    transform: rotate(3deg);
    margin-top: 12px;
}
.t5-collage-item:nth-child(3) {
    grid-column: span 2;
    justify-self: center;
    width: 80%;
    transform: rotate(-1deg);
    margin-top: 16px;
}

/* Button style */
.t5-phone-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #4A90E2;
    color: #FFFFFF !important;
    text-decoration: none;
    font-weight: 700;
    font-size: 13px;
    padding: 10px 24px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.25);
    margin-top: 20px;
    transition: background 0.2s;
}
.t5-phone-btn:hover {
    background: #357ABD;
}


/* ─── SPEAKERS GRID ─── */
.t5-speakers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 20px;
    margin-top: 16px;
}
.t5-speaker-card {
    background: #FFFFFF;
    border: 1px solid var(--t5-border-color);
    border-radius: 12px;
    padding: 16px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(30, 62, 98, 0.04);
}
.t5-speaker-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin: 0 auto 12px;
    overflow: hidden;
    border: 2px solid #E8F4FC;
}
.t5-speaker-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t5-speaker-name {
    font-weight: 700;
    font-size: 14px;
    color: var(--t5-text-dark);
}
.t5-speaker-role {
    font-size: 11px;
    color: var(--t5-text-muted);
    margin-top: 2px;
}

/* ─── SCHEDULE TIMELINE ─── */
.t5-schedule-grid {
    display: flex;
    flex-direction: column;
    gap: 16px;
    position: relative;
    padding-left: 20px;
    text-align: left;
    margin-top: 16px;
}
.t5-schedule-grid::before {
    content: '';
    position: absolute;
    left: 4px;
    top: 8px;
    bottom: 8px;
    width: 2px;
    background: #4A90E2;
    opacity: 0.3;
}
.t5-schedule-item {
    position: relative;
}
.t5-schedule-item::before {
    content: '';
    position: absolute;
    left: -20px;
    top: 6px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #4A90E2;
    border: 2px solid #FFFFFF;
}
.t5-schedule-time {
    font-family: 'Fredoka One', cursive;
    font-size: 14px;
    color: #4A90E2;
}
.t5-schedule-body {
    background: #F4F8FB;
    padding: 12px 16px;
    border-radius: 12px;
    margin-top: 4px;
}
.t5-schedule-title {
    font-weight: 700;
    font-size: 13.5px;
    color: var(--t5-text-dark);
}
.t5-schedule-speaker {
    font-size: 11.5px;
    color: var(--t5-text-muted);
    margin-top: 4px;
}

/* ─── CALENDAR WIDGET ─── */
.t5-calendar-box {
    background: #FAF8F2;
    border: 1px solid var(--t5-border-color);
    border-radius: 16px;
    padding: 20px;
    margin: 20px 0;
    box-shadow: 0 8px 20px rgba(30,62,98,0.04);
}
.t5-cal-month-title {
    font-weight: 700;
    font-size: 15px;
    color: var(--t5-text-dark);
    margin-bottom: 16px;
    text-transform: capitalize;
}
.t5-cal-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
    font-size: 13px;
}
.t5-cal-weekday {
    font-weight: 700;
    color: var(--t5-text-muted);
    padding-bottom: 8px;
}
.t5-cal-day {
    aspect-ratio: 1/1;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    color: var(--t5-text-dark);
    border-radius: 50%;
}
.t5-cal-day.active {
    background: var(--t5-accent-pink);
    color: #FFFFFF;
    font-weight: 700;
}
.t5-cal-day.active::after {
    content: '❤️';
    position: absolute;
    font-size: 10px;
    bottom: -6px;
    right: -4px;
}
.t5-cal-day.empty {
    visibility: hidden;
}

/* ─── ADDRESS MAP ─── */
.t5-map-wrap {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--t5-border-color);
    margin: 20px 0;
    aspect-ratio: 16/9;
}
.t5-map-iframe {
    width: 100%;
    height: 100%;
    border: none;
}
.t5-address-text {
    font-size: 13.5px;
    color: var(--t5-text-dark);
    margin-top: 12px;
    font-weight: 600;
}

/* ─── COUNTDOWN ─── */
.t5-countdown-wrap {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 20px 0 10px;
}
.t5-cd-item {
    background: #E8F4FC;
    border-radius: 12px;
    min-width: 68px;
    padding: 10px 6px;
    box-shadow: 0 4px 10px rgba(74, 144, 226, 0.08);
}
.t5-cd-val {
    font-family: 'Fredoka One', cursive;
    font-size: 22px;
    color: #4A90E2;
}
.t5-cd-lbl {
    font-size: 10px;
    color: var(--t5-text-muted);
    font-weight: 700;
    text-transform: uppercase;
}

/* ─── INTERACTION BAR ─── */
.t5-bottom-bar {
    position: fixed;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    max-width: 1000px;
    background: #FFFFFF;
    border-top: 1px solid var(--t5-border-color);
    padding: 12px 20px;
    display: flex;
    gap: 12px;
    z-index: 100;
    box-shadow: 0 -4px 20px rgba(30, 62, 98, 0.05);
}
.t5-bottom-input {
    flex: 1;
    padding: 10px 16px;
    border: 1px solid var(--t5-border-color);
    background: #F4F8FB;
    border-radius: 20px;
    font-size: 13px;
    outline: none;
}
.t5-bottom-input:focus {
    border-color: #4A90E2;
    background: #FFFFFF;
}
.t5-heart-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 1px solid var(--t5-border-color);
    background: #F4F8FB;
    color: var(--t5-accent-pink);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}
.t5-heart-btn:hover {
    background: #FFEBEF;
}

.t5-wishes-list {
    margin-top: 24px;
    max-height: 220px;
    overflow-y: auto;
    text-align: left;
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding-right: 6px;
}
.t5-wishes-list::-webkit-scrollbar {
    width: 4px;
}
.t5-wishes-list::-webkit-scrollbar-thumb {
    background: var(--t5-border-color);
    border-radius: 2px;
}
.t5-wish-item {
    background: #F4F8FB;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 12px;
    border-left: 3px solid #4A90E2;
}
.t5-wish-meta {
    font-weight: 700;
    color: #4A90E2;
    margin-bottom: 2px;
}
</style>
@endpush

@php
    $titleStyles = [];
    if (!empty($event->title_font_family)) $titleStyles[] = "font-family: '{$event->title_font_family}', sans-serif;";
    if (!empty($event->title_font_size))   $titleStyles[] = "font-size: {$event->title_font_size}px;";
    if (!empty($event->title_color))       $titleStyles[] = "color: {$event->title_color} !important;";
    $titleStyleStr = implode(' ', $titleStyles);

    $descStyles = [];
    if (!empty($event->desc_font_family)) $descStyles[] = "font-family: '{$event->desc_font_family}', sans-serif;";
    if (!empty($event->desc_font_size))   $descStyles[] = "font-size: {$event->desc_font_size}px;";
    if (!empty($event->desc_color))       $descStyles[] = "color: {$event->desc_color} !important;";
    $descStyleStr = implode(' ', $descStyles);

    // Get event date and prepare calendar grid
    $eventDate = $event->event_date;
    $calYear = $eventDate->year;
    $calMonth = $eventDate->month;
    $calDay = $eventDate->day;

    $firstDay = \Carbon\Carbon::createFromDate($calYear, $calMonth, 1);
    $daysInMonth = $firstDay->daysInMonth;
    // dayOfWeek is 0 (Sunday) to 6 (Saturday). We align T2 (Mon) as first col:
    // CN(0), T2(1), T3(2), T4(3), T5(4), T6(5), T7(6)
    $startCell = $firstDay->dayOfWeek; 
@endphp

@section('content')
<div class="t5-body">
    <div class="t5-container">
        
        {{-- Floating Record Icon --}}
        <div class="t5-music-record" id="music-play-btn" title="Phát nhạc"></div>

        {{-- SECTION 1: HERO HEADER --}}
        <div class="t5-hero-section">
            <div class="t5-hero-subtitle" style="text-transform: uppercase; letter-spacing: 0.15em;">{{ $event->category ? $event->category->name : 'SỰ KIỆN ĐẶC BIỆT' }}</div>
            <h1 class="t5-hero-title">Invitation</h1>
            
            <div class="t5-hero-collage">
                <div class="t5-polaroid torn">
                    <div class="t5-polaroid-img-wrap">
                        @if($event->bannerImage)
                            <img src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}" class="t5-polaroid-img" alt="Cover photo">
                        @else
                            <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?auto=format&fit=crop&w=600&q=80" class="t5-polaroid-img" alt="Cover photo default">
                        @endif
                    </div>
                </div>
            </div>

            <div class="t5-celebrant-badge" style="{{ $titleStyleStr }}">{!! nl2br(e($event->title)) !!}</div>
            <div class="t5-hero-welcome">WELCOME TO THE EVENT</div>
        </div>

        {{-- SECTION 2: INVITATION --}}
        <div class="t5-card">
            <div class="t5-sec-title bubble">Lời mời trân trọng</div>
            <div class="t5-body-text" style="{{ $descStyleStr }}">
                {!! $event->description !!}
            </div>
        </div>

        {{-- SECTION 3: COLLAGE GALLERY & HOST CONTACT --}}
        @if($event->galleryImages->count() > 0)
        <div class="t5-card">
            <div class="t5-collage-grid">
                @php
                    $slicedGallery = $event->galleryImages->take(3);
                @endphp
                @foreach($slicedGallery as $idx => $block)
                <div class="t5-collage-item">
                    <div class="t5-polaroid">
                        <div class="t5-polaroid-img-wrap">
                            <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="t5-polaroid-img" alt="">
                        </div>
                        @if($block->caption)
                            <div class="t5-polaroid-caption">{{ $block->caption }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- SECTION: DIỄN GIẢ & KHÁCH MỜI --}}
        @if($event->speakers->count() > 0)
        <div class="t5-card">
            <div class="t5-sec-title bubble">Diễn giả & Khách mời</div>
            <div class="t5-speakers-grid">
                @foreach($event->speakers as $speaker)
                <div class="t5-speaker-card">
                    <div class="t5-speaker-avatar">
                        @if($speaker->photo_url)
                            <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" alt="{{ $speaker->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80" alt="{{ $speaker->name }}">
                        @endif
                    </div>
                    <div class="t5-speaker-name">{{ $speaker->name }}</div>
                    <div class="t5-speaker-role">{{ $speaker->title }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- SECTION: LỊCH TRÌNH CHƯƠNG TRÌNH --}}
        @if($event->scheduleItems->count() > 0)
        <div class="t5-card">
            <div class="t5-sec-title bubble">Chương trình hội thảo</div>
            <div class="t5-schedule-grid">
                @foreach($event->scheduleItems as $item)
                <div class="t5-schedule-item">
                    <div class="t5-schedule-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '--:--' }}</div>
                    <div class="t5-schedule-body">
                        <div class="t5-schedule-title">{{ $item->title }}</div>
                        @if($item->speaker)
                            <div class="t5-schedule-speaker">Diễn giả: {{ $item->speaker->name }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- SECTION 4: PARTY TIME (CALENDAR) --}}
        <div class="t5-card">
            <div class="t5-sec-title bubble">Thời gian diễn ra</div>
            <div class="t5-calendar-box">
                <div class="t5-cal-month-title">Tháng {{ $eventDate->translatedFormat('F Y') }}</div>
                <div class="t5-cal-grid">
                    <div class="t5-cal-weekday">CN</div>
                    <div class="t5-cal-weekday">T2</div>
                    <div class="t5-cal-weekday">T3</div>
                    <div class="t5-cal-weekday">T4</div>
                    <div class="t5-cal-weekday">T5</div>
                    <div class="t5-cal-weekday">T6</div>
                    <div class="t5-cal-weekday">T7</div>

                    {{-- Empty cells before start of month --}}
                    @for($i = 0; $i < $startCell; $i++)
                        <div class="t5-cal-day empty"></div>
                    @endfor

                    {{-- Day cells --}}
                    @for($d = 1; $d <= $daysInMonth; $d++)
                        <div class="t5-cal-day {{ $d == $calDay ? 'active' : '' }}">{{ $d }}</div>
                    @endfor
                </div>
            </div>
            
            <div class="t5-body-text font-bold">
                {{ $eventDate->translatedFormat('l, d \t\h\á\n\g m \n\ă\m Y') }}
                <br>
                <span style="color: var(--t5-accent-pink);">Thời gian: {{ $eventDate->format('H:i A') }}</span>
            </div>
        </div>

        {{-- SECTION 5: PARTY ADDRESS --}}
        @if($event->location)
        <div class="t5-card">
            <div class="t5-sec-title bubble">Địa điểm tổ chức</div>
            
            <div class="t5-map-wrap">
                {{-- Dynamic Map fallback using standard placeholder map structure or coordinates --}}
                <iframe class="t5-map-iframe" src="https://maps.google.com/maps?q={{ urlencode($event->location) }}&t=&z=14&ie=UTF8&iwloc=&output=embed"></iframe>
            </div>

            <div class="t5-address-text">{{ $event->location }}</div>
            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->location) }}" target="_blank" class="t5-phone-btn">
                <span class="material-symbols-outlined" style="font-size: 16px;">map</span> Maps ↗
            </a>
        </div>
        @endif

        {{-- SECTION 6: COUNTDOWN --}}
        @if($event->event_date > now())
        <div class="t5-card">
            <div class="t5-sec-title bubble">Đếm ngược</div>
            <div class="t5-countdown-wrap" id="t5-countdown" data-date="{{ $event->event_date->format('Y-m-d\TH:i:s') }}">
                <div class="t5-cd-item"><div class="t5-cd-val" id="t5-days">00</div><div class="t5-cd-lbl">Ngày</div></div>
                <div class="t5-cd-item"><div class="t5-cd-val" id="t5-hours">00</div><div class="t5-cd-lbl">Giờ</div></div>
                <div class="t5-cd-item"><div class="t5-cd-val" id="t5-mins">00</div><div class="t5-cd-lbl">Phút</div></div>
                <div class="t5-cd-item"><div class="t5-cd-val" id="t5-secs">00</div><div class="t5-cd-lbl">Giây</div></div>
            </div>
        </div>
        @endif

        {{-- WISHES AND COMMENTS GUESTBOOK --}}
        <div class="t5-card" style="border-top: 1px solid var(--t5-border-color);">
            <div class="t5-sec-title bubble">Lời nhắn từ người tham gia</div>
            <div class="t5-wishes-list" id="t5-wishes-container">
                <div class="t5-wish-item">
                    <div class="t5-wish-meta">Phương Thảo</div>
                    <div>Chúc hội thảo thể thao diễn ra thật thành công tốt đẹp! Đề tài rất thiết thực! 🎉🏆</div>
                </div>
                <div class="t5-wish-item">
                    <div class="t5-wish-meta">Tuấn Anh</div>
                    <div>Rất mong chờ phần chia sẻ của HLV về phương pháp rèn luyện thể chất toàn diện! 🏋️‍♂️✨</div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- BOTTOM INTERACTION FLOATING BAR --}}
<div class="t5-bottom-bar">
    <input type="text" id="t5-wish-input" placeholder="Gửi lời chúc hoặc phản hồi đến sự kiện..." class="t5-bottom-input" />
    <button id="t5-like-btn" class="t5-heart-btn" title="Thích sự kiện">
        <span class="material-symbols-outlined font-fill">favorite</span>
    </button>
</div>

<script>
    // Countdown logic
    const cdEl = document.getElementById('t5-countdown');
    if (cdEl) {
        const targetDate = new Date(cdEl.getAttribute('data-date')).getTime();
        function updateCd() {
            const diff = targetDate - Date.now();
            if (diff <= 0) {
                document.getElementById('t5-days').innerText = "00";
                document.getElementById('t5-hours').innerText = "00";
                document.getElementById('t5-mins').innerText = "00";
                document.getElementById('t5-secs').innerText = "00";
                return;
            }
            const d = Math.floor(diff / 86400000);
            const h = Math.floor((diff % 86400000) / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            
            document.getElementById('t5-days').innerText = String(d).padStart(2, '0');
            document.getElementById('t5-hours').innerText = String(h).padStart(2, '0');
            document.getElementById('t5-mins').innerText = String(m).padStart(2, '0');
            document.getElementById('t5-secs').innerText = String(s).padStart(2, '0');
        }
        setInterval(updateCd, 1000); updateCd();
    }

    // Floating Record Play Audio toggle
    let audio = null;
    document.getElementById('music-play-btn').addEventListener('click', function() {
        if (!audio) {
            audio = new Audio('https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3'); // Fallback melody track
            audio.loop = true;
        }
        if (audio.paused) {
            audio.play();
            this.style.animationPlayState = 'running';
        } else {
            audio.pause();
            this.style.animationPlayState = 'paused';
        }
    });

    // Wish input add logic
    document.getElementById('t5-wish-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const text = this.value.trim();
            if (!text) return;
            const container = document.getElementById('t5-wishes-container');
            const item = document.createElement('div');
            item.className = 't5-wish-item';
            item.innerHTML = `<div class="t5-wish-meta">Khách ẩn danh</div><div>${text}</div>`;
            container.insertAdjacentElement('afterbegin', item);
            this.value = '';
        }
    });

    // Like functionality calling events.like route name
    const likeBtn = document.getElementById('t5-like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            const heart = this.querySelector('span');
            heart.classList.toggle('text-red-600');
            
            fetch("{{ route('events.like', $event->id) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Đã thích sự kiện này!');
                }
            });
        });
    }
</script>
@endsection
