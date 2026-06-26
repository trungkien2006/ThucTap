@extends('layouts.frontend')
@section('content')
@php $archiveJson = json_encode($archive); @endphp
<section id="archive" class="relative py-24 lg:py-32"
         style="background:linear-gradient(160deg, #FFFDF6 0%, #FFF9E6 45%, #F4FAF5 100%);"
         x-data="{
            idx: 0,
            archive: {{ $archiveJson }},
            activeTab: 'images',
            lightboxImg: null,
            lightboxVideo: null,
            lightboxCaption: '',
            filterYear: '{{ $selectedYear ?? '' }}',
            filterMonth: '',
            filterCategory: '',
            filterSearch: '',
            filterFileTypes: [],
            showFileTypeDropdown: false,
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
                    
                    let fOk = true;
                    if (this.filterFileTypes.length > 0) {
                        fOk = this.filterFileTypes.some(type => {
                            if (type === 'image') {
                                return e.images && e.images.length > 0;
                            }
                            if (type === 'video') {
                                return e.videos && e.videos.length > 0;
                            }
                            if (type === 'document') {
                                const docTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];
                                return e.documents && e.documents.some(d => docTypes.includes(d.type));
                            }
                            if (type === 'archive') {
                                return e.documents && e.documents.some(d => d.type === 'zip');
                            }
                            return false;
                        });
                    }
                    return yOk && mOk && cOk && sOk && fOk;
                });
            },
            get current() {
                const list = this.filteredArchive;
                return list.length > 0 ? list[Math.min(this.idx, list.length - 1)] : null;
            },
            resetIdx() { this.idx = 0; }
         }">

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(28, 20, 16, 0.02);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(28, 20, 16, 0.15);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(28, 20, 16, 0.3);
        }
        #archive select {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            background-color: transparent !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            padding-right: 1.5rem !important;
        }
        #archive select::-ms-expand {
            display: none !important;
        }
    </style>

    <!-- Soft aesthetic blobs -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -left-32 top-1/4 h-[450px] w-[450px] rounded-full blur-[140px] opacity-20" style="background:#FFE381;"></div>
        <div class="absolute -right-32 bottom-10 h-[350px] w-[350px] rounded-full blur-[140px] opacity-15" style="background:#07A0C3;"></div>
        <div class="absolute left-1/2 bottom-0 h-40 w-[600px] -translate-x-1/2 rounded-full blur-[100px] opacity-10" style="background:#04F06A;"></div>
    </div>
    <!-- Top border Jasmine -->
    <div class="absolute inset-x-0 top-0 h-1.5" style="background:#FFE381;"></div>

    <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">
        <div data-aos="fade-up" class="flex items-end justify-between">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-7 w-1 rounded-full" style="background:#8A7320;"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.25em]" style="color:#8A7320;">Archive</span>
                </div>
                <h2 class="font-['Inter'] text-5xl font-black uppercase tracking-tight text-[#1C1410] lg:text-7xl">Kho lưu trữ sự kiện</h2>
                <p class="mt-3 max-w-md leading-relaxed text-[#7A6A52]">
                    Khám phá các sự kiện đã qua, cùng với hình ảnh ghi niệm và tài liệu học thuật đính kèm.
                </p>
            </div>
        </div>

        <!-- ── Unified Filter Bar ── -->
        <div data-aos="fade-up" data-aos-delay="100" 
             class="relative z-40 mt-10 p-4 rounded-3xl flex flex-col gap-4 border"
             style="background: #FFFFFF; border-color: #E8E2D5; box-shadow: 0 10px 30px rgba(28, 20, 16, 0.03);">
            
            <!-- Top Row: Search & Filters -->
            <div class="flex flex-col lg:flex-row lg:items-center gap-4 w-full">
                <!-- Search Keyword Input -->
                <div class="flex-1 min-w-[200px] relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-4 w-4 text-[#7A6A52]/70"></i>
                    </span>
                    <input type="text" 
                           x-model="filterSearch" 
                           @input="resetIdx()"
                           placeholder="Tìm kiếm theo tên hoặc nội dung sự kiện..." 
                           class="w-full pl-10 pr-4 py-2.5 text-sm font-semibold rounded-2xl border transition-all placeholder-[#7A6A52]/50 text-[#1C1410] focus:ring-2 focus:ring-[#FFE381]/50 focus:border-[#FFE381] outline-none"
                           style="background: #FFFDF9; border-color: #E8E2D5;">
                </div>

                <!-- Dropdowns & Action Controls -->
                <div class="flex flex-wrap items-center gap-3">
                    <!-- Year Filter Dropdown -->
                    <div class="flex items-center gap-2 rounded-full px-4 py-2.5 border relative transition-all duration-300 hover:border-[#E8C84A] hover:bg-white hover:shadow-md cursor-pointer group" 
                         style="background: #FFFDF9; border-color: #E8E2D5;">
                        <i data-lucide="calendar" class="h-4 w-4 shrink-0 text-[#8A7320] transition-transform group-hover:scale-110"></i>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Năm</span>
                        <span class="text-sm font-semibold text-[#1C1410] min-w-[45px]" x-text="filterYear === '' ? 'Tất cả' : filterYear"></span>
                        <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] transition-colors group-hover:text-[#1C1410]"></i>
                        <select x-model="filterYear" @change="resetIdx()"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer appearance-none">
                            <option value="">Tất cả</option>
                            <template x-for="yr in years" :key="yr">
                                <option :value="yr" x-text="yr"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Month Filter Dropdown -->
                    <div class="flex items-center gap-2 rounded-full px-4 py-2.5 border relative transition-all duration-300 hover:border-[#07A0C3] hover:bg-white hover:shadow-md cursor-pointer group" 
                         style="background: #FFFDF9; border-color: #E8E2D5;">
                        <i data-lucide="calendar-days" class="h-4 w-4 shrink-0 text-[#07A0C3] transition-transform group-hover:scale-110"></i>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Tháng</span>
                        <span class="text-sm font-semibold text-[#1C1410] min-w-[60px]" x-text="filterMonth === '' ? 'Tất cả' : 'Tháng ' + filterMonth"></span>
                        <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] transition-colors group-hover:text-[#1C1410]"></i>
                        <select x-model="filterMonth" @change="resetIdx()"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer appearance-none">
                            <option value="">Tất cả</option>
                            <template x-for="m in [1,2,3,4,5,6,7,8,9,10,11,12]" :key="m">
                                <option :value="m" x-text="'Tháng ' + m"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Category Filter Dropdown -->
                    <div class="flex items-center gap-2 rounded-full px-4 py-2.5 border relative transition-all duration-300 hover:border-[#04B050] hover:bg-white hover:shadow-md cursor-pointer group" 
                         style="background: #FFFDF9; border-color: #E8E2D5;">
                        <i data-lucide="tag" class="h-4 w-4 shrink-0 text-[#04B050] transition-transform group-hover:scale-110"></i>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Loại</span>
                        <span class="text-sm font-semibold text-[#1C1410] min-w-[50px] truncate max-w-[80px]" x-text="filterCategory === '' ? 'Tất cả' : filterCategory"></span>
                        <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] transition-colors group-hover:text-[#1C1410]"></i>
                        <select x-model="filterCategory" @change="resetIdx()"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer appearance-none">
                            <option value="">Tất cả</option>
                            <template x-for="cat in categories" :key="cat">
                                <option :value="cat" x-text="cat"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Attached File Filter Custom Multi-select Dropdown -->
                    <div class="relative" @click.away="showFileTypeDropdown = false">
                        <div @click="showFileTypeDropdown = !showFileTypeDropdown"
                             class="flex items-center gap-2 rounded-full px-4 py-2.5 border cursor-pointer select-none transition-all duration-300 hover:border-[#FF4D4D] hover:bg-white hover:shadow-md group" 
                             style="background: #FFFDF9; border-color: #E8E2D5;">
                            <i data-lucide="paperclip" class="h-4 w-4 shrink-0 text-[#FF4D4D] transition-transform group-hover:scale-110"></i>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#7A6A52] mr-1">Đính kèm</span>
                            <span class="text-sm font-semibold text-[#1C1410] min-w-[45px] max-w-[100px] truncate" 
                                  x-text="filterFileTypes.length === 0 ? 'Tất cả' : (filterFileTypes.length + ' loại')"></span>
                            <i data-lucide="chevron-down" class="h-3 w-3 shrink-0 text-[#7A6A52] transition-transform group-hover:text-[#1C1410]" :class="showFileTypeDropdown ? 'rotate-180' : ''"></i>
                        </div>
                        
                        <!-- Dropdown Checkbox list -->
                        <div x-show="showFileTypeDropdown" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute right-0 mt-2 w-48 rounded-2xl border p-3.5 z-40 shadow-xl flex flex-col gap-2.5"
                             style="background: #FFFFFF; border-color: #E8E2D5; display: none;">
                            
                            <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-[#7A6A52] hover:text-[#1C1410] select-none">
                                <input type="checkbox" x-model="filterFileTypes" value="image" @change="resetIdx()"
                                       class="w-4 h-4 rounded border-[#E8E2D5] text-[#FFE381] focus:ring-0 cursor-pointer accent-[#FFE381]">
                                <span>🖼️ Hình ảnh</span>
                            </label>
                            <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-[#7A6A52] hover:text-[#1C1410] select-none">
                                <input type="checkbox" x-model="filterFileTypes" value="video" @change="resetIdx()"
                                       class="w-4 h-4 rounded border-[#E8E2D5] text-[#FFE381] focus:ring-0 cursor-pointer accent-[#FF4D4D]">
                                <span>🎥 Video</span>
                            </label>
                            <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-[#7A6A52] hover:text-[#1C1410] select-none">
                                <input type="checkbox" x-model="filterFileTypes" value="document" @change="resetIdx()"
                                       class="w-4 h-4 rounded border-[#E8E2D5] text-[#FFE381] focus:ring-0 cursor-pointer accent-[#04B050]">
                                <span>📄 Tài liệu & Văn bản</span>
                            </label>
                            <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-[#7A6A52] hover:text-[#1C1410] select-none">
                                <input type="checkbox" x-model="filterFileTypes" value="archive" @change="resetIdx()"
                                       class="w-4 h-4 rounded border-[#E8E2D5] text-[#FFE381] focus:ring-0 cursor-pointer accent-[#007ACC]">
                                <span>🗜️ Tệp nén</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Row: Result Count & Clear Filter -->
            <div class="flex items-center justify-between gap-4 pt-3 border-t border-[#E8E2D5]/50 w-full">
                <span class="text-xs font-semibold text-[#7A6A52]">
                    Tìm thấy <span class="font-bold text-[#1C1410]" x-text="filteredArchive.length"></span> sự kiện
                </span>
                <button @click="filterYear=''; filterMonth=''; filterCategory=''; filterSearch=''; filterFileTypes=[]; resetIdx();"
                        x-show="filterYear !== '' || filterMonth !== '' || filterCategory !== '' || filterSearch !== '' || filterFileTypes.length > 0"
                        class="text-xs font-bold px-3.5 py-2 rounded-2xl transition-all hover:opacity-90 flex items-center gap-1.5 shadow-sm"
                        style="background:#FFF3C4; color:#1C1410; border:1px solid #E8C84A;">
                    <i data-lucide="x" class="h-3.5 w-3.5"></i> Xóa lọc
                </button>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[400px_1fr] lg:gap-12">
            <!-- Left Column: Scrollable Event List -->
            <div data-aos="fade-right" class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                <template x-for="(ev, i) in filteredArchive" :key="ev.id || i">
                    <button @click="idx = i; activeTab = 'images'"
                            class="w-full text-left rounded-2xl p-4 flex gap-4 transition-all duration-300 border focus:outline-none"
                            :style="idx === i 
                                ? 'background:#FFE381; border-color:#FFE381; color:#1C1410; box-shadow:0 8px 24px rgba(255,227,129,0.25);' 
                                : 'background:#FFFFFF; border-color:#E8E2D5; color:#1C1410; box-shadow:0 2px 8px rgba(28,20,16,0.02);'">
                        
                        <!-- Cover Image Thumbnail -->
                        <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 bg-[#1C1410]/5 border border-[#E8E2D5]/50">
                            <img :src="ev.img" class="w-full h-full object-cover" />
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
                                <h4 class="font-['Inter'] text-lg font-bold uppercase tracking-wide truncate mt-0.5"
                                    :style="idx === i ? 'color:#1C1410;' : 'color:#1C1410;'"
                                    x-text="ev.title"></h4>
                            </div>
                            
                            <div class="flex gap-2 mt-2">
                                <span class="text-[9px] font-bold px-2 py-0.5 rounded-full"
                                      :style="idx === i ? 'background:rgba(28,20,16,0.1); color:#1C1410;' : 'background:rgba(122,106,82,0.1); color:#7A6A52;'">
                                    <span x-text="ev.images.length"></span> ảnh
                                </span>
                                <span class="text-[9px] font-bold px-2 py-0.5 rounded-full"
                                      :style="idx === i ? 'background:rgba(28,20,16,0.1); color:#1C1410;' : 'background:rgba(122,106,82,0.1); color:#7A6A52;'">
                                    <span x-text="ev.documents.length"></span> tài liệu
                                </span>
                            </div>
                        </div>
                    </button>
                </template>
                <div x-show="filteredArchive.length === 0" class="text-center py-12 text-[#7A6A52]/70 text-sm">
                    <i data-lucide="search-x" class="h-10 w-10 mx-auto mb-3 text-[#7A6A52]/50"></i>
                    <p class="font-semibold">Không tìm thấy sự kiện nào phù hợp.</p>
                    <button @click="filterYear=''; filterMonth=''; filterCategory=''; filterSearch=''; resetIdx();" 
                            class="mt-3 text-xs underline font-bold text-[#07A0C3] hover:text-[#04B050] transition-colors">
                        Xóa bộ lọc
                    </button>
                </div>
            </div>

            <!-- Right Column: Detail Viewer Pane (Read-Only) -->
            <div data-aos="fade-left" 
                 class="rounded-3xl p-6 lg:p-8 flex flex-col justify-between min-h-[500px] transition-all duration-300 border"
                 style="background:#FFFFFF; border-color:#E8E2D5; box-shadow:0 12px 40px rgba(28,20,16,0.04);">
                
                <div x-show="current">
                    <!-- Event Header -->
                    <div class="flex flex-col md:flex-row gap-6 pb-6 border-b border-[#E8E2D5]">
                        <div class="w-full md:w-48 h-32 rounded-xl overflow-hidden shrink-0 bg-[#1C1410]/5 border border-[#E8E2D5]/50">
                            <img :src="current.img" class="w-full h-full object-cover" />
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
                            <h3 class="font-['Inter'] text-2xl lg:text-3xl font-black uppercase tracking-wide text-[#1C1410] mt-2" x-text="current.title"></h3>
                            
                            <!-- Achievements/Metadata Row -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <template x-for="ach in current.achievements" :key="ach">
                                    <span class="text-[10px] font-semibold px-2.5 py-1 rounded-lg bg-[#1C1410]/5 border border-[#E8E2D5] text-[#7A6A52]" x-text="ach"></span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="mt-6 text-sm leading-relaxed text-[#1C1410]/80 whitespace-pre-line" x-text="current.desc"></p>

                    <!-- Tabs Container -->
                    <div class="mt-8">
                        <!-- Tab Headers -->
                        <div class="flex border-b border-[#E8E2D5] gap-4 mb-6">
                            <button @click="activeTab = 'images'"
                                    class="pb-3 text-sm font-bold tracking-wider uppercase border-b-2 transition-all flex items-center gap-2 focus:outline-none"
                                    :class="activeTab === 'images' ? 'border-[#1C1410] text-[#1C1410]' : 'border-transparent text-[#7A6A52] hover:text-[#1C1410]'">
                                <i data-lucide="image" class="h-4 w-4"></i> Ảnh & Video
                            </button>
                            <button @click="activeTab = 'docs'"
                                    class="pb-3 text-sm font-bold tracking-wider uppercase border-b-2 transition-all flex items-center gap-2 focus:outline-none"
                                    :class="activeTab === 'docs' ? 'border-[#1C1410] text-[#1C1410]' : 'border-transparent text-[#7A6A52] hover:text-[#1C1410]'">
                                <i data-lucide="file-text" class="h-4 w-4"></i> Tài liệu học thuật
                            </button>
                            <button @click="activeTab = 'speakers'"
                                    class="pb-3 text-sm font-bold tracking-wider uppercase border-b-2 transition-all flex items-center gap-2 focus:outline-none"
                                    :class="activeTab === 'speakers' ? 'border-[#1C1410] text-[#1C1410]' : 'border-transparent text-[#7A6A52] hover:text-[#1C1410]'">
                                <i data-lucide="users" class="h-4 w-4"></i> Diễn giả & Khách mời
                            </button>
                        </div>

                        <!-- Tab 1: Image & Video Gallery -->
                        <div x-show="activeTab === 'images'" class="space-y-4">
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                <!-- Images -->
                                <template x-for="(img, idxImg) in current.images" :key="'img-'+idxImg">
                                    <div class="group relative aspect-video rounded-xl overflow-hidden cursor-pointer border border-[#E8E2D5] bg-black/5"
                                         @click="lightboxImg = img.url; lightboxCaption = img.caption; lightboxVideo = null;">
                                        <img :src="img.url" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3 animate-fade-in">
                                            <p class="text-[10px] text-white/90 truncate font-semibold w-full" x-text="img.caption"></p>
                                        </div>
                                    </div>
                                </template>
                                
                                <!-- Videos -->
                                <template x-for="(vid, idxVid) in current.videos" :key="'vid-'+idxVid">
                                    <div class="group relative aspect-video rounded-xl overflow-hidden cursor-pointer border border-[#E8E2D5] bg-black/10 flex items-center justify-center animate-fade-in"
                                         @click="lightboxVideo = vid.url; lightboxCaption = vid.caption; lightboxImg = null;">
                                        <!-- Play icon overlay -->
                                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-all flex items-center justify-center z-10">
                                            <div class="w-10 h-10 rounded-full bg-[#FFE381] text-[#1C1410] flex items-center justify-center shadow-lg transition-transform group-hover:scale-110">
                                                <i data-lucide="play" class="h-4 w-4 fill-current translate-x-0.5"></i>
                                            </div>
                                        </div>
                                        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=500&q=80" class="w-full h-full object-cover" />
                                        <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/85 to-transparent z-20">
                                            <p class="text-[9px] text-white/95 truncate font-semibold" x-text="vid.caption"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div x-show="current && current.images.length === 0 && current.videos.length === 0" class="text-center py-10 text-[#7A6A52]/50 text-sm animate-fade-in">
                                Không có ảnh hoặc video lưu trữ cho sự kiện này.
                            </div>
                        </div>

                        <!-- Tab 2: Attached Documents -->
                        <div x-show="activeTab === 'docs'" class="space-y-3">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="(doc, idxDoc) in current.documents" :key="idxDoc">
                                    <div class="rounded-xl p-4 flex justify-between items-center bg-[#1C1410]/5 border border-[#E8E2D5] transition-all hover:bg-[#1C1410]/10">
                                        <div class="flex items-center gap-3 overflow-hidden flex-1 mr-3">
                                            <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#FFE381]/20 text-[#1C1410] shrink-0">
                                                <!-- File Icon depending on type -->
                                                <i data-lucide="file-text" class="h-5 w-5" :style="doc.type === 'pdf' ? 'color:#ff4d4d;' : (doc.type === 'php' ? 'color:#007acc;' : 'color:#04b050;')"></i>
                                            </div>
                                            <div class="overflow-hidden">
                                                <h4 class="text-xs font-semibold text-[#1C1410] truncate w-full" x-text="doc.title"></h4>
                                                <p class="text-[10px] text-[#7A6A52] mt-1" x-text="(doc.type ? doc.type.toUpperCase() : 'PDF') + ' · ' + (doc.size || 'N/A')"></p>
                                            </div>
                                        </div>
                                        <a :href="doc.url === '#' ? 'javascript:void(0)' : doc.url" 
                                           :target="doc.url === '#' ? '_self' : '_blank'"
                                           @click="if(doc.url === '#') { alert('Đây là tài liệu mẫu. Chức năng chỉ hỗ trợ tải/xem tài liệu thật khi có file đính kèm trên hệ thống.') }"
                                           class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all shrink-0 flex items-center gap-1 bg-[#FFE381] hover:bg-[#FFE381]/80 text-[#1C1410] focus:outline-none shadow-sm">
                                            <i data-lucide="eye" class="h-3.5 w-3.5"></i> Xem
                                        </a>
                                    </div>
                                </template>
                            </div>
                            <div x-show="current && current.documents.length === 0" class="text-center py-10 text-[#7A6A52]/50 text-sm">
                                Không có tài liệu đính kèm cho sự kiện này.
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
                                Không có thông tin diễn giả hoặc khách mời cho sự kiện này.
                            </div>
                        </div>
                    </div>
                </div>
                
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


@endsection
