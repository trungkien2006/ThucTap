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
    </section>
</div>

@elseif($templateId == 3)
{{-- BẢN PREVIEW MẪU 3 (AIFUTURE / MINT GREEN) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    /* ─── Template 3: AIFuture / Mint Green ─── */
    .tp3-wrapper {
        --tp3-primary: #006b5b;
        --tp3-primary-container: rgba(0, 245, 212, 0.2);
        --tp3-primary-light: #00f5d4;
        --tp3-on-surface: #1b1c1a;
        --tp3-on-surface-variant: #3a4a46;
        --tp3-surface-container-lowest: #ffffff;
        --tp3-surface-container: #efeeea;
        --tp3-background: #faf9f5;
        
        background-color: var(--tp3-background);
        color: var(--tp3-on-surface);
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        line-height: 24px;
        overflow-x: hidden;
        padding-top: 120px;
        padding-bottom: 120px;
    }
    
    body:has(.tp3-wrapper) { background-color: #faf9f5 !important; }

    .tp3-container { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
    
    .tp3-headline-lg { font-family: 'Plus Jakarta Sans', sans-serif; font-size: clamp(36px, 5vw, 48px); line-height: 1.2; font-weight: 700; letter-spacing: -0.01em; color: var(--tp3-on-surface); }
    .tp3-headline-md { font-family: 'Plus Jakarta Sans', sans-serif; font-size: clamp(24px, 4vw, 32px); line-height: 1.3; font-weight: 600; color: var(--tp3-on-surface); }
    .tp3-body-lg { font-size: 18px; line-height: 28px; font-weight: 400; color: var(--tp3-on-surface-variant); }
    .tp3-label-caps { font-family: 'Inter', sans-serif; font-size: 12px; line-height: 16px; letter-spacing: 0.08em; font-weight: 600; text-transform: uppercase; }
    
    .tp3-hero-badge { display: inline-flex; align-items: center; gap: 8px; padding: 6px 16px; border-radius: 999px; background: var(--tp3-primary-container); color: var(--tp3-primary); margin-bottom: 24px; }
    .tp3-meta-row { display: flex; flex-wrap: wrap; gap: 32px; color: var(--tp3-on-surface-variant); font-size: 18px; margin-top: 24px; }
    .tp3-meta-item { display: flex; align-items: center; gap: 8px; }
    .tp3-meta-icon { color: var(--tp3-primary); }
    
    .tp3-grid { display: grid; grid-template-columns: 1fr; gap: 48px; margin-bottom: 120px; }
    @media(min-width: 1024px) { .tp3-grid { grid-template-columns: 5fr 7fr; } }
    .tp3-title-decor { display: flex; align-items: center; gap: 16px; margin-bottom: 32px; }
    .tp3-title-decor::before { content: ''; display: block; width: 48px; height: 4px; background: var(--tp3-primary); border-radius: 99px; }
    
    .tp3-decor-card { position: relative; border-radius: 32px; overflow: hidden; border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); height: 500px; }
    .tp3-decor-glow { position: absolute; inset: -16px; background: rgba(0, 107, 91, 0.1); filter: blur(24px); border-radius: 40px; transition: background 0.5s; z-index: 0; }
    .tp3-decor-card-inner { position: relative; z-index: 1; height: 100%; }
    .tp3-decor-img { width: 100%; height: 100%; object-fit: cover; }
    .tp3-decor-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent); }
    
    .tp3-activities { margin-bottom: 120px; }
    .tp3-activities-header { text-align: center; margin-bottom: 64px; }
    .tp3-activities-grid { display: grid; grid-template-columns: 1fr; gap: 32px; padding-bottom: 40px; }
    @media(min-width: 768px) { .tp3-activities-grid { grid-template-columns: 1fr 1fr; gap: 24px; } }
    
    .tp3-card { background: var(--tp3-surface-container-lowest); border-radius: 24px; padding: 32px; box-shadow: 0 20px 40px rgba(0, 245, 212, 0.08); border: 1px solid transparent; transition: all 0.5s; display: flex; flex-direction: column; height: 100%; }
    .tp3-card:hover { border-color: rgba(0, 107, 91, 0.2); transform: scale(1.02); }
    .tp3-card-img-wrap { height: 256px; border-radius: 12px; overflow: hidden; margin-bottom: 32px; }
    .tp3-card-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s; }
    .tp3-card:hover .tp3-card-img { transform: scale(1.1); }
    
    .tp3-card-title { color: var(--tp3-primary); margin-bottom: 16px; }
    .tp3-card-desc { color: var(--tp3-on-surface-variant); margin-bottom: 32px; flex-grow: 1; }
    
    .tp3-tag { padding: 8px 16px; border-radius: 999px; background: var(--tp3-surface-container); color: var(--tp3-on-surface-variant); display: inline-flex; align-items: center; gap: 8px; font-weight: 600; text-decoration: none; }
