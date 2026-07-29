<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #F8F4FA; /* Nền màu hồng tím rất nhạt nhẹ nhàng */
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
        }

        .text-dark-purple { color: #2A1A4A; }
        .text-muted-purple { color: #5A4C78; }

        /* --- CLAYMORPHISM STYLES (Hiệu ứng 3D Đất sét) --- */
        
        /* Ô tìm kiếm (Search Bar) */
        .clay-search {
            background: #FFFFFF;
            border-radius: 9999px;
            box-shadow: 
                6px 6px 14px rgba(212, 203, 224, 0.7),
                -6px -6px 14px rgba(255, 255, 255, 1),
                inset 2px 2px 4px rgba(255, 255, 255, 0.8),
                inset -2px -2px 4px rgba(212, 203, 224, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        /* Nút tròn màu trắng (Notification) */
        .clay-btn-white {
            background: #FFFFFF;
            border-radius: 50%;
            box-shadow: 
                5px 5px 12px rgba(212, 203, 224, 0.8),
                -5px -5px 12px rgba(255, 255, 255, 1),
                inset 2px 2px 3px rgba(255, 255, 255, 0.9),
                inset -2px -2px 3px rgba(212, 203, 224, 0.2);
            border: 2px solid rgba(255,255,255, 0.8);
            transition: all 0.2s ease;
        }
        .clay-btn-white:active {
            box-shadow: 
                inset 3px 3px 6px rgba(212, 203, 224, 0.6),
                inset -3px -3px 6px rgba(255, 255, 255, 1);
        }

        /* Nút tròn màu tím (User Profile) */
        .clay-btn-purple {
            background: #9A7CF4;
            border-radius: 50%;
            box-shadow: 
                5px 5px 12px rgba(212, 203, 224, 0.8),
                -5px -5px 12px rgba(255, 255, 255, 1),
                inset 2px 2px 4px rgba(200, 180, 255, 0.8),
                inset -2px -2px 4px rgba(110, 80, 200, 0.4);
            border: 2px solid rgba(180, 150, 255, 0.5);
        }

        /* Badge thông báo (Màu hồng) */
        .clay-badge {
            background: #FF6884;
            border-radius: 50%;
            box-shadow: 
                2px 2px 4px rgba(255, 104, 132, 0.4),
                inset 1px 1px 2px rgba(255, 150, 170, 0.8),
                inset -1px -1px 2px rgba(200, 50, 80, 0.5);
            border: 2px solid #F8F4FA;
        }

        /* Banner chính (Màu tím nhạt) */
        .clay-card {
            background: #BCA6F0;
            border-radius: 36px;
            box-shadow: 
                15px 15px 30px rgba(190, 180, 210, 0.7),
                -15px -15px 30px rgba(255, 255, 255, 1),
                inset 4px 4px 8px rgba(230, 215, 255, 0.7),
                inset -4px -4px 8px rgba(150, 130, 200, 0.4);
            position: relative;
        }

        /* Nút Play (Màu tím đậm) */
        .clay-btn-play {
            background: #9A7CF4;
            border-radius: 9999px;
            box-shadow: 
                6px 6px 14px rgba(130, 100, 200, 0.4),
                -6px -6px 14px rgba(210, 190, 250, 0.5),
                inset 2px 2px 5px rgba(200, 170, 255, 0.8),
                inset -2px -2px 5px rgba(120, 90, 200, 0.5);
            transition: transform 0.2s;
        }
        .clay-btn-play:hover {
            transform: translateY(-2px);
        }
        .clay-btn-play:active {
            transform: translateY(1px);
            box-shadow: 
                inset 3px 3px 6px rgba(120, 90, 200, 0.6),
                inset -3px -3px 6px rgba(200, 170, 255, 0.8);
        }

        /* Bóng đổ cho ảnh 3D */
        .img-3d {
            filter: drop-shadow(8px 12px 10px rgba(80, 60, 120, 0.25));
        }
    </style>
</head>
<body class="w-full pt-10 px-6 sm:px-12">

    <div class="max-w-[1000px] w-full mx-auto">
        
        <!-- HEADER -->
        <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-6">
            
            <!-- Logo / Title -->
            <div class="flex-shrink-0 w-48">
                <h1 class="text-4xl font-black text-dark-purple tracking-tight">Dashboard</h1>
            </div>
            
            <!-- Search Bar -->
            <div class="w-full max-w-[450px] relative">
                <div class="clay-search flex items-center px-5 py-3 h-[52px] w-full">
                    <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="Search for songs, artists..." class="bg-transparent border-none outline-none w-full text-gray-600 placeholder-gray-400 font-bold text-[15px] focus:ring-0">
                </div>
            </div>

            <!-- Profile & Notifications -->
            <div class="flex items-center space-x-5 flex-shrink-0 w-48 justify-end">
                <!-- Notification Bell -->
                <button class="clay-btn-white w-14 h-14 flex items-center justify-center relative cursor-pointer">
                    <svg class="w-7 h-7 text-[#7A5BD1]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                    </svg>
                    <!-- Badge -->
                    <span class="absolute top-0 right-0 clay-badge text-white text-[12px] font-black w-[22px] h-[22px] flex items-center justify-center transform translate-x-1 -translate-y-1">3</span>
                </button>
                
                <!-- User Profile -->
                <button class="clay-btn-purple w-14 h-14 flex items-center justify-center cursor-pointer">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </button>
            </div>
            
        </header>

        <!-- MAIN BANNER -->
        <!-- Banner container cao khoảng 260px trên PC, chỉnh linh hoạt trên Mobile -->
        <div class="clay-card w-full min-h-[300px] md:h-[260px] overflow-visible flex flex-col md:flex-row items-center px-8 md:px-12 mt-12 relative z-10 pb-8 md:pb-0 pt-32 md:pt-0">
            
            <!-- Ảnh 3D Cô Gái (Căn lề trái, trồi lên trên nền một chút) -->
            <div class="absolute left-0 md:left-4 bottom-0 w-[240px] md:w-[280px] z-20 pointer-events-none origin-bottom translate-y-[2px]">
                <!-- Sử dụng link ảnh mẫu 3D trong suốt -->
                <img src="https://static.vecteezy.com/system/resources/previews/024/785/844/original/3d-cute-girl-listening-to-music-with-headphones-transparent-background-free-png.png" alt="3D Girl with headphones" class="w-full h-auto img-3d object-contain">
            </div>

            <!-- Nốt nhạc bay lơ lửng -->
            <div class="hidden md:block absolute left-[260px] top-12 w-10 h-10 text-[#FF8FB3]" style="filter: drop-shadow(2px 4px 6px rgba(200, 100, 130, 0.4)); transform: rotate(-10deg);">
                <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
            </div>
            <div class="hidden md:block absolute left-[280px] bottom-16 w-8 h-8 text-[#FF8FB3]" style="filter: drop-shadow(2px 4px 6px rgba(200, 100, 130, 0.4)); transform: rotate(15deg);">
                <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
            </div>

            <!-- Nội dung chữ và Nút Play -->
            <div class="md:ml-[310px] flex flex-col items-center md:items-start z-30 text-center md:text-left w-full mt-auto md:mt-0">
                <h2 class="text-3xl md:text-[32px] font-black text-dark-purple mb-2 flex items-center justify-center md:justify-start tracking-tight">
                    Good Morning, Mia! 
                    <span class="ml-2 text-yellow-400 text-3xl filter drop-shadow-sm">☀️</span>
                </h2>
                <p class="text-muted-purple text-lg font-bold mb-6 max-w-sm">
                    Let's enjoy some music today!
                </p>
                
                <!-- Nút Play -->
                <button class="clay-btn-play flex items-center px-8 py-3 text-white font-bold text-[17px] cursor-pointer">
                    <svg class="w-5 h-5 mr-2.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Play Something
                </button>
            </div>

            <!-- Ảnh 3D Chậu cây (Căn lề phải) -->
            <div class="absolute right-0 md:right-8 bottom-0 w-32 md:w-44 z-20 pointer-events-none translate-y-[2px]">
                <img src="https://static.vecteezy.com/system/resources/previews/022/242/726/original/3d-rendering-potted-plant-on-transparent-background-png.png" alt="3D Potted Plant" class="w-full h-auto img-3d object-contain">
            </div>

        </div>
    </div>

</body>
</html>
