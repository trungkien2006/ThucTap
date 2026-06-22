<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UniEvents | Studio — {{ $event->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&family=Be+Vietnam+Pro:wght@400;600;700&family=Charm:wght@400;700&family=Montserrat:wght@400;600;700&family=Pacifico&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
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
                            <label class="uni-label text-brand-orange">Mẫu sự kiện</label>
                            <select id="inEventTemplate" onchange="syncData()" class="uni-input font-bold border-brand-orange/30 focus:border-brand-orange bg-orange-50/30">
                                <option value="1" {{ $event->event_template == 1 ? 'selected' : '' }}>Mẫu 1: Quảng bá bình thường</option>
                                <option value="2" {{ $event->event_template == 2 ? 'selected' : '' }}>Mẫu 2: Quảng bá & Chia sẻ tài liệu</option>
                            </select>
                        </div>

                        <!-- Cấu hình chữ Tiêu đề -->
                        <div class="grid grid-cols-2 gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-200/60">
                            <div class="col-span-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Định dạng chữ Tiêu đề</div>
                            <div class="col-span-2">
                                <label class="uni-label text-[10px] text-slate-400">Kiểu Font chữ</label>
                                <select id="inTieuDeFontFamily" onchange="syncData()" class="uni-input py-1 text-[12px]">
                                    <option value="Inter" {{ ($event->title_font_family ?? 'Inter') == 'Inter' ? 'selected' : '' }}>Inter (Không chân, Hiện đại)</option>
                                    <option value="Be Vietnam Pro" {{ ($event->title_font_family ?? 'Inter') == 'Be Vietnam Pro' ? 'selected' : '' }}>Be Vietnam Pro (Mặc định)</option>
                                    <option value="Montserrat" {{ ($event->title_font_family ?? 'Inter') == 'Montserrat' ? 'selected' : '' }}>Montserrat (Tròn trịa, Trẻ trung)</option>
                                    <option value="Playfair Display" {{ ($event->title_font_family ?? 'Inter') == 'Playfair Display' ? 'selected' : '' }}>Playfair Display (Có chân, Sang trọng)</option>
                                    <option value="Rowdies" {{ ($event->title_font_family ?? 'Inter') == 'Rowdies' ? 'selected' : '' }}>Rowdies (Đậm đà, Cá tính)</option>
                                    <option value="Pacifico" {{ ($event->title_font_family ?? 'Inter') == 'Pacifico' ? 'selected' : '' }}>Pacifico (Nghệ thuật, Viết tay)</option>
                                    <option value="Charm" {{ ($event->title_font_family ?? 'Inter') == 'Charm' ? 'selected' : '' }}>Charm (Mềm mại, Bay bướm)</option>
                                    <option value="Arial" {{ ($event->title_font_family ?? 'Inter') == 'Arial' ? 'selected' : '' }}>Arial (Phổ biến)</option>
                                    <option value="Times New Roman" {{ ($event->title_font_family ?? 'Inter') == 'Times New Roman' ? 'selected' : '' }}>Times New Roman (Cổ điển)</option>
                                    <option value="Courier New" {{ ($event->title_font_family ?? 'Inter') == 'Courier New' ? 'selected' : '' }}>Courier New (Máy đánh chữ)</option>
                                </select>
                            </div>
                            <div>
                                <label class="uni-label text-[10px] text-slate-400">Cỡ chữ</label>
                                <select id="inTieuDeSize" onchange="syncData()" class="uni-input py-1 text-[12px]">
                                    @for($size = 16; $size <= 72; $size += 2)
                                        <option value="{{ $size }}" {{ ($event->title_font_size ?? '36') == $size ? 'selected' : '' }}>{{ $size }}px</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label class="uni-label text-[10px] text-slate-400">Màu chữ</label>
                                <div class="flex items-center gap-1">
                                    <input type="color" id="inTieuDeColor" value="{{ $event->title_color ?? '#ffffff' }}" oninput="document.getElementById('inTieuDeColorText').value = this.value; syncData()" class="w-8 h-8 rounded border border-slate-200 cursor-pointer p-0 bg-transparent shrink-0"/>
                                    <input type="text" id="inTieuDeColorText" value="{{ $event->title_color ?? '#ffffff' }}" oninput="document.getElementById('inTieuDeColor').value = this.value; syncData()" class="uni-input py-1 px-1.5 text-[11px] font-mono w-full min-w-0"/>
                                </div>
                            </div>
                            <div>
                                <label class="uni-label text-[10px] text-slate-400">Viền chữ</label>
                                <select id="inTieuDeOutlineWidth" onchange="syncData()" class="uni-input py-1 text-[12px]">
                                    <option value="0" {{ ($event->title_outline_width ?? '0') == '0' ? 'selected' : '' }}>Không viền</option>
                                    <option value="1" {{ ($event->title_outline_width ?? '0') == '1' ? 'selected' : '' }}>1px</option>
                                    <option value="2" {{ ($event->title_outline_width ?? '0') == '2' ? 'selected' : '' }}>2px</option>
                                    <option value="3" {{ ($event->title_outline_width ?? '0') == '3' ? 'selected' : '' }}>3px</option>
                                    <option value="4" {{ ($event->title_outline_width ?? '0') == '4' ? 'selected' : '' }}>4px</option>
                                </select>
                            </div>
                            <div>
                                <label class="uni-label text-[10px] text-slate-400">Màu viền</label>
                                <div class="flex items-center gap-1">
                                    <input type="color" id="inTieuDeOutlineColor" value="{{ $event->title_outline_color ?? '#000000' }}" oninput="document.getElementById('inTieuDeOutlineColorText').value = this.value; syncData()" class="w-8 h-8 rounded border border-slate-200 cursor-pointer p-0 bg-transparent shrink-0"/>
                                    <input type="text" id="inTieuDeOutlineColorText" value="{{ $event->title_outline_color ?? '#000000' }}" oninput="document.getElementById('inTieuDeOutlineColor').value = this.value; syncData()" class="uni-input py-1 px-1.5 text-[11px] font-mono w-full min-w-0"/>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="uni-label">Mô tả tóm tắt</label>
                            <textarea id="inMoTa" rows="2" oninput="syncData()" class="uni-input">{{ $event->description }}</textarea>
                        </div>

                        <!-- Cấu hình chữ Mô tả -->
                        <div class="grid grid-cols-2 gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-200/60">
                            <div class="col-span-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Định dạng chữ Mô tả</div>
                            <div class="col-span-2">
                                <label class="uni-label text-[10px] text-slate-400">Kiểu Font chữ</label>
                                <select id="inMoTaFontFamily" onchange="syncData()" class="uni-input py-1 text-[12px]">
                                    <option value="Inter" {{ ($event->desc_font_family ?? 'Inter') == 'Inter' ? 'selected' : '' }}>Inter (Không chân, Hiện đại)</option>
                                    <option value="Be Vietnam Pro" {{ ($event->desc_font_family ?? 'Inter') == 'Be Vietnam Pro' ? 'selected' : '' }}>Be Vietnam Pro (Mặc định)</option>
                                    <option value="Montserrat" {{ ($event->desc_font_family ?? 'Inter') == 'Montserrat' ? 'selected' : '' }}>Montserrat (Tròn trịa, Trẻ trung)</option>
                                    <option value="Playfair Display" {{ ($event->desc_font_family ?? 'Inter') == 'Playfair Display' ? 'selected' : '' }}>Playfair Display (Có chân, Sang trọng)</option>
                                    <option value="Arial" {{ ($event->desc_font_family ?? 'Inter') == 'Arial' ? 'selected' : '' }}>Arial (Phổ biến)</option>
                                    <option value="Times New Roman" {{ ($event->desc_font_family ?? 'Inter') == 'Times New Roman' ? 'selected' : '' }}>Times New Roman (Cổ điển)</option>
                                </select>
                            </div>
                            <div>
                                <label class="uni-label text-[10px] text-slate-400">Cỡ chữ</label>
                                <select id="inMoTaSize" onchange="syncData()" class="uni-input py-1 text-[12px]">
                                    @for($size = 12; $size <= 32; $size += 1)
                                        <option value="{{ $size }}" {{ ($event->desc_font_size ?? '14') == $size ? 'selected' : '' }}>{{ $size }}px</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label class="uni-label text-[10px] text-slate-400">Màu chữ</label>
                                <div class="flex items-center gap-1">
                                    <input type="color" id="inMoTaColor" value="{{ $event->desc_color ?? '#475569' }}" oninput="document.getElementById('inMoTaColorText').value = this.value; syncData()" class="w-8 h-8 rounded border border-slate-200 cursor-pointer p-0 bg-transparent shrink-0"/>
                                    <input type="text" id="inMoTaColorText" value="{{ $event->desc_color ?? '#475569' }}" oninput="document.getElementById('inMoTaColor').value = this.value; syncData()" class="uni-input py-1 px-1.5 text-[11px] font-mono w-full min-w-0"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- 2. Schedule -->
                <div id="sec-timeline" class="space-y-3 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">2. Lịch hoạt động cụ thể</h4>
                    <textarea id="inLichHoatDong" rows="3" oninput="syncData()" class="uni-input text-[12px] leading-relaxed" placeholder="VD: 13:30 - Đón tiếp & Check-in&#10;14:00 - Bắt đầu chương trình&#10;16:00 - Tổng kết & Trao quà">{{ $event->scheduleItems->map(fn($s) => $s->start_time . ' - ' . $s->title)->implode("\n") }}</textarea>
                </div>



                <!-- 3. Media Library (Tabbed) -->
                <div id="sec-media" class="space-y-3 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">3. Thư viện Media</h4>

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

                <!-- 4. Speaker -->
                <div id="sec-speaker" class="space-y-3 pt-2 border-t border-slate-100 mb-4 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">4. Nhân sự đại diện</h4>
                    <select id="inTenDienGia" onchange="syncData()" class="uni-input">
                        <option value="" data-name="Chuyên gia Creative Director" data-photo="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80">-- Chọn diễn giả (Mặc định) --</option>
                        @foreach($allSpeakers as $speaker)
                            <option value="{{ $speaker->id }}" data-name="{{ $speaker->name }}" data-photo="{{ $speaker->photo_url ? asset($speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}" {{ $event->speakers->contains('id', $speaker->id) ? 'selected' : '' }}>
                                {{ $speaker->name }} - {{ Str::limit($speaker->bio, 30) }}
                            </option>
                        @endforeach
                    </select>
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
                                         class="media-slot w-full {{ $hasMedia ? 'h-auto' : 'h-32' }} bg-white hover:bg-slate-50 border-2 {{ $hasMedia ? '' : 'border-dashed' }} border-slate-300 hover:border-brand-orange rounded-xl flex items-center justify-center gap-2 cursor-pointer text-slate-500 hover:text-brand-orange transition-all {{ $hasMedia ? 'slot-filled' : '' }}"
                                         data-slot="{{ $i }}" id="slot{{ $i }}">
                                        @if($hasMedia)
                                            @if($media->type === 'video')
                                                <video src="{{ Storage::url($media->url) }}" class="w-full h-auto rounded-xl" autoplay loop muted playsinline></video>
                                            @else
                                                <img src="{{ Storage::url($media->url) }}" class="w-full h-auto rounded-xl" alt=""/>
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

                                {{-- Tài liệu đính kèm (Word, Zip...) --}}
                                <div class="doc-upload-section bg-white border border-slate-200 rounded-xl p-3.5 space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[12px] font-bold text-slate-600 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-slate-500">attach_file</span> Tài liệu đính kèm
                                        </span>
                                        <input type="file" id="docFileInput{{ $i }}" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip" onchange="uploadDocumentFile({{ $i }})"/>
                                        <button type="button" onclick="document.getElementById('docFileInput{{ $i }}').click()" class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-[11px] font-semibold transition-all">
                                            Tải file (Word, Zip, PDF...)
                                        </button>
                                    </div>
                                    <div class="flex items-center gap-2 {{ $media && $media->document_url ? '' : 'hidden' }}" id="docInfoWrap{{ $i }}">
                                        <span class="material-symbols-outlined text-[16px] text-emerald-600">article</span>
                                        <a href="{{ $media && $media->document_url ? Storage::url($media->document_url) : '#' }}" id="docLink{{ $i }}" target="_blank" class="text-[12px] font-medium text-brand-orange hover:underline truncate max-w-[200px]">
                                            {{ $media ? ($media->document_name ?? basename($media->document_url)) : '' }}
                                        </a>
                                        <button type="button" onclick="removeDocumentFile({{ $i }})" class="text-red-500 hover:text-red-700 ml-auto flex items-center">
                                            <span class="material-symbols-outlined text-[16px]">close</span>
                                        </button>
                                    </div>
                                    <input type="hidden" id="docFileUrl{{ $i }}" value="{{ $media ? $media->document_url : '' }}" />
                                    <input type="hidden" id="docFileName{{ $i }}" value="{{ $media ? $media->document_name : '' }}" />
                                </div>

                                {{-- URL liên kết ngoài --}}
                                <div class="bg-white border border-slate-200 rounded-xl p-3.5 space-y-1">
                                    <label class="text-[12px] font-bold text-slate-600 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-slate-500">link</span> Liên kết ngoài (URL)
                                    </label>
                                    <input type="text" id="actionUrl{{ $i }}" placeholder="Nhập link liên kết (VD: https://poly.edu.vn)..."
                                           class="w-full text-[13px] px-3 py-1.5 bg-slate-50/50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all"
                                           value="{{ $media ? $media->action_url : '' }}" oninput="syncData()" />
                                </div>

                                {{-- Preview tài liệu và URL ngay dưới caption --}}
                                <div class="mt-1 flex flex-wrap gap-2">
                                    <div id="docPreviewWrap{{ $i }}" class="flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg text-[12px] font-medium border border-emerald-200/50 {{ $media && $media->document_url ? '' : 'hidden' }}">
                                        <span class="material-symbols-outlined text-[16px]">article</span>
                                        <span id="docPreviewName{{ $i }}">{{ $media ? ($media->document_name ?? basename($media->document_url)) : '' }}</span>
                                    </div>
                                    <div id="urlPreviewWrap{{ $i }}" class="flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg text-[12px] font-medium border border-blue-200/50 {{ $media && $media->action_url ? '' : 'hidden' }}">
                                        <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                        <span class="truncate max-w-[150px]" id="urlPreviewLink{{ $i }}">{{ $media ? $media->action_url : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-4 space-y-6" style="position: sticky; top: 88px; align-self: start; height: max-content;">
                    <!-- Speaker Card -->
                    <div onclick="openEditor('sec-speaker')" class="uni-card p-6 cursor-pointer hover:border-slate-300 transition-all group">
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
                                            <img src="{{ Storage::url($newEv->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
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
                                            <img src="{{ Storage::url($promEv->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
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
            slot.classList.remove('slot-filled', 'h-auto');
            slot.classList.add('border-dashed', 'border-slate-300', 'h-32');
            document.getElementById('removeBtn' + slotNum).classList.add('hidden');
        }

        function applyMediaToSlot(url, type) {
            if (!activeSlotId) return false;
            const slot = document.getElementById('slot' + activeSlotId);
            if (type === 'video') {
                slot.innerHTML = `<video src="${url}" class="w-full h-auto rounded-xl" autoplay loop muted></video>`;
            } else {
                slot.innerHTML = `<img src="${url}" class="w-full h-auto rounded-xl" alt=""/>`;
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
            const titleEl = document.getElementById('viewTieuDe');
            titleEl.innerText = document.getElementById('inTieuDe').value;

            // Template toggle
            const template = document.getElementById('inEventTemplate').value;
            const docSections = document.querySelectorAll('.doc-upload-section');
            if (template === '1') {
                docSections.forEach(el => el.classList.add('hidden'));
            } else {
                docSections.forEach(el => el.classList.remove('hidden'));
            }

            // Apply Tiêu đề style
            const titleSize = document.getElementById('inTieuDeSize').value;
            const titleColor = document.getElementById('inTieuDeColor').value;
            const titleOutlineWidth = document.getElementById('inTieuDeOutlineWidth').value;
            const titleOutlineColor = document.getElementById('inTieuDeOutlineColor').value;
            const titleFontFamily = document.getElementById('inTieuDeFontFamily').value;

            titleEl.style.fontSize = titleSize + 'px';
            titleEl.style.color = titleColor;
            titleEl.style.fontFamily = `'${titleFontFamily}', sans-serif`;
            if (titleOutlineWidth && titleOutlineWidth !== '0') {
                titleEl.style.webkitTextStrokeWidth = titleOutlineWidth + 'px';
                titleEl.style.webkitTextStrokeColor = titleOutlineColor;
                titleEl.style.textShadow = `0px 2px 4px rgba(0,0,0,0.5)`;
            } else {
                titleEl.style.webkitTextStrokeWidth = '0px';
                titleEl.style.textShadow = 'none';
            }

            const descEl = document.getElementById('viewMoTa');
            descEl.innerText = document.getElementById('inMoTa').value;

            // Apply Mô tả style
            const descSize = document.getElementById('inMoTaSize').value;
            const descColor = document.getElementById('inMoTaColor').value;
            const descFontFamily = document.getElementById('inMoTaFontFamily').value;

            descEl.style.fontSize = descSize + 'px';
            descEl.style.color = descColor;
            descEl.style.fontFamily = `'${descFontFamily}', sans-serif`;

            document.getElementById('viewLichHoatDong').innerText = document.getElementById('inLichHoatDong').value;
            
            // Speaker
            const spkSelect = document.getElementById('inTenDienGia');
            if(spkSelect) {
                const opt = spkSelect.options[spkSelect.selectedIndex];
                document.getElementById('viewTenDienGia').innerText = opt.getAttribute('data-name');
                const photoUrl = opt.getAttribute('data-photo');
                if(photoUrl) document.getElementById('viewAnhDienGia').src = photoUrl;
            }

            // Sync URL previews
            for (let i = 1; i <= 4; i++) {
                const actionUrlVal = document.getElementById('actionUrl' + i).value.trim();
                const urlPreviewWrap = document.getElementById('urlPreviewWrap' + i);
                const urlPreviewLink = document.getElementById('urlPreviewLink' + i);
                
                if (actionUrlVal) {
                    urlPreviewWrap.classList.remove('hidden');
                    urlPreviewLink.textContent = actionUrlVal;
                } else {
                    urlPreviewWrap.classList.add('hidden');
                }
            }
        }

        // ── Document Upload (AJAX) ────────────────────────────────
        async function uploadDocumentFile(slotId) {
            const fileInput = document.getElementById('docFileInput' + slotId);
            if (!fileInput.files || fileInput.files.length === 0) return;
            
            const file = fileInput.files[0];
            const formData = new FormData();
            formData.append('file', file);
            
            // Show simple indicator
            const linkEl = document.getElementById('docLink' + slotId);
            linkEl.textContent = "Đang tải lên...";
            document.getElementById('docInfoWrap' + slotId).classList.remove('hidden');
            
            try {
                const resp = await fetch("{{ route('admin.events.upload_document') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                if (!resp.ok) {
                    throw new Error("Lỗi tải file");
                }
                
                const data = await resp.json();
                if (data.success) {
                    // Update values
                    document.getElementById('docFileUrl' + slotId).value = data.url;
                    document.getElementById('docFileName' + slotId).value = data.name;
                    
                    // Show file info
                    linkEl.href = data.url;
                    linkEl.textContent = data.name;
                    
                    // Update preview
                    document.getElementById('docPreviewWrap' + slotId).classList.remove('hidden');
                    document.getElementById('docPreviewName' + slotId).textContent = data.name;
                } else {
                    alert("Lỗi: " + (data.message || "Không thể tải lên file."));
                    removeDocumentFile(slotId);
                }
            } catch (err) {
                console.error(err);
                alert("Lỗi tải lên tài liệu.");
                removeDocumentFile(slotId);
            } finally {
                fileInput.value = '';
            }
        }

        function removeDocumentFile(slotId) {
            document.getElementById('docFileUrl' + slotId).value = '';
            document.getElementById('docFileName' + slotId).value = '';
            document.getElementById('docInfoWrap' + slotId).classList.add('hidden');
            document.getElementById('docPreviewWrap' + slotId).classList.add('hidden');
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

            const formData = {
                title: document.getElementById('inTieuDe').value,
                description: document.getElementById('inMoTa').value,
                speaker_id: document.getElementById('inTenDienGia').value,
                schedule_text: document.getElementById('inLichHoatDong').value,
                
                // Styles
                title_font_size: document.getElementById('inTieuDeSize').value,
                title_color: document.getElementById('inTieuDeColor').value,
                title_outline_color: document.getElementById('inTieuDeOutlineColor').value,
                title_outline_width: document.getElementById('inTieuDeOutlineWidth').value,
                title_font_family: document.getElementById('inTieuDeFontFamily').value,
                desc_font_size: document.getElementById('inMoTaSize').value,
                desc_color: document.getElementById('inMoTaColor').value,
                desc_font_family: document.getElementById('inMoTaFontFamily').value,
                event_template: document.getElementById('inEventTemplate').value,
                
                media_slots: []
            };

            for (let i = 1; i <= 4; i++) {
                const slot = document.getElementById('slot' + i);
                const captionEl = document.getElementById('caption' + i);
                const contentEl = document.getElementById('content' + i);
                const docFileUrlVal = document.getElementById('docFileUrl' + i).value;
                const docFileNameVal = document.getElementById('docFileName' + i).value;
                const actionUrlVal = document.getElementById('actionUrl' + i).value;
                const mediaEl = slot.querySelector('img, video');
                
                if ((mediaEl && mediaEl.src) || (contentEl && contentEl.value.trim() !== '') || docFileUrlVal || actionUrlVal) {
                    formData.media_slots.push({
                        url: mediaEl && mediaEl.src ? mediaEl.src : '',
                        caption: captionEl ? captionEl.value : '',
                        content: contentEl ? contentEl.value : '',
                        document_url: docFileUrlVal,
                        document_name: docFileNameVal,
                        action_url: actionUrlVal
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
            } finally {
                // Ẩn Overlay Loading
                if (loadingOverlay) {
                    loadingOverlay.classList.add('hidden');
                }
            }
        }

        window.addEventListener('DOMContentLoaded', () => { syncData(); });
    </script>

    <!-- TinyMCE for rich text formatting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea[id^="content"]',
            menubar: false,
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
