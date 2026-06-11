<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FPT Event Maker') }} - Dashboard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(224, 224, 224, 0.5);
        }
        /* Mobile sidebar hidden by default, shown via toggle class */
        @media (max-width: 767px) {
            .sidebar-open { transform: translateX(0); }
            .sidebar-closed { transform: translateX(-100%); }
        }
    </style>
</head>
<body class="overflow-x-hidden font-body-md text-on-background bg-surface-gray selection:bg-fpt-orange selection:text-white">

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden transition-opacity"></div>

    <!-- SideNavBar Integration -->
    <aside id="sidebar" class="fixed left-0 top-0 h-full flex flex-col py-base bg-surface border-r border-outline-variant w-64 z-50 md:translate-x-0 sidebar-closed transition-transform duration-300">
        <div class="px-6 mb-8 flex justify-between items-center">
            <div>
                <a href="{{ route('home') }}" class="font-headline-md text-headline-md text-deep-navy font-bold block">FPT Polytechnic</a>
                <p class="font-label-lg text-label-lg text-text-muted">Event Management</p>
            </div>
            <button id="closeSidebarBtn" class="md:hidden text-text-muted hover:text-deep-navy p-1">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="flex-1 space-y-1 px-3">
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') || request()->routeIs('admin.events.index') ? 'text-primary font-bold border-r-4 border-primary bg-primary-fixed/30' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all duration-150" href="{{ route('admin.events.index') }}">
                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                <span class="font-label-lg text-label-lg">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.create') ? 'text-primary font-bold border-r-4 border-primary bg-primary-fixed/30' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all duration-150" href="{{ route('admin.events.create') }}">
                <span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
                <span class="font-label-lg text-label-lg">Event Creator</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container transition-all duration-150" href="{{ route('home') }}" target="_blank">
                <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                <span class="font-label-lg text-label-lg">Live Preview</span>
            </a>
        </nav>
        <div class="px-4 mb-4">
            <a href="{{ route('admin.events.create') }}" class="w-full flex items-center justify-center gap-2 bg-fpt-orange text-pure-white font-bold py-3 px-4 rounded-lg hover:brightness-110 active:scale-95 transition-all">
                <span class="material-symbols-outlined">add</span>
                <span>Create New</span>
            </a>
        </div>
        <div class="mt-auto px-3 border-t border-outline-variant pt-4 space-y-1">
            <a class="flex items-center gap-3 px-4 py-2 text-on-surface-variant hover:bg-surface-container transition-all" href="#">
                <span class="material-symbols-outlined" data-icon="person">person</span>
                <span class="font-label-lg text-label-lg">Profile</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-on-surface-variant hover:bg-surface-container transition-all text-left">
                    <span class="material-symbols-outlined" data-icon="logout">logout</span>
                    <span class="font-label-lg text-label-lg">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- TopNavBar Integration -->
    <header class="flex justify-between items-center w-full px-4 md:px-margin-desktop h-16 fixed top-0 z-30 bg-deep-navy shadow-md md:pl-[17rem]">
        <div class="flex items-center gap-4">
            <button id="openSidebarBtn" class="md:hidden text-pure-white hover:bg-white/10 p-2 rounded-lg transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="font-headline-md text-[18px] font-bold text-pure-white block md:hidden">FPT Event Maker</span>
            <div class="hidden md:flex items-center gap-6">
                <a class="text-fpt-orange border-b-2 border-fpt-orange pb-1 font-body-md text-body-md" href="{{ route('admin.events.index') }}">Dashboard</a>
                <a class="text-pure-white/80 hover:text-pure-white transition-colors font-body-md text-body-md" href="{{ route('admin.events.create') }}">New Event</a>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 relative">
                <button class="text-pure-white/80 hover:bg-white/10 p-2 rounded-full transition-colors active:scale-95 duration-200">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                </button>
                
                <!-- Profile Dropdown Toggle -->
                <button id="profileDropdownBtn" class="flex items-center gap-2 focus:outline-none ml-2">
                    <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-fpt-orange bg-fpt-orange text-white flex items-center justify-center font-bold text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-pure-white text-sm hidden sm:block">{{ Auth::user()->name }}</span>
                    <span class="material-symbols-outlined text-pure-white text-sm">expand_more</span>
                </button>

                <!-- Profile Dropdown Menu -->
                <div id="profileDropdown" class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg py-1 hidden border border-outline-variant/30">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="pt-24 pb-12 md:pl-64 min-h-screen">
        <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
            @if(isset($header))
                <div class="mb-8">
                    {{ $header }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm font-body-md flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm font-body-md flex items-center gap-2">
                    <span class="material-symbols-outlined">error</span>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
            {{ $slot ?? '' }}
        </div>
    </main>

    <!-- Footer Integration -->
    <footer class="w-full py-12 px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-gutter bg-surface-container-highest border-t border-outline-variant md:ml-64 relative">
        <div class="flex flex-col gap-2 items-center md:items-start">
            <h4 class="font-label-lg text-label-lg font-bold text-deep-navy uppercase">FPT Polytechnic</h4>
            <div class="font-body-sm text-body-sm text-text-muted mt-2">© {{ date('Y') }} FPT Polytechnic. All rights reserved.</div>
        </div>
        <div class="flex flex-wrap justify-center gap-8 mt-4 md:mt-0">
            <a class="text-text-muted hover:text-deep-navy font-body-sm text-body-sm transition-opacity duration-200" href="#">Contact Us</a>
            <a class="text-text-muted hover:text-deep-navy font-body-sm text-body-sm transition-opacity duration-200" href="#">Support</a>
        </div>
    </footer>

    <script>
        // Sidebar Mobile Toggle
        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('openSidebarBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.remove('sidebar-closed');
            sidebar.classList.add('sidebar-open');
            sidebarOverlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('sidebar-closed');
            sidebar.classList.remove('sidebar-open');
            sidebarOverlay.classList.add('hidden');
        }

        openSidebarBtn.addEventListener('click', openSidebar);
        closeSidebarBtn.addEventListener('click', closeSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);

        // Profile Dropdown Toggle
        const profileDropdownBtn = document.getElementById('profileDropdownBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        profileDropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!profileDropdown.contains(e.target) && !profileDropdownBtn.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
