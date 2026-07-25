<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>UniEvents | Chọn mẫu thiết kế — <?php echo e($event->title); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body { background-color: #f8fafc; overflow: hidden; margin: 0; padding-top: 64px; }
        
        .tp-layout { display: flex; height: calc(100vh - 64px); }
        
        /* Sidebar */
        .tp-sidebar { width: 240px; min-width: 240px; background: white; border-right: 1px solid #e2e8f0; display: flex; flex-direction: column; }
        .tp-sidebar-header { padding: 20px 20px 10px; font-weight: 700; color: #0f172a; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; }
        .tp-sidebar-nav { flex: 1; overflow-y: auto; padding: 10px; }
        .tp-cat-btn { width: 100%; display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 8px; text-align: left; font-size: 13px; font-weight: 500; color: #475569; transition: all 0.2s; margin-bottom: 4px; border: 1px solid transparent; }
        .tp-cat-btn:hover { background: #f1f5f9; color: #0f172a; }
        .tp-cat-btn.active { background: #fff7ed; color: #ea580c; border-color: #fed7aa; }
        
        /* Main Grid */
        .tp-main { flex: 1; display: flex; flex-direction: column; background: #f8fafc; min-width: 0; }
        .tp-main-header { display: flex; align-items: center; justify-content: space-between; padding: 20px 32px; border-bottom: 1px solid #e2e8f0; background: white; }
        .tp-grid-scroll { flex: 1; overflow-y: auto; padding: 32px; }
        .tp-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; transition: all 0.3s; }
        .tp-grid.cols-3 { grid-template-columns: repeat(3, 1fr); }
        .tp-grid.cols-1 { grid-template-columns: 1fr; max-width: 800px; margin: 0 auto; }
        
        /* Template Card */
        .tp-card { background: white; border-radius: 12px; overflow: hidden; border: 2px solid transparent; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05); transition: all 0.2s; position: relative; }
        .tp-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-color: #e2e8f0; }
        .tp-card.active { border-color: #f97316; box-shadow: 0 0 0 4px rgba(249,115,22,0.15); }
        .tp-card-thumb { width: 100%; aspect-ratio: 16/10; object-fit: cover; border-bottom: 1px solid #e2e8f0; background: #e2e8f0; }
        .tp-card-body { padding: 16px; }
        .tp-card-title { font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
        .tp-card-desc { font-size: 13px; color: #64748b; margin-bottom: 16px; }
        .tp-card-actions { display: flex; gap: 8px; }
        .tp-btn-primary { flex: 1; padding: 8px 0; background: #f97316; color: white; border-radius: 8px; font-size: 13px; font-weight: 600; text-align: center; transition: all 0.2s; border: none; cursor: pointer; }
        .tp-btn-primary:hover { background: #ea580c; }
        .tp-btn-secondary { flex: 1; padding: 8px 0; background: #f1f5f9; color: #475569; border-radius: 8px; font-size: 13px; font-weight: 600; text-align: center; transition: all 0.2s; border: none; cursor: pointer; }
        .tp-btn-secondary:hover { background: #e2e8f0; color: #0f172a; }
        
        /* Preview Panel */
        .tp-preview-panel { width: 420px; background: white; border-left: 1px solid #e2e8f0; display: flex; flex-direction: column; position: relative; transition: width 0.1s; }
        .tp-resizer { position: absolute; left: -3px; top: 0; bottom: 0; width: 6px; cursor: col-resize; background: transparent; z-index: 10; }
        .tp-resizer:hover { background: rgba(249,115,22,0.5); }
        .tp-preview-header { padding: 16px 20px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: white; }
        .tp-preview-content { flex: 1; background: #cbd5e1; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 20px; }
        .tp-iframe-wrap { width: 100%; height: 100%; max-width: 1200px; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); transition: all 0.3s ease; }
        .tp-iframe-wrap.mobile { max-width: 375px; }
        .tp-iframe-wrap.tablet { max-width: 768px; }
        iframe.tp-iframe { width: 100%; height: 100%; border: none; pointer-events: none; } /* Disable pointer events in preview to avoid scrolling hijacking */
        
        /* Modal Full Preview */
        #fullPreviewModal { display: none; position: fixed; inset: 0; z-index: 100; background: rgba(15,23,42,0.95); flex-direction: column; }
        #fullPreviewModal.show { display: flex; }
        .fp-header { height: 60px; padding: 0 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .fp-content { flex: 1; padding: 24px; display: flex; justify-content: center; }
        .fp-iframe-wrap { width: 100%; max-width: 1280px; height: 100%; background: white; border-radius: 12px; overflow: hidden; }
        .fp-iframe { width: 100%; height: 100%; border: none; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body class="font-sans antialiased text-slate-800">

    <!-- Fixed Header -->
    <header class="fixed top-0 left-0 w-full h-[64px] z-40 flex items-center justify-between px-6 bg-white border-b border-slate-200 shadow-sm">
        <div class="flex items-center gap-2 w-[240px]">
            <a href="<?php echo e(route('admin.events.index')); ?>" class="flex items-center gap-2">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-indigo-500 text-white shadow-md">
                    <i data-lucide="graduation-cap" class="h-5 w-5"></i>
                </div>
                <div class="flex flex-col min-w-0 text-left">
                    <span class="text-[15px] font-bold leading-tight truncate tracking-tight text-slate-900">UniEvents</span>
                    <span class="text-[11px] text-muted-foreground leading-tight tracking-wider">Trang quản trị</span>
                </div>
            </a>
        </div>
        
        <!-- Progress Indicator -->
        <div class="flex items-center gap-3">
            <div class="hidden md:flex items-center gap-2">
                <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="text-[12px] text-slate-400 hover:text-primary transition-colors">① Thông tin</a>
                <span class="text-slate-300">→</span>
                <span class="text-[12px] text-primary font-semibold">② Chọn mẫu</span>
                <span class="text-slate-300">→</span>
                <span class="text-[12px] text-slate-400">③ Thiết kế</span>
                <span class="text-slate-300">→</span>
                <span class="text-[12px] text-slate-400">④ Xem trước</span>
            </div>
        </div>
        
        <div class="flex items-center justify-end w-[240px]">
            <a href="<?php echo e(route('admin.events.design', $event)); ?>" class="flex items-center gap-1 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-[13px] font-medium transition-all">
                Bỏ qua
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            </a>
        </div>
    </header>

    <div class="tp-layout">
        <!-- Sidebar: Categories -->
        <aside class="tp-sidebar">
            <div class="tp-sidebar-header">Danh mục gợi ý</div>
            <div class="tp-sidebar-nav">
                <button class="tp-cat-btn active">
                    <span class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">grid_view</span> Tất cả mẫu</span>
                    <span class="text-[11px] bg-white border border-orange-200 px-1.5 rounded-full text-orange-600">6</span>
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <button class="tp-cat-btn">
                    <span class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">folder</span> <?php echo e($cat->name); ?></span>
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </aside>

        <!-- Main Content: Template Grid -->
        <main class="tp-main">
            <div class="tp-main-header">
                <div>
                    <h2 class="text-[18px] font-bold text-slate-800">Thư viện mẫu</h2>
                    <p class="text-[13px] text-slate-500">Chọn một mẫu thiết kế phù hợp cho sự kiện của bạn.</p>
                </div>
                <div class="flex items-center gap-2 bg-slate-100 p-1 rounded-lg border border-slate-200">
                    <button onclick="setGridLayout(1)" class="w-8 h-8 flex items-center justify-center rounded text-slate-500 hover:bg-white hover:shadow-sm transition-all"><span class="material-symbols-outlined text-[20px]">splitscreen</span></button>
                    <button onclick="setGridLayout(2)" class="w-8 h-8 flex items-center justify-center rounded bg-white shadow-sm text-brand-orange transition-all"><span class="material-symbols-outlined text-[20px]">grid_view</span></button>
                    <button onclick="setGridLayout(3)" class="w-8 h-8 flex items-center justify-center rounded text-slate-500 hover:bg-white hover:shadow-sm transition-all"><span class="material-symbols-outlined text-[20px]">apps</span></button>
                </div>
            </div>
            
            <div class="tp-grid-scroll">
                <div class="tp-grid cols-2" id="templateGrid">
                    
                    <!-- Template 1 -->
                    <div class="tp-card <?php echo e(($event->page_template == 1 || $event->page_template == null) ? 'active' : ''); ?>" id="card-1" onclick="selectTemplate(1)" style="cursor: pointer;">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80" alt="Template 1" class="tp-card-thumb">
                        <div class="tp-card-body">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="tp-card-title">Mẫu 1: Tiêu chuẩn</h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->page_template == 1 || $event->page_template == null): ?>
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Đang dùng</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <p class="tp-card-desc">Thiết kế hiện đại, bố cục rõ ràng, phù hợp cho mọi loại sự kiện.</p>
                            <div class="tp-card-actions" onclick="event.stopPropagation()">
                                <form action="<?php echo e(route('admin.events.save_template', $event)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="page_template" value="1">
                                    <button type="submit" class="tp-btn-primary w-full">Chọn mẫu này</button>
                                </form>
                                <button onclick="previewTemplate(1)" class="tp-btn-secondary">Xem trước</button>
                            </div>
                        </div>
                    </div>

                    <!-- Template 2 -->
                    <div class="tp-card <?php echo e($event->page_template == 2 ? 'active' : ''); ?>" id="card-2" onclick="selectTemplate(2)" style="cursor: pointer;">
                        <img src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&w=800&q=80" alt="Template 2" class="tp-card-thumb">
                        <div class="tp-card-body">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="tp-card-title">Mẫu 2: Garden</h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->page_template == 2): ?>
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Đang dùng</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <p class="tp-card-desc">Phong cách thanh lịch, tông màu tự nhiên, lý tưởng cho sự kiện văn hóa.</p>
                            <div class="tp-card-actions" onclick="event.stopPropagation()">
                                <form action="<?php echo e(route('admin.events.save_template', $event)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="page_template" value="2">
                                    <button type="submit" class="tp-btn-primary w-full">Chọn mẫu này</button>
                                </form>
                                <button onclick="previewTemplate(2)" class="tp-btn-secondary">Xem trước</button>
                            </div>
                        </div>
                    </div>

                    <!-- Template 3 -->
                    <div class="tp-card <?php echo e($event->page_template == 3 ? 'active' : ''); ?>" id="card-3" onclick="selectTemplate(3)" style="cursor: pointer;">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80" alt="Template 3" class="tp-card-thumb">
                        <div class="tp-card-body">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="tp-card-title">Mẫu 3: Học thuật (Academic)</h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->page_template == 3): ?>
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Đang dùng</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <p class="tp-card-desc">Bố cục học thuật, nghiêm túc, rất thích hợp cho hội thảo nghiên cứu và báo cáo chuyên đề.</p>
                            <div class="tp-card-actions" onclick="event.stopPropagation()">
                                <form action="<?php echo e(route('admin.events.save_template', $event)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="page_template" value="3">
                                    <button type="submit" class="tp-btn-primary w-full">Chọn mẫu này</button>
                                </form>
                                <button onclick="previewTemplate(3)" class="tp-btn-secondary">Xem trước</button>
                            </div>
                        </div>
                    </div>

                    <!-- Template 4 -->
                    <div class="tp-card <?php echo e($event->page_template == 4 ? 'active' : ''); ?>" id="card-4" onclick="selectTemplate(4)" style="cursor: pointer;">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" alt="Template 4" class="tp-card-thumb">
                        <div class="tp-card-body">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="tp-card-title">Mẫu 4: Hội thảo (Workshop)</h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->page_template == 4): ?>
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Đang dùng</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <p class="tp-card-desc">Thiết kế năng động, bố cục tập trung vào thông tin diễn giả và sơ đồ thời gian biểu chi tiết.</p>
                            <div class="tp-card-actions" onclick="event.stopPropagation()">
                                <form action="<?php echo e(route('admin.events.save_template', $event)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="page_template" value="4">
                                    <button type="submit" class="tp-btn-primary w-full">Chọn mẫu này</button>
                                </form>
                                <button onclick="previewTemplate(4)" class="tp-btn-secondary">Xem trước</button>
                            </div>
                        </div>
                    </div>

                    <!-- Template 5 -->
                    <div class="tp-card <?php echo e($event->page_template == 5 ? 'active' : ''); ?>" id="card-5" onclick="selectTemplate(5)" style="cursor: pointer;">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80" alt="Template 5" class="tp-card-thumb">
                        <div class="tp-card-body">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="tp-card-title">Mẫu 5: Lãng mạn (Cinematic)</h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->page_template == 5): ?>
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Đang dùng</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <p class="tp-card-desc">Phong cách Cinematic lãng mạn, ảnh nền tràn viền (full-bleed), thích hợp cho sự kiện kỷ niệm, lễ chúc mừng.</p>
                            <div class="tp-card-actions" onclick="event.stopPropagation()">
                                <form action="<?php echo e(route('admin.events.save_template', $event)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="page_template" value="5">
                                    <button type="submit" class="tp-btn-primary w-full">Chọn mẫu này</button>
                                </form>
                                <button onclick="previewTemplate(5)" class="tp-btn-secondary">Xem trước</button>
                            </div>
                        </div>
                    </div>

                    <!-- Template 6 -->
                    <div class="tp-card <?php echo e($event->page_template == 6 ? 'active' : ''); ?>" id="card-6" onclick="selectTemplate(6)" style="cursor: pointer;">
                        <img src="https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&w=800&q=80" alt="Template 6" class="tp-card-thumb">
                        <div class="tp-card-body">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="tp-card-title">Mẫu 6: Tạp chí (Magazine)</h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->page_template == 6): ?>
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Đang dùng</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <p class="tp-card-desc">Phong cách tạp chí editorial, ảnh banner lớn ở ĐẦU TRANG — nội dung ảnh luôn bên TRÁI. Sang trọng, tinh tế.</p>
                            <div class="tp-card-actions" onclick="event.stopPropagation()">
                                <form action="<?php echo e(route('admin.events.save_template', $event)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="page_template" value="6">
                                    <button type="submit" class="tp-btn-primary w-full">Chọn mẫu này</button>
                                </form>
                                <button onclick="previewTemplate(6)" class="tp-btn-secondary">Xem trước</button>
                            </div>
                        </div>
                    </div>

                

                </div>
            </div>
        </main>

        <!-- Preview Panel -->
        <aside class="tp-preview-panel" id="previewPanel">
            <div class="tp-resizer" id="resizer"></div>
            <div class="tp-preview-header">
                <span class="font-bold text-[14px] flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">visibility</span> Xem thử mẫu</span>
                <div class="flex bg-slate-100 rounded-lg p-1">
                    <button onclick="setPreviewDevice('desktop')" class="w-7 h-7 rounded flex items-center justify-center bg-white shadow-sm text-primary transition-all"><span class="material-symbols-outlined text-[16px]">desktop_windows</span></button>
                    <button onclick="setPreviewDevice('tablet')" class="w-7 h-7 rounded flex items-center justify-center text-slate-500 hover:bg-white hover:shadow-sm transition-all"><span class="material-symbols-outlined text-[16px]">tablet_mac</span></button>
                    <button onclick="setPreviewDevice('mobile')" class="w-7 h-7 rounded flex items-center justify-center text-slate-500 hover:bg-white hover:shadow-sm transition-all"><span class="material-symbols-outlined text-[16px]">smartphone</span></button>
                </div>
            </div>
            <div class="tp-preview-content">
                <div class="tp-iframe-wrap desktop" id="previewWrapper" style="position: relative;">
                    <div id="iframeLoader" style="position: absolute; inset: 0; background: rgba(255,255,255,0.7); display: none; align-items: center; justify-content: center; z-index: 10;">
                        <span class="material-symbols-outlined" style="animation: spin 1s linear infinite; font-size: 32px; color: #94a3b8;">sync</span>
                    </div>
                    <iframe id="miniPreviewFrame" onload="document.getElementById('iframeLoader').style.display='none'" src="<?php echo e(route('admin.events.template_preview', $event->page_template ?? 1)); ?>" class="tp-iframe"></iframe>
                </div>
            </div>
            <div class="p-4 border-t border-slate-200 bg-white">
                <form action="<?php echo e(route('admin.events.save_template', $event)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="page_template" id="formCurrentTemplateId" value="<?php echo e($event->page_template ?? 1); ?>">
                    <button type="submit" class="w-full py-2.5 bg-primary hover:bg-slate-800 text-white font-semibold rounded-xl text-[13px] shadow transition-all flex items-center justify-center gap-2">
                        Dùng mẫu này <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </button>
                </form>
            </div>
        </aside>
    </div>

    <!-- Full Preview Modal -->
    <div id="fullPreviewModal">
        <div class="fp-header">
            <div class="flex items-center gap-3 text-white">
                <h3 class="font-bold text-[16px]">Xem toàn màn hình</h3>
                <span class="bg-white/20 px-2 py-0.5 rounded text-[12px]" id="fpTemplateName">Mẫu 1: Tiêu chuẩn</span>
            </div>
            <div class="flex items-center gap-4">
                <form action="<?php echo e(route('admin.events.save_template', $event)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="page_template" id="fpTemplateId" value="1">
                    <button type="submit" class="px-4 py-2 bg-brand-orange hover:bg-orange-600 text-white font-semibold rounded-lg text-[13px] transition-all">
                        Chọn mẫu này
                    </button>
                </form>
                <button onclick="closeFullPreview()" class="w-10 h-10 flex items-center justify-center text-slate-300 hover:text-white bg-white/10 hover:bg-white/20 rounded-full transition-all">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>
        <div class="fp-content">
            <div class="fp-iframe-wrap">
                <iframe id="fullPreviewFrame" class="fp-iframe" src=""></iframe>
            </div>
        </div>
    </div>

    <script>
        // Grid Layout Toggle
        function setGridLayout(cols) {
            const grid = document.getElementById('templateGrid');
            grid.className = 'tp-grid cols-' + cols;
            
            const buttons = event.currentTarget.parentElement.children;
            for(let btn of buttons) {
                btn.classList.remove('bg-white', 'shadow-sm', 'text-brand-orange');
                btn.classList.add('text-slate-500');
            }
            event.currentTarget.classList.add('bg-white', 'shadow-sm', 'text-brand-orange');
            event.currentTarget.classList.remove('text-slate-500');
        }

        // Resizable Panel Logic
        const resizer = document.getElementById('resizer');
        const panel = document.getElementById('previewPanel');
        let isResizing = false;

        resizer.addEventListener('mousedown', function(e) {
            isResizing = true;
            document.body.style.cursor = 'col-resize';
            // Disable iframe pointer events during resize to prevent lagging
            document.getElementById('miniPreviewFrame').style.pointerEvents = 'none';
        });

        window.addEventListener('mousemove', function(e) {
            if (!isResizing) return;
            const newWidth = document.body.clientWidth - e.clientX;
            // Limits: min 300px, max 800px
            if (newWidth > 300 && newWidth < 800) {
                panel.style.width = newWidth + 'px';
            }
        });

        window.addEventListener('mouseup', function(e) {
            if (isResizing) {
                isResizing = false;
                document.body.style.cursor = 'default';
                // Restore iframe pointer events
                document.getElementById('miniPreviewFrame').style.pointerEvents = 'auto';
            }
        });

        // Device Preview Toggle
        function setPreviewDevice(device) {
            const wrapper = document.getElementById('previewWrapper');
            wrapper.className = 'tp-iframe-wrap ' + device;
            
            const buttons = event.currentTarget.parentElement.children;
            for(let btn of buttons) {
                btn.classList.remove('bg-white', 'shadow-sm', 'text-primary');
                btn.classList.add('text-slate-500');
            }
            event.currentTarget.classList.add('bg-white', 'shadow-sm', 'text-primary');
            event.currentTarget.classList.remove('text-slate-500');
        }

        // Update mini preview panel
        function selectTemplate(id) {
            document.querySelectorAll('.tp-card').forEach(card => card.classList.remove('active'));
            document.getElementById('card-' + id).classList.add('active');
            document.getElementById('iframeLoader').style.display = 'flex';
            document.getElementById('miniPreviewFrame').src = "<?php echo e(url('/admin/template-preview')); ?>/" + id;
            document.getElementById('formCurrentTemplateId').value = id;
        }

        // Preview Selection Update
        function previewTemplate(id) {
            // Update mini preview first
            selectTemplate(id);
            
            // Show full preview
            const modal = document.getElementById('fullPreviewModal');
            document.getElementById('fullPreviewFrame').src = "<?php echo e(url('/admin/template-preview')); ?>/" + id;
            document.getElementById('fpTemplateId').value = id;
            const names = {
                1: 'Mẫu 1: Tiêu chuẩn',
                2: 'Mẫu 2: Garden',
                3: 'Mẫu 3: Học thuật (Academic)',
                4: 'Mẫu 4: Hội thảo (Workshop)',
                5: 'Mẫu 5: Lãng mạn (Cinematic)',
                6: 'Mẫu 6: Tạp chí (Magazine)',

            };
            let templateName = names[id] || ('Mẫu ' + id);
            document.getElementById('fpTemplateName').innerText = templateName;
            
            modal.classList.add('show');
        }

        function closeFullPreview() {
            document.getElementById('fullPreviewModal').classList.remove('show');
            document.getElementById('fullPreviewFrame').src = ""; // Clear memory
        }
        
        // Prevent default form submit on secondary buttons
        document.querySelectorAll('.tp-btn-secondary').forEach(btn => {
            btn.addEventListener('click', e => e.preventDefault());
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/admin/events/template-picker.blade.php ENDPATH**/ ?>