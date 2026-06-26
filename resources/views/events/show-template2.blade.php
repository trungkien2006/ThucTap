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
    
    /* STORY SPLIT SCROLL */
    .gw-story-row { display: flex; flex-direction: column; gap: 32px; margin-bottom: 60px; }
    .gw-story-left { width: 100%; }
    .gw-story-right { width: 100%; }
    .gw-sticky-media { width: 100%; border-radius: 4px; object-fit: cover; }
    
    @media (min-width: 769px) {
        .gw-story-row {
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 0; /* Remove margin so images touch or leave a small gap */
            padding-bottom: 80px; /* Gap between rows */
        }
        .gw-story-left {
            width: 45%;
            padding: 15vh 0; /* Creates scrollable height for the sticky effect */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .gw-story-right {
            width: 45%;
            position: relative;
        }
        .gw-sticky-wrapper {
            position: sticky;
            top: 120px; /* Sticks under the header */
        }
        .gw-sticky-media {
            height: calc(100vh - 160px);
            max-height: 640px;
            aspect-ratio: 4/5;
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
            @if($event->event_date > now())
            <div style="margin-top:36px;">
                <a href="#gw-reactions" class="gw-btn">Tham gia ngay</a>
            </div>
            @else
            <div style="margin-top:36px;">
                <span style="font-size:1.07rem;color:#9aa09a;letter-spacing:0.1em;text-transform:uppercase;">Sự kiện đã kết thúc</span>
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
            @php $gm = $event->galleryImages->get($i); @endphp
            <div class="gw-schedule-item gw-fade-in">
                @if($gm && $gm->url)
                    @if($gm->type === 'video')
                        <video src="{{ \App\Helpers\FileHelper::url($gm->url) }}" class="gw-schedule-img" autoplay loop muted playsinline></video>
                    @else
                        <img src="{{ \App\Helpers\FileHelper::url($gm->url) }}" alt="{{ $item->title }}" class="gw-schedule-img">
                    @endif
                @else
                    <div class="gw-schedule-img-ph"></div>
                @endif
                <div class="gw-schedule-name">{{ $item->title }}</div>
                <div class="gw-schedule-time">{{ $item->start_time->format('H:i') }}@if($item->end_time) – {{ $item->end_time->format('H:i') }}@endif</div>
                @if($item->description)
                <div class="gw-schedule-desc">{{ $item->description }}</div>
                @elseif($item->speaker)
                <div class="gw-schedule-desc">{{ $item->speaker->name }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- FULL WIDTH PHOTO --}}
@if($event->galleryImages->where('type','image')->count() > 0)
@php $pb = $event->galleryImages->where('type','image')->first(); @endphp
@if($pb && $pb->url)
<div><img src="{{ \App\Helpers\FileHelper::url($pb->url) }}" alt="{{ $event->title }}" class="gw-full-photo"></div>
@endif
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

        <div class="gw-story-split">
            {{-- Main Description Row --}}
            @if(!$isJsonDesc && !empty(trim(strip_tags($event->description))))
            <div class="gw-story-row gw-fade-in">
                <div class="gw-story-left" style="padding-top: 0;">
                    <div class="gw-story-body">{!! nl2br(e($event->description)) !!}</div>
                </div>
                <div class="gw-story-right">
                    @php $firstImg = $event->galleryImages->where('type','image')->first(); @endphp
                    @if($firstImg && $firstImg->url)
                    <div class="gw-sticky-wrapper">
                        <img src="{{ \App\Helpers\FileHelper::url($firstImg->url) }}" class="gw-sticky-media" loading="lazy">
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Remaining blocks --}}
            @php 
                $skipCount = ($firstImg && $firstImg->url) ? 1 : 0;
                $remainingBlocks = $event->galleryImages->skip($skipCount)->take(5); 
            @endphp
            @foreach($remainingBlocks as $block)
            @if(!empty($block->content) || $block->url)
            <div class="gw-story-row gw-fade-in">
                <div class="gw-story-left">
                    @if(!empty($block->content))
                    @php $isJ=false; $cd=@json_decode($block->content,true); if(json_last_error()===JSON_ERROR_NONE && is_array($cd))$isJ=true; @endphp
                    @if(!$isJ)<div class="gw-story-body" style="margin-bottom:24px;">{!! $block->content !!}</div>@endif
                    @endif

                    @if($block->document_url)
                    <div style="margin-top:16px;">
                        <a href="{{ \App\Helpers\FileHelper::url($block->document_url) }}" target="_blank"
                           style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#f4f4f2;border:1px solid rgba(61,68,56,0.2);border-radius:2px;font-size:1.04rem;color:#5d7a5c;text-decoration:none;">
                            <span class="material-symbols-outlined" style="font-size:21px;">download</span>
                            {{ $block->document_name ?? basename($block->document_url) }}
                        </a>
                    </div>
                    @endif
                    @if($block->action_url)
                    <div style="margin-top:16px;">
                        <a href="{{ $block->action_url }}" target="_blank" class="gw-btn">
                            {{ $block->action_label ?? 'Truy cập liên kết' }}
                        </a>
                    </div>
                    @endif
                </div>
                
                <div class="gw-story-right">
                    @if($block->url)
                    <div class="gw-sticky-wrapper">
                        @if($block->type==='video')
                        <video src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="gw-sticky-media" autoplay loop muted playsinline controls></video>
                        @else
                        <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" alt="{{ $block->caption ?? '' }}" class="gw-sticky-media" loading="lazy">
                        @endif
                        @if($block->caption)<p style="margin-top:10px;font-size:1.01rem;color:#9aa09a;font-style:italic;">{{ $block->caption }}</p>@endif
                    </div>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @if($event->speakers->count() > 0)
        @php $speaker = $event->speakers->first(); @endphp
        <div class="gw-speaker-block gw-fade-in">
            <img src="{{ $speaker->photo_url ? asset($speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80' }}"
                 alt="{{ $speaker->name }}" class="gw-speaker-img">
            <div>
                <div class="gw-speaker-label">Diễn giả chính</div>
                <div class="gw-speaker-name">{{ $speaker->name }}</div>
                @if($speaker->bio)<div class="gw-speaker-bio">{{ Str::limit($speaker->bio, 150) }}</div>@endif
            </div>
        </div>
        @endif
    </div>
</section>
@endif

{{-- GALLERY --}}
@if($event->galleryImages->where('type','image')->count() > 1)
<section class="gw-gallery-section" id="gw-gallery">
    <div style="padding:0 32px 20px;max-width:860px;margin:0 auto;">
        <h2 class="gw-section-title gw-fade-in">Thư viện ảnh</h2>
    </div>
    <div style="overflow:hidden;">
        <div class="gw-gallery-track" id="gw-gallery-track">
            @foreach($event->galleryImages->where('type','image') as $img)
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
    <div class="gw-reactions">
        <button id="like-btn" data-event-id="{{ $event->id }}"
                class="gw-like-btn {{ session()->has('liked_events.' . $event->id) ? 'liked' : '' }}">
            <span class="material-symbols-outlined" style="font-size:23px;">favorite</span>
            <span id="likes-count">{{ $event->likes_count }}</span> Yêu thích
        </button>
        <div class="gw-views-chip">
            <span class="material-symbols-outlined" style="font-size:23px;">visibility</span>
            <span>{{ $event->views_count }}</span> Lượt xem
        </div>
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
    /* PARALLAX HERO - REMOVED */
})();

</script>
@endpush
