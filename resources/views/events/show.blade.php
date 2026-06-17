@extends('layouts.public')

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

<!-- Hero Section -->
<section class="relative h-[600px] min-h-[500px] flex items-center justify-center overflow-hidden rounded-[24px] mb-12 mt-4">
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
        <h1 class="font-display-lg text-display-lg mb-6 leading-tight max-w-4xl mx-auto">{{ $event->title }}</h1>
        
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

        <div class="flex flex-col md:flex-row justify-center gap-4">
            
        </div>
    </div>
</section>

<!-- Bento Grid Details Section -->
<section class="max-w-container-max mx-auto py-12">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
        
        <!-- About / Description -->
        <div class="md:col-span-12 bg-pure-white p-8 md:p-12 rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow mb-8">
            <h2 class="font-headline-lg text-headline-lg text-deep-navy mb-6">About This Event</h2>
            <div class="text-on-surface-variant font-body-md leading-relaxed prose max-w-none">
                {!! nl2br(e($event->description)) !!}
            </div>
        </div>

        <!-- Date & Time Card -->
        <div class="md:col-span-4 bg-pure-white p-8 rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined" data-icon="calendar_month">calendar_month</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md text-deep-navy">Date & Time</h3>
                    <p class="text-text-muted font-body-sm">Mark your calendar</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-surface-container">
                    <span class="text-on-surface-variant font-label-lg">Event Date</span>
                    <span class="text-deep-navy font-bold">{{ $event->event_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-surface-container">
                    <span class="text-on-surface-variant font-label-lg">Time</span>
                    <span class="text-deep-navy font-bold">{{ $event->event_date->format('h:i A') }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-on-surface-variant font-label-lg">Status</span>
                    @if($event->event_date > now())
                        <span class="text-green-600 font-bold">Upcoming</span>
                    @else
                        <span class="text-gray-500 font-bold">Past Event</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Location & Map Card -->
        <div class="md:col-span-8 bg-pure-white rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col md:flex-row">
            <div class="p-8 md:w-1/2">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined" data-icon="location_on">location_on</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-headline-md text-deep-navy">Venue</h3>
                        <p class="text-text-muted font-body-sm">Where it happens</p>
                    </div>
                </div>
                <p class="text-on-surface-variant mb-6 font-body-md leading-relaxed font-bold text-xl">
                    {{ $event->location }}
                </p>
            </div>
            <div class="md:w-1/2 h-64 md:h-auto min-h-[300px] bg-surface-container-high relative">
                <div class="absolute inset-0 bg-gray-200">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAg2DFIzrPiE9eXGxlhrk8ScwLBwckgjmEZnhrE-ODdCkSyH1b-2ESSrPzi4nApCTbVdD0VvPajUX0fIoyIL6MGdFnydbyV2813F6U8sxnqLkHBzUOroOH7_I3FYJuzL4xhnEGzUasqtv9y1-haiTqsozTeCE__gZ_oedn5F9AEUZ7-39XQUI0PgWgM0X8RvkBK0DIZ4eTYKcWbVAquMrJjM8I1xeekmAgsoQY_EjyDZak8zIbyEjduy7RytBzqM_KFarHBFn8Va78" alt="Map"/>
                </div>
            </div>
        </div>

        <!-- Agenda Timeline -->
        @if($event->scheduleItems->count() > 0)
        <div class="md:col-span-12 bg-pure-white p-8 md:p-12 rounded-2xl border border-outline-variant shadow-sm mt-8">
            <div class="text-center mb-16">
                <h2 class="font-headline-lg text-headline-lg text-deep-navy mb-4">Event Agenda</h2>
                <p class="text-text-muted max-w-2xl mx-auto">A comprehensive breakdown of the day's activities.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($event->scheduleItems as $index => $item)
                <div class="relative timeline-item">
                    <div class="timeline-dot w-8 h-8 rounded-full bg-fpt-orange text-white flex items-center justify-center font-bold mb-6 relative z-10">{{ $index + 1 }}</div>
                    <div class="font-label-lg text-fpt-orange mb-2 uppercase tracking-wide">{{ $item->start_time->format('H:i') }}</div>
                    <h4 class="font-headline-md text-headline-md text-deep-navy mb-3">{{ $item->title }}</h4>
                    @if($item->speaker)
                        <p class="text-text-muted font-body-sm">{{ $item->speaker->name }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>


@push('scripts')
<script>
    const dateStr = document.getElementById('countdown')?.getAttribute('data-date');
    if (dateStr) {
        function updateCountdown() {
            const target = new Date(dateStr).getTime();
            
            function update() {
                const now = new Date().getTime();
                const diff = target - now;

                if (diff <= 0) {
                    document.getElementById('countdown').style.display = 'none';
                    return;
                }

                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((diff % (1000 * 60)) / 1000);

                document.getElementById('days').innerText = d.toString().padStart(2, '0');
                document.getElementById('hours').innerText = h.toString().padStart(2, '0');
                document.getElementById('minutes').innerText = m.toString().padStart(2, '0');
                document.getElementById('seconds').innerText = s.toString().padStart(2, '0');
            }

            setInterval(update, 1000);
            update();
        }
        updateCountdown();
    }
</script>
@endpush
@endsection
