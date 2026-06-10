<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event: ') }} {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Event Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $event->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description', $event->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Event Date -->
                            <div>
                                <x-input-label for="event_date" :value="__('Event Date & Time')" />
                                <x-text-input id="event_date" class="block mt-1 w-full" type="datetime-local" name="event_date" :value="old('event_date', $event->event_date ? $event->event_date->format('Y-m-d\TH:i') : '')" required />
                                <x-input-error :messages="$errors->get('event_date')" class="mt-2" />
                            </div>

                            <!-- Location -->
                            <div>
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $event->location)" required />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <!-- Event Type -->
                            <div>
                                <x-input-label for="event_type" :value="__('Event Type')" />
                                <select id="event_type" name="event_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="conference" {{ old('event_type', $event->event_type) == 'conference' ? 'selected' : '' }}>Conference</option>
                                    <option value="workshop" {{ old('event_type', $event->event_type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                    <option value="seminar" {{ old('event_type', $event->event_type) == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                    <option value="cultural" {{ old('event_type', $event->event_type) == 'cultural' ? 'selected' : '' }}>Cultural</option>
                                    <option value="sports" {{ old('event_type', $event->event_type) == 'sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="orientation" {{ old('event_type', $event->event_type) == 'orientation' ? 'selected' : '' }}>Orientation</option>
                                    <option value="other" {{ old('event_type', $event->event_type) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('event_type')" class="mt-2" />
                            </div>

                            <!-- Academic Year -->
                            <div>
                                <x-input-label for="academic_year" :value="__('Academic Year')" />
                                <x-text-input id="academic_year" class="block mt-1 w-full" type="text" name="academic_year" :value="old('academic_year', $event->academic_year)" />
                                <x-input-error :messages="$errors->get('academic_year')" class="mt-2" />
                            </div>

                            <!-- Semester -->
                            <div>
                                <x-input-label for="semester" :value="__('Semester')" />
                                <select id="semester" name="semester" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">None</option>
                                    <option value="1" {{ old('semester', $event->semester) == '1' ? 'selected' : '' }}>Semester 1</option>
                                    <option value="2" {{ old('semester', $event->semester) == '2' ? 'selected' : '' }}>Semester 2</option>
                                </select>
                                <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Max Attendees -->
                        <div class="mb-4 w-1/3">
                            <x-input-label for="max_attendees" :value="__('Max Attendees')" />
                            <x-text-input id="max_attendees" class="block mt-1 w-full" type="number" name="max_attendees" :value="old('max_attendees', $event->max_attendees)" />
                            <x-input-error :messages="$errors->get('max_attendees')" class="mt-2" />
                        </div>

                        <!-- Status & Registration Toggles -->
                        <div class="flex items-center gap-6 mb-6 pt-4 border-t border-gray-200">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_published" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('is_published', $event->is_published) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Publish Event to Homepage') }}</span>
                            </label>

                            <label class="inline-flex items-center">
                                <input type="checkbox" name="registration_open" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('registration_open', $event->registration_open) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Registration Open') }}</span>
                            </label>
                        </div>

                        <!-- Banner Image -->
                        <div class="mb-6">
                            <x-input-label for="banner_image" :value="__('Banner Image')" />
                            @if($event->banner_image)
                                <div class="mt-2 mb-2">
                                    <img src="{{ Storage::url($event->banner_image) }}" alt="Banner" class="h-32 object-cover rounded">
                                    <p class="text-sm text-gray-500 mt-1">Upload a new image to replace the current banner.</p>
                                </div>
                            @endif
                            <input type="file" id="banner_image" name="banner_image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.events.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                            <x-primary-button>
                                {{ __('Update Event') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