</style>
@endpush

<div class="tp3-wrapper">
    <!-- Hero Header -->
    <header class="tp3-container" style="margin-bottom: 80px;">
        <div class="tp3-hero-badge">
            <span class="material-symbols-outlined" style="font-size: 18px;">category</span>
            <span class="tp3-label-caps">Công nghệ thông tin</span>
        </div>
        
        <h1 class="tp3-headline-lg" style="max-width: 900px;">Hội thảo Trí tuệ nhân tạo tương lai</h1>
        
        <div class="tp3-meta-row">
            <div class="tp3-meta-item">
                <span class="material-symbols-outlined tp3-meta-icon">calendar_today</span>
                24/12/2024 - 08:30
            </div>
            <div class="tp3-meta-item">
                <span class="material-symbols-outlined tp3-meta-icon">location_on</span>
                Trung tâm Hội nghị Quốc gia
            </div>
        </div>
    </header>

    <!-- Intro Grid -->
    <section class="tp3-container">
        <div class="tp3-grid">
            <div style="display: flex; flex-direction: column; justify-content: center;">
                <h2 class="tp3-headline-md tp3-title-decor">Giới thiệu sự kiện</h2>
                <div class="tp3-body-lg tp3-content-block" style="line-height: 1.8;">
                    <p style="margin-bottom: 16px;">Hội thảo Trí tuệ nhân tạo tương lai là sự kiện công nghệ thường niên quy tụ những chuyên gia hàng đầu trong lĩnh vực AI. Năm nay, chúng tôi tập trung vào sự giao thoa giữa trí tuệ nhân tạo và khả năng sáng tạo của con người, mở ra những góc nhìn mới về một kỷ nguyên công nghệ nhân văn.</p>
                    <p>Với quy mô hơn 1000 người tham dự, sự kiện không chỉ là nơi chia sẻ kiến thức mà còn là không gian kết nối, thực hành các công cụ AI tiên tiến nhất hiện nay.</p>
                </div>
            </div>
            
            <div style="position: relative;">
                <div class="tp3-decor-glow"></div>
                <div class="tp3-decor-card">
                    <div class="tp3-decor-card-inner">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80" class="tp3-decor-img" alt="Hero">
                        <div class="tp3-decor-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities -->
    <section class="tp3-container tp3-activities">
        <div class="tp3-activities-header">
            <h2 class="tp3-headline-md">Hoạt động nổi bật</h2>
            <p class="tp3-body-lg" style="max-width: 700px; margin: 16px auto 0;">Khám phá các hoạt động đặc sắc được thiết kế riêng để tối ưu hóa trải nghiệm học tập và kết nối của bạn.</p>
        </div>
        
        <div class="tp3-activities-grid">
            <div>
                <div class="tp3-card">
                    <div class="tp3-card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80" class="tp3-card-img" alt="">
                    </div>
                    <h3 class="tp3-headline-md tp3-card-title" style="font-size: 24px;">Khai mạc sự kiện</h3>
                    <div class="tp3-card-desc tp3-body-lg" style="font-size: 16px;">
                        Lễ khai mạc đầy cảm hứng với sự tham gia của các Keynote Speakers từ các tập đoàn công nghệ hàng đầu thế giới. Trải nghiệm trình diễn AI kết hợp nghệ thuật thị giác sống động.
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <span class="tp3-tag tp3-label-caps"><span class="material-symbols-outlined" style="font-size: 16px;">description</span> Tài liệu</span>
                    </div>
                </div>
            </div>

            <div style="transform: translateY(40px);">
                <div class="tp3-card">
                    <div class="tp3-card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=800&q=80" class="tp3-card-img" alt="">
                    </div>
                    <h3 class="tp3-headline-md tp3-card-title" style="font-size: 24px;">Workshop chuyên sâu</h3>
                    <div class="tp3-card-desc tp3-body-lg" style="font-size: 16px;">
                        Cơ hội thực hành trực tiếp cùng các chuyên gia. Bạn sẽ được hướng dẫn xây dựng các mô hình ngôn ngữ lớn (LLM) và ứng dụng Generative AI vào quy trình làm việc.
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <span class="tp3-tag tp3-label-caps"><span class="material-symbols-outlined" style="font-size: 16px;">link</span> Đăng ký Demo</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endif

@endsection
