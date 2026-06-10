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
        @if($event->banner_image)
            <img class="w-full h-full object-cover brightness-[0.4]" src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->title }}"/>
        @else
            <div class="w-full h-full bg-deep-navy brightness-[0.8]"></div>
        @endif
    </div>
    <div class="relative z-10 w-full max-w-container-max px-margin-desktop text-center text-pure-white mt-16">
        <span class="inline-block px-4 py-1.5 rounded-full bg-fpt-orange text-pure-white font-label-lg mb-6 tracking-wider uppercase">{{ $event->event_type }}</span>
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
            @if($event->registration_open)
                <a href="#registration-section" class="bg-fpt-orange hover:bg-on-primary-container text-pure-white px-10 py-4 rounded-lg font-headline-md transition-all active:scale-95 shadow-lg shadow-fpt-orange/20 inline-block">Register Now</a>
            @endif
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
        @if($event->schedule && is_array($event->schedule) && count($event->schedule) > 0)
        <div class="md:col-span-12 bg-pure-white p-8 md:p-12 rounded-2xl border border-outline-variant shadow-sm mt-8">
            <div class="text-center mb-16">
                <h2 class="font-headline-lg text-headline-lg text-deep-navy mb-4">Event Agenda</h2>
                <p class="text-text-muted max-w-2xl mx-auto">A comprehensive breakdown of the day's activities.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($event->schedule as $index => $item)
                <div class="relative timeline-item">
                    <div class="timeline-dot w-8 h-8 rounded-full bg-fpt-orange text-white flex items-center justify-center font-bold mb-6 relative z-10">{{ $index + 1 }}</div>
                    <div class="font-label-lg text-fpt-orange mb-2 uppercase tracking-wide">{{ $item['time'] ?? '' }}</div>
                    <h4 class="font-headline-md text-headline-md text-deep-navy mb-3">{{ $item['activity'] ?? '' }}</h4>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

<!-- Registration Section -->
<section id="registration-section" class="bg-surface-container py-24 rounded-[24px] mb-12">
    <div class="max-w-3xl mx-auto px-margin-desktop">
        <div class="text-center mb-12">
            <h2 class="font-headline-lg text-headline-lg text-deep-navy mb-4">Register for the Event</h2>
            <p class="text-text-muted font-body-sm">Secure your spot by filling out the information below. A check-in QR code will be sent to your email.</p>
        </div>

        <div class="bg-pure-white rounded-2xl p-8 border border-outline-variant shadow-xl">
            
            {{-- Flash messages --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm font-body-md flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm font-body-md flex items-center gap-2">
                    <span class="material-symbols-outlined">error</span>
                    {{ session('error') }}
                </div>
            @endif

            @if($event->registration_open)
                <div class="mb-8 flex justify-between items-center pb-6 border-b border-surface-container">
                    @if($event->max_attendees)
                        <div class="text-center">
                            <div class="text-sm text-text-muted mb-1">Capacity</div>
                            <div class="font-bold text-deep-navy">{{ $event->registrations()->count() }} / {{ $event->max_attendees }}</div>
                        </div>
                    @endif
                    <div class="text-center">
                        <div class="text-sm text-text-muted mb-1">Status</div>
                        <div class="font-bold text-green-600 flex items-center gap-1 justify-center"><span class="material-symbols-outlined text-sm">lock_open</span> Open</div>
                    </div>
                </div>

                <form action="{{ route('events.register', $event) }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="full_name" class="block font-label-lg text-deep-navy mb-2">Họ và tên <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" required
                                class="w-full border-outline-variant rounded-lg px-4 py-3 focus:ring-2 focus:ring-fpt-orange focus:border-fpt-orange transition-all bg-surface-container-lowest">
                            @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block font-label-lg text-deep-navy mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full border-outline-variant rounded-lg px-4 py-3 focus:ring-2 focus:ring-fpt-orange focus:border-fpt-orange transition-all bg-surface-container-lowest">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block font-label-lg text-deep-navy mb-2">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full border-outline-variant rounded-lg px-4 py-3 focus:ring-2 focus:ring-fpt-orange focus:border-fpt-orange transition-all bg-surface-container-lowest">
                        </div>
                        <div>
                            <label for="student_id" class="block font-label-lg text-deep-navy mb-2">Mã sinh viên</label>
                            <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}"
                                class="w-full border-outline-variant rounded-lg px-4 py-3 focus:ring-2 focus:ring-fpt-orange focus:border-fpt-orange transition-all bg-surface-container-lowest">
                        </div>
                        <div>
                            <label for="department" class="block font-label-lg text-deep-navy mb-2">Khoa / Ngành</label>
                            <input type="text" name="department" id="department" value="{{ old('department') }}"
                                class="w-full border-outline-variant rounded-lg px-4 py-3 focus:ring-2 focus:ring-fpt-orange focus:border-fpt-orange transition-all bg-surface-container-lowest">
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-fpt-orange text-pure-white py-4 rounded-xl font-headline-md flex items-center justify-center gap-2 hover:opacity-90 transition-opacity shadow-lg active:scale-95 mt-8">
                        Hoàn tất đăng ký
                    </button>
                </form>
            @else
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-text-muted mb-4">event_busy</span>
                    <h3 class="font-headline-md text-deep-navy mb-2">Registration Closed</h3>
                    <p class="text-text-muted font-body-sm">We are no longer accepting registrations for this event.</p>
                </div>
            @endif
        </div>
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
