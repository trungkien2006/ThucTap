<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UniEvents') }} — Dashboard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="overflow-x-hidden bg-body-bg text-primary font-body">

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden md:hidden transition-opacity"></div>

    <!-- ─── Sidebar ─── -->
    <aside id="sidebar" class="admin-sidebar fixed left-0 top-0 h-full flex flex-col bg-white border-r border-slate-100 w-[260px] z-50 md:translate-x-0 transition-transform duration-300">
        <!-- Logo -->
        <div class="px-6 pt-6 pb-4 border-b border-slate-100">
            <a href="{{ route('admin.events.index') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white font-bold text-lg font-heading">U</div>
                <span class="text-[18px] font-bold text-primary font-heading tracking-tight">
                    UniEvents
                    <span class="text-brand-orange font-normal text-[13px]">| Admin</span>
                </span>
            </a>
        </div>

        <!-- User Info -->
        <div class="px-5 py-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-brand-orange text-white flex items-center justify-center font-bold text-sm uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-[13px] font-semibold text-primary">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-400">Quản trị viên</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
            <p class="uni-section-title px-4 mb-2">Tổng quan</p>
            <a class="sidebar-nav-item {{ request()->routeIs('admin.events.index') || request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Dashboard</span>
            </a>

            <p class="uni-section-title px-4 mt-5 mb-2">Quản lý</p>
            <a class="sidebar-nav-item {{ request()->routeIs('admin.events.create') || request()->routeIs('admin.events.edit') ? 'active' : '' }}" href="{{ route('admin.events.create') }}">
                <span class="material-symbols-outlined text-[20px]">add_circle</span>
                <span>Tạo sự kiện</span>
            </a>
            <a class="sidebar-nav-item {{ request()->routeIs('admin.speakers.*') ? 'active' : '' }}" href="{{ route('admin.speakers.index') }}">
                <span class="material-symbols-outlined text-[20px]">groups</span>
                <span>Diễn giả</span>
            </a>
            <a class="sidebar-nav-item {{ request()->routeIs('admin.media.*') ? 'active' : '' }}" href="{{ route('admin.media.index') }}">
                <span class="material-symbols-outlined text-[20px]">perm_media</span>
                <span>Quản lý Media</span>
            </a>
            <a class="sidebar-nav-item {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}" href="{{ route('admin.documents.index') }}">
                <span class="material-symbols-outlined text-[20px]">description</span>
                <span>Tài liệu</span>
            </a>

            <p class="uni-section-title px-4 mt-5 mb-2">Hệ thống</p>
            <a class="sidebar-nav-item" href="{{ route('home') }}" target="_blank">
                <span class="material-symbols-outlined text-[20px]">visibility</span>
                <span>Xem trang công khai</span>
            </a>
            <a class="sidebar-nav-item" href="#">
                <span class="material-symbols-outlined text-[20px]">settings</span>
                <span>Cài đặt</span>
            </a>
        </nav>

        <!-- Bottom -->
        <div class="px-3 pb-4 space-y-1 border-t border-slate-100 pt-3">
            <a href="{{ route('admin.events.create') }}" class="flex items-center justify-center gap-2 w-full py-2.5 bg-primary hover:bg-slate-800 text-white font-semibold rounded-xl text-[13px] shadow-sm transition-all mb-2">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Sự kiện mới</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="sidebar-nav-item w-full text-left text-red-400 hover:text-red-600 hover:bg-red-50">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    <span>Đăng xuất</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ─── Top Header ─── -->
    <header class="fixed top-0 left-0 md:left-[260px] right-0 h-[60px] z-30 flex items-center justify-between px-5 md:px-8 bg-white border-b border-slate-100 shadow-nav">
        <div class="flex items-center gap-4">
            <!-- Mobile toggle -->
            <button id="openSidebarBtn" class="md:hidden text-slate-500 hover:text-primary p-1.5 rounded-lg hover:bg-slate-50 transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <!-- Mobile logo -->
            <span class="md:hidden text-[16px] font-bold text-primary font-heading">UniEvents</span>
            <!-- Breadcrumb area -->
            <div class="hidden md:block">
                @if(isset($pageTitle))
                    <h2 class="text-[15px] font-bold text-primary font-heading">{{ $pageTitle }}</h2>
                @endif
                @if(isset($pageSubtitle))
                    <p class="text-[12px] text-slate-400">{{ $pageSubtitle }}</p>
                @endif
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all relative">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-brand-orange rounded-full"></span>
            </button>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profileDropdownBtn" class="flex items-center gap-2 px-2 py-1.5 rounded-xl hover:bg-slate-50 transition-all">
                    <div class="w-8 h-8 rounded-lg bg-primary text-white flex items-center justify-center font-bold text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-[13px] font-medium text-primary hidden sm:block">{{ Auth::user()->name }}</span>
                    <span class="material-symbols-outlined text-slate-400 text-[16px]">expand_more</span>
                </button>
                <div id="profileDropdown" class="absolute right-0 top-full mt-1 w-48 bg-white rounded-xl shadow-lg py-1.5 hidden border border-slate-100">
                    <a href="#" class="block px-4 py-2 text-[13px] text-slate-600 hover:bg-slate-50 rounded-lg mx-1">Hồ sơ</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-[13px] text-red-500 hover:bg-red-50 rounded-lg mx-1">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- ─── Main Content ─── -->
    <main class="pt-[60px] md:pl-[260px] min-h-screen">
        <div class="max-w-[1200px] mx-auto px-5 md:px-8 py-8">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-[13px] flex items-center gap-2 animate-fade-in">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-[13px] flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">error</span>
                    {{ session('error') }}
                </div>
            @endif

            @if(isset($header))
                <div class="mb-8">
                    {{ $header }}
                </div>
            @endif

            @yield('content')
            {{ $slot ?? '' }}
        </div>
    </main>

    <script>
        // Sidebar Mobile Toggle
        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('openSidebarBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.add('sidebar-open');
            sidebarOverlay.classList.remove('hidden');
        }
        function closeSidebar() {
            sidebar.classList.remove('sidebar-open');
            sidebarOverlay.classList.add('hidden');
        }

        if (openSidebarBtn) openSidebarBtn.addEventListener('click', openSidebar);
        if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', closeSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

        // Profile Dropdown Toggle
        const profileDropdownBtn = document.getElementById('profileDropdownBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileDropdownBtn) {
            profileDropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
        }
        document.addEventListener('click', (e) => {
            if (profileDropdown && !profileDropdown.contains(e.target) && !profileDropdownBtn.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
