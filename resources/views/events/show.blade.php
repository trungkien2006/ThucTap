<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $event->title }} - FPT Polytechnic</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

    <!-- Navbar -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-fpt-orange flex items-center gap-2">
                        <svg class="w-6 h-6 text-fpt-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        FPT <span class="text-fpt-blue">Polytechnic</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Banner -->
    <div class="w-full bg-fpt-blue h-64 md:h-96 relative">
        @if($event->banner_image)
            <img src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover opacity-60">
        @else
            <div class="w-full h-full bg-fpt-blue flex items-center justify-center">
                <span class="text-white opacity-50 text-xl">Event Banner</span>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-fpt-blue to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
                <span class="px-3 py-1 bg-fpt-orange text-white text-sm font-bold rounded-md uppercase tracking-wider mb-4 inline-block">
                    {{ $event->event_type }}
                </span>
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-2">{{ $event->title }}</h1>
                <div class="flex flex-wrap items-center text-blue-100 gap-4 mt-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $event->event_date->format('l, d/m/Y H:i') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $event->location }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        {{ $event->views_count }} lượt xem
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
                    <h2 class="text-2xl font-bold text-fpt-blue mb-4 pb-2 border-b border-gray-100">Thông tin sự kiện</h2>
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>

                @if($event->schedule && is_array($event->schedule))
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
                    <h2 class="text-2xl font-bold text-fpt-blue mb-4 pb-2 border-b border-gray-100">Lịch trình</h2>
                    <div class="space-y-4">
                        @foreach($event->schedule as $item)
                        <div class="flex border-l-4 border-fpt-orange pl-4">
                            <div class="font-bold w-24 text-gray-900">{{ $item['time'] ?? '' }}</div>
                            <div class="flex-1 text-gray-700">{{ $item['activity'] ?? '' }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Registration Box -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-fpt-orange p-6 sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Đăng ký tham gia</h3>
                    
                    @if($event->registration_open)
                        <div class="mb-6 space-y-3 text-sm text-gray-600 border-b border-gray-100 pb-6">
                            @if($event->max_attendees)
                                <div class="flex justify-between">
                                    <span>Số lượng giới hạn:</span>
                                    <span class="font-semibold text-gray-900">{{ $event->max_attendees }} người</span>
                                </div>
                            @endif
                            <div class="flex justify-between">
                                <span>Trạng thái:</span>
                                <span class="font-semibold text-green-600">Đang mở đăng ký</span>
                            </div>
                        </div>
                        <a href="#" class="block w-full py-3 px-4 bg-fpt-orange text-white text-center font-bold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-fpt-orange transition-colors">
                            ĐĂNG KÝ NGAY
                        </a>
                        <p class="text-xs text-center text-gray-500 mt-4">
                            Mã QR Check-in sẽ được gửi qua email sau khi đăng ký thành công.
                        </p>
                    @else
                        <div class="bg-red-50 text-red-700 p-4 rounded-md mb-4 border border-red-100 text-center font-medium">
                            Đã đóng đăng ký
                        </div>
                        <button disabled class="block w-full py-3 px-4 bg-gray-300 text-gray-500 text-center font-bold rounded-md cursor-not-allowed">
                            KHÔNG THỂ ĐĂNG KÝ
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12 border-t border-fpt-orange border-t-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <span class="text-2xl font-bold text-fpt-orange">FPT</span> <span class="text-xl text-white">Polytechnic</span>
                <p class="text-gray-400 text-sm mt-2">&copy; {{ date('Y') }} Event Page Maker.</p>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white">Giới thiệu</a>
                <a href="#" class="text-gray-400 hover:text-white">Liên hệ</a>
            </div>
        </div>
    </footer>

</body>
</html>
