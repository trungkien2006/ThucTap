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
            background-color: var(--primary);
            color: var(--primary-foreground);
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        }
        .sidebar-menu-btn:hover:not(.active) {
            background-color: var(--sidebar-accent, #f1f5f9);
            color: var(--sidebar-accent-foreground, #0f172a);
        }
        
        /* Mobile Overlay styling */
        #mobileOverlay.show {
            display: block;
        }
    </style>
</head>
<body class="overflow-x-clip bg-background text-foreground font-body admin-body">

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar Wrapper -->
    <aside id="sidebar" class="sidebar-transition fixed left-0 top-0 h-full flex flex-col bg-sidebar border-r border-sidebar-border w-[240px] z-50 -translate-x-full md:translate-x-0">
        <!-- Sidebar Header -->
        <div class="flex h-16 shrink-0 items-center gap-2 border-b border-sidebar-border px-4">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-primary text-primary-foreground">
                <i data-lucide="graduation-cap" class="h-5 w-5"></i>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-sm font-bold leading-tight truncate">UniEvent</span>
                <span class="text-[11px] text-muted-foreground leading-tight">Trang quản trị</span>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto p-3 space-y-4">
            
            <a href="{{ route('home') }}" target="_blank" class="sidebar-menu-btn text-brand-orange hover:text-brand-orange hover:bg-orange-50 bg-orange-50/50 mb-2 border border-brand-orange/20">
                <i data-lucide="globe" class="h-5 w-5"></i>
                <span>Xem Website</span>
            </a>

            <!-- Main Group -->
            <div>
                <p class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground/70 px-3 mb-1.5">Chính</p>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-btn {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                        <span>Tổng quan</span>
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="sidebar-menu-btn {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                        <i data-lucide="calendar" class="h-5 w-5"></i>
                        <span>Sự kiện</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="sidebar-menu-btn {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i data-lucide="tag" class="h-5 w-5"></i>
                        <span>Danh mục sự kiện</span>
                    </a>
                    <a href="{{ route('admin.departments.index') }}" class="sidebar-menu-btn {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
                        <i data-lucide="building" class="h-5 w-5"></i>
                        <span>Khoa / Bộ phận</span>
                    </a>
                    <a href="{{ route('admin.archive.index') }}" class="sidebar-menu-btn {{ request()->routeIs('admin.archive.*') ? 'active' : '' }}">
                        <i data-lucide="archive" class="h-5 w-5"></i>
                        <span>Lưu trữ sự kiện</span>
                    </a>
                    <a href="{{ route('admin.speakers.index') }}" class="sidebar-menu-btn {{ request()->routeIs('admin.speakers.*') ? 'active' : '' }}">
                        <i data-lucide="mic" class="h-5 w-5"></i>
                        <span>Diễn giả / Khách mời</span>
                    </a>
                </div>
            </div>

            <!-- Content Group -->
            <div>
                <p class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground/70 px-3 mb-1.5">Nội dung</p>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.media.index') }}" class="sidebar-menu-btn {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                        <i data-lucide="image" class="h-5 w-5"></i>
                        <span>Thư viện Media</span>
                    </a>
                    <a href="{{ route('admin.documents.index') }}" class="sidebar-menu-btn {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                        <i data-lucide="files" class="h-5 w-5"></i>
                        <span>Tài liệu</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="border-t border-sidebar-border p-3">
            <div class="relative">
                <button id="adminAvatarBtn" class="flex items-center gap-2 w-full mb-2 hover:bg-accent/50 rounded-md p-1 transition-colors">
                    @php
                        $userInitials = collect(explode(' ', Auth::user()->name))->map(fn($w) => substr($w, 0, 1))->slice(0, 2)->implode('');
                    @endphp
                    <div class="h-8 w-8 shrink-0 rounded-full bg-accent text-accent-foreground grid place-items-center text-xs font-semibold uppercase">
                        {{ $userInitials }}
                    </div>
                    <div class="min-w-0 flex-1 text-left">
                        <div class="text-xs font-medium truncate">{{ Auth::user()->name }}</div>
                        <div class="text-[11px] text-muted-foreground truncate">{{ Auth::user()->email }}</div>
                    </div>
                    <i data-lucide="chevron-up" class="h-3 w-3 text-muted-foreground"></i>
                </button>
                <div id="adminAvatarDropdown" class="absolute bottom-full left-0 right-0 mb-2 bg-white border border-border rounded-md shadow-lg py-1 hidden z-50">
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
    <header class="fixed top-0 left-0 md:left-[240px] right-0 h-16 z-30 flex items-center gap-2 border-b border-border bg-background/95 backdrop-blur px-3 md:px-4 justify-between">
        <div class="flex items-center gap-2 min-w-0">
            <!-- Mobile Toggle Button -->
            <button id="mobileSidebarToggle" class="md:hidden h-9 w-9 text-muted-foreground hover:text-foreground hover:bg-accent rounded-xl flex items-center justify-center transition-all">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>

            <!-- Breadcrumbs -->
            <div class="hidden md:flex items-center text-xs text-muted-foreground gap-1 min-w-0">
                <div class="flex items-center gap-1 min-w-0">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-foreground">Home</a>
                    @if(isset($breadcrumbs) && is_array($breadcrumbs))
                        @foreach($breadcrumbs as $bc)
                            <i data-lucide="chevron-right" class="h-3 w-3 shrink-0"></i>
                            @if(isset($bc['route']))
                                <a href="{{ $bc['route'] }}" class="hover:text-foreground truncate">{{ $bc['label'] }}</a>
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

        @php
            $nowTime = now();
            $notifications = \Illuminate\Support\Facades\Cache::remember('admin_header_notifications', 60, function () use ($nowTime) {
                $startingSoon = \App\Models\Event::where('is_published', true)
                    ->where('event_date', '>', $nowTime)
                    ->where('event_date', '<=', $nowTime->copy()->addMinutes(10))
                    ->get();
                $runningEvents = \App\Models\Event::where('is_published', true)
                    ->where('event_date', '<=', $nowTime)
                    ->where('end_date', '>=', $nowTime)
                    ->get();
                return [
                    'startingSoon' => $startingSoon,
                    'runningEvents' => $runningEvents,
                    'count' => $startingSoon->count() + $runningEvents->count()
                ];
            });
            
            $startingSoon = $notifications['startingSoon'];
            $runningEvents = $notifications['runningEvents'];
            $notificationCount = $notifications['count'];
        @endphp
        <div class="flex items-center gap-2 md:gap-3">
            <!-- Semester Badge (Real-time Clock) -->
            <div class="hidden lg:inline-flex items-center gap-1.5 h-11 px-4 rounded-full border border-border text-[12px] font-normal text-muted-foreground">
                <span class="h-1.5 w-1.5 rounded-full bg-primary animate-pulse"></span>
                <span id="dateTimeString"></span>
            </div>

            <!-- Create quick dropdown -->
            <div class="relative">
                <button id="quickCreateBtn" class="flex items-center gap-1.5 h-11 px-5 bg-primary text-primary-foreground hover:bg-primary/95 rounded-xl text-sm font-semibold transition-all">
                    <i data-lucide="plus" class="h-5 w-5"></i> Tạo mới
                    <i data-lucide="chevron-down" class="h-3 w-3 opacity-70"></i>
                </button>
                <div id="quickCreateDropdown" class="absolute right-0 top-full mt-1.5 w-48 bg-white border border-border rounded-md shadow-lg py-1 hidden z-50">
                    <div class="px-2.5 py-1.5 text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">Tạo nhanh</div>
                    <div class="h-px bg-border my-1"></div>
                    <a href="{{ route('admin.events.create') }}" class="flex items-center px-2.5 py-1.5 text-xs text-foreground hover:bg-accent rounded-sm mx-1">Sự kiện mới</a>
                    <a href="{{ route('admin.speakers.create') }}" class="flex items-center px-2.5 py-1.5 text-xs text-foreground hover:bg-accent rounded-sm mx-1">Diễn giả mới</a>
                    <a href="{{ route('admin.media.index') }}" class="flex items-center px-2.5 py-1.5 text-xs text-foreground hover:bg-accent rounded-sm mx-1">Tải lên Media</a>
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
            <a href="{{ route('home') }}" target="_blank" class="h-11 w-11 text-muted-foreground hover:text-foreground hover:bg-accent rounded-xl flex items-center justify-center transition-all" title="Xem trang công khai">
                <i data-lucide="external-link" class="h-5 w-5"></i>
            </a>
        </div>
    </header>

    <!-- Main Content Wrapper -->
    <main class="pt-16 md:pl-[240px] min-h-screen">
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

    <script>
        // Initialize Lucide Icons
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });

        // Sidebar Mobile Toggle
        const sidebar = document.getElementById('sidebar');
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const mobileOverlay = document.getElementById('mobileOverlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            mobileOverlay.classList.remove('hidden');
        }
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        }

        if (mobileSidebarToggle) mobileSidebarToggle.addEventListener('click', openSidebar);
        if (mobileOverlay) mobileOverlay.addEventListener('click', closeSidebar);

        // Quick Create Dropdown Toggle
        const quickCreateBtn = document.getElementById('quickCreateBtn');
        const quickCreateDropdown = document.getElementById('quickCreateDropdown');

        if (quickCreateBtn && quickCreateDropdown) {
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

        if (adminAvatarBtn && adminAvatarDropdown) {
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

        if (notificationBtn && notificationDropdown) {
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
        if (dateTimeString) {
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
            setInterval(updateClock, 1000);
        }
    </script>

    @stack('scripts')
</body>
</html>
