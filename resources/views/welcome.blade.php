<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-لاً8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sự kiện - FPT Polytechnic</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    
    <!-- Navbar -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-fpt-orange">
                        FPT <span class="text-fpt-blue">Polytechnic</span>
                    </a>
                </div>
                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-fpt-blue font-medium hover:text-fpt-orange">Quản trị</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-fpt-blue font-medium hover:text-fpt-orange">Đăng nhập</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="bg-fpt-blue py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Cổng Thông Tin Sự Kiện Sinh Viên</h1>
            <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto">Tham gia các hoạt động ngoại khóa, hội thảo, chuyên đề và sự kiện văn hóa để phát triển kỹ năng toàn diện cùng FPT Polytechnic.</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white shadow-sm border-b border-gray-200 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 w-full">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Tìm kiếm sự kiện</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nhập tên sự kiện..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-fpt-orange focus:ring focus:ring-fpt-orange focus:ring-opacity-50">
                </div>
                
                <div class="w-full md:w-48">
                    <label for="event_type" class="block text-sm font-medium text-gray-700 mb-1">Loại sự kiện</label>
                    <select name="event_type" id="event_type" class="w-full border-gray-300 rounded-md shadow-sm focus:border-fpt-orange focus:ring focus:ring-fpt-orange focus:ring-opacity-50">
                        <option value="">Tất cả</option>
                        <option value="conference" {{ request('event_type') == 'conference' ? 'selected' : '' }}>Hội nghị</option>
                        <option value="workshop" {{ request('event_type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="seminar" {{ request('event_type') == 'seminar' ? 'selected' : '' }}>Chuyên đề</option>
                        <option value="cultural" {{ request('event_type') == 'cultural' ? 'selected' : '' }}>Văn hóa</option>
                        <option value="sports" {{ request('event_type') == 'sports' ? 'selected' : '' }}>Thể thao</option>
                        <option value="orientation" {{ request('event_type') == 'orientation' ? 'selected' : '' }}>Định hướng</option>
                        <option value="other" {{ request('event_type') == 'other' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>

                <div class="w-full md:w-32">
                    <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Kỳ học</label>
                    <select name="semester" id="semester" class="w-full border-gray-300 rounded-md shadow-sm focus:border-fpt-orange focus:ring focus:ring-fpt-orange focus:ring-opacity-50">
                        <option value="">Tất cả</option>
                        <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Kỳ 1</option>
                        <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Kỳ 2</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="w-full md:w-auto px-6 py-2 bg-fpt-orange text-white font-medium rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-fpt-orange transition-colors duration-200">
                        Lọc kết quả
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Events Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 flex flex-col">
                        @if($event->banner_image)
                            <img src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">Không có ảnh</span>
                            </div>
                        @endif
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <span class="px-2 py-1 bg-blue-50 text-fpt-blue text-xs font-semibold rounded-md uppercase tracking-wider">
                                    {{ $event->event_type }}
                                </span>
                                <span class="text-sm text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $event->event_date->format('d/m/Y') }}
                                </span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-2 leading-tight">
                                <a href="{{ route('events.show', $event->slug) }}" class="hover:text-fpt-orange transition-colors">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($event->description), 120) }}
                            </p>
                            
                            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                <div class="text-sm text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="truncate max-w-[150px]">{{ $event->location }}</span>
                                </div>
                                <a href="{{ route('events.show', $event->slug) }}" class="text-sm font-semibold text-fpt-orange hover:text-orange-700">
                                    Xem chi tiết &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $events->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Không tìm thấy sự kiện nào</h3>
                <p class="mt-1 text-gray-500">Hãy thử thay đổi điều kiện lọc hoặc tìm kiếm với từ khóa khác.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-fpt-orange font-medium hover:underline">Xóa bộ lọc</a>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12 border-t border-fpt-orange border-t-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <span class="text-2xl font-bold text-fpt-orange">FPT</span> <span class="text-xl text-white">Polytechnic</span>
                <p class="text-gray-400 text-sm mt-2">&copy; {{ date('Y') }} Event Page Maker. Thực tập sinh.</p>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white">Giới thiệu</a>
                <a href="#" class="text-gray-400 hover:text-white">Liên hệ</a>
                <a href="#" class="text-gray-400 hover:text-white">Quy chế</a>
            </div>
        </div>
    </footer>

</body>
</html>
