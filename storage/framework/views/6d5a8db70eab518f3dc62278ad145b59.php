<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>UniEvents | Studio — <?php echo e($event->title); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&family=Be+Vietnam+Pro:wght@400;600;700&family=Charm:wght@400;700&family=Montserrat:wght@400;600;700&family=Pacifico&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <style>
        .app-layout {
            display: grid;
            grid-template-columns: 480px 1fr;
            min-height: 100vh;
        }
        @media (max-width: 1024px) {
            .app-layout {
                grid-template-columns: 320px 1fr;
            }
            .control-drawer {
                width: 320px !important;
                min-width: 320px !important;
            }
        }

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
    <div class="flex w-full" style="height: calc(100vh - 64px);">
        <!-- ─── Control Drawer (Left Panel) ─── -->
        <aside style="width: 450px; min-width: 450px;" class="shrink-0 h-full overflow-y-auto bg-white border-r border-slate-200 shadow-sm p-6 z-30 pb-20">
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
                            <input type="text" id="inTieuDe" value="<?php echo e($event->title); ?>" oninput="syncData()" class="uni-input"/>
                        </div>

                        <div>
                            <label class="uni-label">Mô tả tóm tắt</label>
                            <textarea id="inMoTa" rows="2" oninput="syncData()" class="uni-input"><?php echo e($event->description); ?></textarea>
                        </div>
                    </div>
                </div>

                
                <!-- 2. Sub Banner -->
                <div id="sec-subbanner" class="drawer-section space-y-3 pt-1 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">2. Banner phụ (Mẫu 2)</h4>
                    <div id="subBannerSection" class="uni-card p-6" style="<?php echo e(($event->page_template ?? 1) == 2 ? '' : 'display: none;'); ?>">
                        <div class="flex items-center justify-between mb-5 border-b border-slate-100 pb-3">
                            <h3 class="text-[18px] font-bold text-brand-orange font-heading flex items-center gap-2">
                                <span class="material-symbols-outlined">panorama</span> Banner ngang (Dành riêng Mẫu 2)
                            </h3>
                            <span class="text-[11px] text-slate-400">Ảnh trải dài hiển thị dưới giới thiệu sự kiện</span>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-3 w-full">
                            <div class="w-full relative h-[200px] bg-slate-50 border-2 border-dashed border-slate-300 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:border-brand-orange hover:bg-orange-50 transition-all group overflow-hidden" onclick="document.getElementById('subBannerFileInput').click()">
                                <img id="viewSubBanner" src="<?php echo e($event->subBannerImage ? \App\Helpers\FileHelper::url($event->subBannerImage->url) : ''); ?>" class="absolute inset-0 w-full h-full object-cover <?php echo e($event->subBannerImage ? '' : 'hidden'); ?>">
                                <div class="relative z-10 flex flex-col items-center text-slate-500 group-hover:text-brand-orange <?php echo e($event->subBannerImage ? 'opacity-0 hover:opacity-100 bg-white/90 p-4 rounded-xl shadow-lg' : ''); ?> transition-all">
                                    <span class="material-symbols-outlined text-[32px]">add_photo_alternate</span>
                                    <span class="text-[13px] font-medium mt-1" id="subBannerUploadText"><?php echo e($event->subBannerImage ? 'Thay đổi ảnh banner' : 'Tải ảnh banner lên'); ?></span>
                                </div>
                            </div>
                            <input type="text" id="inSubBannerUrl" readonly class="hidden" value="<?php echo e($event->subBannerImage ? \App\Helpers\FileHelper::url($event->subBannerImage->url) : ''); ?>" />
                            <input type="hidden" id="inSubBannerPath" value="<?php echo e($event->subBannerImage ? $event->subBannerImage->url : ''); ?>" />
                            <input type="file" id="subBannerFileInput" accept="image/*" class="hidden" onchange="uploadSubBanner(this)" />
                            <div class="text-[13px] font-bold text-brand-orange hidden flex items-center gap-1.5" id="subBannerUploading">
                                <span class="material-symbols-outlined animate-spin align-middle text-[18px]">sync</span> Đang tải lên...
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- 3. Speakers -->
                <div id="sec-speakers" class="drawer-section space-y-3 pt-1 transition-all rounded-lg p-2 -m-2" x-data="speakerManager()">
                    <h4 class="uni-section-title">3. Diễn giả</h4>
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
                </div>

                <!-- 4. Schedule -->
                <div id="sec-schedule" class="drawer-section space-y-3 pt-1 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">4. Lịch hoạt động</h4>
                    <!-- Schedule Card -->
                    <?php
                        $scheduleJson = $event->scheduleItems->map(function($s) {
                            return [
                                'id' => uniqid(),
                                'start_time' => $s->start_time ? $s->start_time->format('H:i') : '',
                                'end_time' => $s->end_time ? $s->end_time->format('H:i') : '',
                                'title' => $s->title
                            ];
                        })->toJson();
                    ?>
                    <div class="uni-card p-5 transition-all" x-data="scheduleManager(<?php echo e($scheduleJson); ?>)">
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
                </div>

                <!-- 5. Media Slots -->
                <div id="sec-media-slots" class="drawer-section space-y-3 pt-1 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">5. Nội dung / Ảnh chi tiết</h4>
                    <!-- Media Gallery -->
                    <div class="uni-card p-6">
                        <div class="flex items-center justify-between mb-5 border-b border-slate-100 pb-3">
                            <h3 class="text-[18px] font-bold text-primary font-heading flex items-center gap-2">
                                <span class="w-1 h-5 bg-primary rounded-full"></span>Nội dung chính
                            </h3>
                            <span class="text-[11px] text-slate-400">Nhập nội dung sự kiện và chọn ảnh minh hoạ</span>
                        </div>

                        <div id="t5WarningMsg" class="hidden mb-4 bg-blue-50 text-blue-700 p-3 rounded-lg text-[13px] border border-blue-200">
                            <span class="material-symbols-outlined align-middle mr-1 text-[18px]">info</span>
                            <b>Mẫu 5:</b> Chỉ ô nội dung đầu tiên được dùng làm "Nội dung thiệp mời". Các ô bên dưới chỉ dùng ảnh (nội dung chữ sẽ bị ẩn để phù hợp thiệp mời).
                        </div>

                        <div class="space-y-6" id="mediaSlots">
                            <?php $galleryMedia = $event->galleryImages->take(4)->values(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 4; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php 
                                $media = $galleryMedia->get($i - 1); 
                                $hasMedia = $media ? true : false;
                                
                                $templateId = $event->page_template ?? 1;
                                $textOrder = '';
                                $mediaOrder = '';
                                
                                if ($templateId == 1) {
                                    // Zic-Zac
                                    if ($i % 2 != 0) {
                                        // Odd: Image Left (order-1), Text Right (order-2)
                                        $textOrder = '';
                                        $mediaOrder = '';
                                    } else {
                                        // Even: Text Left (order-1), Image Right (order-2)
                                        $textOrder = '';
                                        $mediaOrder = '';
                                    }
                                } else {
                                    // Template 2 (and others): Text Left, Image Right
                                    $textOrder = '';
                                    $mediaOrder = '';
                                }
                            ?>
                            <div class="grid grid-cols-1 grid-cols-1 gap-6 bg-slate-50/50 p-6 rounded-xl border border-slate-100 items-start media-slot-wrapper" data-slot-wrap="<?php echo e($i); ?>">
                                
                                <div class="flex flex-col h-full w-full <?php echo e($textOrder); ?> media-text-col">
                                    <textarea id="content<?php echo e($i); ?>" rows="8" placeholder="<?php echo e($i == 1 ? 'Nhập nội dung sự kiện cho đoạn này...' : 'Nhập nội dung sự kiện cho đoạn này...'); ?>"
                                           class="w-full text-[14px] px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all resize-y h-full" style="min-height: 250px;"><?php echo e($media ? $media->content : ''); ?></textarea>
                                </div>
                                       
                                
                                <div class="flex flex-col gap-3 w-full <?php echo e($mediaOrder); ?> media-upload-col">
                                    
                                    <div class="relative">
                                        <div onclick="activateSlot(<?php echo e($i); ?>)"
                                             class="media-slot w-full <?php echo e($hasMedia ? 'h-auto' : 'h-32'); ?> bg-white hover:bg-slate-50 border-2 <?php echo e($hasMedia ? '' : 'border-dashed'); ?> border-slate-300 hover:border-brand-orange rounded-xl flex items-center justify-center gap-2 cursor-pointer text-slate-500 hover:text-brand-orange transition-all <?php echo e($hasMedia ? 'slot-filled' : ''); ?>"
                                             data-slot="<?php echo e($i); ?>" id="slot<?php echo e($i); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasMedia): ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($media->type === 'video'): ?>
                                                    <video src="<?php echo e(\App\Helpers\FileHelper::url($media->url)); ?>" data-path="<?php echo e($media->url); ?>" class="w-full h-auto rounded-xl" autoplay loop muted playsinline></video>
                                                <?php else: ?>
                                                    <img src="<?php echo e(\App\Helpers\FileHelper::url($media->url)); ?>" data-path="<?php echo e($media->url); ?>" class="w-full h-auto rounded-xl" alt=""/>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php else: ?>
                                                <span class="material-symbols-outlined text-[22px]">add_photo_alternate</span>
                                                <span class="text-[13px] font-medium">Thêm hình ảnh <?php echo e($i); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        
                                        <button onclick="removeSlot(<?php echo e($i); ?>)" id="removeBtn<?php echo e($i); ?>"
                                                class="<?php echo e($hasMedia ? 'flex' : 'hidden'); ?> absolute top-2 right-2 w-7 h-7 bg-white/90 hover:bg-red-500 hover:text-white text-slate-600 rounded-lg shadow items-center justify-center transition-all z-10"
                                                title="Gỡ ảnh">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </div>
                                    
                                    <input type="text" id="caption<?php echo e($i); ?>" placeholder="Nhập ghi chú / mô tả cho ảnh <?php echo e($i); ?>..."
                                           class="w-full text-[13px] px-3 py-2 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all"
                                           value="<?php echo e($media ? $media->caption : ''); ?>" />

                                    <input type="hidden" id="docFileUrl<?php echo e($i); ?>" value="<?php echo e($media ? $media->document_url : ''); ?>" />
                                    <input type="hidden" id="docFileName<?php echo e($i); ?>" value="<?php echo e($media ? $media->document_name : ''); ?>" />

                                    
                                    <div class="bg-white border border-slate-200 rounded-xl p-3.5 space-y-1">
                                        <label class="text-[12px] font-bold text-slate-600 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-slate-500">link</span> Liên kết ngoài (URL)
                                        </label>
                                        <input type="text" id="actionUrl<?php echo e($i); ?>" placeholder="Nhập link liên kết (VD: https://poly.edu.vn)..."
                                               class="w-full text-[13px] px-3 py-1.5 bg-slate-50/50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all"
                                               value="<?php echo e($media ? $media->action_url : ''); ?>" oninput="syncData()" />
                                    </div>

                                    
                                    <div class="mt-1 flex flex-wrap gap-2">
                                        <div id="urlPreviewWrap<?php echo e($i); ?>" class="flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg text-[12px] font-medium border border-blue-200/50 <?php echo e($media && $media->action_url ? '' : 'hidden'); ?>">
                                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                            <span class="truncate max-w-[150px]" id="urlPreviewLink<?php echo e($i); ?>"><?php echo e($media ? $media->action_url : ''); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <button onclick="addNewSlot()" class="mt-5 w-full py-2.5 border-2 border-dashed border-slate-300 hover:border-brand-orange text-slate-500 hover:text-brand-orange rounded-xl font-medium transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">add_circle</span>
                            Thêm khối nội dung / ảnh
                        </button>
                    </div>
                </div>

<!-- 3. Media Library (Tabbed) -->
                <div id="sec-media" class="drawer-section space-y-3 pt-2 border-slate-100 transition-all rounded-lg p-2 -m-2">
                    <h4 class="uni-section-title">Thư viện Media</h4>

                    
                    <div id="activeSlotIndicator" class="hidden items-center gap-2 px-3 py-2 bg-orange-50 border border-orange-200 rounded-xl">
                        <span class="material-symbols-outlined text-brand-orange text-[16px]">touch_app</span>
                        <p class="text-[12px] text-brand-orange font-medium" id="activeSlotLabel">Đang chọn ảnh cho Ô 1</p>
                        <button onclick="clearActiveSlot()" class="ml-auto text-slate-400 hover:text-slate-600">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </button>
                    </div>

                    
                    <div class="flex gap-1.5 bg-slate-100 p-1 rounded-xl">
                        <button onclick="switchTab('library')" id="tabLibrary" class="tab-btn active flex-1 py-1.5 text-[12px] font-semibold rounded-lg transition-all">
                            Kho Media (<?php echo e(count($mediaLibrary)); ?>)
                        </button>
                        <button onclick="switchTab('upload')" id="tabUpload" class="tab-btn flex-1 py-1.5 text-[12px] font-semibold rounded-lg transition-all text-slate-500 hover:text-primary">
                            Tải file mới
                        </button>
                    </div>

                    
                    <div id="tabPanelLibrary" class="flex flex-col gap-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($mediaLibrary) > 0): ?>
                        <div class="flex justify-between items-center px-1 mt-1">
                            <span class="text-[12px] font-medium text-slate-500">Đã tải lên <?php echo e(count($mediaLibrary)); ?> file</span>
                            <select id="mediaFilter" onchange="filterMedia(this.value)" class="uni-input py-1 text-[11px] w-auto bg-white border-slate-200">
                                <option value="all">Tất cả định dạng</option>
                                <option value="image">Chỉ Hình ảnh</option>
                                <option value="video">Chỉ Video</option>
                            </select>
                        </div>
                        <div id="mediaLibraryGrid">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $mediaLibrary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="lib-item"
                                 onclick="applyLibraryItem('<?php echo e($media->full_url); ?>', '<?php echo e($media->type); ?>', '<?php echo e($media->url); ?>', this)"
                                 title="<?php echo e($media->caption ?? basename($media->url)); ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($media->type === 'video'): ?>
                                    <video src="<?php echo e(\App\Helpers\FileHelper::url($media->url)); ?>"></video>
                                    <div class="lib-overlay" style="display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.3);">
                                        <span class="material-symbols-outlined" style="color:white;font-size:24px;">play_circle</span>
                                    </div>
                                <?php else: ?>
                                    <img src="<?php echo e(\App\Helpers\FileHelper::url($media->url)); ?>" alt="">
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="lib-overlay" style="background:rgba(0,0,0,0);transition:background 0.15s;"></div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-6 text-slate-400">
                            <span class="material-symbols-outlined text-[36px] block mb-1 text-slate-200">photo_library</span>
                            <p class="text-[12px]">Kho ảnh trống. Hãy tải ảnh mới lên.</p>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
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
        <main class="flex-1 h-full bg-slate-100 flex flex-col relative">
            <!-- Fixed Header -->
            <header class="fixed top-0 left-0 w-full h-[64px] z-40 flex items-center justify-between px-8 bg-white border-b border-slate-200/80 shadow-sm transition-all duration-500">
                <div class="flex items-center gap-2 w-[240px]">
                    <a href="<?php echo e(route('admin.events.index')); ?>" class="flex items-center gap-2">
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
                    <input type="hidden" id="inEventTemplate" value="<?php echo e($event->page_template ?? 1); ?>">
                    <a href="<?php echo e(route('admin.events.template', $event)); ?>" class="flex items-center gap-1.5 text-[12px] text-slate-500 hover:text-brand-orange font-medium bg-slate-50 hover:bg-orange-50 px-3 py-1.5 rounded-lg transition-colors border border-slate-200 hover:border-orange-200">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                        Chọn mẫu khác
                    </a>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" onclick="saveDesignThen(() => { document.getElementById('previewIframe').src = '<?php echo e(route('admin.events.preview_iframe', $event)); ?>?t=' + new Date().getTime(); })" class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-[13px] font-medium transition-all shadow-sm border border-slate-200">
                        <span class="material-symbols-outlined text-[18px]">refresh</span>
                        Cập nhật xem trước
                    </button>
                    <button onclick="saveDesignThen(() => { window.location.href = '<?php echo e(route('admin.events.preview', $event)); ?>' })" class="flex items-center gap-2 px-4 py-2 bg-brand-orange hover:bg-orange-600 text-white rounded-xl text-[13px] font-medium transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        Hoàn tất
                    </button>
                </div>
            </header>

            <!-- iframe container -->
            <div class="flex-1 w-full h-full relative">
                <iframe id="previewIframe" src="<?php echo e(route('admin.events.preview_iframe', $event)); ?>?t=<?php echo e(time()); ?>" class="w-full h-full border-none absolute inset-0"></iframe>
            </div>
        </main>
    </div>
        
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

            const templateId = document.getElementById('inEventTemplate') ? document.getElementById('inEventTemplate').value : '1';
            let textOrder = 'lg:order-1';
            let mediaOrder = 'lg:order-2';
            
            if (templateId == '1') {
                if (newI % 2 !== 0) {
                    textOrder = 'lg:order-2';
                    mediaOrder = 'lg:order-1';
                }
            }

            const slotHtml = `
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 bg-slate-50/50 p-6 rounded-xl border border-slate-100 mt-6 items-start media-slot-wrapper" data-slot-wrap="${newI}">
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
                    <input type="text" id="caption${newI}" placeholder="Nhập ghi chú / mô tả cho ảnh ${newI}..."
                           class="w-full text-[13px] px-3 py-2 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all" />

                    <input type="hidden" id="docFileUrl${newI}" />
                    <input type="hidden" id="docFileName${newI}" />

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

﻿        const EVENT_ID = <?php echo e($event->id); ?>;
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const MEDIA_STORE_URL = '<?php echo e(route("admin.media.store")); ?>';
        // ΓöÇΓöÇ Slot Management ΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇ
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
            document.getElementById('activeSlotLabel').textContent = `─Éang chß╗ìn ß║únh cho ├ö sß╗æ ${slotNum}`;

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
                <span class="text-[13px] font-medium">Th├¬m h├¼nh ß║únh ${slotNum}</span>
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

        // ΓöÇΓöÇ Library pick ΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇ
        function applyLibraryItem(url, type = 'image', path = null, el = null) {
            if (!activeSlotId) {
                // Flash indicator to tell user to pick a slot
                const indicator = document.getElementById('activeSlotIndicator');
                indicator.classList.remove('hidden');
                indicator.classList.add('flex');
                document.getElementById('activeSlotLabel').textContent = 'ΓÜá H├úy nhß║Ñn v├áo mß╗Öt ├┤ ß║únh tr╞░ß╗¢c!';
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

        // ΓöÇΓöÇ File Upload (AJAX) ΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇ
        let pendingFiles = [];
        let newFiles = [];
        let duplicatedFiles = [];

        const existingMediaFilenames = [
            <?php $__currentLoopData = $mediaLibrary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                "<?php echo e(basename($media->url)); ?>",
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            document.getElementById('uploadProgressText').textContent = `─Éang tß║úi l├¬n ${filesToUpload.length} file...`;
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
                    let errMsg = 'Lß╗ùi m├íy chß╗º hoß║╖c ─æß╗ïnh dß║íng file kh├┤ng ─æ╞░ß╗úc hß╗ù trß╗ú.';
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
                        row.innerHTML = `<span class="material-symbols-outlined text-[14px]">check_circle</span><span class="truncate">─É├ú th├¬m: ${file.caption}</span>`;
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
                row.innerHTML = `<span class="material-symbols-outlined text-[16px] shrink-0">error</span><span class="font-medium flex-1">${err.message || 'Lß╗ùi tß║úi l├¬n. Vui l├▓ng thß╗¡ lß║íi.'}</span>`;
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
                    throw new Error('M├íy chß╗º trß║ú vß╗ü phß║ún hß╗ôi kh├┤ng hß╗úp lß╗ç (kh├┤ng phß║úi JSON). C├│ thß╗â do file qu├í nß║╖ng hoß║╖c lß╗ùi server.');
                }

                if (!resp.ok) {
                    let errMsg = 'Lß╗ùi tß║úi ß║únh l├¬n.';
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
                alert(err.message || 'C├│ lß╗ùi xß║úy ra khi tß║úi ß║únh l├¬n.');
            } finally {
                uploadingText.classList.add('hidden');
                input.value = '';
            }
        }

        // ΓöÇΓöÇ Drag & Drop on drop zone ΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇ
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

        // ΓöÇΓöÇ Date formatter ΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇΓöÇ
        function formatDisplayDate(dateString) {
            if (!dateString) return 'Ch╞░a chß╗ìn';
            const parts = dateString.split('-');
            if (parts.length === 3) return `${parts[2]}/${parts[1]}/${parts[0]}`;
            return dateString;


    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
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

<?php
    $apData = $allSpeakers->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'bio' => Str::limit($s->bio, 30), 'photo' => $s->photo_url ? asset($s->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80', 'type' => $s->type ?? 'speaker'])->values()->toArray();
    $ssData = $event->speakers->where('pivot.role', 'speaker')->values()->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'photo' => $s->photo_url ? asset($s->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'])->toArray();
?>
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
                allPersons: <?php echo json_encode($apData, 15, 512) ?>,
                selectedSpeakers: <?php echo json_encode($ssData, 15, 512) ?>,
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

        window.syncData = function() {
            // Optional: called on input change, could be used for auto-save
        };

        async function saveDesignThen(callback) {
            // Collect data
            const payload = {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                title: document.getElementById('inTieuDe') ? document.getElementById('inTieuDe').value : '',
                description: document.getElementById('inMoTa') ? document.getElementById('inMoTa').value : '',
                sub_banner_path: document.getElementById('inSubBannerPath') ? document.getElementById('inSubBannerPath').value : '',
                event_template: document.getElementById('inEventTemplate') ? document.getElementById('inEventTemplate').value : '',
            };

            // Collect schedule
            const scheduleEl = document.getElementById('inLichHoatDongData');
            if (scheduleEl) {
                payload.schedule_data = scheduleEl.value;
            }

            // Collect speakers from Alpine
            const speakerManagerEl = document.querySelector('[x-data^="speakerManager"]');
            if (speakerManagerEl) {
                try {
                    const speakerData = Alpine.evaluate(speakerManagerEl, 'selectedSpeakers');
                    if (speakerData) {
                        payload.speaker_ids = speakerData.map(s => s.id);
                    }
                } catch(e) {}
            }

            // Collect media slots
            payload.media_slots = [];
            const slots = document.querySelectorAll('.media-slot-wrapper');
            slots.forEach(slotEl => {
                const i = slotEl.getAttribute('data-slot-wrap');
                if (!i) return;
                
                let content = '';
                if (window.tinymce && tinymce.get('content' + i)) {
                    content = tinymce.get('content' + i).getContent();
                } else {
                    const ta = document.getElementById('content' + i);
                    if (ta) content = ta.value;
                }
                
                let mediaPath = '';
                const mediaEl = document.getElementById('slot' + i)?.querySelector('[data-path]');
                if (mediaEl) {
                    mediaPath = mediaEl.getAttribute('data-path');
                }
                
                payload.media_slots.push({
                    content: content,
                    url: mediaPath,
                    caption: document.getElementById('caption' + i) ? document.getElementById('caption' + i).value : '',
                    action_url: document.getElementById('actionUrl' + i) ? document.getElementById('actionUrl' + i).value : '',
                    document_url: document.getElementById('docFileUrl' + i) ? document.getElementById('docFileUrl' + i).value : '',
                    document_name: document.getElementById('docFileName' + i) ? document.getElementById('docFileName' + i).value : '',
                });
            });

            // Prevent double click by disabling buttons temporarily
            const btns = document.querySelectorAll('button');
            btns.forEach(b => b.disabled = true);

            try {
                const response = await fetch("<?php echo e(route('admin.events.save_design', $event)); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                
                if (response.ok) {
                    if (callback) callback();
                } else {
                    alert('Có lỗi xảy ra khi lưu thiết kế.');
                }
            } catch (error) {
                console.error(error);
                alert('Có lỗi xảy ra khi kết nối đến máy chủ.');
            } finally {
                btns.forEach(b => b.disabled = false);
            }
        }

        function closeEditor() {
            window.location.href = "<?php echo e(route('admin.events.index')); ?>";
        }
    </script>
</body>
</html><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/admin/events/design.blade.php ENDPATH**/ ?>