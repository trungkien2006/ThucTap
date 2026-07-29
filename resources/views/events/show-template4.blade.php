@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* Removed hide navbar rule to comply with layout rule */

:root {
    --t4-gold: #D97706; /* Màu vàng đồng / hổ phách sang trọng */
    --t4-gold-light: #FEF3C7; /* Vàng nhạt */
    --t4-bg: #FCF9F2; /* Màu giấy kem nhạt cao cấp */
    --t4-surface: #FFFFFF;
    --t4-text: #2C2520; /* Màu chữ nâu đen ấm */
    --t4-muted: #786F66; /* Chữ chú thích */
    --t4-border: #EADEC9; /* Viền màu vàng nhạt ấm */
}

.t4-body {
    background-color: var(--t4-bg) !important;
    color: var(--t4-text);
    font-family: 'Montserrat', sans-serif;
    line-height: 1.8;
    min-height: 100vh;
    padding-bottom: 100px;
}

/* ─── CONTAINER ─── */
.t4-container {
    max-width: 1000px;
    margin: 0 auto;
    background: var(--t4-surface);
    border-left: 1px solid var(--t4-border);
    border-right: 1px solid var(--t4-border);
    min-height: 100vh;
    box-shadow: 0 0 40px rgba(44, 37, 32, 0.04);
    position: relative;
}

/* ─── HERO SECTION ─── */
.t4-hero {
    position: relative;
    width: 100%;
    height: 380px;
    overflow: hidden;
}
.t4-hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t4-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(44,37,32,0.1), rgba(44,37,32,0.6));
    z-index: 1;
}
.t4-hero-content {
    position: absolute;
    bottom: 30px;
    left: 0;
    right: 0;
    text-align: center;
    color: #FFFFFF;
    z-index: 2;
    padding: 0 20px;
}
.t4-hero-quote {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 14px;
    opacity: 0.95;
    margin-bottom: 10px;
    letter-spacing: 0.05em;
}
.t4-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 26px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 6px;
    letter-spacing: -0.01em;
    color: #FEF3C7;
}
.t4-hero-subtitle {
    font-size: 13px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    font-weight: 600;
}

/* ─── CARD SECTIONS ─── */
.t4-card {
    padding: 40px 24px;
    text-align: center;
    border-bottom: 1px solid var(--t4-border);
    position: relative;
}
.t4-card::after {
    content: '✦';
    position: absolute;
    bottom: -9px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--t4-surface);
    padding: 0 10px;
    color: var(--t4-gold);
    font-size: 12px;
    z-index: 2;
}
.t4-card:last-of-type {
    border-bottom: none;
}
.t4-card:last-of-type::after {
    display: none;
}

/* Section Title */
.t4-sec-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--t4-gold);
    margin-bottom: 16px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.t4-date-highlight {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    color: var(--t4-gold);
    margin-bottom: 16px;
    font-weight: 600;
}

.t4-body-text {
    font-size: 13.5px;
    color: var(--t4-text);
    line-height: 1.8;
}

/* ─── INFO BOXES ─── */
.t4-info-wrap {
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.t4-info-item {
    background: #FAF8F2;
    border: 1px solid var(--t4-border);
    border-radius: 12px;
    padding: 16px;
}
.t4-info-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--t4-muted);
    font-weight: 700;
    margin-bottom: 4px;
}
.t4-info-val {
    font-size: 14px;
    font-weight: 600;
    color: var(--t4-text);
}

