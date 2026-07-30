<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UniEvents | Studio — {{ $event->title }} | Mẫu 3</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&family=Be+Vietnam+Pro:wght@400;600;700&family=Charm:wght@400;700&family=Montserrat:wght@400;600;700&family=Pacifico&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background-color: #f8fafc; }
        .main-content-canvas { background: #f8fafc; }

        /* Active slot highlight */
        .media-slot.slot-active {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 3px rgba(249,115,22,0.25);
        }
        .media-slot.slot-filled {
            border-style: solid !important;
            border-color: #e2e8f0 !important;
        }

        /* Media library grid & items */
        #mediaLibraryGrid {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 6px !important;
            max-height: 500px;
            overflow-y: auto;
            padding-right: 2px;
        }
        .lib-item {
            transition: border-color 0.15s;
            cursor: pointer;
            position: relative !important;
            width: 100% !important;
            height: 0 !important;
            padding-bottom: 100% !important;
            overflow: hidden !important;
            border-radius: 8px;
            border: 2px solid transparent;
            background: #0f172a;
        }
        .lib-item > img,
        .lib-item > video {
            position: absolute !important;
            top: 0 !important; left: 0 !important;
            width: 100% !important; height: 100% !important;
            object-fit: cover !important;
        }
        .lib-item > .lib-overlay {
            position: absolute !important;
            inset: 0 !important;
            z-index: 5;
        }
        .lib-item.selected { border-color: #f97316 !important; box-shadow: 0 0 0 2px rgba(249,115,22,0.4); }

        /* Tab active */
        .tab-btn.active {
            background: #f97316;
            color: white;
        }

        /* Upload drop zone */
        .drop-zone.dragging {
            border-color: #f97316;
            background-color: #fff7ed;
        }

        /* Spinner overlay */
        #uploadSpinner {
            display: none;
            position: absolute; inset: 0;
            background: rgba(255,255,255,0.75);
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        #uploadSpinner.show { display: flex; }

        /* Tooltip on slot click */
        .slot-label { font-size: 11px; color: #94a3b8; margin-top: 4px; text-align:center; }

        /* Ensure main canvas is always clickable even if drawer is open */
        body.drawer-open .main-content-canvas {
            pointer-events: auto !important;
            opacity: 1 !important;
        }
        body.drawer-open::before {
            display: none !important;
        }
    </style>
</head>
<body class="overflow-x-hidden pt-[64px] bg-slate-900">
    <div id="topErrorBanner" class="hidden fixed top-[64px] left-0 w-full z-50 bg-red-100 text-red-600 px-4 py-3 text-center font-medium text-[14px] border-b border-red-200 shadow-sm transition-all"></div>
    <div class="app-layout">
        <!-- ─── Control Drawer (Left Panel) ─── -->
        <aside class="control-drawer overflow-y-auto p-6 shadow-drawer">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-brand-orange rounded-full"></span>
                    <h3 class="text-[15px] font-bold text-primary font-heading">Bảng cấu hình dữ liệu</h3>
                </div>
                <button onclick="closeEditor()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-slate-100 text-slate-400 hover:text-slate-800 transition-all">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <div class="space-y-5">
                <!-- 1. General Info -->
                <div id="sec-info" class="drawer-section space-y-3 pt-1 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">1. Thông tin chung</h4>
                    <div class="space-y-2.5">
                        <div>
                            <label class="uni-label">Tiêu đề sự kiện</label>
                            <input type="text" id="inTieuDe" value="{{ $event->title }}" oninput="syncData()" class="uni-input"/>
                        </div>

                        <div>
                            <label class="uni-label">Mô tả tóm tắt</label>
                            <textarea id="inMoTa" rows="2" oninput="syncData()" class="uni-input">{{ $event->description }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 3. Media Library (Tabbed) -->
                <div id="sec-media" class="drawer-section space-y-3 pt-2 border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">Thư viện Media</h4>

                    {{-- Active slot indicator --}}
                    <div id="activeSlotIndicator" class="hidden items-center gap-2 px-3 py-2 bg-orange-50 border border-orange-200 rounded-xl">
                        <span class="material-symbols-outlined text-brand-orange text-[16px]">touch_app</span>
                        <p class="text-[12px] text-brand-orange font-medium" id="activeSlotLabel">Đang chọn ảnh cho Ô 1</p>
                        <button onclick="clearActiveSlot()" class="ml-auto text-slate-400 hover:text-slate-600">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </button>
                    </div>

                    {{-- Tabs --}}
                    <div class="flex gap-1.5 bg-slate-100 p-1 rounded-xl">
                        <button onclick="switchTab('library')" id="tabLibrary" class="tab-btn active flex-1 py-1.5 text-[12px] font-semibold rounded-lg transition-all">
                            Kho Media ({{ count($mediaLibrary) }})
                        </button>
                        <button onclick="switchTab('upload')" id="tabUpload" class="tab-btn flex-1 py-1.5 text-[12px] font-semibold rounded-lg transition-all text-slate-500 hover:text-primary">
                            Tải file mới
                        </button>
                    </div>

                    {{-- Tab: Library --}}
                    <div id="tabPanelLibrary" class="flex flex-col gap-3">
                        @if(count($mediaLibrary) > 0)
                        <div class="flex justify-between items-center px-1 mt-1">
                            <span class="text-[12px] font-medium text-slate-500">Đã tải lên {{ count($mediaLibrary) }} file</span>
                            <select id="mediaFilter" onchange="filterMedia(this.value)" class="uni-input py-1 text-[11px] w-auto bg-white border-slate-200">
                                <option value="all">Tất cả định dạng</option>
                                <option value="image">Chỉ Hình ảnh</option>
                                <option value="video">Chỉ Video</option>
                            </select>
                        </div>
                        <div id="mediaLibraryGrid">
                            @foreach($mediaLibrary as $media)
                            <div class="lib-item"
                                 onclick="applyLibraryItem('{{ $media->full_url }}', '{{ $media->type }}', '{{ $media->url }}', this)"
                                 title="{{ $media->caption ?? basename($media->url) }}">
                                @if($media->type === 'video')
                                    <video src="{{ \App\Helpers\FileHelper::url($media->url) }}"></video>
                                    <div class="lib-overlay" style="display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.3);">
                                        <span class="material-symbols-outlined" style="color:white;font-size:24px;">play_circle</span>
                                    </div>
                                @else
                                    <img src="{{ \App\Helpers\FileHelper::url($media->url) }}" alt="">
                                @endif
                                <div class="lib-overlay" style="background:rgba(0,0,0,0);transition:background 0.15s;"></div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-6 text-slate-400">
                            <span class="material-symbols-outlined text-[36px] block mb-1 text-slate-200">photo_library</span>
                            <p class="text-[12px]">Kho ảnh trống. Hãy tải ảnh mới lên.</p>
                        </div>
                        @endif
                    </div>

                    {{-- Tab: Upload --}}
                    <div id="tabPanelUpload" class="hidden">
                        <div class="relative">
                            <label class="drop-zone block border-2 border-dashed border-slate-300 hover:border-brand-orange rounded-xl p-5 text-center cursor-pointer transition-all hover:bg-slate-50/50"
                                   id="dropZoneLabel">
                                <input type="file" id="inHeroBg" accept="image/*,video/*" multiple class="sr-only" onchange="handleFileSelect(this)"/>
                                <span class="material-symbols-outlined text-[32px] text-brand-orange mb-1 block">cloud_upload</span>
                                <p class="text-[13px] font-semibold text-primary">Nhấn hoặc kéo file vào đây</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">JPG, PNG, GIF, SVG, BMP, MP4, AVI, MOV, WEBM (Tối đa 50MB)</p>
                            </label>
                            <div id="uploadSpinner">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-8 h-8 border-4 border-brand-orange border-t-transparent rounded-full animate-spin"></div>
                                    <p class="text-[12px] text-slate-500" id="uploadProgressText">Đang tải lên...</p>
                                </div>
                            </div>
                        </div>
                        {{-- Upload progress list --}}
                        <div id="uploadProgressList" class="mt-2 space-y-1.5 max-h-[100px] overflow-y-auto"></div>
                    </div>
                </div>

            </div>

            <div class="mt-4 pt-4 border-t border-slate-100 space-y-2">
                <button onclick="saveDesignThen(closeEditor)" class="w-full py-2.5 bg-primary hover:bg-slate-800 text-white font-semibold rounded-xl text-[13px] shadow transition-all">
                    Hoàn tất & Đóng
                </button>
            </div>
        </aside>

        <!-- ─── Main Content (Live Preview) ─── -->
        <main class="main-content-canvas min-h-screen pb-16">
            <!-- Fixed Header -->
            <header class="fixed top-0 left-0 w-full h-[64px] z-40 flex items-center justify-between px-8 bg-white border-b border-slate-200/80 shadow-sm transition-all duration-500">
                <div class="flex items-center gap-2 w-[240px]">
                    <a href="{{ route('admin.events.index') }}" class="flex items-center gap-2">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-indigo-500 text-white shadow-md">
                            <i data-lucide="graduation-cap" class="h-5 w-5"></i>
                        </div>
                        <div class="flex flex-col min-w-0 text-left">
                            <span class="text-[15px] font-bold leading-tight truncate tracking-tight text-slate-900">
                                UniEvents
                                <span class="text-brand-orange font-normal text-[12px] ml-0.5">| Studio</span>
                            </span>
                            <span class="text-[11px] text-muted-foreground leading-tight tracking-wider">Trang quản trị</span>
                        </div>
                    </a>
                </div>
                <div class="flex-1 flex justify-start items-center mx-4">
                    <input type="hidden" id="inEventTemplate" value="{{ $event->page_template ?? 1 }}">
                    <a href="{{ route('admin.events.template', $event) }}" class="flex items-center gap-1.5 text-[12px] text-slate-500 hover:text-brand-orange font-medium bg-slate-50 hover:bg-orange-50 px-3 py-1.5 rounded-lg transition-colors border border-slate-200 hover:border-orange-200">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                        Chọn mẫu khác
                    </a>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Step indicator mini -->
                    <div class="hidden md:flex items-center gap-2 mr-4">
                        <a href="{{ route('admin.events.edit', $event) }}" class="text-[12px] text-slate-400 hover:text-primary transition-colors">① Thông tin</a>
                        <span class="text-slate-300">→</span>
                        <a href="{{ route('admin.events.template', $event) }}" class="text-[12px] text-slate-400 hover:text-primary transition-colors">② Chọn mẫu</a>
                        <span class="text-slate-300">→</span>
                        <span class="text-[12px] text-primary font-semibold">③ Thiết kế</span>
                        <span class="text-slate-300">→</span>
                        <a href="{{ route('admin.events.preview', $event) }}" class="text-[12px] text-slate-400 hover:text-primary transition-colors">④ Xem trước</a>
                    </div>

                    <button onclick="openEditor()" class="flex items-center gap-2 px-4 py-2 bg-primary hover:bg-slate-800 text-white rounded-xl text-[13px] font-medium transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">tune</span>
                        Cấu hình sự kiện
                    </button>
                    <button onclick="saveDesignThen(() => { window.location.href = '{{ route('admin.events.preview', $event) }}' })" class="flex items-center gap-2 px-4 py-2 bg-brand-orange hover:bg-orange-600 text-white rounded-xl text-[13px] font-medium transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        Xem trước
                    </button>
                </div>
            </header>

            <!-- Hero Section -->
            <section class="relative h-[320px] w-full overflow-hidden bg-slate-900">
                <div id="viewHeroBg" class="absolute inset-0 bg-cover bg-center transition-all duration-500 scale-105"
                    style="background-image: url('{{ $event->bannerImage ? \App\Helpers\FileHelper::url($event->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=80' }}');">
                </div>
                <div class="absolute inset-0 hero-overlay"></div>

                <div class="absolute inset-0 flex flex-col justify-end max-w-[1140px] mx-auto w-full px-6 pb-8 z-10">
                    <div class="flex gap-2 mb-3">
                        <span id="viewNganh" onclick="openEditor('sec-info')" class="px-2.5 py-1 bg-brand-orange text-white rounded-md text-[10px] uppercase font-bold tracking-wider cursor-pointer hover:opacity-90">{{ $event->category?->name ?? 'Thiết kế đồ họa' }}</span>
                        <span id="viewHocKy" onclick="openEditor('sec-info')" class="px-2.5 py-1 bg-white/20 backdrop-blur-md text-white rounded-md text-[10px] uppercase font-bold tracking-wider cursor-pointer hover:bg-white/30">Fall 2024</span>
                    </div>
                    <h1 id="viewTieuDe" onclick="openEditor('sec-info')" class="text-[28px] md:text-[36px] font-bold text-white mb-2 font-heading leading-tight cursor-pointer hover:text-slate-200">
                        {{ $event->title }}
                    </h1>
                </div>
            </section>

            <!-- Content Grid -->
            <div class="max-w-[1140px] mx-auto px-6 mt-10 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left Column -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Intro Card -->
                    <div class="uni-card p-6" onclick="openEditor('sec-info')" style="cursor: pointer;">
                        <h3 class="text-[18px] font-bold text-primary mb-3 font-heading flex items-center gap-2">
                            <span class="w-1 h-5 bg-primary rounded-full"></span>Giới thiệu sự kiện
                        </h3>
                        <p id="viewMoTa" class="text-slate-600 text-[14px] leading-relaxed whitespace-pre-line">
                            {{ $event->description }}
                        </p>
                    </div>

                    {{-- Mẫu 3 không có Banner Phụ --}}
                    <input type="hidden" id="inSubBannerPath" value="" />

                    <!-- Media Gallery -->
                    <div class="uni-card p-6">
                        <div class="flex items-center justify-between mb-5 border-b border-slate-100 pb-3">
                            <h3 class="text-[18px] font-bold text-primary font-heading flex items-center gap-2">
                                <span class="w-1 h-5 bg-primary rounded-full"></span>Nội dung chính
                            </h3>
                            <span class="text-[11px] text-slate-400">Nhập nội dung sự kiện và chọn ảnh minh hoạ</span>
                        </div>

                        <div class="mb-4 bg-blue-50 text-blue-700 p-3 rounded-lg text-[13px] border border-blue-200">
                            <span class="material-symbols-outlined align-middle mr-1 text-[18px]">school</span>
                            <b>Mẫu 3 — Academic:</b> Ảnh và nội dung hiển thị dọc như bài viết (blog) phù hợp báo cáo chuyên sâu.
                        </div>

                        <div class="space-y-6" id="mediaSlots">
                            @php $galleryMedia = $event->galleryImages->take(4)->values(); @endphp
                            @for($i = 1; $i <= 4; $i++)
                            @php 
                                $media = $galleryMedia->get($i - 1); 
                                $hasMedia = $media ? true : false;
                            @endphp
                            <div class="grid grid-cols-1 gap-6 bg-slate-50/50 p-6 rounded-xl border border-slate-100 items-start media-slot-wrapper" data-slot-wrap="{{ $i }}">
                                {{-- Tiêu đề khối (Caption) --}}
                                <div class="w-full mb-[-10px]">
                                    <label class="text-[12px] font-bold text-slate-700 block mb-1.5 flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[16px] text-brand-orange">short_text</span> 
                                        Mô tả ảnh (Tùy chọn hiển thị)
                                    </label>
                                    <input type="text" id="caption{{ $i }}" placeholder="Nhập mô tả cho ảnh này..."
                                           class="w-full text-[14px] px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all font-bold text-primary"
                                           value="{{ $media ? $media->caption : '' }}" />
                                </div>

                                {{-- Column: Media --}}
                                <div class="flex flex-col gap-3 w-full media-upload-col">
                                    {{-- Image slot --}}
                                    <div class="relative">
                                        <div onclick="activateSlot({{ $i }})"
                                             class="media-slot w-full {{ $hasMedia ? 'h-auto' : 'h-32' }} bg-white hover:bg-slate-50 border-2 {{ $hasMedia ? '' : 'border-dashed' }} border-slate-300 hover:border-brand-orange rounded-xl flex items-center justify-center gap-2 cursor-pointer text-slate-500 hover:text-brand-orange transition-all {{ $hasMedia ? 'slot-filled' : '' }}"
                                             data-slot="{{ $i }}" id="slot{{ $i }}">
                                            @if($hasMedia)
                                                @if($media->type === 'video')
                                                    <video src="{{ \App\Helpers\FileHelper::url($media->url) }}" data-path="{{ $media->url }}" class="w-full h-auto rounded-xl" autoplay loop muted playsinline></video>
                                                @else
                                                    <img src="{{ \App\Helpers\FileHelper::url($media->url) }}" data-path="{{ $media->url }}" class="w-full h-auto rounded-xl" alt=""/>
                                                @endif
                                            @else
                                                <span class="material-symbols-outlined text-[22px]">add_photo_alternate</span>
                                                <span class="text-[13px] font-medium">Thêm hình ảnh {{ $i }}</span>
                                            @endif
                                        </div>
                                        {{-- Remove button (hidden until filled) --}}
                                        <button onclick="removeSlot({{ $i }})" id="removeBtn{{ $i }}"
                                                class="{{ $hasMedia ? 'flex' : 'hidden' }} absolute top-2 right-2 w-7 h-7 bg-white/90 hover:bg-red-500 hover:text-white text-slate-600 rounded-lg shadow items-center justify-center transition-all z-10"
                                                title="Gỡ ảnh">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </div>

                                    
                                    


                                    {{-- Preview URL ngay dưới caption --}}
                                    <div class="mt-1 flex flex-wrap gap-2">
                                        
                                    </div>
                                </div>
                                <div class="flex flex-col h-full w-full media-text-col mt-2">
                                    <textarea id="content{{ $i }}" rows="8" placeholder="Nhập nội dung cho đoạn này..."
                                           class="w-full text-[14px] px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all resize-y h-full" style="min-height: 250px;">{{ $media ? $media->content : '' }}</textarea>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <button onclick="addNewSlot()" class="mt-5 w-full py-2.5 border-2 border-dashed border-slate-300 hover:border-brand-orange text-slate-500 hover:text-brand-orange rounded-xl font-medium transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">add_circle</span>
                            Thêm khối nội dung / ảnh
                        </button>
                    </div>
                </div>

                                <!-- Right Column -->
                <div class="lg:col-span-4 space-y-6" style="position: sticky; top: 88px; align-self: start; height: max-content;" x-data="speakerManager()">
                    
                    <!-- Speakers -->
                    <div class="uni-card p-6 transition-all relative" @click.away="closeDropdown()">
                        <!-- Speakers Section -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-3 border-b border-slate-100 pb-2">
                                <span class="text-[13px] text-slate-500 font-medium">Diễn giả tham gia</span>
                                <button type="button" @click="openDropdown()" class="material-symbols-outlined text-slate-400 hover:text-brand-orange transition-colors text-[18px]">add_circle</button>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="person in selectedSpeakers" :key="person.id">
                                    <div class="flex items-center gap-2 bg-orange-50 border border-orange-200 rounded-full py-1 pl-1 pr-3 shadow-sm">
                                        <img :src="person.photo" class="w-6 h-6 rounded-full object-cover">
                                        <span class="text-[12px] font-semibold text-primary" x-text="person.name"></span>
                                        <button type="button" @click="removePerson(person.id)" class="text-orange-400 hover:text-orange-600 ml-1 flex items-center"><span class="material-symbols-outlined text-[14px]">close</span></button>
                                        <input type="hidden" name="speaker_ids[]" :value="person.id" class="speaker-id-input">
                                    </div>
                                </template>
                                <div x-show="selectedSpeakers.length === 0" class="text-[12px] text-slate-400 italic">Chưa chọn diễn giả</div>
                            </div>
                        </div>


                        <!-- Shared Dropdown Modal -->
                        <div x-show="dropdownOpen" class="absolute top-[40px] right-0 w-[300px] z-[60] bg-white rounded-2xl shadow-xl border border-slate-200 flex flex-col max-h-[350px]" style="display: none;">
                            <div class="p-3 border-b border-slate-100 flex items-center justify-between">
                                <div class="relative flex-1">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">search</span>
                                    <input type="text" x-model="searchQuery" x-ref="searchInput" placeholder="Tìm tên diễn giả..." class="w-full pl-9 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[12px] focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all">
                                </div>
                                <button type="button" @click="closeDropdown()" class="ml-2 text-slate-400 hover:text-slate-600 flex items-center"><span class="material-symbols-outlined text-[18px]">close</span></button>
                            </div>
                            <div class="flex-1 overflow-y-auto p-2 space-y-1">
                                <template x-for="person in filteredPersons" :key="person.id">
                                    <div @click="togglePerson(person)" class="flex items-center justify-between p-2 rounded-xl hover:bg-orange-50 cursor-pointer transition-all">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg overflow-hidden shrink-0 bg-slate-100">
                                                <img :src="person.photo" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <h4 class="text-[12px] font-bold text-primary" x-text="person.name"></h4>
                                                <p class="text-[10px] text-slate-400 truncate max-w-[140px]" x-text="person.bio"></p>
                                            </div>
                                        </div>
                                        <div x-show="isSelected(person.id)">
                                            <span class="material-symbols-outlined text-brand-orange text-[18px]">check_circle</span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Card -->
                    @php
                        $scheduleJson = $event->scheduleItems->map(function($s) {
                            return [
                                'id' => uniqid(),
                                'start_time' => $s->start_time ? $s->start_time->format('H:i') : '',
                                'end_time' => $s->end_time ? $s->end_time->format('H:i') : '',
                                'title' => $s->title
                            ];
                        })->toJson();
                    @endphp
                    <div class="uni-card p-5 transition-all" x-data="scheduleManager({{ $scheduleJson }})">
                        <h4 class="text-[13px] font-bold text-primary mb-3 font-heading flex items-center justify-between">
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-brand-orange">format_list_bulleted</span>Lịch hoạt động sự kiện</span>
                        </h4>
                        
                        <div class="space-y-3 mb-3" x-show="items.length > 0" x-transition>
                            <template x-for="(item, index) in items" :key="item.id">
                                <div class="flex flex-col gap-2.5 bg-slate-50 p-3 rounded-xl border border-slate-200 transition-all group hover:border-brand-orange/30">
                                    
                                    <!-- View Mode (Saved Card) -->
                                    <div x-show="item._saved" style="display: none;" class="flex items-start justify-between gap-3 cursor-pointer" @click="item._saved = false">
                                        <div class="flex flex-col gap-1">
                                            <div class="text-[11px] font-bold text-brand-orange font-mono bg-orange-100/50 px-2 py-0.5 rounded-md inline-flex w-max items-center gap-1">
                                                <span class="material-symbols-outlined text-[13px]">schedule</span>
                                                <span x-text="item.start_time || '--:--'"></span>
                                                <template x-if="item.end_time">
                                                    <span> - <span x-text="item.end_time"></span></span>
                                                </template>
                                            </div>
                                            <div class="text-[13px] font-medium text-slate-700 leading-snug break-words" x-text="item.title || '(Chưa có nội dung)'"></div>
                                        </div>
                                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button type="button" @click.stop="item._saved = false" class="p-1.5 text-slate-400 hover:text-brand-orange hover:bg-orange-50 rounded-lg transition-colors" title="Sửa">
                                                <span class="material-symbols-outlined text-[16px]">edit</span>
                                            </button>
                                            <button type="button" @click.stop="removeItem(index)" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Xóa">
                                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Edit Mode (Form) -->
                                    <div x-show="!item._saved" class="flex flex-col gap-2.5">
                                        <!-- Cột thời gian và nút xoá -->
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center gap-1.5 flex-1">
                                                <span class="text-[11px] font-bold text-slate-400 shrink-0">Từ</span>
                                                <input type="text" x-model="item.start_time" x-init="flatpickr($el, { enableTime: true, noCalendar: true, dateFormat: 'H:i', time_24hr: true, onChange: (sd, ds) => { item.start_time = ds; syncData(); } })" placeholder="--:--" class="w-full text-[12px] py-1.5 px-2 rounded-lg border border-slate-200 focus:border-brand-orange focus:ring-1 focus:ring-brand-orange bg-white transition-all font-medium text-center">
                                            </div>
                                            <div class="flex items-center gap-1.5 flex-1">
                                                <span class="text-[11px] font-bold text-slate-400 shrink-0">Đến</span>
                                                <input type="text" x-model="item.end_time" x-init="flatpickr($el, { enableTime: true, noCalendar: true, dateFormat: 'H:i', time_24hr: true, onChange: (sd, ds) => { item.end_time = ds; syncData(); } })" placeholder="--:--" class="w-full text-[12px] py-1.5 px-2 rounded-lg border border-slate-200 focus:border-brand-orange focus:ring-1 focus:ring-brand-orange bg-white transition-all font-medium text-slate-500 text-center">
                                            </div>
                                            <button type="button" @click="removeItem(index)" class="shrink-0 p-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Xóa">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </div>
                                        <!-- Ô nhập nội dung -->
                                        <textarea rows="2" x-model="item.title" @input="syncData()" class="w-full text-[12px] p-2.5 rounded-lg border border-slate-200 focus:border-brand-orange focus:ring-1 focus:ring-brand-orange bg-white resize-none transition-all" placeholder="Nhập nội dung mốc thời gian..."></textarea>
                                        
                                        <!-- Nút xác nhận từng mục -->
                                        <div class="flex justify-end">
                                            <button type="button" @click="item._saved = true; syncData()" 
                                                    style="background-color: #10b981;"
                                                    class="px-3 py-1.5 rounded-lg text-[11px] font-bold transition-all flex items-center gap-1 shadow-sm text-white hover:opacity-90">
                                                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                                <span>Xác nhận</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <button type="button" @click="addItem()" class="w-full py-2.5 border border-dashed border-brand-orange/50 text-brand-orange rounded-xl text-[12px] font-bold hover:bg-orange-50 hover:border-brand-orange transition-all flex items-center justify-center gap-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">add_circle</span> Thêm mốc lịch trình mới
                            </button>
                        </div>
                        
                        <input type="hidden" id="inLichHoatDongData" :value="JSON.stringify(items)">
                    </div>

                    <!-- Promoted Events: Newest -->
                    @if(isset($newestEvents) && $newestEvents->count() > 0)
                    <div class="uni-card p-5">
                        <h4 class="text-[13px] font-bold text-primary mb-4 font-heading flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-emerald-500">new_releases</span>
                            Sự kiện mới nhất
                        </h4>
                        <div class="space-y-4">
                            @foreach($newestEvents as $newEv)
                                <a href="{{ route('events.show', $newEv->slug) }}" target="_blank" class="flex gap-3 items-center group">
                                    <div class="w-16 h-12 rounded-lg overflow-hidden shrink-0 bg-slate-100 border border-slate-200">
                                        @if($newEv->bannerImage)
                                            <img src="{{ \App\Helpers\FileHelper::url($newEv->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                        @else
                                            <div class="w-full h-full bg-slate-200"></div>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="text-[12px] font-bold text-primary group-hover:text-brand-orange transition-colors line-clamp-2 leading-snug">{{ $newEv->title }}</h5>
                                        <p class="text-[10px] text-slate-400 mt-1">{{ $newEv->event_date->format('d/m/Y') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Promoted Events: Prominent -->
                    @if(isset($prominentEvents) && $prominentEvents->count() > 0)
                    <div class="uni-card p-5">
                        <h4 class="text-[13px] font-bold text-primary mb-4 font-heading flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-amber-500">local_fire_department</span>
                            Sự kiện nổi bật
                        </h4>
                        <div class="space-y-4">
                            @foreach($prominentEvents as $promEv)
                                <a href="{{ route('events.show', $promEv->slug) }}" target="_blank" class="flex gap-3 items-center group">
                                    <div class="w-16 h-12 rounded-lg overflow-hidden shrink-0 bg-slate-100 border border-slate-200">
                                        @if($promEv->bannerImage)
                                            <img src="{{ \App\Helpers\FileHelper::url($promEv->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                        @else
                                            <div class="w-full h-full bg-slate-200"></div>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="text-[12px] font-bold text-primary group-hover:text-brand-orange transition-colors line-clamp-2 leading-snug">{{ $promEv->title }}</h5>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[10px] text-slate-400 flex items-center gap-0.5"><span class="material-symbols-outlined text-[12px]">visibility</span>{{ $promEv->views_count }}</span>
                                            <span class="text-[10px] text-slate-400 flex items-center gap-0.5"><span class="material-symbols-outlined text-[12px]">favorite</span>{{ $promEv->likes_count }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>



    <!-- Duplicate Upload Modal -->
    <div id="duplicateModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-[90%] max-w-[500px] p-6 shadow-2xl transform scale-95 transition-all" id="duplicateModalContent">
            <div class="flex items-center gap-3 mb-4 text-brand-orange">
                <span class="material-symbols-outlined text-[32px]">warning</span>
                <h3 class="text-[18px] font-bold text-primary font-heading">Đã phát hiện file tương đồng</h3>
            </div>
            <p class="text-[14px] text-slate-600 mb-4">Hệ thống phát hiện một số file có tên trùng lặp với các file đã tải lên trước đó. Vẫn tiếp tục tải ảnh lên?</p>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 mb-6 max-h-[150px] overflow-y-auto space-y-1" id="duplicateFilesList"></div>

            <div class="flex flex-col gap-2 sm:flex-row sm:justify-end">
                <button onclick="cancelUpload()" class="px-4 py-2 text-[13px] font-semibold text-slate-500 hover:bg-slate-100 rounded-xl transition-all">Dừng tải file</button>
                <button onclick="uploadNewOnly()" class="px-4 py-2 text-[13px] font-semibold bg-primary hover:bg-slate-800 text-white rounded-xl transition-all shadow-sm">Tải mỗi file mới</button>
                <button onclick="uploadAll()" class="px-4 py-2 text-[13px] font-semibold bg-brand-orange hover:bg-orange-600 text-white rounded-xl transition-all shadow-sm">Tải toàn bộ</button>
            </div>
        </div>
    </div>

    <script>
        const EVENT_ID = {{ $event->id }};
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const MEDIA_STORE_URL = '{{ route("admin.media.store") }}';

        // ── Drawer ──────────────────────────────────────────────
        function openEditor(sectionId = null) {
            document.body.classList.add('drawer-open');
            const drawer = document.querySelector('.control-drawer');
            
            // Hide all sections
            document.querySelectorAll('.drawer-section').forEach(el => el.classList.add('hidden'));
            
            if (sectionId) {
                const targetNode = document.getElementById(sectionId);
                if (targetNode) {
                    targetNode.classList.remove('hidden');
                }
                
                if (sectionId === 'sec-media') {
                    drawer.classList.add('wide');
                } else {
                    drawer.classList.remove('wide');
                }
            } else {
                document.querySelectorAll('.drawer-section').forEach(el => el.classList.remove('hidden'));
                drawer.classList.remove('wide');
            }
        }
        function closeEditor() { 
            document.body.classList.remove('drawer-open'); 
            document.querySelector('.control-drawer').classList.remove('wide');
        }

        // ── Tabs ─────────────────────────────────────────────────
        function switchTab(tab) {
            const isLib = (tab === 'library');
            document.getElementById('tabLibrary').classList.toggle('active', isLib);
            document.getElementById('tabUpload').classList.toggle('active', !isLib);
            document.getElementById('tabLibrary').classList.toggle('text-slate-500', !isLib);
            document.getElementById('tabUpload').classList.toggle('text-slate-500', isLib);
            document.getElementById('tabPanelLibrary').classList.toggle('hidden', !isLib);
            document.getElementById('tabPanelUpload').classList.toggle('hidden', isLib);
        }

        // ── Slot Management ───────────────────────────────────────
        let activeSlotId = null;

        function activateSlot(slotNum) {
            // Deactivate previous
            document.querySelectorAll('.media-slot').forEach(s => s.classList.remove('slot-active'));
            activeSlotId = slotNum;
            const slot = document.getElementById('slot' + slotNum);
            slot.classList.add('slot-active');

            // Show indicator
            const indicator = document.getElementById('activeSlotIndicator');
            indicator.classList.remove('hidden');
            indicator.classList.add('flex');
            document.getElementById('activeSlotLabel').textContent = `Đang chọn ảnh cho Ô số ${slotNum}`;

            // Open drawer to media section
            openEditor('sec-media');
        }

        function clearActiveSlot() {
            activeSlotId = null;
            document.querySelectorAll('.media-slot').forEach(s => s.classList.remove('slot-active'));
            const indicator = document.getElementById('activeSlotIndicator');
            indicator.classList.add('hidden');
            indicator.classList.remove('flex');
        }

        function removeSlot(slotNum) {
            const slot = document.getElementById('slot' + slotNum);
            slot.innerHTML = `
                <span class="material-symbols-outlined text-[22px]">add_photo_alternate</span>
                <span class="text-[13px] font-medium">Thêm hình ảnh ${slotNum}</span>
            `;
            slot.classList.remove('slot-filled', 'h-auto');
            slot.classList.add('border-dashed', 'border-slate-300', 'h-32');
            document.getElementById('removeBtn' + slotNum).classList.add('hidden');
        }

        function applyMediaToSlot(url, type, path = null) {
            if (!activeSlotId) return false;
            const slot = document.getElementById('slot' + activeSlotId);
            if (type === 'video') {
                slot.innerHTML = `<video src="${url}" data-path="${path}" class="w-full h-auto rounded-xl" autoplay loop muted></video>`;
            } else {
                slot.innerHTML = `<img src="${url}" data-path="${path}" class="w-full h-auto rounded-xl" alt=""/>`;
            }
            slot.classList.add('slot-filled', 'h-auto');
            slot.classList.remove('border-dashed', 'border-slate-300', 'slot-active', 'h-32');

            // Show remove button
            document.getElementById('removeBtn' + activeSlotId).classList.remove('hidden');
            document.getElementById('removeBtn' + activeSlotId).classList.add('flex');

            clearActiveSlot();
            return true;
        }

        // ── Library pick ─────────────────────────────────────────
        function applyLibraryItem(url, type = 'image', path = null, el = null) {
            if (!activeSlotId) {
                // Flash indicator to tell user to pick a slot
                const indicator = document.getElementById('activeSlotIndicator');
                indicator.classList.remove('hidden');
                indicator.classList.add('flex');
                document.getElementById('activeSlotLabel').textContent = '⚠ Hãy nhấn vào một ô ảnh trước!';
                indicator.classList.add('border-red-200', 'bg-red-50');
                document.getElementById('activeSlotLabel').classList.add('text-red-500');
                setTimeout(() => {
                    indicator.classList.add('hidden');
                    indicator.classList.remove('flex', 'border-red-200', 'bg-red-50');
                    document.getElementById('activeSlotLabel').classList.remove('text-red-500');
                }, 2000);
                return;
            }
            // Highlight selected lib item
            document.querySelectorAll('.lib-item').forEach(i => i.classList.remove('selected'));
            if (el) {
                el.classList.add('selected');
            } else if (typeof event !== 'undefined' && event.currentTarget) {
                event.currentTarget.classList.add('selected');
            }
            applyMediaToSlot(url, type, path);
        }

        // ── File Upload (AJAX) ────────────────────────────────────
        let pendingFiles = [];
        let newFiles = [];
        let duplicatedFiles = [];

        const existingMediaFilenames = [
            @foreach($mediaLibrary as $media)
                "{{ basename($media->url) }}",
            @endforeach
        ];

        function handleFileSelect(input) {
            if (!input.files || input.files.length === 0) return;
            pendingFiles = Array.from(input.files);
            newFiles = [];
            duplicatedFiles = [];

            pendingFiles.forEach(file => {
                if (existingMediaFilenames.includes(file.name)) {
                    duplicatedFiles.push(file);
                } else {
                    newFiles.push(file);
                }
            });

            if (duplicatedFiles.length > 0) {
                const listEl = document.getElementById('duplicateFilesList');
                listEl.innerHTML = duplicatedFiles.map(f => `
                    <div class="flex items-center gap-2 py-1.5 border-b border-slate-100 last:border-0 text-[13px]">
                        <span class="material-symbols-outlined text-[16px] text-slate-400">image</span>
                        <span class="text-primary font-medium truncate flex-1">${f.name}</span>
                        <span class="text-slate-400 text-[11px] shrink-0">${(f.size / 1024).toFixed(1)} KB</span>
                    </div>
                `).join('');
                const modal = document.getElementById('duplicateModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => document.getElementById('duplicateModalContent').classList.remove('scale-95'), 50);
            } else {
                processUploads(pendingFiles);
            }
        }

        function cancelUpload() {
            document.getElementById('duplicateModal').classList.add('hidden');
            document.getElementById('duplicateModal').classList.remove('flex');
            document.getElementById('duplicateModalContent').classList.add('scale-95');
            document.getElementById('inHeroBg').value = '';
            pendingFiles = [];
        }
        function uploadNewOnly() {
            document.getElementById('duplicateModal').classList.add('hidden');
            document.getElementById('duplicateModal').classList.remove('flex');
            document.getElementById('duplicateModalContent').classList.add('scale-95');
            processUploads(newFiles);
        }
        function uploadAll() {
            document.getElementById('duplicateModal').classList.add('hidden');
            document.getElementById('duplicateModal').classList.remove('flex');
            document.getElementById('duplicateModalContent').classList.add('scale-95');
            processUploads(pendingFiles, true);
        }

        async function processUploads(filesToUpload, force = false) {
            if (filesToUpload.length === 0) return;

            // Show spinner
            document.getElementById('uploadSpinner').classList.add('show');
            document.getElementById('uploadProgressText').textContent = `Đang tải lên ${filesToUpload.length} file...`;
            const progressList = document.getElementById('uploadProgressList');
            progressList.innerHTML = '';

            const formData = new FormData();
            formData.append('event_id', EVENT_ID);
            if (force) formData.append('force_upload', 1);
            filesToUpload.forEach(f => formData.append('files[]', f));

            try {
                const resp = await fetch(MEDIA_STORE_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                if (!resp.ok) {
                    const errorData = await resp.json().catch(() => null);
                    let errMsg = 'Lỗi máy chủ hoặc định dạng file không được hỗ trợ.';
                    if (resp.status === 422 && errorData && errorData.errors) {
                        errMsg = Object.values(errorData.errors).flat().join(' ');
                    } else if (errorData && errorData.message) {
                        errMsg = errorData.message;
                    }
                    throw new Error(errMsg);
                }

                const data = await resp.json();

                if (data.success) {
                    // Add uploaded items to library grid
                    let libGrid = document.getElementById('mediaLibraryGrid');
                    if (!libGrid) {
                        const panel = document.getElementById('tabPanelLibrary');
                        panel.innerHTML = '<div id="mediaLibraryGrid"></div>';
                        libGrid = document.getElementById('mediaLibraryGrid');
                    }

                    data.files.forEach(file => {
                        if (file.type === 'image' || file.type === 'video') {
                            const div = document.createElement('div');
                            div.className = 'lib-item';
                            div.title = file.caption;
                            div.onclick = function() { applyLibraryItem(file.url, file.type, file.path, this); };

                            let mediaHtml = '';
                            if (file.type === 'video') {
                                mediaHtml = `<video src="${file.url}"></video>
                                             <div class="lib-overlay" style="display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.3);">
                                                 <span class="material-symbols-outlined" style="color:white;font-size:24px;">play_circle</span>
                                             </div>`;
                            } else {
                                mediaHtml = `<img src="${file.url}" alt="">`;
                            }

                            div.innerHTML = mediaHtml + `<div class="lib-overlay" style="background:rgba(0,0,0,0);"></div>`;
                            libGrid.insertAdjacentElement('afterbegin', div);
                            existingMediaFilenames.push(file.caption);
                        }

                        // Show progress row
                        const row = document.createElement('div');
                        row.className = 'flex items-center gap-2 text-[12px] text-emerald-600 bg-emerald-50 rounded-lg px-2 py-1.5';
                        row.innerHTML = `<span class="material-symbols-outlined text-[14px]">check_circle</span><span class="truncate">Đã thêm: ${file.caption}</span>`;
                        progressList.appendChild(row);
                    });

                    // Update tab button count
                    const currentCount = document.querySelectorAll('.lib-item').length;
                    document.getElementById('tabLibrary').textContent = `Kho Media (${currentCount})`;

                    // Switch to library tab to show results
                    switchTab('library');

                    // Auto-apply first image to active slot if any
                    if (activeSlotId && data.files.length > 0 && (data.files[0].type === 'image' || data.files[0].type === 'video')) {
                        applyMediaToSlot(data.files[0].url, data.files[0].type, data.files[0].path);
                    }
                }
            } catch (err) {
                console.error('Upload error:', err);
                const row = document.createElement('div');
                row.className = 'flex items-center gap-2 text-[12px] text-red-500 bg-red-50 border border-red-100 rounded-lg px-2 py-2 mb-2';
                row.innerHTML = `<span class="material-symbols-outlined text-[16px] shrink-0">error</span><span class="font-medium flex-1">${err.message || 'Lỗi tải lên. Vui lòng thử lại.'}</span>`;
                progressList.appendChild(row);
            } finally {
                document.getElementById('uploadSpinner').classList.remove('show');
                document.getElementById('inHeroBg').value = '';
            }
        }

        async function uploadSubBanner(input) {
            if (!input.files || input.files.length === 0) return;
            const file = input.files[0];
            const formData = new FormData();
            formData.append('files[]', file);
            formData.append('event_id', EVENT_ID);
            formData.append('force_upload', 1);

            const uploadingText = document.getElementById('subBannerUploading');
            uploadingText.classList.remove('hidden');

            try {
                const resp = await fetch(MEDIA_STORE_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });
                
                let data;
                try {
                    data = await resp.json();
                } catch (e) {
                    throw new Error('Máy chủ trả về phản hồi không hợp lệ (không phải JSON). Có thể do file quá nặng hoặc lỗi server.');
                }

                if (!resp.ok) {
                    let errMsg = 'Lỗi tải ảnh lên.';
                    if (resp.status === 422 && data && data.errors) {
                        errMsg = Object.values(data.errors).flat().join(' ');
                    } else if (data && data.message) {
                        errMsg = data.message;
                    }
                    throw new Error(errMsg);
                }
                
                if (data.success && data.files && data.files.length > 0) {
                    const uploadedFile = data.files[0];
                    document.getElementById('inSubBannerUrl').value = uploadedFile.url;
                    document.getElementById('inSubBannerPath').value = uploadedFile.path;
                    
                    // Add to library for reuse if not already there
                    let libGrid = document.getElementById('mediaLibraryGrid');
                    if (libGrid) {
                        const div = document.createElement('div');
                        div.className = 'lib-item';
                        div.title = uploadedFile.caption || file.name;
                        div.onclick = function() { applyLibraryItem(uploadedFile.url, uploadedFile.type, uploadedFile.path, this); };
                        div.innerHTML = `<img src="${uploadedFile.url}" alt=""><div class="lib-overlay" style="background:rgba(0,0,0,0);"></div>`;
                        libGrid.insertAdjacentElement('afterbegin', div);
                        document.getElementById('tabLibrary').textContent = `Kho Media (${document.querySelectorAll('.lib-item').length})`;
                    }
                    syncData();
                }
            } catch (err) {
                console.error(err);
                alert(err.message || 'Có lỗi xảy ra khi tải ảnh lên.');
            } finally {
                uploadingText.classList.add('hidden');
                input.value = '';
            }
        }

        // ── Drag & Drop on drop zone ──────────────────────────────
        const dropLabel = document.getElementById('dropZoneLabel');
        if (dropLabel) {
            ['dragenter', 'dragover'].forEach(e => dropLabel.addEventListener(e, ev => {
                ev.preventDefault();
                dropLabel.classList.add('dragging');
            }));
            ['dragleave', 'drop'].forEach(e => dropLabel.addEventListener(e, ev => {
                ev.preventDefault();
                dropLabel.classList.remove('dragging');
            }));
            dropLabel.addEventListener('drop', ev => {
                const files = Array.from(ev.dataTransfer.files);
                if (files.length) {
                    pendingFiles = files;
                    processUploads(files);
                }
            });
        }

        // ── Date formatter ────────────────────────────────────────
        function formatDisplayDate(dateString) {
            if (!dateString) return 'Chưa chọn';
            const parts = dateString.split('-');
            if (parts.length === 3) return `${parts[2]}/${parts[1]}/${parts[0]}`;
            return dateString;
        }

        // ── Real-time sync ────────────────────────────────────────
        function syncData() {
            const titleEl = document.getElementById('viewTieuDe');
            const inTieuDe = document.getElementById('inTieuDe');
            if (titleEl && inTieuDe) titleEl.innerText = inTieuDe.value;

            // Template toggle
            const inEventTemplate = document.getElementById('inEventTemplate');
            const template = inEventTemplate ? inEventTemplate.value : '1';
            const docSections = document.querySelectorAll('.doc-upload-section');
            const subBannerSection = document.getElementById('subBannerSection');

            // Documents visibility
            if (template === '1') {
                docSections.forEach(el => el.classList.add('hidden'));
            } else {
                docSections.forEach(el => el.classList.remove('hidden'));
            }

            // Sub Banner visibility (ONLY for Template 2)
            if (template === '2') {
                if (subBannerSection) {
                    subBannerSection.style.display = '';
                    const inSubBannerUrl = document.getElementById('inSubBannerUrl');
                    const subUrl = inSubBannerUrl ? inSubBannerUrl.value : '';
                    const viewSubBanner = document.getElementById('viewSubBanner');
                    if (subUrl && viewSubBanner) {
                        viewSubBanner.src = subUrl;
                        viewSubBanner.classList.remove('hidden');
                        const uploadText = document.getElementById('subBannerUploadText');
                        if (uploadText) uploadText.innerText = 'Thay đổi ảnh banner';
                        if (viewSubBanner.nextElementSibling) {
                            viewSubBanner.nextElementSibling.classList.replace('opacity-100', 'opacity-0');
                            viewSubBanner.nextElementSibling.classList.replace('bg-slate-50', 'bg-white/90');
                            viewSubBanner.nextElementSibling.classList.add('hover:opacity-100');
                        }
                    }
                }
            } else {
                if (subBannerSection) subBannerSection.style.display = 'none';
            }

            // Media slots layout based on template
            const mediaWrappers = document.querySelectorAll('.media-slot-wrapper');
            const t5WarningMsg = document.getElementById('t5WarningMsg');
            
            mediaWrappers.forEach((wrapper) => {
                const slotId = wrapper.getAttribute('data-slot-wrap');
                const textCol = wrapper.querySelector('.media-text-col');
                
                if (template === '5') {
                    if (t5WarningMsg) t5WarningMsg.classList.remove('hidden');
                    // For template 5, only slot 1 has text. Slots > 1 are just images.
                    if (slotId !== '1') {
                        if (textCol) textCol.style.display = 'none';
                        wrapper.classList.remove('lg:grid-cols-2');
                        wrapper.classList.add('grid-cols-1');
                    } else {
                        if (textCol) textCol.style.display = '';
                        wrapper.classList.add('lg:grid-cols-2');
                        wrapper.classList.remove('grid-cols-1');
                    }
                } else {
                    if (t5WarningMsg) t5WarningMsg.classList.add('hidden');
                    // Normal templates: all slots have text
                    if (textCol) textCol.style.display = '';
                    wrapper.classList.add('lg:grid-cols-2');
                    wrapper.classList.remove('grid-cols-1');
                }
            });

            const descEl = document.getElementById('viewMoTa');
            const inMoTa = document.getElementById('inMoTa');
            if (descEl && inMoTa) descEl.innerText = inMoTa.value;

            const viewLich = document.getElementById('viewLichHoatDong');
            const inLich = document.getElementById('inLichHoatDong');
            if (viewLich && inLich) viewLich.innerText = inLich.value;
            
            // Speaker
            const spkSelect = document.getElementById('inTenDienGia');
            if(spkSelect && spkSelect.options && spkSelect.options.length > 0 && spkSelect.selectedIndex >= 0) {
                const opt = spkSelect.options[spkSelect.selectedIndex];
                const viewTen = document.getElementById('viewTenDienGia');
                if (viewTen && opt) viewTen.innerText = opt.getAttribute('data-name') || '';
                const photoUrl = opt ? opt.getAttribute('data-photo') : null;
                const viewAnh = document.getElementById('viewAnhDienGia');
                if(photoUrl && viewAnh) viewAnh.src = photoUrl;
            }

            // Sync URL previews
            for (let i = 1; i <= 4; i++) {
                const actionUrlEl = document.getElementById('actionUrl' + i);
                if (!actionUrlEl) continue;
                
                const urlPreviewWrap = document.getElementById('urlPreviewWrap' + i);
                const urlPreviewLink = document.getElementById('urlPreviewLink' + i);
                
                
            }
        }



        async function saveDesignThen(callback) {
            // Hiển thị Overlay Loading
            let loadingOverlay = document.getElementById('globalLoadingOverlay');
            if (!loadingOverlay) {
                loadingOverlay = document.createElement('div');
                loadingOverlay.id = 'globalLoadingOverlay';
                loadingOverlay.className = 'fixed inset-0 z-[9999] flex items-center justify-center bg-white/70 backdrop-blur-sm transition-opacity';
                loadingOverlay.innerHTML = `
                    <div class="bg-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 border border-slate-100">
                        <span class="material-symbols-outlined animate-spin text-brand-orange text-[28px]">sync</span>
                        <span class="text-[15px] font-bold text-primary font-heading">Đang lưu cấu hình...</span>
                    </div>
                `;
                document.body.appendChild(loadingOverlay);
            }
            loadingOverlay.classList.remove('hidden');

            const speakerIds = Array.from(document.querySelectorAll('.speaker-id-input')).map(el => el.value);
            const formData = {
                title: document.getElementById('inTieuDe').value,
                description: document.getElementById('inMoTa').value,
                speaker_ids: speakerIds,
                schedule_data: document.getElementById('inLichHoatDongData') ? document.getElementById('inLichHoatDongData').value : '[]',
                
                event_template: document.getElementById('inEventTemplate').value,
                
                sub_banner_path: document.getElementById('inSubBannerPath') ? document.getElementById('inSubBannerPath').value : '',
                
                media_slots: []
            };

            const slotWrappers = document.querySelectorAll('[data-slot-wrap]');
            slotWrappers.forEach((wrapper) => {
                const i = wrapper.getAttribute('data-slot-wrap');
                const slot = document.getElementById('slot' + i);
                const captionEl = document.getElementById('caption' + i);
                const contentEl = document.getElementById('content' + i);
                
                
                
                const mediaEl = slot ? slot.querySelector('img, video') : null;
                
                // For tinymce, get content properly if initialized
                let textContent = contentEl ? contentEl.value : '';
                if (window.tinymce && tinymce.get('content' + i)) {
                    textContent = tinymce.get('content' + i).getContent();
                }

                if ((mediaEl && mediaEl.src) || (textContent && textContent.trim() !== '') ) {
                    formData.media_slots.push({
                        url: mediaEl && mediaEl.src ? mediaEl.src : '',
                        path: mediaEl ? mediaEl.getAttribute('data-path') : null,
                        caption: captionEl ? captionEl.value : '',
                        content: textContent,
                        
                        
                        
                    });
                }
            });

            try {
                const resp = await fetch("{{ route('admin.events.save_design', $event) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });
                
                if (resp.ok) {
                    if (callback) callback();
                } else {
                    const errorData = await resp.json().catch(() => null);
                    let errMsg = 'Lỗi lưu cấu hình!';
                    if (resp.status === 422 && errorData && errorData.errors) {
                        errMsg = Object.values(errorData.errors).flat().join(' ');
                    } else if (errorData && errorData.message) {
                        errMsg = errorData.message;
                    }
                    
                    const errorBanner = document.getElementById('topErrorBanner');
                    if (errorBanner) {
                        errorBanner.innerText = errMsg;
                        errorBanner.classList.remove('hidden');
                        setTimeout(() => { errorBanner.classList.add('hidden'); }, 5000);
                    } else {
                        alert(errMsg);
                    }
                }
            } catch (e) {
                console.error(e);
                alert('Lỗi lưu cấu hình!');
            } finally {
                // Ẩn Overlay Loading
                if (loadingOverlay) {
                    loadingOverlay.classList.add('hidden');
                }
            }
        }

        window.addEventListener('DOMContentLoaded', () => { syncData(); });
    </script>

    <!-- Speaker Modal & Dynamic Slots JS -->
    <script>
        // Media Filter JS
        function filterMedia(type) {
            const items = document.querySelectorAll('#mediaLibraryGrid .lib-item');
            items.forEach(item => {
                const itemType = item.querySelector('video') ? 'video' : 'image';
                if (type === 'all' || type === itemType) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Speaker Dropdown JS
        function toggleSpeakerDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('speakerDropdown');
            dropdown.classList.toggle('hidden');
            if (!dropdown.classList.contains('hidden')) {
                document.getElementById('speakerSearchInput').focus();
            }
        }

        // Đóng dropdown khi click ra ngoài
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('speakerDropdown');
            if (dropdown && !dropdown.classList.contains('hidden')) {
                // Nếu click không nằm trong dropdown và không nằm trên nút mở dropdown
                if (!dropdown.contains(event.target) && !event.target.closest('[onclick="toggleSpeakerDropdown(event)"]')) {
                    dropdown.classList.add('hidden');
                }
            }
        });

        function filterSpeakers() {
            const keyword = document.getElementById('speakerSearchInput').value.toLowerCase();
            const items = document.querySelectorAll('.speaker-item');
            items.forEach(item => {
                const name = item.getAttribute('data-name');
                if (name.includes(keyword)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        function selectSpeaker(id, name, photoUrl) {
            document.getElementById('inTenDienGia').value = id;
            document.getElementById('viewTenDienGia').textContent = name;
            document.getElementById('viewAnhDienGia').src = photoUrl;
            syncData();
            document.getElementById('speakerDropdown').classList.add('hidden');
        }

        // Dynamic Slots JS
        function addNewSlot() {
            const container = document.getElementById('mediaSlots');
            const currentSlots = container.querySelectorAll('[data-slot-wrap]');
            let maxI = 0;
            currentSlots.forEach(el => {
                const id = parseInt(el.getAttribute('data-slot-wrap'));
                if (id > maxI) maxI = id;
            });
            const newI = maxI + 1;

            // Template 3: Always Zic-Zac (Academic)
            let textOrder = 'lg:order-1';
            let mediaOrder = 'lg:order-2';
            if (newI % 2 !== 0) {
                textOrder = 'lg:order-2';
                mediaOrder = 'lg:order-1';
            }

            const slotHtml = `
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 bg-slate-50/50 p-6 rounded-xl border border-slate-100 mt-6 items-start media-slot-wrapper" data-slot-wrap="${newI}">
                <div class="w-full mb-[-10px] ${templateId === '3' ? 'col-span-1' : 'col-span-1 lg:col-span-2'}">
                    <label class="text-[12px] font-bold text-slate-700 block mb-1.5 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-brand-orange">short_text</span> 
                        Mô tả ảnh (Tùy chọn hiển thị)
                    </label>
                    <input type="text" id="caption${newI}" placeholder="Nhập mô tả cho ảnh này..."
                           class="w-full text-[14px] px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all font-bold text-primary" />
                </div>
                <div class="flex flex-col h-full w-full ${textOrder} media-text-col" ${templateId === '5' ? 'style="display:none;"' : ''}>
                    <textarea id="content${newI}" rows="8" placeholder="Nhập nội dung sự kiện cho đoạn này..."
                           class="w-full text-[14px] px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all resize-y h-full" style="min-height: 250px;"></textarea>
                </div>
                       
                <div class="flex flex-col gap-3 w-full ${mediaOrder} media-upload-col">
                    <div class="relative">
                        <div onclick="activateSlot(${newI})"
                             class="media-slot w-full h-32 bg-white hover:bg-slate-50 border-2 border-dashed border-slate-300 hover:border-brand-orange rounded-xl flex items-center justify-center gap-2 cursor-pointer text-slate-500 hover:text-brand-orange transition-all"
                             data-slot="${newI}" id="slot${newI}">
                            <span class="material-symbols-outlined text-[22px]">add_photo_alternate</span>
                            <span class="text-[13px] font-medium">Thêm hình ảnh ${newI}</span>
                        </div>
                        <button onclick="removeSlot(${newI})" id="removeBtn${newI}"
                                class="hidden absolute top-2 right-2 w-7 h-7 bg-white/90 hover:bg-red-500 hover:text-white text-slate-600 rounded-lg shadow items-center justify-center transition-all z-10"
                                title="Gỡ ảnh">
                            <span class="material-symbols-outlined text-[16px]">delete</span>
                        </button>
                    </div>

                    
                    

                    <div class="bg-white border border-slate-200 rounded-xl p-3.5 space-y-1">
                        <label class="text-[12px] font-bold text-slate-600 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px] text-slate-500">link</span> Liên kết ngoài (URL)
                        </label>
                        <input type="text" id="actionUrl${newI}" placeholder="Nhập link liên kết..."
                               class="w-full text-[13px] px-3 py-1.5 bg-slate-50/50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all"
                               oninput="syncData()" />
                    </div>

                    <div class="mt-1 flex flex-wrap gap-2">
                        <div id="urlPreviewWrap${newI}" class="hidden flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg text-[12px] font-medium border border-blue-200/50">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                            <span class="truncate max-w-[150px]" id="urlPreviewLink${newI}"></span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col h-full w-full media-text-col mt-2">
                    <textarea id="content${newI}" rows="8" placeholder="Nhập nội dung sự kiện..." class="w-full text-[14px] px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all resize-y h-full" style="min-height: 250px;"></textarea>
                </div>
            </div>`;

            // If template is 5, we shouldn't use lg:grid-cols-2 for new slots.
            let finalHtml = slotHtml;
            if (templateId === '5') {
                finalHtml = finalHtml.replace('lg:grid-cols-2', 'grid-cols-1');
            }

            container.insertAdjacentHTML('beforeend', finalHtml);
            
            // Re-init tinymce for the new textarea if tinymce is available
            if (window.tinymce) {
                tinymce.init({
                    selector: '#content' + newI,
                    menubar: false,
                    min_height: 350,
                    plugins: 'lists link code',
                    toolbar: 'bold italic underline | bullist numlist | link | code',
                    branding: false,
                    setup: function(editor) {
                        editor.on('change', function() {
                            editor.save();
                        });
                    }
                });
            }
        }
    </script>

    @push('scripts')
    <script>
        tinymce.init({
            selector: 'textarea[id^="content"]',
            menubar: false,
            min_height: 350,
            plugins: 'lists link code',
            toolbar: 'bold italic underline | bullist numlist | link | code',
            branding: false,
            setup: function(editor) {
                editor.on('change', function() {
                    tinymce.triggerSave();
                });
            }
        });
    </script>
</body>
</html>

@php
    $apData = $allSpeakers->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'bio' => Str::limit($s->bio, 30), 'photo' => $s->photo_url ? asset($s->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80', 'type' => $s->type ?? 'speaker'])->values()->toArray();
    $ssData = $event->speakers->where('pivot.role', 'speaker')->values()->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'photo' => $s->photo_url ? asset($s->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'])->toArray();

@endphp
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('scheduleManager', (initialItems = []) => ({
            items: initialItems.map(i => ({ ...i, _saved: true })),
            addItem() {
                this.items.push({ id: Date.now().toString(), start_time: '', end_time: '', title: '', _saved: false });
                this.$nextTick(() => { this.syncData(); });
            },
            removeItem(index) {
                this.items.splice(index, 1);
                this.$nextTick(() => { this.syncData(); });
            },
            syncData() {
                if (typeof window.syncData === 'function') {
                    window.syncData();
                }
            }
        }));

        Alpine.data('speakerManager', () => ({
            allPersons: @json($apData),
            selectedSpeakers: @json($ssData),
            dropdownOpen: false,
            searchQuery: '',

            openDropdown() {
                this.searchQuery = '';
                this.dropdownOpen = true;
                setTimeout(() => this.$refs.searchInput.focus(), 100);
            },
            
            closeDropdown() {
                this.dropdownOpen = false;
            },

            get filteredPersons() {
                let baseList = this.allPersons;
                if (this.searchQuery === '') return baseList;
                return baseList.filter(p => p.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
            },

            isSelected(id) {
                return this.selectedSpeakers.some(p => p.id === id);
            },

            togglePerson(person) {
                if (this.isSelected(person.id)) {
                    this.selectedSpeakers = this.selectedSpeakers.filter(p => p.id !== person.id);
                } else {
                    this.selectedSpeakers.push(person);
                }
            },

            removePerson(id) {
                this.selectedSpeakers = this.selectedSpeakers.filter(p => p.id !== id);
            }
        }))
    });
</script>
