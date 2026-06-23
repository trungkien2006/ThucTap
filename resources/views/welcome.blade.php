@extends('layouts.public')

@section('content')
<header class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <h1 class="font-display-lg text-display-lg text-deep-navy mb-2">Event Directory</h1>
        <p class="font-body-lg text-body-lg text-text-muted">Manage, monitor, and promote your campus happenings.</p>
    </div>
    <form action="{{ route('home') }}" method="GET" class="flex items-center bg-surface-container-low p-1.5 rounded-xl border border-outline-variant">
        <button type="submit" name="filter" value="All" class="filter-btn px-6 py-2 rounded-lg font-label-lg text-label-lg transition-all {{ !request('filter') || request('filter') === 'All' ? 'bg-fpt-orange text-pure-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container' }}">All</button>
        <button type="submit" name="filter" value="Upcoming" class="filter-btn px-6 py-2 rounded-lg font-label-lg text-label-lg transition-all {{ request('filter') === 'Upcoming' ? 'bg-fpt-orange text-pure-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container' }}">Upcoming</button>
        <button type="submit" name="filter" value="Past" class="filter-btn px-6 py-2 rounded-lg font-label-lg text-label-lg transition-all {{ request('filter') === 'Past' ? 'bg-fpt-orange text-pure-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container' }}">Past</button>
    </form>
</header>

<div class="bento-grid" id="eventsContainer">
    @if($events->count() > 0)
        {{-- Featured Event (The first event) --}}
        @php $featured = $events->first(); @endphp
        <div class="col-span-12 lg:col-span-8 bg-pure-white rounded-[24px] border border-outline-variant overflow-hidden event-card-hover group flex flex-col md:flex-row">
            <div class="md:w-1/2 relative h-64 md:h-auto overflow-hidden">
                @if($featured->bannerImage)
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ \App\Helpers\FileHelper::url($featured->bannerImage->url) }}" alt="{{ $featured->title }}"/>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-deep-navy group-hover:scale-105 transition-transform duration-700">
                        <span class="text-white opacity-50">No Image</span>
                    </div>
                @endif
                <div class="absolute top-4 left-4 bg-fpt-orange text-pure-white px-4 py-1.5 rounded-full font-label-sm text-label-sm uppercase tracking-wider font-bold">Featured</div>
            </div>
            <div class="md:w-1/2 p-8 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 text-fpt-orange mb-4">
                        <span class="material-symbols-outlined">calendar_today</span>
                        <span class="font-label-lg text-label-lg">{{ $featured->event_date->format('M d, Y • h:i A') }}</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg text-deep-navy mb-4">{{ $featured->title }}</h3>
                    <p class="font-body-md text-body-md text-text-muted mb-6 line-clamp-3">{{ Str::limit(strip_tags($featured->description), 150) }}</p>
                    <div class="flex items-center gap-6 mb-8">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-text-muted">favorite</span>
                            <span class="font-label-lg text-label-lg font-bold">{{ $featured->likes_count }} Likes</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-text-muted">location_on</span>
                            <span class="font-label-lg text-label-lg">{{ $featured->location }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('events.show', $featured->slug) }}" class="flex-1 text-center bg-deep-navy text-pure-white py-3 rounded-lg font-label-lg text-label-lg hover:bg-deep-navy/90 transition-colors">View Details</a>
                </div>
            </div>
        </div>

        {{-- Stats Card --}}
        <div class="col-span-12 lg:col-span-4 bg-deep-navy rounded-[24px] p-8 text-pure-white flex flex-col justify-between shadow-xl">
            <div>
                <h4 class="font-headline-md text-headline-md mb-6">FPT Polytechnic</h4>
                <div class="space-y-6">
                    <div class="flex justify-between items-center pb-4 border-b border-white/10">
                        <span class="font-body-md">Total Events</span>
                        <span class="font-headline-md text-fpt-orange">{{ \App\Models\Event::published()->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-white/10">
                        <span class="font-body-md">Upcoming</span>
                        <span class="font-headline-md text-fpt-orange">{{ \App\Models\Event::published()->upcoming()->count() }}</span>
                    </div>
                    <p class="font-body-sm text-gray-300 mt-4 leading-relaxed">Join our events to connect, learn, and grow. Experience the vibrant academic and cultural life at FPT Polytechnic.</p>
                </div>
            </div>
            <a href="#" class="mt-8 text-center block w-full border border-white/30 text-pure-white py-3 rounded-lg font-label-lg text-label-lg hover:bg-white/10 transition-colors">Learn More</a>
        </div>

        {{-- Standard Event Cards --}}
        @foreach($events->skip(1) as $event)
        <div class="col-span-12 md:col-span-6 lg:col-span-4 bg-pure-white rounded-[24px] border border-outline-variant overflow-hidden event-card-hover group flex flex-col">
            <div class="h-48 overflow-hidden relative">
                @if($event->bannerImage)
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 {{ $event->event_date < now() ? 'opacity-80 grayscale-[0.3]' : '' }}" src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}" alt="{{ $event->title }}"/>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-surface-container-high group-hover:scale-110 transition-transform duration-500">
                        <span class="text-outline opacity-50">No Image</span>
                    </div>
                @endif
                <div class="absolute bottom-3 right-3 {{ $event->event_date < now() ? 'bg-surface-container-highest/90 text-text-muted' : 'bg-surface-container-lowest/90 text-deep-navy' }} backdrop-blur-sm px-3 py-1 rounded-full font-label-sm text-label-sm font-bold">
                    {{ $event->event_date < now() ? 'Past' : 'Upcoming' }}
                </div>
            </div>
            <div class="p-6 flex-1 flex flex-col {{ $event->event_date < now() ? 'opacity-80 grayscale-[0.3]' : '' }}">
                <div class="flex items-center gap-2 text-text-muted mb-2">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    <span class="font-label-sm text-label-sm">{{ $event->event_date->format('M d • h:i A') }}</span>
                </div>
                <h4 class="font-headline-md text-[20px] text-deep-navy mb-3 line-clamp-1"><a href="{{ route('events.show', $event->slug) }}" class="hover:text-fpt-orange transition-colors">{{ $event->title }}</a></h4>
                <p class="font-body-sm text-body-sm text-text-muted mb-6 flex-1 line-clamp-2">{{ Str::limit(strip_tags($event->description), 100) }}</p>
                <div class="flex items-center justify-between pt-6 border-t border-outline-variant">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-fpt-orange">favorite</span>
                        <span class="font-label-lg text-label-lg font-bold text-deep-navy">{{ $event->likes_count }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('events.show', $event->slug) }}" class="p-2 hover:bg-surface-container rounded-full text-text-muted transition-colors flex items-center justify-center" title="Preview"><span class="material-symbols-outlined">visibility</span></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    @else
        <div class="col-span-12 text-center py-20 bg-pure-white rounded-[24px] border border-outline-variant">
            <span class="material-symbols-outlined text-6xl text-outline mb-4">event_busy</span>
            <h2 class="font-headline-lg text-headline-lg text-text-muted">No events found</h2>
        </div>
    @endif
</div>

<div class="mt-16 flex justify-center">
    {{ $events->links() }}
</div>
@endsection