/* ─── TIMELINE ─── */
.t4-timeline {
    margin-top: 24px;
    position: relative;
    padding-left: 20px;
    text-align: left;
}
.t4-timeline::before {
    content: '';
    position: absolute;
    left: 4px;
    top: 6px;
    bottom: 6px;
    width: 1px;
    background: var(--t4-border);
}
.t4-timeline-item {
    position: relative;
    padding-bottom: 24px;
}
.t4-timeline-item:last-child {
    padding-bottom: 0;
}
.t4-timeline-dot {
    position: absolute;
    left: -20px;
    top: 6px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: var(--t4-gold);
    border: 2px solid var(--t4-surface);
}
.t4-timeline-time {
    font-size: 11px;
    font-weight: 700;
    color: var(--t4-gold);
    margin-bottom: 2px;
}
.t4-timeline-title {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--t4-text);
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
                <div class="t4-hero-quote">"Vượt núi băng ngàn, tìm đến bình minh. Khởi đầu nơi đây, mở ra muôn ngả chân trời."</div>
                <h1 class="t4-hero-title" style="{{ $titleStyleStr }}">{!! nl2br(e($event->title)) !!}</h1>
                <div class="t4-hero-subtitle">{{ $event->category ? $event->category->name : 'SỰ KIỆN NỔI BẬT' }}</div>
            </div>
        </div>

        {{-- SECTION 2: DATE & FAREWELL QUOTE --}}
        <div class="t4-card">
            <div class="t4-date-highlight">- {{ $event->event_date->format('Y.m.d') }} -</div>
            <div class="t4-body-text" style="font-style: italic;">
                "Rồi chúng ta cũng sẽ hòa vào biển người, mỗi người đều có phong ba và rực rỡ riêng. Chúc cho chặng đường tới, hoa nở như gấm, ngày gặp lại vẫn như xưa."
            </div>
        </div>

        {{-- SECTION 3: INVITATION --}}
        <div class="t4-card">
            <div class="t4-sec-title">Trân trọng kính mời</div>
            <div class="t4-body-text">
                <strong style="color: var(--t4-gold);">Kính gửi quý thầy cô, đại biểu và các bạn sinh viên</strong>
                <div class="mt-3">
                    Chúng tôi vinh hạnh được đồng hành và chứng kiến khoảnh khắc trọng đại này cùng bạn. Sự hiện diện của bạn là niềm vinh dự lớn lao cho chương trình.
                </div>
            </div>
        </div>

        {{-- SECTION 4: EVENT DETAILS & COUNTDOWN --}}
        <div class="t4-card">
            <div class="t4-sec-title">Thời gian & Địa điểm</div>
            <div class="t4-info-wrap">
                <div class="t4-info-item">
                    <div class="t4-info-label">Thời gian</div>
                    <div class="t4-info-val">
                        {{ $event->event_date->translatedFormat('H:i, l d/m/Y') }} 
                        @if($event->end_date)
                            — {{ $event->end_date->translatedFormat('H:i, d/m/Y') }}
                        @endif
                    </div>
                </div>
                @if($event->location)
                <div class="t4-info-item">
                    <div class="t4-info-label">Địa điểm</div>
                    <div class="t4-info-val">{{ $event->location }}</div>
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

        {{-- SECTION 5: TIMELINE --}}
        @if($event->scheduleItems->count() > 0)
        <div class="t4-card">
            <div class="t4-sec-title">Timeline chương trình</div>
            <div class="t4-timeline">
                @foreach($event->scheduleItems as $item)
                <div class="t4-timeline-item">
                    <div class="t4-timeline-dot"></div>
                    <div class="t4-timeline-time">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}{{ $item->end_time ? ' - ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') : '' }}</div>
                    <div class="t4-timeline-title">{{ $item->title }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

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

        {{-- SECTION 6: INSPIRATIONAL / PHOTO GALLERY --}}
        <div class="t4-card">
            <div class="t4-sec-title">Tương lai rực rỡ</div>
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
            @if($event->galleryImages->count() > 0)
            <div class="grid grid-cols-2 gap-4 mt-6">
                @foreach($event->galleryImages->take(4) as $block)
                    @if($block->url)
                        <div class="rounded-lg overflow-hidden border border-slate-100 shadow-sm" style="aspect-ratio: 1/1;">
                            <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="w-full h-full object-cover" alt="">
                        </div>
                    @endif
                @endforeach
            </div>
            @endif
        </div>

        {{-- SECTION 7: DIỄN GIẢ --}}
        @if($event->speakers->count() > 0)
        <div class="t4-card">
            <div class="t4-sec-title">Diễn giả tham gia</div>
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
        <div class="t4-card" style="display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap;">
            <div style="flex: 1; text-align: left;">
                @if(isset($previousEvent) && $previousEvent)
                <a href="{{ route('events.show', $previousEvent->slug) }}" style="text-decoration:none; color: var(--t4-text);">
                    <div style="font-size:11px; text-transform:uppercase; color:var(--t4-muted); font-weight:700; margin-bottom:4px;">← Sự kiện trước</div>
                    <div style="font-family:'Playfair Display',serif; font-weight:700; font-size:16px;">{{ $previousEvent->title }}</div>
                </a>
                @endif
            </div>
            <div style="flex: 1; text-align: right;">
                @if(isset($nextEvent) && $nextEvent)
                <a href="{{ route('events.show', $nextEvent->slug) }}" style="text-decoration:none; color: var(--t4-text);">
                    <div style="font-size:11px; text-transform:uppercase; color:var(--t4-muted); font-weight:700; margin-bottom:4px;">Sự kiện tiếp →</div>
                    <div style="font-family:'Playfair Display',serif; font-weight:700; font-size:16px;">{{ $nextEvent->title }}</div>
                </a>
                @endif
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
