{{--
    Hero Slider Component — Globe Express style
    Adapted for Laravel school event platform

    Usage in a Laravel view:
    @include('components.hero-slider', ['slides' => $slides])

    Or as a Blade component:
    <x-hero-slider :slides="$slides" />

    $slides = [
        [
            'id'          => 1,
            'eyebrow'     => 'Switzerland Alps',
            'title'       => 'Saint Antönien',
            'description' => 'Mô tả ngắn về sự kiện hoặc địa điểm này...',
            'image'       => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1600&q=80',
            'tag'         => 'Workshop',
            'cta_label'   => 'Khám phá',
            'cta_url'     => '#',
        ],
        ...
    ]
--}}

@props([
    'slides' => [
        [
            'id'          => 1,
            'eyebrow'     => 'Hội trường A — Cơ sở chính',
            'title'       => 'Lễ Khai Giảng Năm Học 2025',
            'description' => 'Sự kiện khai mạc năm học mới, chào đón toàn thể sinh viên khoá K2025 cùng quý thầy cô và đại biểu khách mời.',
            'image'       => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1600&q=80',
            'tag'         => 'Lễ khai giảng',
            'cta_label'   => 'Xem chi tiết',
            'cta_url'     => '#',
        ],
        [
            'id'          => 2,
            'eyebrow'     => 'Khoa Công nghệ Thông tin',
            'title'       => 'Workshop AI & Machine Learning',
            'description' => 'Buổi thực hành chuyên sâu về trí tuệ nhân tạo với các chuyên gia từ Google và Anthropic, dành cho sinh viên năm 3 & 4.',
            'image'       => 'https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=1600&q=80',
            'tag'         => 'Workshop',
            'cta_label'   => 'Đăng ký ngay',
            'cta_url'     => '#',
        ],
        [
            'id'          => 3,
            'eyebrow'     => 'Sân khấu ngoài trời — Khu B',
            'title'       => 'Talkshow Khởi Nghiệp Sinh Viên',
            'description' => 'Gặp gỡ và lắng nghe hành trình của các founder startup từ 22 tuổi đã gọi vốn thành công tại thị trường Đông Nam Á.',
            'image'       => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
            'tag'         => 'Talkshow',
            'cta_label'   => 'Xem lịch trình',
            'cta_url'     => '#',
        ],
        [
            'id'          => 4,
            'eyebrow'     => 'Phòng hội thảo B2.01',
            'title'       => 'Seminar Nghiên Cứu Khoa Học',
            'description' => 'Hội thảo nghiên cứu khoa học sinh viên cấp trường — nơi các đề tài xuất sắc được trình bày và trao giải thưởng.',
            'image'       => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=1600&q=80',
            'tag'         => 'Seminar',
            'cta_label'   => 'Nộp bài tham dự',
            'cta_url'     => '#',
        ],
        [
            'id'          => 5,
            'eyebrow'     => 'Toàn trường — Tất cả cơ sở',
            'title'       => 'Cuộc Thi Lập Trình 24H',
            'description' => 'Hackathon xuyên đêm với chủ đề "EdTech for Tomorrow" — đăng ký nhóm 3–4 người, giải thưởng tổng lên đến 50 triệu đồng.',
            'image'       => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=1600&q=80',
            'tag'         => 'Cuộc thi',
            'cta_label'   => 'Đăng ký đội',
            'cta_url'     => '#',
        ],
    ]
])

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sự Kiện Trường Học</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;700;900&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold: #D4A847;
            --gold-dim: rgba(212,168,71,0.3);
            --white: #ffffff;
            --white-70: rgba(255,255,255,0.7);
            --white-40: rgba(255,255,255,0.4);
            --white-15: rgba(255,255,255,0.15);
            --white-08: rgba(255,255,255,0.08);
            --black-60: rgba(0,0,0,0.6);
            --black-30: rgba(0,0,0,0.3);
            --transition-bg: 900ms cubic-bezier(0.4,0,0.2,1);
            --transition-fast: 350ms cubic-bezier(0.4,0,0.2,1);
        }

        html, body {
            height: 100%;
            overflow: hidden;
            background: #111;
            font-family: 'Inter', sans-serif;
        }

        /* ─── WRAPPER ─────────────────────────────── */
        .slider-wrapper {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        /* ─── BACKGROUND LAYERS ────────────────────── */
        .bg-layer {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: opacity var(--transition-bg);
            will-change: opacity, transform;
        }
        .bg-layer.active {
            opacity: 1;
            animation: kenBurns 12s ease-in-out infinite alternate;
        }
        .bg-layer.leaving {
            opacity: 0;
            transition: opacity 900ms ease;
        }
        .bg-layer.idle {
            opacity: 0;
        }
        @keyframes kenBurns {
            from { transform: scale(1); }
            to   { transform: scale(1.06); }
        }

        /* ─── OVERLAY GRADIENT ─────────────────────── */
        .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                100deg,
                rgba(0,0,0,0.72) 0%,
                rgba(0,0,0,0.35) 55%,
                rgba(0,0,0,0.15) 100%
            );
            z-index: 1;
        }

        /* ─── NAVBAR ───────────────────────────────── */
        nav {
            position: absolute;
            top: 0; left: 0; right: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 48px;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--white);
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
        }
        .nav-brand svg {
            width: 20px; height: 20px;
            stroke: var(--white-70);
        }
        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }
        .nav-links a {
            color: var(--white-70);
            text-decoration: none;
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 400;
            transition: color var(--transition-fast);
            position: relative;
        }
        .nav-links a.active { color: var(--white); }
        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0; right: 0;
            height: 1.5px;
            background: var(--gold);
        }
        .nav-links a:hover { color: var(--white); }
        .nav-actions {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .nav-actions button {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--white-70);
            transition: color var(--transition-fast);
        }
        .nav-actions button:hover { color: var(--white); }
        .nav-actions svg { width: 18px; height: 18px; }

        /* ─── MAIN CONTENT ─────────────────────────── */
        .content {
            position: absolute;
            inset: 0;
            z-index: 5;
            display: flex;
            align-items: center;
            padding: 0 48px;
        }

        /* ─── LEFT: SLIDE INFO ─────────────────────── */
        .slide-info {
            flex: 0 0 400px;
            padding-top: 80px;
        }
        .slide-eyebrow {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--white-70);
            font-size: 13px;
            letter-spacing: 1px;
            margin-bottom: 16px;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 500ms ease 100ms, transform 500ms ease 100ms;
        }
        .slide-eyebrow::before {
            content: '';
            width: 28px;
            height: 1.5px;
            background: var(--gold);
            flex-shrink: 0;
        }
        .slide-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 900;
            font-size: clamp(52px, 6vw, 82px);
            line-height: 0.95;
            color: var(--white);
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 550ms ease 200ms, transform 550ms ease 200ms;
        }
        .slide-desc {
            color: var(--white-70);
            font-size: 14px;
            line-height: 1.65;
            max-width: 340px;
            margin-bottom: 32px;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 500ms ease 320ms, transform 500ms ease 320ms;
        }
        .slide-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 500ms ease 420ms, transform 500ms ease 420ms;
        }
        .btn-play {
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 1.5px solid var(--gold);
            background: var(--gold-dim);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background var(--transition-fast), transform var(--transition-fast);
        }
        .btn-play:hover { background: var(--gold); transform: scale(1.08); }
        .btn-play svg { width: 14px; height: 14px; fill: var(--white); margin-left: 2px; }
        .btn-cta {
            background: none;
            border: 1.5px solid var(--white-40);
            color: var(--white);
            padding: 11px 24px;
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 2px;
            transition: border-color var(--transition-fast), background var(--transition-fast);
            text-decoration: none;
            display: inline-block;
        }
        .btn-cta:hover {
            border-color: var(--gold);
            background: var(--gold-dim);
        }

        /* Animate-in state */
        .slide-info.is-active .slide-eyebrow,
        .slide-info.is-active .slide-title,
        .slide-info.is-active .slide-desc,
        .slide-info.is-active .slide-actions {
            opacity: 1;
            transform: translateY(0);
        }

        /* ─── RIGHT: CARD STRIP ────────────────────── */
        .card-strip {
            position: absolute;
            right: 0;
            top: 0; bottom: 0;
            width: 480px;
            display: flex;
            align-items: center;
            padding: 90px 48px 100px 0;
            gap: 14px;
            overflow: hidden;
        }
        .card-track {
            display: flex;
            gap: 14px;
            transition: transform 600ms cubic-bezier(0.4,0,0.2,1);
            will-change: transform;
        }

        .dest-card {
            flex: 0 0 130px;
            height: 260px;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            transition: flex-basis 550ms cubic-bezier(0.4,0,0.2,1),
                        box-shadow 350ms ease,
                        transform 350ms ease;
            will-change: flex-basis, transform;
        }
        .dest-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }
        .dest-card.active {
            flex: 0 0 172px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.55);
        }
        .dest-card img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 500ms ease;
        }
        .dest-card:hover img { transform: scale(1.05); }
        .dest-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.82) 0%, rgba(0,0,0,0.1) 55%, transparent 100%);
        }
        .dest-card-info {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 14px 14px 16px;
        }
        .dest-card-tag {
            font-size: 9px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 5px;
            font-weight: 500;
        }
        .dest-card-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 1.15;
            color: var(--white);
            text-transform: uppercase;
        }
        /* Active border indicator */
        .dest-card.active::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gold);
            border-radius: 0 0 16px 16px;
        }

        /* ─── BOTTOM BAR ───────────────────────────── */
        .bottom-bar {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            padding: 0 48px 32px;
            gap: 24px;
        }

        /* nav arrows */
        .nav-arrows {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }
        .nav-btn {
            width: 40px; height: 40px;
            border-radius: 50%;
            border: 1px solid var(--white-40);
            background: var(--white-08);
            backdrop-filter: blur(8px);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color var(--transition-fast), background var(--transition-fast), transform var(--transition-fast);
        }
        .nav-btn:hover {
            border-color: var(--gold);
            background: var(--gold-dim);
            transform: scale(1.08);
        }
        .nav-btn svg {
            width: 14px; height: 14px;
            stroke: var(--white);
        }

        /* progress bar */
        .progress-track {
            flex: 1;
            height: 1.5px;
            background: var(--white-15);
            border-radius: 2px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: var(--gold);
            border-radius: 2px;
            transition: width 800ms cubic-bezier(0.4,0,0.2,1);
        }

        /* counter */
        .slide-counter {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--white-40);
            letter-spacing: 2px;
            flex-shrink: 0;
            width: 40px;
            text-align: right;
            transition: color var(--transition-fast);
        }
    </style>
