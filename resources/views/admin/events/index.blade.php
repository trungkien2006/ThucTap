@extends('layouts.app')

@section('header')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="font-headline-lg text-headline-lg text-deep-navy">Welcome back, {{ Auth::user()->name }}</h2>
        <p class="font-body-md text-body-md text-text-muted mt-1">Here's what's happening with your events today.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.events.create') }}" class="flex items-center gap-2 bg-fpt-orange text-pure-white font-label-lg px-4 py-2 rounded-lg hover:brightness-110 transition-all">
            <span class="material-symbols-outlined">add</span>
            <span>New Event</span>
        </a>
    </div>
</div>
@endsection

@section('content')

@php
    $totalRegistrations = 0;
    foreach($events as $e) {
        $totalRegistrations += $e->registrations()->count();
    }
    $activeEvents = $events->where('event_date', '>=', now())->count();
    $livePages = $events->where('status', 'published')->count();
@endphp

<!-- Bento Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter mb-12 mt-4">
    <!-- Total Registrations -->
    <div class="md:col-span-4 glass-card p-6 rounded-xl flex flex-col justify-between shadow-md hover:shadow-lg transition-all border-l-4 border-fpt-orange group">
        <div class="flex justify-between items-start">
            <div class="p-3 bg-primary-fixed/50 rounded-lg text-fpt-orange">
                <span class="material-symbols-outlined text-2xl" data-icon="groups">groups</span>
            </div>
        </div>
        <div class="mt-8">
            <h3 class="font-label-lg text-label-lg text-text-muted uppercase tracking-wider">Total Registrations</h3>
            <p class="font-display-lg text-display-lg text-deep-navy mt-2 group-hover:scale-105 origin-left transition-transform">{{ $totalRegistrations }}</p>
        </div>
    </div>
    
    <!-- Active Events -->
    <div class="md:col-span-4 glass-card p-6 rounded-xl flex flex-col justify-between shadow-md hover:shadow-lg transition-all border-l-4 border-secondary group">
        <div class="flex justify-between items-start">
            <div class="p-3 bg-secondary-fixed/50 rounded-lg text-secondary">
                <span class="material-symbols-outlined text-2xl" data-icon="event_available">event_available</span>
            </div>
        </div>
        <div class="mt-8">
            <h3 class="font-label-lg text-label-lg text-text-muted uppercase tracking-wider">Active Events</h3>
            <p class="font-display-lg text-display-lg text-deep-navy mt-2 group-hover:scale-105 origin-left transition-transform">{{ $activeEvents }}</p>
        </div>
    </div>
    
    <!-- Live Pages -->
    <div class="md:col-span-4 glass-card p-6 rounded-xl flex flex-col justify-between shadow-md hover:shadow-lg transition-all border-l-4 border-tertiary group">
        <div class="flex justify-between items-start">
            <div class="p-3 bg-tertiary-fixed/50 rounded-lg text-tertiary">
                <span class="material-symbols-outlined text-2xl" data-icon="sensors">sensors</span>
            </div>
            <span class="flex items-center gap-2">
                <span class="flex h-2 w-2 rounded-full bg-red-500 animate-pulse"></span>
                <span class="text-red-500 text-label-sm font-bold">LIVE</span>
            </span>
        </div>
        <div class="mt-8">
            <h3 class="font-label-lg text-label-lg text-text-muted uppercase tracking-wider">Published Events</h3>
            <p class="font-display-lg text-display-lg text-deep-navy mt-2 group-hover:scale-105 origin-left transition-transform">{{ $livePages }}</p>
        </div>
    </div>
</div>

<!-- Recent Events Section -->
<section class="bg-pure-white rounded-xl shadow-md border border-outline-variant overflow-hidden">
    <div class="px-8 py-6 border-b border-outline-variant flex justify-between items-center">
        <div>
            <h3 class="font-headline-md text-headline-md text-deep-navy">Recent Events</h3>
            <p class="font-body-sm text-body-sm text-text-muted">Manage your latest activity and drafts</p>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-surface-container-low">
                    <th class="px-8 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Event Name</th>
                    <th class="px-8 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Date</th>
                    <th class="px-8 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Status</th>
                    <th class="px-8 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Registrations</th>
                    <th class="px-8 py-4 font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @foreach($events as $event)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center overflow-hidden shrink-0">
                                @if($event->banner_image)
                                    <img src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-outline">image</span>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('admin.events.show', $event) }}" class="font-body-md text-body-md font-bold text-deep-navy hover:text-fpt-orange transition-colors">{{ $event->title }}</a>
                                <p class="font-body-sm text-body-sm text-text-muted">{{ Str::limit($event->location, 30) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-body-md text-text-muted">
                        {{ $event->event_date->format('M d, Y') }}<br>
                        <span class="text-sm">{{ $event->event_date->format('h:i A') }}</span>
                    </td>
                    <td class="px-8 py-5">
                        @if($event->status == 'published')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full font-label-sm text-label-sm font-bold border border-green-200">Published</span>
                        @else
                            <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full font-label-sm text-label-sm font-bold border border-outline-variant">Draft</span>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        @php
                            $regs = $event->registrations()->count();
                            $max = $event->max_attendees ?: 1; // avoid division by zero
                            $percent = $event->max_attendees ? min(100, round(($regs / $max) * 100)) : 100;
                        @endphp
                        <div class="flex items-center gap-2">
                            @if($event->max_attendees)
                                <div class="w-24 bg-surface-container-high h-2 rounded-full overflow-hidden">
                                    <div class="bg-fpt-orange h-full" style="width: {{ $percent }}%"></div>
                                </div>
                                <span class="text-body-sm font-bold">{{ $regs }}/{{ $event->max_attendees }}</span>
                            @else
                                <span class="text-body-sm font-bold">{{ $regs }} (No limit)</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.events.show', $event) }}" class="p-2 hover:bg-surface-container-high rounded-full text-fpt-orange transition-all" title="Manage/QR">
                                <span class="material-symbols-outlined">visibility</span>
                            </a>
                            <a href="{{ route('admin.events.edit', $event) }}" class="p-2 hover:bg-surface-container-high rounded-full text-on-surface-variant transition-all" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 hover:bg-red-50 rounded-full text-red-500 transition-all" title="Delete">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($events->hasPages())
    <div class="p-6 bg-surface-container-lowest border-t border-outline-variant">
        {{ $events->links() }}
    </div>
    @endif
    
    @if($events->count() == 0)
    <div class="p-12 text-center text-text-muted">
        <span class="material-symbols-outlined text-4xl mb-2">event_busy</span>
        <p>No events found. Click "New Event" to create one.</p>
    </div>
    @endif
</section>

@endsection
