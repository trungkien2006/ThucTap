@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start mt-4">
    <!-- Left Panel: Context -->
    <aside class="lg:col-span-4 space-y-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/30">
            <h2 class="font-headline-lg text-headline-lg text-deep-navy mb-6">Create New Event</h2>
            <p class="font-body-md text-body-md text-text-muted mb-8">Launch your next campus activity. Fill in the essential details to start attracting attendees.</p>
            
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-fpt-orange text-pure-white flex items-center justify-center font-bold">1</div>
                    <div>
                        <p class="font-label-lg text-label-lg text-fpt-orange">Step 1</p>
                        <p class="font-body-md text-body-md font-semibold text-deep-navy">Basic Information</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 opacity-50">
                    <div class="w-10 h-10 rounded-full border-2 border-outline flex items-center justify-center font-bold">2</div>
                    <div>
                        <p class="font-label-lg text-label-lg">Step 2</p>
                        <p class="font-body-md text-body-md font-semibold">Publish & Share</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden bg-deep-navy rounded-xl p-8 text-pure-white shadow-xl">
            <div class="relative z-10">
                <span class="material-symbols-outlined text-fpt-orange text-4xl mb-4">lightbulb</span>
                <h3 class="font-headline-md text-headline-md mb-2">Pro Tip</h3>
                <p class="font-body-sm text-body-sm text-pure-white/80">Events with clear, concise descriptions and high-quality banners see 45% higher student engagement rates.</p>
            </div>
            <div class="absolute -right-8 -bottom-8 opacity-10">
                <span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'FILL' 1;">event</span>
            </div>
        </div>
    </aside>

    <!-- Right Panel: Form Content -->
    <section class="lg:col-span-8">
        <div class="bg-surface-container-lowest p-8 md:p-12 rounded-xl shadow-sm border border-outline-variant/30">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Title -->
                <div class="space-y-2">
                    <label class="font-label-lg text-label-lg text-on-surface-variant" for="title">Event Title <span class="text-red-500">*</span></label>
                    <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="title" name="title" value="{{ old('title') }}" required type="text" placeholder="e.g. FPT Tech Workshop 2024"/>
                    @error('title') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Type & Slug -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="event_type">Event Type <span class="text-red-500">*</span></label>
                        <select class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="event_type" name="event_type" required>
                            <option value="workshop" {{ old('event_type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="seminar" {{ old('event_type') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="conference" {{ old('event_type') == 'conference' ? 'selected' : '' }}>Conference</option>
                            <option value="cultural" {{ old('event_type') == 'cultural' ? 'selected' : '' }}>Cultural Event</option>
                            <option value="sports" {{ old('event_type') == 'sports' ? 'selected' : '' }}>Sports Event</option>
                            <option value="other" {{ old('event_type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('event_type') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="slug">URL Slug <span class="text-red-500">*</span></label>
                        <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="slug" name="slug" value="{{ old('slug') }}" required type="text" placeholder="e.g. tech-workshop-2024"/>
                        @error('slug') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Date & Location -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="event_date">Date & Time <span class="text-red-500">*</span></label>
                        <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="event_date" name="event_date" value="{{ old('event_date') }}" required type="datetime-local"/>
                        @error('event_date') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="location">Location / Venue <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="location" name="location" value="{{ old('location') }}" required type="text" placeholder="Campus Hall A or Virtual Link"/>
                            <span class="material-symbols-outlined absolute left-3 top-3 text-on-surface-variant">location_on</span>
                        </div>
                        @error('location') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="font-label-lg text-label-lg text-on-surface-variant" for="description">Description <span class="text-red-500">*</span></label>
                    <textarea class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="description" name="description" rows="6" required placeholder="Describe what makes this event special...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Banner Image & Max Attendees -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="banner_image">Banner Image</label>
                        <input class="w-full px-4 py-2 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="banner_image" name="banner_image" type="file" accept="image/*"/>
                        @error('banner_image') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-lg text-label-lg text-on-surface-variant" for="max_attendees">Max Attendees (Optional)</label>
                        <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-fpt-orange transition-all" id="max_attendees" name="max_attendees" value="{{ old('max_attendees') }}" type="number" min="1"/>
                        @error('max_attendees') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="flex items-center gap-2 mt-4">
                        <input type="checkbox" name="registration_open" value="1" {{ old('registration_open', true) ? 'checked' : '' }} class="rounded border-gray-300 text-fpt-orange focus:ring-fpt-orange">
                        <span class="font-label-lg text-label-lg text-on-surface-variant">Open for Registration immediately</span>
                    </label>
                </div>

                <!-- Form Actions -->
                <div class="pt-8 flex items-center justify-between border-t border-outline-variant/30">
                    <a href="{{ route('admin.events.index') }}" class="px-6 py-3 font-label-lg text-label-lg text-deep-navy border border-deep-navy rounded-lg hover:bg-deep-navy/5 transition-all">
                        Cancel
                    </a>
                    <button class="px-10 py-3 bg-fpt-orange text-pure-white font-label-lg text-label-lg rounded-lg shadow-lg shadow-fpt-orange/20 hover:brightness-110 transition-all flex items-center gap-2" type="submit">
                        Create Event
                        <span class="material-symbols-outlined">check</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
