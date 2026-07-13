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
        /* ─── Sidebar ──────────────────────────────────────────────────── */
        :root {
            --sidebar-collapsed-w: 64px;
            --sidebar-expanded-w: 240px;
        }

        /* Desktop: collapsed by default, expand on hover */
        @media (min-width: 768px) {
            #sidebar {
                width: var(--sidebar-collapsed-w) !important;
                transform: translateX(0) !important;
                overflow: hidden;
                background-color: white;
                box-shadow: 1px 0 8px -2px rgba(0,0,0,0.08);
            }
            #sidebar:hover {
                width: var(--sidebar-expanded-w) !important;
                box-shadow: 4px 0 24px -4px rgba(0,0,0,0.12);
            }
            /* Header and main content always offset by collapsed width */
            #topHeader {
                left: var(--sidebar-collapsed-w) !important;
            }
            #mainContent {
                padding-left: var(--sidebar-collapsed-w) !important;
            }
        }

        /* Mobile: hidden by default, shown when toggled */
        @media (max-width: 767px) {
            #sidebar {
                width: var(--sidebar-expanded-w) !important;
                transform: translateX(-100%) !important;
                background-color: white;
            }
            #sidebar.mobile-open {
                transform: translateX(0) !important;
            }
            #topHeader {
                left: 0 !important;
            }
            #mainContent {
                padding-left: 0 !important;
            }
        }

        /* Sidebar base transition */
        #sidebar {
            transition: width 0.22s cubic-bezier(0.4,0,0.2,1), transform 0.22s cubic-bezier(0.4,0,0.2,1), box-shadow 0.22s ease;
        }

        /* Text & labels hidden when collapsed, shown when hovered */
        #sidebar .sidebar-text-element {
            opacity: 0;
            width: 0;
            overflow: hidden;
            white-space: nowrap;
            transition: opacity 0.18s ease, width 0.18s ease;
        }
        #sidebar:hover .sidebar-text-element {
            opacity: 1;
            width: auto;
        }

        /* Section labels */
        #sidebar nav p.sidebar-text-element {
            transition: opacity 0.18s ease;
        }

        /* ─── Sidebar Nav & Buttons ─────────────────────────────────── */

        /* Nav: zero horizontal padding when collapsed */
        #sidebarNav {
            padding: 8px 0 !important;
            transition: padding 0.22s ease;
        }
        #sidebar:hover #sidebarNav {
            padding: 8px 12px !important;
        }

        /* Logo: center when collapsed, left when expanded */
        #sidebarLogo {
            justify-content: center !important;
            padding: 0 0 0 6px !important;
            transition: padding 0.22s ease;
        }
        #sidebar:hover #sidebarLogo {
            justify-content: flex-start !important;
            padding: 0 16px !important;
            gap: 10px !important;
        }

        /* ── Menu button: icon centered via padding math ── */
        /*   sidebar=64px, icon=20px → left pad=(64-20)/2=22px          */
        .sidebar-menu-btn {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 0.75rem;
            width: 100% !important;
            height: 2.75rem;
            /* Center icon: push 22px from left = (64px - 20px) / 2 */
            padding: 0 0 0 22px !important;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--color-sidebar-foreground, #475569);
            border-radius: 0.5rem;
            transition: background-color 0.15s, color 0.15s, padding 0.22s ease;
            white-space: nowrap;
            overflow: hidden;
        }
        /* When expanded: normal left padding */
        #sidebar:hover .sidebar-menu-btn {
            padding: 0 12px !important;
        }
        .sidebar-menu-btn i,
        .sidebar-menu-btn svg {
            flex-shrink: 0;
            min-width: 20px;
        }
        .sidebar-menu-btn.active {
            background-color: var(--sidebar-accent, #eff6ff) !important;
            color: var(--sidebar-primary, #2563eb) !important;
            font-weight: 600;
        }
        .sidebar-menu-btn:hover:not(.active) {
            background-color: var(--sidebar-accent, #f8fafc) !important;
            color: var(--sidebar-accent-foreground, #0f172a) !important;
        }

        /* Footer avatar: center when collapsed */
        #sidebarFooter {
            padding: 8px 0 !important;
            border-top: 1px solid var(--border);
            transition: padding 0.22s ease;
        }
        #sidebar:hover #sidebarFooter {
            padding: 8px 12px !important;
        }
        #adminAvatarBtn {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 8px;
            width: 100% !important;
            /* Center avatar: (64 - 32) / 2 = 16px */
            padding: 6px 0 6px 16px !important;
            border-radius: 0.75rem;
            transition: background-color 0.15s, padding 0.22s ease;
        }
        #sidebar:hover #adminAvatarBtn {
            padding: 6px 8px !important;
        }
        #adminAvatarBtn:hover {
            background-color: rgba(0,0,0,0.04) !important;
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

        /* ─── Lucide Icon Global Fix ──────────────────────────────────── */
        /* Khi Lucide render <i data-lucide> thành <svg>, đảm bảo luôn
           thẳng hàng với text/select xung quanh */
        body.admin-body [data-lucide] svg,
        body.admin-body svg[data-lucide] {
            display: inline-block;
            vertical-align: middle;
            flex-shrink: 0;
        }
    </style>
