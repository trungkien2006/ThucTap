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

    <!-- Footer — Premium Glassmorphism & FPT Orange/Jasmine accent -->
    <footer id="contact" class="relative text-white overflow-hidden" style="background: linear-gradient(to top, rgba(15, 10, 5, 0.55), rgba(28, 20, 16, 0.25)), url('{{ asset('bg-hanam.jpg') }}') center 80%/cover no-repeat;">
        <!-- Glowing Ambient Lights -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#F26F21] rounded-full mix-blend-screen filter blur-[120px] opacity-20 pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#FFE381] rounded-full mix-blend-screen filter blur-[120px] opacity-10 pointer-events-none"></div>

        <!-- Glowing Top Border -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#F26F21] via-[#FFE381] to-[#F26F21] shadow-[0_0_15px_rgba(255,227,129,0.5)]"></div>
        
        <div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-6 pt-24 pb-16 lg:grid-cols-12 lg:px-10 relative z-10">
            <!-- Brand Column -->
            <div class="lg:col-span-4" data-aos="fade-up" data-aos-duration="1000">
                <div class="font-['Barlow_Condensed'] text-5xl font-black uppercase tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-[#F26F21] to-[#FFE381] drop-shadow-lg">
                    FPT Polytechnic
                </div>
                <p class="mt-4 max-w-sm text-sm leading-relaxed" style="color:rgba(255,255,255,0.8);">
                    Thực học - Thực nghiệp.<br>
                    Nơi mỗi khoảnh khắc học đường trở thành một kỷ niệm đáng giá và hành trang vững chắc cho tương lai.
                </p>
            </div>

            <!-- Contact Column -->
            <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                <div class="text-xs font-bold uppercase tracking-[0.2em] text-[#FFE381] mb-6 flex items-center gap-2">
                    <span class="w-8 h-[1px] bg-[#FFE381]"></span> Thông tin liên hệ
                </div>
                <ul class="space-y-4 text-sm" style="color:rgba(255,255,255,0.8);">
                    <li class="flex items-start gap-4 group cursor-pointer transition-all duration-300 hover:text-white">
                        <div class="p-2 rounded-lg bg-white/5 border border-white/10 group-hover:bg-[#F26F21]/20 group-hover:border-[#F26F21]/50 transition-colors">
                            <i data-lucide="globe" class="h-4 w-4 text-[#FFE381] group-hover:text-[#F26F21]"></i>
                        </div>
                        <span class="mt-1.5 group-hover:translate-x-1 transition-transform">caodang.fpt.edu.vn</span>
                    </li>
                    <li class="flex items-start gap-4 group cursor-pointer transition-all duration-300 hover:text-white">
                        <div class="p-2 rounded-lg bg-white/5 border border-white/10 group-hover:bg-[#F26F21]/20 group-hover:border-[#F26F21]/50 transition-colors">
                            <i data-lucide="phone" class="h-4 w-4 text-[#FFE381] group-hover:text-[#F26F21]"></i>
                        </div>
                        <span class="mt-1.5 group-hover:translate-x-1 transition-transform">+84 24 7300 1955</span>
                    </li>
                    <li class="flex items-start gap-4 group cursor-pointer transition-all duration-300 hover:text-white">
                        <div class="p-2 rounded-lg bg-white/5 border border-white/10 group-hover:bg-[#F26F21]/20 group-hover:border-[#F26F21]/50 transition-colors">
                            <i data-lucide="map-pin" class="h-4 w-4 text-[#FFE381] group-hover:text-[#F26F21]"></i>
                        </div>
                        <span class="mt-1.5 leading-relaxed group-hover:translate-x-1 transition-transform">Tổ Hợp Giáo Dục FPT Unischool, Khu Đại Học Nam Cao, Hà Nam</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter & Social Column -->
            <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                <div class="text-xs font-bold uppercase tracking-[0.2em] text-[#FFE381] mb-6 flex items-center gap-2">
                    <span class="w-8 h-[1px] bg-[#FFE381]"></span> Kết nối với chúng tôi
                </div>
                
                <div class="flex gap-4">
                    <a href="#" class="grid h-12 w-12 place-items-center rounded-xl bg-white/5 border border-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_5px_15px_rgba(225,48,108,0.4)] hover:bg-gradient-to-br hover:from-[#833ab4] hover:via-[#fd1d1d] hover:to-[#fcb045] hover:border-transparent group">
                        <i data-lucide="instagram" class="h-5 w-5 text-white/70 group-hover:text-white"></i>
                    </a>
                    <a href="#" class="grid h-12 w-12 place-items-center rounded-xl bg-white/5 border border-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_5px_15px_rgba(24,119,242,0.4)] hover:bg-[#1877F2] hover:border-transparent group">
                        <i data-lucide="facebook" class="h-5 w-5 text-white/70 group-hover:text-white"></i>
                    </a>
                    <a href="#" class="grid h-12 w-12 place-items-center rounded-xl bg-white/5 border border-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_5px_15px_rgba(255,0,0,0.4)] hover:bg-[#FF0000] hover:border-transparent group">
                        <i data-lucide="youtube" class="h-5 w-5 text-white/70 group-hover:text-white"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative z-10 border-t border-white/10 py-6 text-center text-sm font-medium tracking-wide flex flex-col md:flex-row justify-center items-center gap-2" style="color:rgba(255,255,255,0.6);">
            <span>© 2026 FPT Polytechnic. All rights reserved.</span>
            <span class="hidden md:inline text-white/20">|</span>
            <span class="flex items-center gap-1">Designed with <i data-lucide="heart" class="h-3 w-3 text-red-500 fill-red-500 animate-pulse"></i> for Students</span>
        </div>
    </footer>an class="flex items-center gap-1">Designed with <i data-lucide="heart" class="h-3 w-3 text-red-500 fill-red-500 animate-pulse"></i> for Students</span>
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
