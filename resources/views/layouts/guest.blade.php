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

            {{-- Form container --}}
            <div class="relative z-10 w-full max-w-md mx-4">
                {{ $slot }}
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