</head>
<body class="overflow-x-clip bg-background text-foreground font-body admin-body admin-bg-gradient">

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar Wrapper -->
    <aside id="sidebar" class="fixed left-0 top-0 h-full flex flex-col border-r border-border z-50">
        <!-- Sidebar Header -->
        <div class="flex h-16 shrink-0 items-center justify-center gap-2 border-b border-border/40 px-0 transition-all" id="sidebarLogo">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-indigo-500 text-white shadow-md">
                <i data-lucide="graduation-cap" class="h-5 w-5"></i>
            </div>
            <div class="flex flex-col min-w-0 sidebar-text-element text-left">
                <span class="text-[15px] font-bold leading-tight truncate tracking-tight text-slate-900">UniEvents</span>
                <span class="text-[11px] text-muted-foreground leading-tight tracking-wider">Trang quản trị</span>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto scrollbar-hide space-y-4" id="sidebarNav">
            
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
                        <span class="sidebar-text-element">Chuyên ngành</span>
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
        <div id="sidebarFooter">
            <div class="relative">
                <button id="adminAvatarBtn" class="mb-2">
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
    <header id="topHeader" class="fixed top-0 right-0 h-16 z-30 flex items-center gap-2 bg-transparent px-3 md:px-4 justify-between transition-all">
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
        @if(!isset($hideTopMenu) || !$hideTopMenu)
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
        @endif

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
            @if(!isset($hideTopMenu) || !$hideTopMenu)
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
                <button id="notificationBtn" class="h-10 w-10 relative text-muted-foreground hover:text-foreground hover:bg-accent rounded-full flex items-center justify-center transition-all">
                    <i data-lucide="bell" class="h-5 w-5"></i>
                    @if($notificationCount > 0)
                        <span class="absolute top-2 right-2 h-2.5 w-2.5 bg-red-500 border-2 border-background rounded-full"></span>
                    @endif
                </button>
                <div id="notificationDropdown" class="absolute right-0 top-full mt-2 w-80 bg-card border border-border rounded-xl shadow-xl py-1 z-50 overflow-hidden hidden">
                    <div class="px-4 py-3 text-[13px] font-semibold text-foreground flex justify-between items-center bg-muted/30">
                        <span>Thông báo</span>
                        @if($notificationCount > 0)
                            <span class="bg-primary/10 text-primary text-[10px] px-2 py-0.5 rounded-full font-medium">{{ $notificationCount }} mới</span>
                        @endif
                    </div>
                    <div class="max-h-[300px] overflow-y-auto">
                        @if($notificationCount == 0)
                            <div class="p-6 flex flex-col items-center justify-center text-center">
                                <div class="h-10 w-10 rounded-full bg-muted/50 flex items-center justify-center mb-2">
                                    <i data-lucide="bell-off" class="h-4 w-4 text-muted-foreground/60"></i>
                                </div>
                                <span class="text-[12px] text-muted-foreground">Bạn không có thông báo mới.</span>
                            </div>
                        @else
                            @foreach($startingSoon as $evt)
                                @php
                                    $diffMin = max(1, round($nowTime->diffInMinutes($evt->event_date)));
                                @endphp
                                <a href="{{ route('admin.events.show', $evt) }}" class="block p-3.5 hover:bg-muted/50 transition-colors border-t border-border/50 first:border-0 group">
                                    <div class="flex items-start gap-3">
                                        <div class="h-8 w-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-110 transition-transform">
                                            <i data-lucide="clock" class="h-4 w-4"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-[13px] font-medium text-foreground line-clamp-1 group-hover:text-primary transition-colors">{{ $evt->title }}</p>
                                            <p class="text-[11px] text-muted-foreground mt-0.5 flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Bắt đầu sau {{ $diffMin }} phút
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @foreach($runningEvents as $evt)
                                @php
                                    $diffEnd = $nowTime->diffInMinutes($evt->end_date);
                                    $diffEndStr = $diffEnd > 60 ? (round($diffEnd / 60) . ' giờ') : ($diffEnd . ' phút');
                                @endphp
                                <a href="{{ route('admin.events.show', $evt) }}" class="block p-3.5 hover:bg-muted/50 transition-colors border-t border-border/50 first:border-0 group">
                                    <div class="flex items-start gap-3">
                                        <div class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-110 transition-transform">
                                            <i data-lucide="play" class="h-4 w-4"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-[13px] font-medium text-foreground line-clamp-1 group-hover:text-primary transition-colors">{{ $evt->title }}</p>
                                            <p class="text-[11px] text-muted-foreground mt-0.5 flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Đang diễn ra (còn {{ $diffEndStr }})
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Public site link -->
            <a href="{{ route('home') }}" target="_blank" class="h-11 w-11 text-muted-foreground hover:text-foreground hover:bg-accent rounded-xl flex items-center justify-center transition-all" title="Xem trang công khai" wire:navigate>
                <i data-lucide="external-link" class="h-5 w-5"></i>
            </a>
            @endif
        </div>
    </header>

    <!-- Floating Toasts -->
    <div class="fixed top-20 right-6 z-50 flex flex-col gap-2 pointer-events-none" id="toastContainer">
        @if(session('success'))
            <div class="bg-card border-l-4 border-emerald-500 shadow-xl rounded-lg px-4 py-3 flex items-start gap-3 w-80 animate-in slide-in-from-right-8 fade-in pointer-events-auto" id="toast-success">
                <div class="mt-0.5 rounded-full bg-emerald-100 p-1 shrink-0">
                    <i data-lucide="check" class="h-3.5 w-3.5 text-emerald-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-foreground">Thành công</p>
                    <p class="text-xs text-muted-foreground mt-0.5">{{ session('success') }}</p>
                </div>
                <button onclick="document.getElementById('toast-success').remove()" class="text-muted-foreground hover:text-foreground shrink-0"><i data-lucide="x" class="h-4 w-4"></i></button>
            </div>
            <script>setTimeout(() => { const t = document.getElementById('toast-success'); if(t) t.remove(); }, 4000);</script>
        @endif
        @if(session('error'))
            <div class="bg-card border-l-4 border-red-500 shadow-xl rounded-lg px-4 py-3 flex items-start gap-3 w-80 animate-in slide-in-from-right-8 fade-in pointer-events-auto" id="toast-error">
                <div class="mt-0.5 rounded-full bg-red-100 p-1 shrink-0">
                    <i data-lucide="alert-triangle" class="h-3.5 w-3.5 text-red-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-foreground">Lỗi</p>
                    <p class="text-xs text-muted-foreground mt-0.5">{{ session('error') }}</p>
                </div>
                <button onclick="document.getElementById('toast-error').remove()" class="text-muted-foreground hover:text-foreground shrink-0"><i data-lucide="x" class="h-4 w-4"></i></button>
            </div>
            <script>setTimeout(() => { const t = document.getElementById('toast-error'); if(t) t.remove(); }, 6000);</script>
        @endif
    </div>

    <!-- Main Content Wrapper -->
    <main id="mainContent" class="pt-16 min-h-screen transition-all">
        <div class="p-4 md:p-6 lg:p-8 max-w-[1600px] mx-auto">

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
            if(sidebar) sidebar.classList.add('mobile-open');
            if(mobileOverlay) mobileOverlay.classList.remove('hidden');
        }
        function closeSidebar() {
            if(sidebar) sidebar.classList.remove('mobile-open');
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
