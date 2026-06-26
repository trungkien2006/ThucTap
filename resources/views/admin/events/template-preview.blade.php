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
            <p class="tp1-text">Tham gia cùng chúng tôi để lắng nghe chia sẻ từ các chuyên gia hàng đầu, trải nghiệm các demo công nghệ trực tiếp và mở rộng mạng lưới quan hệ trong một môi trường sáng tạo và chuyên nghiệp.</p>
        </div>
        
        <div class="tp1-card">
            <h2 class="tp1-section-title">Hoạt động nổi bật</h2>
            <div class="tp1-grid">
                <div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" class="tp1-img" alt="Content">
                </div>
                <div>
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">Networking & Demo</h3>
                    <p class="tp1-text">Bên cạnh các phiên thảo luận chuyên sâu, người tham dự sẽ có thời gian kết nối với các diễn giả và nhà đầu tư tại khu vực Networking. Trực tiếp trải nghiệm các mô hình AI ngôn ngữ lớn (LLM) và các robot tự hành do các startup nội địa phát triển ngay tại khu vực triển lãm.</p>
                    <a href="#" style="display:inline-block;padding:10px 20px;background:#f97316;color:white;border-radius:8px;text-decoration:none;font-weight:600;">Đăng ký tham gia</a>
                </div>
            </div>
            
            <div class="tp1-grid" style="margin-top: 32px;">
                <div>
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">Panel Discussion</h3>
                    <p class="tp1-text">Phiên tọa đàm đặc biệt "Đạo đức trong kỷ nguyên AI" với sự góp mặt của các nhà hoạch định chính sách, kỹ sư AI và nhà nghiên cứu xã hội học. Cùng nhau tìm ra sự cân bằng giữa sự phát triển nhanh chóng của công nghệ và tính nhân bản, an toàn của con người.</p>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80" class="tp1-img" alt="Panel">
                </div>
            </div>
        </div>
    </div>
</div>

@else
{{-- BẢN PREVIEW MẪU 2 (GARDEN) --}}
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
    .tp2-wrapper { background-color: #eaecf0; color: #3d4438; font-family: 'DM Sans', sans-serif; font-weight: 300; overflow-x: hidden; }
    .tp2-hero { position: relative; height: 70vh; min-height: 500px; overflow: hidden; margin-top: 72px; }
    .tp2-hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    .tp2-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(20,24,18,0.28) 0%, rgba(20,24,18,0.08) 50%, rgba(20,24,18,0.38) 100%); }
    .tp2-hero-title-block { position: absolute; top: 50%; right: 5%; transform: translateY(-50%); text-align: right; color: #fff; z-index: 2; }
    .tp2-hero-eyebrow { font-size: 1.14rem; letter-spacing: 0.3em; text-transform: uppercase; opacity: 0.88; margin-bottom: 10px; font-family: 'DM Sans', sans-serif; }
    .tp2-hero-name { font-family: 'Cormorant Garamond', serif; font-size: 5rem; font-weight: 400; line-height: 1; letter-spacing: 0.04em; text-transform: uppercase; text-shadow: 0 2px 30px rgba(0,0,0,0.25); color: #fff; }
    
    .tp2-section { padding: 100px 24px; position: relative; }
    .tp2-container { max-width: 860px; margin: 0 auto; }
    .tp2-card { background: #f4f4f2; border-radius: 4px; padding: 52px 48px; text-align: center; box-shadow: 0 4px 40px rgba(0,0,0,0.06); }
    .tp2-card-title { font-family: 'Cormorant Garamond', serif; font-size: 3.38rem; color: #3d4438; margin-bottom: 12px; }
    .tp2-card-text { font-size: 1.1rem; color: #6e7a6a; line-height: 1.8; margin-bottom: 36px; }
    
    .tp2-story-row { display: flex; justify-content: space-between; gap: 40px; margin-top: 60px; }
    .tp2-story-left { width: 45%; }
    .tp2-story-right { width: 45%; }
    .tp2-story-img { width: 100%; aspect-ratio: 4/5; object-fit: cover; border-radius: 4px; }
    .tp2-story-heading { font-family: 'Cormorant Garamond', serif; font-size: 3rem; margin-bottom: 24px; }
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
                    Mùa thu mang theo những gam màu ấm áp và cảm xúc sâu lắng. Triển lãm "Sắc Màu Mùa Thu" là nơi tôn vinh những tác phẩm hội họa đương đại lấy cảm hứng từ vẻ đẹp của thiên nhiên và con người trong thời khắc giao mùa. Hãy đến và cùng chúng tôi đắm chìm trong không gian nghệ thuật đầy chất thơ.
                </p>
                <div style="font-family:'Cormorant Garamond',serif;font-size:1.69rem;margin-bottom:4px;">Thời gian</div>
                <div style="font-size:1.07rem;color:#6e7a6a;margin-bottom:20px;">Thứ Bảy, 12/10/2026<br>09:00 - 17:00</div>
                <a href="#" style="display:inline-block;padding:13px 40px;background:#5d7a5c;color:#fff;font-size:0.88rem;letter-spacing:0.2em;text-transform:uppercase;text-decoration:none;">Tham gia ngay</a>
            </div>
            
            <div class="tp2-story-row">
                <div class="tp2-story-left">
                    <h2 class="tp2-story-heading">Hành trình<br>cảm xúc</h2>
                    <p style="font-size:1.14rem;color:#6e7a6a;line-height:1.9;">
                        Hơn 50 tác phẩm từ các nghệ sĩ trẻ tài năng được trưng bày theo một mạch cảm xúc xuyên suốt. Từ những bức tranh phong cảnh rực rỡ sắc vàng của lá mùa thu, đến những bức chân dung mang đậm suy tư và tĩnh lặng. Khán giả không chỉ xem tranh mà còn lắng nghe những câu chuyện đằng sau mỗi nét cọ, qua phần giao lưu trực tiếp với các tác giả.
                    </p>
                </div>
                <div class="tp2-story-right">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=800&q=80" class="tp2-story-img" alt="Art">
                </div>
            <div class="tp2-story-row" style="margin-top: 80px;">
                <div class="tp2-story-left" style="display:flex; flex-direction:column; justify-content:center;">
                    <img src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=80" class="tp2-story-img" style="aspect-ratio: 16/9;" alt="Art Workshop">
                </div>
                <div class="tp2-story-right">
                    <h2 class="tp2-story-heading" style="font-size: 2.5rem;">Workshop: <br>Nét vẽ mùa thu</h2>
                    <p style="font-size:1.14rem;color:#6e7a6a;line-height:1.9;">
                        Trong khuôn khổ triển lãm, một buổi workshop nghệ thuật sẽ được tổ chức dành cho những ai đam mê hội họa. Bạn sẽ được hướng dẫn các kỹ thuật pha màu và tự tay tạo nên một bức tranh phong cảnh mùa thu cho riêng mình. Dụng cụ sẽ được ban tổ chức chuẩn bị sẵn sàng.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
