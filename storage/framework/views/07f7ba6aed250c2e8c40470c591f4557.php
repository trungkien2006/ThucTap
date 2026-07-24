<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <script>
        (function() {
            function getDeviceCookie() {
                var match = document.cookie.match(new RegExp('(^| )device_view=([^;]+)'));
                return match ? match[2] : null;
            }
            function setDeviceCookie(value) {
                var d = new Date();
                d.setTime(d.getTime() + (365*24*60*60*1000));
                document.cookie = "device_view=" + value + ";path=/;expires=" + d.toUTCString();
            }
            
            var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var currentDevice = width < 1024 ? 'mobile' : 'desktop';
            var cookieVal = getDeviceCookie();
            
            if (cookieVal !== currentDevice) {
                setDeviceCookie(currentDevice);
                window.location.reload();
            }
            
            window.addEventListener('resize', function() {
                var newWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                var newDevice = newWidth < 1024 ? 'mobile' : 'desktop';
                if (getDeviceCookie() !== newDevice) {
                    setDeviceCookie(newDevice);
                    window.location.reload();
                }
            });
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'UniEvent — Nền tảng sự kiện học đường'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Khám phá, lưu giữ và sống lại những khoảnh khắc đáng nhớ của các sự kiện học đường qua trải nghiệm điện ảnh.'); ?>">
    
    <!-- Alpine.js is loaded via Vite (app.js) -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <!-- AOS CSS for scroll animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&family=Be+Vietnam+Pro:wght@400;600;700&family=Charm:wght@400;700&family=Montserrat:wght@400;600;700&family=Pacifico&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Rowdies:wght@400;700&family=Barlow:wght@400;500;600;700;800;900&family=Barlow+Condensed:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Three.js for 3D Background -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <!-- GSAP + ScrollTrigger -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js']); ?>
    
    <!-- SPA Pre-loaded CDN Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" data-navigate-track></script>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <style>
        html, body {
            touch-action: pan-y !important;
        }
    </style>
</head>
<body class="frontend-body antialiased bg-paper text-ink relative" x-data="{ scrolled: false, mobileOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 40)">
    
    <!-- 3D Interactive Background -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request()->routeIs('home') && !request()->routeIs('archive')): ?>
        <canvas id="three-bg-canvas" class="fixed inset-0 z-[-1] pointer-events-none w-full h-full"></canvas>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php 
        $isHome = request()->routeIs('home'); 
    ?>
    <!-- Header -->
    <header 
        class="fixed inset-x-0 top-0 z-[100] transition-all duration-500 <?php echo e(!$isHome ? 'backdrop-blur-xl border-b shadow-sm' : ''); ?>"
        <?php echo $isHome ? ":class=\"scrolled ? 'backdrop-blur-xl border-b shadow-sm' : 'bg-transparent'\"" : ""; ?>

        style="<?php echo e(!$isHome ? 'background:rgba(255,248,208,0.97);border-color:rgba(232,200,74,0.5);' : ''); ?>"
        <?php echo $isHome ? ":style=\"scrolled ? 'background:rgba(255,248,208,0.97);border-color:rgba(232,200,74,0.5);' : ''\"" : ""; ?>

        x-data="{ megaMenuOpen: false }"
    >
        <div class="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-5 lg:px-10 relative">
            <a href="<?php echo e(route('home')); ?>#top" wire:navigate class="group relative flex items-center h-8 w-[160px] sm:w-[240px]" x-data="{ showUni: true }" x-init="setInterval(() => { showUni = !showUni }, 3000)">
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
                    class="absolute inset-y-0 left-0 flex items-center w-[160px] sm:w-[240px] lg:w-[350px]" 
                    x-show="showUni"
                    x-transition:enter="fluid-in"
                    x-transition:leave="fluid-out"
                >
                    <img src="<?php echo e(asset('images/unievent-logo.png')); ?>?v=<?php echo e(time()); ?>" alt="UniEvent" class="h-10 sm:h-14 lg:h-20 w-auto max-w-none object-contain ml-[-5px] filter drop-shadow-[0_4px_3px_rgba(0,0,0,0.07)]">
                </div>

                <!-- FPT Polytechnic Logo (Fluid effect) -->
                <div 
                    class="absolute inset-y-0 left-0 flex items-center w-[160px] sm:w-[240px] lg:w-[350px]" 
                    x-show="!showUni"
                    x-transition:enter="fluid-in"
                    x-transition:leave="fluid-out"
                    style="display: none;"
                >
                    <img src="<?php echo e(asset('images/fpt-polytechnic.png')); ?>?v=<?php echo e(time()); ?>" alt="FPT Polytechnic" class="h-14 sm:h-20 lg:h-28 w-auto max-w-none object-contain ml-[-12px] sm:ml-[-20px] filter drop-shadow-[0_4px_3px_rgba(0,0,0,0.07)]">
                </div>
            </a>

            <nav class="hidden items-center gap-1 lg:flex absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                <a href="<?php echo e(route('home')); ?>#top" wire:navigate class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors <?php echo e(!$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : ''); ?>"
                   <?php echo $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : ""; ?>>
                    Trang chủ
                </a>
                
                <div class="relative" @mouseenter="megaMenuOpen = true" @mouseleave="megaMenuOpen = false">
                    <a href="<?php echo e(route('events.index')); ?>" wire:navigate class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors <?php echo e(!$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : ''); ?>"
                       <?php echo $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : ""; ?>>
                        Sự kiện
                        <span class="ml-0.5 inline-block h-2 w-2 rounded-full" style="background:#07A0C3;"></span>
                    </a>
                    
                    <!-- Mega Menu -->
                    <div x-show="megaMenuOpen" x-cloak
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
                                <?php
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
                                ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($categories)): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <a href="<?php echo e(isset($c['slug']) ? route('events.index', ['category' => $c['slug']]) : '#'); ?>" wire:navigate class="group flex items-start justify-between rounded-xl px-4 py-3 transition-colors"
                                       style="" onmouseover="this.style.background='rgba(255,227,129,0.3)'" onmouseout="this.style.background=''">
                                        <div>
                                            <div class="text-sm font-semibold text-[#1C1410]"><?php echo e($c['name']); ?></div>
                                            <div class="text-xs text-[#7A6A52]"><?php echo e($c['desc']); ?></div>
                                        </div>
                                        <i data-lucide="arrow-up-right" class="h-4 w-4 text-[#07A0C3] opacity-0 transition-all group-hover:opacity-100"></i>
                                    </a>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <a href="<?php echo e(route('events.index')); ?>" wire:navigate class="mt-2 flex items-center justify-between rounded-xl px-4 py-3 text-[#1C1410] font-semibold transition-all hover:opacity-90" style="background:#FFE381;">
                                <span class="text-sm">Xem tất cả danh mục sự kiện</span>
                                <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="<?php echo e(route('archive')); ?>" wire:navigate class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors <?php echo e(request()->routeIs('archive') ? 'text-[#07A0C3]' : (!$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : '')); ?>"
                   <?php echo $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : ""; ?>>
                    Kho lưu trữ
                </a>
                <a href="<?php echo e(route('contact')); ?>" wire:navigate class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold transition-colors <?php echo e(request()->routeIs('contact') ? 'text-[#07A0C3]' : (!$isHome ? 'text-[#7A6A52] hover:text-[#1C1410]' : '')); ?>"
                   <?php echo $isHome ? ":class=\"scrolled ? 'text-[#7A6A52] hover:text-[#1C1410]' : 'text-white/80 hover:text-white'\"" : ""; ?>>
                    Liên hệ
                </a>
            </nav>

            <div class="hidden lg:block">
                <a href="<?php echo e(route('events.index')); ?>" wire:navigate
                   class="inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-bold text-[#1C1410] shadow-md transition-all hover:shadow-lg hover:scale-105"
                   style="background: #FFE381; border: 1px solid rgba(232,200,74,0.6);">
                    Khám phá ngay
                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>
            </div>

            <button class="lg:hidden text-[#1C1410] p-2" 
                    <?php echo $isHome ? ":class=\"scrolled ? 'text-[#1C1410]' : 'text-white'\"" : ""; ?>

                    @click="mobileOpen = true">
                <i data-lucide="menu" class="h-6 w-6"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div x-show="mobileOpen" style="display: none;" class="fixed inset-0 z-[9999] lg:hidden">
        <div x-show="mobileOpen" class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="mobileOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>
        
        <div x-show="mobileOpen" class="absolute right-0 w-full max-w-sm bg-paper p-6 shadow-2xl flex flex-col <?php echo e($isHome ? 'inset-y-0' : 'top-0 h-fit rounded-b-[2rem]'); ?>" style="background-color: #FFFBEA !important;"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full">
            
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <img src="<?php echo e(asset('images/unievent-logo.png')); ?>?v=<?php echo e(time()); ?>" alt="UniEvent" class="h-8 w-auto object-contain">
                    <div class="h-5 w-[1px] bg-slate-300"></div>
                    <img src="<?php echo e(asset('images/fpt-polytechnic.png')); ?>?v=<?php echo e(time()); ?>" alt="FPT Polytechnic" class="h-8 w-auto object-contain">
                </div>
                <button @click="mobileOpen = false" class="p-2 text-[#7A6A52] hover:text-[#1C1410] bg-white rounded-full shadow-sm">
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>
            </div>

            <nav class="flex flex-col gap-4">
                <a href="<?php echo e(route('home')); ?>#top" wire:navigate @click="mobileOpen = false" class="flex items-center justify-between py-3 text-lg font-semibold text-[#1C1410] border-b border-[#E8C84A]/20">
                    Trang chủ
                    <i data-lucide="chevron-right" class="h-4 w-4 text-[#7A6A52]"></i>
                </a>
                
                <div x-data="{ expanded: false }" class="border-b border-[#E8C84A]/20 pb-3">
                    <button @click="expanded = !expanded" class="flex w-full items-center justify-between py-3 text-lg font-semibold text-[#1C1410]">
                        Danh mục sự kiện
                        <i data-lucide="chevron-down" class="h-4 w-4 text-[#7A6A52] transition-transform" :class="expanded ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="expanded" class="grid grid-cols-1 gap-2 pt-2 pb-2 pl-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($categories)): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <a href="<?php echo e(isset($c['slug']) ? route('events.index', ['category' => $c['slug']]) : '#'); ?>" wire:navigate class="py-2 text-[#7A6A52] hover:text-[#07A0C3] font-medium" @click="mobileOpen = false"><?php echo e($c['name']); ?></a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <a href="<?php echo e(route('archive')); ?>" wire:navigate @click="mobileOpen = false" class="flex items-center justify-between py-3 text-lg font-semibold text-[#1C1410] border-b border-[#E8C84A]/20">
                    Kho lưu trữ
                    <i data-lucide="chevron-right" class="h-4 w-4 text-[#7A6A52]"></i>
                </a>
                <a href="<?php echo e(route('contact')); ?>" wire:navigate @click="mobileOpen = false" class="flex items-center justify-between py-3 text-lg font-semibold <?php echo e(request()->routeIs('contact') ? 'text-[#07A0C3]' : 'text-[#1C1410]'); ?> border-b border-[#E8C84A]/20">
                    Liên hệ
                    <i data-lucide="chevron-right" class="h-4 w-4 text-[#7A6A52]"></i>
                </a>
            </nav>

            <div class="<?php echo e($isHome ? 'mt-auto pt-6' : 'mt-8'); ?>">
                <a href="<?php echo e(route('events.index')); ?>" wire:navigate @click="mobileOpen = false" class="flex w-full items-center justify-center gap-2 rounded-xl py-4 text-center text-lg font-bold text-[#1C1410] shadow-md transition-transform active:scale-95" style="background: #FFE381;">
                    Khám phá ngay
                    <i data-lucide="arrow-right" class="h-5 w-5"></i>
                </a>
            </div>
        </div>
    </div>

    <main class="w-full">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="relative bg-[#1C1410] pt-24 pb-12 overflow-hidden" style="z-index: 70;">
        <div class="absolute inset-0 z-0 opacity-20 pointer-events-none" style="background-image:url('<?php echo e(asset('images/frontend/footer-bg.png')); ?>'); background-size: cover; background-position: center;"></div>
        <div class="mx-auto max-w-[1400px] px-6 lg:px-10 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-16">
                <!-- Brand Info -->
                <div class="col-span-2 md:col-span-1 lg:col-span-1">
                    <a href="<?php echo e(route('home')); ?>#top" class="inline-flex items-center gap-3 mb-6">
                        <img src="<?php echo e(asset('images/unievent-logo.png')); ?>?v=<?php echo e(time()); ?>" alt="UniEvent" class="h-10 w-auto object-contain">
                        <div class="h-6 w-[1px] bg-white/20"></div>
                        <img src="<?php echo e(asset('images/fpt-polytechnic.png')); ?>?v=<?php echo e(time()); ?>" alt="FPT Polytechnic" class="h-10 w-auto object-contain">
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
                <div class="col-span-1">
                    <h4 class="text-white font-bold mb-6 text-lg tracking-wide uppercase font-barlow">Khám Phá</h4>
                    <ul class="space-y-4">
                        <li><a href="<?php echo e(route('home')); ?>#master-wipe-anchor" wire:navigate class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Sự kiện nổi bật</a></li>
                        <li><a href="<?php echo e(route('archive')); ?>" wire:navigate class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Kho lưu trữ</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" wire:navigate class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Liên hệ</a></li>
                        <li>
                            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2 w-full text-left">
                                <i data-lucide="chevron-up" class="w-4 h-4"></i> Quay về đầu trang
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="col-span-1">
                    <h4 class="text-white font-bold mb-6 text-lg tracking-wide uppercase font-barlow">Danh Mục</h4>
                    <ul class="space-y-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($categories) && count($categories) > 0): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_slice($categories, 0, 6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <li><a href="<?php echo e(isset($c['slug']) ? route('events.index', ['category' => $c['slug']]) : '#'); ?>" wire:navigate class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> <?php echo e($c['name']); ?></a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php else: ?>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Workshop</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Hội thảo</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Thể thao</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Văn hóa nghệ thuật</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Định hướng</a></li>
                            <li><a href="#" class="text-white/60 hover:text-[#E8C84A] text-sm transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4"></i> Hội nghị</a></li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>

                <!-- Contact -->
                <div id="contact" class="col-span-2 md:col-span-1 lg:col-span-1">
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
                    
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-white/40 hover:text-white text-sm transition-colors">Điều khoản</a>
                    <a href="#" class="text-white/40 hover:text-white text-sm transition-colors">Bảo mật</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize AOS -->
    <script>
        function initFrontendScripts() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    once: true,
                    offset: 50,
                    duration: 800,
                    easing: 'ease-out-cubic',
                });
            }
        }
        document.addEventListener('DOMContentLoaded', initFrontendScripts);
        document.addEventListener('livewire:navigated', initFrontendScripts);
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->is('events/*') || request()->is('admin/events/*/preview*') || request()->is('admin/template-preview/*')): ?>
        <?php echo $__env->make('components.event-fab-menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request()->routeIs('home') && !request()->routeIs('archive')): ?>
        <script src="<?php echo e(asset('js/three-bg.js')); ?>"></script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->routeIs('home')): ?>


