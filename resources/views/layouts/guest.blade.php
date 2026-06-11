<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'FPT Event Maker') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="font-family: 'Be Vietnam Pro', sans-serif;">
        <div class="min-h-screen flex">

            {{-- Left Panel: Branding --}}
            <div class="hidden lg:flex lg:w-1/2 bg-deep-navy flex-col justify-between p-14 relative overflow-hidden">

                {{-- Decorative background circles --}}
                <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-fpt-orange opacity-10"></div>
                <div class="absolute bottom-0 -right-24 w-80 h-80 rounded-full bg-fpt-orange opacity-10"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full border border-white/5"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full border border-white/5"></div>

                {{-- Logo --}}
                <div class="relative z-10">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-fpt-orange flex items-center justify-center shadow-lg">
                            <span class="material-symbols-outlined text-white font-bold" style="font-size:20px">event</span>
                        </div>
                        <span class="text-pure-white font-bold text-xl tracking-tight">FPT Event Maker</span>
                    </a>
                </div>

                {{-- Center content --}}
                <div class="relative z-10 space-y-6">
                    <div class="inline-flex items-center gap-2 bg-white/10 text-fpt-orange px-4 py-1.5 rounded-full text-sm font-medium backdrop-blur-sm border border-fpt-orange/30">
                        <span class="material-symbols-outlined" style="font-size:16px">admin_panel_settings</span>
                        Cổng quản trị dành cho Admin
                    </div>
                    <h1 class="text-pure-white font-extrabold leading-tight" style="font-size: 2.8rem; line-height: 1.15;">
                        Quản lý sự kiện<br>
                        <span class="text-fpt-orange">FPT Polytechnic</span><br>
                        mọi lúc, mọi nơi.
                    </h1>
                    <p class="text-white/60 text-base leading-relaxed max-w-md">
                        Nền tảng quản lý sự kiện tập trung — từ hội thảo, workshop đến các buổi định hướng sinh viên. Tất cả trong một giao diện đơn giản và hiện đại.
                    </p>

                    {{-- Stats --}}
                    <div class="flex gap-8 pt-4">
                        <div>
                            <div class="text-fpt-orange font-extrabold text-2xl">{{ \App\Models\Event::count() }}</div>
                            <div class="text-white/50 text-sm mt-0.5">Sự kiện</div>
                        </div>
                        <div class="w-px bg-white/10"></div>
                        <div>
                            <div class="text-fpt-orange font-extrabold text-2xl">{{ \App\Models\Registration::count() }}</div>
                            <div class="text-white/50 text-sm mt-0.5">Lượt đăng ký</div>
                        </div>
                        <div class="w-px bg-white/10"></div>
                        <div>
                            <div class="text-fpt-orange font-extrabold text-2xl">{{ \App\Models\Event::published()->upcoming()->count() }}</div>
                            <div class="text-white/50 text-sm mt-0.5">Sắp diễn ra</div>
                        </div>
                    </div>
                </div>

                {{-- Footer text --}}
                <div class="relative z-10 text-white/30 text-xs">
                    © {{ date('Y') }} FPT Polytechnic. All rights reserved.
                </div>
            </div>

            {{-- Right Panel: Login Form --}}
            <div class="w-full lg:w-1/2 flex items-center justify-center bg-surface p-8">
                <div class="w-full max-w-md">

                    {{-- Mobile Logo --}}
                    <div class="lg:hidden flex items-center gap-3 mb-10 justify-center">
                        <div class="w-10 h-10 rounded-xl bg-deep-navy flex items-center justify-center shadow-lg">
                            <span class="material-symbols-outlined text-white" style="font-size:20px">event</span>
                        </div>
                        <span class="text-deep-navy font-bold text-xl">FPT Event Maker</span>
                    </div>

                    {{ $slot }}

                    {{-- Back to home link --}}
                    <div class="mt-8 text-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-text-muted hover:text-deep-navy text-sm transition-colors group">
                            <span class="material-symbols-outlined text-sm group-hover:-translate-x-1 transition-transform">arrow_back</span>
                            Quay về trang chủ
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
