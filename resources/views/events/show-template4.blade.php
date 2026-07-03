@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* Reset navbar and footer to showcase the custom invitation layout */
#navbar, .studio-footer {
    display: none !important;
}

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

/* ─── RSVP FORM ─── */
.t4-input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--t4-border);
    background: #FAF8F2;
    border-radius: 8px;
    font-size: 13px;
    font-family: inherit;
    color: var(--t4-text);
    outline: none;
    transition: all 0.2s;
}
.t4-input:focus {
    border-color: var(--t4-gold);
    background: #FFFFFF;
}
.t4-radio-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
    text-align: left;
    margin: 16px 0;
}
.t4-radio-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    cursor: pointer;
    color: var(--t4-text);
}
.t4-radio-label input {
    accent-color: var(--t4-gold);
}
.t4-btn {
    width: 100%;
    padding: 14px;
    background: var(--t4-gold);
    color: #FFFFFF;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    font-size: 13.5px;
    cursor: pointer;
    transition: background 0.2s;
}
.t4-btn:hover {
    background: #B45309;
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
    gap: 12px;
    z-index: 100;
    box-shadow: 0 -4px 20px rgba(44, 37, 32, 0.06);
}
.t4-bottom-input {
    flex: 1;
    padding: 10px 16px;
    border: 1px solid var(--t4-border);
    background: #FAF8F2;
    border-radius: 20px;
    font-size: 12.5px;
    outline: none;
}
.t4-bottom-input:focus {
    border-color: var(--t4-gold);
    background: #FFFFFF;
}
.t4-heart-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 1px solid var(--t4-border);
    background: #FAF8F2;
    color: #EF4444;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}
.t4-heart-btn:hover {
    background: #FEE2E2;
}

/* ─── GUEST WISHES LIST ─── */
.t4-wishes-list {
    margin-top: 20px;
    max-height: 180px;
    overflow-y: auto;
    text-align: left;
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding-right: 6px;
}
.t4-wishes-list::-webkit-scrollbar {
    width: 4px;
}
.t4-wishes-list::-webkit-scrollbar-thumb {
    background: var(--t4-border);
    border-radius: 2px;
}
.t4-wish-item {
    background: #FAF8F2;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 12px;
    border-left: 3px solid var(--t4-gold);
}
.t4-wish-meta {
    font-weight: 700;
    color: var(--t4-gold);
    margin-bottom: 2px;
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
                <div class="t4-hero-subtitle">{{ $event->academic_year ?? 'LỄ TỐT NGHIỆP' }}</div>
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
                <strong style="color: var(--t4-gold);">Kính gửi quý thầy cô và các bạn cựu sinh viên</strong>
                <div class="mt-3">
                    Lễ tốt nghiệp là cột mốc khép lại hành trình rực rỡ của những năm tháng thanh xuân dưới mái trường thân yêu, đồng thời mở ra cánh cửa tương lai đầy hứa hẹn. Chúng tôi vinh hạnh được đồng hành và chứng kiến khoảnh khắc trọng đại này cùng bạn.
                </div>
            </div>
        </div>

        {{-- SECTION 4: EVENT DETAILS & COUNTDOWN --}}
        <div class="t4-card">
            <div class="t4-sec-title">Thời gian & Địa điểm</div>
            <div class="t4-info-wrap">
                <div class="t4-info-item">
                    <div class="t4-info-label">Thời gian</div>
                    <div class="t4-info-val">{{ $event->event_date->translatedFormat('H:i - l, d/m/Y') }}</div>
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
                    <div class="t4-timeline-time">{{ $item->start_time }}</div>
                    <div class="t4-timeline-title">{{ $item->title }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- SECTION 6: INSPIRATIONAL / PHOTO GALLERY --}}
        <div class="t4-card">
            <div class="t4-sec-title">Tương lai rực rỡ</div>
            <div class="t4-body-text" style="{{ $descStyleStr }}">
                {!! $event->description !!}
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
            <div class="t4-sec-title">Diễn giả & Khách mời</div>
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




    </div>
</div>

{{-- FIXED BOTTOM INTERACTION BAR --}}
<div class="t4-bottom-bar">
    <input type="text" id="t4-comment-input" placeholder="Gửi lời chúc tốt đẹp đến mọi người..." class="t4-bottom-input" />
    <button id="t4-like-btn" class="t4-heart-btn" title="Thích sự kiện">
        <span class="material-symbols-outlined font-fill">favorite</span>
    </button>
</div>

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
            // Hiệu ứng bắn tim đơn giản
            const heart = this.querySelector('span');
            heart.classList.toggle('text-red-600');
            
            // Gọi AJAX like
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
