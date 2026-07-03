@extends('layouts.frontend')

@section('content')

@if($templateId == 1)
{{-- BẢN PREVIEW MẪU 1 (TIÊU CHUẨN) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .tp1-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; color: #0f172a; line-height: 1.6; }
    .tp1-hero { height: 60vh; min-height: 400px; position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-top: 72px; }
    .tp1-hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    .tp1-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15,23,42,0.2), rgba(15,23,42,0.8)); }
    .tp1-hero-content { position: relative; z-index: 10; text-align: center; color: white; padding: 0 20px; max-width: 800px; }
    .tp1-badge { background: #f97316; color: white; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 16px; display: inline-block; }
    .tp1-title { font-size: 48px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .tp1-meta { display: flex; gap: 24px; justify-content: center; font-size: 15px; opacity: 0.9; }
    .tp1-meta-item { display: flex; align-items: center; gap: 8px; }
    
    .tp1-container { max-width: 1140px; margin: 0 auto; padding: 60px 20px; }
    .tp1-card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-bottom: 40px; }
    .tp1-section-title { font-size: 24px; font-weight: 700; color: #0f172a; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; }
    .tp1-section-title::before { content: ''; display: block; width: 4px; height: 24px; background: #f97316; border-radius: 4px; }
    
    .tp1-text { font-size: 16px; color: #475569; margin-bottom: 20px; }
    .tp1-grid { display: grid; gap: 64px; align-items: center; }
    .tp1-grid.left-img { grid-template-columns: 1.8fr 1fr; }
    .tp1-grid.right-img { grid-template-columns: 1fr 1.8fr; }
    .tp1-img { width: 100%; border-radius: 12px; object-fit: cover; aspect-ratio: 4/3; }

    @media (max-width: 768px) {
        .tp1-grid.left-img, .tp1-grid.right-img { grid-template-columns: 1fr; gap: 24px; }
        .tp1-title { font-size: 32px; }
    }
</style>
@endpush

<div class="tp1-wrapper">
    <div class="tp1-hero">
        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1600&q=80" class="tp1-hero-img" alt="Hero">
        <div class="tp1-hero-overlay"></div>
        <div class="tp1-hero-content">
            <span class="tp1-badge">Công nghệ thông tin</span>
            <h1 class="tp1-title">Hội thảo Trí tuệ nhân tạo tương lai</h1>
            <div class="tp1-meta">
                <div class="tp1-meta-item"><span class="material-symbols-outlined">calendar_today</span> 12/10/2026</div>
                <div class="tp1-meta-item"><span class="material-symbols-outlined">location_on</span> Hội trường A</div>
            </div>
        </div>
    </div>
    
    <div class="tp1-container">
        <div class="tp1-card">
            <h2 class="tp1-section-title">Giới thiệu sự kiện</h2>
            <p class="tp1-text">Trí tuệ nhân tạo (AI) đang định hình lại mọi khía cạnh của cuộc sống và công việc. Hội thảo "Trí tuệ nhân tạo tương lai" mang đến góc nhìn sâu sắc về các xu hướng AI đột phá nhất trong thập kỷ tới. Đây là cơ hội để các nhà nghiên cứu, kỹ sư và doanh nghiệp cùng thảo luận về cách AI tạo ra các giá trị bền vững và giải quyết những thách thức toàn cầu.</p>
            <p class="tp1-text">Tham gia cùng chúng tôi để lắng nghe chia sẻ từ các chuyên gia hàng đầu, trải nghiệm các demo công nghệ trực tiếp và mở rộng mạng lưới quan hệ trong một môi trường sáng tạo và chuyên nghiệp.</p>
        </div>
        
        <div class="tp1-card">
            <h2 class="tp1-section-title">Hoạt động nổi bật</h2>
            
            <div class="tp1-grid left-img">
                <div>
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80" class="tp1-img" alt="">
                </div>
                <div>
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">Khai mạc sự kiện</h3>
                    <div class="tp1-text">Chương trình khai mạc với các tiết mục văn nghệ đặc sắc và phát biểu từ ban lãnh đạo.</div>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-orange-50 text-orange-600 rounded-lg text-sm font-medium border border-orange-100">
                            <span class="material-symbols-outlined text-[16px]">download</span> Tài liệu
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg text-sm font-medium border border-slate-200">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span> Liên kết
                        </span>
                    </div>
                </div>
            </div>

            <div class="tp1-grid right-img" style="margin-top: 64px;">
                <div>
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">Workshop chuyên sâu</h3>
                    <div class="tp1-text">Thảo luận cùng các chuyên gia hàng đầu về xu hướng công nghệ mới nhất trong năm 2024.</div>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=800&q=80" class="tp1-img" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

@elseif($templateId == 2)
{{-- BẢN PREVIEW MẪU 2 (GARDEN) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
    /* ─── Template 2: Garden Style ─── */
    /* Override global layout styles within .gw-wrapper */
    body:has(.gw-wrapper) { background-color: #eaecf0 !important; }
    .gw-wrapper { background-color: #eaecf0 !important; color: #3d4438; font-family: 'DM Sans', sans-serif !important; font-weight: 300; overflow-x: hidden; }
    .gw-wrapper h1, .gw-wrapper h2, .gw-wrapper h3, .gw-wrapper h4 { font-family: 'Cormorant Garamond', serif !important; letter-spacing: normal; }
    /* HERO — offsets under fixed site header */
    .gw-hero { position: relative; height: calc(100vh - 72px); min-height: 540px; overflow: hidden; margin-top: 72px; }
    .gw-hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; pointer-events: none; user-select: none; }
    .gw-hero-div { position: absolute; inset: 0; background: linear-gradient(135deg, #3d4438 0%, #5d7a5c 100%); }
    .gw-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(20,24,18,0.28) 0%, rgba(20,24,18,0.08) 50%, rgba(20,24,18,0.38) 100%); }
    .gw-hero-title-block { position: absolute; top: 50%; right: 5%; transform: translateY(-50%); text-align: right; color: #fff; z-index: 2; }
    .gw-hero-eyebrow { font-size: 0.88rem; letter-spacing: 0.3em; text-transform: uppercase; opacity: 0.88; margin-bottom: 10px; font-weight: 300; font-family: 'DM Sans', sans-serif; }
    .gw-hero-name { font-family: 'Cormorant Garamond', serif !important; font-size: clamp(3.64rem, 9.1vw, 7.15rem); font-weight: 600; line-height: 1; letter-spacing: 0.04em; text-transform: uppercase; text-shadow: 0 2px 30px rgba(0,0,0,0.25); color: #fff; }
    .gw-hero-meta { position: absolute; bottom: 36px; left: 36px; color: #fff; z-index: 2; }
    .gw-hero-date { font-size: 0.91rem; letter-spacing: 0.25em; text-transform: uppercase; font-weight: 400; opacity: 0.92; line-height: 2; font-family: 'DM Sans', sans-serif; }
    .gw-hero-location { font-size: 1.1rem; letter-spacing: 0.18em; text-transform: uppercase; font-weight: 500; font-family: 'DM Sans', sans-serif; }
    /* SECTIONS */
    .gw-section { background: #eaecf0; padding: 80px 24px; position: relative; }
    .gw-container { max-width: 860px; margin: 0 auto; }
    .gw-section-title { font-family: 'Cormorant Garamond', serif !important; font-size: clamp(2.6rem, 5.2vw, 3.9rem); font-weight: 400; color: #3d4438; margin-bottom: 8px; line-height: 1.2; }
    .gw-section-subtitle { font-size: 1.14rem; color: #6e7a6a; margin-bottom: 40px; font-weight: 300; }
    /* BOTANICAL */
    .gw-botanical { position: absolute; opacity: 0.18; pointer-events: none; user-select: none; }
    /* CARD */
    .gw-card { background: #f4f4f2 !important; border-radius: 4px; padding: 52px 48px; position: relative; overflow: hidden; text-align: center; box-shadow: 0 4px 40px rgba(0,0,0,0.06); }
    .gw-card-title { font-family: 'Cormorant Garamond', serif !important; font-size: 3.38rem; font-weight: 400; color: #3d4438; margin-bottom: 12px; }
    .gw-card-text { font-size: 1.1rem; color: #6e7a6a; line-height: 1.8; margin-bottom: 36px; font-family: 'DM Sans', sans-serif; }
    .gw-info-group { margin-bottom: 28px; text-align: left; }
    .gw-info-label { font-family: 'Cormorant Garamond', serif !important; font-size: 1.69rem; font-weight: 400; color: #3d4438; margin-bottom: 4px; }
    .gw-info-value { font-size: 1.07rem; color: #6e7a6a; line-height: 1.7; font-weight: 300; font-family: 'DM Sans', sans-serif; }
    .gw-btn { display: inline-block; padding: 13px 40px; background: #5d7a5c; color: #fff !important; font-size: 0.88rem; letter-spacing: 0.2em; text-transform: uppercase; font-weight: 500; text-decoration: none; transition: all 0.3s; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif; }
    .gw-btn:hover { background: #4a6449; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(93,122,92,0.3); }
    /* STORY */
    .gw-story-heading { font-family: 'Cormorant Garamond', serif !important; font-size: clamp(2.34rem, 4.55vw, 3.38rem); font-weight: 400; color: #3d4438; margin-bottom: 12px; }
    .gw-story-body { font-size: 1.14rem; color: #6e7a6a; line-height: 1.9; font-weight: 300; max-width: 640px; font-family: 'DM Sans', sans-serif; }
    .gw-container-lg { max-width: 1080px; margin: 0 auto; }
    
    /* STORY SPLIT SCROLL */
    .gw-story-row { display: flex; flex-direction: column; gap: 32px; margin-bottom: 60px; }
    .gw-story-left { width: 100%; }
    .gw-story-right { width: 100%; }
    .gw-sticky-media { width: 100%; border-radius: 4px; object-fit: cover; }
    
    @media (min-width: 769px) {
        .gw-story-row {
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 0;
            padding-bottom: 80px;
        }
        .gw-story-left {
            width: 45%;
            padding: 15vh 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .gw-story-right {
            width: 45%;
            position: relative;
        }
        .gw-sticky-wrapper {
            position: sticky;
            top: 120px;
        }
        .gw-sticky-media {
            height: calc(100vh - 160px);
            max-height: 640px;
            aspect-ratio: 4/5;
        }
    }
    /* DIVIDER */
    .gw-divider { display: flex; align-items: center; gap: 20px; margin: 12px 0 48px; }
    .gw-divider-line { flex: 1; height: 1px; background: rgba(61,68,56,0.15); }
    .gw-divider-leaf { color: #5d7a5c; opacity: 0.5; font-size: 1.3rem; }
    /* RESPONSIVE */
    @media (max-width: 768px) {
        .gw-hero { height: calc(100svh - 72px); margin-top: 72px; }
        .gw-hero-title-block { right: 5%; left: 5%; text-align: center; }
        .gw-card { padding: 36px 24px; }
    }
    /* ANIMATIONS */
    .gw-fade-in { opacity: 1; transform: translateY(0); }
</style>
@endpush

<div class="gw-wrapper">
    {{-- HERO --}}
    <section class="gw-hero">
        <img class="gw-hero-img" src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&w=1600&q=80" alt="Hero">
        <div class="gw-hero-overlay"></div>
        <div class="gw-hero-title-block">
            <div class="gw-hero-eyebrow">Triển lãm nghệ thuật</div>
            <div class="gw-hero-name">Sắc Màu Mùa Thu</div>
        </div>
        <div class="gw-hero-meta">
            <div class="gw-hero-date">12/10/2026</div>
            <div class="gw-hero-location">Bảo tàng Mỹ thuật</div>
        </div>
    </section>

    {{-- INFO CARD --}}
    <section class="gw-section" id="gw-info" style="padding-top:100px;padding-bottom:60px;overflow:hidden;">
        <div class="gw-botanical" style="left:-40px;top:20px;width:280px;height:420px;">
            <svg viewBox="0 0 280 420" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M80 380 Q60 300 120 240 Q160 200 140 140 Q120 80 180 60" stroke="#3d4438" stroke-width="1.5" fill="none"/>
                <ellipse cx="120" cy="240" rx="38" ry="22" transform="rotate(-30 120 240)" stroke="#3d4438" stroke-width="1" fill="none"/>
                <ellipse cx="140" cy="180" rx="32" ry="18" transform="rotate(20 140 180)" stroke="#3d4438" stroke-width="1" fill="none"/>
                <ellipse cx="155" cy="130" rx="28" ry="16" transform="rotate(-15 155 130)" stroke="#3d4438" stroke-width="1" fill="none"/>
                <ellipse cx="105" cy="300" rx="36" ry="20" transform="rotate(40 105 300)" stroke="#3d4438" stroke-width="1" fill="none"/>
            </svg>
        </div>
        <div class="gw-botanical" style="right:-30px;bottom:10px;width:220px;height:320px;">
            <svg viewBox="0 0 220 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M140 300 Q160 220 100 160 Q60 120 80 60" stroke="#3d4438" stroke-width="1.5" fill="none"/>
                <ellipse cx="100" cy="160" rx="34" ry="20" transform="rotate(25 100 160)" stroke="#3d4438" stroke-width="1" fill="none"/>
                <ellipse cx="115" cy="110" rx="28" ry="16" transform="rotate(-20 115 110)" stroke="#3d4438" stroke-width="1" fill="none"/>
                <ellipse cx="130" cy="220" rx="32" ry="18" transform="rotate(35 130 220)" stroke="#3d4438" stroke-width="1" fill="none"/>
            </svg>
        </div>
        <div class="gw-container">
            <div class="gw-card gw-fade-in">
                <div class="gw-card-title">Lời ngỏ</div>
                <p class="gw-card-text">
                    Mùa thu mang theo những gam màu ấm áp và cảm xúc sâu lắng. Triển lãm "Sắc Màu Mùa Thu" là nơi tôn vinh những tác phẩm hội họa đương đại lấy cảm hứng từ vẻ đẹp của thiên nhiên và con người trong thời khắc giao mùa. Hãy đến và cùng chúng tôi đắm chìm trong không gian nghệ thuật đầy chất thơ.
                </p>
                <div class="gw-info-group">
                    <div class="gw-info-label">Thời gian</div>
                    <div class="gw-info-value">
                        Thứ Bảy, 12/10/2026<br>
                        09:00 - 17:00
                    </div>
                </div>
                <div class="gw-info-group">
                    <div class="gw-info-label">Địa điểm</div>
                    <div class="gw-info-value">Bảo tàng Mỹ thuật</div>
                </div>
                <div style="margin-top:36px;">
                    <a href="#" class="gw-btn">Tham gia ngay</a>
                </div>
            </div>
        </div>
    </section>

    {{-- STORY --}}
    <section class="gw-section" id="gw-story">
        <div class="gw-container-lg">
            <div class="gw-fade-in" style="margin-bottom: 60px; text-align: left; max-width: 45%;">
                <h2 class="gw-story-heading">Hành trình cảm xúc</h2>
                <div class="gw-divider"><div class="gw-divider-line" style="flex: 0 1 60px;"></div><span class="gw-divider-leaf">❧</span><div class="gw-divider-line" style="flex: 1;"></div></div>
            </div>

            <div class="gw-story-split">
                <div class="gw-story-row gw-fade-in">
                    <div class="gw-story-left" style="padding-top: 0;">
                        <div class="gw-story-body">
                            Hơn 50 tác phẩm từ các nghệ sĩ trẻ tài năng được trưng bày theo một mạch cảm xúc xuyên suốt. Từ những bức tranh phong cảnh rực rỡ sắc vàng của lá mùa thu, đến những bức chân dung mang đậm suy tư và tĩnh lặng. Khán giả không chỉ xem tranh mà còn lắng nghe những câu chuyện đằng sau mỗi nét cọ, qua phần giao lưu trực tiếp với các tác giả.
                        </div>
                    </div>
                    <div class="gw-story-right">
                        <div class="gw-sticky-wrapper">
                            <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=800&q=80" class="gw-sticky-media" loading="lazy">
                        </div>
                    </div>
                </div>

                <div class="gw-story-row gw-fade-in">
                    <div class="gw-story-left">
                        <h2 class="gw-story-heading" style="font-size: 2.5rem; margin-bottom: 16px;">Workshop: Nét vẽ mùa thu</h2>
                        <div class="gw-story-body" style="margin-bottom:24px;">
                            Trong khuôn khổ triển lãm, một buổi workshop nghệ thuật sẽ được tổ chức dành cho những ai đam mê hội họa. Bạn sẽ được hướng dẫn các kỹ thuật pha màu và tự tay tạo nên một bức tranh phong cảnh mùa thu cho riêng mình. Dụng cụ sẽ được ban tổ chức chuẩn bị sẵn sàng.
                        </div>
                    </div>
                    <div class="gw-story-right">
                        <div class="gw-sticky-wrapper">
                            <img src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=80" class="gw-sticky-media" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
</div>

@elseif($templateId == 3)
{{-- BẢN PREVIEW MẪU 3 (ACADEMIC) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,600&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
<style>
/* Reset some default layout details to showcase the custom template */
#navbar, .studio-footer {
    display: none !important;
}

:root {
    --navy: #1E3A8A;
    --blue: #2563EB;
    --blue-lt: rgba(37, 99, 235, 0.1);
    --gold: #D97706;
    --gold-lt: #FEF3C7;
    --bg: linear-gradient(135deg, #F0F4FF 0%, #E6EEFF 100%);
    --surface: rgba(255, 255, 255, 0.7);
    --ink: #0F172A;
    --soft: #334155;
    --muted: #64748B;
    --border: rgba(226, 232, 240, 0.8);
}

.t3-body {
    background: var(--bg) !important;
    background-attachment: fixed !important;
    color: var(--ink);
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 14px;
    line-height: 1.6;
    min-height: 100vh;
}

/* NAV */
.t3-nav {
    background: var(--navy);
    padding: 0 48px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
}
.t3-nav-logo {
    color: #fff;
    font-weight: 800;
    font-size: 15px;
    letter-spacing: .05em;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}
.t3-nav-logo span {
    background: var(--blue);
    border-radius: 7px;
    width: 30px;
    height: 30px;
    display: grid;
    place-items: center;
    font-size: 13px;
    color: #fff;
}
.t3-nav-links {
    display: flex;
    gap: 28px;
}
.t3-nav-links a {
    color: rgba(255,255,255,.65);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: color .2s;
}
.t3-nav-links a:hover {
    color: #fff;
}
.t3-nav-cta {
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 18px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s;
}
.t3-nav-cta:hover {
    background: #1e40af;
}

/* HERO */
.t3-hero {
    background: var(--navy);
    padding: 72px 48px 64px;
    position: relative;
    overflow: hidden;
}
.t3-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 80% at 80% 50%, rgba(29,78,216,.4) 0%, transparent 70%);
}
.t3-hero::after {
    content: '';
    position: absolute;
    top: -80px;
    right: -80px;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,.05);
}
.t3-hero-inner {
    position: relative;
    max-width: 800px;
    z-index: 10;
}
.t3-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(29,78,216,.3);
    border: 1px solid rgba(29,78,216,.5);
    border-radius: 999px;
    padding: 5px 14px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: #93C5FD;
    margin-bottom: 20px;
}
.t3-hero-badge span {
    width: 6px;
    height: 6px;
    background: #4ADE80;
    border-radius: 50%;
    display: block;
}
.t3-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(32px, 4vw, 54px);
    font-weight: 700;
    color: #fff;
    line-height: 1.1;
    letter-spacing: -.02em;
    margin-bottom: 16px;
}
.t3-hero h1 em {
    font-style: italic;
    color: #93C5FD;
}
.t3-hero-sub {
    font-size: 15px;
    color: rgba(255,255,255,.6);
    max-width: 620px;
    line-height: 1.7;
    margin-bottom: 32px;
}
.t3-hero-meta {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 36px;
}
.t3-hero-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,.7);
    font-size: 13px;
}
.t3-hero-meta-item svg {
    width: 15px;
    height: 15px;
    color: #93C5FD;
}
.t3-hero-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.t3-btn-primary {
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 12px 24px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: background.15s;
}
.t3-btn-primary:hover {
    background: #1e40af;
}
.t3-btn-outline {
    background: rgba(255,255,255,.1);
    color: #fff;
    border: 1.5px solid rgba(255,255,255,.25);
    border-radius: 10px;
    padding: 12px 24px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all .15s;
}
.t3-btn-outline:hover {
    background: rgba(255,255,255,.18);
}
.t3-hero-stats {
    display: flex;
    gap: 40px;
    padding-top: 36px;
    border-top: 1px solid rgba(255,255,255,.1);
    margin-top: 36px;
    flex-wrap: wrap;
}
.t3-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}
.t3-stat-label {
    font-size: 11px;
    color: rgba(255,255,255,.45);
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-top: 3px;
}

/* COUNTDOWN */
.t3-countdown-bar {
    background: var(--blue);
    padding: 16px 48px;
    display: flex;
    align-items: center;
    gap: 32px;
    justify-content: center;
    flex-wrap: wrap;
}
.t3-cd-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: rgba(255,255,255,.7);
}
.t3-cd-units {
    display: flex;
    gap: 16px;
}
.t3-cd-unit {
    text-align: center;
}
.t3-cd-num {
    background: rgba(0,0,0,.2);
    color: #fff;
    font-size: 22px;
    font-weight: 800;
    border-radius: 8px;
    padding: 6px 14px;
    display: block;
    line-height: 1;
}
.t3-cd-unit-label {
    font-size: 10px;
    color: rgba(255,255,255,.6);
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-top: 4px;
}

/* CONTENT */
.t3-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 48px;
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 48px;
    align-items: start;
}
.t3-section-eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--blue);
    margin-bottom: 10px;
}
.t3-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    letter-spacing: -.01em;
}
.t3-section-body {
    color: var(--soft);
    line-height: 1.8;
    font-size: 14px;
}
.t3-section-body p + p {
    margin-top: 14px;
}

/* SPEAKERS */
.t3-speakers {
    margin-top: 48px;
}
.t3-speaker-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
    margin-top: 20px;
}
.t3-speaker-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: all .2s;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04);
}
.t3-speaker-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    margin: 0 auto 12px;
    display: grid;
    place-items: center;
    font-size: 26px;
    background: var(--blue-lt);
    overflow: hidden;
}
.t3-speaker-name {
    font-size: 14px;
    font-weight: 700;
}
.t3-speaker-role {
    font-size: 12px;
    color: var(--muted);
    margin-top: 2px;
}
.t3-speaker-topic {
    font-size: 11.5px;
    color: var(--blue);
    font-weight: 600;
    margin-top: 8px;
    padding: 4px 10px;
    background: var(--blue-lt);
    border-radius: 999px;
    display: inline-block;
}

/* SCHEDULE */
.t3-schedule {
    margin-top: 48px;
}
.t3-sched-item {
    display: flex;
    gap: 16px;
    padding: 18px 0;
    border-bottom: 1px solid var(--border);
}
.t3-sched-time {
    width: 80px;
    font-size: 12px;
    font-weight: 700;
    color: var(--blue);
    flex-shrink: 0;
    padding-top: 2px;
}
.t3-sched-body {
    flex: 1;
}
.t3-sched-title {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 3px;
}
.t3-sched-speaker {
    font-size: 12px;
    color: var(--muted);
}
.t3-sched-tag {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
    background: var(--gold-lt);
    color: var(--gold);
    margin-top: 6px;
    letter-spacing: .04em;
}

/* SIDEBAR */
.t3-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.t3-sidebar-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04);
}
.t3-sidebar-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: var(--muted);
}
.t3-sidebar-card-body {
    padding: 20px;
}
.t3-info-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.t3-info-item {
    display: flex;
    gap: 10px;
    align-items: flex-start;
}
.t3-info-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: var(--blue-lt);
    display: grid;
    place-items: center;
    flex-shrink: 0;
    font-size: 14px;
}
.t3-info-label {
    font-size: 11px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .06em;
}
.t3-info-value {
    font-size: 13.5px;
    font-weight: 600;
    margin-top: 1px;
}

/* FOOTER */
.t3-footer {
    background: var(--navy);
    color: rgba(255,255,255,.5);
    padding: 32px 48px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    flex-wrap: wrap;
    gap: 16px;
}
.t3-footer strong {
    color: #fff;
}
</style>
@endpush

<div class="t3-body">
    <!-- Navbar -->
    <nav class="t3-nav">
        <a href="#" class="t3-nav-logo">
            <span>U</span> UniEvent
        </a>
        <div class="t3-nav-links">
            <a href="#">Trang chủ</a>
            <a href="#">Sự kiện</a>
            <a href="#">Lưu trữ</a>
        </div>
    </nav>

    <div class="t3-hero" style="background-image: linear-gradient(rgba(30,58,138,0.75), rgba(30,58,138,0.9)), url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1600&q=80'); background-size: cover; background-position: center;">
        <div class="t3-hero-inner">
            <div class="t3-hero-badge">
                <span></span> Công nghệ & Khoa học
            </div>
            <h1>Hội thảo Quốc tế về Trí tuệ Nhân tạo & Tương lai Giáo dục</h1>
            <p class="t3-hero-sub">
                Diễn đàn thảo luận khoa học chuyên sâu về tầm ảnh hưởng của các mô hình ngôn ngữ lớn (LLMs) đối với phương pháp giảng dạy hiện đại và nghiên cứu học thuật.
            </p>
            <div class="t3-hero-meta">
                <div class="t3-hero-meta-item">
                    Thứ Bảy, 12/10/2026
                </div>
                <div class="t3-hero-meta-item">
                    08:30 — 16:30
                </div>
                <div class="t3-hero-meta-item">
                    Hội trường A
                </div>
            </div>
            <div class="t3-hero-actions">
                <a href="#" class="t3-btn-outline">Xem chương trình</a>
            </div>
            <div class="t3-hero-stats">
                <div>
                    <div class="t3-stat-num">3</div>
                    <div class="t3-stat-label">Diễn giả</div>
                </div>
                <div>
                    <div class="t3-stat-num">320+</div>
                    <div class="t3-stat-label">Đại biểu</div>
                </div>
                <div>
                    <div class="t3-stat-num">6</div>
                    <div class="t3-stat-label">Phiên thảo luận</div>
                </div>
                <div>
                    <div class="t3-stat-num">1</div>
                    <div class="t3-stat-label">Ngày</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Countdown -->
    <div class="t3-countdown-bar">
        <div class="t3-cd-label">🕒 Còn lại</div>
        <div class="t3-cd-units">
            <div class="t3-cd-unit"><span class="t3-cd-num">45</span><div class="t3-cd-unit-label">Ngày</div></div>
            <div class="t3-cd-unit"><span class="t3-cd-num">12</span><div class="t3-cd-unit-label">Giờ</div></div>
            <div class="t3-cd-unit"><span class="t3-cd-num">30</span><div class="t3-cd-unit-label">Phút</div></div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="t3-content">
        <div class="t3-main-col">
            <div class="t3-section-eyebrow">Giới thiệu</div>
            <h2 class="t3-section-title">Về hội thảo khoa học</h2>
            <div class="t3-section-body">
                <p>Hội thảo Quốc tế về Trí tuệ Nhân tạo & Tương lai Giáo dục là sự kiện học thuật thường niên nhằm mục đích kết nối các học giả, nhà nghiên cứu và giảng viên từ các trường đại học trong và ngoài nước để cùng chia sẻ kinh nghiệm thực tiễn và những kết quả nghiên cứu mới nhất.</p>
                <p>Năm nay, với chủ đề "AI và Đột phá trong Giáo dục số", hội thảo sẽ tập trung sâu vào cách thức công nghệ generative AI có thể bổ trợ và nâng cao năng lực tự học của sinh viên, đồng thời tối ưu hóa quy trình kiểm tra đánh giá của nhà trường.</p>
            </div>

            <!-- Speakers Section -->
            <div class="t3-speakers">
                <div class="t3-section-eyebrow">Diễn giả</div>
                <h2 class="t3-section-title">Chuyên gia tham dự</h2>
                <div class="t3-speaker-grid">
                    <div class="t3-speaker-card">
                        <div class="t3-speaker-avatar">👨‍🏫</div>
                        <div class="t3-speaker-name">GS. TS. Nguyễn Văn A</div>
                        <div class="t3-speaker-role">Viện trưởng Viện Công nghệ thông tin</div>
                        <div class="t3-speaker-topic">Xu hướng AI trong giáo dục số</div>
                    </div>
                    <div class="t3-speaker-card">
                        <div class="t3-speaker-avatar">👩‍🔬</div>
                        <div class="t3-speaker-name">PGS. TS. Trần Thị B</div>
                        <div class="t3-speaker-role">Trưởng khoa Khoa học Máy tính</div>
                        <div class="t3-speaker-topic">Mô hình ngôn ngữ lớn (LLMs)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="t3-sidebar">
            <div class="t3-sidebar-card">
                <div class="t3-sidebar-card-header">Thông tin chi tiết</div>
                <div class="t3-sidebar-card-body">
                    <div class="t3-info-list">
                        <div class="t3-info-item">
                            <div class="t3-info-icon">📅</div>
                            <div>
                                <div class="t3-info-label">Thời gian</div>
                                <div class="t3-info-value">12/10/2026</div>
                            </div>
                        </div>
                        <div class="t3-info-item">
                            <div class="t3-info-icon">📍</div>
                            <div>
                                <div class="t3-info-label">Địa điểm</div>
                                <div class="t3-info-value">Hội trường A</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Footer -->
    <footer class="t3-footer">
        <div>© 2026 <strong>UniEvent</strong> — Hệ thống quản lý sự kiện trường học</div>
        <div>Được xây dựng với phong cách chuyên nghiệp</div>
    </footer>
</div>

@elseif($templateId == 6)
{{-- BẢN PREVIEW MẪU 6 (SỰ KIỆN TRƯỜNG / HỌC THUẬT) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer { display: none !important; }
:root {
    --school-bg: #F8FAFC;
    --school-primary: #1E3A8A; /* Navy Blue */
    --school-secondary: #3B82F6; /* Bright Blue */
    --school-accent: #F59E0B; /* Gold/Amber */
    --school-text: #1E293B;
    --school-muted: #64748B;
    --school-card: #FFFFFF;
    --school-border: #E2E8F0;
    --container-w: 800px;
}
.w6p-body {
    background: var(--school-bg);
    color: var(--school-text);
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    line-height: 1.6;
    min-height: 100vh;
}
.w6p-container {
    max-width: var(--container-w);
    margin: 0 auto;
    background: var(--school-card);
    min-height: 100vh;
    box-shadow: 0 0 40px rgba(0,0,0,0.05);
    padding-bottom: 60px;
}
.w6p-hero {
    position: relative;
    width: 100%;
    background: var(--school-primary);
    overflow: hidden;
}
.w6p-hero-bg {
    width: 100%;
    height: 350px;
    object-fit: cover;
    opacity: 0.8;
}
.w6p-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, var(--school-primary) 0%, rgba(30,58,138,0.4) 100%);
}
.w6p-hero-content {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 30px 20px;
    text-align: center;
    color: #fff;
    z-index: 10;
}
.w6p-hero-badge {
    display: inline-block;
    background: var(--school-accent);
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 20px;
    margin-bottom: 12px;
    letter-spacing: 1px;
}
.w6p-hero h1 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 32px;
    line-height: 1.2;
    margin-bottom: 16px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.w6p-hero-meta {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    font-size: 13px;
    font-weight: 500;
    color: #e2e8f0;
}
.w6p-hero-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
}
.w6p-cd-bar {
    background: var(--school-secondary);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
    padding: 20px;
}
.w6p-cd-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.w6p-cd-units { display: flex; gap: 15px; }
.w6p-cd-unit { text-align: center; }
.w6p-cd-num {
    display: block;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 24px;
    background: rgba(255,255,255,0.2);
    border-radius: 8px;
    padding: 5px 12px;
    min-width: 50px;
}
.w6p-cd-label { font-size: 11px; text-transform: uppercase; margin-top: 4px; opacity: 0.9; }
.w6p-content-wrap {
    padding: 40px 30px;
}
.w6p-section-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 22px;
    color: var(--school-primary);
    text-align: center;
    margin-bottom: 25px;
    position: relative;
    text-transform: uppercase;
}
.w6p-section-title::after {
    content: '';
    display: block;
    width: 50px;
    height: 4px;
    background: var(--school-accent);
    margin: 10px auto 0;
    border-radius: 2px;
}
.w6p-desc {
    color: var(--school-muted);
    text-align: justify;
    margin-bottom: 40px;
    font-size: 15px;
}
.w6p-gallery {
    display: flex;
    flex-direction: column;
    gap: 25px;
    margin-bottom: 40px;
}
.w6p-gal-card {
    background: #fff;
    border: 1px solid var(--school-border);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}
.w6p-gal-media { width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block; }
.w6p-gal-body { padding: 20px; }
.w6p-gal-caption { font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 18px; color: var(--school-text); margin-bottom: 8px; }
.w6p-gal-text { font-size: 14px; color: var(--school-muted); margin-bottom: 15px; }
.w6p-speakers {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}
.w6p-speaker-card {
    text-align: center;
    padding: 20px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid var(--school-border);
}
.w6p-speaker-img {
    width: 90px; height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--school-secondary);
    margin: 0 auto 15px;
    padding: 3px;
    background: #fff;
}
.w6p-speaker-name { font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 15px; color: var(--school-primary); }
.w6p-speaker-role { font-size: 12px; color: var(--school-muted); margin-top: 4px; }
.w6p-schedule { margin-bottom: 40px; }
.w6p-sch-item {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    background: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    border-left: 4px solid var(--school-accent);
    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}
.w6p-sch-time { font-family: 'Montserrat', sans-serif; font-weight: 700; color: var(--school-primary); min-width: 60px; flex-shrink: 0; }
.w6p-sch-info h4 { font-weight: 600; font-size: 15px; margin: 0 0 4px; }
.w6p-sch-info p { font-size: 13px; color: var(--school-muted); margin: 0; }
.w6p-bottom {
    display: flex;
    justify-content: center;
    gap: 15px;
    padding-top: 20px;
    border-top: 1px solid var(--school-border);
}
.w6p-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    border-radius: 30px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-size: 14px;
    border: none;
}
.w6p-btn-like { background: #fff; color: var(--school-primary); border: 1px solid var(--school-primary); }
.w6p-btn-views { background: #f1f5f9; color: var(--school-muted); }
.w6p-footer { text-align: center; padding: 20px; font-size: 13px; color: var(--school-muted); background: #e2e8f0; }
</style>
@endpush

<div class="w6p-body">
    <div class="w6p-container">
        <div class="w6p-hero">
            <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1600&q=80" class="w6p-hero-bg" alt="Hero">
            <div class="w6p-hero-overlay"></div>
            <div class="w6p-hero-content">
                <div class="w6p-hero-badge">Hội Thảo Khoa Học</div>
                <h1>Kỷ Nguyên Số & Trí Tuệ Nhân Tạo 2026</h1>
                <div class="w6p-hero-meta">
                    <div class="w6p-hero-meta-item">15/10/2026</div>
                    <div class="w6p-hero-meta-item">08:30</div>
                    <div class="w6p-hero-meta-item">Hội trường 1, ĐH XYZ</div>
                </div>
            </div>
        </div>

        <div class="w6p-cd-bar">
            <div class="w6p-cd-title">Sự kiện bắt đầu sau</div>
            <div class="w6p-cd-units">
                <div class="w6p-cd-unit"><span class="w6p-cd-num">15</span><div class="w6p-cd-label">Ngày</div></div>
                <div class="w6p-cd-unit"><span class="w6p-cd-num">08</span><div class="w6p-cd-label">Giờ</div></div>
                <div class="w6p-cd-unit"><span class="w6p-cd-num">45</span><div class="w6p-cd-label">Phút</div></div>
            </div>
        </div>

        <div class="w6p-content-wrap">
            <h2 class="w6p-section-title">Giới Thiệu</h2>
            <div class="w6p-desc">
                Sự kiện thường niên lớn nhất dành cho sinh viên và giảng viên, mang đến những cái nhìn sâu sắc về tương lai của công nghệ và vai trò của AI.
            </div>

            <h2 class="w6p-section-title">Hoạt Động</h2>
            <div class="w6p-gallery">
                <div class="w6p-gal-card">
                    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80" class="w6p-gal-media" alt="">
                    <div class="w6p-gal-body">
                        <h3 class="w6p-gal-caption">Triển lãm Công nghệ</h3>
                        <div class="w6p-gal-text">Khám phá các sản phẩm AI mới nhất.</div>
                    </div>
                </div>
            </div>

            <h2 class="w6p-section-title">Khách Mời</h2>
            <div class="w6p-speakers">
                <div class="w6p-speaker-card">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80" class="w6p-speaker-img" alt="">
                    <div class="w6p-speaker-name">PGS.TS Lê Hữu</div>
                    <div class="w6p-speaker-role">Viện trưởng Viện AI</div>
                </div>
                <div class="w6p-speaker-card">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=200&q=80" class="w6p-speaker-img" alt="">
                    <div class="w6p-speaker-name">ThS. Nguyễn Anh</div>
                    <div class="w6p-speaker-role">CEO TechAsia</div>
                </div>
            </div>

            <h2 class="w6p-section-title">Lịch Trình</h2>
            <div class="w6p-schedule">
                <div class="w6p-sch-item">
                    <div class="w6p-sch-time">08:30</div>
                    <div class="w6p-sch-info">
                        <h4>Đón Khách & Check-in</h4>
                        <p>Khu vực sảnh chính Hội trường</p>
                    </div>
                </div>
            </div>

            <div class="w6p-bottom">
                <div class="w6p-btn w6p-btn-like">
                    <span class="material-symbols-outlined">favorite</span> 150 Thích
                </div>
                <div class="w6p-btn w6p-btn-views">
                    <span class="material-symbols-outlined">visibility</span> 890 Xem
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($templateId == 4)
{{-- BẢN PREVIEW MẪU 4 (CINE LOVE GRADUATION) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer { display: none !important; }
.t4p-body {
    background-color: #FCF9F2 !important;
    color: #2C2520;
    font-family: 'Montserrat', sans-serif;
    line-height: 1.8;
    min-height: 100vh;
    padding-bottom: 60px;
}
.t4p-container {
    max-width: 1000px;
    margin: 0 auto;
    background: #FFFFFF;
    border-left: 1px solid #EADEC9;
    border-right: 1px solid #EADEC9;
    min-height: 100vh;
    box-shadow: 0 0 40px rgba(44, 37, 32, 0.04);
}
.t4p-hero {
    position: relative;
    width: 100%;
    height: 320px;
    overflow: hidden;
}
.t4p-hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t4p-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(44,37,32,0.1), rgba(44,37,32,0.6));
}
.t4p-hero-content {
    position: absolute;
    bottom: 24px;
    left: 0; right: 0;
    text-align: center;
    color: #FFFFFF;
    padding: 0 20px;
}
.t4p-hero-quote {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 12px;
    opacity: 0.95;
    margin-bottom: 8px;
}
.t4p-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 700;
    color: #FEF3C7;
    margin-bottom: 4px;
}
.t4p-hero-subtitle {
    font-size: 11px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    font-weight: 600;
}
.t4p-card {
    padding: 32px 24px;
    text-align: center;
    border-bottom: 1px solid #EADEC9;
    position: relative;
}
.t4p-card::after {
    content: '✦';
    position: absolute;
    bottom: -9px;
    left: 50%;
    transform: translateX(-50%);
    background: #FFFFFF;
    padding: 0 10px;
    color: #D97706;
    font-size: 11px;
}
.t4p-card:last-of-type { border-bottom: none; }
.t4p-card:last-of-type::after { display: none; }
.t4p-sec-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 700;
    color: #D97706;
    margin-bottom: 12px;
    text-transform: uppercase;
}
.t4p-date-highlight {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    color: #D97706;
    margin-bottom: 12px;
    font-weight: 600;
}
.t4p-body-text {
    font-size: 13px;
    color: #2C2520;
    line-height: 1.8;
}
.t4p-info-wrap {
    margin-top: 18px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.t4p-info-item {
    background: #FAF8F2;
    border: 1px solid #EADEC9;
    border-radius: 10px;
    padding: 12px;
}
.t4p-info-label {
    font-size: 10px;
    text-transform: uppercase;
    color: #786F66;
    font-weight: 700;
    margin-bottom: 2px;
}
.t4p-info-val {
    font-size: 13px;
    font-weight: 600;
}
.t4p-countdown {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 18px;
}
.t4p-cd-box {
    background: #FAF8F2;
    border: 1px solid #EADEC9;
    border-radius: 6px;
    padding: 6px;
    min-width: 56px;
}
.t4p-cd-num {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 700;
    color: #D97706;
}
.t4p-cd-label {
    font-size: 8px;
    text-transform: uppercase;
    color: #786F66;
    font-weight: 700;
}
.t4p-timeline {
    margin-top: 18px;
    position: relative;
    padding-left: 20px;
    text-align: left;
}
.t4p-timeline::before {
    content: '';
    position: absolute;
    left: 4px; top: 6px; bottom: 6px;
    width: 1px;
    background: #EADEC9;
}
.t4p-timeline-item {
    position: relative;
    padding-bottom: 18px;
}
.t4p-timeline-item:last-child { padding-bottom: 0; }
.t4p-timeline-dot {
    position: absolute;
    left: -20px; top: 6px;
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #D97706;
    border: 2px solid #FFFFFF;
}
.t4p-timeline-time {
    font-size: 11px;
    font-weight: 700;
    color: #D97706;
}
.t4p-timeline-title {
    font-size: 13px;
}
.t4p-speakers {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-top: 18px;
}
.t4p-speaker {
    background: #FAF8F2;
    border: 1px solid #EADEC9;
    border-radius: 10px;
    padding: 12px;
}
.t4p-speaker-img {
    width: 50px; height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 8px;
    border: 2px solid #EADEC9;
}
.t4p-speaker-name {
    font-size: 12px;
    font-weight: 700;
}
.t4p-speaker-role {
    font-size: 10px;
    color: #786F66;
}
.t4p-input {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #EADEC9;
    background: #FAF8F2;
    border-radius: 8px;
    font-size: 12.5px;
    outline: none;
}
.t4p-btn {
    width: 100%;
    padding: 12px;
    background: #D97706;
    color: #FFFFFF;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
}
.t4p-wishes-list {
    margin-top: 16px;
    text-align: left;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.t4p-wish-item {
    background: #FAF8F2;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 11.5px;
    border-left: 3px solid #D97706;
}
.t4p-wish-meta {
    font-weight: 700;
    color: #D97706;
    margin-bottom: 2px;
}
.t4p-bottom-bar {
    background: #FFFFFF;
    border-top: 1px solid #EADEC9;
    padding: 10px 16px;
    display: flex;
    gap: 10px;
    margin-top: 16px;
}
.t4p-bottom-input {
    flex: 1;
    padding: 8px 14px;
    border: 1px solid #EADEC9;
    background: #FAF8F2;
    border-radius: 16px;
    font-size: 12px;
}
.t4p-heart-btn {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1px solid #EADEC9;
    background: #FAF8F2;
    color: #EF4444;
    display: flex; align-items: center; justify-content: center;
}
</style>
@endpush

<div class="t4p-body">
    <div class="t4p-container">
        <div class="t4p-hero">
            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" alt="Hero">
            <div class="t4p-hero-overlay"></div>
            <div class="t4p-hero-content">
                <div class="t4p-hero-quote">"Vượt núi băng ngàn, tìm đến bình minh. Khởi đầu nơi đây, mở ra muôn ngả chân trời."</div>
                <h1 class="t4p-hero-title">Lễ tốt nghiệp Khóa 2049</h1>
                <div class="t4p-hero-subtitle">Tốt Nghiệp & Tri Ân</div>
            </div>
        </div>

        <div class="t4p-card">
            <div class="t4p-date-highlight">- 2049.06.30 -</div>
            <div class="t4p-body-text" style="font-style: italic;">
                "Rồi chúng ta cũng sẽ hòa vào biển người, mỗi người đều có phong ba và rực rỡ riêng. Chúc cho chặng đường tới, hoa nở như gấm, ngày gặp lại vẫn như xưa."
            </div>
        </div>

        <div class="t4p-card">
            <div class="t4p-sec-title">Trân trọng kính mời</div>
            <div class="t4p-body-text">
                <strong style="color: #D97706;">Kính gửi quý thầy cô và các bạn cựu sinh viên</strong>
                <div class="mt-2">
                    Lễ tốt nghiệp là cột mốc khép lại hành trình rực rỡ của những năm tháng thanh xuân dưới mái trường thân yêu, đồng thời mở ra cánh cửa tương lai đầy hứa hẹn.
                </div>
            </div>
        </div>

        <div class="t4p-card">
            <div class="t4p-sec-title">Thời gian & Địa điểm</div>
            <div class="t4p-info-wrap">
                <div class="t4p-info-item">
                    <div class="t4p-info-label">Thời gian</div>
                    <div class="t4p-info-val">08:00 - Thứ Bảy, 30/06/2049</div>
                </div>
                <div class="t4p-info-item">
                    <div class="t4p-info-label">Địa điểm</div>
                    <div class="t4p-info-val">Hội trường A10, Đại học NEU</div>
                </div>
            </div>

            <div class="t4p-countdown">
                <div class="t4p-cd-box"><div class="t4p-cd-num">45</div><div class="t4p-cd-label">Ngày</div></div>
                <div class="t4p-cd-box"><div class="t4p-cd-num">12</div><div class="t4p-cd-label">Giờ</div></div>
                <div class="t4p-cd-box"><div class="t4p-cd-num">30</div><div class="t4p-cd-label">Phút</div></div>
            </div>
        </div>

        <div class="t4p-card">
            <div class="t4p-sec-title">Timeline chương trình</div>
            @elseif($templateId == 5)
{{-- BẢN PREVIEW MẪU 5 (CINE LOVE BIRTHDAY) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Satisfy&family=Fredoka+One&family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer { display: none !important; }
.t5p-body {
    background-color: #D4EBF8 !important;
    color: #1E3E62;
    font-family: 'Quicksand', sans-serif;
    line-height: 1.6;
    min-height: 100vh;
    padding-bottom: 60px;
}
.t5p-container {
    max-width: 1000px;
    margin: 0 auto;
    background: #FFFFFF;
    min-height: 100vh;
    box-shadow: 0 0 50px rgba(30, 62, 98, 0.08);
    position: relative;
    overflow-x: hidden;
}
.t5p-music-record {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 44px;
    height: 44px;
    background: #222;
    border-radius: 50%;
    border: 3px solid #FFF;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
}
.t5p-music-record::after {
    content: '🎵';
    font-size: 16px;
}
.t5p-polaroid {
    background: #FFFFFF;
    padding: 12px 12px 28px 12px;
    border-radius: 4px;
    box-shadow: 0 10px 25px rgba(30, 62, 98, 0.12);
    border: 1px solid rgba(0,0,0,0.03);
    display: inline-block;
}
.t5p-polaroid-img-wrap {
    width: 100%;
    aspect-ratio: 1/1;
    overflow: hidden;
    background: #F0F4F8;
}
.t5p-polaroid-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t5p-polaroid.torn {
    border-radius: 8px;
    border: 8px solid #FFFFFF;
    box-shadow: 0 12px 30px rgba(30, 62, 98, 0.15);
}
.t5p-hero-section {
    background: linear-gradient(to bottom, #D2EDFC 0%, #FFFFFF 100%);
    padding: 40px 24px 20px;
    text-align: center;
    position: relative;
}
.t5p-hero-subtitle {
    font-family: 'Satisfy', cursive;
    font-size: 14px;
    color: #5B7B9C;
    line-height: 1.4;
    margin-bottom: 12px;
}
.t5p-hero-title {
    font-family: 'Satisfy', cursive;
    font-size: 64px;
    color: #4A90E2;
    margin: 0;
    line-height: 1;
}
.t5p-hero-collage {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 24px 0;
}
.t5p-hero-collage .t5p-polaroid {
    width: 70%;
    transform: rotate(-3deg);
}
.t5p-celebrant-badge {
    font-family: 'Caveat', cursive;
    font-size: 32px;
    color: #FF6B8B;
    margin-top: 10px;
    display: inline-block;
    transform: rotate(2deg);
}
.t5p-hero-welcome {
    font-size: 11px;
    letter-spacing: 0.25em;
    font-weight: 700;
    color: #5B7B9C;
    margin-top: 12px;
    text-transform: uppercase;
}
.t5p-card {
    padding: 32px 24px;
    text-align: center;
}
.t5p-sec-title {
    font-family: 'Fredoka One', cursive;
    font-size: 24px;
    color: #4A90E2;
    margin-bottom: 16px;
    display: inline-block;
}
.t5p-sec-title.bubble {
    background: #E8F4FC;
    padding: 6px 20px;
    border-radius: 20px;
}
.t5p-body-text {
    font-size: 14px;
    color: #1E3E62;
    line-height: 1.8;
}
.t5p-collage-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    padding: 12px 0;
    margin-top: 16px;
}
.t5p-collage-item {
    position: relative;
}
.t5p-collage-item:nth-child(1) { transform: rotate(-4deg); }
.t5p-collage-item:nth-child(2) { transform: rotate(3deg); margin-top: 12px; }
.t5p-collage-item:nth-child(3) { grid-column: span 2; justify-self: center; width: 80%; transform: rotate(-1deg); margin-top: 16px; }
.t5p-phone-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #4A90E2;
    color: #FFFFFF !important;
    text-decoration: none;
    font-weight: 700;
    font-size: 13px;
    padding: 10px 24px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.25);
    margin-top: 20px;
}
.t5p-calendar-box {
    background: #FAF8F2;
    border: 1px solid #BBD6EC;
    border-radius: 16px;
    padding: 20px;
    margin: 20px 0;
}
.t5p-cal-month-title {
    font-weight: 700;
    font-size: 15px;
    color: #1E3E62;
    margin-bottom: 16px;
}
.t5p-cal-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
    font-size: 13px;
}
.t5p-cal-weekday {
    font-weight: 700;
    color: #5B7B9C;
    padding-bottom: 8px;
}
.t5p-cal-day {
    aspect-ratio: 1/1;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    border-radius: 50%;
}
.t5p-cal-day.active {
    background: #FF6B8B;
    color: #FFFFFF;
    font-weight: 700;
}
.t5p-cal-day.active::after {
    content: '❤️';
    position: absolute;
    font-size: 10px;
    bottom: -6px;
    right: -4px;
}
.t5p-cal-day.empty { visibility: hidden; }
.t5p-map-wrap {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #BBD6EC;
    margin: 20px 0;
    aspect-ratio: 16/9;
}
.t5p-map-iframe { width: 100%; height: 100%; border: none; }
.t5p-address-text { font-size: 13.5px; color: #1E3E62; margin-top: 12px; font-weight: 600; }
.t5p-countdown-wrap {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 20px 0 10px;
}
.t5p-cd-item {
    background: #E8F4FC;
    border-radius: 12px;
    min-width: 68px;
    padding: 10px 6px;
}
.t5p-cd-val {
    font-family: 'Fredoka One', cursive;
    font-size: 22px;
    color: #4A90E2;
}
.t5p-cd-lbl {
    font-size: 10px;
    color: #5B7B9C;
    font-weight: 700;
    text-transform: uppercase;
}
.t5p-bottom-bar {
    background: #FFFFFF;
    border-top: 1px solid #BBD6EC;
    padding: 12px 20px;
    display: flex;
    gap: 12px;
    margin-top: 20px;
}
.t5p-bottom-input {
    flex: 1;
    padding: 10px 16px;
    border: 1px solid #BBD6EC;
    background: #F4F8FB;
    border-radius: 20px;
    font-size: 13px;
    outline: none;
}
.t5p-heart-btn {
    width: 42px; height: 42px;
    border-radius: 50%;
    border: 1px solid #BBD6EC;
    background: #F4F8FB;
    color: #FF6B8B;
    display: flex; align-items: center; justify-content: center;
}
.t5p-wishes-list {
    margin-top: 20px;
    text-align: left;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.t5p-wish-item {
    background: #F4F8FB;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 12px;
    border-left: 3px solid #4A90E2;
}
.t5p-wish-meta {
    font-weight: 700;
    color: #4A90E2;
    margin-bottom: 2px;
}
</style>
@endpush

<div class="t5p-body">
    <div class="t5p-container">
        <div class="t5p-music-record"></div>

        <div class="t5p-hero-section">
            <div class="t5p-hero-subtitle">Thể thao & Sức khỏe</div>
            <h1 class="t5p-hero-title">Invitation</h1>
            
            <div class="t5p-hero-collage">
                <div class="t5p-polaroid torn">
                    <div class="t5p-polaroid-img-wrap">
                        <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?auto=format&fit=crop&w=600&q=80" class="t5p-polaroid-img" alt="Cover photo">
                    </div>
                </div>
            </div>

            <div class="t5p-celebrant-badge">Hội thảo Thể thao Học đường</div>
            <div class="t5p-hero-welcome">WELCOME TO THE EVENT</div>
        </div>

        <div class="t5p-card">
            <div class="t5p-sec-title bubble">Lời mời trân trọng</div>
            <div class="t5p-body-text">
                Chào mừng các bạn đến dự buổi hội thảo chuyên đề đặc biệt về sức khỏe và huấn luyện thể chất học đường. Hãy tham dự để chia sẻ các góc nhìn khoa học và thực tiễn nhé!
            </div>
        </div>

        <div class="t5p-card">
            <div class="t5p-sec-title bubble">Khoảnh khắc đáng nhớ</div>
            <div class="t5p-collage-grid">
                <div class="t5p-collage-item">
                    <div class="t5p-polaroid">
                        <div class="t5p-polaroid-img-wrap">
                            <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?auto=format&fit=crop&w=300&q=80" class="t5p-polaroid-img" alt="">
                        </div>
                    </div>
                </div>
                <div class="t5p-collage-item">
                    <div class="t5p-polaroid">
                        <div class="t5p-polaroid-img-wrap">
                            <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?auto=format&fit=crop&w=300&q=80" class="t5p-polaroid-img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="t5p-card">
            <div class="t5p-sec-title bubble">Diễn giả & Khách mời</div>
            <div class="t5p-collage-grid" style="grid-template-columns: 1fr 1fr;">
                <div class="t5p-speaker-card" style="background:#FFF; border:1px solid #BBD6EC; border-radius:12px; padding:16px; text-align:center;">
                    <div class="t5p-speaker-av" style="width:64px; height:64px; border-radius:50%; margin:0 auto 8px; overflow:hidden; background:#E8F4FC; display:grid; place-items:center; font-size:24px;">👨‍💼</div>
                    <div class="t5p-speaker-name" style="font-weight:700; font-size:13px; color:#1E3E62;">HLV. Nguyễn Hồng Minh</div>
                    <div class="t5p-speaker-role" style="font-size:10px; color:#5B7B9C;">Cựu Vụ trưởng Vụ Thể thao</div>
                </div>
                <div class="t5p-speaker-card" style="background:#FFF; border:1px solid #BBD6EC; border-radius:12px; padding:16px; text-align:center;">
                    <div class="t5p-speaker-av" style="width:64px; height:64px; border-radius:50%; margin:0 auto 8px; overflow:hidden; background:#E8F4FC; display:grid; place-items:center; font-size:24px;">🧑‍⚕️</div>
                    <div class="t5p-speaker-name" style="font-weight:700; font-size:13px; color:#1E3E62;">PGS.TS. Trần Mạnh Hùng</div>
                    <div class="t5p-speaker-role" style="font-size:10px; color:#5B7B9C;">Chuyên gia Dinh dưỡng</div>
                </div>
            </div>
        </div>

        <div class="t5p-card">
            <div class="t5p-sec-title bubble">Chương trình hội thảo</div>
            <div class="t5p-wishes-list" style="text-align:left; display:flex; flex-direction:column; gap:12px;">
                <div class="t5p-wish-item" style="border-left:3px solid #4A90E2; padding-left:10px; background:#F4F8FB; border-radius:8px; padding:10px;">
                    <div style="font-weight:700; font-size:12px; color:#4A90E2;">08:00 - Đón tiếp đại biểu & Check-in</div>
                    <div style="font-size:11px; color:#5B7B9C; margin-top:2px;">Khai mạc chương trình</div>
                </div>
                <div class="t5p-wish-item" style="border-left:3px solid #4A90E2; padding-left:10px; background:#F4F8FB; border-radius:8px; padding:10px;">
                    <div style="font-weight:700; font-size:12px; color:#4A90E2;">09:00 - Chuyên đề: Phát triển thể chất</div>
                    <div style="font-size:11px; color:#5B7B9C; margin-top:2px;">Diễn giả: HLV. Nguyễn Hồng Minh</div>
                </div>
                <div class="t5p-wish-item" style="border-left:3px solid #4A90E2; padding-left:10px; background:#F4F8FB; border-radius:8px; padding:10px;">
                    <div style="font-weight:700; font-size:12px; color:#4A90E2;">10:30 - Tọa đàm: Dinh dưỡng tối ưu</div>
                    <div style="font-size:11px; color:#5B7B9C; margin-top:2px;">Diễn giả: PGS.TS. Trần Mạnh Hùng</div>
                </div>
            </div>
        </div>

        <div class="t5p-card">
            <div class="t5p-sec-title bubble">Thời gian diễn ra</div>
            <div class="t5p-calendar-box">
                <div class="t5p-cal-month-title">Tháng 07 / 2026</div>
                <div class="t5p-cal-grid">
                    <div class="t5p-cal-weekday">CN</div>
                    <div class="t5p-cal-weekday">T2</div>
                    <div class="t5p-cal-weekday">T3</div>
                    <div class="t5p-cal-weekday">T4</div>
                    <div class="t5p-cal-weekday">T5</div>
                    <div class="t5p-cal-weekday">T6</div>
                    <div class="t5p-cal-weekday">T7</div>

                    {{-- Mock dates grid --}}
                    <div class="t5p-cal-day empty"></div>
                    <div class="t5p-cal-day empty"></div>
                    <div class="t5p-cal-day">1</div>
                    <div class="t5p-cal-day">2</div>
                    <div class="t5p-cal-day">3</div>
                    <div class="t5p-cal-day">4</div>
                    <div class="t5p-cal-day">5</div>
                    <div class="t5p-cal-day">6</div>
                    <div class="t5p-cal-day">7</div>
                    <div class="t5p-cal-day">8</div>
                    <div class="t5p-cal-day">9</div>
                    <div class="t5p-cal-day">10</div>
                    <div class="t5p-cal-day">11</div>
                    <div class="t5p-cal-day">12</div>
                    <div class="t5p-cal-day">13</div>
                    <div class="t5p-cal-day">14</div>
                    <div class="t5p-cal-day">15</div>
                    <div class="t5p-cal-day">16</div>
                    <div class="t5p-cal-day">17</div>
                    <div class="t5p-cal-day">18</div>
                    <div class="t5p-cal-day">19</div>
                    <div class="t5p-cal-day">20</div>
                    <div class="t5p-cal-day">21</div>
                    <div class="t5p-cal-day">22</div>
                    <div class="t5p-cal-day">23</div>
                    <div class="t5p-cal-day">24</div>
                    <div class="t5p-cal-day active">25</div>
                    <div class="t5p-cal-day">26</div>
                    <div class="t5p-cal-day">27</div>
                    <div class="t5p-cal-day">28</div>
                    <div class="t5p-cal-day">29</div>
                    <div class="t5p-cal-day">30</div>
                    <div class="t5p-cal-day">31</div>
                </div>
            </div>
            <div class="t5p-body-text" style="font-weight: 700;">
                Thứ Bảy, ngày 25 tháng 07 năm 2026
                <br>
                <span style="color: #FF6B8B;">Thời gian: 16:00 PM</span>
            </div>
        </div>

        <div class="t5p-card">
            <div class="t5p-sec-title bubble">Địa điểm tổ chức</div>
            <div class="t5p-map-wrap">
                <iframe class="t5p-map-iframe" src="https://maps.google.com/maps?q=Hanoi&t=&z=14&ie=UTF8&iwloc=&output=embed"></iframe>
            </div>
            <div class="t5p-address-text">Khách sạn Daewoo, 360 Kim Mã, Ba Đình, Hà Nội</div>
        </div>

        <div class="t5p-card">
            <div class="t5p-sec-title bubble">Đếm ngược</div>
            <div class="t5p-countdown-wrap">
                <div class="t5p-cd-item"><div class="t5p-cd-val">45</div><div class="t5p-cd-lbl">Ngày</div></div>
                <div class="t5p-cd-item"><div class="t5p-cd-val">12</div><div class="t5p-cd-lbl">Giờ</div></div>
                <div class="t5p-cd-item"><div class="t5p-cd-val">30</div><div class="t5p-cd-lbl">Phút</div></div>
            </div>
        </div>

        <div class="t5p-card">
            <div class="t5p-sec-title bubble">Lời nhắn từ người tham gia</div>
            <div class="t5p-wishes-list">
                <div class="t5p-wish-item">
                    <div class="t5p-wish-meta">Phương Thảo</div>
                    <div>Chúc hội thảo thể thao diễn ra thật thành công tốt đẹp! Đề tài rất thiết thực! 🎉🏆</div>
                </div>
            </div>
        </div>

        <div class="t5p-bottom-bar">
            <input type="text" placeholder="Gửi lời chúc hoặc phản hồi đến sự kiện..." class="t5p-bottom-input" readonly />
            <button class="t5p-heart-btn">♥</button>
        </div>
    </div>
</div>
@elseif($templateId == 7)
{{-- BẢN PREVIEW MẪU 7 (TẠP CHÍ TỐT NGHIỆP) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
#navbar, .studio-footer { display: none !important; }
:root {
    --mag-bg: #F9F8F3;
    --mag-ink: #1C1A17;
    --mag-gold: #C5A059;
    --mag-gray: #78736B;
    --mag-border: #E8E5DF;
    --font-serif: 'Playfair Display', serif;
    --font-sans: 'DM Sans', sans-serif;
    --container-w: 800px;
}
.t7p-wrapper {
    max-width: var(--container-w);
    margin: 0 auto;
    background: var(--mag-bg);
    color: var(--mag-ink);
    font-family: var(--font-sans);
    font-size: 15px;
    line-height: 1.8;
    min-height: 100vh;
    box-shadow: 0 0 50px rgba(0,0,0,0.05);
}
.t7p-hero {
    position: relative;
    width: 100%;
    height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    overflow: hidden;
}
.t7p-hero-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t7p-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(28,26,23,0) 0%, rgba(28,26,23,0.2) 40%, rgba(28,26,23,0.85) 100%);
}
.t7p-hero-content {
    position: relative;
    z-index: 10;
    padding: 40px 30px;
    text-align: center;
    color: #fff;
}
.t7p-hero-issue {
    font-family: var(--font-sans);
    font-size: 11px;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--mag-gold);
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}
.t7p-hero-issue::before, .t7p-hero-issue::after {
    content: '';
    width: 40px;
    height: 1px;
    background: var(--mag-gold);
}
.t7p-hero h1 {
    font-family: var(--font-serif);
    font-weight: 600;
    font-size: 40px;
    line-height: 1.1;
    margin-bottom: 15px;
}
.t7p-hero-sub {
    font-family: var(--font-serif);
    font-style: italic;
    font-size: 18px;
    color: rgba(255,255,255,0.9);
    margin-bottom: 25px;
}
.t7p-cd-wrap {
    background: var(--mag-ink);
    color: #fff;
    padding: 25px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.t7p-cd-text { font-family: var(--font-serif); font-style: italic; font-size: 20px; color: var(--mag-gold); }
.t7p-cd-timer { display: flex; gap: 20px; }
.t7p-cd-item { text-align: center; }
.t7p-cd-num { display: block; font-family: var(--font-serif); font-size: 26px; line-height: 1; }
.t7p-cd-label { font-size: 9px; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.6); margin-top: 5px; }
.t7p-content { padding: 50px 30px; }
.t7p-section-hd { text-align: center; margin-bottom: 35px; }
.t7p-section-kicker { font-size: 10px; letter-spacing: 0.2em; text-transform: uppercase; color: var(--mag-gray); margin-bottom: 10px; }
.t7p-section-title { font-family: var(--font-serif); font-weight: 600; font-size: 30px; color: var(--mag-ink); position: relative; padding-bottom: 15px; }
.t7p-section-title::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 40px; height: 2px; background: var(--mag-gold); }
.t7p-intro { font-size: 15px; line-height: 1.9; text-align: center; color: var(--mag-gray); margin-bottom: 50px; max-width: 600px; margin-left: auto; margin-right: auto; }
.t7p-intro::first-letter { font-family: var(--font-serif); font-size: 50px; font-weight: 700; color: var(--mag-ink); float: left; line-height: 1; margin-right: 10px; margin-top: -4px; }
.t7p-gallery { margin-bottom: 60px; }
.t7p-gal-item { display: flex; align-items: center; gap: 30px; margin-bottom: 40px; }
.t7p-gal-item:nth-child(even) { flex-direction: row-reverse; }
.t7p-gal-img-wrap { width: 50%; position: relative; }
.t7p-gal-img-wrap::before { content: ''; position: absolute; top: -10px; left: -10px; width: 40%; height: 40%; border-top: 1px solid var(--mag-ink); border-left: 1px solid var(--mag-ink); z-index: 1; }
.t7p-gal-img { width: 100%; aspect-ratio: 3/4; object-fit: cover; position: relative; z-index: 2; filter: grayscale(20%); }
.t7p-gal-content { width: 50%; }
.t7p-gal-caption { font-family: var(--font-serif); font-size: 20px; font-weight: 600; margin-bottom: 10px; }
.t7p-guests { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 60px; }
.t7p-guest-card { text-align: center; }
.t7p-guest-img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin: 0 auto 15px; border: 1px solid var(--mag-border); padding: 4px; filter: grayscale(100%); }
.t7p-guest-name { font-family: var(--font-serif); font-size: 18px; font-weight: 600; margin-bottom: 4px; }
.t7p-guest-role { font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--mag-gold); }
.t7p-timeline { position: relative; max-width: 500px; margin: 0 auto 60px; }
.t7p-timeline::before { content: ''; position: absolute; top: 0; bottom: 0; left: 50%; transform: translateX(-50%); width: 1px; background: var(--mag-border); }
.t7p-tl-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; position: relative; }
.t7p-tl-time { width: 45%; text-align: right; font-family: var(--font-serif); font-size: 20px; font-weight: 600; color: var(--mag-gold); }
.t7p-tl-dot { width: 9px; height: 9px; border-radius: 50%; background: var(--mag-ink); position: absolute; left: 50%; transform: translateX(-50%); border: 3px solid var(--mag-bg); }
.t7p-tl-content { width: 45%; text-align: left; }
.t7p-tl-item:nth-child(even) { flex-direction: row-reverse; }
.t7p-tl-item:nth-child(even) .t7p-tl-time { text-align: left; }
.t7p-tl-item:nth-child(even) .t7p-tl-content { text-align: right; }
.t7p-bottom { display: flex; justify-content: center; gap: 15px; padding: 30px 0; border-top: 1px solid var(--mag-border); }
.t7p-btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 25px; font-family: var(--font-sans); font-weight: 600; font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase; border: 1px solid var(--mag-ink); background: transparent; color: var(--mag-ink); }
</style>
@endpush

