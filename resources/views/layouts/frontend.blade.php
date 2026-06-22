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

    @vite(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js'])
</head>
<body class="frontend-body antialiased bg-paper text-ink relative" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 40)">
    
    <!-- Header -->
    <header 
        class="fixed inset-x-0 top-0 z-50 transition-all duration-500"
        :class="scrolled ? 'backdrop-blur-xl border-b shadow-sm' : 'bg-transparent'"
        :style="scrolled ? 'background:rgba(255,248,208,0.97);border-color:rgba(232,200,74,0.5);' : ''"
        x-data="{ mobileOpen: false, megaMenuOpen: false }"
    >
        <div class="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-5 lg:px-10">
            <a href="#top" class="group flex items-center gap-2">
                <span class="font-['Barlow_Condensed'] text-2xl font-black uppercase tracking-tight transition-colors" :class="scrolled ? 'text-[#1C1410]' : 'text-white'">
                    Uni<span style="color:#E8C84A;">Event</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 lg:flex">
                <a href="#top" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors"
                   :class="scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'">
                    Trang chủ
                </a>
                
                <div class="relative" @mouseenter="megaMenuOpen = true" @mouseleave="megaMenuOpen = false">
                    <a href="#events" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors"
                       :class="scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'">
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
                                    <a href="#events" class="group flex items-start justify-between rounded-xl px-4 py-3 transition-colors"
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

                <a href="#archive" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors"
                   :class="scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'">
                    Kho lưu trữ
                </a>
                <a href="#contact" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors"
                   :class="scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'">
                    Liên hệ
                </a>
            </nav>

            <div class="hidden lg:block">
                <a href="#events"
                   class="inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-bold text-[#1C1410] shadow-md transition-all hover:shadow-lg hover:scale-105"
                   style="background:#FFE381;">
                    Khám phá sự kiện
                    <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>

            <button @click="mobileOpen = !mobileOpen" class="lg:hidden transition-colors" :class="scrolled ? 'text-ink' : 'text-white'" aria-label="Menu">
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
             class="overflow-hidden lg:hidden border-b"
             style="background:#FFF8D0;border-color:#E8C84A;display:none;">
            <div class="space-y-1 px-6 py-4">
                <a href="#top" class="block py-2 text-sm font-semibold text-[#1C1410]" @click="mobileOpen = false">Trang chủ</a>
                <a href="#events" class="block py-2 text-sm font-semibold text-[#1C1410]" @click="mobileOpen = false">Sự kiện</a>
                <a href="#archive" class="block py-2 text-sm font-semibold text-[#1C1410]" @click="mobileOpen = false">Kho lưu trữ</a>
                <a href="#contact" class="block py-2 text-sm font-semibold text-[#1C1410]" @click="mobileOpen = false">Liên hệ</a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer — ấm tối, Jasmine accent -->
    <footer id="contact" class="relative text-white" style="background: linear-gradient(to top, rgba(45,31,10,0.95), rgba(45,31,10,0.85)), url('{{ asset('images/frontend/footer-bg.png') }}') bottom/cover no-repeat;">
        <!-- Top border Jasmine -->
        <div class="h-1.5" style="background:#FFE381;"></div>
        <div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-6 pt-32 pb-24 lg:grid-cols-4 lg:px-10">
            <div class="lg:col-span-2">
                <div class="font-['Barlow_Condensed'] text-4xl font-black uppercase">
                    Uni<span style="color:#FFE381;">Event</span>
                </div>
                <p class="mt-4 max-w-sm text-sm" style="color:rgba(255,227,129,0.55);">
                    Nền tảng sự kiện học đường — nơi mỗi khoảnh khắc trở thành một ký ức điện ảnh.
                </p>
            </div>

            <div>
                <div class="text-xs font-bold uppercase tracking-[0.3em]" style="color:#FFE381;">Liên hệ</div>
                <ul class="mt-4 space-y-3 text-sm" style="color:rgba(255,255,255,0.65);">
                    <li class="flex items-center gap-3"><i data-lucide="mail" class="h-4 w-4" style="color:#07A0C3;"></i> hello@unievent.vn</li>
                    <li class="flex items-center gap-3"><i data-lucide="phone" class="h-4 w-4" style="color:#07A0C3;"></i> +84 28 3823 4567</li>
                    <li class="flex items-center gap-3"><i data-lucide="map-pin" class="h-4 w-4" style="color:#07A0C3;"></i> 268 Lý Thường Kiệt, Q.10, TP.HCM</li>
                </ul>
            </div>

            <div>
                <div class="text-xs font-bold uppercase tracking-[0.3em]" style="color:#FFE381;">Mạng xã hội</div>
                <div class="mt-4 flex gap-3">
                    <a href="#" class="grid h-10 w-10 place-items-center rounded-full transition-colors"
                       style="background:rgba(255,227,129,0.12);" onmouseover="this.style.background='#FFE381';this.style.color='#1C1410'" onmouseout="this.style.background='rgba(255,227,129,0.12)';this.style.color='white'">
                        <i data-lucide="instagram" class="h-4 w-4"></i>
                    </a>
                    <a href="#" class="grid h-10 w-10 place-items-center rounded-full transition-colors"
                       style="background:rgba(255,227,129,0.12);" onmouseover="this.style.background='#07A0C3';" onmouseout="this.style.background='rgba(255,227,129,0.12)';">
                        <i data-lucide="facebook" class="h-4 w-4"></i>
                    </a>
                    <a href="#" class="grid h-10 w-10 place-items-center rounded-full transition-colors"
                       style="background:rgba(255,227,129,0.12);" onmouseover="this.style.background='#04F06A';this.style.color='#1C1410'" onmouseout="this.style.background='rgba(255,227,129,0.12)';this.style.color='white'">
                        <i data-lucide="youtube" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t py-6 text-center text-xs" style="border-color:rgba(255,227,129,0.15);color:rgba(255,227,129,0.35);">
            © 2026 UniEvent. All rights reserved.
        </div>
    </footer>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            AOS.init({
                duration: 900,
                once: true,
                offset: 50,
                easing: 'ease-out-cubic'
            });
        });
    </script>
</body>
</html>