<!-- ========================================== -->
<!-- MAGIC BEE CURSOR                             -->
<!-- ========================================== -->
<style>
    /* Đổi con trỏ chuột thành hình chú Ong vàng FPT (Đã tối ưu bóng đổ để tránh lag) */
    body, a, button, [role="button"], input, select, textarea {
        cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32'><g transform='rotate(-15, 16, 16)'><ellipse cx='12' cy='10' rx='4' ry='6' fill='%23e2f1f8' opacity='0.9'/><ellipse cx='20' cy='10' rx='4' ry='6' fill='%23e2f1f8' opacity='0.9'/><ellipse cx='16' cy='18' rx='7' ry='10' fill='%23FFB800'/><path d='M9.5 16h13M10 20h12' stroke='%23111' stroke-width='2.5' stroke-linecap='round'/><circle cx='16' cy='8' r='4' fill='%23111'/><path d='M15 4c-1-2-2-2-2-2M17 4c1-2 2-2 2-2' stroke='%23111' stroke-width='1' fill='none' stroke-linecap='round'/><polygon points='14,27 18,27 16,31' fill='%23111'/></g></svg>") 16 16, auto !important;
    }
</style>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Back to top button -->
    <button id="backToTopBtn" class="fixed bottom-6 right-6 bg-[#F27024] text-white p-3 rounded-full shadow-lg z-50 opacity-0 invisible transition-all duration-300 hover:bg-[#E8C84A] hover:scale-110 flex items-center justify-center" aria-label="Lên đầu trang">
        <i data-lucide="arrow-up" class="w-6 h-6"></i>
    </button>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopBtn = document.getElementById('backToTopBtn');
            if (backToTopBtn) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.remove('opacity-0', 'invisible');
                        backToTopBtn.classList.add('opacity-100', 'visible');
                    } else {
                        backToTopBtn.classList.add('opacity-0', 'invisible');
                        backToTopBtn.classList.remove('opacity-100', 'visible');
                    }
                });
                backToTopBtn.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\anima\Downloads\ThucTap-main\resources\views/layouts/frontend-mobile.blade.php ENDPATH**/ ?>