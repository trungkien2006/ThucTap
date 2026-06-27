<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UniEvent — Nền tảng sự kiện học đường')</title>
    <meta name="description" content="@yield('meta_description', 'Khám phá, lưu giữ và sống lại những khoảnh khắc đáng nhớ của các sự kiện học đường qua trải nghiệm điện ảnh.')">
    
    <!-- Alpine.js is loaded via Vite (app.js) -->
    <!-- AOS CSS for scroll animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&family=Be+Vietnam+Pro:wght@400;600;700&family=Charm:wght@400;700&family=Montserrat:wght@400;600;700&family=Pacifico&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Rowdies:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="frontend-body antialiased bg-paper text-ink relative" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 40)">
    
    @php $isHome = request()->routeIs('home'); @endphp
    <!-- Header -->
    <header 
        class="fixed inset-x-0 top-0 z-50 transition-all duration-500 {{ !$isHome ? 'backdrop-blur-xl border-b shadow-sm' : '' }}"
        {!! $isHome ? ":class=\"scrolled ? 'backdrop-blur-xl border-b shadow-sm' : 'bg-transparent'\"" : "" !!}
        style="{{ !$isHome ? 'background:rgba(255,248,208,0.97);border-color:rgba(232,200,74,0.5);' : '' }}"
        {!! $isHome ? ":style=\"scrolled ? 'background:rgba(255,248,208,0.97);border-color:rgba(232,200,74,0.5);' : ''\"" : "" !!}
        x-data="{ mobileOpen: false, megaMenuOpen: false }"
    >
        <div class="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-5 lg:px-10 relative">
            <a href="{{ route('home') }}#top" class="group flex items-center gap-2">
                <span class="font-['Barlow'] text-2xl font-black uppercase tracking-tight transition-colors {{ !$isHome ? 'text-[#1C1410]' : '' }}" {!! $isHome ? ":class=\"scrolled ? 'text-[#1C1410]' : 'text-white'\"" : "" !!}>
                    Uni<span style="color:#E8C84A;">Event</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 lg:flex absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                <a href="{{ route('home') }}#top" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ !$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : '' }}"
                   {!! $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : "" !!}>
                    Trang chủ
                </a>
                
                <div class="relative" @mouseenter="megaMenuOpen = true" @mouseleave="megaMenuOpen = false">
                    <a href="{{ route('home') }}#events" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ !$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : '' }}"
                       {!! $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : "" !!}>
                        Sự kiện
                        <span class="ml-0.5 inline-block h-2 w-2 rounded-full" style="background:#07A0C3;"></span>
                    </a>
                    
                    <!-- Mega Menu -->
                    <div x-show="megaMenuOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute left-1/2 top-full z-50 mt-3 w-[640px] -translate-x-1/2"
                         style="display: none;">
                        <div class="overflow-hidden rounded-2xl p-3 shadow-[0_20px_60px_-20px_rgba(255,200,60,0.4)] backdrop-blur-xl"
                             style="background:rgba(255,248,208,0.98);border:1px solid rgba(232,200,74,0.4);">
                            <div class="grid grid-cols-2 gap-1">
                                @if(isset($categories))
                                    @foreach($categories as $c)
                                    <a href="{{ isset($c['slug']) ? route('events.category', $c['slug']) : '#' }}" class="group flex items-start justify-between rounded-xl px-4 py-3 transition-colors"
                                       style="" onmouseover="this.style.background='rgba(255,227,129,0.3)'" onmouseout="this.style.background=''">
                                        <div>
                                            <div class="text-sm font-semibold text-[#1C1410]">{{ $c['name'] }}</div>
                                            <div class="text-xs text-[#7A6A52]">{{ $c['desc'] }}</div>
                                        </div>
                                        <i data-lucide="arrow-up-right" class="h-4 w-4 text-[#07A0C3] opacity-0 transition-all group-hover:opacity-100"></i>
                                    </a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-2 flex items-center justify-between rounded-xl px-4 py-3 text-[#1C1410] font-semibold" style="background:#FFE381;">
                                <span class="text-sm">Xem tất cả danh mục sự kiện</span>
                                <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('archive') }}" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ request()->routeIs('archive') ? 'text-[#07A0C3]' : (!$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : '') }}"
                   {!! $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : "" !!}>
                    Kho lưu trữ
                </a>
                <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ !$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : '' }}"
                   {!! $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : "" !!}>
                    Liên hệ
                </a>
            </nav>

            <div class="hidden lg:block">
                <a href="{{ route('home') }}#events"
                   class="inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-bold text-[#1C1410] shadow-md transition-all hover:shadow-lg hover:scale-105"
                   style="background:#FFE381;">
                    Khám phá sự kiện
                    <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>

            <button @click="mobileOpen = !mobileOpen" class="lg:hidden transition-colors {{ !$isHome ? 'text-ink' : '' }}" {!! $isHome ? ":class=\"scrolled ? 'text-ink' : 'text-white'\"" : "" !!} aria-label="Menu">
                <i data-lucide="menu" x-show="!mobileOpen"></i>
                <i data-lucide="x" x-show="mobileOpen" style="display: none;"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-screen"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 max-h-screen"
             x-transition:leave-end="opacity-0 max-h-0"
             class="lg:hidden overflow-hidden bg-white border-t border-gray-100"
             style="display: none;">
            <nav class="flex flex-col px-6 py-4 space-y-4">
                <a href="{{ route('home') }}#top" class="text-lg font-medium text-[#1C1410] hover:text-[#07A0C3]" @click="mobileOpen = false">Trang chủ</a>
                <a href="{{ route('home') }}#events" class="text-lg font-medium text-[#1C1410] hover:text-[#07A0C3]" @click="mobileOpen = false">Sự kiện</a>
                <div class="pl-4 border-l-2 border-gray-100 flex flex-col gap-3">
                    @if(isset($categories))
                        @foreach($categories as $c)
                            <a href="{{ isset($c['slug']) ? route('events.category', $c['slug']) : '#' }}" class="text-sm text-[#7A6A52] hover:text-[#07A0C3]" @click="mobileOpen = false">{{ $c['name'] }}</a>
                        @endforeach
                    @endif
                </div>
                <a href="{{ route('archive') }}" class="text-lg font-medium text-[#1C1410] hover:text-[#07A0C3]" @click="mobileOpen = false">Kho lưu trữ</a>
                <a href="{{ route('home') }}#contact" class="text-lg font-medium text-[#1C1410] hover:text-[#07A0C3]" @click="mobileOpen = false">Liên hệ</a>
            </nav>
        </div>
    </header>

    <main class="w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative bg-[#1C1410] pt-24 pb-12 overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-20 pointer-events-none" style="background-image:url('{{ asset('images/frontend/footer-bg.png') }}'); background-size: cover; background-position: center;"></div>
        <div class="mx-auto max-w-[1400px] px-6 lg:px-10 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-16">
                <!-- Brand Info -->
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}#top" class="inline-block mb-6">
                        <span class="font-['Barlow'] text-3xl font-black uppercase tracking-tight text-white">
                            Uni<span style="color:#E8C84A;">Event</span>
                        </span>
                    </a>
                    <p class="text-white/60 text-sm leading-relaxed mb-6 max-w-xs">
                        Nền tảng quản lý và trải nghiệm sự kiện học đường hàng đầu, kết nối sinh viên và kiến tạo kỷ niệm đáng nhớ.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center bg-white/5 hover:bg-[#E8C84A] hover:text-[#1C1410] text-white transition-all">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center bg-white/5 hover:bg-[#E8C84A] hover:text-[#1C1410] text-white transition-all">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center bg-white/5 hover:bg-[#E8C84A] hover:text-[#1C1410] text-white transition-all">
                            <i data-lucide="youtube" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg tracking-wide uppercase font-['Barlow']">Khám Phá</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}#events" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Sự kiện nổi bật</a></li>
                        <li><a href="{{ route('archive') }}" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Kho lưu trữ</a></li>
                        <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Hướng dẫn tham gia</a></li>
                        <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Câu hỏi thường gặp</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg tracking-wide uppercase font-['Barlow']">Danh Mục</h4>
                    <ul class="space-y-4">
                        @if(isset($categories) && count($categories) > 0)
                            @foreach(array_slice($categories, 0, 4) as $c)
                            <li><a href="{{ isset($c['slug']) ? route('events.category', $c['slug']) : '#' }}" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> {{ $c['name'] }}</a></li>
                            @endforeach
                        @else
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Workshop</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Hội thảo</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Thể thao</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Văn hóa nghệ thuật</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Contact -->
                <div id="contact">
                    <h4 class="text-white font-bold mb-6 text-lg tracking-wide uppercase font-['Barlow']">Liên Hệ</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-[#E8C84A] shrink-0 mt-0.5"></i>
                            <span class="text-white/60 text-sm leading-relaxed">Văn phòng Đoàn Thanh niên - Hội Sinh viên, Tòa nhà Trung tâm</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-5 h-5 text-[#E8C84A] shrink-0"></i>
                            <a href="tel:0123456789" class="text-white/60 hover:text-white text-sm transition-colors">0123.456.789</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-5 h-5 text-[#E8C84A] shrink-0"></i>
                            <a href="mailto:contact@unievent.edu.vn" class="text-white/60 hover:text-white text-sm transition-colors">contact@unievent.edu.vn</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-white/40 text-sm">
                    &copy; 2026 UniEvent. Bản quyền thuộc về CLB Tin học - Đoàn Thanh niên.
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-white/40 hover:text-white text-sm transition-colors">Điều khoản</a>
                    <a href="#" class="text-white/40 hover:text-white text-sm transition-colors">Bảo mật</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            AOS.init({
                once: true,
                offset: 50,
                duration: 800,
                easing: 'ease-out-cubic',
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
