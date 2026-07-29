@extends('layouts.frontend-mobile')
@section('title', 'Kho Lưu Trữ Ký Ức - UniEvent')

@section('content')
    @php
        $archiveJson = json_encode($archive);
        $archiveYears = collect($archive)->pluck('year')->unique()->filter()->sortDesc();
    @endphp

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <style>
        .font-label-handwritten {
            font-family: 'Caveat', cursive, sans-serif !important;
        }

        .font-display-lg {
            font-family: 'Playfair Display', serif !important;
        }

        .washi-tape-amber {
            background-color: rgba(212, 168, 67, 0.45);
        }

        .washi-tape-sage {
            background-color: rgba(138, 154, 91, 0.45);
        }

        .washi-tape-rose {
            background-color: rgba(220, 156, 156, 0.45);
        }

        .jagged-tape {
            clip-path: polygon(2% 0, 98% 0, 100% 10%, 98% 20%, 100% 30%, 98% 40%, 100% 50%, 98% 60%, 100% 70%, 98% 80%, 100% 90%, 98% 100%, 2% 100%, 0 90%, 2% 80%, 0 70%, 2% 60%, 0 50%, 2% 40%, 0 30%, 2% 20%, 0 10%);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .polaroid-card {
            box-shadow: 0 8px 25px rgba(45, 31, 10, 0.08);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        }

        .polaroid-fan-stack:hover .polaroid-fan-card:nth-child(1) {
            transform: rotate(-14deg) translateX(-55px) !important;
            z-index: 10 !important;
        }

        .polaroid-fan-stack:hover .polaroid-fan-card:nth-child(2) {
            transform: rotate(0deg) translateX(0px) translateY(-8px) !important;
            z-index: 20 !important;
        }

        .polaroid-fan-stack:hover .polaroid-fan-card:nth-child(3) {
            transform: rotate(14deg) translateX(55px) !important;
            z-index: 30 !important;
        }

        .polaroid-fan-card {
            box-shadow: 0 4px 15px rgba(61, 43, 31, 0.12);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
        }
    </style>

    <div class="min-h-screen px-4 py-8 sm:px-6"
        style="background: linear-gradient(160deg, #FFFDF6 0%, #FFF9E6 45%, #F4FAF5 100%);" x-data="archiveMobileApp()"
        x-init="initData({{ $archiveJson }})">

        <!-- HERO SECTION -->
        <div class="relative z-10 text-center max-w-xl mx-auto mb-10 pt-4">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-widest mb-3"
                style="background: #FFE381; color: #1C1410;">
                Kỷ niệm UniEvent
            </span>
            <h1 class="font-display-lg text-4xl sm:text-5xl font-black text-[#1C1410] mb-3 leading-tight">
                Kho Lưu Trữ Ký Ức
            </h1>
            <p class="font-label-handwritten text-2xl sm:text-3xl font-bold text-[#8A7320] mb-4">
                Những khoảnh khắc đáng nhớ nhất...
            </p>
            <p class="text-sm leading-relaxed max-w-md mx-auto text-[#7A6A52]">
                Hành trình thanh xuân được dệt nên từ những nụ cười, những lần hội ngộ và những thành tựu rực rỡ tại
                UniEvent. Hãy cùng lật lại những trang ký ức đầy màu sắc của chúng ta.
            </p>
        </div>

        <!-- FILTER SECTION ("Bộ lọc") -->
        <section class="rounded-3xl p-4 sm:p-6 mb-10 shadow-sm border relative"
            style="background: #FFFDF9; border-color: #E8E2D5;">
            <!-- Washi Tape decoration -->
            <div class="absolute -top-3 right-6 washi-tape-amber h-6 w-24 rotate-[4deg] z-10 opacity-70 jagged-tape"></div>

            <div class="flex flex-col gap-4">
                <!-- Top bar: Heading & Badge -->
                <div class="flex items-center justify-between gap-2 border-b border-[#E8E2D5] pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#8A7320] text-xl">tune</span>
                        <h2 class="font-label-handwritten text-2xl font-bold text-[#1C1410]">Bộ lọc</h2>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1.5"
                            style="background: rgba(255, 227, 129, 0.4); color: #1C1410; border: 1px solid rgba(232, 200, 74, 0.5);">
                            <span class="material-symbols-outlined text-sm">photo_library</span>
                            <span x-text="filteredEvents.length + ' sự kiện'"></span>
                        </div>

                        <button x-show="hasActiveFilters" @click="resetFilters()" x-transition
                            class="text-[11px] font-bold px-2.5 py-1 rounded-full transition-all flex items-center gap-1 cursor-pointer"
                            style="background: rgba(220, 38, 38, 0.1); color: #DC2626;">
                            <span class="material-symbols-outlined text-xs">restart_alt</span>
                            Xóa
                        </button>
                    </div>
                </div>

                <!-- Search Input -->
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#7A6A52]">
                        <span class="material-symbols-outlined text-lg">search</span>
                    </span>
                    <input type="text" x-model="searchQuery" placeholder="Tìm kiếm ký ức..."
                        class="w-full pl-9 pr-3 py-2 text-xs font-semibold rounded-2xl border transition-all text-[#1C1410] outline-none"
                        style="background: #FFFFFF; border-color: #E8E2D5;">
                </div>

                <!-- Filter Controls Grid -->
                <div class="grid grid-cols-3 gap-2">
                    <!-- Year Select -->
                    <div class="relative">
                        <select x-model="selectedYear"
                            class="w-full pl-2.5 pr-6 py-2 text-xs font-bold rounded-xl border appearance-none outline-none cursor-pointer"
                            style="background: #FFFFFF; border-color: #E8E2D5; color: #1C1410;">
                            <option value="">Năm: Tất cả</option>
                            <template x-for="yr in availableYears" :key="yr">
                                <option :value="yr" x-text="yr"></option>
                            </template>
                        </select>
                        <span
                            class="material-symbols-outlined text-sm text-[#7A6A52] absolute right-1.5 top-1.5 pointer-events-none">expand_more</span>
                    </div>

                    <!-- Month Select -->
                    <div class="relative">
                        <select x-model="selectedMonth"
                            class="w-full pl-2.5 pr-6 py-2 text-xs font-bold rounded-xl border appearance-none outline-none cursor-pointer"
                            style="background: #FFFFFF; border-color: #E8E2D5; color: #1C1410;">
                            <option value="">Tháng: Tất cả</option>
                            <template x-for="m in 12" :key="m">
                                <option :value="m" x-text="'Tháng ' + m"></option>
                            </template>
                        </select>
                        <span
                            class="material-symbols-outlined text-sm text-[#7A6A52] absolute right-1.5 top-1.5 pointer-events-none">expand_more</span>
                    </div>

                    <!-- Category Select -->
                    <div class="relative">
                        <select x-model="selectedCategory"
                            class="w-full pl-2.5 pr-6 py-2 text-xs font-bold rounded-xl border appearance-none outline-none cursor-pointer"
                            style="background: #FFFFFF; border-color: #E8E2D5; color: #1C1410;">
                            <option value="">Loại: Tất cả</option>
                            <template x-for="cat in availableCategories" :key="cat">
                                <option :value="cat" x-text="cat"></option>
                            </template>
                        </select>
                        <span
                            class="material-symbols-outlined text-sm text-[#7A6A52] absolute right-1.5 top-1.5 pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- PHOTO WALL GRID (Scrapbook Polaroid Cards - 5 Cards per Page, Compact & Tilted like PC) -->
        <section class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-10">
            <template x-for="(event, index) in pagedEvents" :key="event.id || index">
                <div class="polaroid-card bg-white p-2.5 pb-6 relative rounded-sm border border-black/5 transition-transform duration-300 max-w-[320px] sm:max-w-none w-full mx-auto"
                    :class="{
                        'rotate-[2.8deg]': index % 5 === 0,
                        'rotate-[-3.5deg]': index % 5 === 1,
                        'rotate-[3.2deg]': index % 5 === 2,
                        'rotate-[-2.6deg]': index % 5 === 3,
                        'rotate-[2.2deg]': index % 5 === 4
                     }">

                    <!-- Tape Decorations -->
                    <template x-if="index % 3 === 0">
                        <div
                            class="absolute -top-2.5 left-5 washi-tape-sage h-4.5 w-16 rotate-[-8deg] z-10 opacity-70 jagged-tape">
                        </div>
                    </template>
                    <template x-if="index % 3 === 1">
                        <div
                            class="absolute -top-2 right-5 washi-tape-amber h-4.5 w-16 rotate-[10deg] z-10 opacity-70 jagged-tape">
                        </div>
                    </template>
                    <template x-if="index % 3 === 2">
                        <div
                            class="absolute -top-2.5 left-1/2 -translate-x-1/2 washi-tape-rose h-4.5 w-16 rotate-[3deg] z-10 opacity-70 jagged-tape">
                        </div>
                    </template>

                    <!-- Image Area (Compact Photo Frame - Direct Link without dark overlay) -->
                    <a :href="event.url || '#'"
                        class="block aspect-[16/10] w-full overflow-hidden bg-gray-100 mb-2.5 relative cursor-pointer rounded-xs border border-black/5">
                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                            :src="event.img" :alt="event.title" loading="lazy" />
                    </a>

                    <!-- Text Content -->
                    <div class="px-0.5">
                        <span
                            class="bg-[#E2F0D9] text-[#4F6343] px-2 py-0.5 rounded-full text-[8px] font-bold mb-1 inline-block uppercase tracking-wider"
                            x-text="event.category || 'Sự kiện'"></span>
                        <a :href="event.url || '#'" class="block">
                            <h3 class="font-label-handwritten text-xl text-[#1C1410] leading-snug line-clamp-2 hover:text-[#07A0C3] transition-colors"
                                x-text="event.title"></h3>
                        </a>
                        <p class="font-display-lg italic text-[11px] text-[#7A6A52] opacity-75 mt-0.5"
                            x-text="event.date_str"></p>
                    </div>
                </div>
            </template>

            <template x-if="filteredEvents.length === 0">
                <div class="col-span-full text-center py-16 text-[#7A6A52]">
                    <span class="material-symbols-outlined text-5xl mb-3 opacity-40">search_off</span>
                    <p class="text-base font-medium">Không tìm thấy kỷ niệm nào phù hợp.</p>
                </div>
            </template>
        </section>

        <!-- PAGINATION CONTROLS (5 sự kiện / trang) -->
        <div x-show="totalPages > 1" class="flex items-center justify-center gap-2 mb-16">
            <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                class="px-3 py-1.5 rounded-full border text-xs font-bold transition-all disabled:opacity-30 disabled:cursor-not-allowed text-[#1C1410]"
                style="border-color: #E8E2D5; background: #FFFFFF;">
                ‹ Trước
            </button>

            <template x-for="p in totalPages" :key="p">
                <button @click="goToPage(p)"
                    class="w-7 h-7 rounded-full font-bold text-xs transition-all border flex items-center justify-center"
                    :class="currentPage === p 
                            ? 'bg-[#1C1410] text-[#FFE381] border-[#1C1410] shadow-sm' 
                            : 'bg-white text-[#1C1410] border-[#E8E2D5]'">
                    <span x-text="p"></span>
                </button>
            </template>

            <button @click="goToPage(currentPage + 1)" :disabled="currentPage >= totalPages"
                class="px-3 py-1.5 rounded-full border text-xs font-bold transition-all disabled:opacity-30 disabled:cursor-not-allowed text-[#1C1410]"
                style="border-color: #E8E2D5; background: #FFFFFF;">
                Sau ›
            </button>
        </div>

        <!-- FOOTER CTA SECTION ("Còn rất nhiều kỷ niệm đang chờ được tạo ra...") -->
        <section class="mb-20 text-center flex flex-col items-center">
            <h2 class="font-label-handwritten text-3xl sm:text-4xl text-[#8A7320] mb-6 px-2">
                Còn rất nhiều kỷ niệm đang chờ được tạo ra...
            </h2>

            <div class="flex flex-col items-center gap-8 w-full max-w-xs">
                <a href="{{ route('events.index', ['status' => 'upcoming']) }}"
                    class="w-full justify-center bg-[#FFE381] hover:bg-[#E8C84A] text-[#1C1410] px-6 py-3.5 rounded-full font-extrabold shadow-md hover:shadow-lg transition-all flex items-center gap-2 group border border-[#E8C84A]">
                    Khám phá sự kiện sắp tới
                    <span
                        class="material-symbols-outlined group-hover:translate-x-1 transition-transform text-lg">arrow_forward</span>
                </a>

                <!-- Interactive Polaroid Fan Stack (Tap any card to bring it to front z-index 100) -->
                <div class="polaroid-fan-stack relative flex items-center justify-center my-4 select-none" 
                     style="width: 260px; height: 230px;">

                    <!-- CARD 0 (Left Item) -->
                    <div @click="selectFanCard(0, '{{ $upcomingEvents[0]['url'] ?? route('events.index', ['status' => 'upcoming']) }}')"
                        class="polaroid-fan-card absolute bg-white p-2.5 pb-8 w-36 flex flex-col transition-all duration-300 ease-out border border-black/5 rounded-xs shadow-md cursor-pointer"
                        :style="fanActiveIndex === 0 
                            ? 'transform: rotate(-10deg) translateX(-50px) translateY(-6px) scale(1.06); z-index: 100; box-shadow: 0 20px 40px rgba(0,0,0,0.28); opacity: 1;' 
                            : 'transform: rotate(-10deg) translateX(-50px); z-index: 10; opacity: 0.95;'">
                        <div class="w-full h-24 overflow-hidden bg-gray-100 mb-1.5 rounded-xs pointer-events-none">
                            @if(!empty($upcomingEvents[0]['img']))
                                <img src="{{ $upcomingEvents[0]['img'] }}" alt="{{ $upcomingEvents[0]['title'] }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-amber-50">
                                    <span class="font-display-lg text-3xl text-[#8A7320]/40">?</span>
                                </div>
                            @endif
                        </div>
                        <p
                            class="font-label-handwritten text-[#1C1410] text-xs leading-tight line-clamp-2 pointer-events-none font-bold">
                            {{ $upcomingEvents[0]['title'] ?? 'Khoảnh khắc 1' }}
                        </p>
                        <p class="text-[9px] text-[#7A6A52]/70 mt-0.5 pointer-events-none">
                            {{ $upcomingEvents[0]['date_str'] ?? 'Sắp diễn ra' }}
                        </p>
                    </div>

                    <!-- CARD 1 (Center Item) -->
                    <div @click="selectFanCard(1, '{{ $upcomingEvents[1]['url'] ?? route('events.index', ['status' => 'upcoming']) }}')"
                        class="polaroid-fan-card absolute bg-white p-2.5 pb-8 w-36 flex flex-col transition-all duration-300 ease-out border border-black/5 rounded-xs shadow-md cursor-pointer"
                        :style="fanActiveIndex === 1 
                            ? 'transform: rotate(0deg) translateX(0px) translateY(-8px) scale(1.06); z-index: 100; box-shadow: 0 20px 40px rgba(0,0,0,0.28); opacity: 1;' 
                            : 'transform: rotate(0deg) translateX(0px); z-index: 20; opacity: 0.95;'">
                        <div class="w-full h-24 overflow-hidden bg-gray-100 mb-1.5 rounded-xs pointer-events-none">
                            @if(!empty($upcomingEvents[1]['img']))
                                <img src="{{ $upcomingEvents[1]['img'] }}" alt="{{ $upcomingEvents[1]['title'] }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-24 bg-emerald-50/60 border border-dashed border-[#8A7320]/30 flex items-center justify-center rounded-xs">
                                    <span class="material-symbols-outlined text-3xl text-[#8A7320]/60">photo_camera</span>
                                </div>
                            @endif
                        </div>
                        <p
                            class="font-label-handwritten text-[#1C1410] text-xs leading-tight line-clamp-2 pointer-events-none font-bold">
                            {{ $upcomingEvents[1]['title'] ?? 'Khoảnh khắc tiếp theo...' }}
                        </p>
                        <p class="text-[9px] text-[#7A6A52]/70 mt-0.5 pointer-events-none">
                            {{ $upcomingEvents[1]['date_str'] ?? 'Sắp diễn ra' }}
                        </p>
                    </div>

                    <!-- CARD 2 (Right Item) -->
                    <div @click="selectFanCard(2, '{{ $upcomingEvents[2]['url'] ?? route('events.index', ['status' => 'upcoming']) }}')"
                        class="polaroid-fan-card absolute bg-white p-2.5 pb-8 w-36 flex flex-col transition-all duration-300 ease-out border border-black/5 rounded-xs shadow-md cursor-pointer"
                        :style="fanActiveIndex === 2 
                            ? 'transform: rotate(10deg) translateX(50px) translateY(-6px) scale(1.06); z-index: 100; box-shadow: 0 20px 40px rgba(0,0,0,0.28); opacity: 1;' 
                            : 'transform: rotate(10deg) translateX(50px); z-index: 30; opacity: 0.95;'">
                        <div class="w-full h-24 overflow-hidden bg-gray-100 mb-1.5 rounded-xs pointer-events-none">
                            @if(!empty($upcomingEvents[2]['img']))
                                <img src="{{ $upcomingEvents[2]['img'] }}" alt="{{ $upcomingEvents[2]['title'] }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-rose-50">
                                    <span class="font-display-lg text-3xl text-[#8A7320]/40">?</span>
                                </div>
                            @endif
                        </div>
                        <p
                            class="font-label-handwritten text-[#1C1410] text-xs leading-tight line-clamp-2 pointer-events-none font-bold">
                            {{ $upcomingEvents[2]['title'] ?? 'Khoảnh khắc 2' }}
                        </p>
                        <p class="text-[9px] text-[#7A6A52]/70 mt-0.5 pointer-events-none">
                            {{ $upcomingEvents[2]['date_str'] ?? 'Sắp diễn ra' }}
                        </p>
                    </div>

                </div>
            </div>
        </section>

    </div>

    <script>
        function archiveMobileApp() {
            return {
                events: [],
                searchQuery: '',
                selectedCategory: '',
                selectedMonth: '',
                selectedYear: '',
                currentPage: 1,
                perPage: 5,
                fanActiveIndex: 1,

                selectFanCard(i, url) {
                    if (this.fanActiveIndex === i) {
                        if (url && url !== '#') {
                            window.location.href = url;
                        }
                    } else {
                        this.fanActiveIndex = i;
                    }
                },

                initData(data) {
                    this.events = Array.isArray(data) ? data : [];
                },

                resetFilters() {
                    this.searchQuery = '';
                    this.selectedCategory = '';
                    this.selectedMonth = '';
                    this.selectedYear = '';
                    this.currentPage = 1;
                },

                get hasActiveFilters() {
                    return this.searchQuery.trim() !== '' ||
                        this.selectedCategory !== '' ||
                        this.selectedMonth !== '' ||
                        this.selectedYear !== '';
                },

                get availableYears() {
                    const ys = [...new Set(this.events.map(e => e.year || e.event_year))].filter(Boolean).sort((a, b) => b - a);
                    return ys;
                },

                get availableCategories() {
                    const cats = [...new Set(this.events.map(e => e.category || 'Sự kiện khác'))].filter(Boolean).sort();
                    return cats;
                },

                get filteredEvents() {
                    const search = this.searchQuery.toLowerCase().trim();
                    return this.events.filter(event => {
                        const matchesSearch = search === '' ||
                            (event.title && event.title.toLowerCase().includes(search)) ||
                            (event.desc && event.desc.toLowerCase().includes(search));
                        const matchesCategory = this.selectedCategory === '' || event.category === this.selectedCategory;
                        const matchesMonth = this.selectedMonth === '' || event.month == this.selectedMonth;
                        const matchesYear = this.selectedYear === '' || event.year == this.selectedYear || event.event_year == this.selectedYear;

                        return matchesSearch && matchesCategory && matchesMonth && matchesYear;
                    });
                },

                get totalPages() {
                    return Math.ceil(this.filteredEvents.length / this.perPage) || 1;
                },

                get pagedEvents() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.filteredEvents.slice(start, start + this.perPage);
                },

                goToPage(p) {
                    if (p >= 1 && p <= this.totalPages) {
                        this.currentPage = p;
                        window.scrollTo({ top: 300, behavior: 'smooth' });
                    }
                }
            }
        }
    </script>
@endsection