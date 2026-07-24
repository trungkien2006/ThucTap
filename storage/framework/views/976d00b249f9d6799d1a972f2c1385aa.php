<?php $__env->startSection('title', 'Kho Lưu Trữ Ký Ức - UniEvent'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $archiveJson = json_encode($archive);
    $archiveYears = collect($archive)->pluck('year')->unique()->sortDesc();
?>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@100..900&family=Inter:wght@100..900&family=Playfair+Display:wght@100..900&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "inverse-surface": "#3f2c20",
                    "surface-variant": "#fbddca",
                    "inverse-primary": "#cac6bc",
                    "primary": "#605e56",
                    "surface-tint": "#605e56",
                    "on-primary-fixed-variant": "#48473f",
                    "on-tertiary-container": "#876f52",
                    "surface-container-low": "#fff1ea",
                    "background": "#fff8f5",
                    "surface-container-highest": "#fbddca",
                    "tertiary-fixed-dim": "#dfc29f",
                    "on-primary-fixed": "#1c1c15",
                    "on-secondary-container": "#755700",
                    "on-tertiary-fixed-variant": "#574329",
                    "on-tertiary": "#ffffff",
                    "on-tertiary-fixed": "#281903",
                    "outline": "#79776f",
                    "error-container": "#ffdad6",
                    "surface": "#fff8f5",
                    "on-primary-container": "#75746b",
                    "primary-container": "#fffbf0",
                    "secondary-container": "#fece65",
                    "surface-container-lowest": "#ffffff",
                    "on-secondary": "#ffffff",
                    "on-secondary-fixed": "#261a00",
                    "on-background": "#28180d",
                    "tertiary-container": "#fffaf8",
                    "primary-fixed": "#e6e2d8",
                    "surface-bright": "#fff8f5",
                    "on-surface-variant": "#484740",
                    "on-error-container": "#93000a",
                    "secondary-fixed": "#ffdf9f",
                    "on-error": "#ffffff",
                    "on-primary": "#ffffff",
                    "secondary-fixed-dim": "#eec058",
                    "surface-container": "#ffeade",
                    "primary-fixed-dim": "#cac6bc",
                    "surface-dim": "#f2d4c2",
                    "inverse-on-surface": "#ffede4",
                    "on-secondary-fixed-variant": "#5b4300",
                    "tertiary-fixed": "#fcdeba",
                    "tertiary": "#715b3e",
                    "outline-variant": "#cac6bd",
                    "error": "#ba1a1a",
                    "surface-container-high": "#ffe3d2",
                    "on-surface": "#28180d",
                    "secondary": "#795900"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "spacing": {
                    "margin-lg": "4rem",
                    "margin-md": "2rem",
                    "margin-sm": "1rem",
                    "unit": "8px",
                    "container-padding": "2rem",
                    "gutter": "1.5rem"
            },
            "fontFamily": {
                    "button-text": ["Inter"],
                    "label-handwritten": ["Inter"],
                    "display-lg": ["Inter"],
                    "headline-lg-mobile": ["Inter"],
                    "body-md": ["Inter"],
                    "headline-lg": ["Inter"]
            },
            "fontSize": {
                    "button-text": ["14px", {"lineHeight": "1", "letterSpacing": "0.03em", "fontWeight": "600"}],
                    "label-handwritten": ["22px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "500"}],
                    "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        body {
            background-image: radial-gradient(#d1d1d1 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            background-color: #FFFBF0;
        }
        .washi-tape-amber { background-color: rgba(212, 168, 67, 0.4); }
        .washi-tape-sage { background-color: rgba(138, 154, 91, 0.4); }
        .washi-tape-rose { background-color: rgba(220, 156, 156, 0.4); }
        .jagged-tape { clip-path: polygon(2% 0, 98% 0, 100% 10%, 98% 20%, 100% 30%, 98% 40%, 100% 50%, 98% 60%, 100% 70%, 98% 80%, 100% 90%, 98% 100%, 2% 100%, 0 90%, 2% 80%, 0 70%, 2% 60%, 0 50%, 2% 40%, 0 30%, 2% 20%, 0 10%); }
        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        .polaroid-card {
            box-shadow: 0 4px 15px rgba(61, 43, 31, 0.08);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        }
        .polaroid-card:hover {
            transform: rotate(0deg) translateY(-8px) scale(1.02) !important;
            box-shadow: 0 15px 30px rgba(61, 43, 31, 0.15);
            z-index: 50;
        }
        
        .timeline-line {
            background: linear-gradient(to right, transparent, #715b3e 15%, #715b3e 85%, transparent);
        }

        .floating-ribbon {
            clip-path: polygon(0 0, 100% 0, 85% 100%, 0 100%);
        }
    </style>

<!-- Diagonal Amber Ribbon -->
<div class="absolute -left-12 top-[100px] md:top-[120px] z-50 transform -rotate-45">
<div class="bg-secondary text-on-secondary px-16 py-2 shadow-lg floating-ribbon font-bold tracking-widest text-sm uppercase">
            Kỷ niệm
        </div>
</div>

<main class="max-w-7xl mx-auto px-margin-sm md:px-margin-lg pt-32 pb-12"
      x-data="archiveApp()"
      x-init="initData(<?php echo e($archiveJson); ?>)">
<!-- HERO SECTION -->
<section class="flex flex-col items-center text-center mb-8 relative">
<h1 class="font-display-lg text-[64px] md:text-[80px] italic text-primary leading-tight mb-2">Kho Lưu Trữ</h1>
<p class="font-label-handwritten text-3xl text-tertiary mb-6">Những khoảnh khắc đáng nhớ nhất...</p>
<p class="max-w-2xl text-on-surface-variant opacity-80 leading-relaxed mb-12">
                Hành trình thanh xuân được dệt nên từ những nụ cười, những lần hội ngộ và những thành tựu rực rỡ tại UniEvent. Hãy cùng lật lại những trang ký ức đầy màu sắc của chúng ta.
            </p>
<!-- Sticky Notes Stats -->
<div class="flex flex-wrap justify-center gap-8 md:gap-16 mb-8 relative w-full"
     x-data="{
         eCount: 0, iCount: 0, vCount: 0,
         targetE: <?php echo e($totalArchivedEvents ?? 0); ?>,
         targetI: <?php echo e($totalImages ?? 0); ?>,
         targetV: <?php echo e($totalVideos ?? 0); ?>,
         startCount() {
             const duration = 2000;
             const steps = 60;
             const stepTime = Math.abs(Math.floor(duration / steps));
             let currentStep = 0;
             const timer = setInterval(() => {
                 currentStep++;
                 this.eCount = Math.floor((this.targetE / steps) * currentStep);
                 this.iCount = Math.floor((this.targetI / steps) * currentStep);
                 this.vCount = Math.floor((this.targetV / steps) * currentStep);
                 if (currentStep >= steps) {
                     this.eCount = this.targetE;
                     this.iCount = this.targetI;
                     this.vCount = this.targetV;
                     clearInterval(timer);
                 }
             }, stepTime);
         }
     }"
     x-init="setTimeout(() => startCount(), 300)">
<!-- Amber Note -->
<div class="relative bg-[#FDF2B5] p-6 w-40 h-40 shadow-md rotate-[-3deg] flex flex-col justify-center items-center group hover:scale-105 transition-transform duration-300">
<div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-amber h-6 w-20"></div>
<span class="font-display-lg text-4xl text-on-secondary-fixed-variant" x-text="eCount">0</span>
<span class="font-label-handwritten text-xl text-tertiary">Sự kiện</span>
</div>
<!-- Sage Note -->
<div class="relative bg-[#E2F0D9] p-6 w-40 h-40 shadow-md rotate-[2deg] flex flex-col justify-center items-center group hover:scale-105 transition-transform duration-300">
<div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-sage h-6 w-20"></div>
<span class="font-display-lg text-4xl text-on-tertiary-fixed-variant" x-text="iCount">0</span>
<span class="font-label-handwritten text-xl text-tertiary">Bức ảnh</span>
</div>
<!-- Rose Note -->
<div class="relative bg-[#FFE4E1] p-6 w-40 h-40 shadow-md rotate-[6deg] flex flex-col justify-center items-center group hover:scale-105 transition-transform duration-300">
<div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-rose h-6 w-20"></div>
<span class="font-display-lg text-4xl text-[#8E4444]" x-text="vCount">0</span>
<span class="font-label-handwritten text-xl text-[#8E4444]">Video</span>
</div>
</div>
<div class="flex items-center justify-center gap-4 w-full opacity-30">
<div class="h-[1px] w-24 bg-primary"></div>
<span class="text-xl">✽</span>
<div class="h-[1px] w-24 bg-primary"></div>
</div>
</section>

<!-- SEARCH/FILTER SECTION -->
<section class="mb-16 bg-white/70 backdrop-blur-md rounded-2xl p-6 md:p-8 border border-tertiary/20 shadow-md relative overflow-hidden">
    <!-- Decorative Washi Tape -->
    <div class="absolute -top-3 right-10 washi-tape-amber h-7 w-28 rotate-[4deg] z-10 opacity-70 jagged-tape"></div>

    <div class="flex flex-col gap-6">
        <!-- Top bar: Heading & Stats Counter Badge -->
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-tertiary/10 pb-4">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary text-2xl">tune</span>
                <h2 class="font-label-handwritten text-2xl text-on-surface font-bold">Bộ lọc tìm kiếm ký ức</h2>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="bg-primary/10 text-primary px-4 py-1.5 rounded-full text-sm font-semibold flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">photo_library</span>
                    <span x-text="'Hiển thị ' + filteredEvents.length + ' / ' + events.length + ' kỷ niệm'"></span>
                </div>
                
                <button x-show="hasActiveFilters" 
                        @click="resetFilters()"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="text-xs text-error hover:text-error/80 font-bold bg-error/10 hover:bg-error/20 px-3 py-1.5 rounded-full transition-all flex items-center gap-1 cursor-pointer">
                    <span class="material-symbols-outlined text-sm">restart_alt</span>
                    Xóa lọc
                </button>
            </div>
        </div>

        <!-- Main Controls Grid: Search Input + Select Dropdowns -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <!-- Search Input (Span 5 cols) -->
            <div class="md:col-span-5 relative">
                <div class="flex items-center gap-2 bg-[#fff8f5] px-4 py-2.5 rounded-xl border border-tertiary/20 focus-within:border-secondary focus-within:ring-2 focus-within:ring-secondary/30 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-tertiary">search</span>
                    <input x-model="searchQuery" 
                           class="bg-transparent border-none focus:ring-0 w-full placeholder:italic text-base text-on-surface placeholder:text-on-surface-variant/50 outline-none" 
                           placeholder="Tìm theo tên sự kiện, nội dung..." 
                           type="text"/>
                    <button x-show="searchQuery.length > 0" 
                            @click="searchQuery = ''" 
                            class="text-on-surface-variant/50 hover:text-on-surface transition-colors p-0.5 rounded-full"
                            title="Xóa từ khóa">
                        <span class="material-symbols-outlined text-base block">close</span>
                    </button>
                </div>
            </div>

            <!-- Dropdown Selects Container (Span 7 cols) -->
            <div class="md:col-span-7 grid grid-cols-1 sm:grid-cols-3 gap-3">
                <!-- Year Select -->
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined text-tertiary text-lg absolute left-3 pointer-events-none z-10">calendar_today</span>
                    <select x-model="selectedYear" 
                            class="w-full bg-[#fff8f5] hover:bg-white pl-9 pr-8 py-2.5 rounded-xl border border-tertiary/20 text-sm cursor-pointer transition-all focus:border-secondary focus:ring-2 focus:ring-secondary/30 outline-none text-on-surface font-medium appearance-none shadow-sm">
                        <option value="">Tất cả các năm</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $archiveYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($year); ?>">Năm <?php echo e($year); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <span class="material-symbols-outlined text-tertiary/60 text-lg absolute right-2.5 pointer-events-none">expand_more</span>
                </div>

                <!-- Month Select -->
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined text-tertiary text-lg absolute left-3 pointer-events-none z-10">event</span>
                    <select x-model="selectedMonth" 
                            class="w-full bg-[#fff8f5] hover:bg-white pl-9 pr-8 py-2.5 rounded-xl border border-tertiary/20 text-sm cursor-pointer transition-all focus:border-secondary focus:ring-2 focus:ring-secondary/30 outline-none text-on-surface font-medium appearance-none shadow-sm">
                        <option value="">Tất cả tháng</option>
                        <template x-for="month in 12" :key="month">
                            <option :value="month" x-text="'Tháng ' + month"></option>
                        </template>
                    </select>
                    <span class="material-symbols-outlined text-tertiary/60 text-lg absolute right-2.5 pointer-events-none">expand_more</span>
                </div>

                <!-- Category Select -->
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined text-tertiary text-lg absolute left-3 pointer-events-none z-10">category</span>
                    <select x-model="selectedCategory" 
                            class="w-full bg-[#fff8f5] hover:bg-white pl-9 pr-8 py-2.5 rounded-xl border border-tertiary/20 text-sm cursor-pointer transition-all focus:border-secondary focus:ring-2 focus:ring-secondary/30 outline-none text-on-surface font-medium appearance-none shadow-sm">
                        <option value="">Mọi danh mục</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($cat['name']); ?>"><?php echo e($cat['desc']); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <span class="material-symbols-outlined text-tertiary/60 text-lg absolute right-2.5 pointer-events-none">expand_more</span>
                </div>
            </div>
        </div>

        <!-- Active Filter Badges Bar (Dynamic Chips) -->
        <div x-show="hasActiveFilters" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="flex flex-wrap items-center gap-2 pt-2 border-t border-tertiary/10 text-xs">
            <span class="text-on-surface-variant font-medium">Bộ lọc đang dùng:</span>

            <!-- Search Query Tag -->
            <template x-if="searchQuery.trim() !== ''">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-100 text-amber-900 border border-amber-300 font-medium">
                    <span>Từ khóa: "<strong x-text="searchQuery"></strong>"</span>
                    <button @click="searchQuery = ''" class="hover:text-red-700 ml-0.5" title="Xóa từ khóa"><span class="material-symbols-outlined text-xs block">close</span></button>
                </span>
            </template>

            <!-- Year Tag -->
            <template x-if="selectedYear !== ''">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-900 border border-emerald-300 font-medium">
                    <span x-text="'Năm ' + selectedYear"></span>
                    <button @click="selectedYear = ''" class="hover:text-red-700 ml-0.5" title="Bỏ lọc năm"><span class="material-symbols-outlined text-xs block">close</span></button>
                </span>
            </template>

            <!-- Month Tag -->
            <template x-if="selectedMonth !== ''">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-sky-100 text-sky-900 border border-sky-300 font-medium">
                    <span x-text="'Tháng ' + selectedMonth"></span>
                    <button @click="selectedMonth = ''" class="hover:text-red-700 ml-0.5" title="Bỏ lọc tháng"><span class="material-symbols-outlined text-xs block">close</span></button>
                </span>
            </template>

            <!-- Category Tag -->
            <template x-if="selectedCategory !== ''">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-purple-100 text-purple-900 border border-purple-300 font-medium">
                    <span x-text="'Danh mục: ' + selectedCategory"></span>
                    <button @click="selectedCategory = ''" class="hover:text-red-700 ml-0.5" title="Bỏ lọc danh mục"><span class="material-symbols-outlined text-xs block">close</span></button>
                </span>
            </template>
        </div>
    </div>
</section>

<!-- PHOTO WALL GRID -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-24">
    <template x-for="(event, index) in filteredEvents" :key="event.id">
        <div :class="{
            'md:col-span-2 polaroid-card bg-white p-4 pt-4 pb-12 rotate-[1deg] relative': index % 5 === 0,
            'polaroid-card bg-white p-3 pt-3 pb-8 rotate-[-2deg] relative': index % 5 === 1,
            'polaroid-card bg-white p-3 pt-3 pb-8 rotate-[2.5deg] relative': index % 5 === 2,
            'polaroid-card bg-white p-3 pt-3 pb-8 rotate-[-1.5deg] relative': index % 5 === 3,
            'polaroid-card bg-white p-3 pt-3 pb-8 rotate-[1.2deg] relative': index % 5 === 4
        }">
            
            <!-- Decorations -->
            <template x-if="index % 5 === 0">
                <div class="absolute -top-3 left-8 washi-tape-sage h-8 w-24 rotate-[-12deg] z-10 opacity-60 jagged-tape"></div>
            </template>
            <template x-if="index % 5 === 1">
                <div class="absolute -top-2 right-12 washi-tape-amber h-6 w-20 rotate-[15deg] z-10 opacity-70 jagged-tape"></div>
            </template>
            <template x-if="index % 5 === 2">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-rose h-7 w-24 rotate-[5deg] z-10 opacity-60 jagged-tape"></div>
            </template>
            <template x-if="index % 5 === 3">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-sage h-7 w-24 rotate-[-2deg] z-10 opacity-60 jagged-tape"></div>
            </template>
            <template x-if="index % 5 === 4">
                <div class="absolute -top-2 left-10 washi-tape-amber h-6 w-20 rotate-[-10deg] z-10 opacity-70 jagged-tape"></div>
            </template>
            
            <!-- Image Area -->
            <div :class="index % 5 === 0 ? 'aspect-[16/9] w-full overflow-hidden bg-surface-container relative group cursor-pointer mb-6' : 'aspect-square w-full overflow-hidden bg-surface-container mb-4 relative group cursor-pointer'"
                 @click="window.location.href = event.url">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" :src="event.img" :alt="event.title"/>
                <div class="absolute inset-0 p-4 flex flex-col justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center text-center" style="background-color: rgba(0,0,0,0.5);">
                    <p class="text-white text-xs md:text-sm leading-relaxed line-clamp-5 font-medium drop-shadow-md mb-3" x-text="event.desc"></p>
                    <span class="text-white font-bold border border-white px-4 py-1 text-sm rounded-full transition-colors hover:bg-white hover:text-black">Xem chi tiết →</span>
                </div>
            </div>
            
            <!-- Text Content -->
            <template x-if="index % 5 === 0">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="bg-[#E2F0D9] text-[#4F6343] px-3 py-1 rounded-full text-xs font-bold mb-2 inline-block uppercase" x-text="event.category"></span>
                        <h3 class="font-label-handwritten text-3xl leading-none" x-text="event.title"></h3>
                    </div>
                    <p class="font-display-lg italic text-on-surface-variant" x-text="event.date_str"></p>
                </div>
            </template>
            <template x-if="index % 5 !== 0">
                <div>
                    <span class="bg-surface-variant text-on-surface-variant px-2 py-0.5 rounded text-[10px] font-bold mb-1 inline-block uppercase tracking-wider" x-text="event.category"></span>
                    <h3 class="font-label-handwritten text-2xl" x-text="event.title"></h3>
                    <p class="font-display-lg italic text-sm text-on-surface-variant opacity-60" x-text="event.date_str"></p>
                </div>
            </template>
            
        </div>
    </template>
    
    <template x-if="filteredEvents.length === 0">
        <div class="col-span-full text-center py-24 text-on-surface-variant/50">
            <span class="material-symbols-outlined text-6xl mb-4">search_off</span>
            <p class="text-xl">Không tìm thấy kỷ niệm nào phù hợp.</p>
        </div>
    </template>
</section>

<!-- FOOTER CTA SECTION -->
<section class="mb-32 text-center flex flex-col items-center">
<h2 class="font-label-handwritten text-4xl text-tertiary mb-8">Còn rất nhiều kỷ niệm đang chờ được tạo ra...</h2>
<div class="flex flex-col md:flex-row items-center gap-12">
<a href="<?php echo e(route('events.index', ['status' => 'upcoming'])); ?>" class="bg-secondary text-on-secondary px-8 py-4 rounded-full font-bold shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all flex items-center gap-3 group">
                    Khám phá sự kiện sắp tới
                    <span class="material-symbols-outlined group-hover:translate-x-2 transition-transform">arrow_forward</span>
</a>
<!-- Empty Tilted Polaroid -->
<div class="polaroid-card bg-white p-3 pt-3 pb-10 w-48 h-56 rotate-[-6deg] border border-dashed border-tertiary/30 shadow-none flex flex-col justify-center items-center">
<div class="w-full h-32 bg-surface-container-lowest border border-dashed border-tertiary/20 flex items-center justify-center mb-2">
<span class="font-display-lg text-4xl text-tertiary/30">?</span>
</div>
<p class="font-label-handwritten text-tertiary/40 italic">Khoảnh khắc tiếp theo...</p>
</div>
</div>
</section>
</main>
<!-- Scroll to Top Button -->
<button class="fixed bottom-8 right-8 w-14 h-14 bg-secondary text-on-secondary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-90 transition-all z-50 group" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
<span class="material-symbols-outlined group-hover:-translate-y-1 transition-transform">keyboard_arrow_up</span>
</button>
<script>
    function archiveApp() {
        return {
            events: [],
            searchQuery: '',
            selectedCategory: '',
            selectedMonth: '',
            selectedYear: '',
            
            initData(data) {
                this.events = data;
            },

            resetFilters() {
                this.searchQuery = '';
                this.selectedCategory = '';
                this.selectedMonth = '';
                this.selectedYear = '';
            },

            get hasActiveFilters() {
                return this.searchQuery.trim() !== '' || 
                       this.selectedCategory !== '' || 
                       this.selectedMonth !== '' || 
                       this.selectedYear !== '';
            },
            
            get filteredEvents() {
                return this.events.filter(event => {
                    const matchesSearch = this.searchQuery === '' || 
                        event.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        event.desc.toLowerCase().includes(this.searchQuery.toLowerCase());
                    const matchesCategory = this.selectedCategory === '' || event.category === this.selectedCategory;
                    const matchesMonth = this.selectedMonth === '' || event.month == this.selectedMonth;
                    const matchesYear = this.selectedYear === '' || event.year == this.selectedYear;
                    
                    return matchesSearch && matchesCategory && matchesMonth && matchesYear;
                });
            }
        }
    }

    // Sticky notes subtle animation
    const notes = document.querySelectorAll('.bg-\\[\\#FDF2B5\\], .bg-\\[\\#E2F0D9\\], .bg-\\[\\#FFE4E1\\]');
    notes.forEach(note => {
        note.addEventListener('mousemove', (e) => {
            const rect = note.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            note.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
        });
        note.addEventListener('mouseleave', () => {
            note.style.transform = '';
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\anima\Downloads\ThucTap-main\resources\views/frontend/archive.blade.php ENDPATH**/ ?>