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
        :class="scrolled ? 'bg-paper/85 backdrop-blur-xl border-b border-outline-variant/60' : 'bg-transparent'"
        x-data="{ mobileOpen: false, megaMenuOpen: false }"
    >
        <div class="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-5 lg:px-10">
            <a href="#top" class="group flex items-center gap-2">
                <span class="text-display text-2xl font-semibold tracking-tight transition-colors" :class="scrolled ? 'text-ink' : 'text-white'">
                    Uni<span class="italic text-azure">Event</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 lg:flex">
                <a href="#top" class="group inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-medium transition-colors" :class="scrolled ? 'text-ink-soft hover:text-ink' : 'text-white/80 hover:text-white'">
                    Trang chủ
                </a>
                
                <div class="relative" @mouseenter="megaMenuOpen = true" @mouseleave="megaMenuOpen = false">
                    <a href="#events" class="group inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-medium transition-colors" :class="scrolled ? 'text-ink-soft hover:text-ink' : 'text-white/80 hover:text-white'">
                        Sự kiện
                        <span class="ml-0.5 inline-block h-1 w-1 rounded-full transition-colors" :class="scrolled ? 'bg-azure' : 'bg-azure-glow'"></span>
                    </a>
                    
                    <!-- Mega Menu (Alpine transition) -->
                    <div x-show="megaMenuOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute left-1/2 top-full z-50 mt-3 w-[640px] -translate-x-1/2"
                         style="display: none;">
                        <div class="overflow-hidden rounded-2xl border border-outline-variant/60 bg-paper/95 p-3 shadow-[0_30px_80px_-30px_rgba(20,40,90,0.35)] backdrop-blur-xl">
                            <div class="grid grid-cols-2 gap-1">
                                @if(isset($categories))
                                    @foreach($categories as $c)
                                    <a href="#events" class="group flex items-start justify-between rounded-xl px-4 py-3 transition-colors hover:bg-surface-container">
                                        <div>
                                            <div class="text-sm font-semibold text-ink">{{ $c['name'] }}</div>
                                            <div class="text-xs text-ink-soft">{{ $c['desc'] }}</div>
                                        </div>
                                        <i data-lucide="arrow-up-right" class="h-4 w-4 translate-y-0.5 text-ink-soft opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100"></i>
                                    </a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-2 flex items-center justify-between rounded-xl bg-gradient-to-r from-azure-deep to-azure px-4 py-3 text-white">
                                <span class="text-sm">Xem tất cả danh mục sự kiện</span>
                                <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#archive" class="group inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-medium transition-colors" :class="scrolled ? 'text-ink-soft hover:text-ink' : 'text-white/80 hover:text-white'">
                    Kho lưu trữ
                </a>
                <a href="#contact" class="group inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-medium transition-colors" :class="scrolled ? 'text-ink-soft hover:text-ink' : 'text-white/80 hover:text-white'">
                    Liên hệ
                </a>
            </nav>

            <div class="hidden lg:block">
                <a href="#events" class="group inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-medium transition-all" :class="scrolled ? 'bg-ink text-paper hover:bg-azure-deep' : 'bg-white/10 text-white backdrop-blur-md hover:bg-white/20'">
                    Đăng ký sự kiện
                    <i data-lucide="arrow-up-right" class="h-4 w-4 transition-transform group-hover:rotate-45"></i>
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
             class="overflow-hidden bg-paper lg:hidden border-b border-outline-variant/60"
             style="display: none;">
            <div class="space-y-1 px-6 py-4">
                <a href="#top" class="block py-2 text-ink font-medium" @click="mobileOpen = false">Trang chủ</a>
                <a href="#events" class="block py-2 text-ink font-medium" @click="mobileOpen = false">Sự kiện</a>
                <a href="#archive" class="block py-2 text-ink font-medium" @click="mobileOpen = false">Kho lưu trữ</a>
                <a href="#contact" class="block py-2 text-ink font-medium" @click="mobileOpen = false">Liên hệ</a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="contact" class="relative bg-ink text-white">
        <div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-6 py-20 lg:grid-cols-4 lg:px-10">
            <div class="lg:col-span-2">
                <div class="text-display text-4xl">
                    Uni<span class="italic text-azure-glow">Event</span>
                </div>
                <p class="mt-4 max-w-sm text-sm text-white/60">
                    Nền tảng sự kiện học đường — nơi mỗi khoảnh khắc trở thành một ký ức điện ảnh.
                </p>
            </div>

            <div>
                <div class="text-xs uppercase tracking-[0.3em] text-azure-glow">Liên hệ</div>
                <ul class="mt-4 space-y-3 text-sm text-white/70">
                    <li class="inline-flex items-center gap-3"><i data-lucide="mail" class="h-4 w-4 text-azure"></i> hello@unievent.vn</li>
                    <li class="inline-flex items-center gap-3"><i data-lucide="phone" class="h-4 w-4 text-azure"></i> +84 28 3823 4567</li>
                    <li class="inline-flex items-center gap-3"><i data-lucide="map-pin" class="h-4 w-4 text-azure"></i> 268 Lý Thường Kiệt, Q.10, TP.HCM</li>
                </ul>
            </div>

            <div>
                <div class="text-xs uppercase tracking-[0.3em] text-azure-glow">Mạng xã hội</div>
                <div class="mt-4 flex gap-3">
                    <a href="#" class="grid h-10 w-10 place-items-center rounded-full bg-white/10 transition-colors hover:bg-azure">
                        <i data-lucide="instagram" class="h-4 w-4"></i>
                    </a>
                    <a href="#" class="grid h-10 w-10 place-items-center rounded-full bg-white/10 transition-colors hover:bg-azure">
                        <i data-lucide="facebook" class="h-4 w-4"></i>
                    </a>
                    <a href="#" class="grid h-10 w-10 place-items-center rounded-full bg-white/10 transition-colors hover:bg-azure">
                        <i data-lucide="youtube" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 py-6 text-center text-xs text-white/40">
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