</head>
<body>

<div class="slider-wrapper" id="slider">

    {{-- Background layers --}}
    <div class="bg-layers" id="bgLayers">
        @foreach($slides as $i => $slide)
        <div
            class="bg-layer {{ $i === 0 ? 'active' : 'idle' }}"
            data-index="{{ $i }}"
            style="background-image: url('{{ $slide['image'] }}')"
        ></div>
        @endforeach
    </div>

    {{-- Dark overlay --}}
    <div class="overlay"></div>

    {{-- Navbar --}}
    <nav>
        <div class="nav-brand">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5">
                <circle cx="12" cy="12" r="9"/>
                <path d="M3 12h18M12 3c-2.5 3-4 5.5-4 9s1.5 6 4 9M12 3c2.5 3 4 5.5 4 9s-1.5 6-4 9" stroke-linecap="round"/>
            </svg>
            Sự Kiện Trường
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active">Trang chủ</a></li>
            <li><a href="#">Sự kiện</a></li>
            <li><a href="#">Địa điểm</a></li>
            <li><a href="#">Lịch trình</a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
        <div class="nav-actions">
            <button aria-label="Tìm kiếm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="10.5" cy="10.5" r="6.5"/><path d="M15.5 15.5L20 20" stroke-linecap="round"/>
                </svg>
            </button>
            <button aria-label="Tài khoản">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Main content --}}
    <div class="content">

        {{-- Left: slide info --}}
        <div class="slide-info is-active" id="slideInfo">
            <div class="slide-eyebrow" id="slideEyebrow">{{ $slides[0]['eyebrow'] }}</div>
            <h1 class="slide-title" id="slideTitle">{{ $slides[0]['title'] }}</h1>
            <p class="slide-desc" id="slideDesc">{{ $slides[0]['description'] }}</p>
            <div class="slide-actions">
                <button class="btn-play" aria-label="Xem video">
                    <svg viewBox="0 0 16 16"><polygon points="3,1 13,8 3,15"/></svg>
                </button>
                <a href="{{ $slides[0]['cta_url'] }}" class="btn-cta" id="slideCta">
                    {{ $slides[0]['cta_label'] }}
                </a>
            </div>
        </div>

        {{-- Right: card strip --}}
        <div class="card-strip" id="cardStrip">
            <div class="card-track" id="cardTrack">
                @foreach($slides as $i => $slide)
                <div
                    class="dest-card {{ $i === 0 ? 'active' : '' }}"
                    data-index="{{ $i }}"
                    onclick="goToSlide({{ $i }})"
                    role="button"
                    tabindex="0"
                    aria-label="Xem sự kiện: {{ $slide['title'] }}"
                >
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" loading="lazy">
                    <div class="dest-card-overlay"></div>
                    <div class="dest-card-info">
                        <div class="dest-card-tag">{{ $slide['tag'] }}</div>
                        <div class="dest-card-name">{{ $slide['title'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- Bottom bar --}}
    <div class="bottom-bar">
        <div class="nav-arrows">
            <button class="nav-btn" id="btnPrev" aria-label="Trước">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                    <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="nav-btn" id="btnNext" aria-label="Tiếp theo">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                    <path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="progress-track">
            <div class="progress-fill" id="progressFill" style="width: 20%"></div>
        </div>
        <div class="slide-counter" id="slideCounter">01</div>
    </div>

</div>

<script>
(function () {
    const slides = @json($slides);
    const total  = slides.length;

    let current  = 0;
    let isAnim   = false;
    let autoTimer;

    const bgLayers    = document.querySelectorAll('.bg-layer');
    const cards       = document.querySelectorAll('.dest-card');
    const cardTrack   = document.getElementById('cardTrack');
    const slideInfo   = document.getElementById('slideInfo');
    const slideEyebrow = document.getElementById('slideEyebrow');
    const slideTitle  = document.getElementById('slideTitle');
    const slideDesc   = document.getElementById('slideDesc');
    const slideCta    = document.getElementById('slideCta');
    const progressFill = document.getElementById('progressFill');
    const slideCounter = document.getElementById('slideCounter');

    function goToSlide(index) {
        if (isAnim || index === current) return;
        isAnim = true;
        clearTimeout(autoTimer);

        const prev = current;
        current = index;

        // ── Background crossfade
        bgLayers[prev].classList.remove('active');
        bgLayers[prev].classList.add('leaving');
        bgLayers[current].classList.remove('idle', 'leaving');
        bgLayers[current].classList.add('active');

        setTimeout(() => {
            bgLayers[prev].classList.remove('leaving');
            bgLayers[prev].classList.add('idle');
        }, 950);

        // ── Text swap with exit/enter animation
        slideInfo.classList.remove('is-active');
        setTimeout(() => {
            slideEyebrow.textContent = slides[current].eyebrow;
            slideTitle.textContent   = slides[current].title;
            slideDesc.textContent    = slides[current].description;
            slideCta.textContent     = slides[current].cta_label;
            slideCta.href            = slides[current].cta_url;
            slideInfo.classList.add('is-active');
        }, 300);

        // ── Cards: update active
        cards.forEach((card, i) => {
            card.classList.toggle('active', i === current);
        });

        // ── Card track offset: keep active card visible
        updateCardOffset();

        // ── Progress bar
        progressFill.style.width = ((current + 1) / total * 100) + '%';

        // ── Counter
        slideCounter.textContent = String(current + 1).padStart(2, '0');

        setTimeout(() => { isAnim = false; }, 700);
        scheduleAuto();
    }

    function updateCardOffset() {
        const cardWidth  = 130;
        const gapWidth   = 14;
        const stripWidth = 480;
        const visibleCards = Math.floor((stripWidth - 48) / (cardWidth + gapWidth));
        let offset = 0;
        if (current >= visibleCards - 1) {
            offset = (current - visibleCards + 2) * (cardWidth + gapWidth);
        }
        cardTrack.style.transform = `translateX(-${offset}px)`;
    }

    function next() { goToSlide((current + 1) % total); }
    function prev() { goToSlide((current - 1 + total) % total); }

    function scheduleAuto() {
        clearTimeout(autoTimer);
        autoTimer = setTimeout(next, 5000);
    }

    // ── Keyboard nav
    function handleKey(e) {
        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') next();
        if (e.key === 'ArrowLeft'  || e.key === 'ArrowUp')   prev();
    }

    document.getElementById('btnNext').addEventListener('click', next);
    document.getElementById('btnPrev').addEventListener('click', prev);
    document.addEventListener('keydown', handleKey);

    // Cards keyboard
    cards.forEach(card => {
        card.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                goToSlide(parseInt(card.dataset.index));
            }
        });
    });

    // Pause on hover
    document.getElementById('slider').addEventListener('mouseenter', () => clearTimeout(autoTimer));
    document.getElementById('slider').addEventListener('mouseleave', scheduleAuto);

    // Start
    scheduleAuto();
})();
</script>

</body>
</html>
