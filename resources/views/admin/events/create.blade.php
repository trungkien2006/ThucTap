<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Event Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Event Date -->
                            <div>
                                <x-input-label for="event_date" :value="__('Event Date & Time')" />
                                <x-text-input id="event_date" class="block mt-1 w-full" type="datetime-local" name="event_date" :value="old('event_date')" required />
                                <x-input-error :messages="$errors->get('event_date')" class="mt-2" />
                            </div>

                            <!-- Location -->
                            <div>
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <!-- Event Type -->
                            <div>
                                <x-input-label for="event_type" :value="__('Event Type')" />
                                <select id="event_type" name="event_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="conference">Conference</option>
                                    <option value="workshop">Workshop</option>
                                    <option value="seminar">Seminar</option>
                                    <option value="cultural">Cultural</option>
                                    <option value="sports">Sports</option>
                                    <option value="orientation">Orientation</option>
                                    <option value="other">Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('event_type')" class="mt-2" />
                            </div>

                            <!-- Academic Year -->
                            <div>
                                <x-input-label for="academic_year" :value="__('Academic Year (Optional)')" />
                                <x-text-input id="academic_year" class="block mt-1 w-full" type="text" name="academic_year" :value="old('academic_year')" placeholder="e.g. 2025-2026" />
                                <x-input-error :messages="$errors->get('academic_year')" class="mt-2" />
                            </div>

                            <!-- Semester -->
                            <div>
                                <x-input-label for="semester" :value="__('Semester (Optional)')" />
                                <select id="semester" name="semester" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">None</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                </select>
                                <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Max Attendees -->
                        <div class="mb-4 w-1/3">
                            <x-input-label for="max_attendees" :value="__('Maximum Attendees (Leave blank for unlimited)')" />
                            <x-text-input id="max_attendees" class="block mt-1 w-full" type="number" name="max_attendees" :value="old('max_attendees')" />
                            <x-input-error :messages="$errors->get('max_attendees')" class="mt-2" />
                        </div>

                        <!-- Banner Image -->
                        <div class="mb-6">
                            <x-input-label for="banner_image" :value="__('Banner Image')" />
                            <input type="file" id="banner_image" name="banner_image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.events.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                            <x-primary-button>
                                {{ __('Create Event') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
