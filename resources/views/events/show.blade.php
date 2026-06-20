@extends('layouts.frontend')

@section('content')

@push('styles')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .timeline-dot::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 100%;
        width: 2px;
        height: calc(100% + 1.5rem);
        background: #e1e3e4;
        transform: translateX(-50%);
    }
    .timeline-item:last-child .timeline-dot::after {
        display: none;
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

<!-- Hero Section -->
<section class="relative h-[600px] min-h-[500px] flex items-center justify-center overflow-hidden mb-12">
    <div class="absolute inset-0 z-0">
        @if($event->bannerImage)
            <img class="w-full h-full object-cover brightness-[0.4]" src="{{ Storage::url($event->bannerImage->url) }}" alt="{{ $event->title }}"/>
        @else
            <div class="w-full h-full bg-deep-navy brightness-[0.8]"></div>
        @endif
    </div>
    <div class="relative z-10 w-full max-w-container-max px-margin-desktop text-center text-pure-white mt-16">
        @if($event->category)
            <span class="inline-block px-4 py-1.5 rounded-full bg-fpt-orange text-pure-white font-label-lg mb-6 tracking-wider uppercase">{{ $event->category->name }}</span>
        @endif
        <h1 class="font-display-lg text-display-lg mb-6 leading-tight max-w-4xl mx-auto" style="{{ $titleStyleStr }}">{{ $event->title }}</h1>
        
        <!-- Countdown Timer -->
        @if($event->event_date > now())
        <div class="flex justify-center gap-4 md:gap-8 mb-12" id="countdown" data-date="{{ $event->event_date->format('Y-m-d\TH:i:s') }}">
            <div class="glass-card rounded-xl p-4 min-w-[100px]">
                <div class="text-4xl md:text-5xl font-bold text-fpt-orange" id="days">00</div>
                <div class="text-sm font-label-lg text-pure-white/90 uppercase">Days</div>
            </div>
            <div class="glass-card rounded-xl p-4 min-w-[100px]">
                <div class="text-4xl md:text-5xl font-bold text-fpt-orange" id="hours">00</div>
                <div class="text-sm font-label-lg text-pure-white/90 uppercase">Hours</div>
            </div>
            <div class="glass-card rounded-xl p-4 min-w-[100px]">
                <div class="text-4xl md:text-5xl font-bold text-fpt-orange" id="minutes">00</div>
                <div class="text-sm font-label-lg text-pure-white/90 uppercase">Mins</div>
            </div>
            <div class="glass-card rounded-xl p-4 min-w-[100px]">
                <div class="text-4xl md:text-5xl font-bold text-fpt-orange" id="seconds">00</div>
                <div class="text-sm font-label-lg text-pure-white/90 uppercase">Secs</div>
            </div>
        </div>
        @endif

    </div>
</section>

<!-- Bento Grid Details Section -->
<section class="w-full py-12 px-4 lg:px-10" style="background:#FFFBEA;">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
        
        <!-- Left Column -->
        <div class="lg:col-span-8 space-y-8">
            <!-- About / Description -->
            <div class="p-8 md:p-12 rounded-2xl shadow-sm transition-shadow" style="background:#FFF8D0; border:1px solid rgba(255,227,129,0.5);">
            <h2 class="font-['Barlow_Condensed'] text-4xl font-black uppercase text-[#1C1410] mb-6">Giới thiệu sự kiện</h2>
            <div class="text-on-surface-variant font-body-md leading-relaxed prose max-w-none mb-6" style="{{ $descStyleStr }}">
                {!! nl2br(e($event->description)) !!}
            </div>

            {{-- Hiển thị nội dung chi tiết (các khối thiết kế từ studio) --}}
            @if($event->galleryImages->count() > 0)
                <div class="mt-8 pt-8 border-t border-surface-container space-y-8">
                    @foreach($event->galleryImages->take(4) as $block)
                        <div class="space-y-4">
                            @if($block->content)
                                <div class="text-on-surface-variant font-body-md leading-relaxed text-justify break-words">
                                    {!! nl2br(e($block->content)) !!}
                                </div>
                            @endif

                            @if($block->url)
                                <figure class="my-6">
                                    <div class="rounded-xl overflow-hidden bg-slate-100 shadow-sm max-w-2xl">
                                        @if($block->type === 'video')
                                            <video src="{{ Storage::url($block->url) }}" class="w-full h-auto object-cover max-h-[500px]" autoplay loop muted playsinline controls></video>
                                        @else
                                            <img src="{{ Storage::url($block->url) }}" class="w-full h-auto object-contain max-h-[500px]" alt=""/>
                                        @endif
                                    </div>
                                    @if($block->caption)
                                    <figcaption class="mt-3 text-sm text-text-muted italic">
                                        {{ $block->caption }}
                                    </figcaption>
                                    @endif
                                </figure>
                            @endif

                            <div class="flex flex-wrap gap-3 mt-4">
                                {{-- Tài liệu đính kèm nếu có --}}
                                @if($block->document_url)
                                    <a href="{{ Storage::url($block->document_url) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold rounded-xl text-sm border border-emerald-200 transition-all">
                                        <span class="material-symbols-outlined text-lg">download</span>
                                        Tải tài liệu: {{ $block->document_name ?? basename($block->document_url) }}
                                    </a>
                                @endif

                                {{-- URL liên kết ngoài nếu có --}}
                                @if($block->action_url)
                                    <a href="{{ $block->action_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-xl text-sm border border-blue-200 transition-all">
                                        <span class="material-symbols-outlined text-lg">open_in_new</span>
                                        Xem liên kết ngoài
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            </div>



            <!-- Agenda Timeline -->
            @if($event->scheduleItems->count() > 0)
            <div class="p-8 md:p-12 rounded-2xl border shadow-sm" style="background:#FFF8D0; border-color:rgba(255,227,129,0.5);">
            <div class="text-center mb-16">
                <h2 class="font-['Barlow_Condensed'] text-4xl font-black uppercase text-[#1C1410] mb-4">Lịch trình sự kiện</h2>
                <p class="text-[#7A6A52] max-w-2xl mx-auto">Chi tiết lịch trình diễn ra trong sự kiện.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($event->scheduleItems as $index => $item)
                <div class="relative timeline-item">
                    <div class="timeline-dot w-8 h-8 rounded-full bg-[#07A0C3] text-white flex items-center justify-center font-bold mb-6 relative z-10">{{ $index + 1 }}</div>
                    <div class="font-label-lg text-[#07A0C3] mb-2 uppercase tracking-wide font-bold">{{ $item->start_time->format('H:i') }}</div>
                    <h4 class="font-['Barlow_Condensed'] text-xl font-bold uppercase text-[#1C1410] mb-3">{{ $item->title }}</h4>
                    @if($item->speaker)
                        <p class="text-[#7A6A52] font-body-sm">{{ $item->speaker->name }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            </div>
            @endif

            <!-- Lượt thích và lượt xem -->
            <div class="p-8 rounded-2xl shadow-sm flex flex-col md:flex-row justify-center gap-4 mt-8 items-center" style="background:#FFF8D0; border:1px solid rgba(255,227,129,0.5);">
                <button id="like-btn" data-event-id="{{ $event->id }}" class="bg-white hover:bg-slate-50 border px-8 py-3 rounded-full font-bold transition-all shadow-sm flex items-center gap-2 {{ session()->has('liked_events.' . $event->id) ? 'text-red-500 border-red-200' : 'text-[#1C1410] border-[#FFE381]' }}">
                    <span class="material-symbols-outlined {{ session()->has('liked_events.' . $event->id) ? 'text-red-500' : '' }} font-fill">favorite</span>
                    <span id="likes-count">{{ $event->likes_count }}</span> Lượt thích
                </button>
                <div class="bg-white border text-[#1C1410] px-8 py-3 rounded-full font-bold shadow-sm flex items-center gap-2" style="border-color:rgba(255,227,129,0.5);">
                    <span class="material-symbols-outlined text-[#07A0C3]">visibility</span>
                    <span>{{ $event->views_count }}</span> Lượt xem
                </div>
            </div>

            <!-- Điều hướng Sự kiện Trước / Sau -->
            @if(isset($previousEvent) || isset($nextEvent))
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8 pt-8" style="border-top:1px solid rgba(255,227,129,0.5);">
                <!-- Sự kiện trước -->
                <div>
                    @if(isset($previousEvent) && $previousEvent)
                    <a href="{{ route('events.show', $previousEvent->slug) }}" class="group block max-w-[280px] mr-auto">
                        <div class="flex items-center text-[#7A6A52] group-hover:text-[#07A0C3] transition-colors mb-3">
                            <span class="material-symbols-outlined text-2xl -ml-1">arrow_left_alt</span>
                            <div class="h-[2px] bg-current flex-1"></div>
                        </div>
                        <div class="w-full h-[154px] rounded-xl overflow-hidden bg-slate-100 shadow-sm border border-slate-200">
                            @if($previousEvent->bannerImage)
                                <img src="{{ Storage::url($previousEvent->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-[#FFF8D0]"></div>
                            @endif
                        </div>
                        <h4 class="mt-3 font-bold text-[#1C1410] group-hover:text-[#07A0C3] transition-colors line-clamp-2 text-left">{{ $previousEvent->title }}</h4>
                    </a>
                    @endif
                </div>

                <!-- Sự kiện tiếp theo -->
                <div class="text-right">
                    @if(isset($nextEvent) && $nextEvent)
                    <a href="{{ route('events.show', $nextEvent->slug) }}" class="group block max-w-[280px] ml-auto">
                        <div class="flex items-center text-[#7A6A52] group-hover:text-[#07A0C3] transition-colors mb-3">
                            <div class="h-[2px] bg-current flex-1"></div>
                            <span class="material-symbols-outlined text-2xl -mr-1">arrow_right_alt</span>
                        </div>
                        <div class="w-full h-[154px] rounded-xl overflow-hidden bg-slate-100 shadow-sm border border-slate-200">
                            @if($nextEvent->bannerImage)
                                <img src="{{ Storage::url($nextEvent->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-[#FFF8D0]"></div>
                            @endif
                        </div>
                        <h4 class="mt-3 font-bold text-[#1C1410] group-hover:text-[#07A0C3] transition-colors line-clamp-2 text-right">{{ $nextEvent->title }}</h4>
                    </a>
                    @endif
                </div>
            </div>
            @endif

        </div>

        <!-- Right Column (Aside) -->
        <div class="lg:col-span-4 space-y-6" style="position: sticky; top: 110px; align-self: start; height: max-content;">
            
            <!-- Thời gian & Trạng thái -->
            <div class="p-6 rounded-2xl shadow-sm" style="background:#FFF8D0; border:1px solid rgba(255,227,129,0.5);">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background:#FFE381; color:#1C1410;">
                        <span class="material-symbols-outlined" data-icon="calendar_month">calendar_month</span>
                    </div>
                    <div>
                        <h3 class="font-['Barlow_Condensed'] font-black uppercase text-2xl text-[#1C1410]">Thời gian</h3>
                    </div>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between border-b pb-2" style="border-color:rgba(255,227,129,0.4);">
                        <span class="text-[#7A6A52] font-semibold">Ngày</span>
                        <span class="text-[#1C1410] font-bold">{{ $event->event_date->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2" style="border-color:rgba(255,227,129,0.4);">
                        <span class="text-[#7A6A52] font-semibold">Giờ</span>
                        <span class="text-[#1C1410] font-bold">{{ $event->event_date->format('H:i') }}</span>
                    </div>
                    <div class="flex justify-between pt-1">
                        <span class="text-[#7A6A52] font-semibold">Trạng thái</span>
                        @if($event->event_date > now())
                            <span class="text-green-600 font-bold uppercase tracking-wider text-[11px] px-2 py-0.5 rounded bg-green-100">Sắp diễn ra</span>
                        @else
                            <span class="text-gray-500 font-bold uppercase tracking-wider text-[11px] px-2 py-0.5 rounded bg-gray-100">Đã kết thúc</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Speaker Card -->
            @if($event->speakers->count() > 0)
            <div class="p-6 rounded-2xl border shadow-sm flex gap-4 items-center" style="background:#FFF8D0; border-color:rgba(255,227,129,0.5);">
                <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-slate-200 shadow-inner bg-slate-50">
                    <img class="w-full h-full object-cover" src="{{ $event->speakers->first()->photo_url ? asset($event->speakers->first()->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}"/>
                </div>
                <div>
                    <span class="text-[#07A0C3] text-[10px] font-bold uppercase tracking-widest block mb-0.5">Diễn giả chính</span>
                    <h3 class="text-[16px] font-bold font-['Barlow_Condensed'] uppercase text-[#1C1410]">
                        {{ $event->speakers->first()->name }}
                    </h3>
                    <p class="text-[12px] text-[#7A6A52] font-light mt-0.5">{{ Str::limit($event->speakers->first()->bio, 100) }}</p>
                </div>
            </div>
            @endif

            <!-- Promoted Events: Newest -->
            @if(isset($newestEvents) && $newestEvents->count() > 0)
            <div class="p-6 rounded-2xl border shadow-sm" style="background:#FFF8D0; border-color:rgba(255,227,129,0.5);">
                <h4 class="text-[14px] font-['Barlow_Condensed'] uppercase font-bold text-[#1C1410] mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-emerald-500">new_releases</span>
                    Sự kiện mới nhất
                </h4>
                <div class="space-y-5">
                    @foreach($newestEvents as $newEv)
                        <a href="{{ route('events.show', $newEv->slug) }}" class="flex gap-4 items-center group">
                            <div class="w-20 h-14 rounded-lg overflow-hidden shrink-0 bg-slate-100 border border-slate-200">
                                @if($newEv->bannerImage)
                                    <img src="{{ Storage::url($newEv->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                @else
                                    <div class="w-full h-full bg-slate-200"></div>
                                @endif
                            </div>
                            <div>
                                <h5 class="text-[13px] font-bold text-[#1C1410] group-hover:text-[#07A0C3] transition-colors line-clamp-2 leading-snug">{{ $newEv->title }}</h5>
                                <p class="text-[11px] text-[#7A6A52] mt-1">{{ $newEv->event_date->format('d/m/Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Promoted Events: Prominent -->
            @if(isset($prominentEvents) && $prominentEvents->count() > 0)
            <div class="p-6 rounded-2xl border shadow-sm" style="background:#FFF8D0; border-color:rgba(255,227,129,0.5);">
                <h4 class="text-[14px] font-['Barlow_Condensed'] uppercase font-bold text-[#1C1410] mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-amber-500">local_fire_department</span>
                    Sự kiện nổi bật
                </h4>
                <div class="space-y-5">
                    @foreach($prominentEvents as $promEv)
                        <a href="{{ route('events.show', $promEv->slug) }}" class="flex gap-4 items-center group">
                            <div class="w-20 h-14 rounded-lg overflow-hidden shrink-0 bg-slate-100 border border-slate-200">
                                @if($promEv->bannerImage)
                                    <img src="{{ Storage::url($promEv->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                @else
                                    <div class="w-full h-full bg-slate-200"></div>
                                @endif
                            </div>
                            <div>
                                <h5 class="text-[13px] font-bold text-[#1C1410] group-hover:text-[#07A0C3] transition-colors line-clamp-2 leading-snug">{{ $promEv->title }}</h5>
                                <div class="flex items-center gap-3 mt-1.5">
                                    <span class="text-[11px] text-[#7A6A52] flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">visibility</span>{{ number_format($promEv->views_count) }}</span>
                                    <span class="text-[11px] text-[#7A6A52] flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">favorite</span>{{ number_format($promEv->likes_count) }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

    </div>
</section>


@push('scripts')
<script>
    const dateStr = document.getElementById('countdown-wrapper')?.getAttribute('data-date');
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

    if (document.getElementById('countdown-wrapper')) {
        setInterval(updateCountdown, 1000);
        updateCountdown();
    }

    // Like logic
    document.getElementById('like-btn').addEventListener('click', function() {
        const eventId = this.dataset.eventId;
        const btn = this;
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
                btn.classList.add('text-red-400', 'border-red-400/50');
                btn.querySelector('.material-symbols-outlined').classList.add('text-red-400');
                btn.style.animation = 'pulse 0.5s ease-in-out';
                setTimeout(() => btn.style.animation = '', 500);
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endpush
@endsection
