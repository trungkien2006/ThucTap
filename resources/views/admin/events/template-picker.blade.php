<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chọn mẫu sự kiện — {{ $event->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap');

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg:        #F4F6FB;
            --surface:   #FFFFFF;
            --sidebar:   #FFFFFF;
            --ink:       #18181B;
            --ink-soft:  #52525B;
            --ink-muted: #A1A1AA;
            --accent:    #2563EB;
            --accent-lt: #EFF6FF;
            --accent-md: #DBEAFE;
            --border:    #E4E4E7;
            --border2:   #D4D4D8;
            --green:     #16A34A;
            --green-lt:  #DCFCE7;
            --orange:    #EA580C;
            --orange-lt: #FFEDD5;
            --purple:    #7C3AED;
            --purple-lt: #F5F3FF;
            --r:         10px;
            --r-lg:      16px;
            --shadow:    0 1px 4px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
            --shadow-lg: 0 10px 30px rgba(0,0,0,.08);
            --font-sans: 'Be Vietnam Pro', sans-serif;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg);
            color: var(--ink);
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* Sidebar Left styling */
        .admin-sidebar {
            width: 250px;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .sidebar-brand {
            height: 64px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border);
            font-weight: 800;
            font-size: 18px;
            color: var(--orange);
            letter-spacing: -0.02em;
        }
        .sidebar-menu {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: var(--r);
            color: var(--ink-soft);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .menu-link:hover {
            background: var(--bg);
            color: var(--ink);
        }
        .menu-link.active {
            background: var(--orange-lt);
            color: var(--orange);
            font-weight: 600;
        }

        /* Main Workspace Wrapper */
        .workspace {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Top bar style */
        .topbar {
            height: 64px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            flex-shrink: 0;
        }

        /* Wizard stepper */
        .stepper {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .step-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 500;
            color: var(--ink-muted);
            text-decoration: none;
        }
        .step-item.active {
            color: var(--orange);
            font-weight: 600;
        }
        .step-item.completed {
            color: var(--green);
        }
        .step-divider {
            color: var(--ink-muted);
            font-size: 12px;
        }

        /* Scrollable main panel */
        .panel-content {
            flex: 1;
            overflow-y: auto;
            padding: 32px 40px 120px;
        }

        /* Header block */
        .page-header {
            margin-bottom: 24px;
        }
        .page-header h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--ink);
            margin-bottom: 6px;
            letter-spacing: -0.015em;
        }
        .page-header p {
            font-size: 13.5px;
            color: var(--ink-soft);
        }

        /* Filter & Search Toolbar */
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-lg);
            padding: 12px 20px;
            box-shadow: var(--shadow);
            margin-bottom: 28px;
        }
        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 8px 14px;
            width: 320px;
            max-width: 100%;
        }
        .search-box span {
            color: var(--ink-soft);
            font-size: 18px;
        }
        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            width: 100%;
            color: var(--ink);
        }
        .search-box input::placeholder {
            color: var(--ink-muted);
        }
        .sort-select {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--ink-soft);
        }
        .sort-select select {
            border: 1px solid var(--border);
            background: var(--surface);
            border-radius: var(--r);
            padding: 6px 12px;
            font-size: 13px;
            outline: none;
            color: var(--ink);
            cursor: pointer;
        }

        /* Categories tabs */
        .cat-tabs {
            display: flex;
            gap: 6px;
            margin-bottom: 24px;
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .cat-btn {
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--ink-soft);
            padding: 8px 16px;
            border-radius: 99px;
            font-size: 12.5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .cat-btn:hover {
            border-color: var(--border2);
            color: var(--ink);
            background: var(--bg);
        }
        .cat-btn.active {
            background: var(--ink);
            color: var(--surface);
            border-color: var(--ink);
            font-weight: 600;
        }
        .cat-count {
            font-size: 10px;
            background: rgba(0,0,0,0.06);
            padding: 1px 6px;
            border-radius: 99px;
            color: var(--ink-soft);
        }
        .cat-btn.active .cat-count {
            background: rgba(255,255,255,0.2);
            color: var(--surface);
        }

        /* Templates Grid */
        .tmpl-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        /* Template card */
        .tmpl-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }
        .tmpl-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--border2);
        }
        .tmpl-card.selected {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px var(--orange-lt), var(--shadow-lg);
        }
        .tmpl-thumb-wrap {
            aspect-ratio: 16/10;
            position: relative;
            background: #e2e8f0;
            overflow: hidden;
        }
        .tmpl-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }
        .tmpl-card:hover .tmpl-thumb {
            transform: scale(1.03);
        }
        .tmpl-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(15,23,42,0.75);
            backdrop-filter: blur(4px);
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .tmpl-info {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .tmpl-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }
        .tmpl-name {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--ink);
        }
        .tmpl-desc {
            font-size: 12.5px;
            color: var(--ink-soft);
            line-height: 1.5;
            margin-bottom: 16px;
            flex: 1;
        }
        .tmpl-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }
        .btn-card-select {
            flex: 1;
            padding: 8px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--r);
            color: var(--ink);
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
            text-align: center;
        }
        .tmpl-card.selected .btn-card-select {
            background: var(--orange);
            color: white;
            border-color: var(--orange);
        }
        .btn-card-preview {
            padding: 8px 12px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            color: var(--ink-soft);
            font-size: 12.5px;
            cursor: pointer;
            transition: all 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-card-preview:hover {
            background: var(--bg);
            color: var(--ink);
        }

        /* Blank Option Card */
        .tmpl-card.blank-card {
            border: 2px dashed var(--border2);
            background: transparent;
            justify-content: center;
            align-items: center;
            padding: 32px 24px;
            text-align: center;
            box-shadow: none;
        }
        .tmpl-card.blank-card:hover {
            border-color: var(--orange);
            background: var(--surface);
        }
        .tmpl-card.blank-card.selected {
            border: 2px solid var(--orange);
            background: var(--surface);
            box-shadow: 0 0 0 3px var(--orange-lt);
        }
        .blank-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ink-soft);
            margin-bottom: 14px;
            box-shadow: var(--shadow);
            transition: all 0.2s;
        }
        .tmpl-card.blank-card:hover .blank-icon-wrap {
            color: var(--orange);
            border-color: var(--orange-lt);
            background: var(--orange-lt);
        }

        /* Sticky Footer selection bar */
        .sticky-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.04);
            z-index: 30;
        }
        .selection-preview {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .selection-thumb-mini {
            width: 54px;
            height: 38px;
            border-radius: 6px;
            object-fit: cover;
            background: #cbd5e1;
            border: 1px solid var(--border);
        }
        .selection-info-text {
            display: flex;
            flex-direction: column;
        }
        .selection-info-title {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--ink);
        }
        .selection-info-sub {
            font-size: 11px;
            color: var(--ink-soft);
        }
        .footer-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-back {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            border-radius: var(--r);
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--ink-soft);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover {
            background: var(--bg);
            color: var(--ink);
        }
        .btn-next {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 24px;
            border-radius: var(--r);
            border: none;
            background: var(--orange);
            color: white;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.25);
        }
        .btn-next:hover {
            background: #d94e08;
            box-shadow: 0 4px 16px rgba(234, 88, 12, 0.35);
        }
        .btn-next:disabled {
            background: var(--border2);
            color: var(--ink-muted);
            box-shadow: none;
            cursor: not-allowed;
        }

        /* Full Preview Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(4px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }
        .modal-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-window {
            width: 90%;
            max-width: 1200px;
            height: 85vh;
            background: var(--surface);
            border-radius: var(--r-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-lg);
            transform: scale(0.95);
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .modal-overlay.show .modal-window {
            transform: scale(1);
        }
        .modal-header {
            height: 56px;
            padding: 0 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
        }
        .modal-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--ink);
        }
        .modal-header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-modal-select {
            padding: 6px 16px;
            background: var(--orange);
            color: white;
            border: none;
            border-radius: var(--r);
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s;
        }
        .btn-modal-select:hover {
            background: #d94e08;
        }
        .btn-modal-close {
            background: transparent;
            border: none;
            color: var(--ink-soft);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            border-radius: 6px;
        }
        .btn-modal-close:hover {
            background: var(--bg);
            color: var(--ink);
        }
        .modal-body {
            flex: 1;
            background: #cbd5e1;
            position: relative;
        }
        .modal-iframe {
            width: 100%;
            height: 100%;
            border: none;
            background: white;
        }
    </style>
</head>
<body>

    <!-- Left Navigation Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            UniEvents Admin
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <span class="material-symbols-outlined">dashboard</span>
                Tổng quan
            </a>
            <a href="{{ route('admin.events.index') }}" class="menu-link active">
                <span class="material-symbols-outlined">event</span>
                Sự kiện
            </a>
            <a href="#" class="menu-link">
                <span class="material-symbols-outlined">photo_library</span>
                Thư viện Media
            </a>
            <a href="{{ route('admin.events.index') }}" class="menu-link">
                <span class="material-symbols-outlined">archive</span>
                Lưu trữ sự kiện
            </a>
            <a href="#" class="menu-link">
                <span class="material-symbols-outlined">settings</span>
                Cấu đặt hệ thống
            </a>
        </nav>
    </aside>

    <!-- Main Workspace -->
    <div class="workspace">
        <!-- Top Bar -->
        <header class="topbar">
            <!-- Stepper Progression -->
            <div class="stepper">
                <a href="{{ route('admin.events.edit', $event) }}" class="step-item completed">
                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    ① Thông tin
                </a>
                <span class="step-divider">→</span>
                <span class="step-item active">
                    <span class="material-symbols-outlined text-[16px]">radio_button_checked</span>
                    ② Chọn mẫu
                </span>
                <span class="step-divider">→</span>
                <span class="step-item">
                    <span class="material-symbols-outlined text-[16px]">radio_button_unchecked</span>
                    ③ Thiết kế
                </span>
                <span class="step-divider">→</span>
                <span class="step-item">
                    <span class="material-symbols-outlined text-[16px]">radio_button_unchecked</span>
                    ④ Xem trước
                </span>
            </div>
            
            <a href="{{ route('admin.events.design', $event) }}" class="btn-back py-1.5 px-3.5 text-[12px]">
                Bỏ qua bước này
            </a>
        </header>

        <!-- Main Scrollable Content -->
        <div class="panel-content">
            <div class="page-header">
                <h1>Thư viện mẫu sự kiện</h1>
                <p>Lựa chọn mẫu thiết kế phù hợp nhất làm nền tảng cho sự kiện của bạn. Bạn có thể tự do tùy chỉnh lại toàn bộ nội dung, hình ảnh và bố cục ở bước sau.</p>
            </div>

            <!-- Toolbar Search & Filter -->
            <div class="toolbar">
                <div class="search-box">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" id="tmplSearch" placeholder="Tìm kiếm mẫu thiết kế..." oninput="filterTemplates()">
                </div>
                <div class="sort-select">
                    <span>Sắp xếp:</span>
                    <select id="tmplSort" onchange="sortTemplates()">
                        <option value="popular">Phổ biến nhất</option>
                        <option value="newest">Mới nhất</option>
                        <option value="simple">Đơn giản nhất</option>
                    </select>
                </div>
            </div>

            <!-- Category Tabs -->
            <div class="cat-tabs">
                <button class="cat-btn active" onclick="selectCategory('all', this)">
                    Tất cả mẫu <span class="cat-count" id="count-all">5</span>
                </button>
                <button class="cat-btn" onclick="selectCategory('hoc-thuat', this)">
                    Học thuật <span class="cat-count" id="count-hoc-thuat">1</span>
                </button>
                <button class="cat-btn" onclick="selectCategory('van-nghe', this)">
                    Văn nghệ <span class="cat-count" id="count-van-nghe">1</span>
                </button>
                <button class="cat-btn" onclick="selectCategory('the-thao', this)">
                    Thể thao <span class="cat-count" id="count-the-thao">1</span>
                </button>
                <button class="cat-btn" onclick="selectCategory('le-ky-niem', this)">
                    Lễ kỷ niệm <span class="cat-count" id="count-le-ky-niem">1</span>
                </button>
                <button class="cat-btn" onclick="selectCategory('cong-dong', this)">
                    Cộng đồng <span class="cat-count" id="count-cong-dong">1</span>
                </button>
            </div>

            <!-- Templates Cards Grid -->
            <div class="tmpl-grid" id="templateGrid">
                
                <!-- Blank template option -->
                <div class="tmpl-card blank-card" id="card-blank" onclick="chooseTemplate('blank', 'Trang trống', '', 1)" data-category="all">
                    <div class="blank-icon-wrap">
                        <span class="material-symbols-outlined text-[24px]">add</span>
                    </div>
                    <h3 class="tmpl-name mb-1">Bắt đầu với trang trống</h3>
                    <p class="tmpl-desc">Tự thiết kế từ đầu với giao diện tiêu chuẩn sạch sẽ.</p>
                    <button class="btn-card-select w-full mt-auto">Chọn mẫu này</button>
                </div>

                <!-- Template 3: Mẫu Học thuật -->
                <div class="tmpl-card" id="card-academic" onclick="chooseTemplate('academic', 'Mẫu Học thuật', 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=400&q=80', 3)" data-category="hoc-thuat" data-name="mẫu học thuật hội thảo">
                    <div class="tmpl-thumb-wrap">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=400&q=80" alt="Mẫu Học thuật" class="tmpl-thumb">
                        <span class="tmpl-badge">Học thuật</span>
                        <div class="tmpl-hover-overlay" onclick="event.stopPropagation(); openPreviewModal(3, 'Mẫu Học thuật')">
                            <span class="material-symbols-outlined text-[28px] text-white mb-1">visibility</span>
                            <span class="text-white text-[11px] font-semibold tracking-wide">Xem trước thiết kế</span>
                        </div>
                    </div>
                    <div class="tmpl-info">
                        <div class="tmpl-title-row">
                            <h3 class="tmpl-name">Mẫu Học thuật</h3>
                        </div>
                        <p class="tmpl-desc">Cấu trúc chuyên nghiệp, thanh lịch, làm nổi bật thông tin diễn giả và lịch trình.</p>
                        <div class="tmpl-actions" onclick="event.stopPropagation()">
                            <button class="btn-card-select" onclick="chooseTemplate('academic', 'Mẫu Học thuật', 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=400&q=80', 3)">Chọn mẫu</button>
                            <button class="btn-card-preview" onclick="openPreviewModal(3, 'Mẫu Học thuật')" title="Xem trước mẫu">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Template 4: Mẫu Workshop -->
                <div class="tmpl-card" id="card-workshop" onclick="chooseTemplate('workshop', 'Mẫu Workshop', 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=400&q=80', 4)" data-category="cong-dong" data-name="mẫu workshop tọa đàm">
                    <div class="tmpl-thumb-wrap">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=400&q=80" alt="Mẫu Workshop" class="tmpl-thumb">
                        <span class="tmpl-badge">Cộng đồng</span>
                        <div class="tmpl-hover-overlay" onclick="event.stopPropagation(); openPreviewModal(4, 'Mẫu Workshop')">
                            <span class="material-symbols-outlined text-[28px] text-white mb-1">visibility</span>
                            <span class="text-white text-[11px] font-semibold tracking-wide">Xem trước thiết kế</span>
                        </div>
                    </div>
                    <div class="tmpl-info">
                        <div class="tmpl-title-row">
                            <h3 class="tmpl-name">Mẫu Workshop</h3>
                        </div>
                        <p class="tmpl-desc">Phong cách hiện đại, tối giản, lý tưởng cho những buổi đào tạo và định hướng chuyên môn.</p>
                        <div class="tmpl-actions" onclick="event.stopPropagation()">
                            <button class="btn-card-select" onclick="chooseTemplate('workshop', 'Mẫu Workshop', 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=400&q=80', 4)">Chọn mẫu</button>
                            <button class="btn-card-preview" onclick="openPreviewModal(4, 'Mẫu Workshop')" title="Xem trước mẫu">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Template 5: Mẫu Gala Nghệ thuật -->
                <div class="tmpl-card" id="card-cultural" onclick="chooseTemplate('cultural', 'Mẫu Gala Nghệ thuật', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=400&q=80', 5)" data-category="van-nghe" data-name="mẫu gala nghệ thuật văn nghệ">
                    <div class="tmpl-thumb-wrap">
                        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=400&q=80" alt="Mẫu Gala Nghệ thuật" class="tmpl-thumb">
                        <span class="tmpl-badge">Văn nghệ</span>
                        <div class="tmpl-hover-overlay" onclick="event.stopPropagation(); openPreviewModal(5, 'Mẫu Gala Nghệ thuật')">
                            <span class="material-symbols-outlined text-[28px] text-white mb-1">visibility</span>
                            <span class="text-white text-[11px] font-semibold tracking-wide">Xem trước thiết kế</span>
                        </div>
                    </div>
                    <div class="tmpl-info">
                        <div class="tmpl-title-row">
                            <h3 class="tmpl-name">Mẫu Gala Nghệ thuật</h3>
                        </div>
                        <p class="tmpl-desc">Thiết kế đầy chất thơ với cấu trúc phân đoạn rõ ràng cho kịch bản lễ hội âm nhạc sôi động.</p>
                        <div class="tmpl-actions" onclick="event.stopPropagation()">
                            <button class="btn-card-select" onclick="chooseTemplate('cultural', 'Mẫu Gala Nghệ thuật', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=400&q=80', 5)">Chọn mẫu</button>
                            <button class="btn-card-preview" onclick="openPreviewModal(5, 'Mẫu Gala Nghệ thuật')" title="Xem trước mẫu">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Template 6: Mẫu Thể thao -->
                <div class="tmpl-card" id="card-sports" onclick="chooseTemplate('sports', 'Mẫu Thể thao', 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=400&q=80', 6)" data-category="the-thao" data-name="mẫu thể thao giải đấu">
                    <div class="tmpl-thumb-wrap">
                        <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=400&q=80" alt="Mẫu Thể thao" class="tmpl-thumb">
                        <span class="tmpl-badge">Thể thao</span>
                        <div class="tmpl-hover-overlay" onclick="event.stopPropagation(); openPreviewModal(6, 'Mẫu Thể thao')">
                            <span class="material-symbols-outlined text-[28px] text-white mb-1">visibility</span>
                            <span class="text-white text-[11px] font-semibold tracking-wide">Xem trước thiết kế</span>
                        </div>
                    </div>
                    <div class="tmpl-info">
                        <div class="tmpl-title-row">
                            <h3 class="tmpl-name">Mẫu Thể thao</h3>
                        </div>
                        <p class="tmpl-desc">Năng động, tràn đầy năng lượng, phù hợp các hoạt động thi đấu thể thao học đường sôi nổi.</p>
                        <div class="tmpl-actions" onclick="event.stopPropagation()">
                            <button class="btn-card-select" onclick="chooseTemplate('sports', 'Mẫu Thể thao', 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=400&q=80', 6)">Chọn mẫu</button>
                            <button class="btn-card-preview" onclick="openPreviewModal(6, 'Mẫu Thể thao')" title="Xem trước mẫu">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Template 7: Mẫu Lễ kỷ niệm -->
                <div class="tmpl-card" id="card-ceremony" onclick="chooseTemplate('ceremony', 'Mẫu Lễ kỷ niệm', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=400&q=80', 7)" data-category="le-ky-niem" data-name="mẫu lễ kỷ niệm khai giảng">
                    <div class="tmpl-thumb-wrap">
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=400&q=80" alt="Mẫu Lễ kỷ niệm" class="tmpl-thumb">
                        <span class="tmpl-badge">Lễ kỷ niệm</span>
                        <div class="tmpl-hover-overlay" onclick="event.stopPropagation(); openPreviewModal(7, 'Mẫu Lễ kỷ niệm')">
                            <span class="material-symbols-outlined text-[28px] text-white mb-1">visibility</span>
                            <span class="text-white text-[11px] font-semibold tracking-wide">Xem trước thiết kế</span>
                        </div>
                    </div>
                    <div class="tmpl-info">
                        <div class="tmpl-title-row">
                            <h3 class="tmpl-name">Mẫu Lễ kỷ niệm</h3>
                        </div>
                        <p class="tmpl-desc">Bố cục trang trọng, truyền thống nhưng vẫn rất hiện đại cho ngày lễ tốt nghiệp và khai giảng.</p>
                        <div class="tmpl-actions" onclick="event.stopPropagation()">
                            <button class="btn-card-select" onclick="chooseTemplate('ceremony', 'Mẫu Lễ kỷ niệm', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=400&q=80', 7)">Chọn mẫu</button>
                            <button class="btn-card-preview" onclick="openPreviewModal(7, 'Mẫu Lễ kỷ niệm')" title="Xem trước mẫu">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Template 2: Lễ Tốt nghiệp -->
                <div class="tmpl-card" id="card-le-tot-nghiep" onclick="chooseTemplate('le-tot-nghiep', 'Lễ Tốt nghiệp', 'https://images.unsplash.com/photo-1527891751199-7225231a68dd?auto=format&fit=crop&w=400&q=80', 2)" data-category="le-ky-niem" data-name="lễ tốt nghiệp">
                    <div class="tmpl-thumb-wrap">
                        <img src="https://images.unsplash.com/photo-1527891751199-7225231a68dd?auto=format&fit=crop&w=400&q=80" alt="Lễ Tốt nghiệp" class="tmpl-thumb">
                        <span class="tmpl-badge">Lễ kỷ niệm</span>
                        <div class="tmpl-hover-overlay" onclick="event.stopPropagation(); openPreviewModal(2, 'Lễ Tốt nghiệp')">
                            <span class="material-symbols-outlined text-[28px] text-white mb-1">visibility</span>
                            <span class="text-white text-[11px] font-semibold tracking-wide">Xem trước thiết kế</span>
                        </div>
                    </div>
                    <div class="tmpl-info">
                        <div class="tmpl-title-row">
                            <h3 class="tmpl-name">Lễ Tốt nghiệp</h3>
                        </div>
                        <p class="tmpl-desc">Sang trọng, mang tính chất lưu giữ kỷ niệm học trò với layout ảnh cỡ lớn sang trọng.</p>
                        <div class="tmpl-actions" onclick="event.stopPropagation()">
                            <button class="btn-card-select" onclick="chooseTemplate('le-tot-nghiep', 'Lễ Tốt nghiệp', 'https://images.unsplash.com/photo-1527891751199-7225231a68dd?auto=format&fit=crop&w=400&q=80', 2)">Chọn mẫu</button>
                            <button class="btn-card-preview" onclick="openPreviewModal(2, 'Lễ Tốt nghiệp')" title="Xem trước mẫu">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Sticky Bottom Selection Bar -->
        <footer class="sticky-footer">
            <div class="selection-preview">
                <img id="selectedThumb" src="" alt="Selected Preview" class="selection-thumb-mini hidden">
                <div class="selection-info-text">
                    <span class="selection-info-title" id="selectedTitle">Chưa có mẫu nào được chọn</span>
                    <span class="selection-info-sub" id="selectedSub">Nhấn vào một mẫu để tiếp tục</span>
                </div>
            </div>
            <div class="footer-buttons">
                <a href="{{ route('admin.events.edit', $event) }}" class="btn-back">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    Quay lại
                </a>
                <form id="templateSelectionForm" action="{{ route('admin.events.save_template', $event) }}" method="POST">
                    @csrf
                    <input type="hidden" name="page_template" id="selectedTemplateId" value="">
                    <button type="submit" class="btn-next" id="btnNextStep" disabled>
                        Tiếp tục — Thiết kế
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </button>
                </form>
            </div>
        </footer>
    </div>

    <!-- Fullscreen Iframe Preview Modal -->
    <div class="modal-overlay" id="previewModal">
        <div class="modal-window">
            <div class="modal-header">
                <span class="modal-title" id="modalTitle">Xem trước mẫu thiết kế</span>
                <div class="modal-header-actions">
                    <button class="btn-modal-select" id="btnConfirmSelect" onclick="confirmModalSelection()">Chọn mẫu này</button>
                    <button class="btn-modal-close" onclick="closePreviewModal()">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <iframe id="modalIframe" src="" class="modal-iframe"></iframe>
            </div>
        </div>
    </div>

    <script>
        // Track state
        let currentTemplateCode = "";
        let currentTemplateDatabaseId = null;
        let selectedCategoryCode = "all";

        // Pre-select template if already set in event
        document.addEventListener("DOMContentLoaded", function() {
            const currentDbId = "{{ $event->page_template }}";
            if (currentDbId === "1") {
                chooseTemplate('blank', 'Trang trống', '', 1);
            } else if (currentDbId === "2") {
                chooseTemplate('le-tot-nghiep', 'Lễ Tốt nghiệp', 'https://images.unsplash.com/photo-1527891751199-7225231a68dd?auto=format&fit=crop&w=400&q=80', 2);
            } else if (currentDbId === "3") {
                chooseTemplate('academic', 'Mẫu Học thuật', 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=400&q=80', 3);
            } else if (currentDbId === "4") {
                chooseTemplate('workshop', 'Mẫu Workshop', 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=400&q=80', 4);
            } else if (currentDbId === "5") {
                chooseTemplate('cultural', 'Mẫu Gala Nghệ thuật', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=400&q=80', 5);
            } else if (currentDbId === "6") {
                chooseTemplate('sports', 'Mẫu Thể thao', 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=400&q=80', 6);
            } else if (currentDbId === "7") {
                chooseTemplate('ceremony', 'Mẫu Lễ kỷ niệm', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=400&q=80', 7);
            } else {
                chooseTemplate('academic', 'Mẫu Học thuật', 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=400&q=80', 3);
            }
            updateCategoryCounts();
        });

        // Function when clicking a template card
        function chooseTemplate(cardId, cardTitle, thumbUrl, dbId) {
            // Remove selection class from all cards
            document.querySelectorAll('.tmpl-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selection class to chosen card
            const selectedCardEl = document.getElementById('card-' + cardId);
            if (selectedCardEl) {
                selectedCardEl.classList.add('selected');
            }

            // Update state
            currentTemplateCode = cardId;
            currentTemplateDatabaseId = dbId;

            // Update Form input
            document.getElementById('selectedTemplateId').value = dbId;

            // Enable next button
            const nextBtn = document.getElementById('btnNextStep');
            nextBtn.disabled = false;

            // Update bottom selected preview
            const selectedThumb = document.getElementById('selectedThumb');
            const selectedTitle = document.getElementById('selectedTitle');
            const selectedSub = document.getElementById('selectedSub');

            if (thumbUrl) {
                selectedThumb.src = thumbUrl;
                selectedThumb.classList.remove('hidden');
            } else {
                selectedThumb.classList.add('hidden');
            }

            selectedTitle.textContent = cardTitle;
            
            let subText = "Sử dụng Mẫu Tiêu chuẩn (Trống)";
            if (dbId === 2) subText = "Sử dụng Mẫu 2 (Lễ Tốt nghiệp)";
            else if (dbId === 3) subText = "Sử dụng Mẫu 3 (Học thuật)";
            else if (dbId === 4) subText = "Sử dụng Mẫu 4 (Workshop)";
            else if (dbId === 5) subText = "Sử dụng Mẫu 5 (Gala Văn nghệ)";
            else if (dbId === 6) subText = "Sử dụng Mẫu 6 (Thể thao)";
            else if (dbId === 7) subText = "Sử dụng Mẫu 7 (Lễ kỷ niệm)";
            selectedSub.textContent = subText;
        }

        // Open preview modal
        let modalActiveDbId = null;
        let modalActiveTitle = "";
        
        function openPreviewModal(dbId, title) {
            modalActiveDbId = dbId;
            modalActiveTitle = title;
            document.getElementById('modalTitle').textContent = "Xem trước: " + title;
            document.getElementById('modalIframe').src = "{{ url('/admin/template-preview') }}/" + dbId;
            document.getElementById('previewModal').classList.add('show');
        }

        function closePreviewModal() {
            document.getElementById('previewModal').classList.remove('show');
            document.getElementById('modalIframe').src = "";
        }

        function confirmModalSelection() {
            if (modalActiveDbId !== null) {
                let code = "blank";
                let thumb = "";
                if (modalActiveDbId === 2) {
                    code = "le-tot-nghiep";
                    thumb = "https://images.unsplash.com/photo-1527891751199-7225231a68dd?auto=format&fit=crop&w=400&q=80";
                } else if (modalActiveDbId === 3) {
                    code = "academic";
                    thumb = "https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=400&q=80";
                } else if (modalActiveDbId === 4) {
                    code = "workshop";
                    thumb = "https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=400&q=80";
                } else if (modalActiveDbId === 5) {
                    code = "cultural";
                    thumb = "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=400&q=80";
                } else if (modalActiveDbId === 6) {
                    code = "sports";
                    thumb = "https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=400&q=80";
                } else if (modalActiveDbId === 7) {
                    code = "ceremony";
                    thumb = "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=400&q=80";
                } else {
                    code = "blank";
                    thumb = "";
                }
                chooseTemplate(code, modalActiveTitle, thumb, modalActiveDbId);
                closePreviewModal();
            }
        }

        // Category Filtering
        function selectCategory(cat, btnEl) {
            selectedCategoryCode = cat;
            
            // Toggle active classes on tab buttons
            document.querySelectorAll('.cat-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            btnEl.classList.add('active');

            filterTemplates();
        }

        // Filter search + category
        function filterTemplates() {
            const query = document.getElementById('tmplSearch').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.tmpl-card');

            cards.forEach(card => {
                // Skip the blank card from category filtering but allow search on it
                const isBlank = card.id === "card-blank";
                const cardCat = card.getAttribute('data-category');
                const cardName = card.getAttribute('data-name') || "bắt đầu với trang trống";
                
                const matchesCategory = (selectedCategoryCode === 'all' || isBlank || cardCat === selectedCategoryCode);
                const matchesSearch = (cardName.includes(query) || (isBlank && "trang trống".includes(query)));

                if (matchesCategory && matchesSearch) {
                    card.style.display = "flex";
                } else {
                    card.style.display = "none";
                }
            });
        }

        // Update counts dynamically
        function updateCategoryCounts() {
            const categories = ['all', 'hoc-thuat', 'van-nghe', 'the-thao', 'le-ky-niem', 'cong-dong'];
            const cards = document.querySelectorAll('.tmpl-card');
            
            categories.forEach(cat => {
                let count = 0;
                cards.forEach(card => {
                    if (card.id === "card-blank") return; // Don't count blank card
                    if (cat === 'all' || card.getAttribute('data-category') === cat) {
                        count++;
                    }
                });
                const countEl = document.getElementById('count-' + cat);
                if (countEl) {
                    countEl.textContent = count;
                }
            });
        }

        // Sort Templates
        function sortTemplates() {
            const sortVal = document.getElementById('tmplSort').value;
            const grid = document.getElementById('templateGrid');
            const cards = Array.from(grid.children);

            // Separate blank card, always put it first
            const blankCard = cards.find(c => c.id === "card-blank");
            const otherCards = cards.filter(c => c.id !== "card-blank");

            if (sortVal === "newest") {
                // Reverse order (simulation of newest)
                otherCards.reverse();
            } else if (sortVal === "simple") {
                // Sort by dbId ascending
                otherCards.sort((a, b) => {
                    const getDbId = el => {
                        const clickStr = el.querySelector('.btn-card-select').getAttribute('onclick');
                        const matches = clickStr.match(/,\s*(\d+)\s*\)/);
                        return matches ? parseInt(matches[1]) : 1;
                    };
                    return getDbId(a) - getDbId(b);
                });
            } else {
                // Popular: back to default order
                otherCards.sort((a, b) => {
                    return a.id.localeCompare(b.id);
                });
            }

            // Re-append elements
            grid.innerHTML = "";
            if (blankCard) grid.appendChild(blankCard);
            otherCards.forEach(c => grid.appendChild(c));
        }
    </script>
</body>
</html>
