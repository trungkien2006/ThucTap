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
    .tp1-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; }
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
            <p class="tp1-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <p class="tp1-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        
        <div class="tp1-card">
            <h2 class="tp1-section-title">Nội dung chương trình</h2>
            <div class="tp1-grid">
                <div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" class="tp1-img" alt="Content">
                </div>
                <div>
                    <p class="tp1-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <a href="#" style="display:inline-block;padding:10px 20px;background:#f97316;color:white;border-radius:8px;text-decoration:none;font-weight:600;">Xem chi tiết</a>
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
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.
                </p>
                <div style="font-family:'Cormorant Garamond',serif;font-size:1.69rem;margin-bottom:4px;">Thời gian</div>
                <div style="font-size:1.07rem;color:#6e7a6a;margin-bottom:20px;">Thứ Bảy, 12/10/2026<br>09:00 - 17:00</div>
                <a href="#" style="display:inline-block;padding:13px 40px;background:#5d7a5c;color:#fff;font-size:0.88rem;letter-spacing:0.2em;text-transform:uppercase;text-decoration:none;">Tham gia ngay</a>
            </div>
            
            <div class="tp2-story-row">
                <div class="tp2-story-left">
                    <h2 class="tp2-story-heading">Hành trình<br>cảm xúc</h2>
                    <p style="font-size:1.14rem;color:#6e7a6a;line-height:1.9;">
                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.
                    </p>
                </div>
                <div class="tp2-story-right">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=800&q=80" class="tp2-story-img" alt="Art">
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
