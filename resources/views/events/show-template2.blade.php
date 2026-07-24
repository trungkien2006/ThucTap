@extends('layouts.frontend')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
    /* ─── Template 2: Garden Style ─── */
    /* Override global layout styles within .gw-wrapper */
    body:has(.gw-wrapper) { background-color: #eaecf0 !important; }
    .gw-wrapper { background-color: #eaecf0 !important; color: #3d4438; font-family: 'DM Sans', sans-serif !important; font-weight: 300; overflow-x: hidden; }
    .gw-wrapper h1, .gw-wrapper h2, .gw-wrapper h3, .gw-wrapper h4 { font-family: 'Cormorant Garamond', serif !important; letter-spacing: normal; }
    /* HERO — offsets under fixed site header */
    .gw-hero { position: relative; height: calc(100vh - 72px); min-height: 540px; overflow: hidden; margin-top: 72px; }
    .gw-hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; pointer-events: none; user-select: none; }
    .gw-hero-div { position: absolute; inset: 0; background: linear-gradient(135deg, #3d4438 0%, #5d7a5c 100%); }
    .gw-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(20,24,18,0.28) 0%, rgba(20,24,18,0.08) 50%, rgba(20,24,18,0.38) 100%); }
    .gw-hero-title-block { position: absolute; top: 50%; right: 5%; transform: translateY(-50%); text-align: right; color: #fff; z-index: 2; }
    .gw-hero-eyebrow { font-size: 0.88rem; letter-spacing: 0.3em; text-transform: uppercase; opacity: 0.88; margin-bottom: 10px; font-weight: 300; font-family: 'DM Sans', sans-serif; }
    .gw-hero-name { font-family: 'Cormorant Garamond', serif !important; font-size: clamp(3.64rem, 9.1vw, 7.15rem); font-weight: 600; line-height: 1; letter-spacing: 0.04em; text-transform: uppercase; text-shadow: 0 2px 30px rgba(0,0,0,0.25); color: #fff; }
    .gw-hero-meta { position: absolute; bottom: 36px; left: 36px; color: #fff; z-index: 2; }
    .gw-hero-date { font-size: 0.91rem; letter-spacing: 0.25em; text-transform: uppercase; font-weight: 400; opacity: 0.92; line-height: 2; font-family: 'DM Sans', sans-serif; }
    .gw-hero-location { font-size: 1.1rem; letter-spacing: 0.18em; text-transform: uppercase; font-weight: 500; font-family: 'DM Sans', sans-serif; }
    /* SECTIONS */
    .gw-section { background: #eaecf0; padding: 80px 24px; position: relative; }
    .gw-container { max-width: 860px; margin: 0 auto; }
    .gw-section-title { font-family: 'Cormorant Garamond', serif !important; font-size: clamp(2.6rem, 5.2vw, 3.9rem); font-weight: 400; color: #3d4438; margin-bottom: 8px; line-height: 1.2; }
    .gw-section-subtitle { font-size: 1.14rem; color: #6e7a6a; margin-bottom: 40px; font-weight: 300; }
    /* BOTANICAL */
    .gw-botanical { position: absolute; opacity: 0.18; pointer-events: none; user-select: none; }
    /* CARD */
    .gw-card { background: #f4f4f2 !important; border-radius: 4px; padding: 52px 48px; position: relative; overflow: hidden; text-align: center; box-shadow: 0 4px 40px rgba(0,0,0,0.06); }
    .gw-card-title { font-family: 'Cormorant Garamond', serif !important; font-size: 3.38rem; font-weight: 400; color: #3d4438; margin-bottom: 12px; }
    .gw-card-text { font-size: 1.1rem; color: #6e7a6a; line-height: 1.8; margin-bottom: 36px; font-family: 'DM Sans', sans-serif; }
    .gw-info-group { margin-bottom: 28px; text-align: left; }
    .gw-info-label { font-family: 'Cormorant Garamond', serif !important; font-size: 1.69rem; font-weight: 400; color: #3d4438; margin-bottom: 4px; }
    .gw-info-value { font-size: 1.07rem; color: #6e7a6a; line-height: 1.7; font-weight: 300; font-family: 'DM Sans', sans-serif; }
    .gw-btn { display: inline-block; padding: 13px 40px; background: #5d7a5c; color: #fff !important; font-size: 0.88rem; letter-spacing: 0.2em; text-transform: uppercase; font-weight: 500; text-decoration: none; transition: all 0.3s; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif; }
    .gw-btn:hover { background: #4a6449; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(93,122,92,0.3); }
    /* SCHEDULE */
    .gw-schedule-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 24px; margin-top: 40px; }
    .gw-schedule-img { width: 100%; aspect-ratio: 3/4; object-fit: cover; margin-bottom: 16px; display: block; }
    .gw-schedule-img-ph { width: 100%; aspect-ratio: 3/4; background: linear-gradient(135deg, #c8cfc6, #a8b5a6); margin-bottom: 16px; display: block; }
    .gw-schedule-name { font-family: 'Cormorant Garamond', serif !important; font-size: 1.82rem; font-weight: 400; color: #3d4438; margin-bottom: 4px; }
    .gw-schedule-time { font-size: 1.01rem; color: #5d7a5c; margin-bottom: 8px; letter-spacing: 0.06em; font-family: 'DM Sans', sans-serif; }
    .gw-schedule-desc { font-size: 1.04rem; color: #6e7a6a; line-height: 1.7; font-weight: 300; font-family: 'DM Sans', sans-serif; }
    /* FULL PHOTO */
    .gw-full-photo { width: 100%; height: 55vh; min-height: 320px; object-fit: cover; display: block; }
    /* STORY */
    .gw-story-heading { font-family: 'Cormorant Garamond', serif !important; font-size: clamp(2.34rem, 4.55vw, 3.38rem); font-weight: 400; color: #3d4438; margin-bottom: 12px; }
    .gw-story-body { font-size: 1.14rem; color: #6e7a6a; line-height: 1.9; font-weight: 300; max-width: 640px; font-family: 'DM Sans', sans-serif; }
    .gw-container-lg { max-width: 1080px; margin: 0 auto; }
    
    /* STORY SCROLLYTELLING */
    #gw-story { overflow: visible !important; } /* CRITICAL: sticky won't work with overflow:hidden */
    .gw-scrolly-container { display: flex; flex-direction: column; gap: 32px; margin-bottom: 60px; }
    .gw-scrolly-text-col { width: 100%; }
    .gw-scrolly-media-col { width: 100%; }
    .gw-text-block { margin-bottom: 40px; }
    .gw-scrolly-img { width: 100%; border-radius: 4px; object-fit: cover; aspect-ratio: 4/5; margin-bottom: 16px; display: none; }
    .gw-scrolly-img.active { display: block; }
    
    @media (min-width: 769px) {
        .gw-scrolly-container {
            flex-direction: row;
            gap: 48px;
            align-items: flex-start;
            position: relative;
        }
        .gw-scrolly-text-col { width: 45%; }
        .gw-scrolly-media-col {
            width: 50%;
            height: calc(100vh - 140px);
            position: relative;
        }
        /* States added by JS */
        .gw-scrolly-media-col.is-fixed {
            position: fixed;
            top: 100px;
            /* right position and width will be set by JS dynamically */
        }
        .gw-scrolly-media-col.is-bottom {
            position: absolute;
            bottom: 0;
            top: auto;
            right: 0; /* Align right within the relative container row */
        }
        .gw-scrolly-media-stack {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 4px;
            overflow: hidden;
        }
        .gw-scrolly-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: block;
            opacity: 0;
            transition: opacity 0.6s ease;
            margin-bottom: 0;
        }
        .gw-scrolly-img.active { opacity: 1; z-index: 2; }
        
        .gw-scrollable-text {
            max-height: 150px;
            overflow-y: auto;
            padding-right: 8px;
            word-break: break-word;
        }
        .gw-scrollable-text::-webkit-scrollbar { width: 5px; }
        .gw-scrollable-text::-webkit-scrollbar-track { background: rgba(0,0,0,0.05); border-radius: 4px; }
        .gw-scrollable-text::-webkit-scrollbar-thumb { background: #b0b0b0; border-radius: 4px; }

        .gw-hero {
            min-height: 100vh;
        }

        .gw-text-block {
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: 0;
            padding: 20px 0;
        }
        .gw-text-block:last-child {
            min-height: 50vh;
        }
    }
    /* GALLERY */
    .gw-gallery-section { background: #f4f4f2; padding: 60px 0 80px; overflow: hidden; }
    .gw-gallery-track { display: flex; gap: 0; transition: transform 0.5s cubic-bezier(0.4,0,0.2,1); }
    .gw-gallery-slide { flex: 0 0 33.333%; aspect-ratio: 3/4; overflow: hidden; position: relative; }
    .gw-gallery-slide img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .gw-gallery-slide:hover img { transform: scale(1.03); }
    .gw-gallery-controls { display: flex; justify-content: flex-end; gap: 16px; padding: 20px 32px 0; max-width: 900px; margin: 0 auto; }
    .gw-gallery-btn { width: 40px; height: 40px; background: none; border: 1px solid #3d4438; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #3d4438; transition: all 0.2s; font-size: 1.43rem; }
    .gw-gallery-btn:hover { background: #3d4438; color: #fff; }
    /* DIVIDER */
    .gw-divider { display: flex; align-items: center; gap: 20px; margin: 12px 0 48px; }
    .gw-divider-line { flex: 1; height: 1px; background: rgba(61,68,56,0.15); }
    .gw-divider-leaf { color: #5d7a5c; opacity: 0.5; font-size: 1.3rem; }
    /* REACTIONS */
    .gw-reactions { display: flex; gap: 16px; justify-content: center; margin-top: 48px; }
    .gw-like-btn { display: inline-flex; align-items: center; gap: 8px; padding: 11px 28px; background: #fff; border: 1px solid rgba(61,68,56,0.2); border-radius: 999px; font-size: 1.07rem; color: #3d4438; cursor: pointer; transition: all 0.2s; font-family: 'DM Sans', sans-serif; }
    .gw-like-btn:hover { border-color: #5d7a5c; color: #5d7a5c; }
    .gw-like-btn.liked { color: #c0434b; border-color: #c0434b; }
    .gw-views-chip { display: inline-flex; align-items: center; gap: 8px; padding: 11px 28px; background: #fff; border: 1px solid rgba(61,68,56,0.12); border-radius: 999px; font-size: 1.07rem; color: #6e7a6a; font-family: 'DM Sans', sans-serif; }
    /* SPEAKER */
    .gw-speaker-block { display: flex; gap: 24px; align-items: center; padding: 32px; background: #f4f4f2; border-radius: 4px; margin-top: 60px; }
    .gw-speaker-img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 2px solid #c8cfc6; }
    .gw-speaker-label { font-size: 0.88rem; letter-spacing: 0.15em; text-transform: uppercase; color: #5d7a5c; margin-bottom: 6px; font-family: 'DM Sans', sans-serif; }
    .gw-speaker-name { font-family: 'Cormorant Garamond', serif !important; font-size: 1.95rem; color: #3d4438; margin-bottom: 4px; }
    .gw-speaker-bio { font-size: 1.07rem; color: #6e7a6a; line-height: 1.7; font-family: 'DM Sans', sans-serif; }
    /* RESPONSIVE */
    @media (max-width: 768px) {
        .gw-hero { height: calc(100svh - 72px); margin-top: 72px; }
        .gw-hero-title-block { right: 5%; left: 5%; text-align: center; }
        .gw-card { padding: 36px 24px; }
        .gw-gallery-slide { flex: 0 0 80%; }
        .gw-schedule-grid { grid-template-columns: repeat(2, 1fr); }
        .gw-speaker-block { flex-direction: column; text-align: center; }
    }
    @media (max-width: 480px) { .gw-schedule-grid { grid-template-columns: 1fr; } }
    /* ANIMATIONS */
    .gw-fade-in { opacity: 0; transform: translateY(24px); transition: opacity 0.7s ease, transform 0.7s ease; }
    .gw-fade-in.visible { opacity: 1; transform: translateY(0); }
</style>
@endpush

@section('content')
<div class="gw-wrapper">
{{-- HERO --}}
<section class="gw-hero">
    @if($event->bannerImage && $event->bannerImage->url)
        <img class="gw-hero-img"
             src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}"
             alt="{{ $event->title }}">
    @else
        <div class="gw-hero-div"></div>
    @endif
    <div class="gw-hero-overlay"></div>
    <div class="gw-hero-title-block">
        <div class="gw-hero-eyebrow">
            @if($event->category){{ $event->category->name }}@else Sự kiện @endif
        </div>
        <div class="gw-hero-name">{{ $event->title }}</div>
    </div>
    <div class="gw-hero-meta">
        <div class="gw-hero-date">{{ $event->event_date->format('d/m/Y') }}</div>
        @if($event->location)
        <div class="gw-hero-location">{{ $event->location }}</div>
        @endif
    </div>
</section>

{{-- INFO CARD --}}
<section class="gw-section" id="gw-info" style="padding-top:100px;padding-bottom:60px;overflow:hidden;">
    <div class="gw-botanical" style="left:-40px;top:20px;width:280px;height:420px;">
        <svg viewBox="0 0 280 420" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M80 380 Q60 300 120 240 Q160 200 140 140 Q120 80 180 60" stroke="#3d4438" stroke-width="1.5" fill="none"/>
            <ellipse cx="120" cy="240" rx="38" ry="22" transform="rotate(-30 120 240)" stroke="#3d4438" stroke-width="1" fill="none"/>
            <ellipse cx="140" cy="180" rx="32" ry="18" transform="rotate(20 140 180)" stroke="#3d4438" stroke-width="1" fill="none"/>
            <ellipse cx="155" cy="130" rx="28" ry="16" transform="rotate(-15 155 130)" stroke="#3d4438" stroke-width="1" fill="none"/>
            <ellipse cx="105" cy="300" rx="36" ry="20" transform="rotate(40 105 300)" stroke="#3d4438" stroke-width="1" fill="none"/>
        </svg>
    </div>
    <div class="gw-botanical" style="right:-30px;bottom:10px;width:220px;height:320px;">
        <svg viewBox="0 0 220 320" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M140 300 Q160 220 100 160 Q60 120 80 60" stroke="#3d4438" stroke-width="1.5" fill="none"/>
            <ellipse cx="100" cy="160" rx="34" ry="20" transform="rotate(25 100 160)" stroke="#3d4438" stroke-width="1" fill="none"/>
            <ellipse cx="115" cy="110" rx="28" ry="16" transform="rotate(-20 115 110)" stroke="#3d4438" stroke-width="1" fill="none"/>
            <ellipse cx="130" cy="220" rx="32" ry="18" transform="rotate(35 130 220)" stroke="#3d4438" stroke-width="1" fill="none"/>
        </svg>
    </div>
    <div class="gw-container">
        <div class="gw-card gw-fade-in">
            <div class="gw-card-title">Thông tin sự kiện</div>
            <p class="gw-card-text">
                Chúng tôi rất vui được chia sẻ sự kiện đặc biệt này cùng bạn.<br>
                Kính mời bạn tham dự và đồng hành cùng chúng tôi.
            </p>
            <div class="gw-info-group">
                <div class="gw-info-label">Thời gian</div>
                <div class="gw-info-value">
                    {{ $event->event_date->format('l, d/m/Y') }}<br>
                    {{ $event->event_date->format('H:i') }}
                    @if($event->end_date)
                        @if($event->event_date->isSameDay($event->end_date))
                            - {{ $event->end_date->format('H:i') }}
                        @else
                            - {{ $event->end_date->format('H:i d/m/Y') }}
                        @endif
                    @endif
                </div>
            </div>
            @if($event->location)
            <div class="gw-info-group">
                <div class="gw-info-label">Địa điểm</div>
                <div class="gw-info-value">{{ $event->location }}</div>
            </div>
            @endif
            @if($event->category)
            <div class="gw-info-group">
                <div class="gw-info-label">Chủ đề</div>
                <div class="gw-info-value">{{ $event->category->name }}</div>
            </div>
            @endif
            @php
                $isArchived = ($event->status === 'archived') || ($event->event_date <= now());
            @endphp

            @if(!$isArchived)
            {{-- COUNTDOWN TIMER --}}
            <div style="margin-top:36px;">
                <div style="font-size:0.78rem;letter-spacing:0.25em;text-transform:uppercase;color:#6e7a6a;margin-bottom:14px;font-family:'DM Sans',sans-serif;">
                    Sự kiện bắt đầu sau
                </div>
                <div id="gw-countdown" style="display:flex;gap:12px;justify-content:center;align-items:flex-end;" data-target="{{ $event->event_date->toIso8601String() }}">
                    <div style="text-align:center;">
                        <div id="gw-cd-days" style="font-family:'Cormorant Garamond',serif;font-size:3rem;font-weight:600;color:#3d4438;line-height:1;">00</div>
                        <div style="font-size:0.7rem;letter-spacing:0.2em;text-transform:uppercase;color:#9aa09a;margin-top:4px;">Ngày</div>
                    </div>
                    <div style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;color:#5d7a5c;line-height:1;padding-bottom:0.3rem;">:</div>
                    <div style="text-align:center;">
                        <div id="gw-cd-hours" style="font-family:'Cormorant Garamond',serif;font-size:3rem;font-weight:600;color:#3d4438;line-height:1;">00</div>
                        <div style="font-size:0.7rem;letter-spacing:0.2em;text-transform:uppercase;color:#9aa09a;margin-top:4px;">Giờ</div>
                    </div>
                    <div style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;color:#5d7a5c;line-height:1;padding-bottom:0.3rem;">:</div>
                    <div style="text-align:center;">
                        <div id="gw-cd-mins" style="font-family:'Cormorant Garamond',serif;font-size:3rem;font-weight:600;color:#3d4438;line-height:1;">00</div>
                        <div style="font-size:0.7rem;letter-spacing:0.2em;text-transform:uppercase;color:#9aa09a;margin-top:4px;">Phút</div>
                    </div>
                    <div style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;color:#5d7a5c;line-height:1;padding-bottom:0.3rem;">:</div>
                    <div style="text-align:center;">
                        <div id="gw-cd-secs" style="font-family:'Cormorant Garamond',serif;font-size:3rem;font-weight:600;color:#5d7a5c;line-height:1;">00</div>
                        <div style="font-size:0.7rem;letter-spacing:0.2em;text-transform:uppercase;color:#9aa09a;margin-top:4px;">Giây</div>
                    </div>
                </div>
                <script>
                (function(){
                    var target = new Date(document.getElementById('gw-countdown').dataset.target).getTime();
                    function pad(n){ return n < 10 ? '0'+n : n; }
                    function tick(){
                        var now = Date.now();
                        var diff = target - now;
                        if(diff <= 0){
                            document.getElementById('gw-cd-days').textContent = '00';
                            document.getElementById('gw-cd-hours').textContent = '00';
                            document.getElementById('gw-cd-mins').textContent = '00';
                            document.getElementById('gw-cd-secs').textContent = '00';
                            return;
                        }
                        var d = Math.floor(diff / 86400000);
                        var h = Math.floor((diff % 86400000) / 3600000);
                        var m = Math.floor((diff % 3600000) / 60000);
                        var s = Math.floor((diff % 60000) / 1000);
                        document.getElementById('gw-cd-days').textContent = pad(d);
                        document.getElementById('gw-cd-hours').textContent = pad(h);
                        document.getElementById('gw-cd-mins').textContent = pad(m);
                        document.getElementById('gw-cd-secs').textContent = pad(s);
                    }
                    tick();
                    setInterval(tick, 1000);
                })();
                </script>
            </div>
            @else
            {{-- ARCHIVED / ENDED --}}
            <div style="margin-top:36px;display:flex;flex-direction:column;align-items:center;gap:10px;">
                <div style="display:inline-flex;align-items:center;gap:8px;padding:10px 24px;background:#f0f0ee;border:1px solid #c8ccc6;border-radius:2px;">
                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="#9aa09a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    <span style="font-size:0.88rem;color:#9aa09a;letter-spacing:0.15em;text-transform:uppercase;font-family:'DM Sans',sans-serif;">Sự kiện đã kết thúc</span>
                </div>
                <span style="font-size:0.82rem;color:#b8bcb8;font-family:'DM Sans',sans-serif;">Kết thúc ngày {{ $event->event_date->format('d/m/Y') }}</span>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- SCHEDULE --}}
@if($event->scheduleItems->count() > 0)
<section class="gw-section" id="gw-schedule" style="padding-top:40px;">
    <div class="gw-container">
        <div class="gw-fade-in">
            <h2 class="gw-section-title">Lịch trình sự kiện</h2>
            <p class="gw-section-subtitle">Chúng tôi rất vui được có mặt cùng bạn trong ngày đặc biệt này.</p>
            <div class="gw-divider"><div class="gw-divider-line"></div><span class="gw-divider-leaf">❧</span><div class="gw-divider-line"></div></div>
        </div>
        <div class="gw-schedule-grid">
            @foreach($event->scheduleItems as $i => $item)
            <div class="gw-schedule-item gw-fade-in text-center p-6 bg-[#f4f7f4] rounded-2xl">
                <div class="gw-schedule-time text-[1.4rem] font-bold text-[#5d7a5c] mb-2">{{ $item->start_time->format('H:i') }}@if($item->end_time) – {{ $item->end_time->format('H:i') }}@endif</div>
                <div class="gw-schedule-name text-[1.6rem] font-medium text-[#3d4438] mb-2">{{ $item->title }}</div>
                @if($item->description)
                <div class="gw-schedule-desc text-[#6e7a6a]">{{ $item->description }}</div>
                @elseif($item->speaker)
                <div class="gw-schedule-desc text-[#6e7a6a]">{{ $item->speaker->name }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- FULL WIDTH PHOTO --}}
@php $pb = $event->subBannerImage; @endphp
@if($pb && $pb->url)
<div><img src="{{ \App\Helpers\FileHelper::url($pb->url) }}" alt="{{ $event->title }}" class="gw-full-photo"></div>
@endif

{{-- STORY / DESCRIPTION --}}
@if(!empty($event->description))
<section class="gw-section" id="gw-story">
    <div class="gw-container-lg">
        <div class="gw-fade-in" style="margin-bottom: 60px; text-align: left; max-width: 45%;">
            <h2 class="gw-story-heading">Giới thiệu sự kiện</h2>
            <div class="gw-divider"><div class="gw-divider-line" style="flex: 0 1 60px;"></div><span class="gw-divider-leaf">❧</span><div class="gw-divider-line" style="flex: 1;"></div></div>
            @php
                $isJsonDesc = false;
                if(!empty($event->description)){
                    $dd = @json_decode($event->description, true);
                    if(json_last_error()===JSON_ERROR_NONE && is_array($dd)) $isJsonDesc=true;
                }
            @endphp
        </div>

                <div class="gw-scrolly-container">
            {{-- CỘT TRÁI: Tất cả text blocks xếp dọc --}}
            <div class="gw-scrolly-text-col">
                {{-- Block 0: Mô tả chính --}}
                @if(!$isJsonDesc && !empty(trim(strip_tags($event->description))))
                <div class="gw-text-block" data-media-index="0">
                    <div class="gw-story-body">{!! nl2br(e($event->description)) !!}</div>
                </div>
                @endif

                {{-- Block 1..N: Từ galleryImages --}}
                @php 
                    $skipCount = 0;
                    $remainingBlocks = $event->galleryImages->skip($skipCount)->take(5); 
                @endphp
                @foreach($remainingBlocks as $i => $block)
                @if(!empty($block->content) || $block->url)
                <div class="gw-text-block gw-fade-in" data-media-index="{{ $i + 1 }}">
                    @if(!empty($block->content))
                    @php $isJ=false; $cd=@json_decode($block->content,true); if(json_last_error()===JSON_ERROR_NONE && is_array($cd))$isJ=true; @endphp
                    @if(!$isJ)<div class="gw-story-body gw-scrollable-text" style="margin-bottom:24px;">{!! $block->content !!}</div>@endif
                    @endif

                    @if($block->action_url)
                    <div style="margin-top:16px;">
                        <a href="{{ $block->action_url }}" target="_blank" class="gw-btn">
                            {{ $block->action_label ?? 'Truy cập liên kết' }}
                        </a>
                    </div>
                    @endif
                </div>
                @endif
                @endforeach
            </div>

            {{-- CỘT PHẢI: Khung ảnh sticky --}}
            <div class="gw-scrolly-media-col">
                <div class="gw-scrolly-media-stack">
                    {{-- Ảnh 0: Ảnh đầu tiên cho mô tả chính --}}
                    @if(!$isJsonDesc && !empty(trim(strip_tags($event->description))))
                    @php $firstImg = $event->galleryImages->where('type','image')->first(); @endphp
                    @if($firstImg && $firstImg->url)
                    <img data-media-index="0" class="gw-scrolly-img active" src="{{ \App\Helpers\FileHelper::url($firstImg->url) }}" loading="lazy">
                    @else
                    <div data-media-index="0" class="gw-scrolly-img active" style="background: linear-gradient(135deg, #c8cfc6, #a8b5a6);"></div>
                    @endif
                    @endif

                    {{-- Ảnh 1..N: Từ galleryImages --}}
                    @foreach($remainingBlocks as $i => $block)
                    @if($block->url)
                        @if($block->type==='video')
                        <video data-media-index="{{ $i + 1 }}" class="gw-scrolly-img" src="{{ \App\Helpers\FileHelper::url($block->url) }}" autoplay loop muted playsinline></video>
                        @else
                        <img data-media-index="{{ $i + 1 }}" class="gw-scrolly-img" src="{{ \App\Helpers\FileHelper::url($block->url) }}" alt="{{ $block->caption ?? '' }}" loading="lazy">
                        @endif
                    @else
                        <div data-media-index="{{ $i + 1 }}" class="gw-scrolly-img" style="background: linear-gradient(135deg, #c8cfc6, #a8b5a6);"></div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @php
            $t2_speakers = $event->speakers()->wherePivot('role', 'speaker')->get();
        @endphp

        @if($t2_speakers->count() > 0)
        <div class="gw-fade-in" style="margin-top:40px;">
            <div style="font-size:0.78rem;letter-spacing:0.25em;text-transform:uppercase;color:#6e7a6a;margin-bottom:20px;font-family:'DM Sans',sans-serif;text-align:center;">Diễn giả tham gia</div>
            <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:24px;">
                @foreach($t2_speakers as $speaker)
                <div class="gw-speaker-block" style="margin-top:0;display:flex;align-items:center;gap:20px;padding:24px;background:#fff;border:1px solid rgba(61,68,56,0.1);border-radius:4px;width:100%;max-width:350px;">
                    <img src="{{ $speaker->photo_url ? asset($speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80' }}"
                         alt="{{ $speaker->name }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;flex-shrink:0;">
                    <div>
                        <div style="font-size:1.15rem;font-weight:600;color:#3d4438;margin-bottom:4px;">{{ $speaker->name }}</div>
                        @if($speaker->title)<div style="font-size:0.9rem;color:#5d7a5c;font-family:'DM Sans',sans-serif;">{{ $speaker->title }}</div>@endif
                        @if($speaker->bio)<div style="font-size:0.85rem;color:#9aa09a;margin-top:6px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $speaker->bio }}</div>@endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif


    </div>
</section>
@endif

{{-- GALLERY (RECAP ALBUM) --}}
@php
    $recapMedia = $event->media()->where('is_recap', true)->where('type', 'image')->get();
@endphp
@if($recapMedia->count() > 0)
<section class="gw-gallery-section" id="gw-gallery">
    <div style="padding:0 32px 20px;max-width:860px;margin:0 auto;">
        <h2 class="gw-section-title gw-fade-in">Album Sự kiện</h2>
    </div>
    <div style="overflow:hidden;">
        <div class="gw-gallery-track" id="gw-gallery-track">
            @foreach($recapMedia as $img)
            <div class="gw-gallery-slide">
                <img src="{{ \App\Helpers\FileHelper::url($img->url) }}" alt="{{ $img->caption ?? $event->title }}">
            </div>
            @endforeach
        </div>
    </div>
    <div class="gw-gallery-controls">
        <button class="gw-gallery-btn" id="gw-prev">&#8592;</button>
        <button class="gw-gallery-btn" id="gw-next">&#8594;</button>
    </div>
</section>
@endif

{{-- REACTIONS --}}
<section class="gw-section" style="padding:48px 24px;" id="gw-reactions">
    <div class="gw-reactions" style="flex-wrap: wrap;" x-data="{ copied: false }">
        <button id="like-btn" data-event-id="{{ $event->id }}"
                class="gw-like-btn {{ session()->has('liked_events.' . $event->id) ? 'liked' : '' }}">
            <span class="material-symbols-outlined" style="font-size:23px;">favorite</span>
            <span id="likes-count">{{ $event->likes_count }}</span> Yêu thích
        </button>
        <div class="gw-views-chip">
            <span class="material-symbols-outlined" style="font-size:23px;">visibility</span>
            <span>{{ $event->views_count }}</span> Lượt xem
        </div>
        
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" 
           class="gw-btn" style="background:#1877F2; display:flex; align-items:center; gap:8px;">
           <svg class="w-4 h-4 fill-current" style="width:16px;height:16px;" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
           Chia sẻ
        </a>
        <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)" 
                class="gw-btn" style="background:#eaecf0; color:#3d4438 !important; border:1px solid #c8cfc6; display:flex; align-items:center; gap:8px; position:relative;">
            <svg class="w-4 h-4" style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            Copy Link
            <span x-show="copied" x-transition style="display:none; position:absolute; top:-40px; left:50%; transform:translateX(-50%); background:#3d4438; color:#fff; font-size:12px; padding:4px 8px; border-radius:4px; white-space:nowrap; text-transform:none; letter-spacing:normal; box-shadow:0 4px 12px rgba(0,0,0,0.1);">Đã sao chép!</span>
        </button>
    </div>
    @if(isset($previousEvent) || isset($nextEvent))
    <div style="max-width:860px;margin:48px auto 0;display:grid;grid-template-columns:1fr 1fr;gap:24px;">
        <div>
            @if(isset($previousEvent) && $previousEvent)
            <a href="{{ route('events.show', $previousEvent->slug) }}" style="display:block;color:#3d4438;text-decoration:none;">
                <span style="display:block;margin-bottom:8px;color:#9aa09a;font-size:0.88rem;text-transform:uppercase;letter-spacing:0.1em;">← Sự kiện trước</span>
                <strong style="font-family:'Cormorant Garamond',serif;font-size:1.43rem;font-weight:400;">{{ $previousEvent->title }}</strong>
            </a>
            @endif
        </div>
        <div style="text-align:right;">
            @if(isset($nextEvent) && $nextEvent)
            <a href="{{ route('events.show', $nextEvent->slug) }}" style="display:block;color:#3d4438;text-decoration:none;">
                <span style="display:block;margin-bottom:8px;color:#9aa09a;font-size:0.88rem;text-transform:uppercase;letter-spacing:0.1em;">Sự kiện tiếp →</span>
                <strong style="font-family:'Cormorant Garamond',serif;font-size:1.43rem;font-weight:400;">{{ $nextEvent->title }}</strong>
            </a>
            @endif
        </div>
    </div>
    @endif
</section>
@include('components.event-fab-menu', ['event' => $event])
</div>
@endsection

@push('scripts')
<script>

(function(){
    // Gallery slider
    var track=document.getElementById('gw-gallery-track'),prev=document.getElementById('gw-prev'),next=document.getElementById('gw-next');
    if(track&&prev&&next){
        var ci=0,slides=track.querySelectorAll('.gw-gallery-slide'),total=slides.length,vc=window.innerWidth<=768?1:3;
        function goTo(i){ var max=Math.max(0,total-vc); ci=Math.max(0,Math.min(i,max)); track.style.transform='translateX(-'+(ci*(100/vc))+'%)'; }
        prev.addEventListener('click',function(){ goTo(ci-1); });
        next.addEventListener('click',function(){ goTo(ci+1); });
    }
    // Fade-in
    var fades=document.querySelectorAll('.gw-fade-in');
    var obs=new IntersectionObserver(function(entries){
        entries.forEach(function(e){ if(e.isIntersecting){ e.target.classList.add('visible'); obs.unobserve(e.target); } });
    },{threshold:0.1});
    fades.forEach(function(el){ obs.observe(el); });
    // Like button
    var lb=document.getElementById('like-btn');
    if(lb){ lb.addEventListener('click',function(){
        var eid=this.dataset.eventId,cs=document.getElementById('likes-count');
        fetch('/events/'+eid+'/like',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').getAttribute('content')}})
        .then(function(r){ return r.json(); }).then(function(d){ if(d.success){ cs.innerText=d.likes_count; lb.classList.add('liked'); } }).catch(console.error);
    }); }
    // Scrollytelling
    var storySection = document.getElementById('gw-story');
    var scrollyContainer = storySection ? storySection.querySelector('.gw-scrolly-container') : null;
    var textBlocks = document.querySelectorAll('.gw-text-block');
    var mediaCol = document.querySelector('.gw-scrolly-media-col');
    var mediaItems = document.querySelectorAll('.gw-scrolly-img');
    
    if (window.innerWidth >= 769 && textBlocks.length > 0 && storySection && mediaCol && scrollyContainer) {
        var offsetTop = 100; // distance from viewport top when fixed
        
        // Save the media column's initial top position relative to the document
        var mediaColInitialTop = mediaCol.getBoundingClientRect().top + window.pageYOffset;
        
        // Calculate when to stop fixing (bottom of scrolly container minus media height)
        function getStopPoint() {
            var containerRect = scrollyContainer.getBoundingClientRect();
            var containerBottom = containerRect.bottom + window.pageYOffset;
            var mediaHeight = mediaCol.offsetHeight;
            return containerBottom - mediaHeight - offsetTop;
        }
        
        window.addEventListener('scroll', function() {
            var scrollY = window.pageYOffset;
            var stopPoint = getStopPoint();
            var windowHeight = window.innerHeight;
            
            // Point where media col's top would naturally reach the fixed offset
            var fixStart = mediaColInitialTop - offsetTop;
            
            if (scrollY >= fixStart && scrollY < stopPoint) {
                // Media column has reached the top — fix it
                mediaCol.classList.add('is-fixed');
                mediaCol.classList.remove('is-bottom');
                // Maintain correct width and horizontal position
                var parentRect = scrollyContainer.getBoundingClientRect();
                mediaCol.style.width = (parentRect.width * 0.5) + 'px';
                mediaCol.style.right = (window.innerWidth - parentRect.right) + 'px';
            } else if (scrollY >= stopPoint) {
                // Scrolled past — park at bottom of container
                mediaCol.classList.remove('is-fixed');
                mediaCol.classList.add('is-bottom');
                mediaCol.style.width = '50%';
                mediaCol.style.right = '0';
            } else {
                // Haven't reached the section yet — natural flow
                mediaCol.classList.remove('is-fixed');
                mediaCol.classList.remove('is-bottom');
                mediaCol.style.width = '50%';
                mediaCol.style.right = 'auto';
            }
            
            // Fade Effect: which text block is currently in focus
            var focusIndex = '0';
            textBlocks.forEach(function(block) {
                var blockRect = block.getBoundingClientRect();
                if (blockRect.top < windowHeight * 0.5) {
                    focusIndex = block.getAttribute('data-media-index');
                }
            });
            
            mediaItems.forEach(function(item) {
                if (item.getAttribute('data-media-index') === focusIndex) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        });
        
        // Trigger once on load
        window.dispatchEvent(new Event('scroll'));
    }
})();

</script>
@endpush
