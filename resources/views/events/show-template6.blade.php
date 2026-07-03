@extends('layouts.frontend')

{{--
  ================================================================
  MẪU 6 — TRƯỜNG HỌC / SỰ KIỆN HỌC THUẬT (School / Academic Event)
  ----------------------------------------------------------------
  - Phù hợp cho sự kiện trường: Hội thảo, Lễ Tốt Nghiệp, Khai Giảng.
  - Màu sắc: Xanh Navy, Vàng Gold, Trắng (chuyên nghiệp, học thuật).
  - Bố cục: Hiện đại, các khối thẻ nổi (card), mảng màu rõ ràng.
  ================================================================
--}}

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer { display: none !important; }

:root {
    --school-bg: #F8FAFC;
    --school-primary: #1E3A8A; /* Navy Blue */
    --school-secondary: #3B82F6; /* Bright Blue */
    --school-accent: #F59E0B; /* Gold/Amber */
    --school-text: #1E293B;
    --school-muted: #64748B;
    --school-card: #FFFFFF;
    --school-border: #E2E8F0;
    
    --container-w: 800px;
}

body { background-color: #f1f5f9; }

.w6-body {
    background: var(--school-bg);
    color: var(--school-text);
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    line-height: 1.6;
    min-height: 100vh;
}

/* CONTAINER */
.w6-container {
    max-width: var(--container-w);
    margin: 0 auto;
    background: var(--school-card);
    min-height: 100vh;
    box-shadow: 0 0 40px rgba(0,0,0,0.05);
    padding-bottom: 60px;
}

/* HERO SECTION */
.w6-hero {
    position: relative;
    width: 100%;
    background: var(--school-primary);
    overflow: hidden;
}
.w6-hero-bg {
    width: 100%;
    height: 400px;
    object-fit: cover;
    opacity: 0.8;
}
.w6-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, var(--school-primary) 0%, rgba(30,58,138,0.4) 100%);
}
.w6-hero-content {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 40px 30px;
    text-align: center;
    color: #fff;
    z-index: 10;
}
.w6-hero-badge {
    display: inline-block;
    background: var(--school-accent);
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 20px;
    margin-bottom: 16px;
    letter-spacing: 1px;
}
.w6-hero h1 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: clamp(28px, 5vw, 42px);
    line-height: 1.2;
    margin-bottom: 16px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.w6-hero-meta {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    font-size: 14px;
    font-weight: 500;
    color: #e2e8f0;
}
.w6-hero-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
}
.w6-hero-meta-item svg { width: 18px; height: 18px; color: var(--school-accent); }

/* COUNTDOWN */
.w6-cd-bar {
    background: var(--school-secondary);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
    padding: 20px;
}
.w6-cd-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.w6-cd-units { display: flex; gap: 15px; }
.w6-cd-unit { text-align: center; }
.w6-cd-num {
    display: block;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 24px;
    background: rgba(255,255,255,0.2);
    border-radius: 8px;
    padding: 5px 12px;
    min-width: 50px;
}
.w6-cd-label { font-size: 11px; text-transform: uppercase; margin-top: 4px; opacity: 0.9; }

/* CONTENT BLOCKS */
.w6-content-wrap {
    padding: 40px 30px;
}
.w6-section-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 24px;
    color: var(--school-primary);
    text-align: center;
    margin-bottom: 30px;
    position: relative;
    text-transform: uppercase;
}
.w6-section-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background: var(--school-accent);
    margin: 12px auto 0;
    border-radius: 2px;
}
.w6-desc {
    color: var(--school-muted);
    text-align: justify;
    margin-bottom: 40px;
    font-size: 16px;
}

/* GALLERY (CARDS) */
.w6-gallery {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-bottom: 50px;
}
.w6-gal-card {
    background: #fff;
    border: 1px solid var(--school-border);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}
.w6-gal-media { width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block; }
.w6-gal-body { padding: 20px; }
.w6-gal-caption {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 18px;
    color: var(--school-text);
    margin-bottom: 8px;
}
.w6-gal-text { font-size: 14px; color: var(--school-muted); margin-bottom: 15px; }

/* SPEAKERS */
.w6-speakers {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
    margin-bottom: 50px;
}
.w6-speaker-card {
    text-align: center;
    padding: 20px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid var(--school-border);
    transition: transform 0.2s;
}
.w6-speaker-card:hover { transform: translateY(-5px); }
.w6-speaker-img {
    width: 100px; height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--school-secondary);
    margin: 0 auto 15px;
    padding: 3px;
    background: #fff;
}
.w6-speaker-name {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 16px;
    color: var(--school-primary);
}
.w6-speaker-role { font-size: 13px; color: var(--school-muted); margin-top: 4px; }

/* SCHEDULE */
.w6-schedule { margin-bottom: 50px; }
.w6-sch-item {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    background: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    border-left: 4px solid var(--school-accent);
    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}
.w6-sch-time {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    color: var(--school-primary);
    min-width: 60px;
    flex-shrink: 0;
}
.w6-sch-info h4 { font-weight: 600; font-size: 16px; margin: 0 0 4px; }
.w6-sch-info p { font-size: 13px; color: var(--school-muted); margin: 0; }

