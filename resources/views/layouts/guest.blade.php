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
    <body class="font-sans antialiased relative" style="font-family: 'Be Vietnam Pro', sans-serif;">
        <!-- Bạn có thể thay đổi đường dẫn ảnh tại đây bằng ảnh FPT campus của bạn (ví dụ: url('/images/fpt-hanam.jpg')) -->
        <div class="min-h-screen flex items-center justify-center relative bg-cover bg-no-repeat" 
             style="background-image: url('{{ asset('bg-hanam.jpg') }}'); background-position: center 80%;">
            
            {{-- Lớp phủ tối nhẹ để làm nổi bật form --}}
            <div class="absolute inset-0 bg-black/20"></div>

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
            
            {{-- Snowflake Container --}}
            <div id="snowflake-container" class="snowflake-container"></div>
            
        </div>

        <style>
            .snowflake-container {
                position: absolute;
                inset: 0;
                overflow: hidden;
                pointer-events: none;
                z-index: 5;
            }
            .snowflake {
                position: absolute;
                top: -10vh;
                border-radius: 50%;
                opacity: 0.8;
                /* Bông tuyết rơi, lắc lư và đổi màu liên tục qua 10 màu */
                animation: fall var(--fd) linear infinite var(--fdel),
                           sway var(--sd) ease-in-out infinite alternate var(--fdel),
                           colorChange 10s linear infinite;
            }
            @keyframes fall {
                0% { transform: translateY(-10vh); }
                100% { transform: translateY(110vh); }
            }
            @keyframes sway {
                0% { margin-left: -20px; }
                100% { margin-left: 20px; }
            }
            @keyframes colorChange {
                0%   { background-color: #ff3b30; box-shadow: 0 0 5px #ff3b30; } /* Đỏ */
                10%  { background-color: #ff9500; box-shadow: 0 0 5px #ff9500; } /* Cam */
                20%  { background-color: #ffcc00; box-shadow: 0 0 5px #ffcc00; } /* Vàng */
                30%  { background-color: #4cd964; box-shadow: 0 0 5px #4cd964; } /* Xanh lá nhạt */
                40%  { background-color: #34c759; box-shadow: 0 0 5px #34c759; } /* Xanh lá đậm */
                50%  { background-color: #5ac8fa; box-shadow: 0 0 5px #5ac8fa; } /* Lục lam */
                60%  { background-color: #007aff; box-shadow: 0 0 5px #007aff; } /* Xanh dương */
                70%  { background-color: #5856d6; box-shadow: 0 0 5px #5856d6; } /* Tím đậm */
                80%  { background-color: #af52de; box-shadow: 0 0 5px #af52de; } /* Tím nhạt */
                90%  { background-color: #ff2d55; box-shadow: 0 0 5px #ff2d55; } /* Hồng */
                100% { background-color: #ff3b30; box-shadow: 0 0 5px #ff3b30; } /* Trở lại Đỏ */
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const container = document.getElementById('snowflake-container');
                if (!container) return;
                
                // Tạo 60 bông tuyết
                for (let i = 0; i < 60; i++) {
                    const snowflake = document.createElement('div');
                    snowflake.className = 'snowflake';
                    
                    // Kích thước ngẫu nhiên (từ 3px đến 8px để nhìn rõ đổi màu)
                    const size = Math.random() * 5 + 3;
                    snowflake.style.width = size + 'px';
                    snowflake.style.height = size + 'px';
                    
                    // Vị trí xuất phát ngẫu nhiên theo chiều ngang
                    snowflake.style.left = Math.random() * 100 + '%';
                    
                    // Sinh giá trị ngẫu nhiên cho animation
                    snowflake.style.setProperty('--fd', (Math.random() * 10 + 5) + 's'); // Thời gian rơi: 5-15s
                    snowflake.style.setProperty('--sd', (Math.random() * 3 + 2) + 's');  // Thời gian lắc lư: 2-5s
                    snowflake.style.setProperty('--fdel', '-' + (Math.random() * 15) + 's'); // Thời gian delay
                    
                    // Delay cho đổi màu để mỗi hạt tuyết có chu kỳ màu lệch nhau
                    snowflake.style.animationDelay = `-${Math.random() * 10}s`;
                    
                    container.appendChild(snowflake);
                }
            });
        </script>
    </body>
</html>
