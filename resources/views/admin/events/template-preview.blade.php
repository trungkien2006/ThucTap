@extends('layouts.frontend')

@section('content')

@if($templateId == 1)
{{-- BẢN PREVIEW MẪU 1 (TIÊU CHUẨN) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    #navbar, .studio-footer { display: none !important; }
    .tp1-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; color: #0f172a; line-height: 1.6; }
    .tp1-hero { height: 60vh; min-height: 400px; position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .tp1-hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    .tp1-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15,23,42,0.2), rgba(15,23,42,0.8)); }
    .tp1-hero-content { position: relative; z-index: 10; text-align: center; color: white; padding: 0 20px; max-width: 800px; }
    .tp1-badge { background: #f97316; color: white; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 16px; display: inline-block; }
    .tp1-title { font-size: 48px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .tp1-meta { display: flex; gap: 24px; justify-content: center; font-size: 15px; opacity: 0.9; }
    .tp1-meta-item { display: flex; align-items: center; gap: 8px; }
    .tp1-container { max-width: 1000px; margin: 0 auto; padding: 60px 20px; }
    .tp1-card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-bottom: 40px; }
    .tp1-section-title { font-size: 24px; font-weight: 700; color: #0f172a; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; }
    .tp1-section-title::before { content: ''; display: block; width: 4px; height: 24px; background: #f97316; border-radius: 4px; }
    .tp1-text { font-size: 16px; color: #475569; margin-bottom: 20px; }
    .tp1-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; align-items: center; }
    .tp1-img { width: 100%; border-radius: 12px; object-fit: cover; aspect-ratio: 16/9; }
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
        </div>
    </div>
</div>

@elseif($templateId == 2)
{{-- BẢN PREVIEW MẪU 2 (GARDEN) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
    #navbar, .studio-footer { display: none !important; }
    .tp2-wrapper { background-color: #eaecf0; color: #3d4438; font-family: 'DM Sans', sans-serif; font-weight: 300; overflow-x: hidden; }
    .tp2-hero { position: relative; height: 70vh; min-height: 500px; overflow: hidden; }
    .tp2-hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    .tp2-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(20,24,18,0.28) 0%, rgba(20,24,18,0.08) 50%, rgba(20,24,18,0.38) 100%); }
    .tp2-hero-title-block { position: absolute; top: 50%; right: 5%; transform: translateY(-50%); text-align: right; color: #fff; z-index: 2; }
    .tp2-hero-eyebrow { font-size: 1.14rem; letter-spacing: 0.3em; text-transform: uppercase; opacity: 0.88; margin-bottom: 10px; font-family: 'DM Sans', sans-serif; }
    .tp2-hero-name { font-family: 'Cormorant Garamond', serif; font-size: 5rem; font-weight: 400; line-height: 1; letter-spacing: 0.04em; text-transform: uppercase; color: #fff; }
    .tp2-section { padding: 100px 24px; position: relative; }
    .tp2-container { max-width: 860px; margin: 0 auto; }
    .tp2-card { background: #f4f4f2; border-radius: 4px; padding: 52px 48px; text-align: center; box-shadow: 0 4px 40px rgba(0,0,0,0.06); }
    .tp2-card-title { font-family: 'Cormorant Garamond', serif; font-size: 3.38rem; color: #3d4438; margin-bottom: 12px; }
    .tp2-card-text { font-size: 1.1rem; color: #6e7a6a; line-height: 1.8; margin-bottom: 36px; }
</style>
@endpush

<div class="tp2-wrapper">
    <div class="tp2-hero">
        <img src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&w=1600&q=80" class="tp2-hero-img" alt="Hero">
        <div class="tp2-hero-overlay"></div>
        <div class="tp2-hero-title-block">
            <div class="tp2-hero-eyebrow">Triển lãm nghệ thuật</div>
            <div class="tp2-hero-name">Sắc Màu Mùa Thu</div>
        </div>
    </div>
    
    <div class="tp2-section">
        <div class="tp2-container">
            <div class="tp2-card">
                <div class="tp2-card-title">Lời ngỏ</div>
                <p class="tp2-card-text">
                    Mùa thu mang theo những gam màu ấm áp và cảm xúc sâu lắng. Triển lãm "Sắc Màu Mùa Thu" là nơi tôn vinh những tác phẩm hội họa đương đại lấy cảm hứng từ vẻ đẹp của thiên nhiên.
                </p>
            </div>
        </div>
    </div>
</div>

@elseif($templateId == 3)
{{-- BẢN PREVIEW MẪU 3 (ACADEMIC / HỌC THUẬT) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
<style>
    #navbar, .studio-footer { display: none !important; }
    .tp3-wrapper { background: #F8FAFF; color: #0F172A; font-family: 'Be Vietnam Pro', sans-serif; font-size: 14px; line-height: 1.6; }
    .tp3-hero { background: #0F2044; padding: 60px 48px; position: relative; overflow: hidden; text-align: left; }
    .tp3-hero::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 70% 80% at 80% 50%, rgba(29,78,216,.4) 0%, transparent 70%); }
    .tp3-hero-inner { position: relative; max-width: 800px; z-index: 10; }
    .tp3-hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(29,78,216,.3); border: 1px solid rgba(29,78,216,.5); border-radius: 999px; padding: 5px 14px; font-size: 11px; font-weight: 700; color: #93C5FD; margin-bottom: 20px; text-transform: uppercase; }
    .tp3-hero h1 { font-family: 'Playfair Display', serif; font-size: 40px; font-weight: 700; color: #fff; line-height: 1.1; margin-bottom: 16px; }
    .tp3-hero-sub { font-size: 15px; color: rgba(255,255,255,.6); line-height: 1.7; margin-bottom: 24px; }
    .tp3-content { max-width: 1000px; margin: 0 auto; padding: 40px 20px; }
    .tp3-card { background: white; border: 1px solid #E2E8F0; border-radius: 12px; padding: 32px; margin-bottom: 24px; }
    .tp3-title { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; margin-bottom: 16px; }
</style>
@endpush

<div class="tp3-wrapper">
    <div class="tp3-hero">
        <div class="tp3-hero-inner">
            <div class="tp3-hero-badge">Hội thảo Khoa học</div>
            <h1>Hội Thảo Quốc Tế <em>Trí Tuệ Nhân Tạo</em> trong Giáo dục</h1>
            <p class="tp3-hero-sub">Cùng các chuyên gia hàng đầu thảo luận về ứng dụng AI trong giảng dạy, nghiên cứu và quản lý giáo dục tại Việt Nam.</p>
        </div>
    </div>
    <div class="tp3-content">
        <div class="tp3-card">
            <h2 class="tp3-title">Về hội thảo</h2>
            <p>Trí tuệ nhân tạo (AI) đang tạo ra những thay đổi mang tính cách mạng trong mọi lĩnh vực, đặc biệt là Giáo dục. Hội thảo năm nay tập trung thảo luận các mô hình ứng dụng AI thực tế, chuẩn mực đạo đức, và các công cụ hỗ trợ nâng cao hiệu suất dạy học.</p>
        </div>
    </div>
</div>

@elseif($templateId == 4)
{{-- BẢN PREVIEW MẪU 4 (WORKSHOP / SEMINAR) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
    #navbar, .studio-footer { display: none !important; }
    .tp4-wrapper { background: #0B0F19; color: #F3F4F6; font-family: 'Outfit', sans-serif; font-size: 14px; }
    .tp4-hero { padding: 80px 20px; text-align: center; position: relative; }
    .tp4-badge { display: inline-flex; background: rgba(249, 115, 22, 0.15); border: 1px solid rgba(249, 115, 22, 0.3); border-radius: 99px; padding: 6px 16px; font-size: 11px; font-weight: 700; color: #F97316; margin-bottom: 20px; text-transform: uppercase; }
    .tp4-hero h1 { font-size: 44px; font-weight: 800; color: #fff; margin-bottom: 16px; }
    .tp4-hero-sub { font-size: 16px; color: #9CA3AF; max-width: 600px; margin: 0 auto; }
    .tp4-content { max-width: 800px; margin: 0 auto; padding: 40px 20px; }
    .tp4-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 32px; }
</style>
@endpush

<div class="tp4-wrapper">
    <div class="tp4-hero">
        <div class="tp4-badge">Workshop & Tọa đàm</div>
        <h1>Làm chủ Kỹ năng Thiết kế UI/UX Hiện đại</h1>
        <p class="tp4-hero-sub">Buổi chia sẻ thực tế về quy trình thiết kế sản phẩm số, xây dựng Design System và kiểm thử trải nghiệm người dùng.</p>
    </div>
    <div class="tp4-content">
        <div class="tp4-card">
            <h2 style="font-size: 20px; font-weight:700; margin-bottom:12px; color:#fff;">Nội dung chính</h2>
            <p style="color:#9CA3AF;">Buổi tọa đàm sẽ đi sâu vào các case-study thực tế từ các doanh nghiệp công nghệ lớn, hướng dẫn cách thiết kế giao diện tối ưu và áp dụng các nguyên tắc tâm lý học hành vi vào sản phẩm số.</p>
        </div>
    </div>
</div>

@elseif($templateId == 5)
{{-- BẢN PREVIEW MẪU 5 (CULTURAL / VĂN NGHỆ / GALA) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    #navbar, .studio-footer { display: none !important; }
    .tp5-wrapper { background: #0D0814; color: #FFF1F2; font-family: 'Plus Jakarta Sans', sans-serif; }
    .tp5-hero { padding: 90px 20px; text-align: center; position: relative; }
    .tp5-badge { display: inline-flex; background: rgba(236, 72, 153, 0.15); border: 1px solid rgba(236, 72, 153, 0.4); border-radius: 99px; padding: 6px 18px; font-family: 'Cinzel', serif; font-size: 11px; font-weight: 700; color: #FDA4AF; margin-bottom: 24px; }
    .tp5-hero h1 { font-family: 'Cinzel', serif; font-size: 46px; font-weight: 800; color: #fff; text-shadow: 0 0 20px rgba(236,72,153,0.4); margin-bottom: 16px; }
    .tp5-hero-sub { font-size: 15px; color: #FDA4AF; }
    .tp5-content { max-width: 800px; margin: 0 auto; padding: 40px 20px; }
    .tp5-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(236,72,153,0.15); border-radius: 20px; padding: 32px; }
</style>
@endpush

<div class="tp5-wrapper">
    <div class="tp5-hero">
        <div class="tp5-badge">Gala Âm nhạc</div>
        <h1>ĐÊM NHẠC MÙA THU: KHÚC GIAO MÙA</h1>
        <p class="tp5-hero-sub">Đắm chìm vào không gian nghệ thuật nhẹ nhàng và đầy chất thơ.</p>
    </div>
    <div class="tp5-content">
        <div class="tp5-card">
            <h2 style="font-family:'Cinzel', serif; font-size: 20px; margin-bottom:12px; color:#fff;">Thông tin chương trình</h2>
            <p style="color:#FDA4AF;">Đêm hội tụ những giọng ca xuất sắc nhất cùng các tiết mục nghệ thuật được dàn dựng công phu, hứa hẹn mang lại những cung bậc cảm xúc khó quên cho người xem.</p>
        </div>
    </div>
</div>

@elseif($templateId == 6)
{{-- BẢN PREVIEW MẪU 6 (SPORTS / THỂ THAO) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
<style>
    #navbar, .studio-footer { display: none !important; }
    .tp6-wrapper { background: #111317; color: #FFFFFF; font-family: 'Plus Jakarta Sans', sans-serif; }
    .tp6-hero { padding: 80px 20px; text-align: center; }
    .tp6-badge { display: inline-flex; background: rgba(255, 78, 0, 0.15); border: 1px solid #FF4E00; color: #FF4E00; padding: 4px 14px; border-radius: 4px; font-family: 'Teko', sans-serif; font-size: 18px; margin-bottom: 20px; text-transform: uppercase; }
    .tp6-hero h1 { font-family: 'Teko', sans-serif; font-size: 64px; font-weight: 700; text-transform: uppercase; margin-bottom: 16px; letter-spacing: 0.02em; }
    .tp6-hero-sub { font-size: 15px; color: #8E929A; }
    .tp6-content { max-width: 800px; margin: 0 auto; padding: 40px 20px; }
    .tp6-card { background: #1C1E24; border: 1px solid #23262F; padding: 32px; border-radius: 8px; }
</style>
@endpush

<div class="tp6-wrapper">
    <div class="tp6-hero">
        <div class="tp6-badge">Giải đấu Thể thao</div>
        <h1>GIẢI BÓNG ĐÁ ĐẠI HỌC CÚP VÀNG 2026</h1>
        <p class="tp6-hero-sub">Nơi tinh thần thể thao thăng hoa và khát khao chiến thắng rực cháy.</p>
    </div>
    <div class="tp6-content">
        <div class="tp6-card">
            <h2 style="font-family:'Teko', serif; font-size:28px; color:#fff; margin-bottom:12px;">CHI TIẾT GIẢI ĐẤU</h2>
            <p style="color:#8E929A;">Giải bóng đá thường niên quy tụ 16 đội tuyển mạnh nhất tranh tài trong 2 tuần. Hãy đăng ký đội bóng của bạn để tham gia vào giải đấu danh giá này.</p>
        </div>
    </div>
</div>

@elseif($templateId == 7)
{{-- BẢN PREVIEW MẪU 7 (CEREMONY / LỄ KỶ NIỆM) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Plus+Jakarta+Sans:wght@500;700&display=swap" rel="stylesheet">
<style>
    #navbar, .studio-footer { display: none !important; }
    .tp7-wrapper { background: #FFFFFF; color: #1E293B; font-family: 'Plus Jakarta Sans', sans-serif; }
    .tp7-hero { padding: 90px 20px; text-align: center; background: #0F172A; color: #fff; }
    .tp7-badge { display: inline-flex; background: rgba(217, 119, 6, 0.15); border: 1px solid #D97706; color: #D97706; padding: 4px 14px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; margin-bottom: 24px; }
    .tp7-hero h1 { font-family: 'Cinzel', serif; font-size: 44px; font-weight: 700; margin-bottom: 16px; }
    .tp7-hero-sub { font-size: 15px; color: #94A3B8; }
    .tp7-content { max-width: 800px; margin: 0 auto; padding: 40px 20px; }
    .tp7-card { background: #FFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); }
</style>
@endpush

<div class="tp7-wrapper">
    <div class="tp7-hero">
        <div class="tp7-badge">Lễ kỷ niệm & Khai giảng</div>
        <h1>LỄ KHAI GIẢNG & CHÀO ĐÓN TÂN SINH VIÊN K30</h1>
        <p class="tp7-hero-sub">Trang nghiêm, nồng nhiệt đón chào thế hệ sinh viên tiếp theo bước vào hành trình tri thức mới.</p>
    </div>
    <div class="tp7-content">
        <div class="tp7-card">
            <h2 style="font-family:'Cinzel', serif; font-size:20px; color:#0F172A; margin-bottom:12px;">Nội dung buổi lễ</h2>
            <p style="color:#64748B;">Lễ khai giảng chính thức với sự hiện diện của Ban giám hiệu nhà trường, các vị khách quý và hơn 2000 tân sinh viên khóa mới. Buổi lễ đánh dấu mốc khởi đầu quan trọng cho năm học đầy rực rỡ.</p>
        </div>
    </div>
</div>
@endif

@endsection
