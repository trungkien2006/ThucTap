@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-margin-mobile">
    <div class="max-w-xl w-full">
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/30 overflow-hidden relative text-center pb-8">
            
            @if($status === 'success')
                <!-- Success Header -->
                <div class="h-32 bg-green-500 relative overflow-hidden flex items-center justify-center">
                    <div class="absolute inset-0 opacity-20">
                        <span class="material-symbols-outlined text-[120px] text-pure-white absolute -right-10 -bottom-10 rotate-12" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    </div>
                    <div class="w-16 h-16 bg-pure-white rounded-full flex items-center justify-center shadow-lg relative z-10">
                        <span class="material-symbols-outlined text-green-500 text-4xl font-bold" data-icon="check">check</span>
                    </div>
                </div>
                <div class="pt-8 px-8">
                    <h1 class="font-headline-lg text-headline-lg text-green-600 mb-2">{{ $message }}</h1>
                </div>
            @elseif($status === 'already_checked_in')
                <!-- Warning Header -->
                <div class="h-32 bg-fpt-orange relative overflow-hidden flex items-center justify-center">
                    <div class="absolute inset-0 opacity-20">
                        <span class="material-symbols-outlined text-[120px] text-pure-white absolute -right-10 -bottom-10 rotate-12" style="font-variation-settings: 'FILL' 1;">history</span>
                    </div>
                    <div class="w-16 h-16 bg-pure-white rounded-full flex items-center justify-center shadow-lg relative z-10">
                        <span class="material-symbols-outlined text-fpt-orange text-4xl font-bold" data-icon="info">info</span>
                    </div>
                </div>
                <div class="pt-8 px-8">
                    <h1 class="font-headline-lg text-headline-lg text-fpt-orange mb-2">{{ $message }}</h1>
                </div>
            @else
                <!-- Error Header -->
                <div class="h-32 bg-red-500 relative overflow-hidden flex items-center justify-center">
                    <div class="absolute inset-0 opacity-20">
                        <span class="material-symbols-outlined text-[120px] text-pure-white absolute -right-10 -bottom-10 rotate-12" style="font-variation-settings: 'FILL' 1;">error</span>
                    </div>
                    <div class="w-16 h-16 bg-pure-white rounded-full flex items-center justify-center shadow-lg relative z-10">
                        <span class="material-symbols-outlined text-red-500 text-4xl font-bold" data-icon="close">close</span>
                    </div>
                </div>
                <div class="pt-8 px-8">
                    <h1 class="font-headline-lg text-headline-lg text-red-600 mb-2">{{ $message }}</h1>
                </div>
            @endif

            <div class="px-8 md:px-12 mt-6">
                <!-- Attendee Info Card -->
                <div class="bg-surface-gray rounded-xl p-6 border border-outline-variant/30 relative text-left">
                    <div class="mb-4">
                        <p class="font-label-sm text-label-sm text-text-muted uppercase tracking-wider mb-1">Attendee Name</p>
                        <p class="font-headline-md text-[20px] text-deep-navy font-bold">{{ $registration->full_name }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-t border-outline-variant pt-4">
                        <div>
                            <p class="font-label-sm text-label-sm text-text-muted uppercase mb-1">Student ID</p>
                            <p class="font-body-md text-body-md text-deep-navy font-semibold">{{ $registration->student_id ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="font-label-sm text-label-sm text-text-muted uppercase mb-1">Email</p>
                            <p class="font-body-md text-body-md text-deep-navy font-semibold truncate" title="{{ $registration->email }}">{{ $registration->email }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-label-sm text-label-sm text-text-muted uppercase mb-1">Event</p>
                            <p class="font-body-md text-body-md text-fpt-orange font-bold">{{ $registration->event->title }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('admin.events.show', $registration->event) }}" class="inline-flex w-full sm:w-auto px-6 py-3 bg-surface-container-high text-on-surface-variant font-label-lg text-label-lg rounded-lg hover:bg-surface-variant transition-all items-center justify-center gap-2">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Back to Event
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
