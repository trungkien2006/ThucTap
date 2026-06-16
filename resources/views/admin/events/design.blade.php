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
    </style>
</head>
<body class="overflow-x-hidden pt-[64px]">
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

                <!-- 5. Media -->
                <div id="sec-media" class="space-y-3 pt-2 border-t border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">5. Thư viện Media</h4>
                    <p class="text-[11px] text-slate-400 mb-2">Chọn ảnh từ thư viện hoặc tải ảnh mới lên.</p>

                    <!-- Media Library Grid -->
                    <div id="mediaLibrary" class="grid grid-cols-3 gap-2 max-h-[200px] overflow-y-auto">
                        @foreach($event->media as $media)
                        <div class="media-select-item relative aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-brand-orange cursor-pointer transition-all" onclick="selectMedia(this, '{{ Storage::url($media->url) }}')" data-url="{{ Storage::url($media->url) }}">
                            <img src="{{ Storage::url($media->url) }}" class="w-full h-full object-cover" alt="">
                            <div class="absolute inset-0 bg-black/0 hover:bg-black/20 transition-all flex items-center justify-center">
                                <span class="material-symbols-outlined text-white opacity-0 hover:opacity-100 text-[20px]">check_circle</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="space-y-1">
                        <label class="uni-label">Tải ảnh mới (Bôi đen nhiều file)</label>
                        <input type="file" id="inHeroBg" accept="image/*" multiple onchange="handleFileSelect(this)" class="w-full text-[12px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[12px] file:font-semibold file:bg-slate-100 file:text-primary hover:file:bg-slate-200 transition-all cursor-pointer border border-slate-200 rounded-xl p-1"/>
                    </div>
                </div>

                <!-- 6. Speaker -->
                <div id="sec-speaker" class="space-y-3 pt-2 border-t border-slate-100 mb-4 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">6. Nhân sự đại diện</h4>
                    <input type="text" id="inTenDienGia" value="{{ $event->speakers->first()?->name ?? 'Chuyên gia Creative Director' }}" oninput="syncData()" class="uni-input"/>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-slate-100 space-y-2">
                <button onclick="closeEditor()" class="w-full py-2.5 bg-primary hover:bg-slate-800 text-white font-semibold rounded-xl text-[13px] shadow transition-all">
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
                    <a href="{{ route('admin.events.preview', $event) }}" class="flex items-center gap-2 px-4 py-2 bg-brand-orange hover:bg-orange-600 text-white rounded-xl text-[13px] font-medium transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        Xem trước
                    </a>
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
                    <p id="viewMoTa" onclick="openEditor('sec-info')" class="text-slate-200/90 text-[14px] max-w-2xl font-light leading-relaxed cursor-pointer hover:text-white">
                        {{ Str::limit($event->description, 150) }}
                    </p>
                </div>
            </section>

            <!-- Content Grid -->
            <div class="max-w-[1140px] mx-auto px-6 mt-10 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left Column -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Intro Card -->
                    <div class="uni-card p-6">
                        <h3 class="text-[18px] font-bold text-primary mb-3 font-heading flex items-center gap-2">
                            <span class="w-1 h-5 bg-primary rounded-full"></span>Giới thiệu sự kiện
                        </h3>
                        <p class="text-slate-600 text-[14px] leading-relaxed">
                            {{ $event->description }}
                        </p>
                    </div>

                    <!-- Media Gallery -->
                    <div class="uni-card p-6">
                        <div class="flex items-center justify-between mb-5 border-b border-slate-100 pb-3">
                            <h3 class="text-[18px] font-bold text-primary font-heading flex items-center gap-2">
                                <span class="w-1 h-5 bg-primary rounded-full"></span>Bộ sưu tập khoảnh khắc
                            </h3>
                            <span class="text-[11px] text-slate-400">Nhấn để chọn Media</span>
                        </div>

                        <div class="space-y-6" id="mediaSlots">
                            @for($i = 1; $i <= 4; $i++)
                            <div class="flex flex-col gap-3 bg-slate-50/50 p-4 rounded-xl border border-slate-100">
                                <div onclick="openEditor('sec-media')" class="media-slot w-full h-24 bg-white hover:bg-slate-100 border border-dashed border-slate-300 hover:border-brand-orange rounded-xl flex items-center justify-center gap-2 cursor-pointer text-slate-500 hover:text-brand-orange transition-all" data-slot="{{ $i }}">
                                    <span class="material-symbols-outlined text-[22px]">add</span>
                                    <span class="text-[13px] font-medium">Thêm hình ảnh số {{ $i }}</span>
                                </div>
                                <input type="text" placeholder="Nhập ghi chú mô tả nội dung cho ảnh {{ $i }}..." class="w-full text-[13px] px-3 py-2 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all"/>
                            </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Speaker Card -->
                    <div onclick="openEditor('sec-speaker')" class="bg-gradient-to-r from-slate-900 to-slate-800 text-white p-5 rounded-2xl flex gap-5 items-center cursor-pointer hover:shadow-lg transition-all border border-slate-800">
                        <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-white/10 shadow-inner">
                            <img id="viewAnhDienGia" class="w-full h-full object-cover" src="{{ $event->speakers->first()?->photo_url ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}"/>
                        </div>
                        <div>
                            <span class="text-brand-orange text-[10px] font-bold uppercase tracking-widest block mb-0.5">Keynote Speaker</span>
                            <h3 id="viewTenDienGia" class="text-[16px] font-bold font-heading">
                                {{ $event->speakers->first()?->name ?? 'Chuyên gia Creative Director' }}
                            </h3>
                            <p class="text-[12px] text-slate-400 font-light">Nhấn để cấu hình nhân sự đại diện chương trình</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-4 space-y-6">
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
            
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 mb-6 max-h-[150px] overflow-y-auto space-y-1" id="duplicateFilesList">
                <!-- List of duplicated files injected here -->
            </div>

            <div class="flex flex-col gap-2 sm:flex-row sm:justify-end">
                <button onclick="cancelUpload()" class="px-4 py-2 text-[13px] font-semibold text-slate-500 hover:bg-slate-100 rounded-xl transition-all">Dừng tải file</button>
                <button onclick="uploadNewOnly()" class="px-4 py-2 text-[13px] font-semibold bg-primary hover:bg-slate-800 text-white rounded-xl transition-all shadow-sm">Tải mỗi file mới</button>
                <button onclick="uploadAll()" class="px-4 py-2 text-[13px] font-semibold bg-brand-orange hover:bg-orange-600 text-white rounded-xl transition-all shadow-sm">Tải toàn bộ</button>
            </div>
        </div>
    </div>

    <script>
        // Open control drawer
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

        // Close control drawer
        function closeEditor() {
            document.body.classList.remove('drawer-open');
        }

        // File upload handler & Duplicate checking
        let uploadedImageBase64 = '';
        let pendingFiles = [];
        let newFiles = [];
        let duplicatedFiles = [];
        
        // Mock existing media filenames from database (in reality, you'd check content hashes on server)
        const existingMediaFilenames = [
            @foreach($event->media as $media)
                "{{ basename($media->url) }}",
            @endforeach
        ];

        function handleFileSelect(input) {
            if (!input.files || input.files.length === 0) return;
            
            pendingFiles = Array.from(input.files);
            newFiles = [];
            duplicatedFiles = [];

            pendingFiles.forEach(file => {
                // Simple duplicate check by filename
                if (existingMediaFilenames.includes(file.name)) {
                    duplicatedFiles.push(file);
                } else {
                    newFiles.push(file);
                }
            });

            if (duplicatedFiles.length > 0) {
                // Show modal
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
            document.getElementById('inHeroBg').value = ''; // Reset input
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
            processUploads(pendingFiles);
        }

        function processUploads(filesToUpload) {
            if (filesToUpload.length === 0) return;
            
            // Set the first image as Hero Background
            const reader = new FileReader();
            reader.onload = function(e) {
                uploadedImageBase64 = e.target.result;
                syncData();
            };
            reader.readAsDataURL(filesToUpload[0]);

            // Add all files to the media library grid visually
            const library = document.getElementById('mediaLibrary');
            filesToUpload.forEach(f => {
                const tempReader = new FileReader();
                tempReader.onload = function(event) {
                    const url = event.target.result;
                    const html = `
                        <div class="media-select-item relative aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-brand-orange cursor-pointer transition-all animate-fade-in" onclick="selectMedia(this, '${url}')">
                            <img src="${url}" class="w-full h-full object-cover" alt="">
                            <div class="absolute inset-0 bg-black/0 hover:bg-black/20 transition-all flex items-center justify-center">
                                <span class="material-symbols-outlined text-white opacity-0 hover:opacity-100 text-[20px]">check_circle</span>
                            </div>
                        </div>
                    `;
                    library.insertAdjacentHTML('afterbegin', html);
                    existingMediaFilenames.push(f.name); // Add to existing so next upload catches it
                };
                tempReader.readAsDataURL(f);
            });
            
            // Note: In a real environment, you would use FormData and fetch() to actually upload these to the server here.
        }

        // Media library selection
        let selectedMediaUrl = '';
        let activeSlot = null;
        function selectMedia(el, url) {
            // Remove previous selection
            document.querySelectorAll('.media-select-item').forEach(item => {
                item.classList.remove('border-brand-orange');
                item.classList.add('border-transparent');
            });
            // Highlight selected
            el.classList.remove('border-transparent');
            el.classList.add('border-brand-orange');
            selectedMediaUrl = url;

            // If there's an active slot, fill it
            if (activeSlot) {
                activeSlot.innerHTML = `<img src="${url}" class="w-full h-full object-cover rounded-xl"/>`;
                activeSlot.classList.remove('border-dashed');
                activeSlot = null;
            }
        }

        // Track which media slot was clicked
        document.querySelectorAll('.media-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                activeSlot = this;
            });
        });

        // Date formatter
        function formatDisplayDate(dateString) {
            if (!dateString) return 'Chưa chọn';
            const parts = dateString.split('-');
            if (parts.length === 3) return `${parts[2]}/${parts[1]}/${parts[0]}`;
            return dateString;
        }

        // Real-time sync
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
            document.getElementById('viewTenDienGia').innerText = document.getElementById('inTenDienGia').value;

            if (uploadedImageBase64) {
                document.getElementById('viewHeroBg').style.backgroundImage = `url('${uploadedImageBase64}')`;
            }
        }

        window.addEventListener('DOMContentLoaded', () => { syncData(); });
    </script>
</body>
</html>