/* BOTTOM BAR */
.w6-bottom {
    display: flex;
    justify-content: center;
    gap: 15px;
    padding-top: 20px;
    border-top: 1px solid var(--school-border);
}
.w6-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    border-radius: 30px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
}
.w6-btn-like {
    background: #fff;
    color: var(--school-primary);
    border: 1px solid var(--school-primary);
}
.w6-btn-like.liked {
    background: var(--school-primary);
    color: #fff;
}
.w6-btn-views {
    background: #f1f5f9;
    color: var(--school-muted);
}
.w6-footer {
    text-align: center;
    padding: 20px;
    font-size: 13px;
    color: var(--school-muted);
    background: #e2e8f0;
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
<div class="w6-body">
    <div class="w6-container">
        
        {{-- HERO --}}
        <div class="w6-hero">
            @if($event->bannerImage)
                <img src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}" class="w6-hero-bg" alt="{{ $event->title }}">
            @else
                <div class="w6-hero-bg" style="background:#1E3A8A;"></div>
            @endif
            <div class="w6-hero-overlay"></div>
            <div class="w6-hero-content">
                <div class="w6-hero-badge">{{ $event->category ? $event->category->name : 'Sự kiện trường' }}</div>
                <h1 style="{!! $titleStyleStr !!}">{!! nl2br(e($event->title)) !!}</h1>
                <div class="w6-hero-meta">
                    <div class="w6-hero-meta-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        {{ $event->event_date->format('d/m/Y') }}
                    </div>
                    <div class="w6-hero-meta-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        {{ $event->event_date->format('H:i') }}
                    </div>
                    @if($event->location)
                    <div class="w6-hero-meta-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $event->location }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- COUNTDOWN --}}
        <div class="w6-cd-bar">
            <div class="w6-cd-title">Sự kiện sẽ bắt đầu sau</div>
            <div class="w6-cd-units">
                <div class="w6-cd-unit"><span class="w6-cd-num" id="w6-days">00</span><div class="w6-cd-label">Ngày</div></div>
                <div class="w6-cd-unit"><span class="w6-cd-num" id="w6-hours">00</span><div class="w6-cd-label">Giờ</div></div>
                <div class="w6-cd-unit"><span class="w6-cd-num" id="w6-mins">00</span><div class="w6-cd-label">Phút</div></div>
            </div>
        </div>

        <div class="w6-content-wrap">
            {{-- DESCRIPTION --}}
            <h2 class="w6-section-title">Giới Thiệu</h2>
            <div class="w6-desc" style="{!! $descStyleStr !!}">
                {!! $event->description !!}
            </div>

            {{-- GALLERY --}}
            @if($event->galleryImages->count() > 0)
            <h2 class="w6-section-title">Khoảnh Khắc Nổi Bật</h2>
            <div class="w6-gallery">
                @foreach($event->galleryImages as $block)
                <div class="w6-gal-card">
                    @if($block->url)
                        @if($block->type === 'video')
                            <video src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="w6-gal-media" autoplay loop muted playsinline controls></video>
                        @else
                            <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="w6-gal-media" alt="">
                        @endif
                    @endif
                    <div class="w6-gal-body">
                        @if($block->caption) <h3 class="w6-gal-caption">{{ $block->caption }}</h3> @endif
                        @if(!empty($block->content)) <div class="w6-gal-text">{!! $block->content !!}</div> @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- SPEAKERS --}}
            @if($event->speakers->count() > 0)
            <h2 class="w6-section-title">Khách Mời & Diễn Giả</h2>
            <div class="w6-speakers">
                @foreach($event->speakers as $speaker)
                <div class="w6-speaker-card">
                    @if($speaker->photo_url)
                        <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" class="w6-speaker-img" alt="{{ $speaker->name }}">
                    @endif
                    <div class="w6-speaker-name">{{ $speaker->name }}</div>
                    <div class="w6-speaker-role">{{ $speaker->title }}</div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- SCHEDULE --}}
            @if($event->scheduleItems->count() > 0)
            <h2 class="w6-section-title">Lịch Trình</h2>
            <div class="w6-schedule">
                @foreach($event->scheduleItems as $item)
                <div class="w6-sch-item">
                    <div class="w6-sch-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}</div>
                    <div class="w6-sch-info">
                        <h4>{{ $item->title }}</h4>
                        @if($item->speaker) <p>Cùng {{ $item->speaker->name }}</p> @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- BOTTOM ACTIONS --}}
            <div class="w6-bottom">
                <button id="like-btn" data-event-id="{{ $event->id }}" class="w6-btn w6-btn-like {{ session()->has('liked_events.' . $event->id) ? 'liked' : '' }}">
                    <span class="material-symbols-outlined">favorite</span>
                    <span id="likes-count">{{ $event->likes_count }}</span> Thích
                </button>
                <div class="w6-btn w6-btn-views">
                    <span class="material-symbols-outlined">visibility</span>
                    {{ $event->views_count }} Lượt xem
                </div>
            </div>
        </div>
        
    </div>
    
    <footer class="w6-footer">
        © 2026 UniEvent — Hệ thống quản lý sự kiện học đường
    </footer>
</div>

<script>
    const targetDate = new Date("{{ $event->event_date->toIso8601String() }}").getTime();
    function updateCountdown() {
        const now = new Date().getTime();
        const diff = targetDate - now;
        if (diff < 0) {
            document.getElementById('w6-days').innerText = "00";
            document.getElementById('w6-hours').innerText = "00";
            document.getElementById('w6-mins').innerText = "00";
            return;
        }
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        document.getElementById('w6-days').innerText = String(days).padStart(2, '0');
        document.getElementById('w6-hours').innerText = String(hours).padStart(2, '0');
        document.getElementById('w6-mins').innerText = String(mins).padStart(2, '0');
    }
    setInterval(updateCountdown, 1000);
    updateCountdown();

    const likeBtn = document.getElementById('like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            const eventId = this.dataset.eventId;
            const countSpan = document.getElementById('likes-count');
            fetch(`/events/${eventId}/like`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    countSpan.innerText = data.likes_count;
                    likeBtn.classList.add('liked');
                }
            })
            .catch(err => console.error(err));
        });
    }
</script>
@endsection
