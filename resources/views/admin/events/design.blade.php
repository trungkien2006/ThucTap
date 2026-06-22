<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UniEvents | Studio — {{ $event->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background-color: #0f172a; }

        /* Active slot highlight */
        .media-slot.slot-active {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 3px rgba(249,115,22,0.25);
        }
        .media-slot.slot-filled {
            border-style: solid !important;
            border-color: #e2e8f0 !important;
        }

        /* Media library item */
        .lib-item { transition: all 0.15s; cursor: pointer; }
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
<body class="overflow-x-clip pt-[64px]">
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
                <div id="sec-info" class="space-y-3 pt-1 transition-all rounded-lg p-2 -m-2">
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

                <!-- 2. Time & Location -->
                <div id="sec-time" class="space-y-3 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">2. Thời gian & Địa điểm</h4>
                    <div class="space-y-2.5">
                        <div>
                            <label class="uni-label">Ngày diễn ra</label>
                            <input type="date" id="inNgay" value="{{ $event->event_date->format('Y-m-d') }}" onchange="syncData()" class="uni-input"/>
                        </div>
                        <div>
                            <label class="uni-label">Khung giờ hoạt động</label>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[11px] text-slate-400 shrink-0">Từ:</span>
                                    <input type="time" id="inGioBatDau" value="{{ $event->event_date->format('H:i') }}" onchange="syncData()" class="uni-input py-1.5"/>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[11px] text-slate-400 shrink-0">Đến:</span>
                                    <input type="time" id="inGioKetThuc" value="{{ $event->end_date ? $event->end_date->format('H:i') : '17:00' }}" onchange="syncData()" class="uni-input py-1.5"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="uni-label">Vị trí / Địa điểm</label>
                            <input type="text" id="inDiaDiem" value="{{ $event->location }}" oninput="syncData()" class="uni-input"/>
                        </div>
                    </div>
                </div>

                <!-- 3. Schedule -->
                <div id="sec-timeline" class="space-y-3 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">3. Lịch hoạt động cụ thể</h4>
                    <textarea id="inLichHoatDong" rows="3" oninput="syncData()" class="uni-input text-[12px] leading-relaxed" placeholder="VD: 13:30 - Đón tiếp & Check-in&#10;14:00 - Bắt đầu chương trình&#10;16:00 - Tổng kết & Trao quà">{{ $event->scheduleItems->map(fn($s) => $s->start_time . ' - ' . $s->title)->implode("\n") }}</textarea>
                </div>

                <!-- 4. Classification -->
                <div class="space-y-3 pt-2 border-t border-slate-100">
                    <h4 class="uni-section-title">4. Giới hạn & Phân loại</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="uni-label">Học kỳ</label>
                            <select id="inHocKy" onchange="syncData()" class="uni-input">
                                <option value="Spring 2024">Spring 2024</option>
                                <option value="Summer 2024">Summer 2024</option>
                                <option value="Fall 2024" selected>Fall 2024</option>
                                <option value="Spring 2025">Spring 2025</option>
                            </select>
                        </div>
                        <div>
                            <label class="uni-label">Khối ngành</label>
                            <select id="inNganh" onchange="syncData()" class="uni-input">
                                <option value="Công nghệ thông tin">Công nghệ thông tin</option>
                                <option value="Thiết kế đồ họa" {{ $event->category?->name == 'Thiết kế đồ họa' ? 'selected' : '' }}>Thiết kế đồ họa</option>
                                <option value="Digital Marketing">Digital Marketing</option>
                                <option value="Quản trị khách sạn">Quản trị khách sạn</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="uni-label">Số lượng tối đa</label>
                        <input type="number" id="inToiDa" value="{{ $event->max_attendees ?? 50 }}" oninput="syncData()" class="uni-input"/>
                    </div>
                </div>

                <!-- 5. Media Library (Tabbed) -->
                <div id="sec-media" class="space-y-3 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">5. Thư viện Media</h4>

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
                    <div id="tabPanelLibrary">
                        @if(count($mediaLibrary) > 0)
                        <div id="mediaLibraryGrid" class="grid grid-cols-3 gap-2 max-h-[220px] overflow-y-auto pr-1">
                            @foreach($mediaLibrary as $media)
                            <div class="lib-item relative aspect-square rounded-xl overflow-hidden border-2 border-transparent bg-slate-900"
                                 onclick="applyLibraryItem('{{ Storage::url($media->url) }}', '{{ $media->type }}')"
                                 title="{{ $media->caption ?? basename($media->url) }}">
                                @if($media->type === 'video')
                                    <video src="{{ Storage::url($media->url) }}" class="w-full h-full object-cover"></video>
                                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-[24px]">play_circle</span>
                                    </div>
                                @else
                                    <img src="{{ Storage::url($media->url) }}" class="w-full h-full object-cover" alt="">
                                @endif
                                <div class="absolute inset-0 bg-black/0 hover:bg-black/30 transition-all flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 text-[20px]">add_photo_alternate</span>
                                </div>
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

                <!-- 6. Speaker -->
                <div id="sec-speaker" class="space-y-3 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">6. Nhân sự đại diện</h4>
                    <select id="inTenDienGia" onchange="syncData()" class="uni-input">
                        <option value="" data-name="Chuyên gia Creative Director" data-photo="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80">-- Chọn diễn giả (Mặc định) --</option>
                        @foreach($allSpeakers as $speaker)
                            <option value="{{ $speaker->id }}" data-name="{{ $speaker->name }}" data-photo="{{ $speaker->photo_url ? asset($speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}" {{ $event->speakers->contains('id', $speaker->id) ? 'selected' : '' }}>
                                {{ $speaker->name }} - {{ Str::limit($speaker->bio, 30) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 7. Design Options -->
                <div id="sec-design" class="space-y-4 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">7. Thiết kế & Giao diện</h4>
                    
                    <div class="space-y-3">
                        <label class="uni-label flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">palette</span> 🎨 Giao diện</label>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="text-[11px] text-slate-500">Màu chủ đạo</label>
                                <input type="color" value="#f97316" class="w-full h-8 rounded-lg cursor-pointer border border-slate-200">
                            </div>
                            <div>
                                <label class="text-[11px] text-slate-500">Font chữ</label>
                                <select class="uni-input py-1 text-[12px]">
                                    <option>Inter</option>
                                    <option selected>Barlow Condensed</option>
                                    <option>Roboto</option>
                                    <option>Playfair Display</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[11px] text-slate-500">Bo góc</label>
                                <select class="uni-input py-1 text-[12px]">
                                    <option>Nhỏ (4px)</option>
                                    <option>Vừa (8px)</option>
                                    <option selected>Lớn (16px)</option>
                                    <option>Tròn (99px)</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[11px] text-slate-500">Shadow</label>
                                <select class="uni-input py-1 text-[12px]">
                                    <option>Không có</option>
                                    <option selected>Mềm mại</option>
                                    <option>Đậm</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2">
                        <label class="uni-label flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">auto_awesome</span> ✨ Hiệu ứng</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex items-center gap-2 p-2 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50">
                                <input type="radio" name="effect" class="accent-brand-orange"> <span class="text-[12px]">Không</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50">
                                <input type="radio" name="effect" class="accent-brand-orange"> <span class="text-[12px]">Đom đóm</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50">
                                <input type="radio" name="effect" checked class="accent-brand-orange"> <span class="text-[12px]">Tuyết</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50">
                                <input type="radio" name="effect" class="accent-brand-orange"> <span class="text-[12px]">Sao trời</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50">
                                <input type="radio" name="effect" class="accent-brand-orange"> <span class="text-[12px]">Lá rơi</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50">
                                <input type="radio" name="effect" class="accent-brand-orange"> <span class="text-[12px]">Bokeh</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2">
                        <label class="uni-label flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">dashboard_customize</span> 📐 Bố cục</label>
                        <select class="uni-input">
                            <option>Classic</option>
                            <option selected>Modern</option>
                            <option>Timeline</option>
                            <option>Gallery</option>
                        </select>
                    </div>
                </div>

                <!-- 8. Document & Files -->
                <div id="sec-docs" class="space-y-3 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2 mb-4">
                    <h4 class="uni-section-title">8. Tài liệu đính kèm</h4>
                    <p class="text-[11px] text-slate-500 mb-2">Thêm tài liệu Excel, Word, PDF cho người tham gia tải về.</p>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-4 text-center cursor-pointer hover:border-brand-orange hover:bg-orange-50 transition-all">
                        <span class="material-symbols-outlined text-[24px] text-slate-400 mb-1">note_add</span>
                        <p class="text-[12px] font-medium text-slate-600">Tải tài liệu lên</p>
                    </div>
                    <!-- Sample doc container -->
                    <div class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-xl shadow-sm mt-3">
                        <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-green-600 shrink-0">
                            <span class="material-symbols-outlined">table_view</span>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="text-[13px] font-semibold text-primary truncate">Danh_sach_chia_nhom.xlsx</p>
                            <p class="text-[11px] text-slate-400">1.2 MB</p>
                        </div>
                        <button class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                        </button>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-xl shadow-sm">
                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 shrink-0">
                            <span class="material-symbols-outlined">description</span>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="text-[13px] font-semibold text-primary truncate">Tai_lieu_huong_dan.docx</p>
                            <p class="text-[11px] text-slate-400">850 KB</p>
                        </div>
                        <button class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                        </button>
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
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.events.index') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white font-bold text-lg font-heading">U</div>
                        <span class="text-[18px] font-bold text-primary font-heading tracking-tight">
                            UniEvents
                            <span class="text-brand-orange font-normal text-[14px]">| Studio</span>
                        </span>
                    </a>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Step indicator mini -->
                    <div class="hidden md:flex items-center gap-2 mr-4">
                        <a href="{{ route('admin.events.edit', $event) }}" class="text-[12px] text-slate-400 hover:text-primary transition-colors">① Thông tin</a>
                        <span class="text-slate-300">→</span>
                        <span class="text-[12px] text-primary font-semibold">② Thiết kế</span>
                        <span class="text-slate-300">→</span>
                        <a href="{{ route('admin.events.preview', $event) }}" class="text-[12px] text-slate-400 hover:text-primary transition-colors">③ Xem trước</a>
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
                    style="background-image: url('{{ $event->bannerImage ? Storage::url($event->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=80' }}');">
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

                    <!-- Media Gallery -->
                    <div class="uni-card p-6">
                        <div class="flex items-center justify-between mb-5 border-b border-slate-100 pb-3">
                            <h3 class="text-[18px] font-bold text-primary font-heading flex items-center gap-2">
                                <span class="w-1 h-5 bg-primary rounded-full"></span>Nội dung chính
                            </h3>
                            <span class="text-[11px] text-slate-400">Nhập nội dung sự kiện và chọn ảnh minh hoạ</span>
                        </div>

                        <div class="space-y-6" id="mediaSlots">
                            @php $galleryMedia = $event->galleryImages->take(4)->values(); @endphp
                            @for($i = 1; $i <= 4; $i++)
                            @php 
                                $media = $galleryMedia->get($i - 1); 
                                $hasMedia = $media ? true : false;
                            @endphp
                            <div class="flex flex-col gap-3 bg-slate-50/50 p-4 rounded-xl border border-slate-100" data-slot-wrap="{{ $i }}">
                                {{-- Content --}}
                                <textarea id="content{{ $i }}" rows="3" placeholder="Nhập nội dung sự kiện cho đoạn này..."
                                       class="w-full text-[14px] px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all resize-y">{{ $media ? $media->content : '' }}</textarea>
                                       
                                {{-- Image slot --}}
                                <div class="relative">
                                    <div onclick="activateSlot({{ $i }})"
                                         class="media-slot w-full h-32 bg-white hover:bg-slate-50 border-2 {{ $hasMedia ? '' : 'border-dashed' }} border-slate-300 hover:border-brand-orange rounded-xl flex items-center justify-center gap-2 cursor-pointer text-slate-500 hover:text-brand-orange transition-all {{ $hasMedia ? 'slot-filled' : '' }}"
                                         data-slot="{{ $i }}" id="slot{{ $i }}">
                                        @if($hasMedia)
                                            @if($media->type === 'video')
                                                <video src="{{ Storage::url($media->url) }}" class="w-full h-full object-cover rounded-xl" autoplay loop muted playsinline></video>
                                            @else
                                                <img src="{{ Storage::url($media->url) }}" class="w-full h-full object-cover rounded-xl" alt=""/>
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
                                {{-- Caption --}}
                                <input type="text" id="caption{{ $i }}" placeholder="Nhập ghi chú / mô tả cho ảnh {{ $i }}..."
                                       class="w-full text-[13px] px-3 py-2 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all"
                                       value="{{ $media ? $media->caption : '' }}" />
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-4 space-y-6" style="position: sticky; top: 88px; align-self: start; height: max-content;">
                    <!-- Registration Card -->
                    <div class="uni-card p-5">
                        <div class="flex justify-between items-center mb-4 border-b border-slate-100 pb-3">
                            <span class="text-[13px] text-slate-500 font-medium">Cổng đăng ký</span>
                            <span class="badge-success flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                Đang mở
                            </span>
                        </div>

                        <div class="space-y-3.5 mb-5">
                            <div onclick="openEditor('sec-time')" class="flex items-center gap-3.5 cursor-pointer hover:bg-slate-50 p-1.5 rounded-lg transition-all">
                                <div class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-400 font-medium">Ngày diễn ra</p>
                                    <p id="viewNgay" class="text-[13px] font-semibold text-primary">{{ $event->event_date->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div onclick="openEditor('sec-time')" class="flex items-center gap-3.5 cursor-pointer hover:bg-slate-50 p-1.5 rounded-lg transition-all">
                                <div class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">schedule</span>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-400 font-medium">Thời gian</p>
                                    <p id="viewGio" class="text-[13px] font-semibold text-primary">{{ $event->event_date->format('H:i') }} - {{ $event->end_date ? $event->end_date->format('H:i') : '17:00' }}</p>
                                </div>
                            </div>
                            <div onclick="openEditor('sec-time')" class="flex items-center gap-3.5 cursor-pointer hover:bg-slate-50 p-1.5 rounded-lg transition-all">
                                <div class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-400 font-medium">Địa điểm</p>
                                    <p id="viewDiaDiem" class="text-[13px] font-semibold text-primary">{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>

                        <button class="w-full py-2.5 bg-brand-orange hover:bg-orange-600 text-white rounded-xl text-[13px] font-bold transition-all shadow-md shadow-orange-500/10 pointer-events-none">
                            Giữ chỗ (Giới hạn: <span id="viewToiDa">{{ $event->max_attendees ?? 50 }}</span> slot)
                        </button>
                    </div>

                    <!-- Schedule Card -->
                    <div onclick="openEditor('sec-timeline')" class="uni-card p-5 cursor-pointer hover:border-slate-300 transition-all">
                        <h4 class="text-[13px] font-bold text-primary mb-3 font-heading flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-brand-orange">format_list_bulleted</span>
                            Lịch hoạt động sự kiện
                        </h4>
                        <div id="viewLichHoatDong" class="text-[12px] text-slate-600 bg-slate-50 p-3 rounded-xl border border-slate-100 whitespace-pre-line leading-relaxed">
                            {{ $event->scheduleItems->map(fn($s) => $s->start_time . ' - ' . $s->title)->implode("\n") ?: "Chưa có lịch hoạt động" }}
                        </div>
                    </div>

                    <!-- Speaker Card -->
                    <div onclick="openEditor('sec-info')" class="uni-card p-6 cursor-pointer hover:border-slate-300 transition-all group">
                        <div class="flex justify-between items-center mb-4 border-b border-slate-100 pb-3">
                            <span class="text-[13px] text-slate-500 font-medium">Diễn giả chính</span>
                            <span class="material-symbols-outlined text-slate-400 group-hover:text-brand-orange transition-colors text-[18px]">edit</span>
                        </div>
                        <div class="flex gap-4 items-center">
                            <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-slate-200 shadow-inner bg-slate-50">
                                <img id="viewAnhDienGia" class="w-full h-full object-cover" src="{{ $event->speakers->first()?->photo_url ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}"/>
                            </div>
                            <div>
                                <span class="text-brand-orange text-[10px] font-bold uppercase tracking-widest block mb-0.5">Keynote Speaker</span>
                                <h3 id="viewTenDienGia" class="text-[16px] font-bold font-heading text-primary">
                                    {{ $event->speakers->first()?->name ?? 'Chuyên gia Creative Director' }}
                                </h3>
                                <p class="text-[12px] text-slate-400 font-light">Nhấn để cấu hình nhân sự</p>
                            </div>
                        </div>
                    </div>
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
            if (sectionId) {
                setTimeout(() => {
                    const targetNode = document.getElementById(sectionId);
                    if (targetNode) {
                        targetNode.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        targetNode.classList.add('bg-orange-50/70');
                        setTimeout(() => targetNode.classList.remove('bg-orange-50/70'), 1000);
                    }
                }, 200);
            }
        }
        function closeEditor() { document.body.classList.remove('drawer-open'); }

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
            slot.classList.remove('slot-filled');
            slot.classList.add('border-dashed', 'border-slate-300');
            document.getElementById('removeBtn' + slotNum).classList.add('hidden');
        }

        function applyMediaToSlot(url, type) {
            if (!activeSlotId) return false;
            const slot = document.getElementById('slot' + activeSlotId);
            if (type === 'video') {
                slot.innerHTML = `<video src="${url}" class="w-full h-full object-cover rounded-xl" autoplay loop muted></video>`;
            } else {
                slot.innerHTML = `<img src="${url}" class="w-full h-full object-cover rounded-xl" alt=""/>`;
            }
            slot.classList.add('slot-filled');
            slot.classList.remove('border-dashed', 'border-slate-300', 'slot-active');

            // Show remove button
            document.getElementById('removeBtn' + activeSlotId).classList.remove('hidden');
            document.getElementById('removeBtn' + activeSlotId).classList.add('flex');

            clearActiveSlot();
            return true;
        }

        // ── Library pick ─────────────────────────────────────────
        function applyLibraryItem(url, type = 'image') {
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
            event.currentTarget && event.currentTarget.classList.add('selected');
            applyMediaToSlot(url, type);
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
                    const grid = document.getElementById('mediaLibraryGrid');
                    if (!grid) {
                        // If grid doesn't exist (was empty), recreate the panel
                        document.getElementById('tabPanelLibrary').innerHTML = `<div id="mediaLibraryGrid" class="grid grid-cols-3 gap-2 max-h-[220px] overflow-y-auto pr-1"></div>`;
                    }
                    const libGrid = document.getElementById('mediaLibraryGrid');

                    data.files.forEach(file => {
                        if (file.type === 'image' || file.type === 'video') {
                            const div = document.createElement('div');
                            div.className = 'lib-item relative aspect-square rounded-xl overflow-hidden border-2 border-transparent bg-slate-900';
                            div.title = file.caption;
                            div.onclick = () => applyLibraryItem(file.url, file.type);
                            
                            let mediaHtml = '';
                            if (file.type === 'video') {
                                mediaHtml = `<video src="${file.url}" class="w-full h-full object-cover"></video>
                                             <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                                 <span class="material-symbols-outlined text-white text-[24px]">play_circle</span>
                                             </div>`;
                            } else {
                                mediaHtml = `<img src="${file.url}" class="w-full h-full object-cover" alt="">`;
                            }

                            div.innerHTML = `${mediaHtml}
                                <div class="absolute inset-0 bg-black/0 hover:bg-black/30 transition-all flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white opacity-0 hover:opacity-100 text-[20px]">add_photo_alternate</span>
                                </div>`;
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
                        applyMediaToSlot(data.files[0].url, data.files[0].type);
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
            document.getElementById('viewTieuDe').innerText = document.getElementById('inTieuDe').value;
            document.getElementById('viewMoTa').innerText = document.getElementById('inMoTa').value;
            const rawDate = document.getElementById('inNgay').value;
            document.getElementById('viewNgay').innerText = formatDisplayDate(rawDate);
            const startTime = document.getElementById('inGioBatDau').value || '--:--';
            const endTime = document.getElementById('inGioKetThuc').value || '--:--';
            document.getElementById('viewGio').innerText = `${startTime} - ${endTime}`;
            document.getElementById('viewLichHoatDong').innerText = document.getElementById('inLichHoatDong').value;
            document.getElementById('viewDiaDiem').innerText = document.getElementById('inDiaDiem').value;
            document.getElementById('viewHocKy').innerText = document.getElementById('inHocKy').value;
            document.getElementById('viewNganh').innerText = document.getElementById('inNganh').value;
            document.getElementById('viewToiDa').innerText = document.getElementById('inToiDa').value;
            
            // Speaker
            const spkSelect = document.getElementById('inTenDienGia');
            if(spkSelect) {
                const opt = spkSelect.options[spkSelect.selectedIndex];
                document.getElementById('viewTenDienGia').innerText = opt.getAttribute('data-name');
                const photoUrl = opt.getAttribute('data-photo');
                if(photoUrl) document.getElementById('viewAnhDienGia').src = photoUrl;
            }
        }

        async function saveDesignThen(callback) {
            const formData = {
                title: document.getElementById('inTieuDe').value,
                description: document.getElementById('inMoTa').value,
                event_date: document.getElementById('inNgay').value,
                start_time: document.getElementById('inGioBatDau').value,
                end_date: document.getElementById('inGioKetThuc').value,
                location: document.getElementById('inDiaDiem').value,
                academic_year: document.getElementById('inHocKy').value,
                department_id: document.getElementById('inNganh').selectedIndex > 0 ? 1 : null,
                max_attendees: document.getElementById('inToiDa').value,
                speaker_id: document.getElementById('inTenDienGia').value,
                schedule_text: document.getElementById('inLichHoatDong').value,
                media_slots: []
            };

            for (let i = 1; i <= 4; i++) {
                const slot = document.getElementById('slot' + i);
                const captionEl = document.getElementById('caption' + i);
                const contentEl = document.getElementById('content' + i);
                const mediaEl = slot.querySelector('img, video');
                
                if ((mediaEl && mediaEl.src) || (contentEl && contentEl.value.trim() !== '')) {
                    formData.media_slots.push({
                        url: mediaEl && mediaEl.src ? mediaEl.src : '',
                        caption: captionEl ? captionEl.value : '',
                        content: contentEl ? contentEl.value : ''
                    });
                }
            }

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
                    alert('Lỗi lưu cấu hình!');
                }
            } catch (e) {
                console.error(e);
                alert('Lỗi lưu cấu hình!');
            }
        }

        window.addEventListener('DOMContentLoaded', () => { syncData(); });
    </script>
</body>
</html>
