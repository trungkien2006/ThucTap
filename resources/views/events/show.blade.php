@extends('layouts.frontend')

@section('content')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .tp1-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; color: #0f172a; line-height: 1.6; }
    .tp1-hero { height: 60vh; min-height: 400px; position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-top: 72px; }
    .tp1-hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    .tp1-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15,23,42,0.2), rgba(15,23,42,0.8)); }
    .tp1-hero-content { position: relative; z-index: 10; text-align: center; color: white; padding: 0 20px; max-width: 800px; }
    .tp1-badge { background: #f97316; color: white; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 16px; display: inline-block; }
    .tp1-title { font-size: 48px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .tp1-meta { display: flex; gap: 24px; justify-content: center; font-size: 15px; opacity: 0.9; }
    .tp1-meta-item { display: flex; align-items: center; gap: 8px; }
    
    .tp1-container { max-width: 1140px; margin: 0 auto; padding: 60px 20px; }
    .tp1-card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-bottom: 40px; }
    .tp1-section-title { font-size: 24px; font-weight: 700; color: #0f172a; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; }
    .tp1-section-title::before { content: ''; display: block; width: 4px; height: 24px; background: #f97316; border-radius: 4px; }
    
    .tp1-text { font-size: 16px; color: #475569; margin-bottom: 20px; }
    .tp1-grid { display: grid; gap: 64px; align-items: center; }
    .tp1-grid.left-img { grid-template-columns: 1.8fr 1fr; }
    .tp1-grid.right-img { grid-template-columns: 1fr 1.8fr; }
    .tp1-img { width: 100%; border-radius: 12px; object-fit: cover; aspect-ratio: 4/3; }

    /* For Markdown and rich content */
    .tp1-text img { max-width: 100%; border-radius: 12px; margin: 16px 0; }
    .tp1-text a { color: #f97316; text-decoration: underline; }
    
    @media (max-width: 768px) {
        .tp1-grid.left-img, .tp1-grid.right-img { grid-template-columns: 1fr; gap: 24px; }
        .tp1-title { font-size: 32px; }
        .tp1-meta { flex-direction: column; gap: 12px; }
    }
</style>
@endpush

<div class="tp1-wrapper">
    <!-- Hero Section -->
    <div class="tp1-hero">
        @if($event->bannerImage)
            <img src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}" class="tp1-hero-img" alt="{{ $event->title }}">
        @else
            <div class="tp1-hero-img" style="background:#0f172a;"></div>
        @endif
        <div class="tp1-hero-overlay"></div>
        <div class="tp1-hero-content">
            @if($event->category)
            <span class="tp1-badge">{{ $event->category->name }}</span>
            @endif
            <h1 class="tp1-title">{{ $event->title }}</h1>
            <div class="tp1-meta">
                <div class="tp1-meta-item">
                    <span class="material-symbols-outlined">calendar_today</span> 
                    {{ $event->event_date->format('d/m/Y H:i') }}
                    @if($event->end_date)
                        @if($event->event_date->isSameDay($event->end_date))
                            - {{ $event->end_date->format('H:i') }}
                        @else
                            - {{ $event->end_date->format('d/m/Y H:i') }}
                        @endif
                    @endif
                </div>
                @if($event->location)
                <div class="tp1-meta-item"><span class="material-symbols-outlined">location_on</span> {{ $event->location }}</div>
                @endif
            </div>

            <!-- Countdown Timer -->
            @if($event->event_date > now())
            <div class="flex justify-center gap-4 mt-8" id="countdown-wrapper" data-date="{{ $event->event_date->format('Y-m-d\TH:i:s') }}">
                <div class="bg-white/20 backdrop-blur-md rounded-xl p-3 min-w-[80px]">
                    <div class="text-3xl font-bold text-white" id="days">00</div>
                    <div class="text-[10px] font-bold text-white/80 uppercase">Ngày</div>
                </div>
                <div class="bg-white/20 backdrop-blur-md rounded-xl p-3 min-w-[80px]">
                    <div class="text-3xl font-bold text-white" id="hours">00</div>
                    <div class="text-[10px] font-bold text-white/80 uppercase">Giờ</div>
                </div>
                <div class="bg-white/20 backdrop-blur-md rounded-xl p-3 min-w-[80px]">
                    <div class="text-3xl font-bold text-white" id="minutes">00</div>
                    <div class="text-[10px] font-bold text-white/80 uppercase">Phút</div>
                </div>
                <div class="bg-white/20 backdrop-blur-md rounded-xl p-3 min-w-[80px]">
                    <div class="text-3xl font-bold text-white" id="seconds">00</div>
                    <div class="text-[10px] font-bold text-white/80 uppercase">Giây</div>
                </div>
            </div>
            @endif

        </div>
    </div>
    </div>
    
    <div class="tp1-container">
            <!-- Giới thiệu sự kiện -->
            @if(!empty($event->description))
            <div class="tp1-card">
                <h2 class="tp1-section-title">Giới thiệu sự kiện</h2>
                <div class="tp1-text text-left">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>
            @endif

        <!-- Nội dung chính (Gallery Blocks) -->
        @if(count($event->galleryImages) > 0)
        <div class="tp1-card">
            <h2 class="tp1-section-title">Nội dung chi tiết</h2>
            @foreach($event->galleryImages as $index => $block)
            <div class="tp1-grid {{ $index % 2 == 0 ? 'left-img' : 'right-img' }}" style="{{ $index > 0 ? 'margin-top: 64px;' : '' }}">
                @if($index % 2 == 0)
                    <div>
                        @if($block->url)
                            @if($block->type === 'video')
                                <video src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="tp1-img" autoplay loop muted playsinline controls></video>
                            @else
                                <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="tp1-img" alt="">
                            @endif
                        @endif
                    </div>
                    <div class="text-left">
                        @if($block->caption)
                            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">{{ $block->caption }}</h3>
                        @endif
                        @if(!empty($block->content))
                            <div class="tp1-text">{!! $block->content !!}</div>
                        @endif
                        <div class="flex flex-wrap gap-2 mt-4">
                            @if($block->action_url)
                                <a href="{{ $block->action_url }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-100 transition-colors border border-slate-200">
                                    <span class="material-symbols-outlined text-[16px]">open_in_new</span> Liên kết
                                </a>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-left">
                        @if($block->caption)
                            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">{{ $block->caption }}</h3>
                        @endif
                        @if(!empty($block->content))
                            <div class="tp1-text">{!! $block->content !!}</div>
                        @endif
                        <div class="flex flex-wrap gap-2 mt-4">
                            @if($block->action_url)
                                <a href="{{ $block->action_url }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-100 transition-colors border border-slate-200">
                                    <span class="material-symbols-outlined text-[16px]">open_in_new</span> Liên kết
                                </a>
                            @endif
                        </div>
                    </div>
                    <div>
                        @if($block->url)
                            @if($block->type === 'video')
                                <video src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="tp1-img" autoplay loop muted playsinline controls></video>
                            @else
                                <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="tp1-img" alt="">
                            @endif
                        @endif
                    </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        <!-- Lịch trình sự kiện -->
        @if($event->scheduleItems->count() > 0)
        <div class="tp1-card" x-data="{ activeIndex: 0 }">
            <h2 class="tp1-section-title">Lịch trình sự kiện</h2>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mt-6">
                <!-- Left panel: Time slots selector -->
                <div class="md:col-span-4 flex md:flex-col gap-2 overflow-x-auto md:overflow-x-visible pb-3 md:pb-0 scrollbar-none" style="-ms-overflow-style: none; scrollbar-width: none;">
                    @foreach($event->scheduleItems as $index => $item)
                    <button 
                        @click="activeIndex = {{ $index }}"
                        :class="activeIndex === {{ $index }} ? 'bg-[#f97316] text-white border-[#f97316]' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 border-slate-200'"
                        class="flex items-center justify-center md:justify-start gap-3 px-4 py-3 rounded-xl border text-sm font-bold transition-all shrink-0 w-auto md:w-full text-left"
                    >
                        <span class="material-symbols-outlined text-[18px]">schedule</span>
                        <span>{{ $item->start_time->format('H:i') }}{{ $item->end_time ? ' - ' . $item->end_time->format('H:i') : '' }}</span>
                    </button>
                    @endforeach
                </div>
                
                <!-- Right panel: Content corresponding to chosen time slot -->
                <div class="md:col-span-8 bg-slate-50 border border-slate-200/60 rounded-xl p-6 min-h-[160px] flex flex-col justify-center text-left">
                    @foreach($event->scheduleItems as $index => $item)
                    <div x-show="activeIndex === {{ $index }}" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-[#f97316] mb-3">
                                <span class="material-symbols-outlined text-[14px]">schedule</span>
                                {{ $item->start_time->format('H:i') }}{{ $item->end_time ? ' - ' . $item->end_time->format('H:i') : '' }}
                            </span>
                            <h3 class="font-extrabold text-xl text-slate-800 tracking-tight leading-tight">{{ $item->title }}</h3>
                        </div>
                        
                        @if($item->speaker)
                        <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-slate-200/60 w-fit">
                            <img src="{{ $item->speaker->photo_url ? asset($item->speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80' }}"
                                 alt="{{ $item->speaker->name }}" class="w-10 h-10 rounded-full object-cover border border-slate-100 shadow-sm">
                            <div>
                                <div class="font-bold text-sm text-slate-800 leading-none mb-1 text-left">{{ $item->speaker->name }}</div>
                                <div class="text-xs text-slate-500 leading-none text-left">{{ $item->speaker->title ?? 'Diễn giả' }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($item->description)
                        <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">{{ $item->description }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @php
            $speakers = $event->speakers()->wherePivot('role', 'speaker')->get();
        @endphp
        
        @if($speakers->count() > 0)
        <div class="tp1-card mb-6">
            <h2 class="tp1-section-title text-center">Diễn giả tham gia</h2>
            <div class="flex flex-wrap justify-center gap-6">
                @foreach($speakers as $speaker)
                <div class="flex flex-col items-center text-center p-6 rounded-xl border border-slate-100 bg-slate-50 hover:shadow-md transition-shadow w-full sm:w-[calc(50%-12px)] md:w-[calc(33.333%-16px)] max-w-[320px]">
                    <img src="{{ $speaker->photo_url ? asset($speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80' }}"
                         alt="{{ $speaker->name }}" class="w-24 h-24 rounded-full object-cover mb-4 border-4 border-white shadow-sm">
                    <h3 class="font-bold text-lg text-slate-800">{{ $speaker->name }}</h3>
                    @if($speaker->title)
                        <p class="text-sm text-[#f97316] font-medium mb-3">{{ $speaker->title }}</p>
                    @endif
                    @if($speaker->bio)
                        <p class="text-sm text-slate-600">{{ $speaker->bio }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif


        
        <!-- Tương tác & Chia sẻ -->
        <div class="flex flex-wrap justify-center gap-4 mt-8" x-data="{ copied: false }">
            <button id="like-btn" data-event-id="{{ $event->id }}" class="flex items-center gap-2 px-6 py-3 rounded-full font-bold transition-all shadow-sm {{ session()->has('liked_events.' . $event->id) ? 'bg-orange-50 text-[#f97316] border border-orange-200' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50' }}">
                <span class="material-symbols-outlined {{ session()->has('liked_events.' . $event->id) ? 'font-fill' : '' }}">favorite</span>
                <span id="likes-count">{{ $event->likes_count }}</span> Lượt thích
            </button>
            <div class="flex items-center gap-2 px-6 py-3 rounded-full bg-white text-slate-700 border border-slate-200 shadow-sm font-bold">
                <span class="material-symbols-outlined text-[#f97316]">visibility</span>
                <span>{{ $event->views_count }}</span> Lượt xem
            </div>
            
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" 
               class="flex items-center gap-2 bg-[#1877F2] text-white px-6 py-3 rounded-full font-bold shadow-[0_4px_12px_rgba(24,119,242,0.3)] hover:scale-105 transition-transform">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Chia sẻ
            </a>
            <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)" 
                    class="relative flex items-center gap-2 bg-white text-slate-700 border border-slate-200 px-6 py-3 rounded-full font-bold shadow-sm hover:bg-slate-50 transition-all">
                <span class="material-symbols-outlined" style="font-size:18px;">link</span> Copy Link
                <span x-show="copied" x-transition style="display:none;" class="absolute -top-10 left-1/2 -translate-x-1/2 bg-[#1C1410] text-white text-xs px-2.5 py-1.5 rounded shadow-lg pointer-events-none whitespace-nowrap">Đã sao chép!</span>
            </button>
        </div>
        
        <!-- Điều hướng Sự kiện Trước / Sau -->
        @if(isset($previousEvent) || isset($nextEvent))
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-slate-200">
            <div>
                @if(isset($previousEvent) && $previousEvent)
                <a href="{{ route('events.show', $previousEvent->slug) }}" class="group block max-w-[280px] mr-auto">
                    <div class="flex items-center text-slate-500 group-hover:text-[#f97316] transition-colors mb-3">
                        <span class="material-symbols-outlined text-2xl -ml-1">arrow_left_alt</span>
                        <div class="h-[2px] bg-current flex-1"></div>
                    </div>
                    <div class="w-full h-[154px] rounded-xl overflow-hidden bg-slate-100 shadow-sm border border-slate-200">
                        @if($previousEvent->bannerImage)
                            <img src="{{ \App\Helpers\FileHelper::url($previousEvent->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @endif
                    </div>
                    <h4 class="mt-3 font-bold text-slate-800 group-hover:text-[#f97316] transition-colors line-clamp-2 text-left">{{ $previousEvent->title }}</h4>
                </a>
                @endif
            </div>
            <div class="text-right">
                @if(isset($nextEvent) && $nextEvent)
                <a href="{{ route('events.show', $nextEvent->slug) }}" class="group block max-w-[280px] ml-auto">
                    <div class="flex items-center text-slate-500 group-hover:text-[#f97316] transition-colors mb-3">
                        <div class="h-[2px] bg-current flex-1"></div>
                        <span class="material-symbols-outlined text-2xl -mr-1">arrow_right_alt</span>
                    </div>
                    <div class="w-full h-[154px] rounded-xl overflow-hidden bg-slate-100 shadow-sm border border-slate-200">
                        @if($nextEvent->bannerImage)
                            <img src="{{ \App\Helpers\FileHelper::url($nextEvent->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @endif
                    </div>
                    <h4 class="mt-3 font-bold text-slate-800 group-hover:text-[#f97316] transition-colors line-clamp-2 text-right">{{ $nextEvent->title }}</h4>
                </a>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>

@push('scripts')
<script>
    const dateStr = document.getElementById('countdown-wrapper')?.getAttribute('data-date');
    if(dateStr) {
        const eventDate = new Date(dateStr).getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = eventDate - now;

            if (distance < 0) {
                document.getElementById('countdown-wrapper').style.display = 'none';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').innerText = days.toString().padStart(2, '0');
            document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
            document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
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
                    likeBtn.classList.remove('bg-white', 'text-slate-700', 'border-slate-200');
                    likeBtn.classList.add('bg-orange-50', 'text-[#f97316]', 'border-orange-200');
                    const icon = likeBtn.querySelector('.material-symbols-outlined');
                    icon.classList.add('font-fill');
                    
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

@include('components.event-fab-menu', ['event' => $event])

@endsection
