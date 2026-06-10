<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FPT Event Maker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-surface text-on-surface overflow-x-hidden">

    <!-- TopNavBar -->
    <nav class="flex justify-between items-center w-full px-4 md:px-margin-desktop h-16 fixed top-0 z-50 bg-deep-navy shadow-md">
        <div class="flex items-center gap-base">
            <!-- Mobile Menu Toggle Button -->
            <button id="publicMobileMenuBtn" class="md:hidden text-pure-white p-2 hover:bg-white/10 rounded-lg transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <a href="{{ route('home') }}" class="font-headline-md text-headline-md font-bold text-pure-white">FPT Event Maker</a>
        </div>
        <div class="hidden md:flex items-center gap-gutter">
            @auth
            <a class="font-body-md text-body-md text-pure-white/80 hover:text-pure-white transition-colors active:scale-95 duration-200" href="{{ route('admin.events.index') }}">Dashboard</a>
            @else
            <a class="font-body-md text-body-md text-pure-white/80 hover:text-pure-white transition-colors active:scale-95 duration-200" href="{{ route('login') }}">Login</a>
            @endauth
            <a class="{{ request()->routeIs('home') ? 'text-fpt-orange border-b-2 border-fpt-orange pb-1' : 'text-pure-white/80 hover:text-pure-white' }} font-body-md text-body-md transition-colors active:scale-95 duration-200" href="{{ route('home') }}">All Events</a>
        </div>
        <div class="flex items-center gap-4 md:gap-gutter">
            <div class="hidden md:flex relative group">
                <form action="{{ route('home') }}" method="GET">
                    <input name="search" value="{{ request('search') }}" class="bg-white/10 text-pure-white border-none rounded-lg px-4 py-1.5 focus:ring-2 focus:ring-fpt-orange w-64 font-body-sm text-body-sm transition-all group-hover:bg-white/20" placeholder="Search events..." type="text"/>
                    <button type="submit" class="absolute right-3 top-1.5 text-pure-white/60">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>
            @auth
            <div class="flex items-center gap-2 relative">
                <!-- Notifications (Hidden on very small screens) -->
                <button class="hidden sm:block material-symbols-outlined text-pure-white hover:bg-white/10 p-2 rounded-full transition-colors">notifications</button>
                
                <!-- Profile Dropdown Toggle -->
                <button id="publicProfileBtn" class="flex items-center focus:outline-none">
                    <div class="w-8 h-8 rounded-full border-2 border-fpt-orange bg-fpt-orange text-white flex items-center justify-center font-bold text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </button>

                <!-- Profile Dropdown Menu -->
                <div id="publicProfileMenu" class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg py-1 hidden border border-outline-variant/30">
                    <a href="{{ route('admin.events.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </nav>

    <!-- Mobile Navigation Drawer -->
    <div id="publicMobileDrawer" class="fixed inset-y-0 left-0 w-64 bg-deep-navy shadow-xl z-50 transform -translate-x-full transition-transform duration-300 md:hidden flex flex-col">
        <div class="p-6 border-b border-white/10 flex justify-between items-center">
            <span class="font-headline-md text-headline-md font-bold text-pure-white">Menu</span>
            <button id="closePublicMobileBtn" class="text-pure-white/80 hover:text-pure-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 flex flex-col gap-4">
            <!-- Mobile Search -->
            <form action="{{ route('home') }}" method="GET" class="relative mb-4">
                <input name="search" value="{{ request('search') }}" class="bg-white/10 text-pure-white border-none rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-fpt-orange font-body-sm text-body-sm" placeholder="Search events..." type="text"/>
            </form>

            <a class="text-pure-white font-body-md text-body-md flex items-center gap-3" href="{{ route('home') }}">
                <span class="material-symbols-outlined">event</span> All Events
            </a>
            @auth
            <a class="text-pure-white font-body-md text-body-md flex items-center gap-3" href="{{ route('admin.events.index') }}">
                <span class="material-symbols-outlined">dashboard</span> Dashboard
            </a>
            @else
            <a class="text-pure-white font-body-md text-body-md flex items-center gap-3" href="{{ route('login') }}">
                <span class="material-symbols-outlined">login</span> Login
            </a>
            @endauth
        </div>
    </div>
    <!-- Mobile Drawer Overlay -->
    <div id="publicMobileOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden transition-opacity"></div>

    <!-- Main Content -->
    <main class="pt-24 pb-12 px-margin-desktop min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full py-12 px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-gutter bg-surface-container-highest border-t border-outline-variant">
        <div class="flex flex-col gap-4">
            <span class="font-label-lg text-label-lg font-bold text-deep-navy">FPT Polytechnic</span>
            <p class="font-body-sm text-body-sm text-text-muted">© {{ date('Y') }} FPT Polytechnic. All rights reserved.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-gutter">
            <a class="font-body-sm text-body-sm text-text-muted hover:text-deep-navy hover:underline transition-opacity duration-200" href="#">Contact Us</a>
            <a class="font-body-sm text-body-sm text-text-muted hover:text-deep-navy hover:underline transition-opacity duration-200" href="#">Privacy Policy</a>
            <a class="font-body-sm text-body-sm text-text-muted hover:text-deep-navy hover:underline transition-opacity duration-200" href="#">Terms of Service</a>
        </div>
        <div class="flex gap-4">
            <button class="w-8 h-8 rounded-full bg-deep-navy/10 flex items-center justify-center hover:bg-fpt-orange hover:text-white transition-all"><span class="material-symbols-outlined text-sm">face_nod</span></button>
            <button class="w-8 h-8 rounded-full bg-deep-navy/10 flex items-center justify-center hover:bg-fpt-orange hover:text-white transition-all"><span class="material-symbols-outlined text-sm">link</span></button>
            <button class="w-8 h-8 rounded-full bg-deep-navy/10 flex items-center justify-center hover:bg-fpt-orange hover:text-white transition-all"><span class="material-symbols-outlined text-sm">mail</span></button>
        </div>
    </footer>

    <script>
        // Profile Dropdown Logic
        const publicProfileBtn = document.getElementById('publicProfileBtn');
        const publicProfileMenu = document.getElementById('publicProfileMenu');
        
        if (publicProfileBtn && publicProfileMenu) {
            publicProfileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                publicProfileMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!publicProfileMenu.contains(e.target) && !publicProfileBtn.contains(e.target)) {
                    publicProfileMenu.classList.add('hidden');
                }
            });
        }

        // Mobile Drawer Logic
        const publicMobileMenuBtn = document.getElementById('publicMobileMenuBtn');
        const closePublicMobileBtn = document.getElementById('closePublicMobileBtn');
        const publicMobileDrawer = document.getElementById('publicMobileDrawer');
        const publicMobileOverlay = document.getElementById('publicMobileOverlay');

        function openPublicMobileMenu() {
            publicMobileDrawer.classList.remove('-translate-x-full');
            publicMobileOverlay.classList.remove('hidden');
        }

        function closePublicMobileMenu() {
            publicMobileDrawer.classList.add('-translate-x-full');
            publicMobileOverlay.classList.add('hidden');
        }

        if (publicMobileMenuBtn) publicMobileMenuBtn.addEventListener('click', openPublicMobileMenu);
        if (closePublicMobileBtn) closePublicMobileBtn.addEventListener('click', closePublicMobileMenu);
        if (publicMobileOverlay) publicMobileOverlay.addEventListener('click', closePublicMobileMenu);
    </script>

    @stack('scripts')
</body>
</html>
