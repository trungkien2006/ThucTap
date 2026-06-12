@extends('layouts.app')

@section('header')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.events.index') }}" class="text-text-muted hover:text-fpt-orange transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-headline-lg text-headline-lg text-deep-navy">{{ $event->title }}</h2>
        </div>
        <p class="font-body-md text-body-md text-text-muted mt-1 ml-10">Manage event details and view registration statistics.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('events.show', $event->slug) }}" target="_blank" class="flex items-center gap-2 bg-surface-container-high text-on-surface-variant font-label-lg px-4 py-2 rounded-lg hover:bg-surface-variant transition-all">
            <span class="material-symbols-outlined">visibility</span>
            <span>View Public Page</span>
        </a>
        <a href="{{ route('admin.events.edit', $event) }}" class="flex items-center gap-2 bg-fpt-orange text-pure-white font-label-lg px-4 py-2 rounded-lg hover:brightness-110 transition-all">
            <span class="material-symbols-outlined">edit</span>
            <span>Edit Event</span>
        </a>
    </div>
</div>
@endsection

@section('content')

<!-- Bento Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-gutter mb-8 mt-4">
    <!-- Total Registrations -->
    <div class="glass-card p-6 rounded-xl flex flex-col justify-between shadow-sm hover:shadow-md transition-all border-l-4 border-blue-500 group">
        <div class="flex justify-between items-start">
            <div class="p-3 bg-blue-100 rounded-lg text-blue-600">
                <span class="material-symbols-outlined text-2xl" data-icon="groups">groups</span>
            </div>
        </div>
        <div class="mt-4">
            <h3 class="font-label-lg text-label-lg text-text-muted uppercase tracking-wider">Total Registrations</h3>
            <p class="font-display-lg text-display-lg text-deep-navy mt-2 group-hover:scale-105 origin-left transition-transform">{{ $event->registrations->count() }}</p>
        </div>
    </div>
    
    <!-- Email Confirmed -->
    <div class="glass-card p-6 rounded-xl flex flex-col justify-between shadow-sm hover:shadow-md transition-all border-l-4 border-green-500 group">
        <div class="flex justify-between items-start">
            <div class="p-3 bg-green-100 rounded-lg text-green-600">
                <span class="material-symbols-outlined text-2xl" data-icon="mark_email_read">mark_email_read</span>
            </div>
        </div>
        <div class="mt-4">
            <h3 class="font-label-lg text-label-lg text-text-muted uppercase tracking-wider">Email Confirmed</h3>
            <p class="font-display-lg text-display-lg text-deep-navy mt-2 group-hover:scale-105 origin-left transition-transform">{{ $event->registrations->where('email_confirmed', true)->count() }}</p>
        </div>
    </div>

    <!-- Checked In -->
    <div class="glass-card p-6 rounded-xl flex flex-col justify-between shadow-sm hover:shadow-md transition-all border-l-4 border-fpt-orange group">
        <div class="flex justify-between items-start">
            <div class="p-3 bg-primary-fixed/50 rounded-lg text-fpt-orange">
                <span class="material-symbols-outlined text-2xl" data-icon="how_to_reg">how_to_reg</span>
            </div>
        </div>
        <div class="mt-4">
            <h3 class="font-label-lg text-label-lg text-text-muted uppercase tracking-wider">Checked In</h3>
            <p class="font-display-lg text-display-lg text-deep-navy mt-2 group-hover:scale-105 origin-left transition-transform">{{ $event->registrations->filter(function($reg) { return $reg->checkins->count() > 0; })->count() }}</p>
        </div>
    </div>
    
    <!-- Views -->
    <div class="glass-card p-6 rounded-xl flex flex-col justify-between shadow-sm hover:shadow-md transition-all border-l-4 border-purple-500 group">
        <div class="flex justify-between items-start">
            <div class="p-3 bg-purple-100 rounded-lg text-purple-600">
                <span class="material-symbols-outlined text-2xl" data-icon="visibility">visibility</span>
            </div>
        </div>
        <div class="mt-4">
            <h3 class="font-label-lg text-label-lg text-text-muted uppercase tracking-wider">Page Views</h3>
            <p class="font-display-lg text-display-lg text-deep-navy mt-2 group-hover:scale-105 origin-left transition-transform">{{ $event->views_count }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Event Info -->
    <div class="lg:col-span-2">
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/30 h-full">
            <h3 class="font-headline-md text-headline-md text-deep-navy mb-6 border-b border-outline-variant/30 pb-4">Event Details</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <p class="font-label-sm text-label-sm text-text-muted uppercase">Date & Time</p>
                    <p class="font-body-md text-body-md text-deep-navy font-semibold">{{ $event->event_date->format('M d, Y - H:i A') }}</p>
                </div>
                <div class="space-y-1">
                    <p class="font-label-sm text-label-sm text-text-muted uppercase">Location</p>
                    <p class="font-body-md text-body-md text-deep-navy font-semibold">{{ $event->location }}</p>
                </div>
                <div class="space-y-1">
                    <p class="font-label-sm text-label-sm text-text-muted uppercase">Event Type</p>
                    <p class="font-body-md text-body-md text-deep-navy font-semibold capitalize">{{ $event->category?->name ?? 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="font-label-sm text-label-sm text-text-muted uppercase">Capacity</p>
                    <p class="font-body-md text-body-md text-deep-navy font-semibold">{{ $event->max_attendees ? $event->max_attendees . ' attendees' : 'Unlimited' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="font-label-sm text-label-sm text-text-muted uppercase">Status</p>
                    <div>
                        @if($event->status == 'published')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full font-label-sm text-label-sm font-bold border border-green-200">Published</span>
                        @else
                            <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full font-label-sm text-label-sm font-bold border border-outline-variant">Draft</span>
                        @endif
                    </div>
                </div>
                <div class="space-y-1">
                    <p class="font-label-sm text-label-sm text-text-muted uppercase">Registration</p>
                    <div>
                        @if($event->registration_open)
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-label-sm text-label-sm font-bold border border-blue-200">Open</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full font-label-sm text-label-sm font-bold border border-red-200">Closed</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code -->
    <div class="lg:col-span-1">
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/30 text-center h-full flex flex-col justify-center items-center">
            <h3 class="font-headline-md text-headline-md text-deep-navy mb-2">Event QR Code</h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">Scan to access the public event page</p>
            
            <div class="p-4 bg-white border border-outline-variant rounded-xl shadow-sm mb-4">
                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate(route('events.show', $event->slug)) !!}
            </div>
            
            <button onclick="navigator.clipboard.writeText('{{ route('events.show', $event->slug) }}'); alert('Link copied to clipboard!');" class="flex items-center gap-2 text-fpt-orange hover:underline font-label-sm text-label-sm">
                <span class="material-symbols-outlined text-sm">content_copy</span> Copy Link
            </button>
        </div>
    </div>
</div>

<!-- Registrations List -->
<section class="bg-pure-white rounded-xl shadow-sm border border-outline-variant overflow-hidden">
    <div class="px-8 py-6 border-b border-outline-variant flex justify-between items-center">
        <div>
            <h3 class="font-headline-md text-headline-md text-deep-navy">Registrations List</h3>
            <p class="font-body-sm text-body-sm text-text-muted">Manage attendees for this event</p>
        </div>
        <div class="flex gap-2">
            <button class="flex items-center gap-2 bg-surface-container-high text-on-surface-variant font-label-sm px-3 py-2 rounded-lg hover:bg-surface-variant transition-all">
                <span class="material-symbols-outlined text-sm">file_download</span> Export CSV
            </button>
        </div>
    </div>
    
    @if($event->registrations->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-surface-container-low">
                    <th class="px-6 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">#</th>
                    <th class="px-6 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Attendee</th>
                    <th class="px-6 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Student ID</th>
                    <th class="px-6 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Email Confirmed</th>
                    <th class="px-6 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Check-in Status</th>
                    <th class="px-6 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Time Registered</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @foreach($event->registrations->sortByDesc('created_at') as $index => $reg)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="px-6 py-4 text-body-md text-text-muted">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">
                        <p class="font-body-md text-body-md font-bold text-deep-navy">{{ $reg->full_name }}</p>
                        <p class="font-body-sm text-body-sm text-text-muted">{{ $reg->email }}</p>
                    </td>
                    <td class="px-6 py-4 text-body-md text-deep-navy">
                        {{ $reg->student_id ?? '-' }}
                        @if($reg->department)
                            <span class="block text-xs text-text-muted">{{ $reg->department->name }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($reg->email_confirmed)
                            <span class="flex items-center gap-1 text-green-600 bg-green-100 px-2 py-1 rounded w-fit text-xs font-bold">
                                <span class="material-symbols-outlined text-sm">check_circle</span> Yes
                            </span>
                        @else
                            <span class="flex items-center gap-1 text-gray-500 bg-gray-100 px-2 py-1 rounded w-fit text-xs font-bold">
                                <span class="material-symbols-outlined text-sm">schedule</span> Pending
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($reg->checkins->count() > 0)
                            <span class="flex items-center gap-1 text-fpt-orange bg-primary-fixed/30 px-2 py-1 rounded w-fit text-xs font-bold">
                                <span class="material-symbols-outlined text-sm">how_to_reg</span> Checked in ({{ $reg->checkins->count() }})
                            </span>
                            <span class="block text-xs text-text-muted mt-1">{{ $reg->checkins->sortByDesc('checked_in_at')->first()->checked_in_at->format('H:i, M d') }}</span>
                        @else
                            <span class="flex items-center gap-1 text-gray-500 bg-gray-100 px-2 py-1 rounded w-fit text-xs font-bold">
                                <span class="material-symbols-outlined text-sm">cancel</span> No
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-body-sm text-text-muted">
                        {{ $reg->created_at->format('M d, Y - H:i') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="p-12 text-center text-text-muted">
        <span class="material-symbols-outlined text-4xl mb-2">person_off</span>
        <p>No one has registered for this event yet.</p>
    </div>
    @endif
</section>

@endsection
