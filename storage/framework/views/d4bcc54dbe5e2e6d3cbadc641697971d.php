<?php $__env->startSection('title', 'Kho Lưu Trữ Ký Ức - UniEvent'); ?>

<?php $__env->startSection('content'); ?>
<?php $archiveJson = json_encode($archive); ?>
<section id="archive" class="relative py-24 lg:py-32"
         style="background:linear-gradient(160deg, #FFFDF6 0%, #FFF9E6 45%, #F4FAF5 100%);"
          x-data="{
             idx: 0,
             archive: <?php echo e($archiveJson); ?>,
             activeTab: 'images',
             lightboxImg: null,
             lightboxVideo: null,
             lightboxCaption: '',
             filterYear: '<?php echo e($selectedYear ?? ''); ?>',
             filterMonth: '',
             filterCategory: '',
             filterSearch: '',
             searchInput: '',
             _searchTimer: null,
             activeMobileFilter: null,
             debounceSearch(val) {
                 clearTimeout(this._searchTimer);
                 this._searchTimer = setTimeout(() => {
                     this.filterSearch = val;
                     this.resetIdx();
                 }, 300);
             },
             get years() {
                 const ys = [...new Set(this.archive.map(e => e.event_year))].sort((a,b)=>b-a);
                 return ys;
             },
             get categories() {
                 const cats = [...new Set(this.archive.map(e => e.category || 'Sự kiện khác'))].sort();
                 return cats;
             },
             get filteredArchive() {
                 const searchLower = this.filterSearch.toLowerCase().trim();
                 return this.archive.filter(e => {
                     const yOk = this.filterYear === '' || e.event_year == this.filterYear;
                     const mOk = this.filterMonth === '' || e.month == this.filterMonth;
                     const cOk = this.filterCategory === '' || (e.category || 'Sự kiện khác') === this.filterCategory;
                     const sOk = searchLower === '' || 
                                 (e.title && e.title.toLowerCase().includes(searchLower)) || 
                                 (e.desc && e.desc.toLowerCase().includes(searchLower));
                     
                     return yOk && mOk && cOk && sOk;
                 });
             },
             get current() {
                 const list = this.filteredArchive;
                 return list.length > 0 ? list[Math.min(this.idx, list.length - 1)] : null;
             },
             resetIdx() { 
                 this.idx = 0; 
                 this.mobilePage = 0;
             },
             mobilePage: 0,
             mobilePerPage: 10,
             get mobileTotalPages() {
                 return Math.ceil(this.filteredArchive.length / this.mobilePerPage);
             },
             get mobilePagedArchive() {
                 const start = this.mobilePage * this.mobilePerPage;
                 return this.filteredArchive.slice(start, start + this.mobilePerPage);
             },
             goToMobilePage(p) {
                 this.mobilePage = p;
                 this.$nextTick(() => {
                     if (this.$refs.mobileArchiveScrollBox) {
                         this.$refs.mobileArchiveScrollBox.scrollTop = 0;
                     }
                 });
             }
          }">

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
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
        <!-- HERO SECTION -->
        <div class="relative z-40 flex flex-col items-center text-center mt-2 mb-10 px-4" data-aos="fade-up">
            <h1 class="font-barlow-condensed text-5xl font-black uppercase tracking-tight mb-2" style="color: #1C1410;">
                Kho Lưu Trữ
            </h1>
            <p class="text-lg italic font-medium mb-3" style="color: #8A7320;">
                Những khoảnh khắc đáng nhớ nhất...
            </p>
            <p class="text-sm leading-relaxed max-w-[280px] mx-auto" style="color: #7A6A52;">
                Hành trình thanh xuân được dệt nên từ những nụ cười, những lần hội ngộ và những thành tựu rực rỡ tại UniEvent. Hãy cùng lật lại những trang ký ức đầy màu sắc của chúng ta.
            </p>
        </div>

        <!-- ── Unified Filter Bar ── -->
        <div data-aos="fade-up" data-aos-delay="100" 
             class="relative z-40 mt-10 p-4 rounded-3xl flex flex-col lg:flex-row lg:items-center gap-4 border"
             style="background: #FFFFFF; border-color: #E8E2D5; box-shadow: 0 10px 30px rgba(28, 20, 16, 0.03);">
            
            <!-- Search Keyword Input -->
            <div class="flex-1 min-w-[200px] relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <i data-lucide="search" class="h-4 w-4 text-[#7A6A52]/70"></i>
                </span>
                <input type="text" 
                       x-model="searchInput" 
                       @input="debounceSearch($event.target.value)"
                       placeholder="Tìm kiếm theo tên hoặc nội dung sự kiện..." 
                       class="w-full pl-10 pr-4 py-2.5 text-sm font-semibold rounded-2xl border transition-all placeholder-[#7A6A52]/50 text-[#1C1410] focus:ring-2 focus:ring-[#FFE381]/50 focus:border-[#FFE381] outline-none"
                       style="background: #FFFDF9; border-color: #E8E2D5;">
            </div>

            <!-- Dropdowns & Action Controls (Desktop) -->
            <div class="hidden lg:flex flex-wrap items-center gap-3">
                <!-- Year Filter Dropdown -->
                <div class="flex items-center justify-between gap-2 rounded-2xl px-4 h-11 border relative w-full md:w-auto" 
                     style="background: #FFFDF9; border-color: #E8E2D5;">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="h-4 w-4 shrink-0 text-[#8A7320]"></i>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Năm</span>
                    </div>
                    <select x-model="filterYear" @change="resetIdx()"
                            class="bg-transparent bg-none text-sm font-semibold focus:outline-none cursor-pointer pr-5 appearance-none w-full">
                        <option value="">Tất cả</option>
                        <template x-for="yr in years" :key="yr">
                            <option :value="yr" x-text="yr"></option>
                        </template>
                    </select>
                    <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] absolute right-3 pointer-events-none"></i>
                </div>

                <!-- Month Filter Dropdown -->
                <div class="flex items-center justify-between gap-2 rounded-2xl px-4 h-11 border relative w-full md:w-auto" 
                     style="background: #FFFDF9; border-color: #E8E2D5;">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar-days" class="h-4 w-4 shrink-0 text-[#07A0C3]"></i>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Tháng</span>
                    </div>
                    <select x-model="filterMonth" @change="resetIdx()"
                            class="bg-transparent bg-none text-sm font-semibold focus:outline-none cursor-pointer pr-5 appearance-none w-full">
                        <option value="">Tất cả</option>
                        <template x-for="m in [1,2,3,4,5,6,7,8,9,10,11,12]" :key="m">
                            <option :value="m" x-text="'Tháng ' + m"></option>
                        </template>
                    </select>
                    <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] absolute right-3 pointer-events-none"></i>
                </div>

                <!-- Category Filter Dropdown -->
                <div class="flex items-center justify-between gap-2 rounded-2xl px-4 h-11 border relative w-full md:w-auto" 
                     style="background: #FFFDF9; border-color: #E8E2D5;">
                    <div class="flex items-center gap-2">
                        <i data-lucide="tag" class="h-4 w-4 shrink-0 text-[#04B050]"></i>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Loại</span>
                    </div>
                    <select x-model="filterCategory" @change="resetIdx()"
                            class="bg-transparent bg-none text-sm font-semibold focus:outline-none cursor-pointer pr-5 appearance-none w-full">
                        <option value="">Tất cả</option>
                        <template x-for="cat in categories" :key="cat">
                            <option :value="cat" x-text="cat"></option>
                        </template>
                    </select>
                    <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] absolute right-3 pointer-events-none"></i>
                </div>
            </div>

            <!-- Mobile Filters (visible only on mobile) -->
            <div class="flex lg:hidden items-center justify-between gap-2 w-full mt-1">
                <!-- Year Filter Button -->
                <button @click="activeMobileFilter = (activeMobileFilter === 'year' ? null : 'year')"
                        type="button"
                        class="flex-grow flex items-center justify-center gap-1.5 py-2 px-2.5 rounded-2xl border text-sm font-semibold transition-all h-11 focus:outline-none"
                        :class="activeMobileFilter === 'year' ? 'bg-[#FFE381]/20 border-[#FFE381] text-[#8A7320]' : (filterYear !== '' ? 'bg-[#FFE381]/10 border-[#FFE381]/50 text-[#8A7320]' : 'bg-[#FFFDF9] border-[#E8E2D5] text-[#7A6A52]')">
                    <i data-lucide="calendar" class="h-4.5 w-4.5 shrink-0 text-[#8A7320]"></i>
                    <span x-show="filterYear !== ''" class="text-xs font-bold animate-fade-in" x-text="filterYear"></span>
                </button>

                <!-- Month Filter Button -->
                <button @click="activeMobileFilter = (activeMobileFilter === 'month' ? null : 'month')"
                        type="button"
                        class="flex-grow flex items-center justify-center gap-1.5 py-2 px-2.5 rounded-2xl border text-sm font-semibold transition-all h-11 focus:outline-none"
                        :class="activeMobileFilter === 'month' ? 'bg-[#07A0C3]/10 border-[#07A0C3] text-[#07A0C3]' : (filterMonth !== '' ? 'bg-[#07A0C3]/5 border-[#07A0C3]/50 text-[#07A0C3]' : 'bg-[#FFFDF9] border-[#E8E2D5] text-[#7A6A52]')">
                    <i data-lucide="calendar-days" class="h-4.5 w-4.5 shrink-0 text-[#07A0C3]"></i>
                    <span x-show="filterMonth !== ''" class="text-xs font-bold animate-fade-in" x-text="'T' + filterMonth"></span>
                </button>

                <!-- Category Filter Button -->
                <button @click="activeMobileFilter = (activeMobileFilter === 'category' ? null : 'category')"
                        type="button"
                        class="flex-grow flex items-center justify-center gap-1.5 py-2 px-2.5 rounded-2xl border text-sm font-semibold transition-all h-11 focus:outline-none"
                        :class="activeMobileFilter === 'category' ? 'bg-[#04B050]/10 border-[#04B050] text-[#04B050]' : (filterCategory !== '' ? 'bg-[#04B050]/5 border-[#04B050]/50 text-[#04B050]' : 'bg-[#FFFDF9] border-[#E8E2D5] text-[#7A6A52]')">
                    <i data-lucide="tag" class="h-4.5 w-4.5 shrink-0 text-[#04B050]"></i>
                    <span x-show="filterCategory !== ''" class="text-xs font-bold max-w-[60px] truncate animate-fade-in" x-text="filterCategory"></span>
                </button>
            </div>

            <!-- Mobile Filter Options Panel (visible only on mobile) -->
            <div x-show="activeMobileFilter !== null"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 -translate-y-1 scale-98"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-1 scale-98"
                 class="w-full mt-1 p-3.5 rounded-2xl border bg-[#FFFDF9] border-[#E8E2D5] shadow-sm lg:hidden z-50"
                 style="display: none;"
                 @click.away="activeMobileFilter = null">
                 
                 <!-- Year Options -->
                 <div x-show="activeMobileFilter === 'year'" class="flex flex-wrap gap-2 justify-start">
                     <button @click="filterYear = ''; resetIdx(); activeMobileFilter = null;"
                             type="button"
                             class="px-3.5 py-2 rounded-xl text-xs font-bold border transition-all"
                             :class="filterYear === '' ? 'bg-[#FFE381] border-[#FFE381] text-[#1C1410] shadow-sm' : 'bg-white border-[#E8E2D5] text-[#7A6A52]'">
                         Tất cả năm
                     </button>
                     <template x-for="yr in years" :key="yr">
                         <button @click="filterYear = yr; resetIdx(); activeMobileFilter = null;"
                                 type="button"
                                 class="px-3.5 py-2 rounded-xl text-xs font-bold border transition-all"
                                 :class="filterYear == yr ? 'bg-[#FFE381] border-[#FFE381] text-[#1C1410] shadow-sm' : 'bg-white border-[#E8E2D5] text-[#7A6A52]'"
                                 x-text="yr">
                         </button>
                     </template>
                 </div>

                 <!-- Month Options -->
                 <div x-show="activeMobileFilter === 'month'" class="grid grid-cols-4 gap-2">
                     <button @click="filterMonth = ''; resetIdx(); activeMobileFilter = null;"
                             type="button"
                             class="col-span-4 px-3.5 py-2 rounded-xl text-xs font-bold border transition-all text-center"
                             :class="filterMonth === '' ? 'bg-[#07A0C3] border-[#07A0C3] text-white shadow-sm' : 'bg-white border-[#E8E2D5] text-[#7A6A52]'">
                         Tất cả tháng
                     </button>
                     <template x-for="m in [1,2,3,4,5,6,7,8,9,10,11,12]" :key="m">
                         <button @click="filterMonth = m; resetIdx(); activeMobileFilter = null;"
                                 type="button"
                                 class="px-2.5 py-2 rounded-xl text-xs font-bold border transition-all text-center"
                                 :class="filterMonth == m ? 'bg-[#07A0C3] border-[#07A0C3] text-white shadow-sm' : 'bg-white border-[#E8E2D5] text-[#7A6A52]'"
                                 x-text="'T' + m">
                         </button>
                     </template>
                 </div>

                 <!-- Category Options -->
                 <div x-show="activeMobileFilter === 'category'" class="flex flex-col gap-1 max-h-48 overflow-y-auto custom-scrollbar">
                     <button @click="filterCategory = ''; resetIdx(); activeMobileFilter = null;"
                             type="button"
                             class="w-full text-left px-3.5 py-2.5 rounded-xl text-xs font-bold border transition-all"
                             :class="filterCategory === '' ? 'bg-[#04B050] border-[#04B050] text-white shadow-sm' : 'bg-white border-[#E8E2D5] text-[#7A6A52]'">
                         Tất cả loại
                     </button>
                     <template x-for="cat in categories" :key="cat">
                         <button @click="filterCategory = cat; resetIdx(); activeMobileFilter = null;"
                                 type="button"
                                 class="w-full text-left px-3.5 py-2.5 rounded-xl text-xs font-bold border transition-all"
                                 :class="filterCategory === cat ? 'bg-[#04B050] border-[#04B050] text-white shadow-sm' : 'bg-white border-[#E8E2D5] text-[#7A6A52]'"
                                 x-text="cat">
                         </button>
                     </template>
                 </div>
            </div>

            <!-- Result Count & Clear Filter -->
            <div class="flex items-center justify-between lg:justify-end gap-4 shrink-0 lg:ml-auto pt-3 lg:pt-0 border-t lg:border-t-0 border-[#E8E2D5]/50 w-full lg:w-auto">
                <span class="text-xs font-semibold text-[#7A6A52]">
                    Tìm thấy <span class="font-bold text-[#1C1410]" x-text="filteredArchive.length"></span> sự kiện
                </span>
            </div>
        </div>

        <div class="mt-4 flex justify-end"
             x-show="filterYear !== '' || filterMonth !== '' || filterCategory !== '' || filterSearch !== ''"
             x-transition>
            <button @click="filterYear=''; filterMonth=''; filterCategory=''; filterSearch=''; searchInput=''; resetIdx();"
                    class="text-xs font-bold px-3.5 py-2 rounded-2xl transition-all hover:opacity-90 flex items-center gap-1.5 shadow-sm"
                    style="background:#FFF3C4; color:#1C1410; border:1px solid #E8C84A;">
                <i data-lucide="x" class="h-3.5 w-3.5"></i> Xóa lọc
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-12">
             <!-- Left Column: Scrollable Event List -->
             <div data-aos="fade-right" class="lg:col-span-4 relative" x-data="{ archiveReady: false }" x-init="setTimeout(() => archiveReady = true, 500)">
                 <style>
                     @keyframes archiveShimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
                     .archive-skeleton { background: linear-gradient(90deg, rgba(232,226,213,0.5) 25%, rgba(255,253,249,0.8) 50%, rgba(232,226,213,0.5) 75%); background-size: 200% 100%; animation: archiveShimmer 1.5s infinite; }
                 </style>
                 <div x-show="!archiveReady" class="space-y-4 absolute inset-0 z-10 w-full" style="background:transparent;">
                     <template x-for="i in 3">
                         <div class="w-full rounded-2xl h-[98px] archive-skeleton border border-[#E8E2D5]/50 bg-white"></div>
                     </template>
                 </div>
                 
                 <!-- Desktop View: Scrollable List -->
                 <div x-show="archiveReady" style="display: none;" class="hidden lg:block space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar" x-transition:enter="transition-opacity ease-out duration-300">
                     <template x-for="(ev, i) in filteredArchive" :key="ev.id || i">
                         <button @click="idx = i; activeTab = 'images'"
                                 class="w-full text-left rounded-2xl p-4 flex gap-4 transition-all duration-300 border focus:outline-none"
                                 :style="idx === i 
                                     ? 'background:#FFE381; border-color:#FFE381; color:#1C1410; box-shadow:0 8px 24px rgba(255,227,129,0.25);' 
                                     : 'background:#FFFFFF; border-color:#E8E2D5; color:#1C1410; box-shadow:0 2px 8px rgba(28,20,16,0.02);'">
                             
                             <!-- Cover Image Thumbnail -->
                             <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 bg-[#1C1410]/5 border border-[#E8E2D5]/50">
                                 <img :src="ev.img" loading="lazy" class="w-full h-full object-cover" />
                             </div>
                             
                             <div class="flex flex-col justify-between overflow-hidden flex-1">
                                 <div>
                                     <div class="text-[10px] font-bold font-mono uppercase tracking-wider flex items-center gap-2"
                                          :style="idx === i ? 'color:#7A6A52;' : 'color:#8A7320;'">
                                         <span x-text="'T' + ev.month + '/' + ev.event_year"></span>
                                         <span x-show="ev.year && ev.year !== String(ev.event_year)"
                                               class="text-[8px] px-1.5 py-0.5 rounded-full"
                                               :style="idx === i ? 'background:rgba(28,20,16,0.1); color:#1C1410;' : 'background:rgba(122,106,82,0.1); color:#7A6A52;'"
                                               x-text="'NH ' + ev.year"></span>
                                     </div>
                                     <h4 class="font-['Barlow_Condensed'] text-lg font-bold uppercase tracking-wide truncate mt-0.5"
                                         x-text="ev.title"></h4>
                                 </div>
                                 
                                 <div class="flex gap-2 mt-2">
                                     <span class="text-[9px] font-bold px-2 py-0.5 rounded-full"
                                           :style="idx === i ? 'background:rgba(28,20,16,0.1); color:#1C1410;' : 'background:rgba(122,106,82,0.1); color:#7A6A52;'">
                                         <span x-text="ev.images.length"></span> ảnh
                                     </span>
                                 </div>
                             </div>
                         </button>
                     </template>
                     <div x-show="filteredArchive.length === 0" class="text-center py-12 text-[#7A6A52]/70 text-sm">
                         <i data-lucide="search-x" class="h-10 w-10 mx-auto mb-3 text-[#7A6A52]/50"></i>
                         <p class="font-semibold">Không tìm thấy sự kiện nào phù hợp.</p>
                         <button @click="filterYear=''; filterMonth=''; filterCategory=''; filterSearch=''; searchInput=''; resetIdx();" 
                                 class="mt-3 text-xs underline font-bold text-[#07A0C3] hover:text-[#04B050] transition-colors">
                             Xóa bộ lọc
                         </button>
                     </div>
                 </div>

                 <!-- Mobile View: Paginated Vertical Slider -->
                 <div x-show="archiveReady" style="display: none;" class="block lg:hidden space-y-4" x-transition:enter="transition-opacity ease-out duration-300">
                     <div class="relative rounded-2xl border border-black/5 bg-white/50" style="backdrop-filter: blur(4px);">
                         <div x-ref="mobileArchiveScrollBox" class="overflow-y-auto px-2 py-2 flex flex-col gap-2.5" style="max-height: 220px; scrollbar-width: thin;">
                             <template x-for="(ev, i) in mobilePagedArchive" :key="mobilePage + '-' + i">
                                 <button @click="idx = (mobilePage * mobilePerPage) + i; activeTab = 'images'; $nextTick(() => { document.getElementById('detail-pane').scrollIntoView({ behavior: 'smooth' }); });"
                                         class="w-full text-left rounded-2xl p-3 flex gap-3 transition-all duration-300 border focus:outline-none"
                                         :style="idx === ((mobilePage * mobilePerPage) + i) 
                                             ? 'background:#FFE381; border-color:#FFE381; color:#1C1410; box-shadow:0 8px 24px rgba(255,227,129,0.25);' 
                                             : 'background:#FFFFFF; border-color:#E8E2D5; color:#1C1410; box-shadow:0 2px 8px rgba(28,20,16,0.02);'">
                                     
                                     <!-- Cover Image Thumbnail -->
                                     <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-[#1C1410]/5 border border-[#E8E2D5]/50">
                                         <img :src="ev.img" loading="lazy" class="w-full h-full object-cover" />
                                     </div>
                                     
                                     <div class="flex flex-col justify-between overflow-hidden flex-1">
                                         <div>
                                             <div class="text-[10px] font-bold font-mono uppercase tracking-wider flex items-center gap-2"
                                                  :style="idx === ((mobilePage * mobilePerPage) + i) ? 'color:#7A6A52;' : 'color:#8A7320;'">
                                                 <span x-text="'T' + ev.month + '/' + ev.event_year"></span>
                                                 <span x-show="ev.year && ev.year !== String(ev.event_year)"
                                                       class="text-[8px] px-1.5 py-0.5 rounded-full"
                                                       :style="idx === ((mobilePage * mobilePerPage) + i) ? 'background:rgba(28,20,16,0.1); color:#1C1410;' : 'background:rgba(122,106,82,0.1); color:#7A6A52;'"
                                                       x-text="'NH ' + ev.year"></span>
                                             </div>
                                             <h4 class="font-['Barlow_Condensed'] text-lg font-bold uppercase tracking-wide truncate mt-0.5"
                                                 x-text="ev.title"></h4>
                                         </div>
                                         
                                         <div class="flex gap-2 mt-2">
                                             <span class="text-[9px] font-bold px-2 py-0.5 rounded-full"
                                                   :style="idx === ((mobilePage * mobilePerPage) + i) ? 'background:rgba(28,20,16,0.1); color:#1C1410;' : 'background:rgba(122,106,82,0.1); color:#7A6A52;'">
                                                 <span x-text="ev.images.length"></span> ảnh
                                             </span>
                                         </div>
                                     </div>
                                 </button>
                             </template>
                             <div x-show="filteredArchive.length === 0" class="text-center py-12 text-[#7A6A52]/70 text-sm">
                                 <i data-lucide="search-x" class="h-10 w-10 mx-auto mb-3 text-[#7A6A52]/50"></i>
                                 <p class="font-semibold">Không tìm thấy sự kiện nào phù hợp.</p>
                             </div>
                         </div>
                         <!-- Bottom fade hint -->
                         <div class="absolute bottom-0 left-0 right-0 h-8 rounded-b-2xl pointer-events-none" style="background: linear-gradient(to top, rgba(255,251,234,0.95), transparent);"></div>
                     </div>

                     <!-- Mobile Pagination Indicators -->
                     <template x-if="mobileTotalPages > 1">
                         <div class="flex items-center justify-center gap-2 mt-4">
                             <button @click="goToMobilePage(mobilePage - 1)" :disabled="mobilePage === 0"
                                     class="w-8 h-8 rounded-full flex items-center justify-center text-sm border transition-all focus:outline-none"
                                     :class="mobilePage === 0 ? 'border-gray-200 text-gray-300 cursor-not-allowed' : 'border-[#E8E2D5] text-[#7A6A52] active:bg-[#FFE381]/20'">
                                 ‹
                             </button>
                             <template x-for="p in mobileTotalPages" :key="p">
                                 <button @click="goToMobilePage(p - 1)"
                                         class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all focus:outline-none"
                                         :class="mobilePage === p - 1 ? 'bg-[#07A0C3] text-white shadow-sm border border-[#07A0C3]' : 'text-[#7A6A52] border border-[#E8E2D5] bg-white active:bg-gray-100'">
                                     <span x-text="p"></span>
                                 </button>
                             </template>
                             <button @click="goToMobilePage(mobilePage + 1)" :disabled="mobilePage >= mobileTotalPages - 1"
                                     class="w-8 h-8 rounded-full flex items-center justify-center text-sm border transition-all focus:outline-none"
                                     :class="mobilePage >= mobileTotalPages - 1 ? 'border-gray-200 text-gray-300 cursor-not-allowed' : 'border-[#E8E2D5] text-[#7A6A52] active:bg-[#FFE381]/20'">
                                 ›
                             </button>
                         </div>
                     </template>
                 </div>
             </div>
 
             <!-- Right Column: Detail Viewer Pane (Read-Only) -->
             <div id="detail-pane"
                  data-aos="fade-left" 
                  class="lg:col-span-8 rounded-3xl p-6 lg:p-8 flex flex-col justify-between min-h-[500px] transition-all duration-300 border"
                  style="background:#FFFFFF; border-color:#E8E2D5; box-shadow:0 12px 40px rgba(28,20,16,0.04);">
                
                <div x-show="current">
                    <!-- Event Header -->
                    <div class="flex flex-col md:flex-row gap-6 pb-6 border-b border-[#E8E2D5]">
                        <div class="w-full md:w-48 h-32 rounded-xl overflow-hidden shrink-0 bg-[#1C1410]/5 border border-[#E8E2D5]/50">
                            <img :src="current.img" loading="lazy" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-2 flex-wrap">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-[0.25em] text-[#1C1410]" style="background:#FFE381;">
                                    ✦ Năm học <span x-text="current.year"></span>
                                </span>
                                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-[9px] font-bold text-[#07A0C3]" style="background:rgba(7,160,195,0.07); border:1px solid rgba(7,160,195,0.2);">
                                    <i data-lucide="calendar" class="h-2.5 w-2.5"></i>
                                    <span x-text="'Tháng ' + current.month + '/' + current.event_year"></span>
                                </span>
                            </div>
                            <h3 class="font-['Barlow_Condensed'] text-2xl lg:text-3xl font-black uppercase tracking-wide text-[#1C1410] mt-2" x-text="current.title"></h3>
                            
                            <!-- Achievements/Metadata Row -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <template x-for="ach in current.achievements" :key="ach">
                                    <span class="text-[10px] font-semibold px-2.5 py-1 rounded-lg bg-[#1C1410]/5 border border-[#E8E2D5] text-[#7A6A52]" x-text="ach"></span>
                                </template>
                            </div>
                        </div>
                    </div>


                    <!-- Tabs Container -->
                    <div class="mt-8">
                        <!-- Tab Headers -->
                        <div class="flex border-b border-[#E8E2D5] gap-4 mb-6">
                            <button @click="activeTab = 'images'"
                                    class="pb-3 text-sm font-bold tracking-wider uppercase border-b-2 transition-all flex items-center gap-2 focus:outline-none"
                                    :class="activeTab === 'images' ? 'border-[#1C1410] text-[#1C1410]' : 'border-transparent text-[#7A6A52] hover:text-[#1C1410]'">
                                <i data-lucide="image" class="h-4 w-4"></i> Ảnh & Video
                            </button>

                            <button @click="activeTab = 'speakers'"
                                    class="pb-3 text-sm font-bold tracking-wider uppercase border-b-2 transition-all flex items-center gap-2 focus:outline-none"
                                    :class="activeTab === 'speakers' ? 'border-[#1C1410] text-[#1C1410]' : 'border-transparent text-[#7A6A52] hover:text-[#1C1410]'">
                                <i data-lucide="users" class="h-4 w-4"></i> Diễn giả tham gia
                            </button>
                        </div>

                        <!-- Tab 1: Image & Video Gallery -->
                        <div x-show="activeTab === 'images'" class="space-y-4">
                            <div class="max-h-[200px] overflow-y-auto lg:max-h-none pr-1 custom-scrollbar">
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-6">
                                    <!-- Images -->
                                    <template x-for="(img, idxImg) in current.images" :key="'img-'+idxImg">
                                        <div class="flex flex-col gap-1.5 cursor-pointer">
                                            <div class="group relative aspect-video rounded-xl overflow-hidden border border-[#E8E2D5] bg-black/5"
                                                 @click="lightboxImg = img.url; lightboxCaption = img.caption; lightboxVideo = null;">
                                                <img :src="img.url" loading="lazy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                            </div>
                                            <!-- Caption BELOW the image -->
                                            <p class="text-[10px] sm:text-xs text-slate-600 font-medium px-1 line-clamp-2 mt-0.5 leading-snug break-all" 
                                               x-show="img.caption" 
                                               x-text="img.caption"></p>
                                        </div>
                                    </template>
                                    
                                    <!-- Videos -->
                                    <template x-for="(vid, idxVid) in current.videos" :key="'vid-'+idxVid">
                                        <div class="flex flex-col gap-1.5 cursor-pointer">
                                            <div class="group relative aspect-video rounded-xl overflow-hidden border border-[#E8E2D5] bg-black/10 flex items-center justify-center"
                                                 @click="lightboxVideo = vid.url; lightboxCaption = vid.caption; lightboxImg = null;">
                                                <!-- Play icon overlay -->
                                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-all flex items-center justify-center z-10">
                                                    <div class="w-10 h-10 rounded-full bg-[#FFE381] text-[#1C1410] flex items-center justify-center shadow-lg transition-transform group-hover:scale-110">
                                                        <i data-lucide="play" class="h-4 w-4 fill-current translate-x-0.5"></i>
                                                    </div>
                                                </div>
                                                <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=500&q=80" loading="lazy" class="w-full h-full object-cover" />
                                            </div>
                                            <!-- Caption BELOW the video -->
                                            <p class="text-[10px] sm:text-xs text-slate-600 font-medium px-1 line-clamp-2 mt-0.5 leading-snug break-all" 
                                               x-show="vid.caption" 
                                               x-text="vid.caption"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div x-show="current && current.images.length === 0 && current.videos.length === 0" class="text-center py-10 text-[#7A6A52]/50 text-sm animate-fade-in">
                                Không có ảnh hoặc video lưu trữ cho sự kiện này.
                            </div>
                        </div>



                        <!-- Tab 3: Speakers -->
                        <div x-show="activeTab === 'speakers'" class="space-y-3">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <template x-for="(speaker, idxSpk) in current.speakers" :key="idxSpk">
                                    <div class="rounded-xl p-4 flex items-center gap-4 bg-[#1C1410]/5 border border-[#E8E2D5] transition-all hover:bg-[#1C1410]/10">
                                        <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 bg-[#E8E2D5]">
                                            <template x-if="speaker.avatar">
                                                <img :src="speaker.avatar" class="w-full h-full object-cover" />
                                            </template>
                                            <template x-if="!speaker.avatar">
                                                <div class="w-full h-full flex items-center justify-center text-[#7A6A52] bg-[#FFE381]/20">
                                                    <i data-lucide="user" class="h-5 w-5"></i>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="overflow-hidden">
                                            <h4 class="text-sm font-bold text-[#1C1410] truncate w-full" x-text="speaker.name"></h4>
                                            <p class="text-xs text-[#7A6A52] mt-0.5 truncate" x-text="speaker.role"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div x-show="current && current.speakers && current.speakers.length === 0" class="text-center py-10 text-[#7A6A52]/50 text-sm">
                                Không có thông tin diễn giả cho sự kiện này.
                            </div>
                        </div>
                    </div>
                    <!-- Fallback if no event selected -->
                    <div x-show="!current" class="flex flex-col items-center justify-center py-20 text-[#7A6A52]/50">
                        <i data-lucide="archive" class="h-12 w-12 mb-3 opacity-60"></i>
                        <p class="text-sm font-semibold">Vui lòng chọn một sự kiện để xem chi tiết.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image/Video Lightbox Modal -->
        <div x-show="lightboxImg || lightboxVideo" 
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/95 backdrop-blur-md"
             style="display: none;"
             @keydown.escape.window="lightboxImg = null; lightboxVideo = null;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <button @click="lightboxImg = null; lightboxVideo = null;" class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors bg-white/10 hover:bg-white/20 p-2 rounded-full focus:outline-none">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
            <div class="max-w-4xl max-h-[85vh] flex flex-col items-center" @click.away="lightboxImg = null; lightboxVideo = null;">
                <div x-show="lightboxImg" class="w-full flex justify-center">
                    <img :src="lightboxImg" class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl" />
                </div>
                <div x-show="lightboxVideo" class="w-full flex justify-center bg-black rounded-lg overflow-hidden">
                    <video :src="lightboxVideo" controls autoplay class="max-w-full max-h-[75vh] object-contain"></video>
                </div>
                <p class="mt-4 text-white/90 text-sm text-center max-w-lg" x-text="lightboxCaption"></p>
            </div>
        </div>
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

    <!-- Scroll to Top Button -->
    <button class="fixed bottom-8 right-8 w-14 h-14 bg-secondary text-on-secondary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-90 transition-all z-50 group" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <span class="material-symbols-outlined group-hover:-translate-y-1 transition-transform">keyboard_arrow_up</span>
    </button>

    <script>
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

<?php echo $__env->make('layouts.frontend-mobile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/frontend/archive-mobile.blade.php ENDPATH**/ ?>