<div class="t7p-wrapper">
    <div class="t7p-hero">
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600" class="t7p-hero-bg" alt="Hero">
        <div class="t7p-hero-overlay"></div>
        <div class="t7p-hero-content">
            <div class="t7p-hero-issue">LỄ TỐT NGHIỆP</div>
            <h1>Lễ Tốt Nghiệp Khóa 2026</h1>
            <div class="t7p-hero-sub">The Editorial Issue</div>
        </div>
    </div>

    <div class="t7p-cd-wrap">
        <div class="t7p-cd-text">Chờ đón khoảnh khắc...</div>
        <div class="t7p-cd-timer">
            <div class="t7p-cd-item"><span class="t7p-cd-num">15</span><div class="t7p-cd-label">Ngày</div></div>
            <div class="t7p-cd-item"><span class="t7p-cd-num">08</span><div class="t7p-cd-label">Giờ</div></div>
        </div>
    </div>

    <div class="t7p-content">
        <div class="t7p-section-hd">
            <div class="t7p-section-kicker">Chương 1</div>
            <h2 class="t7p-section-title">Câu Chuyện Của Chúng Tôi</h2>
        </div>
        <div class="t7p-intro">
            Một chặng đường đại học đầy ý nghĩa đã khép lại. Từng trang tạp chí này ghi lại những kỷ niệm đẹp nhất của chúng ta dưới mái trường mến yêu. Hãy cùng nhìn lại và tự hào về những gì chúng ta đã đạt được.
        </div>

        <div class="t7p-section-hd">
            <div class="t7p-section-kicker">Chương 2</div>
            <h2 class="t7p-section-title">Khung Hình Kỷ Niệm</h2>
        </div>
        <div class="t7p-gallery">
            <div class="t7p-gal-item">
                <div class="t7p-gal-img-wrap"><img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=800" class="t7p-gal-img" alt=""></div>
                <div class="t7p-gal-content">
                    <h3 class="t7p-gal-caption">Ngày Nhập Học</h3>
                    <div style="color:var(--mag-gray); font-size:13px;">Ký ức về ngày đầu bỡ ngỡ bước chân vào giảng đường.</div>
                </div>
            </div>
        </div>

        <div class="t7p-section-hd">
            <div class="t7p-section-kicker">Chương 3</div>
            <h2 class="t7p-section-title">Khách Mời</h2>
        </div>
        <div class="t7p-guests">
            <div class="t7p-guest-card">
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&q=80" class="t7p-guest-img" alt="">
                <div class="t7p-guest-name">GS. Nguyễn Văn A</div>
                <div class="t7p-guest-role">Hiệu Trưởng</div>
            </div>
            <div class="t7p-guest-card">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&q=80" class="t7p-guest-img" alt="">
                <div class="t7p-guest-name">TS. Trần Thị B</div>
                <div class="t7p-guest-role">Trưởng Khoa</div>
            </div>
        </div>

        <div class="t7p-section-hd">
            <div class="t7p-section-kicker">Chương 4</div>
            <h2 class="t7p-section-title">Lịch Trình Sự Kiện</h2>
        </div>
        <div class="t7p-timeline">
            <div class="t7p-tl-item">
                <div class="t7p-tl-time">08:00</div>
                <div class="t7p-tl-dot"></div>
                <div class="t7p-tl-content">
                    <div style="font-weight:600;">Đón Khách</div>
                </div>
            </div>
            <div class="t7p-tl-item">
                <div class="t7p-tl-time">09:00</div>
                <div class="t7p-tl-dot"></div>
                <div class="t7p-tl-content">
                    <div style="font-weight:600;">Khai Mạc Lễ</div>
                </div>
            </div>
        </div>

        <div class="t7p-bottom">
            <div class="t7p-btn">YÊU THÍCH (125)</div>
        </div>
    </div>
</div>

@endif

@endsection
