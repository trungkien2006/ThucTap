<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle ?? 'UniEvent Admin' }} · UniEvent Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- SPA Pre-loaded CDN Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js" data-navigate-track></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin" data-navigate-track></script>

    @stack('styles')
    
    <style>
        .sidebar-transition {
            transition: width 0.2s ease, transform 0.2s ease;
        }
        .sidebar-menu-btn {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            width: 100%;
            height: 2.75rem;
            padding: 0 1rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--color-sidebar-foreground, #475569);
            border-radius: var(--radius);
            transition: background-color 0.15s, color 0.15s;
        }
        .sidebar-menu-btn.active {
            background-color: var(--sidebar-accent, #eff6ff);
            color: var(--sidebar-primary, #2563eb);
            font-weight: 600;
        }
        .sidebar-menu-btn:hover:not(.active) {
            background-color: var(--sidebar-accent, #f8fafc);
            color: var(--sidebar-accent-foreground, #0f172a);
        }
        
        /* Mobile Overlay styling */
        #mobileOverlay.show {
            display: block;
        }
        
        /* Hide scrollbar */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="overflow-x-clip bg-background text-foreground font-body admin-body admin-bg-gradient">

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar Wrapper -->
    <aside id="sidebar" class="sidebar-transition fixed left-0 top-0 h-full flex flex-col bg-transparent hover:bg-white border-r border-border hover:shadow-2xl w-[240px] md:sidebar-icon-only z-50 -translate-x-full md:translate-x-0 group">
        <!-- Sidebar Header -->
        <div class="flex h-16 shrink-0 items-center gap-2 border-b border-white/20 px-4 sidebar-logo-container transition-all">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-indigo-500 text-white shadow-md">
                <i data-lucide="graduation-cap" class="h-5 w-5"></i>
            </div>
            <div class="flex flex-col min-w-0 sidebar-text-element">
                <span class="text-sm font-bold leading-tight truncate">UniEvent</span>
                <span class="text-[11px] text-muted-foreground leading-tight">Trang quản trị</span>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto scrollbar-hide p-3 space-y-4">
            
            <a href="{{ route('home') }}" target="_blank" class="sidebar-menu-btn text-violet-600 hover:text-violet-700 hover:bg-violet-50/50 bg-white/40 mb-2 border border-violet-200/50 backdrop-blur-sm rounded-xl">
                <i data-lucide="globe" class="h-5 w-5 shrink-0"></i>
                <span class="sidebar-text-element">Xem Website</span>
            </a>

            <!-- Main Group -->
            <div>
                <p class="text-[10px] uppercase tracking-wider font-bold text-muted-foreground/70 px-3 mb-1.5 sidebar-text-element">Chính</p>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-btn rounded-xl {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" class="h-5 w-5 shrink-0"></i>
                        <span class="sidebar-text-element">Tổng quan</span>
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="sidebar-menu-btn rounded-xl {{ request()->routeIs('admin.events.*') && !request()->routeIs('admin.events.create') && !request()->routeIs('admin.events.edit') && !request()->routeIs('admin.events.design') && !request()->routeIs('admin.events.preview') && !request()->routeIs('admin.events.show') ? 'active' : '' }}">
                        <i data-lucide="calendar" class="h-5 w-5 shrink-0"></i>
                        <span class="sidebar-text-element">Sự kiện</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="sidebar-menu-btn rounded-xl {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i data-lucide="tag" class="h-5 w-5 shrink-0"></i>
                        <span class="sidebar-text-element">Danh mục sự kiện</span>
                    </a>
                    <a href="{{ route('admin.departments.index') }}" class="sidebar-menu-btn rounded-xl {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
                        <i data-lucide="building" class="h-5 w-5 shrink-0"></i>
                        <span class="sidebar-text-element">Khoa / Bộ phận</span>
                    </a>
                    <a href="{{ route('admin.archive.index') }}" class="sidebar-menu-btn rounded-xl {{ request()->routeIs('admin.archive.*') ? 'active' : '' }}">
                        <i data-lucide="archive" class="h-5 w-5 shrink-0"></i>
                        <span class="sidebar-text-element">Lưu trữ sự kiện</span>
                    </a>
                    <a href="{{ route('admin.speakers.index') }}" class="sidebar-menu-btn rounded-xl {{ request()->is('admin/speakers*') ? 'active' : '' }}">
                        <i data-lucide="mic" class="h-5 w-5 shrink-0"></i>
                        <span class="sidebar-text-element">Diễn giả / Khách mời</span>
                    </a>
                </div>
            </div>

            <!-- Content Group -->
            <div>
                <p class="text-[10px] uppercase tracking-wider font-bold text-muted-foreground/70 px-3 mb-1.5 sidebar-text-element">Nội dung</p>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.media.index') }}" class="sidebar-menu-btn rounded-xl {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                        <i data-lucide="image" class="h-5 w-5 shrink-0"></i>
                        <span class="sidebar-text-element">Thư viện Media</span>
                    </a>
                    <a href="{{ route('admin.documents.index') }}" class="sidebar-menu-btn rounded-xl {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                        <i data-lucide="files" class="h-5 w-5 shrink-0"></i>
                        <span class="sidebar-text-element">Tài liệu</span>
                    </a>
                    @if(Auth::user()->isSuperAdmin())
                        <a href="{{ route('admin.users.index') }}" class="sidebar-menu-btn rounded-xl {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i data-lucide="users" class="h-5 w-5 shrink-0"></i>
                            <span class="sidebar-text-element">Quản lý Admin</span>
                        </a>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="border-t border-white/20 p-3">
            <div class="relative">
                <button id="adminAvatarBtn" class="flex items-center gap-2 w-full mb-2 hover:bg-white/40 rounded-xl p-1 transition-colors">
                    @php
                        $userInitials = collect(explode(' ', Auth::user()->name))->map(fn($w) => substr($w, 0, 1))->slice(0, 2)->implode('');
                    @endphp
                    <div class="h-8 w-8 shrink-0 rounded-full bg-gradient-to-br from-violet-200 to-indigo-200 text-indigo-700 grid place-items-center text-xs font-bold uppercase shadow-sm">
                        {{ $userInitials }}
                    </div>
                    <div class="min-w-0 flex-1 text-left sidebar-text-element">
                        <div class="text-xs font-semibold truncate text-foreground">{{ Auth::user()->name }}</div>
                        <div class="text-[11px] text-muted-foreground truncate">{{ Auth::user()->email }}</div>
                    </div>
                    <i data-lucide="chevron-up" class="h-3 w-3 text-muted-foreground shrink-0 sidebar-text-element"></i>
                </button>
                <div id="adminAvatarDropdown" class="absolute bottom-full left-0 right-0 mb-2 bg-white border border-border rounded-md shadow-lg py-1 hidden z-50">
                    @if(Auth::user()->isSuperAdmin())
                        <a href="{{ route('admin.users.create') }}" class="flex items-center px-3 py-2 text-xs text-foreground hover:bg-accent">
                            <i data-lucide="user-plus" class="h-3.5 w-3.5 mr-2"></i> Tạo tài khoản
                        </a>
                        <div class="h-px bg-border my-1"></div>
                    @endif
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-3 py-2 text-xs text-foreground hover:bg-accent">
                        <i data-lucide="settings" class="h-3.5 w-3.5 mr-2"></i> Cài đặt tài khoản
                    </a>
                    <a href="{{ route('admin.profile.activity') }}" class="flex items-center px-3 py-2 text-xs text-foreground hover:bg-accent">
                        <i data-lucide="history" class="h-3.5 w-3.5 mr-2"></i> Lịch sử hoạt động
                    </a>
                    <div class="h-px bg-border my-1"></div>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-3 py-2 text-xs text-destructive hover:bg-accent">
                            <i data-lucide="log-out" class="h-3.5 w-3.5 mr-2"></i> Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Top Header -->
    <header class="fixed top-0 left-0 md:left-[80px] right-0 h-16 z-30 flex items-center gap-2 bg-transparent px-3 md:px-4 justify-between transition-all">
        <div class="flex items-center gap-2 min-w-0">
            <!-- Mobile Toggle Button -->
            <button id="mobileSidebarToggle" class="md:hidden h-9 w-9 text-muted-foreground hover:text-foreground hover:bg-accent rounded-xl flex items-center justify-center transition-all">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>

            <!-- Breadcrumbs -->
            <div class="hidden md:flex items-center text-xs text-muted-foreground gap-1 min-w-0">
                <div class="flex items-center gap-1 min-w-0">
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-foreground">Home</a>
                    @if(isset($breadcrumbs) && is_array($breadcrumbs))
                        @foreach($breadcrumbs as $bc)
                            <i data-lucide="chevron-right" class="h-3 w-3 shrink-0"></i>
                            @if(isset($bc['route']))
                                <a href="{{ $bc['route'] }}" wire:navigate class="hover:text-foreground truncate">{{ $bc['label'] }}</a>
                            @else
                                <span class="text-foreground font-medium truncate">{{ $bc['label'] }}</span>
                            @endif
                        @endforeach
                    @else
                        <i data-lucide="chevron-right" class="h-3 w-3 shrink-0"></i>
                        <span class="text-foreground font-medium truncate">{{ $pageTitle ?? 'Dashboard' }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Global Search Bar -->
        <div class="flex-1 max-w-2xl px-4 hidden md:flex items-center justify-center">
            <form action="{{ route('admin.events.index') }}" method="GET" class="flex items-center w-full max-w-md gap-2">
                <div class="relative flex-1 group">
                    <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-muted-foreground h-4 w-4 group-focus-within:text-primary transition-colors"></i>
                    <input type="text" name="search" placeholder="Tìm kiếm sự kiện, danh mục..." value="{{ request('search') }}"
                        class="h-10 w-full pl-10 pr-4 rounded-xl border border-border bg-white focus:bg-white text-sm transition-all focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary shadow-sm placeholder:text-muted-foreground">
                </div>
                <button type="submit" class="h-10 px-4 bg-primary text-primary-foreground text-sm font-medium rounded-xl hover:bg-primary/90 transition-colors shadow-sm whitespace-nowrap">
                    Tìm kiếm
                </button>
            </form>
        </div>

        @php
            $nowTime = now();
            $startingSoon = \App\Models\Event::where('is_published', true)
                ->where('event_date', '>', $nowTime)
                ->where('event_date', '<=', $nowTime->copy()->addMinutes(10))
                ->get();
            $runningEvents = \App\Models\Event::where('is_published', true)
                ->where('event_date', '<=', $nowTime)
                ->where('end_date', '>=', $nowTime)
                ->get();
            
            $notificationCount = $startingSoon->count() + $runningEvents->count();
        @endphp
        <div class="flex items-center gap-2 md:gap-3">
            <!-- Semester Badge (Real-time Clock) -->
            <div class="hidden lg:inline-flex items-center gap-1.5 h-11 px-4 rounded-full border border-border text-[12px] font-normal text-muted-foreground">
                <span class="h-1.5 w-1.5 rounded-full bg-primary animate-pulse"></span>
                <span id="dateTimeString"></span>
            </div>

            <!-- Create quick dropdown -->
            <div class="relative">
                <button id="quickCreateBtn" class="flex items-center gap-1.5 h-11 px-5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white hover:opacity-90 rounded-xl text-sm font-semibold transition-all shadow-md shadow-indigo-500/20">
                    <i data-lucide="plus" class="h-5 w-5"></i> Tạo mới
                    <i data-lucide="chevron-down" class="h-3 w-3 opacity-70"></i>
                </button>
                <div id="quickCreateDropdown" class="absolute right-0 top-full mt-1.5 w-48 bg-white border border-border rounded-md shadow-lg py-1 hidden z-50">
                    <div class="px-2.5 py-1.5 text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">Tạo nhanh</div>
                    <div class="h-px bg-border my-1"></div>
                    <a href="{{ route('admin.speakers.create') }}" wire:navigate class="flex items-center px-2.5 py-1.5 text-xs text-foreground hover:bg-accent rounded-sm mx-1">Diễn giả mới</a>
                    <a href="{{ route('admin.media.index') }}" wire:navigate class="flex items-center px-2.5 py-1.5 text-xs text-foreground hover:bg-accent rounded-sm mx-1">Tải lên Media</a>
                </div>
            </div>

            <!-- Notifications Button with Dropdown -->
            <div class="relative">
                <button id="notificationBtn" class="h-11 w-11 relative text-muted-foreground hover:text-foreground hover:bg-accent rounded-xl flex items-center justify-center transition-all">
                    <i data-lucide="bell" class="h-5 w-5"></i>
                    @if($notificationCount > 0)
                        <span class="absolute top-3 right-3 h-4 w-4 bg-destructive text-white text-[9px] font-bold rounded-full flex items-center justify-center animate-pulse">
                            {{ $notificationCount }}
                        </span>
                    @endif
                </button>
                <div id="notificationDropdown" class="absolute right-0 top-full mt-1.5 w-80 bg-white border border-border rounded-md shadow-lg py-2 hidden z-50">
                    <div class="px-3 py-1.5 text-xs font-semibold text-foreground border-b border-border flex justify-between items-center">
                        <span>Thông báo sự kiện</span>
                        @if($notificationCount > 0)
                            <span class="bg-destructive/10 text-destructive text-[10px] px-1.5 py-0.5 rounded-full font-medium">{{ $notificationCount }} mới</span>
                        @endif
                    </div>
                    <div class="max-h-64 overflow-y-auto divide-y divide-border">
                        @if($notificationCount == 0)
                            <div class="p-4 text-center text-xs text-muted-foreground">Không có thông báo nào vào lúc này</div>
                        @else
                            @foreach($startingSoon as $evt)
                                @php
                                    $diffMin = max(1, round($nowTime->diffInMinutes($evt->event_date)));
                                @endphp
                                <div class="p-3 hover:bg-accent/40 transition-colors">
                                    <div class="flex items-start gap-2.5">
                                        <div class="h-7 w-7 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                            <i data-lucide="clock" class="h-4 w-4"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-medium text-foreground truncate">{{ $evt->title }}</p>
                                            <p class="text-[11px] text-amber-600 font-medium mt-0.5">Sắp diễn ra: Bắt đầu sau {{ $diffMin }} phút nữa</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach($runningEvents as $evt)
                                @php
                                    $diffEnd = $nowTime->diffInMinutes($evt->end_date);
                                    $diffEndStr = $diffEnd > 60 ? (round($diffEnd / 60) . ' giờ') : ($diffEnd . ' phút');
                                @endphp
                                <div class="p-3 hover:bg-accent/40 transition-colors">
                                    <div class="flex items-start gap-2.5">
                                        <div class="h-7 w-7 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                            <i data-lucide="play" class="h-4 w-4"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-medium text-foreground truncate">{{ $evt->title }}</p>
                                            <p class="text-[11px] text-emerald-600 font-medium mt-0.5">Đang diễn ra: Còn {{ $diffEndStr }} là kết thúc</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Public site link -->
            <a href="{{ route('home') }}" target="_blank" class="h-11 w-11 text-muted-foreground hover:text-foreground hover:bg-accent rounded-xl flex items-center justify-center transition-all" title="Xem trang công khai" wire:navigate>
                <i data-lucide="external-link" class="h-5 w-5"></i>
            </a>
        </div>
    </header>

    <!-- Main Content Wrapper -->
    <main class="pt-16 md:pl-[80px] min-h-screen transition-all">
        <div class="p-4 md:p-6 lg:p-8 max-w-[1600px] mx-auto">
            @if(session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg text-xs flex items-center gap-2 animate-fade-in shadow-sm">
                    <i data-lucide="check-circle-2" class="h-4 w-4 text-emerald-600"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-xs flex items-center gap-2 shadow-sm">
                    <i data-lucide="alert-circle" class="h-4 w-4 text-red-600"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
            {{ $slot ?? '' }}
        </div>
    </main>

    <script data-spa-ignore>
        // Init setup that runs on initial page load AND after SPA navigations
        function initAdminScripts() {
            // Initialize Lucide Icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Sidebar Mobile Toggle
            const sidebar = document.getElementById('sidebar');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const mobileOverlay = document.getElementById('mobileOverlay');

        function openSidebar() {
            if(sidebar) sidebar.classList.remove('-translate-x-full');
            if(mobileOverlay) mobileOverlay.classList.remove('hidden');
        }
        function closeSidebar() {
            if(sidebar) sidebar.classList.add('-translate-x-full');
            if(mobileOverlay) mobileOverlay.classList.add('hidden');
        }

        if (mobileSidebarToggle && !mobileSidebarToggle.dataset.initialized) {
            mobileSidebarToggle.dataset.initialized = 'true';
            mobileSidebarToggle.addEventListener('click', openSidebar);
        }
        if (mobileOverlay && !mobileOverlay.dataset.initialized) {
            mobileOverlay.dataset.initialized = 'true';
            mobileOverlay.addEventListener('click', closeSidebar);
        }

        // Quick Create Dropdown Toggle
        const quickCreateBtn = document.getElementById('quickCreateBtn');
        const quickCreateDropdown = document.getElementById('quickCreateDropdown');

        if (quickCreateBtn && quickCreateDropdown && !quickCreateBtn.dataset.initialized) {
            quickCreateBtn.dataset.initialized = 'true';
            quickCreateBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                quickCreateDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!quickCreateDropdown.contains(e.target) && !quickCreateBtn.contains(e.target)) {
                    quickCreateDropdown.classList.add('hidden');
                }
            });
        }

        // Admin Avatar Dropdown Toggle
        const adminAvatarBtn = document.getElementById('adminAvatarBtn');
        const adminAvatarDropdown = document.getElementById('adminAvatarDropdown');

        if (adminAvatarBtn && adminAvatarDropdown && !adminAvatarBtn.dataset.initialized) {
            adminAvatarBtn.dataset.initialized = 'true';
            adminAvatarBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                adminAvatarDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!adminAvatarDropdown.contains(e.target) && !adminAvatarBtn.contains(e.target)) {
                    adminAvatarDropdown.classList.add('hidden');
                }
            });
        }

        // Notification Dropdown Toggle
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');

        if (notificationBtn && notificationDropdown && !notificationBtn.dataset.initialized) {
            notificationBtn.dataset.initialized = 'true';
            notificationBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!notificationDropdown.contains(e.target) && !notificationBtn.contains(e.target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });
        }

        // Dynamic Real-time Clock
        const dateTimeString = document.getElementById('dateTimeString');
        if (dateTimeString && !dateTimeString.dataset.initialized) {
            dateTimeString.dataset.initialized = 'true';
            // clear old interval if it exists (so they don't stack up)
            if (window.clockInterval) {
                clearInterval(window.clockInterval);
            }
            const updateClock = () => {
                const now = new Date();
                const month = now.getMonth() + 1;
                let semester = '';
                if (month >= 1 && month <= 4) {
                    semester = 'Spring';
                } else if (month >= 5 && month <= 8) {
                    semester = 'Summer';
                } else {
                    semester = 'Fall';
                }
                const options = { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'numeric', 
                    day: 'numeric',
                    hour: '2-digit', 
                    minute: '2-digit', 
                    second: '2-digit',
                    hour12: false 
                };
                dateTimeString.textContent = now.toLocaleDateString('vi-VN', options) + ` · Kỳ ${semester}`;
            };
            updateClock();
            window.clockInterval = setInterval(updateClock, 1000);
        }
        
        } // End of initAdminScripts

        if (!window.adminSpaInitialized) {
            window.adminSpaInitialized = true;
            document.addEventListener('DOMContentLoaded', initAdminScripts);
            
            // Prefetch on hover for instant navigation
            document.addEventListener('mouseover', (e) => {
                const link = e.target.closest('a.sidebar-menu-btn, a[href*="admin.profile"], a[href*="admin.users"]');
                if (!link || !link.href || link.dataset.prefetched || link.target === '_blank' || link.href.includes('javascript:') || link.href.includes('#')) return;
                link.dataset.prefetched = 'true';
                const linkElement = document.createElement('link');
                linkElement.rel = 'prefetch';
                linkElement.href = link.href;
                document.head.appendChild(linkElement);
            });

            // Custom Bulletproof SPA Navigation for Admin Sidebar
            document.addEventListener('click', async (e) => {
            const link = e.target.closest('a.sidebar-menu-btn, a[href*="admin.profile"], a[href*="admin.users"]');
            if (!link || !link.href || link.target === '_blank' || link.hasAttribute('download')) return;
            if (link.href.includes('javascript:') || link.href.includes('#')) return;
            
            e.preventDefault();
            const url = link.href;

            // Optimistically update active state on sidebar
            if (link.classList.contains('sidebar-menu-btn')) {
                document.querySelectorAll('.sidebar-menu-btn').forEach(btn => btn.classList.remove('active'));
                link.classList.add('active');
            }

            // Visual feedback
            const topBar = document.createElement('div');
            topBar.className = 'fixed top-0 left-0 h-1 bg-primary z-[9999] transition-all duration-150 ease-out';
            topBar.style.width = '30%';
            document.body.appendChild(topBar);

            try {
                const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }
                
                topBar.style.width = '70%';
                
                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Swap Title & Body
                document.title = doc.title;
                document.body.innerHTML = doc.body.innerHTML;
                document.body.className = doc.body.className;

                // Update History
                history.pushState({}, '', url);

                // Re-evaluate scripts in the body
                Array.from(document.body.querySelectorAll('script:not([data-spa-ignore])')).forEach(oldScript => {
                    const newScript = document.createElement('script');
                    Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                    newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                    oldScript.parentNode.replaceChild(newScript, oldScript);
                });

                // Re-initialize UI
                if (typeof lucide !== 'undefined') lucide.createIcons();
                if (typeof initAdminScripts === 'function') initAdminScripts();

            } catch (err) {
                window.location.href = url; // Fallback
            } finally {
                topBar.style.width = '100%';
                setTimeout(() => topBar.remove(), 200);
            }
        });

        window.addEventListener('popstate', () => {
            window.location.reload();
        });
        } // End of window.adminSpaInitialized
    </script>

    @stack('scripts')
</body>
</html>
