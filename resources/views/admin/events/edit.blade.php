@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start mt-4">
    <!-- Left Panel: Context -->
    <aside class="lg:col-span-4 space-y-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/30">
            <h2 class="font-headline-lg text-headline-lg text-deep-navy mb-6">Edit Event</h2>
            <p class="font-body-md text-body-md text-text-muted mb-8">Update your event details. Changes will reflect immediately on the public page if the event is published.</p>
            
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-fpt-orange text-pure-white flex items-center justify-center font-bold"><span class="material-symbols-outlined text-sm">edit</span></div>
                    <div>
                        <p class="font-label-lg text-label-lg text-fpt-orange">Current Status</p>
                        <p class="font-body-md text-body-md font-semibold text-deep-navy">{{ ucfirst($event->status) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 border-t border-outline-variant/30 pt-6">
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 border border-red-500 text-red-500 rounded-lg hover:bg-red-50 transition-colors flex justify-center items-center gap-2 font-bold">
                        <span class="material-symbols-outlined">delete</span> Delete Event
                    </button>
                </form>
            </div>
        </div>

        @if($event->banner_image)
        <div class="relative overflow-hidden rounded-xl h-64 border border-outline-variant/30 shadow-sm">
            <img src="{{ Storage::url($event->banner_image) }}" alt="Banner" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-deep-navy/80 to-transparent flex items-end p-6">
                <span class="font-label-lg text-pure-white">Current Banner Image</span>
            </div>
        </div>
        @endif
    </aside>

    <!-- Right Panel: Form Content -->
    <section class="lg:col-span-8">
        <div class="bg-surface-container-lowest p-8 md:p-12 rounded-xl shadow-sm border border-outline-variant/30">
            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="space-y-2">
                    <label class="font-label-lg text-label-lg text-on-surface-variant" for="title">Event Title <span class="text-red-500">*</span></label>
                    <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="title" name="title" value="{{ old('title', $event->title) }}" required type="text"/>
                    @error('title') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Type & Slug -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="event_type">Event Type <span class="text-red-500">*</span></label>
                        <select class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="event_type" name="event_type" required>
                            <option value="workshop" {{ old('event_type', $event->event_type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="seminar" {{ old('event_type', $event->event_type) == 'seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="conference" {{ old('event_type', $event->event_type) == 'conference' ? 'selected' : '' }}>Conference</option>
                            <option value="cultural" {{ old('event_type', $event->event_type) == 'cultural' ? 'selected' : '' }}>Cultural Event</option>
                            <option value="sports" {{ old('event_type', $event->event_type) == 'sports' ? 'selected' : '' }}>Sports Event</option>
                            <option value="other" {{ old('event_type', $event->event_type) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('event_type') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="slug">URL Slug <span class="text-red-500">*</span></label>
                        <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="slug" name="slug" value="{{ old('slug', $event->slug) }}" required type="text"/>
                        @error('slug') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Date & Location -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="event_date">Date & Time <span class="text-red-500">*</span></label>
                        <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required type="datetime-local"/>
                        @error('event_date') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="location">Location / Venue <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="location" name="location" value="{{ old('location', $event->location) }}" required type="text"/>
                            <span class="material-symbols-outlined absolute left-3 top-3 text-on-surface-variant">location_on</span>
                        </div>
                        @error('location') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="font-label-lg text-label-lg text-on-surface-variant" for="description">Description <span class="text-red-500">*</span></label>
                    <textarea class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="description" name="description" rows="6" required>{{ old('description', $event->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Banner Image & Max Attendees -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="banner_image">New Banner Image</label>
                        <input class="w-full px-4 py-2 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="banner_image" name="banner_image" type="file" accept="image/*"/>
                        <p class="text-xs text-text-muted mt-1">Leave blank to keep current image</p>
                        @error('banner_image') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="max_attendees">Max Attendees (Optional)</label>
                        <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="max_attendees" name="max_attendees" value="{{ old('max_attendees', $event->max_attendees) }}" type="number" min="1"/>
                        @error('max_attendees') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter mt-4">
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="status">Publication Status <span class="text-red-500">*</span></label>
                        <select class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="status" name="status" required>
                            <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                            <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published (Visible to public)</option>
                            <option value="archived" {{ old('status', $event->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2 flex items-center pt-6">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="registration_open" value="1" {{ old('registration_open', $event->registration_open) ? 'checked' : '' }} class="rounded border-gray-300 text-fpt-orange focus:ring-fpt-orange">
                            <span class="font-label-lg text-label-lg text-on-surface-variant">Registration is Open</span>
                        </label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-8 flex items-center justify-between border-t border-outline-variant/30">
                    <a href="{{ route('admin.events.index') }}" class="px-6 py-3 font-label-lg text-label-lg text-deep-navy border border-deep-navy rounded-lg hover:bg-deep-navy/5 transition-all">
                        Cancel
                    </a>
                    <button class="px-10 py-3 bg-fpt-orange text-pure-white font-label-lg text-label-lg rounded-lg shadow-lg shadow-fpt-orange/20 hover:brightness-110 transition-all flex items-center gap-2" type="submit">
                        Save Changes
                        <span class="material-symbols-outlined">save</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
