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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&family=Be+Vietnam+Pro:wght@400;600;700&family=Charm:wght@400;700&family=Montserrat:wght@400;600;700&family=Pacifico&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Rowdies:wght@400;700&family=Barlow:wght@400;500;600;700;800;900&family=Barlow+Condensed:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- GSAP + ScrollTrigger -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

    @vite(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="frontend-body antialiased bg-paper text-ink relative" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 40)">
    
    @php 
        $isHome = request()->routeIs('home'); 
    @endphp
    <!-- Header -->
    <header 
        class="fixed inset-x-0 top-0 z-[100] transition-all duration-500 {{ !$isHome ? 'backdrop-blur-xl border-b shadow-sm' : '' }}"
        {!! $isHome ? ":class=\"scrolled ? 'backdrop-blur-xl border-b shadow-sm' : 'bg-transparent'\"" : "" !!}
        style="{{ !$isHome ? 'background:rgba(255,248,208,0.97);border-color:rgba(232,200,74,0.5);' : '' }}"
        {!! $isHome ? ":style=\"scrolled ? 'background:rgba(255,248,208,0.97);border-color:rgba(232,200,74,0.5);' : ''\"" : "" !!}
        x-data="{ mobileOpen: false, megaMenuOpen: false }"
    >
        <div class="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-5 lg:px-10 relative">
            <a href="{{ route('home') }}#top" class="group relative flex items-center h-8 min-w-[240px]" x-data="{ showUni: true }" x-init="setInterval(() => { showUni = !showUni }, 3000)">
                <style>
                    /* Smooth Top-to-Bottom Flow Transition */
                    @keyframes fluidIn {
                        0% { 
                            transform: translateY(-20px);
                            opacity: 0;
                        }
                        100% { 
                            transform: translateY(0);
                            opacity: 1;
                        }
                    }
                    @keyframes fluidOut {
                        0% { 
                            transform: translateY(0);
                            opacity: 1;
                        }
                        100% { 
                            transform: translateY(20px);
                            opacity: 0;
                        }
                    }
                    .fluid-in {
                        animation: fluidIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
                    }
                    .fluid-out {
                        animation: fluidOut 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
                    }
                </style>

                <!-- UniEvent Logo (Image + Fluid effect) -->
                <div 
                    class="absolute inset-y-0 left-0 flex items-center" 
                    x-show="showUni"
                    x-transition:enter="fluid-in"
                    x-transition:leave="fluid-out"
                    style="width: 350px;"
                >
                    <img src="{{ asset('images/unievent-logo.png') }}?v={{ time() }}" alt="UniEvent" style="height: 80px; width: auto; max-width: none; object-fit: contain; margin-left: -5px; filter: drop-shadow(0 4px 3px rgba(0,0,0,0.07));">
                </div>

                <!-- FPT Polytechnic Logo (Fluid effect) -->
                <div 
                    class="absolute inset-y-0 left-0 flex items-center" 
                    x-show="!showUni"
                    x-transition:enter="fluid-in"
                    x-transition:leave="fluid-out"
                    style="display: none; width: 350px;"
                >
                    <img src="{{ asset('images/fpt-polytechnic.png') }}?v={{ time() }}" alt="FPT Polytechnic" style="height: 110px; width: auto; max-width: none; object-fit: contain; margin-left: -20px; filter: drop-shadow(0 4px 3px rgba(0,0,0,0.07));">
                </div>
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
                                @php
                                    if(!isset($categories)) {
                                        $categories = \Illuminate\Support\Facades\Cache::remember('frontend_categories', 300, function () {
                                            $dbCategories = \App\Models\Category::where('type', 'event_type')->whereNotIn('name', ['Other', 'Khác'])->get();
                                            $vietnameseNames = [
                                                'Conference' => 'Hội nghị',
                                                'Workshop' => 'Hội thảo thực hành',
                                                'Seminar' => 'Hội thảo chuyên đề',
                                                'Cultural' => 'Văn hóa nghệ thuật',
                                                'Sports' => 'Thể thao',
                                                'Orientation' => 'Định hướng'
                                            ];
                                            return $dbCategories->map(function ($c) use ($vietnameseNames) {
                                                return [
                                                    'name' => $c->name,
                                                    'slug' => $c->slug,
                                                    'desc' => $vietnameseNames[$c->name] ?? 'Sự kiện'
                                                ];
                                            })->toArray();
                                        });
                                    }
                                @endphp
                                @if(isset($categories))
                                    @foreach($categories as $c)
                                    <a href="{{ isset($c['slug']) ? route('events.index', ['category' => $c['slug']]) : '#' }}" class="group flex items-start justify-between rounded-xl px-4 py-3 transition-colors"
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
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ request()->routeIs('contact') ? 'text-[#07A0C3]' : (!$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : '') }}"
                   {!! $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : "" !!}>
                    Liên hệ
                </a>
            </nav>

            <div class="hidden lg:block">
                <a href="{{ route('home') }}#events"
                   class="inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-bold text-[#1C1410] shadow-md transition-all hover:shadow-lg hover:scale-105"
                   style="background: #FFE381; border: 1px solid rgba(232,200,74,0.6);">
                    Khám phá ngay
                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>
            </div>

            <button class="lg:hidden text-[#1C1410] p-2" 
                    {!! $isHome ? ":class=\"scrolled ? 'text-[#1C1410]' : 'text-white'\"" : "" !!}
                    @click="mobileOpen = true">
                <i data-lucide="menu" class="h-6 w-6"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" style="display: none;" class="fixed inset-0 z-50 lg:hidden">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="mobileOpen = false"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"></div>
            
            <div class="absolute inset-y-0 right-0 w-full max-w-sm bg-[#FFFBEA] p-6 shadow-2xl flex flex-col"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full">
                
                <div class="flex items-center justify-between mb-8">
                    <span class="font-barlow text-2xl font-black uppercase tracking-tight text-[#1C1410]">
                        Uni<span style="color:#E8C84A;">Event</span>
                    </span>
                    <button @click="mobileOpen = false" class="p-2 text-[#7A6A52] hover:text-[#1C1410] bg-white rounded-full shadow-sm">
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>

                <nav class="flex flex-col gap-4">
                    <a href="{{ route('home') }}#top" @click="mobileOpen = false" class="flex items-center justify-between py-3 text-lg font-semibold text-[#1C1410] border-b border-[#E8C84A]/20">
                        Trang chủ
                        <i data-lucide="chevron-right" class="h-4 w-4 text-[#7A6A52]"></i>
                    </a>
                    
                    <div x-data="{ expanded: false }" class="border-b border-[#E8C84A]/20 pb-3">
                        <button @click="expanded = !expanded" class="flex w-full items-center justify-between py-3 text-lg font-semibold text-[#1C1410]">
                            Danh mục sự kiện
                            <i data-lucide="chevron-down" class="h-4 w-4 text-[#7A6A52] transition-transform" :class="expanded ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="expanded" class="grid grid-cols-1 gap-2 pt-2 pb-2 pl-4">
                            @if(isset($categories))
                                @foreach($categories as $c)
                                <a href="{{ isset($c['slug']) ? route('events.index', ['category' => $c['slug']]) : '#' }}" class="py-2 text-[#7A6A52] hover:text-[#07A0C3] font-medium" @click="mobileOpen = false">{{ $c['name'] }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('archive') }}" @click="mobileOpen = false" class="flex items-center justify-between py-3 text-lg font-semibold text-[#1C1410] border-b border-[#E8C84A]/20">
                        Kho lưu trữ
                        <i data-lucide="chevron-right" class="h-4 w-4 text-[#7A6A52]"></i>
                    </a>
                    <a href="{{ route('contact') }}" @click="mobileOpen = false" class="flex items-center justify-between py-3 text-lg font-semibold {{ request()->routeIs('contact') ? 'text-[#07A0C3]' : 'text-[#1C1410]' }} border-b border-[#E8C84A]/20">
                        Liên hệ
                        <i data-lucide="chevron-right" class="h-4 w-4 text-[#7A6A52]"></i>
                    </a>
                </nav>

                <div class="mt-auto pt-6">
                    <a href="{{ route('home') }}#events" @click="mobileOpen = false" class="flex w-full items-center justify-center gap-2 rounded-xl py-4 text-center text-lg font-bold text-[#1C1410] shadow-md transition-transform active:scale-95" style="background: #FFE381;">
                        Khám phá ngay
                        <i data-lucide="arrow-right" class="h-5 w-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative bg-[#1C1410] pt-24 pb-12 overflow-hidden" style="z-index: 70;">
        <div class="absolute inset-0 z-0 opacity-20 pointer-events-none" style="background-image:url('{{ asset('images/frontend/footer-bg.png') }}'); background-size: cover; background-position: center;"></div>
        <div class="mx-auto max-w-[1400px] px-6 lg:px-10 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-16">
                <!-- Brand Info -->
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}#top" class="inline-block mb-6">
                        <span class="font-barlow text-3xl font-black uppercase tracking-tight text-white">
                            Uni<span style="color:#E8C84A;">Event</span>
                        </span>
                    </a>
                    <p class="text-white/60 text-sm leading-relaxed mb-6 max-w-xs">
                        Nền tảng quản lý và trải nghiệm sự kiện học đường hàng đầu, kết nối sinh viên và kiến tạo kỷ niệm đáng nhớ.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="https://facebook.com/fpt.poly" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full flex items-center justify-center bg-white/5 hover:bg-[#E8C84A] hover:text-[#1C1410] text-white transition-all" title="Facebook">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                        </a>
                        <a href="https://caodang.fpt.edu.vn" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full flex items-center justify-center bg-white/5 hover:bg-[#E8C84A] hover:text-[#1C1410] text-white transition-all" title="Trang chủ">
                            <i data-lucide="globe" class="w-5 h-5"></i>
                        </a>
                        <a href="https://tiktok.com/@fpt.polytechnic.official" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full flex items-center justify-center bg-white/5 hover:bg-[#E8C84A] hover:text-[#1C1410] text-white transition-all" title="TikTok">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg tracking-wide uppercase font-barlow">Khám Phá</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}#master-wipe-anchor" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Sự kiện nổi bật</a></li>
                        <li><a href="{{ route('archive') }}" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Kho lưu trữ</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Liên hệ</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg tracking-wide uppercase font-barlow">Danh Mục</h4>
                    <ul class="space-y-4">
                        @if(isset($categories) && count($categories) > 0)
                            @foreach(array_slice($categories, 0, 6) as $c)
                            <li><a href="{{ isset($c['slug']) ? route('events.index', ['category' => $c['slug']]) : '#' }}" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> {{ $c['name'] }}</a></li>
                            @endforeach
                        @else
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Workshop</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Hội thảo</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Thể thao</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Văn hóa nghệ thuật</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Định hướng</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Hội nghị</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Contact -->
                <div id="contact">
                    <h4 class="text-white font-bold mb-6 text-lg tracking-wide uppercase font-barlow">Liên Hệ</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-[#E8C84A] shrink-0 mt-0.5"></i>
                            <span class="text-white/60 text-sm leading-relaxed">Toà Gamma, Tổ hợp Giáo dục FPT Unischool, Khu Đại học Nam Cao, Phường Hà Nam, Tỉnh Ninh Bình</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-5 h-5 text-[#E8C84A] shrink-0"></i>
                            <a href="tel:0911968213" class="text-white/60 hover:text-white text-sm transition-colors">0911 968 213</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-5 h-5 text-[#E8C84A] shrink-0"></i>
                            <a href="mailto:caodang@fpt.edu.vn" class="text-white/60 hover:text-white text-sm transition-colors">caodang@fpt.edu.vn</a>
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
    
    @if(request()->is('events/*') || request()->is('admin/events/*/preview*') || request()->is('admin/template-preview/*'))
        @include('components.event-fab-menu')
    @endif

@if(request()->routeIs('home'))
<!-- ========================================== -->
<!-- FALLING PARTICLES EFFECT                   -->
<!-- ========================================== -->
<style>
    .falling-particle {
        position: absolute;
        width: 4px;
        height: 12px;
        border-radius: 2px;
        pointer-events: none;
        background: #fff;
        box-shadow: 0 0 2px currentColor;
        z-index: 0;
        animation: fall linear forwards;
        will-change: transform, opacity;
    }
    @keyframes fall {
        0% { transform: translateY(0) rotate(var(--rot)); opacity: 0; }
        10% { opacity: 1; }
        80% { opacity: 1; }
        100% { transform: translateY(110vh) rotate(var(--rot)); opacity: 0; }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const isHome = document.querySelector('body').classList.contains('home-page') || window.location.pathname === '/';
        
        // Tạo các container rơi ở các section, TRỪ #spotlight (để không rơi trong banner)
        const targetSections = ['#events', '#featured-events-wrapper', '#archive-sticky-wrapper'];
        let fallContainers = [];
        
        if (isHome) {
            targetSections.forEach(selector => {
                const sec = document.querySelector(selector);
                if (sec) {
                    const c = document.createElement('div');
                    c.className = "falling-particles-layer pointer-events-none";
                    c.style.cssText = "position: absolute !important; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; overflow: hidden;";
                    sec.insertBefore(c, sec.firstChild);
                    fallContainers.push(c);
                }
            });
        }
        
        if (fallContainers.length === 0) return;
        
        const fallColors = ["#FFE381", "#07A0C3", "#04F06A", "#FF5722", "#E83A59"]; 
        const maxParticles = 15; // Giảm tối đa số lượng hạt rơi xuống còn 15 để siêu mượt
        
        function createFallingParticle() {
            if (document.hidden) return; 
            
            // Tìm các container đang hiển thị
            const visible = [];
            fallContainers.forEach(c => {
                const rect = c.parentElement.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    visible.push({ container: c, rect: rect });
                }
            });
            
            if (visible.length === 0) return;
            
            // Chọn ngẫu nhiên 1 container
            const target = visible[Math.floor(Math.random() * visible.length)];
            const activeContainer = target.container;
            const parentRect = target.rect;
            
            if (activeContainer.childElementCount > maxParticles) return;
            
            const p = document.createElement("div");
            p.classList.add("falling-particle");
            
            p.style.left = (Math.random() * 100) + "vw";
            p.style.color = fallColors[Math.floor(Math.random() * fallColors.length)];
            p.style.backgroundColor = p.style.color;
            p.style.setProperty('--rot', (Math.random() * 360) + "deg");
            
            const scale = Math.random() * 0.8 + 0.4;
            p.style.width = (4 * scale) + "px";
            p.style.height = (12 * scale) + "px";
            
            // Tính toán vị trí top tương đối so với vùng đang hiển thị của container
            const viewportTop = -parentRect.top;
            const startY = Math.max(0, viewportTop) - 20; 
            
            p.style.top = startY + "px";
            
            // CSS Animation thay vì JS để đảm bảo tương thích 100% mọi trình duyệt
            p.style.animationDuration = (Math.random() * 3 + 2) + "s";
            
            activeContainer.appendChild(p);
            
            setTimeout(() => {
                if (p.parentNode) p.remove();
            }, 6000);
        }
        
        setInterval(createFallingParticle, 400); // Rơi chậm và thưa hơn (400ms/hạt)
    });
</script>
<!-- ========================================== -->
<!-- RANDOM FIREWORKS EFFECT (ADDED SAFELY)     -->
<!-- ========================================== -->
<style>
    .firework-spark {
        position: absolute;
        width: 3px; 
        height: 15px; 
        border-radius: 50%;
        pointer-events: none;
        background: #fff !important; 
        box-shadow: 0 0 2px currentColor; 
        animation: explode 2s cubic-bezier(0.1, 1, 0.2, 1) forwards; 
        z-index: 0;
        will-change: transform, opacity;
    }
    @keyframes explode {
        0% { transform: translate(0, 0) rotate(var(--rot)) scale(1); opacity: 1; }
        60% { opacity: 1; }
        100% { transform: translate(var(--tx), var(--ty)) rotate(var(--rot)) scale(0); opacity: 0; }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fwColors = ["#FFE381", "#07A0C3", "#04F06A", "#FF5722", "#E83A59", "#FF00FF", "#00FFFF"]; 
        const isHome = document.querySelector('body').classList.contains('home-page') || window.location.pathname === '/';
        
        // Tạo các container pháo hoa ở mỗi section (BAO GỒM cả #spotlight)
        const targetSections = ['#spotlight', '#events', '#featured-events-wrapper', '#archive-sticky-wrapper'];
        let containers = [];
        
        if (isHome) {
            targetSections.forEach(selector => {
                const sec = document.querySelector(selector);
                if (sec) {
                    const c = document.createElement('div');
                    c.className = "fireworks-layer pointer-events-none";
                    c.style.cssText = "position: absolute !important; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; overflow: hidden;";
                    sec.insertBefore(c, sec.firstChild);
                    containers.push(c);
                }
            });
            
            // Đẩy ảnh sự kiện lên trên
            const catSec = document.getElementById('categories-section');
            if (catSec) catSec.style.background = 'transparent';
            
            document.querySelectorAll('.event-category-card, #featured-cards-viewport, #archive .group').forEach(el => {
                el.style.position = 'relative';
                el.style.zIndex = '10';
            });
        }
        
        if (containers.length === 0) return;
        
        function explodeFirework() {
            if (document.hidden) return;
            
            const visible = [];
            containers.forEach(c => {
                const parentRect = c.parentElement.getBoundingClientRect();
                if (parentRect.top < window.innerHeight && parentRect.bottom > 0) {
                    visible.push({ container: c, rect: parentRect });
                }
            });
            
            if (visible.length === 0) {
                scheduleNextFirework();
                return;
            }
            
            const target = visible[Math.floor(Math.random() * visible.length)];
            const activeContainer = target.container;
            
            const x = Math.random() * window.innerWidth;
            
            // Tính toạ độ y tương đối với vùng nhìn thấy của container absolute
            const viewportTop = -target.rect.top;
            const visibleTop = Math.max(0, viewportTop);
            const visibleBottom = Math.min(target.rect.height, viewportTop + window.innerHeight);
            const y = visibleTop + Math.random() * (visibleBottom - visibleTop) * 0.7;
            
            const numSparks = Math.floor(Math.random() * 8 + 6); // Giảm cực độ số lượng tia pháo (6-14 tia)
            const burstColor = fwColors[Math.floor(Math.random() * fwColors.length)];
            const fragment = document.createDocumentFragment();
            
            for (let i = 0; i < numSparks; i++) {
                const spark = document.createElement("div");
                spark.classList.add("firework-spark");
                spark.style.left = x + "px";
                spark.style.top = y + "px";
                
                const color = Math.random() > 0.15 ? burstColor : fwColors[Math.floor(Math.random() * fwColors.length)];
                spark.style.color = color; 
                
                const angle = Math.random() * Math.PI * 2;
                spark.style.setProperty('--rot', (angle + Math.PI/2) + 'rad');
                
                const distance = Math.random() * 300 + 100; 
                const tx = Math.cos(angle) * distance;
                const ty = Math.sin(angle) * distance + (Math.random() * 250 + 150); 
                
                spark.style.setProperty('--tx', tx + 'px');
                spark.style.setProperty('--ty', ty + 'px');
                
                spark.style.animationDuration = (Math.random() * 0.8 + 1.2) + "s";
                
                fragment.appendChild(spark);
            }
            
            activeContainer.appendChild(fragment);
            
            setTimeout(() => {
                const sparks = activeContainer.querySelectorAll('.firework-spark');
                sparks.forEach(s => {
                    const animationName = getComputedStyle(s).animationName;
                    if (animationName === 'none') s.remove();
                });
            }, 3000);
        }
        
        function scheduleNextFirework() {
            setTimeout(() => {
                if (!document.hidden) {
                    explodeFirework();
                    // Đã bỏ hoàn toàn nổ chùm (đôi) để giảm giật lag
                }
                scheduleNextFirework();
            }, Math.random() * 1500 + 1000); // Pháo nổ rất thưa (1s - 2.5s mỗi quả)
        }
        
        setTimeout(scheduleNextFirework, 500);
        explodeFirework();
    });
</script>

<!-- ========================================== -->
<!-- MAGIC BEE CURSOR                             -->
<!-- ========================================== -->
<style>
    /* Đổi con trỏ chuột thành hình chú Ong vàng FPT */
    body, a, button, [role="button"], input, select, textarea {
        cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32'><defs><filter id='shadow'><feDropShadow dx='1' dy='1' stdDeviation='1' flood-opacity='0.4'/></filter></defs><g filter='url(%23shadow)' transform='rotate(-15, 16, 16)'><ellipse cx='12' cy='10' rx='4' ry='6' fill='%23e2f1f8' opacity='0.9'/><ellipse cx='20' cy='10' rx='4' ry='6' fill='%23e2f1f8' opacity='0.9'/><ellipse cx='16' cy='18' rx='7' ry='10' fill='%23FFB800'/><path d='M9.5 16h13M10 20h12' stroke='%23111' stroke-width='2.5' stroke-linecap='round'/><circle cx='16' cy='8' r='4' fill='%23111'/><path d='M15 4c-1-2-2-2-2-2M17 4c1-2 2-2 2-2' stroke='%23111' stroke-width='1' fill='none' stroke-linecap='round'/><polygon points='14,27 18,27 16,31' fill='%23111'/></g></svg>") 16 16, auto !important;
    }
</style>
@endif
</body>
</html>
